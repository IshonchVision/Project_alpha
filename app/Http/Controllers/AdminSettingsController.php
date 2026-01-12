<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminSettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.sections.settings', compact('user', 'settings'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:50',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB ga oshirdim, kerak bo'lsa
        ]);

        if ($request->hasFile('avatar')) {
            try {
                $file = $request->file('avatar');

                $path = $file->store('avatars', [
                    'disk'       => 's3',           // ← 'minio' emas, 's3' ishlatamiz
                    'visibility' => 'public',
                ]);

                // Eski avatar bor bo'lsa — exists() siz o'chirishga urinaymiz
                if ($user->avatar) {
                    try {
                        Storage::disk('s3')->delete($user->avatar);
                    } catch (\Throwable $e) {
                        // Fayl yo'q bo'lsa yoki 403 chiqsa — jim o'tkazamiz
                        Log::warning("Eski avatar o'chirishda xato (ehtimol mavjud emas): " . $e->getMessage());
                    }
                }

                $user->avatar = $path;   // ← bu yerda saqlanadi
            } catch (\Throwable $e) {
                return back()->with('error', 'Avatarni yuklashda xatolik: ' . $e->getMessage());
            }
        }

        $user->name  = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? $user->phone;
        $user->save();

        return back()->with('success', 'Profil muvaffaqiyatli yangilandi');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        Auth::user()->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Parol muvaffaqiyatli yangilandi');
    }

    public function destroyAll(Request $request)
    {
        $request->validate([
            'confirmation' => 'required|string',
            'current_password' => 'required',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Parol noto\'g\'ri');
        }

        if ($request->confirmation !== 'DELETE ALL') {
            return back()->with('error', 'Tasdiqlash to\'g\'ri kelmadi');
        }

        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            $tables = [
                'group_messages',
                'groups',
                'courses',
                'payments',
                'contacts',
                'quizzes',
                'reflections',
                'modules',
                'videos',
                'posts'
            ];

            foreach ($tables as $t) {
                if (DB::getSchemaBuilder()->hasTable($t)) {
                    DB::table($t)->truncate();
                }
            }

            User::where('is_admin', false)->delete();

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Ma\'lumotlarni o\'chirishda xatolik: ' . $e->getMessage());
        }

        return back()->with('success', 'Keraksiz ma\'lumotlar o\'chirildi');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:50',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            try {
                $file = $request->file('avatar');
                $path = $file->store('avatars', 'public');
                if (!$path || !Storage::disk('public')->exists($path)) {
                    \Log::error('Avatar upload: stored path missing or file not found', ['path' => $path, 'user_id' => $user->id]);
                    return back()->with('error', 'Avatarni saqlashda xatolik yuz berdi');
                }

                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $user->avatar = $path;
            } catch (\Throwable $e) {
                \Log::error('Avatar upload failed: ' . $e->getMessage(), ['user_id' => $user->id]);
                return back()->with('error', 'Avatarni yuklashda xatolik');
            }
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? $user->phone;
        $user->save();

        return back()->with('success', 'Admin profil saqlandi');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Joriy parol noto\'g\'ri');
        }

        $user->password = bcrypt($request->password);
        $user->save();

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

        // Perform destructive cleanup within transaction and with FK checks disabled
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            // Truncate tables that are safe to remove
            $tables = [
                'group_messages', 'groups', 'courses', 'payments', 'contacts', 'quizzes', 'reflections', 'modules', 'videos', 'posts'
            ];
            foreach ($tables as $t) {
                if (DB::getSchemaBuilder()->hasTable($t)) {
                    DB::table($t)->truncate();
                }
            }

            // Remove non-admin users
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

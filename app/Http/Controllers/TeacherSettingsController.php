<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherSettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('teacher.sections.settings', compact('user'));
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
                    return back()->with('error', 'Avatarni saqlashda xatolik yuz berdi');
                }

                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $user->avatar = $path;
            } catch (\Throwable $e) {
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
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        Auth::user()->update(['password' => bcrypt($request->password)]);

        return back()->with('success', 'Parol muvaffaqiyatli yangilandi!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class StudentSettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('student.sections.settings', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');
            // delete old avatar if exists and is in public disk
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Profil ma\'lumotlaringiz yangilandi');
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

    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'email_notifications' => 'sometimes|boolean',
            'push_notifications' => 'sometimes|boolean',
        ]);

        $user->email_notifications = (bool) ($request->has('email_notifications') && $request->email_notifications);
        $user->push_notifications = (bool) ($request->has('push_notifications') && $request->push_notifications);
        $user->save();

        return back()->with('success', 'Bildirishnoma sozlamalari saqlandi');
    }
}

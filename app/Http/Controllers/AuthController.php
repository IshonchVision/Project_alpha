<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AuthController extends Controller
{
    public function login_blade()
    {
        return view("auth.login");
    }

    public function register_blade()
    {
        return view("auth.register");
    }

    public function register(Request $request)
    {
        // 1. Validation — eng muhim qism!
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', // baza darajasida unique tekshiruvi
            'password' => 'required|min:6|confirmed', // confirmed → password_confirmation bilan solishtiradi
        ], [
            'email.unique' => 'Bu email bilan allaqachon ro\'yxatdan o\'tilgan. Iltimos, login qiling',
            'email.required' => 'Email majburiy.',
            'email.email' => 'To\'g\'ri email manzil kiriting.',
            'password.required' => 'Parol majburiy.',
            'password.min' => 'Parol kamida 6 belgidan iborat bo\'lishi kerak.',
            'password.confirmed' => 'Parollar mos kelmayapti.',
        ]);

        // Agar validation o'tmasa → xato bilan orqaga qaytar
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // 2. User yaratish (xavfsiz)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // avto hash
            'role' => 'user',
            'status' => true
        ]);

        // 3. Muvaffaqiyatli xabar
        return redirect('/login')->with('success', 'Muvaffaqiyatli ro\'yxatdan o\'tdingiz! Endi tizimga kiring.');
    }



    public function login(Request $request)
    {
        // 1. Validation (majburiy maydonlar va format)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email manzil majburiy.',
            'email.email' => 'To\'g\'ri email kiriting.',
            'password.required' => 'Parol majburiy.',
        ]);

        $email = $request->email;
        $password = $request->password;
        $remember = $request->has('remember'); // "Meni eslab qol" checkbox

        // 2. Auth::attempt — Laravelning o'zi parolni tekshiradi (hash bilan)
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // Login muvaffaqiyatli
            $request->session()->regenerate(); // Session fixation oldini olish

            $user = Auth::user();

            if($user)
            {
                $user->update([
                    'status' => true
                ]);
            }

            // Role ga qarab yo'naltirish
            if ($user->role === 'teacher') {
                return redirect('/teacher/dashboard')->with('success', 'Xush kelibsiz, o\'qituvchi!');
            }

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Xush kelibsiz, admin!');
            }

            // Oddiy user (student)
            return redirect('/')->with('success', 'Muvaffaqiyatli kirish!');
        }

        // 3. Agar login muvaffaqiyatsiz bo'lsa
        return back()->withErrors([
            'email' => 'Email yoki parol noto\'g\'ri.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        Auth::logout();

        $request->session()->invalidate(); // sessiyani tozalaydi
        $request->session()->regenerateToken(); // CSRF tokenni yangilaydi

        if($user){
            $user->update([
                'status' => false
            ]);
        }

        return redirect('/')->with('success', 'Muvaffaqiyatli chiqdingiz!');
    }
}

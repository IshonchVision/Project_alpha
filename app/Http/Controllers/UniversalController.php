<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversalController extends Controller
{
    public function panel()
    {
        $user = Auth::user();

        if ($user->role === 'user') {
            return redirect()->route('student.dashboard');
        }

        if ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }

        // Admin yoki boshqa role
        return redirect()->route('admin.dashboard');
    }
}

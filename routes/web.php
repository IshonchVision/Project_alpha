<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GroupChatsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::view('/{any}', 'dashboard')->where('any', '.*');


// website url
Route::get('/', [HomeController::class, 'home']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('contact', [HomeController::class, 'contact']);
Route::get('course', [HomeController::class, 'course']);
Route::get('detail', [HomeController::class, 'detail']);
Route::get('feature', [HomeController::class, 'feature']);
Route::get('team', [HomeController::class, 'team']);
Route::get('testimonial', [HomeController::class, 'testimonial']);


// Login Register 

Route::get('/login_blade', [AuthController::class, 'login_blade'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register'])->name('register');


Route::get('/register', [AuthController::class, 'register_blade'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


// Mening kurslarim


Route::get('/my_course', [CourseController::class, 'my_course']);


Route::get('group_chats', [GroupChatsController::class, 'index']);

Route::get('admin', [AdminController::class, 'admin_panel']);




//  Admin url

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.sections.dashboard');
    })->name('dashboard');

    Route::get('/users', function () {
        return view('admin.sections.users');
    })->name('users');

    Route::get('/teachers', function () {
        return view('admin.sections.teachers');
    })->name('teachers');

    Route::get('/groups', function () {
        return view('admin.sections.groups');
    })->name('groups');

    Route::get('/chats', function () {
        return view('admin.sections.chats');
    })->name('chats');

    Route::get('/statistics', function () {
        return view('admin.sections.statistics');
    })->name('statistics');

    Route::get('/payments', function () {
        return view('admin.sections.payments');
    })->name('payments');

    Route::get('/settings', function () {
        return view('admin.sections.settings');
    })->name('settings');
});


Route::prefix('teacher')->name('teacher.')->group(function () {

    Route::get('/dashboard', function () {
        return view('teacher.sections.dashboard');
    })->name('dashboard');

    Route::get('/groups', function () {
        return view('teacher.sections.groups');
    })->name('groups');

    Route::get('/courses', function () {
        return view('teacher.sections.courses');
    })->name('courses');

    Route::get('/students', function () {
        return view('teacher.sections.students');
    })->name('students');

    Route::get('/grades', function () {
        return view('teacher.sections.greades');
    })->name('grades');

    Route::get('/chats', function () {
        return view('teacher.sections.chats');
    })->name('chats');

    Route::get('/settings', function () {
        return view('teacher.sections.settings');
    })->name('settings');

    Route::get('/payments', function () {
        return view('teacher.sections.payments');
    })->name('payments');
});




Route::prefix('student')->name('student.')->group(function () {

    Route::get('/dashboard', function () {
        return view('student.sections.dashboard');
    })->name('dashboard');

    Route::get('/courses', function () {
        return view('student.sections.courses');
    })->name('courses');

    Route::get('/course/{id}', function () {
        return view('student.sections.course_detail');
    })->name('course.detail');

    Route::get('/grades', function () {
        return view('student.sections.grades');
    })->name('grades');

    Route::get('/chats', function () {
        return view('student.sections.chats');
    })->name('chats');

    Route::get('/settings', function () {
        return view('student.sections.settings');
    })->name('settings');
});



// Student kurs detali sahifasi (kursni bosganda ochiladigan sahifa)
Route::get('/student/courses/{course}', function ($course) {
    return view('student.section.course-detail', ['courseId' => $course]);
})->name('student.courses.show');

Route::get('/student/lessons/{lesson}', function ($lesson) {
    return view('student.section.lesson', ['lessonId' => $lesson]);
})->name('student.lessons.show');

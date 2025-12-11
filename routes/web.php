<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GroupChatsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UniversalController;
use Illuminate\Support\Facades\Route;

// Route::view('/{any}', 'dashboard')->where('any', '.*');

Route::get('/', [HomeController::class, 'home'])->name('home'); // Sayt bosh sahifasi (kurslar ro'yxati)

Route::get('/courses', [CourseController::class, 'index'])->name('courses'); // Barcha kurslar sahifasi (public)
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show'); // Kurs detali (public)

// Boshqa public sahifalar (masalan: about, contact va h.k.)
Route::get('/about', function () {
    return view('about');
})->name('about');

// 2. Faqat login qilgan foydalanuvchilar uchun (Dashboard va shaxsiy sahifalar)
Route::middleware(['auth'])->group(function () {

    // Dashboard (mening kurslarim)
    Route::get('/dashboard', [HomeController::class, 'dashboard'])
        ->name('dashboard');

    // Student uchun shaxsiy sahifalar
    Route::get('/student/courses', function () {
        return view('student.courses');
    })->name('student.courses.index');

    Route::get('/student/courses/{course}', function ($course) {
        return view('student.course-detail', ['courseId' => $course]);
    })->name('student.courses.show');

    Route::get('/student/lessons/{lesson}', function ($lesson) {
        return view('student.lesson', ['lessonId' => $lesson]);
    })->name('student.lessons.show');
});



// website url
Route::get('/about', [HomeController::class, 'about']);
Route::get('contact', [HomeController::class, 'contact']);
Route::get('course', [HomeController::class, 'course']);
Route::get('detail', [HomeController::class, 'detail']);
Route::get('feature', [HomeController::class, 'feature']);
Route::get('team', [HomeController::class, 'team']);
Route::get('testimonial', [HomeController::class, 'testimonial']);


// Login Register 

// Login sahifasini ko'rsatish (GET)
Route::get('/login', [AuthController::class, 'login_blade'])->name('login');

// Login qilish (POST) — alohida nom kerak emas, lekin bo'lsa ham bo'ladi
Route::post('/login', [AuthController::class, 'login']); // name('login.post') yoki umuman namesiz

// Register sahifasini ko'rsatish (GET)
Route::get('/register', [AuthController::class, 'register_blade'])->name('register');

// Register qilish (POST)
Route::post('/register', [AuthController::class, 'register']);
// Mening kurslarim


Route::get('/universal/panel', [UniversalController::class, 'panel']);



Route::get('/my_course', [CourseController::class, 'my_course'])->middleware('auth');;


Route::get('group_chats', [GroupChatsController::class, 'index']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//  Admin url

Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [AdminController::class, 'admin_panel']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/teachers', [AdminController::class, 'teachers'])->name('teachers');
    Route::get('/groups', [AdminController::class, 'groups'])->name('groups');
    Route::get('/chats', [AdminController::class, 'chats'])->name('chats');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
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


Route::post('/contact/message/send', [ContactController::class, 'store'])
    ->name('contact.message.send');


Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('verify.show');
Route::post('/verify', [AuthController::class, 'verify'])->name('verify.check');


Route::get('/course/{id}', [CourseController::class, 'detail'])
     ->name('course.detail') 
     ->middleware('auth');
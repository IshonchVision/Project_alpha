<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GroupChatsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherSettingsController;
use App\Http\Controllers\UniversalController;
use Illuminate\Support\Facades\Route;

// 404 Fallback Route
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// ============================================
// PUBLIC ROUTES
// ============================================

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/course', [HomeController::class, 'course']);
Route::get('/detail', [HomeController::class, 'detail']);
Route::get('/feature', [HomeController::class, 'feature']);
Route::get('/team', [HomeController::class, 'team']);
Route::get('/testimonial', [HomeController::class, 'testimonial']);

// ============================================
// AUTH ROUTES
// ============================================

Route::get('/login', [AuthController::class, 'login_blade'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register_blade'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('verify.show');
Route::post('/verify', [AuthController::class, 'verify'])->name('verify.check');

// ============================================
// AUTHENTICATED USER ROUTES
// ============================================

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/my_course', [CourseController::class, 'my_course']);
    Route::get('/universal/panel', [UniversalController::class, 'panel']);
    Route::get('/group_chats', [GroupChatsController::class, 'index']);
});

// ============================================
// COURSE ROUTES
// ============================================

Route::get('/course/{id}', [CourseController::class, 'detail'])->name('course.detail');
Route::post('/course/watch', [CourseController::class, 'watch'])->name('course.watch');

// ============================================
// CONTACT ROUTE
// ============================================

Route::post('/contact/message/send', [ContactController::class, 'store'])
    ->name('contact.message.send');

// ============================================
// ADMIN ROUTES
// ============================================

Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [AdminController::class, 'admin_panel']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/teachers', [AdminController::class, 'teachers'])->name('teachers');
    Route::get('/groups', [AdminController::class, 'groups'])->name('groups');
    Route::get('/chats', [AdminController::class, 'chats'])->name('chats');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');

    // Settings
    Route::get('/settings', [\App\Http\Controllers\AdminSettingsController::class, 'edit'])->name('settings');
    Route::post('/settings/profile', [\App\Http\Controllers\AdminSettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/general', [\App\Http\Controllers\AdminSettingsController::class, 'updateGeneral'])->name('settings.general');
    Route::post('/settings/notifications', [\App\Http\Controllers\AdminSettingsController::class, 'updateNotifications'])->name('settings.notifications');
    Route::post('/settings/password', [\App\Http\Controllers\AdminSettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/destroy', [\App\Http\Controllers\AdminSettingsController::class, 'destroyAll'])->name('settings.destroy');

    // Users & Teachers
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
    Route::delete('/teacher/{user}', [AdminController::class, 'teacher_destroy'])->name('teachers.destroy');
    Route::post('/teachers', [AdminController::class, 'teacher_store'])->name('teachers.store');

    // Chats
    Route::post('/chats/send', [AdminController::class, 'sendChatMessage'])->name('chats.send');
    Route::get('/chats/{id}', [AdminController::class, 'loadGroupChat'])->name('chats.group');
    Route::get('/chats/{id}/poll', [AdminController::class, 'pollGroupMessages'])->name('chats.poll');

    // Groups
    Route::post('/groups', [AdminController::class, 'storeGroup'])->name('groups.store');
});

// ============================================
// TEACHER ROUTES
// ============================================

Route::prefix('teacher')->name('teacher.')->middleware(['auth', 'is_teacher'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');

    // Groups
    Route::get('/groups', [TeacherController::class, 'groups'])->name('groups');
    Route::post('/groups', [TeacherController::class, 'storeGroup'])->name('groups.store');
    Route::get('/groups/{id}', [TeacherController::class, 'showGroup'])->name('groups.show');
    Route::put('/groups/{id}', [TeacherController::class, 'updateGroup'])->name('groups.update');
    Route::delete('/groups/{id}', [TeacherController::class, 'destroyGroup'])->name('groups.destroy');

    // Courses
    Route::get('/courses', [TeacherController::class, 'courses'])->name('courses');
    Route::post('/courses', [TeacherController::class, 'storeCourse'])->name('courses.store');
    Route::get('/courses/{id}', [TeacherController::class, 'showCourse'])->name('courses.show');
    Route::put('/courses/{id}', [TeacherController::class, 'updateCourse'])->name('courses.update');
    Route::delete('/courses/{id}', [TeacherController::class, 'destroyCourse'])->name('courses.destroy');

    Route::get('/courses/{course}/videos/create', [TeacherController::class, 'createVideo'])
        ->name('courses.videos.create');
    Route::post('/courses/{course}/videos', [TeacherController::class, 'storeVideo'])
        ->name('courses.videos.store');
    Route::delete('/videos/{id}', [TeacherController::class, 'destroyVideo'])
        ->name('videos.destroy');

    Route::get('/courses/{course}/quizzes/create', [TeacherController::class, 'createQuiz'])
        ->name('quizzes.create');
    Route::post('/courses/{course}/quizzes', [TeacherController::class, 'storeQuiz'])
        ->name('quizzes.store');
    Route::delete('/quizzes/{id}', [TeacherController::class, 'destroyQuiz'])
        ->name('quizzes.destroy');

    // Students
    Route::get('/students', [TeacherController::class, 'students'])->name('students');

    // Grades
    Route::get('/grades', [TeacherController::class, 'grades'])->name('grades');

    // Chats
    Route::get('/chats', [TeacherController::class, 'chats'])->name('chats');
    Route::post('/chats/send', [TeacherController::class, 'sendChatMessage'])->name('chats.send');
    Route::get('/chats/{id}', [TeacherController::class, 'loadGroupChat'])->name('chats.group');
    Route::get('/chats/{id}/poll', [TeacherController::class, 'pollGroupMessages'])->name('chats.poll');

    // Settings
    Route::get('/settings', [TeacherSettingsController::class, 'edit'])->name('settings');
    Route::put('/settings', [TeacherSettingsController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [TeacherSettingsController::class, 'updatePassword'])->name('password.update');
});

// ============================================
// STUDENT ROUTES
// ============================================

Route::prefix('student')->name('student.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

    // Profile Settings
    Route::post('/settings/profile', [StudentController::class, 'updateProfile'])->name('settings.profile');

    // Courses
    Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/courses/{id}', [StudentController::class, 'courseDetail'])->name('courses.show');

    // Quizzes
    Route::get('/quizzes/{id}/take', [StudentController::class, 'takeQuiz'])->name('quiz.take');
    Route::post('/quizzes/{id}/submit', [StudentController::class, 'submitQuiz'])->name('quiz.submit');

    // Chats
    Route::get('/chats', [StudentController::class, 'chats'])->name('chats');
    Route::get('/chats/{id}', [StudentController::class, 'loadGroupChat'])->name('chats.group');
    Route::get('/chats/{id}/poll', [StudentController::class, 'pollGroupMessages'])->name('chats.poll');
    Route::post('/chats/send', [StudentController::class, 'sendChatMessage'])->name('chats.send');

    // Settings
    Route::get('/settings', function () {
        return view('student.sections.settings');
    })->name('settings');
});
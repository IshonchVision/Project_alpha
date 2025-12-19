<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GroupChatsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
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

    // Admin settings controller actions
    Route::get('/settings', [\App\Http\Controllers\AdminSettingsController::class, 'edit'])->name('settings');
    Route::post('/settings/profile', [\App\Http\Controllers\AdminSettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/general', [\App\Http\Controllers\AdminSettingsController::class, 'updateGeneral'])->name('settings.general');
    Route::post('/settings/notifications', [\App\Http\Controllers\AdminSettingsController::class, 'updateNotifications'])->name('settings.notifications');
    Route::post('/settings/password', [\App\Http\Controllers\AdminSettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/destroy', [\App\Http\Controllers\AdminSettingsController::class, 'destroyAll'])->name('settings.destroy');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])
        ->name('users.destroy');
    Route::delete('/teacher/{user}', [AdminController::class, 'teacher_destroy'])
        ->name('teachers.destroy');
    Route::post('/teachers', [AdminController::class, 'teach    er_store'])->name('teachers.store');

    Route::get('/chats', [AdminController::class, 'chats'])->name('chats');
    Route::post('/chats/send', [AdminController::class, 'sendChatMessage'])->name('chats.send');
    Route::get('/chats/{id}', [AdminController::class, 'loadGroupChat'])->name('chats.group');
    Route::get('/chats/{id}/poll', [AdminController::class, 'pollGroupMessages'])->name('chats.poll');
    // Creates a new group — use existing controller method `storeGroup`
    Route::post('/groups', [AdminController::class, 'storeGroup'])->name('groups.store');
});


Route::prefix('teacher')->name('teacher.')->middleware(['auth', 'is_teacher'])->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\TeacherController::class, 'dashboard'])->name('dashboard');

    // Groups
    Route::get('/groups', [\App\Http\Controllers\TeacherController::class, 'groups'])->name('groups');
    Route::post('/groups', [\App\Http\Controllers\TeacherController::class, 'storeGroup'])->name('groups.store');
    Route::get('/groups/{id}', [\App\Http\Controllers\TeacherController::class, 'showGroup'])->name('groups.show');
    Route::put('/groups/{id}', [\App\Http\Controllers\TeacherController::class, 'updateGroup'])->name('groups.update');
    Route::delete('/groups/{id}', [\App\Http\Controllers\TeacherController::class, 'destroyGroup'])->name('groups.destroy');

    // Courses
    Route::get('/courses', [\App\Http\Controllers\TeacherController::class, 'courses'])->name('courses');
    Route::post('/courses', [\App\Http\Controllers\TeacherController::class, 'storeCourse'])->name('courses.store');
    Route::get('/courses/{id}', [\App\Http\Controllers\TeacherController::class, 'showCourse'])->name('courses.show');
    Route::put('/courses/{id}', [\App\Http\Controllers\TeacherController::class, 'updateCourse'])->name('courses.update');
    Route::delete('/courses/{id}', [\App\Http\Controllers\TeacherController::class, 'destroyCourse'])->name('courses.destroy');

    // Video upload/delete
    Route::post('/courses/{id}/videos', [\App\Http\Controllers\TeacherController::class, 'storeVideo'])->name('courses.videos.store');
    Route::delete('/videos/{id}', [\App\Http\Controllers\TeacherController::class, 'destroyVideo'])->name('videos.destroy');

    // Students
    Route::get('/students', [\App\Http\Controllers\TeacherController::class, 'students'])->name('students');

    // Grades (placeholder)
    Route::get('/grades', [\App\Http\Controllers\TeacherController::class, 'grades'])->name('grades');

    // Chats
    Route::get('/chats', [\App\Http\Controllers\TeacherController::class, 'chats'])->name('chats');
    Route::post('/chats/send', [\App\Http\Controllers\TeacherController::class, 'sendChatMessage'])->name('chats.send');
    Route::get('/chats/{id}', [\App\Http\Controllers\TeacherController::class, 'loadGroupChat'])->name('chats.group');
    Route::get('/chats/{id}/poll', [\App\Http\Controllers\TeacherController::class, 'pollGroupMessages'])->name('chats.poll');

    // Settings
    Route::get('/settings', [\App\Http\Controllers\TeacherSettingsController::class, 'edit'])->name('settings');
    Route::post('/settings/profile', [\App\Http\Controllers\TeacherSettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/password', [\App\Http\Controllers\TeacherSettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/notifications', [\App\Http\Controllers\TeacherSettingsController::class, 'updateNotifications'])->name('settings.notifications');

    Route::post('/teacher/quizzes', [TeacherController::class, 'storeQuiz'])->name('quizzes.store');
    Route::delete('/teacher/quizzes/{id}', [TeacherController::class, 'destroyQuiz'])->name('quizzes.destroy');
});




Route::prefix('student')->name('student.')->middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('student.sections.dashboard');
    })->name('dashboard');

    Route::get('/courses', function () {
        return view('student.sections.courses');
    })->name('courses');
});



Route::post('/contact/message/send', [ContactController::class, 'store'])
    ->name('contact.message.send');


Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('verify.show');
Route::post('/verify', [AuthController::class, 'verify'])->name('verify.check');


Route::get('/course/{id}', [CourseController::class, 'detail'])
    ->name('course.detail')
    ->middleware('auth');

// Watch/Access a course — requires auth; returns JSON 401 for AJAX or flashes error for guests
Route::post('/course/watch', [CourseController::class, 'watch'])->name('course.watch');


// routes/web.php yoki teacher route file ichiga:

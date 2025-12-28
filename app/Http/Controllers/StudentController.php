<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function courses()
    {
        $enrolledCourses = Auth::user()
            ->enrolledCourses()
            ->with(['user', 'videos'])
            ->withCount('videos')
            ->latest()
            ->get();

        // Progress (keyin real qilamiz, hozircha tasodifiy)
        foreach ($enrolledCourses as $course) {
            $course->progress = rand(10, 90);
        }

        return view('student.sections.courses', compact('enrolledCourses'));
    }

    // Kurs detal sahifasi
    public function courseDetail($courseId)
    {
        $course = Course::with([
            'user',
            'videos' => function ($query) {
                $query->orderBy('id'); // yoki order column bo'lsa 'order'
            },
            'quizzes',
        ])
            ->withCount(['videos', 'quizzes'])
            ->findOrFail($courseId);

        // Talaba bu kursga enrolledmi?
        if (! Auth::user()->enrolledCourses()->where('course_id', $courseId)->exists()) {
            abort(403, 'Siz bu kursga ro\'yxatdan o\'tmagansiz.');
        }

        // TO'G'RI VIEW NOMI: student.sections.course-detail
        return view('student.sections.course-detail', compact('course'));
    }

    // Video dars sahifasi
    public function lesson($lessonId)
    {
        $video = Video::with('course.user')->findOrFail($lessonId);

        // Tekshirish: talaba kursga enrolledmi?
        if (! Auth::user()->enrolledCourses()->where('course_id', $video->course_id)->exists()) {
            abort(403, 'Ruxsat etilmagan.');
        }

        return view('student.lesson', compact('video'));
    }

    public function dashboard()
    {
        return view('student.sections.dashboard');
    }
}

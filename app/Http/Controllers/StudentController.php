<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\Quiz;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil muvaffaqiyatli yangilandi!');
    }

    public function courses()
    {
        $enrolledCourses = Auth::user()
            ->enrolledCourses()
            ->with(['user', 'videos'])
            ->withCount('videos')
            ->latest()
            ->get();

        foreach ($enrolledCourses as $course) {
            $course->progress = rand(10, 90);

            foreach ($course->videos as $video) {
                if (config('filesystems.default') === 's3') {
                    $video->signed_url = Storage::disk('s3')->temporaryUrl(
                        $video->video_url,
                        Carbon::now()->addHours(5),
                        ['ResponseContentType' => 'video/mp4']
                    );
                } else {
                    $video->signed_url = asset('storage/' . $video->video_url);
                }
            }
        }

        return view('student.sections.courses', compact('enrolledCourses'));
    }

    public function courseDetail($courseId)
    {
        $course = Course::with([
            'user',
            'videos' => fn($q) => $q->orderBy('id'),
            'quizzes',
        ])
            ->withCount(['videos', 'quizzes'])
            ->findOrFail($courseId);

        if (!Auth::user()->enrolledCourses()->where('course_id', $courseId)->exists()) {
            abort(403, 'Siz bu kursga ro\'yxatdan o\'tmagansiz.');
        }

        foreach ($course->videos as $video) {
            if (config('filesystems.default') === 's3') {
                $video->signed_url = Storage::disk('s3')->temporaryUrl(
                    $video->video_url,
                    Carbon::now()->addHours(5),
                    ['ResponseContentType' => 'video/mp4']
                );
            } else {
                $video->signed_url = asset('storage/' . $video->video_url);
            }
        }

        return view('student.sections.course-detail', compact('course'));
    }

    public function takeQuiz($quizId)
    {
        $quiz = Quiz::with('questions', 'course')->findOrFail($quizId);

        if (!$quiz->course || $quiz->course->course_type !== 'theory' || !Auth::user()->enrolledCourses()->where('course_id', $quiz->course_id)->exists()) {
            abort(403, 'Ruxsat etilmagan.');
        }

        return view('student.quiz.take', compact('quiz'));
    }

    public function submitQuiz(Request $request, $quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);

        if ($quiz->course->course_type !== 'theory' || !Auth::user()->enrolledCourses()->where('course_id', $quiz->course_id)->exists()) {
            abort(403, 'Ruxsat etilmagan.');
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|in:a,b,c,d',
        ]);

        $score = 0;
        $totalPoints = $quiz->questions->sum('points');

        foreach ($quiz->questions as $question) {
            $userAnswer = $request->answers[$question->id] ?? null;
            if ($userAnswer && strtolower($userAnswer) === strtolower($question->correct_answer)) {
                $score += $question->points;
            }
        }

        $percentage = ($totalPoints > 0) ? ($score / $totalPoints) * 100 : 0;
        $passed = $percentage >= $quiz->passing_score_percentage;

        return view('student.quiz.result', compact('quiz', 'score', 'totalPoints', 'percentage', 'passed'));
    }

    public function lesson($lessonId)
    {
        $video = Video::with('course.user')->findOrFail($lessonId);

        if (!Auth::user()->enrolledCourses()->where('course_id', $video->course_id)->exists()) {
            abort(403, 'Ruxsat etilmagan.');
        }

        return view('student.lesson', compact('video'));
    }

    public function dashboard()
    {
        return view('student.sections.dashboard');
    }

    public function chats()
    {
        $user = Auth::user();

        // TO'G'IRLANDI: student_id ishlatildi
        $groups = Group::with('teacher')
            ->withCount('messages as messages_count')
            // eager-load only the latest message per group
            ->with(['messages' => fn($q) => $q->latest()->limit(1)])
            ->get();


        foreach ($groups as $group) {
            $group->current_students = $group->students()->count();
        }

        $selectedGroup = $groups->first();

        $messages = collect();
        if ($selectedGroup) {
            $messages = GroupMessage::with('user')
                ->where('group_id', $selectedGroup->id)
                ->latest()
                ->limit(100)
                ->get()
                ->reverse();
        }

        return view('student.sections.chats', compact('groups', 'selectedGroup', 'messages'));
    }

    public function loadGroupChat($id)
    {
        try {
            $user = Auth::user();

            // TO'G'IRLANDI: student_id ishlatildi
            $selectedGroup = Group::whereHas('students', fn($q) => $q->where('student_id', $user->id))
                ->with('teacher')
                ->findOrFail($id);

            $messages = GroupMessage::with('user')
                ->where('group_id', $id)
                ->latest()
                ->limit(100)
                ->get()
                ->reverse();

            $html = view('student.sections.chat-window', compact('selectedGroup', 'messages'))->render();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'html' => $html,
                    'group_id' => $selectedGroup->id,
                    'last_message' => optional($messages->last())->message ?? null,
                    'last_time' => optional($messages->last())->created_at?->diffForHumans() ?? null,
                    'last_user_id' => optional($messages->last())->user_id ?? null,
                    'messages_count' => GroupMessage::where('group_id', $id)->count(),
                    'last_message_id' => optional($messages->last())->id ?? null,
                ]);
            }

            return view('student.sections.chat-window', compact('selectedGroup', 'messages'));
        } catch (\Throwable $e) {
            Log::error('Student loadGroupChat error', ['id' => $id, 'error' => $e->getMessage()]);

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json(['message' => 'Guruhni yuklashda server xatosi yuz berdi. Iltimos, sahifani yangilang.'], 500);
            }

            throw $e;
        }
    }

    public function pollGroupMessages($id, Request $request)
    {
        try {
            $user = Auth::user();

            // TO'G'IRLANDI: student_id ishlatildi
            $exists = Group::whereHas('students', fn($q) => $q->where('student_id', $user->id))
                ->where('id', $id)
                ->exists();

            if (!$exists) {
                abort(403);
            }

            $lastId = (int) $request->query('last_id', 0);

            $messages = GroupMessage::with('user')
                ->where('group_id', $id)
                ->when($lastId > 0, function ($q) use ($lastId) {
                    $q->where('id', '>', $lastId);
                })
                ->orderBy('id')
                ->get();

            $html = '';
            foreach ($messages as $msg) {
                $html .= view('student.sections.partials.message', compact('msg'))->render();
            }

            $newLastId = $messages->last()?->id ?? $lastId;

            return response()->json([
                'html' => $html,
                'last_message_id' => $newLastId,
                'messages_count' => GroupMessage::where('group_id', $id)->count(),
                'last_message' => optional($messages->last())->message ?? null,
                'last_time' => optional($messages->last())->created_at?->diffForHumans() ?? null,
                'last_user_id' => optional($messages->last())->user_id ?? null,
            ]);
        } catch (\Throwable $e) {
            Log::error('Student pollGroupMessages error', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Polling xatosi'], 500);
        }
    }

    public function sendChatMessage(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'message' => 'required|string|max:1000'
        ]);

        $user = Auth::user();

        // TO'G'IRLANDI: student_id ishlatildi
        $group = Group::whereHas('students', fn($q) => $q->where('student_id', $user->id))
            ->findOrFail($request->group_id);

        $message = GroupMessage::create([
            'group_id' => $group->id,
            'user_id' => $user->id,
            'message' => $request->message,
        ]);

        event(new \App\Events\NewGroupMessage($message));

        if ($request->ajax() || $request->wantsJson()) {
            $selectedGroup = Group::with('teacher')->findOrFail($request->group_id);

            $messages = GroupMessage::with('user')
                ->where('group_id', $selectedGroup->id)
                ->latest()
                ->limit(100)
                ->get()
                ->reverse();

            $html = view('student.sections.chat-window', compact('selectedGroup', 'messages'))->render();

            return response()->json([
                'html' => $html,
                'group_id' => $selectedGroup->id,
                'last_message' => $message->message,
                'last_time' => $message->created_at->diffForHumans(),
                'messages_count' => GroupMessage::where('group_id', $selectedGroup->id)->count(),
                'last_message_id' => $message->id,
                'message_html' => view('student.sections.partials.message', ['msg' => $message])->render(),
                'message_id' => $message->id,
            ]);
        }

        return back()->with('success', 'Xabar yuborildi');
    }
}

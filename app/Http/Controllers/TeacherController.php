<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Quizzes;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Number of courses owned by this teacher
        $coursesCount = Course::where('user_id', $user->id)->count();

        // Active groups taught by this teacher
        $activeGroups = Group::where('teacher_id', $user->id)->where('status', 'active')->count();

        // Students: unique users from course_student and group_student
        $courseStudentIds = DB::table('course_student')
            ->whereIn('course_id', function ($q) use ($user) {
                $q->select('id')->from('courses')->where('user_id', $user->id);
            })->pluck('user_id')->toArray();

        // Note: group_student uses `student_id` column
        $groupStudentIds = DB::table('group_student')
            ->whereIn('group_id', function ($q) use ($user) {
                $q->select('id')->from('groups')->where('teacher_id', $user->id);
            })->pluck('student_id')->toArray();

        $studentIds = array_unique(array_merge($courseStudentIds, $groupStudentIds));
        $studentsCount = count($studentIds);

        // Average rating (if `rating` column exists on courses)
        $avgRating = null;
        if (Schema::hasColumn('courses', 'rating')) {
            $avgRating = Course::where('user_id', $user->id)->avg('rating');
            $avgRating = $avgRating ? round($avgRating, 1) : null;
        }

        // Recent activities: enrollments and group joins and messages
        $activities = [];

        // Recent course enrollments
        $courseEnrolls = DB::table('course_student')
            ->whereIn('course_id', function ($q) use ($user) {
                $q->select('id')->from('courses')->where('user_id', $user->id);
            })->orderBy('created_at', 'desc')->limit(10)->get();

        foreach ($courseEnrolls as $row) {
            $activities[] = [
                'type' => 'course_enroll',
                'user_id' => $row->user_id,
                'course_id' => $row->course_id,
                'created_at' => $row->created_at,
            ];
        }

        // Recent group joins
        $groupJoins = DB::table('group_student')
            ->whereIn('group_id', function ($q) use ($user) {
                $q->select('id')->from('groups')->where('teacher_id', $user->id);
            })->orderBy('created_at', 'desc')->limit(10)->get();

        foreach ($groupJoins as $row) {
            $activities[] = [
                'type' => 'group_join',
                // group_student stores the joining user's id in `student_id`
                'user_id' => $row->student_id ?? null,
                'group_id' => $row->group_id,
                'created_at' => $row->created_at ?? $row->enrolled_at ?? null,
            ];
        }

        // Recent group messages in teacher's groups
        $groupIds = Group::where('teacher_id', $user->id)->pluck('id')->toArray();
        $messages = GroupMessage::with('user')
            ->whereIn('group_id', $groupIds)
            ->latest()
            ->limit(10)
            ->get();

        foreach ($messages as $m) {
            $activities[] = [
                'type' => 'group_message',
                'user_id' => $m->user_id,
                'message' => $m->message,
                'created_at' => $m->created_at,
            ];
        }

        // Normalize activities: attach user and related entity info, sort and limit
        $activities = collect($activities)
            ->sortByDesc('created_at')
            ->take(6)
            ->values()
            ->toArray();

        // Load users for activities
        $userIds = array_values(array_unique(array_filter(array_map(function ($a) {
            return $a['user_id'] ?? null;
        }, $activities))));
        $users = User::whereIn('id', $userIds)->get()->keyBy('id');

        // Enhance activities
        foreach ($activities as &$a) {
            $a['user'] = $users[$a['user_id']] ?? null;
            if ($a['type'] === 'course_enroll' && isset($a['course_id'])) {
                $a['title'] = Course::find($a['course_id'])?->title ?? 'Kurs';
            }
            if ($a['type'] === 'group_join' && isset($a['group_id'])) {
                $a['title'] = Group::find($a['group_id'])?->name ?? 'Guruh';
            }
        }

        return view('teacher.sections.dashboard', compact(
            'coursesCount',
            'studentsCount',
            'activeGroups',
            'avgRating',
            'activities'
        ));
    }

    public function groups()
    {
        $user = Auth::user();
        $groups = Group::withCount('students')
            ->where('teacher_id', $user->id)
            ->latest()
            ->get();

        return view('teacher.sections.groups', compact('groups'));
    }

    public function storeGroup(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'subject' => 'nullable|string|max:255',
            'lesson_time' => 'nullable|string|max:10',
            'lesson_days' => 'nullable|string|max:255',
            'max_students' => 'nullable|integer|min:1',
            'status' => 'nullable|in:active,inactive,full',
        ]);

        $data['teacher_id'] = $user->id;

        Group::create($data);

        return back()->with('success', 'Guruh yaratildi');
    }

    /**
     * Return a group's data (JSON) for AJAX editing/viewing
     */
    public function showGroup($id)
    {
        $user = Auth::user();
        $group = Group::where('id', $id)->where('teacher_id', $user->id)->withCount('students')->firstOrFail();

        return response()->json([
            'group' => $group,
        ]);
    }

    /**
     * Update a group (teacher-owned)
     */
    public function updateGroup(Request $request, $id)
    {
        $user = Auth::user();
        $group = Group::where('id', $id)->where('teacher_id', $user->id)->firstOrFail();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'subject' => 'nullable|string|max:255',
            'lesson_time' => 'nullable|string|max:10',
            'lesson_days' => 'nullable|string|max:255',
            'max_students' => 'nullable|integer|min:1',
            'status' => 'nullable|in:active,inactive,full',
        ]);

        $group->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Guruh yangilandi', 'group' => $group]);
        }

        return back()->with('success', 'Guruh yangilandi');
    }

    /**
     * Delete a group owned by the teacher
     */
    public function destroyGroup($id)
    {
        $user = Auth::user();
        $group = Group::where('id', $id)->where('teacher_id', $user->id)->firstOrFail();

        $group->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['message' => 'Guruh o‘chirildi']);
        }

        return back()->with('success', 'Guruh o‘chirildi');
    }

    public function courses()
    {
        $user = Auth::user();
        $courses = Course::where('user_id', $user->id)->withCount('students')->with('videos')->latest()->get();

        return view('teacher.sections.courses', compact('courses'));
    }

    public function storeCourse(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_hours' => 'nullable|numeric|min:0',
            'is_active' => 'sometimes|boolean',
            'course_type' => 'required|in:regular,theory',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB maks
        ]);

        if ($request->hasFile('img')) {
            try {
                $path = $request->file('img')->store('courses', 's3');

                $data['img'] = $path;
            } catch (\Exception $e) {
                return back()->with('error', 'Rasm yuklashda xatolik: ' . $e->getMessage());
            }
        }

        // Default qiymatlar (DB non-nullable ustunlar uchun)
        $data['description'] = $data['description'] ?? '';
        $data['duration_hours'] = $data['duration_hours'] ?? 0;
        $data['sertificate_template'] = $data['sertificate_template'] ?? '';
        $data['img'] = $data['img'] ?? null; // yoki '' agar DB da null bo‘lmasa
        $data['is_active'] = $data['is_active'] ?? true;
        $data['user_id'] = $user->id;

        Course::create($data);

        return back()->with('success', 'Kurs muvaffaqiyatli yaratildi!');
    }

    /**
     * Show a course owned by the teacher (JSON for AJAX)
     */
    public function showCourse($id)
    {
        $user = Auth::user();
        $course = Course::where('id', $id)->where('user_id', $user->id)->with('videos')->firstOrFail();

        return response()->json(['course' => $course]);
    }

    /**
     * Update a course owned by the teacher
     */
    public function updateCourse(Request $request, $id)
    {
        $user = Auth::user();
        $course = Course::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_hours' => 'nullable|numeric',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('img')) {
            // Delete old
            try {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($course->img);
            } catch (\Throwable $e) {
            }
            $path = $request->file('img')->store('courses', 'public');
            $data['img'] = $path;
        }

        $course->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Kurs yangilandi', 'course' => $course]);
        }

        return back()->with('success', 'Kurs yangilandi');
    }

    /**
     * Delete a course owned by the teacher
     */
    public function destroyCourse($id)
    {
        $user = Auth::user();
        $course = Course::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $course->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['message' => 'Kurs o‘chirildi']);
        }

        return back()->with('success', 'Kurs o‘chirildi');
    }

    /**
     * Upload a video to a course (teacher-owned)
     */
    public function storeVideo(Request $request, $courseId)
    {
        $course = Auth::user()->courses()->findOrFail($courseId);

        // 1️⃣ Validatsiya (PHP limitini tekshirish)
        $maxUploadSize = min(
            $this->parseSize(ini_get('upload_max_filesize')),
            $this->parseSize(ini_get('post_max_size')),
            1024 * 1024 * 1024 // 1 GB
        );

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'video'            => [
                'required',
                'file',
                'mimes:mp4,avi,mov,webm,mpg,mpeg',
                'max:' . ($maxUploadSize / 1024), // KB ga aylantirish
            ],
        ], [
            'video.max' => 'Video hajmi ' . $this->formatBytes($maxUploadSize) . ' dan oshmasligi kerak!'
        ]);

        $file = $request->file('video');

        if (!$file || !$file->isValid()) {
            return back()->with('error', 'Video fayl yuklanmadi yoki buzilgan.');
        }

        // 2️⃣ Manual hajm tekshirish
        if ($file->getSize() > $maxUploadSize) {
            return back()->with('error', 'Video hajmi ' . $this->formatBytes($maxUploadSize) . ' dan oshib ketdi!');
        }

        try {
            // 3️⃣ S3 mavjudligini tekshirish
            if (!config('filesystems.disks.s3')) {
                throw new \Exception('S3 disk sozlanmagan! .env faylini tekshiring.');
            }

            // 4️⃣ Test ulanish
            try {
                Storage::disk('s3')->exists('test'); // Connection test
            } catch (\Exception $e) {
                throw new \Exception('S3 ga ulanib bo\'lmadi: ' . $e->getMessage());
            }

            Log::info('Video yuklash boshlandi', [
                'file_size' => $file->getSize(),
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType()
            ]);

            // 5️⃣ S3 ga yuklash
            $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $file->getClientOriginalName());

            // MUHIM: putFileAs ishlatish (kattaroq fayllar uchun yaxshiroq)
            $path = Storage::disk('s3')->putFileAs('videos', $file, $fileName);

            if (!$path) {
                throw new \Exception('S3 ga yuklash muvaffaqiyatsiz tugadi!');
            }

            // 6️⃣ Yuklangani tekshirish
            if (!Storage::disk('s3')->exists($path)) {
                throw new \Exception('Fayl S3 ga yuklanmadi: ' . $path);
            }

            Log::info('Video S3 ga yuklandi', ['path' => $path]);

            // 7️⃣ Public qilish
            try {
                Storage::disk('s3')->setVisibility($path, 'public');
            } catch (\Exception $e) {
                Log::warning('Visibility xatosi: ' . $e->getMessage());
            }

            // 8️⃣ Bazaga saqlash
            $video = Video::create([
                'course_id'        => $course->id,
                'user_id'          => Auth::id(),
                'title'            => $validated['title'],
                'description'      => $validated['description'] ?? null,
                'video_url'        => $path, // videos/1234567890_filename.mp4
                'duration_seconds' => $validated['duration_minutes'] * 60,
            ]);

            Log::info('Video bazaga saqlandi', ['video_id' => $video->id, 'path' => $path]);

            return back()->with('success', 'Video muvaffaqiyatli yuklandi! (S3: ' . $path . ')');
        } catch (\Throwable $e) {
            Log::error('Video yuklash xatosi', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }

    // Helper funksiyalar
    private function parseSize($size)
    {
        $unit = strtoupper(substr($size, -1));
        $value = (int) substr($size, 0, -1);

        switch ($unit) {
            case 'G':
                return $value * 1024 * 1024 * 1024;
            case 'M':
                return $value * 1024 * 1024;
            case 'K':
                return $value * 1024;
            default:
                return (int) $size;
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
    public function destroyVideo($id)
    {
        $user = Auth::user();
        $video = Video::findOrFail($id);
        $course = $video->course;
        if (!$course || $course->user_id !== $user->id) abort(403);

        try {
            \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('storage/', '', $video->video_url));
        } catch (\Throwable $e) {
        }

        $video->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['message' => 'Video o‘chirildi']);
        }

        return back()->with('success', 'Video o‘chirildi');
    }

    public function students()
    {
        $user = Auth::user();

        // Students are users from course_student and group_student where teacher owns course/group
        $courseIds = Course::where('user_id', $user->id)->pluck('id')->toArray();
        $groupIds = Group::where('teacher_id', $user->id)->pluck('id')->toArray();

        $courseUserIds = DB::table('course_student')->whereIn('course_id', $courseIds)->pluck('user_id')->toArray();
        $groupUserIds = DB::table('group_student')->whereIn('group_id', $groupIds)->pluck('student_id')->toArray();

        $userIds = array_unique(array_merge($courseUserIds, $groupUserIds));
        $students = User::whereIn('id', $userIds)->get();

        return view('teacher.sections.students', compact('students'));
    }

    public function chats()
    {
        $user = Auth::user();
        $groups = Group::withCount('students')
            ->where('teacher_id', $user->id)
            ->with(['messages' => fn($q) => $q->latest()->limit(1)])
            ->get();

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

        return view('teacher.sections.chats', compact('groups', 'selectedGroup', 'messages'));
    }

    public function sendChatMessage(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'message' => 'required|string|max:1000',
        ]);

        $group = Group::findOrFail($request->group_id);
        $user = Auth::user();

        if ($group->teacher_id !== $user->id) {
            return response()->json(['message' => 'Ruxsat yo‘q'], 403);
        }

        $message = GroupMessage::create([
            'group_id' => $request->group_id,
            'user_id' => $user->id,
            'message' => $request->message,
        ]);

        event(new \App\Events\NewGroupMessage($message));

        if ($request->ajax() || $request->wantsJson()) {
            $messages = GroupMessage::with('user')
                ->where('group_id', $group->id)->latest()->limit(100)->get()->reverse();

            $html = view('admin.sections.chat-window', ['selectedGroup' => $group, 'messages' => $messages])->render();

            return response()->json([
                'html' => $html,
                'group_id' => $group->id,
                'last_message' => $message->message,
                'last_time' => $message->created_at->diffForHumans(),
                'messages_count' => GroupMessage::where('group_id', $group->id)->count(),
                'last_message_id' => $message->id,
                'message_html' => view('admin.sections.partials.message', ['msg' => $message])->render(),
                'message_id' => $message->id,
            ]);
        }

        return back();
    }

    public function loadGroupChat($id)
    {
        $user = Auth::user();
        $group = Group::where('id', $id)->where('teacher_id', $user->id)->firstOrFail();

        $messages = GroupMessage::with('user')->where('group_id', $id)->latest()->limit(100)->get()->reverse();
        $html = view('admin.sections.chat-window', ['selectedGroup' => $group, 'messages' => $messages])->render();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => $html,
                'group_id' => $group->id,
                'last_message_id' => optional($messages->last())->id ?? null,
            ]);
        }

        // Render the same partial used by admin but pass it as `selectedGroup` to keep view expectations
        return view('admin.sections.chat-window', ['selectedGroup' => $group, 'messages' => $messages]);
    }

    public function pollGroupMessages($id, Request $request)
    {
        $user = Auth::user();
        $group = Group::where('id', $id)->where('teacher_id', $user->id)->firstOrFail();

        $lastId = (int) $request->query('last_id', 0);
        $messages = GroupMessage::with('user')->where('group_id', $id)
            ->when($lastId > 0, fn($q) => $q->where('id', '>', $lastId))
            ->orderBy('id')->get();

        $html = '';
        foreach ($messages as $msg) {
            $html .= view('admin.sections.partials.message', ['msg' => $msg])->render();
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
    }
    // app/Http/Controllers/TeacherController.php

    public function storeQuiz(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit_minutes' => 'nullable|integer|min:1',
            'passing_score_percentage' => 'required|integer|min:0|max:100',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_answer' => 'required|in:a,b,c,d',
            'questions.*.points' => 'required|integer|min:1',
        ]);

        // Quiz yaratish
        $quiz = Quiz::create([
            'course_id' => $validated['course_id'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'time_limit_minutes' => $validated['time_limit_minutes'] ?? null,
            'passing_score_percentage' => $validated['passing_score_percentage'],
        ]);

        // Savollarni qo'shish
        foreach ($validated['questions'] as $questionData) {
            Question::create([
                'quiz_id' => $quiz->id,
                'question' => $questionData['question'],
                'option_a' => $questionData['option_a'],
                'option_b' => $questionData['option_b'],
                'option_c' => $questionData['option_c'],
                'option_d' => $questionData['option_d'],
                'correct_answer' => $questionData['correct_answer'],
                'points' => $questionData['points'],
            ]);
        }

        return back()->with('success', 'Test muvaffaqiyatli qo\'shildi!');
    }

    public function destroyQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);

        // Faqat o'z quizini o'chirishi mumkin
        if ($quiz->course->teacher_id !== auth()->id()) {
            return back()->with('error', 'Ruxsat yo\'q');
        }

        $quiz->delete(); // Cascade bilan savollar ham o'chadi

        return back()->with('success', 'Test o\'chirildi');
    }


    public function createVideo($courseId)
    {
        $course = Auth::user()->courses()->findOrFail($courseId);
        return view('teacher.videos.create', compact('course'));
    }

    // Quiz yaratish sahifasini ko'rsatish
    public function createQuiz($courseId)
    {
        $course = Auth::user()->courses()->findOrFail($courseId);

        // Faqat theory kurslarga ruxsat berish
        if ($course->course_type !== 'theory') {
            return redirect()->route('teacher.courses')
                ->with('error', 'Bu kurs turi uchun quiz qo\'shib bo\'lmaydi.');
        }

        return view('teacher.quizzes.create', compact('course'));
    }
}

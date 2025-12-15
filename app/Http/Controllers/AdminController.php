<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\Payment;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function admin_panel()
    {
        return view('admin.sections.dashboard'); // admin/
    }

    public function dashboard()
    {

        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'XAtolik yuz berdi');
        }

        $user_count = User::where('role', 'user')->count();

        $active_users = User::where('role', 'user')->where('status', true)->count();

        $active_group = Group::where('status', 'active')->count();

        $price_sum = Payment::where('status', 'completed')->sum('amount');

        $new_users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $currentYear = Carbon::now()->year;

        $monthlyPayments = Payment::where('status', 'completed')
            ->whereYear('created_at', $currentYear)
            ->selectRaw('EXTRACT(MONTH FROM created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');


        return view('admin.sections.dashboard', compact(
            'user_count',
            'active_users',
            'active_group',
            'price_sum',
            'new_users',
            'monthlyPayments'
        ));
    }

    public function users()
    {
        $user = Auth::user();


        if (!$user) {
            return redirect('/')->with('error', 'XAtolik yuz berdi');
        }

        $users = User::select(
            'id',
            'name',
            'email',
            'role',
            'phone',
            'created_at',
            'status',
        )
            ->where('role', 'user')
            ->get();


        return view('admin.sections.users', compact('users'));
    }

    public function teachers()
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) {
            return redirect('/')->with('error', 'Ruxsat yo‘q');
        }

        $teachers = User::query()
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.phone',
                'users.status',
            ])
            // Guruhlar soni (0 bo‘lsa ham chiqadi)
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(groups.id)')
                    ->from('groups')
                    ->whereColumn('groups.teacher_id', 'users.id');
            }, 'group_count')
            // Fan ma’lumoti — hozircha subject_id yo‘q, shuning uchun subquery orqali olamiz
            ->selectSub(function ($query) {
                $query->select('subjects.name')
                    ->from('subjects')
                    ->whereColumn('subjects.teacher_id', 'users.id')
                    ->limit(1);
            }, 'subject_name')
            ->where('users.role', 'teacher')
            ->get();

        $subjects = Subject::all(); // yangi o‘qituvchi qo‘shish uchun

        return view('admin.sections.teachers', compact('teachers', 'subjects'));
    }
    public function groups()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Ruxsat yo‘q');
        }

        $groups = Group::with('teacher')->latest()->get();

        foreach ($groups as $group) {
            // Keep `current_students` attribute in sync for the view
            $group->current_students = DB::table('group_student')
                ->where('group_id', $group->id)
                ->count();
        }

        $teachers = User::query()
            ->select(['users.id', 'users.name'])
            ->selectSub(function ($query) {
                $query->select('subjects.name')
                    ->from('subjects')
                    ->whereColumn('subjects.teacher_id', 'users.id')
                    ->limit(1);
            }, 'subject_name')
            ->where('role', 'teacher')
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.sections.groups', compact('groups', 'teachers'));
    }


    public function statistics()
    {
        return view('admin.sections.statistics');
    }

    public function payments()
    {
        return view('admin.sections.payments');
    }

    public function settings()
    {
        return view('admin.sections.settings');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.sections.user-show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.sections.user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'phone', 'role']));
        return back()->with('success', 'Malumotlar yangilandi');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Foydalanuvchi o\'chirildi');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();
        return back()->with('success', 'Status o\'zgartirildi');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate(['password' => 'required|min:6']);
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return back()->with('success', 'Parol yangilandi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role ?? 'user',
            'password' => bcrypt($request->password),
            'status' => 1,
        ]);

        return back()->with('success', 'Yangi foydalanuvchi qo\'shildi');
    }
    public function teacher_destroy($id)
    {
        Teacher::findOrFail($id)->delete();
        return back()->with('success', 'O\'qituvchi o\'chirildi');
    }

    public function teacher_store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:20',
            'subject_id' => 'nullable|exists:subjects,id',
            'password' => 'required|min:6|confirmed',
            'status'   => 'required|in:active,inactive',
            
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'subject_id' => $request->subject_id,
            'role'       => 'teacher',
            'password'   => Hash::make($request->password),
            'is_teacher' => true,
        ]);

        return redirect()->route('admin.teachers')
            ->with('success', 'Yangi o‘qituvchi muvaffaqiyatli qo‘shildi!');
    }

    public function chats()
    {
        $groups = Group::with('teacher')
            ->withCount('messages as messages_count')
            // eager-load only the latest message per group
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

        return view('admin.sections.chats', compact('groups', 'selectedGroup', 'messages'));
    }

    public function sendChatMessage(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'message'  => 'required|string|max:1000'
        ]);

        $message = GroupMessage::create([
            'group_id' => $request->group_id,
            'user_id'  => auth()->id(),
            'message'  => $request->message,
        ]);

        // Broadcast the new message to websocket listeners
        event(new \App\Events\NewGroupMessage($message));

        if ($request->ajax() || $request->wantsJson()) {
            $selectedGroup = Group::with('teacher')->findOrFail($request->group_id);

            $messages = GroupMessage::with('user')
                ->where('group_id', $selectedGroup->id)
                ->latest()
                ->limit(100)
                ->get()
                ->reverse();

            $html = view('admin.sections.chat-window', compact('selectedGroup', 'messages'))->render();

            return response()->json([
                'html' => $html,
                'group_id' => $selectedGroup->id,
                'last_message' => $message->message,
                'last_time' => $message->created_at->diffForHumans(),
                'messages_count' => GroupMessage::where('group_id', $selectedGroup->id)->count(),
                'last_message_id' => $message->id,
                'message_html' => view('admin.sections.partials.message', ['msg' => $message])->render(),
                'message_id' => $message->id,
            ]);
        }

        return back();
    }

    public function loadGroupChat($id)
    {
        try {
            $selectedGroup = Group::with('teacher')->findOrFail($id);

            $messages = GroupMessage::with('user')
                ->where('group_id', $id)
                ->latest()
                ->limit(100)
                ->get()
                ->reverse();

            $html = view('admin.sections.chat-window', compact('selectedGroup', 'messages'))->render();

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

            return view('admin.sections.chat-window', compact('selectedGroup', 'messages'));
        } catch (\Throwable $e) {
            Log::error('loadGroupChat error', ['id' => $id, 'error' => $e->getMessage()]);
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json(['message' => 'Guruhni yuklashda server xatosi yuz berdi. Iltimos, sahifani yangilang.'], 500);
            }
            throw $e;
        }
    }
    public function pollGroupMessages($id, Request $request)
    {
        try {
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
                $html .= view('admin.sections.partials.message', compact('msg'))->render();
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
            Log::error('pollGroupMessages error', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Polling xatosi'], 500);
        }
    }
    public function storeGroup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|unique:groups,code',
            'teacher_id' => 'required|exists:users,id',
            'subject' => 'nullable|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'lesson_days' => 'nullable|string',
            'lesson_time' => 'nullable|date_format:H:i',
            'max_students' => 'required|integer|min:1',
            'monthly_fee' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1',
            'start_date' => 'nullable|date',
            'room' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Group::create($validated);

        return redirect()->route('admin.groups')->with('success', 'Yangi guruh muvaffaqiyatli qoʻshildi!');
    }
}

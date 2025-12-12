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

        // Faqat teacher bilan birga yuklaymiz
        $groups = Group::with('teacher')->get();

        // Har bir guruhga o‘quvchilar sonini qo‘lda qo‘shib chiqamiz (xato bermaydi!)
        foreach ($groups as $group) {
            $group->students_count = DB::table('group_student')
                ->where('group_id', $group->id)
                ->count();
        }

        return view('admin.sections.groups', compact('groups'));
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
        ]);

        return redirect()->route('admin.sections.teachers')
            ->with('success', 'Yangi o‘qituvchi muvaffaqiyatli qo‘shildi!');
    }

    public function chats()
    {
        $groups = Group::with('teacher')
            ->withCount('messages as messages_count')
            ->with(['messages' => fn($q) => $q->latest()->first()])
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

        GroupMessage::create([
            'group_id' => $request->group_id,
            'user_id'  => auth()->id(),
            'message'  => $request->message,
        ]);

        return back();
    }

    public function loadGroupChat($id)
    {
        $group = Group::with('teacher')->findOrFail($id);

        $messages = GroupMessage::with('user')
            ->where('group_id', $id)
            ->latest()
            ->limit(100)
            ->get()
            ->reverse();

        return view('admin.sections.chat-window', compact('group', 'messages'));
    }
}

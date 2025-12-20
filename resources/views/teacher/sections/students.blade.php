@extends('teacher.layout')

@section('title', 'O\'quvchilar')
@section('page-title', 'Mening O\'quvchilarim')

@section('content')

<!-- Filtrlar va statistika -->
<div class="stats-grid" style="margin-bottom: 20px;">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $students->count() }}</h3>
            <p>Jami O'quvchilar</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $students->where('status', 1)->count() }}</h3> <!-- Agar status fieldi bo'lsa -->
            <p>Faol O'quvchilar</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-user-clock"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $students->where('status', 0)->count() }}</h3>
            <p>NoFaol</p>
        </div>
    </div>
</div>

<!-- Guruh filtr va qidiruv -->
<div class="card">
    <div class="card-header">
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <h4 style="margin: 0;">O'quvchilar Ro'yxati</h4>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <div style="overflow-x: auto;">
            <table class="table" style="margin: 0; min-width: 1000px;">
                <thead style="background: #f8fafc;">
                    <tr>
                        <th style="padding: 18px 20px; text-align: left;">#</th>
                        <th style="padding: 18px 20px; text-align: left;">O'QUVCHI</th>
                        <th style="padding: 18px 20px; text-align: left;">GURUH</th>
                        <th style="padding: 18px 20px; text-align: left;">TELEFON</th>
                        <th style="padding: 18px 20px; text-align: left;">O'RTACHA BAHO</th>
                        <th style="padding: 18px 20px; text-align: left;">DAVOMAT</th>
                        <th style="padding: 18px 20px; text-align: left;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $i => $s)
                    <tr style="background: white; transition: all 0.3s;">
                        <td style="padding: 20px;">{{ $loop->iteration }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($s->name) }}&background=random"
                                    class="user-avatar"
                                    style="width: 45px; height: 45px; border-radius: 50%;">
                                <div>
                                    <div style="font-weight: 700; color: var(--dark);">{{ $s->name }}</div>
                                    <div style="font-size: 13px; color: #64748b;">ID: {{ $s->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                            // O'qituvchiga tegishli guruhlar orasidan ushbu o'quvchi qatnashgan birinchi guruhni topamiz
                            $teacherGroup = \App\Models\Group::where('teacher_id', auth()->id())
                            ->whereHas('students', function($query) use ($s) {
                            $query->where('student_id', $s->id);
                            })
                            ->first();
                            @endphp
                            {{ $teacherGroup ? $teacherGroup->name : '-' }}
                        </td>
                        <td>{{ $s->phone ?? '-' }}</td>
                        <td><strong style="color: #10b981;">-</strong></td>
                        <td><strong style="color: #10b981;">-</strong></td>
                        <td>
                            @if($s->status ?? false)
                            <span style="background: #dcfce7; color: #059669; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 700;">Faol</span>
                            @else
                            <span style="background: #fee2e2; color: #dc2626; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 700;">NoFaol</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                            Hozircha o'quvchilaringiz mavjud emas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    tbody tr:hover {
        background: #f8fafc !important;
        transform: scale(1.01);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .btn-sm {
        border: none;
        border-radius: 10px;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn-sm:hover {
        transform: translateY(-3px);
    }

    .btn-info {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        color: white;
    }
</style>
@endsection
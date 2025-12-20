@extends('teacher.layout')

@section('title', 'Dashboard')
@section('page-title', 'Bosh Sahifa')

@section('content')
<!-- Statistika kartalari -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $coursesCount ?? 0 }}</h3>
            <p>Mening Kurslarim</p>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i> {{ $coursesCount > 0 ? '+ yangi' : '' }}
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $studentsCount ?? 0 }}</h3>
            <p>Jami O'quvchilar</p>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i> {{ $studentsCount > 0 ? '+ bu oy' : '' }}
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $activeGroups ?? 0 }}</h3>
            <p>Faol Guruhlar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-star"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $avgRating ?? '-' }}</h3>
            <p>O'rtacha Baho</p>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i> {{ $avgRating ? '+0.0' : '' }}
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin: 0 -15px;">
    <!-- So'nggi faoliyat -->
    <div class="col-lg-8" style="padding: 0 15px;">
        <div class="card">
            <div class="card-header">
                <h4>So'nggi Faollik</h4>
            </div>
            <div class="card-body">
                @forelse($activities as $act)
                    @php
                        $u = $act['user'] ?? null;
                        $time = isset($act['created_at']) ? \Carbon\Carbon::parse($act['created_at'])->diffForHumans() : '';
                        $avatar = $u ? urlencode($u->name) : 'Foydalanuvchi';
                    @endphp
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px; padding: 18px; background: #f8fafc; border-radius: 14px; border-left: 4px solid #d1d5db;">
                        <img src="https://ui-avatars.com/api/?name={{ $u?->name ?? 'Foydalanuvchi' }}&background=random" style="width: 48px; height: 48px; border-radius: 50%;">
                        <div style="flex: 1;">
                            @if($act['type'] === 'course_enroll')
                                <strong>{{ $u?->name ?? 'Foydalanuvchi' }}</strong> "{{ $act['title'] ?? 'Kurs' }}" kursiga qo'shildi
                            @elseif($act['type'] === 'group_join')
                                <strong>{{ $u?->name ?? 'Foydalanuvchi' }}</strong> "{{ $act['title'] ?? 'Guruh' }}" guruhiga qo'shildi
                            @elseif($act['type'] === 'group_message')
                                <strong>{{ $u?->name ?? 'Foydalanuvchi' }}</strong> guruhga yangi xabar yubordi: "{{ Str::limit($act['message'] ?? '', 80) }}"
                            @else
                                <strong>{{ $u?->name ?? 'Foydalanuvchi' }}</strong> faoliyat bildirildi
                            @endif
                            <div style="color: #64748b; font-size: 13px; margin-top: 4px;">{{ $time }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-muted">Hozircha faollik yo'q</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Tez kirish -->
    <div class="col-lg-4" style="padding: 0 15px;">
        <div class="card">
            <div class="card-header">
                <h4>Tez Kirish</h4>
            </div>
            <div class="card-body" style="padding: 20px;">
                <a href="{{ route('teacher.courses') }}" style="display: block; padding: 20px; background: linear-gradient(135deg, #ecfdf5, #dcfce7); border-radius: 16px; margin-bottom: 15px; text-decoration: none; color: var(--dark); transition: all 0.3s;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h5 style="margin: 0; font-weight: 800;">Mening Kurslarim</h5>
                            <p style="margin: 5px 0 0; color: #64748b;">3 ta faol kurs</p>
                        </div>
                        <i class="fas fa-book-open" style="font-size: 32px; color: var(--primary);"></i>
                    </div>
                </a>

                <a href="{{ route('teacher.grades') }}" style="display: block; padding: 20px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 16px; margin-bottom: 15 demolition: 15px; text-decoration: none; color: var(--dark); transition: all 0.3s;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h5 style="margin: 0; font-weight: 800;">Baholar Jadvali</h5>
                            <p style="margin: 5px 0 0; color: #64748b;">Yangilash kerak</p>
                        </div>
                        <i class="fas fa-table" style="font-size: 32px; color: #f59e0b;"></i>
                    </div>
                </a>

                <a href="{{ route('teacher.chats') }}" style="display: block; padding: 20px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); border-radius: 16px; text-decoration: none; color: var(--dark); transition: all 0.3s;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h5 style="margin: 0; font-weight: 800;">Chatlar</h5>
                            <p style="margin: 5px 0 0; color: #64748b;">5 ta yangi xabar</p>
                        </div>
                        <i class="fas fa-comments" style="font-size: 32px; color: #3b82f6;"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
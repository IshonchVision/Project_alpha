@extends('student.layout')

@section('title', 'Dashboard')
@section('page-title', 'Bosh Sahifa')

@section('content')
<!-- Statistika kartalari -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="stat-info">
            <h3>3</h3>
            <p>Faol Kurslar</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-video"></i>
        </div>
        <div class="stat-info">
            <h3>42</h3>
            <p>Ko'rilgan Darslar</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-info">
            <h3>68 soat</h3>
            <p>O'qish Vaqti</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-trophy"></i>
        </div>
        <div class="stat-info">
            <h3>2</h3>
            <p>Yakunlangan Kurslar</p>
        </div>
    </div>
</div>

<!-- Mening kurslarim -->
<div class="card">
    <div class="card-header">
        <h4>Mening Kurslarim</h4>
        <a href="{{ route('student.courses') }}" class="btn-primary" style="padding: 10px 20px; font-size: 14px;">Barchasini Ko'rish</a>
    </div>
    <div class="card-body">
        <!-- Kurs 1 -->
        <div class="course-item">
            <div class="course-thumbnail">
                <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=400" alt="Course">
                <div class="course-duration"><i class="fas fa-clock"></i> 24 soat</div>
            </div>
            <div style="flex: 1;">
                <h5 style="font-size: 22px; font-weight: 800; margin: 0 0 10px;">Advanced English Grammar</h5>
                <p style="color: #64748b; margin: 0 0 15px;">O'qituvchi: Gulnoza Ahmedova</p>
                <div style="display: flex; gap: 20px;">
                    <span><i class="fas fa-play-circle" style="color: var(--primary);"></i> 18/24 dars</span>
                    <span><i class="fas fa-chart-line" style="color: #10b981;"></i> 75% tugallangan</span>
                </div>
                <div style="margin-top: 15px;">
                    <div style="background: #e2e8f0; border-radius: 10px; height: 10px; overflow: hidden;">
                        <div style="width: 75%; height: 100%; background: linear-gradient(135deg, #3b82f6, #2563eb);"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Boshqa kurslar qo'shishingiz mumkin -->
    </div>
</div>
@endsection
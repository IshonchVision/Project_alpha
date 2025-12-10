@extends('student.layout')

@section('title', 'Kurs Detallari')
@section('page-title', 'Advanced English Grammar')

@section('content')
<div class="top-bar">
    <h1 class="page-title">@yield('page-title')</h1>
    <div class="search-box">
        <input type="text" class="search-input" placeholder="Dars qidirish...">
    </div>
    <div class="user-info">
        <img src="https://ui-avatars.com/api/?name=Malika+Karimova&background=3b82f6&color=fff" alt="Student" class="avatar">
        <div>
            <h5 style="margin: 0; font-weight: 800; font-size: 16px;">Malika Karimova</h5>
            <p style="margin: 0; color: #64748b; font-size: 14px;">Talaba</p>
        </div>
    </div>
</div>

<!-- Kurs haqida -->
<div class="card">
    <div class="card-header">
        <div>
            <h4>Advanced English Grammar</h4>
            <p style="margin: 5px 0 0; color: #64748b;">O'qituvchi: Gulnoza Ahmedova</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <span style="background: #dbeafe; color: #1e40af; padding: 6px 14px; border-radius: 10px; font-weight: 700;"><i class="fas fa-star"></i> 4.8</span>
            <span style="background: #dcfce7; color: #059669; padding: 6px 14px; border-radius: 10px; font-weight: 700;"><i class="fas fa-users"></i> 45 talaba</span>
            <span style="background: #fef3c7; color: #d97706; padding: 6px 14px; border-radius: 10px; font-weight: 700;"><i class="fas fa-clock"></i> 24 soat</span>
        </div>
    </div>
    <div class="card-body">
        <p style="line-height: 1.6; color: #475569;">To'liq ingliz tili grammatikasi kursi. Present, Past, Future tenses, conditionals va boshqa mavzular.</p>
        <div style="margin-top: 20px;">
            <div style="background: #e2e8f0; border-radius: 10px; height: 12px;">
                <div style="width: 75%; height: 100%; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 10px;"></div>
            </div>
            <p style="margin-top: 8px; color: #64748b;">75% tugallangan (18/24 dars)</p>
        </div>
    </div>
</div>

<!-- Darslar -->
<div class="card">
    <div class="card-header">
        <h4>Darslar (24 ta)</h4>
    </div>
    <div class="card-body">
        <!-- Dars misoli -->
        <div style="display: flex; gap: 25px; padding: 25px; background: #f8fafc; border-radius: 18px; margin-bottom: 20px; border-left: 5px solid var(--primary);">
            <div style="position: relative; width: 280px; height: 160px; border-radius: 14px; overflow: hidden; flex-shrink: 0;">
                <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=400" alt="Lesson" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 48px; color: white;"><i class="fas fa-play-circle"></i></div>
                <div style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.8); color: white; padding: 6px 12px; border-radius: 8px;"><i class="fas fa-clock"></i> 45 daqiqa</div>
            </div>
            <div style="flex: 1;">
                <h5 style="font-size: 20px; font-weight: 800; margin: 0 0 10px;">Lesson 1: Present Simple Tense</h5>
                <p style="color: #64748b; margin: 0 0 15px;">Present Simple tense qoidasi, misollar va mashqlar.</p>
                <div style="display: flex; gap: 15px; align-items: center;">
                    <button class="btn-primary" style="padding: 10px 20px;"><i class="fas fa-play"></i> Ko'rish</button>
                    <span style="color: #10b981;"><i class="fas fa-check-circle"></i> Yakunlangan</span>
                    <span style="color: #64748b;"><i class="fas fa-eye"></i> 234 marta ko'rilgan</span>
                </div>
            </div>
        </div>

        <!-- Yana darslar qo'shishingiz mumkin -->
        <div style="text-align: center; padding: 20px;">
            <button class="btn-primary">Yana ko'proq yuklash</button>
        </div>
    </div>
</div>

<!-- Izohlar bo'limi (ixtiyoriy) -->
<div class="card">
    <div class="card-header">
        <h4>Izohlar va Savollar</h4>
    </div>
    <div class="card-body">
        <div style="display: flex; gap: 15px; margin-bottom: 20px;">
            <img src="https://ui-avatars.com/api/?name=Aziz&background=random" style="width: 40px; height: 40px; border-radius: 50%;">
            <div style="flex: 1;">
                <strong>Aziz Toshmatov</strong> <small style="color: #64748b;">2 soat oldin</small>
                <p style="margin: 8px 0 0;">Juda yaxshi tushuntirdingiz!</p>
            </div>
        </div>
        <textarea class="form-control" rows="3" placeholder="Izoh qoldiring..."></textarea>
        <button class="btn-primary" style="margin-top: 10px; padding: 10px 20px;">Yuborish</button>
    </div>
</div>
@endsection
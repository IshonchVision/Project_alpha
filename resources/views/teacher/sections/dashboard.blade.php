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
            <h3>3</h3>
            <p>Mening Kurslarim</p>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i> +1 yangi
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>140</h3>
            <p>Jami O'quvchilar</p>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i> +12 bu oy
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="stat-info">
            <h3>8</h3>
            <p>Faol Guruhlar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-star"></i>
        </div>
        <div class="stat-info">
            <h3>4.8</h3>
            <p>O'rtacha Baho</p>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i> +0.2
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
                <select class="form-select" style="width: 180px;">
                    <option>Bugun</option>
                    <option>Oxirgi 7 kun</option>
                    <option>Oxirgi 30 kun</option>
                </select>
            </div>
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px; padding: 18px; background: #f8fafc; border-radius: 14px; border-left: 4px solid var(--primary);">
                    <img src="https://ui-avatars.com/api/?name=Malika+Karimova&background=random" style="width: 48px; height: 48px; border-radius: 50%;">
                    <div style="flex: 1;">
                        <strong>Malika Karimova</strong> "Advanced English Grammar" kursidagi Lesson 1 ni tugatdi
                        <div style="color: #64748b; font-size: 13px; margin-top: 4px;">15 daqiqa oldin</div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px; padding: 18px; background: #f8fafc; border-radius: 14px; border-left: 4px solid #3b82f6;">
                    <img src="https://ui-avatars.com/api/?name=Aziz+Toshmatov&background=random" style="width: 48px; height: 48px; border-radius: 50%;">
                    <div style="flex: 1;">
                        <strong>Aziz Toshmatov</strong> yangi izoh qoldirdi: "Juda yaxshi tushuntirdingiz!"
                        <div style="color: #64748b; font-size: 13px; margin-top: 4px;">42 daqiqa oldin</div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px; padding: 18px; background: #f8fafc; border-radius: 14px; border-left: 4px solid #f59e0b;">
                    <img src="https://ui-avatars.com/api/?name=Sardor+Rahimov&background=random" style="width: 48px; height: 48px; border-radius: 50%;">
                    <div style="flex: 1;">
                        <strong>Sardor Rahimov</strong> "IELTS Speaking Preparation" kursiga qo'shildi
                        <div style="color: #64748b; font-size: 13px; margin-top: 4px;">1 soat oldin</div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 15px; padding: 18px; background: #f8fafc; border-radius: 14px; border-left: 4px solid var(--success);">
                    <img src="https://ui-avatars.com/api/?name=Nigora+Aliyeva&background=random" style="width: 48px; height: 48px; border-radius: 50%;">
                    <div style="flex: 1;">
                        <strong>Nigora Aliyeva</strong> barcha darslarni 100% yakunladi!
                        <div style="color: #64748b; font-size: 13px; margin-top: 4px;">2 soat oldin</div>
                    </div>
                </div>
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
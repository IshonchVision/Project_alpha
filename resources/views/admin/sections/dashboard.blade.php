@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>2,543</h3>
            <p>Jami Foydalanuvchilar</p>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i> +12.5% bu oy
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <div class="stat-info">
            <h3>47</h3>
            <p>Faol O'qituvchilar</p>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i> +5 yangi
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="stat-info">
            <h3>156</h3>
            <p>Faol Guruhlar</p>
            <div class="stat-trend up">
                <i class="fas fa-arrow-up"></i> +8.3%
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="stat-info">
            <h3>$45,678</h3>
            <p>Bu Oylik Daromad</p>
            <div class="stat-trend down">
                <i class="fas fa-arrow-down"></i> -3.2%
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin: 0 -15px;">
    <div class="col-lg-8" style="padding: 0 15px;">
        <div class="card">
            <div class="card-header">
                <h4>Oylik Statistika</h4>
                <select class="form-select" style="width: 150px;">
                    <option>2024</option>
                    <option>2023</option>
                </select>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    📊 Chart.js yoki boshqa kutubxona bu yerda bo'ladi
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4" style="padding: 0 15px;">
        <div class="card">
            <div class="card-header">
                <h4>Yangi Ro'yxatlar</h4>
            </div>
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 15px; background: #f8fafc; border-radius: 12px;">
                    <img src="https://ui-avatars.com/api/?name=Ali+Valiyev&background=random" style="width: 50px; height: 50px; border-radius: 50%;">
                    <div>
                        <h6 style="margin: 0; font-weight: 700;">Ali Valiyev</h6>
                        <small style="color: #64748b;">5 daqiqa oldin</small>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 15px; background: #f8fafc; border-radius: 12px;">
                    <img src="https://ui-avatars.com/api/?name=Malika+Karimova&background=random" style="width: 50px; height: 50px; border-radius: 50%;">
                    <div>
                        <h6 style="margin: 0; font-weight: 700;">Malika Karimova</h6>
                        <small style="color: #64748b;">12 daqiqa oldin</small>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 15px; background: #f8fafc; border-radius: 12px;">
                    <img src="https://ui-avatars.com/api/?name=Sardor+Rahimov&background=random" style="width: 50px; height: 50px; border-radius: 50%;">
                    <div>
                        <h6 style="margin: 0; font-weight: 700;">Sardor Rahimov</h6>
                        <small style="color: #64748b;">1 soat oldin</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
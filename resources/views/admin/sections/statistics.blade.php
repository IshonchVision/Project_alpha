@extends('admin.layout')

@section('title', 'Statistika')
@section('page-title', 'Statistika')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Umumiy Statistika</h4>
        <select class="form-select" style="width: 150px;">
            <option>2024</option>
            <option>2023</option>
            <option>2022</option>
        </select>
    </div>
    <div class="card-body">
        <div class="chart-container">
            📈 Bu yerda katta diagrammalar (masalan, Chart.js bilan) bo'ladi
        </div>
        <div class="stats-grid" style="margin-top: 30px;">
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3>87%</h3>
                    <p>O'rtacha Davomat</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> +3.5%
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-info">
                    <h3>92%</h3>
                    <p>Bitiruvchilar</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> +5.2%
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="stat-info">
                    <h3>450+</h3>
                    <p>Jami Darslar</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> +25
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3>12,500</h3>
                    <p>O'qish Soatlari</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> +450
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin: 0 -15px;">
    <div class="col-lg-6" style="padding: 0 15px;">
        <div class="card">
            <div class="card-header">
                <h4>Oylik Faollik</h4>
            </div>
            <div class="card-body">
                <div class="chart-container" style="height: 250px;">
                    📊 Oylik faollik grafigi
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="padding: 0 15px;">
        <div class="card">
            <div class="card-header">
                <h4>Eng Mashhur Fanlar</h4>
            </div>
            <div class="card-body">
                <div style="padding: 15px 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px;">
                                <i class="fas fa-language"></i>
                            </div>
                            <div>
                                <h6 style="margin: 0; font-weight: 700;">Ingliz tili</h6>
                                <small style="color: #64748b;">456 o'quvchi</small>
                            </div>
                        </div>
                        <span class="badge bg-primary" style="padding: 8px 16px;">34%</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px;">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <div>
                                <h6 style="margin: 0; font-weight: 700;">Matematika</h6>
                                <small style="color: #64748b;">342 o'quvchi</small>
                            </div>
                        </div>
                        <span class="badge bg-success" style="padding: 8px 16px;">25%</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px;">
                                <i class="fas fa-code"></i>
                            </div>
                            <div>
                                <h6 style="margin: 0; font-weight: 700;">Dasturlash</h6>
                                <small style="color: #64748b;">287 o'quvchi</small>
                            </div>
                        </div>
                        <span class="badge bg-purple" style="padding: 8px 16px; background: #8b5cf6;">21%</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px;">
                                <i class="fas fa-atom"></i>
                            </div>
                            <div>
                                <h6 style="margin: 0; font-weight: 700;">Fizika</h6>
                                <small style="color: #64748b;">178 o'quvchi</small>
                            </div>
                        </div>
                        <span class="badge bg-warning" style="padding: 8px 16px;">13%</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #06b6d4, #0891b2); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px;">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div>
                                <h6 style="margin: 0; font-weight: 700;">Kimyo</h6>
                                <small style="color: #64748b;">92 o'quvchi</small>
                            </div>
                        </div>
                        <span class="badge bg-info" style="padding: 8px 16px;">7%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
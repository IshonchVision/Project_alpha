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
            <h3>140</h3>
            <p>Jami O'quvchilar</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="stat-info">
            <h3>128</h3>
            <p>Faol O'quvchilar</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-user-clock"></i>
        </div>
        <div class="stat-info">
            <h3>12</h3>
            <p>NoFaol</p>
        </div>
    </div>
</div>

<!-- Guruh filtr va qidiruv -->
<div class="card">
    <div class="card-header">
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <h4 style="margin: 0;">O'quvchilar Ro'yxati</h4>
            <select class="form-select" style="width: 250px;">
                <option>Barcha guruhlar</option>
                <option>Advanced English Grammar</option>
                <option>IELTS Speaking Preparation</option>
                <option>English for Beginners</option>
            </select>
            <select class="form-select" style="width: 180px;">
                <option>Barcha statuslar</option>
                <option>Faol</option>
                <option>NoFaol</option>
            </select>
        </div>
        <button class="btn-primary">
            <i class="fas fa-file-export"></i> Excel Export
        </button>
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
                        <th style="padding: 18px 20px; text-align: left;">AMALLAR</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- O'quvchi 1 -->
                    <tr style="background: white; transition: all 0.3s;">
                        <td style="padding: 20px;">1</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <img src="https://ui-avatars.com/api/?name=Malika+Karimova&background=random" class="user-avatar" style="width: 45px; height: 45px; border-radius: 50%;">
                                <div>
                                    <div style="font-weight: 700; color: var(--dark);">Malika Karimova</div>
                                    <div style="font-size: 13px; color: #64748b;">ID: 1001</div>
                                </div>
                            </div>
                        </td>
                        <td>Advanced English Grammar</td>
                        <td>+998 99 123 45 67</td>
                        <td><strong style="color: #10b981;">4.8</strong></td>
                        <td><strong style="color: #10b981;">92%</strong></td>
                        <td><span style="background: #dcfce7; color: #059669; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 700;">Faol</span></td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn-sm btn-info" style="padding: 8px 14px; font-size: 13px;"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm" style="padding: 8px 14px; font-size: 13px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white;"><i class="fas fa-comment"></i></button>
                                <button class="btn-sm btn-danger" style="padding: 8px 14px; font-size: 13px;"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>

                    <!-- O'quvchi 2 -->
                    <tr style="background: white; transition: all 0.3s;">
                        <td style="padding: 20px;">2</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <img src="https://ui-avatars.com/api/?name=Aziz+Toshmatov&background=random" class="user-avatar" style="width: 45px; height: 45px; border-radius: 50%;">
                                <div>
                                    <div style="font-weight: 700; color: var(--dark);">Aziz Toshmatov</div>
                                    <div style="font-size: 13px; color: #64748b;">ID: 1002</div>
                                </div>
                            </div>
                        </td>
                        <td>IELTS Speaking Preparation</td>
                        <td>+998 90 987 65 43</td>
                        <td><strong style="color: #3b82f6;">4.2</strong></td>
                        <td><strong style="color: #3b82f6;">88%</strong></td>
                        <td><span style="background: #dcfce7; color: #059669; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 700;">Faol</span></td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn-sm btn-info" style="padding: 8px 14px; font-size: 13px;"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm" style="padding: 8px 14px; font-size: 13px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white;"><i class="fas fa-comment"></i></button>
                                <button class="btn-sm btn-danger" style="padding: 8px 14px; font-size: 13px;"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Qo'shimcha o'quvchilar (namuna uchun 3-4 ta yetarli) -->
                    <tr style="background: white; transition: all 0.3s;">
                        <td style="padding: 20px;">3</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <img src="https://ui-avatars.com/api/?name=Sardor+Rahimov&background=random" class="user-avatar" style="width: 45px; height: 45px; border-radius: 50%;">
                                <div>
                                    <div style="font-weight: 700; color: var(--dark);">Sardor Rahimov</div>
                                    <div style="font-size: 13px; color: #64748b;">ID: 1003</div>
                                </div>
                            </div>
                        </td>
                        <td>English for Beginners</td>
                        <td>+998 91 555 44 33</td>
                        <td><strong style="color: #10b981;">5.0</strong></td>
                        <td><strong style="color: #10b981;">100%</strong></td>
                        <td><span style="background: #dcfce7; color: #059669; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 700;">Faol</span></td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn-sm btn-info" style="padding: 8px 14px; font-size: 13px;"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm" style="padding: 8px 14px; font-size: 13px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white;"><i class="fas fa-comment"></i></button>
                                <button class="btn-sm btn-danger" style="padding: 8px 14px; font-size: 13px;"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>

                    <tr style="background: white; transition: all 0.3s;">
                        <td style="padding: 20px;">4</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <img src="https://ui-avatars.com/api/?name=Nigora+Aliyeva&background=random" class="user-avatar" style="width: 45px; height: 45px; border-radius: 50%;">
                                <div>
                                    <div style="font-weight: 700; color: var(--dark);">Nigora Aliyeva</div>
                                    <div style="font-size: 13px; color: #64748b;">ID: 1004</div>
                                </div>
                            </div>
                        </td>
                        <td>Advanced English Grammar</td>
                        <td>+998 93 222 11 00</td>
                        <td><strong style="color: #f59e0b;">3.6</strong></td>
                        <td><strong style="color: #f59e0b;">78%</strong></td>
                        <td><span style="background: #fee2e2; color: #dc2626; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 700;">NoFaol</span></td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn-sm btn-info" style="padding: 8px 14px; font-size: 13px;"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm" style="padding: 8px 14px; font-size: 13px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white;"><i class="fas fa-comment"></i></button>
                                <button class="btn-sm btn-danger" style="padding: 8px 14px; font-size: 13px;"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    tbody tr:hover {
        background: #f8fafc !important;
        transform: scale(1.01);
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }
    .btn-sm {
        border: none;
        border-radius: 10px;
        transition: all 0.3s;
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
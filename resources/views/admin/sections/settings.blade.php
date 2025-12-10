@extends('admin.layout')

@section('title', 'Sozlamalar')
@section('page-title', 'Sozlamalar')

@section('content')
<div class="row" style="margin: 0 -15px;">
    <div class="col-lg-4" style="padding: 0 15px;">
        <div class="card">
            <div class="card-body">
                <div style="text-align: center; padding: 20px 0;">
                    <img src="https://ui-avatars.com/api/?name=Super+Admin&background=3b82f6&color=fff&size=150" style="width: 150px; height: 150px; border-radius: 50%; border: 5px solid var(--primary); margin-bottom: 20px;">
                    <h4 style="margin: 10px 0 5px 0; font-weight: 800;">Super Admin</h4>
                    <p style="color: #64748b; margin: 0;">admin@eduplatform.uz</p>
                    <button class="btn-primary" style="margin-top: 20px; width: 100%;">
                        <i class="fas fa-camera"></i> Rasmni O'zgartirish
                    </button>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h4>Tizim Ma'lumotlari</h4>
            </div>
            <div class="card-body">
                <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b;">Versiya:</span>
                    <strong>v2.5.0</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b;">Database:</span>
                    <strong>MySQL 8.0</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
                    <span style="color: #64748b;">Server:</span>
                    <strong>Online</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 12px 0;">
                    <span style="color: #64748b;">Oxirgi Backup:</span>
                    <strong>10.12.2024</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8" style="padding: 0 15px;">
        <div class="card">
            <div class="card-header">
                <h4>Umumiy Sozlamalar</h4>
                <button class="btn-primary">
                    <i class="fas fa-save"></i> Saqlash
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Platforma Nomi</label>
                        <input type="text" class="form-control" value="EduPlatform" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                    <div class="col-md-6" style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Administrator Email</label>
                        <input type="email" class="form-control" value="admin@eduplatform.uz" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                    <div class="col-md-6" style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Telefon</label>
                        <input type="text" class="form-control" value="+998 90 123 45 67" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                    <div class="col-md-6" style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Til</label>
                        <select class="form-select" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                            <option>O'zbek</option>
                            <option>Русский</option>
                            <option>English</option>
                        </select>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Manzil</label>
                        <input type="text" class="form-control" value="Toshkent, O'zbekiston" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h4>Bildirishnomalar</h4>
            </div>
            <div class="card-body">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f8fafc; border-radius: 12px; margin-bottom: 15px;">
                    <div>
                        <h6 style="margin: 0 0 5px 0; font-weight: 700;">Email Bildirishnomalar</h6>
                        <p style="margin: 0; color: #64748b; font-size: 14px;">Yangi foydalanuvchilar haqida email orqali xabar olish</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f8fafc; border-radius: 12px; margin-bottom: 15px;">
                    <div>
                        <h6 style="margin: 0 0 5px 0; font-weight: 700;">SMS Bildirishnomalar</h6>
                        <p style="margin: 0; color: #64748b; font-size: 14px;">To'lovlar haqida SMS orqali xabar olish</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f8fafc; border-radius: 12px; margin-bottom: 15px;">
                    <div>
                        <h6 style="margin: 0 0 5px 0; font-weight: 700;">Push Bildirishnomalar</h6>
                        <p style="margin: 0; color: #64748b; font-size: 14px;">Brauzer orqali bildirishnomalar olish</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f8fafc; border-radius: 12px;">
                    <div>
                        <h6 style="margin: 0 0 5px 0; font-weight: 700;">Haftalik Hisobotlar</h6>
                        <p style="margin: 0; color: #64748b; font-size: 14px;">Har hafta tizim statistikasini olish</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h4>Xavfsizlik</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Joriy Parol</label>
                        <input type="password" class="form-control" placeholder="••••••••" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                    <div class="col-md-6" style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Yangi Parol</label>
                        <input type="password" class="form-control" placeholder="••••••••" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                    <div class="col-md-12" style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Parolni Tasdiqlash</label>
                        <input type="password" class="form-control" placeholder="••••••••" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                </div>
                <button class="btn-primary">
                    <i class="fas fa-key"></i> Parolni O'zgartirish
                </button>
            </div>
        </div>

        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h4>Xavfli Zona</h4>
            </div>
            <div class="card-body">
                <div style="padding: 25px; background: #fef2f2; border-radius: 12px; border: 2px solid #fee2e2;">
                    <h6 style="color: #dc2626; font-weight: 800; margin: 0 0 10px 0;"><i class="fas fa-exclamation-triangle"></i> Ma'lumotlarni O'chirish</h6>
                    <p style="color: #991b1b; margin: 0 0 15px 0;">Bu amal barcha ma'lumotlarni butunlay o'chirib tashlaydi va qaytarib bo'lmaydi.</p>
                    <button class="btn-sm btn-danger" style="padding: 12px 24px;">
                        <i class="fas fa-trash-alt"></i> Barcha Ma'lumotlarni O'chirish
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #cbd5e1;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
}

input:checked + .slider:before {
    transform: translateX(26px);
}
</style>
@endsection
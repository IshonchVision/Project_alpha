@extends('student.layout')

@section('title', 'Sozlamalar')
@section('page-title', 'Sozlamalar')

@section('content')


<div class="row">
    <!-- Profil ma'lumotlari -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Profil Ma'lumotlari</h4>
            </div>
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 25px; margin-bottom: 30px;">
                    <img src="https://ui-avatars.com/api/?name=Malika+Karimova&background=3b82f6&color=fff&size=128" alt="Avatar" style="width: 120px; height: 120px; border-radius: 50%; border: 5px solid var(--primary);">
                    <div>
                        <button type="button" class="btn-primary" style="padding: 10px 20px;">
                            <i class="fas fa-camera"></i> Rasmni O'zgartirish
                        </button>
                        <p style="margin: 10px 0 0; color: #64748b;">JPG yoki PNG. Maksimal 2MB</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">Ism va Familiya</label>
                        <input type="text" class="form-control" value="Malika Karimova" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">Telefon</label>
                        <input type="text" class="form-control" value="+998 99 123 45 67" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">E-mail</label>
                        <input type="email" class="form-control" value="malika.student@example.uz" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">Yosh</label>
                        <input type="number" class="form-control" value="19" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px;">
                    </div>
                </div>

                <div style="margin-top: 30px;">
                    <button class="btn-primary" style="padding: 14px 32px;">
                        <i class="fas fa-save"></i> Saqlash
                    </button>
                </div>
            </div>
        </div>

        <!-- Parolni almashtirish -->
        <div class="card" style="margin-top: 30px;">
            <div class="card-header">
                <h4>Parolni Almashtirish</h4>
            </div>
            <div class="card-body">
                <div style="max-width: 500px;">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">Joriy Parol</label>
                        <input type="password" class="form-control" placeholder="••••••••">
                    </div>
                    <div style="margin-bottom: wife's 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">Yangi Parol</label>
                        <input type="password" class="form-control" placeholder="Yangi parol">
                    </div>
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">Tasdiqlash</label>
                        <input type="password" class="form-control" placeholder="Yana kiriting">
                    </div>
                    <button class="btn-primary" style="background: linear-gradient(135deg, #dc2626, #ef4444);">
                        <i class="fas fa-key"></i> Parolni Yangilash
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Qo'shimcha sozlamalar -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Bildirishnomalar</h4>
            </div>
            <div class="card-body">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div>
                        <strong>Email bildirishnomalar</strong><br>
                        <small style="color: #64748b;">Yangi darslar va izohlar</small>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div>
                        <strong>Push bildirishnomalar</strong><br>
                        <small style="color: #64748b;">Brauzer orqali</small>
                    </div>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 30px;">
            <div class="card-body">
                <button style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; padding: 14px 24px; border-radius: 14px; width: 100%; font-weight: 700;">
                    <i class="fas fa-sign-out-alt"></i> Chiqish
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Toggle switch (oldingi sahifalardan nusxa) */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}
.switch input { opacity: 0; width: 0; height: 0; }
.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #cbd5e1;
    transition: .4s;
    border-radius: 34px;
}
.slider:before {
    position: absolute;
    content: "";
    height: 26px; width: 26px;
    left: 4px; bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}
input:checked + .slider { background-color: var(--primary); }
input:checked + .slider:before { transform: translateX(26px); }
</style>
@endsection
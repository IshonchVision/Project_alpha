@extends('teacher.layout')

@section('title', 'Sozlamalar')
@section('page-title', 'Sozlamalar')

@section('content')


<div class="row" style="margin: 0 -15px;">
    <!-- Profil ma'lumotlari -->
    <div class="col-lg-8" style="padding: 0 15px;">
        <div class="card">
            <div class="card-header">
                <h4>Profil Ma'lumotlari</h4>
            </div>
            <div class="card-body">
                <form>
                    <div style="display: flex; align-items: center; gap: 25px; margin-bottom: 30px;">
                        <img src="https://ui-avatars.com/api/?name=Gulnoza+Ahmedova&background=10b981&color=fff&size=128" alt="Avatar" style="width: 120px; height: 120px; border-radius: 50%; border: 5px solid var(--primary);">
                        <div>
                            <button type="button" class="btn-primary" style="padding: 10px 20px; font-size: 14px;">
                                <i class="fas fa-camera"></i> Rasmni O'zgartirish
                            </button>
                            <p style="margin: 10px 0 0; color: #64748b;">JPG, PNG yoki GIF. Maksimal 2MB</p>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 700; color: var(--dark);">Ism va Familiya</label>
                            <input type="text" class="form-control" value="Gulnoza Ahmedova" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 15px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 700; color: var(--dark);">Telefon Raqam</label>
                            <input type="text" class="form-control" value="+998 95 123 45 67" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 15px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 700; color: var(--dark;">E-mail</label>
                            <input type="email" class="form-control" value="gulnoza.teacher@example.uz" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 15px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 700; color: var(--dark);">Mutaxassislik</label>
                            <input type="text" class="form-control" value="Ingliz tili o'qituvchisi" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 15px;">
                        </div>
                    </div>

                    <div style="margin-top: 30px;">
                        <button type="submit" class="btn-primary" style="padding: 14px 32px;">
                            <i class="fas fa-save"></i> Saqlash
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Parolni almashtirish -->
        <div class="card" style="margin-top: 30px;">
            <div class="card-header">
                <h4>Parolni Almashtirish</h4>
            </div>
            <div class="card-body">
                <form>
                    <div style="max-width: 500px;">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 700; color: var(--dark);">Joriy Parol</label>
                            <input type="password" class="form-control" placeholder="••••••••" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 15px;">
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 700; color: var(--dark);">Yangi Parol</label>
                            <input type="password" class="form-control" placeholder="Yangi parol kiriting" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 15px;">
                            <small style="color: #64748b; display: block; margin-top: 6px;">Kamida 8 belgidan iborat bo'lsin</small>
                        </div>
                        <div style="margin-bottom: 30px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 700; color: var(--dark);">Yangi Parolni Tasdiqlash</label>
                            <input type="password" class="form-control" placeholder="Yana bir marta kiriting" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 15px;">
                        </div>

                        <button type="submit" class="btn-primary" style="padding: 14px 32px; background: linear-gradient(135deg, #dc2626, #ef4444);">
                            <i class="fas fa-key"></i> Parolni Yangilash
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Qo'shimcha sozlamalar (ixtiyoriy) -->
    <div class="col-lg-4" style="padding: 0 15px;">
        <div class="card">
            <div class="card-header">
                <h4>Boshqa Sozlamalar</h4>
            </div>
            <div class="card-body">
                <div style="margin-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <div>
                            <h6 style="margin: 0; font-weight: 700;">Email Bildirishnomalar</h6>
                            <small style="color: #64748b;">Yangi izohlar va xabarlar haqida xabar berish</small>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <div>
                            <h6 style="margin: 0; font-weight: 700;">Push Bildirishnomalar</h6>
                            <small style="color: #64748b;">Brauzer orqali bildirishnomalar</small>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div style="display: flex; justify-content: space-between prél; align-items: center;">
                        <div>
                            <h6 style="margin: 0; font-weight: 700;">Profilni Ko'rinadigan Qilish</h6>
                            <small style="color: #64748b;">O'quvchilar sizni topa olishsin</small>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <hr style="margin: 30px 0; border-color: #e2e8f0;">

                <button type="button" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; padding: 14px 24px; border-radius: 14px; font-weight: 700; width: 100%; cursor: pointer; transition: all 0.3s;">
                    <i class="fas fa-sign-out-alt"></i> Hisobdan Chiqish
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control {
        transition: all 0.3s;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(16,185,129,0.1);
    }

    /* Toggle Switch */
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
        background-color: var(--primary);
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@endsection
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
                <form action="{{ route('settings.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="display: flex; align-items: center; gap: 25px; margin-bottom: 30px;">
                        @php
                            $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? '') . '&background=3b82f6&color=fff&size=128';
                        @endphp
                        <img src="{{ $avatarUrl }}" alt="Avatar" style="width: 120px; height: 120px; border-radius: 50%; border: 5px solid var(--primary); object-fit:cover">
                        <div style="flex:1">
                            <label class="btn btn-outline-secondary" style="padding: 10px 20px; cursor:pointer">
                                <i class="fas fa-camera"></i> Rasmni O'zgartirish
                                <input type="file" name="avatar" accept="image/*" style="display:none">
                            </label>
                            <p style="margin: 10px 0 0; color: #64748b;">JPG yoki PNG. Maksimal 2MB</p>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 700;">Ism va Familiya</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 700;">Telefon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 700;">E-mail</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 700;">Yosh (ixtiyoriy)</label>
                            <input type="number" name="age" class="form-control" value="{{ old('age') }}" style="padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px;">
                        </div>
                    </div>

                    <div style="margin-top: 30px;">
                        <button class="btn-primary" style="padding: 14px 32px;">
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
                <form action="{{ route('student.settings.password') }}" method="POST" style="max-width:500px;">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">Joriy Parol</label>
                        <input type="password" name="current_password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">Yangi Parol</label>
                        <input type="password" name="password" class="form-control" placeholder="Yangi parol" required>
                    </div>
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 700;">Tasdiqlash</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Yana kiriting" required>
                    </div>
                    <button class="btn-primary" style="background: linear-gradient(135deg, #dc2626, #ef4444);">
                        <i class="fas fa-key"></i> Parolni Yangilash
                    </button>
                </form>
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
                <form action="{{ route('settings.notifications') }}" method="POST">
                    @csrf
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div>
                            <strong>Email bildirishnomalar</strong><br>
                            <small style="color: #64748b;">Yangi darslar va izohlar</small>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="email_notifications" value="1" {{ $user->email_notifications ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div>
                            <strong>Push bildirishnomalar</strong><br>
                            <small style="color: #64748b;">Brauzer orqali</small>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="push_notifications" value="1" {{ $user->push_notifications ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div style="text-align:right">
                        <button class="btn btn-outline-primary">Saqlash</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card" style="margin-top: 30px;">
            <div class="card-body">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; padding: 14px 24px; border-radius: 14px; width: 100%; font-weight: 700;">
                        <i class="fas fa-sign-out-alt"></i> Chiqish
                    </button>
                </form>
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
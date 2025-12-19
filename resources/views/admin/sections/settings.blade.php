@extends('admin.layout')

@section('title', 'Sozlamalar')
@section('page-title', 'Sozlamalar')

@section('content')
<div class="row" style="margin: 0 -15px;">
    <div class="col-lg-4" style="padding: 0 15px;">
        <form action="{{ route('admin.settings.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div style="text-align: center; padding: 20px 0;">
                        @php $avatar = $user->avatar ? asset('storage/' . $user->avatar) : ('https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=3b82f6&color=fff&size=150'); @endphp
                        <img id="admin-avatar-preview" src="{{ $avatar }}" style="width: 150px; height: 150px; border-radius: 50%; border: 5px solid var(--primary); margin-bottom: 20px; object-fit:cover">
                        <h4 style="margin: 10px 0 5px 0; font-weight: 800;">{{ $user->name }}</h4>
                        <p style="color: #64748b; margin: 0;">{{ $user->email }}</p>
                        <label class="btn-primary" style="display:block;margin-top:20px; width:100%; text-align:center; cursor:pointer; position:relative; overflow:hidden">
                            <i class="fas fa-camera"></i> Rasmni O'zgartirish
                            <input id="admin-avatar-input" type="file" name="avatar" accept="image/*" style="position:absolute; left:0; top:0; width:100%; height:100%; opacity:0; cursor:pointer">
                        </label>
                        @if($errors->has('avatar'))
                            <div class="text-danger" style="margin-top:8px">{{ $errors->first('avatar') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="text-danger" style="margin-top:8px">{{ session('error') }}</div>
                        @endif
                        @if(session('success'))
                            <div class="text-success" style="margin-top:8px">{{ session('success') }}</div>
                        @endif
                        <div id="avatar-upload-status" style="margin-top:8px; color: #0ea5e9; display:none">Yuklanmoqda...</div>
                    </div>
                    <div style="margin-top: 12px">
                        <label class="form-label">Ism</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        <label class="form-label mt-2">E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                        <label class="form-label mt-2">Telefon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>
                    <div style="margin-top:16px; text-align:right">
                        <button class="btn btn-outline-primary">Saqlash</button>
                    </div>
                </div>
            </div>
        </form>

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
                    <strong>PostgreSQL</strong>
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
       
        <form action="{{ route('admin.settings.password') }}" method="POST">
            @csrf
            <div class="card" style="margin-top: 20px;">
                <div class="card-header">
                    <h4>Xavfsizlik</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 25px;">
                            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Joriy Parol</label>
                            <input name="current_password" type="password" class="form-control" placeholder="" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                            @error('current_password') <div class="text-danger" style="margin-top:6px">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6" style="margin-bottom: 25px;">
                            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Yangi Parol</label>
                            <input name="password" type="password" class="form-control" placeholder="" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                            @error('password') <div class="text-danger" style="margin-top:6px">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12" style="margin-bottom: 25px;">
                            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Parolni Tasdiqlash</label>
                            <input name="password_confirmation" type="password" class="form-control" placeholder="" style="padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px;">
                        </div>
                    </div>
                    <button class="btn-primary">
                        <i class="fas fa-key"></i> Parolni O'zgartirish
                    </button>
                </div>
            </div>
        </form>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('admin-avatar-input');
    const preview = document.getElementById('admin-avatar-preview');
    if (input && preview) {
        input.addEventListener('change', function (e) {
            const file = e.target.files && e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (ev) {
                preview.src = ev.target.result;
            };
            reader.readAsDataURL(file);
            // show status and submit the parent form (profile)
            const status = document.getElementById('avatar-upload-status');
            if (status) {
                status.style.display = 'block';
            }
            // submit the form containing the input
            if (input.form) {
                input.form.submit();
            }
        });
    }
});
</script>
<script>
function confirmDangerZoneSubmit(form) {
    const confirmInput = document.getElementById('danger-confirmation');
    const passInput = document.getElementById('danger-current-password');
    if (!confirmInput || !passInput) return false;
    if (confirmInput.value !== 'DELETE ALL') {
        alert('Iltimos, aniq "DELETE ALL" yozing.');
        return false;
    }
    if (!passInput.value) {
        alert('Iltimos, joriy parolni kiriting.');
        return false;
    }
    return confirm('Siz chindan ham barcha ma\'lumotlarni o\'chirmoqchimisiz? Bu amal qaytarib bo\'lmaydi.');
}

document.addEventListener('DOMContentLoaded', function () {
    const confirmInput = document.getElementById('danger-confirmation');
    const submitBtn = document.getElementById('danger-submit');
    if (confirmInput && submitBtn) {
        confirmInput.addEventListener('input', function () {
            if (confirmInput.value === 'DELETE ALL') {
                submitBtn.disabled = false;
                submitBtn.style.opacity = 1;
            } else {
                submitBtn.disabled = true;
                submitBtn.style.opacity = 0.6;
            }
        });
    }
});
</script>
@endsection
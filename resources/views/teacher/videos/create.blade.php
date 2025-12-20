@extends('teacher.layout')

@section('title', 'Yangi Video Qo\'shish')
@section('page-title', 'Yangi Video Qo\'shish')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ $course->title }} kursiga video qo'shish</h4>
        <a href="{{ route('teacher.courses') }}" class="btn-secondary">
            <i class="fas fa-arrow-left"></i> Orqaga
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert" style="padding:12px 18px;border-radius:12px;background:#ecfccb;color:#365314;margin-bottom:18px;font-weight:700;">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert" style="padding:12px 18px;border-radius:12px;background:#fee2e2;color:#991b1b;margin-bottom:18px;">
            <ul style="margin:0;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('teacher.courses.videos.store', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="video_file"><i class="fas fa-file-video"></i> Video faylini yuklash</label>
                <input type="file" id="video_file" name="video" accept="video/*" class="form-control" required>
                <small style="color: #64748b; display: block; margin-top: 8px;">
                    MP4, AVI, MOV va boshqalar. Maksimal: 1 GB
                </small>
            </div>

            <div class="form-group">
                <label for="title"><i class="fas fa-heading"></i> Video nomi</label>
                <input type="text" name="title" class="form-control" placeholder="Masalan: 1-dars. Kirish" required>
            </div>

            <div class="form-group">
                <label for="description"><i class="fas fa-align-left"></i> Tavsif</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Bu videoda nimalar o'rgatiladi?"></textarea>
            </div>

            <div class="form-group">
                <label for="duration_minutes"><i class="fas fa-clock"></i> Davomiyligi (daqiqa)</label>
                <input type="number" name="duration_minutes" class="form-control" placeholder="45" min="1" required>
            </div>

            <div style="text-align: right; margin-top: 30px;">
                <a href="{{ route('teacher.courses') }}" class="btn-secondary" style="margin-right: 15px;">
                    Bekor qilish
                </a>
                <button type="submit" class="btn-primary" style="padding: 14px 32px; font-size: 16px;">
                    <i class="fas fa-upload"></i> Videoni Yuklash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Oldingi stilni shu yerga ham qo'ying yoki layoutdan meros oladi */
    .form-group { margin-bottom: 25px; }
    .form-control { width: 100%; padding: 14px 16px; border: 2px solid #e2e8f0; border-radius: 14px; background: #f8fafc; }
    .form-control:focus { border-color: #8b5cf6; box-shadow: 0 0 0 4px rgba(139,92,246,0.15); outline: none; }
    .btn-primary { background: linear-gradient(135deg, #10b981, #059669); padding: 12px 25px; border: none; color: white; border-radius: 12px; }
</style>
@endsection
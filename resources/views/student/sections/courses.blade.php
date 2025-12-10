@extends('student.layout')

@section('title', 'Mening Kurslarim')
@section('page-title', 'Mening Kurslarim')

@section('content')
<div class="row">
    <!-- Kurs 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="" class="course-link"> <!-- Link qo'shdim -->
            <div class="course-item">
                <div class="course-thumbnail">
                    <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=400" alt="Course">
                    <div class="course-duration"><i class="fas fa-clock"></i> 24 soat</div>
                </div>
                <div style="padding: 20px;">
                    <h5 style="font-size: 20px; font-weight: 800; margin-bottom: 10px;">Advanced English Grammar</h5>
                    <p style="color: #64748b; margin-bottom: 15px;">O'qituvchi: Gulnoza Ahmedova</p>
                    <div style="display: flex; gap: 15px; font-size: 14px; color: #64748b;">
                        <span><i class="fas fa-video" style="color: #3b82f6;"></i> 18 dars</span>
                        <span><i class="fas fa-users" style="color: #3b82f6;"></i> 45 talaba</span>
                        <span><i class="fas fa-star" style="color: #f59e0b;"></i> 4.8</span>
                    </div>
                    <div style="margin-top: 15px;">
                        <div style="background: #e2e8f0; border-radius: 10px; height: 8px;">
                            <div style="width: 75%; height: 100%; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 10px;"></div>
                        </div>
                        <small style="color: #64748b; margin-top: 6px; display: block;">75% tugallangan</small>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Kurs 2 va 3 shu tarzda... (link qo'shing) -->
    <!-- Masalan: Kurs 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="" class="course-link">
            <!-- Kurs 2 kodini qo'ying -->
        </a>
    </div>
    <!-- Kurs 3 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="" class="course-link">
            <!-- Kurs 3 kodini qo'ying -->
        </a>
    </div>
</div>

<style>
.course-link {
    text-decoration: none;
    color: inherit;
}
.course-item {
    transition: all 0.3s;
}
.course-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
</style>
@endsection
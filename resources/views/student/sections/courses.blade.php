@extends('student.layout')

@section('title', 'Mening Kurslarim')
@section('page-title', 'Mening Kurslarim')

@section('content')

<div class="row">

    <!-- Kurs 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
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
    </div>

    <!-- Kurs 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="course-item">
            <div class="course-thumbnail">
                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400" alt="Course">
                <div class="course-duration"><i class="fas fa-clock"></i> 16 soat</div>
            </div>
            <div style="padding: 20px;">
                <h5 style="font-size: 20px; font-weight: 800; margin-bottom: 10px;">IELTS Speaking Preparation</h5>
                <p style="color: #64748b; margin-bottom: 15px;">O'qituvchi: Gulnoza Ahmedova</p>

                <div style="display: flex; gap: 15px; font-size: 14px; color: #64748b;">
                    <span><i class="fas fa-video" style="color: #3b82f6;"></i> 12 dars</span>
                    <span><i class="fas fa-users" style="color: #3b82f6;"></i> 28 talaba</span>
                    <span><i class="fas fa-star" style="color: #f59e0b;"></i> 4.9</span>
                </div>

                <div style="margin-top: 15px;">
                    <div style="background: #e2e8f0; border-radius: 10px; height: 8px;">
                        <div style="width: 50%; height: 100%; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 10px;"></div>
                    </div>
                    <small style="color: #64748b; margin-top: 6px; display: block;">50% tugallangan</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Kurs 3 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="course-item">
            <div class="course-thumbnail">
                <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400" alt="Course">
                <div class="course-duration"><i class="fas fa-clock"></i> 32 soat</div>
            </div>
            <div style="padding: 20px;">
                <h5 style="font-size: 20px; font-weight: 800; margin-bottom: 10px;">English for Beginners</h5>
                <p style="color: #64748b; margin-bottom: 15px;">O'qituvchi: Gulnoza Ahmedova</p>

                <div style="display: flex; gap: 15px; font-size: 14px; color: #64748b;">
                    <span><i class="fas fa-video" style="color: #3b82f6;"></i> 24 dars</span>
                    <span><i class="fas fa-users" style="color: #3b82f6;"></i> 67 talaba</span>
                    <span><i class="fas fa-star" style="color: #f59e0b;"></i> 4.7</span>
                </div>

                <div style="margin-top: 15px;">
                    <div style="background: #e2e8f0; border-radius: 10px; height: 8px;">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #10b981, #059669); border-radius: 10px;"></div>
                    </div>
                    <small style="color: #10b981; margin-top: 6px; display: block; font-weight: 700;">100% yakunlangan</small>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
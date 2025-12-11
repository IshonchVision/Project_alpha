@extends('layouts.app')

@section('content')

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/img/courses-header.jpg') center/cover no-repeat;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 fw-bold">Mening kurslarim</h1>
            <p class="text-white lead mt-3">Siz yaratgan yoki ro'yxatdan o'tgan barcha kurslar bir joyda</p>
        </div>
    </div>
    <!-- Header End -->

    <!-- My Courses Section -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Kurslaringiz ro'yxati</h2>
            <p class="text-muted">Jami: {{ $courses->count() }} ta kurs</p>
        </div>

        @if($courses->count() > 0)
            <div class="row g-5">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6">
                        <div class="card course-card border-0 shadow-lg rounded-4 overflow-hidden h-100 transition-all hover-lift">
                            <a href="{{ route('course.detail', $course->id) }}" class="text-decoration-none">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/courses/' . $course->img) }}" class="card-img-top" alt="{{ $course->title }}" style="height: 220px; object-fit: cover;">
                                    <div class="position-absolute bottom-0 start-0 end-0 bg-gradient-overlay"></div>
                                    @if($course->is_active)
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-success fs-6 px-3 py-2">Faol</span>
                                    @else
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-secondary fs-6 px-3 py-2">Faol emas</span>
                                    @endif
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold text-dark mb-3">{{ \Illuminate\Support\Str::limit($course->title, 60) }}</h5>
                                    <p class="text-muted small mb-4">{{ \Illuminate\Support\Str::limit($course->description, 100) }}</p>
                                    
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-chalkboard-teacher text-primary me-2"></i>
                                            <span class="text-dark">{{ $course->user->name ? $course->user->name : "O'qituvchi" }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-clock text-primary me-2"></i>
                                            <span class="text-dark">{{ $course->duration_hours }} soat</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fas fa-certificate text-warning me-1"></i>
                                            <small class="text-muted">Sertifikat mavjud</small>
                                        </div>
                                        <div class="text-warning">
                                            ★★★★☆ <span class="text-dark small">(4.7)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-book-open fa-5x text-muted mb-4 opacity-50"></i>
                <h4 class="text-muted">Hozircha kurslaringiz yo'q</h4>
                <p class="text-muted lead">Yangi kurs yaratishni boshlang yoki mavjud kurslarga qo'shiling.</p>
            </div>
        @endif
    </div>

    <style>
        .bg-gradient-overlay {
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            height: 100%;
        }
        .course-card {
            transition: all 0.4s ease;
        }
        .hover-lift:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
        }
        .card-img-top {
            transition: transform 0.5s ease;
        }
        .course-card:hover .card-img-top {
            transform: scale(1.08);
        }
    </style>

@endsection
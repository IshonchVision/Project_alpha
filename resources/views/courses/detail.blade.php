@extends('layouts.app')

@section('content')
    <div class="container-fluid px-0">
        <!-- Kurs Header -->
        <div class="position-relative">
            <img src="{{ asset('storage/courses/' . $course->img) }}" class="w-100" style="height: 400px; object-fit: cover;" alt="{{ $course->title }}">
            <div class="position-absolute bottom-0 start-0 end-0 bg-gradient-to-t from-black via-transparent to-transparent p-5">
                <div class="container">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <h1 class="text-white display-4 fw-bold mb-3">{{ $course->title }}</h1>
                            <p class="text-white lead mb-4">{{ $course->description }}</p>
                            <div class="d-flex flex-wrap gap-4 text-white">
                                <div>
                                    <i class="fas fa-chalkboard-teacher me-2"></i>
                                    <strong>Mentor:</strong> {{ $course->user->name }}
                                </div>
                                <div>
                                    <i class="fas fa-clock me-2"></i>
                                    <strong>Davomiylik:</strong> {{ $course->duration_hours }} soat
                                </div>
                                <div>
                                    <i class="fas fa-video me-2"></i>
                                    <strong>Darslar soni:</strong> {{ $course->videos->count() }} ta
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-end">
                            <div class="bg-white bg-opacity-20 backdrop-blur rounded-3 p-4">
                                <h5 class="text-white mb-3">Sizning progress</h5>
                                <div class="progress bg-white bg-opacity-30 rounded-pill" style="height: 30px;">
                                    <div class="progress-bar bg-success fw-bold" style="width: 45%;">
                                        45%
                                    </div>
                                </div>
                                <p class="text-white mt-2 mb-0">12 / {{ $course->videos->count() }} dars tugallandi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="row">
                <!-- Kurs bo'limlari va darslari -->
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-4">Kurs tarkibi</h3>

                    @php
                        // Videolarni bo'limlarga ajratish uchun misol (agar alohida bo'lim table bo'lmasa, title bo'yicha guruhlash)
                        $grouped = $course->videos->groupBy(function($video) {
                            return explode(' ', $video->title)[0] ?? 'Boshqa';
                        });
                    @endphp

                    <div class="accordion" id="courseAccordion">
                        @foreach($grouped as $section => $videos)
                            <div class="accordion-item border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-light fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#section-{{ $loop->index }}">
                                        {{ $section }} bo'lim
                                        <span class="ms-auto small text-muted">{{ $videos->count() }} dars • {{ $videos->sum('duration_seconds') / 60 }} daqiqa</span>
                                    </button>
                                </h2>
                                <div id="section-{{ $loop->index }}" class="accordion-collapse collapse" data-bs-parent="#courseAccordion">
                                    <div class="accordion-body pt-0">
                                        @foreach($videos as $video)
                                            <a href="#" class="d-block p-3 border-bottom hover-bg-light text-decoration-none text-dark">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3">
                                                            @if($loop->parent->iteration > 1 || $loop->iteration > 3)
                                                                <i class="fas fa-lock text-muted fs-4"></i>
                                                            @else
                                                                <i class="fas fa-play-circle text-primary fs-4"></i>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-semibold">{{ $video->title }}</h6>
                                                            <small class="text-muted">
                                                                <i class="far fa-clock"></i> {{ floor($video->duration_seconds / 60) }} daqiqa
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        @if($loop->parent->iteration == 1 && $loop->iteration <= 2)
                                                            <i class="fas fa-check-circle text-success"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Mentor haqida -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                        <div class="card-body text-center p-4">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle mb-3" width="120" height="120" alt="Mentor">
                            <h5 class="fw-bold">{{ $course->user->name }}</h5>
                            <p class="text-muted small">Backend dasturchi • 5+ yil tajriba</p>
                            <p class="text-secondary">
                                Otabeq Nurmuhammad – tajribali backend dasturchi bo'lib, minglab talabalarga SQL, Node.js va Express o'rgatgan.
                            </p>
                            <div class="d-grid gap-2 mt-4">
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-envelope me-2"></i> Xabar yozish
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sertifikat -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-certificate text-success fs-1 mb-3"></i>
                            <h6 class="fw-bold">Kursni tugatganda sertifikat</h6>
                            <p class="small text-muted">Barcha darslarni tugatib, testdan o'tsangiz rasmiy sertifikat beriladi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-to-t { background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); }
        .hover-bg-light:hover { background-color: #f8f9fa !important; }
        .accordion-button:not(.collapsed) { background-color: #e3f2fd; color: #1976d2; }
        .accordion-button:focus { box-shadow: none; }
    </style>
@endsection
@extends('layouts.app')

@section('content')

<div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
    <div class="container text-center py-5">
        <h2 class="text-white display-1">Kurslar</h2>
        <div class="d-inline-flex text-white mb-5">
            <p class="m-0 text-uppercase">Barcha</p>
            <i class="fa fa-angle-double-right pt-1 px-1"></i>
            <p class="m-0 text-uppercase">Kurslar</p>
        </div>
        <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
            <div class="input-group">
                <input type="text" class="form-control border-light" style="padding: 30px 25px;" placeholder="Kurs qidirish...">
                <div class="input-group-append">
                    <button class="btn btn-secondary px-4 px-lg-5">Qidirish</button>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($courses as $course)
    @if($course->course_type === 'theory')
    <div class="container-fluid py-5 bg-light mb-5">
        <div class="container py-5">
            <div class="row mx-0 justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center position-relative mb-5">
                        <h1 class="display-5">Ta'lim nazariyasi kursi</h1>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 pb-4">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ route('course.detail', $course->id) }}">
                        <img class="img-fluid" src="{{ $course->img ? asset('storage/' . $course->img) : asset('img/courses-1.jpg') }}" alt="" style="border-radius: 15px; height: 300px; object-fit: cover; width: 100%;">
                        <div class="courses-text p-3" style="background: rgba(0,0,0,0.6); border-radius: 0 0 15px 15px; position: absolute; bottom: 0; width: 100%;">
                            <h4 class="text-center text-white px-3">{{ $course->title }}</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-8 col-md-6 pb-4">
                    <div class="p-4 bg-white shadow-sm" style="border-radius: 15px; min-height: 300px;">
                        <h4 class="mb-3">Kurs tavsifi</h4>
                        <p style="white-space: pre-line; font-size: 16px; color: #666;">{{ $course->description }}</p>
                        <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                            <span class="font-weight-bold"><i class="fa fa-video text-primary mr-2"></i>{{ $course->videos->count() }} ta dars</span>
                            <span class="badge badge-success px-3 py-2">Bepul</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row mx-0 justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center position-relative mb-5">
                    <h1 class="display-5">Boshqa kurslarimiz</h1>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($courses as $course)
                @if($course->course_type !== 'theory')
                <div class="col-lg-4 col-md-6 pb-4">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                       href="{{ route('course.detail', $course->id) }}"
                       style="border-radius: 15px; text-decoration: none; display: block; height: 450px;">

                        <img class="img-fluid"
                             src="{{ $course->img ? asset('storage/' . $course->img) : asset('img/courses-1.jpg') }}"
                             style="height: 100%; width: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1;">

                        <div class="courses-text"
                             style="position: absolute; bottom: 0; left: 0; width: 100%; z-index: 2;
                                    background: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0.7) 50%, transparent 100%);
                                    padding: 30px 20px;">

                            <div class="text-center mb-3">
                                <p class="text-white mb-1" style="font-size: 14px; opacity: 0.8;">
                                    O'qituvchi: {{ $course->user->name ?? "O'qituvchi" }}
                                </p>
                                <h4 class="text-white m-0" style="font-weight: 700; font-size: 22px;">{{ $course->title }}</h4>
                            </div>

                            <div style="width: 100%; height: 1px; background: rgba(255,255,255,0.2); margin-bottom: 15px;"></div>

                            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                <div style="color: #ffc107; font-weight: 800; font-size: 17px;">
                                    {{ $course->videos->count() }} ta dars
                                </div>
                                <div>
                                    <span style="background-color: #ff8a50; color: white; padding: 8px 15px;
                                                 border-radius: 25px; font-size: 13px; font-weight: 600; white-space: nowrap;">
                                        Video kurs
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@extends('layouts.app')

@section('content')

<style>
    /* Scrollbar stilini o'zgartirish */
    .mavzular-scroll::-webkit-scrollbar {
        width: 4px;
    }

    .mavzular-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .mavzular-scroll::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.6);
        border-radius: 10px;
        min-height: 40px;
    }

    .mavzular-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.8);
    }
</style>

<!-- Detail Start -->
<div class="container-fluid py-5">
    <div class="container py-5">

        <!-- Fanning nomi (eng tepada) -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="section-title text-center position-relative">
                    <h1 class="display-5">Ta'lim nazariyasidan modullik darslar</h1>
                </div>
            </div>
        </div>

        <!-- Yuqori qism: Video + Mavzular -->
        <div class="row mb-4">
            <!-- Chap: Video/Rasm (katta) -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="position-relative" style="border-radius: 10px; overflow: hidden; height: 100%;">
                    <img class="img-fluid w-100" style="height: 400px; object-fit: cover;" src="img/courses-1.jpg" alt="Kurs video">
                    <div class="position-absolute" style="bottom: 20px; left: 20px;">
                        <button class="btn btn-primary btn-lg">
                            <i class="fa fa-play-circle"></i> Video ko'rish
                        </button>
                    </div>
                </div>
            </div>

            <!-- O'ng: Mavzular ro'yxati -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="bg-light p-4" style="border-radius: 10px; height: 400px;">
                    <h3 class="mb-4">Mavzular</h3>
                    <ul class="list-group list-group-flush mavzular-scroll" style="max-height: 320px; overflow-y: auto;">
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">Ta'limga kirish</a>
                            <span class="badge badge-primary badge-pill">1-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">Ushbu fanning turlari</a>
                            <span class="badge badge-primary badge-pill">2-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">Ta'limning prixalogiyasi</a>
                            <span class="badge badge-primary badge-pill">3-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">Kalit so'zlar</a>
                            <span class="badge badge-primary badge-pill">4-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">Online ta'lim</a>
                            <span class="badge badge-primary badge-pill">5-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">Yangi mavzu</a>
                            <span class="badge badge-primary badge-pill">6-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">Pedagogik texnologiyalar</a>
                            <span class="badge badge-primary badge-pill">7-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">Zamonaviy ta'lim usullari</a>
                            <span class="badge badge-primary badge-pill">8-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">O'quvchilarni baholash</a>
                            <span class="badge badge-primary badge-pill">9-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            <a href="" class="text-decoration-none h6 m-0">Dars rejalashtirish</a>
                            <span class="badge badge-primary badge-pill">10-dars</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Pastki qism: Izoh + Kurs xususiyatlari -->
        <div class="row">
            <!-- Chap: Kurs izohi (col-8) -->
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="bg-light p-4" style="border-radius: 10px;">
                    <h3 class="mb-4">Kurs haqida</h3>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                        dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                        specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    <p>
                        SadipscingLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                        it to make a type specimen book. It has survived not only five and scrambled
                        it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.
                    </p>
                </div>
            </div>

            <!-- O'ng: Kurs xususiyatlari (col-4) -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div style="background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #e0e0e0;">
                    <h4 class="text-primary py-3 px-4 m-0" style="background: #f8f9fa; border-bottom: 1px solid #e0e0e0;">Kurs xususiyatlari</h4>
                    <div class="d-flex justify-content-between border-bottom px-4" style="border-color: #e0e0e0 !important;">
                        <h6 class="text-dark my-3">O'qituvchi</h6>
                        <h6 class="text-dark my-3 font-weight-bold">Jasur M.</h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4" style="border-color: #e0e0e0 !important;">
                        <h6 class="text-dark my-3">Darslar soni</h6>
                        <h6 class="text-dark my-3 font-weight-bold">40 ta</h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4" style="border-color: #e0e0e0 !important;">
                        <h6 class="text-dark my-3">Davomiyligi</h6>
                        <h6 class="text-dark my-3 font-weight-bold">13 soat</h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4" style="border-color: #e0e0e0 !important;">
                        <h6 class="text-dark my-3">Kimlari uchun</h6>
                        <h6 class="text-dark my-3 font-weight-bold">Barcha</h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4" style="border-color: #e0e0e0 !important;">
                        <h6 class="text-dark my-3">Tili</h6>
                        <h6 class="text-dark my-3 font-weight-bold">O'zbek</h6>
                    </div>
                    <h5 class="text-success py-3 px-4 m-0" style="border-top: 1px solid #e0e0e0;">Kurs narxi: Bepul</h5>
                    <div class="py-3 px-4">
                        <form action="{{ route('course.watch') }}" method="POST" style="display:inline-block; width:100%">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id ?? '' }}">
                            <button type="submit" class="btn btn-block btn-primary py-3 px-5" style="font-weight: bold;">Hozir ko'rish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Detail End -->

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@endsection
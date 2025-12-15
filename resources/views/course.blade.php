@extends('layouts.app')

@section('content')


<!-- Header Start -->
<div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
    <div class="container text-center py-5">
        <h2 class="text-white display-1">Kurslar</h2>
        <div class="d-inline-flex text-white mb-5">
            <p class="m-0 text-uppercase">Barcha</p>
            <i class="fa fa-angle-double-left pt-1 px-1"></i>
            <i class="fa fa-angle-double-right pt-1 px-1"></i>
            <p class="m-0 text-uppercase">Kurslar</p>
        </div>
        <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Kurslar</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Courses 1</a>
                        <a class="dropdown-item" href="#">Courses 2</a>
                        <a class="dropdown-item" href="#">Courses 3</a>
                    </div>
                </div>
                <input type="text" class="form-control border-light" style="padding: 30px 25px;" placeholder="Keyword">
                <div class="input-group-append">
                    <button class="btn btn-secondary px-4 px-lg-5">Qidirish</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Ta'lim Nazariyasi Kurslari Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container py-5">
        <div class="row mx-0 justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center position-relative mb-5">
                    <h1 class="display-5">Ta'lim nazariyasi kursi</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Ta'lim nazariyasi kurs kartasi -->
            <div class="col-lg-4 col-md-6 pb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ url('detail') }}">
                    <img class="img-fluid" src="img/courses-1.jpg" alt="Ta'lim Nazariyasi">
                    <div class="courses-text p-3" style="background: rgba(0,0,0,0.6); border-radius: 10px;">
                        <p class="text-center text-white mb-1" style="font-size: 14px;">O'qituvchi: Mahliyo</p>
                        <h4 class="text-center text-white px-3">Ta'lim nazariyasi asoslari</h4>
                        <div class="border-top w-100 mt-3">
                            <div class="d-flex justify-content-between p-3">
                                <span class="text-white" style="font-weight: 700; font-size: 18px;">27 ta dars</span>
                                <span class="text-white"><small>Bepul</small></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-8 col-md-6 pb-4">
                <div class="p-3" style="background: #f8f9fa; border-radius: 10px;">
                    <h4>Kurs tavsifi</h4>
                    <p>
                        Bu kurs ta'lim nazariyasi asoslarini o‘rgatadi. Kurs davomida pedagogik metodlar, darslarni rejalashtirish
                        va samarali tashkil qilish bo‘yicha amaliy mashqlar mavjud.
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                        to make a type specimen book. It has survived not only five centuries, but also the leap
                        into electronic typesetting, remaining essentially unchanged. It was popularised in the 1
                        960s with the release of Letraset sheets containing Lorem Ipsum passages, and more
                        recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ta'lim Nazariyasi Kurslari End -->

<!-- Boshqa Kurslar Start -->
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
            <!-- Sizning boshqa kurslar ro'yxati shu yerda bo'ladi -->
            <div class="col-lg-4 col-md-6 pb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ url('detail') }}">
                    <img class="img-fluid" src="img/courses-1.jpg" alt="">
                    <div class="courses-text p-3" style="background: rgba(0,0,0,0.6); border-radius: 10px;">
                        <p class="text-center text-white mb-1" style="font-size: 14px;">O'qituvchi: Anvar N.</p>
                        <h4 class="text-center text-white px-3">Python boshlang'ich darslar</h4>
                        <div class="border-top w-100 mt-3">
                            <div class="d-flex justify-content-between p-3">
                                <span class="text-white" style="font-weight: 700; font-size: 18px;">40 ta dars</span>
                                <span class="text-white"><small>Bepul</small></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Shu tarzda boshqa kurslar -->
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@endsection      
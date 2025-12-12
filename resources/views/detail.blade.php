@extends('layouts.app')

@section('content')



<!-- Detail Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <!-- Kurs modullari -->
            <div class="col-lg-8">
                <div class="mb-5">
                    <div class="section-title position-relative mb-5">
                        <h1 class="display-4">Ta'lim nazariyasidan modullik darslar</h1>
                    </div>
                    <div class="owl-carousel related-carousel position-relative" style="padding: 0 30px;">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="detail.html">
                            <img class="img-fluid" src="img/courses-1.jpg" alt="">
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3">Web design & development courses for beginners</h4>
                                <div class="border-top w-100 mt-3">
                                    <div class="d-flex justify-content-between p-4">
                                        <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                        <span class="text-white"><i class="fa fa-star mr-2"></i>4.5 <small>(250)</small></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- boshqa kurs kartalari shu yerda -->
                    </div> <br>

                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                        dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                        specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem
                        Ipsum....
                    </p>
                    <p>SadipscingLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scram
                        bled it to make a type specimen book. It has survived not only five centuries, but also the leap into elec
                    </p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 mt-5 mt-lg-0">

                <!-- Mavzular -->
                <div class="mb-5">
                    <h2 class="mb-3">Mavzular</h2>
                    <ul class="list-group list-group-flush topic-list">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="" class="text-decoration-none h6 m-0">Ta'limga kirish</a>
                            <span class="badge badge-primary badge-pill">1-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="" class="text-decoration-none h6 m-0">Ushbu fanning turlari</a>
                            <span class="badge badge-primary badge-pill">2-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="" class="text-decoration-none h6 m-0">Ta'limning prixalogiyasi</a>
                            <span class="badge badge-primary badge-pill">3-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="" class="text-decoration-none h6 m-0">Kalit so'zlar</a>
                            <span class="badge badge-primary badge-pill">4-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="" class="text-decoration-none h6 m-0">Onlne ta'lim</a>
                            <span class="badge badge-primary badge-pill">5-dars</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <a href="" class="text-decoration-none h6 m-0">Yangi mavzu</a>
                            <span class="badge badge-primary badge-pill">6-dars</span>
                        </li>
                    </ul>
                </div>

                <!-- Kurs xususiyatlari -->
                <div class="bg-primary mb-5 py-3">
                    <h3 class="text-white py-3 px-4 m-0">Kurs xususiyatlari</h3>
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">O'qituvchi</h6>
                        <h6 class="text-white my-3">Jasur M.</h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Reyting</h6>
                        <h6 class="text-white my-3">4.5 <small>(250)</small></h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Davomiyligi</h6>
                        <h6 class="text-white my-3">13 soat</h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Kimlari uchun</h6>
                        <h6 class="text-white my-3">Barch</h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom px-4">
                        <h6 class="text-white my-3">Tili</h6>
                        <h6 class="text-white my-3">O'zbek</h6>
                    </div>
                    <h5 class="text-white py-3 px-4 m-0">Kurs narxi: Bepul</h5>
                    <div class="py-3 px-4">
                        <a class="btn btn-block btn-secondary py-3 px-5" href="">Hozir ko'rish</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Detail End -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@endsection
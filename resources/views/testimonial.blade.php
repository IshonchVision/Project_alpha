@extends('layouts.app')

@section('content')


<!-- Header Start -->
<div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
    <div class="container text-center py-5">
        <h1 class="text-white display-1">Testimonial</h1>
        <div class="d-inline-flex text-white mb-5">
            <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
            <i class="fa fa-angle-double-right pt-1 px-3"></i>
            <p class="m-0 text-uppercase">Testimonial</p>
        </div>
        <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Courses</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Courses 1</a>
                        <a class="dropdown-item" href="#">Courses 2</a>
                        <a class="dropdown-item" href="#">Courses 3</a>
                    </div>
                </div>
                <input type="text" class="form-control border-light" style="padding: 30px 25px;" placeholder="Keyword">
                <div class="input-group-append">
                    <button class="btn btn-secondary px-4 px-lg-5">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Testimonial Start -->
<div class="container-fluid bg-image py-5" style="margin: 90px 0;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="section-title position-relative mb-4">
                    <h1 class="display-4">O'quvchilarning fikrlari</h1>
                </div>
                <p class="m-0">
                    Ushbu platforma orqali minglab talabalar o'z bilimlarini kengaytirib, amaliy ko'nikmalarini oshirmoqda. Quyida o'quvchilarimizning kurslarimiz haqidagi fikrlari bilan tanishing
                </p>
            </div>
            <div class="col-lg-7">
                <div class="owl-carousel testimonial-carousel">
                    <div class="bg-white p-5">
                        <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                        <p>Ushbu kurslar orqali men web dizayn bo'yicha o'z ko'nikmalarimni sezilarli darajada oshirdim. Video darslar juda tushunarli va amaliy mashqlar bilan boyitilgan, o'rganish jarayoni qiziqarli bo'ldi</p>
                        <div class="d-flex flex-shrink-0 align-items-center mt-4">
                            <img class="img-fluid mr-4" src="img/testimonial-2.jpg" alt="">
                            <div>
                                <h5>Student Name</h5>
                                <span>Web Dizayn Kursi</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-5">
                        <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                        <p>Men IT kurslarida ishtirok etdim va o'qituvchilar juda malakali, har bir modul amaliy misollar bilan mustahkamlangan. Kursni tugatgandan keyin real loyihalarda ishonch bilan ishlash imkoniga ega bo'ldim</p>
                        <div class="d-flex flex-shrink-0 align-items-center mt-4">
                            <img class="img-fluid mr-4" src="img/testimonial-1.jpg" alt="">
                            <div>
                                <h5>Student Name</h5>
                                <span>Frontend Development</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial Start -->

@endsection
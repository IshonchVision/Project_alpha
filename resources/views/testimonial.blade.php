@extends('layouts.app')

@section('content')


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
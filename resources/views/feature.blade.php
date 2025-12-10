@extends('layouts.app')

@section('content')

        <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h6 class="text-white display-1">Bizning kursdan nimalar olasiz</h6>
        </div>
    </div>
    <!-- Header End -->


    <!-- Feature Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Nima uchun bizni tanlash kerak?</h6>
                        <h5 class="display-4">Nima uchun o‘rganishni aynan biz bilan boshlashingiz kerak?</h5>
                    </div>
                    <p class="mb-4 pb-2">Bizning tajribali o‘qituvchilarimiz sizga samarali va qiziqarli ta’lim berishga tayyor. Siz istalgan bilimni qulay va interaktiv tarzda o‘rganishingiz mumkin.</p>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-primary mr-4">
                            <i class="fa fa-2x fa-graduation-cap text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Tajribali O‘qituvchilar</h4>
                            <p>Bizning o‘qituvchilarimiz sohada yetarlicha tajribaga ega bo‘lib, sizning bilimlaringizni mukammal rivojlantirishga yordam beradi.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-secondary mr-4">
                            <i class="fa fa-2x fa-certificate text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Kursni tugatganligi haqida Sertifikatlar</h4>
                            <p>Bizning kurslarimizni tamomlaganingizdan so‘ng siz xalqaro tan olingan sertifikatga ega bo‘lasiz.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="btn-icon bg-warning mr-4">
                            <i class="fa fa-2x fa-book-reader text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Onlayn Darslar</h4>
                            <p class="m-0">Siz uydan chiqmasdan ham onlayn darslar orqali o‘rganishingiz mumkin, bu esa vaqt va qulaylikni tejaydi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/feature.jpg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->

@endsection
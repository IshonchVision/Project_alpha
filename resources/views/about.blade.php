@extends('layouts.app')

@section('content')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h2 class="text-white display-3">Biz haqimizda batafsil</h2>
            <div class="d-inline-flex text-white mb-5">
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Header End -->

    <!-- About Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href=""
                    style="max-height: 400px;">
                    <img class="img-fluid" src="img/header.jpg" alt=""
                        style="max-height: 350px; object-fit: cover; width: 100%;">
                </a>
            </div>
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="section-title position-relative mb-3">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2"
                        style="font-size: 0.85rem;">Maqsad sharhi</h6>
                    <h2 class="display-5">Ta'lim nazariyasi haqida ma'lumot</h2>
                </div>
                <p style="font-size: 0.95rem; line-height: 1.7; text-align: justify;">
                    Ta'lim nazariyasi — o'qitish jarayoni, metodlari, tamoyillari va o'quvchini rivojlantirishga qaratilgan
                    ilmiy yondashuvlarni o'rganuvchi fan.
                    Ushbu platformada siz ta'lim jarayonining asoslari, didaktik tamoyillar, o'qitish metodlari, o'quvchi
                    psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o'rganasiz.
                </p>
            </div>
            <div class="col-12">
                <p style="font-size: 0.95rem; line-height: 1.7; text-align: justify;">
                    <b style="color: blue;">Ta'lim nazariyasi</b> — o'qitish jarayoni, metodlari, tamoyillari va o'quvchini
                    rivojlantirishga qaratilgan ilmiy ilmiy yondashuvlarni o'rganuvchi fan.
                    Ushbu platformada siz ta'lim jarayonining asoslari, didaktik tamoyillar, o'qitish metodlari, o'quvchi
                    psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o'rganasiz.
                </p>
                <p style="font-size: 0.95rem; line-height: 1.7; text-align: justify;">
                    Ta'lim nazariyasi — o'qitish jarayoni, metodlari, tamoyillari va o'quvchini rivojlantirishga qaratilgan
                    ilmiy yondashuvlarni o'rganuvchi fan.
                    Ushbu platformada siz ta'lim jarayonining asoslari, didaktik tamoyillar, o'qitish metodlari, o'quvchi
                    psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o'rganasiz.
                </p>
                <p style="font-size: 0.95rem; line-height: 1.7; text-align: justify;">
                    Ushbu platformada siz ta'lim jarayonining asoslari, didaktik tamoyillar, o'qitish metodlari, o'quvchi
                    psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o'rganasiz.
                    Ta'lim nazariyasi — o'qitish jarayoni, metodlari, tamoyillari va o'quvchini rivojlantirishga qaratilgan
                    ilmiy yondashuvlarni o'rganuvchi fan.
                </p>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Kurslar bo'limi -->
    <div class="container py-12" style="margin-top: 60px;">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4">
                        <div class="card text-center h-100 shadow-lg border-0 rounded-3">
                            <div class="card-body p-5"
                                style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white;">
                                <i class="fa fa-laptop fa-3x mb-4"></i>
                                <h5 class="card-title mb-3 fw-bold">IT: Turli sohalar</h5>
                                <p class="card-text" style="line-height: 1.6;">
                                    Dasturlash, Web Development, Data Science, AI va boshqa sohalarda kurslar.
                                    Real loyihalar va interaktiv mashqlar bilan bilimlaringizni amalda sinab ko'ring.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center h-100 shadow-lg border-0 rounded-3">
                            <div class="card-body p-5"
                                style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                                <i class="fa fa-globe fa-3x mb-4"></i>
                                <h5 class="card-title mb-3 fw-bold">IELTS</h5>
                                <p class="card-text" style="line-height: 1.6;">
                                    Umumiy IELTS tayyorlov kurslari: listening, reading, writing va speaking qamrab olingan.
                                    Interaktiv mashqlar va testlar bilan muvaffaqiyat sari qadam tashlang.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center h-100 shadow-lg border-0 rounded-3">
                            <div class="card-body p-5"
                                style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%); color: white;">
                                <i class="fa fa-graduation-cap fa-3x mb-4"></i>
                                <h5 class="card-title mb-3 fw-bold">SAT</h5>
                                <p class="card-text" style="line-height: 1.6;">
                                    SAT tayyorlov kurslari bilan matematika va ingliz tilini mustahkamlang.
                                    Sinov testlari va interaktiv mashqlar muvaffaqiyatingizni oshiradi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
<!-- Header End -->


<!-- About Start -->
<div class="container py-12">
    <div class="row align-items-center">
        <!-- Chap tomonda matn -->
        <div class="col-lg-5 col-md-6 pb-4">
            <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ url('detail') }}">
                <img class="img-fluid" src="img/courses-1.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">
                        Ta'lim nazariyasi: Videoni joyi
                    </h4>
                    <div class="border-top w-100 mt-3">
                        <div class="d-flex justify-content-between p-4">
                            <span class="text-white"><i class="fa fa-user mr-2"></i>Prof. J. Doe</span>
                            <span class="text-white"><i class="fa fa-star mr-2"></i>4.8
                                <small>(512)</small>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-7 mb-5">
            <div class="section-title position-relative mb-4">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Maqsad sharhi</h6>
                <h2 class="display-4">Ta'lim nazariyasi haqida qisqacha ma'lumot</h>
            </div>
            <p>
                Ta’lim nazariyasi — o‘qitish jarayoni, metodlari, tamoyillari va o‘quvchini rivojlantirishga qaratilgan ilmiy yondashuvlarni o‘rganuvchi fan.
                Ushbu platformada siz ta’lim jarayonining asoslari, didaktik tamoyillar, o‘qitish metodlari, o‘quvchi psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o‘rganasiz.
                Ta’lim nazariyasi — o‘qitish jarayoni, metodlari, tamoyillari va o‘quvchini rivojlantirishga qaratilgan ilmiy yondashuvlarni o‘rganuvchi fan.
                Ushbu platformada siz ta’lim jarayonining asoslari, didaktik tamoyillar, o‘qitish metodlari, o‘quvchi psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o‘rganasiz.
                Ushbu platformada siz ta’lim jarayonining asoslari, didaktik tamoyillar, o‘qitish metodlari, o‘quvchi psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o‘rganasiz.
            </p>
        </div>
    </div>
</div>
<!-- About End -->

<!-- About Start (Turli kurslar) -->
<div class="container py-12" style="margin-top: 60px;">
    <div class="row justify-content-center">
        <div class="container-fluid py-12">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="section-title position-relative mb-5 p-4 rounded-3"
                        style="border: 2px solid #6c757d; background: #f8f9fa; box-shadow: 0 8px 20px rgba(0,0,0,0.1);">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">
                            Bizning Maqsadimiz
                        </h6>
                        <h2 class="display-5 fw-bold mt-3">
                            Bu sayt nafaqat Ta’lim nazariyasi, balki turli kurslar bilan bilimlaringizni kengaytiradi!
                        </h2>
                        <p class="lead text-muted mb-0 mt-3" style="line-height: 1.7;">
                            Shu platformada siz nafaqat Ta’lim nazariyasi asoslarini, balki IT, IELTS, SAT va boshqa ko‘plab kurslarni ham o‘rganishingiz mumkin.
                            Har bir kurs interaktiv, amaliy va hayratlantiruvchi tajribaga boyitilgan.
                            Bu sayt sizni o‘qitish jarayonida qiziqtiradi, ilhomlantiradi va yangi bilimlarni egallashga undaydi!
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Kurslar kartalari -->
        <div class="col-12">
            <div class="row g-4 justify-content-center">

                <div class="col-md-4">
                    <div class="card text-center h-100 shadow-lg border-0 rounded-3">
                        <div class="card-body p-5" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white;">
                            <i class="fa fa-laptop fa-3x mb-4"></i>
                            <h5 class="card-title mb-3 fw-bold">IT: Turli sohalar</h5>
                            <p class="card-text" style="line-height: 1.6;">
                                Dasturlash, Web Development, Data Science, AI va boshqa sohalarda kurslar.
                                Real loyihalar va interaktiv mashqlar bilan bilimlaringizni amalda sinab ko‘ring.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center h-100 shadow-lg border-0 rounded-3">
                        <div class="card-body p-5" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
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
                        <div class="card-body p-5" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%); color: white;">
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
<!-- About End -->




@endsection
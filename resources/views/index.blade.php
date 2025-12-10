@extends('layouts.app')

@section('content')


<!-- Header Start -->
<div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
    <div class="container text-center my-5 py-5">
        <h1 class="text-white mt-4 mb-4">O‘zingizga qulay tarzda o‘rganing</h1>
        <h1 class="text-white display-1 mb-5">Zamonaviy kurslar</h1>
        <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
            <div class="input-group">
                <!-- <div class="input-group-prepend">
                    <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Courses</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Courses 1</a>
                        <a class="dropdown-item" href="#">Courses 2</a>
                        <a class="dropdown-item" href="#">Courses 3</a>
                    </div>
                </div> -->
                <!-- <input type="text" class="form-control border-light" style="padding: 30px 25px;" placeholder="Keyword">
                <div class="input-group-append">
                    <button class="btn btn-secondary px-4 px-lg-5">Search</button>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="img/online.jpg" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="section-title position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Onlayn ta'lim</h6>
                    <h1 class="display-4">Istalgan joyda onlayn ta'lim uchun birinchi tanlov!</h1>
                </div>
                <p>
                    Bizning platformamiz bilan siz istalgan vaqtda va istalgan joydan sifatli ta'lim olishingiz mumkin.
                    Tajriba to'plagan xalqaro va mahalliy o'qituvchilar, amaliy topshiriqlar va interaktiv testlar yordamida bilimlaringizni mustahkamlaysiz.
                    Video darslar, qo'shimcha materiallar va jonli muloqot orqali savollaringizga tezkor javob olasiz.
                    Boshlash uchun ro'yxatdan o'ting va o'z rivojlanish yo'lingizni bugun boshlang.
                </p>
                <div class="row pt-3 mx-0">
                    <div class="col-3 px-0">
                        <div class="bg-success text-center p-4">
                            <h1 class="text-white" data-toggle="counter-up">123</h1>
                            <h6 class="text-uppercase text-white">Mavjud<span class="d-block">Kurslar</span></h6>
                        </div>
                    </div>
                    <div class="col-3 px-0">
                        <div class="bg-primary text-center p-4">
                            <h1 class="text-white" data-toggle="counter-up">123</h1>
                            <h6 class="text-uppercase text-white">Onlayn<span class="d-block">Kurslar</span></h6>
                        </div>
                    </div>
                    <div class="col-3 px-0">
                        <div class="bg-secondary text-center p-4">
                            <h1 class="text-white" data-toggle="counter-up">123</h1>
                            <h6 class="text-uppercase text-white">Maxoratli<span class="d-block">O'qituvchilar</span></h6>
                        </div>
                    </div>
                    <div class="col-3 px-0">
                        <div class="bg-warning text-center p-4">
                            <h1 class="text-white" data-toggle="counter-up">123</h1>
                            <h6 class="text-uppercase text-white">O'quvchilar<span class="d-block">Soni</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Feature Start -->
<div class="container-fluid bg-image" style="margin: 90px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 my-5 pt-5 pb-lg-5">
                <div class="section-title position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Nega Bizni tanlashingiz kerak?</h6>
                    <h2 class="display-4">Biz bilan o'rganishni boshlashingizga sabablar?</h2>
                </div>
                <p class="mb-4 pb-2"> Ushbu platforma o'quvchilar uchun qulay va samarali ta'lim jarayonini yaratishga mo'ljallangan.
                    Darslar amaliy misollar bilan boyitilgan bo'lib, o'rgangan bilimlarni darhol amalda qo'llash imkonini beradi.
                    O'qituvchi bilan onlayn muloqot, savol-javob imkoniyatlari va muntazam yangilanib boradigan materiallar ta'lim jarayonini yanada qiziqarli qiladi.</p>
                <div class="d-flex mb-3">
                    <div class="btn-icon bg-primary mr-4">
                        <i class="fa fa-2x fa-graduation-cap text-white"></i>
                    </div>
                    <div class="mt-n1">
                        <h4>Malakali o'qituvchilar</h4>
                        <p>Video kurslarni siz ko'p yillik tajribaga ega xalqaro toifadagi o'qituvchilar</p>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <div class="btn-icon bg-secondary mr-4">
                        <i class="fa fa-2x fa-tasks text-white"></i>
                    </div>
                    <div class="mt-n1">
                        <h4>Testlar va amaliy topshiriqlar</h4>
                        <p>Har modul yoki dars oxirida siz o'z bilimingizni sinash maqsadida test topshiriqlarini ishlab natijalaringizni ko'rib borasiz</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="btn-icon bg-warning mr-4">
                        <i class="fa fa-2x fa-comment-dots text-white"></i>
                    </div>
                    <div class="mt-n1">
                        <h4>Guruhingiz bilan onlayn muloqotlar</h4>
                        <p class="m-0">Siz kursni o'qish davomida yuzaga kelgan savollaringizni umumiy chatga yoki video darsni izoh qismlariga qoldirishingiz mumkun bo'ladi</p>
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


<!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="section-title text-center position-relative mb-5">
            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">O'qituvchilar</h6>
            <h1 class="display-4">O'qituvchilarimiz bilan tanishing</h1>
        </div>
        <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
            <div class="team-item">
                <img class="img-fluid w-100" src="img/team-1.jpg" alt="">
                <div class="bg-light text-center p-4">
                    <h5 class="mb-3">Instructor Name</h5>
                    <p class="mb-2">Ingliz tili o'qituvchisi</p>
                    <div class="d-flex justify-content-center">
                        <a class="mx-1 p-1" href="#"><i class="fab fa-telegram"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-item">
                <img class="img-fluid w-100" src="img/team-2.jpg" alt="">
                <div class="bg-light text-center p-4">
                    <h5 class="mb-3">Instructor Name</h5>
                    <p class="mb-2">IT o'qituvchi</p>
                    <div class="d-flex justify-content-center">
                        <a class="mx-1 p-1" href="#"><i class="fab fa-telegram"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-item">
                <img class="img-fluid w-100" src="img/team-3.jpg" alt="">
                <div class="bg-light text-center p-4">
                    <h5 class="mb-3">Instructor Name</h5>
                    <p class="mb-2">Matematika o'qituvchi</p>
                    <div class="d-flex justify-content-center">
                        <a class="mx-1 p-1" href="#"><i class="fab fa-telegram"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-item">
                <img class="img-fluid w-100" src="img/team-4.jpg" alt="">
                <div class="bg-light text-center p-4">
                    <h5 class="mb-3">Instructor Name</h5>
                    <p class="mb-2">Web Design & Development</p>
                    <div class="d-flex justify-content-center">
                        <a class="mx-1 p-1" href="#"><i class="fab fa-telegram"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="mx-1 p-1" href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->


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
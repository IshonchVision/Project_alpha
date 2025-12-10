@extends('layouts.app')

@section('content')


<!-- Header Start -->
<div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
    <div class="container text-center py-5">
        <h2 class="text-white display-1">Kurslar</h2>
        <div class="d-inline-flex text-white mb-5">
            <p class="m-0 text-uppercase"><a class="text-white" href="">Barcha</a></p>
            <i class="fa fa-angle-double-right pt-1 px-3"></i>
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
=======
<!-- Header Start -->
<div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('img/header-bg.jpg'); background-size: cover;">
    <div class="container text-center py-5">
        <h1 class="text-white display-1">Kurslar</h1>
        <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
            <div class="input-group">
                <input type="text" class="form-control border-light" style="padding: 30px 25px;" placeholder="Kurs nomi bo'yicha qidirish...">
                <div class="input-group-append">
                    <button class="btn btn-primary px-5">Qidirish</button>
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

<!-- Courses Start -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Bizning Kurslar</h6>
        <h1 class="display-4">Yangi va Eng Mashhur Kurslar</h1>
    </div>


<!-- Courses Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row mx-0 justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center position-relative mb-5">
                    <h1 class="display-4">Platformadagi mavjud barcha kurslar</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 pb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ url("detail") }}">
                    <img class="img-fluid" src="img/courses-1.jpg" alt="">
                    <div class="courses-text">
                        <h4 class="text-center text-white px-3">Web design & development courses for
                            beginners</h4>
                        <div class="border-top w-100 mt-3">
                            <div class="d-flex justify-content-between p-4">
                                <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                    <small>(250)</small></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ url("detail") }}">
                    <img class="img-fluid" src="img/courses-2.jpg" alt="">
                    <div class="courses-text">
                        <h4 class="text-center text-white px-3">Web design & development courses for
                            beginners</h4>
                        <div class="border-top w-100 mt-3">
                            <div class="d-flex justify-content-between p-4">
                                <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                    <small>(250)</small></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ url("detail") }}">
                    <img class="img-fluid" src="img/courses-3.jpg" alt="">
                    <div class="courses-text">
                        <h4 class="text-center text-white px-3">Web design & development courses for
                            beginners</h4>
                        <div class="border-top w-100 mt-3">
                            <div class="d-flex justify-content-between p-4">
                                <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                    <small>(250)</small></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ url("detail") }}">
                    <img class="img-fluid" src="img/courses-4.jpg" alt="">
                    <div class="courses-text">
                        <h4 class="text-center text-white px-3">Web design & development courses for
                            beginners</h4>
                        <div class="border-top w-100 mt-3">
                            <div class="d-flex justify-content-between p-4">
                                <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                    <small>(250)</small></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ url("detail") }}">
                    <img class="img-fluid" src="img/courses-5.jpg" alt="">
                    <div class="courses-text">
                        <h4 class="text-center text-white px-3">Web design & development courses for
                            beginners</h4>
                        <div class="border-top w-100 mt-3">
                            <div class="d-flex justify-content-between p-4">
                                <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                    <small>(250)</small></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 pb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{ url("detail") }}">
                    <img class="img-fluid" src="img/courses-6.jpg" alt="">
                    <div class="courses-text">
                        <h4 class="text-center text-white px-3">Web design & development courses for
                            beginners</h4>
                        <div class="border-top w-100 mt-3">
                            <div class="d-flex justify-content-between p-4">
                                <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                    <small>(250)</small></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg justify-content-center mb-0">
                        <li class="page-item disabled">
                            <a class="page-link rounded-0" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link rounded-0" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Courses End -->

<div class="container-fluid py-12">
    <div class="container py-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Online</h6>
                    <h1 class="display-4">Kursdan foydalanish yo'riqnomasi</h1>
    <div class="row">
        <!-- Kurs 1 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="course-card position-relative overflow-hidden rounded-lg shadow-lg">
                <img class="img-fluid w-100" src="img/courses-1.jpg" alt="Web Design">
                <div class="course-overlay">
                    <div class="course-info">
                        <h5 class="text-white">Web Design & Development</h5>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <span><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                            <span><i class="fa fa-star mr-2"></i>4.8 (250)</span>
                        </div>
                        <a href="{{ url('detail/1') }}" class="btn btn-light btn-sm">Batafsil</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kurs 2 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="course-card position-relative overflow-hidden rounded-lg shadow-lg">
                <img class="img-fluid w-100" src="img/courses-2.jpg" alt="Digital Marketing">
                <div class="course-overlay">
                    <div class="course-info">
                        <h5 class="text-white">Digital Marketing</h5>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <span><i class="fa fa-user mr-2"></i>Anna Smith</span>
                            <span><i class="fa fa-star mr-2"></i>4.9 (320)</span>
                        </div>
                        <a href="{{ url('detail/2') }}" class="btn btn-light btn-sm">Batafsil</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kurs 3 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="course-card position-relative overflow-hidden rounded-lg shadow-lg">
                <img class="img-fluid w-100" src="img/courses-3.jpg" alt="Graphic Design">
                <div class="course-overlay">
                    <div class="course-info">
                        <h5 class="text-white">Graphic Design Master</h5>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <span><i class="fa fa-user mr-2"></i>Mike Johnson</span>
                            <span><i class="fa fa-star mr-2"></i>4.7 (180)</span>
                        </div>
                        <a href="{{ url('detail/3') }}" class="btn btn-light btn-sm">Batafsil</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kurs 4 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="course-card position-relative overflow-hidden rounded-lg shadow-lg">
                <img class="img-fluid w-100" src="img/courses-4.jpg" alt="Mobile App">
                <div class="course-overlay">
                    <div class="course-info">
                        <h5 class="text-white">Mobile App Development</h5>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <span><i class="fa fa-user mr-2"></i>Sarah Lee</span>
                            <span><i class="fa fa-star mr-2"></i>4.9 (410)</span>
                        </div>
                        <a href="{{ url('detail/4') }}" class="btn btn-light btn-sm">Batafsil</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2-qator: Kurs 5-8 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="course-card position-relative overflow-hidden rounded-lg shadow-lg">
                <img class="img-fluid w-100" src="img/courses-5.jpg" alt="Python">
                <div class="course-overlay">
                    <div class="course-info">
                        <h5 class="text-white">Python Dasturlash</h5>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <span><i class="fa fa-user mr-2"></i>Alex Kim</span>
                            <span><i class="fa fa-star mr-2"></i>5.0 (520)</span>
                        </div>
                        <a href="{{ url('detail/5') }}" class="btn btn-light btn-sm">Batafsil</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="course-card position-relative overflow-hidden rounded-lg shadow-lg">
                <img class="img-fluid w-100" src="img/courses-6.jpg" alt="Data Science">
                <div class="course-overlay">
                    <div class="course-info">
                        <h5 class="text-white">Data Science & AI</h5>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <span><i class="fa fa-user mr-2"></i>Emma Watson</span>
                            <span><i class="fa fa-star mr-2"></i>4.8 (390)</span>
                        </div>
                        <a href="{{ url('detail/6') }}" class="btn btn-light btn-sm">Batafsil</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="course-card position-relative overflow-hidden rounded-lg shadow-lg">
                <img class="img-fluid w-100" src="img/courses-1.jpg" alt="UI/UX">
                <div class="course-overlay">
                    <div class="course-info">
                        <h5 class="text-white">UI/UX Design</h5>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <span><i class="fa fa-user mr-2"></i>David Brown</span>
                            <span><i class="fa fa-star mr-2"></i>4.6 (280)</span>
                        </div>
                        <a href="{{ url('detail/7') }}" class="btn btn-light btn-sm">Batafsil</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="course-card position-relative overflow-hidden rounded-lg shadow-lg">
                <img class="img-fluid w-100" src="img/courses-2.jpg" alt="English">
                <div class="course-overlay">
                    <div class="course-info">
                        <h5 class="text-white">Ingliz Tili (IELTS)</h5>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <span><i class="fa fa-user mr-2"></i>Gulnoza A.</span>
                            <span><i class="fa fa-star mr-2"></i>4.9 (610)</span>
                        </div>
                        <a href="{{ url('detail/8') }}" class="btn btn-light btn-sm">Batafsil</a>
                    </div>
                </div>
                <p>
                    Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et, tempor voluptua sit
                    consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum et lorem et sit,
                    sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata eirmod,
                    dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore. Amet erat amet et magna
                    voluptua sit consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum et
                    lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata
                    eirmod, dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
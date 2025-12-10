@extends('layouts.app')

@section('content')

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
            </div>
        </div>
    </div>
</div>
<!-- Courses End -->

<style>
.course-card {
    height: 350px;
    transition: all 0.4s ease;
    cursor: pointer;
}

.course-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2) !important;
}

.course-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 30px 20px 20px;
    transform: translateY(100%);
    transition: all 0.4s ease;
}

.course-card:hover .course-overlay {
    transform: translateY(0);
}

.course-info h5 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 15px;
}

.course-info .btn-light {
    background: rgba(255,255,255,0.9);
    color: #333;
    font-weight: 600;
}

.course-info .btn-light:hover {
    background: white;
    color: #007bff;
}
</style>

@endsection
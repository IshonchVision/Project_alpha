@extends('layouts.app')

@section('content')
    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h1 class="display-5">O'qituvchilarimiz bilan tanishing</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                <div class="team-item">
                    <img class="img-fluid w-100" src="img/talim.png" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">Manzura G'ayratova</h5>
                        <p class="mb-2">Ta'lim nazariyasi o'qituvchisi</p>
                    </div>
                </div>
                <div class="team-item">
                    <img class="img-fluid w-100" src="img/anvar.png" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">Anvar Narzullayev</h5>
                        <p class="mb-2">IT mutaxasisi</p>
                    </div>
                </div>
                <div class="team-item">
                    <img class="img-fluid w-100" src="img/rustam.png" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">Rustam Qoriyev</h5>
                        <p class="mb-2">Ingliz tili o'qituvchisi</p>
                    </div>
                </div>
                <div class="team-item">
                    <img class="img-fluid w-100" src="img/suhrob.png" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">Suxrob Nurali</h5>
                        <p class="mb-2">Php Senior dasturchi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection

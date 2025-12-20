@extends('layouts.app')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid py-3 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-secondary text-uppercase mb-2">Online ta'lim</h6>
                <h1 class="display-4">Biz bilan bog'laning</h1>
            </div>
            <div class="row align-items-stretch">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="bg-white shadow-sm rounded h-100 p-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mr-4"
                                style="width: 60px; height: 60px; flex-shrink: 0;">
                                <i class="fa fa-2x fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-dark mb-1">Bizning manzil</h4>
                                <p class="m-0 text-muted">Uzbekistan, Toshkent</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="rounded-circle bg-success d-flex align-items-center justify-content-center mr-4"
                                style="width: 60px; height: 60px; flex-shrink: 0;">
                                <i class="fa fa-2x fa-phone-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-dark mb-1">Telefon raqamlar</h4>
                                <p class="m-0 text-muted">+998 90 123 45 67</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center mr-4"
                                style="width: 60px; height: 60px; flex-shrink: 0;">
                                <i class="fa fa-2x fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-dark mb-1">Email</h4>
                                <p class="m-0 text-muted">onlinetalim@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="bg-white shadow-sm rounded h-100 p-5">
                        <form action="{{ route('contact.message.send') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control border rounded px-4 py-3 shadow-sm"
                                        placeholder="fullname" name="name" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="email" class="form-control border rounded px-4 py-3 shadow-sm"
                                        placeholder="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control border rounded px-4 py-3 shadow-sm"
                                    placeholder="theme" name="subject" required>
                            </div>
                            <div class="form-group mb-4">
                                <textarea class="form-control border rounded px-4 py-3 shadow-sm resize-none" rows="6" placeholder="message"
                                    name="message" required></textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary btn-lg px-3 py-2 rounded-pill shadow" type="submit">
                                    Yuborish
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

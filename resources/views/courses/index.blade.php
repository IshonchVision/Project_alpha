@extends('layouts.app')
@section('title', 'Kurslar')

@section('content')
<h2>Ta'lim Nazariyasi Kursi</h2>
<div class="row">
    @for($i = 1; $i <= 10; $i++)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Modul {{ $i }}: {{ ['Kirish', 'Tarixiy rivojlanish', 'Biheviorizm', 'Kognitivizm', 'Motivatsiya', 'Raqamli ta\'lim', 'Baholash', 'Interfaol usullar', 'XXI asr ko\'nikmalari', 'Yakuniy loyiha'][$i-1] }}</h5>
                <p class="text-muted flex-grow-1">Qisqa tavsif...</p>
                <div class="mt-auto">
                    <div class="progress mb-2">
                        <div class="progress-bar {{ $i <= 9 ? 'bg-success' : 'bg-warning' }}" style="width: {{ $i <= 9 ? 100 : 60 }}%"></div>
                    </div>
                    <a href="/courses/{{ $i }}" class="btn btn-primary btn-sm w-100">
                        {{ $i <= 9 ? 'Davom etish' : 'Yakunlash' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endfor
</div>
@endsection
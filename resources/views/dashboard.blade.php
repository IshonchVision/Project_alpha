@extends('layouts.app')
@section('title', 'Dashboard')

@section('sidebar')
<h5 class="px-3 mb-3">Menyu</h5>
<ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link active" href="/dashboard"><i class="fas fa-home"></i> Bosh sahifa</a></li>
    <li class="nav-item"><a class="nav-link" href="/courses"><i class="fas fa-book"></i> Kurslar</a></li>
    <li class="nav-item"><a class="nav-link" href="/portfolio"><i class="fas fa-briefcase"></i> Portfolio</a></li>
    <li class="nav-item"><a class="nav-link" href="/forum"><i class="fas fa-comments"></i> Forum</a></li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <h2>Xush kelibsiz, {{ auth()->check() ? auth()->user()->name : 'Mehmon' }}!</h2>
        <p class="text-muted">Sizning o'quv jarayoningiz statistikasi</p>
    </div>

    <!-- Statistik kartalar -->
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5>10 / 10</h5>
                <p>Tugatilgan modullar</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5>92%</h5>
                <p>Umumiy muvaffaqiyat</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5>8</h5>
                <p>Refleksiya topshirilgan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5>1</h5>
                <p>Sertifikat olingan</p>
            </div>
        </div>
    </div>

    <!-- Progress -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5>Kurs progressi</h5>
                <div class="progress mb-3">
                    <div class="progress-bar bg-success" style="width: 92%">92%</div>
                </div>
                <canvas id="progressChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    new Chart(document.getElementById('progressChart'), {
        type: 'doughnut',
        data: {
            labels: ['Tugatilgan', 'Qolgan'],
            datasets: [{
                data: [92, 8],
                backgroundColor: ['#198754', '#e9ecef']
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection
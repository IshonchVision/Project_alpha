@extends('layouts.app')
@section('title', 'Elektron Portfolio')

@section('content')
<h2>Mening Elektron Portfoliom</h2>

<div class="card mb-4">
    <div class="card-body text-center">
        <h4>Sertifikat</h4>
        <img src="https://via.placeholder.com/800x600/198754/ffffff?text=SERTIFIKAT" class="img-fluid rounded">
        <br><br>
        <a href="#" class="btn btn-success">PDF yuklab olish</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Eng yaxshi refleksiyalar</h5>
                <ul class="list-group">
                    <li class="list-group-item">Modul 3: Biheviorizm haqida mulohaza</li>
                    <li class="list-group-item">Modul 7: Baholash tizimi</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Statistika</h5>
                <canvas id="portfolioChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    new Chart(document.getElementById('portfolioChart'), {
        type: 'radar',
        data: {
            labels: ['Nazariy bilim', 'Refleksiya', 'Faollik', 'Testlar', 'Loyiha'],
            datasets: [{ label: 'Sizning natijangiz', data: [90, 95, 85, 88, 92], backgroundColor: 'rgba(13,110,253,0.2)', borderColor: '#0d6efd' }]
        }
    });
</script>
@endsection
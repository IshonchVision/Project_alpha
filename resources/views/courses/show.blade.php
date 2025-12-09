@extends('layouts.app')
@section('title', 'Modul 3: Biheviorizm')

@section('content')
<h2>Modul 3: Biheviorizm nazariyasi</h2>

<!-- Video -->
<div class="card mb-4">
    <div class="card-body">
        <h5>Video dars</h5>
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
        </div>
    </div>
</div>

<!-- Test -->
<div class="card mb-4">
    <div class="card-body">
        <h5>Test (10 savol)</h5>
        <form>
            <div class="mb-3">
                <label>1. Biheviorizmning asosiy tamoyili nima?</label>
                <div class="form-check"><input class="form-check-input" type="radio" name="q1"><label>O'rganish — bu javob-reaksiya</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q1"><label>O'rganish — ichki jarayon</label></div>
            </div>
            <button type="submit" class="btn btn-success">Testni yakunlash</button>
        </form>
    </div>
</div>

<!-- Refleksiya -->
<div class="card">
    <div class="card-body">
        <h5>Reflektiv topshiriq</h5>
        <p>Biheviorizmni zamonaviy maktabda qanday qo'llash mumkin?</p>
        <textarea class="form-control" rows="6" placeholder="Fikringizni yozing..."></textarea>
        <div class="mt-3">
            <input type="file" class="form-control mb-2">
            <button class="btn btn-primary">Topshirish</button>
        </div>
    </div>
</div>
@endsection
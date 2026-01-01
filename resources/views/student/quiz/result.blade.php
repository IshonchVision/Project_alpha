@extends('student.layout')

@section('title', 'Test Natijasi')
@section('page-title', 'Test Natijasi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg text-center border-0">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <h3 class="mb-0">{{ $quiz->title }} — Natija</h3>
                </div>
                <div class="card-body py-5">
                    <div class="mb-4">
                        <h1 class="display-1 fw-bold {{ $passed ? 'text-success' : 'text-danger' }}">
                            {{ round($percentage) }}%
                        </h1>
                        <p class="lead fs-3 {{ $passed ? 'text-success' : 'text-danger' }}">
                            <i class="fas fa-{{ $passed ? 'check-circle' : 'times-circle' }}"></i>
                            {{ $passed ? 'Tabriklaymiz! Muvaffaqiyatli o\'tdingiz!' : 'Afsuski, o\'ta olmadingiz. Yana urinib ko\'ring.' }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="fs-5 text-muted">
                            To'plangan ball: <strong>{{ $score }}</strong> / {{ $totalPoints }}
                        </p>
                        <p class="text-muted">
                            Kerakli o'tish balli: {{ $quiz->passing_score_percentage }}%
                        </p>
                    </div>

                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('student.courses.show', $quiz->course_id) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-book"></i> Kursga qaytish
                        </a>
                        <a href="{{ route('student.quiz.take', $quiz->id) }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-redo"></i> Qayta yechish
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
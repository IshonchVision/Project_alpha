@extends('student.layout')

@section('title', $quiz->title)
@section('page-title', $quiz->title)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $quiz->title }}</h4>
            <p class="mb-0 mt-2">
                <strong>Vaqt cheklovi:</strong> {{ $quiz->time_limit_minutes ?? 'Cheklanmagan' }} daqiqa |
                <strong>O'tish balli:</strong> {{ $quiz->passing_score_percentage }}%
            </p>
        </div>
        <div class="card-body">
            <form action="{{ route('student.quiz.submit', $quiz->id) }}" method="POST">
                @csrf

                @foreach($quiz->questions as $index => $question)
                    <div class="mb-5 p-4 border rounded bg-light">
                        <h5 class="mb-3">
                            {{ $index + 1 }}. {{ $question->question }}
                        </h5>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="a_{{ $question->id }}" value="a" required>
                            <label class="form-check-label" for="a_{{ $question->id }}">
                                A) {{ $question->option_a }}
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="b_{{ $question->id }}" value="b">
                            <label class="form-check-label" for="b_{{ $question->id }}">
                                B) {{ $question->option_b }}
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="c_{{ $question->id }}" value="c">
                            <label class="form-check-label" for="c_{{ $question->id }}">
                                C) {{ $question->option_c }}
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="d_{{ $question->id }}" value="d">
                            <label class="form-check-label" for="d_{{ $question->id }}">
                                D) {{ $question->option_d }}
                            </label>
                        </div>
                    </div>
                @endforeach

                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        <i class="fas fa-paper-plane"></i> Testni yuborish
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
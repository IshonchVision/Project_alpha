@extends('teacher.layout')

@section('title', 'Yangi Quiz Qo\'shish')
@section('page-title', 'Quiz Qo\'shish')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4><i class="fas fa-clipboard-check me-2"></i> "{{ $course->title }}" kursiga yangi quiz qo'shish</h4>
        <a href="{{ route('teacher.courses') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Orqaga
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success rounded-3 mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger rounded-3 mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('teacher.quizzes.store', $course->id) }}" method="POST">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">

            <div class="form-group mb-4">
                <label class="fw-bold">Test Nomi *</label>
                <input type="text" name="title" class="form-control" placeholder="Masalan: Grammatika Test 1" required>
            </div>

            <div class="form-group mb-4">
                <label>Tavsif (ixtiyoriy)</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Test haqida qisqacha ma'lumot..."></textarea>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Vaqt cheklovi (daqiqa, ixtiyoriy)</label>
                        <input type="number" name="time_limit_minutes" class="form-control" min="1" placeholder="30">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>O'tish foizi *</label>
                        <input type="number" name="passing_score_percentage" class="form-control" value="70" min="0" max="100" required>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <div id="questions-container">
                <!-- Birinchi savol -->
                <div class="question-block p-4 border rounded-3 mb-4 bg-light">
                    <h5><i class="fas fa-question-circle"></i> Savol 1</h5>

                    <div class="form-group mt-3">
                        <label>Savol matni *</label>
                        <textarea name="questions[0][question]" class="form-control" rows="2" required></textarea>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>A variant *</label>
                            <input type="text" name="questions[0][option_a]" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>B variant *</label>
                            <input type="text" name="questions[0][option_b]" class="form-control" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>C variant *</label>
                            <input type="text" name="questions[0][option_c]" class="form-control" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>D variant *</label>
                            <input type="text" name="questions[0][option_d]" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>To'g'ri javob *</label>
                            <select name="questions[0][correct_answer]" class="form-control" required>
                                <option value="">Tanlang...</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Ball *</label>
                            <input type="number" name="questions[0][points]" class="form-control" value="1" min="1" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="add-question" class="btn btn-outline-primary mb-4">
                <i class="fas fa-plus"></i> Yana savol qo'shish
            </button>

            <div class="text-end">
                <a href="{{ route('teacher.courses') }}" class="btn btn-secondary me-3">Bekor qilish</a>
                <button type="submit" class="btn btn-success px-5">
                    <i class="fas fa-save"></i> Testni Saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let questionIndex = 1;
    document.getElementById('add-question').addEventListener('click', function () {
        const container = document.getElementById('questions-container');
        const block = container.querySelector('.question-block').cloneNode(true);

        block.querySelector('h5').innerHTML = `<i class="fas fa-question-circle"></i> Savol ${questionIndex + 1}`;
        block.querySelectorAll('input, textarea, select').forEach(input => {
            input.value = '';
            if (input.name) {
                input.name = input.name.replace(/\[\d+\]/, `[${questionIndex}]`);
            }
        });

        container.appendChild(block);
        questionIndex++;
    });
</script>
@endsection
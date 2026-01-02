@extends('student.layout')

@section('title', $course->title)
@section('page-title', $course->title)

@section('content')
<div class="container-fluid py-4">

    <!-- Kurs haqida -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-start">
            <div>
                <h3 class="mb-1">{{ $course->title }}</h3>
                <p class="text-muted mb-0"><i class="fas fa-chalkboard-teacher"></i> O'qituvchi: {{ $course->user->name }}</p>
            </div>
            
        </div>
        <div class="card-body">
            <p class="lead">{{ $course->description }}</p>

            
        </div>
    </div>

    <!-- Darslar ro'yxati -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h4 class="mb-0">Darslar ({{ $course->videos_count }} ta)</h4>
        </div>
        <div class="card-body p-0">
            @forelse($course->videos as $index => $video)
                <div class="p-4 border-bottom hover-bg-light d-flex gap-4 align-items-center">
                    <div class="position-relative flex-shrink-0" style="width: 280px;">
                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=400"
                             class="rounded img-fluid"
                             style="height: 160px; object-fit: cover;">
                        <div class="position-absolute top-50 start-50 translate-middle text-white" style="font-size: 48px;">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>

                    <div class="flex-grow-1">
                        <h5 class="mb-2">{{ $video->title ?? 'Dars ' . ($index + 1) }}</h5>
                        <p class="text-muted mb-3">{{ $video->description ?? 'Tavsif mavjud emas.' }}</p>

                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <a href="{{ $video->signed_url }}"
                               target="_blank"
                               class="btn btn-primary"
                               data-bs-toggle="modal"
                               data-bs-target="#lessonModal"
                               data-video-url="{{ $video->signed_url }}"
                               data-video-title="{{ $video->title ?? 'Dars ' . ($index + 1) }}">
                                <i class="fas fa-play"></i> Ko'rish
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-5 text-center text-muted">
                    <i class="fas fa-video fa-3x mb-3"></i>
                    <p>Hozircha bu kursda video darslar yo'q.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Agar theory bo'lsa, testlar bo'limi (videolar tagida) -->
    @if($course->course_type === 'theory' && $course->quizzes_count > 0)
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Testlar ({{ $course->quizzes_count }} ta)</h4>
            </div>
            <div class="card-body p-0">
                @forelse($course->quizzes as $quiz)
                    <div class="p-4 border-bottom hover-bg-light d-flex gap-4 align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-2">{{ $quiz->title }}</h5>
                            <p class="text-muted mb-3">{{ $quiz->description ?? 'Tavsif mavjud emas.' }}</p>
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <a href="{{ route('student.quiz.take', $quiz->id) }}" class="btn btn-success">
                                    <i class="fas fa-pencil-alt"></i> Test yechish
                                </a>
                                <span class="text-muted"><i class="fas fa-clock"></i> {{ $quiz->time_limit_minutes ?? 'Cheklanmagan' }} daqiqa</span>
                                <span class="text-muted"><i class="fas fa-check"></i> O'tish balli: {{ $quiz->passing_score_percentage }}%</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-5 text-center text-muted">
                        <i class="fas fa-question-circle fa-3x mb-3"></i>
                        <p>Hozircha bu kursda testlar yo'q.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif

</div>

<!-- Video modal (avvalgidek) -->
<div class="modal fade" id="lessonModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lessonModalTitle">Dars</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <video id="lessonVideoPlayer" class="w-100" style="height: 70vh;" controls autoplay>
                    <source src="#" type="video/mp4">
                    Brauzeringiz video qo'llab-quvvatlamaydi.
                </video>
            </div>
        </div>
    </div>
</div>

<script>
    const lessonModal = document.getElementById('lessonModal');
    lessonModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-video-url');
        const title = button.getAttribute('data-video-title');

        document.getElementById('lessonModalTitle').textContent = title;
        const video = document.getElementById('lessonVideoPlayer');
        video.querySelector('source').src = url;
        video.load();
    });

    lessonModal.addEventListener('hidden.bs.modal', function () {
        const video = document.getElementById('lessonVideoPlayer');
        video.pause();
        video.querySelector('source').src = '#';
        video.load();
    });
</script>
@endsection
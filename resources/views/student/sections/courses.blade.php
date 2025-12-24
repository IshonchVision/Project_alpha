@extends('student.layout')

@section('title', 'Mening Kurslarim')
@section('page-title', 'Mening Kurslarim')

@section('content')
<div class="row">
    @forelse ($enrolledCourses as $course)
        <div class="col-lg-4 col-md-6 mb-4">
            <a href="{{ route('student.courses.show', $course->id) }}" class="course-link text-decoration-none">
                <div class="course-item bg-white rounded-3 overflow-hidden shadow-sm h-100 d-flex flex-column">
                    
                    <!-- Yangi: Kurs videolari ro'yxati (thumbnail oldida) -->
                    <div class="p-3 bg-light border-bottom">
                        <h6 class="mb-2 fw-bold">Kurs darslari ({{ $course->videos_count }} ta)</h6>
                        <ul class="list-unstyled mb-0 small">
                            @foreach($course->videos->take(5) as $video) <!-- Faqat 5 tasini ko'rsatamiz -->
                                <li class="d-flex justify-content-between align-items-center mb-1">
                                    <span>{{ Str::limit($video->title ?? 'Dars ' . $video->id, 30) }}</span>
                                    <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#videoModal{{ $course->id }}-{{ $video->id }}"
                                            onclick="loadVideo('{{ $video->signed_url ?? '#' }}')">
                                        <i class="fas fa-play"></i> Ko'rish
                                    </button>
                 `               </li>
                            @endforeach
                            @if($course->videos_count > 5)
                                <li class="text-muted small">... va yana {{ $course->videos_count - 5 }} ta</li>
                            @endif
                        </ul>
                    </div>

                    <!-- Thumbnail -->
                    <div class="course-thumbnail position-relative">
                        @php
                            $imageUrl = $course->img 
                                ? (config('filesystems.default') === 's3' 
                                    ? \Storage::disk('s3')->url($course->img)
                                    : asset('storage/' . $course->img))
                                : 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=800&q=80';
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $course->title }}" class="w-100" style="height: 200px; object-fit: cover;">
                        <div class="course-duration position-absolute bottom-0 end-0 bg-dark bg-opacity-75 text-white px-3 py-1 rounded-start">
                            <i class="fas fa-clock"></i> {{ $course->duration_hours ?? 'Noma\'lum' }} soat
                        </div>
                    </div>

                    <div class="p-4 flex-grow-1 d-flex flex-column">
                        <h5 class="fw-bold mb-2" style="font-size: 19px; color: #1e293b;">
                            {{ Str::limit($course->title, 50) }}
                        </h5>
                        <p class="text-muted mb-3">
                            <i class="fas fa-chalkboard-teacher text-primary"></i>
                            O'qituvchi: {{ $course->user->name ?? 'O\'qituvchi' }}
                        </p>

                        <div class="d-flex justify-content-between text-muted small mb-3">
                            <span><i class="fas fa-video text-primary"></i> {{ $course->videos_count }} ta dars</span>
                            <span><i class="fas fa-star text-warning"></i> 4.9</span>
                        </div>

                        <!-- Progress bar -->
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">Jarayon</small>
                                <small class="text-primary fw-bold">{{ $course->progress }}%</small>
                            </div>
                            <div class="progress bg-light" style="height: 8px; border-radius: 10px;">
                                <div class="progress-bar bg-gradient-primary" role="progressbar"
                                     style="width: {{ $course->progress }}%; background: linear-gradient(90deg, #3b82f6, #2563eb);"
                                     aria-valuenow="{{ $course->progress }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Modal for video playback -->
        @foreach($course->videos as $video)
            <div class="modal fade" id="videoModal{{ $course->id }}-{{ $video->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $video->title ?? 'Video' }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <video id="courseVideoPlayer" class="w-100" style="height: 500px;" controls autoplay>
                                <source src="#" type="video/mp4">
                                Brauzeringiz video ni qo'llab-quvvatlamaydi.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-book-open fa-4x text-muted mb-4"></i>
            <h4 class="text-muted">Hozircha hech qanday kursga ro'yxatdan o'tmagansiz</h4>
            <a href="{{ route('courses') }}" class="btn btn-primary mt-3">Kurslarni ko'rish</a>
        </div>
    @endforelse
</div>

<!-- JS for loading video into modal -->
<script>
    function loadVideo(url) {
        document.querySelector('#courseVideoPlayer source').src = url;
        document.querySelector('#courseVideoPlayer').load();
    }
</script>

<style>
.course-link {
    color: inherit;
    text-decoration: none;
    display: block;
    transition: transform 0.3s ease;
}
.course-link:hover {
    transform: translateY(-8px);
}
.course-link:hover .course-item {
    box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
}
.progress {
    background-color: #e2e8f0;
}
</style>
@endsection
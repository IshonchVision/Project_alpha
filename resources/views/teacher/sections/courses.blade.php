@extends('teacher.layout')

@section('title', 'Kurslar')
@section('page-title', 'Mening Kurslarim')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Kurslar</h4>
        <button class="btn-primary" onclick="document.getElementById('addCourseModal').style.display='flex'">
            <i class="fas fa-plus"></i> Yangi Kurs Qo'shish
        </button>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert" style="padding:12px 18px;border-radius:12px;background:#ecfccb;color:#365314;margin-bottom:18px;font-weight:700;">
            {{ session('success') }}
        </div>
        @endif
        @forelse($courses as $course)
        <div class="course-item" data-course-id="{{ $course->id }}">
            <div class="course-thumbnail">
                <img src="{{ $course->img ? asset('storage/' . $course->img) : 'https://via.placeholder.com/300x180' }}" alt="{{ $course->title }}">
                <div class="course-duration">
                    <i class="fas fa-clock"></i> {{ $course->duration_hours ?? '—' }} soat
                </div>
            </div>
            <div class="course-content">
                <div>
                    <h5 class="course-title">{{ $course->title }}</h5>
                    <p class="course-description">{{ Str::limit($course->description ?? '', 180) }}</p>
                    <div class="course-meta">
                        <span><i class="fas fa-video"></i> {{ $course->videos->count() }} video</span>
                        <span><i class="fas fa-users"></i> {{ $course->students()->count() }} o'quvchi</span>
                        <span><i class="fas fa-star"></i> {{ $course->rating ?? '-' }}</span>
                    </div>
                </div>
                <div class="course-actions">
                    <button class="btn-sm btn-info course-add-video-btn" data-id="{{ $course->id }}"
                        style="background: linear-gradient(135deg, #06b6d4, #0891b2);">
                        <i class="fas fa-video"></i> Video qo'shish
                    </button>
                    <form action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST"
                        style="display:inline" onsubmit="return confirm('Kursni o\'chirishni xohlaysizmi?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-sm btn-danger" type="submit">
                            <i class="fas fa-trash"></i> O'chirish
                        </button>
                    </form>
                </div>
                @if($course->videos->count())
                <div class="course-videos" style="margin-top:15px;">
                    @foreach($course->videos as $video)
                    <div class="video-row" style="display:flex;gap:12px;align-items:center;margin-top:12px;">
                        <video width="180" controls preload="metadata" style="border-radius:8px;overflow:hidden;">
                            <source src="{{ asset($video->video_url) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div style="flex:1;">
                            <strong>{{ $video->title }}</strong>
                            <p style="margin:6px 0;color:#64748b;">{{ Str::limit($video->description ?? '', 120) }}</p>
                            <div style="display:flex;gap:10px;align-items:center;">
                                <span style="color:#64748b;font-size:13px;"><i class="fas fa-clock"></i> {{ intdiv($video->duration_seconds,60) }} min</span>
                                @if($video->module && $video->module->quizzes && $video->module->quizzes->count())
                                <span style="color:#059669;font-weight:700;font-size:13px;">Quiz mavjud</span>
                                @endif
                                <form action="{{ route('teacher.videos.destroy', $video->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Videoni o\'chirishni xohlaysizmi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-sm btn-danger" type="submit">O'chirish</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="text-muted">Hozircha kurslaringiz mavjud emas.</div>
        @endforelse
    </div>
</div>

<!-- Yangi Kurs Qo'shish Modali -->
<div id="addCourseModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 600px; width: 95%;">
        <div class="modal-header">
            <h3>Yangi Kurs Qo'shish</h3>
            <button class="modal-close" onclick="document.getElementById('addCourseModal').style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="img"><i class="fas fa-image"></i> Kurs rasmini yuklash</label>
                    <input type="file" id="img" name="img" accept="image/*" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"><i class="fas fa-heading"></i> Kurs Nomi</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Masalan: Advanced English Grammar" required>
                </div>
                <div class="form-group">
                    <label for="description"><i class="fas fa-align-left"></i> Kurs Izohi (Tavsifi)</label>
                    <textarea id="description" name="description" class="form-control" rows="8"
                        placeholder="Bu kursda o'quvchilar nimalarni o'rganadi? Qisqacha va jozibali yozing..." required></textarea>
                </div>
                <div style="text-align: right; margin-top: 30px;">
                    <button type="button" class="btn-secondary" onclick="document.getElementById('addCourseModal').style.display='none'" style="margin-right: 15px;">
                        Bekor qilish
                    </button>
                    <button type="submit" class="btn-primary" style="padding: 14px 32px; font-size: 16px;">
                        <i class="fas fa-save"></i> Kursni Yaratish
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Yangi Video Qo'shish Modali (kursga video qo'shish uchun) -->
<div id="addVideoModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 700px; width: 95%;">
        <div class="modal-header">
            <h3><i class="fas fa-video"></i> Yangi Video Qo'shish</h3>
            <button class="modal-close" onclick="document.getElementById('addVideoModal').style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="addVideoForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="video_course_id" name="course_id" value="{{ old('course_id') ?? '' }}">
                @if($errors->any() && old('course_id'))
                <div class="alert" style="background:#fee2e2;color:#7f1d1d;padding:12px 16px;border-radius:10px;margin-bottom:18px;font-weight:700;">
                    <ul style="margin:0;padding-left:18px;font-weight:600;">
                        @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-group">
                    <label for="video_title"><i class="fas fa-heading"></i> Video Sarlavhasi</label>
                    <input type="text" id="video_title" name="title" class="form-control"
                        placeholder="Masalan: Lesson 1 - Present Simple Tense" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="video_description"><i class="fas fa-align-left"></i> Video Izohi (Tavsifi)</label>
                    <textarea id="video_description" name="description" class="form-control" rows="6"
                        placeholder="Bu videoda nimalar tushuntiriladi? Qisqacha izoh bering..." required>{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="video_file"><i class="fas fa-file-video"></i> Video Fayl Yuklash</label>
                    <input type="file" id="video_file" name="video" accept="video/*"
                        class="form-control" required>
                    <small style="color: #64748b; display: block; margin-top: 8px;">
                        Faqat video fayllar. Maksimal hajm: 500MB
                    </small>
                </div>
                <div class="form-group">
                    <label for="duration"><i class="fas fa-clock"></i> Davomiyligi (daqiqa)</label>
                    <input type="number" id="duration" name="duration_minutes" class="form-control"
                        placeholder="Masalan: 45" min="1" value="{{ old('duration_minutes') }}" required>
                </div>

                <div style="margin-top:10px;">
                    <label style="display:flex;gap:10px;align-items:center;font-weight:700;">
                        <input type="checkbox" id="add_quiz_toggle" name="add_quiz" {{ old('quiz_title') ? 'checked' : '' }}>
                        <span>Quiz qo'shish (ixtiyoriy)</span>
                    </label>
                </div>

                <div id="quiz_fields" style="display: {{ old('quiz_title') ? 'block' : 'none' }}; margin-top:14px; border-radius:10px; padding:12px; background:#fbfbfb;">
                    <div class="form-group">
                        <label for="quiz_title"><i class="fas fa-question-circle"></i> Quiz Sarlavhasi</label>
                        <input type="text" id="quiz_title" name="quiz_title" class="form-control" placeholder="Masalan: Quiz - Dars 1" value="{{ old('quiz_title') }}">
                    </div>
                    <div class="form-group" style="display:flex;gap:10px;">
                        <input type="number" id="quiz_time_limit" name="quiz_time_limit" class="form-control" placeholder="Vaqt (daqiqa)" value="{{ old('quiz_time_limit') }}">
                        <input type="number" id="quiz_attempts" name="quiz_attempts" class="form-control" placeholder="Urinishlar" value="{{ old('quiz_attempts') ?? 1 }}">
                        <input type="number" id="quiz_passing" name="quiz_passing" class="form-control" placeholder="O'tish foizi" min="0" max="100" value="{{ old('quiz_passing') ?? 70 }}">
                    </div>
                    <div class="form-group">
                        <label for="quiz_answare"><i class="fas fa-list"></i> Savollar va javoblar (JSON yoki matn)</label>
                        <textarea id="quiz_answare" name="quiz_answare" class="form-control" rows="4" placeholder='Masalan: [{"q":"1+1?","a":"2"}]'>{{ old('quiz_answare') }}</textarea>
                    </div>
                </div>
                <div style="text-align: right; margin-top: 30px;">
                    <button type="button" class="btn-secondary"
                        onclick="document.getElementById('addVideoModal').style.display='none'"
                        style="margin-right: 15px;">
                        Bekor qilish
                    </button>
                    <button type="submit" class="btn-primary" style="padding: 14px 32px; font-size: 16px; background: linear-gradient(135deg, #10b981, #059669);">
                        <i class="fas fa-upload"></i> Video Yuklash
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    #addVideoModal .btn-primary { background: linear-gradient(135deg, #10b981, #059669) !important; }
    #addVideoModal .btn-primary:hover { background: linear-gradient(135deg, #059669, #047857) !important; }

    .course-item { display: flex; gap: 25px; padding: 25px; background: #f8fafc; border-radius: 18px; margin-bottom: 25px; border: 2px solid transparent; transition: all 0.3s; }
    .course-item:hover { border-color: var(--primary); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); }
    .course-thumbnail { position: relative; width: 300px; height: 180px; border-radius: 14px; overflow: hidden; flex-shrink: 0; }
    .course-thumbnail img { width: 100%; height: 100%; object-fit: cover; }
    .course-duration { position: absolute; bottom: 10px; right: 10px; background: rgba(0, 0, 0, 0.8); color: white; padding: 6px 12px; border-radius: 8px; font-size: 13px; font-weight: 700; }
    .course-content { flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
    .course-title { font-size: 22px; font-weight: 800; margin: 0 0 10px 0; }
    .course-description { color: #64748b; margin: 0 0 15px 0; line-height: 1.6; }
    .course-meta { display: flex; gap: 20px; margin-bottom: 15px; }
    .course-meta span { color: #64748b; font-size: 14px; }
    .course-meta i { color: var(--primary); margin-right: 5px; }
    .course-actions { display: flex; gap: 10px; flex-wrap: wrap; }
    .btn-sm { padding: 10px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; }
    .btn-info { background: linear-gradient(135deg, #06b6d4, #0891b2); color: white; }
    .btn-danger { background: linear-gradient(135deg, var(--danger), #dc2626); color: white; }
    .btn-sm:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); }

    .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.7); display: flex; align-items: center; justify-content: center; z-index: 9999; padding: 20px; }
    .modal-content { background: white; border-radius: 24px; max-height: 90vh; overflow-y: auto; }
    .modal-header { padding: 30px 35px; border-bottom: 2px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .modal-close { width: 40px; height: 40px; border: none; background: #f1f5f9; border-radius: 10px; cursor: pointer; font-size: 18px; color: #64748b; }
    .modal-close:hover { background: #e2e8f0; color: var(--danger); }
    .modal-body { padding: 35px; }
    .form-group { margin-bottom: 25px; }
    .form-group label { display: block; margin-bottom: 10px; font-weight: 600; color: var(--dark); font-size: 15px; }
    .form-control { width: 100%; padding: 14px 16px; border: 2px solid #e2e8f0; border-radius: 14px; font-size: 15px; background: #f8fafc; transition: all 0.3s; }
    .form-control:focus { outline: none; border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15); }
    .btn-secondary { background: #e2e8f0; color: #475569; border: none; padding: 12px 25px; border-radius: 12px; cursor: pointer; font-weight: 600; }
    .btn-secondary:hover { background: #cbd5e1; }
</style>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Har bir kurs uchun "Video qo'shish" tugmasi
        document.querySelectorAll('.course-add-video-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const courseId = btn.getAttribute('data-id');
                const form = document.getElementById('addVideoForm');
                form.reset();
                // ensure file input cleared
                document.getElementById('video_file').value = '';
                form.action = `/teacher/courses/${courseId}/videos`;
                // set hidden course id so validation can restore
                const hid = document.getElementById('video_course_id'); if (hid) hid.value = courseId;
                document.getElementById('addVideoModal').style.display = 'flex';
            });
        });
        // Quiz toggle behavior
        const quizToggle = document.getElementById('add_quiz_toggle');
        const quizFields = document.getElementById('quiz_fields');
        if (quizToggle && quizFields) {
            quizToggle.addEventListener('change', function () {
                quizFields.style.display = this.checked ? 'block' : 'none';
            });
        }

        // If server returned validation errors for a specific course, reopen modal
        @if(old('course_id'))
        (function(){
            const cId = {{ old('course_id') }};
            const form = document.getElementById('addVideoForm');
            if (form) {
                form.action = `/teacher/courses/${cId}/videos`;
                const hid = document.getElementById('video_course_id'); if (hid) hid.value = cId;
                document.getElementById('addVideoModal').style.display = 'flex';
            }
        })();
        @endif
    });
</script>
@endsection
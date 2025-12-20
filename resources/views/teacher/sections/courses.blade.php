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
                @if($course->course_type === 'theory')
                <div class="course-type-badge">
                    <i class="fas fa-book"></i> Nazariya
                </div>
                @endif
            </div>
            <div class="course-content">
                <div>
                    <h5 class="course-title">{{ $course->title }}</h5>
                    <p class="course-description">{{ Str::limit($course->description ?? '', 180) }}</p>
                    <div class="course-meta">
                        <span><i class="fas fa-video"></i> {{ $course->videos->count() }} video</span>
                        <span><i class="fas fa-users"></i> {{ $course->students()->count() }} o'quvchi</span>
                        <span><i class="fas fa-star"></i> {{ $course->rating ?? '-' }}</span>
                        @if($course->quizzes)
                        <span><i class="fas fa-clipboard-check"></i> {{ $course->quizzes->count() }} test</span>
                        @endif
                    </div>
                </div>
                <div class="course-actions">
                    @if($course->course_type === 'theory')
                    <button class="btn-sm btn-quiz open-quiz-modal" data-course-id="{{ $course->id }}" type="button">
                        <i class="fas fa-clipboard-check"></i> Quiz/Test
                    </button>
                    @else
                    <button
                        type="button"
                        class="btn-sm btn-info"
                        onclick="openAddVideoModal({{ $course->id }})">
                        <i class="fas fa-video"></i> Video qo'shish
                    </button>
                    @endif
                    <form action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST"
                        style="display:inline" onsubmit="return confirm('Kursni o\'chirishni xohlaysizmi?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-sm btn-danger" type="submit">
                            <i class="fas fa-trash"></i> O'chirish
                        </button>
                    </form>
                </div>

                @if($course->course_type === 'theory' && $course->quizzes && $course->quizzes->count())
                <div class="course-quizzes" style="margin-top:15px;">
                    @foreach($course->quizzes as $quiz)
                    <div class="quiz-item" style="padding:15px;background:#f0f9ff;border-radius:12px;margin-top:10px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div>
                                <h6 style="margin:0 0 5px 0;font-weight:700;"><i class="fas fa-clipboard-check"></i> {{ $quiz->title }}</h6>
                                <p style="margin:0;color:#64748b;font-size:14px;">
                                    <i class="fas fa-question-circle"></i> {{ $quiz->questions->count() }} savol
                                    @if($quiz->time_limit_minutes)
                                    • <i class="fas fa-clock"></i> {{ $quiz->time_limit_minutes }} daqiqa
                                    @endif
                                    • <i class="fas fa-percent"></i> O'tish: {{ $quiz->passing_score_percentage }}%
                                </p>
                            </div>
                            <div style="display:flex;gap:8px;">
                                <button class="btn-sm btn-info edit-quiz-btn" data-quiz-id="{{ $quiz->id }}" type="button">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Testni o\'chirishni xohlaysizmi?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-sm btn-danger" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

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
            <button class="modal-close" onclick="closeModal('addCourseModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label><i class="fas fa-list"></i> Kurs Turi</label>
                    <div style="display:flex;gap:15px;margin-top:10px;">
                        <label class="radio-card">
                            <input type="radio" name="course_type" value="regular" checked>
                            <div class="radio-content">
                                <i class="fas fa-video" style="font-size:24px;color:#06b6d4;"></i>
                                <span style="font-weight:700;margin-top:8px;">Oddiy Kurs</span>
                                <small style="color:#64748b;">Video darslar</small>
                            </div>
                        </label>
                        <label class="radio-card">
                            <input type="radio" name="course_type" value="theory">
                            <div class="radio-content">
                                <i class="fas fa-book" style="font-size:24px;color:#8b5cf6;"></i>
                                <span style="font-weight:700;margin-top:8px;">Video va Nazariya</span>
                                <small style="color:#64748b;">Quiz va testlar</small>
                            </div>
                        </label>
                    </div>
                </div>
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
                    <button type="button" class="btn-secondary" onclick="closeModal('addCourseModal')" style="margin-right: 15px;">
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

<!-- Quiz/Test Qo'shish Modali -->
<div id="addQuizModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 800px; width: 95%;">
        <div class="modal-header">
            <h3><i class="fas fa-clipboard-check"></i> Yangi Quiz/Test Qo'shish</h3>
            <button class="modal-close" onclick="closeModal('addQuizModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="addQuizForm" action="{{ route('teacher.quizzes.store') }}" method="POST">
                @csrf
                <input type="hidden" id="quiz_course_id" name="course_id" value="">

                <div class="form-group">
                    <label for="quiz_title"><i class="fas fa-heading"></i> Test Nomi</label>
                    <input type="text" id="quiz_title" name="title" class="form-control" placeholder="Masalan: Grammatika Test 1" required>
                </div>

                <div class="form-group">
                    <label for="quiz_description"><i class="fas fa-align-left"></i> Tavsif (ixtiyoriy)</label>
                    <textarea id="quiz_description" name="description" class="form-control" rows="3" placeholder="Test haqida qisqacha ma'lumot..."></textarea>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;">
                    <div class="form-group">
                        <label for="time_limit"><i class="fas fa-clock"></i> Vaqt (daqiqa, ixtiyoriy)</label>
                        <input type="number" id="time_limit" name="time_limit_minutes" class="form-control" placeholder="30" min="1">
                    </div>
                    <div class="form-group">
                        <label for="passing_score"><i class="fas fa-percent"></i> O'tish foizi</label>
                        <input type="number" id="passing_score" name="passing_score_percentage" class="form-control" placeholder="70" value="70" min="0" max="100" required>
                    </div>
                </div>

                <hr style="margin:25px 0;border:none;border-top:2px solid #e2e8f0;">

                <div id="questions-container">
                    <div class="question-block" data-question-index="0">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;">
                            <h5 style="margin:0;"><i class="fas fa-question-circle"></i> Savol 1</h5>
                            <button type="button" class="btn-sm btn-danger remove-question" style="display:none;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <div class="form-group">
                            <label>Savol matni</label>
                            <textarea name="questions[0][question]" class="form-control" rows="2" placeholder="Savolingizni kiriting..." required></textarea>
                        </div>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                            <div class="form-group">
                                <label><i class="fas fa-circle" style="color:#3b82f6;"></i> A variant</label>
                                <input type="text" name="questions[0][option_a]" class="form-control" placeholder="A variant" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-circle" style="color:#10b981;"></i> B variant</label>
                                <input type="text" name="questions[0][option_b]" class="form-control" placeholder="B variant" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-circle" style="color:#f59e0b;"></i> C variant</label>
                                <input type="text" name="questions[0][option_c]" class="form-control" placeholder="C variant" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-circle" style="color:#ef4444;"></i> D variant</label>
                                <input type="text" name="questions[0][option_d]" class="form-control" placeholder="D variant" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-check-circle"></i> To'g'ri javob</label>
                            <select name="questions[0][correct_answer]" class="form-control" required>
                                <option value="">Tanlang...</option>
                                <option value="a">A variant</option>
                                <option value="b">B variant</option>
                                <option value="c">C variant</option>
                                <option value="d">D variant</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-star"></i> Ball</label>
                            <input type="number" name="questions[0][points]" class="form-control" value="1" min="1" required>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-question-btn" class="btn-secondary" style="width:100%;margin-top:15px;">
                    <i class="fas fa-plus"></i> Yana Savol Qo'shish
                </button>

                <div style="text-align: right; margin-top: 30px;">
                    <button type="button" class="btn-secondary" onclick="closeModal('addQuizModal')" style="margin-right: 15px;">
                        Bekor qilish
                    </button>
                    <button type="submit" class="btn-primary" style="padding: 14px 32px; font-size: 16px;">
                        <i class="fas fa-save"></i> Testni Saqlash
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Video Qo'shish Modali (TO'G'RI ISHLAYDIGAN) -->
<div id="addVideoModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 700px; width: 95%;">
        <div class="modal-header">
            <h3><i class="fas fa-video"></i> Yangi Video Qo'shish</h3>
            <button class="modal-close" onclick="closeModal('addVideoModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="addVideoForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="video_course_id" name="course_id" value="">

                <div class="form-group">
                    <label for="video_title"><i class="fas fa-heading"></i> Video Sarlavhasi</label>
                    <input type="text" id="video_title" name="title" class="form-control" placeholder="Masalan: Lesson 1 - Present Simple Tense" required>
                </div>
                <div class="form-group">
                    <label for="video_description"><i class="fas fa-align-left"></i> Video Izohi</label>
                    <textarea id="video_description" name="description" class="form-control" rows="6" placeholder="Bu videoda nimalar tushuntiriladi?" required></textarea>
                </div>
                <div class="form-group">
                    <label for="video_file"><i class="fas fa-file-video"></i> Video Fayl</label>
                    <input type="file" id="video_file" name="video" accept="video/*" class="form-control" required>
                    <small style="color: #64748b; display: block; margin-top: 8px;">
                        Faqat video fayllar. Maksimal hajm: 500MB
                    </small>
                </div>
                <div class="form-group">
                    <label for="duration"><i class="fas fa-clock"></i> Davomiyligi (daqiqa)</label>
                    <input type="number" id="duration" name="duration_minutes" class="form-control" placeholder="45" min="1" required>
                </div>

                <div style="text-align: right; margin-top: 30px;">
                    <button type="button" class="btn-secondary" onclick="closeModal('addVideoModal')" style="margin-right: 15px;">
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
    .course-type-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
    }

    .radio-card {
        flex: 1;
        cursor: pointer;
    }

    .radio-card input[type="radio"] {
        display: none;
    }

    .radio-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        background: #f8fafc;
        transition: all 0.3s;
    }

    .radio-card input[type="radio"]:checked+.radio-content {
        border-color: #8b5cf6;
        background: #f5f3ff;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
    }

    .btn-quiz {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed) !important;
        color: white;
    }

    .btn-quiz:hover {
        background: linear-gradient(135deg, #7c3aed, #6d28d9) !important;
    }

    .question-block {
        padding: 20px;
        background: #f8fafc;
        border-radius: 14px;
        margin-bottom: 20px;
        border: 2px solid #e2e8f0;
    }

    .course-item {
        display: flex;
        gap: 25px;
        padding: 25px;
        background: #f8fafc;
        border-radius: 18px;
        margin-bottom: 25px;
        border: 2px solid transparent;
        transition: all 0.3s;
    }

    .course-item:hover {
        border-color: #8b5cf6;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .course-thumbnail {
        position: relative;
        width: 300px;
        height: 180px;
        border-radius: 14px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .course-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .course-duration {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
    }

    .course-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .course-title {
        font-size: 22px;
        font-weight: 800;
        margin: 0 0 10px 0;
    }

    .course-description {
        color: #64748b;
        margin: 0 0 15px 0;
        line-height: 1.6;
    }

    .course-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .course-meta span {
        color: #64748b;
        font-size: 14px;
    }

    .course-meta i {
        color: #8b5cf6;
        margin-right: 5px;
    }

    .course-actions {
        position: relative;
        z-index: 9999;
    }


    .btn-sm {
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-info {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        color: white;
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    .btn-sm:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
    }

    .modal-content {
        background: white;
        border-radius: 24px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        padding: 30px 35px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-close {
        width: 40px;
        height: 40px;
        border: none;
        background: #f1f5f9;
        border-radius: 10px;
        cursor: pointer;
        font-size: 18px;
        color: #64748b;
    }

    .modal-close:hover {
        background: #e2e8f0;
        color: #ef4444;
    }

    .modal-body {
        padding: 35px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #1e293b;
        font-size: 15px;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        font-size: 15px;
        background: #f8fafc;
        transition: all 0.3s;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #8b5cf6;
        background: white;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #475569;
        border: none;
        padding: 12px 25px;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-secondary:hover {
        background: #cbd5e1;
    }

    .btn-primary {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
    }

    .course-actions {
        position: relative;
        z-index: 9999;
    }
</style>

@endsection

@section('scripts')
<script>
    // Modallarni yopish uchun universal funksiya
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.style.display = 'none';
    }

    // Overlayga bosganda yopish (barcha modallar uchun)
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-overlay')) {
            e.target.style.display = 'none';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // 1. VIDEO QO'SHISH MODALI — endi 100% ishlaydi
        document.querySelectorAll('.open-video-modal').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const courseId = this.getAttribute('data-course-id');
                const modal = document.getElementById('addVideoModal');
                const form = document.getElementById('addVideoForm');

                // Forma tozalash
                form.reset();

                // Action va hidden inputni to'ldirish
                form.action = `/teacher/courses/${courseId}/videos`;
                document.getElementById('video_course_id').value = courseId;

                // Modalni ochish
                modal.style.display = 'flex';
            });
        });

        // 2. QUIZ MODALI
        document.querySelectorAll('.open-quiz-modal').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const courseId = this.getAttribute('data-course-id');
                document.getElementById('quiz_course_id').value = courseId;
                document.getElementById('addQuizModal').style.display = 'flex';
            });
        });

        // 3. YANGI KURS MODALI (tugma bor joyda)
        document.querySelector('.btn-primary').addEventListener('click', function() {
            document.getElementById('addCourseModal').style.display = 'flex';
        });

        // 4. Savol qo'shish/o'chirish (quiz uchun)
        let questionIndex = 1;

        const addQuestionBtn = document.getElementById('add-question-btn');
        if (addQuestionBtn) {
            addQuestionBtn.addEventListener('click', function() {
                const container = document.getElementById('questions-container');
                const template = container.querySelector('.question-block');
                const newBlock = template.cloneNode(true);

                // Yangi savol raqami
                newBlock.querySelector('h5').innerHTML = `<i class="fas fa-question-circle"></i> Savol ${questionIndex + 1}`;
                newBlock.setAttribute('data-question-index', questionIndex);

                // Barcha maydonlarni tozalash va name ni yangilash
                newBlock.querySelectorAll('input, textarea, select').forEach(el => {
                    el.value = '';
                    if (el.name) {
                        el.name = el.name.replace(/\[\d+\]/, `[${questionIndex}]`);
                    }
                });

                // O'chirish tugmasini ko'rsatish
                newBlock.querySelector('.remove-question').style.display = 'inline-block';

                container.appendChild(newBlock);
                questionIndex++;

                // O'chirish tugmalarini yangilash
                bindRemoveButtons();
            });
        }

        // Savol o'chirish
        function bindRemoveButtons() {
            document.querySelectorAll('.remove-question').forEach(btn => {
                btn.onclick = function() {
                    if (document.querySelectorAll('.question-block').length > 1) {
                        this.closest('.question-block').remove();
                        updateQuestionNumbers();
                    } else {
                        alert("Kamida bitta savol bo'lishi kerak!");
                    }
                };
            });
        }

        function updateQuestionNumbers() {
            document.querySelectorAll('.question-block').forEach((block, idx) => {
                block.querySelector('h5').innerHTML = `<i class="fas fa-question-circle"></i> Savol ${idx + 1}`;
                block.querySelectorAll('input, textarea, select').forEach(el => {
                    if (el.name) {
                        el.name = el.name.replace(/\[\d+\]/, `[${idx}]`);
                    }
                });
            });
            questionIndex = document.querySelectorAll('.question-block').length;
        }

        // Boshida o'chirish tugmalarini faollashtirish
        bindRemoveButtons();
    });
</script>
@endsection

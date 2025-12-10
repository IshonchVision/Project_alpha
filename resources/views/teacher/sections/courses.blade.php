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
        <button class="btn-primary" style="background: linear-gradient(135deg, #10b981, #059669);"
            onclick="document.getElementById('addVideoModal').style.display='flex'">
            <i class="fas fa-video"></i> Yangi Video Qo'shish
        </button>
    </div>
    <div class="card-body">
        <!-- Kurs 1 -->
        <div class="course-item">
            <div class="course-thumbnail">
                <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=400" alt="Course">
                <div class="course-duration">
                    <i class="fas fa-clock"></i> 24 soat
                </div>
            </div>
            <div class="course-content">
                <div>
                    <h5 class="course-title">Advanced English Grammar</h5>
                    <p class="course-description">To'liq ingliz tili grammatikasi kursi. Present, Past, Future tenses, conditionals va boshqalar.</p>
                    <div class="course-meta">
                        <span><i class="fas fa-video"></i> 18 video</span>
                        <span><i class="fas fa-users"></i> 45 o'quvchi</span>
                        <span><i class="fas fa-star"></i> 4.8 (12 baho)</span>
                    </div>
                </div>
                <div class="course-actions">
                    <button class="btn-sm btn-info" onclick="showCourseDetails(1)"><i class="fas fa-eye"></i> Ko'rish</button>
                    <button class="btn-sm btn-info" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);"><i class="fas fa-edit"></i> Tahrirlash</button>
                    <button class="btn-sm btn-danger"><i class="fas fa-trash"></i> O'chirish</button>
                </div>
            </div>
        </div>

        <!-- Kurs 2 -->
        <div class="course-item">
            <div class="course-thumbnail">
                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400" alt="Course">
                <div class="course-duration">
                    <i class="fas fa-clock"></i> 16 soat
                </div>
            </div>
            <div class="course-content">
                <div>
                    <h5 class="course-title">IELTS Speaking Preparation</h5>
                    <p class="course-description">IELTS Speaking imtihoniga tayyorgarlik kursi. Part 1, 2, 3 uchun strategiyalar va amaliyotlar.</p>
                    <div class="course-meta">
                        <span><i class="fas fa-video"></i> 12 video</span>
                        <span><i class="fas fa-users"></i> 28 o'quvchi</span>
                        <span><i class="fas fa-star"></i> 4.9 (8 baho)</span>
                    </div>
                </div>
                <div class="course-actions">
                    <button class="btn-sm btn-info" onclick="showCourseDetails(2)"><i class="fas fa-eye"></i> Ko'rish</button>
                    <button class="btn-sm btn-info" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);"><i class="fas fa-edit"></i> Tahrirlash</button>
                    <button class="btn-sm btn-danger"><i class="fas fa-trash"></i> O'chirish</button>
                </div>
            </div>
        </div>

        <!-- Kurs 3 -->
        <div class="course-item">
            <div class="course-thumbnail">
                <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400" alt="Course">
                <div class="course-duration">
                    <i class="fas fa-clock"></i> 32 soat
                </div>
            </div>
            <div class="course-content">
                <div>
                    <h5 class="course-title">English for Beginners</h5>
                    <p class="course-description">Boshlovchilar uchun ingliz tili kursi. Alphabet, basic vocabulary, simple sentences.</p>
                    <div class="course-meta">
                        <span><i class="fas fa-video"></i> 24 video</span>
                        <span><i class="fas fa-users"></i> 67 o'quvchi</span>
                        <span><i class="fas fa-star"></i> 4.7 (20 baho)</span>
                    </div>
                </div>
                <div class="course-actions">
                    <button class="btn-sm btn-info" onclick="showCourseDetails(3)"><i class="fas fa-eye"></i> Ko'rish</button>
                    <button class="btn-sm btn-info" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);"><i class="fas fa-edit"></i> Tahrirlash</button>
                    <button class="btn-sm btn-danger"><i class="fas fa-trash"></i> O'chirish</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- YANGI KURS QO'SHISH MODALI (faqat nomi va izohi) -->
<div id="addCourseModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 600px; width: 95%;">
        <div class="modal-header">
            <h3>Yangi Kurs Qo'shish</h3>
            <button class="modal-close" onclick="document.getElementById('addCourseModal').style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title"><i class="fas fa-heading"></i> Kurs Nomi</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Masalan: Advanced English Grammar" required>
                </div>

                <div class="form-group">
                    <label for="description"><i class="fas fa-align-left"></i> Kurs Izohi (Tavsifi)</label>
                    <textarea id="description" name="description" class="form-control" rows="8" placeholder="Bu kursda o'quvchilar nimalarni o'rganadi? Qisqacha va jozibali yozing..." required></textarea>
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

<div id="addVideoModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 700px; width: 95%;">
        <div class="modal-header">
            <h3><i class="fas fa-video"></i> Yangi Video Qo'shish</h3>
            <button class="modal-close" onclick="document.getElementById('addVideoModal').style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Agar kerak bo'lsa, kurs tanlash uchun qo'shsa bo'ladi -->
                <!-- <input type="hidden" name="course_id" value=""> -->

                <div class="form-group">
                    <label for="video_title"><i class="fas fa-heading"></i> Video Sarlavhasi</label>
                    <input type="text" id="video_title" name="title" class="form-control"
                        placeholder="Masalan: Lesson 1 - Present Simple Tense" required>
                </div>

                <div class="form-group">
                    <label for="video_description"><i class="fas fa-align-left"></i> Video Izohi (Tavsifi)</label>
                    <textarea id="video_description" name="description" class="form-control" rows="6"
                        placeholder="Bu videoda nimalar tushuntiriladi? Qisqacha izoh bering..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="video_file"><i class="fas fa-file-video"></i> Video Fayl Yuklash</label>
                    <input type="file" id="video_file" name="video" accept="video/mp4,video/avi,video/mov,video/wmv"
                        class="form-control" required>
                    <small style="color: #64748b; display: block; margin-top: 8px;">
                        Faqat MP4, AVI, MOV formatlari. Maksimal hajm: 500MB
                    </small>
                </div>

                <div class="form-group">
                    <label for="duration"><i class="fas fa-clock"></i> Davomiyligi (daqiqa)</label>
                    <input type="number" id="duration" name="duration" class="form-control"
                        placeholder="Masalan: 45" min="1" required>
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


<!-- KURS DETALLARI MODALI (ko'rish uchun) -->
<div id="courseDetailModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 1200px; width: 95%;">
        <div class="modal-header">
            <h3 id="modalCourseTitle">Kurs Sarlavhasi</h3>
            <button class="modal-close" onclick="document.getElementById('courseDetailModal').style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="course-lessons">
                <!-- Darslar bu yerga dinamik qo'shiladi yoki statik misollar -->
                <div class="lesson-item">
                    <div class="lesson-video">
                        <div style="background: #000; border-radius: 12px; position: relative; padding-bottom: 56.25%; overflow: hidden;">
                            <iframe width="100%" height="100%" style="position: absolute; top: 0; left: 0;" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="lesson-info">
                        <h5>Lesson 1: Present Simple Tense</h5>
                        <p>Bu darsda Present Simple Tense haqida to'liq ma'lumot.</p>
                        <div class="lesson-meta">
                            <span><i class="fas fa-clock"></i> 45 daqiqa</span>
                            <span><i class="fas fa-eye"></i> 234 ko'rilgan</span>
                        </div>
                    </div>
                </div>

                <!-- Izohlar bo'limi -->
                <div class="comments-section">
                    <h5 style="margin-bottom: 20px;"><i class="fas fa-comments"></i> Izohlar</h5>
                    <div class="add-comment">
                        <img src="https://ui-avatars.com/api/?name=Teacher&background=10b981&color=fff" class="comment-avatar">
                        <div class="comment-input-wrapper">
                            <textarea class="comment-input" placeholder="Izoh qoldiring..." rows="3"></textarea>
                            <button class="btn-primary" style="margin-top: 10px;">Yuborish</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Umumiy kurs item stillari */
    /* Video yuklash tugmasi va modali uchun qo'shimcha stillar */
    #addVideoModal .btn-primary {
        background: linear-gradient(135deg, #10b981, #059669) !important;
    }

    #addVideoModal .btn-primary:hover {
        background: linear-gradient(135deg, #059669, #047857) !important;
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
        border-color: var(--primary);
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
    }

    .course-meta span {
        color: #64748b;
        font-size: 14px;
    }

    .course-meta i {
        color: var(--primary);
        margin-right: 5px;
    }

    .course-actions {
        display: flex;
        gap: 10px;
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
        background: linear-gradient(135deg, var(--info), #0891b2);
        color: white;
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger), #dc2626);
        color: white;
    }

    .btn-sm:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Modal stillari */
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
        color: var(--danger);
    }

    .modal-body {
        padding: 35px;
    }

    /* Form stillari */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: var(--dark);
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
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
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

    /* Izohlar stillari (qisqartirilgan) */
    .comments-section {
        margin-top: 40px;
        padding: 25px;
        background: #f8fafc;
        border-radius: 18px;
    }

    .add-comment {
        display: flex;
        gap: 15px;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px solid #e2e8f0;
    }

    .comment-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .comment-input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        resize: vertical;
    }
</style>

<script>
    function showCourseDetails(courseId) {
        // Agar dinamik bo'lsa, bu yerga kurs ma'lumotlarini yuklash mumkin (AJAX)
        document.getElementById('modalCourseTitle').textContent = 'Kurs Sarlavhasi'; // Misol
        document.getElementById('courseDetailModal').style.display = 'flex';
    }
</script>
@endsection
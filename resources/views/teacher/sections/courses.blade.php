@extends('teacher.layout')

@section('title', 'Kurslar')
@section('page-title', 'Mening Kurslarim')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Kurslar</h4>
        <button class="btn-primary" onclick="document.getElementById('addCourseModal').style.display='flex'">
            <i class="fas fa-plus"></i> Yangi Kurs
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
                    <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
                    <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
                    <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- KURS DETALLARI MODAL -->
<div id="courseDetailModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 1200px; width: 95%;">
        <div class="modal-header">
            <h3>Advanced English Grammar</h3>
            <button class="modal-close" onclick="document.getElementById('courseDetailModal').style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="course-lessons">
                <!-- Lesson 1 -->
                <div class="lesson-item">
                    <div class="lesson-video">
                        <div style="background: #000; border-radius: 12px; position: relative; padding-bottom: 56.25%; overflow: hidden;">
                            <iframe width="100%" height="100%" style="position: absolute; top: 0; left: 0;" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="lesson-info">
                        <h5>Lesson 1: Present Simple Tense</h5>
                        <p>Bu darsda Present Simple Tense haqida to'liq ma'lumot. Qoidalar, misollar va mashqlar.</p>
                        <div class="lesson-meta">
                            <span><i class="fas fa-clock"></i> 45 daqiqa</span>
                            <span><i class="fas fa-eye"></i> 234 ko'rilgan</span>
                        </div>
                    </div>
                </div>

                <!-- Izohlar Bo'limi -->
                <div class="comments-section">
                    <h5 style="margin-bottom: 20px;"><i class="fas fa-comments"></i> Izohlar (8)</h5>
                    
                    <!-- Izoh 1 -->
                    <div class="comment-item">
                        <img src="https://ui-avatars.com/api/?name=Malika&background=random" class="comment-avatar">
                        <div class="comment-content">
                            <div class="comment-header">
                                <strong>Malika Karimova</strong>
                                <span class="comment-time">2 soat oldin</span>
                            </div>
                            <p class="comment-text">Juda yaxshi tushuntirdingiz! Present Simple haqida barcha tushunchasiz joylar ochildi. Rahmat!</p>
                            <div class="comment-actions">
                                <button><i class="fas fa-thumbs-up"></i> 12</button>
                                <button><i class="fas fa-reply"></i> Javob berish</button>
                            </div>
                        </div>
                    </div>

                    <!-- Izoh 2 -->
                    <div class="comment-item">
                        <img src="https://ui-avatars.com/api/?name=Aziz&background=random" class="comment-avatar">
                        <div class="comment-content">
                            <div class="comment-header">
                                <strong>Aziz Toshmatov</strong>
                                <span class="comment-time">5 soat oldin</span>
                            </div>
                            <p class="comment-text">Keyingi darsda Past Simple ham bo'ladimi?</p>
                            <div class="comment-actions">
                                <button><i class="fas fa-thumbs-up"></i> 5</button>
                                <button><i class="fas fa-reply"></i> Javob berish</button>
                            </div>
                            <!-- O'qituvchi javobi -->
                            <div class="comment-reply">
                                <img src="https://ui-avatars.com/api/?name=Gulnoza&background=10b981&color=fff" class="comment-avatar" style="width: 30px; height: 30px;">
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <strong>Gulnoza Ahmedova</strong>
                                        <span class="teacher-badge" style="font-size: 10px;">O'qituvchi</span>
                                        <span class="comment-time">3 soat oldin</span>
                                    </div>
                                    <p class="comment-text">Ha Aziz, keyingi darsda Past Simple tenseini o'rganamiz!</p>
                                    <div class="comment-actions">
                                        <button><i class="fas fa-thumbs-up"></i> 8</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Izoh 3 -->
                    <div class="comment-item">
                        <img src="https://ui-avatars.com/api/?name=Sardor&background=random" class="comment-avatar">
                        <div class="comment-content">
                            <div class="comment-header">
                                <strong>Sardor Rahimov</strong>
                                <span class="comment-time">1 kun oldin</span>
                            </div>
                            <p class="comment-text">Videoni qayta-qayta ko'rdim, juda foydali bo'ldi!</p>
                            <div class="comment-actions">
                                <button><i class="fas fa-thumbs-up"></i> 15</button>
                                <button><i class="fas fa-reply"></i> Javob berish</button>
                            </div>
                        </div>
                    </div>

                    <!-- Yangi izoh qo'shish -->
                    <div class="add-comment">
                        <img src="https://ui-avatars.com/api/?name=Gulnoza&background=10b981&color=fff" class="comment-avatar">
                        <div class="comment-input-wrapper">
                            <textarea class="comment-input" placeholder="Izoh qoldiring..." rows="3"></textarea>
                            <button class="btn-primary" style="margin-top: 10px;">
                                <i class="fas fa-paper-plane"></i> Yuborish
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Lesson 2 -->
                <div class="lesson-item" style="margin-top: 30px;">
                    <div class="lesson-video">
                        <div style="background: #000; border-radius: 12px; position: relative; padding-bottom: 56.25%; overflow: hidden;">
                            <iframe width="100%" height="100%" style="position: absolute; top: 0; left: 0;" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="lesson-info">
                        <h5>Lesson 2: Past Simple Tense</h5>
                        <p>Past Simple tense va uning qo'llanilishi. Regular va irregular verbs.</p>
                        <div class="lesson-meta">
                            <span><i class="fas fa-clock"></i> 50 daqiqa</span>
                            <span><i class="fas fa-eye"></i> 198 ko'rilgan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
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
    background: rgba(0,0,0,0.8);
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
    color: var(--dark);
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
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
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

.modal-header h3 {
    margin: 0;
    font-weight: 800;
    color: var(--dark);
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
    transition: all 0.3s;
}

.modal-close:hover {
    background: #e2e8f0;
    color: var(--danger);
}

.modal-body {
    padding: 35px;
}

.lesson-item {
    margin-bottom: 30px;
}

.lesson-video {
    margin-bottom: 20px;
}

.lesson-info h5 {
    font-size: 20px;
    font-weight: 800;
    color: var(--dark);
    margin: 0 0 10px 0;
}

.lesson-info p {
    color: #64748b;
    margin: 0 0 15px 0;
}

.lesson-meta {
    display: flex;
    gap: 20px;
}

.lesson-meta span {
    color: #64748b;
    font-size: 14px;
}

/* Comments Section */
.comments-section {
    margin-top: 30px;
    padding: 25px;
    background: #f8fafc;
    border-radius: 18px;
}

.comment-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.comment-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    flex-shrink: 0;
}

.comment-content {
    flex: 1;
    background: white;
    padding: 15px;
    border-radius: 12px;
}

.comment-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}

.comment-header strong {
    color: var(--dark);
    font-size: 14px;
}

.comment-time {
    color: #94a3b8;
    font-size: 12px;
    margin-left: auto;
}

.comment-text {
    color: #475569;
    margin: 0 0 10px 0;
    line-height: 1.6;
}

.comment-actions {
    display: flex;
    gap: 15px;
}

.comment-actions button {
    background: none;
    border: none;
    color: #64748b;
    font-size: 13px;
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 6px;
    transition: all 0.3s;
}

.comment-actions button:hover {
    background: #f1f5f9;
    color: var(--primary);
}

.comment-reply {
    margin-top: 15px;
    margin-left: 40px;
    display: flex;
    gap: 10px;
}

.add-comment {
    display: flex;
    gap: 15px;
    margin-top: 25px;
    padding-top: 25px;
    border-top: 2px solid #e2e8f0;
}

.comment-input-wrapper {
    flex: 1;
}

.comment-input {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    resize: vertical;
}

.comment-input:focus {
    outline: none;
    border-color: var(--primary);
}

.teacher-badge {
    background: var(--success);
    color: white;
    padding: 2px 8px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
}
</style>

<script>
function showCourseDetails(courseId) {
    document.getElementById('courseDetailModal').style.display = 'flex';
}
</script>
@endsection
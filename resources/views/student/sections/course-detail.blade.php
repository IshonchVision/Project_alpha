@extends('student.layout')

@section('title', 'Kurs Detali')
@section('page-title', 'Express Database')

@section('content')
<div class="course-detail">
    <!-- Kurs bosh qismi -->
    <div class="course-header">
        <div class="thumbnail">
            <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=800" alt="Course Thumbnail">
            <div class="play-icon"><i class="fas fa-play-circle"></i></div>
        </div>
        <div class="info">
            <h1>Express Database</h1>
            <p class="mentor">Mentor: Otabek Nurmuhammad</p> <!-- Faqat o'qituvchi haqida ma'lumot -->
            <p class="description">Bu kursda SQL va ma'lumotlar bazasi asoslari o'rganiladi. Boshlovchilar uchun ideal.</p>
        </div>
    </div>

    <!-- Darslar bo'limlari -->
    <div class="sections">
        <!-- Bo'lim 1 -->
        <div class="section">
            <h3>1. SQL Asoslari</h3>
            <div class="lessons">
                <a href="{{ route('student.lessons.show', 1) }}" class="lesson completed"> <!-- Link qo'shdim -->
                    <i class="fas fa-check-circle"></i> Kirish: Ma'lumotlar ombori <span class="progress">100%</span>
                </a>
                <a href="{{ route('student.lessons.show', 2) }}" class="lesson completed">
                    <i class="fas fa-check-circle"></i> Ma'lumotlar Arxitekturasi: Jadvallar va Kalitlar <span class="progress">100%</span>
                </a>
                <a href="{{ route('student.lessons.show', 3) }}" class="lesson">
                    <i class="fas fa-play-circle"></i> Ma'lumotlar Manipulyatsiyasi <span class="progress">0%</span>
                </a>
                <div class="lesson locked">
                    <i class="fas fa-lock"></i> "So'rash" San'ati <span class="progress">0%</span>
                </div>
                <!-- Boshqa locked darslar... -->
            </div>
        </div>

        <!-- Bo'lim 2 -->
        <div class="section">
            <h3>2. Murakkab So'rovlar</h3>
            <div class="lessons">
                <div class="lesson locked"><i class="fas fa-lock"></i> Jadvallar Boshqaruvi</div>
                <!-- Boshqa locked darslar... -->
            </div>
        </div>
    </div>
</div>

<style>
.course-detail { max-width: 1200px; margin: 0 auto; }
.course-header { display: flex; gap: 30px; margin-bottom: 40px; }
.thumbnail { position: relative; width: 40%; border-radius: 16px; overflow: hidden; }
.thumbnail img { width: 100%; height: auto; }
.play-icon { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 50px; color: white; }
.info { flex: 1; }
.info h1 { font-size: 32px; margin-bottom: 10px; }
.mentor { font-size: 18px; color: #64748b; margin-bottom: 15px; }
.description { font-size: 16px; color: #475569; }
.section { background: #f8fafc; border-radius: 16px; padding: 25px; margin-bottom: 25px; }
.section h3 { font-size: 22px; margin-bottom: 20px; color: #1e40af; }
.lessons { display: flex; flex-direction: column; gap: 12px; }
.lesson { display: flex; align-items: center; gap: 12px; padding: 14px; background: white; border-radius: 12px; text-decoration: none; color: inherit; transition: all 0.3s; }
.lesson:hover { background: #eef2ff; }
.lesson i { font-size: 18px; }
.completed i { color: #10b981; }
.progress { margin-left: auto; font-weight: 600; color: #10b981; }
.locked { opacity: 0.6; cursor: not-allowed; }
</style>
@endsection
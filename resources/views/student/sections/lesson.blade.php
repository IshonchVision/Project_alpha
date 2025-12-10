@extends('student.layout')

@section('title', 'Dars: Kirish')
@section('page-title', 'Darsni Ko\'rish')

@section('content')
<div class="lesson-page">
    <!-- Video player -->
    <div class="video-container">
        <video controls width="100%" poster="https://via.placeholder.com/800x450">
            <source src="https://example.com/video.mp4" type="video/mp4"> <!-- Dinamik video URL -->
            Videoni ko'rish uchun brauzeringizni yangilang.
        </video>
    </div>

    <!-- Tavsif/izoh -->
    <div class="description">
        <h2>Tarixga Qaytamiz</h2>
        <p>
            Avvallari odamlar ma'lumotini yodda saqlashgan. Keyin esa uni
            yo'qotmaslik uchun qog'ozga yozishni o'ylab topishdi. Savdogarlar
            ro'yxatlar tuzdi, soliqchilar yozuvlar yuritdi. Bu biz bilgan ma'lumotlar
            bazasining ilk ko'rinishi edi. Faqat barchasi qo'lda bajarilardi, qidirish
            qiyin, xatolar ko'p, yangilash esa juda sekin (chuniki qog'ozga yongitdan
            ko'chirish talab qiladi).
        </p>
    </div>
</div>

<style>
.lesson-page { max-width: 800px; margin: 0 auto; padding: 20px; }
.video-container { margin-bottom: 30px; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
.description h2 { font-size: 28px; margin-bottom: 15px; color: #1e293b; }
.description p { font-size: 16px; line-height: 1.8; color: #475569; }
</style>
@endsection
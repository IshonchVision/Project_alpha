@extends('layouts.app')

@section('content')
    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h2 class="text-white display-3">Biz haqimizda batafsil</h2>
            <div class="d-inline-flex text-white mb-5">
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Header End -->

    <!-- About Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href=""
                    style="max-height: 400px;">
                    <img class="img-fluid" src="img/header.jpg" alt=""
                        style="max-height: 350px; object-fit: cover; width: 100%;">
                </a>
            </div>
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="section-title position-relative mb-3">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2"
                        style="font-size: 0.85rem;">Maqsad sharhi</h6>
                    <h2 class="display-5">Ta'lim nazariyasi haqida ma'lumot</h2>
                </div>
                <p style="font-size: 0.95rem; line-height: 1.7; text-align: justify;">
                    Ta'lim nazariyasi — o'qitish jarayoni, metodlari, tamoyillari va o'quvchini rivojlantirishga qaratilgan
                    ilmiy yondashuvlarni o'rganuvchi fan.
                    Ushbu platformada siz ta'lim jarayonining asoslari, didaktik tamoyillar, o'qitish metodlari, o'quvchi
                    psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o'rganasiz.
                </p>
            </div>
            <div class="col-12">
                <p style="font-size: 0.95rem; line-height: 1.7; text-align: justify;">
                    <b style="color: blue;">Ta'lim nazariyasi</b> — o'qitish jarayoni, metodlari, tamoyillari va o'quvchini
                    rivojlantirishga qaratilgan ilmiy yondashuvlarni o'rganuvchi fan.
                    Ushbu platformada siz ta'lim jarayonining asoslari, didaktik tamoyillar, o'qitish metodlari, o'quvchi
                    psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o'rganasiz.
                </p>
                <p style="font-size: 0.95rem; line-height: 1.7; text-align: justify;">
                    Ta'lim nazariyasi — o'qitish jarayoni, metodlari, tamoyillari va o'quvchini rivojlantirishga qaratilgan
                    ilmiy yondashuvlarni o'rganuvchi fan.
                    Ushbu platformada siz ta'lim jarayonining asoslari, didaktik tamoyillar, o'qitish metodlari, o'quvchi
                    psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o'rganasiz.
                </p>
                <p style="font-size: 0.95rem; line-height: 1.7; text-align: justify;">
                    Ushbu platformada siz ta'lim jarayonining asoslari, didaktik tamoyillar, o'qitish metodlari, o'quvchi
                    psixologiyasi va zamonaviy pedagogik yondashuvlarni chuqur va amaliy shaklda o'rganasiz.
                    Ta'lim nazariyasi — o'qitish jarayoni, metodlari, tamoyillari va o'quvchini rivojlantirishga qaratilgan
                    ilmiy yondashuvlarni o'rganuvchi fan.
                </p>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- AI Chat Assistant Section -->
    <div class="container py-5" style="margin-top: 60px;">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-5">
                    <h3 class="display-5 fw-bold text-dark">Fan bo'yicha qo'shimcha bilimlar olish uchun <b
                            style="color: #224abe">Yordamchi AI</b> dan foydalaning</h3>
                </div>
                <!-- Chat Card -->
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient text-white py-3 text-center"
                        style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                        <h5 class="mb-0"><i class="fa fa-robot me-2" style="color: white"></i> <b style="color: white">AI Yordamchi</b></h5>
                    </div>
                    <div class="card-body p-0">
                        <!-- Chat Messages Area -->
                        <div id="chatMessages" class="p-4"
                            style="height: 450px; overflow-y: auto; background-color: #f8f9fa;">
                            <div class="message-item mb-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 42px; height: 42px;">
                                        <i class="fa fa-robot fa-lg"></i>
                                    </div>
                                    <div class="message-content bg-white p-3 rounded-3 shadow-sm"
                                        style="max-width: 80%; border-left: 4px solid #4e73df;">
                                        <p class="mb-0 text-dark" style="line-height: 1.6;">
                                            Assalomu alaykum! Men sizga Ta'lim nazariyasi va boshqa fanlar bo'yicha yordam
                                            berishga tayyorman.<br>
                                            Savollaringizni yozing! 📚
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Input va tugmalar maydoni -->
                        <div class="border-top bg-white p-4">
                            <!-- Textarea -->
                            <div class="mb-4">
                                <textarea id="userQuestion" class="form-control border-0 shadow-sm" placeholder="Savolingizni bu yerga yozing..."
                                    rows="3" style="resize: none; background-color: #f8f9fa;"></textarea>
                            </div>

                            <!-- Tugmalar qatori: Tozalash chapda, Yuborish o'ngda -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button id="clearChatBtn" class="btn btn-outline-danger" title="Chatni tozalash">
                                    <i class="fa fa-trash me-2"></i> Tozalash
                                </button>

                                <button id="sendBtn" class="btn btn-primary px-5" type="button">
                                    <i></i> Yuborish
                                </button>
                            </div>

                            <!-- Loading indicator - faqat spinner -->
                            <div id="loadingIndicator" class="text-center mt-4" style="display: none;">
                                <div class="spinner-border text-primary" role="status"
                                    style="width: 2.5rem; height: 2.5rem;">
                                    <span class="visually-hidden">loading</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Skromniy va chiroyli chat dizayni */
        #chatMessages::-webkit-scrollbar {
            width: 6px;
        }

        #chatMessages::-webkit-scrollbar-track {
            background: transparent;
        }


        #chatMessages::-webkit-scrollbar-thumb {
            background: rgba(78, 115, 223, 0.3);
            border-radius: 10px;
        }

        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: rgba(78, 115, 223, 0.5);
        }

        .message-item {
            animation: fadeInUp 0.4s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* User message */
        .user-message .message-content {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            margin-left: auto;
            border-left: none;
            border-right: 4px solid #224abe;
        }

        /* Focus styles */
        #userQuestion:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.2);
            background-color: #ffffff !important;
        }

        /* Hover effects */
        #sendBtn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
        }

        #clearChatBtn:hover {
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #chatMessages {
                height: 350px;
            }

            .message-content {
                max-width: 90% !important;
            }

            #clearChatBtn {
                float: none !important;
                display: block;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatMessages = document.getElementById('chatMessages');
            const userQuestion = document.getElementById('userQuestion');
            const sendBtn = document.getElementById('sendBtn');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const clearChatBtn = document.getElementById('clearChatBtn');

            // Chatni tozalash — tasdiqlashsiz
            clearChatBtn.addEventListener('click', function() {
                chatMessages.innerHTML = `
                <div class="message-item mb-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px;">
                            <i class="fa fa-robot fa-lg"></i>
                        </div>
                        <div class="message-content bg-white p-3 rounded-3 shadow-sm" style="max-width: 80%; border-left: 4px solid #4e73df;">
                            <p class="mb-0 text-dark" style="line-height: 1.6;">
                                Assalomu alaykum! Men sizga Ta'lim nazariyasi va boshqa fanlar bo'yicha yordam berishga tayyorman.<br>
                                Savollaringizni yozing! 📚
                            </p>
                        </div>
                    </div>
                </div>`;
            });

            async function sendMessage() {
                const question = userQuestion.value.trim();
                if (!question) return;

                addMessage(question, 'user');
                userQuestion.value = '';
                loadingIndicator.style.display = 'block'; // Faqat spinner ko'rinadi
                sendBtn.disabled = true;

                try {
                    const response = await fetch('/ai-chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            question: question
                        })
                    });

                    const data = await response.json();

                    if (data.content && data.content[0]) {
                        addMessage(data.content[0].text, 'ai');
                    } else {
                        addMessage('Xatolik: API dan noto\'g\'ri javob keldi.', 'ai');
                    }
                } catch (error) {
                    addMessage('Xatolik: Server bilan bog\'lanib bo\'lmadi.', 'ai');
                } finally {
                    loadingIndicator.style.display = 'none'; // Spinner yashiriladi
                    sendBtn.disabled = false;
                    userQuestion.focus();
                }
            }

            function addMessage(text, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message-item mb-4 ${sender === 'user' ? 'user-message' : ''}`;

                if (sender === 'user') {
                    messageDiv.innerHTML = `
                    <div class="d-flex align-items-start justify-content-end">
                        <div class="message-content p-3 rounded-3 shadow-sm" style="max-width: 80%;">
                            <p class="mb-0">${text}</p>
                        </div>
                    </div>`;
                } else {
                    messageDiv.innerHTML = `
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px;">
                            <i class="fa fa-robot fa-lg"></i>
                        </div>
                        <div class="message-content bg-white p-3 rounded-3 shadow-sm" style="max-width: 80%; border-left: 4px solid #4e73df;">
                            <p class="mb-0 text-dark" style="white-space: pre-wrap; line-height: 1.6;">${text}</p>
                        </div>
                    </div>`;
                }

                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            sendBtn.addEventListener('click', sendMessage);
            userQuestion.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });
        });
    </script>

    <!-- Kurslar bo'limi -->
    <div class="container py-12" style="margin-top: 60px;">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4">
                        <div class="card text-center h-100 shadow-lg border-0 rounded-3">
                            <div class="card-body p-5"
                                style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white;">
                                <i class="fa fa-laptop fa-3x mb-4"></i>
                                <h5 class="card-title mb-3 fw-bold">IT: Turli sohalar</h5>
                                <p class="card-text" style="line-height: 1.6;">
                                    Dasturlash, Web Development, Data Science, AI va boshqa sohalarda kurslar.
                                    Real loyihalar va interaktiv mashqlar bilan bilimlaringizni amalda sinab ko'ring.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center h-100 shadow-lg border-0 rounded-3">
                            <div class="card-body p-5"
                                style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                                <i class="fa fa-globe fa-3x mb-4"></i>
                                <h5 class="card-title mb-3 fw-bold">IELTS</h5>
                                <p class="card-text" style="line-height: 1.6;">
                                    Umumiy IELTS tayyorlov kurslari: listening, reading, writing va speaking qamrab olingan.
                                    Interaktiv mashqlar va testlar bilan muvaffaqiyat sari qadam tashlang.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center h-100 shadow-lg border-0 rounded-3">
                            <div class="card-body p-5"
                                style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%); color: white;">
                                <i class="fa fa-graduation-cap fa-3x mb-4"></i>
                                <h5 class="card-title mb-3 fw-bold">SAT</h5>
                                <p class="card-text" style="line-height: 1.6;">
                                    SAT tayyorlov kurslari bilan matematika va ingliz tilini mustahkamlang.
                                    Sinov testlari va interaktiv mashqlar muvaffaqiyatingizni oshiradi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

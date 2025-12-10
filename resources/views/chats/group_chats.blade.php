@extends('layouts.app')

@section('styles')
    <!-- Qo'shimcha CSS lar bu yerga keladi (head ichiga joylanadi) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f5f6fa;
        }
        #chatMessages {
            height: 500px;
            overflow-y: auto;
            background: #f8f9fa;
            padding: 15px;
        }
        .message-bubble {
            max-width: 70%;
        }
        .unread-badge {
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
        }
    </style>
@endsection

@section('content')
<div class="container my-5">
    <div class="row">

        <!-- Sidebar - Kurslar ro'yxati -->
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Mening Kurslarim</h6>
                </div>
                <div class="list-group list-group-flush" id="courseList">
                    <!-- Kurslar JS orqali qo'shiladi -->
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="col-lg-9">
            <!-- Chat oynasi -->
            <div class="card shadow-sm d-none" id="chatCard">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" id="chatCourseTitle">Kurs nomi</h5>
                    <span class="badge bg-light text-dark">
                        <i class="fas fa-users"></i> <span id="courseStudentsCount">0</span> o'quvchi
                    </span>
                </div>

                <div class="card-body p-0" id="chatMessages">
                    <!-- Xabarlar shu yerga qo'shiladi -->
                </div>

                <div class="card-footer bg-light">
                    <form id="chatForm">
                        <div class="input-group">
                            <input type="text" id="messageInput" class="form-control" placeholder="Xabar yozing..." autocomplete="off" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i> Yuborish
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kurs tanlanmagan holat -->
            <div class="card shadow-sm text-center py-5" id="emptySelect">
                <i class="fas fa-comments fa-4x text-muted mb-4"></i>
                <h4>Chatni boshlash uchun kursni tanlang</h4>
                <p class="text-muted">Chap tarafdagi ro'yxatdan kurs tanlang</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fake data (keyinchalik backenddan keladi)
    const courses = [
        { id: 1, title: "Laravel Bootcamp", students: 37, unread: 2, messages: [
            { user: "Siz", text: "Assalomu alaykum!", time: "10:15", isMe: true },
            { user: "Jasur", text: "Va alaykum salom!", time: "10:16", isMe: false },
        ]},
        { id: 2, title: "Vue.js Boshlang'ich", students: 18, unread: 0, messages: [] },
        { id: 3, title: "Python Asoslari", students: 52, unread: 5, messages: [
            { user: "Dilshod", text: "Funksiyalar mavzusiga o'tamizmi?", time: "09:40", isMe: false },
        ]},
    ];

    const courseList = document.getElementById("courseList");
    const chatCard = document.getElementById("chatCard");
    const emptySelect = document.getElementById("emptySelect");
    const chatMessages = document.getElementById("chatMessages");

    // Kurslarni ro'yxatga qo'shish
    courses.forEach(course => {
        const item = document.createElement("a");
        item.href = "#";
        item.className = "list-group-item list-group-item-action d-flex justify-content-between align-items-center";

        item.innerHTML = `
            <div>
                <h6 class="mb-1">${course.title}</h6>
                <small class="text-muted">${course.students} o'quvchi</small>
            </div>
            ${course.unread > 0 ? `<span class="badge bg-danger rounded-pill unread-badge">${course.unread}</span>` : ""}
        `;

        item.addEventListener('click', (e) => {
            e.preventDefault();
            openChat(course);
        });

        courseList.appendChild(item);
    });

    function openChat(course) {
        emptySelect.classList.add("d-none");
        chatCard.classList.remove("d-none");

        document.getElementById("chatCourseTitle").innerText = course.title;
        document.getElementById("courseStudentsCount").innerText = course.students;

        chatMessages.innerHTML = "";

        if (course.messages.length === 0) {
            chatMessages.innerHTML = `
                <div class="text-center text-muted mt-5">
                    <i class="fas fa-comments fa-3x mb-3"></i>
                    <p>Hozircha xabarlar yo'q. Birinchi bo'lib yozing!</p>
                </div>
            `;
            return;
        }

        course.messages.forEach(msg => addMessage(msg.text, msg.isMe, msg.user, msg.time));
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function addMessage(text, isMe = true, user = "Siz", time = null) {
        const now = new Date();
        const timeStr = time || `${now.getHours().toString().padStart(2, "0")}:${now.getMinutes().toString().padStart(2, "0")}`;

        const msgDiv = document.createElement("div");
        msgDiv.className = `d-flex mb-3 ${isMe ? 'justify-content-end' : 'justify-content-start'}`;

        const bubbleClass = isMe ? "bg-primary text-white" : "bg-white text-dark border";

        msgDiv.innerHTML = `
            ${!isMe ? `<img src="https://via.placeholder.com/40" class="rounded-circle me-2 align-self-end" width="40" height="40">` : ""}
            <div class="message-bubble">
                <div class="p-3 rounded shadow-sm ${bubbleClass}">
                    ${!isMe ? `<strong class="d-block mb-1">${user}</strong>` : ""}
                    <p class="mb-1">${text}</p>
                    <small class="${isMe ? 'text-light' : 'text-muted'}">${timeStr}</small>
                </div>
            </div>
            ${isMe ? `<img src="https://via.placeholder.com/40" class="rounded-circle ms-2 align-self-end" width="40" height="40">` : ""}
        `;

        chatMessages.appendChild(msgDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Xabar yuborish
    document.getElementById("chatForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const input = document.getElementById("messageInput");
        const text = input.value.trim();
        if (!text) return;

        addMessage(text, true);
        input.value = "";
    });
</script>
@endsection
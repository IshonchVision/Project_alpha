@extends('admin.layout')

@section('title', 'Chatlar')
@section('page-title', 'Guruh Chatlari')

@section('content')
<div class="row" style="margin: 0;">
    <!-- GURUHLAR RO'YXATI (Chap tomon) -->
    <div class="col-lg-4" style="padding: 0 15px;">
        <div class="card" style="height: calc(100vh - 150px);">
            <div class="card-header">
                <h4>Guruhlar</h4>
                <div style="margin-top: 15px;">
                    <input type="text" class="form-control" placeholder="Guruh qidirish..." style="padding: 10px 15px; border-radius: 10px;">
                </div>
            </div>
            <div class="card-body" style="padding: 0; overflow-y: auto;">
                <!-- Guruh 1 -->
                <div class="group-chat-item active">
                    <img src="https://ui-avatars.com/api/?name=Advanced+English&background=3b82f6&color=fff" class="group-avatar">
                    <div class="group-info">
                        <h6 class="group-name">Advanced English A1</h6>
                        <p class="last-message">Malika: Bugungi dars uchun...</p>
                    </div>
                    <div class="group-meta">
                        <span class="message-time">2 daq</span>
                        <span class="unread-badge">3</span>
                    </div>
                </div>

                <!-- Guruh 2 -->
                <div class="group-chat-item">
                    <img src="https://ui-avatars.com/api/?name=Matematika&background=10b981&color=fff" class="group-avatar">
                    <div class="group-info">
                        <h6 class="group-name">Matematika 101</h6>
                        <p class="last-message">Aziz: Masala 45 ni tushunmadim...</p>
                    </div>
                    <div class="group-meta">
                        <span class="message-time">10 daq</span>
                        <span class="unread-badge">1</span>
                    </div>
                </div>

                <!-- Guruh 3 -->
                <div class="group-chat-item">
                    <img src="https://ui-avatars.com/api/?name=IELTS&background=8b5cf6&color=fff" class="group-avatar">
                    <div class="group-info">
                        <h6 class="group-name">IELTS Preparation</h6>
                        <p class="last-message">Nodira: Ertangi imtihon soat...</p>
                    </div>
                    <div class="group-meta">
                        <span class="message-time">25 daq</span>
                    </div>
                </div>

                <!-- Guruh 4 -->
                <div class="group-chat-item">
                    <img src="https://ui-avatars.com/api/?name=Python&background=f59e0b&color=fff" class="group-avatar">
                    <div class="group-info">
                        <h6 class="group-name">Python Asoslari</h6>
                        <p class="last-message">Javohir: Bugun Python'da loop...</p>
                    </div>
                    <div class="group-meta">
                        <span class="message-time">1 soat</span>
                    </div>
                </div>

                <!-- Guruh 5 -->
                <div class="group-chat-item">
                    <img src="https://ui-avatars.com/api/?name=Fizika&background=06b6d4&color=fff" class="group-avatar">
                    <div class="group-info">
                        <h6 class="group-name">Fizika Advanced</h6>
                        <p class="last-message">Shahzod: Kinetik energiya...</p>
                    </div>
                    <div class="group-meta">
                        <span class="message-time">3 soat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CHAT OYNASI (O'ng tomon) -->
    <div class="col-lg-8" style="padding: 0 15px;">
        <div class="card" style="height: calc(100vh - 150px); display: flex; flex-direction: column;">
            <!-- Chat Header -->
            <div class="chat-window-header">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="https://ui-avatars.com/api/?name=Advanced+English&background=3b82f6&color=fff" style="width: 50px; height: 50px; border-radius: 50%;">
                    <div>
                        <h5 style="margin: 0; font-weight: 800;">Advanced English A1</h5>
                        <p style="margin: 0; color: #64748b; font-size: 14px;">24 o'quvchi • O'qituvchi: Gulnoza</p>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn-sm btn-info"><i class="fas fa-search"></i></button>
                    <button class="btn-sm btn-info"><i class="fas fa-ellipsis-v"></i></button>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="chat-messages">
                <!-- Xabar 1 -->
                <div class="message-item received">
                    <img src="https://ui-avatars.com/api/?name=Malika&background=random" class="message-avatar">
                    <div class="message-content">
                        <div class="message-header">
                            <span class="message-sender">Malika Karimova</span>
                            <span class="message-timestamp">14:30</span>
                        </div>
                        <div class="message-text">Bugungi dars uchun uy vazifasi nima edi?</div>
                    </div>
                </div>

                <!-- Xabar 2 (O'qituvchi) -->
                <div class="message-item received teacher-message">
                    <img src="https://ui-avatars.com/api/?name=Gulnoza&background=10b981&color=fff" class="message-avatar">
                    <div class="message-content">
                        <div class="message-header">
                            <span class="message-sender">Gulnoza Ahmedova</span>
                            <span class="teacher-badge">O'qituvchi</span>
                            <span class="message-timestamp">14:32</span>
                        </div>
                        <div class="message-text">Unit 5, Exercise 2, 3 va 4. Ertaga tekshiramiz!</div>
                    </div>
                </div>

                <!-- Xabar 3 -->
                <div class="message-item received">
                    <img src="https://ui-avatars.com/api/?name=Aziz&background=random" class="message-avatar">
                    <div class="message-content">
                        <div class="message-header">
                            <span class="message-sender">Aziz Toshmatov</span>
                            <span class="message-timestamp">14:35</span>
                        </div>
                        <div class="message-text">Rahmat! Exercise 3 ni qayerdan topish mumkin?</div>
                    </div>
                </div>

                <!-- Xabar 4 -->
                <div class="message-item received">
                    <img src="https://ui-avatars.com/api/?name=Sardor&background=random" class="message-avatar">
                    <div class="message-content">
                        <div class="message-header">
                            <span class="message-sender">Sardor Rahimov</span>
                            <span class="message-timestamp">14:38</span>
                        </div>
                        <div class="message-text">Men homework 12-ni topshirdim, ko'rdingizmi ustoz?</div>
                    </div>
                </div>

                <!-- Xabar 5 (O'qituvchi) -->
                <div class="message-item received teacher-message">
                    <img src="https://ui-avatars.com/api/?name=Gulnoza&background=10b981&color=fff" class="message-avatar">
                    <div class="message-content">
                        <div class="message-header">
                            <span class="message-sender">Gulnoza Ahmedova</span>
                            <span class="teacher-badge">O'qituvchi</span>
                            <span class="message-timestamp">14:40</span>
                        </div>
                        <div class="message-text">Ha Sardor, ko'rdim. Juda yaxshi bajargansan! 👍</div>
                    </div>
                </div>

                <!-- Xabar 6 -->
                <div class="message-item received">
                    <img src="https://ui-avatars.com/api/?name=Nigora&background=random" class="message-avatar">
                    <div class="message-content">
                        <div class="message-header">
                            <span class="message-sender">Nigora Aliyeva</span>
                            <span class="message-timestamp">14:42</span>
                        </div>
                        <div class="message-text">Speaking practice uchun audio file yuborish mumkinmi?</div>
                    </div>
                </div>

                <!-- Admin xabari -->
                <div class="message-item sent">
                    <div class="message-content">
                        <div class="message-header">
                            <span class="message-sender">Siz (Admin)</span>
                            <span class="message-timestamp">14:45</span>
                        </div>
                        <div class="message-text">Barcha o'quvchilar faol ishtirok qilishingizni so'raymiz!</div>
                    </div>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="chat-input-container">
                <button class="chat-action-btn"><i class="fas fa-paperclip"></i></button>
                <input type="text" class="chat-input" placeholder="Xabar yozing...">
                <button class="chat-action-btn"><i class="fas fa-smile"></i></button>
                <button class="btn-primary" style="padding: 12px 24px; margin-left: 10px;">
                    <i class="fas fa-paper-plane"></i> Yuborish
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Guruh Chat Item */
.group-chat-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    border-bottom: 1px solid #f1f5f9;
    cursor: pointer;
    transition: all 0.3s;
}

.group-chat-item:hover {
    background: #f8fafc;
}

.group-chat-item.active {
    background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(139,92,246,0.1));
    border-left: 4px solid var(--primary);
}

.group-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 3px solid #e2e8f0;
}

.group-info {
    flex: 1;
    min-width: 0;
}

.group-name {
    margin: 0;
    font-weight: 700;
    font-size: 15px;
    color: var(--dark);
}

.last-message {
    margin: 3px 0 0 0;
    font-size: 13px;
    color: #64748b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.group-meta {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 5px;
}

.message-time {
    font-size: 12px;
    color: #94a3b8;
}

.unread-badge {
    background: var(--primary);
    color: white;
    padding: 3px 8px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
}

/* Chat Window */
.chat-window-header {
    padding: 20px 25px;
    border-bottom: 2px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    background: #f8fafc;
}

.message-item {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    align-items: flex-start;
}

.message-item.sent {
    flex-direction: row-reverse;
}

.message-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #e2e8f0;
}

.message-content {
    max-width: 60%;
    background: white;
    padding: 12px 16px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.message-item.sent .message-content {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
}

.message-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
}

.message-sender {
    font-weight: 700;
    font-size: 13px;
    color: var(--dark);
}

.message-item.sent .message-sender {
    color: white;
}

.teacher-badge {
    background: var(--success);
    color: white;
    padding: 2px 8px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
}

.message-timestamp {
    font-size: 11px;
    color: #94a3b8;
    margin-left: auto;
}

.message-item.sent .message-timestamp {
    color: rgba(255,255,255,0.8);
}

.message-text {
    font-size: 14px;
    line-height: 1.5;
    color: #475569;
}

.message-item.sent .message-text {
    color: white;
}

.teacher-message .message-content {
    border-left: 4px solid var(--success);
}

/* Chat Input */
.chat-input-container {
    padding: 20px;
    border-top: 2px solid #f1f5f9;
    display: flex;
    align-items: center;
    gap: 10px;
    background: white;
}

.chat-input {
    flex: 1;
    padding: 12px 20px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
}

.chat-action-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: #f1f5f9;
    border-radius: 10px;
    color: #64748b;
    cursor: pointer;
    transition: all 0.3s;
}

.chat-action-btn:hover {
    background: #e2e8f0;
    color: var(--primary);
}
</style>
@endsection
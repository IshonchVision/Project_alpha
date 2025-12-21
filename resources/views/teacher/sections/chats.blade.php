@extends('teacher.layout')

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
                    <input type="text" class="form-control" placeholder="Guruh qidirish..." id="groupSearch" style="padding: 10px 15px; border-radius: 10px;">
                </div>
            </div>
            <div class="card-body" style="padding: 0; overflow-y: auto;">
                @foreach($groups as $g)
                @php
                    $last = optional($g->messages->first());
                @endphp
                <a href="{{ route('teacher.chats.group', $g->id) }}"
                   data-group-id="{{ $g->id }}"
                   class="group-chat-item {{ ($selectedGroup?->id ?? null) == $g->id ? 'active' : '' }}">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($g->name) }}&background=random&color=fff" class="group-avatar">
                    <div class="group-info">
                        <h6 class="group-name">{{ $g->name }}</h6>
                        <p class="last-message">
                            {{ $last?->user?->name ? $last->user->name . ': ' . Str::limit($last->message, 40) : 'Hozircha xabar yo‘q' }}
                        </p>
                    </div>
                    <div class="group-meta">
                        <span class="message-time">{{ $last?->created_at?->diffForHumans() ?? '' }}</span>
                        @if(($g->unread_count ?? 0) > 0)
                            <span class="unread-badge">{{ $g->unread_count }}</span>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CHAT OYNASI (O'ng tomon) -->
    <div class="col-lg-8" style="padding: 0 15px;">
        <div class="card chat-card" style="height: calc(100vh - 150px); display: flex; flex-direction: column;">
            <!-- Chat Header -->
            <div class="chat-window-header">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($selectedGroup?->name ?? 'Guruh') }}&background=3b82f6&color=fff"
                         style="width: 50px; height: 50px; border-radius: 50%;">
                    <div>
                        <h5 style="margin: 0; font-weight: 800;">{{ $selectedGroup?->name ?? 'Guruh tanlang' }}</h5>
                        <p style="margin: 0; color: #64748b; font-size: 14px;">
                            {{ $selectedGroup?->students()->count() ?? 0 }} o'quvchi • 
                            O'qituvchi: {{ $selectedGroup?->teacher?->name ?? auth()->user()->name }}
                        </p>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn-sm btn-info"><i class="fas fa-search"></i></button>
                    <button class="btn-sm btn-info"><i class="fas fa-ellipsis-v"></i></button>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="chat-messages" id="messagesBox">
                @if(!$selectedGroup || $messages->count() === 0)
                    <div class="text-center text-muted py-5">
                        {{ $selectedGroup ? 'Hozircha xabar yo‘q' : 'Chap tarafdan guruh tanlang' }}
                    </div>
                @else
                    @foreach($messages as $msg)
                        <div class="message-item {{ $msg->user_id == auth()->id() ? 'sent' : 'received' }} {{ $msg->user->role == 'teacher' ? 'teacher-message' : '' }}"
                             data-message-id="{{ $msg->id }}">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($msg->user->name) }}&background=random" class="message-avatar">
                            <div class="message-content">
                                <div class="message-header">
                                    <span class="message-sender">{{ $msg->user->name }}</span>
                                    @if($msg->user->role == 'teacher')
                                        <span class="teacher-badge">O'qituvchi</span>
                                    @endif
                                    <span class="message-timestamp">{{ $msg->created_at->format('H:i') }}</span>
                                </div>
                                <div class="message-text">{{ $msg->message }}</div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Chat Input -->
            @if($selectedGroup)
            <form action="{{ route('teacher.chats.send') }}" method="POST" class="chat-input-container" id="teacherChatForm">
                @csrf
                <input type="hidden" name="group_id" value="{{ $selectedGroup->id }}">
                <input type="hidden" id="lastMessageId" value="{{ $messages->last()?->id ?? 0 }}">
                <button type="button" class="chat-action-btn"><i class="fas fa-paperclip"></i></button>
                <input type="text" name="message" class="chat-input" placeholder="Xabar yozing..." required autocomplete="off">
                <button type="submit" class="btn-primary" style="padding:12px 24px">Yuborish</button>
            </form>
            @else
            <div class="chat-input-container" style="justify-content: center; color: #64748b;">
                Guruh tanlang va suhbatni boshlang
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Oldingi CSS larningizni saqlab qoldim – o'zgartirishsiz */
    .group-chat-item { display: flex; align-items: center; gap: 12px; padding: 15px 20px; border-bottom: 1px solid #f1f5f9; cursor: pointer; transition: all 0.3s; }
    .group-chat-item:hover { background: #f8fafc; }
    .group-chat-item.active { background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(139,92,246,0.1)); border-left: 4px solid var(--primary); }
    .group-avatar { width: 50px; height: 50px; border-radius: 50%; border: 3px solid #e2e8f0; }
    .group-info { flex: 1; min-width: 0; }
    .group-name { margin: 0; font-weight: 700; font-size: 15px; color: var(--dark); }
    .last-message { margin: 3px 0 0 0; font-size: 13px; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .group-meta { display: flex; flex-direction: column; align-items: flex-end; gap: 5px; }
    .message-time { font-size: 12px; color: #94a3b8; }
    .unread-badge { background: var(--primary); color: white; padding: 3px 8px; border-radius: 10px; font-size: 11px; font-weight: 700; }

    .chat-window-header { padding: 20px 25px; border-bottom: 2px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; background: white; }
    .chat-messages { flex: 1; overflow-y: auto; padding: 20px; background: #f8fafc; }
    .message-item { display: flex; gap: 12px; margin-bottom: 20px; align-items: flex-start; }
    .message-item.sent { flex-direction: row-reverse; }
    .message-avatar { width: 40px; height: 40px; border-radius: 50%; border: 2px solid #e2e8f0; }
    .message-content { max-width: 60%; background: white; padding: 12px 16px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .message-item.sent .message-content { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; }
    .message-header { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; }
    .message-sender { font-weight: 700; font-size: 13px; color: var(--dark); }
    .message-item.sent .message-sender { color: white; }
    .teacher-badge { background: var(--success); color: white; padding: 2px 8px; border-radius: 8px; font-size: 10px; font-weight: 700; }
    .message-timestamp { font-size: 11px; color: #94a3b8; margin-left: auto; }
    .message-item.sent .message-timestamp { color: rgba(255,255,255,0.8); }
    .message-text { font-size: 14px; line-height: 1.5; color: #475569; }
    .message-item.sent .message-text { color: white; }
    .teacher-message .message-content { border-left: 4px solid var(--success); }

    .chat-input-container { padding: 20px; border-top: 2px solid #f1f5f9; display: flex; align-items: center; gap: 10px; background: white; }
    .chat-input { flex: 1; padding: 12px 20px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 14px; }
    .chat-action-btn { width: 40px; height: 40px; border: none; background: #f1f5f9; border-radius: 10px; color: #64748b; cursor: pointer; transition: all 0.3s; }
    .chat-action-btn:hover { background: #e2e8f0; color: var(--primary); }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Global o'zgaruvchilar
    window.__teacherPreviewChannels = {};   // Har bir guruh preview uchun
    window.__currentChatChannel = null;     // Hozirgi ochiq guruh kanali
    window.__chatPollInterval = null;       // Polling

    // Guruhni AJAX orqali yuklash
    function loadGroupChat(url) {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            document.querySelector('.col-lg-8').innerHTML = data.html;
            setupCurrentChatRealtime();  // Realtime/pollingni qayta ishga tushirish
            bindSendForm();              // Yangi formani bog'lash
        })
        .catch(err => console.error('Guruh yuklash xatosi:', err));
    }

    // Guruh elementlariga click hodisasi
    document.querySelectorAll('.group-chat-item').forEach(el => {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            if (url) loadGroupChat(url);
        });
    });

    // Barcha guruhlar uchun preview yangilanishi (last message + badge)
    function subscribeToPreviewChannels() {
        document.querySelectorAll('.group-chat-item').forEach(el => {
            const groupId = el.dataset.groupId;
            if (!groupId || window.__teacherPreviewChannels[groupId]) return;

            if (!window.Echo) return;

            try {
                const channel = window.Echo.channel(`group.${groupId}`);
                window.__teacherPreviewChannels[groupId] = channel;

                channel.listen('NewGroupMessage', function(e) {
                    const item = document.querySelector(`.group-chat-item[data-group-id="${e.group_id}"]`);
                    if (!item) return;

                    // Last message
                    const lastMsg = item.querySelector('.last-message');
                    if (lastMsg && e.message) {
                        lastMsg.textContent = (e.user_name ? e.user_name + ': ' : '') + e.message;
                    }

                    // Vaqt
                    const time = item.querySelector('.message-time');
                    if (time && e.created_at) {
                        time.textContent = new Date(e.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
                    }

                    // Unread badge
                    const badge = item.querySelector('.unread-badge');
                    if (badge) {
                        let count = parseInt(badge.textContent || '0') + 1;
                        badge.textContent = count;
                        badge.style.display = 'inline-block';
                    } else if (!badge && e.unread_increment) {
                        // Agar badge yo'q bo'lsa yangi yaratish mumkin, lekin hozircha faqat mavjudlar uchun
                    }
                });
            } catch (err) {
                console.warn(`Preview kanal ulanish xatosi (group ${groupId}):`, err);
            }
        });
    }
    subscribeToPreviewChannels();

    // Hozirgi guruh uchun realtime + fallback polling
    function setupCurrentChatRealtime() {
        // Eski resurslarni tozalash
        if (window.__chatPollInterval) clearInterval(window.__chatPollInterval);
        if (window.__currentChatChannel) {
            window.__currentChatChannel.leave();
            window.__currentChatChannel = null;
        }

        const groupIdInput = document.querySelector('input[name="group_id"]');
        if (!groupIdInput || !groupIdInput.value) return;

        const groupId = groupIdInput.value;
        let lastMessageId = parseInt(document.getElementById('lastMessageId')?.value || 0);

        if (!window.Echo) {
            startPolling(groupId, lastMessageId);
            return;
        }

        try {
            const channel = window.Echo.channel(`group.${groupId}`);
            window.__currentChatChannel = channel;

            channel.listen('NewGroupMessage', function(e) {
                const currentUserId = parseInt(document.querySelector('meta[name="user-id"]')?.content || 0);

                // O'z xabari bo'lsa – faqat yangilash, bildirishnoma bermaymiz
                if (e.user_id === currentUserId) return;

                const box = document.getElementById('messagesBox');
                if (box && e.html && !document.querySelector(`[data-message-id="${e.id}"]`)) {
                    box.insertAdjacentHTML('beforeend', e.html);
                    box.scrollTop = box.scrollHeight;
                }

                if (e.id > lastMessageId) {
                    lastMessageId = e.id;
                    document.getElementById('lastMessageId').value = e.id;
                }

                if (window.toastr && e.message) {
                    toastr.info(e.message, 'Yangi xabar');
                }
            });

            // Agar 4 soniyada subscription bo'lmasa – pollingga o'tamiz
            setTimeout(() => {
                if (!channel.subscribed) startPolling(groupId, lastMessageId);
            }, 4000);

        } catch (err) {
            console.warn('Realtime ulanmadi, polling ishga tushdi:', err);
            startPolling(groupId, lastMessageId);
        }
    }

    function startPolling(groupId, lastId) {
        window.__chatPollInterval = setInterval(() => {
            fetch(`/teacher/chats/${groupId}/poll?last_id=${lastId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.html) {
                    const box = document.getElementById('messagesBox');
                    if (box) {
                        box.insertAdjacentHTML('beforeend', data.html);
                        box.scrollTop = box.scrollHeight;
                    }
                }
                if (data.last_message_id > lastId) {
                    lastId = data.last_message_id;
                    document.getElementById('lastMessageId').value = lastId;
                }
            })
            .catch(err => console.warn('Polling xatosi:', err));
        }, 3000);
    }

    // Xabar yuborish
    function bindSendForm() {
        const form = document.getElementById('teacherChatForm');
        if (!form) return;

        form.onsubmit = function(e) {
            e.preventDefault();
            const data = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: data
            })
            .then(r => r.json())
            .then(json => {
                if (json.message_html && json.message_id) {
                    const box = document.getElementById('messagesBox');
                    if (box && !document.querySelector(`[data-message-id="${json.message_id}"]`)) {
                        box.insertAdjacentHTML('beforeend', json.message_html);
                        box.scrollTop = box.scrollHeight;
                    }
                    document.getElementById('lastMessageId').value = json.message_id;
                }
                this.querySelector('input[name="message"]').value = '';
            })
            .catch(err => {
                console.error(err);
                alert('Xabar yuborishda xatolik');
            });
        };
    }

    // Dastlabki sozlash
    setupCurrentChatRealtime();
    bindSendForm();

    // Guruh qidiruvi (ixtiyoriy bonus)
    document.getElementById('groupSearch')?.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.group-chat-item').forEach(item => {
            const name = item.querySelector('.group-name').textContent.toLowerCase();
            item.style.display = name.includes(query) ? 'flex' : 'none';
        });
    });
});
</script>
@endsection
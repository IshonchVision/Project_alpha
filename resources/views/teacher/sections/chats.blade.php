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
                    <input type="text" class="form-control" placeholder="Guruh qidirish..." style="padding: 10px 15px; border-radius: 10px;">
                </div>
            </div>
            <div class="card-body" style="padding: 0; overflow-y: auto;">
                @foreach($groups as $g)
                @php
                    $last = optional($g->messages->first());
                @endphp
                <a href="{{ route('teacher.chats.group', $g->id) }}" data-group-id="{{ $g->id }}" class="group-chat-item {{ ($selectedGroup?->id ?? null) == $g->id ? 'active' : '' }}">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($g->name) }}&background=random&color=fff" class="group-avatar">
                    <div class="group-info">
                        <h6 class="group-name">{{ $g->name }}</h6>
                        <p class="last-message">{{ $last?->user?->name ? $last->user->name . ': ' . Str::limit($last->message, 40) : '' }}</p>
                    </div>
                    <div class="group-meta">
                        <span class="message-time">{{ $last?->created_at ? $last->created_at->diffForHumans() : '' }}</span>
                        @if(($g->students_count ?? 0) > 0)
                            <span class="unread-badge">{{ $g->students_count }}</span>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CHAT OYNASI (O'ng tomon) -->
    <div class="col-lg-8" style="padding: 0 15px;">
        <div class="card" style="height: calc(100vh - 150px); display: flex; flex-direction: column;">
            <!-- Chat Header -->
            <div class="chat-window-header">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($selectedGroup?->name ?? 'Guruh') }}&background=3b82f6&color=fff" style="width: 50px; height: 50px; border-radius: 50%;">
                    <div>
                        <h5 style="margin: 0; font-weight: 800;">{{ $selectedGroup?->name ?? 'Guruh tanlang' }}</h5>
                        <p style="margin: 0; color: #64748b; font-size: 14px;">{{ $selectedGroup?->students()->count() ?? 0 }} o'quvchi • O'qituvchi: {{ $selectedGroup?->teacher?->name ?? auth()->user()->name }}</p>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn-sm btn-info"><i class="fas fa-search"></i></button>
                    <button class="btn-sm btn-info"><i class="fas fa-ellipsis-v"></i></button>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="chat-messages" id="messagesBox">
                @if($messages->count() === 0)
                    <div class="text-center text-muted py-5">Hozircha xabar yo‘q</div>
                @else
                    @foreach($messages as $msg)
                        <div class="message-item {{ $msg->user_id == auth()->id() ? 'sent' : 'received' }} {{ $msg->user->role == 'teacher' ? 'teacher-message' : '' }}" data-message-id="{{ $msg->id }}">
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
            <form action="{{ route('teacher.chats.send') }}" method="POST" class="chat-input-container" id="teacherChatForm">
                @csrf
                <input type="hidden" name="group_id" value="{{ $selectedGroup?->id ?? '' }}">
                <input type="hidden" id="lastMessageId" value="{{ $messages->last()?->id ?? '' }}">
                <button type="button" class="chat-action-btn"><i class="fas fa-paperclip"></i></button>
                <input type="text" name="message" class="chat-input" placeholder="Xabar yozing..." required autocomplete="off">
                <button type="submit" class="btn-primary" style="padding:12px 24px">Yuborish</button>
            </form>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    function bindGroupLinks() {
        document.querySelectorAll('.group-chat-item').forEach(function (el) {
            el.onclick = function (e) {
                e.preventDefault();
                const url = el.getAttribute('href');
                if (!url) return;
                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                    .then(r => r.json())
                    .then(data => {
                        document.querySelector('.col-lg-8').innerHTML = data.html;
                    }).catch(err => console.error(err));
            };
        });
    }
    bindGroupLinks();

    // Subscribe to all group channels so teacher receives messages without refreshing
    function subscribeToGroupChannel(groupId) {
        if (!groupId || !window.Echo) return;
        window.__teacherGroupChannels = window.__teacherGroupChannels || {};
        if (window.__teacherGroupChannels[groupId]) return; // already subscribed

        try {
            const ch = window.Echo.channel('group.' + groupId);
            window.__teacherGroupChannels[groupId] = ch;
            ch.listen('NewGroupMessage', function (e) {
                console.info('Teacher group.' + groupId + ' event', e);
                // Update preview badge/time
                const item = document.querySelector('.group-chat-item[data-group-id="' + groupId + '"]');
                if (item) {
                    item.querySelector('.last-message').textContent = e.message ?? e.last_message ?? '';
                    item.querySelector('.message-time').textContent = e.created_at ? (new Date(e.created_at)).toLocaleTimeString() : '';
                    const badge = item.querySelector('.unread-badge');
                    if (badge) {
                        const count = Number(badge.textContent || 0) + 1;
                        badge.textContent = count;
                        badge.style.display = '';
                    }
                }

                // If this is the currently open group, append to messages
                const currentGroupId = document.querySelector('input[name="group_id"]')?.value;
                if (String(currentGroupId) === String(e.group_id)) {
                    const box = document.getElementById('messagesBox');
                    if (box && e.html && !document.querySelector('[data-message-id="' + e.id + '"]')) {
                        box.insertAdjacentHTML('beforeend', e.html);
                        box.scrollTop = box.scrollHeight;
                    }
                    const lastInput = document.getElementById('lastMessageId');
                    if (lastInput && e.id) lastInput.value = e.id;
                }
            });
        } catch (err) {
            console.warn('Failed to subscribe to group.' + groupId, err);
        }
    }

    document.querySelectorAll('.group-chat-item').forEach(function (el) {
        const gid = el.getAttribute('data-group-id');
        if (gid) subscribeToGroupChannel(gid);
    });

    // Realtime + polling for teacher chat (similar to admin implementation)
    (function setupRealtime() {
        const getGroupId = () => document.querySelector('input[name="group_id"]')?.value;
        let lastId = Number(document.getElementById('lastMessageId')?.value || 0);
        let usingRealtime = false;

        const initChannel = () => {
            const groupId = getGroupId();
            if (!groupId) return;

            // Leave previous channel if present
            if (window.__teacherEchoChannel && window.__teacherEchoChannel.leave) {
                try { window.__teacherEchoChannel.leave(); } catch (e) {}
            }

            if (window.Echo && window.Echo.connector && window.Echo.connector.pusher) {
                const pusher = window.Echo.connector.pusher;

                const handleConnected = function () {
                    usingRealtime = true;
                    if (window.__teacherChatPollInterval) {
                        clearInterval(window.__teacherChatPollInterval);
                        window.__teacherChatPollInterval = null;
                    }
                };
                const handleDisconnected = function () {
                    usingRealtime = false;
                };

                if (pusher.connection && pusher.connection.state === 'connected') {
                    handleConnected();
                } else {
                    pusher.connection.bind('connected', handleConnected);
                    pusher.connection.bind('disconnected', handleDisconnected);
                }

                window.__teacherEchoChannel = window.Echo.channel('group.' + groupId);

                // Wait for subscription success before switching fully to realtime
                try {
                    const pusherChannel = window.Echo.connector.pusher.channel('group.' + groupId);
                    if (pusherChannel && pusherChannel.bind) {
                        pusherChannel.bind('pusher:subscription_succeeded', function () {
                            usingRealtime = true;
                            if (window.__teacherChatPollInterval) {
                                clearInterval(window.__teacherChatPollInterval);
                                window.__teacherChatPollInterval = null;
                            }
                            console.info('Teacher realtime subscription succeeded for group', groupId);
                        });
                    }
                } catch (err) {
                    console.warn('Subscription check failed', err);
                }

                window.__teacherEchoChannel.listen('NewGroupMessage', function (e) {
                    console.info('Teacher received NewGroupMessage', e);
                    if (e && e.html) {
                        if (!document.querySelector('[data-message-id="' + e.id + '"]')) {
                            const box = document.getElementById('messagesBox');
                            if (box) {
                                box.insertAdjacentHTML('beforeend', e.html);
                                box.scrollTop = box.scrollHeight;
                            }
                        }
                    }
                    // update last id
                    if (e.id) {
                        const lastInput = document.getElementById('lastMessageId');
                        if (lastInput) lastInput.value = e.id;
                        lastId = Number(e.id);
                    }

                    try {
                        const currentUserId = Number(document.querySelector('meta[name="user-id"]')?.getAttribute('content') || 0);
                        if (e.user_id && Number(e.user_id) !== currentUserId) {
                            if (window.toastr) window.toastr.info(e.message ?? 'Yangi xabar');
                        }
                    } catch (err) { console.warn(err); }

                    // update preview in list
                    if (e.message ?? e.last_message) {
                        const item = document.querySelector('.group-chat-item[data-group-id="' + groupId + '"]');
                        if (item) {
                            item.querySelector('.last-message').textContent = e.message ?? e.last_message ?? '';
                            item.querySelector('.message-time').textContent = e.created_at ? (new Date(e.created_at)).toLocaleTimeString() : '';
                            const badge = item.querySelector('.unread-badge');
                            if (badge) {
                                const count = Number(badge.textContent || 0) + 1;
                                badge.textContent = count;
                                badge.style.display = '';
                            }
                        }
                    }
                });
            }

            // Start polling if not using realtime
            if (window.__teacherChatPollInterval) clearInterval(window.__teacherChatPollInterval);
            if (!usingRealtime) {
                window.__teacherChatPollInterval = setInterval(function () {
                    fetch('/teacher/chats/' + groupId + '/poll?last_id=' + lastId, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                        .then(async r => {
                            if (r.status === 401 || r.status === 419) throw { message: 'Sessiya muddati tugagan' };
                            const ct = r.headers.get('content-type') || '';
                            if (!ct.includes('application/json')) throw { message: 'Poll failed' };
                            if (!r.ok) throw await r.json().catch(() => ({ message: 'Server error' }));
                            return r.json();
                        })
                        .then(data => {
                            if (data.html) {
                                const box = document.getElementById('messagesBox');
                                if (box) {
                                    box.insertAdjacentHTML('beforeend', data.html);
                                    box.scrollTop = box.scrollHeight;
                                }
                            }
                            if (data.last_message_id) {
                                lastId = data.last_message_id;
                                const lastInput = document.getElementById('lastMessageId');
                                if (lastInput) lastInput.value = lastId;
                            }
                            if (data.last_message) {
                                const item = document.querySelector('.group-chat-item[data-group-id="' + groupId + '"]');
                                if (item) {
                                    item.querySelector('.last-message').textContent = data.last_message ?? '';
                                    item.querySelector('.message-time').textContent = data.last_time ?? '';
                                    const badge = item.querySelector('.unread-badge');
                                    if (badge) {
                                        if ((data.messages_count ?? 0) > 0) {
                                            badge.textContent = data.messages_count;
                                            badge.style.display = '';
                                        } else {
                                            badge.style.display = 'none';
                                        }
                                    }
                                }
                            }
                            try {
                                const currentUserId = Number(document.querySelector('meta[name="user-id"]')?.getAttribute('content') || 0);
                                if (data.last_user_id && Number(data.last_user_id) !== currentUserId) {
                                    if (window.toastr) window.toastr.info(data.last_message ?? 'Yangi xabar');
                                }
                            } catch (err) { console.warn(err); }
                        }).catch(err => { console.warn('Poll error', err); });
                }, 2000);
            }
        };

        // Init and re-init when group changes via AJAX
        initChannel();
        document.addEventListener('click', function (e) {
            if (e.target.closest && e.target.closest('.group-chat-item')) {
                setTimeout(initChannel, 300);
            }
        });
    })();

    // Simple AJAX submit for teacherChatForm
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (form && form.id === 'teacherChatForm') {
            e.preventDefault();
            const data = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') },
                body: data
            }).then(async r => {
                const ct = r.headers.get('content-type') || '';
                if (!ct.includes('application/json')) throw new Error('Server error');
                const json = await r.json();
                if (json.message_html && json.message_id) {
                    const box = document.getElementById('messagesBox');
                    if (box && !document.querySelector('[data-message-id="' + json.message_id + '"]')) {
                        box.insertAdjacentHTML('beforeend', json.message_html);
                        box.scrollTop = box.scrollHeight;
                    }
                }
                form.querySelector('input[name="message"]').value = '';
            }).catch(err => { console.error(err); alert('Xatolik yuz berdi'); });
        }
    });
});
</script>
@endsection
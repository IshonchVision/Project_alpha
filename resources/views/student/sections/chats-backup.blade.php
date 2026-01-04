{{-- resources/views/student/sections/chats.blade.php --}}
@extends('student.layout')

@section('title', 'Guruh Chatlari')
@section('page-title', 'Guruh Chatlari')

@section('content')
<div class="row" style="margin:0">
    <!-- GURUHLAR RO'YXATI -->
    <div class="col-lg-4" style="padding:0 15px">
        <div class="card" style="height:calc(100vh - 150px)">
            <div class="card-header">
                <h4>Guruhlar</h4>
                <input type="text" class="form-control mt-3" placeholder="Qidirish..." id="search">
            </div>
            <div class="card-body p-0 overflow-y-auto">
                @foreach($groups as $group)
                    <a href="{{ route('student.chats.group', $group->id) }}"
                       class="group-chat-item d-flex align-items-center p-3 border-bottom text-decoration-none {{ $selectedGroup?->id == $group->id ? 'active' : '' }}"
                       data-group-id="{{ $group->id }}">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($group->name) }}&background=random&color=fff&bold=true"
                             class="rounded-circle me-3" width="50" height="50" alt="{{ $group->name }}">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 group-name">{{ $group->name }}</h6>
                            <p class="mb-0 text-muted small last-message">
                                {{ $group->messages->first()?->message ? Str::limit($group->messages->first()->message, 30) : "Xabar yo'q" }}
                            </p>
                        </div>
                        <div class="text-end">
                            <small class="text-muted message-time d-block">
                                {{ $group->messages->first()?->created_at->diffForHumans() ?? '' }}
                            </small>
                            @if($group->messages_count ?? 0 > 0)
                                <span class="badge bg-primary rounded-pill unread-badge">{{ $group->messages_count }}</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CHAT OYNASI -->
    <div class="col-lg-8" style="padding:0 15px">
        <div id="chatContainer">
            @include('student.sections.chat-window')
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .group-chat-item {
        cursor: pointer;
        transition: background 0.2s;
    }
    .group-chat-item:hover {
        background-color: #f8f9fa;
    }
    .group-chat-item.active {
        background-color: #e7f3ff;
        border-left: 4px solid #0d6efd;
    }
    .unread-badge {
        font-size: 0.75rem;
    }
    .overflow-y-auto {
        overflow-y: auto;
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let lastId = 0;
    let currentGroupId = null;

    function bindGroupLinks() {
        document.querySelectorAll('.group-chat-item').forEach(el => {
            el.onclick = function (e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                const groupId = this.getAttribute('data-group-id');

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(async r => {
                    if (r.status === 401 || r.status === 419) {
                        throw { message: 'Sessiya muddati tugagan. Iltimos, qayta kiring.' };
                    }
                    const ct = r.headers.get('content-type') || '';
                    if (!ct.includes('application/json')) {
                        throw { message: 'Xatolik yuz berdi. Sahifani yangilang.' };
                    }
                    if (!r.ok) throw await r.json().catch(() => ({ message: 'Server xatosi' }));
                    return r.json();
                })
                .then(data => {
                    document.getElementById('chatContainer').innerHTML = data.html;
                    document.querySelectorAll('.group-chat-item').forEach(i => i.classList.remove('active'));
                    el.classList.add('active');

                    currentGroupId = groupId;
                    lastId = data.last_message_id || 0;

                    // Guruh preview yangilash
                    updateGroupPreview(data);

                    bindGroupLinks();
                    initChatWindow();
                })
                .catch(err => {
                    console.error('Load group error:', err);
                    alert(err.message || 'Guruh yuklanmadi.');
                });
            };
        });
    }

    function updateGroupPreview(data) {
        if (!data.group_id) return;
        
        const item = document.querySelector(`.group-chat-item[data-group-id="${data.group_id}"]`);
        if (!item) return;

        if (data.last_message) {
            const msgEl = item.querySelector('.last-message');
            if (msgEl) msgEl.textContent = data.last_message.substring(0, 30) + (data.last_message.length > 30 ? '...' : '');
        }
        
        if (data.last_time) {
            const timeEl = item.querySelector('.message-time');
            if (timeEl) timeEl.textContent = data.last_time;
        }

        const badge = item.querySelector('.unread-badge');
        if (badge && data.messages_count) {
            badge.textContent = data.messages_count;
            badge.style.display = '';
        }
    }

    // Qidiruv
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.group-chat-item').forEach(item => {
                const name = item.querySelector('.group-name').textContent.toLowerCase();
                item.style.display = name.includes(query) ? '' : 'none';
            });
        });
    }

    function initChatWindow() {
        const messagesBox = document.getElementById('messagesBox');
        if (messagesBox) messagesBox.scrollTop = messagesBox.scrollHeight;

        const lastMessageInput = document.getElementById('lastMessageId');
        if (lastMessageInput) lastId = Number(lastMessageInput.value || 0);

        const groupIdInput = document.getElementById('chatGroupId');
        if (!groupIdInput) {
            console.log('Group ID input not found');
            return;
        }
        
        currentGroupId = groupIdInput.value;
        console.log('Chat initialized for group:', currentGroupId);

        // Setup send button
        const sendBtn = document.getElementById('chatSendBtn');
        const messageInput = document.getElementById('chatMessageInput');
        
        if (!sendBtn || !messageInput) {
            console.log('Send button or message input not found');
            return;
        }
        
        console.log('Chat elements found, attaching handlers');
        
        // Button click
        sendBtn.onclick = function() {
            console.log('Send button clicked!');
            sendChatMessage();
        };
        
        // Enter key
        messageInput.onkeypress = function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                console.log('Enter pressed!');
                sendChatMessage();
            }
        };
        
        function sendChatMessage() {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            if (!token) {
                alert('CSRF token topilmadi. Sahifani yangilang.');
                return;
            }

            const message = messageInput.value.trim();
            if (!message) {
                console.log('Empty message');
                return;
            }

            console.log('Sending message:', message);
            sendBtn.disabled = true;
            
            const formData = new FormData();
            formData.append('group_id', currentGroupId);
            formData.append('message', message);

            fetch("/student/chats/send", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async r => {
                console.log('Response status:', r.status);
                const contentType = r.headers.get('content-type') || '';
                if (!contentType.includes('application/json')) {
                    const text = await r.text();
                    console.error('Non-JSON response:', text.substring(0, 200));
                    throw { message: 'Server xatosi' };
                }
                const data = await r.json();
                if (!r.ok) {
                    console.error('Server error:', data);
                    throw data;
                }
                return data;
            })
            .then(data => {
                console.log('Success:', data);
                
                if (data.success && data.message_html && data.message_id) {
                    const existingMsg = document.querySelector(`[data-message-id="${data.message_id}"]`);
                    if (!existingMsg && messagesBox) {
                        messagesBox.insertAdjacentHTML('beforeend', data.message_html);
                        messagesBox.scrollTop = messagesBox.scrollHeight;
                    }
                    if (lastMessageInput) lastMessageInput.value = data.message_id;
                    lastId = data.message_id;

                    updateGroupPreview(data);
                    messageInput.value = '';
                } else {
                    console.error('Invalid response:', data);
                    throw { message: 'Xabar yuborilmadi' };
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert(err.message || 'Xatolik yuz berdi');
            })
            .finally(() => {
                sendBtn.disabled = false;
            });
        }

        // Polling (har 2.5 soniyada yangi xabarlarni tekshirish)
        if (window.__studentChatPoll) clearInterval(window.__studentChatPoll);

        window.__studentChatPoll = setInterval(() => {
            if (!currentGroupId) return;

            fetch(`/student/chats/${currentGroupId}/poll?last_id=${lastId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(r => r.ok ? r.json() : Promise.reject())
            .then(data => {
                if (data.html) {
                    messagesBox?.insertAdjacentHTML('beforeend', data.html);
                    messagesBox?.scrollTop = messagesBox.scrollHeight;
                }
                
                if (data.last_message_id) {
                    lastId = data.last_message_id;
                    if (lastMessageInput) lastMessageInput.value = lastId;
                }

                // Preview yangilash
                if (data.last_message && data.group_id) {
                    const item = document.querySelector(`.group-chat-item[data-group-id="${currentGroupId}"]`);
                    if (item) {
                        const msgEl = item.querySelector('.last-message');
                        if (msgEl) msgEl.textContent = data.last_message.substring(0, 30) + (data.last_message.length > 30 ? '...' : '');
                        
                        const timeEl = item.querySelector('.message-time');
                        if (timeEl && data.last_time) timeEl.textContent = data.last_time;
                        
                        const badge = item.querySelector('.unread-badge');
                        if (badge && data.messages_count) {
                            badge.textContent = data.messages_count;
                            badge.style.display = '';
                        }
                    }
                }
            })
            .catch(err => {
                console.error('Poll error:', err);
            });
        }, 2500);
    }

    // Boshida faollashtirish
    bindGroupLinks();
    initChatWindow();
});
</script>
@endsection
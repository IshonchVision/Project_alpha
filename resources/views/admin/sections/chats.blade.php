@extends('admin.layout')

@section('title', 'Guruh Chatlari')
@section('page-title', 'Guruh Chatlari')

@section('content')
<div class="row" style="margin:0">
    <!-- GURUHLAR -->
    <div class="col-lg-4" style="padding:0 15px">
        <div class="card" style="height:calc(100vh - 150px)">
            <div class="card-header">
                <h4>Guruhlar</h4>
                <input type="text" class="form-control mt-3" placeholder="Qidirish..." id="search">
            </div>
            <div class="card-body p-0 overflow-y-auto">
                @foreach($groups as $group)
                             <a href="{{ route('admin.chats.group', $group->id) }}"
                                 class="group-chat-item {{ $selectedGroup?->id == $group->id ? 'active' : '' }}" data-group-id="{{ $group->id }}">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($group->name) }}&background=random&color=fff&bold=true"
                         class="group-avatar">
                    <div class="group-info">
                        <h6 class="group-name">{{ $group->name }}</h6>
                        <p class="last-message">
                            {{ $group->messages->first()?->message ? Str::limit($group->messages->first()->message, 30) : 'Xabar yo‘q' }}
                        </p>
                    </div>
                    <div class="group-meta">
                        <span class="message-time">
                            {{ $group->messages->first()?->created_at->diffForHumans() ?? '' }}
                        </span>
                        @if($group->messages_count > 0)
                            <span class="unread-badge">{{ $group->messages_count }}</span>
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
            @include('admin.sections.chat-window')
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Group link click -> load chat via AJAX and update list
    function bindGroupLinks() {
        document.querySelectorAll('.group-chat-item').forEach(function (el) {
            el.onclick = function (e) {
                e.preventDefault();
                const url = el.getAttribute('href');
                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                    .then(r => r.json())
                    .then(data => {
                        document.getElementById('chatContainer').innerHTML = data.html;
                        bindGroupLinks(); // rebind in case UI changed
                        initChatWindow();
                        // Update active class
                        document.querySelectorAll('.group-chat-item').forEach(i => i.classList.remove('active'));
                        el.classList.add('active');
                        // Update group preview
                        const item = document.querySelector('.group-chat-item[data-group-id="' + data.group_id + '"]');
                        if (item) {
                            item.querySelector('.last-message').textContent = data.last_message ?? '';
                            item.querySelector('.message-time').textContent = data.last_time ?? '';
                            const badge = item.querySelector('.unread-badge');
                            if (badge) badge.textContent = data.messages_count ?? '';
                        }
                    })
                    .catch(console.error);
            };
        });
    }

    // Simple client-side search for groups
    const search = document.getElementById('search');
    if (search) {
        search.addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.group-chat-item').forEach(function (item) {
                const name = item.querySelector('.group-name')?.textContent?.toLowerCase() || '';
                item.style.display = name.includes(q) ? '' : 'none';
            });
        });
    }

    // Initialize group links and chat window on load
    bindGroupLinks();
    // init chat behaviors: scroll and AJAX submit
    function initChatWindow() {
        const box = document.getElementById('messagesBox');
        if (box) box.scrollTop = box.scrollHeight;

        const form = document.getElementById('adminChatForm');
        if (!form) return;

        form.onsubmit = function (e) {
            e.preventDefault();
            const data = new FormData(form);
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: data
            })
            .then(r => r.json())
            .then(data => {
                // Replace chat window HTML
                const container = document.getElementById('chatContainer');
                if (container && data.html) container.innerHTML = data.html;
                // Rebind
                bindGroupLinks();
                initChatWindow();

                // Update group preview
                if (data.group_id) {
                    const item = document.querySelector('.group-chat-item[data-group-id="' + data.group_id + '"]');
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
            })
            .catch(console.error);
        };

        // Start polling for new messages for this group
        const groupId = document.querySelector('input[name="group_id"]')?.value;
        if (!groupId) return;

        // Clear previous poll
        if (window.__adminChatPollInterval) {
            clearInterval(window.__adminChatPollInterval);
        }

        // Read last message id
        let lastId = Number(document.getElementById('lastMessageId')?.value || 0);

        window.__adminChatPollInterval = setInterval(function () {
            fetch('/admin/chats/' + groupId + '/poll?last_id=' + lastId, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(r => r.json())
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

                    // Update group preview
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
                })
                .catch(console.error);
        }, 2000);
    }
    initChatWindow();
});
</script>
@endsection
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
                    .then(async r => {
                        if (r.status === 401 || r.status === 419) {
                            throw { message: 'Sessiya muddati tugagan. Iltimos, tizimga qayta kiring.' };
                        }
                        const ct = r.headers.get('content-type') || '';
                        // If the server returned HTML (likely a redirect to login), show friendly message
                        if (!ct.includes('application/json')) {
                            const text = await r.text();
                            console.error('Expected JSON but got HTML/text:', text);
                            throw { message: 'Guruh yuklanmadi. Iltimos, sahifani yangilang yoki tizimga qayta kiring.' };
                        }
                        if (!r.ok) {
                            const err = await r.json().catch(() => ({ message: 'Server error' }));
                            throw err;
                        }
                        return r.json();
                    })
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
                    .catch(err => {
                        console.error('Load chat error', err);
                        alert(err && err.message ? err.message : 'Guruh yuklanmadi. Iltimos, sahifani yangilang.');
                    });
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

        // Track last seen message id for polling deduplication
        let lastId = Number(document.getElementById('lastMessageId')?.value || 0);

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
            .then(async r => {
                if (r.status === 401 || r.status === 419) {
                    throw { message: 'Sessiya muddati tugagan. Iltimos, tizimga qayta kiring.' };
                }
                const ct = r.headers.get('content-type') || '';
                if (!ct.includes('application/json')) {
                    const text = await r.text();
                    console.error('Expected JSON but got HTML/text on send:', text);
                    throw { message: 'Xabar yuborilmadi. Iltimos, sahifani yangilang yoki tizimga qayta kiring.' };
                }
                if (!r.ok) {
                    const err = await r.json().catch(() => ({ message: 'Server error' }));
                    throw err;
                }
                return r.json();
            })
            .then(data => {
                // If Echo (websockets) is active, the broadcast may not reach the sender,
                // so append the message_html returned by the API if present (avoid duplicates).
                const box = document.getElementById('messagesBox');

                if (window.Echo) {
                    if (data.message_html && data.message_id) {
                        // only append if message id not present
                        if (!document.querySelector('[data-message-id="' + data.message_id + '"]')) {
                            box?.insertAdjacentHTML('beforeend', data.message_html);
                            box?.scrollTo({ top: box.scrollHeight, behavior: 'smooth' });
                        }
                        // Update both DOM input and our local lastId so polling won't re-fetch it
                        const lastInput = document.getElementById('lastMessageId');
                        if (lastInput) lastInput.value = data.message_id;
                        lastId = Number(data.message_id);
                    }
                } else {
                    if (data.html) {
                        const container = document.getElementById('chatContainer');
                        if (container) container.innerHTML = data.html;
                        bindGroupLinks();
                        initChatWindow();
                        // If server sent a last_message_id, keep our local lastId in sync
                        if (data.last_message_id) {
                            lastId = Number(data.last_message_id);
                        }
                    }
                }

                // Update group preview in both cases
                if (data.group_id) {
                    const item = document.querySelector('.group-chat-item[data-group-id="' + data.group_id + '"]');
                    if (item) {
                        if (data.last_message) item.querySelector('.last-message').textContent = data.last_message ?? '';
                        if (data.last_time) item.querySelector('.message-time').textContent = data.last_time ?? '';
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

                // Clear input after success
                const input = document.querySelector('#adminChatForm input[name="message"]');
                if (input) input.value = '';
            })
            .catch(err => {
                console.error('Send message error', err);
                let msg = 'Xabar yuborishda xatolik yuz berdi.';
                if (err && err.errors) {
                    const first = Object.values(err.errors)[0];
                    if (first) msg = first[0];
                } else if (err && err.message) {
                    msg = err.message;
                }
                alert(msg);
            });
        };

        const groupId = document.querySelector('input[name="group_id"]')?.value;
        if (!groupId) return;

        // If Echo (WebSockets) is available, try to use it; fall back to polling until connected
        let usingRealtime = false;
        if (window.Echo && window.Echo.connector && window.Echo.connector.pusher) {
            // Unsubscribe previous channel if any
            if (window.__adminEchoChannel && window.__adminEchoChannel.leave) {
                try { window.__adminEchoChannel.leave(); } catch (e) { }
            }

            const pusher = window.Echo.connector.pusher;
            // Track connection state
            const handleConnected = function () {
                usingRealtime = true;
                console.info('Pusher connected, switching to realtime for group', groupId);
                // Stop polling if running
                if (window.__adminChatPollInterval) {
                    clearInterval(window.__adminChatPollInterval);
                    window.__adminChatPollInterval = null;
                }
                const status = document.getElementById('realtimeStatus');
                if (status) status.textContent = 'Realtime: ulandi';
            };

            const handleDisconnected = function () {
                usingRealtime = false;
                console.warn('Pusher disconnected, will use polling fallback for group', groupId);
                const status = document.getElementById('realtimeStatus');
                if (status) status.textContent = 'Realtime: ulanmagan (polling)';
                // start polling below (function continues)
            };

            // If already connected, mark realtime immediately
            if (pusher.connection && pusher.connection.state === 'connected') {
                handleConnected();
            } else {
                pusher.connection.bind('connected', handleConnected);
                pusher.connection.bind('disconnected', handleDisconnected);
            }

            window.__adminEchoChannel = window.Echo.channel('group.' + groupId);
            window.__adminEchoChannel.listen('NewGroupMessage', function (e) {
                if (e && e.html) {
                    // avoid duplicate messages
                    if (!document.querySelector('[data-message-id="' + e.id + '"]')) {
                        const box = document.getElementById('messagesBox');
                        if (box) {
                            box.insertAdjacentHTML('beforeend', e.html);
                            box.scrollTop = box.scrollHeight;
                        }
                    }
                }
                // update lastMessageId
                if (e.id) {
                    const lastInput = document.getElementById('lastMessageId');
                    if (lastInput) lastInput.value = e.id;
                    lastId = Number(e.id);
                }

                // Show a toast for messages coming from other users
                try {
                    const currentUserId = Number(document.querySelector('meta[name="user-id"]')?.getAttribute('content') || 0);
                    if (e.user_id && Number(e.user_id) !== currentUserId) {
                        if (window.toastr) {
                            window.toastr.info(e.message ?? 'Yangi xabar');
                        }
                    }
                } catch (err) {
                    console.warn('Toast show failed', err);
                }
                // update preview
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
            // If not connected yet, we continue to poll until handleConnected() clears it.
        }

        // Clear previous poll
        if (window.__adminChatPollInterval) {
            clearInterval(window.__adminChatPollInterval);
        }

        // If we're not using realtime yet, show polling status to user
        if (!usingRealtime) {
            const status = document.getElementById('realtimeStatus');
            if (status) status.textContent = 'Realtime: ulanmagan (polling)';
        }

        // Polling uses the `lastId` that we keep updated above

        window.__adminChatPollInterval = setInterval(function () {
            fetch('/admin/chats/' + groupId + '/poll?last_id=' + lastId, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(async r => {
                    if (r.status === 401 || r.status === 419) {
                        throw { message: 'Sessiya muddati tugagan. Iltimos, tizimga qayta kiring.' };
                    }
                    const ct = r.headers.get('content-type') || '';
                    if (!ct.includes('application/json')) {
                        const text = await r.text();
                        console.error('Expected JSON but got HTML/text on poll:', text);
                        throw { message: 'Poll failed' };
                    }
                    if (!r.ok) {
                        const err = await r.json().catch(() => ({ message: 'Server error' }));
                        throw err;
                    }
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
                    // If polling returned a new message from another user, show toast
                    try {
                        const currentUserId = Number(document.querySelector('meta[name="user-id"]')?.getAttribute('content') || 0);
                        if (data.last_user_id && Number(data.last_user_id) !== currentUserId) {
                            if (window.toastr) {
                                window.toastr.info(data.last_message ?? 'Yangi xabar');
                            }
                        }
                    } catch (err) { console.warn('Poll toast failed', err); }
                })
                .catch(err => {
                    console.error('Poll error', err);
                });
        }, 2000);
    }
    initChatWindow();
});
</script>
@endsection
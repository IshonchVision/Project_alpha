@if($selectedGroup ?? null)
<div class="card" style="height:calc(100vh - 150px);display:flex;flex-direction:column">
    <div class="chat-window-header">
        <div style="display:flex;align-items:center;gap:15px">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($selectedGroup->name) }}&background=random&color=fff&bold=true"
                 style="width:50px;height:50px;border-radius:50%">
            <div>
                <h5 style="margin:0;font-weight:800">{{ $selectedGroup->name }}</h5>
                <p style="margin:0;color:#64748b;font-size:14px">
                    {{ $selectedGroup->students_count ?? 0 }} o'quvchi • 
                    O'qituvchi: {{ $selectedGroup->teacher?->name ?? 'Yo‘q' }}
                </p>
            </div>
        </div>
    </div>

    <div class="chat-messages" id="messagesBox">
        @forelse($messages as $msg)
        <div class="message-item {{ $msg->user_id == auth()->id() ? 'sent' : 'received' }} {{ $msg->user->role == 'teacher' ? 'teacher-message' : '' }}">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($msg->user->name) }}&background=random&color=fff"
                 class="message-avatar">
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
        @empty
        <div class="text-center text-muted py-5">Hozircha xabar yo‘q</div>
        @endforelse
    </div>

    <form action="{{ route('admin.chats.send') }}" method="POST" class="chat-input-container">
        @csrf
        <input type="hidden" name="group_id" value="{{ $selectedGroup->id }}">
        <button type="button" class="chat-action-btn">Clip</button>
        <input type="text" name="message" class="chat-input" placeholder="Xabar yozing..." required autocomplete="off">
        <button type="submit" class="btn-primary" style="padding:12px 24px">Yuborish</button>
    </form>
</div>
@else
<div class="d-flex align-items-center justify-content-center h-100">
    <div class="text-center text-muted">
        <i class="fas fa-comments fa-4x mb-3"></i>
        <h5>Guruh tanlang</h5>
    </div>
</div>
@endif

<script>
document.querySelector('.chat-messages')?.scrollTop = document.querySelector('.chat-messages')?.scrollHeight;
</script>
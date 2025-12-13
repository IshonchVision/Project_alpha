<div class="message-item {{ $msg->user_id == auth()->id() ? 'sent' : 'received' }} {{ $msg->user->role == 'teacher' ? 'teacher-message' : '' }}" data-message-id="{{ $msg->id }}">
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

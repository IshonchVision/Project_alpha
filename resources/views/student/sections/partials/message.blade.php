{{-- resources/views/student/sections/partials/message.blade.php --}}
<div class="message mb-3 d-flex {{ $msg->user_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}" 
     data-message-id="{{ $msg->id }}">
    <div class="message-content" style="max-width: 70%;">
        @if($msg->user_id != Auth::id())
            <div class="d-flex align-items-start">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($msg->user->name) }}&background=random&color=fff&size=32" 
                     class="rounded-circle me-2" 
                     width="32" 
                     height="32" 
                     alt="{{ $msg->user->name }}">
                <div>
                    <small class="text-muted d-block mb-1">{{ $msg->user->name }}</small>
                    <div class="p-2 rounded bg-light">
                        <p class="mb-0">{{ $msg->message }}</p>
                    </div>
                    <small class="text-muted" style="font-size: 0.75rem;">
                        {{ $msg->created_at->format('H:i') }}
                    </small>
                </div>
            </div>
        @else
            <div class="text-end">
                <small class="text-muted d-block mb-1">Siz</small>
                <div class="p-2 rounded bg-primary text-white">
                    <p class="mb-0">{{ $msg->message }}</p>
                </div>
                <small class="text-muted" style="font-size: 0.75rem;">
                    {{ $msg->created_at->format('H:i') }}
                </small>
            </div>
        @endif
    </div>
</div>

@php
    $groupVar = $selectedGroup ?? ($group ?? null);
@endphp
@if($groupVar)
<div class="card" style="height:calc(100vh - 150px);display:flex;flex-direction:column">
    <div class="chat-window-header">
        <div style="display:flex;align-items:center;gap:15px">
              <img src="https://ui-avatars.com/api/?name={{ urlencode($groupVar->name) }}&background=random&color=fff&bold=true"
                 style="width:50px;height:50px;border-radius:50%">
            <div>
                <h5 style="margin:0;font-weight:800">{{ $groupVar->name }}</h5>
                    <p style="margin:0;color:#64748b;font-size:14px">
                        {{ $groupVar->current_students ?? 0 }} o'quvchi • 
                        O'qituvchi: {{ $groupVar->teacher?->name ?? 'Yo‘q' }}
                </p>
                <div style="font-size:12px;color:#94a3b8;margin-top:4px">
                    <span id="realtimeStatus">Realtime: ulanmoqda...</span>
                </div>
            </div>
        </div>
    </div>

    <div class="chat-messages" id="messagesBox">
        @forelse($messages as $msg)
            @include('admin.sections.partials.message', ['msg' => $msg])
        @empty
        <div class="text-center text-muted py-5">Hozircha xabar yo‘q</div>
        @endforelse
    </div>

    <form action="{{ route('admin.chats.send') }}" method="POST" class="chat-input-container" id="adminChatForm">
        @csrf
        <input type="hidden" name="group_id" value="{{ $groupVar->id }}">
        <input type="hidden" id="lastMessageId" value="{{ $messages->last()?->id ?? '' }}">
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
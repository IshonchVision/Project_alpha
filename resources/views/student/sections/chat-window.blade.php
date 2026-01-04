{{-- resources/views/student/sections/chat-window.blade.php --}}
@if($selectedGroup ?? false)
<div class="card" style="height:calc(100vh - 150px); display:flex; flex-direction:column;">
    <!-- Chat header -->
    <div class="card-header d-flex align-items-center">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($selectedGroup->name) }}&background=random&color=fff&bold=true"
             class="rounded-circle me-3" width="45" height="45" alt="{{ $selectedGroup->name }}">
        <div>
            <h5 class="mb-0">{{ $selectedGroup->name }}</h5>
            <small class="text-muted">
                O'qituvchi: {{ $selectedGroup->teacher->name ?? 'Noma\'lum' }}
            </small>
        </div>
    </div>

    <!-- Messages area -->
    <div class="card-body overflow-y-auto flex-grow-1 p-3" id="messagesBox">
        @foreach($messages ?? [] as $msg)
            @include('student.sections.partials.message', ['msg' => $msg])
        @endforeach
    </div>

    <!-- Input form -->
    <div class="card-footer">
        <div class="d-flex gap-2">
            <input type="hidden" id="chatGroupId" value="{{ $selectedGroup->id }}">
            <input type="hidden" id="lastMessageId" value="{{ $messages->last()?->id ?? 0 }}">
            
            <input type="text" 
                   class="form-control" 
                   placeholder="Xabar yozing..." 
                   autocomplete="off"
                   id="chatMessageInput"
                   onkeypress="if(event.key==='Enter'){event.preventDefault();sendStudentMessage();}">
            <button type="button" 
                    class="btn btn-primary" 
                    onclick="sendStudentMessage()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<script>
function sendStudentMessage() {
    console.log('sendStudentMessage called');
    
    const messageInput = document.getElementById('chatMessageInput');
    const groupIdInput = document.getElementById('chatGroupId');
    const lastMessageInput = document.getElementById('lastMessageId');
    const messagesBox = document.getElementById('messagesBox');
    
    if (!messageInput || !groupIdInput) {
        console.error('Required elements not found');
        return;
    }
    
    const message = messageInput.value.trim();
    if (!message) {
        console.log('Empty message');
        return;
    }
    
    const groupId = groupIdInput.value;
    console.log('Sending:', message, 'to group:', groupId);
    
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!token) {
        alert('CSRF token yo\'q. Sahifani yangilang.');
        return;
    }
    
    const formData = new FormData();
    formData.append('group_id', groupId);
    formData.append('message', message);
    
    fetch('/student/chats/send', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(r => {
        console.log('Response:', r.status);
        return r.json();
    })
    .then(data => {
        console.log('Data:', data);
        if (data.success && data.message_html) {
            if (messagesBox) {
                messagesBox.insertAdjacentHTML('beforeend', data.message_html);
                messagesBox.scrollTop = messagesBox.scrollHeight;
            }
            if (lastMessageInput && data.message_id) {
                lastMessageInput.value = data.message_id;
            }
            messageInput.value = '';
        } else {
            alert('Xabar yuborilmadi: ' + (data.message || 'Noma\'lum xato'));
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Xatolik: ' + err.message);
    });
}
</script>
</div>
@else
<div class="card" style="height:calc(100vh - 150px)">
    <div class="card-body d-flex align-items-center justify-content-center">
        <div class="text-center text-muted">
            <i class="fas fa-comments fa-3x mb-3"></i>
            <p>Guruh tanlang</p>
        </div>
    </div>
</div>
@endif
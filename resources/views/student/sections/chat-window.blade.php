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
        <form id="studentChatForm" class="d-flex gap-2">
            @csrf
            <input type="hidden" name="group_id" value="{{ $selectedGroup->id }}">
            <input type="hidden" id="lastMessageId" value="{{ $messages->last()?->id ?? 0 }}">
            
            <input type="text" 
                   name="message" 
                   class="form-control" 
                   placeholder="Xabar yozing..." 
                   required 
                   autocomplete="off">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </div>
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
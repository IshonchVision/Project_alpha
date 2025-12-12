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
                   class="group-chat-item {{ $selectedGroup?->id == $group->id ? 'active' : '' }}">
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
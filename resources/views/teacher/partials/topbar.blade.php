<div class="top-bar">
    <h1 class="page-title">@yield('page-title', 'Bosh Sahifa')</h1>
    <div class="user-info">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff" alt="Teacher" class="avatar">
        <div>
            <h5 style="margin: 0; font-weight: 800; font-size: 16px;">{{ Auth::user()->name }}</h5>
            <p style="margin: 0; color: #64748b; font-size: 14px;">{{ Auth::user()->subject ?? (Auth::user()->role == 'teacher' ? "O'qituvchi" : '') }}</p>
        </div>
    </div>
</div>
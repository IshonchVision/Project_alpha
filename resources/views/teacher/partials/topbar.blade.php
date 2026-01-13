<div class="top-bar">
    <div class="d-flex align-items-center">
        <button class="menu-toggle d-md-none border-0 bg-transparent me-3" id="sidebarCollapse">
            <i class="fas fa-bars" style="font-size: 24px; color: var(--primary);"></i>
        </button>

        <h1 class="page-title mb-0">@yield('page-title', 'Bosh Sahifa')</h1>
    </div>

    <div class="user-info">
        <img src="{{ Auth::user()->avatar
            ? Storage::disk('s3')->url(Auth::user()->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=10b981&color=fff' }}"
            alt="Teacher" class="avatar"
            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary);">
        <div>
            <h5 style="margin: 0; font-weight: 800; font-size: 16px;">{{ Auth::user()->name }}</h5>
            <p style="margin: 0; color: #64748b; font-size: 14px;">
                {{ Auth::user()->speciality ?? (Auth::user()->role == 'teacher' ? "O'qituvchi" : '') }}
            </p>
        </div>
    </div>
</div>

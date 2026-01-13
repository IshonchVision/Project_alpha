<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::id() }}">
    <meta name="reverb-key" content="{{ env('REVERB_APP_KEY') }}">
    <meta name="reverb-host" content="{{ env('REVERB_HOST') }}">
    <meta name="reverb-port" content="{{ env('REVERB_PORT') }}">
    <meta name="reverb-scheme" content="{{ env('REVERB_SCHEME') }}">
    <title>Talaba Paneli - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        :root {
            --primary: #3b82f6;
            --secondary: #2563eb;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #06b6d4;
            --dark: #0f172a;
            --light: #f1f5f9;
            --sidebar-bg: #1e293b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        /* SIDEBAR - RASMDAGIDEK SKROMNIY */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: var(--sidebar-bg);
            padding: 0;
            overflow-y: auto;
            box-shadow: 5px 0 30px rgba(0,0,0,0.4);
            z-index: 1100;
            transition: all 0.3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .brand h3 {
            color: white;
            font-size: 22px;
            font-weight: 800;
            margin: 0;
        }

        .sidebar-close {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 22px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 12px;
            margin: 0 15px 8px 15px;
            transition: all 0.3s;
            font-weight: 600;
        }

        .menu-link:hover, .menu-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .menu-link.active {
            background: var(--primary);
            box-shadow: 0 4px 15px rgba(59,130,246,0.4);
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .top-bar {
            background: white;
            padding: 15px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: #1e293b;
            margin: 0;
        }

        .mobile-toggle {
            display: none;
            background: white;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 10px;
            cursor: pointer;
        }

        /* STATS & CARDS (Originalingdek qoldi) */
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .sidebar { left: -280px; }
            .sidebar.active { left: 0; }
            .sidebar-close { display: block; }
            .main-content { margin-left: 0; padding: 15px; }
            .mobile-toggle { display: block; }
            .top-bar { padding: 15px; }
            .page-title { font-size: 18px; }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1090;
        }
        .sidebar-overlay.active { display: block; }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="overlay" onclick="toggleSidebar()"></div>

    <div class="sidebar" id="sidebar">
        <div class="brand">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-user-graduate text-primary fa-lg"></i>
                <h3>Talaba Paneli</h3>
            </div>
            <button class="sidebar-close" onclick="toggleSidebar()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="menu" style="list-style: none; padding: 0;">
            <li><a href="{{ route('student.courses') }}" class="menu-link {{ request()->routeIs('student.courses') ? 'active' : '' }}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('student.chats') }}" class="menu-link {{ request()->routeIs('student.chats') ? 'active' : '' }}"><i class="fas fa-comments"></i> <span>Chatlar</span></a></li>
            <li><a href="{{ route('student.settings') }}" class="menu-link {{ request()->routeIs('student.settings') ? 'active' : '' }}"><i class="fas fa-cog"></i> <span>Sozlamalar</span></a></li>
             <li class="menu-item">
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
            <a href="#" class="menu-link text-danger" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Chiqish</span>
            </a>
        </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="user-info d-flex align-items-center gap-2">
                <div class="text-end d-none d-sm-block">
                    <h6 class="mb-0 fw-bold">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">Talaba</small>
                </div>
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        @yield('content')
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pusher-js@8.3.0/dist/web/pusher.min.js"></script>
<script src="https://unpkg.com/laravel-echo/dist/echo.iife.js"></script>
<script>
    // SIDEBAR TOGGLE
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('overlay').classList.toggle('active');
    }

    // --- SIZNING ORIGINAL REVERB/ECHO KODLARINGIZ ---
    (function() {
        const key = document.querySelector('meta[name="reverb-key"]')?.getAttribute('content');
        const host = document.querySelector('meta[name="reverb-host"]')?.getAttribute('content') || 'localhost';
        const port = document.querySelector('meta[name="reverb-port"]')?.getAttribute('content') || '8080';
        const scheme = document.querySelector('meta[name="reverb-scheme"]')?.getAttribute('content') || 'http';

        if (!key) return;

        try {
            window.Echo = new window.Echo({
                broadcaster: 'reverb',
                key: key,
                wsHost: host,
                wsPort: port,
                wssPort: port,
                forceTLS: scheme === 'https',
                enabledTransports: ['ws', 'wss'],
                disableStats: true,
            });
        } catch (e) { console.error('Echo init error', e); }
    })();

    // TOASTR SOZLAMALARI
    toastr.options = { "closeButton": true, "progressBar": true, "positionClass": "toast-top-right", "timeOut": "5000" }
    @if(session('success')) toastr.success("{{ session('success') }}") @endif
    @if(session('error')) toastr.error("{{ session('error') }}") @endif
    @if($errors->any()) toastr.error("{{ $errors->first() }}") @endif
</script>
@yield('scripts')
</body>
</html>

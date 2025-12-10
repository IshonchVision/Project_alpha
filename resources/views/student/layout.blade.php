<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talaba Paneli - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #172554 0%, #1e3a8a 100%);
            padding: 20px;
            overflow-y: auto;
            box-shadow: 5px 0 30px rgba(0,0,0,0.4);
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px 10px;
            border-bottom: 2px solid rgba(255,255,255,0.1);
            margin-bottom: 30px;
        }

        .brand i {
            font-size: 38px;
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand h3 {
            color: white;
            font-size: 26px;
            font-weight: 800;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 16px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 14px;
            transition: all 0.3s;
            font-weight: 600;
        }

        .menu-link:hover, .menu-link.active {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(10px);
        }

        .menu-link.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 10px 30px rgba(59,130,246,0.5);
        }

        .main-content {
            margin-left: 280px;
            padding: 35px;
            min-height: 100vh;
        }

        .top-bar {
            background: white;
            padding: 28px 40px;
            border-radius: 24px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-title {
            font-size: 34px;
            font-weight: 900;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .search-input {
            padding: 12px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            width: 300px;
            font-size: 15px;
        }

        .avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border: 4px solid var(--primary);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: white;
            padding: 35px;
            border-radius: 24px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 25px;
            transition: all 0.4s;
        }

        .stat-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.18);
        }

        .stat-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: white;
        }

        .stat-icon.blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .stat-icon.green { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-icon.purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .stat-icon.orange { background: linear-gradient(135deg, #f59e0b, #d97706); }

        .card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 35px;
        }

        .card-header {
            padding: 30px 35px;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h4 {
            font-size: 24px;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            padding: 14px 32px;
            border-radius: 14px;
            font-weight: 700;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(59,130,246,0.5);
        }

        .course-item {
            display: flex;
            gap: 25px;
            padding: 25px;
            background: #f8fafc;
            border-radius: 18px;
            margin-bottom: 25px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .course-item:hover {
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }

        .course-thumbnail {
            position: relative;
            width: 280px;
            height: 160px;
            border-radius: 14px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .course-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .course-duration {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="brand">
            <i class="fas fa-user-graduate"></i>
            <h3>Talaba Paneli</h3>
        </div>
        <ul class="menu" style="list-style: none; padding: 0;">
            <li><a href="{{ route('student.dashboard') }}" class="menu-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('student.courses') }}" class="menu-link {{ request()->routeIs('student.courses') ? 'active' : '' }}"><i class="fas fa-book-open"></i> <span>Mening Kurslarim</span></a></li>
            <li><a href="{{ route('student.grades') }}" class="menu-link {{ request()->routeIs('student.grades') ? 'active' : '' }}"><i class="fas fa-table"></i> <span>Baholarim</span></a></li>
            <li><a href="{{ route('student.chats') }}" class="menu-link {{ request()->routeIs('student.chats') ? 'active' : '' }}"><i class="fas fa-comments"></i> <span>Chatlar</span> <span class="badge bg-danger" style="margin-left: auto; padding: 4px 10px; border-radius: 20px; font-size: 12px;">3</span></a></li>
            <li><a href="{{ route('student.settings') }}" class="menu-link {{ request()->routeIs('student.settings') ? 'active' : '' }}"><i class="fas fa-cog"></i> <span>Sozlamalar</span></a></li>
            <li><a href="#" class="menu-link"><i class="fas fa-sign-out-alt"></i> <span>Chiqish</span></a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Qidirish...">
            </div>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Malika+Karimova&background=3b82f6&color=fff" alt="Student" class="avatar">
                <div>
                    <h5 style="margin: 0; font-weight: 800; font-size: 16px;">Malika Karimova</h5>
                    <p style="margin: 0; color: #64748b; font-size: 14px;">Talaba</p>
                </div>
            </div>
        </div>

        @yield('content')
    </div>
</body>
</html>
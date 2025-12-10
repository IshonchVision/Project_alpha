<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3b82f6;
            --secondary: #8b5cf6;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #06b6d4;
            --dark: #0f172a;
            --light: #f1f5f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #7c3aed 100%);
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            padding: 20px;
            overflow-y: auto;
            box-shadow: 5px 0 30px rgba(0,0,0,0.4);
            z-index: 1000;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
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
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand h3 {
            color: white;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .menu {
            list-style: none;
        }

        .menu-item {
            margin-bottom: 8px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 16px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .menu-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--primary);
            transform: scaleY(0);
            transition: transform 0.3s;
        }

        .menu-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(10px);
        }

        .menu-link:hover::before {
            transform: scaleY(1);
        }

        .menu-link.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 10px 30px rgba(59,130,246,0.5);
        }

        .menu-link i {
            font-size: 20px;
            width: 25px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-left: auto;
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
            background: linear-gradient(135deg, #1e3a8a, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-input {
            padding: 12px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            width: 300px;
            font-size: 15px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
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
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent, rgba(59,130,246,0.05));
            transform: translateX(-100%);
            transition: transform 0.4s;
        }

        .stat-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.18);
        }

        .stat-card:hover::before {
            transform: translateX(0);
        }

        .stat-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            position: relative;
            z-index: 1;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 10px 30px rgba(59,130,246,0.4);
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            box-shadow: 0 10px 30px rgba(139,92,246,0.4);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 10px 30px rgba(16,185,129,0.4);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            box-shadow: 0 10px 30px rgba(245,158,11,0.4);
        }

        .stat-info {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .stat-info h3 {
            font-size: 42px;
            font-weight: 900;
            margin: 0;
            color: var(--dark);
        }

        .stat-info p {
            color: #64748b;
            margin: 5px 0 0 0;
            font-weight: 600;
            font-size: 15px;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            font-weight: 700;
            margin-top: 8px;
        }

        .stat-trend.up {
            color: var(--success);
        }

        .stat-trend.down {
            color: var(--danger);
        }

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
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(59,130,246,0.5);
        }

        .card-body {
            padding: 35px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        thead th {
            background: #f8fafc;
            padding: 18px 20px;
            text-align: left;
            font-weight: 700;
            color: var(--dark);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            background: white;
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: #f8fafc;
            transform: scale(1.01);
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        tbody td {
            padding: 20px;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
        }

        tbody td:first-child {
            border-left: 1px solid #f1f5f9;
            border-radius: 12px 0 0 12px;
        }

        tbody td:last-child {
            border-right: 1px solid #f1f5f9;
            border-radius: 0 12px 12px 0;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 3px solid #e2e8f0;
        }

        .user-name {
            font-weight: 700;
            color: var(--dark);
        }

        .user-email {
            font-size: 13px;
            color: #64748b;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            display: inline-block;
        }

        .status-badge.active {
            background: #dcfce7;
            color: #059669;
        }

        .status-badge.inactive {
            background: #fee2e2;
            color: #dc2626;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-info {
            background: linear-gradient(135deg, var(--info), #0891b2);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
        }

        .btn-sm:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .chart-container {
            padding: 20px;
            background: #f8fafc;
            border-radius: 16px;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 18px;
        }

        .group-card {
            background: linear-gradient(135deg, #f8fafc, white);
            padding: 25px;
            border-radius: 18px;
            margin-bottom: 20px;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .group-card:hover {
            border-color: var(--primary);
            transform: translateX(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .group-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .group-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark);
            margin: 0 0 5px 0;
        }

        .group-teacher {
            color: #64748b;
            font-size: 14px;
        }

        .group-stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .group-stat {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 14px;
        }

        .group-stat i {
            color: var(--primary);
        }

        .chat-preview {
            background: white;
            padding: 25px;
            border-radius: 18px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary);
            transition: all 0.3s;
        }

        .chat-preview:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: translateX(10px);
        }

        .chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .chat-group {
            font-weight: 800;
            font-size: 18px;
            color: var(--dark);
        }

        .chat-time {
            color: #64748b;
            font-size: 13px;
        }

        .chat-message {
            color: #475569;
            line-height: 1.6;
        }

        .chat-from {
            font-weight: 700;
            color: var(--primary);
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .search-input {
                width: 100%;
            }

            .top-bar {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>
    <!-- ADMIN SIDEBAR -->
    <div class="sidebar">
        <div class="brand">
            <i class="fas fa-shield-alt"></i>
            <h3>Admin Panel</h3>
        </div>
        <ul class="menu">
            <li class="menu-item">
                <a href="#" class="menu-link active" onclick="showAdminSection('dashboard')">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link" onclick="showAdminSection('users')">
                    <i class="fas fa-users"></i>
                    <span>Foydalanuvchilar</span>
                    <span class="badge bg-danger">156</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link" onclick="showAdminSection('teachers')">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>O'qituvchilar</span>
                    <span class="badge bg-success">12</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link" onclick="showAdminSection('groups')">
                    <i class="fas fa-layer-group"></i>
                    <span>Guruhlar</span>
                    <span class="badge bg-info">24</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link" onclick="showAdminSection('chats')">
                    <i class="fas fa-comments"></i>
                    <span>Chatlar</span>
                    <span class="badge bg-warning">45</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link" onclick="showAdminSection('statistics')">
                    <i class="fas fa-chart-bar"></i>
                    <span>Statistika</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>To'lovlar</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-cog"></i>
                    <span>Sozlamalar</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Chiqish</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="top-bar">
            <h1 class="page-title">Admin Dashboard</h1>
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Qidirish...">
            </div>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Admin&background=3b82f6&color=fff" alt="Admin" class="avatar">
                <div>
                    <h5 style="margin: 0; font-weight: 800; font-size: 16px;">Super Admin</h5>
                    <p style="margin: 0; color: #64748b; font-size: 14px;">admin@eduplatform.uz</p>
                </div>
            </div>
        </div>

        <!-- DASHBOARD SECTION -->
        <div id="admin-dashboard-section">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>2,543</h3>
                        <p>Jami Foydalanuvchilar</p>
                        <div class="stat-trend up">
                            <i class="fas fa-arrow-up"></i> +12.5% bu oy
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-info">
                        <h3>47</h3>
                        <p>Faol O'qituvchilar</p>
                        <div class="stat-trend up">
                            <i class="fas fa-arrow-up"></i> +5 yangi
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stat-info">
                        <h3>156</h3>
                        <p>Faol Guruhlar</p>
                        <div class="stat-trend up">
                            <i class="fas fa-arrow-up"></i> +8.3%
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-info">
                        <h3>$45,678</h3>
                        <p>Bu Oylik Daromad</p>
                        <div class="stat-trend down">
                            <i class="fas fa-arrow-down"></i> -3.2%
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin: 0 -15px;">
                <div class="col-lg-8" style="padding: 0 15px;">
                    <div class="card">
                        <div class="card-header">
                            <h4>Oylik Statistika</h4>
                            <select class="form-select" style="width: 150px;">
                                <option>2024</option>
                                <option>2023</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                📊 Chart.js yoki boshqa kutubxona bu yerda bo'ladi
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" style="padding: 0 15px;">
                    <div class="card">
                        <div class="card-header">
                            <h4>Yangi Ro'yxatlar</h4>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 15px; background: #f8fafc; border-radius: 12px;">
                                <img src="https://ui-avatars.com/api/?name=Ali+Valiyev&background=random" style="width: 50px; height: 50px; border-radius: 50%;">
                                <div>
                                    <h6 style="margin: 0; font-weight: 700;">Ali Valiyev</h6>
                                    <small style="color: #64748b;">5 daqiqa oldin</small>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 15px; background: #f8fafc; border-radius: 12px;">
                                <img src="https://ui-avatars.com/api/?name=Malika+Karimova&background=random" style="width: 50px; height: 50px; border-radius: 50%;">
                                <div>
                                    <h6 style="margin: 0; font-weight: 700;">Malika Karimova</h6>
                                    <small style="color: #64748b;">12 daqiqa oldin</small>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 15px; background: #f8fafc; border-radius: 12px;">
                                <img src="https://ui-avatars.com/api/?name=Sardor+Rahimov&background=random" style="width: 50px; height: 50px; border-radius: 50%;">
                                <div>
                                    <h6 style="margin: 0; font-weight: 700;">Sardor Rahimov</h6>
                                    <small style="color: #64748b;">1 soat oldin</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- USERS SECTION -->
        <div id="admin-users-section" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h4>Barcha Foydalanuvchilar</h4>
                    <button class="btn-primary">
                        <i class="fas fa-user-plus"></i> Yangi User
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>FOYDALANUVCHI</th>
                                    <th>ROL</th>
                                    <th>TELEFON</th>
                                    <th>RO'YXATDAN O'TGAN</th>
                                    <th>STATUS</th>
                                    <th>AMALLAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <img src="https://ui-avatars.com/api/?name=Aziz+Toshmatov&background=random" class="user-avatar">
                                            <div>
                                                <div class="user-name">Aziz Toshmatov</div>
                                                <div class="user-email">aziz@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-info text-white">User</span></td>
                                    <td>+998 90 123 45 67</td>
                                    <td>12.12.2024</td>
                                    <td><span class="status-badge active">Faol</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                            <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <img src="https://ui-avatars.com/api/?name=Malika+Sultanova&background=random" class="user-avatar">
                                            <div>
                                                <div class="user-name">Malika Sultanova</div>
                                                <div class="user-email">malika@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-info text-white">User</span></td>
                                    <td>+998 91 234 56 78</td>
                                    <td>10.12.2024</td>
                                    <td><span class="status-badge active">Faol</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                            <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <img src="https://ui-avatars.com/api/?name=Shoxjaxon+Erkinov&background=random" class="user-avatar">
                                            <div>
                                                <div class="user-name">Shoxjaxon Erkinov</div>
                                                <div class="user-email">shox@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-info text-white">User</span></td>
                                    <td>+998 99 876 54 32</td>
                                    <td>05.12.2024</td>
                                    <td><span class="status-badge inactive">NoFaol</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                            <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Qo'shimcha misollar qo'shish mumkin -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TEACHERS SECTION -->
        <div id="admin-teachers-section" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h4>O'qituvchilar Ro'yxati</h4>
                    <button class="btn-primary">
                        <i class="fas fa-user-plus"></i> Yangi O'qituvchi
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>O'QITUVCHI</th>
                                    <th>FAN</th>
                                    <th>GURUHLAR SONI</th>
                                    <th>TELEFON</th>
                                    <th>STATUS</th>
                                    <th>AMALLAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <img src="https://ui-avatars.com/api/?name=Olim+To'ychiyev&background=random" class="user-avatar">
                                            <div>
                                                <div class="user-name">Olim To'ychiyev</div>
                                                <div class="user-email">olim@teacher.uz</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Matematika</td>
                                    <td>5</td>
                                    <td>+998 97 111 22 33</td>
                                    <td><span class="status-badge active">Faol</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                            <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <img src="https://ui-avatars.com/api/?name=Gulnoza+Ahmedova&background=random" class="user-avatar">
                                            <div>
                                                <div class="user-name">Gulnoza Ahmedova</div>
                                                <div class="user-email">gulnoza@teacher.uz</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Ingliz tili</td>
                                    <td>8</td>
                                    <td>+998 95 444 55 66</td>
                                    <td><span class="status-badge active">Faol</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                            <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- GROUPS SECTION -->
        <div id="admin-groups-section" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h4>Guruhlar</h4>
                    <button class="btn-primary">
                        <i class="fas fa-plus"></i> Yangi Guruh
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="group-card">
                                <div class="group-header">
                                    <div>
                                        <h5 class="group-title">Advanced English A1</h5>
                                        <p class="group-teacher">O'qituvchi: Gulnoza Ahmedova</p>
                                    </div>
                                    <span class="badge bg-success">Faol</span>
                                </div>
                                <div class="group-stats">
                                    <div class="group-stat"><i class="fas fa-users"></i> 24 o'quvchi</div>
                                    <div class="group-stat"><i class="fas fa-calendar"></i> Dush-Chor-Juma</div>
                                    <div class="group-stat"><i class="fas fa-clock"></i> 18:00</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="group-card">
                                <div class="group-header">
                                    <div>
                                        <h5 class="group-title">Matematika 101</h5>
                                        <p class="group-teacher">O'qituvchi: Olim To'ychiyev</p>
                                    </div>
                                    <span class="badge bg-success">Faol</span>
                                </div>
                                <div class="group-stats">
                                    <div class="group-stat"><i class="fas fa-users"></i> 18 o'quvchi</div>
                                    <div class="group-stat"><i class="fas fa-calendar"></i> Sesh-Pay-Shan</div>
                                    <div class="group-stat"><i class="fas fa-clock"></i> 19:00</div>
                                </div>
                            </div>
                        </div>
                        <!-- Qo'shimcha guruhlar -->
                    </div>
                </div>
            </div>
        </div>

        <!-- CHATS SECTION -->
        <div id="admin-chats-section" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h4>So'nggi Chatlar</h4>
                </div>
                <div class="card-body">
                    <div class="chat-preview">
                        <div class="chat-header">
                            <h5 class="chat-group">Advanced English A1</h5>
                            <span class="chat-time">2 daqiqa oldin</span>
                        </div>
                        <p class="chat-message"><span class="chat-from">Malika:</span> Bugungi dars uchun uy vazifasi nima edi?</p>
                    </div>
                    <div class="chat-preview">
                        <div class="chat-header">
                            <h5 class="chat-group">Matematika 101</h5>
                            <span class="chat-time">10 daqiqa oldin</span>
                        </div>
                        <p class="chat-message"><span class="chat-from">Aziz:</span> Masala 45 ni tushunmadim, yordam bera olasizmi?</p>
                    </div>
                    <!-- Qo'shimcha chatlar -->
                </div>
            </div>
        </div>

        <!-- STATISTICS SECTION -->
        <div id="admin-statistics-section" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h4>Umumiy Statistika</h4>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        📈 Bu yerda katta diagrammalar (masalan, Chart.js bilan) bo'ladi
                    </div>
                    <div class="stats-grid" style="margin-top: 30px;">
                        <div class="stat-card">
                            <div class="stat-icon green">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-info">
                                <h3>87%</h3>
                                <p>O'rtacha Davomat</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon purple">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="stat-info">
                                <h3>92%</h3>
                                <p>Bitiruvchilar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showAdminSection(section) {
            // Barcha bo'limlarni yashirish
            const sections = document.querySelectorAll('div[id^="admin-"][id$="-section"]');
            sections.forEach(sec => sec.style.display = 'none');

            // Barcha linklardan active klassini olib tashlash
            const links = document.querySelectorAll('.menu-link');
            links.forEach(link => link.classList.remove('active'));

            // Tanlangan bo'limni ko'rsatish
            document.getElementById(`admin-${section}-section`).style.display = 'block';

            // Bosilgan linkka active qo'shish
            event.currentTarget.classList.add('active');
        }

        // Mobile uchun sidebar toggle (ixtiyoriy qo'shimcha)
        // Agar kerak bo'lsa, top-bar ga menu button qo'shish mumkin
    </script>
</body>
</html>
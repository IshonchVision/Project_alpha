<div class="sidebar">
    <div class="brand">
        <i class="fas fa-shield-alt"></i>
        <h3>Admin Panel</h3>
    </div>
    <ul class="menu">
        <li class="menu-item">
            <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.users') }}" class="menu-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Foydalanuvchilar</span>
                <span class="badge bg-danger">156</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.teachers') }}" class="menu-link {{ request()->routeIs('admin.teachers') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>O'qituvchilar</span>
                <span class="badge bg-success">12</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.groups') }}" class="menu-link {{ request()->routeIs('admin.groups') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                <span>Guruhlar</span>
                <span class="badge bg-info">24</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.chats') }}" class="menu-link {{ request()->routeIs('admin.chats') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Chatlar</span>
                <span class="badge bg-warning">45</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.statistics') }}" class="menu-link {{ request()->routeIs('admin.statistics') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Statistika</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.payments') }}" class="menu-link {{ request()->routeIs('admin.payments') ? 'active' : '' }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>To'lovlar</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.settings') }}" class="menu-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
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
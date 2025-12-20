<!-- resources/views/teacher/partials/sidebar.blade.php -->
<div class="sidebar">
    <div class="brand">
        <i class="fas fa-chalkboard-teacher"></i>
        <h3>O'qituvchi Panel</h3>
    </div>
    <ul class="menu">
        <li class="menu-item">
            <a href="{{ route('teacher.dashboard') }}" class="menu-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('teacher.groups') }}" class="menu-link {{ request()->routeIs('teacher.groups') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                <span>Guruhlar</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('teacher.courses') }}" class="menu-link {{ request()->routeIs('teacher.courses') ? 'active' : '' }}">
                <i class="fas fa-book-open"></i>
                <span>Kurslar</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('teacher.students') }}" class="menu-link {{ request()->routeIs('teacher.students') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>O'quvchilar</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('teacher.chats') }}" class="menu-link {{ request()->routeIs('teacher.chats') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Chatlar</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('teacher.settings') }}" class="menu-link {{ request()->routeIs('teacher.settings') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Sozlamalar</span>
            </a>
        </li>
        <li class="menu-item">
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
            <a href="#" class="menu-link" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Chiqish</span>
            </a>
        </li>
    </ul>
</div>
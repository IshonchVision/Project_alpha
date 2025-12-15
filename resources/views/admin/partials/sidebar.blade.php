@if (Auth::user()->role === 'admin')
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
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.teachers') }}" class="menu-link {{ request()->routeIs('admin.teachers') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>O'qituvchilar</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.groups') }}" class="menu-link {{ request()->routeIs('admin.groups') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                <span>Guruhlar</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.chats') }}" class="menu-link {{ request()->routeIs('admin.chats') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Chatlar</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.settings') }}" class="menu-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
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
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        @if(session('success'))
        toastr.success("{{ session('success') }}")
        @endif

        @if(session('error'))
        toastr.error("{{ session('error') }}")
        @endif

        @if(session('warning'))
        toastr.warning("{{ session('warning') }}")
        @endif

        @if(session('info'))
        toastr.info("{{ session('info') }}")
        @endif
    </script>

</div>
@endif
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        <a href="{{ url('/') }}" class="navbar-brand ml-lg-3">
            <h1 class="m-0 text-uppercase text-primary">
                <i class="fa fa-book-reader mr-3"></i>Killer
            </h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Bosh sahifa</a>
                <a href="{{ url('/about') }}" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">Biz haqimizda</a>
                <a href="{{ url('/course') }}" class="nav-item nav-link {{ request()->is('course') ? 'active' : '' }}">Kurslar</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('detail') || request()->is('feature.html') || request()->is('team') || request()->is('testimonial') ? 'active' : '' }}" data-toggle="dropdown">Sahifalar</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ url('detail') }}" class="dropdown-item {{ request()->is('detail') ? 'active' : '' }}">Kurs tafsilotlari</a>
                        <a href="{{ url('feature') }}" class="dropdown-item {{ request()->is('feature.html') ? 'active' : '' }}">Nimalar olasiz</a>
                        <a href="{{ url('team') }}" class="dropdown-item {{ request()->is('team') ? 'active' : '' }}">Bizning jamoa</a>
                        <a href="{{ url('testimonial') }}" class="dropdown-item {{ request()->is('testimonial') ? 'active' : '' }}">Maqolalar</a>
                    </div>
                </div>

                <a href="{{ url('/contact') }}" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Bizga bog'lanish</a>
                <a href="{{ url('/my_course') }}" class="nav-item nav-link {{ request()->is('my_course') ? 'active' : '' }}">Mening kurslarim</a>
                <a href="{{ url('/group_chats') }}" class="nav-item nav-link {{ request()->is('group_chats') ? 'active' : '' }}">Guruh chatlari</a>
            </div>

            <div class="d-flex">
                <a href="{{ url('/login_blade') }}" class="btn btn-outline-primary py-2 px-4 mr-2">Login</a>
                <a href="{{ url('/register_blade') }}" class="btn btn-primary py-2 px-4">Register</a>
            </div>
        </div>
    </nav>
</div>
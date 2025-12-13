@if (Auth::user()->role === 'admin')
<div class="top-bar">
    <h1 class="page-title">Admin Dashboard</h1>
    <div class="user-info">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff&bold=true&fontsize=0.5&rounded=true&size=56"
            alt="{{ Auth::user()->name }}"
            class="avatar rounded-circle"
            style="width: 56px; height: 56px; object-fit: cover; box-shadow: 0 4px 12px rgba(99,102,241,0.3);">
        <div>
            <h5 style="margin: 0; font-weight: 800; font-size: 16px;">{{ Auth::user()->name }}</h5>
            <p style="margin: 0; color: #64748b; font-size: 14px;">{{ Auth::user()->email }}</p>
        </div>
    </div>
</div>
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

@endif
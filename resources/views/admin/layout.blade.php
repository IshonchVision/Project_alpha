<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="pusher-key" content="{{ env('PUSHER_APP_KEY') }}">
    <meta name="pusher-cluster" content="{{ env('PUSHER_APP_CLUSTER') }}">
    <meta name="user-id" content="{{ auth()->id() }}">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        /* Ensure toastr notifications have readable colors despite global .toast overrides */
        .toast {
            color: inherit !important;
        }

        .toast-success {
            background-color: #28a745 !important;
            color: #fff !important;
            border-color: rgba(0, 0, 0, 0.05) !important;
        }

        .toast-error {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        .toast-info {
            background-color: #17a2b8 !important;
            color: #fff !important;
        }

        .toast-warning {
            background-color: #f0ad4e !important;
            color: #000 !important;
        }

        .toast .toast-message,
        .toast .toast-body {
            color: inherit !important;
        }
    </style>
</head>

<body>
    <!-- ADMIN SIDEBAR -->
    @include('admin.partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- TOP BAR -->
        @include('admin.partials.topbar')

        <!-- CONTENT -->
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://unpkg.com/laravel-echo/dist/echo.iife.js"></script>
    <script>
        (function() {
            const key = document.querySelector('meta[name="pusher-key"]')?.getAttribute('content');
            if (!key) return;

            // Enable Pusher logging for debugging (disable in production)
            Pusher.logToConsole = false;

            try {
                window.Echo = new window.Echo({
                    broadcaster: 'pusher',
                    key: key,
                    wsHost: window.location.hostname,
                    wsPort: 6001,
                    wssPort: 6001,
                    forceTLS: false,
                    encrypted: false,
                    disableStats: true,
                    enabledTransports: ['ws', 'wss']
                });
            } catch (e) {
                console.error('Echo init error', e);
            }
        })();
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
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

</html>
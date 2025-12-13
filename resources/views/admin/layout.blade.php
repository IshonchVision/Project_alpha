<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="pusher-key" content="{{ env('PUSHER_APP_KEY') }}">
    <meta name="pusher-cluster" content="{{ env('PUSHER_APP_CLUSTER') }}">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
        (function () {
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
</html>
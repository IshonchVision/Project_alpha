<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <!-- ADMIN SIDEBAR -->
    @include('admin.partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- TOP BAR -->
        @include('admin.partials.topbar')

        <!-- DASHBOARD SECTION -->
        <div id="admin-dashboard-section">
            @include('admin.sections.dashboard')
        </div>

        <!-- USERS SECTION -->
        <div id="admin-users-section" style="display: none;">
            @include('admin.sections.users')
        </div>

        <!-- TEACHERS SECTION -->
        <div id="admin-teachers-section" style="display: none;">
            @include('admin.sections.teachers')
        </div>

        <!-- GROUPS SECTION -->
        <div id="admin-groups-section" style="display: none;">
            @include('admin.sections.groups')
        </div>

        <!-- CHATS SECTION -->
        <div id="admin-chats-section" style="display: none;">
            @include('admin.sections.chats')
        </div>

        <!-- STATISTICS SECTION -->
        <div id="admin-statistics-section" style="display: none;">
            @include('admin.sections.statistics')
        </div>

        <!-- PAYMENTS SECTION -->
        <!-- <div id="admin-payments-section" style="display: none;">
            @include('admin.sections.payments')
        </div> -->

        <!-- SETTINGS SECTION -->
        <div id="admin-settings-section" style="display: none;">
            @include('admin.sections.settings')
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
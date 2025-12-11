@if (Auth::user()->role === 'admin')
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
@endif
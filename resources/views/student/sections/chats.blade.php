@extends('student.layout')

@section('title', 'Chatlar')
@section('page-title', 'Chatlar')

@section('content')
<div class="top-bar">
    <h1 class="page-title">@yield('page-title', 'Chatlar')</h1>
    <div class="search-box">
        <input type="text" class="search-input" placeholder="Xabar yoki guruh qidirish...">
    </div>
    <div class="user-info">
        <img src="https://ui-avatars.com/api/?name=Malika+Karimova&background=3b82f6&color=fff" alt="Student" class="avatar">
        <div>
            <h5 style="margin: 0; font-weight: 800; font-size: 16px;">Malika Karimova</h5>
            <p style="margin: 0; color: #64748b; font-size: 14px;">Talaba</p>
        </div>
    </div>
</div>

<div class="row">
    <!-- Guruhlar ro'yxati (chap taraf) -->
    <div class="col-lg-4">
        <div class="card" style="height: calc(100vh - 250px);">
            <div class="card-header">
                <h4>Guruh Chatlari</h4>
            </div>
            <div class="card-body" style="padding: 0; overflow-y: auto;">
                <!-- Guruh 1 -->
                <div style="padding: 20px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; cursor: pointer; transition: all 0.3s;" onclick="selectChat(1)">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="position: relative;">
                            <img src="https://ui-avatars.com/api/?name=Advanced+English&background=3b82f6&color=fff" style="width: 50px; height: 50px; border-radius: 50%;">
                            <span style="position: absolute; bottom: 0; right: 0; background: #10b981; width: 15px; height: 15px; border-radius: 50%; border: 3px solid white;"></span>
                        </div>
                        <div style="flex: 1;">
                            <h6 style="margin: 0; font-weight: 700;">Advanced English Grammar</h6>
                            <small style="color: #64748b;">Oxirgi xabar: 5 daqiqa oldin</small>
                        </div>
                        <span style="background: var(--primary); color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px;">3</span>
                    </div>
                </div>

                <!-- Guruh 2 -->
                <div style="padding: 20px; border-bottom: 1px solid #e2e8f0; cursor: pointer; transition: all 0.3s;" onclick="selectChat(2)">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <img src="https://ui-avatars.com/api/?name=IELTS&background=8b5cf6&color=fff" style="width: 50px; height: 50px; border-radius: 50%;">
                        <div style="flex: 1;">
                            <h6 style="margin: 0; font-weight: 700;">IELTS Speaking Preparation</h6>
                            <small style="color: #64748b;">Gulnoza Ahmedova: Yaxshi ish!</small>
                        </div>
                    </div>
                </div>

                <!-- Guruh 3 -->
                <div style="padding: 20px; border-bottom: 1px solid #e2e8f0; cursor: pointer; transition: all 0.3s;" onclick="selectChat(3)">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <img src="https://ui-avatars.com/api/?name=Beginners&background=10b981&color=fff" style="width: 50px; height: 50px; border-radius: 50%;">
                        <div style="flex: 1;">
                            <h6 style="margin: 0; font-weight: 700;">English for Beginners</h6>
                            <small style="color: #64748b;">Siz: Rahmat o'qituvchi!</small>
                        </div>
                        <span style="background: var(--primary); color: white; padding: 4px 8px; border-radius: 20px; font-size: 12px;">1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat oynasi (o'ng taraf) -->
    <div class="col-lg-8">
        <div class="card" style="height: calc(100vh - 250px); display: flex; flex-direction: column;">
            <div class="card-header">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="https://ui-avatars.com/api/?name=Advanced+English&background=3b82f6&color=fff" style="width: 45px; height: 45px; border-radius: 50%;">
                    <div>
                        <h5 style="margin: 0; font-weight: 700;">Advanced English Grammar</h5>
                        <small style="color: #64748b;">45 a'zo, 8 faol</small>
                    </div>
                </div>
            </div>
            <div class="card-body" style="flex: 1; overflow-y: auto; padding: 20px;">
                <!-- Xabarlar -->
                <div style="display: flex; gap: 15px; margin-bottom: 25px;">
                    <img src="https://ui-avatars.com/api/?name=Gulnoza&background=10b981&color=fff" style="width: 40px; height: 40px; border-radius: 50%;">
                    <div>
                        <div style="background: #e0e7ff; padding: 12px 16px; border-radius: 18px; max-width: 400px;">
                            <strong>Gulnoza Ahmedova <small style="color: #64748b;">(O'qituvchi)</small></strong><br>
                            Bugungi uy vazifasi: Present Simple mashqlarni bajarib keling.
                        </div>
                        <small style="color: #94a3b8; margin-left: 10px;">10:25</small>
                    </div>
                </div>

                <div style="display: flex; gap: 15px; margin-bottom: 25px; justify-content: flex-end;">
                    <div style="text-align: right;">
                        <div style="background: var(--primary); color: white; padding: 12px 16px; border-radius: 18px; max-width: 400px;">
                            Tushundim, rahmat!
                        </div>
                        <small style="color: #94a3b8; margin-right: 10px;">10:28</small>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Malika&background=3b82f6&color=fff" style="width: 40px; height: 40px; border-radius: 50%;">
                </div>

                <!-- Yana xabarlar qo'shishingiz mumkin -->
            </div>
            <div style="padding: 20px; border-top: 2px solid #e2e8f0;">
                <div style="display: flex; gap: 10px;">
                    <input type="text" class="form-control" placeholder="Xabar yozing..." style="border-radius: 20px;">
                    <button class="btn-primary" style="border-radius: 50%; width: 50px; height: 50px; padding: 0;">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function selectChat(id) {
    // Bu yerda JS bilan chatni almashtirish mumkin (hozircha oddiy)
    alert('Chat ' + id + ' tanlandi');
}
</script>
@endsection
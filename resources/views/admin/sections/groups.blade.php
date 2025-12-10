@extends('admin.layout')

@section('title', 'Guruhlar')
@section('page-title', 'Guruhlar')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Guruhlar</h4>
        <button class="btn-primary">
            <i class="fas fa-plus"></i> Yangi Guruh
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="group-card">
                    <div class="group-header">
                        <div>
                            <h5 class="group-title">Advanced English A1</h5>
                            <p class="group-teacher">O'qituvchi: Gulnoza Ahmedova</p>
                        </div>
                        <span class="badge bg-success">Faol</span>
                    </div>
                    <div class="group-stats">
                        <div class="group-stat"><i class="fas fa-users"></i> 24 o'quvchi</div>
                        <div class="group-stat"><i class="fas fa-calendar"></i> Dush-Chor-Juma</div>
                        <div class="group-stat"><i class="fas fa-clock"></i> 18:00</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group-card">
                    <div class="group-header">
                        <div>
                            <h5 class="group-title">Matematika 101</h5>
                            <p class="group-teacher">O'qituvchi: Olim To'ychiyev</p>
                        </div>
                        <span class="badge bg-success">Faol</span>
                    </div>
                    <div class="group-stats">
                        <div class="group-stat"><i class="fas fa-users"></i> 18 o'quvchi</div>
                        <div class="group-stat"><i class="fas fa-calendar"></i> Sesh-Pay-Shan</div>
                        <div class="group-stat"><i class="fas fa-clock"></i> 19:00</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group-card">
                    <div class="group-header">
                        <div>
                            <h5 class="group-title">IELTS Preparation</h5>
                            <p class="group-teacher">O'qituvchi: Nodira Qodirova</p>
                        </div>
                        <span class="badge bg-success">Faol</span>
                    </div>
                    <div class="group-stats">
                        <div class="group-stat"><i class="fas fa-users"></i> 15 o'quvchi</div>
                        <div class="group-stat"><i class="fas fa-calendar"></i> Har kuni</div>
                        <div class="group-stat"><i class="fas fa-clock"></i> 16:00</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group-card">
                    <div class="group-header">
                        <div>
                            <h5 class="group-title">Python Asoslari</h5>
                            <p class="group-teacher">O'qituvchi: Javohir Nematov</p>
                        </div>
                        <span class="badge bg-warning">To'ldi</span>
                    </div>
                    <div class="group-stats">
                        <div class="group-stat"><i class="fas fa-users"></i> 20 o'quvchi</div>
                        <div class="group-stat"><i class="fas fa-calendar"></i> Dush-Chor-Shan</div>
                        <div class="group-stat"><i class="fas fa-clock"></i> 20:00</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group-card">
                    <div class="group-header">
                        <div>
                            <h5 class="group-title">Fizika Advanced</h5>
                            <p class="group-teacher">O'qituvchi: Shahzod Karimov</p>
                        </div>
                        <span class="badge bg-success">Faol</span>
                    </div>
                    <div class="group-stats">
                        <div class="group-stat"><i class="fas fa-users"></i> 16 o'quvchi</div>
                        <div class="group-stat"><i class="fas fa-calendar"></i> Sesh-Chor-Juma</div>
                        <div class="group-stat"><i class="fas fa-clock"></i> 17:00</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group-card">
                    <div class="group-header">
                        <div>
                            <h5 class="group-title">Kimyo Boshlang'ich</h5>
                            <p class="group-teacher">O'qituvchi: Madina Ergasheva</p>
                        </div>
                        <span class="badge bg-danger">Faol emas</span>
                    </div>
                    <div class="group-stats">
                        <div class="group-stat"><i class="fas fa-users"></i> 12 o'quvchi</div>
                        <div class="group-stat"><i class="fas fa-calendar"></i> Dush-Pay-Juma</div>
                        <div class="group-stat"><i class="fas fa-clock"></i> 15:00</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group-card">
                    <div class="group-header">
                        <div>
                            <h5 class="group-title">Beginner English B1</h5>
                            <p class="group-teacher">O'qituvchi: Gulnoza Ahmedova</p>
                        </div>
                        <span class="badge bg-success">Faol</span>
                    </div>
                    <div class="group-stats">
                        <div class="group-stat"><i class="fas fa-users"></i> 22 o'quvchi</div>
                        <div class="group-stat"><i class="fas fa-calendar"></i> Sesh-Chor-Shan</div>
                        <div class="group-stat"><i class="fas fa-clock"></i> 14:00</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group-card">
                    <div class="group-header">
                        <div>
                            <h5 class="group-title">Matematika Advanced</h5>
                            <p class="group-teacher">O'qituvchi: Olim To'ychiyev</p>
                        </div>
                        <span class="badge bg-success">Faol</span>
                    </div>
                    <div class="group-stats">
                        <div class="group-stat"><i class="fas fa-users"></i> 14 o'quvchi</div>
                        <div class="group-stat"><i class="fas fa-calendar"></i> Dush-Chor-Juma</div>
                        <div class="group-stat"><i class="fas fa-clock"></i> 16:30</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
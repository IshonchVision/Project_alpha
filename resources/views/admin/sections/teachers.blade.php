@extends('admin.layout')

@section('title', 'O\'qituvchilar')
@section('page-title', 'O\'qituvchilar')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>O'qituvchilar Ro'yxati</h4>
        <button class="btn-primary">
            <i class="fas fa-user-plus"></i> Yangi O'qituvchi
        </button>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>O'QITUVCHI</th>
                        <th>FAN</th>
                        <th>GURUHLAR SONI</th>
                        <th>TELEFON</th>
                        <th>STATUS</th>
                        <th>AMALLAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Olim+To'ychiyev&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Olim To'ychiyev</div>
                                    <div class="user-email">olim@teacher.uz</div>
                                </div>
                            </div>
                        </td>
                        <td>Matematika</td>
                        <td>5</td>
                        <td>+998 97 111 22 33</td>
                        <td><span class="status-badge active">Faol</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Gulnoza+Ahmedova&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Gulnoza Ahmedova</div>
                                    <div class="user-email">gulnoza@teacher.uz</div>
                                </div>
                            </div>
                        </td>
                        <td>Ingliz tili</td>
                        <td>8</td>
                        <td>+998 95 444 55 66</td>
                        <td><span class="status-badge active">Faol</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Nodira+Qodirova&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Nodira Qodirova</div>
                                    <div class="user-email">nodira@teacher.uz</div>
                                </div>
                            </div>
                        </td>
                        <td>Ingliz tili (IELTS)</td>
                        <td>4</td>
                        <td>+998 91 777 88 99</td>
                        <td><span class="status-badge active">Faol</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Javohir+Nematov&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Javohir Nematov</div>
                                    <div class="user-email">javohir@teacher.uz</div>
                                </div>
                            </div>
                        </td>
                        <td>Dasturlash (Python)</td>
                        <td>3</td>
                        <td>+998 93 222 33 44</td>
                        <td><span class="status-badge active">Faol</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Shahzod+Karimov&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Shahzod Karimov</div>
                                    <div class="user-email">shahzod@teacher.uz</div>
                                </div>
                            </div>
                        </td>
                        <td>Fizika</td>
                        <td>6</td>
                        <td>+998 94 333 44 55</td>
                        <td><span class="status-badge active">Faol</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Madina+Ergasheva&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Madina Ergasheva</div>
                                    <div class="user-email">madina@teacher.uz</div>
                                </div>
                            </div>
                        </td>
                        <td>Kimyo</td>
                        <td>4</td>
                        <td>+998 90 999 88 77</td>
                        <td><span class="status-badge inactive">NoFaol</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <button class="btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
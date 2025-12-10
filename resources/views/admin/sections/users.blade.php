@extends('admin.layout')

@section('title', 'Foydalanuvchilar')
@section('page-title', 'Foydalanuvchilar')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Barcha Foydalanuvchilar</h4>
        <button class="btn-primary">
            <i class="fas fa-user-plus"></i> Yangi User
        </button>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>FOYDALANUVCHI</th>
                        <th>ROL</th>
                        <th>TELEFON</th>
                        <th>RO'YXATDAN O'TGAN</th>
                        <th>STATUS</th>
                        <th>AMALLAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Aziz+Toshmatov&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Aziz Toshmatov</div>
                                    <div class="user-email">aziz@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-info text-white">User</span></td>
                        <td>+998 90 123 45 67</td>
                        <td>12.12.2024</td>
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
                                <img src="https://ui-avatars.com/api/?name=Malika+Sultanova&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Malika Sultanova</div>
                                    <div class="user-email">malika@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-info text-white">User</span></td>
                        <td>+998 91 234 56 78</td>
                        <td>10.12.2024</td>
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
                                <img src="https://ui-avatars.com/api/?name=Shoxjaxon+Erkinov&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Shoxjaxon Erkinov</div>
                                    <div class="user-email">shox@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-info text-white">User</span></td>
                        <td>+998 99 876 54 32</td>
                        <td>05.12.2024</td>
                        <td><span class="status-badge inactive">NoFaol</span></td>
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
                                <img src="https://ui-avatars.com/api/?name=Dilshod+Qodirov&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Dilshod Qodirov</div>
                                    <div class="user-email">dilshod@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-info text-white">User</span></td>
                        <td>+998 93 555 66 77</td>
                        <td>08.12.2024</td>
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
                                <img src="https://ui-avatars.com/api/?name=Nigora+Aliyeva&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Nigora Aliyeva</div>
                                    <div class="user-email">nigora@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-info text-white">User</span></td>
                        <td>+998 94 888 99 00</td>
                        <td>07.12.2024</td>
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
                                <img src="https://ui-avatars.com/api/?name=Jamshid+Rahmonov&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Jamshid Rahmonov</div>
                                    <div class="user-email">jamshid@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-info text-white">User</span></td>
                        <td>+998 95 111 22 33</td>
                        <td>06.12.2024</td>
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
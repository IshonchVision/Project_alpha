@extends('admin.layout')

@section('title', 'Guruhlar')
@section('page-title', 'Guruhlar')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Barcha To'lovlar</h4>
        <div style="display: flex; gap: 15px;">
            <button class="btn-primary" style="background: linear-gradient(135deg, #10b981, #059669);">
                <i class="fas fa-file-export"></i> Export Excel
            </button>
        </div>
    </div>
    <div class="card-body">
        <!-- Filter Section -->
        <div class="filter-section" style="margin-bottom: 25px; display: flex; gap: 15px; flex-wrap: wrap;">
            <select class="form-select" style="width: 200px;" id="filterPaymentStatus">
                <option value="">Barcha Statuslar</option>
                <option value="paid">To'langan</option>
                <option value="pending">Kutilmoqda</option>
                <option value="failed">Muvaffaqiyatsiz</option>
            </select>
            <select class="form-select" style="width: 200px;" id="filterPaymentMonth">
                <option value="">Barcha Oylar</option>
                <option value="01">Yanvar</option>
                <option value="02">Fevral</option>
                <option value="03">Mart</option>
                <option value="04">Aprel</option>
                <option value="05">May</option>
                <option value="06">Iyun</option>
                <option value="07">Iyul</option>
                <option value="08">Avgust</option>
                <option value="09">Sentyabr</option>
                <option value="10">Oktabr</option>
                <option value="11">Noyabr</option>
                <option value="12">Dekabr</option>
            </select>
            <input type="number" class="form-control" style="width: 150px;" placeholder="Yil" id="filterPaymentYear" value="{{ date('Y') }}">
            <button class="btn-primary" onclick="applyPaymentFilters()">
                <i class="fas fa-filter"></i> Filter
            </button>
            <button class="btn-primary" style="background: linear-gradient(135deg, #6b7280, #4b5563);" onclick="resetPaymentFilters()">
                <i class="fas fa-redo"></i> Reset
            </button>
        </div>

        <div class="table-container">
            <table id="paymentsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FOYDALANUVCHI</th>
                        <th>GURUH</th>
                        <th>SUMMA</th>
                        <th>TO'LOV TUR</th>
                        <th>SANA</th>
                        <th>STATUS</th>
                        <th>AMALLAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1001</td>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Aziz+Toshmatov&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Aziz Toshmatov</div>
                                    <div class="user-email">aziz@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td>Advanced English A1</td>
                        <td>1,200,000 so'm</td>
                        <td>Click</td>
                        <td>10.12.2024</td>
                        <td><span class="status-badge active">To'langan</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-sm btn-info" title="Ko'rish"><i class="fas fa-eye"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#1002</td>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Malika+Sultanova&background=random" class="user-avatar">
                                <div>
                                    <div class="user-name">Malika Sultanova</div>
                                    <div class="user-email">malika@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td>Matematika 101</td>
                        <td>900,000 so'm</td>
                        <td>Payme</td>
                        <td>08.12.2024</td>
                        <td><span class="status-badge active">To'langan</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-sm btn-info"><i class="fas fa-eye"></i></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Qo'shimcha qatorlar -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container" style="margin-top: 25px; display: flex; justify-content: space-between; align-items: center;">
            <div style="color: #64748b;">
                Ko'rsatilmoqda: 1-10 / 342
            </div>
            <nav>
                <ul class="pagination" style="margin: 0; display: flex; gap: 8px; list-style: none;">
                    <li><button class="page-btn">«</button></li>
                    <li><button class="page-btn active">1</button></li>
                    <li><button class="page-btn">2</button></li>
                    <li><button class="page-btn">3</button></li>
                    <li><button class="page-btn">»</button></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection
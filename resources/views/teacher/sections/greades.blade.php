@extends('teacher.layout')

@section('title', 'Baholar Jadvali')
@section('page-title', 'Baholar Jadvali')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h4>Baholar Jadvali</h4>
            <div style="display: flex; gap: 15px; margin-top: 15px;">
                <select class="form-select" style="width: 200px;">
                    <option>Advanced English A1</option>
                    <option>Beginner English B1</option>
                    <option>IELTS Preparation</option>
                </select>
                <select class="form-select" style="width: 150px;">
                    <option>Dekabr 2024</option>
                    <option>Noyabr 2024</option>
                    <option>Oktyabr 2024</option>
                </select>
            </div>
        </div>
        <div style="display: flex; gap: 10px;">
            <button class="btn-primary">
                <i class="fas fa-save"></i> Saqlash
            </button>
            <button class="btn-primary" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                <i class="fas fa-file-excel"></i> Excel Export
            </button>
        </div>
    </div>
    <div class="card-body" style="padding: 0; overflow-x: auto;">
        <table class="grades-table">
            <thead>
                <tr>
                    <th class="sticky-col" style="min-width: 50px;">#</th>
                    <th class="sticky-col" style="min-width: 200px; left: 50px;">O'quvchi</th>
                    <th style="min-width: 120px;">01.12.2024<br><small>Dushanba</small></th>
                    <th style="min-width: 120px;">04.12.2024<br><small>Chorshanba</small></th>
                    <th style="min-width: 120px;">06.12.2024<br><small>Juma</small></th>
                    <th style="min-width: 120px;">08.12.2024<br><small>Dushanba</small></th>
                    <th style="min-width: 120px;">11.12.2024<br><small>Chorshanba</small></th>
                    <th style="min-width: 120px;">13.12.2024<br><small>Juma</small></th>
                    <th style="min-width: 120px;">15.12.2024<br><small>Dushanba</small></th>
                    <th style="min-width: 120px;">18.12.2024<br><small>Chorshanba</small></th>
                    <th style="min-width: 150px; background: #f8fafc;"><strong>O'rtacha</strong></th>
                    <th style="min-width: 150px; background: #f8fafc;"><strong>Davomat</strong></th>
                </tr>
            </thead>
            <tbody>
                <!-- O'quvchi 1 -->
                <tr>
                    <td class="sticky-col">1</td>
                    <td class="sticky-col student-name-cell" style="left: 50px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="https://ui-avatars.com/api/?name=Malika+Karimova&background=random" style="width: 35px; height: 35px; border-radius: 50%;">
                            <div>
                                <div style="font-weight: 700;">Malika Karimova</div>
                                <small style="color: #64748b;">ID: 12345</small>
                            </div>
                        </div>
                    </td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input" placeholder="-" min="1" max="5"></td>
                    <td style="background: #f8fafc;"><strong style="color: #10b981; font-size: 18px;">4.7</strong></td>
                    <td style="background: #f8fafc;"><strong style="color: #10b981;">87%</strong></td>
                </tr>

                <!-- O'quvchi 2 -->
                <tr>
                    <td class="sticky-col">2</td>
                    <td class="sticky-col student-name-cell" style="left: 50px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="https://ui-avatars.com/api/?name=Aziz+Toshmatov&background=random" style="width: 35px; height: 35px; border-radius: 50%;">
                            <div>
                                <div style="font-weight: 700;">Aziz Toshmatov</div>
                                <small style="color: #64748b;">ID: 12346</small>
                            </div>
                        </div>
                    </td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input average" value="3" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input" placeholder="-" min="1" max="5"></td>
                    <td style="background: #f8fafc;"><strong style="color: #3b82f6; font-size: 18px;">4.0</strong></td>
                    <td style="background: #f8fafc;"><strong style="color: #3b82f6;">100%</strong></td>
                </tr>

                <!-- O'quvchi 3 -->
                <tr>
                    <td class="sticky-col">3</td>
                    <td class="sticky-col student-name-cell" style="left: 50px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="https://ui-avatars.com/api/?name=Sardor+Rahimov&background=random" style="width: 35px; height: 35px; border-radius: 50%;">
                            <div>
                                <div style="font-weight: 700;">Sardor Rahimov</div>
                                <small style="color: #64748b;">ID: 12347</small>
                            </div>
                        </div>
                    </td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input" placeholder="-" min="1" max="5"></td>
                    <td style="background: #f8fafc;"><strong style="color: #10b981; font-size: 18px;">5.0</strong></td>
                    <td style="background: #f8fafc;"><strong style="color: #10b981;">100%</strong></td>
                </tr>

                <!-- O'quvchi 4 -->
                <tr>
                    <td class="sticky-col">4</td>
                    <td class="sticky-col student-name-cell" style="left: 50px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="https://ui-avatars.com/api/?name=Nigora+Aliyeva&background=random" style="width: 35px; height: 35px; border-radius: 50%;">
                            <div>
                                <div style="font-weight: 700;">Nigora Aliyeva</div>
                                <small style="color: #64748b;">ID: 12348</small>
                            </div>
                        </div>
                    </td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input average" value="3" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input poor" value="2" min="1" max="5"></td>
                    <td><input type="number" class="grade-input average" value="3" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input" placeholder="-" min="1" max="5"></td>
                    <td style="background: #f8fafc;"><strong style="color: #f59e0b; font-size: 18px;">3.4</strong></td>
                    <td style="background: #f8fafc;"><strong style="color: #f59e0b;">75%</strong></td>
                </tr>

                <!-- O'quvchi 5 -->
                <tr>
                    <td class="sticky-col">5</td>
                    <td class="sticky-col student-name-cell" style="left: 50px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="https://ui-avatars.com/api/?name=Dilshod+Qodirov&background=random" style="width: 35px; height: 35px; border-radius: 50%;">
                            <div>
                                <div style="font-weight: 700;">Dilshod Qodirov</div>
                                <small style="color: #64748b;">ID: 12349</small>
                            </div>
                        </div>
                    </td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input good" value="4" min="1" max="5"></td>
                    <td><input type="number" class="grade-input excellent" value="5" min="1" max="5"></td>
                    <td><input type="number" class="grade-input" placeholder="-" min="1" max="5"></td>
                    <td style="background: #f8fafc;"><strong style="color: #10b981; font-size: 18px;">4.6</strong></td>
                    <td style="background: #f8fafc;"><strong style="color: #10b981;">100%</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
.grades-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.grades-table thead th {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    padding: 15px;
    text-align: center;
    font-weight: 700;
    font-size: 13px;
    color: var(--dark);
    border: 1px solid #e2e8f0;
    position: sticky;
    top: 0;
    z-index: 10;
}

.grades-table tbody tr {
    transition: all 0.3s;
}

.grades-table tbody tr:hover {
    background: #f8fafc;
}

.grades-table tbody td {
    padding: 12px;
    text-align: center;
    border: 1px solid #e2e8f0;
}

.sticky-col {
    position: sticky;
    left: 0;
    background: white !important;
    z-index: 5;
    font-weight: 700;
    box-shadow: 2px 0 5px rgba(0,0,0,0.05);
}

.student-name-cell {
    text-align: left !important;
}

.grade-input {
    width: 70px;
    padding: 8px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    transition: all 0.3s;
}

.grade-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(16,185,129,0.1);
}

.grade-input.excellent {
    border-color: #10b981;
    background: #d1fae5;
    color: #065f46;
}

.grade-input.good {
    border-color: #3b82f6;
    background: #dbeafe;
    color: #1e40af;
}

.grade-input.average {
    border-color: #f59e0b;
    background: #fef3c7;
    color: #92400e;
}

.grade-input.poor {
    border-color: #ef4444;
    background: #fee2e2;
    color: #991b1b;
}
</style>

<script>
// Baholarni ranglash
document.querySelectorAll('.grade-input').forEach(input => {
    input.addEventListener('input', function() {
        const value = parseInt(this.value);
        this.classList.remove('excellent', 'good', 'average', 'poor');
        
        if (value === 5) {
            this.classList.add('excellent');
        } else if (value === 4) {
            this.classList.add('good');
        } else if (value === 3) {
            this.classList.add('average');
        } else if (value <= 2 && value > 0) {
            this.classList.add('poor');
        }
    });
});
</script>
@endsection
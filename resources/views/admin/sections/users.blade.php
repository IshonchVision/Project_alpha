@extends('admin.layout')

@section('title', 'Foydalanuvchilar')
@section('page-title', 'Foydalanuvchilar')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold text-dark">Barcha Foydalanuvchilar</h4>
                <!-- Agar "Yangi qo'shish" tugmasi bo'lsa, bu yerga qo'yiladi -->
                <!-- <button id="openModalBtn" class="btn btn-primary">+ Yangi foydalanuvchi</button> -->
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">FOYDALANUVCHI</th>
                            <th>ROL</th>
                            <th>TELEFON</th>
                            <th>RO'YXATDAN O'TGAN</th>
                            <th>STATUS</th>
                            <th class="text-center" width="120">AMALLAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&bold=true&rounded=true&size=48"
                                            class="rounded-circle shadow-sm" width="48" height="48" alt="{{ $user->name }}">
                                        <div>
                                            <div class="fw-semibold">{{ $user->name }}</div>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $roles = [
                                            'user' => ['bg-info-subtle text-info', 'O\'quvchi'],
                                            'teacher' => ['bg-success-subtle text-success', 'O\'qituvchi'],
                                            'admin' => ['bg-danger-subtle text-danger', 'Admin']
                                        ];
                                        $role = $user->role ?? 'user';
                                        $badge = $roles[$role] ?? ['bg-secondary-subtle text-secondary', ucfirst($role)];
                                    @endphp
                                    <span class="badge rounded-pill px-3 py-2 {{ $badge[0] }}">
                                        {{ $badge[1] }}
                                    </span>
                                </td>
                                <td class="text-muted">{{ $user->phone ?? '—' }}</td>
                                <td class="text-muted">{{ $user->created_at->format('d.m.Y') }}</td>
                                <td>
                                    <span
                                        class="badge rounded-pill px-3 py-2 {{ $user->status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                        {{ $user->status ? 'Faol' : 'NoFaol' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded"
                                                onclick="return confirm('«{{ $user->name }}» ni oʻchirmoqchimisiz?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Umumiy chiroyli ko'rinish */
        .table thead th {
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.95rem;
        }

        .badge {
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* Hover effekti */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Tugmalar */
        .btn-sm {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .btn-outline-primary:hover {
            background: #0d6efd;
            color: white;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // O'chirish tasdiqlash
            document.querySelectorAll(".delete-btn").forEach(btn => {
                btn.addEventListener("click", function () {
                    const name = this.dataset.name;
                    if (confirm(`"${name}" foydalanuvchini o'chirmoqchimisiz?\nBu amalni ortga qaytarib bo'lmaydi!`)) {
                        this.closest("form").submit();
                    }
                });
            });

            // Agar kelajakda edit modal qo'shmoqchi bo'lsangiz, bu yerda qoladi
        });
    </script>
@endsection
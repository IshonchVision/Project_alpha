{{-- resources/views/admin/groups/index.blade.php --}}

@extends('admin.layout')

@section('title', 'Guruhlar')
@section('page-title', 'Guruhlar')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Guruhlar roʻyxati</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroupModal">
            <i class="fas fa-plus"></i> Yangi guruh qoʻshish
        </button>
    </div>

    <div class="card-body">
        <div class="row g-4">
            @forelse($groups as $group)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 group-card">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">{{ $group->name }}</h5>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    {{ $group->teacher?->name ?? 'Oʻqituvchi biriktirilmagan' }}
                                </p>
                            </div>
                            <span class="badge rounded-pill {{ $group->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $group->status == 'active' ? 'Faol' : 'Arxivlangan' }}
                            </span>
                        </div>

                        <div class="row g-2 small text-muted flex-grow-1">
                            <div class="col-12 d-flex align-items-center">
                                <i class="fas fa-users me-2 text-primary"></i>
                                {{ $group->current_students }} / {{ $group->max_students }} oʻquvchi
                            </div>
                            <div class="col-12 d-flex align-items-center">
                                <i class="fas fa-book me-2 text-info"></i>
                                {{ $group->subject ?? '—' }}
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <i class="fas fa-calendar-alt me-2 text-success"></i>
                                {{ $group->lesson_days ?? '—' }}
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <i class="fas fa-clock me-2 text-warning"></i>
                                {{ $group->lesson_time ? \Carbon\Carbon::parse($group->lesson_time)->format('H:i') : '—' }}
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <i class="fas fa-layer-group me-2 text-purple"></i>
                                {{ ucfirst($group->level) }}
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <i class="fas fa-money-bill-wave me-2 text-danger"></i>
                                {{ number_format($group->monthly_fee) }} soʻm/oy
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted">
                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                    <p>Hozircha hech qanday guruh yaratilmagan</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Yangi guruh qoʻshish uchun Modal -->
<div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="addGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('admin.groups.store') }}" method="POST" id="groupForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModalLabel">Yangi guruh qoʻshish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Guruh nomi -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Guruh nomi <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Guruh kodi -->
                        <div class="col-md-6">
                            <label for="code" class="form-label">Guruh kodi (masalan: ENG-2025-A1)</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                                value="{{ old('code') }}" placeholder="ENG-2025-A1">
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- O'qituvchi -->
                        <div class="col-md-6">
                            <label for="teacher_id" class="form-label">O'qituvchi <span class="text-danger">*</span></label>
                            <select name="teacher_id" id="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror" required>
                                <option value="">-- O'qituvchi tanlang --</option>
                                @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }} @if($teacher->subject_name) ({{ $teacher->subject_name }}) @endif
                                </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fan nomi -->
                        <div class="col-md-6">
                            <label for="subject" class="form-label">Fan nomi</label>
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror"
                                value="{{ old('subject') }}">
                            @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Daraja -->
                        <div class="col-md-4">
                            <label for="level" class="form-label">Daraja</label>
                            <select name="level" id="level" class="form-select">
                                <option value="beginner" {{ old('level', 'beginner') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                        </div>

                        <!-- Dars kunlari -->
                        <div class="col-md-4">
                            <label for="lesson_days" class="form-label">Dars kunlari</label>
                            <input type="text" name="lesson_days" id="lesson_days" class="form-control"
                                value="{{ old('lesson_days') }}" placeholder="Dushanba, Chorshanba, Juma">
                        </div>

                        <!-- Dars vaqti -->
                        <div class="col-md-4">
                            <label for="lesson_time" class="form-label">Dars boshlanish vaqti</label>
                            <input type="time" name="lesson_time" id="lesson_time" class="form-control"
                                value="{{ old('lesson_time') }}">
                        </div>

                        <!-- Maksimal o'quvchilar soni -->
                        <div class="col-md-4">
                            <label for="max_students" class="form-label">Maksimal o'quvchilar soni</label>
                            <input type="number" name="max_students" id="max_students" class="form-control"
                                value="{{ old('max_students', 20) }}" min="1" max="50">
                        </div>

                        <!-- Oylik to'lov -->
                        <div class="col-md-4">
                            <label for="monthly_fee" class="form-label">Oylik toʻlov (soʻm)</label>
                            <input type="number" name="monthly_fee" id="monthly_fee" class="form-control"
                                value="{{ old('monthly_fee', 0) }}" min="0">
                        </div>

                        <!-- Kurs davomiyligi (oyda) -->
                        <div class="col-md-4">
                            <label for="duration_months" class="form-label">Kurs davomiyligi (oy)</label>
                            <input type="number" name="duration_months" id="duration_months" class="form-control"
                                value="{{ old('duration_months', 6) }}" min="1">
                        </div>

                        <!-- Boshlanish sanasi -->
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Boshlanish sanasi</label>
                            <input type="date" name="start_date" id="start_date" class="form-control"
                                value="{{ old('start_date') }}">
                        </div>

                        <!-- Xona -->
                        <div class="col-md-6">
                            <label for="room" class="form-label">Xona raqami</label>
                            <input type="text" name="room" id="room" class="form-control"
                                value="{{ old('room') }}" placeholder="Masalan: 301-xona">
                        </div>

                        <!-- Tavsif -->
                        <div class="col-12">
                            <label for="description" class="form-label">Qo'shimcha tavsif</label>
                            <textarea name="description" id="description" rows="3" class="form-control"
                                placeholder="Guruh haqida qisqacha ma'lumot...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guruhni saqlash
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .group-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .group-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .text-purple {
        color: #6f42c1;
    }
</style>
@endsection

@section('scripts')
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var addGroupModal = new bootstrap.Modal(document.getElementById('addGroupModal'));
        addGroupModal.show();
    });
</script>
@endif
@endsection
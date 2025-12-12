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
                @forelse($groups as $group)
                    <div class="col-md-6">
                        <div class="group-card">
                            <div class="group-header">
                                <div>
                                    <h5 class="group-title">{{ $group->name }}</h5>
                                    <p class="group-teacher">
                                        O'qituvchi: {{ $group->teacher?->name ?? 'Biriktirilmagan' }}
                                    </p>
                                </div>
                                <span class="badge {{ $group->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $group->status == 'active' ? 'Faol' : 'Faol emas' }}
                                </span>
                            </div>

                            <div class="group-stats">
                                <div class="group-stat">
                                    <i class="fas fa-users"></i>
                                    {{ $group->students_count ?? 0 }} o'quvchi
                                </div>
                                <div class="group-stat">
                                    <i class="fas fa-calendar"></i>
                                    {{ $group->days ?? '—' }}
                                </div>
                                <div class="group-stat">
                                    <i class="fas fa-clock"></i>
                                    {{ $group->time ?? '—' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Hozircha hech qanday guruh yaratilmagan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@extends('teacher.layout')

@section('title', 'Guruhlar')
@section('page-title', 'Guruhlar')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Guruhlar</h4>
        <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
            <i class="fas fa-plus"></i> Yangi Guruh
        </button>
    </div>

    <!-- Create Group Modal -->
    <div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="createGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('teacher.groups.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGroupModalLabel">Yangi Guruh</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Guruh nomi</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kod (ixtiyoriy)</label>
                            <input type="text" name="code" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fan</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dars kunlari</label>
                            <input type="text" name="lesson_days" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dars vaqti</label>
                            <input type="text" name="lesson_time" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max o'quvchilar</label>
                            <input type="number" name="max_students" class="form-control" min="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Faol</option>
                                <option value="inactive">Faol emas</option>
                                <option value="full">To'ldi</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary">Yaratish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div id="groupsAlertContainer"></div>
        <div class="row">
            @foreach($groups as $group)
            <div class="col-md-6" data-group-id="{{ $group->id }}">
                <div class="group-card">
                    <div class="group-header">
                        <div>
                            <h5 class="group-title">{{ $group->name }}</h5>
                            <p class="group-teacher">O'qituvchi: {{ $group->teacher?->name ?? '—' }}</p>
                        </div>
                    </div>
                    <div class="group-stats">
                        <div class="group-stat"><i class="fas fa-users"></i> {{ $group->current_students ?? $group->students_count ?? 0 }} o'quvchi</div>
                        <div class="group-stat"><i class="fas fa-calendar"></i> {{ $group->lesson_days ?? '—' }}</div>
                        <div class="group-stat"><i class="fas fa-clock"></i> {{ $group->lesson_time ?? '—' }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        function showAlert(msg, type = 'success') {
                const container = document.getElementById('groupsAlertContainer');
                if (!container) return;
                const el = document.createElement('div');
                el.className = 'alert alert-' + type;
                el.textContent = msg;
                container.appendChild(el);
                setTimeout(() => el.remove(), 4000);
        }

        // Open edit modal and populate
        document.addEventListener('click', function (e) {
                const edit = e.target.closest('.group-edit-btn');
                if (edit) {
                        const id = edit.getAttribute('data-id');
                        fetch('/teacher/groups/' + id, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                                .then(r => r.json())
                                .then(data => {
                                        const g = data.group;
                                        // ensure modal exists
                                        let modal = document.getElementById('editGroupModal');
                                        if (!modal) {
                                                // create modal HTML
                                                const html = `
                                                <div class="modal fade" id="editGroupModal" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form id="editGroupForm">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Guruhni tahrirlash</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="_method" value="PUT">
                                                                    <div class="mb-3"><label class="form-label">Guruh nomi</label><input id="edit_name" name="name" class="form-control" required></div>
                                                                    <div class="mb-3"><label class="form-label">Kod</label><input id="edit_code" name="code" class="form-control"></div>
                                                                    <div class="mb-3"><label class="form-label">Fan</label><input id="edit_subject" name="subject" class="form-control"></div>
                                                                    <div class="mb-3"><label class="form-label">Dars kunlari</label><input id="edit_lesson_days" name="lesson_days" class="form-control"></div>
                                                                    <div class="mb-3"><label class="form-label">Dars vaqti</label><input id="edit_lesson_time" name="lesson_time" class="form-control"></div>
                                                                    <div class="mb-3"><label class="form-label">Max o'quvchilar</label><input id="edit_max_students" name="max_students" type="number" class="form-control" min="1"></div>
                                                                    <div class="mb-3"><label class="form-label">Status</label>
                                                                        <select id="edit_status" name="status" class="form-select"><option value="active">Faol</option><option value="inactive">Faol emas</option><option value="full">To'ldi</option></select>
                                                                    </div>
                                                                    <div id="editErrors" class="text-danger"></div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                                                                    <button type="submit" class="btn btn-primary">Saqlash</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>`;
                                                document.body.insertAdjacentHTML('beforeend', html);
                                                modal = document.getElementById('editGroupModal');
                                        }

                                        // fill inputs
                                        modal.querySelector('#edit_name').value = g.name ?? '';
                                        modal.querySelector('#edit_code').value = g.code ?? '';
                                        modal.querySelector('#edit_subject').value = g.subject ?? '';
                                        modal.querySelector('#edit_lesson_days').value = g.lesson_days ?? '';
                                        modal.querySelector('#edit_lesson_time').value = g.lesson_time ?? '';
                                        modal.querySelector('#edit_max_students').value = g.max_students ?? '';
                                        modal.querySelector('#edit_status').value = g.status ?? 'active';
                                        modal.setAttribute('data-group-id', g.id);

                                        const bsModal = new bootstrap.Modal(modal);
                                        bsModal.show();
                                }).catch(err => { console.error(err); alert('Guruh maʼlumotlarini olishda xatolik'); });
                }

                // Delete
                const del = e.target.closest('.group-delete-btn');
                if (del) {
                        const id = del.getAttribute('data-id');
                        if (!confirm('Guruhni o‘chirishni xohlaysizmi?')) return;
                        const form = new FormData(); form.append('_method', 'DELETE'); form.append('_token', csrf);
                        fetch('/teacher/groups/' + id, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: form })
                                .then(async r => { if (!r.ok) throw await r.json().catch(() => ({ message: 'Server error' })); return r.json(); })
                                .then(json => {
                                        const el = document.querySelector('[data-group-id="' + id + '"]');
                                        if (el) el.remove();
                                        showAlert(json.message ?? 'Guruh o‘chirildi', 'success');
                                }).catch(err => { console.error(err); showAlert(err.message ?? 'O‘chirishda xatolik', 'danger'); });
                }
        });

        // Handle edit submit
        document.addEventListener('submit', function (e) {
                const form = e.target;
                if (form && form.id === 'editGroupForm') {
                        e.preventDefault();
                        const modal = form.closest('.modal');
                        const id = modal?.getAttribute('data-group-id');
                        if (!id) return;

                        const fd = new FormData(form);
                        fd.append('_token', csrf);
                        // Already has _method=PUT field

                        fetch('/teacher/groups/' + id, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: fd })
                                .then(async r => {
                                        if (!r.ok) throw await r.json().catch(() => ({ message: 'Server error' }));
                                        return r.json();
                                })
                                .then(json => {
                                        const g = json.group;
                                        const el = document.querySelector('[data-group-id="' + id + '"]');
                                        if (el) {
                                                el.querySelector('.group-title').textContent = g.name ?? '';
                                                el.querySelector('.group-stat .fa-calendar')?.parentElement && (el.querySelectorAll('.group-stat')[1].innerHTML = '<i class="fas fa-calendar"></i> ' + (g.lesson_days ?? '—'));
                                                el.querySelectorAll('.group-stat')[2].innerHTML = '<i class="fas fa-clock"></i> ' + (g.lesson_time ?? '—');
                                                const badge = el.querySelector('.badge');
                                                if (badge) {
                                                        badge.textContent = (g.status ? (g.status.charAt(0).toUpperCase() + g.status.slice(1)) : '—');
                                                        badge.className = 'badge ' + (g.status == 'active' ? 'bg-success' : (g.status == 'inactive' ? 'bg-danger' : 'bg-warning'));
                                                }
                                        }

                                        showAlert(json.message ?? 'Guruh yangilandi');
                                        const bs = bootstrap.Modal.getInstance(modal);
                                        if (bs) bs.hide();
                                }).catch(err => {
                                        console.error(err);
                                        const errEl = document.getElementById('editErrors');
                                        if (errEl) errEl.textContent = (err.message ?? 'Xatolik');
                                });
                }
        });
});
</script>
@endsection
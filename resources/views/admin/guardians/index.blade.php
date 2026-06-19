@extends('admin.layouts.app')
@section('title', 'Guardian Management')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0" style="color:var(--hope-green,#1B4332);">Guardian Management</h5>
    @if(Auth::user()->hasPermission('create_user'))
    <a href="{{ route('admin.users.create', ['role' => 'guardian']) }}"
        class="btn btn-sm" style="background:#1B4332;color:#fff;font-weight:600;border-radius:8px;">
        <i data-lucide="user-plus" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>Add Guardian via User Management
    </a>
    @endif
</div>

<div class="card mb-3">
    <div class="card-body py-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" id="searchInput" class="form-control form-control-sm"
                    placeholder="Search by name or email...">
            </div>
            <div class="col-md-3">
                <select id="sortSelect" class="form-select form-select-sm">
                    <option value="az">A–Z Name</option>
                    <option value="za">Z–A Name</option>
                    <option value="created">Date Created</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="statusFilter" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-sm btn-outline-secondary w-100" onclick="clearFilters()">
                    <i data-lucide="x-circle" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Clear
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0" id="guardiansTable">
            <thead style="background:#1B4332;">
                <tr>
                    <th style="color:#EAB308;">Full Name</th>
                    <th style="color:#EAB308;">Email</th>
                    <th style="color:#EAB308;">Contact</th>
                    <th style="color:#EAB308;">Relationship</th>
                    <th style="color:#EAB308;">Students</th>
                    <th style="color:#EAB308;">Status</th>
                    <th style="color:#EAB308;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guardians as $guardian)
                @php $user = $guardian->user; @endphp
                <tr data-name="{{ strtolower(optional($user)->last_name ?? '') }}"
                    data-created="{{ optional($user)->created_at?->timestamp ?? 0 }}"
                    data-status="{{ optional($user)->is_active ? 'active' : 'inactive' }}"
                    data-search="{{ strtolower(optional($user)->list_name.' '.optional($user)->email) }}">
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @include('partials.avatar',[
                            'name' => optional($user)->list_name ?? '?',
                            'image' => optional($user)->profile_picture ?? null,
                            'size' => 32,
                            ])
                            <span>{{ optional($user)->list_name ?? '—' }}</span>
                        </div>
                    </td>
                    <td>{{ optional($user)->email ?? '—' }}</td>
                    <td>{{ optional($user)->contact_number_1 ?? '—' }}</td>
                    <td>{{ $guardian->relationship ?? '—' }}</td>
                    <td>
                        @forelse($guardian->students as $student)
                            <div class="small {{ !$loop->last ? 'mb-1' : '' }}">{{ $student->list_name }}</div>
                        @empty
                            <span class="text-muted">—</span>
                        @endforelse
                    </td>
                    <td>
                        <span class="badge bg-{{ optional($user)->is_active ? 'success' : 'secondary' }}">
                            {{ optional($user)->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            @if(Auth::user()->hasPermission('view_guardian'))
                            <a href="{{ route('admin.guardians.show',$guardian->guardian_id) }}"
                                class="btn btn-sm btn-outline-info" title="View">
                                <i data-lucide="eye" style="width:14px;height:14px;"></i>
                            </a>
                            @endif
                            @if(Auth::user()->hasPermission('edit_guardian'))
                            <a href="{{ route('admin.guardians.edit',$guardian->guardian_id) }}"
                                class="btn btn-sm btn-outline-primary" title="Edit">
                                <i data-lucide="pencil" style="width:14px;height:14px;"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr id="noDataRow">
                    <td colspan="7" class="text-center text-muted py-5">
                        <i data-lucide="heart-handshake" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#9ca3af;"></i>
                        No guardians found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="noResults" class="text-center text-muted py-4" style="display:none;">
            <i data-lucide="search" style="width:1.5rem;height:1.5rem;display:block;margin:0 auto .5rem;stroke:#9ca3af;"></i>
            No guardians match your search.
        </div>
    </div>
</div>

<script>
    var searchInput = document.getElementById('searchInput');
    var sortSelect = document.getElementById('sortSelect');
    var statusFilter = document.getElementById('statusFilter');
    var tbody = document.querySelector('#guardiansTable tbody');
    var hasGuardians = tbody.querySelectorAll('tr[data-search]').length > 0;

    function applyFilters() {
        if (!hasGuardians) {
            document.getElementById('noResults').style.display = 'none';
            return;
        }

        var search = searchInput.value.toLowerCase().trim();
        var sort = sortSelect.value;
        var status = statusFilter.value;

        var rows = Array.from(tbody.querySelectorAll('tr[data-search]'));

        rows.forEach(function(row) {
            var show = true;
            if (search && !(row.dataset.search || '').includes(search)) {
                show = false;
            }
            if (status && row.dataset.status !== status) {
                show = false;
            }
            row.style.display = show ? '' : 'none';
        });

        var visible = rows.filter(function(r) {
            return r.style.display !== 'none';
        });
        document.getElementById('noResults').style.display = (visible.length === 0) ? '' : 'none';

        visible.sort(function(a, b) {
            if (sort === 'az') return (a.dataset.name || '').localeCompare(b.dataset.name || '');
            if (sort === 'za') return (b.dataset.name || '').localeCompare(a.dataset.name || '');
            if (sort === 'created') return (b.dataset.created || 0) - (a.dataset.created || 0);
            return 0;
        });
        visible.forEach(function(r) {
            tbody.appendChild(r);
        });
    }

    function clearFilters() {
        searchInput.value = '';
        sortSelect.value = 'az';
        statusFilter.value = '';
        applyFilters();
    }

    [searchInput, sortSelect, statusFilter].forEach(function(el) {
        el.addEventListener('input', applyFilters);
    });

    applyFilters();
    setTimeout(function() { lucide.createIcons(); }, 100);
</script>
@endsection

@extends('admin.layouts.app')
@section('title', 'Guardian Management')
@section('content')

<div class="page-heading">
    <h5>Guardian Management</h5>
    @if(Auth::user()->hasPermission('create_user'))
    <a href="{{ route('admin.users.create', ['role' => 'guardian']) }}" class="btn-primary-app">
        <i data-lucide="user-plus"></i>Add Guardian
    </a>
    @endif
</div>

<div class="filter-bar">
    <div class="row g-2 align-items-center">
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text" style="background:#f8fafc;border-color:#E5E9F2;border-right:none;padding:.42rem .65rem;">
                    <i data-lucide="search" style="width:14px;height:14px;stroke:#94A3B8;"></i>
                </span>
                <input type="text" id="searchInput" class="form-control" placeholder="Search by name or email…">
            </div>
        </div>
        <div class="col-md-3">
            <select id="sortSelect" class="form-select">
                <option value="az">A–Z Name</option>
                <option value="za">Z–A Name</option>
                <option value="created">Date Created</option>
            </select>
        </div>
        <div class="col-md-2">
            <select id="statusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-secondary w-100" onclick="clearFilters()" style="height:38px;font-size:13.5px;">
                <i data-lucide="x" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.25rem;"></i>Clear
            </button>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-scroll-wrap">
        <table class="table table-hover" id="guardiansTable">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Relationship</th>
                    <th>Students</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                            @include('partials.avatar',['name'=>optional($user)->list_name??'?','image'=>optional($user)->profile_picture??null,'size'=>32])
                            <span class="fw-semibold">{{ optional($user)->list_name ?? '—' }}</span>
                        </div>
                    </td>
                    <td>{{ optional($user)->email ?? '—' }}</td>
                    <td>{{ optional($user)->contact_number_1 ?? '—' }}</td>
                    <td>{{ $guardian->relationship ?? '—' }}</td>
                    <td>
                        @forelse($guardian->students as $student)
                            <div class="small {{ !$loop->last ? 'mb-1' : '' }}">{{ $student->list_name }}</div>
                        @empty
                            <span style="color:#94A3B8;">—</span>
                        @endforelse
                    </td>
                    <td>
                        <span class="badge" style="background:{{ optional($user)->is_active ? '#DCFCE7' : '#F1F5F9' }};color:{{ optional($user)->is_active ? '#166534' : '#64748B' }};">
                            {{ optional($user)->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            @if(Auth::user()->hasPermission('view_guardian'))
                            <a href="{{ route('admin.guardians.show',$guardian->guardian_id) }}" class="btn-act btn-act-view">
                                <i data-lucide="eye"></i>View
                            </a>
                            @endif
                            @if(Auth::user()->hasPermission('edit_guardian'))
                            <a href="{{ route('admin.guardians.edit',$guardian->guardian_id) }}" class="btn-act btn-act-edit">
                                <i data-lucide="pencil"></i>Edit
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr id="noDataRow">
                    <td colspan="7" class="text-center py-5" style="color:#94A3B8;">
                        <i data-lucide="heart-handshake" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
                        No guardians found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div id="noResults" class="text-center py-5" style="display:none;color:#94A3B8;">
        <i data-lucide="search" style="width:1.5rem;height:1.5rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
        No guardians match your filters.
    </div>
</div>

<script>
    var searchInput  = document.getElementById('searchInput');
    var sortSelect   = document.getElementById('sortSelect');
    var statusFilter = document.getElementById('statusFilter');
    var tbody = document.querySelector('#guardiansTable tbody');
    var hasGuardians = tbody.querySelectorAll('tr[data-search]').length > 0;

    function applyFilters() {
        if (!hasGuardians) { document.getElementById('noResults').style.display='none'; return; }
        var search = searchInput.value.toLowerCase().trim();
        var sort   = sortSelect.value;
        var status = statusFilter.value;
        var rows   = Array.from(tbody.querySelectorAll('tr[data-search]'));

        rows.forEach(function(row) {
            var show = true;
            if (search && !(row.dataset.search||'').includes(search)) show=false;
            if (status && row.dataset.status!==status) show=false;
            row.style.display = show ? '' : 'none';
        });

        var visible = rows.filter(r=>r.style.display!=='none');
        document.getElementById('noResults').style.display = visible.length===0 ? '' : 'none';

        visible.sort(function(a,b){
            if (sort==='az') return (a.dataset.name||'').localeCompare(b.dataset.name||'');
            if (sort==='za') return (b.dataset.name||'').localeCompare(a.dataset.name||'');
            if (sort==='created') return (b.dataset.created||0)-(a.dataset.created||0);
            return 0;
        }).forEach(r=>tbody.appendChild(r));
    }

    function clearFilters() {
        searchInput.value=''; sortSelect.value='az'; statusFilter.value='';
        applyFilters();
    }

    [searchInput,sortSelect,statusFilter].forEach(el=>el.addEventListener('input',applyFilters));
    applyFilters();
    setTimeout(()=>lucide.createIcons(), 100);
</script>
@endsection

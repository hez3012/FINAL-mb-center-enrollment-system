@extends('admin.layouts.app')
@section('title', 'Enrollment Management')
@section('content')

<div class="page-heading">
    <h5>Enrollment Management</h5>
    @if(Auth::user()->hasPermission('create_walkin_enrollment'))
    <a href="{{ route('admin.enrollments.create') }}" class="btn-primary-app">
        <i data-lucide="clipboard-plus"></i>Add Walk-in Enrollment
    </a>
    @endif
</div>

<div class="filter-bar">
    <div class="row g-2 align-items-center">
        <div class="col-md-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by student name…">
        </div>
        <div class="col-md-2">
            <select id="yearFilter" class="form-select">
                <option value="">All School Years</option>
                @foreach($schoolYears as $sy)
                <option value="{{ $sy->school_year_id }}">{{ $sy->year_label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select id="statusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="pending">Pending Review</option>
                <option value="pending_payment">Pending Payment</option>
                <option value="enrolled">Enrolled</option>
                <option value="completed">Completed</option>
                <option value="withdrawn">Withdrawn</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <div class="col-md-2">
            <select id="typeFilter" class="form-select">
                <option value="">All Types</option>
                <option value="walk_in">Walk-in</option>
                <option value="online">Online</option>
            </select>
        </div>
        <div class="col-md-2">
            <select id="sortSelect" class="form-select">
                <option value="default">Sort: Default</option>
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="az">A–Z Name</option>
                <option value="za">Z–A Name</option>
            </select>
        </div>
        <div class="col-md-1">
            <button class="btn btn-outline-secondary w-100" onclick="clearFilters()" style="height:38px;" title="Clear">
                <i data-lucide="x" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
            </button>
        </div>
    </div>
</div>

@php
$statusBg = ['pending'=>'#FEF3C7','pending_payment'=>'#FFEDD5','enrolled'=>'#DCFCE7','completed'=>'#DBEAFE','withdrawn'=>'#F1F5F9','rejected'=>'#FEE2E2'];
$statusTx = ['pending'=>'#92400E','pending_payment'=>'#9A3412','enrolled'=>'#166534','completed'=>'#1E40AF','withdrawn'=>'#64748B','rejected'=>'#B91C1C'];
@endphp

<div class="card">
    <div class="table-scroll-wrap">
        <table class="table table-hover" id="enrollmentsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>School Year</th>
                    <th>Program</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $editableStatuses = ['pending', 'pending_payment', 'enrolled'];

                $statusGroups = [
                    ['key'=>'digital_pending','label'=>'Pending Review — Digital Enrollment','icon'=>'globe','groupbg'=>'#FFFBEB',
                     'items'=>$enrollments->filter(fn($e)=>$e->status==='pending'&&$e->enrollment_type==='online')],
                    ['key'=>'active','label'=>'Active Enrollments','icon'=>'clipboard-check','groupbg'=>'#F0FDF4',
                     'items'=>$enrollments->filter(fn($e)=>in_array($e->status,['pending','pending_payment','enrolled'])&&!($e->status==='pending'&&$e->enrollment_type==='online'))],
                    ['key'=>'completed','label'=>'Completed','icon'=>'check-circle-2','groupbg'=>'#EFF6FF',
                     'items'=>$enrollments->filter(fn($e)=>$e->status==='completed')],
                    ['key'=>'withdrawn','label'=>'Withdrawn — History','icon'=>'clipboard-x','groupbg'=>'#FFFBEB',
                     'items'=>$enrollments->filter(fn($e)=>$e->status==='withdrawn')],
                    ['key'=>'rejected','label'=>'Rejected — History','icon'=>'x-circle','groupbg'=>'#FFF1F2',
                     'items'=>$enrollments->filter(fn($e)=>$e->status==='rejected')],
                ];
                @endphp

                @if($enrollments->isEmpty())
                <tr id="noDataRow">
                    <td colspan="8" class="text-center py-5" style="color:#94A3B8;">
                        <i data-lucide="clipboard-x" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
                        No enrollments found.
                    </td>
                </tr>
                @endif

                @foreach($statusGroups as $group)
                @if($group['items']->isNotEmpty())
                <tr class="category-header" data-category="{{ $group['key'] }}" style="background:{{ $group['groupbg'] }};">
                    <td colspan="8" style="padding:.55rem 1rem;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748B;border-bottom:1px solid #E2E8F0;">
                        <i data-lucide="{{ $group['icon'] }}" style="width:13px;height:13px;display:inline;vertical-align:middle;margin-right:.4rem;stroke:#1B4332;"></i>{{ $group['label'] }}
                    </td>
                </tr>
                @foreach($group['items'] as $enrollment)
                @php
                $isOnlinePending = $enrollment->enrollment_type==='online' && $enrollment->status==='pending';
                @endphp
                <tr data-name="{{ strtolower(optional($enrollment->student)->last_name ?? '') }}"
                    data-created="{{ $enrollment->created_at?->timestamp ?? 0 }}"
                    data-year="{{ $enrollment->school_year_id }}"
                    data-status="{{ $enrollment->status }}"
                    data-type="{{ $enrollment->enrollment_type }}"
                    data-search="{{ strtolower(optional($enrollment->student)->list_name ?? '') }}">
                    <td style="color:#94A3B8;font-size:12px;">{{ $enrollment->enrollment_id }}</td>
                    <td class="fw-semibold">{{ optional($enrollment->student)->list_name ?? '—' }}</td>
                    <td>{{ optional($enrollment->schoolYear)->year_label ?? '—' }}</td>
                    <td>
                        @if(optional($enrollment->programLevel)->program_name)
                            {{ $enrollment->programLevel->program_name }}
                        @elseif($enrollment->student?->serviceType?->service_name)
                            <span style="color:#64748B;font-size:12px;">{{ $enrollment->student->serviceType->service_name }}</span>
                        @else —
                        @endif
                    </td>
                    <td>
                        <span class="badge" style="background:{{ $enrollment->enrollment_type==='walk_in' ? '#F1F5F9' : '#E0F2FE' }};color:{{ $enrollment->enrollment_type==='walk_in' ? '#64748B' : '#0369A1' }};">
                            {{ $enrollment->type_label }}
                        </span>
                    </td>
                    <td>
                        <span class="badge" style="background:{{ $statusBg[$enrollment->status] ?? '#F1F5F9' }};color:{{ $statusTx[$enrollment->status] ?? '#64748B' }};">
                            {{ $enrollment->status_label }}
                        </span>
                    </td>
                    <td style="font-size:12.5px;color:#64748B;">
                        {{ $enrollment->enrollment_date?->format('m/d/Y') ?? '—' }}
                    </td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="{{ route('admin.enrollments.show',['id'=>$enrollment->enrollment_id]) }}" class="btn-act btn-act-view">
                                <i data-lucide="eye"></i>View
                            </a>
                            @if(in_array($enrollment->status,$editableStatuses) && Auth::user()->hasPermission('edit_enrollment') && !$isOnlinePending)
                            <a href="{{ route('admin.enrollments.edit',['id'=>$enrollment->enrollment_id]) }}" class="btn-act btn-act-edit">
                                <i data-lucide="pencil"></i>Edit
                            </a>
                            @endif
                            @if(Auth::user()->hasPermission('delete_enrollment'))
                            <button type="button" class="btn-act btn-act-del"
                                data-url="{{ route('admin.enrollments.destroy',['id'=>$enrollment->enrollment_id]) }}"
                                onclick="confirmDelete(this.dataset.url)">
                                <i data-lucide="trash-2"></i>Delete
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="noResults" class="text-center py-5" style="display:none;color:#94A3B8;">
        <i data-lucide="search" style="width:1.5rem;height:1.5rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
        No enrollments match your filters.
    </div>
</div>

@if($enrollments->hasPages())
<div class="mt-3">{{ $enrollments->withQueryString()->links('pagination::bootstrap-5') }}</div>
@endif

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold" style="color:#DC2626;">
                    <i data-lucide="trash-2" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>Delete Enrollment
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="font-size:13.5px;color:#64748B;">
                Delete this enrollment record? This cannot be undone.
            </div>
            <div class="modal-footer border-0 pt-0">
                <button class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var searchInput  = document.getElementById('searchInput');
    var yearFilter   = document.getElementById('yearFilter');
    var statusFilter = document.getElementById('statusFilter');
    var typeFilter   = document.getElementById('typeFilter');
    var sortSelect   = document.getElementById('sortSelect');
    var tbody = document.querySelector('#enrollmentsTable tbody');

    Array.from(tbody.querySelectorAll('tr')).forEach(function(el,i){ el.dataset.originalOrder=i; });

    function applyFilters() {
        var search = searchInput.value.toLowerCase().trim();
        var year   = yearFilter.value;
        var status = statusFilter.value;
        var type   = typeFilter.value;
        var sort   = sortSelect.value;
        var hasFilter = search||year||status||type||sort!=='default';

        var headers  = Array.from(tbody.querySelectorAll('tr.category-header'));
        var spacers  = Array.from(tbody.querySelectorAll('tr.category-spacer'));
        var dataRows = Array.from(tbody.querySelectorAll('tr[data-search]'));
        var noRes    = document.getElementById('noResults');

        if (!hasFilter) {
            Array.from(tbody.querySelectorAll('tr'))
                .sort((a,b)=>parseInt(a.dataset.originalOrder||0)-parseInt(b.dataset.originalOrder||0))
                .forEach(el=>tbody.appendChild(el));
            headers.forEach(h=>h.style.display='');
            spacers.forEach(s=>s.style.display='');
            dataRows.forEach(r=>r.style.display='');
            noRes.style.display='none';
            return;
        }

        headers.forEach(h=>h.style.display='none');
        spacers.forEach(s=>s.style.display='');
        dataRows.forEach(function(row){
            var show=true;
            if (search && !(row.dataset.search||'').includes(search)) show=false;
            if (year   && row.dataset.year!==year)   show=false;
            if (status && row.dataset.status!==status) show=false;
            if (type   && row.dataset.type!==type)   show=false;
            row.style.display=show?'':'none';
        });

        var visible=dataRows.filter(r=>r.style.display!=='none');
        noRes.style.display=visible.length===0?'':'none';

        visible.sort(function(a,b){
            if (sort==='newest') return parseInt(b.dataset.created||0)-parseInt(a.dataset.created||0);
            if (sort==='oldest') return parseInt(a.dataset.created||0)-parseInt(b.dataset.created||0);
            if (sort==='az') return (a.dataset.name||'').localeCompare(b.dataset.name||'');
            if (sort==='za') return (b.dataset.name||'').localeCompare(a.dataset.name||'');
            return 0;
        }).forEach(r=>tbody.appendChild(r));
    }

    function clearFilters() {
        searchInput.value=''; yearFilter.value=''; statusFilter.value=''; typeFilter.value=''; sortSelect.value='default';
        applyFilters();
    }

    function confirmDelete(url) {
        document.getElementById('deleteForm').action=url;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    [searchInput,yearFilter,statusFilter,typeFilter,sortSelect].forEach(el=>el.addEventListener('input',applyFilters));
    applyFilters();
    setTimeout(()=>lucide.createIcons(),100);
</script>
@endsection

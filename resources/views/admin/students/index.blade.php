@extends('admin.layouts.app')
@section('title', 'Student Management')
@section('content')

<div class="page-heading">
    <h5>Student Management</h5>
    @if(Auth::user()->hasPermission('create_student'))
    <a href="{{ route('admin.students.create') }}" class="btn-primary-app">
        <i data-lucide="user-plus"></i>Add New Student
    </a>
    @endif
</div>

<div class="filter-bar">
    <div class="row g-2 align-items-center">
        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-text" style="background:#f8fafc;border-color:#E5E9F2;border-right:none;padding:.42rem .65rem;">
                    <i data-lucide="search" style="width:14px;height:14px;stroke:#94A3B8;"></i>
                </span>
                <input type="text" id="searchInput" class="form-control" placeholder="Search by name or guardian…">
            </div>
        </div>
        <div class="col-md-2">
            <select id="sortSelect" class="form-select">
                <option value="default">Sort: Default (by Status)</option>
                <option value="az">A–Z Name</option>
                <option value="za">Z–A Name</option>
                <option value="created">Date Created</option>
                <option value="modified">Date Modified</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="serviceFilter" class="form-select">
                <option value="">All Services</option>
                @foreach($serviceTypes as $st)
                <option value="{{ $st->service_type_id }}">{{ $st->service_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select id="statusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="withdrawn">Withdrawn</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-secondary w-100" onclick="clearFilters()" style="height:38px;font-size:13.5px;">
                <i data-lucide="x" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.25rem;"></i>Clear Filters
            </button>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-scroll-wrap">
        <table class="table table-hover" id="studentsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Guardian</th>
                    <th>Service Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $statusBg = ['active'=>'#DCFCE7','inactive'=>'#F1F5F9','withdrawn'=>'#FEF3C7','completed'=>'#DBEAFE'];
                $statusTx = ['active'=>'#166534','inactive'=>'#64748B','withdrawn'=>'#92400E','completed'=>'#1E40AF'];
                $statusGroups = [
                    ['key'=>'active',    'label'=>'Active',    'icon'=>'user-check', 'groupbg'=>'#F0FDF4','students'=>$students->where('status','active')],
                    ['key'=>'inactive',  'label'=>'Inactive',  'icon'=>'user-minus', 'groupbg'=>'#F8FAFC','students'=>$students->where('status','inactive')],
                    ['key'=>'withdrawn', 'label'=>'Withdrawn', 'icon'=>'user-x',     'groupbg'=>'#FFFBEB','students'=>$students->where('status','withdrawn')],
                    ['key'=>'completed', 'label'=>'Completed', 'icon'=>'badge-check','groupbg'=>'#EFF6FF','students'=>$students->where('status','completed')],
                ];
                @endphp

                @if($students->isEmpty())
                <tr id="noDataRow">
                    <td colspan="6" class="text-center py-5" style="color:#94A3B8;">
                        <i data-lucide="graduation-cap" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
                        No students found.
                    </td>
                </tr>
                @endif

                @foreach($statusGroups as $group)
                @if($group['students']->isNotEmpty())
                <tr class="category-header" data-category="{{ $group['key'] }}" style="background:{{ $group['groupbg'] }};">
                    <td colspan="6" style="padding:.55rem 1rem;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748B;border-bottom:1px solid #E2E8F0;">
                        <i data-lucide="{{ $group['icon'] }}" style="width:13px;height:13px;display:inline;vertical-align:middle;margin-right:.4rem;stroke:#1B4332;"></i>{{ $group['label'] }}
                    </td>
                </tr>
                @foreach($group['students'] as $student)
                @php
                $isLocked = in_array($student->student_id, $lockedStudentIds ?? []);
                $guardianName = optional($student->guardian?->user)->full_name ?? '—';
                @endphp
                <tr data-name="{{ strtolower($student->last_name) }}"
                    data-created="{{ $student->created_at?->timestamp ?? 0 }}"
                    data-modified="{{ $student->updated_at?->timestamp ?? 0 }}"
                    data-service="{{ $student->service_type_id }}"
                    data-status="{{ $student->status }}"
                    data-search="{{ strtolower($student->list_name.' '.$guardianName) }}">
                    <td style="color:#94A3B8;font-size:12px;">{{ $student->student_id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @include('partials.avatar',['name'=>$student->list_name,'image'=>$student->profile_picture,'size'=>32])
                            <div>
                                <div class="fw-semibold" style="font-size:13.5px;">{{ $student->list_name }}</div>
                                @if($isLocked)
                                <div style="font-size:11px;color:#B45309;display:flex;align-items:center;gap:.2rem;">
                                    <i data-lucide="lock" style="width:10px;height:10px;display:inline;"></i>Pending online enrollment
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $guardianName }}</td>
                    <td>
                        @if($student->serviceType)
                        <span class="badge" style="background:#E0F2FE;color:#0369A1;">{{ $student->serviceType->service_name }}</span>
                        @else
                        <span style="color:#94A3B8;">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge" style="background:{{ $statusBg[$student->status] ?? '#F1F5F9' }};color:{{ $statusTx[$student->status] ?? '#64748B' }};">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            @if(Auth::user()->hasPermission('view_student'))
                            <a href="{{ route('admin.students.show',$student->student_id) }}" class="btn-act btn-act-view">
                                <i data-lucide="eye"></i>View
                            </a>
                            @endif
                            @if(Auth::user()->hasPermission('edit_student'))
                            @if($isLocked)
                            <span class="btn-act" style="opacity:.45;cursor:not-allowed;color:#64748B;border-color:#E2E8F0;background:#F8FAFC;" title="Cannot edit — digital enrollment pending">
                                <i data-lucide="lock"></i>Locked
                            </span>
                            @else
                            <a href="{{ route('admin.students.edit',$student->student_id) }}" class="btn-act btn-act-edit">
                                <i data-lucide="pencil"></i>Edit
                            </a>
                            @endif
                            @endif
                            @if(Auth::user()->hasPermission('delete_student'))
                            <button type="button" class="btn-act btn-act-del"
                                data-name="{{ $student->list_name }}"
                                data-url="{{ route('admin.students.destroy',['id'=>$student->student_id]) }}"
                                onclick="confirmDelete(this.dataset.url,this.dataset.name)">
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
        No students match your filters.
    </div>
</div>

{{-- Paginator (controller uses paginate(15)) --}}
@if($students->hasPages())
<div class="mt-3">{{ $students->withQueryString()->links('pagination::bootstrap-5') }}</div>
@endif

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold" style="color:#DC2626;">
                    <i data-lucide="trash-2" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>Delete Student
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="font-size:13.5px;color:#64748B;">
                Delete <strong id="deleteStudentName"></strong>? This cannot be undone.
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
    var sortSelect   = document.getElementById('sortSelect');
    var serviceFilter= document.getElementById('serviceFilter');
    var statusFilter = document.getElementById('statusFilter');
    var tbody = document.querySelector('#studentsTable tbody');

    Array.from(tbody.querySelectorAll('tr')).forEach(function(el,i){ el.dataset.originalOrder=i; });

    function applyFilters() {
        var search  = searchInput.value.toLowerCase().trim();
        var sort    = sortSelect.value;
        var service = serviceFilter.value;
        var status  = statusFilter.value;
        var hasFilter = search||service||status||sort!=='default';

        var headers  = Array.from(tbody.querySelectorAll('tr.category-header'));
        var dataRows = Array.from(tbody.querySelectorAll('tr[data-search]'));
        var noRes    = document.getElementById('noResults');

        if (!hasFilter) {
            Array.from(tbody.querySelectorAll('tr'))
                .sort((a,b)=>parseInt(a.dataset.originalOrder||0)-parseInt(b.dataset.originalOrder||0))
                .forEach(el=>tbody.appendChild(el));
            headers.forEach(h=>h.style.display='');
            dataRows.forEach(r=>r.style.display='');
            noRes.style.display='none';
            return;
        }

        headers.forEach(h=>h.style.display='none');
        dataRows.forEach(function(row){
            var show=true;
            if (search  && !(row.dataset.search||'').includes(search)) show=false;
            if (service && row.dataset.service!==service) show=false;
            if (status  && row.dataset.status!==status)  show=false;
            row.style.display=show?'':'none';
        });

        var visible=dataRows.filter(r=>r.style.display!=='none');
        noRes.style.display=visible.length===0?'':'none';

        visible.sort(function(a,b){
            if (sort==='az') return (a.dataset.name||'').localeCompare(b.dataset.name||'');
            if (sort==='za') return (b.dataset.name||'').localeCompare(a.dataset.name||'');
            if (sort==='created')  return parseInt(b.dataset.created||0)-parseInt(a.dataset.created||0);
            if (sort==='modified') return parseInt(b.dataset.modified||0)-parseInt(a.dataset.modified||0);
            return 0;
        }).forEach(r=>tbody.appendChild(r));
    }

    function clearFilters() {
        searchInput.value=''; sortSelect.value='default'; serviceFilter.value=''; statusFilter.value='';
        applyFilters();
    }

    function confirmDelete(url, name) {
        document.getElementById('deleteStudentName').textContent=name;
        document.getElementById('deleteForm').action=url;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    [searchInput,sortSelect,serviceFilter,statusFilter].forEach(el=>el.addEventListener('input',applyFilters));
    applyFilters();
    setTimeout(()=>lucide.createIcons(),100);
</script>
@endsection

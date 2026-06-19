@extends('admin.layouts.app')
@section('title', 'Student Management')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0" style="color:var(--hope-green,#1B4332);">Student Management</h5>
    @if(Auth::user()->hasPermission('create_student'))
    <a href="{{ route('admin.students.create') }}" class="btn btn-sm" style="background:#1B4332;color:#fff;font-weight:600;border-radius:8px;">
        <i data-lucide="user-plus" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>Add New Student
    </a>
    @endif
</div>

<div class="card mb-3">
    <div class="card-body py-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-3">
                <input type="text" id="searchInput" class="form-control form-control-sm"
                    placeholder="Search by name or guardian...">
            </div>
            <div class="col-md-2">
                <select id="sortSelect" class="form-select form-select-sm">
                    <option value="default">Default (by Status)</option>
                    <option value="az">A–Z Name</option>
                    <option value="za">Z–A Name</option>
                    <option value="created">Date Created</option>
                    <option value="modified">Date Modified</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="serviceFilter" class="form-select form-select-sm">
                    <option value="">All Services</option>
                    @foreach($serviceTypes as $st)
                    <option value="{{ $st->service_type_id }}">
                        {{ $st->service_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select id="statusFilter" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="withdrawn">Withdrawn</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-sm btn-outline-secondary w-100"
                    onclick="clearFilters()" title="Clear Filters">
                    <i data-lucide="x-circle" style="width:13px;height:13px;"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0" id="studentsTable">
            <thead style="background:#1B4332;">
                <tr>
                    <th style="color:#EAB308;">#</th>
                    <th style="color:#EAB308;">Full Name</th>
                    <th style="color:#EAB308;">Guardian</th>
                    <th style="color:#EAB308;">Service Type</th>
                    <th style="color:#EAB308;">Status</th>
                    <th style="color:#EAB308;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $statusGroups = [
                ['key'=>'active', 'label'=>'Active', 'icon'=>'user-check', 'class'=>'table-success',
                'students'=>$students->where('status','active')],
                ['key'=>'inactive', 'label'=>'Inactive', 'icon'=>'user-minus', 'class'=>'table-secondary',
                'students'=>$students->where('status','inactive')],
                ['key'=>'withdrawn', 'label'=>'Withdrawn', 'icon'=>'user-x', 'class'=>'table-warning',
                'students'=>$students->where('status','withdrawn')],
                ['key'=>'completed', 'label'=>'Completed', 'icon'=>'badge-check', 'class'=>'table-primary',
                'students'=>$students->where('status','completed')],
                ];
                @endphp

                @if($students->isEmpty())
                <tr id="noDataRow">
                    <td colspan="6" class="text-center text-muted py-5">
                        <i data-lucide="graduation-cap" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#9ca3af;"></i>
                        No students found.
                    </td>
                </tr>
                @endif

                @foreach($statusGroups as $group)
                @if($group['students']->isNotEmpty())
                <tr class="category-header {{ $group['class'] }}"
                    data-category="{{ $group['key'] }}">
                    <td colspan="6" class="py-2 px-3 fw-semibold small">
                        <i data-lucide="{{ $group['icon'] }}" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>
                        {{ $group['label'] }}
                    </td>
                </tr>
                @foreach($group['students'] as $student)
                @php
                $sc = [
                'active' => 'success',
                'inactive' => 'secondary',
                'withdrawn' => 'warning',
                'completed' => 'primary',
                ];
                $isLocked = in_array($student->student_id, $lockedStudentIds ?? []);
                $guardianName = optional($student->guardian?->user)->full_name ?? '—';
                @endphp
                <tr data-name="{{ strtolower($student->last_name) }}"
                    data-created="{{ $student->created_at?->timestamp ?? 0 }}"
                    data-modified="{{ $student->updated_at?->timestamp ?? 0 }}"
                    data-service="{{ $student->service_type_id }}"
                    data-status="{{ $student->status }}"
                    data-search="{{ strtolower($student->list_name . ' ' . $guardianName) }}">
                    <td>{{ $student->student_id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @include('partials.avatar', [
                            'name' => $student->list_name,
                            'image' => $student->profile_picture,
                            'size' => 32,
                            ])
                            <div>
                                <div>{{ $student->list_name }}</div>
                                @if($isLocked)
                                <small class="text-warning">
                                    <i data-lucide="lock" style="width:11px;height:11px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>
                                    Pending online enrollment
                                </small>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $guardianName }}</td>
                    <td>
                        @if($student->serviceType)
                        <span class="badge bg-info text-dark">
                            {{ $student->serviceType->service_name }}
                        </span>
                        @else
                        <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $sc[$student->status] ?? 'secondary' }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-1">
                            @if(Auth::user()->hasPermission('view_student'))
                            <a href="{{ route('admin.students.show', $student->student_id) }}"
                                class="btn btn-sm btn-outline-info" title="View">
                                <i data-lucide="eye" style="width:14px;height:14px;"></i>
                            </a>
                            @endif

                            @if(Auth::user()->hasPermission('edit_student'))
                            @if($isLocked)
                            <span class="btn btn-sm btn-outline-secondary disabled"
                                title="Cannot edit — digital enrollment pending review">
                                <i data-lucide="lock" style="width:14px;height:14px;"></i>
                            </span>
                            @else
                            <a href="{{ route('admin.students.edit', $student->student_id) }}"
                                class="btn btn-sm btn-outline-primary" title="Edit">
                                <i data-lucide="pencil" style="width:14px;height:14px;"></i>
                            </a>
                            @endif
                            @endif

                            @if(Auth::user()->hasPermission('delete_student'))
                            <button class="btn btn-sm btn-outline-danger" title="Delete"
                                data-name="{{ $student->list_name }}"
                                data-url="{{ route('admin.students.destroy', ['id' => $student->student_id]) }}"
                                onclick="confirmDelete(this.dataset.url, this.dataset.name)">
                                <i data-lucide="trash-2" style="width:14px;height:14px;"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                <tr class="category-spacer">
                    <td colspan="6"
                        style="height:10px;border:none;padding:0;"></td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <div id="noResults" class="text-center text-muted py-4" style="display:none;">
            <i data-lucide="search" style="width:1.5rem;height:1.5rem;display:block;margin:0 auto .5rem;stroke:#9ca3af;"></i>
            No students match your search.
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title text-danger fw-bold">
                    <i data-lucide="trash-2" style="width:15px;height:15px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>Delete Student
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body small text-muted">
                Are you sure you want to delete
                <strong id="deleteStudentName"></strong>?
            </div>
            <div class="modal-footer border-0 pt-0">
                <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        <i data-lucide="trash-2" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var searchInput = document.getElementById('searchInput');
    var sortSelect = document.getElementById('sortSelect');
    var serviceFilter = document.getElementById('serviceFilter');
    var statusFilter = document.getElementById('statusFilter');
    var tbody = document.querySelector('#studentsTable tbody');

    Array.from(tbody.querySelectorAll('tr')).forEach(function(el, i) {
        el.dataset.originalOrder = i;
    });

    function applyFilters() {
        var search = searchInput.value.toLowerCase().trim();
        var sort = sortSelect.value;
        var service = serviceFilter.value;
        var status = statusFilter.value;
        var hasFilter = search !== '' || service !== '' || status !== '' ||
            sort !== 'default';

        var categoryHeaders = Array.from(tbody.querySelectorAll('tr.category-header'));
        var categorySpacers = Array.from(tbody.querySelectorAll('tr.category-spacer'));
        var dataRows = Array.from(tbody.querySelectorAll('tr[data-search]'));
        var noResultsDiv = document.getElementById('noResults');

        if (!hasFilter) {
            Array.from(tbody.querySelectorAll('tr'))
                .sort(function(a, b) {
                    return parseInt(a.dataset.originalOrder || 0) -
                        parseInt(b.dataset.originalOrder || 0);
                })
                .forEach(function(el) {
                    tbody.appendChild(el);
                });
            categoryHeaders.forEach(function(h) {
                h.style.display = '';
            });
            categorySpacers.forEach(function(s) {
                s.style.display = '';
            });
            dataRows.forEach(function(r) {
                r.style.display = '';
            });
            noResultsDiv.style.display = 'none';
            return;
        }

        categoryHeaders.forEach(function(h) {
            h.style.display = 'none';
        });
        categorySpacers.forEach(function(s) {
            s.style.display = 'none';
        });

        dataRows.forEach(function(row) {
            var show = true;
            if (search && !(row.dataset.search || '').includes(search)) {
                show = false;
            }
            if (service && row.dataset.service !== service) {
                show = false;
            }
            if (status && row.dataset.status !== status) {
                show = false;
            }
            row.style.display = show ? '' : 'none';
        });

        var visible = dataRows.filter(function(r) {
            return r.style.display !== 'none';
        });
        noResultsDiv.style.display = (visible.length === 0) ? '' : 'none';

        visible.sort(function(a, b) {
            if (sort === 'az') return (a.dataset.name || '').localeCompare(b.dataset.name || '');
            if (sort === 'za') return (b.dataset.name || '').localeCompare(a.dataset.name || '');
            if (sort === 'created') return parseInt(b.dataset.created || 0) - parseInt(a.dataset.created || 0);
            if (sort === 'modified') return parseInt(b.dataset.modified || 0) - parseInt(a.dataset.modified || 0);
            return 0;
        });
        visible.forEach(function(r) {
            tbody.appendChild(r);
        });
    }

    function clearFilters() {
        searchInput.value = '';
        sortSelect.value = 'default';
        serviceFilter.value = '';
        statusFilter.value = '';
        applyFilters();
    }

    function confirmDelete(url, name) {
        document.getElementById('deleteStudentName').textContent = name;
        document.getElementById('deleteForm').action = url;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    [searchInput, sortSelect, serviceFilter, statusFilter].forEach(function(el) {
        el.addEventListener('input', applyFilters);
    });

    applyFilters();
    setTimeout(function() { lucide.createIcons(); }, 100);
</script>
@endsection

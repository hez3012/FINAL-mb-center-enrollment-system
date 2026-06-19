@extends('admin.layouts.app')
@section('title', 'User Management')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0" style="color:var(--hope-green,#1B4332);">User Management</h5>
    @if(Auth::user()->hasPermission('create_user'))
    <a href="{{ route('admin.users.create') }}" class="btn btn-sm" style="background:#1B4332;color:#fff;font-weight:600;border-radius:8px;">
        <i data-lucide="user-plus" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>
        {{ Auth::user()->role?->role_name === 'staff' ? 'Add Guardian' : 'Add New User' }}
    </a>
    @endif
</div>

<div class="card mb-3">
    <div class="card-body py-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control form-control-sm"
                    placeholder="Search by name, email, username...">
            </div>
            <div class="col-md-2">
                <select id="sortSelect" class="form-select form-select-sm">
                    <option value="default">Default (by Role)</option>
                    <option value="az">A–Z Name</option>
                    <option value="za">Z–A Name</option>
                    <option value="created">Date Created</option>
                    <option value="modified">Date Modified</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="roleFilter" class="form-select form-select-sm">
                    <option value="">All Roles</option>
                    <option value="guardian">Guardian</option>
                    <option value="directress">Directress</option>
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="staff">Staff</option>
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
        <table class="table table-hover mb-0" id="usersTable">
            <thead style="background:#1B4332;">
                <tr>
                    <th style="color:#EAB308;">#</th>
                    <th style="color:#EAB308;">Full Name</th>
                    <th style="color:#EAB308;">Username</th>
                    <th style="color:#EAB308;">Email</th>
                    <th style="color:#EAB308;">Role</th>
                    <th style="color:#EAB308;">Status</th>
                    <th style="color:#EAB308;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $currentRoleName = Auth::user()->role?->role_name;
                $currentUserId = Auth::user()->user_id;

                $categoryGroups = [
                ['key'=>'you', 'label'=>'You', 'icon'=>'user-check', 'class'=>'table-primary',
                'users'=>$users->filter(fn($u)=>$u->user_id===$currentUserId)],
                ['key'=>'guardian', 'label'=>'Guardians', 'icon'=>'heart-handshake', 'class'=>'table-secondary',
                'users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='guardian')],
                ['key'=>'directress', 'label'=>'Directress', 'icon'=>'award', 'class'=>'table-danger',
                'users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='directress')],
                ['key'=>'admin', 'label'=>'Admins', 'icon'=>'user-cog', 'class'=>'table-primary',
                'users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='admin')],
                ['key'=>'teacher', 'label'=>'Teachers', 'icon'=>'graduation-cap', 'class'=>'table-success',
                'users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='teacher')],
                ['key'=>'staff', 'label'=>'Staff', 'icon'=>'badge', 'class'=>'table-info',
                'users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='staff')],
                ];
                @endphp

                @if($users->isEmpty())
                <tr id="noDataRow">
                    <td colspan="7" class="text-center text-muted py-5">
                        <i data-lucide="users" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#9ca3af;"></i>
                        No users found.
                    </td>
                </tr>
                @endif

                @foreach($categoryGroups as $group)
                @if($group['users']->isNotEmpty())
                <tr class="category-header {{ $group['class'] }}"
                    data-category="{{ $group['key'] }}">
                    <td colspan="7" class="py-2 px-3 fw-semibold small">
                        <i data-lucide="{{ $group['icon'] }}" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>{{ $group['label'] }}
                    </td>
                </tr>
                @foreach($group['users'] as $user)
                @php
                $isMe = $currentUserId === $user->user_id;
                $targetRoleName = $user->role?->role_name;

                $canEdit = !$isMe && Auth::user()->hasPermission('edit_user')
                && match($currentRoleName) {
                'directress' => true,
                'admin' => $targetRoleName !== 'directress',
                'teacher' => in_array($targetRoleName,['staff','guardian']),
                default => false,
                };

                $canToggle = !$isMe && Auth::user()->hasPermission('edit_user')
                && match($currentRoleName) {
                'directress' => true,
                'admin' => $targetRoleName !== 'directress',
                'teacher' => in_array($targetRoleName,['staff','guardian']),
                default => false,
                };

                $canDelete = !$isMe && Auth::user()->hasPermission('delete_user')
                && match($currentRoleName) {
                'directress' => true,
                'admin' => $targetRoleName !== 'directress',
                default => false,
                };
                @endphp
                <tr data-name="{{ strtolower($user->last_name) }}"
                    data-created="{{ $user->created_at?->timestamp ?? 0 }}"
                    data-modified="{{ $user->updated_at?->timestamp ?? 0 }}"
                    data-role="{{ $targetRoleName }}"
                    data-status="{{ $user->is_active ? 'active' : 'inactive' }}"
                    data-search="{{ strtolower($user->list_name.' '.$user->email.' '.$user->username) }}">
                    <td>{{ $user->user_id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @include('partials.avatar',['name'=>$user->list_name,'image'=>$user->profile_picture,'size'=>32])
                            <div>
                                {{ $user->list_name }}
                                @if($isMe)
                                <span class="badge bg-primary ms-1">You</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @php $roleColors=['directress'=>'danger','admin'=>'primary','teacher'=>'success','staff'=>'info','guardian'=>'secondary']; @endphp
                        <span class="badge bg-{{ $roleColors[$targetRoleName] ?? 'secondary' }}">
                            {{ ucfirst($targetRoleName) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $user->is_active ? 'success' : 'secondary' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            @if(Auth::user()->hasPermission('view_user'))
                            <a href="{{ route('admin.users.show',$user->user_id) }}"
                                class="btn btn-sm btn-outline-info" title="View">
                                <i data-lucide="eye" style="width:14px;height:14px;"></i>
                            </a>
                            @endif
                            @if($canEdit)
                            <a href="{{ route('admin.users.edit',$user->user_id) }}"
                                class="btn btn-sm btn-outline-primary" title="Edit">
                                <i data-lucide="pencil" style="width:14px;height:14px;"></i>
                            </a>
                            @endif
                            @if($canToggle)
                            <form method="POST"
                                action="{{ route('admin.users.toggle',$user->user_id) }}"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="btn btn-sm btn-outline-{{ $user->is_active ? 'warning':'success' }}"
                                    title="{{ $user->is_active ? 'Deactivate':'Activate' }}">
                                    <i data-lucide="{{ $user->is_active ? 'user-x':'user-check' }}" style="width:14px;height:14px;"></i>
                                </button>
                            </form>
                            @endif
                            @if($canDelete)
                            <button class="btn btn-sm btn-outline-danger" title="Delete"
                                data-id="{{ $user->user_id }}"
                                data-name="{{ $user->list_name }}"
                                onclick="confirmDelete(this.dataset.id,this.dataset.name)">
                                <i data-lucide="trash-2" style="width:14px;height:14px;"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                <tr class="category-spacer">
                    <td colspan="7" style="height:10px;border:none;padding:0;"></td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <div id="noResults" class="text-center text-muted py-4" style="display:none;">
            <i data-lucide="search" style="width:1.5rem;height:1.5rem;display:block;margin:0 auto .5rem;stroke:#9ca3af;"></i>
            No users match your search.
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title text-danger fw-bold">
                    <i data-lucide="trash-2" style="width:15px;height:15px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>Delete User
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body small text-muted">
                Are you sure you want to delete <strong id="deleteUserName"></strong>?
            </div>
            <div class="modal-footer border-0 pt-0">
                <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
    var roleFilter = document.getElementById('roleFilter');
    var statusFilter = document.getElementById('statusFilter');
    var tbody = document.querySelector('#usersTable tbody');

    Array.from(tbody.querySelectorAll('tr')).forEach(function(el, i) {
        el.dataset.originalOrder = i;
    });

    function applyFilters() {
        var search = searchInput.value.toLowerCase().trim();
        var sort = sortSelect.value;
        var role = roleFilter.value;
        var status = statusFilter.value;
        var hasFilter = search !== '' || role !== '' || status !== '' || sort !== 'default';

        var categoryHeaders = Array.from(tbody.querySelectorAll('tr.category-header'));
        var categorySpacers = Array.from(tbody.querySelectorAll('tr.category-spacer'));
        var dataRows = Array.from(tbody.querySelectorAll('tr[data-search]'));
        var noResultsDiv = document.getElementById('noResults');

        if (!hasFilter) {
            Array.from(tbody.querySelectorAll('tr'))
                .sort(function(a, b) {
                    return parseInt(a.dataset.originalOrder || 0) - parseInt(b.dataset.originalOrder || 0);
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
            if (role && row.dataset.role !== role) {
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
            if (sort === 'created') return (b.dataset.created || 0) - (a.dataset.created || 0);
            if (sort === 'modified') return (b.dataset.modified || 0) - (a.dataset.modified || 0);
            return 0;
        });
        visible.forEach(function(r) {
            tbody.appendChild(r);
        });
    }

    function clearFilters() {
        searchInput.value = '';
        sortSelect.value = 'default';
        roleFilter.value = '';
        statusFilter.value = '';
        applyFilters();
    }

    function confirmDelete(id, name) {
        document.getElementById('deleteUserName').textContent = name;
        document.getElementById('deleteForm').action = '/admin/users/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    [searchInput, sortSelect, roleFilter, statusFilter].forEach(function(el) {
        el.addEventListener('input', applyFilters);
    });

    applyFilters();

    // Re-init Lucide after dynamic re-renders
    setTimeout(function() { lucide.createIcons(); }, 100);
</script>
@endsection

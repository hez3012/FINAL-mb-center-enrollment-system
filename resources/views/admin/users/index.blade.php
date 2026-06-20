@extends('admin.layouts.app')
@section('title', 'User Management')
@section('content')

<div class="page-heading">
    <h5>User Management</h5>
    @if(Auth::user()->hasPermission('create_user'))
    <a href="{{ route('admin.users.create') }}" class="btn-primary-app">
        <i data-lucide="user-plus"></i>
        {{ Auth::user()->role?->role_name === 'staff' ? 'Add Guardian' : 'Add New User' }}
    </a>
    @endif
</div>

{{-- Filters --}}
<div class="filter-bar">
    <div class="row g-2 align-items-center">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text" style="background:#f8fafc;border-color:#E5E9F2;border-right:none;padding:.42rem .65rem;">
                    <i data-lucide="search" style="width:14px;height:14px;stroke:#94A3B8;"></i>
                </span>
                <input type="text" id="searchInput" class="form-control"
                    placeholder="Search by name, email, username…">
            </div>
        </div>
        <div class="col-md-2">
            <select id="sortSelect" class="form-select">
                <option value="default">Sort: Default (by Role)</option>
                <option value="az">A–Z Name</option>
                <option value="za">Z–A Name</option>
                <option value="created">Date Created</option>
                <option value="modified">Date Modified</option>
            </select>
        </div>
        <div class="col-md-2">
            <select id="roleFilter" class="form-select">
                <option value="">All Roles</option>
                <option value="guardian">Guardian</option>
                <option value="directress">Directress</option>
                <option value="admin">Admin</option>
                <option value="teacher">Teacher</option>
                <option value="staff">Staff</option>
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
                <i data-lucide="x" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.25rem;"></i>Clear Filters
            </button>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="table-scroll-wrap">
        <table class="table table-hover" id="usersTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $currentRoleName = Auth::user()->role?->role_name;
                $currentUserId   = Auth::user()->user_id;

                $roleColors = ['directress'=>'danger','admin'=>'primary','teacher'=>'success','staff'=>'info','guardian'=>'secondary'];

                $categoryGroups = [
                    ['key'=>'you',        'label'=>'You',        'icon'=>'user-check',    'bg'=>'#EFF6FF','users'=>$users->filter(fn($u)=>$u->user_id===$currentUserId)],
                    ['key'=>'guardian',   'label'=>'Guardians',  'icon'=>'heart-handshake','bg'=>'#F8FAFC','users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='guardian')],
                    ['key'=>'directress', 'label'=>'Directress', 'icon'=>'award',          'bg'=>'#FFF1F2','users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='directress')],
                    ['key'=>'admin',      'label'=>'Admins',     'icon'=>'user-cog',       'bg'=>'#EFF6FF','users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='admin')],
                    ['key'=>'teacher',    'label'=>'Teachers',   'icon'=>'graduation-cap', 'bg'=>'#F0FDF4','users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='teacher')],
                    ['key'=>'staff',      'label'=>'Staff',      'icon'=>'badge',          'bg'=>'#F0F9FF','users'=>$users->filter(fn($u)=>$u->user_id!==$currentUserId && $u->role?->role_name==='staff')],
                ];
                @endphp

                @if($users->isEmpty())
                <tr id="noDataRow">
                    <td colspan="7" class="text-center py-5" style="color:#94A3B8;">
                        <i data-lucide="users" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
                        No users found.
                    </td>
                </tr>
                @endif

                @foreach($categoryGroups as $group)
                @if($group['users']->isNotEmpty())
                <tr class="category-header" data-category="{{ $group['key'] }}"
                    style="background:{{ $group['bg'] }};">
                    <td colspan="7" style="padding:.55rem 1rem;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748B;border-bottom:1px solid #E2E8F0;">
                        <i data-lucide="{{ $group['icon'] }}" style="width:13px;height:13px;display:inline;vertical-align:middle;margin-right:.4rem;stroke:#1B4332;"></i>{{ $group['label'] }}
                    </td>
                </tr>
                @foreach($group['users'] as $user)
                @php
                $isMe = $currentUserId === $user->user_id;
                $targetRoleName = $user->role?->role_name;
                $canEdit   = !$isMe && Auth::user()->hasPermission('edit_user')   && match($currentRoleName){'directress'=>true,'admin'=>$targetRoleName!=='directress','teacher'=>in_array($targetRoleName,['staff','guardian']),default=>false};
                $canToggle = !$isMe && Auth::user()->hasPermission('edit_user')   && match($currentRoleName){'directress'=>true,'admin'=>$targetRoleName!=='directress','teacher'=>in_array($targetRoleName,['staff','guardian']),default=>false};
                $canDelete = !$isMe && Auth::user()->hasPermission('delete_user') && match($currentRoleName){'directress'=>true,'admin'=>$targetRoleName!=='directress',default=>false};
                @endphp
                <tr data-name="{{ strtolower($user->last_name) }}"
                    data-created="{{ $user->created_at?->timestamp ?? 0 }}"
                    data-modified="{{ $user->updated_at?->timestamp ?? 0 }}"
                    data-role="{{ $targetRoleName }}"
                    data-status="{{ $user->is_active ? 'active' : 'inactive' }}"
                    data-search="{{ strtolower($user->list_name.' '.$user->email.' '.$user->username) }}">
                    <td style="color:#94A3B8;font-size:12px;">{{ $user->user_id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @include('partials.avatar',['name'=>$user->list_name,'image'=>$user->profile_picture,'size'=>32])
                            <div>
                                <div class="fw-semibold" style="font-size:13.5px;">{{ $user->list_name }}</div>
                                @if($isMe)<span class="badge bg-primary" style="font-size:10px;">You</span>@endif
                            </div>
                        </div>
                    </td>
                    <td style="color:#374151;">{{ $user->username }}</td>
                    <td style="color:#374151;">{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-{{ $roleColors[$targetRoleName] ?? 'secondary' }}">
                            {{ ucfirst($targetRoleName) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge" style="background:{{ $user->is_active ? '#DCFCE7' : '#F1F5F9' }};color:{{ $user->is_active ? '#166534' : '#64748B' }};">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            @if(Auth::user()->hasPermission('view_user'))
                            <a href="{{ route('admin.users.show',$user->user_id) }}" class="btn-act btn-act-view">
                                <i data-lucide="eye"></i>View
                            </a>
                            @endif
                            @if($canEdit)
                            <a href="{{ route('admin.users.edit',$user->user_id) }}" class="btn-act btn-act-edit">
                                <i data-lucide="pencil"></i>Edit
                            </a>
                            @endif
                            @if($canToggle)
                            <form method="POST" action="{{ route('admin.users.toggle',$user->user_id) }}" style="display:contents;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-act {{ $user->is_active ? 'btn-act-warn' : 'btn-act-ok' }}">
                                    <i data-lucide="{{ $user->is_active ? 'user-x' : 'user-check' }}"></i>
                                    {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            @endif
                            @if($canDelete)
                            <button type="button" class="btn-act btn-act-del"
                                data-id="{{ $user->user_id }}" data-name="{{ $user->list_name }}"
                                onclick="confirmDelete(this.dataset.id,this.dataset.name)">
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
        No users match your filters.
    </div>
</div>

{{-- Delete modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold" style="color:#DC2626;">
                    <i data-lucide="trash-2" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>Delete User
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="font-size:13.5px;color:#64748B;">
                Delete <strong id="deleteUserName"></strong>? This cannot be undone.
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
    var roleFilter   = document.getElementById('roleFilter');
    var statusFilter = document.getElementById('statusFilter');
    var tbody = document.querySelector('#usersTable tbody');

    Array.from(tbody.querySelectorAll('tr')).forEach(function(el,i){ el.dataset.originalOrder = i; });

    function applyFilters() {
        var search = searchInput.value.toLowerCase().trim();
        var sort   = sortSelect.value;
        var role   = roleFilter.value;
        var status = statusFilter.value;
        var hasFilter = search||role||status||sort!=='default';

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
            var show = true;
            if (search && !(row.dataset.search||'').includes(search)) show=false;
            if (role   && row.dataset.role!==role)    show=false;
            if (status && row.dataset.status!==status) show=false;
            row.style.display = show ? '' : 'none';
        });

        var visible = dataRows.filter(r=>r.style.display!=='none');
        noRes.style.display = visible.length===0 ? '' : 'none';

        visible.sort(function(a,b){
            if (sort==='az') return (a.dataset.name||'').localeCompare(b.dataset.name||'');
            if (sort==='za') return (b.dataset.name||'').localeCompare(a.dataset.name||'');
            if (sort==='created')  return (b.dataset.created||0)-(a.dataset.created||0);
            if (sort==='modified') return (b.dataset.modified||0)-(a.dataset.modified||0);
            return 0;
        }).forEach(r=>tbody.appendChild(r));
    }

    function clearFilters() {
        searchInput.value=''; sortSelect.value='default'; roleFilter.value=''; statusFilter.value='';
        applyFilters();
    }

    function confirmDelete(id, name) {
        document.getElementById('deleteUserName').textContent = name;
        document.getElementById('deleteForm').action = '/admin/users/'+id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    [searchInput,sortSelect,roleFilter,statusFilter].forEach(el=>el.addEventListener('input',applyFilters));
    applyFilters();
    setTimeout(()=>lucide.createIcons(), 100);
</script>
@endsection

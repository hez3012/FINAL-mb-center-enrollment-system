@extends('admin.layouts.app')
@section('title', 'Add New User')
@section('content')

@php
function fmtPerm(string $n): string {
$s = ['walkin' => 'Walk-In', 'ped' => 'Ped.'];
return implode(' ', array_map(fn($w) => $s[$w] ?? ucfirst($w), explode('_', $n)));
}
@endphp

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0">Add New User</h5>
    @if(($preselectedRole ?? '') === 'guardian')
    <a href="{{ route('admin.guardians.index') }}" class="btn-act btn-act-view" style="text-decoration:none;"><i data-lucide="arrow-left" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Back
    </a>
    @else
    <a href="{{ route('admin.users.index') }}" class="btn-act btn-act-view" style="text-decoration:none;"><i data-lucide="arrow-left" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Back
    </a>
    @endif
</div>

<div class="card border-0 shadow" style="border-radius: 14px; background: #fff;">
    <div class="card-body p-4 p-lg-5">
        <form method="POST" action="{{ route('admin.users.store') }}"
            enctype="multipart/form-data">
            @csrf

            {{-- Role --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Role <span class="text-danger">*</span>
                </label>
                @if(($preselectedRole ?? '') === 'guardian')
                @php $guardianRole = $allowedRoles->firstWhere('role_name','guardian'); @endphp
                <input type="hidden" name="role_id"
                    value="{{ $guardianRole?->role_id }}">
                <input type="text" class="form-control bg-light" readonly value="Guardian">
                <small class="text-muted">
                    <i data-lucide="lock" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Role is locked to Guardian.
                </small>
                @else
                <select name="role_id" id="roleSelect"
                    class="form-select @error('role_id') is-invalid @enderror" required>
                    <option value="">-- Select Role --</option>
                    @foreach($allowedRoles as $role)
                    <option value="{{ $role->role_id }}"
                        data-role="{{ $role->role_name }}"
                        {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                        {{ ucfirst($role->role_name) }}
                    </option>
                    @endforeach
                </select>
                @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                @endif
            </div>

            {{-- Profile Picture --}}
            <div class="border rounded-4 p-4 mb-4" style="background: #f9f7f3; border-color: #e8e3d8;">
                <p class="fw-semibold small mb-3" style="color:#1B4332;">
                    <i data-lucide="user-circle" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Profile Picture
                </p>
                <div class="row g-3 align-items-center">
                    <div class="col-md-4 text-center text-md-start">
                        <div id="avatarWrapper" class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle border border-2 shadow-sm" style="background: white; width: 96px; height: 96px;">
                            @include('partials.avatar',['name'=>'?','image'=>null,'size'=>72])
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-2 mb-2">
                            <label for="profilePicInput" class="btn btn-sm mb-0 px-3" style="border:1px solid #1B4332;color:#1B4332;background:#fff;">
                                <i data-lucide="image" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Choose Picture
                            </label>
                            <button type="button" class="btn btn-sm mb-0 px-3" style="border:1px solid #1B4332;color:#1B4332;background:#fff;"
                                onclick="openCameraCapture('profilePicInput')">
                                <i data-lucide="camera" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Take Photo
                            </button>
                            <button type="button" id="removePicBtn" class="btn btn-sm btn-outline-danger mb-0 px-3 d-none">
                                <i data-lucide="trash-2" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Remove Photo
                            </button>
                            <input type="file" name="profile_picture" id="profilePicInput"
                                class="d-none @error('profile_picture') is-invalid @enderror"
                                accept=".jpg,.jpeg,.png">
                            <span id="picFileName" class="text-muted small fw-semibold">No file chosen</span>
                        </div>
                        <div class="small text-muted">
                            JPG or PNG only · Max 50MB · Optional
                        </div>
                        @error('profile_picture')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Personal Information --}}
            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: #fff; border-color: #e8e3d8;">
                <p class="fw-semibold small mb-3 d-flex align-items-center gap-2" style="color:#1B4332;">
                    <i data-lucide="user" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Personal Information
                </p>
                <div class="row g-3 mb-0">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            First Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="first_name"
                            class="form-control @error('first_name') is-invalid @enderror"
                            value="{{ old('first_name') }}" required minlength="2">
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Middle Name <span class="text-muted small fw-normal">(optional)</span>
                        </label>
                        <input type="text" name="middle_name" id="middleNameInput"
                            class="form-control @error('middle_name') is-invalid @enderror"
                            value="{{ old('middle_name') }}">
                        @error('middle_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Last Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="last_name"
                            class="form-control @error('last_name') is-invalid @enderror"
                            value="{{ old('last_name') }}" required minlength="2">
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">M.I.</label>
                        <input type="text" id="miDisplay" class="form-control bg-light"
                            readonly placeholder="Auto">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            Sex <span class="text-danger">*</span>
                        </label>
                        <select name="sex" id="sexSelect"
                            class="form-select @error('sex') is-invalid @enderror" required>
                            <option value="">-- Select --</option>
                            @foreach(['male'=>'Male','female'=>'Female','prefer_not_to_say'=>'Prefer not to say','others'=>'Others'] as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('sex') === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('sex')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3" id="sexSpecifyWrapper" style="display:none;">
                        <label class="form-label fw-semibold">Please specify</label>
                        <input type="text" name="sex_specify"
                            class="form-control @error('sex_specify') is-invalid @enderror"
                            value="{{ old('sex_specify') }}">
                        @error('sex_specify')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Birthdate <span class="text-muted small fw-normal">(optional)</span>
                        </label>
                        <input type="date" name="birthdate" id="birthdateInput"
                            class="form-control @error('birthdate') is-invalid @enderror"
                            value="{{ old('birthdate') }}">
                        @error('birthdate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Age</label>
                        <input type="text" id="ageDisplay" class="form-control bg-light"
                            readonly placeholder="Auto">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Contact #1 <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="contact_number_1"
                            class="form-control @error('contact_number_1') is-invalid @enderror"
                            value="{{ old('contact_number_1') }}"
                            maxlength="11" required>
                        @error('contact_number_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @else
                        <small class="text-muted">Format: 09XXXXXXXXX (11 digits)</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Contact #2 <span class="text-muted small fw-normal">(optional)</span>
                        </label>
                        <input type="text" name="contact_number_2"
                            class="form-control @error('contact_number_2') is-invalid @enderror"
                            value="{{ old('contact_number_2') }}"
                            maxlength="11">
                        @error('contact_number_2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @else
                        <small class="text-muted">Format: 09XXXXXXXXX (11 digits)</small>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Address --}}
            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: #fff; border-color: #e8e3d8;">
                <p class="fw-semibold small mb-3 d-flex align-items-center gap-2" style="color:#1B4332;">
                    <i data-lucide="map-pin" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Address
                </p>
                <div class="mb-0">
                    @include('partials.address-fields',[
                    'fieldPrefix' => '',
                    'data' => [
                    'region' => old('region',''),
                    'province' => old('province',''),
                    'city' => old('city',''),
                    'barangay' => old('barangay',''),
                    'house_unit_no' => old('house_unit_no',''),
                    'street' => old('street',''),
                    'zip_code' => old('zip_code',''),
                    ],
                    ])
                </div>
            </div>

            {{-- Account Credentials --}}
            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: #fff; border-color: #e8e3d8;">
                <p class="fw-semibold small mb-3 d-flex align-items-center gap-2" style="color:#1B4332;">
                    <i data-lucide="shield" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Account Credentials
                </p>
                <div class="row g-3 mb-0">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Username <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}" required minlength="4">
                        @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password" name="password" id="userPassword"
                                class="form-control @error('password') is-invalid @enderror"
                                required minlength="6" style="border-right:none;">
                            <button type="button" class="input-group-text" id="toggleUserPw" tabindex="-1"
                                style="background:#f9f7f3;border-color:#d6d0c4;border-left:none;color:#6b7280;cursor:pointer;border-radius:0 8px 8px 0;">
                                <i data-lucide="eye" id="eyeUserPw" style="width:15px;height:15px;"></i>
                            </button>
                        </div>
                        @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        <div style="height:4px;border-radius:2px;background:#e5e7eb;margin-top:.35rem;overflow:hidden;"><div id="pwStrengthFill" style="height:100%;width:0%;border-radius:2px;transition:width .25s,background .25s;"></div></div>
                        <div id="pwStrengthLabel" style="font-size:.72rem;margin-top:.2rem;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="userPasswordConfirm"
                                class="form-control" required style="border-right:none;">
                            <button type="button" class="input-group-text" id="toggleUserPwConfirm" tabindex="-1"
                                style="background:#f9f7f3;border-color:#d6d0c4;border-left:none;color:#6b7280;cursor:pointer;border-radius:0 8px 8px 0;">
                                <i data-lucide="eye" id="eyeUserPwConfirm" style="width:15px;height:15px;"></i>
                            </button>
                        </div>
                        <div id="pwMatchMsg" style="font-size:.72rem;margin-top:.2rem;"></div>
                    </div>
                </div>
            </div>

            {{-- Guardian-only fields --}}
            <div id="guardianFields"
                class="border rounded-4 p-3 p-md-4 mb-4 {{ ($preselectedRole ?? '') === 'guardian' ? '' : 'd-none' }}"
                style="background: rgba(255,255,255,0.8); border-color: #e8e3d8;">
                <p class="fw-semibold small mb-3 d-flex align-items-center gap-2" style="color:#1B4332;">
                    <i data-lucide="heart-handshake" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Guardian Profile Information
                </p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Relationship to Student <span class="text-danger">*</span>
                        </label>
                        <select name="relationship"
                            class="form-select @error('relationship') is-invalid @enderror">
                            <option value="">-- Select --</option>
                            @foreach(['Mother','Father','Grandparent','Aunt/Uncle','Sibling','Legal Guardian','Other'] as $rel)
                            <option value="{{ $rel }}"
                                {{ old('relationship') === $rel ? 'selected' : '' }}>
                                {{ $rel }}
                            </option>
                            @endforeach
                        </select>
                        @error('relationship')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Facebook Account Link
                            <span class="text-muted small fw-normal">(optional)</span>
                        </label>
                        <input type="url" name="facebook_link"
                            class="form-control @error('facebook_link') is-invalid @enderror"
                            value="{{ old('facebook_link') }}"
                            placeholder="https://facebook.com/yourprofile">
                        <small class="text-muted">So facilitators can reach the guardian via Messenger.</small>
                        @error('facebook_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Permissions --}}
            <div id="permissionsSection" class="mb-4 d-none">
                <label class="form-label fw-semibold">
                    Permissions
                    <span class="text-muted small fw-normal ms-1">
                        (auto-loaded from role, customizable)
                    </span>
                </label>
                @foreach($permissions->groupBy('category') as $category => $catPerms)
                <div class="border rounded p-3 mb-2 bg-light">
                    <p class="fw-semibold text-primary mb-2 small">
                        <i data-lucide="folder" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>{{ $category }}
                    </p>
                    <div class="row g-2">
                        @foreach($catPerms as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input permission-check"
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission->permission_id }}"
                                    id="perm_{{ $permission->permission_id }}"
                                    {{ in_array($permission->permission_id, old('permissions',[])) ? 'checked' : '' }}>
                                <label class="form-check-label small"
                                    for="perm_{{ $permission->permission_id }}">
                                    {{ fmtPerm($permission->permission_name) }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn-primary-app">
                    <i data-lucide="user-plus"></i>Create User
                </button>
            </div>
        </form>
    </div>
</div>

<div id="createUserMeta"
    data-role-permissions='@json($rolePermissions)'
    data-audit-log-id="{{ $viewAuditLogId }}"
    data-preselected="{{ $preselectedRole ?? '' }}"
    style="display:none;"></div>

{{-- Fullscreen Modal --}}
<div class="modal fade" id="fullscreenModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 p-1 justify-content-end">
                <button type="button" class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <img id="fullscreenImg" src="" alt=""
                    class="img-fluid rounded" style="max-height:80vh;">
            </div>
        </div>
    </div>
</div>

<script>
    var meta = document.getElementById('createUserMeta');
    var rolePermissions = JSON.parse(meta.dataset.rolePermissions);
    var viewAuditLogId = parseInt(meta.dataset.auditLogId);
    var preselectedRole = meta.dataset.preselected;
    var roleSelect = document.getElementById('roleSelect');
    var guardianFields = document.getElementById('guardianFields');
    var permissionsSection = document.getElementById('permissionsSection');

    function handleRoleChange() {
        if (preselectedRole === 'guardian') {
            guardianFields.classList.remove('d-none');
            permissionsSection.classList.add('d-none');
            return;
        }

        var opt = roleSelect ? roleSelect.options[roleSelect.selectedIndex] : null;
        var roleName = opt ? opt.getAttribute('data-role') : '';
        var roleId = roleSelect ? parseInt(roleSelect.value) : 0;

        if (!roleName) {
            guardianFields.classList.add('d-none');
            permissionsSection.classList.add('d-none');
            return;
        }

        if (roleName === 'guardian') {
            guardianFields.classList.remove('d-none');
            permissionsSection.classList.add('d-none');
        } else {
            guardianFields.classList.add('d-none');
            permissionsSection.classList.remove('d-none');
            var defaultPerms = rolePermissions[roleId] || [];
            document.querySelectorAll('.permission-check').forEach(function(cb) {
                var permId = parseInt(cb.value);
                cb.checked = (permId === viewAuditLogId) ? true : defaultPerms.includes(permId);
            });
        }
    }

    if (roleSelect) {
        roleSelect.addEventListener('change', handleRoleChange);
    }
    handleRoleChange();

    document.getElementById('middleNameInput').addEventListener('input', function() {
        var mi = this.value.trim();
        document.getElementById('miDisplay').value = mi ? mi[0].toUpperCase() + '.' : '';
    });

    document.getElementById('birthdateInput').addEventListener('change', function() {
        if (!this.value) {
            document.getElementById('ageDisplay').value = '';
            return;
        }
        var birth = new Date(this.value);
        var today = new Date();
        var age = today.getFullYear() - birth.getFullYear();
        if (today.getMonth() < birth.getMonth() ||
            (today.getMonth() === birth.getMonth() && today.getDate() < birth.getDate())) {
            age--;
        }
        document.getElementById('ageDisplay').value = age + ' years old';
    });

    document.getElementById('sexSelect').addEventListener('change', function() {
        document.getElementById('sexSpecifyWrapper').style.display =
            this.value === 'others' ? '' : 'none';
    });

    // Profile picture preview
    document.getElementById('profilePicInput').addEventListener('change', function() {
        var file = this.files[0];
        if (!file) return;
        document.getElementById('picFileName').textContent = file.name;
        document.getElementById('removePicBtn').classList.remove('d-none');
        var reader = new FileReader();
        reader.onload = function(e) {
            var w = document.getElementById('avatarWrapper');
            w.innerHTML = '<img src="' + e.target.result + '" style="width:48px;height:48px;border-radius:50%;object-fit:cover;cursor:pointer;flex-shrink:0;">';
            w.querySelector('img').addEventListener('click', openFullscreen);
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('removePicBtn').addEventListener('click', function() {
        var input = document.getElementById('profilePicInput');
        input.value = '';
        document.getElementById('picFileName').textContent = 'No file chosen';
        document.getElementById('avatarWrapper').innerHTML = `@include('partials.avatar',['name'=>'?','image'=>null,'size'=>72])`;
        this.classList.add('d-none');
    });

    function openFullscreen(e) {
        document.getElementById('fullscreenImg').src = e.target.src;
        new bootstrap.Modal(document.getElementById('fullscreenModal')).show();
    }

    // Eye toggles
    function makeEyeToggle(btnId, inputId, iconId) {
        var btn = document.getElementById(btnId);
        if (!btn) return;
        btn.addEventListener('click', function() {
            var inp = document.getElementById(inputId);
            var isText = inp.type === 'text';
            inp.type = isText ? 'password' : 'text';
            document.getElementById(iconId).setAttribute('data-lucide', isText ? 'eye' : 'eye-off');
            lucide.createIcons();
        });
    }
    makeEyeToggle('toggleUserPw', 'userPassword', 'eyeUserPw');
    makeEyeToggle('toggleUserPwConfirm', 'userPasswordConfirm', 'eyeUserPwConfirm');

    // Password strength
    document.getElementById('userPassword').addEventListener('input', function() {
        var val = this.value;
        var score = 0;
        if (val.length >= 6) score++;
        if (val.length >= 10) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        var fill  = document.getElementById('pwStrengthFill');
        var label = document.getElementById('pwStrengthLabel');
        var colors = ['','#ef4444','#f97316','#EAB308','#22c55e','#16a34a'];
        var labels = ['','Very weak','Weak','Fair','Strong','Very strong'];
        fill.style.width      = val.length === 0 ? '0%' : (score * 20) + '%';
        fill.style.background = colors[score] || '';
        label.textContent     = val.length === 0 ? '' : (labels[score] || '');
        label.style.color     = colors[score] || '';
        checkUserPwMatch();
    });

    function checkUserPwMatch() {
        var pw   = document.getElementById('userPassword').value;
        var conf = document.getElementById('userPasswordConfirm').value;
        var msg  = document.getElementById('pwMatchMsg');
        if (!conf) { msg.textContent = ''; return; }
        if (pw === conf) { msg.textContent = '✓ Passwords match';       msg.style.color = '#16a34a'; }
        else             { msg.textContent = '✗ Passwords do not match'; msg.style.color = '#dc2626'; }
    }
    document.getElementById('userPasswordConfirm').addEventListener('input', checkUserPwMatch);
</script>

@include('partials.camera-capture')
@endsection





@extends('portal.layouts.app')
@section('title', 'Profile Settings')
@section('content')

@php
$me = auth()->user();
$meName = trim($me->first_name . ' ' . $me->last_name);
$meMI = $me->middle_initial;
$meBD = $me->birthdate;
$meAge = $me->age !== null ? $me->age . ' years old' : '';
@endphp

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0">Profile Settings</h5>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('portal.profile.update') }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Profile Picture --}}
            <div class="border rounded-4 p-4 mb-4" style="background: #f9f7f3; border-color: #e8e3d8;">
                <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                    <div class="flex-shrink-0">
                        <div id="avatarWrapper" class="d-inline-flex align-items-center justify-content-center rounded-circle border border-2 shadow-sm" style="background: white; width: 96px; height: 96px; cursor: pointer;">
                            @include('partials.avatar',[
                            'name' => $meName ?: '?',
                            'image' => $me->profile_picture,
                            'size' => 72,
                            ])
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <p class="fw-semibold small mb-2 d-flex align-items-center gap-2" style="color:#1B4332;">
                            <i data-lucide="user-circle" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Profile Picture
                        </p>
                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-2 mb-2">
                            <label for="profilePicInput"
                                class="btn btn-sm mb-0 px-3" style="border:1px solid #1B4332;color:#1B4332;background:#fff;">
                                <i data-lucide="image" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Choose Picture
                            </label>
                            <button type="button" class="btn btn-sm mb-0 px-3" style="border:1px solid #1B4332;color:#1B4332;background:#fff;"
                                onclick="openCameraCapture('profilePicInput')">
                                <i data-lucide="camera" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Take Photo
                            </button>
                            <button type="button" id="removePicBtn"
                                class="btn btn-sm btn-outline-danger mb-0 px-3 {{ $me->profile_picture ? '' : 'd-none' }}">
                                <i data-lucide="trash-2" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Remove Photo
                            </button>
                            <input type="hidden" name="remove_profile_picture" id="removeProfilePictureFlag" value="0">
                            <input type="file" name="profile_picture" id="profilePicInput"
                                class="d-none @error('profile_picture') is-invalid @enderror"
                                accept=".jpg,.jpeg,.png">
                            <span id="picFileName" class="text-muted small fw-semibold">
                                {{ $me->profile_picture ? 'Current photo on file' : 'No file chosen' }}
                            </span>
                        </div>
                        <div class="small text-muted">
                            JPG or PNG only · Max 50MB · Leave blank to keep current
                        </div>
                        @error('profile_picture')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Personal Information --}}
            <p class="fw-semibold small mb-2" style="color:#1B4332;">
                <i data-lucide="user" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Personal Information
            </p>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        First Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="first_name"
                        class="form-control @error('first_name') is-invalid @enderror"
                        value="{{ old('first_name',$me->first_name) }}"
                        required minlength="2">
                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Middle Name <span class="text-muted small fw-normal">(optional)</span>
                    </label>
                    <input type="text" name="middle_name" id="middleNameInput"
                        class="form-control @error('middle_name') is-invalid @enderror"
                        value="{{ old('middle_name',$me->middle_name) }}">
                    @error('middle_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Last Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="last_name"
                        class="form-control @error('last_name') is-invalid @enderror"
                        value="{{ old('last_name',$me->last_name) }}"
                        required minlength="2">
                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">M.I.</label>
                    <input type="text" id="miDisplay" class="form-control bg-light"
                        readonly value="{{ $meMI }}">
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
                            {{ old('sex',$me->sex) === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                    @error('sex')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 {{ old('sex',$me->sex) === 'others' ? '' : 'd-none' }}"
                    id="sexSpecifyWrapper">
                    <label class="form-label fw-semibold">Please specify</label>
                    <input type="text" name="sex_specify"
                        class="form-control @error('sex_specify') is-invalid @enderror"
                        value="{{ old('sex_specify',$me->sex_specify) }}">
                    @error('sex_specify')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Birthdate <span class="text-muted small fw-normal">(optional)</span>
                    </label>
                    <input type="date" name="birthdate" id="birthdateInput"
                        class="form-control @error('birthdate') is-invalid @enderror"
                        value="{{ old('birthdate',$meBD?->format('Y-m-d')) }}">
                    @error('birthdate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Age</label>
                    <input type="text" id="ageDisplay" class="form-control bg-light"
                        readonly value="{{ $meAge }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Contact #1 <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="contact_number_1"
                        class="form-control @error('contact_number_1') is-invalid @enderror"
                        value="{{ old('contact_number_1',$me->contact_number_1) }}"
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
                        value="{{ old('contact_number_2',$me->contact_number_2) }}"
                        maxlength="11">
                    @error('contact_number_2')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @else
                    <small class="text-muted">Format: 09XXXXXXXXX (11 digits)</small>
                    @enderror
                </div>
            </div>

            {{-- Address --}}
            <p class="fw-semibold small mb-2" style="color:#1B4332;">
                <i data-lucide="map-pin" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Address
            </p>
            <div class="mb-4">
                @include('partials.address-fields',[
                'fieldPrefix' => '',
                'data' => [
                'region' => old('region', $me->region ?? ''),
                'province' => old('province', $me->province ?? ''),
                'city' => old('city', $me->city ?? ''),
                'barangay' => old('barangay', $me->barangay ?? ''),
                'house_unit_no' => old('house_unit_no', $me->house_unit_no ?? ''),
                'street' => old('street', $me->street ?? ''),
                'zip_code' => old('zip_code', $me->zip_code ?? ''),
                ],
                ])
            </div>

            {{-- Account Credentials --}}
            <p class="fw-semibold small mb-2" style="color:#1B4332;">
                <i data-lucide="shield" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Account Credentials
            </p>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Username <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="username"
                        class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username',$me->username) }}"
                        required minlength="4">
                    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        New Password
                        <span class="text-muted small fw-normal">(leave blank to keep)</span>
                    </label>
                    <div class="input-group">
                        <input type="password" name="password" id="profilePassword"
                            class="form-control @error('password') is-invalid @enderror"
                            minlength="6" style="border-right:none;">
                        <button type="button" class="input-group-text" id="toggleProfilePw" tabindex="-1"
                            style="background:#f9f7f3;border-color:#d6d0c4;border-left:none;color:#6b7280;cursor:pointer;border-radius:0 8px 8px 0;">
                            <i data-lucide="eye" id="eyeProfilePw" style="width:15px;height:15px;"></i>
                        </button>
                    </div>
                    @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    <div style="height:4px;border-radius:2px;background:#e5e7eb;margin-top:.35rem;overflow:hidden;"><div id="pwStrengthFill" style="height:100%;width:0%;border-radius:2px;transition:width .25s,background .25s;"></div></div>
                    <div id="pwStrengthLabel" style="font-size:.72rem;margin-top:.2rem;"></div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="profilePasswordConfirm"
                            class="form-control" style="border-right:none;">
                        <button type="button" class="input-group-text" id="toggleProfilePwConfirm" tabindex="-1"
                            style="background:#f9f7f3;border-color:#d6d0c4;border-left:none;color:#6b7280;cursor:pointer;border-radius:0 8px 8px 0;">
                            <i data-lucide="eye" id="eyeProfilePwConfirm" style="width:15px;height:15px;"></i>
                        </button>
                    </div>
                    <div id="pwMatchMsg" style="font-size:.72rem;margin-top:.2rem;"></div>
                </div>
            </div>

            <button type="submit" class="btn-primary-app">
                <i data-lucide="save"></i>Save Changes
            </button>
        </form>
    </div>
</div>

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
        document.getElementById('sexSpecifyWrapper')
            .classList.toggle('d-none', this.value !== 'others');
    });

    document.getElementById('profilePicInput').addEventListener('change', function() {
        var file = this.files[0];
        if (!file) return;
        document.getElementById('picFileName').textContent = file.name;
        document.getElementById('removeProfilePictureFlag').value = '0';
        document.getElementById('removePicBtn').classList.remove('d-none');
        var reader = new FileReader();
        reader.onload = function(e) {
            var w = document.getElementById('avatarWrapper');
            w.innerHTML = '<img src="' + e.target.result +
                '" style="width:72px;height:72px;border-radius:50%;object-fit:cover;cursor:pointer;flex-shrink:0;">';
            w.querySelector('img').addEventListener('click', openFullscreen);
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('removePicBtn').addEventListener('click', function() {
        document.getElementById('profilePicInput').value = '';
        document.getElementById('removeProfilePictureFlag').value = '1';
        document.getElementById('picFileName').textContent = 'No file chosen';
        document.getElementById('avatarWrapper').innerHTML = `@include('partials.avatar',['name' => $meName ?: '?', 'image' => null, 'size' => 72])`;
        this.classList.add('d-none');
    });

    (function() {
        var w = document.getElementById('avatarWrapper');
        var img = w ? w.querySelector('img') : null;
        if (img) {
            img.style.cursor = 'pointer';
            img.addEventListener('click', openFullscreen);
        }
    }());

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
    makeEyeToggle('toggleProfilePw', 'profilePassword', 'eyeProfilePw');
    makeEyeToggle('toggleProfilePwConfirm', 'profilePasswordConfirm', 'eyeProfilePwConfirm');

    // Password strength
    document.getElementById('profilePassword').addEventListener('input', function() {
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
        checkProfilePwMatch();
    });

    function checkProfilePwMatch() {
        var pw   = document.getElementById('profilePassword').value;
        var conf = document.getElementById('profilePasswordConfirm').value;
        var msg  = document.getElementById('pwMatchMsg');
        if (!conf) { msg.textContent = ''; return; }
        if (pw === conf) { msg.textContent = '✓ Passwords match';       msg.style.color = '#16a34a'; }
        else             { msg.textContent = '✗ Passwords do not match'; msg.style.color = '#dc2626'; }
    }
    document.getElementById('profilePasswordConfirm').addEventListener('input', checkProfilePwMatch);
</script>

@include('partials.camera-capture')
@endsection


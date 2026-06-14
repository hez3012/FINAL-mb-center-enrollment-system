@extends('admin.layouts.app')
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
    <div>
        <h5 class="fw-bold mb-1">Profile Settings</h5>
        <p class="text-muted small mb-0">Update your personal details, address, and account credentials.</p>
    </div>
</div>

<div class="card border-0 shadow" style="border-radius: 18px; background: linear-gradient(135deg, #fffef5 0%, #f4ffef 100%);">
    <div class="card-body p-4 p-lg-5">
        <form method="POST" action="{{ route('admin.profile.update') }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Profile Picture --}}
            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: rgba(255,255,255,0.7); border-color: rgba(34,197,94,0.2) !important;">
                <p class="fw-semibold text-success small mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle"></i>Profile Picture
                </p>
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div id="avatarWrapper" style="cursor:pointer;">
                                @include('partials.avatar',[
                                'name' => $meName ?: '?',
                                'image' => $me->profile_picture,
                                'size' => 72,
                                ])
                            </div>
                            <div>
                                <div class="fw-semibold">Current picture</div>
                                <div class="text-muted small">A clear photo helps us recognize your account.</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                            <label for="profilePicInput"
                                class="btn btn-sm btn-outline-success mb-0">
                                <i class="bi bi-image me-1"></i>Choose Picture
                            </label>
                            <input type="file" name="profile_picture" id="profilePicInput"
                                class="d-none @error('profile_picture') is-invalid @enderror"
                                accept=".jpg,.jpeg,.png">
                            <span id="picFileName" class="text-muted small">No file chosen</span>
                        </div>
                        @error('profile_picture')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">JPG or PNG only · Max 50MB · Optional</small>
                    </div>
                </div>
            </div>

            {{-- Personal Information --}}
            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: rgba(255,255,255,0.7); border-color: rgba(34,197,94,0.2) !important;">
                <p class="fw-semibold text-success small mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-person"></i>Personal Information
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
            </div>

            {{-- Address --}}
            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: rgba(255,255,255,0.7); border-color: rgba(34,197,94,0.2) !important;">
                <p class="fw-semibold text-success small mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt"></i>Address
                </p>
                <div class="mb-0">
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
            </div>

            {{-- Account Credentials --}}
            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: rgba(255,255,255,0.7); border-color: rgba(34,197,94,0.2) !important;">
                <p class="fw-semibold text-success small mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-shield"></i>Account Credentials
                </p>
                <div class="row g-3 mb-0">
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
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        minlength="6">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted">Minimum 6 characters.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                        class="form-control">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-save me-1"></i>Save Changes
                </button>
            </div>
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
        var reader = new FileReader();
        reader.onload = function(e) {
            var w = document.getElementById('avatarWrapper');
            w.innerHTML = '<img src="' + e.target.result +
                '" style="width:64px;height:64px;border-radius:50%;object-fit:cover;cursor:pointer;flex-shrink:0;">';
            w.querySelector('img').addEventListener('click', openFullscreen);
        };
        reader.readAsDataURL(file);
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
</script>
@endsection
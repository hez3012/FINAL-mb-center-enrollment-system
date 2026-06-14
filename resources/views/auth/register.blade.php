<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H.O.P.E. — Guardian Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light" style="background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);"><style>
    .auth-card {
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 22px;
        box-shadow: 0 16px 40px rgba(22, 163, 74, 0.14);
        overflow: hidden;
    }

    .auth-hero {
        background: linear-gradient(135deg, rgba(220, 252, 231, 0.8) 0%, rgba(254, 240, 138, 0.3) 100%);
        border: 1px solid rgba(34, 197, 94, 0.16);
        border-radius: 16px;
        padding: 1rem 1.1rem;
        margin-bottom: 1.2rem;
    }

    .auth-badge {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.8);
        color: #16a34a;
        font-size: 1.2rem;
        margin-bottom: 0.6rem;
        box-shadow: inset 0 0 0 1px rgba(34, 197, 94, 0.14);
    }

    .auth-title {
        color: #15803d;
        letter-spacing: 0.01em;
    }

    .auth-helper {
        color: #4b5563;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .section-title {
        color: #16a34a;
    }

    .auth-btn {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        border: none;
        color: white;
    }

    .auth-btn:hover {
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        color: white;
    }

    .auth-alert {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .auth-card .form-control,
    .auth-card .form-select {
        border-radius: 12px;
        border-color: #d1fae5;
        padding: 0.72rem 0.85rem;
    }

    .auth-card .form-control:focus,
    .auth-card .form-select:focus {
        border-color: #22c55e;
        box-shadow: 0 0 0 0.2rem rgba(34, 197, 94, 0.16);
    }

    .auth-card .form-label {
        color: #166534;
    }
</style>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100 py-5">
        <div class="col-md-12">

            <div class="card auth-card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    {{-- Header --}}
                    <div class="auth-hero text-center mb-4">
                        <div class="auth-badge">
                            <img src="{{ asset('MB-LOGO.png') }}" alt="MB Logo" style="width: 100%; height: 100%; object-fit: contain; padding: 0.2rem;">
                        </div>
                        <h4 class="fw-bold auth-title mb-1">H.O.P.E.</h4>
                        <p class="auth-helper mb-1">
                            Create your guardian portal account and start your child’s enrollment journey in a few simple steps.
                        </p>
                        <p class="text-muted small mb-0">Holistic Online Profile and Enrollment System · M.B. Therapy Center</p>
                    </div>

                    {{-- Notice: Digital Enrollment Only --}}
                    <div class="alert auth-alert border-0 mb-4 py-3">
                        <p class="fw-semibold small mb-1">
                            <i class="bi bi-info-circle-fill me-1"></i>
                            For Digital Enrollment Only
                        </p>
                        <p class="small mb-2">
                            This registration is exclusively for guardians who wish to
                            <strong>enroll their child online</strong> through the portal.
                            After registering, you will be able to submit an enrollment
                            application digitally.
                        </p>
                        <p class="small mb-0 text-danger fw-semibold">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            Walk-in enrollee? Do not register here.
                        </p>
                        <p class="small mb-0">
                            If your child is enrolling as a walk-in, our staff at
                            M.B. Therapy Center will create your account and provide
                            your login credentials directly. Simply
                            <a href="{{ route('login') }}" class="fw-semibold">log in</a>
                            using those credentials.
                        </p>
                    </div>

                    {{-- Validation errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger py-2">
                            <p class="fw-semibold small mb-1">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                Please fix the following:
                            </p>
                            <ul class="mb-0 small ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf

                        {{-- Personal Information --}}
                        <p class="fw-semibold section-title small mb-2">
                            <i class="bi bi-person me-1"></i>Personal Information
                        </p>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    First Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="first_name"
                                       class="form-control @error('first_name') is-invalid @enderror"
                                       value="{{ old('first_name') }}"
                                       required minlength="2">
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    Middle Name
                                    <span class="text-muted small fw-normal">(optional)</span>
                                </label>
                                <input type="text" name="middle_name" id="middleNameInput"
                                       class="form-control @error('middle_name') is-invalid @enderror"
                                       value="{{ old('middle_name') }}">
                                @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    Last Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="last_name"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       value="{{ old('last_name') }}"
                                       required minlength="2">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">M.I.</label>
                                <input type="text" id="miDisplay"
                                       class="form-control bg-light"
                                       readonly placeholder="Auto">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    Sex <span class="text-danger">*</span>
                                </label>
                                <select name="sex" id="sexSelect"
                                        class="form-select @error('sex') is-invalid @enderror"
                                        required>
                                    <option value="">-- Select --</option>
                                    @foreach(['male'=>'Male','female'=>'Female','prefer_not_to_say'=>'Prefer not to say','others'=>'Others'] as $val => $label)
                                        <option value="{{ $val }}"
                                                {{ old('sex') === $val ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sex')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 {{ old('sex') === 'others' ? '' : 'd-none' }}"
                                 id="sexSpecifyWrapper">
                                <label class="form-label fw-semibold">Please specify</label>
                                <input type="text" name="sex_specify"
                                       class="form-control @error('sex_specify') is-invalid @enderror"
                                       value="{{ old('sex_specify') }}">
                                @error('sex_specify')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    Birthdate
                                    <span class="text-muted small fw-normal">(optional)</span>
                                </label>
                                <input type="date" name="birthdate" id="birthdateInput"
                                       class="form-control @error('birthdate') is-invalid @enderror"
                                       value="{{ old('birthdate') }}">
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Age</label>
                                <input type="text" id="ageDisplay"
                                       class="form-control bg-light"
                                       readonly placeholder="Auto">
                            </div>
                        </div>

                        {{-- Contact Numbers --}}
                        <p class="fw-semibold section-title small mb-2">
                            <i class="bi bi-telephone me-1"></i>Contact Information
                        </p>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Contact #2
                                    <span class="text-muted small fw-normal">(optional)</span>
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
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Facebook Account Link
                                    <span class="text-muted small fw-normal">(optional)</span>
                                </label>
                                <input type="url" name="facebook_link"
                                       class="form-control @error('facebook_link') is-invalid @enderror"
                                       value="{{ old('facebook_link') }}"
                                       placeholder="https://facebook.com/yourprofile">
                                @error('facebook_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small class="text-muted">So our facilitators can reach you via Messenger.</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Address --}}
                        <p class="fw-semibold section-title small mb-2">
                            <i class="bi bi-geo-alt me-1"></i>Address
                        </p>
                        <div class="mb-3">
                            @include('partials.address-fields', [
                                'fieldPrefix' => '',
                                'data' => [
                                    'region'        => old('region', ''),
                                    'province'      => old('province', ''),
                                    'city'          => old('city', ''),
                                    'barangay'      => old('barangay', ''),
                                    'house_unit_no' => old('house_unit_no', ''),
                                    'street'        => old('street', ''),
                                    'zip_code'      => old('zip_code', ''),
                                ],
                            ])
                        </div>

                        {{-- Guardian Information --}}
                        <p class="fw-semibold section-title small mb-2">
                            <i class="bi bi-person-heart me-1"></i>Guardian Information
                        </p>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Relationship to Student
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="relationship"
                                        class="form-select @error('relationship') is-invalid @enderror"
                                        required>
                                    <option value="">-- Select --</option>
                                    @foreach(['Mother','Father','Grandparent','Aunt/Uncle','Sibling','Legal Guardian','Other'] as $rel)
                                        <option value="{{ $rel }}"
                                                {{ old('relationship') === $rel ? 'selected' : '' }}>
                                            {{ $rel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('relationship')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Account Credentials --}}
                        <p class="fw-semibold section-title small mb-2">
                            <i class="bi bi-shield me-1"></i>Account Credentials
                        </p>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Email Address <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="username"
                                       class="form-control @error('username') is-invalid @enderror"
                                       value="{{ old('username') }}"
                                       required minlength="4">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Min. 4 characters. Letters, numbers, - and _ only.</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required minlength="6">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Minimum 6 characters.</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Confirm Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password_confirmation"
                                       class="form-control" required>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn auth-btn">
                                <i class="bi bi-person-check me-1"></i>Create Guardian Account
                            </button>
                        </div>

                        <p class="text-center text-muted small mb-0">
                            Already have an account?
                            <a href="{{ route('login') }}" class="fw-semibold">Log in here</a>
                        </p>

                    </form>

                </div>
            </div>

            <p class="text-center text-muted small mt-3">
                &copy; {{ date('Y') }} M.B. Therapy Center. All rights reserved.
            </p>

        </div>
    </div>
</div>

<script>
document.getElementById('middleNameInput').addEventListener('input', function () {
    var mi = this.value.trim();
    document.getElementById('miDisplay').value = mi ? mi[0].toUpperCase() + '.' : '';
});

document.getElementById('birthdateInput').addEventListener('change', function () {
    if (!this.value) { document.getElementById('ageDisplay').value = ''; return; }
    var birth = new Date(this.value);
    var today = new Date();
    var age   = today.getFullYear() - birth.getFullYear();
    if (today.getMonth() < birth.getMonth() ||
       (today.getMonth() === birth.getMonth() && today.getDate() < birth.getDate())) { age--; }
    document.getElementById('ageDisplay').value = age + ' years old';
});

document.getElementById('sexSelect').addEventListener('change', function () {
    document.getElementById('sexSpecifyWrapper')
        .classList.toggle('d-none', this.value !== 'others');
});
</script>

</body>
</html>
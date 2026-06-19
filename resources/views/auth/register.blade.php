<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H.O.P.E. — Guardian Registration</title>
    {{-- Tabler CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/css/tabler.min.css">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        :root {
            --hope-green:  #1B4332;
            --hope-green2: #2D6A4F;
            --hope-gold:   #EAB308;
            --hope-cream:  #F5F1E8;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--hope-cream);
            min-height: 100vh;
        }

        .reg-header {
            background: linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,.25);
        }

        .reg-header img.hope-logo { height: 44px; }

        .reg-header-text strong {
            font-size: 1.05rem;
            font-weight: 700;
            color: #fff;
        }

        .reg-header-text small {
            display: block;
            color: rgba(255,255,255,.6);
            font-size: .72rem;
        }

        .reg-wrap {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 1.25rem 3rem;
        }

        /* Section card */
        .reg-section {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e8e3d8;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
            margin-bottom: 1.25rem;
            overflow: hidden;
        }

        .reg-section-header {
            background: linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%);
            color: #fff;
            padding: .75rem 1.1rem;
            display: flex;
            align-items: center;
            gap: .55rem;
            font-size: .83rem;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .reg-section-header svg {
            width: 15px;
            height: 15px;
            stroke: rgba(255,255,255,.8);
        }

        .reg-section-body { padding: 1.25rem 1.1rem; }

        /* Form elements */
        .form-label {
            font-weight: 600;
            font-size: .82rem;
            color: #374151;
            margin-bottom: .25rem;
        }

        .form-control, .form-select {
            border-color: #d6d0c4;
            background: #fdfcfa;
            font-size: .875rem;
            padding: .55rem .8rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--hope-green);
            box-shadow: 0 0 0 3px rgba(27,67,50,.1);
        }

        .form-control.bg-light {
            background: #f3f0ea !important;
            color: #6b7280;
        }

        /* Notice alert */
        .reg-notice {
            background: #f0faf5;
            border: 1px solid #6ee7b7;
            border-left: 4px solid var(--hope-green2);
            border-radius: 8px;
            padding: .9rem 1rem;
            font-size: .83rem;
            margin-bottom: 1.5rem;
        }

        .reg-notice .reg-notice-danger {
            color: #dc2626;
            font-weight: 700;
        }

        /* Submit button */
        .btn-hope {
            background: linear-gradient(135deg, var(--hope-green) 0%, var(--hope-green2) 100%);
            color: #fff;
            font-weight: 700;
            padding: .75rem 2rem;
            border-radius: 10px;
            border: none;
            font-size: .95rem;
            box-shadow: 0 2px 10px rgba(27,67,50,.3);
            transition: box-shadow .18s ease, transform .15s ease;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }

        .btn-hope:hover {
            box-shadow: 0 4px 18px rgba(27,67,50,.38);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-hope:disabled { opacity: .65; transform: none; cursor: not-allowed; }

        /* Password strength */
        .pw-strength-bar {
            height: 4px;
            border-radius: 2px;
            background: #e5e7eb;
            margin-top: .35rem;
            overflow: hidden;
        }

        .pw-strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 2px;
            transition: width .25s ease, background .25s ease;
        }

        .pw-strength-label {
            font-size: .72rem;
            margin-top: .2rem;
        }

        /* Confirm match indicator */
        .pw-match-msg {
            font-size: .72rem;
            margin-top: .2rem;
        }

        /* Eye toggle */
        .pw-eye-btn {
            background: #f9f7f3;
            border-color: #d6d0c4;
            border-left: none;
            color: #6b7280;
            cursor: pointer;
        }

        .pw-eye-btn:hover { color: var(--hope-green); }

        /* Password eye when nested in input-group */
        .input-group .form-control { border-right: none; }
        .input-group .pw-eye-btn   { border-radius: 0 6px 6px 0 !important; }
    </style>
</head>
<body>

{{-- Sticky header --}}
<div class="reg-header">
    <img src="{{ asset('HOPE-LOGO.png') }}" alt="H.O.P.E." class="hope-logo">
    <div class="reg-header-text">
        <strong>Guardian Registration</strong>
        <small>H.O.P.E. — Holistic Online Profile &amp; Enrollment System &nbsp;·&nbsp; M.B. Therapy Center</small>
    </div>
</div>

<div class="reg-wrap">

    {{-- Notice --}}
    <div class="reg-notice">
        <p class="fw-semibold mb-1">
            <i data-lucide="info" style="width:14px;height:14px;display:inline;vertical-align:middle;"></i>
            For Digital Enrollment Only
        </p>
        <p class="mb-2">
            This registration is exclusively for guardians who wish to
            <strong>enroll their child online</strong> through the portal.
            After registering, you will be able to submit an enrollment application digitally.
        </p>
        <p class="reg-notice-danger mb-1">
            <i data-lucide="triangle-alert" style="width:13px;height:13px;display:inline;vertical-align:middle;"></i>
            Walk-in enrollee? Do not register here.
        </p>
        <p class="mb-0" style="color:#374151;">
            If your child is enrolling walk-in, our staff will create your account and provide
            your credentials.
            <a href="{{ route('login') }}" class="fw-semibold" style="color:var(--hope-green);">Log in here</a> once received.
        </p>
    </div>

    {{-- Validation errors --}}
    @if($errors->any())
    <div class="alert alert-danger mb-3">
        <p class="fw-semibold small mb-1">
            <i data-lucide="alert-circle" style="width:14px;height:14px;display:inline;vertical-align:middle;"></i>
            Please fix the following:
        </p>
        <ul class="mb-0 small ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}" id="registerForm">
        @csrf

        {{-- Personal Information --}}
        <div class="reg-section">
            <div class="reg-section-header">
                <i data-lucide="user"></i> Personal Information
            </div>
            <div class="reg-section-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name"
                               class="form-control @error('first_name') is-invalid @enderror"
                               value="{{ old('first_name') }}"
                               required minlength="2">
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            Middle Name <span class="text-muted fw-normal small">(optional)</span>
                        </label>
                        <input type="text" name="middle_name" id="middleNameInput"
                               class="form-control @error('middle_name') is-invalid @enderror"
                               value="{{ old('middle_name') }}">
                        @error('middle_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name"
                               class="form-control @error('last_name') is-invalid @enderror"
                               value="{{ old('last_name') }}"
                               required minlength="2">
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">M.I.</label>
                        <input type="text" id="miDisplay" class="form-control bg-light" readonly placeholder="Auto">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sex <span class="text-danger">*</span></label>
                        <select name="sex" id="sexSelect"
                                class="form-select @error('sex') is-invalid @enderror" required>
                            <option value="">-- Select --</option>
                            @foreach(['male'=>'Male','female'=>'Female','prefer_not_to_say'=>'Prefer not to say','others'=>'Others'] as $val => $label)
                                <option value="{{ $val }}" {{ old('sex') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('sex')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 {{ old('sex') === 'others' ? '' : 'd-none' }}" id="sexSpecifyWrapper">
                        <label class="form-label">Please specify</label>
                        <input type="text" name="sex_specify"
                               class="form-control @error('sex_specify') is-invalid @enderror"
                               value="{{ old('sex_specify') }}">
                        @error('sex_specify')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">
                            Birthdate <span class="text-muted fw-normal small">(optional)</span>
                        </label>
                        <input type="date" name="birthdate" id="birthdateInput"
                               class="form-control @error('birthdate') is-invalid @enderror"
                               value="{{ old('birthdate') }}">
                        @error('birthdate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Age</label>
                        <input type="text" id="ageDisplay" class="form-control bg-light" readonly placeholder="Auto">
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Information --}}
        <div class="reg-section">
            <div class="reg-section-header">
                <i data-lucide="phone"></i> Contact Information
            </div>
            <div class="reg-section-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Contact #1 <span class="text-danger">*</span></label>
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
                        <label class="form-label">
                            Contact #2 <span class="text-muted fw-normal small">(optional)</span>
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
                        <label class="form-label">
                            Facebook Account Link <span class="text-muted fw-normal small">(optional)</span>
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
            </div>
        </div>

        {{-- Address --}}
        <div class="reg-section">
            <div class="reg-section-header">
                <i data-lucide="map-pin"></i> Address
            </div>
            <div class="reg-section-body">
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
        </div>

        {{-- Guardian Information --}}
        <div class="reg-section">
            <div class="reg-section-header">
                <i data-lucide="heart-handshake"></i> Guardian Information
            </div>
            <div class="reg-section-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            Relationship to Student <span class="text-danger">*</span>
                        </label>
                        <select name="relationship"
                                class="form-select @error('relationship') is-invalid @enderror" required>
                            <option value="">-- Select --</option>
                            @foreach(['Mother','Father','Grandparent','Aunt/Uncle','Sibling','Legal Guardian','Other'] as $rel)
                                <option value="{{ $rel }}" {{ old('relationship') === $rel ? 'selected' : '' }}>
                                    {{ $rel }}
                                </option>
                            @endforeach
                        </select>
                        @error('relationship')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Account Credentials --}}
        <div class="reg-section">
            <div class="reg-section-header">
                <i data-lucide="shield"></i> Account Credentials
            </div>
            <div class="reg-section-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
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
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="password" id="regPassword"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required minlength="6">
                            <button type="button" class="input-group-text pw-eye-btn" id="toggleRegPw" tabindex="-1">
                                <i data-lucide="eye" style="width:15px;height:15px;" id="eyeReg"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <small class="text-muted">Minimum 6 characters.</small>
                        @enderror
                        <div class="pw-strength-bar"><div class="pw-strength-fill" id="pwStrengthFill"></div></div>
                        <div class="pw-strength-label text-muted" id="pwStrengthLabel"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="regPasswordConfirm"
                                   class="form-control" required>
                            <button type="button" class="input-group-text pw-eye-btn" id="toggleRegPwConfirm" tabindex="-1">
                                <i data-lucide="eye" style="width:15px;height:15px;" id="eyeRegConfirm"></i>
                            </button>
                        </div>
                        <div class="pw-match-msg" id="pwMatchMsg"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('login') }}" class="text-muted small">
                <i data-lucide="arrow-left" style="width:13px;height:13px;display:inline;vertical-align:middle;"></i>
                Already have an account? Log in
            </a>
            <button type="submit" class="btn-hope" id="regSubmitBtn">
                <span id="regBtnText">
                    <i data-lucide="user-check" style="width:16px;height:16px;display:inline;vertical-align:middle;"></i>
                    Create Guardian Account
                </span>
                <span id="regBtnSpinner" style="display:none;">
                    <span class="spinner-border spinner-border-sm me-1"></span>
                    Creating account…
                </span>
            </button>
        </div>

    </form>

    <p class="text-center text-muted small mt-4">
        &copy; {{ date('Y') }} M.B. Therapy Center. All rights reserved.
    </p>

</div>

{{-- Tabler + Lucide --}}
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/js/tabler.min.js"></script>
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    lucide.createIcons();

    // Middle initial
    document.getElementById('middleNameInput').addEventListener('input', function () {
        var mi = this.value.trim();
        document.getElementById('miDisplay').value = mi ? mi[0].toUpperCase() + '.' : '';
    });

    // Age from birthdate
    document.getElementById('birthdateInput').addEventListener('change', function () {
        if (!this.value) { document.getElementById('ageDisplay').value = ''; return; }
        var birth = new Date(this.value);
        var today = new Date();
        var age   = today.getFullYear() - birth.getFullYear();
        if (today.getMonth() < birth.getMonth() ||
           (today.getMonth() === birth.getMonth() && today.getDate() < birth.getDate())) { age--; }
        document.getElementById('ageDisplay').value = age + ' years old';
    });

    // Sex specify
    document.getElementById('sexSelect').addEventListener('change', function () {
        document.getElementById('sexSpecifyWrapper').classList.toggle('d-none', this.value !== 'others');
    });

    // Eye toggle helpers
    function makeEyeToggle(btnId, inputId, iconId) {
        document.getElementById(btnId).addEventListener('click', function () {
            var inp   = document.getElementById(inputId);
            var isText = inp.type === 'text';
            inp.type = isText ? 'password' : 'text';
            document.getElementById(iconId).setAttribute('data-lucide', isText ? 'eye' : 'eye-off');
            lucide.createIcons();
        });
    }

    makeEyeToggle('toggleRegPw', 'regPassword', 'eyeReg');
    makeEyeToggle('toggleRegPwConfirm', 'regPasswordConfirm', 'eyeRegConfirm');

    // Password strength
    document.getElementById('regPassword').addEventListener('input', function () {
        var val    = this.value;
        var score  = 0;
        if (val.length >= 6)               score++;
        if (val.length >= 10)              score++;
        if (/[A-Z]/.test(val))             score++;
        if (/[0-9]/.test(val))             score++;
        if (/[^A-Za-z0-9]/.test(val))     score++;

        var fill   = document.getElementById('pwStrengthFill');
        var label  = document.getElementById('pwStrengthLabel');
        var colors = ['', '#ef4444', '#f97316', '#EAB308', '#22c55e', '#16a34a'];
        var labels = ['', 'Very weak', 'Weak', 'Fair', 'Strong', 'Very strong'];

        fill.style.width = val.length === 0 ? '0%' : (score * 20) + '%';
        fill.style.background = colors[score] || '';
        label.textContent = val.length === 0 ? '' : labels[score] || '';
        label.style.color  = colors[score] || '';

        checkMatch();
    });

    // Confirm match
    function checkMatch() {
        var pw   = document.getElementById('regPassword').value;
        var conf = document.getElementById('regPasswordConfirm').value;
        var msg  = document.getElementById('pwMatchMsg');
        if (!conf) { msg.textContent = ''; return; }
        if (pw === conf) {
            msg.textContent = '✓ Passwords match';
            msg.style.color = '#16a34a';
        } else {
            msg.textContent = '✗ Passwords do not match';
            msg.style.color = '#dc2626';
        }
    }

    document.getElementById('regPasswordConfirm').addEventListener('input', checkMatch);

    // Loading state on submit
    document.getElementById('registerForm').addEventListener('submit', function () {
        var btn   = document.getElementById('regSubmitBtn');
        var txt   = document.getElementById('regBtnText');
        var spin  = document.getElementById('regBtnSpinner');
        btn.disabled = true;
        txt.style.display  = 'none';
        spin.style.display = 'inline';
    });
</script>

</body>
</html>

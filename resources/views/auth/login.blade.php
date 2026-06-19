<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H.O.P.E. — Login</title>
    {{-- Tabler CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/css/tabler.min.css">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">

    <style>
        :root {
            --hope-green:  #1B4332;
            --hope-green2: #2D6A4F;
            --hope-gold:   #EAB308;
            --hope-cream:  #F5F1E8;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--hope-cream);
        }

        /* ── Split layout ─────────────────────────── */
        .auth-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* ── Left branding panel ──────────────────── */
        .auth-brand {
            background: var(--hope-green);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        .auth-brand::before,
        .auth-brand::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            opacity: .06;
            background: #fff;
        }
        .auth-brand::before { width: 400px; height: 400px; top: -120px; right: -120px; }
        .auth-brand::after  { width: 280px; height: 280px; bottom: -80px; left: -80px; }

        .auth-brand-inner {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 340px;
        }

        .auth-hope-logo {
            width: 200px;
            height: auto;
            margin-bottom: 1.75rem;
            filter: drop-shadow(0 4px 16px rgba(0,0,0,.25));
        }

        .auth-mb-logo-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .75rem;
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 12px;
            padding: .65rem 1.25rem;
            margin-bottom: 2rem;
        }

        .auth-mb-logo-wrap img { width: 42px; height: 42px; object-fit: contain; }

        .auth-mb-name {
            text-align: left;
        }

        .auth-mb-name strong {
            display: block;
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .auth-mb-name small {
            font-size: .72rem;
            color: rgba(255,255,255,.6);
        }

        .auth-tagline {
            font-style: italic;
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--hope-gold);
            margin-bottom: .5rem;
            line-height: 1.4;
        }

        .auth-tagline-heart {
            color: #f87171;
            font-style: normal;
        }

        .auth-sub {
            font-size: .8rem;
            color: rgba(255,255,255,.55);
            letter-spacing: .3px;
        }

        /* Illustration area */
        .auth-illustration {
            margin-top: 2.5rem;
            opacity: .85;
        }

        /* ── Right form panel ─────────────────────── */
        .auth-form-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            background: #fff;
        }

        .auth-form-wrap {
            width: 100%;
            max-width: 380px;
        }

        .auth-form-title {
            font-size: 1.65rem;
            font-weight: 800;
            color: var(--hope-green);
            margin-bottom: .25rem;
            letter-spacing: -.5px;
        }

        .auth-form-subtitle {
            font-size: .875rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }

        /* Form controls */
        .auth-form-wrap .form-label {
            font-weight: 600;
            font-size: .83rem;
            color: #374151;
            margin-bottom: .3rem;
        }

        .auth-form-wrap .input-group-text {
            background: #f9f7f3;
            border-color: #d6d0c4;
            color: var(--hope-green2);
        }

        .auth-form-wrap .form-control {
            border-color: #d6d0c4;
            background: #fdfcfa;
            font-size: .9rem;
            padding: .6rem .85rem;
        }

        .auth-form-wrap .form-control:focus {
            border-color: var(--hope-green);
            box-shadow: 0 0 0 3px rgba(27,67,50,.12);
        }

        /* Password eye toggle */
        .pw-eye-btn {
            background: #f9f7f3;
            border-color: #d6d0c4;
            border-left: none;
            color: #6b7280;
            cursor: pointer;
            transition: color .15s;
        }

        .pw-eye-btn:hover { color: var(--hope-green); }

        /* Submit button */
        .btn-hope {
            background: linear-gradient(135deg, var(--hope-green) 0%, var(--hope-green2) 100%);
            color: #fff;
            font-weight: 700;
            padding: .7rem;
            border-radius: 10px;
            border: none;
            font-size: .95rem;
            width: 100%;
            box-shadow: 0 2px 10px rgba(27,67,50,.3);
            transition: box-shadow .18s ease, transform .15s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        .btn-hope:hover {
            box-shadow: 0 4px 18px rgba(27,67,50,.38);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-hope:active { transform: translateY(0); }

        .btn-hope:disabled { opacity: .65; cursor: not-allowed; transform: none; }

        /* Register link */
        .auth-register-box {
            background: #f9f7f3;
            border: 1px solid #e5e1d8;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
        }

        .btn-hope-outline {
            background: transparent;
            border: 2px solid var(--hope-green);
            color: var(--hope-green);
            font-weight: 700;
            border-radius: 8px;
            padding: .45rem 1.1rem;
            font-size: .85rem;
            transition: all .18s;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        .btn-hope-outline:hover {
            background: var(--hope-green);
            color: #fff;
        }

        /* ── Responsive ──────────────────────────── */
        @media (max-width: 768px) {
            .auth-split { grid-template-columns: 1fr; }
            .auth-brand { display: none; }
            .auth-form-panel { padding: 2rem 1.25rem; }
        }
    </style>
</head>
<body>

<div class="auth-split">

    {{-- ── Left: Branding panel ──────────────────── --}}
    <div class="auth-brand animate__animated animate__fadeInLeft">
        <div class="auth-brand-inner">
            <img src="{{ asset('HOPE-LOGO.png') }}" alt="H.O.P.E." class="auth-hope-logo">

            <div class="auth-mb-logo-wrap">
                <img src="{{ asset('MB-LOGO.png') }}" alt="M.B. Therapy Center">
                <div class="auth-mb-name">
                    <strong>M.B. Therapy Center</strong>
                    <small>Batangas City, Philippines</small>
                </div>
            </div>

            <div class="auth-tagline">
                "From Disabilities to Possibilities."
                <span class="auth-tagline-heart">&#9829;</span>
            </div>
            <div class="auth-sub">
                Holistic Online Profile &amp; Enrollment System
            </div>

            {{-- Inline SVG illustration (student/family) --}}
            <div class="auth-illustration">
                <svg viewBox="0 0 320 200" width="280" xmlns="http://www.w3.org/2000/svg" style="display:block;margin:0 auto;">
                    <!-- Ground -->
                    <ellipse cx="160" cy="188" rx="140" ry="12" fill="rgba(255,255,255,.08)"/>
                    <!-- Family figure left (guardian) -->
                    <circle cx="100" cy="90" r="22" fill="#EAB308" opacity=".9"/>
                    <rect x="82" y="114" width="36" height="52" rx="10" fill="#EAB308" opacity=".7"/>
                    <!-- Family figure right (student, smaller) -->
                    <circle cx="152" cy="104" r="16" fill="rgba(255,255,255,.85)"/>
                    <rect x="138" y="122" width="28" height="42" rx="8" fill="rgba(255,255,255,.65)"/>
                    <!-- Heart between them -->
                    <text x="126" y="108" font-size="18" fill="#f87171" opacity=".9">♥</text>
                    <!-- School building -->
                    <rect x="200" y="100" width="80" height="76" rx="4" fill="rgba(255,255,255,.15)"/>
                    <polygon points="200,100 240,70 280,100" fill="rgba(255,255,255,.22)"/>
                    <rect x="228" y="140" width="24" height="36" rx="3" fill="rgba(255,255,255,.25)"/>
                    <text x="218" y="132" font-size="11" fill="rgba(255,255,255,.6)" font-family="serif">HOPE</text>
                    <!-- Stars -->
                    <text x="55" y="55" font-size="10" fill="rgba(255,255,255,.3)">★</text>
                    <text x="175" y="60" font-size="8" fill="rgba(255,255,255,.25)">★</text>
                    <text x="290" y="75" font-size="12" fill="rgba(255,255,255,.2)">★</text>
                </svg>
            </div>
        </div>
    </div>

    {{-- ── Right: Form panel ─────────────────────── --}}
    <div class="auth-form-panel animate__animated animate__fadeInRight">
        <div class="auth-form-wrap">

            <h1 class="auth-form-title">Welcome back</h1>
            <p class="auth-form-subtitle">Sign in to your H.O.P.E. account</p>

            {{-- Error messages --}}
            @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center gap-2 py-2 mb-3" role="alert">
                <i data-lucide="alert-circle" style="width:16px;height:16px;flex-shrink:0;"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email or Username</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i data-lucide="user" style="width:15px;height:15px;"></i>
                        </span>
                        <input type="text"
                               name="login"
                               class="form-control @error('login') is-invalid @enderror"
                               value="{{ old('login') }}"
                               placeholder="Enter your email or username"
                               autofocus required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i data-lucide="lock" style="width:15px;height:15px;"></i>
                        </span>
                        <input type="password"
                               name="password"
                               id="loginPassword"
                               class="form-control"
                               placeholder="Enter your password"
                               required>
                        <button type="button" class="input-group-text pw-eye-btn" id="togglePassword" tabindex="-1">
                            <i data-lucide="eye" style="width:15px;height:15px;" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-hope mb-4" id="loginBtn">
                    <span id="loginBtnText">
                        <i data-lucide="log-in" style="width:16px;height:16px;display:inline;vertical-align:middle;"></i>
                        Sign In
                    </span>
                    <span id="loginBtnSpinner" style="display:none;">
                        <span class="spinner-border spinner-border-sm me-1"></span>
                        Signing in…
                    </span>
                </button>

            </form>

            {{-- Register section --}}
            <div class="auth-register-box">
                <p class="text-muted small mb-2">
                    Planning to enroll your child <strong>online</strong>?
                </p>
                <a href="{{ route('register') }}" class="btn-hope-outline">
                    <i data-lucide="user-plus" style="width:14px;height:14px;"></i>
                    Create a Guardian Account
                </a>
                <p class="text-muted mt-3 mb-0" style="font-size:.72rem;">
                    <i data-lucide="info" style="width:12px;height:12px;display:inline;vertical-align:middle;"></i>
                    Walk-in enrollees: your account will be created by our staff.
                    Use the credentials they provide.
                </p>
            </div>

            <p class="text-center text-muted mt-4 mb-0" style="font-size:.75rem;">
                &copy; {{ date('Y') }} M.B. Therapy Center. All rights reserved.
            </p>

        </div>
    </div>
</div>

{{-- Tabler + Lucide --}}
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/js/tabler.min.js"></script>
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

<script>
    lucide.createIcons();

    // Show/hide password
    var toggleBtn = document.getElementById('togglePassword');
    var pwInput   = document.getElementById('loginPassword');
    var eyeIcon   = document.getElementById('eyeIcon');

    toggleBtn.addEventListener('click', function () {
        var isText = pwInput.type === 'text';
        pwInput.type = isText ? 'password' : 'text';
        eyeIcon.setAttribute('data-lucide', isText ? 'eye' : 'eye-off');
        lucide.createIcons();
    });

    // Loading state on submit
    document.getElementById('loginForm').addEventListener('submit', function () {
        var btn    = document.getElementById('loginBtn');
        var txtEl  = document.getElementById('loginBtnText');
        var spinEl = document.getElementById('loginBtnSpinner');
        btn.disabled = true;
        txtEl.style.display  = 'none';
        spinEl.style.display = 'inline';
    });
</script>

</body>
</html>

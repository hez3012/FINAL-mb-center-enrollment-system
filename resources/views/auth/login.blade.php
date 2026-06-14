<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H.O.P.E. — Login</title>
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
        width: 6rem;
        height: 6rem;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0);
        color: #16a34a;
        font-size: 1.2rem;
        margin-bottom: 0.6rem;
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

    .auth-card .input-group-text {
        background: #f0fdf4;
        color: #16a34a;
        border-color: #d1fae5;
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

    .auth-outline-btn {
        color: #16a34a;
        border: 2px solid #16a34a;
        background: white;
    }

    .auth-outline-btn:hover {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        border-color: #22c55e;
        color: white;
    }
</style>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-8">

            <div class="card auth-card shadow-sm border-0">
                <div class="card-body p-5">

                    {{-- Header --}}
                    <div class="auth-hero text-center mb-4">
                        <div class="auth-badge" style="width: auto; height: auto; border-radius: 0; background: transparent; padding: 0.25rem;">
                            <img src="{{ asset('MB-LOGO-FULL.png') }}" alt="MB Logo" style="width: min(100%, 280px); max-width: 280px; height: auto; object-fit: contain; display: block; margin: 0 auto;">
                        </div>
                        <p class="auth-helper mb-1">
                            Welcome back. Access your guardian portal and manage enrollment with ease.
                        </p>
                        <p class="text-muted small mb-0">Holistic Online Profile and Enrollment System · M.B. Therapy Center</p>
                    </div>

                    {{-- Error messages --}}
                    @if($errors->any())
                        <div class="alert alert-danger py-2">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- Login Form --}}
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Email or Username
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" name="login"
                                       class="form-control @error('login') is-invalid @enderror"
                                       value="{{ old('login') }}"
                                       placeholder="Enter your email or username"
                                       autofocus required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password"
                                       class="form-control"
                                       placeholder="Enter your password"
                                       required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn auth-btn">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </button>
                        </div>

                    </form>

                    {{-- Register section --}}
                    <hr class="my-4">
                    <div class="text-center">
                        <p class="text-muted small mb-2">
                            Planning to enroll your child <strong>online</strong>?
                        </p>
                        <a href="{{ route('register') }}"
                           class="btn auth-outline-btn btn-sm">
                            <i class="bi bi-person-plus me-1"></i>
                            Create a Guardian Account
                        </a>
                        <p class="text-muted mt-3 mb-0" style="font-size:0.75rem;">
                            <i class="bi bi-info-circle me-1"></i>
                            Walk-in enrollees: your account will be created
                            by our staff. Please use the credentials provided to you.
                        </p>
                    </div>

                </div>
            </div>

            <p class="text-center text-muted small mt-3">
                &copy; {{ date('Y') }} M.B. Therapy Center. All rights reserved.
            </p>

        </div>
    </div>
</div>

</body>
</html>
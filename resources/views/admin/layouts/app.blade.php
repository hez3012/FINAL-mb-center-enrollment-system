<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H.O.P.E. — @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-green: #22c55e;
            --secondary-green: #16a34a;
            --dark-green: #15803d;
            --light-green: #dcfce7;
            --lighter-green: #f0fdf4;
            --yellowgreen: #84cc16;
            --lime-green: #a3e635;
            --primary-yellow: #eab308;
            --light-yellow: #fef08a;
        }

        body {
            overflow-x: hidden;
            background-image: url('{{ asset("bg.png") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .parallax-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 110%;
            /* slightly larger to avoid gaps */
            height: 110%;
            background-image: url('{{ asset("bg.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -10;
            transition: transform 0.1s ease-out;
            /* smooth movement */
        }

        .sidebar {
            width: 240px;
            min-width: 240px;
            max-width: 100vw;
            min-height: 100vh;
            max-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            background: linear-gradient(180deg, #ffffff 0%, #f0fdf4 100%);
            border-right: 3px solid #dcfce7;
            box-shadow: 4px 0 15px rgba(34, 197, 94, 0.08);
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar-brand {
            background: linear-gradient(135deg, #dcfce7 0%, #fef08a 100%);
            padding: 1.75rem 1.25rem;
            border-bottom: 3px solid #22c55e;
            margin-bottom: 1rem;
            flex-shrink: 0;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.1));
        }

        .sidebar-brand .fw-bold {
            font-size: 1.1rem;
            color: #15803d;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-brand .fw-bold i {
            color: #eab308;
            font-size: 1.3rem;
        }

        .sidebar-brand .text-muted {
            font-size: 0.75rem;
            color: #16a34a !important;
            margin-top: 0.25rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .sidebar .nav {
            padding: 0.5rem 0.75rem;
            gap: 0.5rem;
        }

        .sidebar .nav-link {
            color: #6b7280 !important;
            font-weight: 600;
            padding: 0.85rem 1rem;
            border-radius: 10px;
            margin: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-left: 3px solid transparent;
            position: relative;
            white-space: normal;
            word-break: break-word;
            overflow-wrap: anywhere;
            line-height: 1.35;
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, #dcfce7 0%, #fef08a 100%);
            color: #15803d !important;
            transform: translateX(5px);
            border-left-color: #22c55e;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white !important;
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.3);
            border-left-color: #eab308;
        }

        .sidebar .nav-link.active i {
            color: #ffffff;
        }

        .sidebar>div:last-child {
            padding: 1.25rem;
            border-top: 2px solid #dcfce7;
            background: linear-gradient(180deg, transparent 0%, #f0fdf4 100%);
            margin-top: auto;
        }

        .sidebar .small {
            margin-bottom: 0.75rem;
        }

        .sidebar .small i {
            color: #22c55e;
            font-size: 1rem;
        }

        .sidebar .small.text-muted {
            color: #6b7280 !important;
            font-weight: 500;
        }

        .sidebar .badge {
            background: linear-gradient(135deg, #22c55e 0%, #84cc16 100%);
            color: white;
            font-weight: 700;
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(34, 197, 94, 0.2);
        }

        .sidebar .btn {
            font-weight: 700;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            white-space: normal;
            overflow-wrap: anywhere;
        }

        .sidebar .btn-outline-secondary {
            color: #16a34a;
            border: 2px solid #16a34a;
        }

        .sidebar .btn-outline-secondary:hover {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            border-color: #22c55e;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(34, 197, 94, 0.3);
        }

        .sidebar .btn-outline-danger {
            color: #dc2626;
            border: 2px solid #dc2626;
        }

        .sidebar .btn-outline-danger:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(220, 38, 38, 0.3);
        }

        .main-wrapper {
            margin-left: 240px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-width: 0;
        }

        .content-area {
            padding: 1.5rem;
            flex: 1;
        }

        .topbar {
            margin: 1.25rem 1.5rem 0.75rem;
            padding: 1rem 1.25rem;
            border-radius: 16px;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
            border: 1px solid #dcfce7;
            box-shadow: 0 6px 18px rgba(34, 197, 94, 0.08);
        }

        .topbar-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #166534;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .topbar-title i {
            color: #eab308;
        }

        .topbar-date {
            background: linear-gradient(135deg, #dcfce7 0%, #fef08a 100%);
            color: #166534;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-weight: 600;
            border: 1px solid #bbf7d0;
        }

        .topbar-info {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #22c55e 0%, #84cc16 100%);
            color: white;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: help;
            position: relative;
            flex-shrink: 0;
        }

        .topbar-info .topbar-info-tooltip {
            visibility: hidden;
            opacity: 0;
            width: 220px;
            background: #14532d;
            color: white;
            text-align: left;
            border-radius: 8px;
            padding: 0.6rem 0.7rem;
            position: absolute;
            z-index: 1;
            top: 140%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.75rem;
            line-height: 1.35;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            transition: opacity 0.2s ease;
        }

        .topbar-info:hover .topbar-info-tooltip {
            visibility: visible;
            opacity: 1;
        }

        .hoverscale {
            scale: 100%;
            transition: scale 0.3s ease;
        }

        .hoverscale:hover {
            scale: 105%;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 220px;
                min-width: 220px;
            }

            .main-wrapper {
                margin-left: 220px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                min-width: 200px;
            }

            .main-wrapper {
                margin-left: 200px;
            }
        }
    </style>
</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="fw-bold text-primary" style="font-size:40px;">
                <img src="{{ asset('MB-LOGO.png') }}" alt="MB Logo" style="
                width: 100%; height: auto; object-fit: contain; margin-right: 0.5rem;">
            </div>
            <div class="text-muted text-center mt-0" style="font-size:16px;">M.B. Therapy Center</div>
        </div>

        <nav class="nav flex-column pt-2">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>

            @if(Auth::user()->hasPermission('view_user'))
            <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>User Management
            </a>
            @endif

            @if(Auth::user()->hasPermission('view_guardian'))
            <a href="{{ route('admin.guardians.index') }}"
                class="nav-link {{ request()->routeIs('admin.guardians.*') ? 'active' : '' }}">
                <i class="bi bi-person-heart me-2"></i>Guardian Management
            </a>
            @endif

            @if(Auth::user()->hasPermission('view_student'))
            <a href="{{ route('admin.students.index') }}"
                class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <i class="bi bi-mortarboard me-2"></i>Student Management
            </a>
            @endif

            @if(Auth::user()->hasPermission('view_enrollment'))
            <a href="{{ route('admin.enrollments.index') }}"
                class="nav-link {{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check me-2"></i>Enrollment Management
            </a>
            @endif

            @if(Auth::user()->hasPermission('view_audit_log'))
            <a href="{{ route('admin.audit-log.index') }}"
                class="nav-link {{ request()->routeIs('admin.audit-log.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text me-2"></i>Audit Log
            </a>
            @endif
        </nav>

        <div class="mt-auto p-3 border-top">
            <div class="small text-muted mb-1">
                <i class="bi bi-person-circle me-1"></i>
                {{ Auth::user()->full_name ?? Auth::user()->username }}
            </div>
            <div class="small text-muted mb-2">
                <span class="badge bg-secondary">{{ ucfirst(Auth::user()->role?->role_name) }}</span>
            </div>
            <a href="{{ route('admin.profile.edit') }}"
                class="btn btn-sm btn-outline-secondary w-100 mb-1">
                <i class="bi bi-gear me-1"></i>Profile Settings
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </form>
        </div>
    </div>

    <div class="parallax-bg"></div>

    {{-- Main Wrapper --}}
    <div class="main-wrapper">

        {{-- Topbar --}}
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="topbar-title">
                <i class="bi bi-grid-3x3-gap-fill"></i>
                @yield('title', 'Dashboard')
            </div>
            <div class="topbar-date">
                <i class="bi bi-calendar3 me-1"></i>
                {{ now()->format('F d, Y') }}
            </div>
        </div>

        {{-- Flash Messages --}}
        <div class="content-area">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        document.addEventListener("mousemove", (e) => {
            const {
                innerWidth,
                innerHeight
            } = window;
            const x = -(e.clientX / innerWidth + 0.5) * 30; // range -15 to +15
            const y = -(e.clientY / innerHeight + 0.5) * 30; // range -15 to +15

            document.querySelector(".parallax-bg").style.transform =
                `translate(${x}px, ${y}px)`;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
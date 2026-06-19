<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H.O.P.E. — @yield('title', 'Dashboard')</title>

    {{-- Tabler CSS (includes Bootstrap 5) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/css/tabler.min.css">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">
    {{-- AOS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    {{-- DataTables Tabler theme --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        :root {
            --hope-green:   #1B4332;
            --hope-green-2: #2D6A4F;
            --hope-green-3: #40916C;
            --hope-gold:    #EAB308;
            --hope-gold-lt: #FEF08A;
            --hope-cream:   #F5F1E8;
            --hope-sidebar-w: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--hope-cream);
        }

        h1, h2, h3, h4, h5, .page-title, .card-title {
            font-family: 'Playfair Display', serif;
        }

        /* ── Sidebar ─────────────────────────────────── */
        .navbar-vertical {
            width: var(--hope-sidebar-w) !important;
            background: var(--hope-green) !important;
            border-right: none !important;
            box-shadow: 4px 0 24px rgba(0,0,0,.18);
        }

        .navbar-vertical .navbar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .5rem;
        }

        .sidebar-hope-logo {
            width: 140px;
            height: auto;
            object-fit: contain;
        }

        .sidebar-mb-badge {
            display: flex;
            align-items: center;
            gap: .5rem;
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 8px;
            padding: .35rem .65rem;
        }

        .sidebar-mb-badge img {
            width: 22px;
            height: 22px;
            object-fit: contain;
        }

        .sidebar-mb-badge span {
            font-size: .72rem;
            font-weight: 600;
            color: rgba(255,255,255,.75);
            letter-spacing: .3px;
        }

        .navbar-vertical .nav-section-title {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(255,255,255,.4);
            padding: 1rem 1rem .3rem;
        }

        .navbar-vertical .nav-link {
            color: rgba(255,255,255,.72) !important;
            border-radius: 8px;
            margin: 1px 8px;
            padding: .6rem .85rem;
            display: flex;
            align-items: center;
            gap: .65rem;
            font-size: .875rem;
            font-weight: 500;
            transition: background .18s ease, color .18s ease;
        }

        .navbar-vertical .nav-link svg {
            width: 18px;
            height: 18px;
            stroke: rgba(255,255,255,.55);
            flex-shrink: 0;
            transition: stroke .18s ease;
        }

        .navbar-vertical .nav-link:hover {
            background: rgba(255,255,255,.1) !important;
            color: #fff !important;
        }

        .navbar-vertical .nav-link:hover svg {
            stroke: var(--hope-gold);
        }

        .navbar-vertical .nav-link.active {
            background: var(--hope-gold) !important;
            color: var(--hope-green) !important;
            font-weight: 700;
        }

        .navbar-vertical .nav-link.active svg {
            stroke: var(--hope-green);
        }

        /* Sidebar user footer */
        .sidebar-user-footer {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,.1);
            padding: 1rem 1rem .85rem;
        }

        .sidebar-user-card {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: .75rem;
        }

        .sidebar-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--hope-gold);
            color: var(--hope-green);
            font-weight: 800;
            font-size: .95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: .82rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .sidebar-user-role {
            font-size: .68rem;
            color: var(--hope-gold);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .sidebar-footer-btns {
            display: flex;
            gap: .4rem;
        }

        .sidebar-footer-btns .btn {
            flex: 1;
            font-size: .75rem;
            padding: .38rem .5rem;
            border-radius: 7px;
            font-weight: 600;
        }

        .btn-sidebar-profile {
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.2);
            color: rgba(255,255,255,.85) !important;
        }

        .btn-sidebar-profile:hover {
            background: rgba(255,255,255,.18);
            color: #fff !important;
        }

        .btn-sidebar-logout {
            background: rgba(220,38,38,.15);
            border: 1px solid rgba(220,38,38,.3);
            color: #fca5a5 !important;
        }

        .btn-sidebar-logout:hover {
            background: rgba(220,38,38,.3);
            color: #fff !important;
        }

        /* ── Page wrapper ────────────────────────────── */
        .page-wrapper {
            margin-left: var(--hope-sidebar-w) !important;
            background: var(--hope-cream);
            min-height: 100vh;
        }

        /* ── Topbar / Page header ────────────────────── */
        .page-header {
            background: #fff;
            border-bottom: 1px solid #e5e1d8;
            padding: .85rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 6px rgba(0,0,0,.06);
        }

        .page-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--hope-green);
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .page-header-title svg {
            width: 20px;
            height: 20px;
            stroke: var(--hope-gold);
        }

        .topbar-date-pill {
            background: var(--hope-green);
            color: #fff;
            font-size: .78rem;
            font-weight: 600;
            padding: .3rem .8rem;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .topbar-date-pill svg {
            width: 14px;
            height: 14px;
            stroke: var(--hope-gold);
        }

        /* ── Page body ───────────────────────────────── */
        .page-body {
            padding: 1.5rem;
        }

        /* ── Card tweaks ─────────────────────────────── */
        .card {
            border-radius: 12px;
            border: 1px solid #e8e3d8;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
        }

        /* ── Brand color utilities ───────────────────── */
        .bg-hope-green  { background-color: var(--hope-green) !important; }
        .bg-hope-gold   { background-color: var(--hope-gold) !important; }
        .text-hope-green { color: var(--hope-green) !important; }
        .text-hope-gold  { color: var(--hope-gold) !important; }
        .border-hope-green { border-color: var(--hope-green) !important; }

        /* ── Responsive ──────────────────────────────── */
        @media (max-width: 991px) {
            .navbar-vertical { width: 100% !important; position: relative; }
            .page-wrapper { margin-left: 0 !important; }
        }

        /* ── Footer ──────────────────────────────────── */
        .page-footer {
            background: var(--hope-green);
            color: rgba(255,255,255,.6);
            font-size: .75rem;
            padding: .75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .page-footer strong { color: var(--hope-gold); }

        @yield('extra-styles')
    </style>
</head>

<body>
<div class="page">

    {{-- ── Sidebar ─────────────────────────────────── --}}
    <aside class="navbar navbar-vertical navbar-expand-lg" style="position:fixed;top:0;left:0;height:100vh;overflow-y:auto;z-index:200;display:flex;flex-direction:column;">

        {{-- Brand --}}
        <div class="navbar-brand" style="flex-direction:column;gap:.6rem;">
            <img src="{{ asset('HOPE-LOGO.png') }}" alt="H.O.P.E." class="sidebar-hope-logo">
            <div class="sidebar-mb-badge">
                <img src="{{ asset('MB-LOGO.png') }}" alt="MB">
                <span>M.B. Therapy Center</span>
            </div>
        </div>

        {{-- Navigation --}}
        <nav style="flex:1;overflow-y:auto;padding-bottom:.5rem;">
            <div class="nav-section-title">Overview</div>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i data-lucide="gauge"></i>
                Dashboard
            </a>

            @if(Auth::user()->hasPermission('view_user') || Auth::user()->hasPermission('view_guardian') || Auth::user()->hasPermission('view_student'))
            <div class="nav-section-title">People</div>
            @endif

            @if(Auth::user()->hasPermission('view_user'))
            <a href="{{ route('admin.users.index') }}"
               class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i data-lucide="users"></i>
                Users
            </a>
            @endif

            @if(Auth::user()->hasPermission('view_guardian'))
            <a href="{{ route('admin.guardians.index') }}"
               class="nav-link {{ request()->routeIs('admin.guardians.*') ? 'active' : '' }}">
                <i data-lucide="heart-handshake"></i>
                Guardians
            </a>
            @endif

            @if(Auth::user()->hasPermission('view_student'))
            <a href="{{ route('admin.students.index') }}"
               class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <i data-lucide="graduation-cap"></i>
                Students
            </a>
            @endif

            @if(Auth::user()->hasPermission('view_enrollment'))
            <div class="nav-section-title">Enrollment</div>
            <a href="{{ route('admin.enrollments.index') }}"
               class="nav-link {{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
                <i data-lucide="clipboard-check"></i>
                Enrollments
            </a>
            @endif

            @if(Auth::user()->hasPermission('view_audit_log'))
            <div class="nav-section-title">System</div>
            <a href="{{ route('admin.audit-log.index') }}"
               class="nav-link {{ request()->routeIs('admin.audit-log.*') ? 'active' : '' }}">
                <i data-lucide="scroll-text"></i>
                Audit Log
            </a>
            @endif
        </nav>

        {{-- User footer --}}
        <div class="sidebar-user-footer">
            <div class="sidebar-user-card">
                <div class="sidebar-avatar">
                    {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->username, 0, 1)) }}
                </div>
                <div>
                    <div class="sidebar-user-name">
                        {{ Auth::user()->full_name ?? Auth::user()->username }}
                    </div>
                    <div class="sidebar-user-role">
                        {{ ucfirst(Auth::user()->role?->role_name) }}
                    </div>
                </div>
            </div>
            <div class="sidebar-footer-btns">
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-sidebar-profile">
                    <i data-lucide="settings" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;"></i>
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" class="flex-1" style="display:contents;">
                    @csrf
                    <button type="submit" class="btn btn-sidebar-logout flex-1">
                        <i data-lucide="log-out" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ── Page wrapper ─────────────────────────────── --}}
    <div class="page-wrapper">

        {{-- Topbar --}}
        <div class="page-header">
            <div class="page-header-title">
                <i data-lucide="layout-grid"></i>
                @yield('title', 'Dashboard')
            </div>
            <div class="topbar-date-pill">
                <i data-lucide="calendar"></i>
                {{ now()->format('F d, Y') }}
            </div>
        </div>

        {{-- Page body --}}
        <div class="page-body">
            @yield('content')
        </div>

        {{-- Footer --}}
        <footer class="page-footer">
            <span><strong>H.O.P.E.</strong> — Holistic Online Profile &amp; Enrollment System</span>
            <span>&copy; {{ date('Y') }} <strong>M.B. Therapy Center</strong>. All rights reserved.</span>
        </footer>
    </div>

</div>

{{-- jQuery (required by DataTables & Toastr) --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{-- Tabler JS (includes Bootstrap 5 bundle) --}}
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/js/tabler.min.js"></script>
{{-- Lucide Icons --}}
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
{{-- Toastr --}}
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
{{-- AOS --}}
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    // Initialise icons
    lucide.createIcons();

    // Initialise AOS
    AOS.init({ duration: 400, once: true });

    // Toastr config
    toastr.options = {
        positionClass: 'toast-top-right',
        timeOut: 4000,
        progressBar: true,
        closeButton: true,
        newestOnTop: true,
    };

    // Flash messages → Toastr
    @if(session('success'))
        toastr.success(@json(session('success')));
    @endif
    @if(session('error'))
        toastr.error(@json(session('error')));
    @endif
    @if(session('warning'))
        toastr.warning(@json(session('warning')));
    @endif
    @if(session('info'))
        toastr.info(@json(session('info')));
    @endif
</script>

@yield('scripts')
</body>
</html>

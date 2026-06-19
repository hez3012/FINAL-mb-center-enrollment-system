<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H.O.P.E. — @yield('title', 'Dashboard')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/css/tabler.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        /* ── Design tokens ───────────────────────────── */
        :root {
            --g:   #1B4332;
            --g2:  #2D6A4F;
            --gd:  #122e23;
            --go:  rgba(27,67,50,.08);
            --gld: #EAB308;
            --bg:  #F1F5F9;
            --bdr: #E2E8F0;
            --txt: #0F172A;
            --txt2:#64748B;
            --sw:  240px;
        }

        /* ── Base ───────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }
        html { font-size: 14px; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--txt);
            line-height: 1.55;
        }
        h1,h2,h3,h4,h5,h6,.card-title,.page-title {
            font-family: 'Inter', sans-serif;
        }
        a { color: var(--g); }

        /* ── Sidebar ─────────────────────────────────── */
        .s-bar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sw);
            height: 100vh;
            background: var(--g);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            z-index: 200;
            box-shadow: 2px 0 16px rgba(0,0,0,.18);
        }

        /* Brand block */
        .s-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 1.2rem 1rem .85rem;
        }
        .s-brand img.s-logo {
            width: 120px;
            height: auto;
            object-fit: contain;
        }
        .s-brand .s-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.14);
            border-radius: 6px;
            padding: .25rem .6rem;
            margin-top: .5rem;
        }
        .s-brand .s-badge img { width: 18px; height: 18px; object-fit: contain; }
        .s-brand .s-badge span { font-size: .7rem; font-weight: 600; color: rgba(255,255,255,.7); letter-spacing: .2px; }

        /* Full-width divider */
        .s-divider {
            height: 1px;
            background: rgba(255,255,255,.1);
            margin: 0;
            flex-shrink: 0;
        }

        /* Nav scroll area */
        .s-nav {
            flex: 1;
            overflow-y: auto;
            padding: .5rem 0 .5rem;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,.12) transparent;
        }
        .s-nav::-webkit-scrollbar { width: 3px; }
        .s-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.12); border-radius: 99px; }

        .s-section {
            font-size: .67rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(255,255,255,.35);
            padding: .9rem 1rem .25rem;
        }

        .s-link {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin: 1px .6rem;
            padding: .55rem .8rem;
            border-radius: 7px;
            color: rgba(255,255,255,.68) !important;
            font-size: .84rem;
            font-weight: 500;
            text-decoration: none !important;
            transition: background .15s, color .15s;
        }
        .s-link svg { width: 16px; height: 16px; stroke: rgba(255,255,255,.45); flex-shrink: 0; transition: stroke .15s; }
        .s-link:hover { background: rgba(255,255,255,.09); color: #fff !important; }
        .s-link:hover svg { stroke: var(--gld); }
        .s-link.active { background: var(--gld) !important; color: var(--g) !important; font-weight: 700; }
        .s-link.active svg { stroke: var(--g); }

        /* Sidebar user footer */
        .s-footer {
            flex-shrink: 0;
            border-top: 1px solid rgba(255,255,255,.1);
            padding: .85rem .9rem .8rem;
        }
        .s-user { display: flex; align-items: center; gap: .65rem; margin-bottom: .6rem; }
        .s-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--gld); color: var(--g);
            font-weight: 800; font-size: .9rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .s-name { font-size: .8rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 130px; }
        .s-role { font-size: .67rem; color: var(--gld); font-weight: 700; text-transform: uppercase; letter-spacing: .4px; }
        .s-btns { display: flex; gap: .4rem; }
        .s-btns .btn { flex: 1; font-size: .73rem; padding: .35rem .4rem; border-radius: 6px; font-weight: 600; }
        .btn-sp { background: rgba(255,255,255,.09); border: 1px solid rgba(255,255,255,.18); color: rgba(255,255,255,.82) !important; }
        .btn-sp:hover { background: rgba(255,255,255,.16); color: #fff !important; }
        .btn-sl { background: rgba(220,38,38,.13); border: 1px solid rgba(220,38,38,.28); color: #fca5a5 !important; }
        .btn-sl:hover { background: rgba(220,38,38,.28); color: #fff !important; }

        /* ── Page wrapper ────────────────────────────── */
        .pw { margin-left: var(--sw); min-height: 100vh; display: flex; flex-direction: column; }

        /* ── Topbar ──────────────────────────────────── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--bdr);
            padding: 0 1.5rem;
            height: 56px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 1px 4px rgba(0,0,0,.05);
            flex-shrink: 0;
        }
        .topbar-title {
            font-size: .95rem; font-weight: 700; color: var(--txt);
            display: flex; align-items: center; gap: .45rem;
        }
        .topbar-title svg { width: 17px; height: 17px; stroke: var(--g); }
        .topbar-date {
            font-size: .78rem; font-weight: 600; color: var(--txt2);
            display: flex; align-items: center; gap: .35rem;
        }
        .topbar-date svg { width: 13px; height: 13px; stroke: var(--gld); }

        /* ── Content ─────────────────────────────────── */
        .p-body { padding: 1.4rem 1.5rem; flex: 1; }

        /* ── Cards ───────────────────────────────────── */
        .card {
            border-radius: 10px;
            border: 1px solid var(--bdr);
            box-shadow: 0 1px 4px rgba(0,0,0,.05);
            background: #fff;
        }
        .card-header { background: #fff; border-bottom: 1px solid var(--bdr); padding: .85rem 1.1rem; font-weight: 600; font-size: .875rem; }

        /* ── Tables ──────────────────────────────────── */
        .table { font-size: 13.5px; margin-bottom: 0; color: var(--txt); }
        .table thead th {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: .85rem 1rem;
            white-space: nowrap;
            vertical-align: middle;
            border-bottom: none;
            color: var(--gld);
            background: var(--g);
        }
        .table tbody td { padding: .7rem 1rem; vertical-align: middle; border-color: #F1F5F9; }
        .table tbody tr { border-color: #F1F5F9; }
        .table-hover tbody tr:hover { background: #F8FAFC; }
        .table-scroll-wrap {
            overflow-y: auto;
            max-height: 62vh;
        }
        .table-scroll-wrap thead th { position: sticky; top: 0; z-index: 2; }

        /* ── Badges ──────────────────────────────────── */
        .badge { font-size: 11.5px; padding: .3em .65em; font-weight: 600; letter-spacing: .02em; }

        /* ── Filter bar ──────────────────────────────── */
        .filter-bar {
            background: #fff;
            border: 1px solid var(--bdr);
            border-radius: 10px;
            padding: .85rem 1.1rem;
            margin-bottom: 1rem;
        }
        .filter-bar .form-control,
        .filter-bar .form-select {
            font-size: 13.5px;
            height: 38px;
            border-color: var(--bdr);
            color: var(--txt);
        }
        .filter-bar .form-control:focus,
        .filter-bar .form-select:focus {
            border-color: var(--g);
            box-shadow: 0 0 0 2px rgba(27,67,50,.08);
        }

        /* ── Page-level action buttons ───────────────── */
        .btn-primary-app {
            background: var(--g);
            color: #fff !important;
            font-weight: 600;
            font-size: .84rem;
            padding: .5rem 1.1rem;
            border-radius: 7px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            text-decoration: none;
            transition: background .15s, box-shadow .15s;
        }
        .btn-primary-app:hover { background: var(--gd); box-shadow: 0 4px 14px rgba(27,67,50,.25); }
        .btn-primary-app svg { width: 15px; height: 15px; }

        /* ── Row action buttons ───────────────────────── */
        .btn-act {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .3rem .65rem;
            font-size: .78rem; font-weight: 600;
            border-radius: 5px;
            white-space: nowrap;
            text-decoration: none;
            transition: .15s;
            border-width: 1px;
            border-style: solid;
        }
        .btn-act svg { width: 13px; height: 13px; }
        .btn-act-view  { color: #0369a1; border-color: #bae6fd; background: #f0f9ff; }
        .btn-act-view:hover  { background: #0369a1; color: #fff; border-color: #0369a1; }
        .btn-act-edit  { color: #1d4ed8; border-color: #bfdbfe; background: #eff6ff; }
        .btn-act-edit:hover  { background: #1d4ed8; color: #fff; border-color: #1d4ed8; }
        .btn-act-warn  { color: #b45309; border-color: #fde68a; background: #fffbeb; }
        .btn-act-warn:hover  { background: #b45309; color: #fff; border-color: #b45309; }
        .btn-act-ok    { color: #166534; border-color: #bbf7d0; background: #f0fdf4; }
        .btn-act-ok:hover    { background: #166534; color: #fff; border-color: #166534; }
        .btn-act-del   { color: #dc2626; border-color: #fecaca; background: #fef2f2; }
        .btn-act-del:hover   { background: #dc2626; color: #fff; border-color: #dc2626; }

        /* ── Page heading row ────────────────────────── */
        .page-heading {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.1rem;
        }
        .page-heading h5 { font-size: 1.05rem; font-weight: 700; color: var(--txt); margin: 0; }

        /* ── Pagination ──────────────────────────────── */
        .pagination { font-size: 13px; gap: .2rem; flex-wrap: wrap; }
        .page-link { padding: .35rem .65rem; border-radius: 6px !important; border-color: var(--bdr); color: var(--txt); font-weight: 500; }
        .page-link:hover { background: var(--go); color: var(--g); border-color: var(--g); }
        .page-item.active .page-link { background: var(--g); border-color: var(--g); color: #fff; }

        /* ── Brand utilities ─────────────────────────── */
        .bg-hope { background: var(--g) !important; }
        .text-hope { color: var(--g) !important; }

        /* ── Footer ──────────────────────────────────── */
        .p-footer {
            background: var(--g);
            color: rgba(255,255,255,.55);
            font-size: .72rem;
            padding: .6rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .4rem;
            flex-shrink: 0;
        }
        .p-footer strong { color: var(--gld); }

        @media (max-width: 991px) {
            .s-bar { transform: translateX(-100%); }
            .pw { margin-left: 0; }
        }

        @yield('extra-styles')
    </style>
</head>
<body>

{{-- Sidebar --}}
<aside class="s-bar">
    <div class="s-brand">
        <img src="{{ asset('HOPE-LOGO.png') }}" alt="H.O.P.E." class="s-logo">
        <div class="s-badge">
            <img src="{{ asset('MB-LOGO.png') }}" alt="MB">
            <span>M.B. Therapy Center</span>
        </div>
    </div>
    <div class="s-divider"></div>

    <nav class="s-nav">
        <div class="s-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="s-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i data-lucide="layout-dashboard"></i>Dashboard
        </a>

        @if(Auth::user()->hasPermission('view_user') || Auth::user()->hasPermission('view_guardian') || Auth::user()->hasPermission('view_student'))
        <div class="s-section">People</div>
        @endif

        @if(Auth::user()->hasPermission('view_user'))
        <a href="{{ route('admin.users.index') }}" class="s-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i data-lucide="users"></i>Users
        </a>
        @endif

        @if(Auth::user()->hasPermission('view_guardian'))
        <a href="{{ route('admin.guardians.index') }}" class="s-link {{ request()->routeIs('admin.guardians.*') ? 'active' : '' }}">
            <i data-lucide="heart-handshake"></i>Guardians
        </a>
        @endif

        @if(Auth::user()->hasPermission('view_student'))
        <a href="{{ route('admin.students.index') }}" class="s-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
            <i data-lucide="graduation-cap"></i>Students
        </a>
        @endif

        @if(Auth::user()->hasPermission('view_enrollment'))
        <div class="s-section">Enrollment</div>
        <a href="{{ route('admin.enrollments.index') }}" class="s-link {{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
            <i data-lucide="clipboard-check"></i>Enrollments
        </a>
        @endif

        @if(Auth::user()->hasPermission('view_audit_log'))
        <div class="s-section">System</div>
        <a href="{{ route('admin.audit-log.index') }}" class="s-link {{ request()->routeIs('admin.audit-log.*') ? 'active' : '' }}">
            <i data-lucide="scroll-text"></i>Audit Log
        </a>
        @endif
    </nav>

    <div class="s-footer">
        <div class="s-user">
            <div class="s-avatar">{{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->username, 0, 1)) }}</div>
            <div>
                <div class="s-name">{{ Auth::user()->full_name ?? Auth::user()->username }}</div>
                <div class="s-role">{{ ucfirst(Auth::user()->role?->role_name) }}</div>
            </div>
        </div>
        <div class="s-btns">
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-sp">
                <i data-lucide="settings" style="width:12px;height:12px;display:inline;vertical-align:text-bottom;"></i> Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display:contents;">
                @csrf
                <button type="submit" class="btn btn-sl flex-1">
                    <i data-lucide="log-out" style="width:12px;height:12px;display:inline;vertical-align:text-bottom;"></i> Logout
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Page wrapper --}}
<div class="pw">
    <div class="topbar">
        <div class="topbar-title">
            <i data-lucide="layout-grid"></i>
            @yield('title', 'Dashboard')
        </div>
        <div class="topbar-date">
            <i data-lucide="calendar-days"></i>
            {{ now()->format('F d, Y') }}
        </div>
    </div>

    <div class="p-body">
        @yield('content')
    </div>

    <footer class="p-footer">
        <span><strong>H.O.P.E.</strong> — Holistic Online Profile &amp; Enrollment System</span>
        <span>&copy; {{ date('Y') }} <strong>M.B. Therapy Center</strong>. All rights reserved.</span>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/js/tabler.min.js"></script>
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    lucide.createIcons();
    AOS.init({ duration: 350, once: true });

    toastr.options = {
        positionClass: 'toast-top-right',
        timeOut: 4000,
        progressBar: true,
        closeButton: true,
        newestOnTop: true,
    };

    @if(session('success'))  toastr.success(@json(session('success'))); @endif
    @if(session('error'))    toastr.error(@json(session('error'))); @endif
    @if(session('warning'))  toastr.warning(@json(session('warning'))); @endif
    @if(session('info'))     toastr.info(@json(session('info'))); @endif
</script>

@yield('scripts')
</body>
</html>

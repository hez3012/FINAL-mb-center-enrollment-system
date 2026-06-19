<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H.O.P.E. Portal — @yield('title', 'Dashboard')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/css/tabler.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <style>
        /* ─── Design tokens ──────────────────────────────── */
        :root {
            --g:          #1B4332;
            --g2:         #2D6A4F;
            --gd:         #122e23;
            --gld:        #EAB308;
            --gld2:       #F59E0B;
            --grad-g:     linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%);
            --grad-gold:  linear-gradient(135deg, #EAB308 0%, #F59E0B 100%);
            --bg:         #F4F6FA;
            --bdr:        #E5E9F2;
            --txt:        #0F172A;
            --txt2:       #64748B;
            --txt3:       #94A3B8;
            --sw:         240px;
            --r:          14px;
            --sh:         0 1px 6px rgba(0,0,0,.06);
            --sh2:        0 6px 20px rgba(0,0,0,.10);
        }

        /* ─── Base ───────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }
        html { font-size: 14px; }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--txt);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Inter', system-ui, sans-serif;
            font-weight: 700;
            letter-spacing: -.015em;
        }
        a { color: var(--g); text-decoration: none; }
        a:hover { text-decoration: none; }
        input, select, textarea, button {
            font-family: 'Inter', system-ui, sans-serif;
        }

        /* ─── Sidebar ────────────────────────────────────── */
        .s-bar {
            position: fixed; top: 0; left: 0;
            width: var(--sw); height: 100vh;
            background: linear-gradient(168deg, #1e5040 0%, #0d2318 100%);
            display: flex; flex-direction: column;
            overflow: hidden; z-index: 200;
            box-shadow: 4px 0 28px rgba(0,0,0,.22);
        }

        /* Brand block */
        .s-brand {
            display: flex; flex-direction: column;
            align-items: center; text-align: center;
            padding: 1.4rem 1rem 1rem;
        }
        .s-logo { width: 108px; height: auto; object-fit: contain; }
        .s-badge {
            display: inline-flex; align-items: center; gap: .4rem;
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 6px; padding: .22rem .65rem; margin-top: .5rem;
        }
        .s-badge img { width: 16px; height: 16px; object-fit: contain; }
        .s-badge span { font-size: .67rem; font-weight: 600; color: rgba(255,255,255,.56); letter-spacing: .2px; }

        /* Guardian portal tag */
        .s-portal-tag {
            background: linear-gradient(135deg, #EAB308, #F59E0B);
            color: #1B4332;
            font-size: .65rem; font-weight: 800;
            text-transform: uppercase; letter-spacing: .06em;
            padding: .18rem .6rem; border-radius: 4px;
            margin-top: .45rem; display: inline-block;
            box-shadow: 0 2px 6px rgba(234,179,8,.35);
        }

        .s-divider { height: 1px; background: rgba(255,255,255,.07); flex-shrink: 0; }

        /* Nav */
        .s-nav {
            flex: 1; overflow-y: auto; padding: .6rem 0;
            scrollbar-width: thin; scrollbar-color: rgba(255,255,255,.1) transparent;
        }
        .s-nav::-webkit-scrollbar { width: 3px; }
        .s-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 99px; }

        .s-section {
            font-size: .63rem; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: rgba(255,255,255,.26);
            padding: 1rem 1rem .3rem;
        }

        .s-link {
            display: flex; align-items: center; gap: .6rem;
            margin: 2px .65rem; padding: .58rem .85rem; border-radius: 8px;
            color: rgba(255,255,255,.56) !important;
            font-size: .83rem; font-weight: 500;
            text-decoration: none !important;
            transition: background .15s, color .15s, box-shadow .15s;
        }
        .s-link svg { width: 16px; height: 16px; stroke: rgba(255,255,255,.36); flex-shrink: 0; transition: stroke .15s; }
        .s-link:hover { background: rgba(255,255,255,.08); color: #fff !important; }
        .s-link:hover svg { stroke: var(--gld); }
        .s-link.active {
            background: linear-gradient(135deg, #EAB308 0%, #F59E0B 100%) !important;
            color: #1B4332 !important;
            font-weight: 700;
            box-shadow: 0 3px 12px rgba(234,179,8,.3);
        }
        .s-link.active svg { stroke: #1B4332 !important; }

        /* Footer */
        .s-footer { flex-shrink: 0; border-top: 1px solid rgba(255,255,255,.07); padding: .9rem .85rem; }
        .s-user { display: flex; align-items: center; gap: .65rem; margin-bottom: .65rem; }
        .s-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, #EAB308, #F59E0B);
            color: #1B4332; font-weight: 800; font-size: .95rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; box-shadow: 0 2px 8px rgba(234,179,8,.35);
        }
        .s-name { font-size: .8rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 130px; }
        .s-role { font-size: .65rem; color: var(--gld); font-weight: 700; text-transform: uppercase; letter-spacing: .4px; margin-top: 1px; }
        .s-btns { display: flex; gap: .4rem; }
        .s-btns .btn { flex: 1; font-size: .72rem; padding: .35rem .4rem; border-radius: 6px; font-weight: 600; }
        .btn-sp { background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.13); color: rgba(255,255,255,.74) !important; }
        .btn-sp:hover { background: rgba(255,255,255,.14); color: #fff !important; }
        .btn-sl { background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.22); color: #fca5a5 !important; }
        .btn-sl:hover { background: rgba(239,68,68,.24); color: #fff !important; }

        /* ─── Page wrapper ───────────────────────────────── */
        .pw { margin-left: var(--sw); min-height: 100vh; display: flex; flex-direction: column; }

        /* ─── Topbar ─────────────────────────────────────── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--bdr);
            padding: 0 1.75rem;
            height: 58px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 1px 6px rgba(0,0,0,.05);
            flex-shrink: 0;
        }
        .topbar-title {
            font-size: .95rem; font-weight: 700; color: var(--txt);
            display: flex; align-items: center; gap: .45rem;
        }
        .topbar-title svg { width: 17px; height: 17px; stroke: var(--g); }
        .topbar-date {
            font-size: .77rem; font-weight: 600; color: var(--txt2);
            display: flex; align-items: center; gap: .35rem;
            background: #F8FAFC; border: 1px solid var(--bdr);
            border-radius: 7px; padding: .28rem .75rem;
        }
        .topbar-date svg { width: 13px; height: 13px; stroke: var(--gld); }

        /* ─── Content ────────────────────────────────────── */
        .p-body { padding: 1.5rem 1.75rem; flex: 1; }

        /* ─── Cards ──────────────────────────────────────── */
        .card { border-radius: var(--r); border: 1px solid var(--bdr); box-shadow: var(--sh); background: #fff; }
        .card-header { background: #fff; border-bottom: 1px solid var(--bdr); padding: .9rem 1.2rem; font-weight: 700; font-size: .875rem; border-radius: var(--r) var(--r) 0 0; }

        /* ─── Tables ─────────────────────────────────────── */
        .table { font-size: 13.5px; margin-bottom: 0; color: var(--txt); }
        .table thead th {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .8rem 1rem;
            white-space: nowrap;
            vertical-align: middle;
            border-bottom: 2px solid var(--bdr);
            color: var(--txt3);
            background: #F8FAFC;
        }
        .table tbody td { padding: .75rem 1rem; vertical-align: middle; border-color: #EEF2F8; }
        .table-hover tbody tr:hover { background: #FAFBFD; }
        .table-scroll-wrap { overflow-y: auto; max-height: 62vh; }
        .table-scroll-wrap thead th { position: sticky; top: 0; z-index: 2; }

        /* ─── Badges ─────────────────────────────────────── */
        .badge { font-size: 11.5px; padding: .28em .75em; font-weight: 600; border-radius: 999px; letter-spacing: .02em; }

        /* Bootstrap badge color overrides — soft pastels with proper contrast */
        .badge.bg-danger    { background: #FEE2E2 !important; color: #B91C1C !important; }
        .badge.bg-primary   { background: #DBEAFE !important; color: #1E40AF !important; }
        .badge.bg-success   { background: #DCFCE7 !important; color: #166534 !important; }
        .badge.bg-info      { background: #E0F2FE !important; color: #0369A1 !important; }
        .badge.bg-secondary { background: #F1F5F9 !important; color: #475569 !important; }
        .badge.bg-warning   { background: #FEF3C7 !important; color: #92400E !important; }

        /* ─── Alert overrides ────────────────────────────── */
        .alert { border-radius: var(--r); font-size: .875rem; border-width: 1px; }
        .alert-warning  { background: #FFFBEB; border-color: #FDE68A; color: #92400E; }
        .alert-info     { background: #EFF8FF; border-color: #BAE6FD; color: #0369A1; }
        .alert-danger   { background: #FFF1F1; border-color: #FECACA; color: #B91C1C; }
        .alert-success  { background: #F0FDF4; border-color: #BBF7D0; color: #166534; }
        .alert-primary  { background: #EFF6FF; border-color: #BFDBFE; color: #1D4ED8; }
        .alert-secondary{ background: #F8FAFC; border-color: #E2E8F0; color: #475569; }

        /* ─── Global form styles ─────────────────────────── */
        .form-control, .form-select { border-radius: 8px; font-size: 13.5px; }
        .form-control:focus, .form-select:focus { border-color: var(--g); box-shadow: 0 0 0 3px rgba(27,67,50,.1); outline: none; }
        .form-label { font-weight: 600; font-size: .84rem; margin-bottom: .3rem; color: #374151; }

        /* ─── Filter bar ─────────────────────────────────── */
        .filter-bar { background: #fff; border: 1px solid var(--bdr); border-radius: var(--r); padding: .9rem 1.2rem; margin-bottom: 1rem; }
        .filter-bar .form-control,
        .filter-bar .form-select { font-size: 13.5px; height: 38px; border-color: var(--bdr); border-radius: 8px; color: var(--txt); }
        .filter-bar .form-control:focus,
        .filter-bar .form-select:focus { border-color: var(--g); box-shadow: 0 0 0 3px rgba(27,67,50,.1); }

        /* ─── Primary button ─────────────────────────────── */
        .btn-primary-app {
            background: linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%);
            color: #fff !important;
            font-weight: 600; font-size: .84rem;
            padding: .52rem 1.2rem; border-radius: 8px; border: none;
            display: inline-flex; align-items: center; gap: .4rem;
            text-decoration: none !important;
            transition: box-shadow .2s, transform .15s;
            box-shadow: 0 2px 8px rgba(27,67,50,.28);
        }
        .btn-primary-app:hover { box-shadow: 0 6px 20px rgba(27,67,50,.36); transform: translateY(-1px); color: #fff !important; }
        .btn-primary-app svg { width: 15px; height: 15px; }

        /* ─── Row action buttons ─────────────────────────── */
        .btn-act { display: inline-flex; align-items: center; gap: .3rem; padding: .28rem .62rem; font-size: .78rem; font-weight: 600; border-radius: 6px; white-space: nowrap; text-decoration: none !important; transition: .15s; border-width: 1px; border-style: solid; }
        .btn-act svg { width: 13px; height: 13px; }
        .btn-act-view  { color: #0369a1; border-color: #bae6fd; background: #f0f9ff; }
        .btn-act-view:hover  { background: #0369a1; color: #fff; border-color: #0369a1; }
        .btn-act-edit  { color: #1d4ed8; border-color: #bfdbfe; background: #eff6ff; }
        .btn-act-edit:hover  { background: #1d4ed8; color: #fff; border-color: #1d4ed8; }
        .btn-act-del   { color: #dc2626; border-color: #fecaca; background: #fef2f2; }
        .btn-act-del:hover   { background: #dc2626; color: #fff; border-color: #dc2626; }

        /* ─── Page heading ───────────────────────────────── */
        .page-heading { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
        .page-heading h5 { font-size: 1.1rem; font-weight: 700; color: var(--txt); margin: 0; }

        /* ─── Pagination ─────────────────────────────────── */
        .pagination { font-size: 13px; gap: .2rem; flex-wrap: wrap; }
        .page-link { padding: .35rem .65rem; border-radius: 7px !important; border-color: var(--bdr); color: var(--txt); font-weight: 500; }
        .page-link:hover { background: rgba(27,67,50,.06); color: var(--g); border-color: var(--g); }
        .page-item.active .page-link { background: var(--g); border-color: var(--g); color: #fff; }

        /* ─── Footer ─────────────────────────────────────── */
        .p-footer {
            background: linear-gradient(135deg, #1B4332 0%, #0f2219 100%);
            color: rgba(255,255,255,.46);
            font-size: .72rem;
            padding: .65rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: .4rem; flex-shrink: 0;
        }
        .p-footer strong { color: var(--gld); }

        /* ─── Responsive ─────────────────────────────────── */
        @media (max-width: 991px) {
            .s-bar { transform: translateX(-100%); }
            .pw { margin-left: 0; }
        }

        @yield('extra-styles')
    </style>
</head>
<body>

<aside class="s-bar">
    <div class="s-brand">
        <img src="{{ asset('HOPE-LOGO.png') }}" alt="H.O.P.E." class="s-logo">
        <div class="s-badge">
            <img src="{{ asset('MB-LOGO.png') }}" alt="MB">
            <span>M.B. Therapy Center</span>
        </div>
        <div class="s-portal-tag">Guardian Portal</div>
    </div>
    <div class="s-divider"></div>

    <nav class="s-nav">
        <div class="s-section">My Portal</div>
        <a href="{{ route('portal.dashboard') }}" class="s-link {{ request()->routeIs('portal.dashboard') ? 'active' : '' }}">
            <i data-lucide="layout-dashboard"></i>Dashboard
        </a>
        <a href="{{ route('portal.enrollments.index') }}" class="s-link {{ request()->routeIs('portal.enrollments.*') ? 'active' : '' }}">
            <i data-lucide="clipboard-check"></i>My Enrollments
        </a>
        <a href="{{ route('portal.activity.index') }}" class="s-link {{ request()->routeIs('portal.activity.*') ? 'active' : '' }}">
            <i data-lucide="history"></i>My Activity
        </a>
    </nav>

    <div class="s-footer">
        <div class="s-user">
            <div class="s-avatar">{{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->username, 0, 1)) }}</div>
            <div>
                <div class="s-name">{{ Auth::user()->full_name ?? Auth::user()->username }}</div>
                <div class="s-role">Guardian</div>
            </div>
        </div>
        <div class="s-btns">
            <a href="{{ route('portal.profile.edit') }}" class="btn btn-sp">
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
        <span><strong>H.O.P.E.</strong> — Guardian Portal</span>
        <span>&copy; {{ date('Y') }} <strong>M.B. Therapy Center</strong>. All rights reserved.</span>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta21/dist/js/tabler.min.js"></script>
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
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

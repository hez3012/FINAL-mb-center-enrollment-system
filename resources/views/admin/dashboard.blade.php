@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('extra-styles')
<style>
    /* ── KPI stat cards ──────────────────────────────── */
    .kpi {
        background: #fff;
        border: 1px solid #E5E9F2;
        border-radius: 14px;
        padding: 1.65rem 1.8rem 1.45rem;
        display: flex;
        align-items: flex-start;
        gap: 1.2rem;
        box-shadow: 0 1px 6px rgba(0,0,0,.06);
        transition: box-shadow .22s, transform .22s;
        position: relative;
        overflow: hidden;
    }
    .kpi::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: var(--kpi-bar, #E5E9F2);
        border-radius: 14px 14px 0 0;
    }
    .kpi:hover {
        box-shadow: 0 10px 32px rgba(0,0,0,.10);
        transform: translateY(-3px);
    }
    .kpi-icon {
        width: 52px; height: 52px;
        border-radius: 13px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .kpi-icon svg { width: 24px; height: 24px; stroke: #fff; }
    .kpi-icon.g  { background: linear-gradient(135deg, #1B4332, #2D6A4F); box-shadow: 0 4px 14px rgba(27,67,50,.28); }
    .kpi-icon.gd { background: linear-gradient(135deg, #C27803, #EAB308); box-shadow: 0 4px 14px rgba(194,120,3,.28); }
    .kpi-icon.b  { background: linear-gradient(135deg, #1D4ED8, #3B82F6); box-shadow: 0 4px 14px rgba(29,78,216,.28); }
    .kpi-icon.t  { background: linear-gradient(135deg, #0F766E, #14B8A6); box-shadow: 0 4px 14px rgba(15,118,110,.28); }
    .kpi-body { flex: 1; min-width: 0; }
    .kpi-val {
        font-size: 2.15rem; font-weight: 800;
        color: #0F172A; line-height: 1.1;
        margin-bottom: .15rem;
        font-variant-numeric: tabular-nums;
        letter-spacing: -.02em;
    }
    .kpi-lbl { font-size: .77rem; color: #64748B; font-weight: 500; }
    .kpi-sub {
        font-size: .71rem; font-weight: 600; margin-top: .3rem;
        display: flex; align-items: center; gap: .25rem;
    }
    .kpi-sub svg { width: 11px; height: 11px; }

    /* ── Welcome banner ──────────────────────────────── */
    .dash-banner {
        background: linear-gradient(118deg, #1B4332 0%, #295c45 55%, #3a7a5c 100%);
        border-radius: 16px;
        padding: 1.6rem 1.85rem;
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.4rem;
        box-shadow: 0 8px 28px rgba(27,67,50,.28);
        position: relative; overflow: hidden;
    }
    .dash-banner::before {
        content: '';
        position: absolute; right: -50px; top: -50px;
        width: 200px; height: 200px;
        background: rgba(255,255,255,.05);
        border-radius: 50%;
    }
    .dash-banner::after {
        content: '';
        position: absolute; right: 80px; bottom: -70px;
        width: 140px; height: 140px;
        background: rgba(234,179,8,.07);
        border-radius: 50%;
    }
    .dash-banner-left { position: relative; z-index: 1; }
    .dash-banner h2 {
        font-size: 1.35rem; font-weight: 700; color: #fff;
        margin: 0 0 .25rem; letter-spacing: -.02em;
    }
    .dash-banner p { margin: 0; color: rgba(255,255,255,.58); font-size: .83rem; }
    .dash-banner-right { text-align: right; flex-shrink: 0; position: relative; z-index: 1; }
    .role-pill {
        background: linear-gradient(135deg, #EAB308, #F59E0B);
        color: #1B4332; font-weight: 800; font-size: .68rem;
        text-transform: uppercase; letter-spacing: .5px;
        padding: .2rem .75rem; border-radius: 20px;
        display: inline-block; margin-bottom: .4rem;
        box-shadow: 0 2px 8px rgba(234,179,8,.42);
    }
    .dash-clock { font-size: .8rem; color: rgba(255,255,255,.48); font-variant-numeric: tabular-nums; }

    /* ── Chart / action panels ───────────────────────── */
    .panel {
        background: #fff;
        border: 1px solid #E5E9F2;
        border-radius: 14px;
        padding: 1.35rem 1.4rem;
        box-shadow: 0 1px 6px rgba(0,0,0,.06);
        height: 100%;
    }
    .panel-hd {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: .85rem;
        border-bottom: 1px solid #F0F4FB;
    }
    .panel-title {
        font-size: .79rem; font-weight: 700; color: #0F172A;
        display: flex; align-items: center; gap: .45rem;
        text-transform: uppercase; letter-spacing: .07em;
    }
    .panel-title svg { width: 14px; height: 14px; stroke: #1B4332; }
    .panel-opts { color: #CBD5E1; cursor: pointer; display: flex; align-items: center; }
    .panel-opts svg { width: 16px; height: 16px; }

    /* ── Quick action links ───────────────────────────── */
    .qa {
        display: flex; align-items: center; gap: .85rem;
        padding: .85rem 1rem;
        border-radius: 10px;
        border: 1px solid #E5E9F2;
        text-decoration: none !important;
        color: #0F172A;
        font-size: .83rem; font-weight: 600;
        transition: all .18s;
        background: #fff;
    }
    .qa:hover {
        background: linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%);
        color: #fff !important;
        border-color: transparent;
        box-shadow: 0 4px 16px rgba(27,67,50,.25);
        transform: translateX(3px);
    }
    .qa-ic {
        width: 36px; height: 36px;
        background: rgba(27,67,50,.07);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; transition: background .18s;
    }
    .qa-ic svg { width: 16px; height: 16px; stroke: #1B4332; transition: stroke .18s; }
    .qa:hover .qa-ic { background: rgba(255,255,255,.12); }
    .qa:hover .qa-ic svg { stroke: #EAB308; }
    .qa-chevron { margin-left: auto; opacity: 0; transition: opacity .18s; display: flex; align-items: center; }
    .qa-chevron svg { width: 14px; height: 14px; stroke: rgba(255,255,255,.65); }
    .qa:hover .qa-chevron { opacity: 1; }
</style>
@endsection

@section('content')

{{-- Welcome banner --}}
<div class="dash-banner" data-aos="fade-down">
    <div class="dash-banner-left">
        <h2>Welcome back, {{ Auth::user()->first_name }}!</h2>
        <p>Here's a live overview of M.B. Therapy Center for today.</p>
    </div>
    <div class="dash-banner-right">
        <div class="role-pill">{{ ucfirst(Auth::user()->role?->role_name) }}</div>
        <div class="dash-clock" id="liveClock"></div>
    </div>
</div>

{{-- KPI row --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="0">
        <div class="kpi" style="--kpi-bar: linear-gradient(90deg, #1B4332, #2D6A4F);">
            <div class="kpi-icon g"><i data-lucide="users"></i></div>
            <div class="kpi-body">
                @if($isTeacherOrStaff)
                <div class="kpi-val">{{ $totalEnrollees }}</div>
                <div class="kpi-lbl">Enrollees (This A.Y.)</div>
                @else
                <div class="kpi-val">{{ $totalUsers }}</div>
                <div class="kpi-lbl">Total Users</div>
                @endif
                <div class="kpi-sub" style="color:#16A34A;">
                    <i data-lucide="shield-check"></i> Active in system
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="60">
        <div class="kpi" style="--kpi-bar: linear-gradient(90deg, #C27803, #EAB308);">
            <div class="kpi-icon gd"><i data-lucide="heart-handshake"></i></div>
            <div class="kpi-body">
                <div class="kpi-val">{{ $totalGuardians }}</div>
                <div class="kpi-lbl">Total Guardians</div>
                <div class="kpi-sub" style="color:#D97706;">
                    <i data-lucide="user-check"></i> Registered families
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
        <div class="kpi" style="--kpi-bar: linear-gradient(90deg, #1D4ED8, #3B82F6);">
            <div class="kpi-icon b"><i data-lucide="graduation-cap"></i></div>
            <div class="kpi-body">
                <div class="kpi-val">{{ $totalStudents }}</div>
                <div class="kpi-lbl">Total Students</div>
                <div class="kpi-sub" style="color:#1D4ED8;">
                    <i data-lucide="users-round"></i> In the system
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="180">
        <div class="kpi" style="--kpi-bar: linear-gradient(90deg, #0F766E, #14B8A6);">
            <div class="kpi-icon t"><i data-lucide="user-check"></i></div>
            <div class="kpi-body">
                <div class="kpi-val">{{ $activeStudents }}</div>
                <div class="kpi-lbl">Active Students</div>
                <div class="kpi-sub" style="color:#0F766E;">
                    <i data-lucide="check-circle-2"></i> Currently enrolled
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Charts (wider) + Quick Actions (narrower) --}}
<div class="row g-3">

    {{-- Charts column --}}
    <div class="col-lg-8">
        <div class="row g-3 h-100">

            {{-- Student status donut --}}
            <div class="col-md-5" data-aos="fade-right">
                <div class="panel">
                    <div class="panel-hd">
                        <div class="panel-title"><i data-lucide="pie-chart"></i>Student Status</div>
                        <div class="panel-opts"><i data-lucide="more-horizontal"></i></div>
                    </div>
                    <div style="position:relative;height:180px;">
                        <canvas id="studentStatusChart"></canvas>
                    </div>
                    <div class="d-flex justify-content-center gap-4 mt-3">
                        <div class="d-flex align-items-center gap-2" style="font-size:.77rem;color:#64748B;">
                            <span style="width:10px;height:10px;border-radius:3px;background:linear-gradient(135deg,#1B4332,#2D6A4F);display:inline-block;flex-shrink:0;"></span>
                            Active ({{ $activeStudents }})
                        </div>
                        <div class="d-flex align-items-center gap-2" style="font-size:.77rem;color:#64748B;">
                            <span style="width:10px;height:10px;border-radius:3px;background:#E2E8F0;display:inline-block;flex-shrink:0;"></span>
                            Inactive ({{ $totalStudents - $activeStudents }})
                        </div>
                    </div>
                </div>
            </div>

            {{-- People overview bar --}}
            <div class="col-md-7" data-aos="fade-up">
                <div class="panel">
                    <div class="panel-hd">
                        <div class="panel-title"><i data-lucide="bar-chart-3"></i>People Overview</div>
                        <div class="panel-opts"><i data-lucide="more-horizontal"></i></div>
                    </div>
                    <div style="position:relative;height:212px;">
                        <canvas id="peopleChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Quick actions column --}}
    <div class="col-lg-4" data-aos="fade-left">
        <div class="panel">
            <div class="panel-hd">
                <div class="panel-title"><i data-lucide="zap"></i>Quick Actions</div>
            </div>
            <div class="d-flex flex-column gap-2">
                @if(Auth::user()->hasPermission('create_enrollment'))
                <a href="{{ route('admin.enrollments.create') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="clipboard-plus"></i></div>
                    <span>Add Walk-in Enrollment</span>
                    <span class="qa-chevron"><i data-lucide="arrow-right"></i></span>
                </a>
                @endif

                @if(Auth::user()->hasPermission('create_guardian'))
                <a href="{{ route('admin.guardians.index') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="heart-handshake"></i></div>
                    <span>View Guardians</span>
                    <span class="qa-chevron"><i data-lucide="arrow-right"></i></span>
                </a>
                @endif

                @if(Auth::user()->hasPermission('create_student'))
                <a href="{{ route('admin.students.create') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="graduation-cap"></i></div>
                    <span>Add New Student</span>
                    <span class="qa-chevron"><i data-lucide="arrow-right"></i></span>
                </a>
                @endif

                @if(Auth::user()->hasPermission('view_enrollment'))
                <a href="{{ route('admin.enrollments.index') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="list-checks"></i></div>
                    <span>View All Enrollments</span>
                    <span class="qa-chevron"><i data-lucide="arrow-right"></i></span>
                </a>
                @endif

                @if(Auth::user()->hasPermission('view_user'))
                <a href="{{ route('admin.users.index') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="users"></i></div>
                    <span>Manage Users</span>
                    <span class="qa-chevron"><i data-lucide="arrow-right"></i></span>
                </a>
                @endif

                @if(Auth::user()->hasPermission('view_audit_log'))
                <a href="{{ route('admin.audit-log.index') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="scroll-text"></i></div>
                    <span>View Audit Log</span>
                    <span class="qa-chevron"><i data-lucide="arrow-right"></i></span>
                </a>
                @endif
            </div>

            <div class="mt-4 pt-3" style="border-top:1px solid #F0F4FB;text-align:center;">
                <div style="font-size:.71rem;color:#B0BBCF;font-weight:500;">
                    {{ now()->format('l, F j, Y') }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    function updateClock() {
        document.getElementById('liveClock').textContent =
            new Date().toLocaleTimeString('en-PH', {hour:'2-digit',minute:'2-digit',second:'2-digit'});
    }
    updateClock(); setInterval(updateClock, 1000);

    Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
    Chart.defaults.font.size = 12;

    /* Student status donut */
    new Chart(document.getElementById('studentStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Inactive'],
            datasets: [{
                data: [{{ $activeStudents }}, {{ $totalStudents - $activeStudents }}],
                backgroundColor: ['#1B4332', '#E2E8F0'],
                borderColor: '#fff',
                borderWidth: 3,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            var t = ctx.dataset.data.reduce(function(a,b){ return a+b; }, 0);
                            var p = t > 0 ? Math.round(ctx.parsed / t * 100) : 0;
                            return ' ' + ctx.label + ': ' + ctx.parsed + ' (' + p + '%)';
                        }
                    }
                }
            }
        }
    });

    /* People overview bar */
    new Chart(document.getElementById('peopleChart'), {
        type: 'bar',
        data: {
            labels: ['Users', 'Guardians', 'Students', 'Enrollees'],
            datasets: [{
                label: 'Count',
                data: [{{ $totalUsers }}, {{ $totalGuardians }}, {{ $totalStudents }}, {{ $totalEnrollees }}],
                backgroundColor: ['#1B4332', '#EAB308', '#3B82F6', '#14B8A6'],
                borderRadius: 8,
                borderSkipped: false,
                maxBarThickness: 48,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, color: '#94A3B8', font: { size: 11 } },
                    grid: { color: '#F1F5F9' },
                    border: { display: false }
                },
                x: {
                    ticks: { color: '#64748B', font: { size: 11, weight: '600' } },
                    grid: { display: false },
                    border: { display: false }
                }
            }
        }
    });
</script>
@endsection

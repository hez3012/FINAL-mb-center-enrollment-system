@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('extra-styles')
<style>
    /* Stat cards */
    .kpi {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 1.25rem 1.35rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        transition: box-shadow .2s, transform .2s;
        text-decoration: none;
        color: inherit;
    }
    .kpi:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,.1);
        transform: translateY(-3px);
        color: inherit;
        text-decoration: none;
    }
    .kpi-icon {
        width: 50px; height: 50px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .kpi-icon svg { width: 24px; height: 24px; }
    .kpi-icon.g  { background: rgba(27,67,50,.09); }  .kpi-icon.g  svg { stroke: #1B4332; }
    .kpi-icon.gd { background: rgba(234,179,8,.12); } .kpi-icon.gd svg { stroke: #92400e; }
    .kpi-icon.b  { background: rgba(59,130,246,.1); } .kpi-icon.b  svg { stroke: #1d4ed8; }
    .kpi-icon.t  { background: rgba(20,184,166,.1); } .kpi-icon.t  svg { stroke: #0f766e; }
    .kpi-val {
        font-size: 1.85rem; font-weight: 800; color: #0F172A;
        line-height: 1; margin-bottom: .15rem;
    }
    .kpi-lbl { font-size: .78rem; color: #64748B; font-weight: 500; }
    .kpi-sub { font-size: .72rem; color: #1B4332; font-weight: 600; margin-top: .25rem; display: flex; align-items: center; gap: .2rem; }
    .kpi-sub svg { width: 11px; height: 11px; }

    /* Chart/action panels */
    .panel {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 1.25rem 1.35rem;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        height: 100%;
    }
    .panel-title {
        font-size: .84rem; font-weight: 700; color: #0F172A;
        margin-bottom: 1.1rem;
        display: flex; align-items: center; gap: .4rem;
        text-transform: uppercase; letter-spacing: .04em;
    }
    .panel-title svg { width: 15px; height: 15px; stroke: #1B4332; }

    /* Welcome banner */
    .dash-banner {
        background: linear-gradient(120deg, #1B4332 0%, #2D6A4F 100%);
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
        box-shadow: 0 4px 18px rgba(27,67,50,.22);
    }
    .dash-banner h2 { font-size: 1.25rem; font-weight: 700; color: #fff; margin: 0 0 .2rem; }
    .dash-banner p  { margin: 0; color: rgba(255,255,255,.65); font-size: .82rem; }
    .dash-banner .role-pill {
        background: #EAB308; color: #1B4332;
        font-weight: 800; font-size: .7rem;
        text-transform: uppercase; letter-spacing: .5px;
        padding: .2rem .7rem; border-radius: 20px;
        margin-bottom: .35rem; display: inline-block;
    }
    .dash-banner .clock { font-size: .78rem; color: rgba(255,255,255,.5); }

    /* Quick actions */
    .qa {
        display: flex; align-items: center; gap: .75rem;
        padding: .75rem .9rem;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        text-decoration: none;
        color: #0F172A;
        font-size: .83rem; font-weight: 600;
        transition: all .15s;
        background: #fff;
    }
    .qa:hover { background: #1B4332; color: #fff; border-color: #1B4332; text-decoration: none; }
    .qa-ic { width: 34px; height: 34px; background: rgba(27,67,50,.07); border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background .15s; }
    .qa-ic svg { width: 16px; height: 16px; stroke: #1B4332; transition: stroke .15s; }
    .qa:hover .qa-ic { background: rgba(255,255,255,.12); }
    .qa:hover .qa-ic svg { stroke: #EAB308; }
</style>
@endsection

@section('content')

{{-- Banner --}}
<div class="dash-banner" data-aos="fade-down">
    <div>
        <h2>Welcome back, {{ Auth::user()->first_name }}!</h2>
        <p>Here's your overview for today.</p>
    </div>
    <div style="text-align:right;flex-shrink:0;">
        <div class="role-pill">{{ ucfirst(Auth::user()->role?->role_name) }}</div>
        <div class="clock" id="liveClock"></div>
    </div>
</div>

{{-- KPI row --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="0">
        <div class="kpi">
            <div class="kpi-icon g"><i data-lucide="users"></i></div>
            <div>
                @if($isTeacherOrStaff)
                <div class="kpi-val">{{ $totalEnrollees }}</div>
                <div class="kpi-lbl">Total Enrollees (This A.Y.)</div>
                @else
                <div class="kpi-val">{{ $totalUsers }}</div>
                <div class="kpi-lbl">Total Users</div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="60">
        <div class="kpi">
            <div class="kpi-icon gd"><i data-lucide="heart-handshake"></i></div>
            <div>
                <div class="kpi-val">{{ $totalGuardians }}</div>
                <div class="kpi-lbl">Total Guardians</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
        <div class="kpi">
            <div class="kpi-icon t"><i data-lucide="graduation-cap"></i></div>
            <div>
                <div class="kpi-val">{{ $totalStudents }}</div>
                <div class="kpi-lbl">Total Students</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="180">
        <div class="kpi">
            <div class="kpi-icon b"><i data-lucide="user-check"></i></div>
            <div>
                <div class="kpi-val">{{ $activeStudents }}</div>
                <div class="kpi-lbl">Active Students</div>
            </div>
        </div>
    </div>
</div>

{{-- Charts + Actions --}}
<div class="row g-3">
    <div class="col-lg-4" data-aos="fade-right">
        <div class="panel">
            <div class="panel-title"><i data-lucide="pie-chart"></i>Student Status</div>
            <div style="position:relative;height:190px;">
                <canvas id="studentStatusChart"></canvas>
            </div>
            <div class="d-flex justify-content-center gap-4 mt-3" style="font-size:.78rem;color:#64748B;">
                <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#1B4332;margin-right:5px;"></span>Active ({{ $activeStudents }})</span>
                <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#CBD5E1;margin-right:5px;"></span>Inactive ({{ $totalStudents - $activeStudents }})</span>
            </div>
        </div>
    </div>

    <div class="col-lg-4" data-aos="fade-up">
        <div class="panel">
            <div class="panel-title"><i data-lucide="bar-chart-3"></i>People Overview</div>
            <div style="position:relative;height:220px;">
                <canvas id="peopleChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4" data-aos="fade-left">
        <div class="panel">
            <div class="panel-title"><i data-lucide="zap"></i>Quick Actions</div>
            <div class="d-flex flex-column gap-2">
                @if(Auth::user()->hasPermission('create_enrollment'))
                <a href="{{ route('admin.enrollments.create') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="clipboard-plus"></i></div>Add Walk-in Enrollment
                </a>
                @endif
                @if(Auth::user()->hasPermission('create_guardian'))
                <a href="{{ route('admin.guardians.index') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="users"></i></div>View Guardians
                </a>
                @endif
                @if(Auth::user()->hasPermission('create_student'))
                <a href="{{ route('admin.students.create') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="graduation-cap"></i></div>Add Student
                </a>
                @endif
                @if(Auth::user()->hasPermission('view_enrollment'))
                <a href="{{ route('admin.enrollments.index') }}" class="qa">
                    <div class="qa-ic"><i data-lucide="list-checks"></i></div>View All Enrollments
                </a>
                @endif
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

    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.font.size = 12;

    new Chart(document.getElementById('studentStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Inactive'],
            datasets: [{
                data: [{{ $activeStudents }}, {{ $totalStudents - $activeStudents }}],
                backgroundColor: ['#1B4332', '#CBD5E1'],
                borderColor: '#fff',
                borderWidth: 3,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            var t = ctx.dataset.data.reduce((a,b)=>a+b,0);
                            var p = t > 0 ? Math.round(ctx.parsed/t*100) : 0;
                            return ' '+ctx.label+': '+ctx.parsed+' ('+p+'%)';
                        }
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('peopleChart'), {
        type: 'bar',
        data: {
            labels: ['Users','Guardians','Students','Enrollees'],
            datasets: [{
                label: 'Count',
                data: [{{ $totalUsers }}, {{ $totalGuardians }}, {{ $totalStudents }}, {{ $totalEnrollees }}],
                backgroundColor: ['#1B4332','#EAB308','#0EA5E9','#8B5CF6'],
                borderRadius: 6,
                borderSkipped: false,
                maxBarThickness: 44,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, color: '#94A3B8' },
                    grid: { color: '#F1F5F9' },
                    border: { display: false }
                },
                x: {
                    ticks: { color: '#64748B' },
                    grid: { display: false },
                    border: { display: false }
                }
            }
        }
    });
</script>
@endsection

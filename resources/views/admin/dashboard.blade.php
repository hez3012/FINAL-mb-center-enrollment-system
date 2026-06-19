@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('extra-styles')
<style>
    /* ── Stat cards ──────────────────────────────── */
    .stat-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e8e3d8;
        box-shadow: 0 2px 8px rgba(0,0,0,.05);
        padding: 1.3rem 1.4rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(27,67,50,.10);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 26px;
        height: 26px;
    }

    .stat-icon-green {
        background: rgba(27,67,50,.1);
    }

    .stat-icon-green svg { stroke: #1B4332; }

    .stat-icon-gold {
        background: rgba(234,179,8,.12);
    }

    .stat-icon-gold svg { stroke: #B45309; }

    .stat-icon-teal {
        background: rgba(20,184,166,.1);
    }

    .stat-icon-teal svg { stroke: #0F766E; }

    .stat-icon-blue {
        background: rgba(59,130,246,.1);
    }

    .stat-icon-blue svg { stroke: #1D4ED8; }

    .stat-body { flex: 1; }

    .stat-value {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: #1B4332;
        line-height: 1;
        margin-bottom: .2rem;
    }

    .stat-label {
        font-size: .8rem;
        color: #6b7280;
        font-weight: 500;
    }

    .stat-link {
        font-size: .75rem;
        font-weight: 600;
        color: #1B4332;
        display: inline-flex;
        align-items: center;
        gap: .25rem;
        margin-top: .4rem;
        text-decoration: none;
        opacity: .7;
        transition: opacity .15s;
    }

    .stat-link:hover { opacity: 1; color: #1B4332; }
    .stat-link svg { width: 13px; height: 13px; }

    /* ── Chart cards ─────────────────────────────── */
    .chart-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e8e3d8;
        box-shadow: 0 2px 8px rgba(0,0,0,.05);
        padding: 1.4rem;
    }

    .chart-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        font-weight: 700;
        color: #1B4332;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .chart-card-title svg { width: 18px; height: 18px; stroke: #EAB308; }

    /* ── Quick actions ───────────────────────────── */
    .qa-btn {
        background: #fff;
        border: 1px solid #e8e3d8;
        border-radius: 10px;
        padding: .9rem 1rem;
        display: flex;
        align-items: center;
        gap: .75rem;
        text-decoration: none;
        color: #1B4332;
        font-weight: 600;
        font-size: .85rem;
        transition: all .18s ease;
        box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }

    .qa-btn:hover {
        background: #1B4332;
        color: #fff;
        border-color: #1B4332;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(27,67,50,.2);
    }

    .qa-btn:hover svg { stroke: #EAB308; }

    .qa-icon {
        width: 38px;
        height: 38px;
        background: rgba(27,67,50,.08);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background .18s;
    }

    .qa-btn:hover .qa-icon { background: rgba(255,255,255,.12); }
    .qa-icon svg { width: 18px; height: 18px; stroke: #1B4332; }
    .qa-btn:hover .qa-icon svg { stroke: #EAB308; }

    /* ── Welcome banner ──────────────────────────── */
    .welcome-banner {
        background: linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%);
        border-radius: 14px;
        padding: 1.4rem 1.75rem;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 18px rgba(27,67,50,.22);
    }

    .welcome-banner h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        margin: 0 0 .2rem;
        color: #fff;
    }

    .welcome-banner p { margin: 0; color: rgba(255,255,255,.7); font-size: .875rem; }
    .welcome-banner-right { text-align: right; flex-shrink: 0; }
    .welcome-banner-right .role-badge {
        background: #EAB308;
        color: #1B4332;
        font-weight: 800;
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: .2rem .65rem;
        border-radius: 6px;
        display: inline-block;
        margin-bottom: .4rem;
    }

    .welcome-banner-right .time-str {
        color: rgba(255,255,255,.55);
        font-size: .78rem;
    }
</style>
@endsection

@section('content')

{{-- Welcome banner --}}
<div class="welcome-banner" data-aos="fade-down">
    <div>
        <h2>Welcome back, {{ Auth::user()->first_name }}!</h2>
        <p>Here's an overview of the H.O.P.E. enrollment system.</p>
    </div>
    <div class="welcome-banner-right">
        <div class="role-badge">{{ ucfirst(Auth::user()->role?->role_name) }}</div>
        <div class="time-str" id="liveClock"></div>
    </div>
</div>

{{-- Stat cards --}}
<div class="row g-3 mb-4">

    <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="0">
        <div class="stat-card">
            <div class="stat-icon stat-icon-green">
                <i data-lucide="users"></i>
            </div>
            <div class="stat-body">
                @if($isTeacherOrStaff)
                <div class="stat-value">{{ $totalEnrollees }}</div>
                <div class="stat-label">Total Enrollees (This A.Y.)</div>
                <a href="{{ route('admin.enrollments.index') }}" class="stat-link">
                    View <i data-lucide="arrow-right"></i>
                </a>
                @else
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-label">Total Users</div>
                <a href="{{ route('admin.users.index') }}" class="stat-link">
                    View <i data-lucide="arrow-right"></i>
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="60">
        <div class="stat-card">
            <div class="stat-icon stat-icon-gold">
                <i data-lucide="heart-handshake"></i>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ $totalGuardians }}</div>
                <div class="stat-label">Total Guardians</div>
                <a href="{{ route('admin.guardians.index') }}" class="stat-link">
                    View <i data-lucide="arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="120">
        <div class="stat-card">
            <div class="stat-icon stat-icon-teal">
                <i data-lucide="graduation-cap"></i>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ $totalStudents }}</div>
                <div class="stat-label">Total Students</div>
                <a href="{{ route('admin.students.index') }}" class="stat-link">
                    View <i data-lucide="arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="180">
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <i data-lucide="user-check"></i>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ $activeStudents }}</div>
                <div class="stat-label">Active Students</div>
                <a href="{{ route('admin.students.index') }}" class="stat-link">
                    View <i data-lucide="arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

</div>

{{-- Charts + Quick Actions row --}}
<div class="row g-3 mb-4">

    {{-- Student status donut --}}
    <div class="col-md-4" data-aos="fade-right">
        <div class="chart-card h-100">
            <div class="chart-card-title">
                <i data-lucide="pie-chart"></i>
                Student Status
            </div>
            <div style="position:relative;height:200px;">
                <canvas id="studentStatusChart"></canvas>
            </div>
            <div class="d-flex justify-content-center gap-3 mt-2" style="font-size:.78rem;">
                <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#1B4332;margin-right:4px;"></span>Active ({{ $activeStudents }})</span>
                <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#d1d5db;margin-right:4px;"></span>Inactive ({{ $totalStudents - $activeStudents }})</span>
            </div>
        </div>
    </div>

    {{-- Enrollment vs Guardians bar --}}
    <div class="col-md-4" data-aos="fade-up">
        <div class="chart-card h-100">
            <div class="chart-card-title">
                <i data-lucide="bar-chart-2"></i>
                People Overview
            </div>
            <div style="position:relative;height:200px;">
                <canvas id="peopleChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="col-md-4" data-aos="fade-left">
        <div class="chart-card h-100">
            <div class="chart-card-title">
                <i data-lucide="zap"></i>
                Quick Actions
            </div>
            <div class="d-flex flex-column gap-2">
                @if(Auth::user()->hasPermission('create_enrollment'))
                <a href="{{ route('admin.enrollments.create') }}" class="qa-btn">
                    <div class="qa-icon"><i data-lucide="clipboard-plus"></i></div>
                    Add Walk-in Enrollment
                </a>
                @endif

                @if(Auth::user()->hasPermission('create_guardian'))
                <a href="{{ route('admin.guardians.create') }}" class="qa-btn">
                    <div class="qa-icon"><i data-lucide="user-plus"></i></div>
                    Add Guardian
                </a>
                @endif

                @if(Auth::user()->hasPermission('create_student'))
                <a href="{{ route('admin.students.create') }}" class="qa-btn">
                    <div class="qa-icon"><i data-lucide="graduation-cap"></i></div>
                    Add Student
                </a>
                @endif

                @if(Auth::user()->hasPermission('view_enrollment'))
                <a href="{{ route('admin.enrollments.index') }}" class="qa-btn">
                    <div class="qa-icon"><i data-lucide="list-checks"></i></div>
                    View All Enrollments
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
    // Live clock
    function updateClock() {
        var now = new Date();
        document.getElementById('liveClock').textContent =
            now.toLocaleTimeString('en-PH', {hour:'2-digit', minute:'2-digit', second:'2-digit'});
    }
    updateClock();
    setInterval(updateClock, 1000);

    // Student status donut
    new Chart(document.getElementById('studentStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Inactive'],
            datasets: [{
                data: [{{ $activeStudents }}, {{ $totalStudents - $activeStudents }}],
                backgroundColor: ['#1B4332', '#e5e7eb'],
                borderColor: ['#fff', '#fff'],
                borderWidth: 3,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            var total = ctx.dataset.data.reduce(function(a,b){return a+b;}, 0);
                            var pct   = total > 0 ? Math.round(ctx.parsed / total * 100) : 0;
                            return ' ' + ctx.label + ': ' + ctx.parsed + ' (' + pct + '%)';
                        }
                    }
                }
            }
        }
    });

    // People overview bar
    new Chart(document.getElementById('peopleChart'), {
        type: 'bar',
        data: {
            labels: ['Users', 'Guardians', 'Students', 'Enrollees\n(This A.Y.)'],
            datasets: [{
                label: 'Count',
                data: [{{ $totalUsers }}, {{ $totalGuardians }}, {{ $totalStudents }}, {{ $totalEnrollees }}],
                backgroundColor: [
                    'rgba(27,67,50,.75)',
                    'rgba(234,179,8,.75)',
                    'rgba(20,184,166,.65)',
                    'rgba(59,130,246,.65)',
                ],
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { size: 11 } },
                    grid: { color: 'rgba(0,0,0,.05)' }
                },
                x: {
                    ticks: { font: { size: 11 } },
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endsection

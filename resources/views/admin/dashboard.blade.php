@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

<style>
    .dashboard-card {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(34, 197, 94, 0.5);
        border-radius: 16px;
        background: linear-gradient(135deg, #fffdef 0%, #f2ffec 100%);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-2px);
        filter: drop-shadow(0 10px 24px rgba(22, 163, 74, 0.12));
    }

    .dashboard-card .card-body {
        position: relative;
        z-index: 1;
    }

    .dashboard-card .icon-badge {
        width: 4rem;
        height: 4rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: inset 0 0 0 1px rgba(34, 197, 94, 0.3);
        margin-bottom: 0.75rem;
    }

    .dashboard-card .view-link {
        margin-top: 0.75rem;
        margin-left: 0.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.4rem 0.75rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #15803d;
        background: linear-gradient(135deg, #f0fdf4 0%, #fefce8 100%);
        border: 1px solid rgba(34, 197, 94, 0.35);
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .dashboard-card .view-link:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(22, 163, 74, 0.12);
        color: #166534;
    }

    .about-us-card {
        border: 1px solid rgba(34, 197, 94, 0.45);
        border-radius: 16px;
        background: linear-gradient(135deg, #fffef5 0%, #f4ffef 100%);
        box-shadow: 0 10px 24px rgba(22, 163, 74, 0.1);
    }

    .about-us-logo {
        width: 64px;
        height: 64px;
        object-fit: contain;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.8);
        padding: 0.4rem;
        box-shadow: inset 0 0 0 1px rgba(34, 197, 94, 0.2);
    }
</style>

<h5 class="fw-bold mb-4">Welcome, {{ Auth::user()->first_name }}!</h5>

<div class="row g-3">
    <div class="col-md-3">
        @if($isTeacherOrStaff)
        <div class="card dashboard-card shadow text-center py-3">
            <div class="card-body">
                <div class="icon-badge">
                    <i class="bi bi-person-check fs-2" style="color: var(--primary-green, #22c55e);"></i>
                </div>
                <h3 class="fw-bold mt-2 mb-0">{{ $totalEnrollees }}</h3>
                <small class="text-muted">Total Enrollees This A.Y.</small>
                <a href="{{ route('admin.enrollments.index') }}" class="view-link">
                    View Enrollments <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
        @else
        <div class="card dashboard-card shadow text-center py-3">
            <div class="card-body">
                <div class="icon-badge">
                    <i class="bi bi-people fs-2" style="color: var(--primary-green, #22c55e);"></i>
                </div>
                <h3 class="fw-bold mt-2 mb-0">{{ $totalUsers }}</h3>
                <small class="text-muted">Total Users</small>
                <a href="{{ route('admin.users.index') }}" class="view-link">
                    View Users <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card shadow text-center py-3">
            <div class="card-body">
                <div class="icon-badge">
                    <i class="bi bi-person-heart fs-2" style="color: var(--yellowgreen, #84cc16);"></i>
                </div>
                <h3 class="fw-bold mt-2 mb-0">{{ $totalGuardians }}</h3>
                <small class="text-muted">Total Guardians</small>
                <a href="{{ route('admin.guardians.index') }}" class="view-link">
                    View Guardians <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card shadow text-center py-3">
            <div class="card-body">
                <div class="icon-badge">
                    <i class="bi bi-mortarboard fs-2" style="color: var(--primary-yellow, #eab308);"></i>
                </div>
                <h3 class="fw-bold mt-2 mb-0">{{ $totalStudents }}</h3>
                <small class="text-muted">Total Students</small>
                <a href="{{ route('admin.students.index') }}" class="view-link">
                    View Students <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card shadow text-center py-3">
            <div class="card-body">
                <div class="icon-badge">
                    <i class="bi bi-check-circle fs-2" style="color: var(--yellowgreen, #84cc16);"></i>
                </div>
                <h3 class="fw-bold mt-2 mb-0">{{ $activeStudents }}</h3>
                <small class="text-muted">Active Students</small>
                <a href="{{ route('admin.students.index') }}" class="view-link">
                    View Active Students <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('portal.layouts.app')
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

    .portal-table-card {
        border: 1px solid rgba(34, 197, 94, 0.45);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 24px rgba(22, 163, 74, 0.1);
        background: linear-gradient(135deg, #fffef5 0%, #f4ffef 100%);
    }

    .portal-table-card .card-header {
        background: rgba(255, 255, 255, 0.8);
        border-bottom: 1px solid rgba(34, 197, 94, 0.2);
    }
</style>

<h5 class="fw-bold mb-4">Welcome, <u><a href="{{ route('portal.profile.edit') }}" class="text-decoration-none text-success fw-bold">{{ Auth::user()->first_name }}</a></u>!</h5>

@if($guardian)
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card dashboard-card shadow text-center py-3">
            <div class="card-body">
                <div class="icon-badge">
                    <i class="bi bi-mortarboard fs-2" style="color: var(--primary-green, #22c55e);"></i>
                </div>
                <h3 class="fw-bold mt-2 mb-0">{{ $students->count() }}</h3>
                <small class="text-muted">Linked Students</small>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card dashboard-card shadow text-center py-3">
            <div class="card-body">
                <div class="icon-badge">
                    <i class="bi bi-check-circle fs-2" style="color: var(--yellowgreen, #84cc16);"></i>
                </div>
                <h3 class="fw-bold mt-2 mb-0">
                    {{ $students->where('status', 'active')->count() }}
                </h3>
                <small class="text-muted">Active Students</small>
            </div>
        </div>
    </div>
</div>

@if($students->count() > 0)
<div class="card portal-table-card">
    <div class="card-header bg-white fw-semibold border-0 py-3">
        <i class="bi bi-people me-1"></i>My Students
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Full Name</th>
                    <th>Service Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->list_name }}</td>
                    <td>
                        @if($student->serviceType)
                            <span class="badge bg-info text-dark">
                                {{ $student->serviceType->service_name }}
                            </span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $sc = [
                                'active'    => 'success',
                                'inactive'  => 'secondary',
                                'withdrawn' => 'warning',
                                'completed' => 'primary',
                            ];
                        @endphp
                        <span class="badge bg-{{ $sc[$student->status] ?? 'secondary' }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@else
<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle me-1"></i>
    Your guardian profile is not fully set up yet.
    Please contact the administrator.
</div>
@endif
@endsection
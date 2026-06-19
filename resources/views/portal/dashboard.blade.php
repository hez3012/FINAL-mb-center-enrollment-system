@extends('portal.layouts.app')
@section('title', 'Dashboard')

@section('extra-styles')
<style>
    .portal-stat {
        background: #fff; border-radius: 12px; border: 1px solid var(--bdr);
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        padding: 1.25rem 1.35rem;
        display: flex; align-items: center; gap: 1rem;
        transition: box-shadow .2s, transform .2s;
    }
    .portal-stat:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.1); }
    .portal-stat-icon {
        width: 50px; height: 50px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        background: var(--go);
    }
    .portal-stat-icon svg { width: 24px; height: 24px; stroke: var(--g); }
    .portal-stat-icon.gold { background: rgba(234,179,8,.12); }
    .portal-stat-icon.gold svg { stroke: #B45309; }
    .portal-stat-value {
        font-size: 1.85rem; font-weight: 800; color: var(--txt); line-height: 1; margin-bottom: .2rem;
    }
    .portal-stat-label { font-size: .8rem; color: var(--txt2); font-weight: 500; }
    .portal-welcome {
        background: linear-gradient(120deg, #1B4332 0%, #2D6A4F 100%);
        border-radius: 12px; padding: 1.25rem 1.5rem; color: #fff;
        margin-bottom: 1.35rem; box-shadow: 0 4px 18px rgba(27,67,50,.2);
    }
    .portal-welcome h2 { font-size: 1.25rem; font-weight: 700; margin: 0 0 .2rem; color: #fff; }
    .portal-welcome p { margin: 0; color: rgba(255,255,255,.7); font-size: .875rem; }
    .portal-welcome a { color: #EAB308; font-weight: 700; text-decoration: none; }
    .portal-welcome a:hover { text-decoration: underline; }
    .students-card-header {
        background: var(--g); color: var(--gld);
        border-radius: 10px 10px 0 0; padding: .85rem 1.1rem;
        font-size: .84rem; font-weight: 700; display: flex; align-items: center; gap: .45rem;
    }
    .students-card-header svg { width: 15px; height: 15px; }
</style>
@endsection

@section('content')

{{-- Welcome banner --}}
<div class="portal-welcome" data-aos="fade-down">
    <h2>Welcome, <a href="{{ route('portal.profile.edit') }}">{{ Auth::user()->first_name }}</a>!</h2>
    <p>Manage your children's enrollment through the H.O.P.E. Guardian Portal.</p>
</div>

@if($guardian)

@php
$statusBg = [
    'pending'           => '#FEF3C7', 'pending_payment' => '#FFEDD5',
    'payment_confirmed' => '#E0F2FE', 'enrolled'        => '#DCFCE7',
    'completed'         => '#DBEAFE', 'withdrawn'       => '#F1F5F9',
    'rejected'          => '#FEE2E2',
];
$statusTx = [
    'pending'           => '#92400E', 'pending_payment' => '#9A3412',
    'payment_confirmed' => '#0369A1', 'enrolled'        => '#166534',
    'completed'         => '#1E40AF', 'withdrawn'       => '#64748B',
    'rejected'          => '#B91C1C',
];
@endphp

{{-- Stat cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-6" data-aos="fade-up" data-aos-delay="0">
        <div class="portal-stat">
            <div class="portal-stat-icon">
                <i data-lucide="graduation-cap"></i>
            </div>
            <div>
                <div class="portal-stat-value">{{ $students->count() }}</div>
                <div class="portal-stat-label">Linked Students</div>
            </div>
        </div>
    </div>
    <div class="col-md-6" data-aos="fade-up" data-aos-delay="60">
        <div class="portal-stat">
            <div class="portal-stat-icon gold">
                <i data-lucide="user-check"></i>
            </div>
            <div>
                <div class="portal-stat-value">{{ $students->where('status', 'active')->count() }}</div>
                <div class="portal-stat-label">Active Students</div>
            </div>
        </div>
    </div>
</div>

{{-- Students table --}}
@if($students->count() > 0)
<div class="card" data-aos="fade-up" data-aos-delay="120">
    <div class="students-card-header">
        <i data-lucide="users"></i>My Students
    </div>
    <div class="table-scroll-wrap" style="max-height:50vh;">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Service Type</th>
                    <th>Enrollment Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                @php $latestEnrollment = $student->enrollments->first(); @endphp
                <tr>
                    <td class="fw-semibold">{{ $student->list_name }}</td>
                    <td>
                        @if($student->serviceType)
                        <span class="badge" style="background:#E0F2FE;color:#0369A1;">
                            {{ $student->serviceType->service_name }}
                        </span>
                        @else
                        <span style="color:#94A3B8;">—</span>
                        @endif
                    </td>
                    <td>
                        @if($latestEnrollment)
                        <span class="badge" style="background:{{ $statusBg[$latestEnrollment->status] ?? '#F1F5F9' }};color:{{ $statusTx[$latestEnrollment->status] ?? '#64748B' }};">
                            {{ $latestEnrollment->status_label }}
                        </span>
                        @else
                        <span class="badge" style="background:#F1F5F9;color:#64748B;">No Enrollment Yet</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="card text-center py-5" data-aos="fade-up">
    <div class="card-body">
        <i data-lucide="graduation-cap" style="width:3rem;height:3rem;display:block;margin:0 auto 1rem;stroke:#CBD5E1;"></i>
        <p style="color:var(--txt2);margin-bottom:.35rem;">No students linked to your account yet.</p>
        <p style="color:var(--txt2);font-size:.82rem;margin:0;">Contact our staff to link your child's student record.</p>
    </div>
</div>
@endif

@else
<div class="alert" style="background:#FFFBEB;border:1px solid #FDE68A;color:#92400E;border-radius:8px;display:flex;align-items:center;gap:.6rem;font-size:.875rem;">
    <i data-lucide="triangle-alert" style="width:18px;height:18px;flex-shrink:0;"></i>
    <div>Your guardian profile is not fully set up yet. Please contact the administrator.</div>
</div>
@endif

@endsection

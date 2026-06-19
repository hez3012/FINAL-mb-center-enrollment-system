@extends('portal.layouts.app')
@section('title', 'Dashboard')

@section('extra-styles')
<style>
    .portal-stat {
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
    .portal-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(27,67,50,.1);
    }
    .portal-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: rgba(27,67,50,.08);
    }
    .portal-stat-icon svg { width: 26px; height: 26px; stroke: #1B4332; }
    .portal-stat-icon.gold { background: rgba(234,179,8,.12); }
    .portal-stat-icon.gold svg { stroke: #B45309; }
    .portal-stat-value {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: #1B4332;
        line-height: 1;
        margin-bottom: .2rem;
    }
    .portal-stat-label { font-size: .8rem; color: #6b7280; font-weight: 500; }
    .portal-welcome {
        background: linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%);
        border-radius: 14px;
        padding: 1.4rem 1.75rem;
        color: #fff;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 18px rgba(27,67,50,.22);
    }
    .portal-welcome h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        margin: 0 0 .25rem;
        color: #fff;
    }
    .portal-welcome p { margin: 0; color: rgba(255,255,255,.7); font-size: .875rem; }
    .portal-welcome a { color: #EAB308; font-weight: 700; text-decoration: none; }
    .portal-welcome a:hover { text-decoration: underline; }
</style>
@endsection

@section('content')

{{-- Welcome banner --}}
<div class="portal-welcome" data-aos="fade-down">
    <h2>Welcome, <a href="{{ route('portal.profile.edit') }}">{{ Auth::user()->first_name }}</a>!</h2>
    <p>Manage your children's enrollment through the H.O.P.E. Guardian Portal.</p>
</div>

@if($guardian)

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
    <div class="card-header fw-semibold py-3" style="background:#1B4332;color:#EAB308;border-radius:11px 11px 0 0;">
        <i data-lucide="users" style="width:15px;height:15px;display:inline;vertical-align:text-bottom;margin-right:.4rem;"></i>My Students
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead style="background:#f9f7f3;">
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
                            <span class="badge bg-info text-dark">
                                {{ $student->serviceType->service_name }}
                            </span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($latestEnrollment)
                        <span class="badge bg-{{ $latestEnrollment->status_badge }}">
                            {{ $latestEnrollment->status_label }}
                        </span>
                        @else
                        <span class="badge bg-secondary">No Enrollment Yet</span>
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
        <i data-lucide="graduation-cap" style="width:3rem;height:3rem;display:block;margin:0 auto 1rem;stroke:#d1cfc8;"></i>
        <p class="text-muted mb-2">No students linked to your account yet.</p>
        <p class="text-muted small mb-0">Contact our staff to link your child's student record.</p>
    </div>
</div>
@endif

@else
<div class="alert alert-warning d-flex align-items-center gap-2">
    <i data-lucide="triangle-alert" style="width:18px;height:18px;flex-shrink:0;"></i>
    <div>
        Your guardian profile is not fully set up yet.
        Please contact the administrator.
    </div>
</div>
@endif

@endsection

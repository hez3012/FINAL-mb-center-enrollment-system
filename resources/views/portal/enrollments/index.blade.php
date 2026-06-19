@extends('portal.layouts.app')
@section('title', 'My Enrollments')

@section('extra-styles')
<style>
    .enroll-section-label {
        font-size: .72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: .08em; color: var(--txt2);
        display: flex; align-items: center; gap: .4rem;
        margin: 1.25rem 0 .6rem;
    }
    .enroll-section-label svg { width: 13px; height: 13px; stroke: var(--g); }
    .enroll-card {
        background: #fff; border: 1px solid var(--bdr); border-radius: 10px;
        padding: 1.1rem 1.15rem; transition: box-shadow .15s, transform .15s;
    }
    .enroll-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,.09); transform: translateY(-2px); }
    .enroll-detail-table td { font-size: 12.5px; padding: .28rem 0; border: none; vertical-align: top; }
    .enroll-detail-table td:first-child { color: var(--txt2); width: 42%; padding-right: .75rem; white-space: nowrap; }
    .enroll-detail-table td:last-child { font-weight: 500; color: var(--txt); }
    .btn-view-enroll {
        display: flex; align-items: center; justify-content: center; gap: .4rem;
        background: var(--go); color: var(--g) !important; border: 1px solid rgba(27,67,50,.18);
        border-radius: 6px; font-size: .82rem; font-weight: 600;
        padding: .45rem .9rem; text-decoration: none !important; transition: .15s;
        margin-top: .75rem; width: 100%;
    }
    .btn-view-enroll:hover { background: var(--g); color: #fff !important; }
    .btn-view-enroll svg { width: 14px; height: 14px; }
    .empty-state { text-align: center; padding: 3.5rem 1.5rem; background: #fff; border: 1px solid var(--bdr); border-radius: 12px; }
    .empty-state svg { width: 2.5rem; height: 2.5rem; stroke: #CBD5E1; display: block; margin: 0 auto .85rem; }
    .empty-state p { color: var(--txt2); font-size: .88rem; margin: .35rem 0 0; }
</style>
@endsection

@section('content')

<div class="page-heading">
    <h5>My Enrollments</h5>
    @if($enrollments->isNotEmpty() && $hasEligibleStudents)
    <a href="{{ route('portal.enrollments.create') }}" class="btn-primary-app">
        <i data-lucide="plus-circle"></i>Submit New Enrollment
    </a>
    @endif
</div>

@if($enrollments->isEmpty())
<div class="empty-state" data-aos="fade-up">
    <i data-lucide="clipboard-x"></i>
    <p class="fw-semibold mb-1" style="color:var(--txt);font-size:.95rem;">No enrollment records yet.</p>
    @if($hasEligibleStudents)
    <p>Submit an enrollment request for your child to get started.</p>
    <a href="{{ route('portal.enrollments.create') }}" class="btn-primary-app d-inline-flex mt-3">
        <i data-lucide="plus-circle"></i>Submit New Enrollment
    </a>
    @else
    <p>All linked students are already enrolled, or no active students are linked to your account.<br>Please contact the administrator for assistance.</p>
    @endif
</div>
@else

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
$activeStatuses   = ['pending','pending_payment','payment_confirmed','enrolled'];
$activeGroup      = $enrollments->filter(fn($e) => in_array($e->status, $activeStatuses));
$withdrawnGroup   = $enrollments->filter(fn($e) => $e->status === 'withdrawn');
$rejectedGroup    = $enrollments->filter(fn($e) => $e->status === 'rejected');

$sections = [];
if ($activeGroup->isNotEmpty())    $sections[] = ['label'=>'Active Enrollments', 'icon'=>'clipboard-check', 'items'=>$activeGroup];
if ($withdrawnGroup->isNotEmpty()) $sections[] = ['label'=>'Withdrawn',          'icon'=>'clipboard-x',    'items'=>$withdrawnGroup];
if ($rejectedGroup->isNotEmpty())  $sections[] = ['label'=>'Rejected',           'icon'=>'x-circle',       'items'=>$rejectedGroup];
@endphp

@foreach($sections as $section)
<div class="enroll-section-label">
    <i data-lucide="{{ $section['icon'] }}"></i>{{ $section['label'] }}
    <span class="badge ms-1" style="background:var(--go);color:var(--g);font-size:11px;">{{ $section['items']->count() }}</span>
</div>
<div class="row g-3 mb-1">
    @foreach($section['items'] as $enrollment)
    <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 40 }}">
        <div class="enroll-card h-100">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="d-flex align-items-center gap-2">
                    @include('partials.avatar',[
                        'name'  => optional($enrollment->student)->full_name ?? '?',
                        'image' => optional($enrollment->student)->profile_picture ?? null,
                        'size'  => 36,
                    ])
                    <div>
                        <div class="fw-semibold" style="font-size:13.5px;">
                            {{ optional($enrollment->student)->full_name }}
                        </div>
                        <div style="font-size:11.5px;color:var(--txt2);">
                            {{ optional($enrollment->schoolYear)->year_label }}
                        </div>
                    </div>
                </div>
                <span class="badge" style="background:{{ $statusBg[$enrollment->status] ?? '#F1F5F9' }};color:{{ $statusTx[$enrollment->status] ?? '#64748B' }};">
                    {{ $enrollment->status_label }}
                </span>
            </div>

            <table class="enroll-detail-table w-100 mb-1">
                <tr>
                    <td>Service / Program</td>
                    <td>
                        @if(optional($enrollment->programLevel)->program_name)
                            {{ $enrollment->programLevel->program_name }}
                        @elseif($enrollment->student?->serviceType?->service_name)
                            {{ $enrollment->student->serviceType->service_name }}
                        @else —
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td>{{ $enrollment->type_label }}</td>
                </tr>
                <tr>
                    <td>Date Filed</td>
                    <td>{{ $enrollment->enrollment_date ? $enrollment->enrollment_date->format('m/d/Y') : '—' }}</td>
                </tr>
            </table>

            @if($enrollment->status === 'rejected' && $enrollment->rejection_reason)
            <div style="background:#FEF2F2;border:1px solid #FECACA;border-radius:6px;padding:.4rem .65rem;font-size:11.5px;color:#B91C1C;margin-bottom:.5rem;display:flex;align-items:flex-start;gap:.35rem;">
                <i data-lucide="x-circle" style="width:13px;height:13px;flex-shrink:0;margin-top:1px;"></i>
                {{ $enrollment->rejection_reason }}
            </div>
            @endif

            <a href="{{ route('portal.enrollments.show', $enrollment->enrollment_id) }}" class="btn-view-enroll">
                <i data-lucide="eye"></i>View Details
            </a>
        </div>
    </div>
    @endforeach
</div>
@endforeach
@endif

@endsection

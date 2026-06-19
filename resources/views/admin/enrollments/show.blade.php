@extends('admin.layouts.app')
@section('title', 'Enrollment Details')
@section('content')

@php
$student = $enrollment->student;
$isSpED = str_contains($student?->serviceType?->service_name ?? '', 'SpED');
$isOnline = $enrollment->enrollment_type === 'online';
$isPending = $enrollment->status === 'pending';
$hasPending = $isPending && $isOnline;
$hasPayment = $enrollment->payment !== null;
$canRecord = $enrollment->status === 'pending_payment'
&& !$hasPayment
&& $blockingDocs->isEmpty();
@endphp

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0">Enrollment Details</h5>
    <a href="{{ route('admin.enrollments.index') }}"
        class="btn-act btn-act-view" style="text-decoration:none;"><i data-lucide="arrow-left" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Back
    </a>
</div>

{{-- Approve / Reject for online pending — Directress and Admin only --}}
@if($hasPending && Auth::user()->hasPermission('approve_enrollment'))
    <div class="card border-warning border mb-3">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <p class="fw-semibold mb-1">
                        <i data-lucide="globe" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
                        Online Enrollment — Pending Review
                    </p>
                    <p class="text-muted small mb-0">
                        Review the student's information and documents before approving.
                    </p>
                </div>
                <div class="d-flex gap-2 flex-shrink-0">
                    <form method="POST"
                          action="{{ route('admin.enrollments.approve', ['id' => $enrollment->enrollment_id]) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-primary-app">
                            <i data-lucide="check-circle"></i>Approve
                        </button>
                    </form>
                    <button type="button" class="btn btn-danger px-4"
                            data-bs-toggle="modal" data-bs-target="#rejectModal">
                        <i data-lucide="x-circle" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Reject
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Payment action bar --}}
@if($enrollment->status === 'pending_payment' && !$hasPayment)
@if($canRecord)
<div class="alert alert-info d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
    <div>
        <i data-lucide="banknote" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
        All required documents are submitted. Ready to record payment.
    </div>
    <a href="{{ route('admin.enrollments.payment.create', ['id' => $enrollment->enrollment_id]) }}"
        class="btn-primary-app" style="text-decoration:none;">
        <i data-lucide="banknote"></i>Record Payment
    </a>
</div>
@else
<div class="alert alert-warning mb-3">
    <i data-lucide="triangle-alert" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
    <strong>Cannot record payment yet.</strong>
    The following required documents must be marked as
    <strong>Submitted</strong> first:
    <ul class="mb-0 mt-1">
        @foreach($blockingDocs as $doc)
        <li>{{ $doc->documentType?->document_name }}
            <span class="badge bg-danger ms-1">
                {{ ucfirst($doc->submission_status) }}
            </span>
        </li>
        @endforeach
    </ul>
</div>
@endif
@endif

{{-- Payment confirmed --}}
@if($hasPayment)
<div class="card border-success border mb-3">
    <div class="card-header bg-success bg-opacity-10 fw-semibold text-success">
        <i data-lucide="check-circle" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Payment Recorded
    </div>
    <div class="card-body">
        <div class="row g-2">
            <div class="col-md-3">
                <small class="text-muted d-block">Amount</small>
                <strong>₱{{ number_format($enrollment->payment->amount, 2) }}</strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Date</small>
                <strong>
                    {{ $enrollment->payment->payment_date?->format('m/d/Y') }}
                </strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Method</small>
                <strong>{{ $enrollment->payment->method_label }}</strong>
            </div>
            <div class="col-md-3">
                <small class="text-muted d-block">Recorded By</small>
                <strong>
                    {{ $enrollment->payment->recordedBy?->full_name ?? '—' }}
                </strong>
            </div>
            @if($enrollment->payment->notes)
            <div class="col-12">
                <small class="text-muted d-block">Notes</small>
                {{ $enrollment->payment->notes }}
            </div>
            @endif
        </div>
    </div>
</div>
@endif

<div class="row g-3">
    {{-- Left: Student + Enrollment Info --}}
    <div class="col-md-7">
        {{-- Student Info --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white fw-semibold">
                <i data-lucide="user" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Student Information
            </div>
            <div class="card-body">
                @if($student)
                <div class="d-flex align-items-center gap-3 mb-3">
                    @include('partials.avatar', [
                    'name' => $student->full_name,
                    'image' => $student->profile_picture,
                    'size' => 56,
                    ])
                    <div>
                        <div class="fw-bold">{{ $student->full_name }}</div>
                        <small class="text-muted">
                            {{ $student->age }} years old
                        </small>
                    </div>
                </div>
                @endif
                <table class="table table-sm mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%">Service Type</td>
                        <td>
                            <strong>
                                {{ $student?->serviceType?->service_name ?? '—' }}
                            </strong>
                        </td>
                    </tr>
                    @if($isSpED)
                    <tr>
                        <td class="text-muted">Program Level</td>
                        <td>{{ $enrollment->programLevel?->program_name ?? '—' }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="text-muted">Disability / Condition</td>
                        <td>
                            {{ $student?->disability?->disability_name ?? '—' }}
                            @if($student?->disability?->disability_name === 'Others'
                            && $student?->disability_other)
                            <span class="text-muted small">
                                — {{ $student->disability_other }}
                            </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Guardian</td>
                        <td>
                            {{ $student?->guardian?->user?->full_name ?? '—' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Enrollment Info --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white fw-semibold">
                <i data-lucide="clipboard-check" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Enrollment Information
            </div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%">School Year</td>
                        <td>{{ optional($enrollment->schoolYear)->year_label }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Type</td>
                        <td>
                            <span class="badge bg-{{ $isOnline ? 'info text-dark' : 'secondary' }}">
                                {{ $enrollment->type_label }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>
                            <span class="badge bg-{{ $enrollment->status_badge }}">
                                {{ $enrollment->status_label }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Date Filed</td>
                        <td>
                            {{ $enrollment->enrollment_date?->format('m/d/Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Waiver</td>
                        <td>
                            @if($enrollment->waiver_signed)
                            <span class="text-success">
                                <i data-lucide="check-circle" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Signed
                            </span>
                            @else
                            <span class="text-danger">
                                <i data-lucide="x-circle" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Not signed
                            </span>
                            @endif
                        </td>
                    </tr>
                    @if($enrollment->remarks)
                    <tr>
                        <td class="text-muted">Remarks</td>
                        <td>{{ $enrollment->remarks }}</td>
                    </tr>
                    @endif
                    @if($enrollment->rejection_reason)
                    <tr>
                        <td class="text-muted">Rejection Reason</td>
                        <td class="text-danger">{{ $enrollment->rejection_reason }}</td>
                    </tr>
                    @endif
                    @if($enrollment->processedBy)
                    <tr>
                        <td class="text-muted">Processed By</td>
                        <td>{{ $enrollment->processedBy->full_name }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    {{-- Right: Documents --}}
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i data-lucide="file" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Document Checklist
            </div>
            <div class="card-body p-0">
                @forelse($enrollment->documents as $doc)
                <div class="d-flex justify-content-between align-items-center
                                px-3 py-2 border-bottom">
                    <div>
                        <div class="fw-semibold small">
                            {{ optional($doc->documentType)->document_name }}
                        </div>
                        @if($doc->notes)
                        <div class="text-muted small">{{ $doc->notes }}</div>
                        @endif
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @foreach($doc->file_paths as $i => $path)
                        <a href="{{ Storage::url($path) }}"
                            target="_blank"
                            class="btn btn-sm btn-outline-secondary"
                            title="View File{{ count($doc->file_paths) > 1 ? ' ' . ($i + 1) : '' }}">
                            <i data-lucide="file" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
                            @if(count($doc->file_paths) > 1)
                            <span class="small">{{ $i + 1 }}</span>
                            @endif
                        </a>
                        @endforeach
                        @if(!$isOnline)
                                @php $dc=['submitted'=>'success','pending'=>'warning','missing'=>'danger']; @endphp
                                <span class="badge bg-{{ $dc[$doc->submission_status] ?? 'secondary' }}">
                                    {{ ucfirst($doc->submission_status) }}
                                </span>
                            @endif
                    </div>
                </div>
                @empty
                <p class="text-muted small px-3 py-2 mb-0">
                    No documents on record.
                </p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Reject Modal --}}
@if($hasPending)
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST"
                action="{{ route('admin.enrollments.reject', ['id' => $enrollment->enrollment_id]) }}">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Reject Enrollment</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label fw-semibold">
                        Rejection Reason <span class="text-danger">*</span>
                    </label>
                    <textarea name="rejection_reason" class="form-control"
                        rows="3" required
                        placeholder="Explain why the enrollment is being rejected...">
                        </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i data-lucide="x-circle" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Confirm Reject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

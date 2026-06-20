@extends('admin.layouts.app')
@section('title', 'Edit Enrollment')
@section('content')

@php
$hasPayment = $enrollment->payment !== null;
$isOnlinePending = $enrollment->status === 'pending'
&& $enrollment->enrollment_type === 'online';
$studentIsSpED = (int) $enrollment->student?->service_type_id === (int) $spedId;
// Documents are editable ONLY while the enrollment is still at "Pending Review".
// Once it moves past that stage (Pending Payment, Enrolled, Rejected, Withdrawn,
// Completed) or a payment has been recorded, the checklist becomes read-only.
$docsLocked = $enrollment->status !== 'pending' || $hasPayment;
@endphp

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0">Edit Enrollment</h5>
    <a href="{{ route('admin.enrollments.index') }}"
        class="btn-act btn-act-view" style="text-decoration:none;"><i data-lucide="arrow-left" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Back
    </a>
</div>

<div class="card border-0 shadow" style="border-radius: 14px; background: #fff;">
    <div class="card-body p-4 p-lg-5">
        <form method="POST"
            action="{{ route('admin.enrollments.update', ['id' => $enrollment->enrollment_id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Student summary (read-only) --}}
            <div class="mb-4 px-3 py-3 rounded-3" style="background:#F0FDF4; border:1px solid #BBF7D0;">
                <div class="row">
                    <div class="col-md-4">
                        <small class="d-block" style="color:#64748B; font-size:.76rem; font-weight:600; text-transform:uppercase; letter-spacing:.04em;">Student</small>
                        <strong style="color:#0F172A;">{{ optional($enrollment->student)->list_name }}</strong>
                    </div>
                    <div class="col-md-4">
                        <small class="d-block" style="color:#64748B; font-size:.76rem; font-weight:600; text-transform:uppercase; letter-spacing:.04em;">Service Type</small>
                        <strong style="color:#0F172A;">
                            {{ $enrollment->student?->serviceType?->service_name ?? '—' }}
                        </strong>
                    </div>
                    <div class="col-md-4">
                        <small class="d-block" style="color:#64748B; font-size:.76rem; font-weight:600; text-transform:uppercase; letter-spacing:.04em;">School Year</small>
                        <strong style="color:#0F172A;">{{ optional($enrollment->schoolYear)->year_label }}</strong>
                    </div>
                </div>
            </div>

            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: #fff; border-color: #e8e3d8;">
                <p class="fw-semibold small mb-3 d-flex align-items-center gap-2" style="color:#1B4332;">
                    <i data-lucide="clipboard-check" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Enrollment Details
                </p>
                <div class="row g-3 mb-0">
                    @if($studentIsSpED)
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Program Level</label>
                        <select name="program_level_id"
                            class="form-select @error('program_level_id') is-invalid @enderror"
                            required>
                            @foreach($programLevels as $level)
                            <option value="{{ $level->program_level_id }}"
                                {{ old('program_level_id', $enrollment->program_level_id) == $level->program_level_id ? 'selected' : '' }}>
                                {{ $level->program_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('program_level_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Enrollment Date</label>
                        <input type="date" name="enrollment_date"
                            class="form-control @error('enrollment_date') is-invalid @enderror"
                            value="{{ old('enrollment_date', $enrollment->enrollment_date?->format('Y-m-d')) }}"
                            required>
                        @error('enrollment_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Status</label>

                        @if($isOnlinePending)
                        <input type="hidden" name="status" value="pending">
                        <input type="text" class="form-control bg-light" readonly
                            value="Pending Review">
                        <small class="text-muted mt-1 d-block">
                            <i data-lucide="info" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
                            Use <strong>Approve / Reject</strong> on the View page.
                        </small>

                        @elseif($hasPayment)
                        <select name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required>
                            @foreach([
                            'enrolled' => 'Enrolled — Payment Confirmed',
                            'withdrawn' => 'Withdrawn',
                            'completed' => 'Completed',
                            ] as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('status', 'enrolled') === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @elseif($enrollment->enrollment_type === 'online')
                        {{-- Online approved, before payment: Pending Payment / Withdrawn only --}}
                        <select name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required>
                            @foreach([
                            'pending_payment' => 'Pending Payment',
                            'withdrawn' => 'Withdrawn',
                            ] as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('status', $enrollment->status) === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @elseif($docsLocked)
                        {{-- Walk-in, locked (docs already submitted, past Pending Review) --}}
                        <select name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required>
                            @foreach([
                            'pending_payment' => 'Pending Payment',
                            'withdrawn' => 'Withdrawn',
                            ] as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('status', $enrollment->status) === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @else
                        {{-- Walk-in, still Pending Review: document-driven dynamic status --}}
                        <select name="status" id="enrollmentStatus"
                            class="form-select @error('status') is-invalid @enderror"
                            required>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted" id="statusHint"></small>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Remarks
                            <span class="text-muted small fw-normal">(optional)</span>
                        </label>
                        <input type="text" name="remarks"
                            class="form-control @error('remarks') is-invalid @enderror"
                            value="{{ old('remarks', $enrollment->remarks) }}">
                        @error('remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6" id="rejectionReasonRow">
                        <label class="form-label fw-semibold">
                            Rejection Reason
                            <span class="text-muted small fw-normal">(if rejected)</span>
                        </label>
                        <input type="text" name="rejection_reason"
                            class="form-control @error('rejection_reason') is-invalid @enderror"
                            value="{{ old('rejection_reason', $enrollment->rejection_reason) }}">
                        @error('rejection_reason')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 d-flex align-items-center pt-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox"
                                name="waiver_signed" id="waiverSigned" value="1"
                                {{ old('waiver_signed', $enrollment->waiver_signed) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="waiverSigned">
                                Waiver Signed by Guardian
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Document Checklist --}}
            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: #fff; border-color: #e8e3d8;">
                <p class="fw-semibold small mb-3 d-flex align-items-center gap-2" style="color:#1B4332;">
                    <i data-lucide="file" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Document Checklist
                </p>

                @if($docsLocked)
                {{-- Locked: read-only document view --}}
                <div class="border rounded p-3 mb-4">
                    <p class="text-muted small mb-3">
                        <i data-lucide="lock" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
                        @if($hasPayment)
                        Documents are locked after payment is recorded.
                        @elseif($enrollment->enrollment_type === 'online')
                        Documents are locked — digital enrollment approved.
                        All files are marked as <strong>Submitted</strong>.
                        @else
                        Documents are locked — all required files were already
                        submitted and the enrollment has moved past Pending Review.
                        @endif
                    </p>
                    @foreach($documentTypes as $docType)
                    @php
                    $existing = $enrollment->documents
                    ->where('document_type_id', $docType->document_type_id)
                    ->first();
                    $dc = ['submitted'=>'success','pending'=>'warning','missing'=>'danger'];
                    $statusVal = $existing?->submission_status ?? 'missing';
                    @endphp
                    <div class="border rounded p-3 mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold small">
                                {{ $docType->document_name }}
                            </span>
                            <span class="badge bg-{{ $dc[$statusVal] ?? 'secondary' }}">
                                {{ ucfirst($statusVal) }}
                            </span>
                        </div>
                        @if($existing?->file_paths)
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach($existing->file_paths as $i => $path)
                            <a href="{{ Storage::url($path) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-secondary">
                                <i data-lucide="file" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>View File{{ count($existing->file_paths) > 1 ? ' ' . ($i + 1) : '' }}
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

                @else
                {{-- Editable documents (Pending Review only) --}}
                <div class="border rounded p-3 mb-4">
                    <p class="text-muted small mb-3">
                        Add, capture, or remove files/photos for each document.
                        Status is locked to <strong>Missing</strong> until at least one file is on record.
                    </p>
                    @foreach($documentTypes as $docType)
                    @php
                    $existing = $enrollment->documents
                    ->where('document_type_id', $docType->document_type_id)
                    ->first();
                    $existingPaths = $existing?->file_paths ?? [];
                    $hasFile = count($existingPaths) > 0;
                    $currentDocStatus = $hasFile
                    ? ($existing?->submission_status ?? 'pending')
                    : 'missing';
                    @endphp
                    <div class="border rounded p-3 mb-2 border-warning">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="fw-semibold small">
                                    {{ $docType->document_name }}
                                </span>
                                <span class="badge bg-warning text-dark ms-1"
                                    style="font-size:10px;">Required</span>
                            </div>
                            <select name="doc_status[{{ $docType->document_type_id }}]"
                                class="form-select form-select-sm doc-status-select doc-status-required"
                                data-has-file="{{ $hasFile ? '1' : '0' }}"
                                data-doc-type="{{ $docType->document_type_id }}"
                                style="width:145px;">
                                @if(!$hasFile)
                                <option value="missing" selected>Missing</option>
                                @else
                                <option value="pending"
                                    {{ $currentDocStatus === 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="submitted"
                                    {{ $currentDocStatus === 'submitted' ? 'selected' : '' }}>
                                    Submitted
                                </option>
                                @endif
                            </select>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-7">
                                {{-- Already-saved files on record --}}
                                <div id="existingDocFiles{{ $docType->document_type_id }}" class="mb-2">
                                    @foreach($existingPaths as $i => $path)
                                    <div class="d-flex align-items-center justify-content-between gap-2 border rounded px-2 py-1 mb-1"
                                        style="background:#f8f9fa;"
                                        id="existingDocRow{{ $docType->document_type_id }}_{{ $i }}">
                                        <span class="small text-truncate" style="max-width:180px;" title="{{ basename($path) }}">
                                            <i data-lucide="file" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>{{ basename($path) }}
                                        </span>
                                        <div class="d-flex gap-1 flex-shrink-0">
                                            <a href="{{ Storage::url($path) }}" target="_blank"
                                                class="btn btn-sm btn-outline-secondary py-0 px-2" title="View File">
                                                <i data-lucide="eye" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2"
                                                title="Remove File / Photo"
                                                onclick="document.getElementById('existingDocRow{{ $docType->document_type_id }}_{{ $i }}').remove(); document.getElementById('keepExistingDoc{{ $docType->document_type_id }}_{{ $i }}').remove(); refreshDocLockState({{ $docType->document_type_id }});">
                                                <i data-lucide="trash-2" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
                                            </button>
                                        </div>
                                        <input type="hidden"
                                            name="keep_existing_doc[{{ $docType->document_type_id }}][]"
                                            value="{{ $path }}"
                                            id="keepExistingDoc{{ $docType->document_type_id }}_{{ $i }}">
                                    </div>
                                    @endforeach
                                </div>

                                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                    <label for="docFile{{ $docType->document_type_id }}"
                                        class="btn btn-sm btn-outline-secondary mb-0">
                                        <i data-lucide="paperclip" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Choose File
                                    </label>
                                    <button type="button" class="btn btn-sm btn-outline-secondary mb-0"
                                        onclick="openCameraCapture(function(file){ addDocFiles({{ $docType->document_type_id }}, [file]); })">
                                        <i data-lucide="camera" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Take Photo
                                    </button>
                                    <input type="file"
                                        name="doc_file[{{ $docType->document_type_id }}][]"
                                        id="docFile{{ $docType->document_type_id }}"
                                        class="d-none"
                                        multiple
                                        data-doc-type="{{ $docType->document_type_id }}"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        onchange="addDocFiles({{ $docType->document_type_id }}, this.files)">
                                </div>
                                <div id="docFileList{{ $docType->document_type_id }}" class="mb-1"></div>
                                <small class="text-muted">PDF, JPG, PNG · Max 50MB each · Multiple files allowed</small>
                            </div>
                            <div class="col-md-5">
                                <input type="text"
                                    name="doc_notes[{{ $docType->document_type_id }}]"
                                    class="form-control form-control-sm"
                                    placeholder="Notes"
                                    value="{{ old("doc_notes.{$docType->document_type_id}", $existing?->notes) }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-primary-app">
                        <i data-lucide="save"></i>Save Changes
                    </button>
                </div>
        </form>
    </div>
</div>

<div id="edit-data"
    data-current-status="{{ $enrollment->status }}"
    data-has-payment="{{ $hasPayment ? '1' : '0' }}"></div>

<script>
    var editData = document.getElementById('edit-data').dataset;
    var currentStatus = editData.currentStatus;
    var hasPayment = editData.hasPayment === '1';

    // ── Document lock / unlock (only when not paid) ──────────────────────────────
    function lockDocSelect(select) {
        select.innerHTML = '<option value="missing">Missing</option>';
        select.value = 'missing';
        select.style.pointerEvents = 'none';
        select.style.backgroundColor = '#e9ecef';
        select.style.color = '#6c757d';
    }

    function unlockDocSelect(select) {
        var prev = select.value;
        select.innerHTML = '';
        var p = document.createElement('option');
        p.value = 'pending';
        p.textContent = 'Pending';
        var s = document.createElement('option');
        s.value = 'submitted';
        s.textContent = 'Submitted';
        select.appendChild(p);
        select.appendChild(s);
        select.value = (prev === 'submitted') ? 'submitted' : 'pending';
        select.style.pointerEvents = '';
        select.style.backgroundColor = '';
        select.style.color = '';
        if (!hasPayment) {
            updateStatusOptions();
        }
    }

    if (!hasPayment) {
        document.querySelectorAll('.doc-status-select').forEach(function(select) {
            if (select.dataset.hasFile === '0') {
                lockDocSelect(select);
            }
            select.addEventListener('change', updateStatusOptions);
        });
    }

    // ── Enrollment status (document-driven, only when before payment) ────────────
    function updateStatusOptions() {
        var enrollmentStatus = document.getElementById('enrollmentStatus');
        if (!enrollmentStatus) return;

        var required = document.querySelectorAll('.doc-status-required');
        var statuses = Array.from(required).map(function(s) {
            return s.value;
        });
        var allSubmitted = statuses.length > 0 &&
            statuses.every(function(s) {
                return s === 'submitted';
            });
        var anyMissing = statuses.some(function(s) {
            return s === 'missing';
        });

        var options, hint;

        if (allSubmitted) {
            options = [{
                    value: 'pending_payment',
                    label: 'Pending Payment'
                },
                {
                    value: 'withdrawn',
                    label: 'Withdrawn'
                },
            ];
            hint = 'All required documents submitted.';
        } else if (anyMissing) {
            options = [{
                    value: 'pending',
                    label: 'Pending Review'
                },
                {
                    value: 'rejected',
                    label: 'Rejected'
                },
                {
                    value: 'withdrawn',
                    label: 'Withdrawn'
                },
            ];
            hint = 'One or more required documents are missing.';
        } else {
            options = [{
                value: 'pending',
                label: 'Pending Review'
            }, ];
            hint = 'Set all required documents to Submitted to unlock Pending Payment.';
        }

        enrollmentStatus.innerHTML = '';
        options.forEach(function(o) {
            var el = document.createElement('option');
            el.value = o.value;
            el.textContent = o.label;
            if (currentStatus === o.value) {
                el.selected = true;
            }
            enrollmentStatus.appendChild(el);
        });

        if (!options.find(function(o) {
                return o.value === currentStatus;
            })) {
            enrollmentStatus.value = options[0].value;
        }

        var hintEl = document.getElementById('statusHint');
        if (hintEl) {
            hintEl.textContent = hint;
        }
    }

    if (!hasPayment) {
        updateStatusOptions();
    }

    // ── Rejection Reason visibility ───────────────────────────────────────────────
    var rejRow = document.getElementById('rejectionReasonRow');

    function updateRejRow(statusVal) {
        if (!rejRow) return;
        rejRow.style.display = statusVal === 'rejected' ? '' : 'none';
    }

    // For dynamic status select (before payment)
    var dynStatus = document.getElementById('enrollmentStatus');
    if (dynStatus) {
        dynStatus.addEventListener('change', function() {
            updateRejRow(this.value);
        });
    }

    // For static status select (after payment: enrolled/withdrawn/completed)
    var staticStatus = document.querySelector('select[name="status"]:not(#enrollmentStatus)');
    if (staticStatus) {
        staticStatus.addEventListener('change', function() {
            updateRejRow(this.value);
        });
    }

    // Initialize on page load
    var anyStatus = document.getElementById('enrollmentStatus') ||
        document.querySelector('select[name="status"]');
    updateRejRow(anyStatus ? anyStatus.value : '');
</script>

@include('partials.camera-capture')
@include('partials.doc-multi-file')
@endsection



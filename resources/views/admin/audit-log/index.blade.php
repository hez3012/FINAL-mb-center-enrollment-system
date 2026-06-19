@extends('admin.layouts.app')
@section('title', 'Audit Log')

@section('extra-styles')
<style>
    .pagination svg {
        width: 0.8rem !important;
        height: 0.8rem !important;
    }
    .pagination { font-size: 0.875rem; flex-wrap: wrap; }
    .pagination .page-link { padding: 0.3rem 0.6rem; }
    .nav-tabs .nav-link { color: #6b7280; font-weight: 600; }
    .nav-tabs .nav-link.active { color: #1B4332; border-bottom: 2px solid #1B4332; background: transparent; font-weight: 700; }
    .nav-tabs .nav-link:hover { color: #1B4332; }
</style>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0" style="color:var(--hope-green,#1B4332);">Audit Log</h5>
    @if($isDirectress)
    <span class="badge" style="background:#1B4332;color:#EAB308;font-weight:700;">Viewing: All Users</span>
    @elseif($isAdmin)
    <span class="badge bg-info text-dark">Viewing: All Users (except Directress)</span>
    @else
    <span class="badge bg-secondary">Viewing: Your Activity Only</span>
    @endif
</div>

<ul class="nav nav-tabs mb-3" id="auditTabs">
    <li class="nav-item">
        <a class="nav-link {{ $activeTab === 'log' ? 'active' : '' }}"
            href="{{ route('admin.audit-log.index', array_merge(request()->query(), ['tab' => 'log'])) }}">
            <i data-lucide="shield" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>Login / Logout History
            <span class="badge bg-secondary ms-1">{{ $logs->total() }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeTab === 'trail' ? 'active' : '' }}"
            href="{{ route('admin.audit-log.index', array_merge(request()->query(), ['tab' => 'trail'])) }}">
            <i data-lucide="history" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;margin-right:.3rem;"></i>Audit Trails
            <span class="badge bg-secondary ms-1">{{ $trails->total() }}</span>
        </a>
    </li>
</ul>

{{-- ── LOG TAB ─────────────────────────────────────────────────────────────── --}}
@if($activeTab === 'log')
<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET"
            action="{{ route('admin.audit-log.index') }}"
            class="row g-2 align-items-center">
            <input type="hidden" name="tab" value="log">
            <div class="col-md-4">
                <input type="text" name="log_search"
                    class="form-control form-control-sm"
                    placeholder="Search by name..."
                    value="{{ request('log_search') }}">
            </div>
            <div class="col-md-2">
                <select name="log_action" class="form-select form-select-sm">
                    <option value="">All Actions</option>
                    <option value="login" {{ request('log_action') === 'login'  ? 'selected' : '' }}>Login</option>
                    <option value="logout" {{ request('log_action') === 'logout' ? 'selected' : '' }}>Logout</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm" style="background:#1B4332;color:#fff;font-weight:600;">
                    <i data-lucide="search" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Filter
                </button>
            </div>
            @if(request('log_search') || request('log_action'))
            <div class="col-auto">
                <a href="{{ route('admin.audit-log.index', ['tab' => 'log']) }}"
                    class="btn btn-sm btn-outline-secondary">
                    <i data-lucide="x-circle" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Clear
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead style="background:#1B4332;">
                <tr>
                    <th style="color:#EAB308;">#</th>
                    <th style="color:#EAB308;">User</th>
                    <th style="color:#EAB308;">Role</th>
                    <th style="color:#EAB308;">Action</th>
                    <th style="color:#EAB308;">IP Address</th>
                    <th style="color:#EAB308;">Date</th>
                    <th style="color:#EAB308;">Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="text-muted small">{{ $log->auth_log_id }}</td>
                    <td class="fw-semibold small">{{ $log->user?->full_name ?? '—' }}</td>
                    <td>
                        <span class="badge bg-light text-dark border small">
                            {{ ucfirst($log->user?->role?->role_name ?? '—') }}
                        </span>
                    </td>
                    <td>
                        @if($log->action === 'login')
                        <span class="badge bg-success">
                            <i data-lucide="log-in" style="width:11px;height:11px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Login
                        </span>
                        @else
                        <span class="badge bg-secondary">
                            <i data-lucide="log-out" style="width:11px;height:11px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Logout
                        </span>
                        @endif
                    </td>
                    <td class="small text-muted">{{ $log->ip_address ?? '—' }}</td>
                    <td class="small text-muted">
                        {{ $log->logged_at?->format('m/d/Y') }}
                    </td>
                    <td class="small text-muted">
                        {{ $log->logged_at?->format('h:i:s A') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i data-lucide="shield" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#9ca3af;"></i>
                        No login / logout records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($logs->hasPages())
<div class="mt-3">{{ $logs->withQueryString()->links('pagination::bootstrap-5') }}</div>
@endif
@endif

{{-- ── TRAIL TAB ───────────────────────────────────────────────────────────── --}}
@if($activeTab === 'trail')
<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET"
            action="{{ route('admin.audit-log.index') }}"
            class="row g-2 align-items-center">
            <input type="hidden" name="tab" value="trail">
            <div class="col-md-3">
                <input type="text" name="trail_search"
                    class="form-control form-control-sm"
                    placeholder="Search by name or details..."
                    value="{{ request('trail_search') }}">
            </div>
            <div class="col-md-2">
                <select name="trail_action" class="form-select form-select-sm">
                    <option value="">All Actions</option>
                    @foreach(['create','update','delete','approve','reject'] as $act)
                    <option value="{{ $act }}"
                        {{ request('trail_action') === $act ? 'selected' : '' }}>
                        {{ ucfirst($act) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="trail_table" class="form-select form-select-sm">
                    <option value="">All Modules</option>
                    @foreach(['student','enrollment','users','guardian','payment'] as $tbl)
                    <option value="{{ $tbl }}"
                        {{ request('trail_table') === $tbl ? 'selected' : '' }}>
                        {{ ucfirst($tbl) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm" style="background:#1B4332;color:#fff;font-weight:600;">
                    <i data-lucide="search" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Filter
                </button>
            </div>
            @if(request('trail_search') || request('trail_action') || request('trail_table'))
            <div class="col-auto">
                <a href="{{ route('admin.audit-log.index', ['tab' => 'trail']) }}"
                    class="btn btn-sm btn-outline-secondary">
                    <i data-lucide="x-circle" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Clear
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead style="background:#1B4332;">
                <tr>
                    <th style="color:#EAB308;">#</th>
                    <th style="color:#EAB308;">User</th>
                    <th style="color:#EAB308;">Role</th>
                    <th style="color:#EAB308;">Action</th>
                    <th style="color:#EAB308;">Module</th>
                    <th style="color:#EAB308;">Details</th>
                    <th style="color:#EAB308;">Date</th>
                    <th style="color:#EAB308;">Time</th>
                </tr>
            </thead>
            <tbody>
                @php
                $actionBadge = [
                'create' => 'primary',
                'update' => 'warning',
                'delete' => 'danger',
                'approve' => 'success',
                'reject' => 'danger',
                ];
                @endphp
                @forelse($trails as $trail)
                <tr>
                    <td class="text-muted small">{{ $trail->log_id }}</td>
                    <td class="fw-semibold small">{{ $trail->user?->full_name ?? '—' }}</td>
                    <td>
                        <span class="badge bg-light text-dark border small">
                            {{ ucfirst($trail->user?->role?->role_name ?? '—') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $actionBadge[strtolower($trail->action)] ?? 'secondary' }}">
                            {{ ucfirst($trail->action) }}
                        </span>
                    </td>
                    <td class="small fw-semibold">{{ $trail->record_label }}</td>
                    <td class="small text-muted" style="max-width:280px;">
                        {{ $trail->formatted_changes }}
                    </td>
                    <td class="small text-muted">
                        {{ $trail->timestamp?->format('m/d/Y') }}
                    </td>
                    <td class="small text-muted">
                        {{ $trail->timestamp?->format('h:i:s A') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">
                        <i data-lucide="history" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#9ca3af;"></i>
                        No activity trail records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($trails->hasPages())
<div class="mt-3">{{ $trails->withQueryString()->links('pagination::bootstrap-5') }}</div>
@endif
@endif

@endsection

@extends('admin.layouts.app')
@section('title', 'Audit Log')

@section('extra-styles')
<style>
    .audit-tabs { display:flex; gap:.3rem; border-bottom:2px solid #E2E8F0; margin-bottom:1.25rem; }
    .audit-tab {
        display:inline-flex; align-items:center; gap:.45rem;
        padding:.6rem 1.1rem; font-size:.84rem; font-weight:600;
        color:#64748B; text-decoration:none;
        border-bottom:2px solid transparent; margin-bottom:-2px;
        transition:.15s;
    }
    .audit-tab:hover { color:#1B4332; text-decoration:none; }
    .audit-tab.active { color:#1B4332; border-bottom-color:#1B4332; }
    .audit-tab .tab-count {
        background:#E2E8F0; color:#374151;
        font-size:11px; font-weight:700;
        padding:.15em .5em; border-radius:20px;
    }
    .audit-tab.active .tab-count { background:#1B4332; color:#EAB308; }
</style>
@endsection

@section('content')

<div class="page-heading">
    <h5>Audit Log</h5>
    @if($isDirectress)
    <span class="badge" style="background:#1B4332;color:#EAB308;font-weight:700;font-size:12px;">Viewing: All Users</span>
    @elseif($isAdmin)
    <span class="badge" style="background:#E0F2FE;color:#0369A1;font-size:12px;font-weight:600;">Viewing: All Users (except Directress)</span>
    @else
    <span class="badge" style="background:#F1F5F9;color:#64748B;font-size:12px;font-weight:600;">Viewing: Your Activity Only</span>
    @endif
</div>

{{-- Tab nav --}}
<div class="audit-tabs">
    <a class="audit-tab {{ $activeTab === 'log' ? 'active' : '' }}"
        href="{{ route('admin.audit-log.index', array_merge(request()->query(), ['tab' => 'log'])) }}">
        <i data-lucide="shield" style="width:14px;height:14px;display:inline;"></i>
        Login / Logout History
        <span class="tab-count">{{ $logs->total() }}</span>
    </a>
    <a class="audit-tab {{ $activeTab === 'trail' ? 'active' : '' }}"
        href="{{ route('admin.audit-log.index', array_merge(request()->query(), ['tab' => 'trail'])) }}">
        <i data-lucide="history" style="width:14px;height:14px;display:inline;"></i>
        Audit Trails
        <span class="tab-count">{{ $trails->total() }}</span>
    </a>
</div>

@php
$actionBadgeBg = ['create'=>'#DBEAFE','update'=>'#FEF3C7','delete'=>'#FEE2E2','approve'=>'#DCFCE7','reject'=>'#FEE2E2'];
$actionBadgeTx = ['create'=>'#1E40AF','update'=>'#92400E','delete'=>'#B91C1C','approve'=>'#166534','reject'=>'#B91C1C'];
$roleBg = ['directress'=>'#FEE2E2','admin'=>'#DBEAFE','teacher'=>'#DCFCE7','staff'=>'#E0F2FE','guardian'=>'#F1F5F9'];
$roleTx = ['directress'=>'#B91C1C','admin'=>'#1E40AF','teacher'=>'#166534','staff'=>'#0369A1','guardian'=>'#64748B'];
@endphp

{{-- ── LOG TAB ─────────────────────────────────────────── --}}
@if($activeTab === 'log')
<div class="filter-bar">
    <form method="GET" action="{{ route('admin.audit-log.index') }}" class="row g-2 align-items-center">
        <input type="hidden" name="tab" value="log">
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text" style="background:#f8fafc;border-color:#E5E9F2;border-right:none;padding:.42rem .65rem;">
                    <i data-lucide="search" style="width:14px;height:14px;stroke:#94A3B8;"></i>
                </span>
                <input type="text" name="log_search" class="form-control" placeholder="Search by name…" value="{{ request('log_search') }}">
            </div>
        </div>
        <div class="col-md-3">
            <select name="log_action" class="form-select">
                <option value="">All Actions</option>
                <option value="login"  {{ request('log_action')==='login'  ? 'selected' : '' }}>Login</option>
                <option value="logout" {{ request('log_action')==='logout' ? 'selected' : '' }}>Logout</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn-primary-app">
                <i data-lucide="search"></i>Filter
            </button>
        </div>
        @if(request('log_search') || request('log_action'))
        <div class="col-auto">
            <a href="{{ route('admin.audit-log.index', ['tab' => 'log']) }}"
                class="btn btn-outline-secondary" style="height:38px;display:inline-flex;align-items:center;font-size:13.5px;">
                <i data-lucide="x" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.25rem;"></i>Clear
            </a>
        </div>
        @endif
    </form>
</div>

<div class="card">
    <div class="table-scroll-wrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th>IP Address</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td style="color:#94A3B8;font-size:12px;">{{ $log->auth_log_id }}</td>
                    <td class="fw-semibold">{{ $log->user?->full_name ?? '—' }}</td>
                    <td>
                        @php $rn = $log->user?->role?->role_name ?? ''; @endphp
                        <span class="badge" style="background:{{ $roleBg[$rn] ?? '#F1F5F9' }};color:{{ $roleTx[$rn] ?? '#64748B' }};">
                            {{ ucfirst($rn ?: '—') }}
                        </span>
                    </td>
                    <td>
                        @if($log->action === 'login')
                        <span class="badge" style="background:#DCFCE7;color:#166534;">
                            <i data-lucide="log-in" style="width:11px;height:11px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Login
                        </span>
                        @else
                        <span class="badge" style="background:#F1F5F9;color:#64748B;">
                            <i data-lucide="log-out" style="width:11px;height:11px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Logout
                        </span>
                        @endif
                    </td>
                    <td style="color:#64748B;font-size:12.5px;">{{ $log->ip_address ?? '—' }}</td>
                    <td style="color:#64748B;font-size:12.5px;">{{ $log->logged_at?->format('m/d/Y') }}</td>
                    <td style="color:#64748B;font-size:12.5px;">{{ $log->logged_at?->format('h:i:s A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5" style="color:#94A3B8;">
                        <i data-lucide="shield" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
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

{{-- ── TRAIL TAB ─────────────────────────────────────────── --}}
@if($activeTab === 'trail')
<div class="filter-bar">
    <form method="GET" action="{{ route('admin.audit-log.index') }}" class="row g-2 align-items-center">
        <input type="hidden" name="tab" value="trail">
        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-text" style="background:#f8fafc;border-color:#E5E9F2;border-right:none;padding:.42rem .65rem;">
                    <i data-lucide="search" style="width:14px;height:14px;stroke:#94A3B8;"></i>
                </span>
                <input type="text" name="trail_search" class="form-control" placeholder="Search by name or details…" value="{{ request('trail_search') }}">
            </div>
        </div>
        <div class="col-md-2">
            <select name="trail_action" class="form-select">
                <option value="">All Actions</option>
                @foreach(['create','update','delete','approve','reject'] as $act)
                <option value="{{ $act }}" {{ request('trail_action')===$act ? 'selected' : '' }}>{{ ucfirst($act) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="trail_table" class="form-select">
                <option value="">All Modules</option>
                @foreach(['student','enrollment','users','guardian','payment'] as $tbl)
                <option value="{{ $tbl }}" {{ request('trail_table')===$tbl ? 'selected' : '' }}>{{ ucfirst($tbl) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn-primary-app">
                <i data-lucide="search"></i>Filter
            </button>
        </div>
        @if(request('trail_search') || request('trail_action') || request('trail_table'))
        <div class="col-auto">
            <a href="{{ route('admin.audit-log.index', ['tab' => 'trail']) }}"
                class="btn btn-outline-secondary" style="height:38px;display:inline-flex;align-items:center;font-size:13.5px;">
                <i data-lucide="x" style="width:13px;height:13px;display:inline;vertical-align:text-bottom;margin-right:.25rem;"></i>Clear
            </a>
        </div>
        @endif
    </form>
</div>

<div class="card">
    <div class="table-scroll-wrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th>Module</th>
                    <th>Details</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trails as $trail)
                @php $rn = $trail->user?->role?->role_name ?? ''; $act = strtolower($trail->action); @endphp
                <tr>
                    <td style="color:#94A3B8;font-size:12px;">{{ $trail->log_id }}</td>
                    <td class="fw-semibold">{{ $trail->user?->full_name ?? '—' }}</td>
                    <td>
                        <span class="badge" style="background:{{ $roleBg[$rn] ?? '#F1F5F9' }};color:{{ $roleTx[$rn] ?? '#64748B' }};">
                            {{ ucfirst($rn ?: '—') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge" style="background:{{ $actionBadgeBg[$act] ?? '#F1F5F9' }};color:{{ $actionBadgeTx[$act] ?? '#64748B' }};">
                            {{ ucfirst($trail->action) }}
                        </span>
                    </td>
                    <td class="fw-semibold" style="font-size:12.5px;">{{ $trail->record_label }}</td>
                    <td style="max-width:260px;font-size:12px;color:#64748B;">{{ $trail->formatted_changes }}</td>
                    <td style="color:#64748B;font-size:12.5px;">{{ $trail->timestamp?->format('m/d/Y') }}</td>
                    <td style="color:#64748B;font-size:12.5px;">{{ $trail->timestamp?->format('h:i:s A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5" style="color:#94A3B8;">
                        <i data-lucide="history" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
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

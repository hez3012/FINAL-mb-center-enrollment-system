@extends('portal.layouts.app')
@section('title', 'My Activity')

@section('extra-styles')
<style>
    .audit-tabs { display:flex; gap:.3rem; border-bottom:2px solid #E2E8F0; margin-bottom:1.25rem; }
    .audit-tab {
        display:inline-flex; align-items:center; gap:.45rem;
        padding:.6rem 1.1rem; font-size:.84rem; font-weight:600;
        color:#64748B; text-decoration:none !important;
        border-bottom:2px solid transparent; margin-bottom:-2px;
        transition:.15s;
    }
    .audit-tab svg { width:14px; height:14px; }
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
    <h5>My Activity</h5>
</div>

<div class="audit-tabs">
    <a class="audit-tab {{ $activeTab === 'log' ? 'active' : '' }}"
       href="{{ route('portal.activity.index', array_merge(request()->query(), ['tab' => 'log'])) }}">
        <i data-lucide="shield"></i>Login / Logout History
        <span class="tab-count">{{ $logs->total() }}</span>
    </a>
    <a class="audit-tab {{ $activeTab === 'trail' ? 'active' : '' }}"
       href="{{ route('portal.activity.index', array_merge(request()->query(), ['tab' => 'trail'])) }}">
        <i data-lucide="history"></i>Activity Trail
        <span class="tab-count">{{ $trails->total() }}</span>
    </a>
</div>

{{-- ── LOG TAB ─────────────────────────────────────────── --}}
@if($activeTab === 'log')
<div class="card">
    <div class="table-scroll-wrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>IP Address</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>
                        @if($log->action === 'login')
                        <span class="badge" style="background:#DCFCE7;color:#166534;">
                            <i data-lucide="log-in" style="width:11px;height:11px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Logged In
                        </span>
                        @else
                        <span class="badge" style="background:#F1F5F9;color:#64748B;">
                            <i data-lucide="log-out" style="width:11px;height:11px;display:inline;vertical-align:text-bottom;margin-right:.2rem;"></i>Logged Out
                        </span>
                        @endif
                    </td>
                    <td style="color:#64748B;font-size:12.5px;">{{ $log->ip_address ?? '—' }}</td>
                    <td style="color:#64748B;font-size:12.5px;">{{ $log->logged_at?->format('m/d/Y') }}</td>
                    <td style="color:#64748B;font-size:12.5px;">{{ $log->logged_at?->format('h:i:s A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5" style="color:#94A3B8;">
                        <i data-lucide="shield" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
                        No login / logout history yet.
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
@php
$actionBadgeBg = ['create'=>'#DBEAFE','update'=>'#FEF3C7','delete'=>'#FEE2E2','approve'=>'#DCFCE7','reject'=>'#FEE2E2'];
$actionBadgeTx = ['create'=>'#1E40AF','update'=>'#92400E','delete'=>'#B91C1C','approve'=>'#166534','reject'=>'#B91C1C'];
@endphp
<div class="card">
    <div class="table-scroll-wrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Module</th>
                    <th>Details</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trails as $trail)
                @php $act = strtolower($trail->action); @endphp
                <tr>
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
                    <td colspan="5" class="text-center py-5" style="color:#94A3B8;">
                        <i data-lucide="history" style="width:2rem;height:2rem;display:block;margin:0 auto .5rem;stroke:#CBD5E1;"></i>
                        No activity recorded yet.
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

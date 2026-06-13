@extends('template.index')

@section('title', 'Log Request API')
@section('disable_scroll_reveal')
@section('css')
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/pages-theme.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="admin-page dashboard-page container-fluid">
    <div class="mb-3">
        <h4 class="mb-1">Log Request API Prediksi</h4>
        <p class="text-muted mb-0 small">Riwayat request ke ML API beserta payload, response, dan status.</p>
    </div>

    <div class="admin-stat-grid" style="grid-template-columns: repeat(3, 1fr);">
        <div class="admin-stat-card"><h3>{{ $summary['total'] }}</h3><p>Total Request</p></div>
        <div class="admin-stat-card"><h3>{{ $summary['success'] }}</h3><p>Berhasil</p></div>
        <div class="admin-stat-card"><h3>{{ $summary['failed'] }}</h3><p>Gagal · avg {{ $summary['avg_duration'] }} ms</p></div>
    </div>

    <form method="GET" class="admin-filter-bar">
        <select name="status" class="form-select form-select-sm" style="width:auto">
            <option value="">Semua Status</option>
            <option value="success" @selected(($filters['status'] ?? '') === 'success')>Sukses</option>
            <option value="failed" @selected(($filters['status'] ?? '') === 'failed')>Gagal</option>
        </select>
        <input type="text" name="q" class="form-control form-control-sm" style="width:220px" placeholder="Cari endpoint/error..." value="{{ $filters['q'] ?? '' }}">
        <button type="submit" class="btn btn-sm btn-soft-primary">Filter</button>
    </form>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>User</th>
                        <th>Endpoint</th>
                        <th>HTTP</th>
                        <th>Status</th>
                        <th>Durasi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $log->user?->name ?? '-' }}</td>
                        <td><small>{{ Str::limit($log->endpoint, 40) }}</small></td>
                        <td>{{ $log->response_status ?? '-' }}</td>
                        <td>
                            @if($log->success)
                                <span class="admin-badge-success">Sukses</span>
                            @else
                                <span class="admin-badge-danger">Gagal</span>
                            @endif
                        </td>
                        <td>{{ $log->duration_ms ?? '-' }} ms</td>
                        <td><a href="{{ route('admin.api-logs.show', $log) }}" class="btn btn-sm btn-soft-primary">Detail</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada log request API.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $logs->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection

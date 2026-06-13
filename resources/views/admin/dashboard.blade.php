@extends('template.index')

@section('title', 'Admin Panel')
@section('disable_scroll_reveal')
@section('css')
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/pages-theme.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="admin-page dashboard-page container-fluid">
    <div class="admin-hero">
        <h4><i class="fas fa-shield me-1"></i> Admin Panel</h4>
        <p>Kelola konten CMS, pantau log request API prediksi, dan statistik platform.</p>
    </div>

    <div class="admin-stat-grid">
        <div class="admin-stat-card"><h3>{{ $stats['users'] }}</h3><p>Total Pengguna</p></div>
        <div class="admin-stat-card"><h3>{{ $stats['examinations'] }}</h3><p>Total Pemeriksaan</p></div>
        <div class="admin-stat-card"><h3>{{ $stats['content_blocks'] }}</h3><p>Blok Konten CMS</p></div>
        <div class="admin-stat-card"><h3>{{ $stats['api_logs'] }}</h3><p>Log API ({{ $stats['api_success'] }} sukses / {{ $stats['api_failed'] }} gagal)</p></div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5>Menu Admin</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.content.index') }}" class="btn btn-outline-primary"><i class="fas fa-pen-to-square me-1"></i> Kelola Konten CMS</a>
                        <a href="{{ route('admin.api-logs.index') }}" class="btn btn-outline-danger"><i class="fas fa-server me-1"></i> Log Request API</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5>Log API Terbaru</h5>
                    <a href="{{ route('admin.api-logs.index') }}" class="btn btn-sm btn-soft-primary">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 admin-table">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Durasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentLogs as $log)
                            <tr>
                                <td>{{ $log->created_at->format('d/m H:i') }}</td>
                                <td>{{ $log->user?->name ?? '-' }}</td>
                                <td>
                                    @if($log->success)
                                        <span class="admin-badge-success">Sukses</span>
                                    @else
                                        <span class="admin-badge-danger">Gagal</span>
                                    @endif
                                </td>
                                <td>{{ $log->duration_ms ?? '-' }} ms</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada log API.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

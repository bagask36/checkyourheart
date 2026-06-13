@extends('template.index')

@section('title', 'Detail Log API')
@section('disable_scroll_reveal')
@section('css')
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/pages-theme.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="admin-page dashboard-page container-fluid">
    <div class="mb-3">
        <a href="{{ route('admin.api-logs.index') }}" class="text-muted small"><i class="fas fa-arrow-left me-1"></i> Kembali ke Log API</a>
        <h4 class="mt-2 mb-0">Detail Log #{{ $apiLog->id }}</h4>
    </div>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="admin-card">
                <div class="admin-card-header"><h5>Informasi Request</h5></div>
                <div class="card-body">
                    <p class="mb-2"><strong>Waktu:</strong> {{ $apiLog->created_at->format('d F Y H:i:s') }}</p>
                    <p class="mb-2"><strong>User:</strong> {{ $apiLog->user?->name ?? '-' }} ({{ $apiLog->user?->email ?? '-' }})</p>
                    <p class="mb-2"><strong>Method:</strong> {{ $apiLog->method }}</p>
                    <p class="mb-2"><strong>Endpoint:</strong><br><small>{{ $apiLog->endpoint }}</small></p>
                    <p class="mb-2"><strong>HTTP Status:</strong> {{ $apiLog->response_status ?? '-' }}</p>
                    <p class="mb-2"><strong>Durasi:</strong> {{ $apiLog->duration_ms ?? '-' }} ms</p>
                    <p class="mb-2"><strong>Status:</strong>
                        @if($apiLog->success)
                            <span class="admin-badge-success">Sukses</span>
                        @else
                            <span class="admin-badge-danger">Gagal</span>
                        @endif
                    </p>
                    @if($apiLog->examination_id)
                        <p class="mb-0"><strong>Examination ID:</strong> #{{ $apiLog->examination_id }}</p>
                    @endif
                    @if($apiLog->error_message)
                        <div class="alert alert-danger mt-3 mb-0 small">{{ $apiLog->error_message }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="admin-card-header"><h5>Request Payload</h5></div>
                <div class="card-body">
                    <pre class="admin-log-json">{{ json_encode($apiLog->request_payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            </div>
            <div class="admin-card">
                <div class="admin-card-header"><h5>Response Body</h5></div>
                <div class="card-body">
                    @if($apiLog->response_body)
                        @php $decoded = $apiLog->decodedResponse(); @endphp
                        <pre class="admin-log-json">{{ $decoded ? json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $apiLog->response_body }}</pre>
                    @else
                        <p class="text-muted mb-0">Tidak ada response body.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

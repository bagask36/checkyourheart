@extends('template.index')

@section('title', 'Kelola Konten CMS')
@section('disable_scroll_reveal')
@section('css')
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/pages-theme.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="admin-page dashboard-page container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <div>
            <h4 class="mb-1">Kelola Konten CMS</h4>
            <p class="text-muted mb-0 small">Konten landing page, edukasi, dan halaman auth.</p>
        </div>
        <a href="{{ route('admin.content.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Konten</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="admin-filter-bar">
        <select name="group" class="form-select form-select-sm" style="width:auto">
            <option value="">Semua Grup</option>
            @foreach($groups as $group)
                <option value="{{ $group }}" @selected(($filters['group'] ?? '') === $group)>{{ ucfirst($group) }}</option>
            @endforeach
        </select>
        <select name="type" class="form-select form-select-sm" style="width:auto">
            <option value="">Semua Tipe</option>
            @foreach($types as $type)
                <option value="{{ $type }}" @selected(($filters['type'] ?? '') === $type)>{{ ucfirst($type) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-soft-primary">Filter</button>
        <a href="{{ route('admin.content.index') }}" class="btn btn-sm btn-light">Reset</a>
    </form>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table">
                <thead>
                    <tr>
                        <th>Grup</th>
                        <th>Tipe</th>
                        <th>Key</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blocks as $block)
                    <tr>
                        <td>{{ $block->group }}</td>
                        <td>{{ $block->type }}</td>
                        <td><code>{{ $block->key ?? '-' }}</code></td>
                        <td>{{ Str::limit($block->title ?? $block->body, 50) }}</td>
                        <td>
                            @if($block->is_active)
                                <span class="admin-badge-success">Aktif</span>
                            @else
                                <span class="admin-badge-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.content.edit', $block) }}" class="btn btn-sm btn-soft-primary">Edit</a>
                            <form action="{{ route('admin.content.destroy', $block) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus konten ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-soft-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $blocks->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection

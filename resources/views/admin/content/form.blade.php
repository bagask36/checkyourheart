@extends('template.index')

@section('title', $block->exists ? 'Edit Konten' : 'Tambah Konten')
@section('disable_scroll_reveal')
@section('css')
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/pages-theme.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="admin-page dashboard-page container-fluid">
    <div class="mb-3">
        <a href="{{ route('admin.content.index') }}" class="text-muted small"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        <h4 class="mt-2 mb-0">{{ $block->exists ? 'Edit Konten' : 'Tambah Konten' }}</h4>
    </div>

    <div class="admin-card">
        <div class="card-body p-4">
            <form method="POST" action="{{ $block->exists ? route('admin.content.update', $block) : route('admin.content.store') }}">
                @csrf
                @if($block->exists) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Grup</label>
                        <select name="group" class="form-select" required>
                            @foreach($groups as $group)
                                <option value="{{ $group }}" @selected(old('group', $block->group) === $group)>{{ ucfirst($group) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipe</label>
                        <select name="type" class="form-select" required>
                            @foreach($types as $type)
                                <option value="{{ $type }}" @selected(old('type', $block->type) === $type)>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Key (unik per grup)</label>
                        <input type="text" name="key" class="form-control" value="{{ old('key', $block->key) }}" placeholder="hero, tip_1, ...">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $block->title) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $block->sort_order ?? 0) }}" min="0">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Isi / Body</label>
                        <textarea name="body" class="form-control" rows="4">{{ old('body', $block->body) }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Meta: Icon (FA class)</label>
                        <input type="text" name="meta_icon" class="form-control" value="{{ old('meta_icon', $block->metaValue('icon')) }}" placeholder="fa-heart">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Meta: Accent color</label>
                        <input type="text" name="meta_accent" class="form-control" value="{{ old('meta_accent', $block->metaValue('accent')) }}" placeholder="#e63946">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Meta: Button text</label>
                        <input type="text" name="meta_button_text" class="form-control" value="{{ old('meta_button_text', $block->metaValue('button_text')) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Meta: Button URL</label>
                        <input type="text" name="meta_button_url" class="form-control" value="{{ old('meta_button_url', $block->metaValue('button_url')) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Meta: Value</label>
                        <input type="text" name="meta_value" class="form-control" value="{{ old('meta_value', $block->metaValue('value')) }}">
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $block->is_active ?? true))>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

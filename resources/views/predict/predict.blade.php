@extends('template.index')

@section('title', 'Prediksi Risiko Penyakit Jantung')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Prediksi Risiko Penyakit Jantung</h4>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-soft-primary border-0">
                <h5 class="card-title mb-0 text-primary">Isi Data Berikut untuk Prediksi</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('predict') }}">
                    @csrf

                    {{-- A. Data Pasien --}}
                    <h5 class="text-muted mb-3">A. Data Pasien</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="patient_name" class="form-label">Nama Pasien</label>
                            <input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ old('patient_name') }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="age" class="form-label">Usia</label>
                            <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="sex" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="sex" name="sex" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="1" {{ old('sex') == '1' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="0" {{ old('sex') == '0' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    {{-- B. Pemeriksaan Fisik & Lab --}}
                    <h5 class="text-muted mt-4 mb-3">B. Pemeriksaan Fisik & Laboratorium</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="trestbps" class="form-label">Tekanan Darah Sistolik (mmHg)</label>
                            <input type="number" class="form-control" id="trestbps" name="trestbps" value="{{ old('trestbps') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="fbs" class="form-label">Gula Darah Sewaktu >200mg/dL</label>
                            <select class="form-select" id="fbs" name="fbs" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="1" {{ old('fbs') == '1' ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ old('fbs') == '0' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="chol" class="form-label">Kolesterol (mg/dL)</label>
                            <input type="number" class="form-control" id="chol" name="chol" value="{{ old('chol') }}" required>
                        </div>
                    </div>

                    {{-- C. Pemeriksaan Jantung --}}
                    <h5 class="text-muted mt-4 mb-3">C. Pemeriksaan Jantung</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cp" class="form-label">
                                Tipe Nyeri Dada
                            </label>
                            <select class="form-select" id="cp" name="cp" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="0" {{ old('cp') == '0' ? 'selected' : '' }}>Tidak Ada  (Tidak mengalami nyeri dada)</option>
                                <option value="1" {{ old('cp') == '1' ? 'selected' : '' }}>Tipikal (Nyeri seperti ditekan/terbakar di tengah dada, muncul saat aktivitas, hilang saat istirahat)</option>
                                <option value="2" {{ old('cp') == '2' ? 'selected' : '' }}>Atipikal (Nyeri dada tidak khas, dapat terasa di area lain atau tidak terkait aktivitas)</option>
                                <option value="3" {{ old('cp') == '3' ? 'selected' : '' }}>Non-Anginal (Nyeri dada karena hal lain, misalnya otot, lambung, atau stres)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="restecg" class="form-label">
                                Hasil EKG
                            </label>
                            <select class="form-select" id="restecg" name="restecg" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="0" {{ old('restecg') == '0' ? 'selected' : '' }}>
                                    Normal (Tidak ada kelainan pada EKG)
                                </option>
                                <option value="1" {{ old('restecg') == '1' ? 'selected' : '' }}>
                                    ST-T Abnormal (Kelainan pada gelombang ST atau T, bisa menunjukkan iskemia atau gangguan irama)
                                </option>
                                <option value="2" {{ old('restecg') == '2' ? 'selected' : '' }}>
                                    Hipertrofi Kiri (Pembesaran bilik kiri jantung yang terlihat pada EKG)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="thalach" class="form-label">
                                Denyut Jantung Maksimum (BPM)
                                <div class="form-text text-muted">Contoh : 120</div>
                            </label>
                            <input
                                type="number"
                                class="form-control"
                                id="thalach"
                                name="thalach"
                                value="{{ old('thalach') }}"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="exang" class="form-label">
                                Apakah Pasien Mengalami Nyeri Dada saat Melakukan Olahraga atau Aktivitas Fisik?
                            </label>
                            <select class="form-select" id="exang" name="exang" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="1" {{ old('exang') == '1' ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ old('exang') == '0' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fas fa-paper-plane me-1"></i> Prediksi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Hasil Prediksi --}}
@if(session('prediction') || session('error'))
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-info border-0">
                    <h5 class="card-title mb-0 text-info">Hasil Prediksi</h5>
                </div>
                <div class="card-body">
                    @if(session('prediction'))
                        <div class="alert alert-info"><strong>Hasil:</strong> {{ session('prediction.message') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger"><strong>Error:</strong> {{ session('error') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Analisis Pakar --}}
@if(session('expert_reasons'))
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-info border-0">
                    <h5 class="card-title mb-0 text-info">Alasan Risiko (Analisis Pakar)</h5>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        @foreach(session('expert_reasons') as $reason)
                            <li>{{ $reason }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Rekomendasi --}}
@if(session('prediction'))
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-success border-0">
                    <h5 class="card-title mb-0 text-success">Rekomendasi</h5>
                </div>
                <div class="card-body">
                    @if(session('prediction.message') === 'Anda berisiko terkena serangan jantung.')
                        <div class="alert alert-warning">
                            Anda berisiko terkena serangan jantung. Segera konsultasikan dengan Dokter Spesialis Jantung!
                        </div>
                    @else
                        <div class="alert alert-success">
                            Anda tidak berisiko terkena serangan jantung saat ini. Lanjutkan pola hidup sehat Anda!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
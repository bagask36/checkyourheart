@extends('template.index')

@section('title', 'Prediksi Risiko Penyakit Jantung')
@section('disable_scroll_reveal')
@section('css')
<link href="{{ asset('assets/css/predict.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="predict-page container-fluid">

    {{-- Hero --}}
    <div class="predict-hero">
        <div class="d-flex align-items-start gap-3 position-relative" style="z-index: 1;">
            <div class="predict-hero-icon">
                <i class="fas fa-heart-pulse"></i>
            </div>
            <div>
                <h4>Prediksi Risiko Penyakit Jantung</h4>
                <p>Lengkapi data pemeriksaan pasien di bawah ini. Sistem akan menganalisis risiko menggunakan model machine learning dan aturan pakar medis.</p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger predict-validation-errors">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="predict-layout">
        {{-- Form --}}
        <div class="predict-form-card card border-0">
            <div class="card-body">
                <form method="POST" action="{{ route('predict') }}" id="predictForm">
                    @csrf

                    {{-- A. Data Pasien --}}
                    <div class="predict-section">
                        <div class="predict-section-header">
                            <span class="predict-section-num">1</span>
                            <div>
                                <p class="predict-section-title">Data Pasien</p>
                                <p class="predict-section-subtitle">Identitas dan demografi dasar</p>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="patient_name" class="form-label">Nama Pasien</label>
                                <input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ old('patient_name') }}" placeholder="Masukkan nama pasien" required>
                            </div>
                            <div class="col-md-3">
                                <label for="age" class="form-label">Usia (tahun)</label>
                                <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}" placeholder="Contoh: 45" min="1" max="120" required>
                            </div>
                            <div class="col-md-3">
                                <label for="sex" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="sex" name="sex" required>
                                    <option value="" disabled {{ old('sex') === null ? 'selected' : '' }}>Pilih...</option>
                                    <option value="1" {{ old('sex') == '1' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="0" {{ old('sex') == '0' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- B. Pemeriksaan Fisik & Lab --}}
                    <div class="predict-section">
                        <div class="predict-section-header">
                            <span class="predict-section-num">2</span>
                            <div>
                                <p class="predict-section-title">Pemeriksaan Fisik & Laboratorium</p>
                                <p class="predict-section-subtitle">Tekanan darah, gula darah, dan kolesterol</p>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="trestbps" class="form-label">Tekanan Darah Sistolik</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="trestbps" name="trestbps" value="{{ old('trestbps') }}" placeholder="120" required>
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="fbs" class="form-label">Gula Darah Sewaktu &gt; 200 mg/dL</label>
                                <select class="form-select" id="fbs" name="fbs" required>
                                    <option value="" disabled {{ old('fbs') === null ? 'selected' : '' }}>Pilih...</option>
                                    <option value="1" {{ old('fbs') == '1' ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ old('fbs') == '0' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="chol" class="form-label">Kolesterol</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="chol" name="chol" value="{{ old('chol') }}" placeholder="200" required>
                                    <span class="input-group-text">mg/dL</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- C. Pemeriksaan Jantung --}}
                    <div class="predict-section">
                        <div class="predict-section-header">
                            <span class="predict-section-num">3</span>
                            <div>
                                <p class="predict-section-title">Pemeriksaan Jantung</p>
                                <p class="predict-section-subtitle">Gejala, EKG, dan aktivitas fisik</p>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="cp" class="form-label">Tipe Nyeri Dada</label>
                                <select class="form-select" id="cp" name="cp" required>
                                    <option value="" disabled {{ old('cp') === null ? 'selected' : '' }}>Pilih...</option>
                                    <option value="0" {{ old('cp') == '0' ? 'selected' : '' }}>Tidak Ada</option>
                                    <option value="1" {{ old('cp') == '1' ? 'selected' : '' }}>Tipikal</option>
                                    <option value="2" {{ old('cp') == '2' ? 'selected' : '' }}>Atipikal</option>
                                    <option value="3" {{ old('cp') == '3' ? 'selected' : '' }}>Non-Anginal</option>
                                </select>
                                <div class="form-text">Tipikal: nyeri ditekan di tengah dada saat aktivitas</div>
                            </div>
                            <div class="col-md-6">
                                <label for="restecg" class="form-label">Hasil EKG</label>
                                <select class="form-select" id="restecg" name="restecg" required>
                                    <option value="" disabled {{ old('restecg') === null ? 'selected' : '' }}>Pilih...</option>
                                    <option value="0" {{ old('restecg') == '0' ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ old('restecg') == '1' ? 'selected' : '' }}>ST-T Abnormal</option>
                                    <option value="2" {{ old('restecg') == '2' ? 'selected' : '' }}>Hipertrofi Kiri</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="thalach" class="form-label">Denyut Jantung Maksimum</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="thalach" name="thalach" value="{{ old('thalach') }}" placeholder="120" required>
                                    <span class="input-group-text">BPM</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exang" class="form-label">Nyeri Dada saat Olahraga?</label>
                                <select class="form-select" id="exang" name="exang" required>
                                    <option value="" disabled {{ old('exang') === null ? 'selected' : '' }}>Pilih...</option>
                                    <option value="1" {{ old('exang') == '1' ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ old('exang') == '0' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pt-2">
                        <button type="submit" class="btn btn-primary predict-submit">
                            <i class="fas fa-stethoscope me-2"></i>Mulai Prediksi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar info --}}
        <aside class="predict-sidebar">
            <div class="predict-info-card">
                <h6><i class="fas fa-circle-info me-1 text-danger"></i> Panduan Pengisian</h6>
                <div class="predict-tip">
                    <span class="predict-tip-icon"><i class="fas fa-user"></i></span>
                    <p>Pastikan nama pasien dan usia sesuai dengan data rekam medis.</p>
                </div>
                <div class="predict-tip">
                    <span class="predict-tip-icon"><i class="fas fa-droplet"></i></span>
                    <p>Tekanan darah sistolik normal dewasa umumnya 90–120 mmHg.</p>
                </div>
                <div class="predict-tip">
                    <span class="predict-tip-icon"><i class="fas fa-heart"></i></span>
                    <p>Denyut jantung maksimum dapat diukur saat tes stres atau olahraga.</p>
                </div>
            </div>
            <div class="predict-info-card">
                <h6><i class="fas fa-notes-medical me-1 text-danger"></i> Catatan</h6>
                <p class="text-muted small mb-0">Hasil prediksi bersifat indikatif dan tidak menggantikan diagnosis medis. Konsultasikan dengan dokter spesialis jantung untuk pemeriksaan lanjutan.</p>
            </div>
        </aside>
    </div>

    {{-- Hasil Prediksi --}}
    @if(session('prediction') || session('error'))
        @php
            $isRisk = session('prediction') && (session('prediction.message') === 'Anda berisiko terkena serangan jantung.');
            $resultClass = session('error') ? 'error-state' : ($isRisk ? 'risk-high' : 'risk-low');
            $resultIcon = session('error') ? 'fa-circle-exclamation' : ($isRisk ? 'fa-triangle-exclamation' : 'fa-circle-check');
            $resultTitle = session('error') ? 'Prediksi Gagal' : ($isRisk ? 'Berisiko Serangan Jantung' : 'Tidak Berisiko');
        @endphp
        <div class="predict-result-panel" id="predictResult">
            <div class="predict-result-card">
                <div class="predict-result-header {{ $resultClass }}">
                    <div class="predict-result-badge {{ $resultClass }}">
                        <i class="fas {{ $resultIcon }}"></i>
                    </div>
                    <div>
                        <p class="predict-result-title">{{ $resultTitle }}</p>
                        @if(session('prediction'))
                            <p class="predict-result-message">{{ session('prediction.message') }}</p>
                        @endif
                        @if(session('error'))
                            <p class="predict-result-message">{{ session('error') }}</p>
                        @endif
                    </div>
                </div>

                @if(session('prediction'))
                    <div class="predict-result-body">
                        <div class="predict-result-grid">
                            @if(session('expert_reasons'))
                                <div class="predict-result-block">
                                    <h6><i class="fas fa-user-doctor text-danger"></i> Analisis Pakar</h6>
                                    <ul>
                                        @foreach(session('expert_reasons') as $reason)
                                            <li>{{ $reason }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session('prediction.explanation'))
                                <div class="predict-result-block">
                                    <h6><i class="fas fa-brain text-primary"></i> Penjelasan Model</h6>
                                    <p>{{ session('prediction.explanation') }}</p>
                                </div>
                            @endif
                        </div>

                        @if($isRisk)
                            <div class="predict-recommendation warn">
                                <i class="fas fa-hospital me-1"></i>
                                Anda berisiko terkena serangan jantung. Segera konsultasikan dengan dokter spesialis jantung untuk pemeriksaan lebih lanjut.
                            </div>
                        @else
                            <div class="predict-recommendation safe">
                                <i class="fas fa-leaf me-1"></i>
                                Anda tidak berisiko terkena serangan jantung saat ini. Pertahankan pola hidup sehat dan lakukan pemeriksaan rutin.
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @endif

</div>
@endsection

@section('scripts')
@if(session('prediction') || session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const result = document.getElementById('predictResult');
        if (result) {
            result.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
</script>
@endif
@endsection

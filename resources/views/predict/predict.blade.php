@extends('template.index')

@section('title', 'Prediksi Risiko Penyakit Jantung')

@section('content')
    {{-- Page title --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Prediksi Risiko Penyakit Jantung</h4>
            </div>
        </div>
    </div>

    {{-- Form card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-soft-primary border-0">
                    <h5 class="card-title mb-0 text-primary">Isi Data Berikut untuk Prediksi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('predict') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="patient_name" class="form-label">Nama Pasien</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="patient_name"
                                    name="patient_name"
                                    value="{{ old('patient_name') }}"
                                    required
                                >
                            </div>
                            @php
                                $fields = [
                                    ['id'=>'age','label'=>'Usia','type'=>'number'],
                                    ['id'=>'trestbps','label'=>'Tekanan Darah Saat Istirahat','type'=>'number'],
                                    ['id'=>'chol','label'=>'Kolesterol','type'=>'number'],
                                    ['id'=>'thalach','label'=>'Denyut Jantung Maksimum','type'=>'number'],
                                ];
                                $selects = [
                                    ['id'=>'sex','label'=>'Jenis Kelamin','options'=>[1=>'Laki-laki',0=>'Perempuan']],
                                    ['id'=>'cp','label'=>'Tipe Nyeri Dada','options'=>[0=>'Tidak Ada',1=>'Tipikal',2=>'Atipikal',3=>'Non-Anginal']],
                                    ['id'=>'fbs','label'=>'Gula Darah >200mg/dl','options'=>[1=>'Ya',0=>'Tidak']],
                                    ['id'=>'restecg','label'=>'Hasil EKG','options'=>[0=>'Normal',1=>'ST-T Abnormal',2=>'Hipertrofi Kiri']],
                                    ['id'=>'exang','label'=>'Nyeri Dada Saat Olahraga','options'=>[1=>'Ya',0=>'Tidak']],
                                ];
                            @endphp

                            @foreach($fields as $f)
                                <div class="col-md-6 mb-3">
                                    <label for="{{ $f['id'] }}" class="form-label">{{ $f['label'] }}</label>
                                    <input
                                        type="{{ $f['type'] }}"
                                        class="form-control"
                                        id="{{ $f['id'] }}"
                                        name="{{ $f['id'] }}"
                                        value="{{ old($f['id']) }}"
                                        required
                                    >
                                </div>
                            @endforeach

                            @foreach($selects as $s)
                                <div class="col-md-6 mb-3">
                                    <label for="{{ $s['id'] }}" class="form-label">{{ $s['label'] }}</label>
                                    <select
                                        class="form-select"
                                        id="{{ $s['id'] }}"
                                        name="{{ $s['id'] }}"
                                        required
                                    >
                                        <option value="" disabled selected>Pilih...</option>
                                        @foreach($s['options'] as $key => $val)
                                            <option value="{{ $key }}" {{ old($s['id']) == (string)$key ? 'selected' : '' }}>
                                                {{ $val }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Prediksi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Rule Based --}}
    @if(session('prediction.expert_reasons'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-soft-info border-0">
                        <h5 class="card-title mb-0 text-info">Alasan Risiko (Analisis Pakar)</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ session('prediction.expert_reasons') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Prediction results --}}
    @if(session('prediction') || session('error'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-soft-info border-0">
                        <h5 class="card-title mb-0 text-info">Hasil Prediksi</h5>
                    </div>
                    <div class="card-body">
                        @if(session('prediction'))
                            <div class="alert alert-info">
                                <strong>Hasil:</strong> {{ session('prediction.message') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                <strong>Error:</strong> {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Analisis Sistem Pakar --}}
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

    {{-- Recommendation --}}
    @if(session('prediction'))
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-soft-success border-0">
                        <h5 class="card-title mb-0 text-success">Rekomendasi</h5>
                    </div>
                    <div class="card-body">
                        @if(session('prediction.message') === 'Anda beresiko terkena serangan jantung.')
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
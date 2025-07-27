@extends('template.index')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard Prediksi Penyakit Jantung</h4>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-soft-info border-0">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-1">Selamat Datang, {{ Auth::user()->name }}!</h5>
                        <p class="card-text text-muted mb-0">
                            Semoga harimu menyenangkan. Berikut ringkasan data prediksi penyakit jantung.
                        </p>
                    </div>
                    <div>
                        <i class="mdi mdi-heart-pulse fs-2 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @php
        $charts = [
            ['id' => 'positiveByGender',   'title' => 'Positif - Jenis Kelamin',       'data' => $chartData['gender'],   'colors' => ['#4e73df','#f6c23e']],
            ['id' => 'negativeByGender',   'title' => 'Negatif - Jenis Kelamin',       'data' => $chartData['gender'],   'colors' => ['#1cc88a','#e74a3b']],
            ['id' => 'positiveByAgeGroup', 'title' => 'Positif - Usia',                'data' => $chartData['ageGroup'], 'colors' => ['#36b9cc','#f6c23e','#e74a3b','#4e73df','#858796','#1cc88a']],
            ['id' => 'negativeByAgeGroup', 'title' => 'Negatif - Usia',                'data' => $chartData['ageGroup'], 'colors' => ['#36b9cc','#f6c23e','#e74a3b','#4e73df','#858796','#1cc88a']],
            ['id' => 'positiveByTensi',    'title' => 'Positif - Tekanan Darah',       'data' => $chartData['tensi'],    'colors' => ['#4e73df','#f6c23e']],
            ['id' => 'negativeByTensi',    'title' => 'Negatif - Tekanan Darah',       'data' => $chartData['tensi'],    'colors' => ['#1cc88a','#e74a3b']],
            ['id' => 'positiveByChol',     'title' => 'Positif - Kolesterol',          'data' => $chartData['chol'],     'colors' => ['#36b9cc','#f6c23e']],
            ['id' => 'negativeByChol',     'title' => 'Negatif - Kolesterol',          'data' => $chartData['chol'],     'colors' => ['#e74a3b','#858796']],
        ];
    @endphp

    @foreach($charts as $chart)
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card hoverable">
            <div class="card-header bg-soft-primary border-0 text-center">
                <h5 class="card-title mb-0">{{ $chart['title'] }}</h5>
            </div>
            <div class="card-body">
                <div class="chartjs-chart d-flex flex-column align-items-center">
                    <canvas id="{{ $chart['id'] }}" height="200"></canvas>
                    <div class="mt-3">
                        @foreach($chart['data']['labels'] as $i => $label)
                            <div class="d-inline-flex align-items-center me-4 mb-2 mt-2">
                                <span class="rounded-circle me-2" style="width:14px; height:14px; background-color: {{ $chart['colors'][$i] }}"></span>
                                <small class="text-muted">{{ $label }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-soft-secondary border-0">
                <h5 class="card-title mb-0">Data Pasien</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="patientsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle">No</th>
                                <th class="align-middle">Nama Pasien</th>
                                <th class="align-middle">Usia</th>
                                <th class="align-middle">Jenis Kelamin</th>
                                <th class="align-middle">Tekanan Darah</th>
                                <th class="align-middle">Kolesterol</th>
                                <th class="align-middle">Hasil EKG</th>
                                <th class="align-middle">Denyut Jantung</th>
                                <th class="align-middle">Prediksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $index => $p)
                            <tr>
                                <td class="align-middle">{{ $patients->firstItem() + $index }}</td>
                                <td class="align-middle">{{ $p->patient_name }}</td>
                                <td class="align-middle">{{ $p->age }}</td>
                                <td class="align-middle">{{ $p->sex == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td class="align-middle">{{ $p->trestbps }} mmHg</td>
                                <td class="align-middle">{{ $p->chol }} mg/dL</td>
                                <td class="align-middle">
                                    @if($p->restecg == 0) Normal
                                    @elseif($p->restecg == 1) ST-T Abnormal
                                    @else Hipertrofi Kiri
                                    @endif
                                </td>
                                <td class="align-middle">{{ $p->thalach }} bpm</td>
                                <td class="align-middle">
                                    @if($p->prediction == 1)
                                        <span class="badge bg-danger">Risiko Tinggi</span>
                                    @else
                                        <span class="badge bg-success">Tidak Berisiko</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $patients->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chartData = @json($chartData);

            function renderPie(id, labels, dataSet, bgColors) {
                var ctx = document.getElementById(id).getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: dataSet,
                            backgroundColor: bgColors
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: "#fff",
                                titleColor: '#333',
                                bodyColor: '#555',
                                borderColor: '#ddd',
                                borderWidth: 1,
                                padding: 10,
                                displayColors: false
                            }
                        },
                        cutout: '75%'  // donut effect
                    }
                });
            }

            // Gender
            renderPie(
                'positiveByGender',
                chartData.gender.labels,
                chartData.gender.positiveValues,
                ['#4e73df','#f6c23e']
            );
            renderPie(
                'negativeByGender',
                chartData.gender.labels,
                chartData.gender.negativeValues,
                ['#1cc88a','#e74a3b']
            );

            // Usia
            renderPie(
                'positiveByAgeGroup',
                chartData.ageGroup.labels,
                chartData.ageGroup.positiveValues,
                ['#36b9cc','#f6c23e','#e74a3b','#4e73df','#858796','#1cc88a']
            );
            renderPie(
                'negativeByAgeGroup',
                chartData.ageGroup.labels,
                chartData.ageGroup.negativeValues,
                ['#36b9cc','#f6c23e','#e74a3b','#4e73df','#858796','#1cc88a']
            );

            // Tekanan Darah
            renderPie(
                'positiveByTensi',
                chartData.tensi.labels,
                chartData.tensi.positiveValues,
                ['#4e73df','#f6c23e']
            );
            renderPie(
                'negativeByTensi',
                chartData.tensi.labels,
                chartData.tensi.negativeValues,
                ['#1cc88a','#e74a3b']
            );

            // Kolesterol
            renderPie(
                'positiveByChol',
                chartData.chol.labels,
                chartData.chol.positiveValues,
                ['#36b9cc','#f6c23e']
            );
            renderPie(
                'negativeByChol',
                chartData.chol.labels,
                chartData.chol.negativeValues,
                ['#e74a3b','#858796']
            );
        });
    </script>
@endsection
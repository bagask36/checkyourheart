@extends('template.index')

@section('title', 'Dashboard')
@section('disable_scroll_reveal')
@section('css')
<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />
@endsection

@php
    $totalPatients = $patients->total();
    $atRisk = array_sum($chartData['gender']['positiveValues']);
    $notAtRisk = array_sum($chartData['gender']['negativeValues']);

    $chartGroups = [
        [
            'title' => 'Jenis Kelamin',
            'icon'  => 'fa-venus-mars',
            'labels' => $chartData['gender']['labels'],
            'positive' => ['id' => 'positiveByGender', 'values' => $chartData['gender']['positiveValues'], 'colors' => ['#457b9d', '#e9c46a']],
            'negative' => ['id' => 'negativeByGender', 'values' => $chartData['gender']['negativeValues'], 'colors' => ['#2a9d8f', '#e63946']],
        ],
        [
            'title' => 'Kelompok Usia',
            'icon'  => 'fa-calendar',
            'labels' => $chartData['ageGroup']['labels'],
            'positive' => ['id' => 'positiveByAgeGroup', 'values' => $chartData['ageGroup']['positiveValues'], 'colors' => ['#457b9d', '#e9c46a', '#e63946', '#2a9d8f', '#1d3557', '#a8dadc']],
            'negative' => ['id' => 'negativeByAgeGroup', 'values' => $chartData['ageGroup']['negativeValues'], 'colors' => ['#457b9d', '#e9c46a', '#e63946', '#2a9d8f', '#1d3557', '#a8dadc']],
        ],
        [
            'title' => 'Tekanan Darah',
            'icon'  => 'fa-heart-pulse',
            'labels' => $chartData['tensi']['labels'],
            'positive' => ['id' => 'positiveByTensi', 'values' => $chartData['tensi']['positiveValues'], 'colors' => ['#e63946', '#457b9d']],
            'negative' => ['id' => 'negativeByTensi', 'values' => $chartData['tensi']['negativeValues'], 'colors' => ['#2a9d8f', '#457b9d']],
        ],
        [
            'title' => 'Kolesterol',
            'icon'  => 'fa-droplet',
            'labels' => $chartData['chol']['labels'],
            'positive' => ['id' => 'positiveByChol', 'values' => $chartData['chol']['positiveValues'], 'colors' => ['#e63946', '#457b9d']],
            'negative' => ['id' => 'negativeByChol', 'values' => $chartData['chol']['negativeValues'], 'colors' => ['#2a9d8f', '#6c757d']],
        ],
    ];
@endphp

@section('content')
<div class="dashboard-page container-fluid">

    {{-- Hero --}}
    <div class="dash-hero">
        <div class="d-flex align-items-start gap-3 position-relative" style="z-index: 1;">
            <div class="dash-hero-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="flex-grow-1">
                <h4>Selamat Datang, {{ Auth::user()->name }}!</h4>
                <p>Ringkasan data prediksi penyakit jantung. Pantau statistik pasien dan tren risiko dari pemeriksaan yang telah dilakukan.</p>
            </div>
            <a href="{{ route('predict.form') }}" class="dash-btn-predict d-none d-md-inline-flex">
                <i class="fas fa-plus"></i> Prediksi Baru
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="dash-stats">
        <div class="dash-stat-card">
            <div class="dash-stat-icon total"><i class="fas fa-users"></i></div>
            <div>
                <div class="dash-stat-value">{{ $totalPatients }}</div>
                <p class="dash-stat-label">Total Pemeriksaan</p>
            </div>
        </div>
        <div class="dash-stat-card">
            <div class="dash-stat-icon risk"><i class="fas fa-triangle-exclamation"></i></div>
            <div>
                <div class="dash-stat-value">{{ $atRisk }}</div>
                <p class="dash-stat-label">Berisiko</p>
            </div>
        </div>
        <div class="dash-stat-card">
            <div class="dash-stat-icon safe"><i class="fas fa-circle-check"></i></div>
            <div>
                <div class="dash-stat-value">{{ $notAtRisk }}</div>
                <p class="dash-stat-label">Tidak Berisiko</p>
            </div>
        </div>
        <div class="dash-stat-card">
            <div class="dash-stat-icon action"><i class="fas fa-percent"></i></div>
            <div>
                <div class="dash-stat-value">{{ $totalPatients > 0 ? round(($atRisk / $totalPatients) * 100) : 0 }}%</div>
                <p class="dash-stat-label">Persentase Risiko</p>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="dash-charts-section">
        <div class="dash-section-header">
            <div>
                <h5>Analisis Statistik</h5>
                <p>Distribusi pasien berdasarkan kategori pemeriksaan</p>
            </div>
        </div>
        <div class="dash-charts-grid">
            @foreach($chartGroups as $group)
            <div class="dash-chart-card">
                <div class="dash-chart-card-header">
                    <span class="dash-chart-card-icon"><i class="fas {{ $group['icon'] }}"></i></span>
                    <p class="dash-chart-card-title">{{ $group['title'] }}</p>
                </div>
                <div class="dash-chart-duo">
                    <div class="dash-chart-pane">
                        <div class="dash-chart-pane-label risk">Berisiko</div>
                        <div class="dash-chart-canvas-wrap">
                            <canvas id="{{ $group['positive']['id'] }}" height="160"></canvas>
                        </div>
                        <div class="dash-chart-legend">
                            @foreach($group['labels'] as $i => $label)
                                <span class="dash-chart-legend-item">
                                    <span class="dash-chart-legend-dot" style="background: {{ $group['positive']['colors'][$i] ?? '#ccc' }}"></span>
                                    {{ $label }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="dash-chart-pane">
                        <div class="dash-chart-pane-label safe">Tidak Berisiko</div>
                        <div class="dash-chart-canvas-wrap">
                            <canvas id="{{ $group['negative']['id'] }}" height="160"></canvas>
                        </div>
                        <div class="dash-chart-legend">
                            @foreach($group['labels'] as $i => $label)
                                <span class="dash-chart-legend-item">
                                    <span class="dash-chart-legend-dot" style="background: {{ $group['negative']['colors'][$i] ?? '#ccc' }}"></span>
                                    {{ $label }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Patient table --}}
    <div class="dash-table-card">
        <div class="dash-table-header">
            <h5><i class="fas fa-table-list me-1 text-danger"></i> Data Pasien</h5>
            <span>{{ $totalPatients }} total rekaman</span>
        </div>

        @if($patients->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Usia</th>
                            <th>Kelamin</th>
                            <th>Tekanan Darah</th>
                            <th>Kolesterol</th>
                            <th>EKG</th>
                            <th>Denyut</th>
                            <th>Prediksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $index => $p)
                        <tr>
                            <td>{{ $patients->firstItem() + $index }}</td>
                            <td>
                                <span id="name-{{ $p->id }}" class="patient-name">••••••</span>
                                <button type="button" class="dash-name-toggle" data-patient-id="{{ $p->id }}" data-patient-name="{{ e($p->patient_name) }}" title="Tampilkan/sembunyikan nama">
                                    <i class="fas fa-eye-slash" id="icon-{{ $p->id }}"></i>
                                </button>
                            </td>
                            <td>{{ $p->age }} th</td>
                            <td>{{ $p->sex == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $p->trestbps }} mmHg</td>
                            <td>{{ $p->chol }} mg/dL</td>
                            <td>
                                @if($p->restecg == 0) Normal
                                @elseif($p->restecg == 1) ST-T Abnormal
                                @else Hipertrofi Kiri
                                @endif
                            </td>
                            <td>{{ $p->thalach }} bpm</td>
                            <td>
                                @if($p->prediction == 1)
                                    <span class="dash-badge risk"><i class="fas fa-circle" style="font-size:0.4rem"></i> Berisiko</span>
                                @else
                                    <span class="dash-badge safe"><i class="fas fa-circle" style="font-size:0.4rem"></i> Aman</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="dash-table-footer">
                {{ $patients->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="dash-empty-state">
                <div><i class="fas fa-inbox d-block"></i></div>
                <p class="mb-2">Belum ada data pemeriksaan.</p>
                <a href="{{ route('predict.form') }}" class="dash-btn-predict">
                    <i class="fas fa-stethoscope"></i> Mulai Prediksi Pertama
                </a>
            </div>
        @endif
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="application/json" id="chart-groups-data">@json($chartGroups)</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.dash-name-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const id = btn.dataset.patientId;
                const actualName = btn.dataset.patientName;
                const nameEl = document.getElementById('name-' + id);
                const iconEl = document.getElementById('icon-' + id);

                if (nameEl.innerText === '••••••') {
                    nameEl.innerText = actualName;
                    iconEl.classList.remove('fa-eye-slash');
                    iconEl.classList.add('fa-eye');
                } else {
                    nameEl.innerText = '••••••';
                    iconEl.classList.remove('fa-eye');
                    iconEl.classList.add('fa-eye-slash');
                }
            });
        });

        const chartGroups = JSON.parse(document.getElementById('chart-groups-data').textContent);
        const chartInstances = [];

        function getPageThemeVar(name) {
            const page = document.querySelector('.dashboard-page');
            return page ? getComputedStyle(page).getPropertyValue(name).trim() : '';
        }

        function isDarkMode() {
            return document.documentElement.getAttribute('data-bs-theme') === 'dark';
        }

        function destroyCharts() {
            chartInstances.forEach(function (chart) { chart.destroy(); });
            chartInstances.length = 0;
        }

        function renderDonut(id, labels, dataSet, bgColors) {
            const el = document.getElementById(id);
            if (!el) return;

            const wrap = el.parentElement;
            if (!wrap.querySelector('canvas')) {
                wrap.innerHTML = '<canvas id="' + id + '" height="160"></canvas>';
            }
            const canvas = document.getElementById(id);
            const total = dataSet.reduce(function (a, b) { return a + b; }, 0);

            if (total === 0) {
                wrap.innerHTML = '<p class="text-muted small mb-0 py-4">Belum ada data</p>';
                return;
            }

            const chartBorder = getPageThemeVar('--page-chart-border') || (isDarkMode() ? '#2a3035' : '#ffffff');
            const tooltipBg = getPageThemeVar('--page-surface') || (isDarkMode() ? '#212529' : '#ffffff');

            chartInstances.push(new Chart(canvas.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataSet,
                        backgroundColor: bgColors.slice(0, labels.length),
                        borderWidth: 2,
                        borderColor: chartBorder,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: tooltipBg,
                            titleColor: getPageThemeVar('--page-text') || (isDarkMode() ? '#e9ecef' : '#1d3557'),
                            bodyColor: getPageThemeVar('--page-muted') || (isDarkMode() ? '#adb5bd' : '#6c757d'),
                            borderColor: getPageThemeVar('--page-border') || 'rgba(29,53,87,0.1)',
                            borderWidth: 1,
                            padding: 10,
                        }
                    },
                    cutout: '68%',
                }
            }));
        }

        function renderAllCharts() {
            destroyCharts();
            chartGroups.forEach(function (group) {
                renderDonut(group.positive.id, group.labels, group.positive.values, group.positive.colors);
                renderDonut(group.negative.id, group.labels, group.negative.values, group.negative.colors);
            });
        }

        renderAllCharts();

        let lastTheme = document.documentElement.getAttribute('data-bs-theme');
        window.addEventListener('resize', function () {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            if (currentTheme !== lastTheme) {
                lastTheme = currentTheme;
                renderAllCharts();
            }
        });
    });
</script>
@endsection

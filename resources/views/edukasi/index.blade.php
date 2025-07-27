@extends('template.index')

@section('title', 'Edukasi Pencegahan Penyakit Jantung')

@section('content')
    {{-- Page title --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edukasi Pencegahan Penyakit Jantung</h4>
            </div>
        </div>
    </div>

    {{-- Intro card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-soft-danger border-0">
                <div class="card-body">
                    <h5 class="card-title text-danger mb-2">Pentingnya Menjaga Kesehatan Jantung</h5>
                    <p class="text-muted mb-0">
                        Penyakit jantung adalah salah satu penyebab kematian tertinggi di dunia. Gaya hidup tidak sehat dapat meningkatkan risikonya. Terapkan pola hidup sehat sejak dini untuk mencegahnya.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Prevention tips --}}
    <div class="row">
        @php
            $tips = [
                [
                    'color' => 'success',
                    'icon'  => 'fa-apple-whole',
                    'title' => '1. Konsumsi Makanan Sehat',
                    'text'  => 'Perbanyak buah, sayur, biji-bijian, dan makanan rendah lemak jenuh. Kurangi garam & gula berlebih.'
                ],
                [
                    'color' => 'primary',
                    'icon'  => 'fa-person-walking',
                    'title' => '2. Rutin Berolahraga',
                    'text'  => 'Olahraga ringan (jalan kaki, jogging, bersepeda) 30 menit/hari, minimal 5× seminggu.'
                ],
                [
                    'color' => 'danger',
                    'icon'  => 'fa-ban-smoking',
                    'title' => '3. Hindari Merokok',
                    'text'  => 'Merokok merusak pembuluh darah dan meningkatkan risiko serangan jantung.'
                ],
                [
                    'color' => 'warning',
                    'icon'  => 'fa-heart-pulse',
                    'title' => '4. Cek Tekanan Darah & Kolesterol',
                    'text'  => 'Pantau tekanan darah dan kadar kolesterol secara rutin untuk deteksi dini.'
                ],
                [
                    'color' => 'info',
                    'icon'  => 'fa-spa',
                    'title' => '5. Kelola Stres dengan Baik',
                    'text'  => 'Stres kronis dapat mempengaruhi tekanan darah. Coba relaksasi, meditasi, atau hobi menyenangkan.'
                ],
            ];
        @endphp

        @foreach($tips as $tip)
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-light bg-gradient hover-shadow">
                    <div class="card-body d-flex align-items-start">
                        <div class="me-3">
                            <div class="avatar-sm bg-{{ $tip['color'] }} bg-gradient rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid {{ $tip['icon'] }} text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fs-6 fw-semibold text-{{ $tip['color'] }} mb-1">{{ $tip['title'] }}</h5>
                            <p class="text-muted small mb-0">{{ $tip['text'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
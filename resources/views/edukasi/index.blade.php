@extends('template.index')

@section('title', 'Edukasi Pencegahan Penyakit Jantung')
@section('disable_scroll_reveal')
@section('css')
<link href="{{ asset('assets/css/education.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@php
    $tips = [
        [
            'num'   => 1,
            'accent' => '#2a9d8f',
            'icon'  => 'fa-apple-whole',
            'title' => 'Konsumsi Makanan Sehat',
            'text'  => 'Perbanyak buah, sayur, biji-bijian, dan makanan rendah lemak jenuh. Kurangi garam dan gula berlebih.',
        ],
        [
            'num'   => 2,
            'accent' => '#457b9d',
            'icon'  => 'fa-person-walking',
            'title' => 'Rutin Berolahraga',
            'text'  => 'Olahraga ringan seperti jalan kaki, jogging, atau bersepeda selama 30 menit per hari, minimal 5 kali seminggu.',
        ],
        [
            'num'   => 3,
            'accent' => '#e63946',
            'icon'  => 'fa-ban-smoking',
            'title' => 'Hindari Merokok',
            'text'  => 'Merokok merusak pembuluh darah dan meningkatkan risiko serangan jantung secara signifikan.',
        ],
        [
            'num'   => 4,
            'accent' => '#e9c46a',
            'icon'  => 'fa-heart-pulse',
            'title' => 'Cek Tekanan Darah & Kolesterol',
            'text'  => 'Pantau tekanan darah dan kolesterol secara rutin. Tekanan darah ideal dewasa 90/60–120/80 mmHg, kolesterol total ideal di bawah 200 mg/dL.',
        ],
        [
            'num'   => 5,
            'accent' => '#6a4c93',
            'icon'  => 'fa-spa',
            'title' => 'Kelola Stres dengan Baik',
            'text'  => 'Stres kronis dapat mempengaruhi tekanan darah. Coba relaksasi, meditasi, atau lakukan hobi yang menyenangkan.',
        ],
    ];

    $warnings = [
        ['icon' => 'fa-heart-crack', 'text' => 'Nyeri dada atau sesak napas'],
        ['icon' => 'fa-circle-exclamation', 'text' => 'Pusing atau pingsan mendadak'],
        ['icon' => 'fa-lungs', 'text' => 'Sesak napas saat beraktivitas'],
        ['icon' => 'fa-heart-pulse', 'text' => 'Detak jantung tidak teratur'],
    ];
@endphp

<div class="education-page container-fluid">

    {{-- Hero --}}
    <div class="edu-hero">
        <div class="d-flex align-items-start gap-3 position-relative" style="z-index: 1;">
            <div class="edu-hero-icon">
                <i class="fas fa-book-medical"></i>
            </div>
            <div>
                <h4>Edukasi Pencegahan Penyakit Jantung</h4>
                <p>Penyakit jantung merupakan salah satu penyebab kematian tertinggi di dunia. Pelajari cara mencegahnya dan jaga kesehatan jantung Anda sejak dini.</p>
            </div>
        </div>
    </div>

    {{-- Quick facts --}}
    <div class="edu-facts">
        <div class="edu-fact-card">
            <div class="edu-fact-value">#1</div>
            <p class="edu-fact-label">Penyakit jantung adalah penyebab kematian utama di dunia</p>
        </div>
        <div class="edu-fact-card">
            <div class="edu-fact-value">80%</div>
            <p class="edu-fact-label">Serangan jantung dapat dicegah dengan gaya hidup sehat</p>
        </div>
        <div class="edu-fact-card">
            <div class="edu-fact-value">30 min</div>
            <p class="edu-fact-label">Olahraga ringan per hari sudah cukup membantu jantung sehat</p>
        </div>
    </div>

    {{-- Intro --}}
    <div class="edu-intro-banner">
        <div class="edu-intro-icon"><i class="fas fa-hand-holding-heart"></i></div>
        <div>
            <h5>Lindungi Jantung Anda: Mulai dari Gaya Hidup Sehat</h5>
            <p>Risiko penyakit jantung meningkat akibat pola hidup tidak sehat — kurang olahraga, makan berlebihan, merokok, dan stres. Mulailah menjaga jantung dengan menerapkan kebiasaan sehat secara konsisten.</p>
        </div>
    </div>

    {{-- Warning signs --}}
    <div class="edu-section-header">
        <h5><i class="fas fa-triangle-exclamation text-warning me-1"></i> Tanda Bahaya yang Perlu Diwaspadai</h5>
        <p>Segera periksakan diri ke dokter jika Anda mengalami gejala berikut</p>
    </div>
    <div class="edu-warning-grid">
        @foreach($warnings as $warning)
            <div class="edu-warning-item">
                <i class="fas {{ $warning['icon'] }} d-block"></i>
                <p>{{ $warning['text'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Tips --}}
    <div class="edu-section-header">
        <h5>5 Langkah Pencegahan Penyakit Jantung</h5>
        <p>Terapkan kebiasaan sehat berikut untuk menjaga kesehatan jantung</p>
    </div>
    <div class="edu-tips-grid">
        @foreach($tips as $tip)
            <div class="edu-tip-card" style="--tip-accent: {{ $tip['accent'] }}; --tip-accent-soft: {{ $tip['accent'] }}1a;">
                <div class="edu-tip-icon-wrap">
                    <i class="fas {{ $tip['icon'] }}"></i>
                </div>
                <div class="edu-tip-body">
                    <h6>{{ $tip['num'] }}. {{ $tip['title'] }}</h6>
                    <p>{{ $tip['text'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- CTA --}}
    <div class="edu-cta">
        <div>
            <h5>Ingin Tahu Risiko Penyakit Jantung Anda?</h5>
            <p>Gunakan fitur prediksi untuk menganalisis risiko berdasarkan data pemeriksaan medis.</p>
        </div>
        <a href="{{ route('predict.form') }}" class="edu-cta-btn">
            <i class="fas fa-stethoscope"></i> Cek Risiko Sekarang
        </a>
    </div>

</div>
@endsection

@extends('template.index')

@section('title', 'Edukasi Pencegahan Penyakit Jantung')
@section('disable_scroll_reveal')
@section('css')
<link href="{{ asset('assets/css/education.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@php
    $hero = $content['hero'];
    $intro = $content['intro'];
    $cta = $content['cta'];
@endphp

<div class="education-page container-fluid">

    <div class="edu-hero">
        <div class="d-flex align-items-start gap-3 position-relative" style="z-index: 1;">
            <div class="edu-hero-icon">
                <i class="fas fa-book-medical"></i>
            </div>
            <div>
                <h4>{{ $hero?->title ?? 'Edukasi Pencegahan Penyakit Jantung' }}</h4>
                <p>{{ $hero?->body }}</p>
            </div>
        </div>
    </div>

    @if($content['facts']->isNotEmpty())
    <div class="edu-facts">
        @foreach($content['facts'] as $fact)
        <div class="edu-fact-card">
            <div class="edu-fact-value">{{ $fact->title }}</div>
            <p class="edu-fact-label">{{ $fact->body }}</p>
        </div>
        @endforeach
    </div>
    @endif

    @if($intro)
    <div class="edu-intro-banner">
        <div class="edu-intro-icon"><i class="fas fa-hand-holding-heart"></i></div>
        <div>
            <h5>{{ $intro->title }}</h5>
            <p>{{ $intro->body }}</p>
        </div>
    </div>
    @endif

    @if($content['warnings']->isNotEmpty())
    <div class="edu-section-header">
        <h5><i class="fas fa-triangle-exclamation text-warning me-1"></i> Tanda Bahaya yang Perlu Diwaspadai</h5>
        <p>Segera periksakan diri ke dokter jika Anda mengalami gejala berikut</p>
    </div>
    <div class="edu-warning-grid">
        @foreach($content['warnings'] as $warning)
        <div class="edu-warning-item">
            <i class="fas {{ $warning->metaValue('icon', 'fa-circle-exclamation') }} d-block"></i>
            <p>{{ $warning->body }}</p>
        </div>
        @endforeach
    </div>
    @endif

    @if($content['tips']->isNotEmpty())
    <div class="edu-section-header">
        <h5>5 Langkah Pencegahan Penyakit Jantung</h5>
        <p>Terapkan kebiasaan sehat berikut untuk menjaga kesehatan jantung</p>
    </div>
    <div class="edu-tips-grid">
        @foreach($content['tips'] as $tip)
        <div class="edu-tip-card" style="--tip-accent: {{ $tip->metaValue('accent', '#e63946') }}; --tip-accent-soft: {{ $tip->metaValue('accent', '#e63946') }}1a;">
            <div class="edu-tip-icon-wrap">
                <i class="fas {{ $tip->metaValue('icon', 'fa-heart') }}"></i>
            </div>
            <div class="edu-tip-body">
                <h6>{{ $tip->metaValue('value', $loop->iteration) }}. {{ $tip->title }}</h6>
                <p>{{ $tip->body }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($cta)
    <div class="edu-cta">
        <div>
            <h5>{{ $cta->title }}</h5>
            <p>{{ $cta->body }}</p>
        </div>
        <a href="{{ url($cta->metaValue('button_url', '/predict')) }}" class="edu-cta-btn">
            <i class="fas fa-stethoscope"></i> {{ $cta->metaValue('button_text', 'Cek Risiko Sekarang') }}
        </a>
    </div>
    @endif

</div>
@endsection

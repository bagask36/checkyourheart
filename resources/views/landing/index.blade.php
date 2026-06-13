<!doctype html>
<html lang="id" data-layout="vertical" data-topbar="light" data-preloader="disable" data-theme="corporate" data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title>Check Your Heart — Deteksi Dini Risiko Penyakit Jantung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Platform prediksi risiko penyakit jantung berbasis machine learning.">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <script>
        (function () {
            try {
                var theme = localStorage.getItem('data-bs-theme') || sessionStorage.getItem('data-bs-theme');
                if (theme === 'dark') {
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                    sessionStorage.setItem('data-bs-theme', 'dark');
                }
            } catch (e) {}
        })();
    </script>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/landing.css') }}" rel="stylesheet" />
</head>
<body>
@php
    $hero = $content['hero'];
    $cta = $content['cta'];
@endphp

<div class="landing-page">
    <nav class="landing-nav">
        <div class="landing-nav-inner">
            <a href="{{ route('landing') }}" class="landing-logo">
                <span class="landing-logo-icon"><i class="fas fa-heart-pulse"></i></span>
                Check Your Heart
            </a>
            <div class="landing-nav-links">
                <a href="#fitur">Fitur</a>
                <a href="#cara-kerja">Cara Kerja</a>
                <a href="{{ route('login') }}">Masuk</a>
            </div>
            <div class="landing-nav-actions">
                <button type="button" class="landing-theme-btn light-dark-mode" aria-label="Toggle theme">
                    <i class="bx bx-moon"></i>
                </button>
                <a href="{{ route('login') }}" class="landing-btn landing-btn-outline">Masuk</a>
                <a href="{{ route('register') }}" class="landing-btn landing-btn-primary">Daftar</a>
            </div>
        </div>
    </nav>

    <header class="landing-hero">
        <div class="landing-hero-inner reveal-hero">
            <h1>{{ $hero?->title ?? 'Deteksi Dini Risiko Penyakit Jantung' }}</h1>
            <p>{{ $hero?->body }}</p>
            <div class="landing-hero-actions">
                <a href="{{ $hero?->metaValue('button_url', '/register') }}" class="landing-hero-btn main">
                    {{ $hero?->metaValue('button_text', 'Mulai Gratis') }}
                </a>
                <a href="{{ $hero?->metaValue('secondary_url', '/login') }}" class="landing-hero-btn secondary">
                    {{ $hero?->metaValue('secondary_text', 'Sudah punya akun?') }}
                </a>
            </div>
        </div>
    </header>

    @if($content['stats']->isNotEmpty())
    <div class="landing-stats reveal-stats">
        @foreach($content['stats'] as $stat)
        <div class="landing-stat-card">
            <h3>{{ $stat->title }}</h3>
            <p>{{ $stat->body }}</p>
        </div>
        @endforeach
    </div>
    @endif

    <section class="landing-section reveal-section" id="fitur">
        <div class="landing-section-title reveal-title">
            <h2>Fitur Utama</h2>
            <p>Solusi lengkap untuk deteksi dini dan edukasi kesehatan jantung</p>
        </div>
        <div class="landing-features">
            @foreach($content['features'] as $feature)
            <div class="landing-feature-card">
                <div class="landing-feature-icon"><i class="fas {{ $feature->metaValue('icon', 'fa-heart') }}"></i></div>
                <h3>{{ $feature->title }}</h3>
                <p>{{ $feature->body }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="landing-section reveal-section" id="cara-kerja">
        <div class="landing-section-title reveal-title">
            <h2>Cara Kerja</h2>
            <p>Tiga langkah sederhana untuk memulai</p>
        </div>
        <div class="landing-steps">
            @foreach($content['steps'] as $step)
            <div class="landing-step-card">
                <div class="landing-step-num">{{ $step->metaValue('value', $loop->iteration) }}</div>
                <h3>{{ $step->title }}</h3>
                <p>{{ $step->body }}</p>
            </div>
            @endforeach
        </div>
    </section>

    @if($cta)
    <section class="landing-cta reveal-cta">
        <h2>{{ $cta->title }}</h2>
        <p>{{ $cta->body }}</p>
        <a
            href="{{ $cta->metaValue('button_url', '/register') }}"
            class="landing-btn landing-btn-primary landing-hero-btn main"
        >
            {{ $cta->metaValue('button_text', 'Daftar Sekarang') }}
        </a>
    </section>
    @endif

    <footer class="landing-footer">
        &copy; {{ date('Y') }} Check Your Heart — Platform Prediksi Risiko Penyakit Jantung
    </footer>
</div>

<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://unpkg.com/scrollreveal"></script>
<script src="{{ asset('assets/js/theme-persist.js') }}"></script>
<script src="{{ asset('assets/js/pages/landing-reveal.js') }}"></script>
</body>
</html>

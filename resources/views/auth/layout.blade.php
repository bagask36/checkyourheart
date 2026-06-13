<!doctype html>
<html lang="id" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-preloader="disable" data-theme="corporate" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>@yield('auth_title') - Check Your Heart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
@php
    $authContent = $authContent ?? ['brand' => null, 'features' => collect()];
@endphp
    <div class="auth-page">
        {{-- Brand panel --}}
        <div class="auth-brand-panel">
            <div class="auth-brand-content reveal-auth-brand">
                <a href="{{ route('landing') }}" class="auth-logo">
                    <span class="auth-logo-icon"><i class="fas fa-heart-pulse"></i></span>
                    <span class="auth-logo-text">Check Your Heart</span>
                </a>
                <h1>@yield('brand_heading', $authContent['brand']?->title ?? 'Check Your Heart')</h1>
                <p>@yield('brand_description', $authContent['brand']?->body ?? '')</p>
            </div>
            <div class="auth-features">
                @foreach(($authContent['features'] ?? collect()) as $feature)
                <div class="auth-feature-item reveal-auth-feature">
                    <i class="fas {{ $feature->metaValue('icon', 'fa-heart') }}"></i>
                    <span>{{ $feature->body }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Form panel --}}
        <div class="auth-form-panel">
            <button type="button" class="auth-theme-toggle light-dark-mode" aria-label="Toggle dark mode">
                <i class="bx bx-moon fs-20"></i>
            </button>

            <div class="auth-card reveal-auth-card">
                <div class="auth-card-header">
                    <h2>@yield('form_heading')</h2>
                    <p>@yield('form_subheading')</p>
                </div>

                @yield('auth_content')
            </div>

            @hasSection('auth_footer_link')
                <div class="reveal-auth-footer-link">
                    @yield('auth_footer_link')
                </div>
            @endif

            <p class="auth-page-footer reveal-auth-page-footer">
                &copy; {{ date('Y') }} Check Your Heart
            </p>
        </div>
    </div>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="{{ asset('assets/js/theme-persist.js') }}"></script>
    <script src="{{ asset('assets/js/pages/auth-reveal.js') }}"></script>
    @yield('auth_scripts')
</body>
</html>

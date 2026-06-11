@extends('auth.layout')

@section('auth_title', 'Masuk')
@section('brand_heading', 'Jaga Kesehatan Jantung Anda')
@section('brand_description', 'Platform prediksi risiko penyakit jantung untuk membantu deteksi dini dan edukasi kesehatan yang lebih baik.')
@section('form_heading', 'Selamat Datang Kembali')
@section('form_subheading', 'Masuk ke akun Anda untuk melanjutkan')

@section('auth_content')
<form method="POST" action="{{ route('login') }}" class="auth-form needs-validation" novalidate autocomplete="off">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger auth-alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email"
               placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
        <div class="invalid-feedback">Masukkan email Anda.</div>
    </div>

    <div class="mb-3">
        <label for="password-input" class="form-label">Kata Sandi</label>
        <div class="auth-pass-wrap">
            <input type="password" name="password" class="form-control password-input"
                   id="password-input" placeholder="Masukkan kata sandi" required>
            <button class="auth-pass-toggle password-addon" type="button" aria-label="Tampilkan kata sandi">
                <i class="ri-eye-fill"></i>
            </button>
        </div>
        <div class="invalid-feedback">Masukkan kata sandi Anda.</div>
    </div>

    <div class="form-check auth-remember mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="auth-remember-check"
               {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="auth-remember-check">Ingat saya</label>
    </div>

    <button class="auth-submit" type="submit">
        <i class="fas fa-right-to-bracket me-1"></i> Masuk
    </button>
</form>
@endsection

@section('auth_footer_link')
<p class="auth-footer-link">
    Belum punya akun?
    <a href="{{ route('register') }}">Daftar sekarang</a>
</p>
@endsection

@section('auth_scripts')
<script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
@endsection

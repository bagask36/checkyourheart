@extends('auth.layout')

@section('auth_title', 'Daftar')
@section('form_heading', 'Buat Akun Baru')
@section('form_subheading', 'Isi data berikut untuk mendaftar')

@section('auth_content')
<form method="POST" action="{{ route('register') }}" class="auth-form needs-validation" novalidate autocomplete="off">
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
        <label for="name" class="form-label">Nama Lengkap</label>
        <input id="name" type="text" name="name" class="form-control"
               placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
        <div class="invalid-feedback">Masukkan nama Anda.</div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" name="email" class="form-control"
               placeholder="nama@email.com" value="{{ old('email') }}" required>
        <div class="invalid-feedback">Masukkan email yang valid.</div>
    </div>

    <div class="mb-3">
        <label for="password-input" class="form-label">Kata Sandi</label>
        <div class="auth-pass-wrap">
            <input id="password-input" type="password" name="password"
                   class="form-control password-input" placeholder="Minimal 8 karakter"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
            <button class="auth-pass-toggle password-addon" type="button" aria-label="Tampilkan kata sandi">
                <i class="ri-eye-fill"></i>
            </button>
        </div>
        <div class="invalid-feedback">Kata sandi tidak memenuhi persyaratan.</div>
    </div>

    <div class="mb-3">
        <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi</label>
        <input id="password-confirm" type="password" name="password_confirmation"
               class="form-control" placeholder="Ulangi kata sandi" required>
        <div class="invalid-feedback">Konfirmasi kata sandi tidak cocok.</div>
    </div>

    <div class="auth-password-rules" id="password-contain">
        <h6>Kata sandi harus memuat:</h6>
        <p id="pass-length" class="invalid">Minimal <strong>8 karakter</strong></p>
        <p id="pass-lower" class="invalid">Minimal <strong>1 huruf kecil</strong> (a-z)</p>
        <p id="pass-upper" class="invalid">Minimal <strong>1 huruf besar</strong> (A-Z)</p>
        <p id="pass-number" class="invalid">Minimal <strong>1 angka</strong> (0-9)</p>
    </div>

    <p class="auth-terms">
        Dengan mendaftar, Anda menyetujui ketentuan penggunaan layanan Check Your Heart.
    </p>

    <button class="auth-submit register" type="submit">
        <i class="fas fa-user-plus me-1"></i> Daftar
    </button>
</form>
@endsection

@section('auth_footer_link')
<p class="auth-footer-link">
    Sudah punya akun?
    <a href="{{ route('login') }}">Masuk di sini</a>
</p>
@endsection

@section('auth_scripts')
<script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/passowrd-create.init.js') }}"></script>
@endsection

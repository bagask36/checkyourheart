<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Sign Up - Check Your Heart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="@yield('description', '')" />
    <meta name="author" content="Themesbrand" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="auth-page-wrapper pt-5">

        <!-- background & shape -->
        <div class="auth-one-bg-position bg-primary" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 1440 120"
                     fill="#4064dc">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z" />
                </svg>
            </div>
        </div>

        <!-- form container -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">
                            <div class="card-body p-4">

                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create New Account</h5>
                                    <p class="text-muted">Get your free Account</p>
                                </div>

                                <div class="p-2 mt-4">
                                    <form method="POST"
                                          action="{{ route('register') }}"
                                          class="needs-validation"
                                          novalidate
                                          autocomplete="off">
                                        @csrf

                                        {{-- Global errors --}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger mt-1">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        {{-- Name --}}
                                        <div class="mb-3">
                                            <label for="name" class="form-label">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input id="name"
                                                   type="text"
                                                   name="name"
                                                   class="form-control"
                                                   placeholder="Enter your full name"
                                                   value="{{ old('name') }}"
                                                   required
                                                   autofocus>
                                            <div class="invalid-feedback">
                                                Please enter your name.
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="mb-3">
                                            <label for="email" class="form-label">
                                                Email <span class="text-danger">*</span>
                                            </label>
                                            <input id="email"
                                                   type="email"
                                                   name="email"
                                                   class="form-control"
                                                   placeholder="Enter email address"
                                                   value="{{ old('email') }}"
                                                   required>
                                            <div class="invalid-feedback">
                                                Please enter a valid email.
                                            </div>
                                        </div>

                                        {{-- Password --}}
                                        <div class="mb-3">
                                            <label for="password-input" class="form-label">
                                                Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input id="password-input"
                                                       type="password"
                                                       name="password"
                                                       class="form-control pe-5 password-input"
                                                       placeholder="Enter password"
                                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                       required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                        type="button"
                                                        id="password-addon">
                                                    <i class="ri-eye-fill align-middle"></i>
                                                </button>
                                                <div class="invalid-feedback">
                                                    Please enter a valid password.
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Confirm Password --}}
                                        <div class="mb-3">
                                            <label for="password-confirm" class="form-label">
                                                Confirm Password <span class="text-danger">*</span>
                                            </label>
                                            <input id="password-confirm"
                                                   type="password"
                                                   name="password_confirmation"
                                                   class="form-control"
                                                   placeholder="Confirm password"
                                                   required>
                                            <div class="invalid-feedback">
                                                Password confirmation does not match.
                                            </div>
                                        </div>

                                        {{-- Terms --}}
                                        <div class="mb-4">
                                            <p class="mb-0 fs-12 text-muted fst-italic">
                                                By registering you agree to the
                                                <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">
                                                    Terms of Use
                                                </a>
                                            </p>
                                        </div>

                                        {{-- Password strength --}}
                                        <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">
                                                Minimum <b>8 characters</b>
                                            </p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">
                                                At least <b>1 lowercase</b> letter (a-z)
                                            </p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">
                                                At least <b>1 uppercase</b> letter (A-Z)
                                            </p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">
                                                At least <b>1 number</b> (0-9)
                                            </p>
                                        </div>

                                        {{-- Submit --}}
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">
                                                Sign Up
                                            </button>
                                        </div>

                                        {{-- Social --}}
                                        <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title text-muted">
                                                    Create account with
                                                </h5>
                                            </div>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-primary btn-icon waves-effect waves-light">
                                                    <i class="ri-facebook-fill fs-16"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-icon waves-effect waves-light">
                                                    <i class="ri-google-fill fs-16"></i>
                                                </button>
                                                <button type="button" class="btn btn-dark btn-icon waves-effect waves-light">
                                                    <i class="ri-github-fill fs-16"></i>
                                                </button>
                                                <button type="button" class="btn btn-info btn-icon waves-effect waves-light">
                                                    <i class="ri-twitter-fill fs-16"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <p class="mb-0">
                                Already have an account ?
                                <a href="{{ route('login') }}"
                                   class="fw-semibold text-primary text-decoration-underline">
                                    Signin
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer class="footer">
            <div class="container text-center">
                <p class="mb-0 text-muted">
                    &copy; <script>document.write(new Date().getFullYear())</script>
                    Check Your Heart <i class="mdi mdi-heart text-danger"></i>
                </p>
            </div>
        </footer>

    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!-- particles -->
    <script src="{{ asset('assets/libs/particles.js/particles.js') }}"></script>
    <script src="{{ asset('assets/js/pages/particles.app.js') }}"></script>

    <!-- init validation & password-strength -->
    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/passowrd-create.init.js') }}"></script>
</body>
</html>
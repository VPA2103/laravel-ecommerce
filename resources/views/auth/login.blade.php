@extends('layouts.app')

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="login-register container">
        <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore active" id="login-tab" data-bs-toggle="tab" href="#tab-item-login"
                    role="tab" aria-controls="tab-item-login" aria-selected="true">Login</a>
            </li>
        </ul>
        <div class="tab-content pt-2" id="login_register_tab_content">
            <div class="tab-pane fade show active" id="tab-item-login" role="tabpanel" aria-labelledby="login-tab">
                <div class="login-form">
                    <form method="POST" action="{{route('login')}}" name="login-form" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="form-control form-control_gray @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" required="" autocomplete="email"
                                autofocus="">
                            <label for="email">Email address *</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="pb-3"></div>

                        <!-- <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control form-control_gray @error('password') is-invalid @enderror" name="password" required=""
                                autocomplete="current-password">
                            <label for="customerPasswodInput">Password *</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  -->

                        <div class="form-floating mb-3 position-relative">
                            <input id="password" type="password"
                                class="form-control form-control_gray pe-5 @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">
                            <label for="password">Password *</label>

                            <!-- Nút icon nằm trong input -->
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                style="cursor: pointer; z-index: 2;" onclick="togglePassword()">
                                <i id="toggleIcon" class="bi bi-eye" style="font-size: 1.2rem;"></i>
                            </span>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Log In</button>
                        <div class="text-center my-3">
                            <span class="text-secondary">or</span>
                        </div>

                        <div class="flex">
                            <a title="Login with Google" href="{{ route('auth.redirection','google') }}" class="btn btn-google w-100 text-uppercase mb-3 d-flex align-items-center justify-content-center">
                                <i class="fab fa-google me-2"></i>
                                <span>Sign in with Google</span>
                            </a>
                            <a title="Login with Facebook" href="{{ route('auth.redirection','facebook') }}" class="btn btn-primary btn-facebook w-100 text-uppercase mb-3 d-flex align-items-center justify-content-center">
                                <i class="fab fa-facebook me-2"></i>
                                <span>Sign in with Facebook</span>
                            </a>
                        </div>
                        <div class="customer-option mt-4 text-center">
                            <span class="text-secondary">No account yet?</span>
                            <a href="{{route('register')}}" class="btn-text js-show-register">Create Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<style>
    .btn-google {
        background-color: #c62828 !important;
        color: white !important;
        border: none;
    }

    .btn-google:hover {
        background-color: #b71c1c !important;
        color: white !important;
    }

    .btn-facebook {
        background-color: #3b5998 !important;
        color: white !important;
        border: none;
        width: 100%;
        text-align: center;
        padding: 10px;
        text-transform: uppercase;
    }

    .btn-facebook:hover {
        background-color: #344e86 !important;
        color: white !important;
    }
</style>
</div>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("toggleIcon");
        const isPassword = passwordInput.type === "password";

        passwordInput.type = isPassword ? "text" : "password";
        toggleIcon.className = isPassword ? "bi bi-eye-slash" : "bi bi-eye";
    }
</script>
@endsection


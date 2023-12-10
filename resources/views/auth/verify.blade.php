<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('member.partials._head')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hope-ui.css?v=1.0') }}">
</head>

<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">
                <div class="col-md-6 p-0">
                    <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
                        <div class="card-body">
                            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center mb-3">
                                <img src="{{ asset('images/icons/surabaya.png') }}" alt="logo" class="img-fluid"
                                    style="max-width: 150px; max-height: 50px;">
                                <h4 class="logo-title ms-2">Perpustakaan Wonorejo RW 08</h4>
                            </a>

                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Link verifikasi telah dikirimkan ke email anda.') }}
                                </div>
                            @endif
                            <p class="cnf-mail mb-1">Sebelum memulai, harap cek email anda</p>
                            <p class="cnf-mail mb-1">Jika anda tidak menerima email</p>
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('Tekan sini untuk meminta lagi') }}</button>.
                            </form>
                            <div class="d-inline-block w-100  d-flex align-center">
                                <p class="mb-2 mt-2">Atau</p>
                            </div>
                            <div class="d-inline-block w-100">
                                <a class="btn btn-primary" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Keluar') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="{{ asset('images/auth/05.png') }}" class="img-fluid gradient-main animated-scaleX"
                        alt="images">
                </div>
            </div>
        </section>
    </div>
</body>

</html>

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
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                                <div class="card-body">
                                    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/icons/surabaya.png') }}" alt="logo"
                                            class="img-fluid" style="max-width: 150px; max-height: 50px;">
                                        <h4 class="logo-title ms-2">Perpustakaan Wonorejo RW 08</h4>
                                    </a>
                                    <h2 class="mb-2 text-center">Masuk</h2>
                                    <p class="text-center">Masuk untuk meminjam buku di perpustakaan Wonorejo RW 8</p>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('login') }}" data-toggle="validator">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>

                                                    <input id="email" type="email" name="email"
                                                        value="{{ old('email') }}"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="20081010107@gmail.com" required autofocus>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Password</label>

                                                    <input class="form-control @error('password') is-invalid @enderror"
                                                        type="password" placeholder="********" name="password" required
                                                        autocomplete="current-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" type="checkbox" class="form-check-input"
                                                        id="remember" name="remember"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">Ingat
                                                        Saya</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <a href="{{ route('password.request') }}" class="float-end mb-3">Lupa
                                                    Password?</a>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">{{ __('Masuk') }}</button>
                                        </div>

                                        <p class="mt-3 text-center">
                                            Tidak memiliki akun? <a href="{{ route('register') }}"
                                                class="text-underline">Klik disini untuk mendaftar.</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="{{ asset('images/auth/01.png') }}" class="img-fluid gradient-main animated-scaleX"
                        alt="images">
                </div>
            </div>
        </section>
    </div>
</body>

</html>

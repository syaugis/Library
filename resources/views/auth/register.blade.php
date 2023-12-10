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
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="{{ asset('images/auth/05.png') }}" class="img-fluid gradient-main animated-scaleX"
                        alt="images">
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
                                <div class="card-body">
                                    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/icons/surabaya.png') }}" alt="logo"
                                            class="img-fluid" style="max-width: 150px; max-height: 50px;">
                                        <h4 class="logo-title ms-2">Perpustakaan Wonorejo RW 08</h4>
                                    </a>
                                    <h2 class="mb-2 text-center">Daftar</h2>
                                    <p class="text-center">Buat akun perpustakaan anda.</p>

                                    {!! Form::open(['route' => ['register'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Nama <span class="text-danger">*</span></label>
                                                {!! Form::text('name', old('name'), [
                                                    'id' => 'username',
                                                    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                                    'placeholder' => 'Nama Lengkap Anda',
                                                    'autofocus',
                                                    'required',
                                                ]) !!}

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                {!! Form::email('email', old('email'), [
                                                    'id' => 'email',
                                                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                                                    'placeholder' => 'Alamat Email Anda',
                                                    'autofocus',
                                                    'required',
                                                ]) !!}

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="full-name" class="form-label">Jenis Kelamin <span
                                                        class="text-danger">*</span></label>

                                                {!! Form::select('gender', ['M' => 'Laki-Laki', 'F' => 'Perempuan'], old('gender'), [
                                                    'id' => 'gender',
                                                    'class' => 'form-control' . ($errors->has('gender') ? ' is-invalid' : ''),
                                                    'placeholder' => 'Pilih Jenis Kelamin Anda',
                                                    'autofocus',
                                                    'required',
                                                ]) !!}

                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="birth_date">Ulang Tahun<span
                                                        class="text-danger">*</span></label>
                                                {!! Form::date('birth_date', old('birth_date'), [
                                                    'id' => 'birth_date',
                                                    'class' => 'form-control' . ($errors->has('birth_date') ? ' is-invalid' : ''),
                                                    'placeholder' => 'User Birth Date',
                                                    'autofocus',
                                                    'required',
                                                ]) !!}

                                                @error('birth_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="address">Alamat Rumah<span
                                                        class="text-danger">*</span></label>
                                                {!! Form::text('address', old('address'), [
                                                    'id' => 'address',
                                                    'class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''),
                                                    'placeholder' => 'Alamat Rumah Anda',
                                                    'autofocus',
                                                    'required',
                                                ]) !!}

                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="phone_number">Nomor Handphone<span
                                                        class="text-danger">*</span></label>
                                                {!! Form::tel('phone_number', old('phone_number'), [
                                                    'id' => 'phone_number',
                                                    'class' => 'form-control' . ($errors->has('phone_number') ? ' is-invalid' : ''),
                                                    'placeholder' => 'Nomor Handphone Anda',
                                                    'pattern' => '^(\+?62|0)[8]{1}[0-9]{9,12}$',
                                                    'autofocus',
                                                    'required',
                                                ]) !!}

                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password</label>
                                                {!! Form::password('password', [
                                                    'id' => 'password',
                                                    'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                                                    'placeholder' => '********',
                                                    'autofocus',
                                                    'autocomplete' => 'new-password',
                                                ]) !!}

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password-confirm" class="form-label">Konfirmasi
                                                    Password</label>
                                                <input id="password-confir" class="form-control" type="password"
                                                    placeholder="********" name="password_confirmation" required
                                                    autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Daftar') }}</button>
                                    </div>

                                    <p class="mt-3 text-center">
                                        Sudah memiliki akun? <a href="{{ route('login') }}"
                                            class="text-underline">Masuk</a>
                                    </p>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>

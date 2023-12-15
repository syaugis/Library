<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('member.partials._head')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            @include('member.partials._nav')
        </nav>
    </div>
    <main>
        <div class="content">
            <div class="container" style="margin-bottom:18rem;">
                <div class="row justify-content-center">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary mb-4 mt-4"><i
                                    class="fa fa-arrow-left"></i>
                                Kembali</a>
                        </div>

                        <div class="col-md-12 mb-5">
                            @if (!empty($data))
                                <div class="card elevation shadow-0 border rounded mb-5">
                                    <div class="card-body">
                                        <div class="col-md-12 d-flex justify-content-center mb-3">
                                            <h4 class="pt-2">
                                                <i class="fa fa-user small"></i> &nbsp; Profil Pengguna
                                            </h4>
                                        </div>
                                        {!! Form::model($data, [
                                            'route' => ['member.profile.update', $id],
                                            'method' => 'put',
                                            'enctype' => 'multipart/form-data',
                                        ]) !!}

                                        <div class="form-group mb-3">
                                            <label for="username">{{ __('Nama Lengkap') }}<span
                                                    class="text-danger">*</span></label>
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

                                        <div class="form-group mb-3">
                                            <label for="email">{{ __('Alamat Email') }}<span
                                                    class="text-danger">*</span></label>
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

                                        <div class="form-group mb-3">
                                            <label for="gender">{{ __('Jenis Kelamin') }}<span
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

                                        <div class="form-group mb-3">
                                            <label for="birth_date">{{ __('Ulang Tahun') }}<span
                                                    class="text-danger">*</span></label>
                                            {!! Form::date('birth_date', old('birth_date'), [
                                                'id' => 'birth_date',
                                                'class' => 'form-control' . ($errors->has('birth_date') ? ' is-invalid' : ''),
                                                'autofocus',
                                                'required',
                                            ]) !!}

                                            @error('birth_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="address">{{ __('Alamat Rumah') }}<span
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

                                        <div class="form-group mb-3">
                                            <label for="phone_number">{{ __('Nomor Handphone') }}<span
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

                                        <div class="form-group mb-3">
                                            <label for="profile_image">{{ __('Foto Profil') }}</label>
                                            {!! Form::file('profile_image', [
                                                'id' => 'profile_image',
                                                'class' => 'form-control' . ($errors->has('profile_image') ? ' is-invalid' : ''),
                                                'accept' => 'image/jpeg,image/png,image/jpg',
                                            ]) !!}

                                            @error('profile_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="password">{{ __('Password') }}</label>
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

                                        <button type="submit" class="btn btn-primary mt-2">Ubah Profil</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endif
                            @if (empty($data))
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="text-center">Tidak dapat menampilan data</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('member.partials._footer')
</body>

</html>

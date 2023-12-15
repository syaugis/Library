<x-app-admin-layout :assets="$assets ?? []">
    <div>
        <?php
        $id = $id ?? null;
        ?>
        @if (isset($id))
            {!! Form::model($data, [
                'route' => ['admin.user.update', $id],
                'method' => 'put',
                'enctype' => 'multipart/form-data',
            ]) !!}
        @else
            {!! Form::open(['route' => ['admin.user.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @endif
        <div class="row">
            @empty(!$id)
                <div class="col-xl-9 col-lg-8">
                @endempty
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $id !== null ? 'Update' : 'New' }} User</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-primary"
                                role="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label" for="username">User Name<span
                                        class="text-danger">*</span></label>
                                {!! Form::text('name', old('name'), [
                                    'id' => 'username',
                                    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                    'placeholder' => 'User Name',
                                    'autofocus',
                                    'required',
                                ]) !!}

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="form-label" for="email">User Email Address<span
                                        class="text-danger">*</span></label>
                                {!! Form::email('email', old('email'), [
                                    'id' => 'email',
                                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                                    'placeholder' => 'User Email Address',
                                    'autofocus',
                                    'required',
                                ]) !!}

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="form-label" for="gender">User Gender<span
                                        class="text-danger">*</span></label>
                                {!! Form::select('gender', ['M' => 'Male', 'F' => 'Female'], old('gender'), [
                                    'id' => 'gender',
                                    'class' => 'form-control' . ($errors->has('gender') ? ' is-invalid' : ''),
                                    'placeholder' => 'Select the user gender',
                                    'autofocus',
                                    'required',
                                ]) !!}

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="form-label" for="birth_date">User Birth Date<span
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

                            <div class="form-group col-md-12">
                                <label class="form-label" for="address">User Address<span
                                        class="text-danger">*</span></label>
                                {!! Form::text('address', old('address'), [
                                    'id' => 'address',
                                    'class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''),
                                    'placeholder' => 'User Address',
                                    'autofocus',
                                    'required',
                                ]) !!}

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label class="form-label" for="phone_number">User Phone Number<span
                                        class="text-danger">*</span></label>
                                {!! Form::tel('phone_number', old('phone_number'), [
                                    'id' => 'phone_number',
                                    'class' => 'form-control' . ($errors->has('phone_number') ? ' is-invalid' : ''),
                                    'placeholder' => 'User Phone Number',
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

                            <div class="form-group col-md-12">
                                <label class="form-label" for="profile_image">User Profile Image</label>
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

                            <div class="form-group col-md-12">
                                <label class="form-label" for="password">Password</label>
                                {!! Form::password('password', [
                                    'id' => 'password',
                                    'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                                    'placeholder' => 'User Password',
                                    'autofocus',
                                    'autocomplete' => 'off',
                                ]) !!}

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">{{ $id !== null ? 'Update' : 'Add' }}
                            User</button>
                    </div>
                </div>

                @empty(!$id)
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <p class="mb-0"><b>Created at</b></p>
                                    <p class="mb-2">
                                        {{ $data->created_at == null ? '-' : \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                    </p>
                                    <p class="mb-0"><b>Last modified at</b></p>
                                    <p class="mb-0">
                                        {{ $data->updated_at == null ? '-' : \Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endempty
        </div>
        {!! Form::close() !!}
    </div>
</x-app-admin-layout>

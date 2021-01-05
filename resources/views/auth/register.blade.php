@extends('master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> {{ trans('header.home') }}</a>
                        <span>{{ trans('make_auth.register') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="register-form">
                        <h2>{{ trans('make_auth.register') }}</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="first_name">{{ trans('make_auth.first_name') }} *</label>
                                                <input class="@error('first_name') is-invalid @enderror" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="midd_name">{{ trans('make_auth.midd_name') }} *</label>
                                                <input class="@error('midd_name') is-invalid @enderror" type="text" id="midd_name" name="midd_name" value="{{ old('midd_name') }}" required autocomplete="midd_name" autofocus>

                                                @error('midd_name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="group-input">
                                        <label for="last_name">{{ trans('make_auth.last_name') }} *</label>
                                        <input class="@error('last_name') is-invalid @enderror" type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="gender">{{ trans('make_auth.gender') }} *</label>
                                                <select class="@error('gender') is-invalid @enderror" id="gender" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                                    <option value="{{ config('user.gender.male') }}">{{ trans('make_auth.male') }}</option>
                                                    <option value="{{ config('user.gender.female') }}">{{ trans('make_auth.female') }}</option>
                                                </select>
                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="birthday">{{ trans('make_auth.birthday') }} *</label>
                                                <input class="@error('birthday') is-invalid @enderror" type="date" id="birthday" name="birthday" value="{{ old('birthday') }}" required autocomplete="birthday" autofocus>

                                                @error('birthday')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="group-input">
                                        <label for="phone">{{ trans('make_auth.phone') }} *</label>
                                        <input type="text" id="phone" name="phone" class=" @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required autocomplete="phone">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="city">{{ trans('make_auth.city') }} *</label>
                                                <select class="@error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
                                                    @foreach($provinces as $province)
                                                        <option value="{{ $province }}">{{ $province }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="district">{{ trans('make_auth.district') }} *</label>
                                                <select class="@error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district') }}" required autocomplete="district" autofocus>
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district }}">{{ $district }}</option>
                                                    @endforeach
                                                </select>
                                                @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="street">{{ trans('make_auth.street') }} *</label>
                                                <input class="@error('street') is-invalid @enderror" type="text" id="street" name="street" value="{{ old('street') }}" required autocomplete="street" autofocus>

                                                @error('street')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="apartment_number">{{ trans('make_auth.apartment_number') }} *</label>
                                                <input class="@error('apartment_number') is-invalid @enderror" type="string" id="apartment_number" name="apartment_number" value="{{ old('apartment_number') }}" required autocomplete="apartment_number" autofocus>

                                                @error('apartment_number')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="email">{{ trans('make_auth.username_or_mail') }} *</label>
                                        <input type="email" id="email" name="email" class=" @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="group-input">
                                        <label for="username">{{ trans('make_auth.username') }} *</label>
                                        <input type="text" id="username" name="username" class=" @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username">

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="group-input">
                                        <label for="password">{{ trans('make_auth.password') }} *</label>
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="group-input">
                                        <label for="con-pass">{{ trans('make_auth.confirm_password') }} *</label>
                                        <input type="password" id="con-pass" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="site-btn register-btn">{{ trans('make_auth.register') }}</button>
                        </form>
                        <div class="switch-login">
                            <a href="{{ route('login') }}" class="or-login">{{ trans('make_auth.or_login') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection

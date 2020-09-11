@extends('master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> {{ trans('lang.home') }}</a>
                        <span>{{ trans('lang.register') }}</span>
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
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>{{ trans('lang.register') }}</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="group-input">
                                <label for="name">{{ trans('lang.name') }} *</label>
                                <input class=" @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="email">{{ trans('lang.username_or_mail') }} *</label>
                                <input type="email" id="email" name="email" class=" @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="password">{{ trans('lang.password') }} *</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="con-pass">{{ trans('lang.confirm_password') }} *</label>
                                <input type="password" id="con-pass" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <button type="submit" class="site-btn register-btn">{{ trans('lang.register') }}</button>
                        </form>
                        <div class="switch-login">
                            <a href="{{ route('login') }}" class="or-login">{{ trans('lang.or_login') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection

@extends ('master')

@section ('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> {{ trans('header.home') }}</a>
                        <span>{{ trans('make_auth.login') }}</span>
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
                    <div class="login-form">
                        <h2>{{ trans('make_auth.login') }}</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="group-input">
                                <label for="username">Username *</label>
                                <input id="username" class="@error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" required>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="pass">{{ trans('make_auth.password') }} *</label>
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="remember">
                                        {{ trans('make_auth.save_password') }}
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="#" class="forget-pass">{{ trans('make_auth.forget_your_password') }}</a>
                                </div>
                            </div>
                            <button type="submit" id="button-login" class="site-btn login-btn">{{ trans('make_auth.sign_in') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection

@extends ('master')

@section ('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> {{ trans('header.home') }}</a>
                        <span>{{ trans('text.change_password') }}</span>
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
                        <h2>{{ trans('text.change_password') }}</h2>
                        <form method="POST" action="{{ route('user.change.password') }}">
                            @csrf
                            @method('PUT')
                            <div class="group-input">
                                <label for="old_password">{{ trans('text.old_password') }} *</label>
                                <input id="old_password" type="password" class="@error('old_password') is-invalid @enderror" name="old_password" value="{{ old('old_password') }}" autocomplete="old_password" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="new_password">{{ trans('text.new_password') }} *</label>
                                <input id="new_password" type="password" class="@error('new_password') is-invalid @enderror" name="new_password" autocomplete="new_password">

                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="confirm_password">{{ trans('make_auth.confirm_password') }} *</label>
                                <input id="confirm_password" type="password" class="@error('confirm_password') is-invalid @enderror" name="confirm_password" autocomplete="confirm_password">

                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="site-btn login-btn">{{ trans('text.update') }}</button>
                        </form>
                        <div class="switch-login">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="or-login">{{ trans('text.create_an_account') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection

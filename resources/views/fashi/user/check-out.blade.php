@extends('master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="#"><i class="fa fa-home"></i>{{ trans('header.home') }}</a>
                        <a href="#">{{ trans('header.shop') }}</a>
                        <span>{{ trans('text.check_out') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form method="POST" class="checkout-form" action="{{ route('create_order') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <h4>{{ trans('text.billing_details') }}</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="receiver">{{ trans('text.receiver') }}<span>*</span></label>
                                <input type="text" class="mb-3 @error ('receiver') is-invalid @enderror" id="receiver" name="receiver" value="@if (isset($user)) {{ $user->first_name . ' ' . $user->midd_name . ' ' . $user->last_name }} @endif {{ old('receiver') }}">
                                @error ('receiver')
                                    <span>
                                        <strong class="error-color">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label for="phone">{{ trans('text.phone') }}<span>*</span></label>
                                <input type="text" class="mb-3 @error ('phone') is-invalid @enderror" id="phone" name="phone" value="@if(isset($user)) {{ $user->customer->phone }} @endif {{ old('phone') }}">
                                @error ('phone')
                                <span>
                                        <strong class="error-color">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label for="address">{{ trans('text.address') }}<span>*</span></label>
                                <input type="text" class="mb-3 @error ('address') is-invalid @enderror" id="address" name="address" value="@if(isset($user)) {{ $user->apartment_number . ' - ' . $user->street . ' - ' . $user->district . ' - ' . $user->city}} @endif {{ old('address') }}">
                                @error ('address')
                                    <span>
                                        <strong class="error-color">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>{{ trans('text.your_order') }}</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>{{ trans('text.product') }}<span>{{ trans('text.total') }}</span></li>
                                    @php $totalPrice = 0; @endphp
                                    @if (isset($cart))
                                        @foreach ($cart as $productCart)
                                            <li class="fw-normal">{{ $productCart['name'] }} x {{ $productCart['quantity'] }} ({{ $productCart['color'] }} - {{ $productCart['size'] }}) <span>${{ $subTotal = $productCart['price'] * $productCart['quantity'] }}</span></li>
                                            @php $totalPrice += $subTotal; @endphp
                                        @endforeach
                                    @endif
                                    <li class="total-price">{{ trans('text.total') }}<span>${{ $totalPrice }}</span></li>
                                </ul>
                                <div class="order-btn">
                                    <button type="submit" @if (!isset($cart)) disabled="" @endif class="site-btn place-btn">{{ trans('text.place_order') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

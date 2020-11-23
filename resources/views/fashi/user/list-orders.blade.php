@extends('master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="#"><i class="fa fa-home"></i>{{ trans('header.home') }}</a>
                        <span>{{ trans('text.profile') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-form">
                        @csrf
                        @method('PUT')
                        <div class="place-order">
                            <h4>{{ trans('text.history_order') }}</h4>
                            <div class="container mt-3">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li>
                                        <a class="nav-link active color-nav order-tab" data-toggle="tab" href="#home">{{ trans('text.pending') }}</a>
                                    </li>
                                    <li>
                                        <a class="nav-link color-nav order-tab" data-toggle="tab" href="#menu1">{{ trans('text.success') }}</a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="home" class="container tab-pane active pre-scrollable"><br>
                                        @foreach ($ordersPending as $key => $order)
                                            <div class="order-total">
                                                <ul class="order-table">
                                                    <li>{{ trans('text.order') }} ({{ $key }})<span>{{ trans('text.total') }}</span></li>
                                                    @php $totalPrice = 0; @endphp
                                                    @foreach ($order->orderDetails as $orderDetail)
                                                        <li class="fw-normal">{{ $orderDetail->productDetail->product->name }} x {{ $orderDetail->quantity }} ({{ $orderDetail->productDetail->color }}) <span>${{ $subTotal = $orderDetail->productDetail->product->price * $orderDetail->quantity }}</span></li>
                                                        @php $totalPrice += $subTotal; @endphp
                                                    @endforeach
                                                    <li class="total-price">{{ trans('text.total') }}<span>${{ $totalPrice }}</span></li>
                                                </ul>
                                                <form method="POST" action="{{ route('orders.cancel', $order->id) }}">
                                                    @csrf
                                                    <div class="order-btn">
                                                        <button type="submit" class="site-btn place-btn">{{ trans('text.cancel') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                    <div id="menu1" class="container tab-pane fade pre-scrollable"><br>
                                        @foreach ($ordersSuccess as $key => $order)
                                            <div class="order-total">
                                                <ul class="order-table">
                                                    <li>{{ trans('text.order') }} ({{ $key + 1 }})<span>{{ trans('text.total') }}</span></li>
                                                    @php $totalPrice = 0; @endphp
                                                    @foreach ($order->orderDetails as $orderDetail)
                                                        <li class="fw-normal">{{ $orderDetail->productDetail->product->name }} x {{ $orderDetail->quantity }} ({{ $orderDetail->productDetail->color }}) <span>${{ $subTotal = $orderDetail->productDetail->product->price * $orderDetail->quantity }}</span></li>
                                                        @php $totalPrice += $subTotal; @endphp
                                                    @endforeach
                                                    <li class="total-price">{{ trans('text.total') }}<span>${{ $totalPrice }}</span></li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

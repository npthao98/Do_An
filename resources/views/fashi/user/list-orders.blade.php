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
                                        <a class="nav-link color-nav order-tab" data-toggle="tab" href="#menu1">{{ trans('text.shipping') }}</a>
                                    </li>
                                    <li>
                                        <a class="nav-link color-nav order-tab" data-toggle="tab" href="#menu2">{{ trans('text.success') }}</a>
                                    </li>
                                    <li>
                                        <a class="nav-link color-nav order-tab" data-toggle="tab" href="#menu3">{{ trans('text.canceled') }}</a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="home" class="container tab-pane active pre-scrollable"><br>
                                        @foreach ($ordersPending as $key => $order)
                                            <div class="order-total">
                                                <ul class="order-table">
                                                    <li>{{ trans('text.order') }} ({{ $key }})<span>{{ trans('text.total') }}</span></li>
                                                    @foreach ($order->items as $item)
                                                        <li class="fw-normal">{{ $item->productInfor->product->name }} x {{ $item->quantity }} ({{ $item->productInfor->color . '-' . $item->productInfor->size}})
                                                            <span>${{ number_format($subTotal = $item->price_sale * $item->quantity) }}</span></li>
                                                    @endforeach
                                                    <li class="fw-normal">@lang('payment.shipment.type_shipment')({{ $order->type_shipment }})
                                                        <span>${{ number_format($order->fee_shipment) }}</span></li>
                                                    <li class="total-price">{{ trans('text.total') }}<span>${{ number_format($order->total_price) }}</span></li>
                                                    <li class="fw-normal">@lang('payment.payment.type_payment')<span>{{ $order->type_payment }}</span></li>
                                                    <p class="mt-4">{{ $order->receiver . ' - ' . $order->phone . ' - ' . trans('text.address') . ': ' . $order->address}}</p>
                                                </ul>
                                                <form method="POST" action="{{ route('orders.cancel', $order->id) }}">
                                                    @csrf
                                                    <div class="order-btn">
                                                        <button type="submit" onclick="return confirmCancel()" class="site-btn place-btn">{{ trans('text.cancel') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                    <div id="menu1" class="container tab-pane fade pre-scrollable"><br>
                                        @foreach ($ordersShipping as $key => $order)
                                            <div class="order-total">
                                                <ul class="order-table">
                                                    <li>{{ trans('text.order') }} ({{ $key + 1 }})<span>{{ trans('text.total') }}</span></li>
                                                    @foreach ($order->items as $item)
                                                        <li class="fw-normal">{{ $item->productInfor->product->name }} x {{ $item->quantity }} ({{ $item->productInfor->color . '-' . $item->productInfor->size}})
                                                            <span>${{ number_format($subTotal = $item->price_sale * $item->quantity) }}</span></li>
                                                    @endforeach
                                                    <li class="fw-normal">@lang('payment.shipment.type_shipment')({{ $order->type_shipment }})
                                                        <span>${{ number_format($order->fee_shipment) }}</span></li>
                                                    <li class="total-price">{{ trans('text.total') }}<span>${{ number_format($order->total_price) }}</span></li>
                                                    <li class="fw-normal">@lang('payment.payment.type_payment')<span>{{ $order->type_payment }}</span></li>
                                                    <p class="mt-4">{{ $order->receiver . ' - ' . $order->phone . ' - ' . trans('text.address') . ': ' . $order->address}}</p>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="menu2" class="container tab-pane fade pre-scrollable"><br>
                                        @foreach ($ordersSuccess as $key => $order)
                                            <div class="order-total">
                                                <ul class="order-table">
                                                    <li>{{ trans('text.order') }} ({{ $key + 1 }})<span>{{ trans('text.total') }}</span></li>
                                                    @foreach ($order->items as $item)
                                                        <li class="fw-normal">{{ $item->productInfor->product->name }} x {{ $item->quantity }} ({{ $item->productInfor->color . '-' . $item->productInfor->size}})
                                                            <span>${{ number_format($subTotal = $item->price_sale * $item->quantity) }}</span></li>
                                                    @endforeach
                                                    <li class="fw-normal">@lang('payment.shipment.type_shipment')({{ $order->type_shipment }})
                                                        <span>${{ number_format($order->fee_shipment) }}</span></li>
                                                    <li class="total-price">{{ trans('text.total') }}<span>${{ number_format($order->total_price) }}</span></li>
                                                    <li class="fw-normal">@lang('payment.payment.type_payment')<span>{{ $order->type_payment }}</span></li>
                                                    <p class="mt-4">{{ $order->receiver . ' - ' . $order->phone . ' - ' . trans('text.address') . ': ' . $order->address}}</p>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="menu3" class="container tab-pane fade pre-scrollable"><br>
                                        @foreach ($ordersCanceled as $key => $order)
                                            <div class="order-total">
                                                <ul class="order-table">
                                                    <li>{{ trans('text.order') }} ({{ $key + 1 }})<span>{{ trans('text.total') }}</span></li>
                                                    @foreach ($order->items as $item)
                                                        <li class="fw-normal">{{ $item->productInfor->product->name }} x {{ $item->quantity }} ({{ $item->productInfor->color . '-' . $item->productInfor->size}})
                                                            <span>${{ number_format($subTotal = $item->price_sale * $item->quantity) }}</span></li>
                                                    @endforeach
                                                    <li class="fw-normal">@lang('payment.shipment.type_shipment')({{ $order->type_shipment }})
                                                        <span>${{ number_format($order->fee_shipment) }}</span></li>
                                                    <li class="total-price">{{ trans('text.total') }}<span>${{ number_format($order->total_price) }}</span></li>
                                                    <li class="fw-normal">@lang('payment.payment.type_payment')<span>{{ $order->type_payment }}</span></li>
                                                    <p class="mt-4">{{ $order->receiver . ' - ' . $order->phone . ' - ' . trans('text.address') . ': ' . $order->address}}</p>
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
@endsection
@section('javascript')
    <script>
        function confirmCancel() {
            return confirm('Do you want to cancel this order?');
        }
    </script>
@endsection

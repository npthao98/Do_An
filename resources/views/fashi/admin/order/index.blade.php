@extends('admin_master')

@section('content')
<br>
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('text.order') }}</h1>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <table id="example" class="table table-striped table-bordered table-width">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.phone') }}</th>
                <th>{{ trans('text.quantity') }}</th>
                <th>{{ trans('text.total_price') }}</th>
                <th>{{ trans('text.order_date') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $order->receiver ?? '' }}</td>
                    <td>{{ $order->phone ?? '' }}</td>
                    <td>
                        @php $totalQuantity = 0; @endphp
                        @foreach ($order->items as $item)
                            @php $totalQuantity += $item->quantity; @endphp
                        @endforeach
                        {{ $totalQuantity ?? ''}}
                    </td>
                    <td>
                        @php $totalPrice = 0; @endphp
                        @foreach ($order->items as $item)
                            @php
                                $quantity = $item->quantity;
                                $price = $item->productInfor->product->price_sale;
                                $subTotal = $quantity * $price;
                                $totalPrice += $subTotal;
                            @endphp
                        @endforeach
                        ${{ number_format($totalPrice) ?? ''}}
                    </td>
                    <td>{{ $order->created_at ?? $order->updated_at }}</td>
                    <td>
                        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModalDelete-{{ $order->id }}">{{ trans('text.show') }}</button>

                        <div class="modal fade" id="exampleModalDelete-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('text.details') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">{{ trans('text.details') }}</th>
                                                    <th scope="col">{{ trans('text.price') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $count = 1 @endphp
                                                @foreach ($order->items as $item)
                                                    <tr>
                                                        <th scope="row">{{ $count++ }}</th>
                                                        <td>{{  $item->productInfor->product->name }} x {{ $item->quantity }} ({{ $item->productInfor->color }} - {{ $item->productInfor->size }})</td>
                                                        <td>${{ number_format($item->quantity * $item->productInfor->product->price_sale ) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('admin.orders.pending', $order->id) }}">
                                            @csrf
                                            <button type="submit" @if ($order->status === config('status.order.pending') || $order->status === config('status.order.success')) hidden="" @endif class="btn btn-info">{{ trans('text.pending') }}</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.orders.success', $order->id) }}">
                                            @csrf
                                            <button type="submit" @if ($order->status === config('status.order.success')) hidden="" @endif class="btn btn-success">{{ trans('text.success') }}</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.orders.cancel', $order->id) }}">
                                            @csrf
                                            <button type="submit" @if ($order->status === config('status.order.canceled') || $order->status === config('status.order.success')) hidden="" @endif class="btn btn-danger">{{ trans('text.cancel') }}</button>
                                        </form>

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('text.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($order->status === config('status.order.success'))
                            <button type="button" disabled="" class="btn btn-success">{{ trans('text.success') }}</button>
                        @elseif ($order->status === config('status.order.canceled'))
                            <button type="button" disabled="" class="btn btn-danger">{{ trans('text.cancel') }}</button>
                        @else
                            <button type="button" disabled="" class="btn btn-info">{{ trans('text.pending') }}</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.phone') }}</th>
                <th>{{ trans('text.quantity') }}</th>
                <th>{{ trans('text.total_price') }}</th>
                <th>{{ trans('text.order_date') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

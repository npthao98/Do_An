@extends('admin_master')

@section('content')
<br>
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('text.product') }}</h1>
        </div>
    </div>

    <a href="{{ route('admin.products.create') }}"><button class="btn btn-primary">{{ trans('text.create_product') }}</button></a>
    <br><br>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <table id="example" class="table table-striped table-bordered table-width">
        <thead>
            <tr>
                <th>{{ trans('text.id') }}</th>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.category') }}</th>

                <th>{{ trans('text.price_sale') }}</th>
                <th>{{ trans('text.price_import') }}</th>
                <th>{{ trans('text.in_stock') }}</th>
                <th>{{ trans('text.image') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->name ?? '' }}</td>
                    <td>{{ $product->category->name ?? '' }}</td>
                    <td>${{ number_format($product->price_sale) ?? '' }}</td>
                    <td>${{ number_format($product->price_import) ?? '' }}</td>
                    @php
                        $total = 0;
                        foreach ($product->productInfors as $productInfor) {
                            $total+=$productInfor->quantity;
                        }
                    @endphp
                    <td>{{ $total ?? '' }}</td>
                    <td><img class="img-fluid image-size-admin" src="{{ asset(config('view.images') . $product->link_to_image_base) }}"></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalShow-{{ $product->id }}">
                          {{ trans('text.show') }}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalShow-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel"><b>{{ $product->name }}</b></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @foreach ($product->productInfors as $productInfor)
                                        <div class="modal-body">
                                            <div><b>{{ trans('text.color') }}: {{ $productInfor->color }}, {{ trans('text.size') }}: {{ $productInfor->size }}, {{ trans('text.quantity') }}: {{ $productInfor->quantity }}</b></div>
                                        </div>
                                    @endforeach

                                    <div class="d-inline">
                                        @foreach ($product->images as $image)
                                                <img src="{{ asset(config('view.images') . $image->link_to_image) }}" style="height: 245px;" class="img-thumbnail product-image-size">
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('text.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('admin.products.edit', $product->id) }}"><button type="button" class="btn btn-warning">{{ trans('text.edit') }}</button></a>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalDelete-{{ $product->id }}">{{ trans('text.delete') }}</button>

                        <div class="modal fade" id="exampleModalDelete-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('text.delete_product') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        {{ trans('text.are_you_sure') }}
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('text.close') }}</button>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">{{ trans('text.yes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>{{ trans('text.id') }}</th>
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.category') }}</th>
                <th>{{ trans('text.price') }}</th>
                <th>{{ trans('text.in_stock') }}</th>
                <th>{{ trans('text.image') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

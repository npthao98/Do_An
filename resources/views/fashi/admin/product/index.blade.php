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
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.category') }}</th>
                <th>{{ trans('text.description') }}</th>
                <th>{{ trans('text.price') }}</th>
                <th>{{ trans('text.in_stock') }}</th>
                <th>{{ trans('text.image') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name ?? '' }}</td>
                    <td>{{ $product->categories->first()->name ?? '' }}</td>
                    <td>{{ $product->description ?? '' }}</td>
                    <td>{{ $product->price ?? '' }}</td>
                    <td>{{ $product->in_stock ?? '' }}</td>
                    <td><img class="img-fluid image-size-admin" src="{{ $product->images->first() ? $product->images->first()->link_to_image : '' }}"></td>
                    <td>
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
                <th>{{ trans('text.name') }}</th>
                <th>{{ trans('text.category') }}</th>
                <th>{{ trans('text.description') }}</th>
                <th>{{ trans('text.price') }}</th>
                <th>{{ trans('text.in_stock') }}</th>
                <th>{{ trans('text.image') }}</th>
                <th>{{ trans('text.options') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

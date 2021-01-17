@extends('admin_master')

@section('content')
    <br>
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ trans('text.create_product') }}</h3>
            </div>

            <form method="POST" action="{{ route('admin.imports.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group form-product">
                        <label for="category" class="col-form-label">{{ trans('text.supplier') }}:</label>
                        <select class="form-control" name="supplier_id" required id="category" value="{{ old('supplier_id') }}">
                            <option value="" disabled>{{ trans('text.supplier') }}</option>
                            @foreach ($suppliers as $supplier)
                                <option
                                    value="{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('supplier_id')
                        <span>
                            <strong class="error-color">{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('productInforId')
                        <span>
                            <strong class="error-color">
                                @lang('message.create.product')
                            </strong>
                        </span>
                    @enderror
                    <br>
                    <label for="color" class="col-form-label">{{ trans('text.product') }} :</label>
                    <select class="product form-control dis col-md-2 d-sm-inline mt-3 mr-4" id="product-add">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->id . ' - ' . $product->name}}</option>
                        @endforeach
                    </select>
                    <button id="add-product" class="tn btn-info" type="button">@lang('text.add_product')</button>
                    @foreach($products as $product)
                        <div class="form-group form-product wrapper pt-4 d-none" id="product{{ $product->id }}">
                            <div>
                                <div class="row pb-3">
                                    <div class="col-md-5">
                                        <label for="color" class="col-form-label">{{ trans('text.product') }} :</label>
                                        <span>{{ $product->id . ' - ' . $product->name }}</span>
                                    </div>
                                    <div class="col-md-7">
                                        <button type="button" class="btn btn-danger" onclick="deleteProduct(this)" id="bt-delete-product{{ $product->id }}">{{ trans('text.delete') }}</button>
                                    </div>
                                </div>
                                <div class="form-product pb-3 row">
                                    <div class="col-md-6">
                                        <label for="category">{{ trans('text.price_import') }}:</label>
                                        <input class="product-id" type="hidden" name="productId[]" required disabled value="{{ $product->id }}">
                                        <input class="price-import" name="priceImport[]" type="number" value="{{ $product->price_import }}" required id="category" disabled>
                                    </div>
                                </div>
                                <div id="product-infors">
                                    <div class="row">
                                        @foreach($product->productInfors as $productInfor)
                                            <div class="col-md-4">
                                                <label for="">
                                                    {{ 'Color: ' . $productInfor->color . '- Size: ' . $productInfor->size . ': ' }}
                                                </label>
                                                <input class="product-infor-id" type="hidden" name="productInforId[]" required disabled value="{{ $productInfor->id }}">
                                                <input class="number-import" type="number" name="numberImport[]" required disabled>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div><br>
                        </div>
                    @endforeach
                    <br>
                </div>

                <div class="card-footer">
                    <button type="submit" id="bt-create" class="btn btn-primary">{{ trans('text.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/import.js') }}"></script>
@endsection

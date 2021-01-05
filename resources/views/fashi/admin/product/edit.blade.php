@extends('admin_master')

@section('content')
<br>
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ trans('text.create_product') }}</h3>
        </div>

        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group form-product">
                    <label for="name" class="col-form-label">{{ trans('text.name') }}:</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $product->name }}">
                </div>
                @error('name')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group form-product">
                    <label for="category" class="col-form-label">{{ trans('text.category') }}:</label>
                    <select class="form-control" name="category" id="category" value="{{ old('category') ?? $product->category }}">
                        <option disabled selected value="">{{ trans('text.category') }}</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ ($category->id == $product->category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group form-product">
                    <label for="description" class="col-form-label">{{ trans('text.description') }}:</label>
                    <textarea class="form-control  @error('description') is-invalid @enderror" id="description" name="description" placeholder="{{ trans('text.enter_description') }}">{{ old('description') ?? $product->description }}</textarea>
                </div>
                @error('description')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group form-product">
                    <label for="price_import" class="col-form-label">{{ trans('text.price_import') }}:</label>
                    <input type="number" class="form-control  @error('price_import') is-invalid @enderror" id="price_import" name="price_import" value="{{ old('price_import') ?? $product->price_import }}">
                </div>
                @error('price_import')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group form-product">
                    <label for="price_sale" class="col-form-label">{{ trans('text.price_sale') }}:</label>
                    <input type="number" class="form-control  @error('price_sale') is-invalid @enderror" id="price_sale" name="price_sale" value="{{ old('price_sale') ?? $product->price_sale }}">
                </div>
                @error('price_sale')
                <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror


                <div class="form-group form-product wrapper">
                    @foreach($product->productInfors as $productInfor)
                        <div>
                            <label for="color" class="col-form-label">{{ trans('text.color') }}:</label>
                            <select class="form-control dis col-md-2 d-sm-inline mt-3 mr-4" name="colors[]" id="color" value="{{ old('parent_id') }}">
                                <option value="{{ config('productDetail.na') }}"
                                    @if(config('productDetail.na')==$productInfor->color) selected @endif>
                                    {{ trans('text.na') }}
                                </option>
                                <option value="{{ config('productDetail.red') }}"
                                    @if(config('productDetail.red')==$productInfor->color) selected @endif>
                                    {{ trans('text.red') }}
                                </option>
                                <option value="{{ config('productDetail.black') }}"
                                    @if(config('productDetail.black')==$productInfor->color) selected @endif>
                                    {{ trans('text.black') }}
                                </option>
                                <option value="{{ config('productDetail.yellow') }}"
                                    @if(config('productDetail.yellow')==$productInfor->color) selected @endif>
                                    {{ trans('text.yellow') }}
                                </option>
                                <option value="{{ config('productDetail.green') }}"
                                    @if(config('productDetail.green')==$productInfor->color) selected @endif>
                                    {{ trans('text.green') }}
                                </option>
                                <option value="{{ config('productDetail.blue') }}"
                                    @if(config('productDetail.blue')==$productInfor->color) selected @endif>
                                    {{ trans('text.blue') }}
                                </option>
                                <option value="{{ config('productDetail.violet') }}"
                                    @if(config('productDetail.violet')==$productInfor->color) selected @endif>
                                    {{ trans('text.violet') }}
                                </option>
                            </select>

                            <label for="size" class="col-form-label">{{ trans('text.size') }}:</label>
                            <select class="form-control col-md-2 d-sm-inline mt-3 mr-4" name="sizes[]" id="size" value="{{ old('parent_id') }}">
                                <option value="{{ config('productDetail.na') }}"
                                    @if(config('productDetail.na')==$productInfor->size) selected @endif>
                                    {{ trans('text.na') }}
                                </option>
                                <option value="{{ config('productDetail.s') }}"
                                    @if(config('productDetail.s')==$productInfor->size) selected @endif>
                                    {{ config('productDetail.s') }}
                                </option>
                                <option value="{{ config('productDetail.m') }}"
                                    @if(config('productDetail.m')==$productInfor->size) selected @endif>
                                    {{ config('productDetail.m') }}
                                </option>
                                <option value="{{ config('productDetail.l') }}"
                                    @if(config('productDetail.l')==$productInfor->size) selected @endif>
                                    {{ config('productDetail.l') }}
                                </option>
                                <option value="{{ config('productDetail.xs') }}"
                                    @if(config('productDetail.xs')==$productInfor->size) selected @endif>
                                    {{ config('productDetail.xs') }}
                                </option>
                            </select>

                            <label for="quantities" class="col-form-label">{{ trans('text.in_stock') }}:</label>
                            <input type="text" class="form-control col-md-2 d-sm-inline mt-3 mr-4  @error('quantities[]')
                                is-invalid @enderror" id="quantities" name="quantities[]" required="" value="{{ $productInfor->quantity }}">
                            <a href="javascript:void(0);" class="remove_field"><button class="btn btn-danger">{{ trans('text.delete') }}</button></a>
                        </div>
                    @endforeach
                </div>

                <br>

                <button class="btn btn-info add_fields">{{ trans('text.add') }}</button>

                <br><br>

                <div class="form-group form-product">
                    <label for="images">{{ trans('text.image') }}:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="images[]" id="images" multiple value="{{ old('images') ?? $product->images }}">
                            <label class="custom-file-label" for="images">{{ trans('text.choose_image') }}</label>
                        </div>
                    </div>
                </div>
                @error('images')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="card-footer">
                <a href="{{ url()->previous() }}" class="btn btn-danger">{{ trans('text.cancel') }}</a>
                <button type="submit" class="btn btn-primary">{{ trans('text.submit') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

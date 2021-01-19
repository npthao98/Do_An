@extends('admin_master')

@section('content')
<br>
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ trans('text.create_product') }}</h3>
        </div>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group form-product">
                    <label for="name" class="col-form-label">{{ trans('text.name') }}:</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required="">
                </div>
                @error('name')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group form-product">
                    <label for="category" class="col-form-label">{{ trans('text.category') }}:</label>
                    <select class="form-control" name="category_id" id="category" value="{{ old('category') }}">
                        <option value="">{{ trans('text.category') }}</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group form-product">
                    <label for="description" class="col-form-label">{{ trans('text.description') }}:</label>
                    <textarea class="form-control  @error('description') is-invalid @enderror" id="description" name="description"  placeholder="{{ trans('text.enter_description') }}" required="">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group form-product">
                    <label for="price" class="col-form-label">{{ trans('text.price_sale') }}:</label>
                    <input type="number" class="form-control  @error('price') is-invalid @enderror" id="price" name="price_sale" value="{{ old('price_sale') }}" required="">
                </div>
                @error('price')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group form-product wrapper">
                    <div>
                        <label for="color" class="col-form-label">{{ trans('text.color') }}:</label>
                        <select class="form-control dis col-md-2 d-sm-inline mt-3 mr-4" name="colors[]" id="color" value="{{ old('parent_id') }}">
                            <option value="{{ config('productDetail.red') }}">{{ trans('text.red') }}</option>
                            <option value="{{ config('productDetail.black') }}">{{ trans('text.black') }}</option>
                            <option value="{{ config('productDetail.yellow') }}">{{ trans('text.yellow') }}</option>
                            <option value="{{ config('productDetail.green') }}">{{ trans('text.green') }}</option>
                            <option value="{{ config('productDetail.blue') }}">{{ trans('text.blue') }}</option>
                            <option value="{{ config('productDetail.violet') }}">{{ trans('text.violet') }}</option>
                        </select>

                        <label for="size" class="col-form-label">{{ trans('text.size') }}:</label>
                        <select class="form-control col-md-2 d-sm-inline mt-3 mr-4" name="sizes[]" id="size" value="{{ old('parent_id') }}">
                            <option value="{{ config('productDetail.s') }}">S</option>
                            <option value="{{ config('productDetail.m') }}">M</option>
                            <option value="{{ config('productDetail.l') }}">L</option>
                            <option value="{{ config('productDetail.xs') }}">XS</option>
                        </select>
                        <a href="javascript:void(0);" class="remove_field" hidden=""><button class="btn btn-danger">{{ trans('text.delete') }}</button></a>
                    </div><br>
                    <button class="btn btn-info add_fields">{{ trans('text.add') }}</button>
                </div>
                <br>
                <div class="form-group form-product">
                    <label for="images">{{ trans('text.image_main') }}:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image" required>
                            <label class="custom-file-label" for="image">{{ trans('text.choose_image') }}</label>
                        </div>
                    </div>
                </div>
                @error('image')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                <div class="form-group form-product">
                    <label for="images">{{ trans('text.images') }}:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="images[]" id="images" multiple>
                            <label class="custom-file-label" for="image">{{ trans('text.choose_image') }}</label>
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
                <button type="submit" id="bt-create" class="btn btn-primary">{{ trans('text.submit') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#bt-create').click(function (){
                var fileUpload = $('#images');
                if (parseInt(fileUpload.get(0).files.length)>4 || parseInt(fileUpload.get(0).files.length)<4){
                    alert("You must to upload 4 files for images");
                    return false
                }
            });
        });
    </script>
@endsection

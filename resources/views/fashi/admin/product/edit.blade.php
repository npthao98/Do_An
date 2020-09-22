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
                        <option value="">{{ trans('text.category') }}</option>
                        @foreach ($categories as $category)
                            @if ($category->parent_id != null)
                                <option
                                  value="{{ $category->id }}" {{ ($category->id == $product->categories->first()->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endif
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
                    <label for="price" class="col-form-label">{{ trans('text.price') }}:</label>
                    <input type="number" class="form-control  @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') ?? $product->price }}">
                </div>
                @error('price')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group form-product">
                    <label for="in_stock" class="col-form-label">{{ trans('text.in_stock') }}:</label>
                    <input type="number" class="form-control  @error('in_stock') is-invalid @enderror" id="in_stock" name="in_stock" value="{{ old('in_stock') ?? $product->in_stock }}" min="1" max="100">
                </div>
                @error('in_stock')
                    <span>
                        <strong class="error-color">{{ $message }}</strong>
                    </span>
                @enderror

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
                <button type="submit" class="btn btn-primary">{{ trans('text.submit') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

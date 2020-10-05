@extends('master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <!-- ./home.html -->
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i>{{ trans('header.home') }}</a>
                        <!-- ./shop.html -->
                        <a href="#">{{ trans('header.shop') }}</a>
                        <span>{{ trans('text.details') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('fashi.user.sidebar-left')
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{ $product->images->first() ? $product->images->first()->link_to_image : '' }}" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    @foreach ($product->images as $image)
                                        <div class="pt active" data-imgbigurl="{{ $image->link_to_image }}"><img src="{{ $image->link_to_image }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{ $product->categories->first()->name }}</span>
                                    <h3>{{ $product->name }}</h3>
                                </div>
                                <div class="pd-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>(5)</span>
                                </div>
                                <div class="pd-desc">
                                    <p>{{ $product->description }}</p>
                                    <h4>${{ $product->price }}<span>${{ $product->price }}</span></h4>
                                </div>
                                <div class="pd-color">
                                    <h6>{{ trans('text.color') }}</h6><br><br>
                                    <div class="form-group form-product">
                                        <select class="form-control" name="color" value="{{ old('parent_id') }}">
                                            @foreach ($product->productDetails->unique('color') as $productDetailColor)
                                                <option
                                                  value="{{ $productDetailColor->color }}">
                                                    {{ $productDetailColor->color }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="pd-size-choose">
                                    @foreach ($product->productDetails->unique('size') as $productDetailSize)
                                        <div class="sc-item">
                                            <label for="sm-size-{{ $productDetailSize->size }}">
                                                <input type="radio" class="size-input" value="{{ $productDetailSize->size }}" id="sm-size-{{ $productDetailSize->size }}">{{ $productDetailSize->size }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" name="quantity">
                                    </div>
                                    <a href="#" class="primary-btn
                                        @if ($product->in_stock > 0)
                                            pd-cart
                                        @else
                                            pd-sold-out-cart
                                        @endif
                                        " data-product-id="{{ $product->id }}">{{ trans('text.add_to_cart') }}</a>
                                </div>
                                <ul class="pd-tags">
                                    <a href="{{ route('product.category.index', $product->categories->first()->id) }}"><li><span class="text-uppercase">{{ trans('text.category') }}:</span> {{ $product->categories->first()->name }}</li></a>
                                </ul>
                                <div class="pd-share">
                                    <div class="pd-social">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="text-uppercase active" data-toggle="tab" href="#tab-3" role="tab">{{ trans('text.customer_reviews') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>{{ trans('text.comments') }}</h4>
                                        <div class="tag-container">
                                            @include('fashi.user.comment')
                                        </div>

                                        <div class="leave-comment">
                                            <h4>{{ trans('text.leave_comment') }}</h4>
                                            <div class="comment-form">
                                                <div class="row">
                                                    <div class="comment-option pl-4">
                                                        <div class="co-item">
                                                            <div class="avatar-pic">
                                                                <img src="{{ asset('bower_components/bower_fashi_shop/img/product-single/avatar-2.png') }}" alt="">
                                                            </div>
                                                            <div class="avatar-text">
                                                                <div class="at-rating">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                </div>
                                                                <h5>{{ auth()->user()->name ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea placeholder="{{ trans('text.messges') }}" name="content" required="">{{ old('content') }}</textarea>
                                                        <button type="submit" class="site-btn" data-name="{{ auth()->user()->name ?? '' }}" data-product-id="{{ $product->id }}">{{ trans('text.send_message') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{ trans('text.related_products') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $productRandom)
                    <div class="col-lg-3 col-sm-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="{{ $productRandom->images->first()->link_to_image }}" alt="">
                                <div class="sale">{{ trans('text.sale') }}</div>
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                    <li class="quick-view"><a href="{{ route('product_detail', $productRandom->id) }}">+ {{ trans('text.quick_view') }}</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{ $productRandom->categories->first()->name }}</div>
                                <a href="{{ route('product_detail', $productRandom->id) }}">
                                    <h5>{{ $productRandom->name }}</h5>
                                </a>
                                <div class="product-price">
                                    ${{ $productRandom->price }}
                                    <span>${{ $productRandom->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Related Products Section End -->


@endsection
@section ('javascript')
    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('js/loadComment.js') }}"></script>
@endsection

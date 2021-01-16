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
                                <img class="product-big-img" src="{{ asset(config('view.images') . $product->link_to_image_base) }}" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="ps-slider owl-carousel">
                                    @foreach ($product->images as $image)
                                        <div class="pt active" data-imgbigurl="{{ asset(config('view.images') . $image->link_to_image) }}">
                                            <img src="{{ asset(config('view.images') . $image->link_to_image) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{ $product->category->name }}</span>
                                    <h3>{{ $product->name }}</h3>
                                </div>
                                <div class="pd-rating">
                                    @for ($i = 1; $i <= round($product->rate); $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @for ($i = round($product->rate + 1); $i <= 5; $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                    <span>({{ $product->rate }}/5)</span>
                                </div>
                                <div class="pd-desc">
                                    <p>{{ $product->description }}</p>
                                    <p><b>{{ trans('text.in_stock') }}: {{ $product->in_stock }}</b></p>
                                    <h4>${{ number_format($product->price_sale) }}</h4>
                                </div>
                                <div class="pd-color">
                                    <h6>{{ trans('text.color') }}</h6><br><br>
                                    <div class="form-group form-product">
                                        <select class="form-control" name="color" value="{{ old('parent_id') }}">
                                            @foreach ($product->productInfors->unique('color') as $productInforColor)
                                                <option
                                                  value="{{ $productInforColor->color }}">
                                                    {{ $productInforColor->color }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="pd-size-choose">
                                    @foreach ($product->productInfors->unique('size') as $productDetailSize)
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
                                        @if ($product->productInfors->sum('quantity') > 0)
                                            pd-cart
                                        @else
                                            pd-sold-out-cart
                                        @endif
                                        " data-product-id="{{ $product->id }}">{{ trans('text.add_to_cart') }}</a>
                                </div>
                                <ul class="pd-tags">
                                    <a href="{{ route('product.category.index', $product->category->id) }}"><li><span class="text-uppercase">{{ trans('text.category') }}:</span> {{ $product->category->name }}</li></a>
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
                                        <br>
                                        @if($rating)
                                            <div class="leave-comment">
                                                <h4>{{ trans('text.leave_comment') }}</h4>
                                                <div class="comment-form">
                                                    <div class="row">
                                                        <div class="comment-option pl-4">
                                                            <div class="co-item">
                                                                <div class="avatar-pic">
                                                                    <img src="{{ asset(config('view.images') . 'avatar.jpg') }}" alt="">
                                                                </div>
                                                                <div class="avatar-text">
                                                                    <div class="rating">
                                                                        <span class="fa fa-star checked" id="star1" onclick="rating(this,1)"></span>
                                                                        <span class="fa fa-star-o" id="star2" onclick="rating(this,2)"></span>
                                                                        <span class="fa fa-star-o" id="star3" onclick="rating(this,3)"></span>
                                                                        <span class="fa fa-star-o" id="star4" onclick="rating(this,4)"></span>
                                                                        <span class="fa fa-star-o" id="star5" onclick="rating(this,5)"></span>
                                                                    </div>
                                                                    <h5>{{ auth()->user()->name ?? ''}}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 pt-2">
                                                            <input type="hidden" name="rate" id="rate" value="1">
                                                            <textarea placeholder="{{ trans('text.messges') }}" id="content_comment" name="content" required="">{{ old('content') }}</textarea>
                                                            <button type="submit" class="site-btn" data-name="{{ auth()->user()->name ?? '' }}" data-product-id="{{ $product->id }}">{{ trans('text.send_message') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
    <div class="related-products spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title mb-0 mt-4">
                        <h2 class="mb-0 mt-5">{{ trans('text.recommend_products') }}</h2>
                    </div>
                    <section class="man-banner spad">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="recomendations-slider owl-carousel">
                                        @foreach ($products as $product)
                                            <div class="product-item">
                                                <div class="pi-pic">
                                                    <div style="height: 300px">
                                                        <img src="{{ asset(config('view.images') . $product->link_to_image_base) }}"  alt="">
                                                    </div>
                                                    @if ($product->in_stock <= 0)
                                                        <div class="sale pp-sale">{{ trans('text.sold_out') }}</div>
                                                    @endif
                                                    <div class="icon">
                                                        <i class="icon_heart_alt"></i>
                                                    </div>
                                                    <ul>
                                                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                                        <li class="quick-view"><a href="{{ route('product_detail', $product->id) }}">+ {{ trans('text.quick_view') }}</a></li>
                                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="pi-text">
                                                    <div class="catagory-name">{{ $product->category->name ?? '' }}</div>
                                                    <a href="{{ route('product_detail', $product->id) }}">
                                                        <h5>{{ $product->name }}</h5>
                                                    </a>
                                                    <div class="product-price">
                                                        ${{ number_format($product->price_sale) }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section ('javascript')
    <script>
        function rating(ths,sno){
            for (var i=1;i<=5;i++){
                var cur=document.getElementById("star"+i);
                cur.className="fa fa-star-o";
            }

            for (var i=1;i<=sno;i++){
                var cur=document.getElementById("star"+i);
                if(cur.className=="fa fa-star-o")
                {
                    cur.className="fa fa-star checked";
                }
            }

            var rate=document.getElementById("rate");
            rate.value = sno;
        }
    </script>
    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('js/loadComment.js') }}"></script>
@endsection

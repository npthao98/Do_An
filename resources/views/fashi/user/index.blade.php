@extends('master')

@section('content')
    <div class="dashboard">
        <!-- Hero Section Begin -->
        <section class="hero-section">
            <div class="hero-items owl-carousel">
                <div class="single-hero-items set-bg" data-setbg="{{ asset('bower_components/bower_fashi_shop/img/hero-1.jpg') }}">
                    <div class="container">
                        {{-- <div class="row">
                            <div class="col-lg-5">
                                <span>Bag, kids</span>
                                <h1>Black friday</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore</p>
                                <a href="{{ route('new_product') }}" class="primary-btn">Shop Now</a>
                            </div>
                        </div>
                        <div class="off-card">
                            <h2>Sale <span>50%</span></h2>
                        </div> --}}
                    </div>
                </div>
                <div class="single-hero-items set-bg" data-setbg="{{ asset('bower_components/bower_fashi_shop/img/hero-2.jpg') }}">
                    <div class="container">
                        {{-- <div class="row">
                            <div class="col-lg-5">
                                <span>Bag,kids</span>
                                <h1>Black friday</h1>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore</p>
                                <a href="#" class="primary-btn">Shop Now</a>
                            </div>
                        </div>
                        <div class="off-card">
                            <h2>Sale <span>50%</span></h2>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>

        <div class="banner-section spad">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-4">
                            <a href="{{ route('product.category.index', $category->id) }}">
                                <div class="single-banner">
                                    <img class="image_category" src="{{ asset(config('view.images') . $category->products->first()->link_to_image_base) }}" alt="">
                                    <div class="inner-text">
                                        <h4>{{ $category->name }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <section class="women-banner spad">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="product-large set-bg" data-setbg="{{ asset(config('view.images') . $categoryFirst->products->first()->link_to_image_base) }}">
                            <h2>{{ $categoryFirst->name }}</h2>
                            <a href="{{ route('product.category.index', $categoryFirst->id) }}">{{ trans('text.discover_more') }}</a>
                        </div>
                    </div>
                    <div class="col-lg-8 offset-lg-1">
                        <div class="filter-control"></div>
                        <div class="product-slider owl-carousel">
                            @foreach ($categoryFirst->products as $product)
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
        <!-- Women Banner Section End -->

        <!-- Man Banner Section Begin -->
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
    </div>
@endsection

@extends('master')

@section('content')
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
                                <img src="{{ asset('bower_components/bower_fashi_shop/img/banner-1.jpg') }}" alt="">
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
                    <div class="product-large set-bg" data-setbg="{{ asset('bower_components/bower_fashi_shop/img/products/women-large.jpg') }}">
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
                                    <img src="{{ $product->images->first()->link_to_image }}" alt="">
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
                                    <div class="catagory-name">{{ $product->categories->first()->name ?? '' }}</div>
                                    <a href="{{ route('product_detail', $product->id) }}">
                                        <h5>{{ $product->name }}</h5>
                                    </a>
                                    <div class="product-price">
                                        ${{ $product->price }}
                                        <span>${{ $product->price }}</span>
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
    <section class="man-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="filter-control"></div>
                    <div class="product-slider owl-carousel">
                        @foreach ($categorySecond->products as $product)
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ $product->images->first()->link_to_image }}" alt="">
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
                                    <div class="catagory-name">{{ $product->categories->first()->name ?? '' }}</div>
                                    <a href="{{ route('product_detail', $product->id) }}">
                                        <h5>{{ $product->name }}</h5>
                                    </a>
                                    <div class="product-price">
                                        ${{ $product->price }}
                                        <span>${{ $product->price }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="product-large set-bg m-large" data-setbg="{{ asset('bower_components/bower_fashi_shop/img/products/man-large.jpg') }}">
                        <h2>{{ $categorySecond->name }}</h2>
                        <a href="{{ route('product.category.index', $categorySecond->id) }}">{{ trans('text.discover_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

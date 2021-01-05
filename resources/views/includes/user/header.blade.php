<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <a href="{{ route('user') }}">
                    <div class="mail-service">
                        @if (isset(Auth::user()->name))
                            <i class=" fa fa-envelope"></i>
                            {{ trans('header.hello') }} {{ Auth::user()->name }}
                        @endif
                    </div>
                </a>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +65 11.188.888
                </div>
            </div>
            <div class="ht-right">
                @guest
                    <a href="{{ route('login') }}" class="login-panel"><i class="fa fa-user"></i>{{ trans('make_auth.login') }}</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="login-panel"><i class="fa fa-user"></i>{{ trans('make_auth.register') }}</a>
                    @endif
                @else
                    @if(auth()->user()->employee)
                        <a href="{{ route('admin.dashboard') }}" class="btn login-panel">{{ trans('make_auth.admin_dashboard') }}</a>
                    @endif
                    <a href="{{ route('login') }}" class="login-panel button-logout"><i class="fa fa-user"></i>{{ trans('make_auth.logout') }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="logout_form">
                        @csrf
                    </form>
                @endguest
                <div class="lan-selector">
                    <select onchange="location = this.value;" class="language_drop" name="countries" id="countries">
                        <option selected>{{ trans('header.language') }}</option>
                        <option value='{!! route('user.change-language', ['en']) !!}' data-image="{{ asset('bower_components/bower_fashi_shop/img/flag-1.jpg') }}" data-imagecss="flag yt"
                            data-title="English">{{ trans('header.english') }}</option>
                        <option value='{!! route('user.change-language', ['vi']) !!}' data-image="{{ asset('bower_components/bower_fashi_shop/img/flag-2.jpg') }}" data-imagecss="flag yu"
                            data-title="Vietnamese">{{ trans('header.vietnamese') }} </option>
                    </select>
                </div>
                <div class="top-social">
                    <div style="margin-top: 15px; margin-bottom: 23px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('bower_components/bower_fashi_shop/img/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <form method="POST" action="{{ route('search') }}">
                        @csrf
                        <div class="advanced-search">
                            <button type="button" class="category-btn">{{ trans('header.search') }}</button>
                            <div class="input-group">
                                <input type="text" name="name" placeholder="{{ trans('header.what_do_you_need') }}">
                                <button type="submit" class="margin-search"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="cart-icon">
                            <a href="{{ route('user.orders') }}">
                                <i class="icon_bag_alt"></i>
                            </a>
                        </li>
                        <li class="cart-icon">
                            <a href="{{ route('show_cart') }}">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="cart_num">{{ session()->get('totalQuantity') ?? '' }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="ti-menu"></i>
                    <span>{{ trans('header.all_categories') }}</span>
                    <ul class="depart-hover">
                        @foreach ($categories as $category)
                            <li><a href="{{ route('product.category.index', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="active"><a href="{{ route('index') }}">{{ trans('header.home') }}</a></li>
                    <li><a href="{{ route('new_product') }}">{{ trans('header.new_product') }}</a></li>
                    <li><a href="{{ route('product.index') }}">{{ trans('header.collection') }}</a></li>
                    <li><a href="#">{{ trans('header.blog') }}</a></li>
                    <li><a href="#">{{ trans('header.contact') }}</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>
<!-- Header End -->

    <div class="filter-widget">
        <a href="{{ route('product.index') }}"><h4 class="fw-title">{{ trans('text.category') }}</h4></a>
        <ul class="filter-catagories">
            @foreach ($categories as $category)
                <li><a href="{{ route('product.category.index', $category->id) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
    {{-- <div class="filter-widget">
        <h4 class="fw-title">{{ trans('text.price') }}</h4>
        <div class="filter-range-wrap">
            <div class="range-slider">
                <div class="price-input">
                    <input type="text" id="minamount">
                    <input type="text" id="maxamount">
                </div>
            </div>
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                data-min="33" data-max="98">
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
        </div>
        <a href="#" class="filter-btn">{{ trans('text.filter') }}</a>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">{{ trans('text.color') }}</h4>
        <div class="fw-color-choose">
            <div class="cs-item">
                <input type="radio" id="cs-black">
                <label class="cs-black" for="cs-black">{{ trans('text.black') }}</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-violet">
                <label class="cs-violet" for="cs-violet">{{ trans('text.violet') }}</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-blue">
                <label class="cs-blue" for="cs-blue">{{ trans('text.blue') }}</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-yellow">
                <label class="cs-yellow" for="cs-yellow">{{ trans('text.yellow') }}</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-red">
                <label class="cs-red" for="cs-red">{{ trans('text.red') }}</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-green">
                <label class="cs-green" for="cs-green">{{ trans('text.green') }}</label>
            </div>
        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">{{ trans('text.size') }}</h4>
        <div class="fw-size-choose">
            <div class="sc-item">
                <input type="radio" id="s-size">
                <label for="s-size">s</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="m-size">
                <label for="m-size">m</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="l-size">
                <label for="l-size">l</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="xs-size">
                <label for="xs-size">xs</label>
            </div>
        </div>
    </div> --}}

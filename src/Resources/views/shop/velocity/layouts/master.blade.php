@push('css')
<style type="text/css">

.cookieConsentContainer {
    z-index: 999;
    width: 350px;
    min-height: 20px;
    box-sizing: border-box;
    padding: 30px 30px 30px 30px;
    background: rgba(0, 0, 0, 0.91) !important;
    overflow: hidden;
    position: fixed;
    bottom: 30px;
    right: 30px;
    display: none;
}

.cookieConsentContainer .cookieTitle a, .cookieConsentContainer .cookieTitle a:hover {
    font-family: OpenSans, arial, "sans-serif";
    color: #ffff;
    font-size: 22px;
    line-height: 20px;
    display: block;
}

.cookieConsentContainer .cookieDesc p {
    margin: 0;
    padding: 0;
    font-family: OpenSans, arial, "sans-serif";
    color: #ffff;
    font-size: 14px;
    line-height: 20px;
    display: block;
    margin-top: 10px;
} .cookieConsentContainer .cookieDesc a {
    font-family: OpenSans, arial, "sans-serif";
    color: #ffff;
    text-decoration: underline;
}
.cookieConsentContainer .cookieButton a {
    display: inline-block;
    font-family: OpenSans, arial, "sans-serif";
    color: #ffff;
    font-size: 14px;
    font-weight: bold;
    margin-top: 14px;
    background: #26a37c;
    box-sizing: border-box;
    padding: 15px 24px;
    text-align: center;
    transition: background 0.3s;
}
.cookieConsentContainer .cookieButton a:hover {
    cursor: pointer;
    background: #21916e;
    color: #ffff;
}

@media (max-width: 980px) {
    .cookieConsentContainer {
        bottom: 60px !important;
        left: 30px !important;
        height: 200px !important;
        width: 300px !important;
    }
}
</style>
@endpush

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        {{-- title --}}
        <title>@yield('page_title')</title>

        {{-- meta data --}}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="content-language" content="{{ app()->getLocale() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        {!! view_render_event('bagisto.shop.layout.head') !!}

        {{-- for extra head data --}}
        @yield('head')

        {{-- seo meta data --}}
        @section('seo')
            <meta name="description" content="{{ core()->getCurrentChannel()->description }}"/>
        @show

        {{-- fav icon --}}
        @if ($favicon = core()->getCurrentChannel()->favicon_url)
            <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
        @else
            <link rel="icon" sizes="16x16" href="{{ asset('/themes/velocity/assets/images/static/v-icon.png') }}" />
        @endif

        {{-- all styles --}}
        @include('shop::layouts.styles')
    </head>

    <body @if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif>
        {!! view_render_event('bagisto.shop.layout.body.before') !!}

        @include('shop::UI.particals')

        {{-- main app --}}
        <div id="app">
            <product-quick-view v-if="$root.quickView"></product-quick-view>

            <div class="main-container-wrapper">

                @section('body-header')
                    @include('shop::layouts.top-nav.index')

                    <?php
                        $gdprRepository = app('Webkul\GDPR\Repositories\GDPRRepository');

                        $gdpr = $gdprRepository->get();

                        foreach ($gdpr as $value) {
                            $gdprData = $value;
                        }
                        try{
                            if($gdprData && $gdprData->gdpr_status == 1 && $gdprData->cookie_status == 1){
                    ?>

                        @include('gdpr::cookie.index')
                    <?php
                            }
                        }catch(\Exception $e){}
                    ?>

                    {!! view_render_event('bagisto.shop.layout.header.before') !!}

                        @include('shop::layouts.header.index')

                    {!! view_render_event('bagisto.shop.layout.header.after') !!}

                    <div class="main-content-wrapper col-12 no-padding">
                        @php
                            $velocityContent = app('Webkul\Velocity\Repositories\ContentRepository')->getAllContents();
                        @endphp

                        <content-header
                            url="{{ url()->to('/') }}"
                            :header-content="{{ json_encode($velocityContent) }}"
                            heading= "{{ __('velocity::app.menu-navbar.text-category') }}"
                            category-count="{{ $velocityMetaData ? $velocityMetaData->sidebar_category_count : 10 }}"
                        ></content-header>

                        <div class="">
                            <div class="row col-12 remove-padding-margin">
                                <sidebar-component
                                    main-sidebar=true
                                    id="sidebar-level-0"
                                    url="{{ url()->to('/') }}"
                                    category-count="{{ $velocityMetaData ? $velocityMetaData->sidebar_category_count : 10 }}"
                                    add-class="category-list-container pt10">
                                </sidebar-component>

                                <div
                                    class="col-12 no-padding content" id="home-right-bar-container">

                                    <div class="container-right row no-margin col-12 no-padding">

                                        {!! view_render_event('bagisto.shop.layout.content.before') !!}

                                        @yield('content-wrapper')

                                        {!! view_render_event('bagisto.shop.layout.content.after') !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @show

                <div class="container">

                    {!! view_render_event('bagisto.shop.layout.full-content.before') !!}

                        @yield('full-content-wrapper')

                    {!! view_render_event('bagisto.shop.layout.full-content.after') !!}

                </div>
            </div>

            <div class="modal-parent" id="loader" style="top: 0" v-show="showPageLoader">
                <overlay-loader :is-open="true"></overlay-loader>
            </div>
        </div>

        {{-- footer --}}
        @section('footer')
            {!! view_render_event('bagisto.shop.layout.footer.before') !!}

                @include('shop::layouts.footer.index')

            {!! view_render_event('bagisto.shop.layout.footer.after') !!}
        @show

        {!! view_render_event('bagisto.shop.layout.body.after') !!}

        <div id="alert-container"></div>

        {{-- all scripts --}}
        @include('shop::layouts.scripts')
    </body>
</html>

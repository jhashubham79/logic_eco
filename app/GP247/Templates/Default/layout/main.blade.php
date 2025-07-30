<!DOCTYPE html>
<html class="wide wow-animation" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ request()->url() }}" />

    <title>{{ env('APP_NAME') }}</title>
    <meta name="description" content="{{ $description ?? gp247_store_info('description') }}">
    <meta name="keywords" content="{{ $keyword ?? gp247_store_info('keyword') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ gp247_file(gp247_store_info('icon', 'GP247/Core/logo/icon.png')) }}" type="image/png" sizes="16x16">

    <!-- Open Graph / Facebook Meta -->
    <meta property="og:title" content="{{ $title ?? gp247_store_info('title') }}" />
    <meta property="og:description" content="{{ $description ?? gp247_store_info('description') }}" />
    <meta property="og:image" content="{{ !empty($og_image) ? gp247_file($og_image) : gp247_file(gp247_store_info('og_image', 'GP247/Core/images/org.jpg')) }}" />
    <meta property="og:url" content="{{ \Request::fullUrl() }}" />
    <meta property="og:type" content="website" />

    <!-- Google Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700%7CLato%7CKalam:300,400,700">

    <!-- Bootstrap & Bootstrap Icons -->
    <link rel="stylesheet" href="{{ url('GP247/Templates/Default/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- Core Styles -->
    <link rel="stylesheet" href="{{ url('GP247/Templates/Default/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('GP247/Templates/Default/css/fonts.css') }}">

    <!-- Custom CSS for GP247 items -->
    @include($GP247TemplatePath . '.common.css')

    <!-- Render Header Module -->
    {!! gp247_render_block('header', $layout_page ?? null) !!}

    <!-- Additional Page-Specific Styles -->
    @stack('styles')
</head>

<body>
 
 
    <div class="page">
        {{-- Block block_menu --}}
        @section('block_menu')
            @include($GP247TemplatePath.'.layout.block_menu')
        @show
        {{--// Block block_menu --}}

        {{-- Block top --}}
        @section('block_top')
            <!--Notice -->
            @include($GP247TemplatePath.'.common.notice')
            <!--//Notice -->

            {{-- Module top --}}
            {!! gp247_render_block('top', $layout_page ?? null) !!}
            {{-- //Module top --}}

            <!--Breadcrumb -->
            @section('breadcrumb')
                @include($GP247TemplatePath.'.common.breadcrumb')
            @show
            <!--//Breadcrumb -->

        @show
        {{-- //Block top --}}

        {{-- Block main --}}
        @section('block_main')
            <section class="section section-xxl bg-default text-md-left">
                <div class="container">
                    <div class="row row-50">
                        @section('block_main_content')

                            <!--Block left-->
                            @section('block_main_content_left')
                            <div class="col-lg-4 col-xl-3">
                                <div class="aside row row-30 row-md-50 justify-content-md-between">
                                    <!--Module left -->
                                    {!! gp247_render_block('left', $layout_page ?? null) !!}
                                    <!--//Module left -->
                                </div>
                            </div>
                            @show
                            <!--//Block left-->

                            <!--Block center-->
                            @section('block_main_content_center')
                            <div class="col-lg-9 col-xl-9">
                                {!! gp247_render_block('center', $layout_page ?? null) !!}
                            </div>
                            @show
                            <!--//Block center-->

                            <!--Block right -->
                            @section('block_main_content_right')
                             {!! gp247_render_block('right', $layout_page ?? null) !!}
                            @show
                            <!--//Block right -->

                        @show
                    </div>
                </div>
            </section>
        @show
        {{-- //Block main --}}

        {{-- Block bottom --}}
        @section('block_bottom')
            <!--Module bottom -->
            {!! gp247_render_block('bottom', $layout_page ?? null) !!}
            <!--//Module bottom -->
            @include($GP247TemplatePath.'.layout.block_bottom')
        @show
        {{-- //Block bottom --}}

        {{-- Block footer --}}
        @section('block_footer')
            <!--Module bottom -->
            {!! gp247_render_block('footer', $layout_page ?? null) !!}
            <!--//Module bottom -->
            @include($GP247TemplatePath.'.layout.block_footer')
        @show
        {{-- //Block footer --}}

    </div>

    <div id="gp247-loading">
        <div class="gp247-overlay"><i class="fa fa-spinner fa-pulse fa-5x fa-fw "></i></div>
    </div>
     
      <script src="{{ url('GP247/Templates/Default/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ url('GP247/Templates/Default/js/script.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="{{url('GP247/Templates/Default/js/core.min.js')}}"></script>
    
    
     
    <!-- js default for item gp247 -->
    @include($GP247TemplatePath.'.common.js')
    <!--//end js defaut -->
    @stack('scripts')
   

</body>
</html>
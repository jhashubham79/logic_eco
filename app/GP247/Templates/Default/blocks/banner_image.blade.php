@php
$banners = $modelBanner->start()->setType('banner')->getData();
$enableLoop = $banners->count() >= 3 ? 'true' : 'false';
@endphp

@if ($banners->count())
<section class="section swiper-container swiper-slider swiper-slider-1" data-loop="{{ $enableLoop }}" data-autoplay="5000">
  <div class="swiper-wrapper text-center text-lg-left">
    @foreach ($banners as $key => $banner)
    
      <div class="swiper-slide swiper-slide-caption context-dark" data-slide-bg="{{ gp247_file($banner->image) }}">
        <a href="{{ gp247_route_front('front.banner.click',['id' => $banner->id]) }}" target="{{ $banner->target }}">
          <div class="swiper-slide-caption section-md text-center">
            {!! gp247_html_render($banner->html) !!}
          </div>
        </a>
      </div>
    @endforeach
  </div>
  <div class="swiper-pagination"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</section>

@endif

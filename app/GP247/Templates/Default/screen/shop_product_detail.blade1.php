@php
/*
$layout_page = shop_product_detail
**Variables:**
- $product: no paginate
- $productRelation: no paginate
*/
@endphp

@extends($GP247TemplatePath.'.layout')

{{-- block_main --}}
@section('block_main_content_center')
<div class="col-lg-9 col-xl-9">
@php
    $countItem = 0
@endphp
      <!-- Single Product-->
      <section class="section section-sm section-first bg-default">
        <div class="container">
          <div class="row row-30">
            <div class="col-lg-6">
              <div class="slick-vertical slick-product">
                <!-- Slick Carousel-->
                <div class="slick-slider carousel-parent" id="carousel-parent" data-items="1" data-swipe="true" data-child="#child-carousel" data-for="#child-carousel">
                  <div class="item">
                    <div class="slick-product-figure"><img src="{{ gp247_file($product->getImage()) }}" alt="" width="530" height="480"/>
                    </div>
                  </div>
                  @if ($product->images->count())
                  @php
                    $countItem = 1 + $product->images->count();
                  @endphp
                  @foreach ($product->images as $key=>$image)
                  <div class="item">
                    <div class="slick-product-figure"><img src="{{ gp247_file($image->getImage()) }}" alt="" width="530" height="480"/>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>

                @if ($countItem > 1)
                <div class="slick-slider child-carousel slick-nav-1" id="child-carousel" data-arrows="true" data-items="{{ $countItem }}" data-sm-items="{{ $countItem }}" data-md-items="{{ $countItem }}" data-lg-items="{{ $countItem }}" data-xl-items="{{ $countItem }}" data-xxl-items="{{ $countItem }}" data-md-vertical="true" data-for="#carousel-parent">
                    <div class="item">
                      <div class="slick-product-figure"><img src="{{ gp247_file($product->getImage()) }}" alt="" width="530" height="480"/>
                      </div>
                    </div>
                    @foreach ($product->images as $key=>$image)
                    <div class="item">
                      <div class="slick-product-figure"><img src="{{ gp247_file($image->getThumb()) }}" alt="" width="530" height="480"/>
                      </div>
                    </div>
                    @endforeach
                  </div>
                @endif

              </div>
            </div>
            <div class="col-lg-6">
            <form id="buy_block" class="product-information" action="{{ gp247_route_front('cart.add') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="product_id" id="product-detail-id" value="{{ $product->id }}" />
              <input type="hidden" name="storeId" id="product-detail-storeId" value="{{ $product->store_id }}" />
              <div class="single-product">
                <h3 class="text-transform-none font-weight-medium" id="product-detail-name">{{ $product->name }}</h3>
                
                {!! $product->displayVendor() !!}
                
                <p>
                  SKU: <span id="product-detail-model">{{ $product->sku }}</span>
                </p>

                {{-- Show price --}}
                <div class="group-md group-middle">
                  <div class="single-product-price" id="product-detail-price">
                    {!! $product->showPriceDetail() !!}
                  </div>
                </div>
                {{--// Show price --}}

                <hr class="hr-gray-100">

                {{-- Button add to cart --}}
                @if ($product->kind != GP247_PRODUCT_GROUP && $product->allowSale() && gp247_config('product_use_button_add_to_cart'))
                <div class="group-xs group-middle">
                    <div class="product-stepper">
                      <input class="form-input" name="qty" type="number" data-zeros="true" value="1" min="1" max="100">
                    </div>
                    <div>
                      <button class="button button-secondary" type="submit" id="gp247-button-process">{{ gp247_language_render('action.add_to_cart') }}</button>
                    </div>
                </div>
                @endif
                {{--// Button add to cart --}}

                {{-- Show attribute --}}
                @if (gp247_config('product_tag'))
                <div id="product-detail-attr">
                    @if ($product->attributes())
                    {!! $product->renderAttributeDetails() !!}
                    @endif
                </div>
                @endif
                {{--// Show attribute --}}

                {{-- Stock info --}}
                @if (gp247_config('product_stock'))
                <div>
                    {{ gp247_language_render('product.stock_status') }}:
                    <span id="stock_status">
                        @if($product->stock <=0 && !gp247_config('product_buy_out_of_stock'))
                            {{ gp247_language_render('product.out_stock') }} 
                            @else 
                            {{ gp247_language_render('product.in_stock') }} 
                            @endif 
                    </span> 
                </div>
                @endif
                {{--// Stock info --}}

                {{-- date available --}}
                @if (gp247_config('product_available') && $product->date_available >= date('Y-m-d H:i:s'))
                    {{ gp247_language_render('product.date_available') }}:
                    <span id="product-detail-available">
                        {{ $product->date_available }}
                    </span>
                @endif
                {{--// date available --}}

                {{-- Category info --}}
                <div>
                  @php
                      $categories = [];
                  @endphp
                {{ gp247_language_render('product.category') }}: 
                @foreach ($product->categories as $category)
                  @php
                      $categories[] = '<a href="'.$category->getUrl().'">'.$category->getTitle().'</a>';
                  @endphp
                @endforeach
                {!! implode(', ', $categories) !!}
                </div>
                {{--// Category info --}}

                {{-- Brand info --}}
                @if (gp247_config('product_brand') && !empty($product->brand->name))
                <div>
                    {{ gp247_language_render('product.brand') }}:
                    <span id="product-detail-brand">
                        {!! empty($product->brand->name) ? 'None' : '<a href="'.$product->brand->getUrl().'">'.$product->brand->name.'</a>' !!}
                    </span>
                </div>
                @endif
                {{--// Brand info --}}

                {{-- Product kind --}}
                @if ($product->kind == GP247_PRODUCT_GROUP)
                  <div class="products-group">
                      @php
                      $groups = $product->groups
                      @endphp
                      <b>{{ gp247_language_render('product.kind_group') }}</b>:<br>
                      @foreach ($groups as $group)
                      <span class="gp247-product-group">
                          <a target=_blank href="{{ $group->product->getUrl() }}">
                              {!! gp247_image_render($group->product->image) !!}
                          </a>
                      </span>
                      @endforeach
                  </div>
                @endif

                @if ($product->kind == GP247_PRODUCT_BUILD)
                  <div class="products-group">
                      @php
                      $builds = $product->builds
                      @endphp
                      <b>{{ gp247_language_render('product.kind_bundle') }}</b>:<br>
                      <span class="gp247-product-build">
                          {!! gp247_image_render($product->image) !!} =
                      </span>
                      @foreach ($builds as $k => $build)
                      {!! ($k) ? '<i class="fa fa-plus" aria-hidden="true"></i>':'' !!}
                      <span class="gp247-product-build">{{ $build->quantity }} x
                          <a target="_new" href="{{ $build->product->getUrl() }}">{!!
                              gp247_image_render($build->product->image) !!}</a>
                      </span>
                      @endforeach
                  </div>
                @endif
              {{-- Product kind --}}

                <hr class="hr-gray-100">

                {{-- Social --}}
                <div class="group-xs group-middle"><span class="list-social-title">Share</span>
                  <div>
                    <ul class="list-inline list-social list-inline-sm">
                      <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                      <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                      <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                      <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
                    </ul>
                  </div>
                </div>
                {{--// Social --}}

              </div>
            </form>
            </div>
          </div>

          <!-- Bootstrap tabs-->
          <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1">
            <!-- Nav tabs-->
            <div class="nav-tabs-wrap">
              <ul class="nav nav-tabs nav-tabs-1">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" href="#tabs-1-1" data-toggle="tab">{{ gp247_language_render('product.description') }}</a>
                </li>
              </ul>
            </div>

            {{-- Render connetnt --}}
            <div class="tab-content tab-content-1">
              <div class="tab-pane fade show active" id="tabs-1-1">
                {!! gp247_html_render($product->content) !!}
              </div>
            </div>
            {{--// Render connetnt --}}

          </div>
        </div>
      </section>


      @if ($productRelation->count())
      <!-- Related Products-->
      <section class="section section-sm section-last bg-default">
        <div class="container">
          <h4 class="font-weight-sbold">{{ gp247_language_render('front.products_recommend') }}</h4>
          <div class="row row-lg row-30 row-lg-50 justify-content-center">
            @foreach ($productRelation as $key => $productRel)
           
            <div class="col-sm-6 col-md-5 col-lg-3">
                  {{-- Render product single --}}
                  @php
                      $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_product_single');
                  @endphp
                  @include($view, ['product' => $productRel])
                  {{-- //Render product single --}}
            </div>
            @endforeach
          </div>
        </div>
      </section>
      @endif
</div>
<!--/product-details-->
@endsection
{{-- block_main --}}


@push('styles')
      <!-- Render include css cart -->
      @php
          $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_css');
      @endphp
      @include($view)
      <!--// Render include css cart -->
@endpush

@push('scripts')
@endpush

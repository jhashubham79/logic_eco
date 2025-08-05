@php
/*
$layout_page = shop_product_list
**Variables:**
- $subCategory: paginate
Use paginate: $subCategory->appends(request()->except(['page','_token']))->links()
- $products: paginate
Use paginate: $products->appends(request()->except(['page','_token']))->links()
*/ 
@endphp

@extends($GP247TemplatePath.'.layout')

{{-- block_main_content_center --}}
@section('block_main_content_center')

<!-- home section -->
<section class="py-5 text-center  catogory-section-hero">
  <div class="container mt-5 ">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-8 col-sm-12">
          <div class="shop-section-heading position-relative">
        <!-- Left floating image -->
        <img src="{{url('images/shop-icon1.webp')}}" alt="Chart"
             class="floating-shop-icon-left ">

        <!-- Heading and Subheading -->
        <h1>Your Digital Challenges. Our Expert Solutions.</h1>
        <p>Speaks to the efficiency and positive outcomes users desire.</p>

        <!-- Right floating image -->
        <img src="{{url('images/shop-icon2.webp')}}" alt="Target"
             class="floating-shop-icon-right">
         </div>
      </div>
    </div>
  </div>
</section>

<!-- box section  -->
<!-- box section  -->
  <section class="py-5 feature-box-section">
    <div class="container">
      <div class="row g-4 text-start">
        <!-- Box 1 -->
        <div class="col-6 col-md-6 col-lg-3">
          <div class="feature-box p-4 h-100">
            <img src="{{url('images/expert-icon.webp')}}" alt="icon" class="img-fluid mb-2">
            <h6>Expert</h6>
            <p class="text-muted mb-0">Expert GTM Professionals</p>
          </div>
        </div>
        <!-- Box 2 -->
        <div class="col-6 col-md-6 col-lg-3">
          <div class="feature-box p-4 h-100">
            <img src="{{url('images/fixed-price-icon.webp')}}" alt="icon" class="img-fluid mb-2">
            <h6>Fixed price</h6>
            <p class="text-muted mb-0">Fixed Price, No Surprises</p>
          </div>
        </div>
        <!-- Box 3 -->
        <div class="col-6 col-md-6 col-lg-3">
          <div class="feature-box p-4 h-100">
            <img src="{{url('images/guarantee-icon.webp')}}" alt="icon" class="img-fluid mb-2">
            <h6>Guaranteed</h6>
            <p class="text-muted mb-0">Guaranteed Fix or Your money</p>
          </div>
        </div>
        <!-- Box 4 -->
        <div class="col-6 col-md-6 col-lg-3">
          <div class="feature-box p-4 h-100">
            <img src="{{url('images/same-day-icon.webp')}}" alt="icon" class="img-fluid mb-2">
            <h6>Same Day</h6>
            <p class="text-muted mb-0">Same-Day Delivery (within 24h)</p>
          </div>
        </div>
      </div>
    </div>
  </section>


<!-- filtersection -->
 <section class="filter-section mt-3">
  <div class="container
  ">
    <div class="row justify-content-center ">
      <div class="col-10 text-center">
        <h2>Find Your Fix</h2>
        <p>Here's a look at the types of urgent problems we solve. Each category represents a core area where small businesses often face roadblocks. Hover over any card to see examples of specific fixes, helping you quickly identify the right solution.</p>
      </div>
      <div class="col-lg-3  col-sm-12 text-center ">
        <div class="filter-box side-box">
          <div class="mobile-scroll">
              @php

 $cat = DB::table('gp247_shop_category_description')
    ->get();   
@endphp
              
             <button class=" btn-filter active" data-filter="all">All</button>
              @foreach($cat as $category)
            <button class=" btn-filter" data-filter="{{ $category->category_id }}">{{ $category->title }} </button>
             @endforeach

              </div>
        </div>
      </div>
<div class="col-lg-9 col-sm-12">
  <div class="card-box">
    <div class="card-box-img">
      <img src="images/Group 35595.svg" alt="">
    </div>
       <div class="card-grid-scrollable-shop" >
    <div class="row g-4 ">
       @if (count($products))
       
       @foreach ($products as $key => $product)
       @php
    $categoryIds = $product->categories->pluck('id')->toArray();
    $categoryString = implode(' ', $categoryIds); // space-separated
  @endphp
       
      <div class=" col-lg-4 col-md-6 col-sm-12 card-item " data-category="{{ $categoryString }}">
        @php
              $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_product_single');
          @endphp
          @include($view, ['product' => $product])
      </div>
@endforeach
 @else
  <div class="product-top-panel group-md">
    <p style="text-align:center">{!! gp247_language_render('front.no_item') !!}</p>
  </div>
  @endif
      

      </div>

    </div>
<!-- 
    <div class="card-see-all">
      <a href="#">See all</a>

    </div> -->
  </div>
</div>

    </div>
  </div>
 </section>
<!-- filtersection -->

<section class="simple-section text-center mt-5">
    <div class="container">
      <div class="row ">
        <div class="col-12">
          <div>
            <h2>Your Problem, Solved in 3 Simple Steps</h2>
          </div>
        </div>
        <div class="col-12">
          <div class="simple-border">
            <div class="row pd-40 mgap">
              <div class="col-md-4 col-sm-12">
                <div class="step-item stepBoxWrap">
                  <div class="stepBox">
                    <img src="{{url('images/step1.webp')}}" class="step-icon" alt="Step 1">
                    <div class="steptxt">
                      <p class="steps">STEP 1</p>
                      <h5>Choose Your Fix</h5>
                      <p class="status">Completed</p>
                    </div>
                    <div class="arrow-image1 d-none d-md-block d-lg-block"><svg class="custom-arrow-svg"
                        xmlns="http://www.w3.org/2000/svg" width="268" height="4" viewBox="0 0 268 4" fill="none">
                        <path d="M2 2H266" stroke="#008C76" stroke-width="4" stroke-linecap="round" />
                      </svg></div>
                    <div class="mobile_arrow1 d-md-none"><svg xmlns="http://www.w3.org/2000/svg" width="3" height="48"
                        viewBox="0 0 3 48" fill="none">
                        <path d="M1.5 1L1.5 47" stroke="#008C76" stroke-width="2" stroke-linecap="round" />
                      </svg></div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-12">
                <div class="step-item stepBoxWrap">
                  <div class="stepBox">
                    <img src="{{url('images/step2.webp')}}" class="step-icon" alt="Step 1">
                    <div class="steptxt">
                      <p class="steps">STEP 2</p>
                      <h5>Submit Your Details</h5>
                      <p class="status">Completed</p>
                    </div>
                    <div class="arrow-image2 d-none d-md-block d-lg-block"><svg class="custom-arrow-svg"
                        xmlns="http://www.w3.org/2000/svg" width="268" height="4" viewBox="0 0 268 4" fill="none">
                        <path d="M2 2H266" stroke="#008C76" stroke-width="4" stroke-linecap="round" />
                      </svg></div>
                    <div class="mobile_arrow2 d-md-none"><svg xmlns="http://www.w3.org/2000/svg" width="3" height="48"
                        viewBox="0 0 3 48" fill="none">
                        <path d="M1.5 1L1.5 47" stroke="#008C76" stroke-width="2" stroke-linecap="round" />
                      </svg></div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-12">
                <div class="step-item stepBoxWrap">
                  <div class="stepBox">
                    <img src="{{url('images/step3.webp')}}" class="step-icon" alt="Step 1">
                    <div class="steptxt">
                      <p class="steps">STEP 3</p>
                      <h5>Consider It Done</h5>
                      <p class="status">Completed</p>
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
  <!-- formsection -->
  <section class="custom-contact-section mb-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class=" custom-contact-bg d-flex align-items-center justify-content-center"
            style="background-image: url(images/rectangle.webp); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 300px;  padding: 30px;">
            <div class="row w-100 align-items-center">
              <div class="col-md-6 col-sm-12 text-white">
                <div class="contact-form-heading">
                  <h3>Have a Different Problem?</h3>
                  <p>
                    If you don’t see the exact service you need, don’t worry.
                    We can likely create a custom fix for you. Get in touch for a
                    bespoke quote from our experts.
                  </p>

                </div>
              </div>
              <div class="col-md-6 ">
                <form>
                  <div class="row g-2">
                    <div class="col-md-6 col-sm-12">
                      <input type="text" class="form-control" placeholder="Full Name" required />
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <input type="text" class="form-control" placeholder="Email or Phone number" required />
                    </div>
                    <div class="col-12">
                      <textarea class="form-control" placeholder="Write..." rows="3" required></textarea>
                    </div>
                    <div class="col-12 text-end">
                      <button type="submit" class="btn btn-pink mt-2">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
{{-- //block_main_content_center --}}


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
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

@if($category)
<!-- home section -->
<section class="py-5 text-center  catogory-section-hero">
  <div class="container mt-5 ">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-8 col-sm-12">
          <div class=" catogory-section-heading position-relative">
        <!-- Left floating image -->
        <img src="{{url($category->cat_1_image)}}" alt="Chart"
             class="floating-icon-left ">

        <!-- Heading and Subheading -->
        <h1>{{$category->title}}</h1>
        <p >{{$category->description}}</p>

        <!-- Right floating image -->
        <img src="{{url($category->cat_2_image)}}" alt="Target"
             class="floating-icon-right">
         </div>
      </div>
    </div>
  </div>
</section>

<!-- box section  -->
<section class="py-5 feature-box-section">
  <div class="container">
    <div class="row g-4 text-start">
      @for ($i = 1; $i <= 4; $i++)
        @php
          $name = $category["usp_{$i}_name"] ?? null;
          $content = $category["usp_{$i}_content"] ?? null;
          $image = $category["usp_{$i}_image"] ?? null;
        @endphp

        @if ($name || $content || $image)
          <div class="col-6 col-md-6 col-lg-3">
            <div class="feature-box p-4 h-100">
              @if ($image)
                <img src="{{ asset($image) }}" alt="" class="img-fluid mb-2">
              @endif
              <h6>{{ $name }}</h6>
              <p class="text-muted mb-0">{{ $content }}</p>
            </div>
          </div>
        @endif
      @endfor
    </div>
  </div>
</section>


@endif


<!-- filter-section  -->

 <section class="filter-section mt-3">
  <div class="container
  ">
    <div class="row justify-content-center ">
      <div class="col-10  text-center">
        <h2>Find Your Fix</h2>
        <p>Here's a look at the types of urgent problems we solve. Each category represents a core area where small businesses often face roadblocks. Hover over any card to see examples of specific fixes, helping you quickly identify the right solution.</p>
      </div>
      <!-- <div class="col-12  text-center  ">
        <div class="filter-box">
          <div class="mobile-scroll">
             <button class=" btn-filter active" data-filter="all">Most Popular </button>
            <button class=" btn-filter" data-filter="Analytics">Analytics & Tracking </button>
             <button class=" btn-filter" data-filter="quickfix">Website Quick Fixes </button>
              <button class=" btn-filter" data-filter="redirects">Broken Link & Redirect Fixes</button>
              <button class=" btn-filter" data-filter="mobile">Mobile Display Issue Fix </button>
              </div>
        </div>
      </div> -->
<div class="col-12">
  <div class="card-box">

   <div class="row align-items-center mb-3">
  <!-- Heading -->
  <div class="col-md-6 col-12 ">
    <h3 class="Product-catogory">Products</h3>
  </div>
  
  <!-- Search (Right Aligned) -->
  <div class="col-md-6 col-12 mt-2 mt-md-0 text-md-end">
    <div class="input-group" >
      <span class="input-group-text bg-white border-end-0">
        <i class="bi bi-search text-muted"></i>
      </span>
      <input type="text" class="form-control border-start-0" placeholder="Search">
    </div>
  </div>
</div>

    <div class="card-box-img">
      <img src="images/Group 35595.svg" alt="">
    </div>
       <div class="card-grid-scrollable-catogory" >
    <div class="row g-4 ">
      
       @if (count($products))
        @foreach ($products as $key => $product)
          <div class=" col-lg-3 col-md-6 col-sm-12 card-item  " data-category="Analytics">
        @php
              $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_product_single');
          @endphp
          @include($view, ['product' => $product])
          </div>
          @endforeach
      <!-- Render pagination -->
    @include($GP247TemplatePath.'.common.pagination', ['items' => $products])
    <!--// Render pagination -->
  @else
  <div class="product-top-panel group-md">
    <p style="text-align:center">{!! gp247_language_render('front.no_item') !!}</p>
  </div>
  @endif

      </div>

    </div>

    <!-- <div class="card-see-all">
      <a href="#">See all</a>

    </div> -->
  </div>
</div>

    </div>
  </div>
 </section>

  
  
  
  
  <section class="simple-section text-center">
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
                <img src="{{url('images/3 (2).png')}}" class="step-icon" alt="Step 1">
              <div class="steptxt">
                <p  class="steps">STEP 1</p>
                <h5>Choose Your Fix</h5>
                <p class="status">Completed</p>
              </div>
               <div class="arrow-image1 d-none d-md-block d-lg-block" ><svg xmlns="http://www.w3.org/2000/svg" width="268" height="4"    viewBox="0 0 268 4" fill="none">
               <path d="M2 2H266" stroke="#008C76" stroke-width="4" stroke-linecap="round"/>
               </svg></div>
               <div class="mobile_arrow1 d-md-none"><svg xmlns="http://www.w3.org/2000/svg" width="3" height="48" viewBox="0 0 3 48" fill="none">
                    <path d="M1.5 1L1.5 47" stroke="#008C76" stroke-width="2" stroke-linecap="round"/>
                    </svg></div>
              </div>
            </div>
            </div>

             <div class="col-md-4 col-sm-12">
              <div class="step-item stepBoxWrap">               
                <div class="stepBox">
                   <img src="{{url('images/3 (3).png')}}" class="step-icon" alt="Step 1">
                   <div class="steptxt">
                    <p  class="steps">STEP 2</p>
                    <h5>Submit Your Details</h5>
                    <p class="status">Completed</p>
                   </div>                  
                  <div class="arrow-image2 d-none d-md-block d-lg-block" ><svg xmlns="http://www.w3.org/2000/svg" width="268" height="4"    viewBox="0 0 268 4" fill="none">
                  <path d="M2 2H266" stroke="#008C76" stroke-width="4" stroke-linecap="round"/>
                  </svg></div>
                    <div class="mobile_arrow2 d-md-none"><svg xmlns="http://www.w3.org/2000/svg" width="3" height="48" viewBox="0 0 3 48" fill="none">
                        <path d="M1.5 1L1.5 47" stroke="#008C76" stroke-width="2" stroke-linecap="round"/>
                        </svg></div>
                </div>
            </div>
            </div>

             <div class="col-md-4 col-sm-12">
              <div class="step-item stepBoxWrap">                
              <div class="stepBox">
                <img src="{{url('images/3 (1).png')}}" class="step-icon" alt="Step 1">
                <div class="steptxt">
                  <p  class="steps">STEP 3</p>
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

<section class="custom-contact-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class=" custom-contact-bg d-flex align-items-center justify-content-center" style="background-image: url(/images/Rectangle.png); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 300px;  padding: 30px;">
           <div class="row w-100 align-items-center">
    <div class="col-md-6 col-sm-12 text-white">
      <div class="contact-form-heading">
                 <h3 >Have a Different Problem?</h3>
                        <p >
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


<!-- Fanq -->
<section class="faq-section py-5">
  <div class="container">
    <h2 class="text-center mb-4">FAQs ?</h2>

    @php
      $faqItems = [];
      $rawFaq = $category->faq ??  null;

      if (is_string($rawFaq)) {
          $faqItems = json_decode($rawFaq, true) ?? [];
      } elseif (is_array($rawFaq)) {
          $faqItems = $rawFaq;
      }
    @endphp

    @if (count($faqItems))
      <div class="accordion faqsList" id="faqAccordion">
        @foreach ($faqItems as $index => $faq)
          <div class="accordion-item mb-3 rounded shadow-sm">
            <h2 class="accordion-header" id="faqHeading{{ $index }}">
              <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#faqCollapse{{ $index }}"
                      aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                      aria-controls="faqCollapse{{ $index }}">
                {{ $faq['question'] ?? 'No question provided' }}
              </button>
            </h2>
            <div id="faqCollapse{{ $index }}"
                 class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                 aria-labelledby="faqHeading{{ $index }}"
                 data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                {{ $faq['answer'] ?? 'No answer provided' }}
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-center">No FAQs available for this product.</p>
    @endif
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
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
<!-- home section -->
<section class="py-5 text-center  product-section-hero">
  <div class="container mt-5 ">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-8 col-sm-12">
          <div class=" product-section-heading  position-relative">
        <!-- Left floating image -->
        <img src="/images/2 (2).png" alt="Chart"
             class="floating-icon-left-product ">

        <!-- Heading and Subheading -->
        
        <h1>{{ $product->name }}</h1>
            <!--<img src="/images/Google logo.svg" alt="">-->
        
       {!! $product->description !!}

        <!-- Right floating image -->
        <img src="/images/4 3.png" alt="Target"
             class="floating-icon-right-product">

             <div class="product-section-btn">
                <p><span class="font-weight-bold">${{ $product->price }}</span> / One-Time Fix</p>
                
                
                 <form id="buy_block" class="product-information" action="{{ gp247_route_front('cart.add') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="product_id" id="product-detail-id" value="{{ $product->id }}" />
              <input type="hidden" name="storeId" id="product-detail-storeId" value="{{ $product->store_id }}" />
             
                
                {{-- Button add to cart --}}
                @if ($product->kind != GP247_PRODUCT_GROUP && $product->allowSale() && gp247_config('product_use_button_add_to_cart'))
               
                      <input class="form-input" name="qty" type="number" data-zeros="true" value="1" min="1" max="100">
                    
                      <button class="btn-products" type="submit" id="gp247-button-process">{{ gp247_language_render('action.add_to_cart') }}</button>
                    
                @endif
              
            </form>
                
                
               

             </div>
         </div>
      </div>
    </div>
  </div>
</section>

<!-- box section  -->
<section class="py-5 feature-box-section">
  <div class="container">
    <div class="row g-4 text-start">

      <!-- Box 1 -->
      <div class="col-6 col-md-6 col-lg-3">
        <div class="feature-box p-4 h-100">
          <img src="/images/2 2.png" alt="" class="img-fluid mb-2">
          <h6>Expert</h6>
          <p >Expert GTM Professionals</p>
        </div>
      </div>

      <!-- Box 2 -->
      <div class="col-6 col-md-6 col-lg-3">
        <div class="feature-box p-4 h-100">
          <img src="/images/35.png" alt="" class="img-fluid mb-2">
          <h6>Fixed price</h6>
          <p class="text-muted mb-0">Fixed Price, No Surprises</p>
        </div>
      </div>

      <!-- Box 3 -->
      <div class="col-6 col-md-6 col-lg-3">
        <div class="feature-box p-4 h-100">
          <img src="/images/2 5.png" alt="" class="img-fluid mb-2">
          <h6>Guaranteed</h6>
          <p class="text-muted mb-0">Guaranteed Fix or Your money</p>
        </div>
      </div>

      <!-- Box 4 -->
      <div class="col-6 col-md-6 col-lg-3">
        <div class="feature-box p-4 h-100">
          <img src="/images/2 6.png" alt="" class="img-fluid mb-2">
          <h6>Same Day</h6>
          <p class="text-muted mb-0">Same-Day Delivery (within 24h)</p>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- What you Got -->
  <section class="whatyougot"> 
    <div class="container">
        <div class="row  g-2 justify-content-center">
            <div class="col-12 ">
                <div class="whatyougot-heading text-center">
                    <h2>Here What you Got</h2>
                    <p>Here's a look at the types of urgent problems we solve. Each category represents a core area where small businesses often face roadblocks. Hover over any card to see examples of specific fixes, helping you quickly identify the right solution.</p>
                </div>
            </div>
          
            <div class="col-lg-4 col-12  text-md-center ">
                <div class="whatyougot-img ">
                  <img src="/images/whatyougetimg.png" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="whatyougot-content">
                <div class="whatyougoticon"><img src="/images/whatyougeticonimg.png" class="img-fluid" alt=""></div>
                <div><p>Comprehensive GTM container debug and audit

                </p></div>
            </div>
              <div class="whatyougot-content">
                <div class="whatyougoticon"><img src="/images/whatyougeticonimg.png" class="img-fluid" alt=""></div>
                <div><p>Configuration and fix for up to 3 key event triggers (e.g., clicks, form submissions)

                </p></div>
            </div>
              <div class="whatyougot-content">
                <div class="whatyougoticon"><img src="/images/whatyougeticonimg.png" class="img-fluid" alt=""></div>
                <div><p>
                  Verification of data flow to Google Analytics (or other specified platform)
                </p></div>
            </div>
              <div class="whatyougot-content">
                <div class="whatyougoticon"><img src="/images/whatyougeticonimg.png" class="img-fluid" alt=""></div>
                <div><p>
                      Quality assurance testing across major browsers
                </p></div>
            </div>
              <div class="whatyougot-content">
                <div class="whatyougoticon"><img src="/images/whatyougeticonimg.png" class="img-fluid" alt=""></div>
                <div><p>
                         A concise report detailing fixes and recommendations
                </p></div>
            </div>
              <div class="whatyougot-content">
                <div class="whatyougoticon"><img src="/images/whatyougeticonimg.png" class="img-fluid" alt=""></div>
                <div><p>
                      detailing fixes and recommendations
                </p></div>
            </div>

            </div>
             
        </div>
    </div>
 </section> 

<!-- problem-cardsection  -->


<section class="problem-card-section">
    <div class="container py-5">
  <!-- Top Section: Problems -->
  <h2>Frustrated with GTM Issues?</h2>
  <div class="row g-4 justify-content-center">
    <div class="col-md-3 col-sm-6">
      <div class="problem-card">
        <img src="/images/2 2 (1).png" alt="" width="50">
        <h5>Tags not firing correctly?</h5>
        <p >Sorry, the page you are looking for doesn’t exist or has been removed. Keep exploring out site:</p>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="problem-card">
        <img src="/images/2 3.png" alt="" width="50">
        <h5>Frustrating setup errors?</h5>
         <p >Sorry, the page you are looking for doesn’t exist or has been removed. Keep exploring out site:</p>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="problem-card">
        <img src="/images/2 3 (1).png" alt="" width="50">
        <h5>Missing conversion data?</h5>
         <p >Sorry, the page you are looking for doesn’t exist or has been removed. Keep exploring out site:</p>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="problem-card">
        <img src="/images/2 2 (1).png" alt="" width="50">
        <h5 >Missing conversion data?</h5>
        <p >Sorry, the page you are looking for doesn’t exist or has been removed. Keep exploring out site:</p>
      </div>
    </div>
  </div>
</section>


<!-- price-section  -->
<section class=" price-section-product py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col--10 col-sm-12">
        <div class="price-section text-center"> 
             <h2>Enhance Your Solution</h2>
             <p >
               Here's a look at the types of urgent problems we solve. Each category represents a core area where small businesses often face roadblocks. Hover over any card to see examples of specific fixes, helping you quickly identify the right solution.
              </p>
        </div>
        <div class="col-md-10 col-sm-12 mx-auto">
          <div>
              <div class="price-section-cards">
      <!-- Option Cards -->
      <div class=" form-check form-product border-bottom">
        <div>
          <input class="form-check-input " type="checkbox" value="" id="option1">
          <label class="form-check-label " for="option1">Advanced GA4 Reporting setup</label>
          <p>Get custom dashboard and reports tailored to your KPIs.</p>
        </div>
        <span>$299</span>
      </div>

      <div class=" form-check form-product border-bottom">
        <div>
          <input class="form-check-input " type="checkbox" value="" id="option1">
          <label class="form-check-label " for="option1">Advanced GA4 Reporting setup</label>
          <p>Get custom dashboard and reports tailored to your KPIs.</p>
        </div>
        <span>$299</span>
      </div>

      <div class=" form-check form-product border-bottom">
        <div>
          <input class="form-check-input " type="checkbox" value="" id="option1">
          <label class="form-check-label " for="option1">Advanced GA4 Reporting setup</label>
          <p>Get custom dashboard and reports tailored to your KPIs.</p>
        </div>
        <span>$299</span>
      </div>

      <!-- Total Price Row -->
      <div class=" product-price-sec  mt-4  ">
        <div class="price-badge-product">
          <span class="badge  d-none d-md-flex">Saving 20%</span>
        <div class="product-total">Total : <span class="total price">$299</span></div>
        </div>
        
        <button class="product-price-btn">Buy GTM <span class="fix">Fix</span></button>
      </div>
    </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</section>






 <!-- simple step  -->

 
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
                <img src="/images/3 (2).png" class="step-icon" alt="Step 1">
              <div class="steptxt">
                <p  class="steps">STEP 1</p>
                <h5>Choose Your Fix</h5>
                <p class="status">Completed</p>
              </div>
               <div class="arrow-image1 d-none d-md-block d-lg-block" ><svg class="custom-arrow-svg" xmlns="http://www.w3.org/2000/svg" width="268" height="4"    viewBox="0 0 268 4" fill="none">
               <path d="M2 2H266" stroke="#008C76" stroke-width="4" stroke-linecap="round"/>
               </svg></div>
               <div class="mobile_arrow1 d-md-none"><svg  xmlns="http://www.w3.org/2000/svg" width="3" height="48" viewBox="0 0 3 48" fill="none">
                    <path d="M1.5 1L1.5 47" stroke="#008C76" stroke-width="2" stroke-linecap="round"/>
                    </svg></div>
              </div>
            </div>
            </div>

             <div class="col-md-4 col-sm-12">
              <div class="step-item stepBoxWrap">               
                <div class="stepBox">
                   <img src="/images/3 (3).png" class="step-icon" alt="Step 1">
                   <div class="steptxt">
                    <p  class="steps">STEP 2</p>
                    <h5>Submit Your Details</h5>
                    <p class="status">Completed</p>
                   </div>                  
                  <div class="arrow-image2 d-none d-md-block d-lg-block" ><svg class="custom-arrow-svg" xmlns="http://www.w3.org/2000/svg" width="268" height="4"    viewBox="0 0 268 4" fill="none">
                  <path d="M2 2H266" stroke="#008C76" stroke-width="4" stroke-linecap="round"/>
                  </svg></div>
                    <div class="mobile_arrow2 d-md-none"><svg  xmlns="http://www.w3.org/2000/svg" width="3" height="48" viewBox="0 0 3 48" fill="none">
                        <path d="M1.5 1L1.5 47" stroke="#008C76" stroke-width="2" stroke-linecap="round"/>
                        </svg></div>
                </div>
            </div>
            </div>

             <div class="col-md-4 col-sm-12">
              <div class="step-item stepBoxWrap">                
              <div class="stepBox">
                <img src="/images/3 (1).png" class="step-icon" alt="Step 1">
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
        <div class=" custom-contact-bg d-flex align-items-center justify-content-center" style="background-image: url(images/Rectangle.png); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 300px;  padding: 30px;">
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
    <div class="accordion faqsList " id="faqAccordion">
      <!-- Item 1 (open by default) -->
      <div class="accordion-item mb-3 rounded shadow-sm">
        <h2 class="accordion-header" id="faqHeadingOne">
          <button class="accordion-button" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#faqCollapseOne"
            aria-expanded="true"
            aria-controls="faqCollapseOne">
           What is Webflow and why is it the best website builder?
          </button>
        </h2>
        <div id="faqCollapseOne"
             class="accordion-collapse collapse show"
             aria-labelledby="faqHeadingOne"
             data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Webflow is a powerful visual development platform that allows designers to build fully responsive websites without writing a single line of code. It combines the flexibility of code with the simplicity of a visual editor, empowering creators to bring their ideas to life faster and more efficiently than ever before.
          </div>
        </div>
      </div>

      <!-- Item 2 -->
      <div class="accordion-item mb-3 rounded shadow-sm">
        <h2 class="accordion-header" id="faqHeadingTwo">
          <button class="accordion-button collapsed" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#faqCollapseTwo"
            aria-expanded="false"
            aria-controls="faqCollapseTwo">
            What is your favorite template from BRIX Templates?
          </button>
        </h2>
        <div id="faqCollapseTwo"
             class="accordion-collapse collapse"
             aria-labelledby="faqHeadingTwo"
             data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Webflow is a powerful visual development platform that allows designers to build fully responsive websites without writing a single line of code. It combines the flexibility of code with the simplicity of a visual editor, empowering creators to bring their ideas to life faster and more efficiently than ever before.
          </div>
        </div>
      </div>

      <!-- Additional items similarly -->
      <div class="accordion-item mb-3 rounded shadow-sm">
        <h2 class="accordion-header" id="faqHeadingThree">
          <button class="accordion-button collapsed" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#faqCollapseThree"
            aria-expanded="false"
            aria-controls="faqCollapseThree">
            What is your favorite template from BRIX Templates?
          </button>
        </h2>
        <div id="faqCollapseThree"
             class="accordion-collapse collapse"
             aria-labelledby="faqHeadingThree"
             data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Webflow is a powerful visual development platform that allows designers to build fully responsive websites without writing a single line of code. It combines the flexibility of code with the simplicity of a visual editor, empowering creators to bring their ideas to life faster and more efficiently than ever before.
          </div>
        </div>
      </div>

      <!-- Add more items as needed -->
    </div>
  </div>
</section>

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


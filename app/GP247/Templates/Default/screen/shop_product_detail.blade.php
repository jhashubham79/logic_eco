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
        <img src="{{url($product->image)}}" alt="Chart"
             class="floating-icon-left-product ">

        <!-- Heading and Subheading -->
        
      @php
    $name = strip_tags($product->name);
    $words = explode(' ', $name, 2);
    $firstWord = $words[0];
    $rest = isset($words[1]) ? ' ' . $words[1] : '';
@endphp

<h1>
    <span class="text-primary">{{ $firstWord }}</span>{{ $rest }}
</h1>
  

         
        <!-- Right floating image -->
        <img src="{{url($product->images[0]->image ?? '')}}" alt="Target"
             class="floating-icon-right-product">

             <div class="product-section-btn">
                <p><span class="font-weight-bold">${{ $product->price }}</span> / One-Time Fix</p>
                
                
                 <form id="buy_block" class="product-information" action="{{ gp247_route_front('cart.add') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="product_id" id="product-detail-id" value="{{ $product->id }}" />
              <input type="hidden" name="storeId" id="product-detail-storeId" value="{{ $product->store_id }}" />
             
                
                {{-- Button add to cart --}}
                @if ($product->kind != GP247_PRODUCT_GROUP && $product->allowSale() && gp247_config('product_use_button_add_to_cart'))
               
                      <input class="form-input" name="qty" type="hidden" data-zeros="true" value="1" min="1" max="100">
                    
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

      @for ($i = 1; $i <= 4; $i++)
        @php
            $name = $product->{'usp_'.$i.'_name'} ?? null;
            $image = $product->{'usp_'.$i.'_image'} ?? null;
            $content = $product->{'usp_'.$i.'_content'} ?? null;
        @endphp

        @if ($name || $image || $content)
          <div class="col-6 col-md-6 col-lg-3">
            <div class="feature-box p-4 h-100">
              @if ($image)
                <img src="{{ url($image) }}" alt="" class="img-fluid mb-2">
              @endif
              @if ($name)
                <h6>{{ $name }}</h6>
              @endif
              @if ($content)
                <p class="text-muted mb-0">{{ $content }}</p>
              @endif
            </div>
          </div>
        @endif
      @endfor

    </div>
  </div>
</section>


<!-- What you Got -->
  <!-- What you Got -->
<section class="whatyougot"> 
  <div class="container">
    <div class="row g-2 justify-content-center">
      
      <div class="col-12">
        <div class="whatyougot-heading text-center">
          <h2>{{ $product->what_heading }}</h2>
          <p>
            {{ $product->what_subheading }}
          </p>
        </div>
      </div>

      <div class="col-lg-4 col-12 text-md-center">
        <div class="whatyougot-img">
          <img src="{{url($product->what_image ?? '')}}" class="img-fluid" alt="">
        </div>
      </div>

      <div class="col-lg-6 col-12">
        @php
          // This depends on your structure
          $items = $product->what_items ?? [];
          if (is_string($items)) $items = json_decode($items, true);
        @endphp

        @foreach ($items as $item)
          @if (!empty($item))
            <div class="whatyougot-content">
              <div class="whatyougoticon">
                <img src="/images/whatyougeticonimg.png" class="img-fluid" alt="">
              </div>
              <div><p>{{ $item }}</p></div>
            </div>
          @endif
        @endforeach

      </div>

    </div>
  </div>
</section>


<!-- problem-cardsection  -->


<section class="problem-card-section">
  <div class="container py-5">
    <h2>Frustrated with product Issues?</h2>
    <div class="row g-4 justify-content-center">

      @php
        $frus = [];

        for ($i = 1; $i <= 4; $i++) {
          $frus[] = [
            'image' => $product->{'frus_' . $i . '_image'} ?? '',
            'name' => $product->{'frus_' . $i . '_name'} ?? '',
            'content' => $product->{'frus_' . $i . '_content'} ?? '',
          ];
        }
      @endphp

      @foreach ($frus as $item)
        @if ($item['name'] || $item['content'])
        <div class="col-md-3 col-sm-6">
          <div class="problem-card h-100 text-center p-3">
            @if ($item['image'])
              <img src="{{ url($item['image']) }}" alt="" width="50" class="mb-2">
            @endif
            <h5>{{ $item['name'] }}</h5>
            <p>{{ $item['content'] }}</p>
          </div>
        </div>
        @endif
      @endforeach

    </div>
  </div>
</section>


<!-- Related Product Section -->
<section class="price-section-product py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="price-section text-center"> 
          <h2>Enhance Your Solution</h2>
          <p>
            Here's a look at the types of urgent problems we solve. Each category represents a core area where small businesses often face roadblocks. Hover over any card to see examples of specific fixes, helping you quickly identify the right solution.
          </p>
        </div>

     @php
    use Illuminate\Support\Facades\DB;

    // Main product price
    $mainProductId = $product->id;
    $mainProductPrice = $product->price;

    // Get related product IDs excluding the current product
    $relatedIds = DB::table('related_product')
        ->where('product_id', $mainProductId)
        ->orWhere('related_product_id', $mainProductId)
        ->get()
        ->flatMap(function ($item) use ($mainProductId) {
            return collect([$item->product_id, $item->related_product_id])
                ->reject(fn($id) => $id == $mainProductId);
        })
        ->unique()
        ->values()
        ->toArray();

    // Get related products with English description
    $relatedProducts = DB::table('gp247_shop_product as p')
        ->join('gp247_shop_product_description as d', 'p.id', '=', 'd.product_id')
        ->whereIn('p.id', $relatedIds)
        ->where('d.lang', 'en') // Filter for English language
        ->select('p.id', 'p.price', 'd.name', 'd.description')
        ->get();
@endphp

@if($relatedProducts->count())
<form id="multi-add-to-cart" action="{{ gp247_route_front('cart.multi_add') }}" method="POST">
  @csrf

  {{-- Main product (always included) --}}
  <input type="hidden" name="products[]" value="{{ $mainProductId }}">
  
      <input type="hidden"
             name="qty[{{ $mainProductId }}]"
             value="1"
             min="1"
             class="form-control form-control-sm qty-input"
             style="width: 80px;"
             data-id="{{ $mainProductId }}"
             data-price="{{ $mainProductPrice }}"
             id="main-product-qty">
    </div>
 

  {{-- Related products --}}
  @foreach ($relatedProducts as $relProd)
    <div class="form-check form-product border-bottom py-3 d-flex justify-content-between align-items-start">
      <div>
        <input 
            class="form-check-input product-checkbox" 
            type="checkbox" 
            name="products[]" 
            value="{{ $relProd->id }}" 
            data-price="{{ $relProd->price }}"
            id="product_{{ $relProd->id }}">
        <label class="form-check-label fw-bold" for="product_{{ $relProd->id }}">
          {{ $relProd->name }}
        </label>
        <p class="mb-1">{{ $relProd->description ?? 'No description available' }}</p>
      </div>

      <div class="text-end">
        <span class="d-block text-muted mb-2">${{ number_format($relProd->price, 2) }}</span>
        <input type="number" 
               name="qty[{{ $relProd->id }}]" 
               value="1" 
               min="1" 
               class="form-control form-control-sm qty-input d-none" 
               style="width: 80px;" 
               data-id="{{ $relProd->id }}"
               disabled>
      </div>
    </div>
  @endforeach

  <div class="product-price-sec mt-4 text-center">
    <div class="price-badge-product mb-3">
      <!--<span class="badge bg-success d-none d-md-inline-block">Saving 20%</span>-->
      <div class="product-total fs-5">Total: <span class="total price">$0.00</span></div>
    </div>
    <button type="submit" class="product-price-btn btn btn-warning px-5">
      Buy  
    </button>
  </div>
</form>
@endif


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

    @php
      $faqItems = [];
      $rawFaq = $product->faq ??  null;

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
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const totalDisplay = document.querySelector('.total.price');

    function calculateTotal() {
      let total = 0;

      // Always include main product
      const mainQty = document.querySelector('#main-product-qty');
      const mainPrice = parseFloat(mainQty.dataset.price);
      total += mainPrice * parseInt(mainQty.value || 1);

      // Include related products if checked
      checkboxes.forEach(cb => {
        const id = cb.value;
        const price = parseFloat(cb.dataset.price);
        const qtyInput = document.querySelector(`.qty-input[data-id="${id}"]`);
        const qty = (cb.checked && qtyInput && !qtyInput.disabled)
            ? parseInt(qtyInput.value || 1)
            : 0;

        if (cb.checked) {
          total += price * qty;
        }
      });

      totalDisplay.textContent = `$${total.toFixed(2)}`;
    }

    // Toggle input enable/disable on checkbox change
    checkboxes.forEach(cb => {
      cb.addEventListener('change', function () {
        const qtyInput = document.querySelector(`.qty-input[data-id="${cb.value}"]`);
        if (qtyInput) {
          qtyInput.disabled = !cb.checked;
        }
        calculateTotal();
      });
    });

    // Recalculate on quantity input change
    const qtyInputs = document.querySelectorAll('.qty-input');
    qtyInputs.forEach(input => {
      input.addEventListener('input', calculateTotal);
    });

    // Initial run
    calculateTotal();
  });
</script>


@endpush


<!-- problem-section -->

@php
$home = DB::table('gp247_front_page_description')
    ->where('page_id', '9f6721bb-7c1e-433d-89b3-c5b7290e5980')
    ->first();
@endphp

 <section class="problem-section " >
  <div class="container">
    <div class="row align-items-center ">
      <div class="col-md-5 col-sm-12">
        <div class="problem-section-heading">
           <h2>Ask AI About Your Problem</h2>
           <p>Not sure which service you need? Describe your issue below, and our Al assistant will suggest the </p>
        </div>
      </div>
      <div class="col-md-7 col-sm-12">
         <div class="recommendation-form-wrapper">
             
             
            \
              <form class="recommendation-form" action="{{ gp247_route_front('front.search') }}"  method="GET">
               <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="e.g., Need to Improve my SEO ..." />
               <button   type="submit">Get Recommendations</button>
            </form>
       </div>
      </div>
    </div>
  </div>

  <div class="problem-section-img">
    <img src="{{url('images/2.webp')}}" class="img-fluid" alt="image">
     
  </div>

 </section>
 <!-- problem-section -->
 <section class="buget-frendly mb-5">
  <div class="container">
    <div class="row justify-content-center">
      
      <!-- Section Heading -->
      <div class="col-10">
        <div class="buget-frendly-heading text-center">
          <h2>{{ $home->budget_heading ?? 'Budget Friendly (Benefits)' }}</h2>
          <p>{{ $home->budget_content ?? '' }}</p>
        </div>
      </div>

      <div class="col-12">
        <div class="row g-4 justify-content-center">

          <!-- Left Large Card (Card 1) -->
          <div class="col-lg-5">
            <div class="cards h-100">
              <div class="d-flex justify-content-center">
                <div class="buget-frendly-img">
                  @if (!empty($home->budget_card_1_icon))
                    <img src="{{ url('uploads/' . $home->budget_card_1_icon) }}" class="img-fluid" alt="">
                  @endif
                </div>
              </div>
              <h3>{{ $home->budget_card_1_title ?? '' }}</h3>
              <p class="card-text">{{ $home->budget_card_1_subtitle ?? '' }}</p>
            </div>
          </div>

          <!-- Right Column (Cards 2 & 3) -->
          <div class="col-lg-5">
            <div class="bugets-right-cards gap-4 h-100">

              <!-- Card 2 -->
              <div class="card">
                <div class="buget-frendly-small-card d-flex align-items-center">
                  <div class="me-3">
                    <h3>{{ $home->budget_card_2_title ?? '' }}</h3>
                    <p>{{ $home->budget_card_2_subtitle ?? '' }}</p>
                  </div>
                  <div class="ms-auto">
                    @if (!empty($home->budget_card_2_icon))
                      <img src="{{  url('uploads/' . $home->budget_card_2_icon) }}" alt="">
                    @endif
                  </div>
                </div>
              </div>

              <!-- Card 3 -->
              <div class="card">
                <div class="buget-frendly-small-card d-flex align-items-center">
                  <div class="me-3">
                    <h3>{{ $home->budget_card_3_title ?? '' }}</h3>
                    <p>{{ $home->budget_card_3_subtitle ?? '' }}</p>
                  </div>
                  <div class="ms-auto">
                    @if (!empty($home->budget_card_3_icon))
                      <img src="{{  url('uploads/' . $home->budget_card_3_icon) }}" alt="">
                    @endif
                  </div>
                </div>
              </div>

            </div>
          </div> <!-- /.col-lg-5 -->

        </div>
      </div>

    </div>
  </div>
</section>


 <!-- section-ready -->
<section class="section-ready">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-ready-content">
          <h2>Ready to Get It Off Your To-</br>Do List?</h2>
          <div class="ready-btn">
            <a href="#">View All Serives</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section-ready -->

<!-- testimonialsection -->
<!-- Swiper -->

<!-- testimonialsection -->
  <div class="testimonial-slider">
    <div class="container-fluid">
      <div class="buget-frendly-heading text-center">
        <h2>Testimonials</h2>
        <p>Real Results, Real Voices</p>
      </div>
      <div class="swiper-container">
        <div class="swiper">
          <div class="swiper-wrapper">
            
            <div class="swiper-slide swiper-slide--nine">
              <div class="slide-content">
                <div class="testimonial-video">
                  <video controls="" controlslist="nodownload" class="w-100"><source src="" type="video/mp4"></video>
                </div>
                <div class="testimonial-user">
                  <div class="t-username">
                    <span class="t-username1">John Doe 6</span>
                    <span class="user-p">Founder & CEO, Keka</span>
                  </div>
                  <div class="t-userimage">
                    <img src="{{url('images/logo.webp')}}" alt="image">
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide swiper-slide--nine">
              <div class="slide-content">
                <div class="testimonial-video">
                  <video controls="" controlslist="nodownload" class="w-100"><source src="" type="video/mp4"></video>
                </div>
                <div class="testimonial-user">
                  <div class="t-username">
                    <span class="t-username1">John Doe 6</span>
                    <span class="user-p">Founder & CEO, Keka</span>
                  </div>
                  <div class="t-userimage">
                    <img src="{{url('images/logo.webp')}}" alt="image">
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide swiper-slide--nine">
              <div class="slide-content">
                <div class="testimonial-video">
                  <video controls="" controlslist="nodownload" class="w-100"><source src="" type="video/mp4"></video>
                </div>
                <div class="testimonial-user">
                  <div class="t-username">
                    <span class="t-username1">John Doe 6</span>
                    <span class="user-p">Founder & CEO, Keka</span>
                  </div>
                  <div class="t-userimage">
                    <img src="{{url('images/logo.webp')}}" alt="image">
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide swiper-slide--nine">
              <div class="slide-content">
                <div class="testimonial-video">
                  <video controls="" controlslist="nodownload" class="w-100"><source src="" type="video/mp4"></video>
                </div>
                <div class="testimonial-user">
                  <div class="t-username">
                    <span class="t-username1">John Doe 6</span>
                    <span class="user-p">Founder & CEO, Keka</span>
                  </div>
                  <div class="t-userimage">
                    <img src="{{url('images/logo.webp')}}" alt="image">
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide swiper-slide--nine">
              <div class="slide-content">
                <div class="testimonial-video">
                  <video controls="" controlslist="nodownload" class="w-100"><source src="" type="video/mp4"></video>
                </div>
                <div class="testimonial-user">
                  <div class="t-username">
                    <span class="t-username1">John Doe 6</span>
                    <span class="user-p">Founder & CEO, Keka</span>
                  </div>
                  <div class="t-userimage">
                    <img src="{{url('images/logo.webp')}}" alt="image">
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="swiper-pagination"></div>

        </div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
          </svg>
        </div>
        <div class="swiper-button-next">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
          </svg>
        </div>


      </div>
    </div>
  </div>
  <!-- testimonialsection -->


<!-- testimonialsection -->


 <!-- formsection -->

<section class="custom-contact-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class=" custom-contact-bg d-flex align-items-center justify-content-center" style="background-image: url(images/rectangle.webp); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 300px;  padding: 30px;">
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




<!-- Fanq -->
<section class="faq-section py-5">
  <div class="container">
    <h2 class="text-center mb-4">FAQs ?</h2>
 
    @php
      $faqItems = [];
      $rawFaq = $home->faqs ??  null;

      if (is_string($rawFaq)) {
          $faqItems = json_decode($rawFaq, true) ?? [];
      } elseif (is_array($rawFaq)) {
          $faqItems = $rawFaq;
      }
    @endphp

    @if (count($faqItems))
      <div class="accordion faqsList" id="faqAccordion">
        @foreach ($faqItems as $index => $faq)
          <div class="accordion-item mb-3">
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





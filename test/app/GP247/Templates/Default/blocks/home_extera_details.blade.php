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
              <form class="recommendation-form">
               <input type="text" placeholder="e.g., Need to Improve my SEO ..." />
               <button   type="submit">Get Recommendations</button>
            </form>
       </div>
      </div>
    </div>
  </div>

  <div class="problem-section-img">
    <img src="images/2.png" class="img-fluid" alt="">
     
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
<div class="container py-5">
  <div class="owl-carousel video-3d-carousel">

    <!-- Slide 1 -->
    <div class="video-item">
      <video src="images/1088330669-preview.mp4" muted poster="posters/poster1.jpg"></video>
    </div>

    <!-- Slide 2 -->
    <div class="video-item">
       <video src="images/1088330669-preview.mp4" muted poster="posters/poster1.jpg"></video>
    </div>

    <!-- Slide 3 -->
    <div class="video-item">
      <video src="images/1088330669-preview.mp4" muted poster="posters/poster1.jpg"></video>
    </div>

    <!-- Add more slides -->
  </div>
</div>

<!-- testimonialsection -->


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
         @php
         if($home->faqs) {
           // Decode the JSON string into an array
           $faqs = json_decode($home->faqs, true);
         } else {
           $faqs = [];
         }  
      
      @endphp
      @foreach($faqs as $index => $faq)
      <div class="accordion-item mb-3 rounded shadow-sm">
        <h2 class="accordion-header" id="faqHeadingOne{{$index}}">
          <button class="accordion-button" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#faqCollapseOne{{$index}}"
            aria-expanded="true"
            aria-controls="faqCollapseOne">
           {{ $faq['question'] ?? 'Default Question' }}
          </button>
        </h2>
        <div id="faqCollapseOne{{$index}}"
             class="accordion-collapse collapse show"
             aria-labelledby="faqHeadingOne{{$index}}"
             data-bs-parent="#faqAccordion">
          <div class="accordion-body">
         {{ $faq['answer'] ?? 'Default Answer' }}
          </div>
        </div>
      </div>
      @endforeach
    

      <!-- Add more items as needed -->
    </div>
  </div>
</section>

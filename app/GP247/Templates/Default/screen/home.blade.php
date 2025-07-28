@php
/*
$layout_page = front_home
*/ 
@endphp

@extends($GP247TemplatePath.'.layout')

@section('block_main')
@php
$home = DB::table('gp247_front_page_description')
    ->where('page_id', '9f6721bb-7c1e-433d-89b3-c5b7290e5980')
    ->first();
@endphp




<section class="hero-section  ">
  <div class="container z-2 pt-5 mt-4">
   <div class="row justify-content-center">
    <div class="col-md-10 col-sm-12">
        <h1>
 {!! $home->heading !!}
</h1>
    <p>
  {{$home->subheading}}
    </p>
    <a href="{{$home->button_link}}" class="btn custom-btn ">{{$home->button_text}}</a>
    </div>
   </div>
  </div>

  <!-- Bottom Video -->
  <div class="video-wrapper">
    <video autoplay muted loop>
      <source src="{{url('public/images/1088330669-preview.mp4')}}" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
</section>


<!-- 3simple step -->


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
                <img src="{{url('public/images/3 (2).png')}}" class="step-icon" alt="Step 1">
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
                   <img src="images/3 (3).png" class="step-icon" alt="Step 1">
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
                <img src="{{url('public/images/3 (1).png')}}" class="step-icon" alt="Step 1">
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




@endsection

@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')
{{-- //script here --}}
@endpush

@php
$productsNew = $modelProduct->start()->getProductLatest()->setlimit(gp247_config('product_top'))->getData();
@endphp

@if ($productsNew->count())

@php
$home = DB::table('gp247_front_page_description')
    ->where('page_id', '9f6721bb-7c1e-433d-89b3-c5b7290e5980')
    ->first();

 $cat = DB::table('gp247_shop_category_description')
   
    ->get();   
@endphp

<!-- filtersection -->
 <section class="filter-section mt-3">
  <div class="container
  ">
    <div class="row justify-content-center ">
      <div class="col-10  text-center">
        <h2>{{$home->find_title}}</h2>
        <p>{{$home->find_content}}</p>
      </div>
      <div class="col-12  text-center ">
        <div class="filter-box">
          <div class="mobile-scroll">
            <button class=" btn-filter active" data-filter="all">Most Popular </button>
           
              @foreach($cat as $category)
              <button class=" btn-filter" data-filter="{{ $category->category_id }}">{{ $category->title }}</button>
              @endforeach
             
            
              </div>
        </div>
      </div>
<div class="col-12">
  <div class="card-box">
    <div class="card-box-img">
      <img src="{{url('images/icon-r.svg')}}" alt="">
    </div>
       <div class="card-grid-scrollable" >
    <div class="row g-4 ">
      
 @foreach ($productsNew as $key => $productNew)
  @php
    $categoryIds = $productNew->categories->pluck('id')->toArray();
    $categoryString = implode(' ', $categoryIds); // space-separated
  @endphp

 

  <div class="col-lg-3 col-md-6 col-sm-12 card-item" data-category="{{ $categoryString }}">
    {{-- Render product single --}}
    @php
      $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_product_single');
    @endphp
    @include($view, ['product' => $productNew])
    {{-- //Render product single --}}
  </div>
@endforeach



      </div>

    </div>

    <div class="card-see-all">
      <a href="{{url('product')}}">See all</a>

    </div>
  </div>
</div>

    </div>
  </div>
 </section>
<!-- filtersection -->



   
@endif
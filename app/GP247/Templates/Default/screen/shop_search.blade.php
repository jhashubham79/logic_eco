@extends($GP247TemplatePath.'.layout')

{{-- block_main_content_center --}}
@section('block_main_content_center')
<div class="col-lg-9 col-xl-9">

  {{-- ✅ Perfect Matches --}}
  <h3>{{ __('Perfect Matches') }}</h3>
  @if ($perfectMatches->count())
    <div class="row row-30 row-lg-50">
      @foreach ($perfectMatches as $product)
        <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
          <div class="filter-card">
            <div class="icon-image">
              <img src="{{ gp247_file($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
            <h4>{{ $product->name }}</h4>
            {!! $product->description !!}
            <div class="filter-price">
              <span class="price">${{ $product->price }}</span>
              <button class="filter-price-btn" onclick="window.location='{{ url('product/' . $product->alias) }}'">Buy Now</button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <p class="text-center text-muted">{{ __('No perfect matches found.') }}</p>
  @endif
<hr>
  
    <h3>{{ __('Similar Suggestions') }}</h3>
     <hr>
  @if ($priceMismatchMatches->count())
   
   
    <div class="row row-30 row-lg-50">
      @foreach ($priceMismatchMatches as $product)
        <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
          <div class="filter-card">
            <div class="icon-image">
              <img src="{{ gp247_file($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
            <h4>{{ $product->name }}</h4>
            {!! $product->description !!}
            <div class="filter-price">
              <span class="price">${{ $product->price }}</span>
              <button class="filter-price-btn" onclick="window.location='{{ url('product/' . $product->alias) }}'">View</button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif

 
  @if ($similarMatches->count())
   
   
    <div class="row row-30 row-lg-50">
      @foreach ($similarMatches as $product)
        <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
          <div class="filter-card">
            <div class="icon-image">
              <img src="{{ gp247_file($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
            <h4>{{ $product->name }}</h4>
            {!! $product->description !!}
            <div class="filter-price">
              <span class="price">${{ $product->price }}</span>
              <button class="filter-price-btn" onclick="window.location='{{ url('product/' . $product->alias) }}'">View</button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif

</div>
@endsection
{{-- //block_main_content_center --}}

@push('styles')
  @php
      $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_css');
  @endphp
  @include($view)
@endpush

@push('scripts')
  @php
      $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_js');
  @endphp
  @include($view)
@endpush

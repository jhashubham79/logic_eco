
        <div class="filter-card">
          <div class="icon-image"><img src="{{ gp247_file($product->getThumb()) }}" alt="{{ $product->name }}"  class="img-fluid"></div>
          <h4>{{ $product->name }}</h4>
          {!! $product->description !!}
          <div class="filter-price">
            <span class="price">${{ $product->price }}</span>
            <button class="filter-price-btn" onclick="window.location='{{ $product->getUrl() }}'">Buy Now</button>
          </div>
        </div>


@pushOnce('scripts')
      <!-- Render include js cart -->
      @php
          $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_js');
      @endphp
      @include($view)
      <!--// Render include js cart -->
@endPushOnce
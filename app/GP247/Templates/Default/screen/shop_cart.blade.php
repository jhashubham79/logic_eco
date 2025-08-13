@php
/*
$layout_page = shop_cart
**Variables:**
- $cart: no paginate
- $countries: array
- $attributesGroup: array
*/
@endphp

@extends($GP247TemplatePath.'.layout')

@section('block_main')



<section class="cart py-5">
        <div class="container">
             <h1 class="mb-4 text-center">Cart</h1>
             <div class="row g-4 justify-content-center">
                 <div class="col-lg-10">
             <div class="my-orders bg-white">
            <div class="row g-4 justify-content-center">
                
                
                 @if (count($cart) ==0)

            <div class="col-md-12">
                {!! gp247_language_render('cart.cart_empty') !!}!
            </div>

            @else
            @php
                $cartTmp = $cart->groupBy('storeId');
            @endphp
                
                <div class="col-lg-12">
                    
                        
                        @foreach ($cartTmp as $sId => $cartItem)
                        
                        <form action="{{ gp247_route_front('checkout.prepare') }}" method="POST">
                    <input type="hidden" name="store_id" value="{{ $sId }}">
                    @csrf

                    {{-- Item cart detail --}}
                    @php
                        $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_cart_list');
                    @endphp
                    @include($view, ['cartItem' => $cartItem])
                    {{-- //Item cart detail --}}
                    
                    {{-- Button checkout --}}
                   
                        <div class="pull-right">
                              
                              
                             <button class="btn custom-btn   cart-checkout-button text-center text-md-end" type="submit">
                            Checkout <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                            
                            <!--<button class="button button-secondary" type="submit" id="">{{ gp247_language_render('cart.checkout') }}</button>-->
                        </div>
                    
                    {{-- Button checkout --}}
                </form>
                        @endforeach
            {{--// Render cart item for earch shop --}}
           
                        
                    
                </div>
</div>
                <!-- Order Summary -->
                 @endif
            </div>
        </div>
        </div>
        </div>
    </section>










@endsection

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
@php
/*
$layout_page = shop_checkout
**Variables:**
- $cartItem: collection
- $storeCheckout: int
- $shippingMethod: string
- $paymentMethod: string
- $totalMethod: array
- $dataTotal: array
- $shippingAddress: array
- $countries: array
- $attributesGroup: array
*/

      $action_url = 'checkout.process';
    $current_url = url()->current(); 
    
    $count = count(explode('/',$current_url));
    if (explode('/',$current_url)[$count-1] == "buynow") {
        $action_url = 'checkout.lastbuynow';
    }
@endphp

@extends($GP247TemplatePath.'.layout')


@section('block_main')
<section class="section section-xl bg-default text-md-left shop-checkout cart">
    <div class="container">
        <div class="row">
            @if (count($cartItem) ==0)
            <div class="col-md-12 text-danger min-height-37vh">
                {!! gp247_language_render('cart.cart_empty') !!}!
            </div>
            @else
            <div class="col-12">
                <h1 class="h3 my-5 text-center"><i class="fa fa-shopping-bag" aria-hidden="true"></i>  {{ gp247_store_info(key: 'title', storeId: $storeCheckout) }}</h1>
            </div>

            {{-- Item cart detail --}}
            @php
                $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_checkout_list');
            @endphp
            @include($view, ['cartItem' => $cartItem])
            {{-- //Item cart detail --}}


            <div class="col-md-12">
              <div class="my-orders bg-white mb-4">
                <form class="gp247-shipping-address checkout-form" id="gp247-form-process" role="form" method="POST" action="{{ gp247_route_front($action_url) }}">
                @csrf
                <div class="row">
                    {{-- Begin address shipping --}}
                    <div class="col-md-6">
                        {{-- Select address if customer login --}}
                        @if (customer()->user())
                            <div class="">
                                <select class="form-control" name="address_process" style="width: 100%;" id="addressList">
                                    <option value="">{{ gp247_language_render('cart.change_address') }}</option>
                                    @foreach ($addressList as $k => $address)
                                    <option value="{{ $address->id }}" {{ (old('address_process') ==  $address->id) ? 'selected':''}}>- {{ $address->first_name. ' '.$address->last_name.', '.$address->address1.' '.$address->address2.' '.$address->address3 }}</option>
                                    @endforeach
                                    <option value="new" {{ (old('address_process') ==  'new') ? 'selected':''}}>{{ gp247_language_render('cart.add_new_address') }}</option>
                                </select>
                            </div>
                        @endif
                        {{--// Select address if customer login --}}
                        
                        {{-- Render address shipping --}}
                        <table class="table table-borderless table-responsive">
                            <tr width=100%>
                                @if (gp247_config('customer_lastname'))
                                    <td class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label class="control-label"><i class="fa fa-user"></i>
                                            {{ gp247_language_render('order.first_name') }}:</label>
                                        <input class="form-control" name="first_name" type="text"
                                            placeholder="{{ gp247_language_render('order.first_name') }}"
                                            value="{{old('first_name', $shippingAddress['first_name'])}}">
                                        @if($errors->has('first_name'))
                                        <span class="help-block">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </td>
                                    <td class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label class="control-label"><i class="fa fa-user"></i>
                                            {{ gp247_language_render('order.last_name') }}:</label>
                                        <input class="form-control" name="last_name" type="text" placeholder="{{ gp247_language_render('order.last_name') }}"
                                            value="{{old('last_name',$shippingAddress['last_name'])}}">
                                        @if($errors->has('last_name'))
                                        <span class="help-block">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </td>
                                @else
                                    <td colspan="2"
                                        class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label class="control-label"><i class="fa fa-user"></i>
                                            {{ gp247_language_render('order.name') }}:</label>
                                        <input class="form-control" name="first_name" type="text" placeholder="{{ gp247_language_render('order.name') }}"
                                            value="{{old('first_name',$shippingAddress['first_name'])}}">
                                        @if($errors->has('first_name'))
                                        <span class="help-block">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>

                            @if (gp247_config('customer_name_kana'))
                                <tr>
                                <td class="form-group{{ $errors->has('first_name_kana') ? ' has-error' : '' }}">
                                    <label class="control-label"><i class="fa fa-user"></i>
                                        {{ gp247_language_render('order.first_name_kana') }}:</label>
                                    <input class="form-control" name="first_name_kana" type="text"
                                        placeholder="{{ gp247_language_render('order.first_name_kana') }}"
                                        value="{{old('first_name_kana', $shippingAddress['first_name_kana'])}}">
                                    @if($errors->has('first_name_kana'))
                                    <span class="help-block">{{ $errors->first('first_name_kana') }}</span>
                                    @endif
                                </td>
                                <td class="form-group{{ $errors->has('last_name_kana') ? ' has-error' : '' }}">
                                    <label class="control-label"><i class="fa fa-user"></i>
                                        {{ gp247_language_render('order.last_name_kana') }}:</label>
                                    <input class="form-control" name="last_name_kana" type="text" placeholder="{{ gp247_language_render('order.last_name_kana') }}"
                                        value="{{old('last_name_kana',$shippingAddress['last_name_kana'])}}">
                                    @if($errors->has('last_name_kana'))
                                    <span class="help-block">{{ $errors->first('last_name_kana') }}</span>
                                    @endif
                                </td>
                                </tr>
                            @endif

                            <tr>
                                @if (gp247_config('customer_phone'))
                                    <td class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="control-label"><i class="fa fa-envelope"></i>
                                            {{ gp247_language_render('order.email') }}:</label>
                                        <input class="form-control" name="email" type="text" placeholder="{{ gp247_language_render('order.email') }}"
                                            value="{{old('email', $shippingAddress['email'])}}">
                                        @if($errors->has('email'))
                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                        @endif
                                    </td>
                                    <td class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label class="control-label"><i class="fa fa-phone"
                                                aria-hidden="true"></i> {{ gp247_language_render('order.phone') }}:</label>
                                        <input class="form-control" name="phone" type="text" placeholder="{{ gp247_language_render('order.phone') }}"
                                            value="{{old('phone',$shippingAddress['phone'])}}">
                                        @if($errors->has('phone'))
                                            <span class="help-block">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </td>
                                @else
                                    <td colspan="2" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="control-label"><i class="fa fa-envelope"></i>
                                            {{ gp247_language_render('order.email') }}:</label>
                                        <input class="form-control" name="email" type="text" placeholder="{{ gp247_language_render('order.email') }}"
                                            value="{{old('email',$shippingAddress['email'])}}">
                                        @if($errors->has('email'))
                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                            
                            
                            <tr>
                                <td colspan="2" class="form-group">
                                    <div class="create-account">
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" id="createAccount" name="create_account" value="1">
                                          <label class="form-check-label" for="createAccount">
                                            Create an account?
                                          </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            @if (gp247_config('customer_country'))
                            <tr>
                                <td colspan="2" class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                    <label for="country" class="control-label"><i class="fas fa-globe"></i>
                                        {{ gp247_language_render('order.country') }}:</label>
                                    @php
                                        $ct = old('country',$shippingAddress['country']);
                                    @endphp
                                    <select class="form-control country " style="width: 100%;" name="country">
                                        <option value="">__{{ gp247_language_render('order.country') }}__</option>
                                        @foreach ($countries as $k => $v)
                                        <option value="{{ $k }}" {{ ($ct ==$k) ? 'selected':'' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                            {{ $errors->first('country') }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endif


                            <tr>
                                @if (gp247_config('customer_postcode'))
                                    <td class="form-group {{ $errors->has('postcode') ? ' has-error' : '' }}">
                                        <label for="postcode" class="control-label"><i class="fa fa-tablet"></i>
                                            {{ gp247_language_render('order.postcode') }}:</label>
                                        <input class="form-control" name="postcode" type="text" placeholder="{{ gp247_language_render('order.postcode') }}"
                                            value="{{ old('postcode',$shippingAddress['postcode'])}}">
                                        @if($errors->has('postcode'))
                                            <span class="help-block">{{ $errors->first('postcode') }}</span>
                                        @endif
                                    </td>
                                @endif

                                @if (gp247_config('customer_company'))
                                    <td class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                                        <label for="company" class="control-label"><i class="fa fa-university"></i>
                                            {{ gp247_language_render('order.company') }}</label>
                                        <input class="form-control" name="company" type="text" placeholder="{{ gp247_language_render('order.company') }}"
                                            value="{{ old('company',$shippingAddress['company'])}}">
                                        @if($errors->has('company'))
                                            <span class="help-block">{{ $errors->first('company') }}</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>

                            @if (gp247_config('customer_address1'))
                            <tr>
                                    <td colspan="2"
                                        class="form-group {{ $errors->has('address1') ? ' has-error' : '' }}">
                                        <label for="address1" class="control-label"><i class="fa fa-list-ul"></i>
                                            {{ gp247_language_render('order.address') }}:</label>
                                        <input class="form-control" name="address1" type="text" placeholder="{{ gp247_language_render('order.address1') }}"
                                            value="{{ old('address1',$shippingAddress['address1'])}}">
                                        @if($errors->has('address1'))
                                            <span class="help-block">{{ $errors->first('address1') }}</span>
                                        @endif
                                    </td>
                            </tr>
                            @endif

                            @if (gp247_config('customer_address2'))
                            <tr>
                                    <td colspan="2"
                                        class="form-group {{ $errors->has('address2') ? ' has-error' : '' }}">
                                        <label for="address2" class="control-label"><i class="fa fa-list-ul"></i>
                                            {{ gp247_language_render('order.address') }}:</label>
                                        <input class="form-control" name="address2" type="text" placeholder="{{ gp247_language_render('order.address2') }}"
                                            value="{{ old('address2',$shippingAddress['address2'])}}">
                                        @if($errors->has('address2'))
                                            <span class="help-block">{{ $errors->first('address2') }}</span>
                                        @endif
                                    </td>
                            </tr>
                            @endif

                            @if (gp247_config('customer_address3'))
                            <tr>
                                    <td colspan="2"
                                        class="form-group {{ $errors->has('address3') ? ' has-error' : '' }}">
                                        <label for="address3" class="control-label"><i class="fa fa-list-ul"></i>
                                            {{ gp247_language_render('order.address') }}:</label>
                                        <input class="form-control" name="address3" type="text" placeholder="{{ gp247_language_render('order.address3') }}"
                                            value="{{ old('address3',$shippingAddress['address3'])}}">
                                        @if($errors->has('address3'))
                                            <span class="help-block">{{ $errors->first('address3') }}</span>
                                        @endif
                                    </td>
                            </tr>
                            @endif

                            <tr>
                                <td colspan="2">
                                    <label class="control-label"><i class="fa fa-calendar-o"></i>
                                        {{ gp247_language_render('cart.note') }}:</label>
                                    <textarea class="form-control" rows="5" name="comment"
                                        placeholder="{{ gp247_language_render('cart.note') }}....">{{ old('comment','')}}</textarea>
                                </td>
                            </tr>

                        </table>
                        {{-- //Render address shipping --}}
                        
                        <!--<div class="create-account">-->
                        <!--    <div class="form-check">-->
                        <!--      <input class="form-check-input" type="checkbox" id="createAccount" name="create_account" value="1">-->
                        <!--      <label class="form-check-label" for="createAccount">-->
                        <!--        Create an account?-->
                        <!--      </label>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    {{--// End address shipping --}}


                    <div class="col-md-6">
                        {{-- Total --}}
                        <div class="row">
                            <div class="col-md-12">
                                {{-- Data total --}}
                                @php
                                    $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_render_total');
                                @endphp
                                @include($view)
                                {{-- Data total --}}

                                {{-- Total method --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('totalMethod') ? ' has-error' : '' }}">
                                            @if($errors->has('totalMethod'))
                                                <span class="help-block">{{ $errors->first('totalMethod') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            @foreach ($totalMethod as $key => $plugin)
                                                @includeIf($plugin['appPath'].'::render')
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                {{-- //Total method --}}

@if (gp247_config('use_shipping'))
                                {{-- Shipping method --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('shippingMethod') ? ' has-error' : '' }}">
                                            <h3 class="control-label"><i class="fa fa-truck" aria-hidden="true"></i>
                                                {{ gp247_language_render('order.shipping_method') }}:<br></h3>
                                            @if($errors->has('shippingMethod'))
                                            <span class="help-block">{{ $errors->first('shippingMethod') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            @foreach ($shippingMethod as $key => $shipping)
                                            <div>
                                                <label class="radio-inline">
                                                    <input type="radio" name="shippingMethod"
                                                        value="{{ $shipping['key'] }}"
                                                        {{ (old('shippingMethod') == $key)?'checked':'' }}
                                                        style="position: relative;"
                                                        {{ ($shipping['permission'])?'':'disabled' }}>
                                                    <span for="shippingMethod">{{ $shipping['title'] }}</span>
                                                </label>
                                            </div>

                                            {{-- Render view --}}
                                            @includeIf($shipping['appPath'].'::render')
                                            {{-- //Render view --}}

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                {{-- //Shipping method --}}
@endif

@if (gp247_config('use_payment'))
                                {{-- Payment method --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="px-md-5">
                                        <div
                                            class="form-group {{ $errors->has('paymentMethod') ? ' has-error' : '' }}">
                                            <h3 class="control-label mb-4"><i class="fa fa-credit-card-alt"></i>
                                                {{ gp247_language_render('order.payment_method') }}:<br></h3>
                                            @if($errors->has('paymentMethod'))
                                            <span class="help-block">{{ $errors->first('paymentMethod') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group cart-payment-method">
                                            @foreach ($paymentMethod as $key => $payment)
                                            <div>
                                                <label class="radio-inline">
                                                    <input type="radio" name="paymentMethod"
                                                        value="{{ $payment['key'] }}"
                                                        {{ (old('paymentMethod') == $key)?'checked':'' }}
                                                        style="position: relative;"
                                                        {{ ($payment['permission'])?'':'disabled' }}>
                                                        <span class="radio-inline" for="paymentMethod">
                                                            <img title="{{ $payment['title'] }}"
                                                                alt="{{ $payment['title'] }}"
                                                                src="{{ gp247_file('GP247/'.$payment['image']) }}"
                                                                style="width: 120px;">
                                                        </span>
                                                </label>
                                            </div>

                                            {{-- Render view --}}
                                            @includeIf($payment['appPath'].'::render')
                                            {{-- //Render view --}}

                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- //Payment method --}}
@endif

                            </div>
                            
                        </div>
                        {{-- End total --}}

                        {{-- Button checkout --}}
                        <div class="row" style="padding-bottom: 20px;">
                            <div class="col-md-12 text-center">
                                <div class="px-md-5">
                                <div class="pull-right">
                                    {!! $viewCaptcha ?? ''!!}
                                    <button class="btn custom-btn" type="submit" id="gp247-button-process">{{ gp247_language_render('cart.checkout') }}</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        {{-- Button checkout --}}

                    </div>
                </div>
            </form>
              </div>
        </div>





            @endif
        </div>
    </div>
</section>

@endsection




@push('scripts')

{{-- Render script from total method --}}
@foreach ($totalMethod as $key => $plugin)
    @includeIf($plugin['appPath'].'::script')
@endforeach
{{--// Render script from total method --}}

{{-- Render script from shipping method --}}
@foreach ($shippingMethod as $key => $plugin)
    @includeIf($plugin['appPath'].'::script')
@endforeach
{{--// Render script from shipping method --}}

{{-- Render script from payment method --}}
@foreach ($paymentMethod as $key => $plugin)
    @includeIf($plugin['appPath'].'::script')
@endforeach
{{--// Render script from payment method --}}

<script type="text/javascript">

    $('#gp247-button-process').click(function(){
        $('#gp247-form-process').submit();
        $(this).prop('disabled',true);
    });

    $('#addressList').change(function(){
        var id = $('#addressList').val();
        if(!id) {
            return;   
        } else if(id == 'new') {
            $('#gp247-form-process [name="first_name"]').val('');
            $('#gp247-form-process [name="last_name"]').val('');
            $('#gp247-form-process [name="phone"]').val('');
            $('#gp247-form-process [name="postcode"]').val('');
            $('#gp247-form-process [name="company"]').val('');
            $('#gp247-form-process [name="country"]').val('');
            $('#gp247-form-process [name="address1"]').val('');
            $('#gp247-form-process [name="address2"]').val('');
            $('#gp247-form-process [name="address3"]').val('');
        } else {
            $.ajax({
            url: '{{ gp247_route_front('customer.address_detail') }}',
            type: 'GET',
            dataType: 'json',
            async: false,
            cache: false,
            data: {
                id: id,
            },
            success: function(data){
                error= parseInt(data.error);
                if(error === 1)
                {
                    alert(data.msg);
                }else{
                    $('#gp247-form-process [name="first_name"]').val(data.first_name);
                    $('#gp247-form-process [name="last_name"]').val(data.last_name);
                    $('#gp247-form-process [name="phone"]').val(data.phone);
                    $('#gp247-form-process [name="postcode"]').val(data.postcode);
                    $('#gp247-form-process [name="company"]').val(data.company);
                    $('#gp247-form-process [name="country"]').val(data.country);
                    $('#gp247-form-process [name="address1"]').val(data.address1);
                    $('#gp247-form-process [name="address2"]').val(data.address2);
                    $('#gp247-form-process [name="address3"]').val(data.address3);
                }

                }
        });
        }
    });

</script>
@endpush

@push('styles')
      <!-- Render include css cart -->
      @php
          $view = gp247_shop_process_view($GP247TemplatePath, 'common.shop_css');
      @endphp
      @include($view)
      <!--// Render include css cart -->
@endpush
@php
/*
$layout_page = shop_profile
** Variables:**
- $customer
- $countries
*/ 
@endphp

@php
    $view = gp247_shop_process_view($GP247TemplatePath, 'account.layout');
@endphp
@extends($view)

@section('block_main_profile')
   <!-- Right Panel -->
<div class="col-lg-9">
    <div class="dashboard-r">
        <h2 class="dashboard-r-heading">{{ gp247_language_render('customer.update_infomation') }}</h2>
        <div class="profile-details">
            <form method="POST" action="{{ gp247_route_front('customer.post_change_infomation') }}">
                @csrf

                {{-- Name (First/Last or Just First Name) --}}
                @if (gp247_config('customer_lastname'))
                    <div class="form-group row {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-3 col-form-label text-md-right">
                            {{ gp247_language_render('customer.first_name') }}
                        </label>
                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control custom-filter" name="first_name"
                                   value="{{ old('first_name', $customer['first_name']) }}">
                            @if($errors->has('first_name'))
                                <span class="help-block">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-3 col-form-label text-md-right">
                            {{ gp247_language_render('customer.last_name') }}
                        </label>
                        <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control custom-filter" name="last_name"
                                   value="{{ old('last_name', $customer['last_name']) }}">
                            @if($errors->has('last_name'))
                                <span class="help-block">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="form-group row {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-3 col-form-label text-md-right">
                            {{ gp247_language_render('customer.name') }}
                        </label>
                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control custom-filter" name="first_name"
                                   value="{{ old('first_name', $customer['first_name']) }}">
                            @if($errors->has('first_name'))
                                <span class="help-block">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Phone --}}
                @if (gp247_config('customer_phone'))
                    <div class="form-group row {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-3 col-form-label text-md-right">
                            {{ gp247_language_render('customer.phone') }}
                        </label>
                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control custom-filter" name="phone"
                                   value="{{ old('phone', $customer['phone']) }}">
                            @if($errors->has('phone'))
                                <span class="help-block">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Email (display only) --}}
                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label text-md-right">
                        {{ gp247_language_render('customer.email') }}
                    </label>
                    <div class="col-md-6 pt-2">
                        {{ $customer['email'] }}
                    </div>
                </div>

                {{-- Address 1 --}}
                <div class="form-group row {{ $errors->has('address1') ? ' has-error' : '' }}">
                    <label for="address1" class="col-md-3 col-form-label text-md-right">
                       Address
                    </label>
                    <div class="col-md-6">
                        <input id="address1" type="text" class="form-control custom-filter" name="address1"
                               value="{{ old('address1', $customer['address1']) }}">
                        @if($errors->has('address1'))
                            <span class="help-block">{{ $errors->first('address1') }}</span>
                        @endif
                    </div>
                </div>

                {{-- You can continue this same UI format for other fields like address2, address3, sex, birthday, etc. --}}

                {{-- Submit --}}
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button class="btn custom-btn mt-2" type="submit">
                            {{ gp247_language_render('customer.update_infomation') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


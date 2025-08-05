@php
/*
$layout_page = shop_auth
$token 
$email
*/ 
@endphp

@extends($GP247TemplatePath.'.layout')

@section('block_main')

<div class="signup py-5">
    <div class="container">
        <div class="signup-bg">
            <div class="signup-tabs text-center">
                  
                    {{-- Login Tab --}}
                    <div >
                        
                        <div class="text-center mt-4">
                            <h2 class="heading2">Create New Password!</h2>
                            <!--<p class="tagline2">Please enter your username or email address. You will receive a link to create a new password via email.</p>-->
                        </div>
                        <div class="form-fields text-start">
                            <div class="row justify-content-center">
                                <div class="col-md-5 col-lg-4">
                 <form method="POST" action="{{ gp247_route_front('customer.password_request') }}" aria-label="{{ gp247_language_render('customer.password_reset') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                       <div class="mb-3">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ gp247_language_render('customer.email') }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                           </div>

                       <div class="mb-3">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ gp247_language_render('customer.password') }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="mb-3">
                                <input id="password-confirm" type="password" placeholder="{{ gp247_language_render('customer.password_confirm') }}" class="form-control" name="password_confirmation" required>
                          
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button class="btn custom-btn w-100 mt-3" type="submit" id="">{{ gp247_language_render('customer.password_reset') }}</button>
                            </div>
                        </div>
                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end tab content -->
                </div>
            </div>
        </div>
    </div>
</div>







@endsection

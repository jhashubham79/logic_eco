@php
/*
$layout_page = shop_auth
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
                            <h2 class="heading2">Forgot Password!</h2>
                            <p class="tagline2">Please enter your username or email address. You will receive a link to create a new password via email.</p>
                        </div>
                        <div class="form-fields text-start">
                            <div class="row justify-content-center">
                                <div class="col-md-5 col-lg-4">
                                    <form class="form-horizontal" method="POST" action="{{ gp247_route_front('customer.password_email') }}" id="gp247-form-process">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    
                        
                    <div class="col-md-12">
                        <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}"
                            required>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        <br />
                        @endif
                        {!! $viewCaptcha ?? ''!!}
                        <button class="btn custom-btn w-100 mt-3" type="submit" id="gp247-button-process">{{ gp247_language_render('action.submit') }}</button>
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
@extends($GP247TemplatePath.'.layout')

@section('block_main')

@php
    $activeTab = "login";
@endphp

<div class="signup py-5">
    <div class="container">
        <div class="signup-bg">
            <div class="signup-tabs text-center">
                <ul class="nav d-inline-flex rounded shadow p-2 nav-pills mb-3" id="signup-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                       <a href="{{ gp247_route_front('customer.register') }}"
                            class="nav-link">
                            Sign Up
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $activeTab === 'login' ? 'active' : '' }}" id="s2-tab"
                            data-bs-toggle="pill" data-bs-target="#s2" type="button" role="tab"
                            aria-controls="s2" aria-selected="{{ $activeTab === 'login' ? 'true' : 'false' }}">
                            Login
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="signup-tabContent">
                    {{-- Sign Up Tab --}}
                  
                    {{-- Login Tab --}}
                    <div class="tab-pane fade {{ $activeTab === 'login' ? 'show active' : '' }}" id="s2"
                        role="tabpanel" aria-labelledby="s2-tab" tabindex="0">
                        <div class="text-center mt-4">
                            <h2 class="heading2">Welcome back!</h2>
                            <p class="tagline2">Please enter your details.</p>
                        </div>
                        <div class="form-fields text-start">
                            <div class="row justify-content-center">
                                <div class="col-md-5 col-lg-4">
                                    <form action="{{ route('customer.postLogin') }}" method="POST" class="p-4">
                                        @csrf
                                        <input type="hidden" name="active_tab" value="login">

                                        {{-- Email --}}
                                        <div class="mb-3">
                                            
                                            <input type="email" name="email" placeholder="{{ gp247_language_render('customer.email') }}" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Password --}}
                                        <div class="mb-3">
                                           
                                            <input type="password" name="password" placeholder="{{ gp247_language_render('customer.password') }}" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Remember Me + Forgot --}}
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                                <label class="form-check-label fw-semibold" for="remember">Remember me</label>
                                            </div>
                                            <div>
                                                <a href="{{ route('customer.forgot') }}" class="text-dark text-decoration-none fw-semibold">Forgot Password?</a>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn custom-btn w-100">Login</button>
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
@extends($GP247TemplatePath.'.layout')

@section('block_main')


<!-- Register UI Wrapper -->
<div class="signup py-5">
    <div class="container">
        <div class="signup-bg">
            <!--<img src="{{ url('images/signup-bg.webp') }}" class="background-image" alt="Signup Background">-->

            <div class="signup-tabs text-center">
                <ul class="nav d-inline-flex rounded shadow p-2 nav-pills mb-3" id="signup-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="s1-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-s1" type="button" role="tab"
                            aria-controls="pills-s1" aria-selected="true">
                            Sign Up
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ gp247_route_front('customer.login') }}"
                            class="nav-link">
                            Login
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="signup-tabContent">
                    <div class="tab-pane fade show active" id="pills-s1" role="tabpanel" aria-labelledby="s1-tab">
                        <div class="text-center mt-4">
                            <h1 class="heading2">Create an account</h1>
                            <p class="tagline2">Sign up now and unlock your Solution</p>
                        </div>

                        <div class="form-fields text-start">
                            <div class="row justify-content-center">
                                <div class="col-md-5 col-lg-4">
                                    {{-- Begin S-Cart Form --}}
                                    <form action="{{gp247_route_front('customer.postRegister')}}" method="post" id="gp247-form-process" class="box">
                                        {!! csrf_field() !!}
                                     <div class="form_content" id="collapseExample">
                                        <div class="form_content">
                                            @if (gp247_config('customer_lastname'))
                                                <div class="mb-3">
                                                    <input type="text" name="first_name" placeholder="{{ gp247_language_render('customer.first_name') }}"
                                                        class="form-control form-control-lg {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                                        value="{{ old('first_name') }}">
                                                    @error('first_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" name="last_name" placeholder="{{ gp247_language_render('customer.last_name') }}"
                                                        class="form-control form-control-lg {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                                        value="{{ old('last_name') }}">
                                                    @error('last_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @else
                                                <div class="mb-3">
                                                    <input type="text" name="first_name" placeholder="{{ gp247_language_render('customer.name') }}"
                                                        class="form-control form-control-lg {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                                        value="{{ old('first_name') }}" >
                                                    @error('first_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif

                                            {{-- Optional KANA fields --}}
                                            @if (gp247_config('customer_name_kana'))
                                                <div class="mb-3">
                                                    <input type="text" name="first_name_kana" placeholder="{{ gp247_language_render('customer.first_name_kana') }}"
                                                        class="form-control form-control-lg {{ $errors->has('first_name_kana') ? 'is-invalid' : '' }}"
                                                        value="{{ old('first_name_kana') }}">
                                                    @error('first_name_kana')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" name="last_name_kana" placeholder="{{ gp247_language_render('customer.last_name_kana') }}"
                                                        class="form-control form-control-lg {{ $errors->has('last_name_kana') ? 'is-invalid' : '' }}"
                                                        value="{{ old('last_name_kana') }}">
                                                    @error('last_name_kana')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif

                                            {{-- Email, Phone --}}
                                            <div class="mb-3">
                                                <input type="email" name="email" placeholder="{{ gp247_language_render('customer.email') }}"
                                                    class="form-control form-control-lg {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @if (gp247_config('customer_phone'))
                                                <div class="mb-3">
                                                    <input type="text" name="phone" placeholder="{{ gp247_language_render('customer.phone') }}"
                                                        class="form-control form-control-lg {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                                        value="{{ old('phone') }}">
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif

                                            {{-- Password --}}
                                            <div class="mb-3">
                                                <input type="password" name="password" placeholder="{{ gp247_language_render('customer.password') }}"
                                                    class="is_required validate account_input  form-control form-control-lg {{ $errors->has('password') ? 'is-invalid' : '' }}" >
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <input type="password" name="password_confirmation" placeholder="{{ gp247_language_render('customer.password_confirm') }}"
                                                    class="is_required validate account_input form-control form-control-lg {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" >
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Optional fields --}}
                                            @if (gp247_config('customer_postcode'))
                                                <div class="mb-3">
                                                    <input type="text" name="postcode" placeholder="{{ gp247_language_render('customer.postcode') }}"
                                                        class="form-control form-control-lg {{ $errors->has('postcode') ? 'is-invalid' : '' }}"
                                                        value="{{ old('postcode') }}">
                                                    @error('postcode')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif

                                            @if (gp247_config('customer_address1'))
                                                <div class="mb-3">
                                                    <input type="text" name="address1" placeholder="{{ gp247_language_render('customer.address1') }}"
                                                        class="form-control form-control-lg {{ $errors->has('address1') ? 'is-invalid' : '' }}"
                                                        value="{{ old('address1') }}">
                                                    @error('address1')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif

                                            {{-- Additional address, company, country, etc --}}
                                            {{-- ...reuse your same logic here if enabled via config --}}

                                            {{-- Custom Fields --}}
                                            @php
                                                gp247_check_view($GP247TemplatePath.'.common.render_form_custom_field');
                                            @endphp
                                            @include($GP247TemplatePath.'.common.render_form_custom_field', ['object' => $customer])

                                            {{-- Captcha --}}
                                            {!! $viewCaptcha ?? ''!!}

                                            {{-- Terms & Submit --}}
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="terms" required>
                                                <label class="form-check-label fw-semibold" for="terms">
                                                    I agree to the <a href="#" class="text-primary text-decoration-none">terms of service</a>
                                                </label>
                                            </div>

                                            <button type="submit" class="btn custom-btn w-100" id="gp247-button-process">
                                                {{ gp247_language_render('customer.signup') }}
                                            </button>
                                        </div>
										 </div>
                                    </form>
                                    {{-- End S-Cart Form --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Tab --}}
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('gp247-form-process');

    form.addEventListener('submit', function (e) {
        let valid = true;

        // Clear all previous errors
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback.js-error').forEach(el => el.remove());

        // Fields to validate
        const requiredFields = [
            'first_name',
            'email',
            'password',
            'password_confirmation'
        ];

        // Validate required fields
        requiredFields.forEach(name => {
            const input = form.querySelector(`[name="${name}"]`);
            if (input && input.value.trim() === '') {
                valid = false;
                showError(input, 'This field is required.');
            }
        });

        // Password match validation
        const password = form.querySelector('[name="password"]');
        const confirmPassword = form.querySelector('[name="password_confirmation"]');

        if (password && confirmPassword && password.value !== confirmPassword.value) {
            valid = false;
            showError(confirmPassword, 'Passwords do not match.');
        }

        if (!valid) {
            e.preventDefault(); // Prevent form submission
        }
    });

    function showError(input, message) {
        input.classList.add('is-invalid');

        const error = document.createElement('div');
        error.className = 'invalid-feedback js-error';
        error.textContent = message;

        // Append error after input
        input.parentNode.appendChild(error);
    }
});
</script>



@endsection
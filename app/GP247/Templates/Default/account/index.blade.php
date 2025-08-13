@php
/*
$layout_page = shop_profile
** Variables:**
- $customer
*/ 
@endphp

@php
    $view = gp247_shop_process_view($GP247TemplatePath, 'account.layout');
@endphp
@extends($view)

@section('block_main_profile')

<div class="col-lg-9">
                    <div class="dashboard-r h-100">
                        <div class="profile-details my-3">
                            <p>Welcome <span>  {{ $customer['first_name'] }} {{ $customer['last_name'] }} </span>!</p>
                        </div>
                    </div>
                </div>
    
@endsection
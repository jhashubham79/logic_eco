@extends($GP247TemplatePath.'.layout')

@section('block_main')

<section class="dashboard py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="dashboard-l">
                        <div class="dashboard-profile">
                            <img src="{{url('images/Profile.webp')}}" class="rounded-circle mb-3" width="50"
                                alt="User">
                            <h5 class="dashboard-username">{{ customer()->user()->name}}</h5>
                        </div>
                        @php
    $currentRoute = Route::currentRouteName();
@endphp

<div class="list-group text-start">
    <a href="#" class="list-group-item list-group-item-action">
        <span><img src="{{ url('images/active-services.png') }}" width="24" alt="icon"> Active Services</span>
    </a>

    <a href="{{ gp247_route_front('customer.change_infomation') }}"
       class="list-group-item list-group-item-action {{ $currentRoute == 'customer.change_infomation' ? 'active' : '' }}">
        <span><img src="{{ url('images/profile-icon.png') }}" width="24" alt="icon"> Profile</span>
    </a>

    <a href="{{ gp247_route_front('customer.change_password') }}"
       class="list-group-item list-group-item-action {{ $currentRoute == 'customer.change_password' ? 'active' : '' }}">
        <span><img src="{{ url('images/security-icon.png') }}" width="24" alt="icon"> Security</span>
    </a>

    <a href="{{ gp247_route_front('customer.order_list') }}"
       class="list-group-item list-group-item-action {{ $currentRoute == 'customer.order_list' ? 'active' : '' }}">
        <span><img src="{{ url('images/orders-icon.png') }}" width="24" alt="icon"> Orders</span>
        <img src="{{ url('images/right-icon.svg') }}" width="24" alt="icon">
    </a>
</div>

                    </div>
                </div>
           
           @section('block_main_profile')
            @show
               

            </div>
        </div>
    </section>




@endsection



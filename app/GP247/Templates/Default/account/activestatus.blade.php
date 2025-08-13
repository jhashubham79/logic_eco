@php
/*
$layout_page = shop_profile
** Variables:**
- $addresses
*/ 
@endphp

@php
    $view = gp247_shop_process_view($GP247TemplatePath, 'account.layout');
@endphp
@extends($view)

@section('block_main_profile')



<div class="col-lg-9">
                    <div class="dashboard-r">
                        <h2 class="dashboard-r-heading">2 Active Services</h2>
                        <div class="row g-4">
                            
                            @foreach($orders as $order)
                            <!-- Card 1 -->
                            <div class="col-md-4">
                                <div class="dashboard-card">
                                    <span class="dashboard-badge badge active-badge">Active</span>
                                    <div class="dashboard-card-icon">
                                        <img src="images/point-icon.webp" alt="icon">
                                    </div>
                                     @foreach($order->details as $item)
                    <h6 class="dashboard-subheading">{{ $item->name }}</h6>
                  @endforeach
                                   
                                    <ul class="dashboard-list">
                                        <li>Same-Day Tag Debugging</li>
                                        <li>Better Marketing ROI</li>
                                        <li>Accurate Conversion Tracking</li>
                                        <li>More....</li>
                                    </ul>
                                    <a href="#" class="btn btn-outline-custom w-100 mt-3">See Details</a>
                                </div>
                            </div>
                               @endforeach
                            <!-- Card 2 (Pending) -->
                            <!--<div class="col-md-4">-->
                            <!--    <div class="dashboard-card">-->
                            <!--        <span class="dashboard-badge badge pending-badge">Pending</span>-->
                            <!--        <div class="dashboard-card-icon">-->
                            <!--            <img src="images/point-icon.webp" alt="icon">-->
                            <!--        </div>-->
                            <!--        <h6 class="dashboard-subheading">Google Tag Manager Fix</h6>-->
                            <!--        <ul class="dashboard-list">-->
                            <!--            <li>Same-Day Tag Debugging</li>-->
                            <!--            <li>Better Marketing ROI</li>-->
                            <!--            <li>Accurate Conversion Tracking</li>-->
                            <!--            <li>More....</li>-->
                            <!--        </ul>-->
                            <!--        <a href="#" class="btn btn-outline-custom w-100 mt-3">See Details</a>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <!-- Card 3 -->
                            
                        </div>
                    </div>
                </div>
    
    @endsection
@php
/*
$layout_page = shop_profile
** Variables:**
- $statusOrder
- $orders
*/ 
@endphp

@php
    $view = gp247_shop_process_view($GP247TemplatePath, 'account.layout');
@endphp
@extends($view)





@section('block_main_profile')
<div class="col-lg-9">
  <div class="dashboard-r">
    <div class="d-md-flex justify-content-between align-items-center mb-2">
      <h2 class="dashboard-r-heading">{{ $title }}</h2>
      <!--<div class="d-flex flex-wrap gap-2 mb-3">-->
      <!--  <input type="text" class="form-control custom-filter" placeholder="🔍 Search">-->
      <!--  <select class="form-select custom-filter">-->
      <!--    <option>Category</option>-->
      <!--  </select>-->
      <!--  <select class="form-select custom-filter">-->
      <!--    <option>Status</option>-->
      <!--  </select>-->
      <!--  <select class="form-select custom-filter">-->
      <!--    <option>Date Range</option>-->
      <!--  </select>-->
      <!--</div>-->
    </div>

    @if (count($orders) == 0)
      <div class="text-danger">
        {{ gp247_language_render('front.no_item') }}
      </div>
    @else
      <div class="table-responsive orders-table">
        <table class="table align-middle">
          <thead class="table-light">
            <tr>
              <th>Order ID</th>
              <th>Product</th>
              <th>Date</th>
              <th>Status</th>
              <th>Invoice</th>
              <th>Rating</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
              <tr>
                <td>#{{ $order->id }}</td>

                {{-- Product Names --}}
                <td>
                  @foreach($order->details as $item)
                    <div> &bull; {{ $item->name }}</div>
                  @endforeach
                </td>

                {{-- Date --}}
                <td>{{ $order->created_at->format('d-m-Y') }}</td>

                {{-- Status --}}
                <td>{{ $statusOrder[$order->status] ?? 'Unknown' }}</td>

                {{-- Invoice Link --}}
                <td>
                  <a href="{{ url('customer/invoice/' . $order->id) }}" target="_blank">
                      View
                    
                  </a>
                </td>

                {{-- Rating (optional placeholder) --}}
                <td class="rating">
                  <span class="star">&#9733;</span>
                  <span class="star">&#9733;</span>
                  <span class="star">&#9733;</span>
                  <span class="star">&#9733;</span>
                  <span class="star">&#9733;</span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</div>
@endsection


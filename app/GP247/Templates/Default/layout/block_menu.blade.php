     <nav class="navbar navbar-expand-lg navbar-custom bg-white shadow-sm">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand" href="{{url('/')}}">
      <img src="{{ gp247_file(gp247_store_info('logo', ($storeId ?? null))) }}" alt="Logo" class=" logo-img img-fluid">
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler border-0  shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Items + Button -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav align-items-center ">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('product')}}">Shop</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Categories</a>
          <ul class="dropdown-menu">
            @php
$categories = DB::table('gp247_shop_category_description')
    ->join('gp247_shop_category', 'gp247_shop_category.id', '=', 'gp247_shop_category_description.category_id')
    ->where('gp247_shop_category.status', 1)
    ->select('gp247_shop_category_description.*','gp247_shop_category.alias') // or add fields you need from both tables
    ->get();

            @endphp
 @foreach($categories as $category)
            <li><a class="dropdown-item" href="{{url('category/' . $category->alias)}}">{{$category->title}}</a></li>
           @endforeach
          </ul>
        </li>
      </ul>

      <!-- Get Sample Button -->
     <div class="btn-nav">

    <ul class="navbar-nav d-flex flex-row align-items-center gap-3">
        {{-- Account Dropdown --}}
        @if(function_exists('gp247_cart') && gp247_config('link_account', null, 1))

            @if(function_exists('customer') && !customer()->user())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="guestDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-lock"></i> {{ gp247_language_render('front.account') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ gp247_route_front('customer.login') }}">
                                <i class="fa fa-user"></i> {{ gp247_language_render('front.login') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-lock"></i> {{ gp247_language_render('customer.my_profile') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ gp247_route_front('customer.index') }}">
                                <i class="fa fa-user"></i> {{ gp247_language_render('customer.my_profile') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ gp247_route_front('customer.logout') }}" rel="nofollow"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> {{ gp247_language_render('front.logout') }}
                            </a>
                            <form id="logout-form" action="{{ gp247_route_front('customer.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        @endif

        {{-- Cart Button (Desktop) --}}
        @if (gp247_config('link_cart', null, 1) && function_exists('gp247_cart'))
            <li class="nav-item d-none d-lg-block">
                <a href="{{ gp247_route_front('cart') }}" class="btn btn-outline-secondary position-relative">
                    <i class="bi bi-cart3"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="shopping-cart">
                        {{ gp247_cart()->instance('default')->count() }}
                    </span>
                </a>
            </li>

            {{-- Cart Button (Mobile) --}}
            <li class="nav-item d-lg-none w-100 mt-2">
                <a href="{{ gp247_route_front('cart') }}" class="btn btn-outline-secondary position-relative w-100 text-start">
                    <i class="bi bi-cart3 me-2"></i> 
                    {{ gp247_language_render('cart.page_title') }}
                    <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger">
                        {{ gp247_cart()->instance('default')->count() }}
                    </span>
                </a>
            </li>
        @endif
    </ul>
    
    
    

</div>

 <!-- RD Navbar Search-->
                 

    </div>
  </div>
</nav>
     
     
     
      

      
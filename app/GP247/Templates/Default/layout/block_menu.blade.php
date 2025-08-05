     <nav class="navbar navbar-expand-lg navbar-custom bg-white">
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

     <ul class="navbar-nav align-items-center">
        {{-- Account Dropdown --}}
        @if(function_exists('gp247_cart') && gp247_config('link_account', null, 1))

            @if(function_exists('customer') && !customer()->user())
            
            
        <!--<ul class="navbar-nav align-items-center">-->
          <li class="nav-item">
            <a class="nav-link" href="{{ gp247_route_front('customer.login') }}"><img src="{{url('images/Profile.webp')}}" width="41" height="41" alt="profile">
              Login/SignUp</a>
          </li>
        <!--</ul>-->


       
            
            
            
            
                <!--<li class="nav-item dropdown">-->
                <!--    <a class="nav-link dropdown-toggle" href="#" id="guestDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
                <!--        <i class="fa fa-lock"></i> {{ gp247_language_render('front.account') }}-->
                <!--    </a>-->
                <!--    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">-->
                <!--        <li>-->
                <!--            <a class="dropdown-item" href="{{ gp247_route_front('customer.login') }}">-->
                <!--                <i class="fa fa-user"></i> {{ gp247_language_render('front.login') }}-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->
            @else
            
            
        <ul class="navbar-nav align-items-center">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false"><img src="{{url('images/Profile.webp')}}" width="41" height="41" alt="profile">{{ customer()->user()->name}}</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Active Services</a></li>
                  <li><a class="dropdown-item" href="{{ gp247_route_front('customer.index') }}">Profile</a></li>
                  <li><a class="dropdown-item" href="#">Security</a></li>
                  <li><a class="dropdown-item" href="{{ gp247_route_front('customer.order_list') }}">Order History</a></li>
                  <li><a class="dropdown-item" href="{{ gp247_route_front('customer.logout') }}" rel="nofollow"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>
                </ul>
                 <form id="logout-form" action="{{ gp247_route_front('customer.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
          </li>
       </ul> 

            
            
            
                <!--<li class="nav-item dropdown">-->
                <!--    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
                <!--        <i class="fa fa-lock"></i> {{ gp247_language_render('customer.my_profile') }}-->
                <!--    </a>-->
                <!--    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">-->
                <!--        <li>-->
                <!--            <a class="dropdown-item" href="{{ gp247_route_front('customer.index') }}">-->
                <!--                <i class="fa fa-user"></i> {{ gp247_language_render('customer.my_profile') }}-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li>-->
                <!--            <a class="dropdown-item" href="{{ gp247_route_front('customer.logout') }}" rel="nofollow"-->
                <!--               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">-->
                <!--                <i class="fa fa-power-off"></i> {{ gp247_language_render('front.logout') }}-->
                <!--            </a>-->
                           
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->
            @endif
        @endif

        {{-- Cart Button (Desktop) --}}
        @if (gp247_config('link_cart', null, 1) && function_exists('gp247_cart'))
            <li class="nav-item d-none d-lg-block">
                <a href="{{ gp247_route_front('cart') }}" class="btn btn-white position-relative">
                    <svg fill="#000000" version="1.1" width="25" height="25" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 902.86 902.86" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"></path> <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717 c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744 c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742 C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744 c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742 S619.162,694.432,619.162,716.897z"></path> </g> </g> </g></svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge text-danger" id="shopping-cart">
                        {{ gp247_cart()->instance('default')->count() }}
                    </span>
                </a>
            </li>

            {{-- Cart Button (Mobile) --}}
            <li class="nav-item d-lg-none">
                <a href="{{ gp247_route_front('cart') }}" class="btn btn-white position-relative">
                    <svg fill="#000000" version="1.1" width="25" height="25" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 902.86 902.86" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"></path> <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717 c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744 c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742 C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744 c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742 S619.162,694.432,619.162,716.897z"></path> </g> </g> </g></svg>
                    {{ gp247_language_render('cart.page_title') }}
                    <span class="position-absolute top-0 end-0 translate-middle badge text-danger">
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
     
     
     
      

      
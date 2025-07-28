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
     <div class="btn-nav "> 
         <a href="#">Get Sample</a>
     </div>
    </div>
  </div>
</nav>
     
     
     
      

      
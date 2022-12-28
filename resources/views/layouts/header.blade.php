@php
$setting = App\Models\Admin\Setting::first();
$websites = App\Models\Admin\Website::where('status',1)->limit(10)->get();
$categories = App\Models\Admin\Category::where('status',1)->limit(10)->get();
@endphp




       <!-- Pre Loader -->
  {{--       <div class="preloader">
            <div class="d-table">
                <div class="d-table-cell">
                    <img @if($setting) src="{{ asset('storage/app/public/'.$setting->logo) }}" @endif alt="Images">
                    <h2>@if($setting) {{ $setting->title }} @endif</h2>
                </div>
            </div>
        </div> --}}
        <!-- End Pre Loader -->

        <!-- Top Header Start -->
        @guest
        @else
        @if(Auth::user()->is_admin == 1)
        <header class="top-header top-header-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4">
         
                    </div>

                    <div class="col-lg-9 col-md-8">
                        <div class="top-header-right">
                        {{--     <div class="top-header-right-item">
                                <div class="language-list">
                                    <select class="language-list-item">
                                        <option>English</option>
                                        <option>العربيّة</option>
                                        <option>Deutsch</option>
                                        <option>Português</option>
                                        <option>简体中文</option>
                                    </select> 
                                </div>
                            </div> --}}
                            
                            <div class="top-header-right-item">
                                <ul class="top-header-list">
                                    @guest
                                    <li><a href="{{ route('login') }}" >Login </a></li>
                                    <li><a href="{{ route('register') }}" >Register </a></li>
            
                                    @else
                                    <li class="dropdown">
                                      <a class=" dropdown-toggle" data-bs-toggle="dropdown">
                                        {{ Auth::user()->first_name }}
                                      </a>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-dark" href="{{ route('user.profile',Auth::id())  }}">Profile</a></li>
                                       
                                    @if(Auth::user()->is_admin == 1)
                                        <li><a class="dropdown-item text-dark" href="{{ route('dashboard') }}">Dashboard</a></li>

                                        @endif
                                        <li><a class="dropdown-item text-dark" href="{{ route('logout') }}">Logout</a></li>
                                      </ul>
                                    </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Top Header End -->
        @endif
        @endguest

        <!-- Start Navbar Area -->
        <div class="navbar-area">
            <!-- Menu For Mobile Device -->
            <div class="mobile-nav">
                <a href="{{ route('/') }}" class="logo">
                    <img @if($setting) src="{{ asset('storage/app/public/'.$setting->logo) }}" @else src="" @endif  height="50px" alt="Logo">
                </a>
            </div>

            <!-- Menu For Desktop Device -->
            <div class="main-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light ">
                        <a class="navbar-brand" href="{{ route('/') }}">
                            <img @if($setting) src="{{ asset('storage/app/public/'.$setting->logo) }}" @else src="" @endif height="50px"  alt="Logo">
                        </a>

                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a href="{{ route('/') }}" class="nav-link active">
                                        Home 
                                    </a>
                                </li> 
                                <li class="nav-item">

                                    <a href="#" class="nav-link">
                                         Categories 
                                        <i class='bx bx-chevron-down'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($categories as $category)
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                {{ $category->name }}
                                                @if(count($category->subcate) > 0)
                                                <i class='bx bx-chevron-down'></i>
                                                @endif
                                            </a>
                                            @if(count($category->subcate) > 0)
                                            <ul class="dropdown-menu">
                                                @foreach($category->subcate as $subcate)
                                                <li class="nav-item">
                                                    <a href="#0" class="nav-link">
                                                        {{ $subcate->name }}
                                                    </a>
                                                </li> 
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach

                                    </ul>
                                </li>


                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Market
                                        <i class='bx bx-chevron-down'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($websites as $website)
                                        <li class="nav-item">
                                            <a href="#0" class="nav-link">
                                                {{ $website->name }} 
                                            </a>
                                        </li>
                                        @endforeach

                                    </ul>
                                </li> 

                                <li class="nav-item">
                                    <a href="#0" class="nav-link">
                                        Reviews
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#0" class="nav-link">
                                        Products
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}" class="nav-link">
                                        Contact
                                    </a>
                                </li>
                            </ul>

                       {{--      <div class="nav-right-side">
                                <ul class="nav-right-list">
                                    <li><a href="#"><i class='bx bx-repost'></i></a></li>
                                    <li><a href="#"><i class='bx bx-heart'></i></a></li>
                                    <li class="cart-span">
                                        <a href="#"><i class='bx bx-cart'></i></a>
                                        <span>1</span>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                    </nav>
                </div>
            </div>

            <div class="side-nav-responsive">
                <div class="container">
               {{--      <div class="dot-menu">
                        <div class="circle-inner">
                            <div class="circle circle-one"></div>
                            <div class="circle circle-two"></div>
                            <div class="circle circle-three"></div>
                        </div>
                    </div> --}}
                    
                    <div class="container">
                        <div class="side-nav-inner">
                            <div class="side-nav justify-content-center align-items-center">
                                <div class="side-nav-item">
                                    <ul class="nav-right-list">
                                        <li><a href="#"><i class='bx bx-repost'></i></a></li>
                                        <li><a href="#"><i class='bx bx-heart'></i></a></li>
                                        <li class="cart-span">
                                            <a href="#"><i class='bx bx-cart'></i></a>
                                            <span>1</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Navbar Area -->
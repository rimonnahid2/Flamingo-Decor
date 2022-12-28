@php
$setting = App\Models\Admin\Setting::first();
@endphp
@extends('layouts.app')
@section('content')

        <!-- Banner Area -->
        <div class="banner-area mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="banner-item-content">
                            <span>WELCOME TO OUR SHOP</span>
                            <h1>{{ $top_1->title }}</h1>
                            <p>{!!  Str::words($top_1->summary,'10','..') !!}</p>
                            <a href="{{ route('single.product',$top_1->slug) }}" class="default-btn btn-bg-one">Order Now</a>
                            <img src="{{ asset('storage/app/public/'.$top_1->image) }}"   alt="{{ $top_1->title }}">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">
                        	@foreach($offers as $product)
                            <div class="col-lg-12 col-md-6">
                                <div class="banner-item-side">
                                    <h3>{{    Str::words($product->title,'5','') }}</h3>
                                    <span>Get a {{ $product->discount }}% Offer!</span>
                                    <a href="{{ route('single.product',$product->slug) }}" class="newslette-btn">Newsletter</a>
                                    <img src="{{ asset('storage/app/public/'.$product->image) }}" class="mt-1" style=" height: 177px;" width="150px"  alt="{{ $product->title }}">
                                </div>
                            </div>
                            @endforeach
                        {{--     <div class="col-lg-12 col-md-6">
                                <div class="banner-item-side">
                                    <h3>Sign Up on Shop</h3>
                                    <span>Get a 30% Offer!</span>
                                    <a href="#" class="newslette-btn">Newsletter</a>
                                    <img src="public/frontend/assets/images/home-one/home-one-img2.png" style="width: 230px; height: 177px;"  alt="{{ $product->title }}">
                                </div>
                            </div> --}}

                         {{--    <div class="col-lg-12 col-md-6">
                                <div class="banner-item-side-2">
                                    <h3>Big Sale Offer</h3>
                                    <span>Up to 70% Discount</span>
                                    <a href="shop-grid.html" class="shop-btn">Shop Now</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Area End -->

        <!-- New Arrival Area -->
        <section class="new-arrival-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>New Arrivals</h2>
                </div>

                <div class="row pt-45">
                	@foreach($products as $product)
                    <div class="col-lg-3 col-sm-6">
                        <div class="new-arrival-item">
                            <div class="arrival-img">
                                <a href="{{ route('single.product',$product->slug) }}">
                                    <img src="{{ asset('storage/app/public/'.$product->image) }}" height="350px"  alt="{{ $product->title }}">
                                </a>
                                <div class="arrival-item-tag">
                                    <h3>New</h3>
                                </div>
                                <ul class="arrival-item-action">
                                    <li><a href="#"><i class='bx bx-repost'></i></a></li>
                                    <li><a href="#0"><i class='bx bx-heart'></i></a></li>
                                    <li><a href="#0"><i class='bx bx-cart'></i></a></li>
                                </ul>
                            </div>

                            <div class="content">
                                <h3><a href="{{ route('single.product',$product->slug) }}">{{ Str::words($product->title,'8','') }}</a></h3>
                                <span>$ {{ number_format((float)$product->price - $product->discount / $product->price * 100, 2,) }} <del>${{ $product->price }}</del></span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                   {{--  <div class="col-lg-3 col-sm-6">
                        <div class="new-arrival-item">
                            <div class="arrival-img">
                                <a href="shop-details.html">
                                    <img src="public/frontend/assets/images/new-arrival-img/new-arrival-2.png"  alt="{{ $product->title }}">
                                </a>
                                <div class="arrival-item-tag">
                                    <h3>New</h3>
                                </div>
                                <ul class="arrival-item-action">
                                    <li><a href="#"><i class='bx bx-repost'></i></a></li>
                                    <li><a href="#0"><i class='bx bx-heart'></i></a></li>
                                    <li><a href="#0"><i class='bx bx-cart'></i></a></li>
                                </ul>
                            </div>

                            <div class="content">
                                <h3><a href="shop-details.html">Rear Organic Saffron</a></h3>
                                <span>$4000.0/Kg</span>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </section>
        <!-- New Arrival Area End -->

        <!-- Choose Area -->
        <div class="choose-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Why You Choose Us</h2>
                </div>
                <div class="row pt-45">
                    <div class="col-lg-4 col-sm-6">
                        <div class="choose-card">
                            <i class="flaticon-24-hours"></i>
                            <h3>24/7 Online Support</h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="choose-card">
                            <i class="flaticon-leaf"></i>
                            <h3>100% Pure Foods</h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 offset-lg-0 offset-sm-3">
                        <div class="choose-card">
                            <i class="flaticon-service"></i>
                            <h3>Home Delivery</h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Choose Area End -->

        <!-- Trending Area -->
        <div class="trending-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Trending Products</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget arcu luctus orci vulputate eleifend ut et odio. Proin purus mi, convallis sit amet pretium a, rhoncus aliquam purus. 
                    </p>
                </div>

                <div class="row pt-45">
                    <div class="col-lg-9">
                        <div class="row">
                        	@foreach($trend as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="trending-item">
                                    <div class="trending-img">
                                        <a href="{{ route('single.product',$product->slug) }}">
                                            <img src="{{ asset('storage/app/public/'.$product->image) }}"  alt="{{ $product->title }}" height="350px">
                                        </a>
                                        <div class="trending-item-tag">
                                            <h3>New</h3>
                                        </div>
                                        <ul class="trending-item-action">
                                            <li><a href="#"><i class='bx bx-repost'></i></a></li>
                                            <li><a href="#0"><i class='bx bx-heart'></i></a></li>
                                            <li><a href="#0"><i class='bx bx-cart'></i></a></li>
                                        </ul>
                                    </div>
        
                                    <div class="content">
                                        <h3><a href="{{ route('single.product',$product->slug) }}">{{ Str::words($product->title,'8','') }}</a></h3>
                                        <div class="rating">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>
                                        <span>{{ number_format((float)$product->price - $product->discount / $product->price * 100, 2,) }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                           {{--  <div class="col-lg-4 col-sm-6">
                                <div class="trending-item">
                                    <div class="trending-img">
                                        <a href="shop-details.html">
                                            <img src="public/frontend/assets/images/trending-img/trending-img2.png"  alt="{{ $product->title }}">
                                        </a>
                                        <div class="trending-item-tag">
                                            <h3>-22%</h3>
                                        </div>
                                        <ul class="trending-item-action">
                                            <li><a href="#"><i class='bx bx-repost'></i></a></li>
                                            <li><a href="#0"><i class='bx bx-heart'></i></a></li>
                                            <li><a href="#0"><i class='bx bx-cart'></i></a></li>
                                        </ul>
                                    </div>
        
                                    <div class="content">
                                        <h3><a href="shop-details.html">Fresh Carrots</a></h3>
                                        <div class="rating">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>
                                        <span>$5.0/Kg <del>$6.0/Kg</del></span>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="row">
                            @foreach($hot_deal as $product)
                            <div class="col-lg-12 col-md-6">
                                <div class="trending-side-item d-flex justify-content-center flex-column">
                                    <h3>{{ Str::words($product->title,'4','') }}</h3>
                                    <p>{!! Str::words($product->description,'10','') !!}.</p>
                                    <a href="{{ $product->link }}" class="shop-btn">Shop It Now</a>
                                    <img src="{{ asset('storage/app/public/'.$product->image) }}" height="250px" alt="Images">
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Trending Area End -->

        <!-- Brand Area -->
        <div class="brand-area pb-100">
            <div class="container">
                <div class="brand-slider owl-carousel owl-theme">
                    @foreach($websites as $website)
                    <div class="brand-item">
                        <img src="{{ asset('storage/app/public/'.$website->image) }}" height="70px" alt="Images">
                    </div>
                    @endforeach
        
                </div>
            </div>
        </div>
        <!-- Brand Area End -->

        <!-- Testimonials Area -->
        <div class="testimonials-area ptb-100">
            <div class="container">
                <div class="testimonials-slider owl-carousel owl-theme">
                    <div class="testimonials-item">
                        <img src="public/frontend/assets/images/testimonials/testimonials-img1.jpg" alt="Images">
                        <p>
                            "We are one of the best  and huge problem on the product taking from online. Most of the time we 
                            get the eCommerce  and ordered product on this and on that time we saw that it gives the best 
                            service for all the time." 
                        </p>
                        <i class='bx bxs-quote-alt-left'></i>
                        <h3>- Elen Musk, CEO, MT Corporation</h3>
                    </div>

                    <div class="testimonials-item">
                        <img src="public/frontend/assets/images/testimonials/testimonials-img2.jpg" alt="Images">
                        <p>
                            "We are one of the best  and huge problem on the product taking from online. Most of the time we 
                            get the eCommerce  and ordered product on this and on that time we saw that it gives the best 
                            service for all the time." 
                        </p>
                        <i class='bx bxs-quote-alt-left'></i>
                        <h3>- Tom Shumate, Founder, MT Corporation</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonials Area End -->

        <!-- Offer Area End -->
        <div class="offer-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Our Daily Offer</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget arcu luctus orci vulputate eleifend ut et odio. Proin purus mi, convallis sit amet pretium a, rhoncus aliquam purus. 
                    </p>
                </div>

                <div class="row pt-45">
                	@foreach($today_offer as $product)

                    <div class="col-lg-6" >
                        <div class="offer-top-item offer-bg1" style="height:400px">
                            <span>{{ Str::words($product->title,'5','') }}</span>
                            <h3>Buy {{ $product->discount }}% Fresh Apple</h3>
                            <p>Get this products now</p>
                            <a href="{{ $product->link }}" class="shop-btn">Shop Now</a>
                            <img src="{{ asset('storage/app/public/'.$product->image) }}" height="300px" alt="Images">
                        </div>
                    </div>
                    @endforeach

               
           {{--          <div class="col-lg-6">
                        <div class="offer-top-item offer-bg2">
                            <span>Discount Offer</span>
                            <h3>Offer Start at $30 Buy!</h3>
                            <p>Come to us immediately.</p>
                            <a href="#" class="shop-btn">Shop It Now</a>
                            <img src="public/frontend/assets/images/offer-img/offer-img6.png" alt="Images">
                        </div>
                    </div> --}}
                    @foreach($daily_offer as $product)
                    <div class="col-lg-3 col-sm-6">
                        <div class="offer-item">
                            <div class="offer-img">
                                <a href="{{ route('single.product',$product->slug) }}">
                                    <img src="{{ asset('storage/app/public/'.$product->image) }}" height="350px"  alt="{{ $product->title }}">
                                </a>
                                <div class="offer-item-tag">
                                    <h3>-{{ $product->discount }}%</h3>
                                </div>
                                <ul class="offer-item-action">
                                    <li><a href="#"><i class='bx bx-repost'></i></a></li>
                                    <li><a href="#0"><i class='bx bx-heart'></i></a></li>
                                    <li><a href="#0"><i class='bx bx-cart'></i></a></li>
                                </ul>
                            </div>
    
                            <div class="content">
                                <h3><a href="{{ route('single.product',$product->slug) }}">{{ Str::words($product->title,'3','') }}</a></h3>
                                <span>${{ number_format((float)$product->price - $product->discount / $product->price * 100, 2,) }} <del>${{ $product->price }}</del></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Offer Area End -->

        <!-- Blog Area -->
        <section class="blog-area pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Our Latest Blogs</h2>
                    <p class="margin-auto">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget arcu luctus orci vulputate eleifend ut et odio. Proin purus mi, convallis sit amet pretium a, rhoncus aliquam purus. 
                    </p>
                </div>

                <div class="row pt-45">
                    @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-card">
                            <a href="{{ route('single.blog',$blog->slug) }}">
                                <img src="{{ asset('storage/app/public/'.$blog->image) }}" height="300pc"  alt="{{ $blog->title }}">
                            </a>
                            <div class="content">
                                <span><i class='bx bx-time-five'></i> {{ $blog->created_at->format('F d, Y') }}</span>
                                <h3><a href="{{ route('single.blog',$blog->slug) }}">{{ Str::words($blog->title,'10','') }} </a></h3>
                                <p>
                                    {!!Str::words($blog->description,'15','') !!}
                                </p>
                                <a href="{{ route('single.blog',$blog->slug) }}" class="read-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- Blog Area End -->

        <!-- Newsletter Area Section -->
        <div class="newsletter-area-section pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Keep in Touch With Newsletter</h2>
                    <p class="margin-auto">
                        Get 35% Discount on Subscribe
                    </p>
                </div>

                <div class="newsletter-area pt-45">
                    <form class="newsletter-form" data-toggle="validator" method="POST">
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL" required autocomplete="off">
                        <button class="subscribe-btn" type="submit">
                            Subscribe
                        </button>
                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Newsletter Area Section End -->
@endsection
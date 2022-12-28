@php
$setting = App\Models\Admin\Setting::first();
@endphp
@extends('layouts.app')
@section('content')

<!-- Product Details Area -->
<div class="product-details-area pt-100 pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="product-detls-image">
                    <img src="{{ asset('storage/app/public/'.$product->image) }}" width="100%" alt="Image">
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="product-desc">
                    <h3>{{ $product->title }}</h3>
                    <div class="price">
                        <span class="new-price">${{ $product->price - $product->discount }}</span>
                        <span class="old-price">${{ $product->discount }}</span>
                    </div>

                    <div class="product-review">
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star-half'></i>
                        </div>
                        <a href="#" class="rating-count">3 reviews</a>
                    </div>
                    <p>
                        {!! $product->summary !!}
                    </p>

                    <div class="input-count-area">
                        <h3>Quantity</h3>
                        <div class="input-counter">
                            <span class="minus-btn"><i class='bx bx-minus'></i></span>
                            <input type="text" value="1">
                            <span class="plus-btn"><i class='bx bx-plus'></i></span>
                        </div>
                    </div>
        
                    <div class="product-add-btn">
                        <a href="{{ $product->link }}" class="default-btn btn-bg-three">
                            <i class="fas fa-cart-plus"></i> Buy Now!
                        </a>
                        <a href="#0" class="default-btn btn-bg-three">
                            <i class="fas fa-cart-plus"></i> Add To Cart
                        </a>
                    </div>

                    <div class="product-share">
                        <ul>
                            <li>
                                <span>Share:</span>
                            </li>
                            <li>
                                <a href="{{ $product->fb() }}" target="popup"
                                            onclick="window.open('{{ $product->fb() }}','popup','width=600,height=600'); return false;" rel="nofollow">
                                    <i class='bx bxl-facebook' ></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $product->linkedin() }}"  target="popup"
                                            onclick="window.open('{{ $product->fb() }}','popup','width=600,height=600'); return false;" rel="nofollow">
                                    <i class='bx bxl-linkedin'></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $product->twitter() }}"  target="popup"
                                            onclick="window.open('{{ $product->fb() }}','popup','width=600,height=600'); return false;" rel="nofollow">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $product->pin() }}"  target="popup"
                                            onclick="window.open('{{ $product->fb() }}','popup','width=600,height=600'); return false;" rel="nofollow">
                                    <i class='bx bxl-pinterest'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Details Area End -->

<!-- Product Tab -->
<div class="product-tab pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="tab products-details-tab">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <ul class="tabs">
                                <li>
                                    <a href="#">
                                        Description
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Reviews
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Shipping Information
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="tab_content current active pt-45">
                                <div class="tabs_item current">
                                    <div class="products-tabs-decs">
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                </div>

                                <div class="tabs_item">
                                    <div class="products-tabs-reviews">
                                        <ul>
                                            <li>
                                                <img src="assets/images/products/product-profile1.jpg" alt="Image">
                                                <h3>Devit M. kolin</h3>
                                                <div class="content">
                                                    <div class="rating">
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star-half'></i>
                                                    </div>
                                                    <span>19 Jan 2020</span>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
                                            </li>

                                            <li>
                                                <img src="assets/images/products/product-profile2.jpg" alt="Image">
                                                <h3>Donam. Markin</h3>
                                                <div class="content">
                                                    <div class="rating">
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star-half'></i>
                                                    </div>
                                                    <span>14 April 2020</span>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
                                            </li>
                                        </ul>

                                        <div class="reviews-form">
                                            <div class="contact-form">
                                                <h3>Add Your Review</h3>
                                                <p>Lorem ipsum dolo sit amet, consectetur adipisicing  eiusmod tempor incididun </p>
                                                <div class="rating">
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star'></i>
                                                    <i class='bx bxs-star-half'></i>
                                                </div>
                                                <form id="contactForm">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="form-group">
                                                                <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Your Name*">
                                                            </div>
                                                        </div>
                        
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="form-group">
                                                                <input type="email" name="email_address" id="email_address" required data-error="Please enter email address" class="form-control" placeholder="Email Address*">
                                                            </div>
                                                        </div>
                        
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group">
                                                                <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
                                                            </div>
                                                        </div>
                        
                                                        <div class="col-lg-12 col-md-12">
                                                            <button type="submit" class="default-btn btn-bg-three">
                                                                Send Your Message
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tabs_item">
                                    <div class="products-tabs-shipping">
                                       {!! $product->note !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Tab End -->

<!-- Related Product Area -->
<div class="related-products-area pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2>Related Products</h2>
        </div>
        <div class="row pt-45">
        	@foreach($relatedproduct as $product)
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="product-img">
                        <a href="shop-details.html">
                            <img src="{{ asset('storage/app/public/'.$product->image) }}" height="350px"  alt="{{ $product->title }}">
                        </a>

                        <div class="product-item-tag">
                            <h3>New</h3>
                        </div>
                        <ul class="product-item-action">
                            <li><a href="#"><i class='bx bx-repost'></i></a></li>
                            <li><a href="wishlist.html"><i class='bx bx-heart'></i></a></li>
                            <li><a href="cart.html"><i class='bx bx-cart'></i></a></li>
                        </ul>
                    </div>

                    <div class="content">
                        <h3><a href="shop-details.html">{{ $product->title }}</a></h3>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <span>$12.0/Kg </span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Related Product Area End -->

@endsection
    @php
$setting = App\Models\Admin\Setting::first();
@endphp
@extends('layouts.app')
@section('content')
    <!-- Inner Banner Area -->
  {{--       <div class="inner-banner-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-4">
                        <div class="inner-content">
                            <h2>Blog Details</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Blog Details</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-8">
                        <div class="inner-img">
                            <img src="public/frontend/assets/images/inner-banner/inner-banner3.png" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Inner Banner Area End -->

        <!-- Blog Details Area -->
        <div class="blog-details-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-article">
                            <div class="blog-article-img">
                                <img src="{{ asset('storage/app/public/'.$blog->image) }}" alt="Images">
                                <div class="blog-article-tag">
                                    <h3>{{ $blog->created_at->format('d') }}</h3>
                                    <span>{{ $blog->created_at->format('m') }}</span>
                                </div>
                            </div>

                            <div class="blog-article-title">
                                <h2>{{ $blog->title }} </h2>
                                <ul>
                                    <li>By Admin</li>
                                    <li>Related Post</li>
                                    <li><i class='bx bx-user'></i>{{ $blog->user->name }}</li>
                                </ul>
                            </div>

                            <div class="article-content">
                                <p>
                                {!! $blog->description)}}
                                </p>

             {{--                    <blockquote class="blockquote"> 
                                    <p>
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tem por invidunt ut labore et
                                        dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                                        Stet clita kasd gubergren consectetur adipiscing elit consetetur sadipscing elitr, sed diam nonumy eirmod tem por.
                                    </p>
                                </blockquote> --}}

                            </div>

                            

                            <div class="comments-wrap">
                                <div class="comment-title">
                                    <h3 class="title">Comments (02)</h3>
                                </div>
								
								<ul class="comment-list">
									<li>
										<img src="{{ asset('public/frontend/assets/images/blog/blog-profile1.jpg') }}" alt="Image">
										<h3>Charles Lauver</h3>
                                        <span>CEO, Maxcom Corporation</span>
                                        <div class="content">
                                            <div class="rating">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                            </div>
                                            <span class="date">NOV 05, 2020</span>
                                        </div>
										<p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pretium, massa vel gravida bibendum, dolor turpis mollis sem, id interdum nisl odio vitae velit. Phasellus felis dolor, venenatis in lacus vel,
                                            maximus tempor nisi. Ut ut felis condimentum, sodales nisi quis, ultrices est. Pellentesque habitant morbi tristique senectus et netus et .
                                        </p>
										<a href="#">Reply</a>
                                    </li>
                                    
                                    <li>
										<img src="{{ asset('public/frontend/assets/images/blog/blog-profile2.jpg') }}" alt="Image">
										<h3>Peggy Galvan</h3>
                                        <span>Manager, Devine Limited.</span>
                                        <div class="content">
                                            <div class="rating">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                            </div>
                                            <span class="date">NOV 05, 2020</span>
                                        </div>
										<p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pretium, massa vel gravida bibendum, dolor turpis mollis sem, id interdum nisl odio vitae velit. Phasellus felis dolor, venenatis in lacus vel,
                                            maximus tempor nisi. Ut ut felis condimentum, sodales nisi quis, ultrices est. Pellentesque habitant morbi tristique senectus et netus et .
                                        </p>
                                        <a href="#"> Reply</a>
                                    </li>
								</ul>
                            </div>

                            <div class="comments-form">
                                <h3 class="title">Leave A Comment</h3>
                                <div class="contact-form">
                                    <form id="contactForm">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Your Name">
                                                </div>
                                            </div>
            
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Your Email">
                                                </div>
                                            </div>
    
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" name="websit" class="form-control" required data-error="Your website" placeholder="Your website">
                                                </div>
                                            </div>
            
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
                                                </div>
                                            </div>
    
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group checkbox-option">
                                                    <input type="checkbox" id="chb2">
                                                    <p>
                                                        Save my name, email, and website in this browser for the next time I comment.
                                                    </p>
                                                </div>
                                            </div>
            
                                            <div class="col-lg-12 col-md-12">
                                                <button type="submit" class="default-btn btn-bg-three">
                                                    Post A Comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="side-bar-area">
                            <div class="search-widget">
                                <form class="search-form">
                                    <input type="search" class="form-control" placeholder="Search...">
                                    <button type="submit">
                                        <i class="bx bx-search"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="side-bar-widget">
                                <h3 class="title">All Categories</h3>
                                <div class="side-bar-categories">
                                    <ul>
                                        <li>
                                            <a href="#" class="active">All Categories & Items<span>(70)</span></a>
                                        </li>
                                        <li>
                                            <a href="#">Cooking & Baking<span>(12)</span></a>  
                                        </li>
                                        <li>
                                            <a href="#">Beverage<span>(14)</span></a>
                                        </li>
                                        <li>
                                            <a href="#">Snacks<span>(17)</span></a>
                                        </li>
                                        <li>
                                            <a href="#">Milk and Dairy<span>(37)</span></a>
                                        </li>
                                        <li>
                                            <a href="#">Meat and Fish<span>(18)</span></a>
                                        </li>
                                        <li>
                                            <a href="#">Fruits and Vegetable<span>(22)</span></a>
                                        </li>
                                        <li>
                                            <a href="#">Home & Kitchen Appliance<span>(19)</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="side-bar-widget">
                                <h3 class="title">Recent Posts</h3>
                                <div class="widget-popular-post">
                                    <article class="item">
                                        <a href="#0" class="thumb"> {{-- news-details.html --}}
                                            <span class="full-image cover bg1" role="img"></span>
                                        </a>
                                        <div class="info">
                                            <h4 class="title-text"> 
                                                <a href="#0"> {{-- news-details.html --}}
                                                    Fresh Organic Meat 
                                                </a>
                                            </h4>
                                            <p>Nov 05, 2020</p>
                                        </div>
                                    </article>
    
                                    <article class="item">
                                        <a href="#0" class="thumb"> {{-- news-details.html --}}
                                            <span class="full-image cover bg2" role="img"></span>
                                        </a>
                                        <div class="info">
                                            <h4 class="title-text">
                                                <a href="#0"> {{-- news-details.html --}}
                                                    Pineapple Price Lower
                                                </a>
                                            </h4>
                                            <p>13 October, 2020</p>
                                        </div>
                                    </article>
    
                                    <article class="item">
                                        <a href="#0" class="thumb"> {{-- news-details.html --}}
                                            <span class="full-image cover bg3" role="img"></span>
                                        </a>
                                        <div class="info">
                                            <h4 class="title-text">
                                                <a href="#0"> {{-- news-details.html --}}
                                                    Higher the Banana Price
                                                </a> 
                                            </h4>
                                            <p>17 October, 2020</p>
                                        </div>
                                    </article>
                                </div>
                            </div>

                            <div class="side-bar-widget">
                                <h3 class="title">Tags</h3>
                                <ul class="side-bar-widget-tag">
                                    <li><a href="#">Basic Food</a></li>
                                    <li><a href="#">Raw</a></li>
                                    <li><a href="#">Fresh</a></li>
                                    <li><a href="#">Rate</a></li>
                                    <li><a href="#">Price</a></li>
                                    <li><a href="#">Grocery</a></li>
                                    <li><a href="#">Category</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Details Area End -->

        @endsection
@php
$setting = App\Models\Admin\Setting::first();
@endphp
@extends('layouts.app')
@section('content')


        <!-- Inner Banner Area -->
{{--         <div class="inner-banner-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-4">
                        <div class="inner-content">
                            <h2>CONTACT US</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Contact Us</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-8">
                        <div class="inner-img">
                            <img src="public/frontend/assets/images/inner-banner/inner-banner2.png" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Inner Banner Area End -->

        <!-- Contact Form Area -->
        <div class="contact-form-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Let's Send Us a Message Below</h2>
                </div>
                <div class="row pt-45 align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-img">
                            <img src="public/frontend/assets/images/contact-img.jpg" alt="Images">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="contact-form">
                            <h2>Send a Message</h2>
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Your Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Name">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Your Email</label>
                                            <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Email">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="Phone">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Your Subject</label>
                                            <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject" placeholder="Your Subject">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Your Message</label>
                                            <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="agree-label">
                                            <input type="checkbox" id="chb1">
                                            <label for="chb1">
                                                Accept <a href="terms-condition.html">Terms & Conditions</a> And <a href="privacy-policy.html">Privacy Policy.</a>
                                            </label>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-bg-three">
                                            Send Message
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Form Area End -->

        <!-- Contact Area -->
        <div class="contact-area pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Get in Touch</h2>
                </div>
                <div class="row pt-45">
                    <div class="col-lg-4 col-sm-6">
                        <div class="contact-card">
                            <i class='bx bx-phone-call'></i>
                            <h3>Call Number</h3>
                            <span><a href="tel:+1-(123)-456-7890">@if($setting) {{ $setting->phone }} @endif</a></span>
                            <span><a href="tel:+1-(123)-656-6790">@if($setting) {{ $setting->hotline }} @endif</a></span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="contact-card">
                            <i class='bx bxs-map'></i>
                            <h3>Address</h3>
                            <span>@if($setting) {{ $setting->address }} @endif</span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 offset-lg-0 offset-sm-3">
                        <div class="contact-card">
                            <i class='bx bx-message'></i>
                            <h3>Contact Info</h3>
                            <span><a href="mailto:hello@hilo.com">@if($setting) {{ $setting->email }} @endif</a></span>
                            <span><a href="@if($setting) {{ $setting->website_link }} @endif">@if($setting) {{ $setting->website_link }} @endif</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Area End -->

        <!-- Map Area -->
        <div class="map-area">
            <div class="container-fluid m-0 p-0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50194.82376159623!2d-79.09792989247224!3d38.159337740034566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b4a08eb8621697%3A0xe5d6e4710a09b66e!2sStaunton%2C%20VA%2024401%2C%20USA!5e0!3m2!1sen!2sbd!4v1607173226867!5m2!1sen!2sbd" ></iframe>
            </div>
        </div>
        <!-- Map Area End -->

@endsection
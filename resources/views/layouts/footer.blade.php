@php
$setting = App\Models\Admin\Setting::first();
@endphp

<!-- Footer Area -->
        <footer class="footer-area">
            <div class="container">
                <div class="footer-top pt-100 pb-70">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget">
                                <div class="footer-logo">
                                    <a href="{{ route('/') }}">
                                        <img  @if($setting) src="{{ asset('storage/app/public/'.$setting->logo) }}" @else src="" @endif class="footer-logo1" alt="Images">
                                        <img  @if($setting) src="{{ asset('storage/app/public/'.$setting->logo) }}" @else src="" @endif  class="footer-logo2" alt="Images">
                                    </a>
                                </div>
                                <p>
                                   @if($setting) {{ $setting->meta_description }} @endif
                                </p>
                                <ul class="footer-list-contact">
                                    <li>
                                        <i class='bx bx-home'></i>
                                        <a href="#0">@if($setting) {{ $setting->address }} @endif</a>
                                    </li>
                                    <li>
                                        <i class='bx bx-phone-call' ></i>
                                        <a href="tel:+1(123)-456-7890">+@if($setting) {{ $setting->phone }} @endif</a>
                                    </li>
                                    <li>
                                        <i class='bx bx-envelope'></i>
                                        <a href="mailto:hello@hilo.com">@if($setting) {{ $setting->email }} @endif</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget">
                                <h3>Services</h3>
                                <ul class="footer-list">
                                    <li>
                                        <a href="{{ route('login') }}" target="_blank">
                                            My Account
                                        </a>
                                    </li> 
                                    <li>
                                        <a href="{{ route('contact') }}" target="_blank">
                                            Contact
                                        </a>
                                    </li> 
                                    <li>
                                        <a href="#0" target="_blank">
                                            Privacy Policy      
                                        </a>
                                    </li> 
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget">
                                <h3>Partner</h3>
                                <ul class="footer-list">
                                    <li>
                                        <a href="http://delwarit.com/" target="_blank">
                                            DelwarIT
                                        </a>
                                    </li> 
                                    <li>
                                        <a href="https://smartcity.com.bd/" target="_blank">
                                            Smart City 
                                        </a>
                                    </li> 
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget">
                                <h3>Follow Us</h3>
                                <p>We are one of the best & quality full  in market. Let's join.</p>
                                <form class="footer-form-area">
                                    <input type="email" class="form-control" placeholder="Email">
                                    <button class="subscribe-btn" type="submit">
                                        <i class='bx bx-paper-plane'></i>
                                    </button>
                                </form>

                                <ul class="social-link">
                                    <li>
                                        <a href="#0" target="_blank"><i class='bx bxl-facebook'></i></a>
                                    </li> 
                                    <li>
                                        <a href="#0" target="_blank"><i class='bx bxl-twitter'></i></a>
                                    </li> 
                                    <li>
                                        <a href="#0" target="_blank"><i class='bx bxl-instagram'></i></a>
                                    </li> 
                                    <li>
                                        <a href="#0" target="_blank"><i class='bx bxl-youtube'></i></a>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="copy-right-area">
                    <div class="copy-right-text">
                        <p>
                            Copyright @<script>document.write(new Date().getFullYear())</script> DelwarIT. All Rights Reserved by 
                            <a href="https://delwarit.com/" target="_blank">DelwarIT</a> 
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End -->
@extends('auth.layouts.auth_app')
@section('authtitle','Login')
@section('content')
<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-4">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col mx-auto">
                <div class="card mt-5 mt-lg-0">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="text-center">
                                <h3 class="">Sign In</h3>
                                <p>Create New Account  <a href="{{ route('register') }}">Sign Up</a>
                                </p>
                            </div>
                            <div class="login-separater text-center mb-4"> <span>or Sign In Now</span>
                                <hr/>
                            </div>
                            <div class="form-body">
                                <form class="row g-3" method="POST" action="{{ route('login') }}">
                            @csrf
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email</label>
                                        <input type="email"  id="inputEmailAddress" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" id="inputChoosePassword"  class="form-control border-end-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"><a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end"> 
                                        @if (Route::has('password.request'))
                                            <a class="" href="{{ route('password.request') }}">
                                                Forgot Password ?
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
@endsection
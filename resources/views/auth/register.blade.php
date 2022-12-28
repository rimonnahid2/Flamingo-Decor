@extends('auth.layouts.auth_app')
@section('authtitle','Register')
@section('content')
<div class="d-flex align-items-center justify-content-center my-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
            <div class="col mx-auto">
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="text-center">
                                <h3 class="">Sign Up</h3>
                                <p>Do you have any account? <a href="{{ route('login') }}">Sign In</a>
                                </p>
                            </div>
                            <div class="form-body">


                                <form class="row g-3" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="col-6">
                                        <label for="inputEmailAddress" class="form-label">First Name</label>
                                        <input type="name"  id="inputNameAddress" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="inputEmailAddress" class="form-label">Last Name </label>
                                        <input type="name"  id="inputNameAddress" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email </label>
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
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Confirm Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end"> 
                                        @if (Route::has('password.request'))
                                            <a class="authentication-forgot-password.html" href="{{ route('password.request') }}">
                                                Forget Password ? 
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign Up</button>
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
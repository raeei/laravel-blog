@extends('layouts.app_layout')

@section('content')
<div class="container mb-8" style="margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11" style="background: black;margin: 15px; border: 1px solid springgreen; border-radius: 10px;">

                <div class="card-body">
                    <div class="text-center pt-3 pb-4">
                        <img src="../images/advert1.jpg" width="100px" height="100px" />
                        <h3 class="text-white mt-4">Sign Up</h3>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                       <div class=" mb-3">
                            <label for="first_name" class="col-form-label text-md-end text-white">{{ __('First Name') }}</label>
                                <input id="first_name" value="{{ old('first_name') }}" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required autocomplete="name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                     <div class=" mb-3">
                            <label for="last_name" class="col-form-label text-md-end text-white">{{ __('Last Name') }}</label>
                                <input id="last_name"  type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                       <div class=" mb-3">
                            <label for="phone" class="col-form-label text-md-end text-white">{{ __('Phone') }}</label>
                                <input id="phone" onkeypress="isInputNumber(event)" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="name" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class=" mb-3">
                            <label for="email"  value="{{ old('name') }}" class="col-form-label text-md-end text-white">{{ __('Email Address') }}</label>
                                <input id="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class=" mb-3">
                            <label for="password" class="col-form-label text-md-end text-white">{{ __('Password') }}</label>
                                <input id="password" value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                       <div class=" mb-3">
                            <label for="password-confirm" class="col-form-label text-md-end text-white">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" value="{{ old('password-confirm') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="row mb-0 pt-2 pb-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
           
        </div>
    </div>
</div>


@endsection

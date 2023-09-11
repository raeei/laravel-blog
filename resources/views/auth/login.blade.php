@extends('layouts.app_layout')

@section('content')
<style>
    .input-error{
                box-shadow: 0 3px 3px red;
            }
</style>
<div class="container mb-8" style="margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11" style="background: black;margin: 15px; border: 1px solid springgreen; border-radius: 10px;">
            <div class="card-body">
                <div class="text-center pt-3 pb-4">
                    <img src="../images/advert1.jpg" width="100px" height="100px" />
                    <h3 class="text-white mt-4">Log In</h3>
                </div>
                <div class="alert alert-danger alert-block text-center d-none"> 
                    <strong id="alert-message"></strong>        
                </div>
                <form id="login-form" method="POST" action="">
                    @csrf

                    <div class=" mb-3">
                        <label for="email" class="col-form-label text-md-end text-white">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        <span class="d-none text-danger" style="color: red;" id="email-alert">
                        </span>
                    </div>

                    <div class=" mb-3">
                        <label for="password" class="col-form-label text-md-end text-white">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                       <span class="d-none text-danger" style="color: red" id="password-alert">
                       </span>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-white" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 text-right pt-0 pr-3 pb-0 pl-0">
                                <div class="form-check">
                                    @if (Route::has('password.request'))
                                    <a class="text-white" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 mb-0 text-center">
                        <button type="submit" id="login-btn" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>       
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#login-form').submit(function (e) {
            e.preventDefault();
            $('#login-btn').html("");
            $('#login-btn').append('<i class="fa fa-spinner fa-spin"></i>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // gets the csrf_token
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('login') }}",
                type: 'post',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#login-btn').html("");
                    $('#login-btn').html("Login");
                    if (response.status === 401) {
                        $('.alert-danger').removeClass('d-none');
                        $('#alert-message').html("");
                        $('#alert-message').append(response.message);
                    }
                    if (response.status === 200) {
                        location.reload(true);
                    }
                    else{
                        window.location = '{{ route('welcome') }}';
                    }
                },
                error: function (data) {
                     $('#login-btn').html("");
                    $('#login-btn').html("Login");
                    if ($.trim(data.responseJSON.errors.email) === 0) {
                        $("#email-alert").addClass("d-none").removeClass("d-block");
                        $("#email").removeClass("input-error");
                    } else {
                        $("#email-alert").addClass("d-block").removeClass("d-none");
                        $("#email").addClass("input-error");
                        $("#email-alert").html(data.responseJSON.errors.email[0]);
                    }
                    
                    if ($.trim(data.responseJSON.errors.password) === 0) {
                        $("#password-alert").addClass("d-none").removeClass("d-block");
                        $("#password").removeClass("input-error");
                    } else {
                        $("#password-alert").addClass("d-block").removeClass("d-none");
                        $("#password").addClass("input-error");
                        $("#password-alert").html(data.responseJSON.errors.password[0]);
                    }
                }
            });
        });
    });

</script>


@endsection

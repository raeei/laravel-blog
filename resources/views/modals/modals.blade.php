<div class="modal fade  " id="login"  data-keyboard="false"  data-backdrop="static" tabindex="-1" >
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content" style="background: none !important; box-shadow: none; border: none;">

            <div class="modal-header" style="margin-bottom: 5px; border-bottom: none;">
                <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close" style="padding: 4px 10px 10px 10px; opacity: 0.7; margin-right: -5px; z-index: 50001; color: white !important; background: black; border-radius: 50px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0; background-image: url(../images/back1.jpg); background-repeat: no-repeat; background-size: cover; border-radius: 10px; ">
                <div class="container-fluid" style="margin: auto;background: black; opacity: 0.90;">
                    <div class="col-11" style="margin: auto;">
                        <div class="card-body" >
                            <div class="alert alert-danger alert-block text-center d-none"> 
                                <strong id="alert-message"></strong>        
                            </div>
                            <!--                            <form method="POST" action="{{ route('login') }}">-->
                            <form id="login-form" method="POST" action="">
                                @csrf

                                <div class=" mb-4">
                                    <label for="email" class="col-form-label text-md-end text-white">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span class="d-none text-danger" style="color: red;" id="email-alert">
                                    </span>
                                </div>

                                <div class=" mb-4">
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
                                    <button id="login-btn" type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                        </div>  
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  " id="loginSignUp"  data-keyboard="false"  data-backdrop="static" tabindex="-1" >
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <strong>Log in to continue</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="../images/rabbit.jpg" />
                <h5>We're a place platform that gives you the verified news you need.</h5>
                <div class="container">
                    <a href="{{route('login')}}" class="btn btn-primary form-control">Log in</a>
                    <h4>Or</h4>
                    <a href="{{route('register')}}" class="btn btn-dark form-control create-account-button">Create an account</a>
                </div>      
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="requireDate"   data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <strong>Alert</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Both dates are required to search through table</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade user-photo-modal" id="userPhoto"   data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <strong>Upload Picture</strong></h5>
                <button type="button" class="close" onclick="closeModal()"data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="upload-photo" action="" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="modal-body">
                    <div class="photo-upload-container">
                        <label for="picture">Profile Picture</label>
                        <input id="picture" onchange="profilePictureLoad(this);" name="picture" class="form-control" type="file" required />
                        <img class="d-none" id="show-uploaded-picture" /> 
                        <span class="d-none text-danger" id="profile-picture-alert">
                        </span>
                    </div>
                    <div class="success-message" id="upload-photo-success-alert">
                        <p><strong>Information updated successfully</strong></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" id="upload-photo-btn">Upload Photo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade user-password-modal" id="passwordChange"   data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <strong>Change Password</strong></h5>
                <button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="change-password" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="modal-body">
                    <label for="password">Password</label>
                    <input type="password" id="password"  class="form-control"  name="password" autocomplete="off" required/>
                    <span class="d-none text-danger" id="change-password-alert">
                    </span>
                    <div style="margin-bottom: 15px;">
                        <label for="confirm_password">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" type="password" required/>
                    </div>
                    <div class="password-change-success-message">
                        <p id="password-success-alert"><strong>Information updated successfully</strong></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn" id="change-password-btn" >Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
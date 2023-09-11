<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="{{url('../')}}/public/img/logo8.png">
        <title>@yield('page_title')</title>


        <link rel="stylesheet" href="{{asset('css/app.css')}}">


        <script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/html" href="../css/tiny-slider-2.9.4-.css">
        <script src="../js/tiny-slider-2.9.4-.js"></script>
        @yield('modal_Script')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <!--@vite(['resources/js/app.js'])-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <!--<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>-->
        <link rel="stylesheet" href="css/summernote-bs4.min.css">
        <script src="js/summernote-bs4.min.js"></script>


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        @yield('datatableScript')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">  
        <script src="//unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script> 
        <script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>
        <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>

<!--      <script src="{{asset('js/tiny-slider-2.9.4-.js')}}"></script>
<script src="{{asset('js/jquery-3.5.1.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('js/popper.min.js')}}" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('css/summernote-bs4.min.css')}}">
<script src="{{asset('js/summernote-bs4.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap-4-4-1.min.css')}}" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="{{asset('js/bootstrap-4-4-1.min.js')}}" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->

    </head>
    <body>
        
         @include('layouts.nav-bar')
         <?php
         $currentUrl = url()->current();
?>
        <!--content area-->
        <div class="" style=" margin-top: 100px; padding-left: 0px; padding-right: 0px;">
            @yield('content')
        </div>

        <div>
            <div class="network-error" style="display: none;  padding: 5px; background: black; color: white; text-align: center;  position: fixed; bottom: 3%; right: 1%; z-index: 5000; ">     
                <h1>
                    Network connection is lost
                </h1>
                <h5 class="timer"></h5>
            </div>
            <div class="network-okay" style="display: none; padding: 5px; background: black; color: white; text-align: center;  position: fixed; bottom: 3%; right: 1%; z-index: 5000; ; ">
                <h1>
                    Network is back online
                </h1>
            </div>
        </div>
        <!--footer area-->
        @include('layouts.footer')
        @include('modals.modals')
    </body>

    <?php
    if (Auth::check()) {
        $small_profile_picture = Auth::user()->picture;
        $count_saved = App\Models\Favorite::where('user_id', Auth::user()->id)->count();
    } else {
        $small_profile_picture = "0";
        $count_saved = "0";
    }
    ?>
    <script src="{{asset('js/myScripts.js')}}"></script>
    <script src="{{asset('js/my-navbar.js')}}"></script>
    @yield('JavaScript')

<!--<script src="jquery.jdSlider-latest.js"></script>-->
<!--<script>
window.onload = function () {
    $('.shortlet-listing-slider').jdSlider();
};
</script>-->
    
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
                    if (response.code === 401) {
                        $('.alert-danger').removeClass('d-none');
                        $('#alert-message').html("");
                        $('#alert-message').append(response.message);
                    }
                    if (response.code == 200 && response.user == 'user') {
                        location.reload(true);
                    }
                    else if  (response.code == 200 && response.user != 'user'){
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

    <script>
                            $(function () {
                            var time = 35;
                             connect();
                            function connect() {
                            setTimeout(connect, 800);
                            if (time == 30){  
                                $('.network-okay').hide();
                            }
                             if (time == 20){  
                                var newTime = 35;
                                var showOkay = 'no';
                                check_network(newTime, showOkay);
                            }
                            
                            if(time == 15){
                                $('.network-error').show();
                                $('.network-okay').hide(); 
                            }
                           
                            if(time == 10){
                                var newTime = 35;
                                var showOkay = 'show';
                                check_network(newTime, showOkay);
                            }
                            if(time == 1){
                                time = 20;
                                clearTimeout(connect);
                            }
                             $(".timer").html('reconnecting in ' +time);
                            time --;
                            }
                            
                            function check_network(newTime, showOkay) {
                                var myTime = newTime;
                                var show = showOkay;
                                 $.ajax({
                            url: "{{ route('network') }}",
                                    method: "get",
                                    dataType: 'json',
                                    success: function (response) {
                                          if (show == 'show'){
                                            $('.network-error').hide();
                                            $('.network-okay').show();
                                             $('.network-error').hide();
                                        time = myTime;
                                        clearTimeout(connect);
                                        }
                                        else{
                                             $('.network-error').hide();
                                        time = myTime;
                                        clearTimeout(connect);
                                        }
                                    }
                            });
                            }
                           
                            });
    </script>
    <script>

        $(document).ready(function () {
            alert('ok');
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

        if ({{$count_saved}} > 0){
        document.getElementById("nav-count-saved-post").innerHTML = '<i class="fas fa-heart"></i> Saved Post  ({{$count_saved}})';
        }
        else{
        document.getElementById("nav-count-saved-post").innerHTML = '<i class="fas fa-heart"></i> No Saved Post';
        }
        });
        //        $.ajaxSetup({
        //        headers: {
        //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //        }
        });
    </script>

</html>
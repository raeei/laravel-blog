<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="{{url('../')}}/public/img/logomucg.png">
        <title>Welcome to test 4</title>
        <link rel="stylesheet" href="css/summernote-bs4.min.css">
        <script src="js/summernote-bs4.min.js"></script>
        <script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        @yield('modal_Script')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
       
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
       
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> 
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">  

        <script src="//unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script> 
        <script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>



        <style>
            body{

                /* background: #cfd0d3; */
                font-family: 'Cormorant', raleway !important;
            }


            /* navbar-section */

            @media (min-width: 800px) and (max-width: 850px) {
                .navbar:not(.top-nav-collapse) {
                    background: black !important;

                }
                .top-nav-collapse{
                    background: black !important;
                }
            }

            .navbar{
                background: black;
            }

            @media only screen and (max-width:768px){
                .navbar{
                    background-color: black
                }
            }

            .nav-item .nav-link{
                color: white !important;
                font-family: 'Cormorant', raleway;
                font-weight: 500;
                text-transform: uppercase;
                font-size: 15px;
            }

            .nav-item .nav-link:hover{
                background-color: #202020 !important;
                font-size: 17px;
            }

            @media only screen and (max-width:991px){
                .nav-flex-icons{
                    display: none;
                }
                .navbar-collapse{
                    text-align: right !important;
                }
            }


            .menu ul {
                display: none;
            }
            .menu #m1{
                padding: 10px;
                color: black;
                background: white;
                border-radius: 50px;
                margin-left: 25px;
            }
            .menu #m2{
                padding: 10px; 
                color: black;
                background: white;
                border-radius: 50px;
                margin-left: 10px;
            }
            #demo1{
                display: none
            }
            @media only screen and (max-width: 991px){
                #demo1{
                    display: block;
                }
            }
            .menu ul.dropit-submenu {
                animation: fade-in 0.3s ease-in-out forwards;
                background-color: #fff;
                padding: 6px 0;
                margin-left: -150px !important;
                margin-top: 5px;
                width: 200px;
                border-radius:6px;
                box-shadow:0 2px 4px 0 rgba(0,0,0,.16),0 2px 8px 0 rgba(0,0,0,.12);
                overflow: hidden;
            }
            .menu ul.dropit-submenu a {
                display: block;
                font-size: 15px;
                line-height: 25px;
                color: #7a868e;
                padding: 0 18px;
                text-align: left !important;
            }
            .menu ul.dropit-submenu a:hover {
                /* background: #248fc1; */
                background: black;
                color: #fff;
                text-decoration: none;
            }

            .dropit {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .dropit .dropit-trigger {
                position: relative;
            }
            .dropit .dropit-submenu {
                position: absolute;
                top: 100%;
                left: 0; /* dropdown left or right */
                z-index: 1000;
                display: none;
                min-width: 150px;
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .dropit .dropit-open .dropit-submenu {
                display: block;
            }

            li.menu-separator{
                background:#eee;
                height:1px;
                min-height:0;
                margin:12px 0;
                padding:0
            }

            @keyframes fade-in {
                0% {
                    opacity: 0;
                    z-index: 0;
                }

                30% {
                    opacity: 0.3;
                }

                55% {
                    opacity: 0.6;
                }

                70% {
                    opacity: 0.9;
                }

                100% {
                    opacity: 1;
                }
            }

            
            
            
          .table-section{
                background: white !important;
            }

            .table-container{
                margin:auto;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .table-section .header{
                font-family: 'Cormorant', raleway;
                font-size: 25px;
                color: #374151;
                text-align: center;
                padding-bottom: 20px;
                padding-top: 20px;
            }

          .table-container .select-container{
              padding-bottom: 20px;
          }

          .table-container .select-otion{
              font-family: 'Cormorant', raleway !important;
              font-size: 15px;
              font-weight: 600;
              color: #374151;
          }

          .select-option:focus{
              box-shadow: 0px 0px 3px 3px rgba(239,148,11,0.52);
              border: 1px solid #ef940b;
              outline: none !important;
          }

          .table-container .date-container{
              padding-bottom: 10px;
          }

          .table-container .date-control{
              text-align: right;
              margin-bottom: 10px;
          }

          @media only screen and (max-width:768px){
            .table-container .date-control{
                  text-align: left;
              }
          }

          .table-container label{
              text-align: right;
              color:#374151;
              font-family: 'Cormorant', raleway;
              font-weight: 600;
              font-size: 15px;
          }

         .table-container .search-date{
              margin-bottom: 10px;
          }
          
          .table-container .filter-button{
              width: 100%;
          }

          .table-container .reload-button{
              width: 100%;
              margin-bottom: 20px;
          }

            .table-striped{
                font-family: 'Cormorant', raleway;
                border-left: 1px solid #dddddd !important;
                border-right: 1px solid #dddddd !important;
                border-bottom: 1px solid #dddddd !important;
            }

            .table-striped td, .table-striped tr {
                border:none !important;

                font-family: 'Cormorant', raleway;
            }

            .table-striped thead{
                font-family: 'Cormorant', raleway;
                font-size: 15px;
                font-weight: 800;
                background: black;
                padding-left: 0px;

                padding-right: 0px !important;
                color: white;
            }

            .table-striped tbody tr td{
                font-family: 'Cormorant', raleway;
                font-size: 15px;
                font-weight: 400;
                color: #374151;
            }

            .table-striped th{
                border: none;
            }    

            .table-striped tbody tr:hover{
                background: rgba(225,225,225,1.2) !important;
            }
      
        
          .footer-section{
                background-color: black !important;
                margin-top: 70px;
                /*   // #202020  */
            }
            .footer-copyright{
                background: black !important;
            }

            .footer-copyright-container{
                height: 40px;
                background: black;
            }

            .footer-copyright-col{
                background: black;
                padding-top: 6px;
            }

            .footer-copyright-p{
                text-align: center;
                color: white;
                font-size: 14px !important;
                font-family: 'Cormorant', raleway;
            }

            .footer-copyright-links{

                font-size: 14px !important;
                color: #66a700;
                font-family: 'Cormorant', raleway;
            }

            .footer-copyright-links:hover{
                color: #ef940b;
            }
            
             .modal-backdrop{
        opacity: 1 !important
    }

        </style>
    </head>
</body>
<nav  class=" navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar navbar-section" style="border-bottom: 0.2px solid #ddd; padding-bottom: 5px; z-index: 500;">
    <div class="container-fluid " >

        <!-- Brand -->
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">

            <a class="navbar-brand" href="/">
                <strong>myBlog</strong>
            </a>
        </div>

        <!-- Links -->
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 navbar-collapse"  id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
                @guest
                <li class="nav-item">
                    <a href="{{ url('/deposit') }}" class="nav-link">
                        News
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/withdraw') }}" class="nav-link">
                        Business
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/transaction') }}" class="nav-link">
                        Sports
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('admin.users')}}" class="nav-link">
                        USERS
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.all_posts')}}" class="nav-link">
                        POST
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.all_comments')}}" class="nav-link">
                        COMMENTS
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.all_likes')}}" class="nav-link">
                        LIKES
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.all_advert')}}" class="nav-link">
                        ADVERTS
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.all_admin')}}" class="nav-link">
                        ADMINS
                    </a>
                </li>
                @endguest
            </ul>

<!--            {{-- menu icon for search, user, and mobile menu(Hamburger) --}}-->
            <div class="row" style="float: right">
              
                <ul id="demo" class="menu">
                    <li>
                        <a onclick="menu1()">
                            <i class="fas fa-user" id="m1" style=""></i>
                        </a> @guest
                        <ul>
                            <li><a href="{{ url('/login') }}"><i class="fas fa-right-from-bracket"></i> Login</a></li>
                            <li><a href="{{ url('/register') }}"><i class="fas fa-user-plus"></i> Register</a></li>
                            <li class="menu-separator"></li>
                            <li><a href="#"><i class="fas fa-globe"></i> Language</a></li>
                            <li><a href="#"><i class="fas fa-circle-info"></i> Help</a></li>
                        </ul>
                        @else
                        <ul>
                            <a href="{{route ('profile')}}">
                                <div class="container text-center pt-1">
                                    <img src="../images/{{Auth::user()->picture}}" alt="..." height="50px" width="50px" style="border-radius: 50px;"/>
                                    <p>ubong.ibok@gmail.com</p>
                                </div>
                            </a>
                            <li class="menu-separator"></li>
                            <li style="cursor: pointer" data-toggle="modal" data-target="#passwordChange"><a ><i class="fas fa-password"></i> Change password</a></li>
                            <li><a href="#"><i class="fas fa-message"></i> Message</a></li>
                            <li class="menu-separator"></li>
                            <li><a href="#"><i class="fas fa-globe"></i> Language</a></li>
                            <li><a href="#"><i class="fas fa-circle-info"></i> Help</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-right-from-bracket"></i>
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                        @endguest
                    </li>
                </ul>


                <ul id="demo1" class="menu">
                    <li>
                        <a onclick="menu2()">
                            <i class="fas fa-bars" id="m2"></i>
                        </a>
                        <ul>
                            <li><a href="{{ route('admin.users')}}">USERS</a></li>
                            <li><a href="{{ route('admin.all_posts')}}">POST</a></li>
                            <li><a href="{{ route('admin.all_comments')}}">COMMENTS</a></li>
                            <li><a href="{{ route('admin.all_likes')}}">LIKES</a></li>
                            <li><a href="{{ route('admin.all_advert')}}">ADVERT</a></li>
                            <li><a href="{{ route('admin.all_admin')}}">ADMIN</a></li>
                        </ul>
                        </div>

                        </div>   
                        </div>
                        </nav>



                        
                        <!--content area-->
                        <div class="container-fluid" style=" margin-top: 120px;">
                            @yield('content')
                        </div>

                        
                        <!--footer area-->
                           <div class="modal fade " id="passwordChange"   data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <strong>Change Password</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="changePassword" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="modal-body">
                    <div style="margin-bottom: 15px;">
                        <label for="password">Password</label>
                        <input type="password" id="password"  class="form-control"  name="password" autocomplete="off" required/>
                        <span class="d-none text-danger" id="change-password-alert">
                        </span>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="confirm_password">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required/>

                    </div>
                    <div class="text-center">
                        <p class="" style="display: none; color: green; font-size: 16px; padding-top: 10px" id="password-success-alert"><strong>Information updated successfully</strong></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="changePassword-btn" value="Change Password" />
                </div>
            </form>
        </div>
    </div>
</div>
                   
<footer class="footer-section">
    <div class="container-fluid footer-copyright">
        <div class="row">
            <div class="container footer-copyright-container">

                <div class="col footer-copyright-col">    
                    <p class="footer-copyright-p" style="letter-spacing: 1px; font-size: 14px; font-weight: 600">Copyright © 2021 MyPropertyPlug.ng. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
</footer>
                        
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
                        
                        <!--Controls the Icon for user on the nav bar-->
                        <script>
                            function menu1() {
                                 const element1 = document.getElementById("m1");
                                const cssObj = window.getComputedStyle(element1, null);
                                const m1 = cssObj.getPropertyValue("padding");
                                if (m1 == '10px') {
                                    document.getElementById("m1").style.padding = "8px";
                                    document.getElementById("m1").style.border = "2px solid red";
                                    $(".search-box").hide();
                                    $("#search-icon").css("border", "none");
                                    $("#search-icon").css("padding", "10px");
                                    document.getElementById("m2").style.border = "none";
                                    document.getElementById("m2").style.padding = "10px";
                                    // $("#m1").css("border", "red");
                                } else {
                                    document.getElementById("m1").style.border = "none";
                                }

                            }
                        </script>

                        <!--controls the icon for the mobile menu-->
                        <script>
                            function menu2() {
                                const element1 = document.getElementById("m2");
                                const cssObj = window.getComputedStyle(element1, null);
                                const m2 = cssObj.getPropertyValue("padding");
                                if (m2 === '10px') {
                                    document.getElementById("m2").style.padding = "8px";
                                    document.getElementById("m2").style.border = "2px solid red";
                                    $(".search-box").hide();
                                    $("#search-icon").css("border", "none");
                                    $("#search-icon").css("padding", "10px");
                                    document.getElementById("m1").style.border = "none";
                                    document.getElementById("m1").style.padding = "10px";
                                    // $("#m1").css("border", "red");
                                } else {
                                    document.getElementById("m2").style.border = "none";
                                }

                            }
                        </script>

                        <!--controls the dropdown menu-->
                        <script>
                            $(document).ready(function () {
                                $('#demo').dropit();
                            });
                            $(document).ready(function () {
                                $('#demo1').dropit();
                            });
                            $(document).ready(function () {
                                $('#demo').dropit({
                                    action: 'click', // The open action for the trigger
                                    submenuEl: 'ul', // The submenu element
                                    triggerEl: 'a', // The trigger element
                                    triggerParentEl: 'li', // The trigger parent element
                                    afterLoad: function () {}, // Triggers when plugin has loaded
                                    beforeShow: function () {}, // Triggers before submenu is shown
                                    afterShow: function () {}, // Triggers after submenu is shown
                                    beforeHide: function () {}, // Triggers before submenu is hidden
                                    afterHide: function () {} // Triggers before submenu is hidden
                                });
                            });
                            (function ($) {

                                $.fn.dropit = function (method) {

                                    var methods = {

                                        init: function (options) {
                                            this.dropit.settings = $.extend({}, this.dropit.defaults, options);
                                            return this.each(function () {
                                                var $el = $(this),
                                                        el = this,
                                                        settings = $.fn.dropit.settings;

                                                // Hide initial submenus
                                                $el.addClass('dropit')
                                                        .find('>' + settings.triggerParentEl + ':has(' + settings.submenuEl + ')').addClass('dropit-trigger')
                                                        .find(settings.submenuEl).addClass('dropit-submenu').hide();

                                                // Open on click
                                                $el.off(settings.action).on(settings.action, settings.triggerParentEl + ':has(' + settings.submenuEl + ') > ' + settings.triggerEl + '', function () {

                                                    // Close click menu's if clicked again
                                                    if (settings.action == 'click' && $(this).parents(settings.triggerParentEl).hasClass('dropit-open')) {
                                                        document.getElementById("m1").style.border = "none";
                                                        document.getElementById("m1").style.padding = "10px";
                                                        document.getElementById("m2").style.border = "none";
                                                        document.getElementById("m2").style.padding = "10px";
                                                        settings.beforeHide.call(this);
                                                        $(this).parents(settings.triggerParentEl).removeClass('dropit-open').find(settings.submenuEl).hide();
                                                        settings.afterHide.call(this);
                                                        return false;
                                                    }

                                                    // Hide open menus
                                                    settings.beforeHide.call(this);
                                                    $('.dropit-open').removeClass('dropit-open').find('.dropit-submenu').hide();

                                                    settings.afterHide.call(this);

                                                    // Open this menu
                                                    settings.beforeShow.call(this);
                                                    $(this).parents(settings.triggerParentEl).addClass('dropit-open').find(settings.submenuEl).show();
                                                    settings.afterShow.call(this);

                                                    return false;
                                                });

                                                // Close if outside click
                                                $(document).on('click', function () {
                                                    settings.beforeHide.call(this);
                                                    $('.dropit-open').removeClass('dropit-open').find('.dropit-submenu').hide();
                                                    settings.afterHide.call(this);
                                                    document.getElementById("m1").style.border = "none";
                                                    document.getElementById("m1").style.padding = "10px";
                                                    document.getElementById("m2").style.border = "none";
                                                    document.getElementById("m2").style.padding = "10px";
                                                });

                                                // If hover
                                                if (settings.action == 'mouseenter') {
                                                    $el.on('mouseleave', '.dropit-open', function () {
                                                        settings.beforeHide.call(this);
                                                        $(this).removeClass('dropit-open').find(settings.submenuEl).hide();
                                                        settings.afterHide.call(this);
                                                    });
                                                }

                                                settings.afterLoad.call(this);
                                            });
                                        }

                                    };

                                    if (methods[method]) {
                                        return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
                                    } else if (typeof method === 'object' || !method) {
                                        return methods.init.apply(this, arguments);
                                    } else {
                                        $.error('Method "' + method + '" does not exist in dropit plugin!');
                                    }

                                };

                                $.fn.dropit.defaults = {
                                    action: 'click', // The open action for the trigger
                                    submenuEl: 'ul', // The submenu element
                                    triggerEl: 'a', // The trigger element
                                    triggerParentEl: 'li', // The trigger parent element
                                    afterLoad: function () {}, // Triggers when plugin has loaded
                                    beforeShow: function () {}, // Triggers before submenu is shown
                                    afterShow: function () {}, // Triggers after submenu is shown
                                    beforeHide: function () {}, // Triggers before submenu is hidden
                                    afterHide: function () {} // Triggers before submenu is hidden
                                };

                                $.fn.dropit.settings = {};

                            })(jQuery);

                        </script>

                        </body>
                        </html>














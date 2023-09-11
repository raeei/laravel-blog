<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="{{url('../')}}/public/img/logomucg.png">
        <title>Welcome to test 4</title>
        <link rel="stylesheet" href="{{ URL::asset('css/summernote-bs4.min.css') }}">
        <script src="{{ URL::asset('js/summernote-bs4.min.js') }}"></script>
         
        <script src="{{ URL::asset('js/popper.min.js') }}" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

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



            .summary-container{
                /*        display: flex;
                        flex-direction: row;
                        flex-wrap: wrap;
                        justify-content: space-evenly;
                        gap: 2rem;
                        width: 100%;
                        max-width: 37.5rem;
                        padding: 0.5rem;
                        margin: 0 auto;
                        box-sizing: border-box;*/
            }

            .summary-box{
                flex: 10%;
                text-align: center;
                padding: 15px;
                margin-bottom: 15px;
            }

            .summary-box div{
                padding: 1rem;
            }
            @media only screen and (max-width: 1199px){
                .summary-container{

                    gap: 1rem;
                }

                .summary-box{
                    flex: 33% !important;
                }

            }

            @media only screen and  (max-width: 991px){
                .summary-box{
                    flex: 35% !important;
                }
            }

            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked + .slider {
                background-color: #2196F3;
            }

            input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
            
            .input-error{
                box-shadow: 0 3px 3px red;
            }
        </style>
    </head>

    <body>
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

                    </ul>

                    <!--            {{-- menu icon for search, user, and mobile menu(Hamburger) --}}-->
                    <div class="row" style="float: right">

                        <ul id="demo" class="menu">
                            <li>
                                <a onclick="menu1()">
                                    <i class="fas fa-user" id="m1" style="cursor: pointer;"></i>
                                </a> @guest
                                @else
                                <ul>
                                    <a>
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

                    </div>

                </div>   
            </div>
        </nav>

        <!--content area-->
        <div class="container-fluid" style=" margin-top: 120px;">
            <div class="container-fluid" style="margin: auto;">
                <div class="col-sm-11 summary-container" style="margin: auto;">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                                <div>
                                    <i class="fas fa-users"></i>
                                    <h4 class="numbers" id="all-post">
                                    </h4>
                                    <h4 class="details text-muted">ALL POST</h4>
                                </div>        
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                                <div>
                                    <i class="fas fa-donate"></i>
                                    <h4 class="numbers" id="all-active"> 

                                    </h4>
                                    <h4 class="details text-muted">ACTIVE</h4>
                                </div>    
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class=" summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                                <div>
                                    <i class="fas fa-donate"></i>
                                    <h4 class="numbers" id="all-pending"> 

                                    </h4>
                                    <h4 class="details text-muted">PENDING</h4>
                                </div>    
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class=" summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                                <div>
                                    <i class="fas fas fa-cogs"></i>
                                    <h4 class="numbers" id="all-cancelled">

                                    </h4>
                                    <h4 class="details text-muted">CANCELLED</h4>
                                </div>     
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class=" summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                                <div>
                                    <i class="fas fa-user-cog"></i>
                                    <h4 class="numbers" id="all-edit">

                                    </h4>
                                    <h4 class="details text-muted">ASKED TO EDIT</h4>
                                </div>        
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class=" summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                                <div>
                                    <i class="fas fa-user-cog"></i>
                                    <h4 class="numbers" id="all-likes"></h4>
                                    <h4 class="details text-muted">LIKES</h4>
                                </div>        
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class=" summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                                <div>
                                    <i class="fas fa-user-cog"></i>
                                    <h4 class="numbers" id="all-comments"></h4>
                                    <h4 class="details text-muted">COMMENTS</h4>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid table-section">
                    <div class="col-lg-11 table-container" >

                        <h1 class="header">POST TABLE</h1>
                        <div class="text-center p-3"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editorCreatePostModal">Create Post</button></div>
                        <div class="row">
                            <div class="col-sm-3 select-container">
                                <select id="select-post-type" class="form-control select-option">
                                    <option value="1">All Post</option> 
                                    <option value="2">Active</option>
                                    <option value="3">Pending</option>
                                    <option value="4">Asked To Edit</option>
                                </select>
                            </div>
                            <div class="col-sm-5 date-container input-daterange">
                                <div class="row">                             
                                    <div class="col-lg-5 col-4 date-control">
                                        <label>From :</label> 
                                    </div>
                                    <div class="col-lg-6 col-8">

                                        <input type="date" name="start_date" id="start_date" class="form-control search-date" />
                                    </div>
                                </div>

                                <div class="row">                             
                                    <div class="col-lg-5 col-4 date-control">
                                        <label>To :</label> 
                                    </div>
                                    <div class="col-lg-6 col-8">
                                        <input type="date" name="end_date" id="end_date" class="form-control search-date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row date-control" >                             
                                    <div class="col-lg-6 date-control" >
                                        <button class="btn btn-success filter-button" name="filter" id="filter">Find</button> 
                                    </div>
                                    <div class="col-lg-6">
                                        <button name="refresh" id="refresh" class="btn btn-dark reload-button">Reload</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="editor-post">
                                <thead>
                                    <tr>
                                        <th class="" aria-label="hidden" aria-sortin="false">Featured Picture</th>
                                        <th>Post Title</th>
                                        <th>Content</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>                
                    </div>
                </div>  

                <div class="container-fluid table-section">
                    <div class="col-lg-11 table-container" >
                        <div class="" style="padding-top: 40px; text-align: center;">
                            <h5>My Activities</h5>
                            <div class="container-fluid table-section">
                                <div class=" table-container" >
                                    <div class="row">
                                        <div class="col-sm-6 date-container input-daterange">
                                            <div class="row">                             
                                                <div class="col-lg-4 col-4 date-control text-left">
                                                    <label>From :</label> 
                                                </div>
                                                <div class="col-lg-8 col-8">
                                                    <input type="date" name="editor_activity_start_date" id="editor-activity-start-date" class="form-control search-date" />
                                                </div>
                                            </div>
                                            <div class="row">                             
                                                <div class="col-lg-4 col-4 date-control text-left">
                                                    <label>To :</label> 
                                                </div>
                                                <div class="col-lg-8 col-8 text-left">
                                                    <input type="date" name="editor_activity_start_date" id="editor-activity-end-date" class="form-control search-date" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row date-control" >                             
                                                <div class="col-lg-6 date-control" >
                                                    <button class="btn btn-success filter-button" name="filter" id="editor-filter-post">Find</button> 
                                                </div>
                                                <div class="col-lg-6">
                                                    <button name="refresh" id="editor-refresh-post" class="btn btn-dark reload-button">Reload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="editor-activities-table">
                                            <thead>
                                                <tr>
                                                    <th class="" aria-label="hidden" aria-sortin="false">Description</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>                   
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <div class="modal fade  " id="editorCreatePostModal"  data-keyboard="false"  data-backdrop="static" tabindex="-1" >
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="font-weight-bold" id="modal-title">Create Post</h5>
                        <button type="button" onclick="closeModal()" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>   
                    <div class="modal-body">
                        <form id="createPostForm"   enctype="multipart/form-data" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="id" id="id">
                            <div style="margin-bottom: 15px;">
                                <label for="post_title">Post Title</label>
                                <input id="post_title"  type="text" class="form-control" name="post_title" value="" required placeholder="Enter title" autocomplete="off"/>
                                <span class="d-none text-danger" id="post-title-alert">
                                </span>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="feature_picture">Feature Picture</label>
                                <input type="file"  onchange="imageLoad(this);" id="feature_picture"  name="feature_picture" class="form-control" required />
                                <img class="d-none" id="showUploadPicture1" src="#" width="300px" height="200px" /> 
                                <span class="d-none text-danger" id="feature-picture-alert">
                                </span>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="role">Add watermark to featured image</label>
                                <select id="watermark" name="watermark" class="form-control select-option" required>
                                    <option value="">None</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <span class="d-none text-danger" id="category-alert">
                                </span>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="post_body">Post Body</label>
                                <textarea id="post_body" name="post_body" rows="6"  placeholder="Enter content..."></textarea>
                                <span class="d-none text-danger" id="post-body-alert">
                                </span>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="role">Select Category</label>
                                <select id="category" name="category" class="form-control select-option" required>
                                    <option value="none">None</option>
                                    <option value="News">News</option>
                                    <option value="Sport">Sport</option>
                                    <option value="Politics">Politics</option>
                                    <option value="Business">Business</option>
                                    <option value="Entertainment">Entertainment</option>
                                    <option value="Weather">Weather</option>
                                    <option value="Culture">Culture</option>
                                    <option value="Tv">Tv</option>
                                    <option value="Technology">Technology</option>
                                    </select>
                                <span class="d-none text-danger" id="category-alert">
                                </span>
                            </div>
                            <div class="text-center">
                                <p class="" style="display: none; color: green; font-size: 16px; padding-top: 10px" id="success-alert"><strong>Information saved successfully</strong></p>
                            </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <input type="button" onclick="closeModal()"  class="btn btn-secondary" data-dismiss="modal" value="Close"/>
                        <input type="submit" id="createPost" class="btn btn-primary" value="Create Post"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade  " id="viewPost"  data-keyboard="false"  data-backdrop="static" tabindex="-1" >
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <strong>View Post</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="margin-bottom: 35px;">
                            <h1 id="view-post-title" style=" overflow: hidden; width:100%;"></h1>
                        </div>
                        <div style="margin-bottom: 30px;">
                            <img  height="300px" width="100%" id="view-featured-picture"/>
                        </div>
                        <div style="margin-bottom: 10px;">
                            <p id="view-post-content" style="overflow:hidden; width:100%"></p>
                        </div>
                        <div style="margin-bottom: 10px; border-top: 1px solid #eee; padding-top: 10px;">
                            <span style="">
                                <i class="fas fa-heart fa-lg" id="fa-heart"style="margin-right: 20px;  cursor: pointer;"> </i> 
                                <i class="fas fa-comment fa-lg" id="fa-comment" style="margin-right: 20px;  cursor: pointer;"></i>
                                <i class="fa-solid fa-bookmark fa-lg" id="fa-save" style="margin-right: 20px;  cursor: pointer;"></i>
                                <i class="fa-solid fa-eye fa-lg" id=""> 0</i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade  " id="editPostModal"  data-keyboard="false"  data-backdrop="static" tabindex="-1" >
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="font-weight-bold" id="modal-title">View Post</h5>
                        <button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>   
                    <div class="modal-body">
                        <form id="editPostForm"   enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="post_id" id="post_id">
                            <div style="margin-bottom: 15px;">
                                <label for="post_title">Post Title</label>
                                <input id="edit_post_title"  type="text" class="form-control" name="post_title" value="" required placeholder="Enter title" autocomplete="off"/>
                                <span class="d-none text-danger" id="edit-post-title-alert">
                                </span>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="edit_feature_picture">Feature Picture</label>
                                <input type="file" id="edit_feature_picture" onchange="editImageLoad(this);" name="edit_feature_picture" class="form-control" />
                                <img id="dislay_feautred_picture" src="#" width="300px" height="200px" /> 
                                <span class="d-none text-danger" id="edit-feature-picture-alert">
                                </span>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="role">Add watermark to featured image</label>
                                <select id="edit_watermark" name="watermark" class="form-control select-option" required>
                                    <option value="">None</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <span class="d-none text-danger" id="edit-category-alert">
                                </span>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="post_body">Post Body</label>
                                <textarea id="edit_post_body" name="post_body" rows="6"  placeholder="Enter content..."></textarea>
                                <span class="d-none text-danger" id="edit-post-body-alert">
                                </span>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="role">Select Category</label>
                                <select id="edit_category" name="category" class="form-control select-option" required>
                                    <option value="none">None</option>
                                    <option value="News">News</option>
                                    <option value="Sport">Sport</option>
                                    <option value="Politics">Politics</option>
                                    <option value="Business">Business</option>
                                    <option value="Entertainment">Entertainment</option>
                                    <option value="Weather">Weather</option>
                                    <option value="Culture">Culture</option>
                                    <option value="Tv">Tv</option>
                                    <option value="Technology">Technology</option>
                                </select>
                                <span class="d-none text-danger" id="edit-category-alert">
                                </span>
                            </div>
                            <div class="text-center">
                                <p class="" style="display: none; color: green; font-size: 16px; padding-top: 10px" id="edit-success-alert"><strong>Information updated successfully</strong></p>
                            </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <input type="button"  class="btn btn-secondary" data-dismiss="modal" value="Close"/>
                        <input type="submit" id="editPostBtn" class="btn btn-primary" value="Edit Post"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade " id="passwordChange"   data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <strong>Change Password</strong></h5>
                        <button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" type="password" required/>

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

     <script type="text/javascript" src="{{ URL::asset('js/editor.js') }}"></script>
        <script>
function closeModal(){
     $('#changePassword')[0].reset();
     $('#createPostForm')[0].reset();
     $("#post_body").summernote("reset");
     $("#showUploadPicture1").addClass("d-none").removeClass("d-block");
     $("#post-title-alert").addClass("d-none").removeClass("d-block");
     $("#feature-picture-alert").addClass("d-none").removeClass("d-block");
     $("#post-body-alert").addClass("d-none").removeClass("d-block");
     
}
            $(document).ready(function () {
                // code for display the summary of post on the summery box
            document.getElementById("all-post").innerHTML = {{$post_count_summary['all_post'] }};
            document.getElementById("all-active").innerHTML = {{$post_count_summary['approved_post'] }};
            document.getElementById("all-pending").innerHTML = {{$post_count_summary['pending_post'] }};
            document.getElementById("all-cancelled").innerHTML = {{$post_count_summary['cancelled_post'] }};
            document.getElementById("all-edit").innerHTML = {{$post_count_summary['edit_post'] }};
            document.getElementById("all-likes").innerHTML = {{$post_count_summary['likes'] }};
            document.getElementById("all-comments").innerHTML = {{$post_count_summary['comments'] }};
            
            // code for displaying data on the post table
            $('.input-daterange').datepicker({
            todayBtn: 'linked',
                    format: 'yyyy-mm-dd',
                    autoclose: true,
            });
            fetch_data();
            function fetch_data(start_date = '', end_date = '', select_post_type = '')
            {
            $('#editor-post').DataTable({
            processing: true,
                    serverSide: true,
                    ordering: true,
                    pageLength: 10,
                    oLanguage: {
                    "sEmptyTable": "No post found"
                    },
                    order: [],
                    "error": "this is test",
                    ajax: {
                    url: "{{ route('editor.dashboard') }}",
                            method: "GET",
                            data: {start_date: start_date, end_date: end_date, select_post_type: select_post_type }
                    },
                    columns: [
                    {
                    data: 'featured_picture',
                            render: function (data) {
                            return '<img src="../images/' + data + '" style="height: 50px; width: 80px;">'
                            }
                    },
                    {
                    data: 'post_title',
                            render: function (data) {
                            if (data.length > 19) {
                            data = data.substr(0, 20) + "...";
                            }
                            return data;
                            }
                    }
                    ,
                    {
                    data: 'body',
                            render: function (data) {
                            if (data.length > 49) {
                            data = data.substr(0, 50) + "...";
                            }
                            return data;
                            }
                    }
                    ,
                    {
                    data: 'category'
                    }
                    ,
                    {
                    data: 'status'
                    }
                    ,
                    {
                    data: 'created_at'
                    }
                    ,
                    {
                    data: 'edit',
                            orderable: false,
                            searchable: false
                    }
                    ,
                    {
                    data: 'view',
                            orderable: false,
                            searchable: false
                    }
                    ]
            });
            }
                // code to filter the post table using the filter button
            $('#filter').click(function () {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var select_post_type = $('#select-post-type option:selected').val();
            if (start_date != '' && end_date != '' && select_post_type != '')
            {
            $('#editor-post').DataTable().destroy();
            fetch_data(start_date, end_date, select_post_type);
            } else
            {
            $('#requireDate').modal('show');
            }
            });
            // code to refresh and reset the post table
            $('#refresh').click(function () {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#select-post-type').val(1);
            $('#editor-post').DataTable().destroy();
            fetch_data();
            });

            // Create post code goes here
            $('#createPostForm').submit(function (e) {
            e.preventDefault();
            $("#createPost").val("please wait...");
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            let formData = new FormData(this);
            $.ajax({
            url: "{{ route('editor.storePost') }}",
                    type: 'post',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                    if (response) {
                    setTimeout(() => {
                    $('#createPostForm')[0].reset();
                    $("#post_body").summernote("reset");
                     $("#createPost").val("Create Post");
                    document.getElementById("success-alert").style.display = "block";
                    document.getElementById("all-post").innerHTML = response.data.all_post;
                    document.getElementById("all-active").innerHTML = response.data.approved_post;
                    document.getElementById("all-pending").innerHTML = response.data.pending_post;
                    document.getElementById("all-cancelled").innerHTML = response.data.cancelled_post;
                    document.getElementById("all-edit").innerHTML = response.data.edit_post;
                    document.getElementById("all-likes").innerHTML = response.data.likes;
                    }, 1000);
                    setTimeout(() => {
                    $('#editorCreatePostModal').modal('hide');
                    closeModal();
                    document.getElementById("success-alert").style.display = "none"; $('#createPostBtn').val('Create Post');
                    $('#editor-post').DataTable().destroy();
                    fetch_data();
                    }, 3000);
                    }

                    },
                    error: function (data) {
                    // for post title field
                    if ($.trim(data.responseJSON.errors.post_title) == 0) {
                    $("#post-title-alert").addClass("d-none").removeClass("d-block");
                    $("#post_title").removeClass("input-error");
                    } else {
                    $("#post-title-alert").addClass("d-block").removeClass("d-none");
                    $("#post_title").addClass("input-error");
                    document.getElementById("post-title-alert").innerHTML = data.responseJSON.errors.post_title[0];
                    }

                    // for feature picture field
                    if ($.trim(data.responseJSON.errors.feature_picture) == 0) {
                    $("#feature-picture-alert").addClass("d-none").removeClass("d-block");
                    $("#feature_picture").removeClass("input-error");
                    } else {
                    $("#feature-picture-alert").addClass("d-block").removeClass("d-none");
                    $("#feature_picture").addClass("input-error");
                    document.getElementById("feature-picture-alert").innerHTML = data.responseJSON.errors.feature_picture[0];
                    }

                    // for post body field
                    if ($.trim(data.responseJSON.errors.post_body) == 0) {
                    $("#post-body-alert").addClass("d-none").removeClass("d-block");
                    $("#post_body").removeClass("input-error");
                    } else {
                    $("#post-body-alert").addClass("d-block").removeClass("d-none");
                    $("#post_body").addClass("input-error");
                    document.getElementById("post-body-alert").innerHTML = data.responseJSON.errors.post_body[0];
                    }

                    if ($.trim(data.responseJSON.errors.phone) == 0) {
                    $("#phone-alert").addClass("d-none").removeClass("d-block");
                    } else {
                    $("#phone-alert").addClass("d-block").removeClass("d-none");
                    $("#first_name").removeClass("input-error");
                    document.getElementById("phone-alert").innerHTML = data.responseJSON.errors.phone[0];
                    }
                    $('#createPost').val('Create Post');
                    }
            });
            });
            // code for getting of a particular post for editing
            $(document).on('click', '#edit', function () {
            $.ajax({
            url: "{{ route('editor.getPostById') }}",
                    method: "post",
                    dataType: 'json',
                    data: {
                    "_token": "{{ csrf_token() }}",
                            "id": $(this).data('id')
                    },
                    success: function (response) {
                    document.getElementById('dislay_feautred_picture').src = "#";
                    document.getElementById("post_id").value = response.data.id;
                    document.getElementById("edit_category").value = response.data.category;
                    document.getElementById('dislay_feautred_picture').src = "../images/" + response.data.featured_picture;
                    if (response){
                    $('#edit_post_body').summernote('code', response.data.body);
                    $('#edit_post_title').val(response.data.post_title);
                    $('#edit_feature_picture').val('response.data.featured_picture');
                    }
                    }
            });
            });
            // view post code goes here
            $(document).on('click', '#view', function () {
            $.ajax({
            url: "{{ route('editor.viewPost') }}",
                    method: "post",
                    dataType: 'json',
                    data: {
                    "_token": "{{ csrf_token() }}",
                            "id": $(this).data('id')
                    },
                    success: function (response) {
                    document.getElementById("view-post-title").innerHTML = response.data.post_title;
                    document.getElementById("view-featured-picture").src = "../images/" + response.data.featured_picture;
                    document.getElementById("view-post-content").innerHTML = response.data.body;
                    document.getElementById("fa-heart").innerHTML = ' ' + response.count_likes;
                    document.getElementById("fa-comment").innerHTML = ' ' + response.count_comments;
                    document.getElementById("fa-save").innerHTML = ' ' + response.count_favorites;
                    }
            });
            });
            // code for submitting an edited post
            $('#editPostForm').submit(function (e) {
            e.preventDefault();
            $("#editPostBtn").val("please wait...");
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            let formData = new FormData(this);
            $.ajax({
            url: "{{ route('editor.editPost') }}",
                    type: 'post',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                    if (response) {
                    setTimeout(() => {
                    $('#editPostForm')[0].reset();
                    $("#edit_post_body").summernote("reset");
                    document.getElementById('dislay_feautred_picture').src = "#";
                    document.getElementById("edit-success-alert").style.display = "block";
                    document.getElementById("all-post").innerHTML = response.data.all_post;
                    document.getElementById("all-active").innerHTML = response.data.approved_post;
                    document.getElementById("all-pending").innerHTML = response.data.pending_post;
                    document.getElementById("all-cancelled").innerHTML = response.data.cancelled_post;
                    document.getElementById("all-edit").innerHTML = response.data.edit_post;
                    document.getElementById("all-likes").innerHTML = response.data.likes;
                    }, 1000);
                    setTimeout(() => {
                    $('#editPostModal').modal('hide');
                    document.getElementById("edit-success-alert").style.display = "none";
                    $('#editPostBtn').val('Edit Post');
                    $('#editor-post').DataTable().destroy();
                    fetch_data();
                    }, 3000);
                    }
                    },
                    error: function (data) {
                    // for post title field
                    if ($.trim(data.responseJSON.errors.post_title) == 0) {
                    $("#edit-post-title-alert").addClass("d-none").removeClass("d-block");
                    $("#edit_post_title").removeClass("input-error");
                    } else {
                    $("#edit-post-title-alert").addClass("d-block").removeClass("d-none");
                    $("#edit_post_title").addClass("input-error");
                    document.getElementById("edit-post-title-alert").innerHTML = data.responseJSON.errors.post_title[0];
                    }

                    // for feature picture field
                    if ($.trim(data.responseJSON.errors.feature_picture) == 0) {
                    $("#edit-feature-picture-alert").addClass("d-none").removeClass("d-block");
                    $("#edit_feature_picture").removeClass("input-error");
                    } else {
                    $("#edit-feature-picture-alert").addClass("d-block").removeClass("d-none");
                    $("#edit_feature_picture").addClass("input-error");
                    document.getElementById("edit-feature-picture-alert").innerHTML = data.responseJSON.errors.feature_picture[0];
                    }

                    // for category field
                    if ($.trim(data.responseJSON.errors.watermark) == 0) {
                    $("#edit-watermark").addClass("d-none").removeClass("d-block");
                    $("#edit_watermark").removeClass("input-error");
                    } else {
                    $("#edit-watermark").addClass("d-block").removeClass("d-none");
                    $("#edit_watermark").addClass("input-error");
                    document.getElementById("edit-watermark").innerHTML = data.responseJSON.errors.watermark[0];
                    }
                    // for post body field
                    if ($.trim(data.responseJSON.errors.post_body) == 0) {
                    $("#edit-post-body-alert").addClass("d-none").removeClass("d-block");
                    $("#edit_post_body").removeClass("input-error");
                    } else {
                    $("#edit-post-body-alert").addClass("d-block").removeClass("d-none");
                    $("#edit_post_body").addClass("input-error");
                    document.getElementById("edit-post-body-alert").innerHTML = data.responseJSON.errors.post_body[0];
                    }

                    // for category field
                    if ($.trim(data.responseJSON.errors.category) == 0) {
                    $("#edit-category").addClass("d-none").removeClass("d-block");
                    $("#edit_category").removeClass("input-error");
                    } else {
                    $("#edit-category").addClass("d-block").removeClass("d-none");
                    $("#edit_category").addClass("input-error");
                    document.getElementById("edit-category").innerHTML = data.responseJSON.errors.category[0];
                    }

                    $('#createPost').val('Create Post');
                    }
            });
            });
        
            // to connect the summernote to the textarea for create post
            $('#post_body').summernote({
            placeholder: 'Enter content here..',
            });
            // to connect the summernote to the textarea for edit post
            $('#edit_post_body').summernote({
            placeholder: 'E n ter co ntent here..',
            });
            });
            // document.ready ends here

            // code to display the choosen image beneath the input file in the create post form
            function imageLoad(input){
            $("#showUploadPicture1").addClass("d-block").removeClass("d-none");
            var image1 = document.getElementById("feature_picture");
            if (image1.files && image1.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#showUploadPicture1').attr('src', e.target.result).width(300).height(200);
            };
            reader.readAsDataURL(image1.files[0]);
            }
            }

            // code to display the choosen image beneath the input file in the edit post form
            function editImageLoad(input){
            var image = document.getElementById("edit_feature_picture");
            if (image.files && image.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#dislay_feautred_picture').attr('src', e.target.result).width(300).height(200);
            };
            reader.readAsDataURL(image.files[0]);
            }
            }
            $.fn.dataTable.ext.errMode = 'throw';
        </script>

        <script>
            $(document).ready(function () {
            // code for display the data of the activity table
            $('.activity-input-daterange').datepicker({
            todayBtn: 'linked',
                    format: 'yyyy-mm-dd',
                    autoclose: true,
            });
            fetch_data();
            function fetch_data(start_date = '', end_date = '')
            {
            $('#editor-activities-table').DataTable({
            processing: true,
                    serverSide: true,
                    ordering: true,
                    pageLength: 10,
                    oLanguage: {
                    "sEmptyTable": "No activity found"
                    },
                    order: [],
                    "error": "this is test",
                    ajax: {
                    url: "{{ route('editorActivity') }}",
                            method: "GET",
                            data: {start_date: start_date, end_date: end_date}
                    },
                    columns: [
                    {
                    data: 'description'
                    }
                    ,
                    {
                    data: 'created_at'
                    }
                    ]
            });
            }

            // change password code goes here
            $('#changePassword').submit(function (e) {
            e.preventDefault();
            $("#changePassword-btn").val("please wait...");
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            let formData = new FormData(this);
            $.ajax({
            url: "{{route('editor.changePassword')}}",
                    type: 'Post',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                    $("#change-password-alert").addClass("d-none").removeClass("d-block");
                    $("#password").removeClass("input-error");
                    setTimeout(() => {
                    $('#changePassword')[0].reset();
                    document.getElementById("password-success-alert").style.display = "block";
                    }, 1000);
                    setTimeout(() => {
                    $('#passwordChange').modal('hide');
                    document.getElementById("password-success-alert").style.display = "none";
                    $("#changePassword-btn").val("Change Password");
                    }, 3000);
               
                    },
                    error: function (data) {
                    if ($.trim(data.responseJSON.errors.password) == 0) {
                    $("#change-password-alert").addClass("d-none").removeClass("d-block");
                    $("#password").removeClass("input-error");
                    } else {
                    $("#change-password-alert").addClass("d-block").removeClass("d-none");
                    $("#password").addClass("input-error");
                    document.getElementById("change-password-alert").innerHTML = data.responseJSON.errors.password[0];
                    }
                    $("#changePassword-btn").val("Change Password");
                    }
            });
            });
            // code for the filter button of the activity table
            $('#editor-filter-post').click(function () {
            var start_date = $('#editor-activity-start-date').val();
            var end_date = $('#editor-activity-end-date').val();
            if (start_date != '' && end_date != '')
            {
            $('#editor-activities-table').DataTable().destroy();
            fetch_data(start_date, end_date);
            } else
            {
            $('#requireDate').modal('show');
            }
            });
            // code for refresh button of the activity table, it will reload table and reset the input field for searching through activity table
            $('#editor-refresh-post').click(function () {
            $('#editor-activity-start-date').val('');
            $('#editor-activity-end-date').val('');
            $('#editor-activities-table').DataTable().destroy();
            fetch_data();
            });
            });
        </script>

       
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

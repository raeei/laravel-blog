@extends('layouts.app_layout')

@section('page_title')
Myblog.com | {{ ucfirst(Auth::user()->first_name) }}'s profile
@endsection

@section('datatableScript')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>  
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
@endsection

@section('content')
<div class="container-fluid user-profile mb-6" style="margin-bottom: 30px;">
    <div class="col-lg-7 container">
        <div class="row">
            <div class="col-md-5 user-profile-image-container">
                <img id="user-picture" src="../images/{{ $profile_details['user_picture']}}" alt="{{ Auth::user()->first_name }}"/>
            </div>
            <div class="col-md-7 user-profile-details-container">
                <h6><strong>First Name:</strong> {{ ucfirst(Auth::user()->first_name) }}</h6>
                <h6><strong>Last Name:</strong> {{ ucfirst(Auth::user()->last_name) }}</h6>
                <h6><strong>Phone:</strong> {{ Auth::user()->phone }}</h6>
                <h6><strong>Email:</strong> {{ Auth::user()->email }}</h6>
                <h6><strong>Joined:</strong> {{ date('F j, Y', strtotime(Auth::user()->created_at)) }} - </h6>
                <h6><strong>Comments:</strong> {{ $profile_details['comments'] }}</h6>
                <h6><strong>Likes:</strong> {{ $profile_details['likes'] }}</h6>
                <!--<h6><strong>No. of viewed Post:</strong> {{ $profile_details['saved_post'] }}</h6>-->
                <h6><strong>Saved Post:</strong> {{ $profile_details['saved_post'] }}</h6>
            </div>
        </div>
        <div class="row user-profile-detail-button-container" style="margin-bottom: 20px;">
            <div class="col-6 text-right"><button class="btn" data-toggle="modal" data-target="#userPhoto">Change Photo</button></div>
            <div class="col-6 right"><button class="btn" data-toggle="modal" data-target="#passwordChange">Change Password</button></div>
        </div>

    </div>
</div>

<div class="container-fluid user-profile " style="margin-bottom: 30px; ">
    <div class="col-lg-7 container">
        <div class="user-profile-activity-table-container">
            <h5>Newsletter</h5>
            <h6 style="margin-bottom: 30px;">Your newsletter subscription</h6>
             <input type="hidden" name="_token" id="my-token" value="{{ csrf_token() }}"/>
            <div class="">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 20px;">
                        <div class="row subscription-container" >
                            <div class="container-fluid" style="justify-content: center; text-align: center">
                                 <img src="../images/giphy.gif" height="60%" width="30%" />
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

            <div style="padding-bottom: 20px;">
                <button class="btn btn-success get-add-newsletter" data-toggle="modal" data-target="#addNewsletter">Add new newsletter subscription</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid user-profile " style="margin-bottom: 50px;">
    <div class="col-lg-7 container">
        <div class="user-profile-activity-table-container">
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
                                    <input type="date" name="start_date" id="start_date" class="form-control search-date" />
                                </div>
                            </div>
                            <div class="row">                             
                                <div class="col-lg-4 col-4 date-control text-left">
                                    <label>To :</label> 
                                </div>
                                <div class="col-lg-8 col-8 text-left">
                                    <input type="date" name="end_date" id="end_date" class="form-control search-date" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                        <table class="table table-bordered table-striped" id="profile-activities-table">
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

<div class="modal fade user-password-modal" id="addNewsletter"   data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <strong>Newsletter Subscription</strong></h5>
                <button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 20px;">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-6 " style="margin-bottom: 15px;">    
                                <div class="class" style="background: #eee; border-radius: 5px; padding: 20px 10px 20px 10px;">
                                    <div class="image-container">
                                        <img src="../images/news.jpg" alt="" width="100%" height="100%" style="border-radius: 5px;"/>
                                    </div>
                                    <div class="" style="text-align: left; margin-bottom: 25px;">
                                        <h5><strong>News</strong></h5>
                                    </div>
                                    <div class="modal-sub-container" style="text-align: left;">
                                        <button value="News" class="form-control btn btn-danger sub-unsub-btn" id="modal-news-btn"><i class="fas fa-circle-minus"></i> Unsubscribe</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-6 " style="margin-bottom: 15px;">    
                                <div class="class" style="background: #eee; border-radius: 5px; padding: 20px 10px 20px 10px;">
                                    <div class="image-container">
                                        <img src="../images/business.jpg" alt="" width="100%" height="100%" style="border-radius: 5px;"/>
                                    </div>
                                    <div class="" style="text-align: left; margin-bottom: 25px;">
                                        <h5><strong>Business</strong></h5>
                                    </div>
                                    <div class="modal-sub-container" style="text-align: left;">
                                        <button value="Business" class="form-control btn btn-danger sub-unsub-btn" id="modal-business-btn"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-6 " style="margin-bottom: 15px;">    
                                <div class="class" style="background: #eee; border-radius: 5px; padding: 20px 10px 20px 10px;">
                                    <div class="image-container">
                                        <img src="../images/entertainment.jpg" alt="" width="100%" height="100%" style="border-radius: 5px;"/>
                                    </div>
                                    <div class="" style="text-align: left; margin-bottom: 25px;">
                                        <h5><strong>Entertainment</strong></h5>
                                    </div>
                                    <div class="modal-sub-container" style="text-align: left;">
                                        <button value="Entertainment" class="form-control btn btn-danger sub-unsub-btn" id="modal-entertainment-btn"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-6 " style="margin-bottom: 15px;">    
                                <div class="class" style="background: #eee; border-radius: 5px; padding: 20px 10px 20px 10px;">
                                    <div class="image-container">
                                        <img src="../images/sport.jpg" alt="" width="100%" height="100%" style="border-radius: 5px;"/>
                                    </div>
                                    <div class="" style="text-align: left; margin-bottom: 25px;">
                                        <h5><strong>Sport</strong></h5>
                                    </div>
                                    <div class="modal-sub-container" style="text-align: left;">
                                        <button value="Sport" class="form-control btn btn-danger sub-unsub-btn" id="modal-sport-btn"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-6 " style="margin-bottom: 15px;">    
                                <div class="class" style="background: #eee; border-radius: 5px; padding: 20px 10px 20px 10px;">
                                    <div class="image-container">
                                        <img class="img" data-id="test" src="../images/technology.jpg" alt="" width="100%" height="100%" style="border-radius: 5px;"/>
                                    </div>
                                    <div class="" style="text-align: left; margin-bottom: 25px;">
                                        <h5><strong>Technology</strong></h5>
                                    </div>
                                    <div class="modal-sub-container" style="text-align: left;">
                                        <button value="Technology"  class="form-control btn btn-danger sub-unsub-btn" id="modal-technology-btn"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div> 
            </div>
            <div class="modal-footer">
                <button  class="btn" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('JavaScript')
<script src="{{asset('js/user-profile.js')}}"></script>
@endsection
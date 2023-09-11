@extends('Admin.layouts.admin_layout')


<style>
   
    .summary-container{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-evenly;
        gap: 2rem;
        width: 100%;
        max-width: 37.5rem;
        padding: 0.5rem;
        margin: 0 auto;
        box-sizing: border-box;
    }

    .summary-box{
        flex: 10%;
        text-align: center;
        padding: 15px;
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

      .input-error{
        box-shadow: 0 3px 3px red;
    }

</style>


@section('content')

<div class="container-fluid" style="margin: auto;">
    <div class="col-sm-11 summary-container" style="margin: auto;">
        <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
            <div>
                <i class="fas fa-users"></i>
                <h4 class="numbers" id="allUsers-summary">
                </h4>
                <h4 class="details text-muted">ALL USERS</h4>
            </div>        
        </div>
        <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
            <div>
                <i class="fas fa-donate"></i>
                <h4 class="numbers" id="activeUsers-summary"></h4>
                <h4 class="details text-muted">ACTIVE</h4>
            </div>    
        </div>
        <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
            <div>
                <i class="fas fas fa-cogs"></i>
                <h4 class="numbers" id="suspendedUsers-summary"></h4>
                <h4 class="details text-muted">SUSPENDED</h4>
            </div>     
        </div>
        <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
            <div>
                <i class="fas fa-user-cog"></i>
                <h4 class="numbers" id="verifiedUsers-summary"></h4>
                <h4 class="details text-muted">VERIFIED</h4>
            </div>        
        </div>
    </div>

    <div class="container-fluid table-section">
        <div class="col-lg-11 table-container" >

            <h1 class="header">ALL USERS TABLE</h1>
            <div class="row">
                <div class="col-sm-3 select-container">
                    <select id="select-user-type" class="form-control select-option">
                        <option value="1">All Users</option> 
                        <option value="2">Active</option>
                        <option value="3">Suspend</option>
                        <option value="4">Verified</option>
                        <option value="5">Referral Bonus</option>
                    </select>
                </div>

                <div class="col-sm-5 date-container input-daterange">
                    <div class="row">                             
                        <div class="col-lg-5 col-4 date-control">
                            <label>From :</label> 
                        </div>
                        <div class="col-lg-6 col-8">
                            <input type="date" name="start_date" id="all-users-start-date" class="form-control search-date" />
                        </div>
                    </div>

                    <div class="row">                             
                        <div class="col-lg-5 col-4 date-control">
                            <label>To :</label> 
                        </div>
                        <div class="col-lg-6 col-8">
                            <input type="date" name="end_date" id="all-users-end-date" class="form-control search-date" required>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row date-control" >                             
                        <div class="col-lg-6 date-control" >
                            <button class="btn btn-success filter-button" name="filter" id="all-users-filter">Find</button> 
                        </div>
                        <div class="col-lg-6">
                            <button name="refresh" id="all-users-refresh" class="btn btn-dark reload-button">Reload</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="all-users-table">
                    <thead>
                        <tr>
                            <th class="" aria-label="hidden" aria-sortin="false">Joined Date</th>
                            <th>First Name</th>
                            <th>Last name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>                

        </div>
    </div>  
</div>

<div class="modal fade  " id="userDetails"  data-keyboard="false"  data-backdrop="static" tabindex="-1" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>User Detail</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="" style="border: 1px solid #eee; margin: auto; border-radius: 10px; padding: 0; box-shadow:">
                    <div class="row" style=" padding: 20px 10px 20px 10px;">

                        <div class="col-md-5">
                            <img id="user-picture" src="" alt="..." height="250px" width="100%" style="border-radius: 10px;"/>
                        </div>
                        <div class="col-md-7">
                            <h6><strong>First Name: </strong><span id="view-first-name"></span></h6>
                            <h6><strong>Last Name: </strong><span id="view-last-name"></span></h6>
                            <h6><strong>Phone: </strong><span id="view-phone"></span></h6>
                            <h6><strong>Email: </strong><span id="view-email"></span></h6>
                            <h6><strong>Joined: </strong><span id="view-joined-date"></span></h6>
                            <h6><strong>Comments: </strong><span id="view-comment"></span></h6>
                            <h6><strong>Likes:</strong> <span id="view-like"></span></h6>
                            <h6><strong>Saved Post:</strong> <span id="view-saved-post"></span></h6>
                        </div>

                    </div>
                    <div class="row" style=" padding: 0px 10px 20px 10px;">
                        <div class="col-4"><button class="btn">Delete</button></div>
                        <div class="col-4"><button class="btn">Suspend</button></div>
                        <div class="col-4"><button class="btn"  data-toggle="modal" data-target="#editUser">Edit</button></div>
                    </div>
                </div>

                <div style="margin-top: 50px;">
                    <h5 class="text-center">Likes</h5>
                    <div class="container-fluid table-section">
                        <div class=" table-container" >
                            <div class="row">
                                <div class="col-sm-6 date-container input-daterange">
                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>From :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8">
                                            <input type="date" name="user_likes_start_date" id="user-like-start-date" class="form-control search-date" />
                                        </div>
                                    </div>
                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>To :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8 text-left">
                                            <input type="date" name="user_likes_start_date" id="user-like-end-date" class="form-control search-date" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row date-control" >                             
                                        <div class="col-lg-6 date-control" >
                                            <button class="btn btn-success filter-button" name="filter" id="user-like-filter">Find</button> 
                                        </div>
                                        <div class="col-lg-6">
                                            <button name="refresh" id="user-like-refresh" class="btn btn-dark reload-button">Reload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="user-like-table">
                                    <thead>
                                        <tr>
                                            <th class="" aria-label="hidden" aria-sortin="false">Featured Picture</th>
                                            <th>Post Title</th>
                                            <th>Like Type</th>
                                            <th>Post Date</th>
                                            <th>Like Date</th>                
                                        </tr>
                                    </thead>
                                </table>
                            </div>                
                        </div>
                    </div>              
                </div>

                <div style="margin-top: 50px;">
                    <h5 class="text-center">Favorite Posts</h5>
                    <div class="container-fluid table-section">
                        <div class=" table-container" >
                            <div class="row">
                                <div class="col-sm-6 date-container input-daterange">
                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>From :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8">
                                            <input type="date" name="start_date" id="user-favorite-start-date" class="form-control search-date" />
                                        </div>
                                    </div>
                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>To :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8 text-left">
                                            <input type="date" name="end_date" id="user-favorite-end-date" class="form-control search-date" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="row date-control" >                             
                                        <div class="col-lg-6 date-control" >
                                            <button class="btn btn-success filter-button" name="filter" id="user-favorite-filter">Find</button> 
                                        </div>
                                        <div class="col-lg-6">
                                            <button name="refresh" id="user-favorite-refresh" class="btn btn-dark reload-button">Reload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="user-favorite-table">
                                    <thead>
                                        <tr>
                                            <th class="" aria-label="hidden" aria-sortin="false">Featured Picture</th>
                                            <th>Post Title</th>
                                            <th>Post Date</th>
                                            <th>Saved Date</th>                  
                                        </tr>
                                    </thead>
                                </table>
                            </div>                
                        </div>
                    </div>
                </div>

                <div style="margin-top: 50px;">
                    <h5 class="text-center">Comments</h5>
                    <div class="container-fluid table-section">
                        <div class=" table-container" >
                            <div class="row">

                                <div class="col-sm-6 date-container input-daterange">
                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>From :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8">
                                            <input type="date" name="start_date" id="user-comment-start-date" class="form-control search-date" />
                                        </div>
                                    </div>

                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>To :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8 text-left">
                                            <input type="date" name="end_date" id="user-comment-end-date" class="form-control search-date" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="row date-control" >                             
                                        <div class="col-lg-6 date-control" >
                                            <button class="btn btn-success filter-button" name="filter" id="user-comment-filter">Find</button> 
                                        </div>
                                        <div class="col-lg-6">
                                            <button name="refresh" id="user-comment-refresh" class="btn btn-dark reload-button">Reload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="user-comment-table">
                                    <thead>
                                        <tr>
                                            <th class="" aria-label="hidden" aria-sortin="false">Featured Picture</th>
                                            <th>Post Title</th>
                                            <th>Post Date</th>
                                            <th>Comment</th>
                                            <th>Type</th>
                                            <th>Comment Date</th>                   
                                        </tr>
                                    </thead>
                                </table>
                            </div>                
                        </div>
                    </div>
                </div>

                <div style="margin-top: 50px;">
                    <h5 class="text-center">User Activities</h5>
                    <div class="container-fluid table-section">
                        <div class=" table-container" >

                            <div class="row">

                                <div class="col-sm-6 date-container input-daterange">
                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>From :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8">
                                            <input type="date" name="start_date" id="user-activity-start-date" class="form-control search-date" />
                                        </div>
                                    </div>

                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>To :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8 text-left">
                                            <input type="date" name="end_date" id="user-activity-end-date" class="form-control search-date" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="row date-control" >                             
                                        <div class="col-lg-6 date-control" >
                                            <button class="btn btn-success filter-button" name="filter" id="user-activity-filter">Find</button> 
                                        </div>
                                        <div class="col-lg-6">
                                            <button name="refresh" id="user-activity-refresh" class="btn btn-dark reload-button">Reload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="user-activity-table">
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
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    document.getElementById("allUsers-summary").innerHTML = {{$user_summary['all_users'] }};
    document.getElementById("activeUsers-summary").innerHTML = {{$user_summary['active_users'] }};
    document.getElementById("suspendedUsers-summary").innerHTML = {{$user_summary['cancelled_users'] }};
    document.getElementById("verifiedUsers-summary").innerHTML = {{$user_summary['verified_users'] }};
    });</script>

<script>
    $(document).ready(function () {
    $('.input-daterange').datepicker({
    todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true,
    });
    fetch_all_users();
    function fetch_all_users(start_date = '', end_date = '', select_user_type = ''){
        $('#all-users-table').DataTable().destroy();
    $('#all-users-table').DataTable({
    processing: true,
            serverSide: true,
            ordering: true,
            pageLength: 25,
            oLanguage: {
            "sEmptyTable": "No users available"
            },
            order: [],
            "error": "this is test",
            ajax: {
            url: "{{ route('admin.users') }}",
                    method: "GET",
                    data: {start_date: start_date, end_date: end_date, select_user_type: select_user_type}
            },
            columns: [
            {
            data: 'created_at'
            },
            {
            data: 'first_name'
            }
            ,
            {
            data: 'last_name'
            }
            ,
            {
            data: 'phone'
            }
            ,
            {
            data: 'email'
            }
            ,
            {
            data: 'user_status'
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
    $('#all-users-filter').click(function () {
    var start_date = $('#all-users-start-date').val();
    var end_date = $('#all-users-end-date').val();
    var select_user_type = $('#select-user-type').val();
    if (start_date != '' && end_date != '' && select_user_type != '')
    {
    $('#all-users-table').DataTable().destroy();
    fetch_all_users(start_date, end_date, select_user_type);
    } else
    {
    $('#requireDate').modal('show');
    }
    });
    $('#all-users-refresh').click(function () {
    $('#all-users-start-date').val('');
    $('#all-users-end-date').val('');
    $('#all-users-table').DataTable().destroy();
    $('#select-user-type').val(1);
    fetch_all_users();
    });
    }


    // get user id for editing users code goes here
    $(document).on('click', '#edit', function () {
    $.ajax({
    url: "{{ route('admin.editGetUserId') }}",
            method: "post",
            dataType: 'json',
            data: {
            "_token": "{{ csrf_token() }}",
                    "id": $(this).data('id')

            },
            success: function (response) {
            $('#user-first-name').val(response.data.first_name);
            $('#user-last-name').val(response.data.last_name);
            $('#user-phone').val(response.data.phone);
            $('#user-email').val(response.data.email);
            $('#password').val(response.data.password);
            $('#id').val(response.data.id);
            }
    });
    });
    // the code for viewing user details in a modal
    $(document).on('click', '#viewUser', function () {
        var id = $(this).data('id');
    $.ajax({
    url: "{{ route('admin.viewUserDetails') }}",
            method: "post",
            dataType: 'json',
            data: {
            "_token": "{{ csrf_token() }}",
                    "id": $(this).data('id')
            },
            success: function (response) {
            if (response){
            document.getElementById("user-picture").src = "../images/" + response.userInfo.picture;
            document.getElementById("view-first-name").innerHTML = response.userInfo.first_name;
            document.getElementById("view-last-name").innerHTML = response.userInfo.last_name;
            document.getElementById("view-phone").innerHTML = response.userInfo.phone;
            document.getElementById("view-email").innerHTML = response.userInfo.email;
            document.getElementById("view-joined-date").innerHTML = response.userInfo.created_at;
            document.getElementById("view-comment").innerHTML = response.user_comment;
            document.getElementById("view-like").innerHTML = response.user_like;
            document.getElementById("view-saved-post").innerHTML = response.user_favorite;
            }

            }
    });
    
    // code for retrieving a particular user's likes table   
    fetch_user_likes();
    function fetch_user_likes(start_date = '', end_date = ''){
         var url = '{{ route('userLikes',":id") }}';
    url = url.replace(':id', id);
    $('#user-like-table').DataTable().destroy();
    $('#user-like-table').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            pageLength: 10,
            oLanguage: {
            "sEmptyTable": "No likes found"
            },
            order: [],
            "error": "",
            ajax: {
            url: url,
                    method: "GET",
                    data: {start_date: start_date, end_date: end_date}
            },
            columns: [
            {
            data: 'featured_picture',
                    render: function (data) {
                    return '<img src="../images/' + data + '" style="height: 100px; width: 100px;">'
                    }
            }
            ,
            {
            data: 'post_title'
            }
            ,
            {
            data: 'like_type'
            }
            ,
            {
            data: 'post_created_at'
            }
            ,
            {
            data: 'likes_created_at'
            }
            ]
    });
    }
    $('#user-like-filter').click(function () {
    var start_date = $('#user-like-start-date').val();
    var end_date = $('#user-like-end-date').val();
    if (start_date != '' && end_date != '')
    {
    $('#user-like-table').DataTable().destroy();
    fetch_user_likes(start_date, end_date);
    } else
    {
    $('#requireDate').modal('show');
    }
    });
    $('#user-like-refresh').click(function () {
    $('#user-like-start-date').val('');
    $('#user-like-end-date').val('');
    $('#user-like-table').DataTable().destroy();
    fetch_user_likes();
    });
    

    //code for retrieving a particular user's favorite table    
    fetch_user_favorite();
    function fetch_user_favorite(start_date = '', end_date = ''){
    $('#user-favorite-table').DataTable().destroy();
    var url = '{{ route('userFavorite',":id") }}';
    url = url.replace(':id', id);
    $('#user-favorite-table').DataTable({
    processing: true,
            serverSide: true,
            ordering: true,
            pageLength: 10,
            oLanguage: {
            "sEmptyTable": "No favorite found"
            },
            order: [],
            "error": "",
            ajax: {
            url: url,
                    method: "GET",
                    data: {start_date: start_date, end_date: end_date}
            },
             columns: [
            {
            data: 'featured_picture',
                    render: function (data) {
                    return '<img src="../images/' + data + '" style="height: 100px; width: 100px;">'
                    }
            }
            ,
            {
            data: 'post_title'
            }
            ,
            {
            data: 'post_created_at'
            }
            ,
            {
            data: 'favorites_created_at'
            }
            ]
    });
    }
    $('#user-favorite-filter').click(function () {
    var start_date = $('#user-favorite-start-date').val();
    var end_date = $('#user-favorite-end-date').val();
    if (start_date != '' && end_date != '')
    {
    $('#user-favorite-table').DataTable().destroy();
    fetch_user_favorite(start_date, end_date);
    } else
    {
    $('#requireDate').modal('show');
    }
    });
    $('#user-favorite-refresh').click(function () {
    $('#user-favorite-start-date').val('');
    $('#user-favorite-end-date').val('');
    $('#user-favorite-table').DataTable().destroy();
    fetch_user_favorite();
    });
    
    //code for retrieving a particular user's comment table 
    var url = '{{ route('userComment',":id") }}';
    url = url.replace(':id', id);
    fetch_user_comment();
    function fetch_user_comment(start_date = '', end_date = ''){
    $('#user-comment-table').DataTable().destroy();
    $('#user-comment-table').DataTable({
    processing: true,
            serverSide: true,
            ordering: true,
            pageLength: 10,
            oLanguage: {
            "sEmptyTable": "No comment found"
            },
            order: [],
            "error": "",
            ajax: {
            url: url,
                    method: "GET",
                    data: {start_date: start_date, end_date: end_date}
            },
             columns: [
            {
            data: 'featured_picture',
                    render: function (data) {
                    return '<img src="../images/' + data + '" style="height: 100px; width: 100px;">'
                    }
            }
            ,
            {
            data: 'post_created_at'
            }
            ,
            {
            data: 'post_title'
            }
            ,
            {
            data: 'comment_body'
            }
            ,
            {
            data: 'comment_type'
            }
            ,
            {
            data: 'comment_created_at'
            }
            ]
            
    });
    }
    $('#user-comment-filter').click(function () {
    var start_date = $('#user-comment-start-date').val();
    var end_date = $('#user-comment-end-date').val();
    if (start_date != '' && end_date != '')
    {
    $('#user-comment-table').DataTable().destroy();
    fetch_user_comment(start_date, end_date);
    } else
    {
    $('#requireDate').modal('show');
    }
    });
    $('#user-comment-refresh').click(function () {
    $('#user-comment-start-date').val('');
    $('#user-comment-end-date').val('');
    $('#user-comment-table').DataTable().destroy();
    fetch_user_comment();
    });
    
    //code for retrieving a particular user's activity table    
    fetch_user_activity();
    function fetch_user_activity(start_date = '', end_date = ''){
    $('#user-activity-table').DataTable().destroy();
    var url = '{{ route('userActivity',":id") }}';
    url = url.replace(':id', id);
    $('#user-activity-table').DataTable({
    processing: true,
            serverSide: true,
            ordering: true,
            pageLength: 10,
            oLanguage: {
            "sEmptyTable": "No activity found"
            },
            order: [],
            "error": "",
            ajax: {
            url: url,
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
    $('#user-activity-filter').click(function () {
    var start_date = $('#user-activity-start-date').val();
    var end_date = $('#user-activity-end-date').val();
    if (start_date != '' && end_date != '')
    {
    $('#user-activity-table').DataTable().destroy();
    fetch_user_activity(start_date, end_date);
    } else
    {
    $('#requireDate').modal('show');
    }
    });
    $('#user-activity-refresh').click(function () {
    $('#user-activity-start-date').val('');
    $('#user-activity-end-date').val('');
    $('#user-activity-table').DataTable().destroy();
    fetch_user_activity();
    });
    
    });
    <!-- the code for the user modal ends here -->
    
    <!-- Update user details code goes here --> 
    $(document).on('click', '#update', function () {
    $("#update").val("please wait...");
    $.ajax({
    url: "{{ route('admin.update') }}",
            type: 'post',
            dataType: 'json',
            data: $('#updateForm').serialize(),
            success: function (response) {
            if (response) {

            setTimeout(() => {
            $('#updateForm')[0].reset();
            $("#phone-alert").removeClass("d-block");
            $("#phone-alert").addClass("d-none");
            document.getElementById("success-alert").style.display = "block";
            $('#all_users_table').DataTable().destroy();
            fetch_data();
            $("#update").val("save changes");
            }, 1000);
            setTimeout(() => {

            $('#createAdmin').modal('hide');
            document.getElementById("success-alert").style.display = "none";
            }, 3000);
            }
            },
            error: function (data) {
            $("#update").val("save changes");
            if ($.trim(data.responseJSON.errors.first_name) == 0) {
            $("#first-name-alert").addClass("d-none").removeClass("d-block");
            $("#first_name").removeClass("input-error");
            } else {
            $("#first-name-alert").addClass("d-block").removeClass("d-none");
            $("#first_name").addClass("input-error");
            document.getElementById("first-name-alert").innerHTML = data.responseJSON.errors.first_name[0];
            }

            if ($.trim(data.responseJSON.errors.phone) == 0) {
            $("#phone-alert").addClass("d-none").removeClass("d-block");
            $("#first_name").removeClass("input-error");
            } else {
            $("#phone-alert").addClass("d-block").removeClass("d-none");
            $("#first_name").addClass("input-error");
            document.getElementById("phone-alert").innerHTML = data.responseJSON.errors.phone[0];
            }

            }
    });
    });
    });
    $.fn.dataTable.ext.errMode = 'throw';
        </script>


<div class="modal fade " id="editUser"   data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <strong>Edit User</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" method="get">
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="id">
                    <div style="margin-bottom: 15px;">
                        <label for="first_name">First Name</label>
                        <input id="user-first-name" value="" type="text" class="form-control " name="first_name" required placeholder="First Name"/>
                        <span class="d-none text-danger" id="user-first-name-alert">
                        </span>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="last_name">Last Name</label>
                        <input id="user-last-name"  type="text" class="form-control" name="last_name" value="" required placeholder="last Name"/>
                        <span class="d-none text-danger" id="user-last-name-alert">
                        </span>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="phone">Phone</label>
                        <input id="user-phone" disabled type="tel" class="form-control" name="phone" required placeholder="Phone"/>
                        <span class="d-none text-danger" id="phone-alert">
                        </span>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="phone">Email</label>
                        <input id="user-email" disabled type="tel" class="form-control" name="email" required placeholder="Email"/>
                        <span class="d-none text-danger" id="user-email-alert">
                        </span>
                    </div>
                    <div class="text-center">
                        <p class="" style="display: none; color: green; font-size: 16px; padding-top: 10px" id="success-alert"><strong>Information updated successfully</strong></p>
                    </div>
                </form>     
            </div>


            <div class="modal-footer">
                <input type="submit" id="update" class="btn btn-primary" value="Save changes"/>
            </div>

        </div>
    </div>
</div>


@endsection
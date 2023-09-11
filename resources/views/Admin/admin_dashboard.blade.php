@extends('Admin.layouts.admin_layout')

<style>
    .ok{
        margin-top: 100px;

    }
    .post-side{
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

    .row2{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-evenly;
        gap: 1rem;
        width: 100%;
        max-width: 37.5rem;
    }

    .post{
        flex: 33%;
    }
    @media only screen and (max-width: 1199px){
        ..post-side{

            gap: 1rem;
        }

        .post{
            flex: 33% !important;
        }


    }

    @media only screen and  (max-width: 991px){
        ..post-side{
            grid-template-columns: repeat(2, 1fr) !important;
        }

        .post{
            flex: 33% !important;
        }
    }

    @media only screen and  (max-width: 575px){
        .post-side{
            border-right: none;
        }
        /* .post{
            flex: 10% !important;
        }   */
    }

    .post2{
        background-image: url('../images/image1.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

</style>


@section('content')
<div class="container-fluid">
    <div class="" style="margin: auto;">
        <div class="col-md-9 col-sm-12 post-side" style="">
            <div class=" post" style="background: #EEE; border: 0.5px solid  #eee">
                <a href="{{ route('admin.users')}}" style="text-decoration: none;">

                    <div class="p-5" style="text-align: center;">
                        <i class="fas fa-users" style="font-size: 45px;"></i>
                        <?php
                        $all_user_data = DB::table('users')
                                ->count()
                        ?>

                        <h6 style="font-size: 14px ; color: #111;">All Users ({{($all_user_data)}})</h6>
                        <h6 style="font-size: 14px ; color: #111;">Verified Users (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Unverified Users (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Suspended Users (5)</h6>
                    </div>

                </a>
            </div>

            <div class=" post" style="background: #EEE; border: 0.5px solid  #eee">
                <a href="{{ route('admin.all_posts')}}" style="text-decoration: none;">      
                    <div class="p-5" style="text-align: center;">
                        <i class="fa-solid fa-note-sticky" style="font-size: 45px;"></i>

                        <h6 style="font-size: 14px ; color: #111;">All Posts (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Approved Post (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Pending Post (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Suspended Post(5)</h6>
                    </div>      
                </a>
            </div>

            <div class=" post" style="background: #EEE; border: 0.5px solid  #eee">
                <a href="{{ route('admin.all_comments')}}" style="text-decoration: none;">      
                    <div class="p-5" style="text-align: center;">
                        <i class="fa-solid fa-comment" style="font-size: 45px;"></i>
                        <h6 style="font-size: 14px ; color: #111;">All Comments (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Approved Comments (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Pending Comments (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Suspended Comments(5)</h6>
                    </div>      
                </a>
            </div>

            <div class=" post" style="background: #EEE; border: 0.5px solid  #eee">
                <a href="{{ route('admin.all_likes')}}" style="text-decoration: none;">      
                    <div class="p-5" style="text-align: center;">
                        <i class="fa-solid fa-heart" style="font-size: 45px;"></i>
                        <h6 style="font-size: 14px ; color: #111;">All Likes (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Likes on Post (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Likes on Comment (5)</h6>
                    </div>      
                </a>
            </div>

            <div class=" post" style="background: #EEE; border: 0.5px solid  #eee">
                <a href="{{ route('admin.all_advert')}}" style="text-decoration: none;">      
                    <div class="p-5" style="text-align: center;">
                        <i class="fa-solid fa-rectangle-ad" style="font-size: 45px;"></i>
                        <h6 style="font-size: 14px ; color: #111;">All Adverts (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Running Adverts  (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Pending Adverts (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Expired Advert(5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Cancelled Advert(5)</h6>
                    </div>      
                </a>
            </div>

            <div class=" post" style="background: #EEE; border: 0.5px solid  #eee">
                <a href="{{ route('admin.all_admin')}}" style="text-decoration: none;">      
                    <div class="p-5" style="text-align: center;">
                        <i class="fa-solid fa-gears" style="font-size: 45px;"></i>
                        <h6 style="font-size: 14px ; color: #111;">All Admin (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Moderator  (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Authors (5)</h6>
                        <h6 style="font-size: 14px ; color: #111;">Suspended Admin(5)</h6>
                    </div>      
                </a>
            </div>

            <div class="container-fluid table-section">
            <div class="table-container" >

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
</div>
<script>
    $(document).ready(function () {
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
                    url: "{{ route('admin.dashboard') }}",
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
                url: "{{route('admin.changePassword')}}",
                type: 'Post',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {

                    if (response) {
                         $('#profile-activities-table').DataTable().destroy();
                         fetch_data();
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
                    }
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
        
        $('#filter').click(function () {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            if (start_date != '' && end_date != '')
            {
            $('#editor-activities-table').DataTable().destroy();
            fetch_data(start_date, end_date);
            } else
            {
            alert('Both Date is required');
            }
            });
            $('#refresh').click(function () {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#editor-activities-table').DataTable().destroy();
            fetch_data();
            });
    });
</script>
@endsection
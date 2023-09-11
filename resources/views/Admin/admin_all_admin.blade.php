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


</style>


@section('content')


<div class="container-fluid" style="margin: auto;">
    <div class="col-sm-11 summary-container" style="margin: auto;">


        <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
            <div>
                <i class="fas fa-users"></i>
                <h4 class="numbers" id="sum-all-admin"></h4>
                <h4 class="details text-muted">ALL ADMINS</h4>
            </div>        
        </div>

        <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
            <div>
                <i class="fas fa-donate"></i>
                <h4 class="numbers" id="sum-admin"></h4>
                <h4 class="details text-muted">ADMINS</h4>
            </div>    
        </div>

        <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
            <div>
                <i class="fas fas fa-cogs"></i>
                <h4 class="numbers" id="sum-editor"></h4>
                <h4 class="details text-muted">EDITORS</h4>
            </div>     
        </div>

        <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
            <div>
                <i class="fas fa-user-cog"></i>
                <h4 class="numbers" id="sum-all-suspended-admin"></h4>
                <h4 class="details text-muted">SUSPENDED ADMIN</h4>
            </div>        
        </div>
    </div>
    <div class="container-fluid table-section">
        <div class="col-lg-11 table-container" >

            <h1 class="header">ALL ADMIN TABLE</h1>
            <div class="text-center p-3"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAdmin">Create ADMIN</button></div>
           
            <div class="row">
                <div class="col-sm-3 select-container">
                    <select id="transact" class="form-control select-option">
                        <option value="1">All Admin</option> 
                        <option value="2">Moderator</option>
                        <option value="3">Author</option>
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
                 <table class="table table-bordered table-striped" id="all-post-table">
                    <thead>
                        <tr>
                            <th class="" aria-label="hidden" aria-sortin="false">Profile Picture</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>                

        </div>
    </div>  
</div>

<div class="modal fade " id="createAdmin"   data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <strong>Add Admin</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="create-admin" enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="id" id="id">
                    <div style="margin-bottom: 15px;">
                        <label for="first_name">First Name</label>
                        <input id="first_name" value="{{ old('first_name') }}" type="text" class="form-control" name="first_name" required placeholder="First Name"/>

                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="last_name">Last Name</label>
                        <input id="last_name"  type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required placeholder="last Name"/>

                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="phone">Phone</label>
                        <input id="phone"  type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required placeholder="Phone"/>

                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="email">Email</label>
                        <input id="email" value="{{ old('email') }}" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email"/>

                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="picture">Picture</label>
                        <input id="view-admin-picture" name="picture" class="form-control" type="file" required />

                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="role">Select Role</label>
                        <select id="role" name="role" class="form-control select-option" required>
                            <option value="">None</option>
                            <option value="editor">Editor</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="password">Password</label>
                        <input id="password" value="{{ old('password') }}" class="form-control" type="passsword" name="password" required/>

                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="confirm_password">Confirm Password</label>
                        <input id="password-confirm" value="{{ old('password-confirm') }}" type="password" class="form-control" name="password_confirmation" type="password"/>
                    </div>
                     <div class="text-center">
                        <p class="" style="display: none; color: green; font-size: 16px; padding-top: 10px" id="success-alert"><strong>Information updated successfully</strong></p>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="button"  class="btn btn-secondary" data-dismiss="modal" value="Close"/>
                <input type="submit" id="createAdmin" class="btn btn-primary" value="Create Admin"/>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade  " id="adminDetails"  data-keyboard="false"  data-backdrop="static" tabindex="-1" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <strong>View Admin</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="" style="border: 1px solid #eee; margin: auto; border-radius: 10px; padding: 0; box-shadow:">
                    <div class="row" style=" padding: 20px 10px 20px 10px;">
                        <div class="col-md-5">
                            <img id="view-admin-picture" src="" alt="..." height="250px" width="100%" style="border-radius: 10px;"/>
                        </div>
                        <div class="col-md-7">
                            <h6><strong>First Name: </strong><span id="view-admin-first-name"></span></h6>
                            <h6><strong>Last Name: </strong><span id="view-admin-last-name"></span></h6>
                            <h6><strong>Phone: </strong><span id="view-admin-phone"></span></h6>
                            <h6><strong>Email: </strong><span id="view-admin-email"></span></h6>
                            <h6><strong>Joined: </strong><span id="view-admin-joined-date"></span></h6>
                            <h6><strong>Role: </strong><span id="view-admin-role"></span></h6>
                            <h6><strong>Total Post: </strong><span id="view-admin-total-post"></span></h6></h6>
                            <h6><strong>Approved Post: </strong><span id="view-admin-approved-post"></span></h6></h6>
                            <h6><strong>Pending Post: </strong><span id="view-admin-pending-post"></span></h6></h6>
                            <h6><strong>Asked To Edit: </strong><span id="view-admin-edit-post"></span></h6></h6>
                            <h6><strong>Cancelled Post: </strong><span id="view-admin-cancelled-post"></span></h6></h6>
                        </div>
                    </div>
                    <div class="row" style=" padding: 0px 10px 20px 10px;">
                        <div class="col-4"><button class="btn">Delete</button></div>
                        <div class="col-4"><button class="btn">Suspend</button></div>
                        <div class="col-4"><button class="btn">Edit</button></div>
                    </div>
                </div>

                <div style="margin-top: 50px;">
                    <h5 class="text-center">Activites</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="all_users_table">
                            <thead>
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
                            </thead>
                        </table>
                    </div>                

                </div>
                
                <div style="margin-top: 50px;">
                    <h5 class="text-center">Admin Activities</h5>
                    <div class="container-fluid table-section">
                        <div class=" table-container" >

                            <div class="row">

                                <div class="col-sm-6 date-container input-daterange">
                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>From :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8">
                                            <input type="date" name="start_date" id="admin-activity-start-date" class="form-control search-date" />
                                        </div>
                                    </div>

                                    <div class="row">                             
                                        <div class="col-lg-4 col-4 date-control text-left">
                                            <label>To :</label> 
                                        </div>
                                        <div class="col-lg-8 col-8 text-left">
                                            <input type="date" name="end_date" id="admin-activity-end-date" class="form-control search-date" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="row date-control" >                             
                                        <div class="col-lg-6 date-control" >
                                            <button class="btn btn-success filter-button" name="filter" id="admin-activity-filter">Find</button> 
                                        </div>
                                        <div class="col-lg-6">
                                            <button name="refresh" id="admin-activity-refresh" class="btn btn-dark reload-button">Reload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="admin-activity-table">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("sum-all-admin").innerHTML = {{ $sum_all_admin }};
            document.getElementById("sum-admin").innerHTML = {{ $sum_all_adminitrator }};
            document.getElementById("sum-editor").innerHTML = {{ $sum_all_editor }};
            document.getElementById("sum-all-suspended-admin").innerHTML = {{ $sum_all_suspended_admin }};
</script>

<script>
    $(document).ready(function () {
 $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
        fetch_data();
        function fetch_data(start_date = '', end_date = ''){
    $('#all-post-table').DataTable({
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
            url: "{{ route('admin.all_admin') }}",
                    method: "GET",
                    data: {start_date: start_date, end_date: end_date}
            },
            columns: [
            {
            data: 'picture',
                    render: function (data) {
                    return '<img src="../images/' + data + '" style="height: 50px; width: 80px;">'
                    }
            }
            ,
            {
            data: 'first_name'
            },
            {
            data: 'last_name'
            }
            ,
            {
            data: 'phone'
            }
            ,
            {
            data: 'role'
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
 $('#filter').click(function () {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            if (start_date != '' && end_date != '')
            {
                $('#all-post-table').DataTable().destroy();
                fetch_data(start_date, end_date);
            } else
            {
                alert('Both Date is required');
            }
        });
        $('#refresh').click(function () {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#all-post-table').DataTable().destroy();
            fetch_data();
        });

  // Create post code goes here
        $('#create-admin').submit(function (e) {
            e.preventDefault();
            console.log('button working');
            $("#createAdmin").val("please wait...");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.add_admin') }}",
                type: 'post',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {

                    if (response) {
                        console.log(response);
                        setTimeout(() => {
                            $('#all-post-table')[0].reset();
                            document.getElementById("success-alert").style.display = "block";
                        }, 1000);
                        setTimeout(() => {
                            $('#createAdmin').modal('hide');
                            document.getElementById("success-alert").style.display = "none";
                            $('#createAdmin').val('Create Admin');
                            $('#all-post-table').DataTable().destroy();
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
                }
            });

        });

    // view user code goes here
    $(document).on('click', '#view', function () {
          var id = $(this).data('id');
          var role = $(this).data('role');
    $.ajax({
            url: "{{ route('admin.admin_details') }}",
            method: "post",
            dataType: 'json',
            data: {
            "_token": "{{ csrf_token() }}",
                    "id": $(this).data('id'),
                    "role": $(this).data('role')
            },
            success: function (response) {
               if(response){
                console.log(response);
            document.getElementById("view-admin-picture").src = "../images/" + response.admin_details[0].picture;
            document.getElementById("view-admin-first-name").innerHTML = response.admin_details[0].first_name;
            document.getElementById("view-admin-last-name").innerHTML = response.admin_details[0].last_name;
            document.getElementById("view-admin-phone").innerHTML = response.admin_details[0].phone;
            document.getElementById("view-admin-email").innerHTML = response.admin_details[0].email;
            document.getElementById("view-admin-joined-date").innerHTML = response.admin_details[0].created_at;
            document.getElementById("view-admin-role").innerHTML = response.admin_details[0].role;
            document.getElementById("view-admin-total-post").innerHTML = response.getAdminCountPost.count_admin_all_post;
            document.getElementById("view-admin-approved-post").innerHTML = response.getAdminCountPost.count_admin_approved_post;
             document.getElementById("view-admin-pending-post").innerHTML = response.getAdminCountPost.count_admin_pending_post;
            document.getElementById("view-admin-edit-post").innerHTML = response.getAdminCountPost.count_admin_edit_post;
            document.getElementById("view-admin-cancelled-post").innerHTML = response.getAdminCountPost.count_admin_cancelled_post;
            }
            
            }
    });
    
    fetch_admin_activity();
    function fetch_admin_activity(start_date = '', end_date = ''){
    $('#admin-activity-table').DataTable().destroy();
    var url = '{{ route('userActivity',":id") }}';
    url = url.replace(':id', id);
    $('#admin-activity-table').DataTable({
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
    $('#admin-activity-filter').click(function () {
    var start_date = $('#admin-activity-start-date').val();
    var end_date = $('#admin-activity-end-date').val();
    if (start_date != '' && end_date != '')
    {
    $('#admin-activity-table').DataTable().destroy();
    fetch_admin_activity(start_date, end_date);
    } else
    {
    $('#requireDate').modal('show');
    }
    });
    $('#admin-activity-refresh').click(function () {
    $('#admin-activity-start-date').val('');
    $('#admin-activity-end-date').val('');
    $('#admin-activity-table').DataTable().destroy();
    fetch_admin_activity();
    });
    
    });
       
        
        
    });
    $.fn.dataTable.ext.errMode = 'throw';

</script>


<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus');
    });
</script>

@endsection
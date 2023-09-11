@extends('Admin.layouts.admin_layout')


<style>
    .summary-post-container{
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

    .summary-post{
        flex: 10%;
        text-align: center;
        padding: 15px;
    }
    @media only screen and (max-width: 1199px){
        .summary-post-container{

            gap: 1rem;
        }

        .summary-post{
            flex: 33% !important;
        }


    }

    @media only screen and  (max-width: 991px){
        .summary-post-container{
            grid-template-columns: repeat(2, 1fr) !important;
        }

        .summary-post{
            flex: 35% !important;
        }
    }







</style>


@section('content')


<div class="container-fluid" style="margin: auto;">
    <div class="col-sm-11 summary-post-container" style="margin: auto;">


        <div class="summary-post" style="background: #EEE; border: 0.5px solid  #eee">
            <div class="p-2">
                <i class="fas fa-users"></i>
                <h4 class="numbers" id="count-all-post"></h4>
                <h4 class="details text-muted">ALL POSTS</h4>
            </div>        
        </div>

        <div class="summary-post" style="background: #EEE; border: 0.5px solid  #eee">    
            <div class="p-2">
                <i class="fas fa-donate"></i>
                <h4 class="numbers"id="count-approved-post"></h4>
                <h4 class="details text-muted">APPROVED POSTS</h4>
            </div>   
        </div>

        <div class="summary-post" style="background: #EEE; border: 0.5px solid  #eee">     
            <div class="p-2">
                <i class="fas fas fa-cogs"></i>
                <h4 class="numbers" id="count-pending-post"></h4>
                <h4 class="details text-muted">PENDING POSTS</h4>
            </div>        
        </div>

        <div class="summary-post" style="background: #EEE; border: 0.5px solid  #eee">     
            <div class="p-2">
                <i class="fas fa-user-cog"></i>
                <h4 class="numbers" id="count-suspended-post"></h4>
                <h4 class="details text-muted">SUSPENDED POST</h4>
            </div>    
        </div>

    </div>

    <div class="container-fluid table-section">
        <div class="col-lg-11 table-container" >

            <h1 class="header">ALL POSTS TABLE</h1>
            <div class="row">
                <div class="col-sm-3 select-container">
                    <select id="all-post-type" class="form-control select-option">
                        <option value="1">All Post</option> 
                        <option value="2">Approved Post</option>
                        <option value="3">Pending Post</option>
                        <option value="4">Asked To Edit</option>
                        <option value="5">Suspended Post</option>
                    </select>
                </div>

                <div class="col-sm-5 date-container input-daterange">
                    <div class="row">                             
                        <div class="col-lg-5 col-4 date-control">
                            <label>From :</label> 
                        </div>
                        <div class="col-lg-6 col-8">

                            <input type="date" name="start_date" id="all-post-start-date" class="form-control search-date" />
                        </div>
                    </div>

                    <div class="row">                             
                        <div class="col-lg-5 col-4 date-control">
                            <label>To :</label> 
                        </div>
                        <div class="col-lg-6 col-8">
                            <input type="date" name="end_date" id="all-post-end-date" class="form-control search-date" required>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row date-control" >                             
                        <div class="col-lg-6 date-control" >
                            <button class="btn btn-success filter-button" name="filter" id="all-post-filter">Find</button> 
                        </div>
                        <div class="col-lg-6">
                            <button name="refresh" id="all-post-refresh" class="btn btn-dark reload-button">Reload</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="all-post-table">
                    <thead>
                        <tr>
                            <th class="" aria-label="hidden" aria-sortin="false">Featured Picture</th>
                            <th>Post Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Post Date</th>
                            <th>Approved By</th>
                            <th>Approved Date</th>
                            <th>Edited Date</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>                
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
                    <div class="row">
                        <div class="col-6">
                            
                        </div>
                        
                        <div class="col-6 text-right">
                            <span style="">
                        <i class="fas fa-heart fa-lg" id="fa-heart" style="margin-right: 20px;  cursor: pointer;"></i> 
                        <i class="fas fa-comment fa-lg" id="fa-comment" style="margin-right: 20px;  cursor: pointer;"></i>
                        <i class="fa-solid fa-bookmark fa-lg" id="fa-save" style="margin-right: 20px;  cursor: pointer;"></i>
                         <i class="fa-solid fa-eye fa-lg" id="fa-eye"></i>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <form id="actionOnPost" action="javascript:void(0)">
                @csrf
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="id" id="id">
                    <select id="status" name="status" class="form-control select-option" required>
                        <option value="">Select Action</option>
                        <option value="Active">Approve Post</option>
                        <option value="Edit">Ask To Edit</option>
                        <option value="Cancel">Cancel Post</option>
                    </select>
                    <input type="submit" id="post-action" class="btn btn-primary" value="Take Action"/>
                </div>
                <div class="text-center">
                    <p class="" style="display: none; color: green; font-size: 16px; padding-top: 10px" id="success-alert">
                        <strong>Information updated successfully</strong>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).ready(function () {
    document.getElementById("count-all-post").innerHTML = {{$post_count_summary['all_post'] }};
    document.getElementById("count-approved-post").innerHTML = {{$post_count_summary['approved_post'] }};
    document.getElementById("count-pending-post").innerHTML = {{$post_count_summary['pending_post'] }};
    document.getElementById("count-suspended-post").innerHTML = {{$post_count_summary['cancelled_post'] }};
});
</script>

<script>
    $(document).ready(function () {
 $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
        fetch_all_post();
        function fetch_all_post(start_date = '', end_date = '', all_post_type = '') {
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
            url: "{{ route('admin.all_posts') }}",
                    method: "GET",
                    data: {start_date: start_date, end_date: end_date, all_post_type: all_post_type}
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
                    if (data.length > 59) {
                    data = data.substr(0, 60) + "...";
                    }
                    return data;
                    }
            }
            ,
            {
            data: 'first_name'
            },
            {
            data: 'category'
            }
            ,
            {
            data: 'status'
            }
            ,
            {
            data: 'post_created_at'
            }
            ,
            {
            data: 'approved_by'
            }
            ,
            {
            data: 'approved_at'
            }
            ,
            {
            data: 'edited_at'
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
   $('#all-post-filter').click(function () {
            var start_date = $('#all-post-start-date').val();
            var end_date = $('#all-post-end-date').val();
            var all_post_type = $('#all-post-type').val();
            if (start_date != '' && end_date != '' && all_post_type != '')
            {
                $('#all-post-table').DataTable().destroy();
                fetch_all_post(start_date, end_date, all_post_type);
            } else
            {
                $('#requireDate').modal('show');
            }
        });
        $('#all-post-refresh').click(function () {
            $('#all-post-start-date').val('');
            $('#all-post-end-date').val('');
            $('#all-post-type').val(1);
            $('#all-post-table').DataTable().destroy();
            fetch_all_post();
        });


    //  post action code goes here
    $('#actionOnPost').submit(function (e) {
    $("#post-action").val("please wait...");
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    let formData = new FormData(this);
    $.ajax({
    url: "{{ route('admin.postAction') }}",
            method: "post",
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {

            if (response) {
            setTimeout(() => {
            $('#actionOnPost')[0].reset();
            document.getElementById("success-alert").style.display = "block";
            }, 1000);
            setTimeout(() => {
            $('#viewPost').modal('hide');
            document.getElementById("success-alert").style.display = "none";
            $('#post-action').val('Take Action');
            $('#all-post-table').DataTable().destroy();
            $("#post-action").val("Take Action");
            fetch_all_post();
            }, 3000);
            document.getElementById("count-all-post").innerHTML = response.count.all_post;
            document.getElementById("count-approved-post").innerHTML = response.count.approved_post;
            document.getElementById("count-pending-post").innerHTML = response.count.pending_post;
            document.getElementById("count-suspended-post").innerHTML = response.count.cancelled_post;
            }
            }
    });
    });
    
    // view post code goes here
    $(document).on('click', '#view', function () {
    $.ajax({
    url: "{{ route('admin.viewPost') }}",
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
            document.getElementById("fa-eye").innerHTML = ' ' + response.count_page_view;
            $('#id').val(response.data.id);
            }
    });
    });

     
    });
    $.fn.dataTable.ext.errMode = 'throw';

</script>
@endsection
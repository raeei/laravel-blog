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
                            <h4 class="numbers" id="sum-all-comment"></h4>
                            <h4 class="details text-muted">ALL COMMENTS</h4>
                    </div>        
                </div>
    
                <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                    <div>
                        <i class="fas fa-donate"></i>
                        <h4 class="numbers" id="sum-active-comment"></h4>
                        <h4 class="details text-muted">ACTIVE COMMENTS</h4>
                    </div>    
                </div>
    
                <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                    <div>
                        <i class="fas fa-user-cog"></i>
                        <h4 class="numbers" id="sum-cancelled-comment"></h4>
                        <h4 class="details text-muted">CANCELLED COMMENTS</h4>
                    </div>        
                </div>
    </div>
   
    <div class="container-fluid table-section">
        <div class="col-lg-11 table-container" >
            <h1 class="header">ALL COMMENTS TABLE</h1>
            <div class="row">
                <div class="col-sm-3 select-container">
                    <select id="select-all-comment-type" class="form-control select-option">
                        <option value="1">All Comments</option> 
                        <option value="2">Active</option>
                        <option value="3">Cancelled</option>
                    </select>
                </div>

                <div class="col-sm-5 date-container input-daterange">
                    <div class="row">                             
                        <div class="col-lg-5 col-4 date-control">
                            <label>From :</label> 
                        </div>
                        <div class="col-lg-6 col-8">

                            <input type="date" name="start_date" id="all-comment-start-date" class="form-control search-date" />
                        </div>
                    </div>

                    <div class="row">                             
                        <div class="col-lg-5 col-4 date-control">
                            <label>To :</label> 
                        </div>
                        <div class="col-lg-6 col-8">
                            <input type="date" name="end_date" id="all-comment-end-date" class="form-control search-date" required>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row date-control" >                             
                        <div class="col-lg-6 date-control" >
                            <button class="btn btn-success filter-button" name="filter" id="all-comment-filter">Find</button> 
                        </div>
                        <div class="col-lg-6">
                            <button name="refresh" id="all-comment-refresh" class="btn btn-dark reload-button">Reload</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="all-comment-table">
                    <thead>
                        <tr>
                            <th class="" aria-label="hidden" aria-sortin="false">Post Picture</th>
                            <th>Post Title</th>
                            <th>Post Date</th>
                            <th>Comment</th>
                            <th>Comment Type</th>
                            <th>Status</th>
                            <th>User</th>
                            <th>Created Date</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>                
    
        </div>
    </div>  
</div>

<div class="modal fade  " id="viewComment"  data-keyboard="false"  data-backdrop="static" tabindex="-1" >
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <strong>View Comment</strong></h5>
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
                            <p id="view-post-content" style="overflow:hidden; width:100%; word-break: break-all;"></p>
                        </div>
                        <div style="margin-bottom: 10px; border-top: 1px solid #eee; padding-top: 10px;">
                            <span style="">
                                <i class="fas fa-heart fa-lg" id="fa-heart"style="margin-right: 20px;  cursor: pointer;"> </i> 
                                <i class="fas fa-comment fa-lg" id="count-comment" style="margin-right: 20px;  cursor: pointer;"></i>
                                <i class="fa-solid fa-bookmark fa-lg" id="fa-save" style="margin-right: 20px;  cursor: pointer;"></i>
                                <i class="fa-solid fa-eye fa-lg" id=""> 0</i>
                            </span>
                        </div>
                        <div  class="comment-container" style="border-top: 1px solid #eee;padding-top: 15px">
                   
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

<script>
      document.getElementById("sum-all-comment").innerHTML = {{$count_all_comment}};
            document.getElementById("sum-active-comment").innerHTML = {{$count_active_comment}};
            document.getElementById("sum-cancelled-comment").innerHTML = {{$count_cancelled_comment}};
</script> 


<script>
   
    $(document).ready(function () {
       
      
            
         // code for displaying data on the post table
            $('.input-daterange').datepicker({
            todayBtn: 'linked',
                    format: 'yyyy-mm-dd',
                    autoclose: true,
            });
            fetch_all_comments();
            function fetch_all_comments(start_date = '', end_date = '', select_comment_type = '') {
            $('#all-comment-table').DataTable({
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
                    url: "{{ route('admin.all_comments') }}",
                            method: "GET",
                            data: {start_date: start_date, end_date: end_date, select_comment_type: select_comment_type }
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
                    data: 'post_created_at'
                    }
                    ,
                    {
                    data: 'comment_body',
                            render: function (data) {
                            if (data.length > 49) {
                            data = data.substr(0, 50) + "...";
                            }
                            return data;
                            }
                    }
                    ,
                    {
                    data: 'comment_type'
                    }
                    ,
                    {
                    data: 'status'
                    }
                    ,
                    {
                    data: 'first_name'
                    }
                    ,
                    {
                    data: 'created_at'
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
            $('#all-comment-filter').click(function () {
            var start_date = $('#all-comment-start-date').val();
            var end_date = $('#all-comment-end-date').val();
            var select_comment_type = $('#select-all-comment-type').val();
            if (start_date != '' && end_date != '' && select_comment_type != '')
            {
            $('#all-comment-table').DataTable().destroy();
            fetch_all_comments(start_date, end_date, select_comment_type);
            } else
            {
            $('#requireDate').modal('show');
            }
            });
            // code to refresh and reset the post table
            $('#all-comment-refresh').click(function () {
            $('#all-comment-start-date').val('');
            $('#all-comment-end-date').val('');
            $('#select-all-comment-type').val(1);
            $('#all-comment-table').DataTable().destroy();
            fetch_all_comments();
            });
            
            // view post code goes here
            $(document).on('click', '#view', function () {
            $.ajax({
            url: "{{ route('admin.viewComment') }}",
                    method: "get",
                    dataType: 'json',
                    data: {
                    "_token": "{{ csrf_token() }}",
                            "comment_id": $(this).data('comment-id'),
                            "post_id" : $(this).data('post-id'),
                            "user_id" : $(this).data('user-id')
                    },
                    success: function (response) {
                        
                    document.getElementById("view-post-title").innerHTML = response.post_details.post_title;
                    document.getElementById("view-featured-picture").src = "../images/" + response.post_details.featured_picture;
                    document.getElementById("view-post-content").innerHTML = response.post_details.body;
                    document.getElementById("fa-heart").innerHTML = ' ' + response.count_likes;
                    document.getElementById("count-comment").innerHTML = ' ' + response.count_comments;
                    document.getElementById("fa-save").innerHTML = ' ' + response.count_favorites;
                     $('.comment-container').html("");
                    
                        if($.trim(response.data) == 0){
                         $('.comment-container').
                                    append('<div class="text-center p-4"><h3>No Comments</h3></div>');         
                        }
                        else{
                             $.each(response.data, function (key, value) {
                                 var id = response.comment_id;
                                var comment_id = value.id;
                                const count_replies = response.count_replies;
                             const total_replies = count_replies.filter(element => element == comment_id);
                             if(id == comment_id){
                                 $('.comment-container').css("border", "3px dotted red");
                                 $('.comment-container').css("border-radius", "5px");
                             } else{
                                 $('.comment-container').css("border", "1px solid #eee");
                             }
                            $('.comment-container').
                                    append('<div class="reply_box" style="padding: 10px;">\
                        <div class="row">\
                            <div class="col-xl-1 col-lg-2 col-md-2 col-sm-2 col-3">\
                                <img src="../images/' + value.picture + '" alt="..." height="50px" width="50px" style="border-radius: 60px;"/>\
                            </div>\
                        </div>\
                        <div style="word-break: break-all;">' + value.comment_body + '<div>\
                        <div class="p-2">\
                            <button value="' + value.id + '" data-id="' + id + '"  class="btn btn-secondary view_reply_btn">View Replies ('+ total_replies.length +')</button>\
                        </div>\
                         <div class="reply_section"></div>\
                         <div class="" style="margin:auto; " ><button  class="d-none hideComment btn text-center" id="hideComment" value="' + value.id + '"  style="cursor: pointer">hide comments</button> </div>\
                    </div>');
                        }); 
                        }
                    }
            });
            });
            
             // code for the view reply button
            $(document).on('click', '.view_reply_btn', function (e) {
                var thisClick = $(this);
                var comment_id = thisClick.val();
                var id = $(this).data('id');
               thisClick.closest('.view_reply_btn').hide();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.getReply') }}",
                    method: "post",
                    data: {
                        'comment_id': comment_id,
                        'id': id
                    },
                    dataType: 'json',
                    success: function (response) {
                          
                        $.each(response.data, function (key, value) {
                            var id = response.id;
                            var comment_id = value.id;
//                                const count_replies = response.count_replies;
//                             const total_replies = count_replies.filter(element => element == comment_id);
                                 if(id == comment_id){
                                 $('.reply_box').closest('.reply_section').css("border", "3px dotted red");
                                 $('.sub_reply_box').css("border-radius", "5px");
                             } else{
                                 $('.sub_reply_box').css("border", "1px solid #eee");
                             }
                           thisClick.closest('.reply_box').find("#hideComment").addClass("d-block").removeClass("d-none");
                            thisClick.closest('.reply_box').find('.reply_section').append('<div class="c" style="border: 1px solid #eee; border-radius: 5px;margin: 10px 0px 15px 30px; padding: 10px;">\
                        <div class="row">\
                            <div class="col-xl-1 col-lg-2 col-md-2 col-sm-2 col-3">\
                                <img src="../images/'+ value.picture +'" alt="..." height="50px" width="50px" style="border-radius: 60px;"/>\
                            </div>\
                        </div>\
                        <div style="word-break: break-all;"><span style="color: blue; ">'+ value.comment_name +'</span> '+ value.reply_msg +'<div>\
                    </div>');
                        });
                    }
                });

            });
    });
    
    //     $.fn.dataTable.ext.errMode = 'throw';
    
</script>
@endsection
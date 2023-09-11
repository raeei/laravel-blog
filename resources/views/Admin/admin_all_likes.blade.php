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
                            <h4 class="numbers">
                                {{$like_count_summary['all_likes'] }}
                            </h4>
                            <h4 class="details text-muted">ALL LIKES</h4>
                    </div>        
                </div>
    
                <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                    <div>
                        <i class="fas fa-donate"></i>
                        <h4 class="numbers">{{$like_count_summary['post_likes'] }}</h4>
                        <h4 class="details text-muted">LIKES ON POST</h4>
                    </div>    
                </div>
    
                <div class="summary-box" style="background: #EEE; border: 0.5px solid  #eee">
                    <div>
                        <i class="fas fas fa-cogs"></i>
                        <h4 class="numbers">{{$like_count_summary['comment_likes'] }}</h4>
                        <h4 class="details text-muted">LIKES ON COMMENT</h4>
                    </div>     
                </div>
    
                 
    </div>

    
    <div class="container-fluid table-section">
        <div class="col-lg-11 table-container" >
    
            <h1 class="header">ALL LIKES TABLE</h1>
            <div class="row">
                <div class="col-sm-3 select-container">
                    <select id="select-all-like-type" class="form-control select-option">
                        <option value="1">All Like</option> 
                        <option value="2">Likes on Post</option>
                        <option value="3">Likes on Comment</option>
                    </select>
                </div>

                <div class="col-sm-5 date-container input-daterange">
                    <div class="row">                             
                        <div class="col-lg-5 col-4 date-control">
                            <label>From :</label> 
                        </div>
                        <div class="col-lg-6 col-8">

                            <input type="date" name="start_date" id="all-like-start-date" class="form-control search-date" />
                        </div>
                    </div>

                    <div class="row">                             
                        <div class="col-lg-5 col-4 date-control">
                            <label>To :</label> 
                        </div>
                        <div class="col-lg-6 col-8">
                            <input type="date" name="end_date" id="all-like-end-date" class="form-control search-date" required>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row date-control" >                             
                        <div class="col-lg-6 date-control" >
                            <button class="btn btn-success filter-button" name="filter" id="all-like-filter">Find</button> 
                        </div>
                        <div class="col-lg-6">
                            <button name="refresh" id="all-like-refresh" class="btn btn-dark reload-button">Reload</button>
                        </div>
                    </div>
                </div>
            </div>
    
           
    
    
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="all-like-table">
                    <thead>
                        <tr>
                            <th class="" aria-label="hidden" aria-sortin="false">Post Title</th>
                            <th>Like By</th>              
                            <th>Type Of Like</th>
                            <th>Like Date</th>
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
                    <h1 id="view-post-title" style=" overflow: hidden; width:100%; word-break: break-all;"></h1>
                </div>
                <div style="margin-bottom: 30px;">
                    <img  height="300px" width="100%" id="view-featured-picture"/>
                </div>
                <div style="margin-bottom: 10px;">
                    <p id="view-post-content" style="overflow:hidden; width:100%; word-break: break-all;"></p>
                </div>
                <div style="margin-bottom: 10px;">
                    <div class="row" style="border-top: 1px solid #eee;">
                        <div class="col-6">
                            <label>By</label>
                            <h5 id="author"></h5>
                            <h5 id="date"></h5>
                        </div>
                        <div class="col-6 text-right">
                            <label></label>
                             <i class="fas fa-heart fa-lg" id="fa-heart"> </i> 
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
 $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
        fetch_all_like();
        function fetch_all_like(start_date = '', end_date = '', select_like_type = '')
        {
    $('#all-like-table').DataTable({
    processing: true,
            serverSide: true,
            ordering: true,
            pageLength: 10,
            oLanguage: {
            "sEmptyTable": "No likes found"
            },
            order: [],
            "error": "this is test",
            ajax: {
            url: "{{ route('admin.all_likes') }}",
                    method: "GET",
                    data: {start_date: start_date, end_date: end_date, select_like_type: select_like_type}
            },
            columns: [
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
            }
            ,
            {
            data: 'like_type'
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
 $('#all-like-filter').click(function () {
            var start_date = $('#all-like-start-date').val();
            var end_date = $('#all-like-end-date').val();
            var select_like_type = $('#select-all-like-type').val();
            if (start_date != '' && end_date != '' && select_like_type != '')
            {
                $('#all-like-table').DataTable().destroy();
                fetch_all_like(start_date, end_date, select_like_type);
            } else
            {
                $('#requireDate').modal('show');
            }
        });
        $('#all-like-refresh').click(function () {
            $('#all-like-start-date').val('');
            $('#all-like-end-date').val('');
            $('#select-all-like-type').val(1);
            $('#all-like-table').DataTable().destroy();
            fetch_all_like();
        });
    // view post code goes here
    $(document).on('click', '#view', function () {

    $.ajax({
    url: "{{ route('editor.getLikeDetails') }}",
            method: "post",
            dataType: 'json',
            data: {
            "_token": "{{ csrf_token() }}",
                    "id": $(this).data('id')
            },
            success: function (response) {
                
                if(response){
                    console.log(response);
                         document.getElementById("view-post-title").innerHTML = response.data[0].post_title;
            document.getElementById("view-featured-picture").src = "../images/" + response.data[0].featured_picture;
            document.getElementById("view-post-content").innerHTML = response.data[0].body;
             document.getElementById("author").innerHTML = response.data[0].first_name+' '+response.data[0].last_name;
             document.getElementById("date").innerHTML = response.data[0].created_at;
             document.getElementById("fa-heart").innerHTML = ' '+response.countLikes;
            $('#id').val(response.data.id);
                }
       
            }
    });
    });

       
    });
    $.fn.dataTable.ext.errMode = 'throw';

</script>
@endsection
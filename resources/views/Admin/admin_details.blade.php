@extends('Admin.layouts.admin_layout')

@section('content')
<div class="container-fluid table-section">
    <div class="col-lg-11 table-container">

    
<div class="row" style="margin-bottom: 30px;">
    <div class="col-sm-4">
        <img src="../images/image1.jpg" alt="..." height="300px" width="100%" style="border-radius: 10px;"/>
    </div>
    <div class="col-sm-8" style="border-bottom: 1px solid #eee;">
        <h6 style="font-weight: 900; font-size: 30px;">Moderator</h6>
        <h6 style="font-size: 25px;">Ubong Sunday</h6>
        <h6  style="font-size: 25px;">07067251489</h6>
        <h6 style="font-size: 25px;">ubong.ibok@gmail.com</h6>
        <h6 style="font-size: 25px;">Joined 16 Jan, 2023</h6>
        <div class="row" style="padding-bottom: 10px;">
            <div class="col-4"><button class="btn">Delete</button></div>
            <div class="col-4"><button class="btn">Suspend</button></div>
            <div class="col-4"><button class="btn">Edit</button></div>
        </div>
    </div>
   
</div>
</div>

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


<div class="container-fluid" style="margin: auto;">

    
    <div class="container-fluid table-section">
        <div class="col-lg-11 table-container"  style="border-bottom: 1px solid #eee;">
    
            <h1 class="header">UBONG'S POST TABLE</h1>
            <div class="row">
                <div class="col-sm-3 select-container">
                    <select id="transact" class="form-control select-option">
                        <option value="1">All</option> 
                        <option value="2">Approved</option>
                        <option value="3">Cancel</option>
                        <option value="4">Ask to Edit</option>
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
                <table class="table table-bordered table-striped" id="all_users_table">
                    <thead>
                        <tr>
                            <th class="" aria-label="hidden" aria-sortin="false">Joined Date</th>
                            <th>First Name</th>
                            <th>Last name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            {{-- <th>Status</th>
                            <th>No. of Comments</th>
                            <th>No. of Likes</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>                
    
        </div>
    </div>  

    <div class="container-fluid table-section">
        <div class="col-lg-11 table-container" >
    
            <h1 class="header">UBONG'S COMMENT TABLE</h1>
            <div class="row">
                <div class="col-sm-3 select-container">
                    <select id="transact" class="form-control select-option">
                        <option value="1">All Transactions</option> 
                        <option value="2">Withdrawals</option>
                        <option value="3">Deposits</option>
                        <option value="4">Earnings</option>
                        <option value="5">Referral Bonus</option>
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
                <table class="table table-bordered table-striped" id="all_users_table">
                    <thead>
                        <tr>
                            <th class="" aria-label="hidden" aria-sortin="false">Joined Date</th>
                            <th>First Name</th>
                            <th>Last name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            {{-- <th>Status</th>
                            <th>No. of Comments</th>
                            <th>No. of Likes</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>                
    
        </div>
    </div>  
</div>
 


<script>
    $(document).ready(function () {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        fetch_data();
        function fetch_data(start_date = '', end_date = '')
        {
            $('#all_users_table').DataTable({
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
                    url: '{{ url('users') }}',
                    method: "GET",
                    data: {start_date: start_date, end_date: end_date}
                },
                columns: [
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    }
                    ,
                    {
                        data: 'last_name',
                        name: 'last_name'
                    }
                    ,
                    {
                        data: 'phone',
                        name: 'phone',
                    }
                    ,
                    {
                        data: 'email',
                        name: 'email',
                    }
                    ,
                    
                    {
                        data: 'action',
                        name: 'action',
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
                $('#all_users_table').DataTable().destroy();
                fetch_data(start_date, end_date);
            } else
            {
                alert('Both Date is required');
            }
        });
        $('#refresh').click(function () {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#all_users_table').DataTable().destroy();
            fetch_data();
        });
    });
    
        $.fn.dataTable.ext.errMode = 'throw';
    
</script>

</div>

@endsection
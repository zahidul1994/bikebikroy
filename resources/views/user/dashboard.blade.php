@extends('layouts.user')
@section('title','User Dashboard')
@section('page-style')

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endsection
@section('content')
<section id="account-menu">
    <div class="container">
        <ul class="ac-menu ps-0 mb-0">
            <li><a href="{{url('user/profile')}}">My account</a></li>
            <li><a href="#">My membership</a></li>
            <li><a href="#">Favorites</a></li>
            <li><a href="#"><b>Settings</b></a></li>
            <li><a href="#" style="color: #000;"><b>Dashboard</b></a></li>
        </ul>
    </div>
</section>

<section id="account-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ac-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ac-user-name">
                                <p>
                                    <b><a href="{{url('user/bikesale/create')}}">Post For Bike Sale</a></b>
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ac-user-name">
                                <p>
                                    <b><a href="{{url('user/addsale')}}">Post For Bike Buy</a></b>
                                </p>
                            </div>

                        </div>
                    </div>
                    <h1 class="text-center">Bike Sale Post List  </h1>
                    <h3 class="text-center"> You Can {{@Auth::user()->salepost}}  Post For Bike Sale</h3>
                    <table id="dataTable" class="table display table-striped  bordered nowrap"  style="width: 100%;">
                    <thead>
                    
                        <tr>
                            <td>SL</td>
                            <td>Date </td>
                            <td>Title </td>
                            <td>Status </td>
                            <td>Action</td>
                           </tr>
                    </thead>
                    <tbody>
                    
                    
                    
                    </tbody>
                    <tfoot>
                    
                    </tfoot>
                    </table>
                    
                   
                </div>
            </div>
        </div>


    </div>
</section>



@endsection

@section('page-script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script> 

<script>
    $(document).ready(function() {
             $('#dataTable').DataTable({
             responsive: true,
            processing: true,
            serverSide: true,
     
            ajax: {
               
                url: "{{ url('user/dashboard') }}",

            },

            columns: [


                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
               


                {
                    data: 'created_at',
                   name: 'created_at'
                  
                },

                {
                    data: 'title',
                   
                },
                {
                    data: 'status',
                   
                },

                

                {
                    
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }

            ]

        });
  




    
    });
</script>
@endsection
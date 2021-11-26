@extends('layouts.superadmin')
@section('title','Admin List')
@section('page-style')

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endsection
@section('content')
<div class="cards">
    <div class="row">
        <div class="col md-7"></div>
        <div class="col md-5 mb-2 text-end"> <a class="btn btn-primary" href="{{url('superadmin/createadmin')}}" >
            Create Admin
          </a></div>
    
        <table id="dataTable" class="table display table-striped  bordered nowrap"
        style="width: 100%;">
        <thead>

            <tr>
                <td>SL</td>
                <td>Name</td>
                <td>photo</td>
                <td>Email</td>
                <td>Admin Type</td>
                <td>Status</td>
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

<!-- Modal -->
<div class="modal fade" id="Packagemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Division </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
        <h5> @include('errors.ajaxformerror')</h5>
        <div class="modal-body">
            
            {!! Form::open(['url' => 'superadmin/createpackage', 'class' => 'form', 'id' => 'ccccc']) !!}
                {!! Form::hidden('divisionid', '', ['id' => 'divisionid']) !!}
            <label for="divisionname" class="form-label">Division Name English *</label>
            <div class="input-group">
                {!! Form::text('divisionname', null, ['id' => 'divisionname', 'class' => 'form-control  mb-1']) !!}
            </div> 
            <label for="bndivisionname" class="form-label">Division Name Bangla *</label>
            <div class="input-group">
                {!! Form::text('bndivisionname', null, ['id' => 'bndivisionname', 'class' => 'form-control  mb-1']) !!}
            </div> 
                </div>
        <div class="modal-footer">
           
            <input type="button" id="addBtn" value="Save Payby" class="btn btn-primary">


            {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>

@endsection

@section('page-script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script> 

<script>
    $(document).ready(function() {
       
$("#formerrors").hide();
  clearform();

        $('#dataTable').DataTable({
             responsive: true,
            processing: true,
            serverSide: true,
     
            ajax: {
               
                url: "{{ url('superadmin/adminlist') }}",

            },

            columns: [


                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
               


                {
                    data: 'adminname',
                  
                },

                {
                    data: 'photo',
                   
                },
                {
                    data: 'email',
                   
                },
                {
                    data: 'admintype',
                   
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
        //Delete Admin
        $(document).on('click', '#deleteBtn', function() {

            if (!confirm('Sure?')) return;
            $id = $(this).attr('rid');
            //console.log($roomid);
            $info_url = url + '/superadmin/deleteadmin/' + $id;
            $.ajax({
                url: $info_url,
                method: "DELETE",
                type: "DELETE",
                data: {},
                success: function(data) {
                    if (data) {
                        Swal.fire({
                            icon: 'warning',
                            title: "Admin Delete Successfully",
                                timer: 2000,
                                showConfirmButton: false,
                                });
                        $('#dataTable').DataTable().ajax.reload();

                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $("#addBtn").click(function() {
     
if ($(this).val() == 'Save') {

$.ajax({
    url:"{{ url('/superadmin/createdivision') }}",
    method: "POST",
    data: {
        division: $("#divisionname").val(),
        bndivision: $("#bndivisionname").val(),
        
        

    },
    success: function(d) {
        if (d.success) {
            Swal.fire({
                icon: 'success',
               title: "Division Create Successfully",
                timer: 2000,
                showConfirmButton: false,
                });
            $('#dataTable').DataTable().ajax.reload();
             clearform();

        } else {
            $.each(d.errors, function(key, value) {
                $('#formerrors').show();
                $('#formerrors ul').append('<li>' + value +
                '</li>');
            });
        }
    },
    error: function(d) {
        // alert(d.message);
        console.log(d);
    }

});
}
});
//Create end shift

//Update shift
$("#Packagemodal").on('click', '#addBtn', function() {

if ($(this).val() == 'Update') {

$.ajax({
    url: url + '/superadmin/updatedivision/' + $("#divisionid").val(),
    method: "PUT",
    type: "PUT",
    data: {
        division: $("#divisionname").val(),
        bndivision: $("#bndivisionname").val(),
    },
    success: function(d) {
        if (d.success) {
            Swal.fire({
            icon: 'warning',
            title: "Division Update Successfully",
                timer: 2000,
                showConfirmButton: false,
                });
            $('#dataTable').DataTable().ajax.reload();
             clearform();



        }
        else {
            $.each(d.errors, function(key, value) {
                $('#formerrors').show();
                $('#formerrors ul').append('<li>' + value +
                '</li>');
            });
        }
    },
    error: function(d) {
        console.log(d);
    }
});
}
});
//Update shift end





//Edit shift
$("#dataTable").on('click', '#editBtn', function() {

$divisionid = $(this).attr('rid');

$info_url = url + '/superadmin/editdivision/' + $divisionid ;
//console.log($info_url);
// return;
$.get($info_url, {}, function(d) {

populateForm(d);
location.hash = "ccccc";

$("#Packagemodal").modal('show');
});
});
//Edit shift end







//form populatede

function populateForm(data) {
$("#divisionname").val(data.division);
$("#bndivisionname").val(data.bndivision);
$("#divisionid").val(data._id);
$("#addBtn").val('Update');


}

function clearform() {
$('#ccccc')[0].reset();
$("#addBtn").val('Save');
$("#Packagemodal").modal('hide');
}

$("#close").click(function() {
clearform();
});

    
    });
</script>
@endsection
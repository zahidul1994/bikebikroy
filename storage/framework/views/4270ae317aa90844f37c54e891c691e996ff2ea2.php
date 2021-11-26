
<?php $__env->startSection('title','Package List'); ?>
<?php $__env->startSection('page-style'); ?>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="cards">
    <div class="row">
        <div class="col md-7"></div>
        <div class="col md-5 mb-2 text-end"> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Packagemodal">
            Create Role
          </button></div>
    
        <table id="dataTable" class="table display table-striped  bordered  table-responsive"
        style="width: 100%;">
        <thead>

            <tr>
                <td>SL</td>
                <td>Role</td>
                <td>Permission</td>
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
          <h5 class="modal-title" id="exampleModalLabel">Create Package</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
        <h5> <?php echo $__env->make('errors.ajaxformerror', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></h5>
        <div class="modal-body">
            
            <?php echo Form::open(['url' => 'superadmin/createpackage', 'class' => 'form', 'id' => 'ccccc']); ?>

                <?php echo Form::hidden('packageid', '', ['id' => 'packageid']); ?>

            <label for="name" class="form-label">Name *</label>
            <div class="input-group">
                <?php echo Form::text('name', null, ['id' => 'name', 'class' => 'form-control  mb-1']); ?>

            </div> 
            <table  class="table  table-hover">
                <thead>
                  <tr>
                     <th>Permission Name</th>
                   <th><a rel="group_1" href="#invert_selection">Click For All Selection</a> </th>
                                   
                  </tr>
                </thead>
        
        
                <tbody>
                  <?php if(count(CommonFx::Permissionname())>0): ?>
                  <?php $__currentLoopData = CommonFx::Permissionname(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                  <tr>
                   <td><?php echo e($value->name); ?></td>
                   <td id="group_1">  <div class="pretty p-icon p-round p-pulse">
                      <?php echo e(Form::checkbox('permission', $value->name, false, array('class' => 'group_1'))); ?>

                          <div class="state p-success">
                              <i class="icon mdi mdi-check"></i>
                              <label>Allow</label>
                          </div>
                      </div></td>
                   
                 
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                 <h3 class="text-danger">No Permission List  found</h3>
                 <?php endif; ?>
                            
                </tbody>
            </table>
           
        </div>
        <div class="modal-footer">
           
            <input type="button" id="addBtn" value="Save" class="btn btn-primary">


            <?php echo Form::close(); ?>


        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script> 

<script>
    $(document).ready(function() {
        $("A[href='#select_all']").click( function() {
            $("#" + $(this).attr('rel') + " INPUT[type='checkbox']").attr('checked', true);
            return false;
        });
        // Select none
        $("A[href='#select_none']").click( function() {
            $("#" + $(this).attr('rel') + " INPUT[type='checkbox']").attr('checked', false);
            return false;
        });
        // Invert selection
        $("A[href='#invert_selection']").click( function() {
            $("#" + $(this).attr('rel') + " INPUT[type='checkbox']").each( function() {
                $(this).attr('checked', !$(this).attr('checked'));
            });
            return false;
        });
$("#formerrors").hide();
  clearform();

        $('#dataTable').DataTable({
             responsive: true,
            processing: true,
            serverSide: true,
     
            ajax: {
               
                url: "<?php echo e(url('superadmin/rolelist')); ?>",

            },

            columns: [


                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
               


                {
                    data: 'name',
                  
                },

                {
                    data: 'permission',
                    height: '65%',
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
            $info_url = url + '/superadmin/deleterole/' + $id;
            $.ajax({
                url: $info_url,
                method: "DELETE",
                type: "DELETE",
                data: {},
                success: function(data) {
                    if (data) {
                        Swal.fire({
                            icon: 'warning',
                            title: "Role Delete Successfully",
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
    var checkvalue = [];
            $.each($("input[name='permission']:checked"), function(){            
                checkvalue.push($(this).val());
            });
$.ajax({
    url:"<?php echo e(url('/superadmin/createtrole')); ?>",
    method: "POST",
    data: {
        name: $("#name").val(),
        permission: checkvalue,
             

    },
    success: function(d) {
        if (d.success) {
            Swal.fire({
                icon: 'success',
               title: "Role Create Successfully",
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
    url: url + '/superadmin/updatepackage/' + $("#packageid").val(),
    method: "PUT",
    type: "PUT",
    data: {
        packagename: $("#packagename").val(),
        packageprice: $("#packageprice").val(),
        expiryday: $("#expiryday").val(),
      complaintitle: $("#complaintitle").val(),
      description: $("#description").val(),
    },
    success: function(d) {
        if (d.success) {
            Swal.fire({
            icon: 'warning',
            title: "Package Update Successfully",
                timer: 2000,
                showConfirmButton: false,
                });
            $('#dataTable').DataTable().ajax.reload();
             clearform();



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

$packageid = $(this).attr('rid');

$info_url = url + '/superadmin/editpackage/' + $packageid ;
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
$("#packagename").val(data.packagename);
$("#packageprice").val(data.packageprice);
$("#expiryday").val(data.expiryday);
$("#description").val(data.description);
$("#packageid").val(data._id);
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.superadmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Laravel\Laravel8\Bikebikroy\resources\views/superadmin/role/index.blade.php ENDPATH**/ ?>
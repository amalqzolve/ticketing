$(function () {
    $('.ktdatepicker').datepicker({
        format: 'dd-mm-yyyy'
    });
});

$(document).ready(function() {
    $("#pipelineassign_submit").click(function(e){
    	 e.preventDefault();
        var branch            = $("#branch").val();
        var department        = $('#department').val();
        var designation       = $("#designation").val();
        var pipelineassign_type= $("#pipelineassign_type").val();
        var employee          = $("#employee").val();
        var proces            = $('#pipeline_process').val();
        var stages            = $('#pipeline_stage').val();
         if (branch=="") {
         $('#branch').addClass('is-invalid');
         return false;
         } 
         else{
            $('#branch').removeClass('is-invalid');
         } 

        if (!department) { 
           $('#department').addClass('is-invalid');
            return false;
        }
        else {
           $('#department').removeClass('is-invalid');
        }
         if (!designation) { 
           $('#designation').addClass('is-invalid');
            return false;
        }
        else {
           $('#designation').removeClass('is-invalid');
        }

        if (employee && employee.length > 0) {

            }else{
            Swal.fire({

        text: "Please select the employee",
        type: "error"
        });
                return false;
            }
       
        
         if (!pipelineassign_type) { 
           $('#pipelineassign_type').addClass('is-invalid');
            return false;
        }
        else {
           $('#pipelineassign_type').removeClass('is-invalid');
        }
         
        $('#form_pipeline_assign_save').attr("action",base_url+"common/db_add_update");
        $('#form_pipeline_assign_save').submit();
    

    }); 

});


 $(document).ready(function() {
//  $('select[name="branch"]').trigger('change');
//  $('select[name="department"]').trigger('change');
//  $('select[name="designation"]').trigger('change');
//       $('#employee').select2({
//    placeholder: "Select"
// });

        $('select[name="branch"]').on('change', function() {
            var branch = $(this).val();
            if(branch) {
                $.ajax({
                    url:base_url+'pipeline_assign/getdynamicdepartment',
                    type: "POST",
                    data : {branch_id:branch},
                    dataType: "json",
                    success:function(data) {
                        $('select[name="designation"]').val(null).trigger("change")
                        $('select[name="department"]').empty();
                        $('select[name="employee[]"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="department"]').append('<option value="'+ value.id +'">'+ value.dept_name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="department"]').empty();
            }
        });
         $('select[name="department"]').on('change', function() {
             $('select[name="employee[]"]').empty();
        }); 
    });




 /*$(document).ready(function() {

        $('select[name="designation"]').on('change', function() {
             
            var branch     = $("#branch").val();
             
            var department = $("#department").val();
            
            if(branch && department) {
                $.ajax({
                    url:base_url+'pipeline_assign/getdynamicemployee',
                    type: "POST",
                    data : {branch_id:branch,
                            department_id : department,
                       },
                    dataType: "json",
                    success:function(data) {
                        $('select[name="employee[]"]').empty();
                        $.each(data, function(key, value) {
                          var data = {id:value.id,text:value.f_name};
                          var newOption = new Option(data.text, data.id, false, false);
                          $('#employee').append(newOption).trigger('change');
                          });
                    }
                });
            }else{
                $('select[name="employee[]"]').empty();
            }
        });
    });

*/
 var table
 $(document).ready(function() {
     table = $('#pipeline_assign_list').DataTable({ 
 "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                },
                pageSize: 'A3',
                orientation: 'landscape',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            }
        ],
    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],
        "ajax": {
            "url" : base_url+'pipeline_assign/pipeline_assign_list',
            "type": "POST",
            "data": function ( data ) {
            	  
            }
        },
        "columnDefs": [
        { 
            "targets": [ 0 ],
            "orderable": false,
        },
        ],

    });
});



$(document).ready(function() {
    $("#pipeline_assign_update").click(function(e){
        e.preventDefault();
        var branch              = $("#branch").val();
        var department          = $('#department').val();
        var designation         = $("#designation").val();
        var expense_date        = $("#expense_date").val();
        var expense_amount      = $('#expense_amount').val();
        var pipeline_assign_type  = $("#pipeline_assign_type").val();
        var note                = $("#note").val();
        var employee            = $("#employee").val();
         if (branch=="") {
         $('#branch').addClass('is-invalid');
         return false;
         } 
         else{
            $('#branch').removeClass('is-invalid');
         } 

        if (!department) { 
           $('#department').addClass('is-invalid');
            return false;
        }
        else {
           $('#department').removeClass('is-invalid');
        }
         if (!designation) { 
           $('#designation').addClass('is-invalid');
            return false;
        }
        else {
           $('#designation').removeClass('is-invalid');
        }

        if (employee && employee.length > 0) {

            }else{
            Swal.fire({

        text: "Please select the employee",
        type: "error"
        });
                return false;
            }
        if (!expense_date) { 
        $('#expense_date').addClass('is-invalid');
        return false;
        }
        else {
           $('#expense_date').removeClass('is-invalid');
        }
         if (!expense_amount) { 
           $('#expense_amount').addClass('is-invalid');
            return false;
        }
        else {
           $('#expense_amount').removeClass('is-invalid');
        }
         if (!pipeline_assign_type) { 
           $('#pipeline_assign_type').addClass('is-invalid');
            return false;
        }
        else {
           $('#pipeline_assign_type').removeClass('is-invalid');
        }
         
        $('#form_pipeline_assign_update').attr("action",base_url+"common/db_add_update");
        $('#form_pipeline_assign_update').submit();
    

    }); 

});


 $(document).on('click', '.kt_pipeline_assign_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this pipeline_assign Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'pipeline_assign_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your pipeline_assign has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your pipeline_assign is safe :)", "error");

          }
        })
     });



 $(document).ready(function() {

        $('select[name="fb_branch"]').on('change', function() {
            var fb_branch = $(this).val();
            if(fb_branch) {
                $.ajax({
                    url:base_url+'pipeline_assign/getdynamicdepartment',
                    type: "POST",
                    data : {branch_id:fb_branch},
                    dataType: "json",
                    success:function(data) {
                        $('select[name="fb_designation"]').val(null).trigger("change")

                        $('select[name="fb_department"]').empty();
                        $('select[name="fb_employee"]').empty();
                        $('#fb_employee').select2({
   placeholder: "Select"
});
                        $.each(data, function(key, value) {
                        $('select[name="fb_department"]').append('<option value="'+ value.id +'">'+ value.dept_name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="fb_department"]').empty();
            }
        });
         $('select[name="fb_department"]').on('change', function() {
             $('select[name="fb_employee"]').empty();
        }); 
    });




 $(document).ready(function() {

        $('select[name="fb_designation"]').on('change', function() {
               var designation = $(this).val();
            var fb_branch     = $("#fb_branch").val();
             
            var fb_department = $("#fb_department").val();
            
            if(fb_branch && fb_department) {
                $.ajax({
                   // url:base_url+'pipeline_assign/getdynamicemployee',
                     url:base_url+'home/getdynamicemployee1',
                    type: "POST",
                    data : {branch_id:fb_branch,
                            department_id : fb_department,designation:designation
                       },
                    dataType: "json",
                    success:function(data) {
                        $('select[name="fb_employee"]').empty();
                           $('#fb_employee').select2({
   placeholder: "Select"
});
   

                        $.each(data, function(key, value) {
                          var data = {id:value.id,text:value.f_name};
                          var newOption = new Option(data.text, data.id, false, false);
                          $('#fb_employee').append(newOption).trigger('change');
                          });
                    }
                });
            }else{
                $('select[name="fb_employee"]').empty();
            }
        });
    });

 $(document).on('click', '.kt_common_pipeline_process_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/ajax_edit_data',
        data: {table:'qrecruitment_common_pipeline_process',id:id},
        success: function(data){

            var object = JSON.parse(data);

            $.each(object, function(key, value)
              {
                 $('#e_process_id').val(value.id);
                 $('#e_process_name').val(value.process_name);
                 $('#e_process_description').val(value.description);
                // $('#e_payhead_category').val(value.payhead_category);
              
              });
            $('#editcommonpipelineprocess').modal('show');
       },
       
  });
     
});

 $(document).ready(function() {
    $("#pipelineassign_edit").click(function(e){
       e.preventDefault();
        var branch            = $("#branch").val();
        var department        = $('#department').val();
        var designation       = $("#designation").val();
        var pipelineassign_type= $("#pipelineassign_type").val();
        var employee          = $("#employee").val();
       
         if (branch=="") {
         $('#branch').addClass('is-invalid');
         return false;
         } 
         else{
            $('#branch').removeClass('is-invalid');
         } 

        if (!department) { 
           $('#department').addClass('is-invalid');
            return false;
        }
        else {
           $('#department').removeClass('is-invalid');
        }
         if (!designation) { 
           $('#designation').addClass('is-invalid');
            return false;
        }
        else {
           $('#designation').removeClass('is-invalid');
        }

        if (employee && employee.length > 0) {

            }else{
            Swal.fire({

        text: "Please select the employee",
        type: "error"
        });
                return false;
            }
       
        
         if (!pipelineassign_type) { 
           $('#pipelineassign_type').addClass('is-invalid');
            return false;
        }
        else {
           $('#pipelineassign_type').removeClass('is-invalid');
        }
         
        $('#form_pipeline_assign_edit').attr("action",base_url+"common/db_add_update");
        $('#form_pipeline_assign_edit').submit();
    

    }); 

});
 $(document).ready(function() {
  $('#employee').select2({
   placeholder: "Select"
});
  });
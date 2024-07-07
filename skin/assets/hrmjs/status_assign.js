$(function () {
    $('.ktdatepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
});

$(document).ready(function() {
    $("#status_assign_submit").click(function(e){
    	 e.preventDefault();
        var branch            = $("#branch").val();
        var department        = $('#department').val();
        var designation       = $("#designation").val();
        var status            = $("#status").val();
        var employee          = $("#employee").val();

        var name_error      = $("input[name ='name_error_msg']").val();

       
         if (branch=="") {

            $('#branch').next().find('.select2-selection').addClass('select-dropdown-error');

          return false;
         } 
          else {
            $('#branch').next().find('.select2-selection').removeClass('select-dropdown-error');
         
        }

        if (!department) { 
            $('#department').next().find('.select2-selection').addClass('select-dropdown-error');
            return false;
        }
        else {
         //  $('#department').removeClass('is-invalid');
            $('#department').next().find('.select2-selection').removeClass('select-dropdown-error');

        }
         if (!designation) { 
            $('#designation').next().find('.select2-selection').addClass('select-dropdown-error');
             return false;
        }
         else {
         
            $('#designation').next().find('.select2-selection').removeClass('select-dropdown-error');

        }
       
        if (employee && employee.length > 0) {

            }else{
            Swal.fire({

        text: "Please select the employee",
        type: "error"
        });
                return false;
            }
       
    
          if (!status) { 
            $('#status').next().find('.select2-selection').addClass('select-dropdown-error');
             return false;
        }
         else {
         
            $('#status').next().find('.select2-selection').removeClass('select-dropdown-error');

        }
       
        
         
        $('#form_status_assign_save').attr("action",base_url+"common/db_add_update");
        $('#form_status_assign_save').submit();
     
    

    }); 

});


 $(document).ready(function() {

        $('select[name="branch"]').on('change', function() {
            var branch = $(this).val();
            if(branch) {
                $.ajax({
                    url:base_url+'pipeline_assign/getdynamicdepartment',
                    type: "POST",
                    data : {branch_id:branch},
                    dataType: "json",
                    success:function(data) {
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




 $(document).ready(function() {

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
  $(document).ready(function() {

        $('select[name="e_branch"]').on('change', function() {
            var branch = $(this).val();
            if(branch) {
                $.ajax({
                    url:base_url+'pipeline_assign/getdynamicdepartment',
                    type: "POST",
                    data : {branch_id:branch},
                    dataType: "json",
                    success:function(data) {
                        $('select[name="e_department"]').empty();
                        $('select[name="e_employee[]"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="e_department"]').append('<option value="'+ value.id +'">'+ value.dept_name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="e_department"]').empty();
            }
        });
         $('select[name="e_department"]').on('change', function() {
             $('select[name="e_employee[]"]').empty();
        }); 
    });
 $(document).ready(function() {

        $('select[name="e_designation"]').on('change', function() {
             
            var branch     = $("#e_branch").val();
             
            var department = $("#e_department").val();
            
            if(branch && department) {
                $.ajax({
                    url:base_url+'pipeline_assign/getdynamicemployee',
                    type: "POST",
                    data : {branch_id:branch,
                            department_id : department,
                       },
                    dataType: "json",
                    success:function(data) {
                        $('select[name="e_employee[]"]').empty();
                        $.each(data, function(key, value) {
                          var data = {id:value.id,text:value.f_name};
                          var newOption = new Option(data.text, data.id, false, false);
                          $('#e_employee').append(newOption).trigger('change');
                          });
                    }
                });
            }else{
                $('select[name="e_employee[]"]').empty();
            }
        });
    });

 var table
 $(document).ready(function() {
     table = $('#status_assign_list').DataTable({ 
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                },
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
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
            "url" : base_url+'status_assign/status_assign_list',
            "type": "POST",
            "data": function ( data ) {
            	  
            }
        },
        "columnDefs": [
        { 
            "targets": [ 0 ],
            "orderable": false,
        },
        { 
            "targets": [ 6 ],
            "orderable": false,
        }
        ],

    });
});



$(document).ready(function() {
    $("#status_assign_edit").click(function(e){
       e.preventDefault();
        var branch            = $("#e_branch").val();
        var department        = $('#e_department').val();
        var designation       = $("#e_designation").val();
        var status            = $("#e_status").val();
        var employee          = $("#e_employee").val();
       
         if (branch=="") {
         $('#e_branch').addClass('is-invalid');
         return false;
         } 
         else{
            $('#e_branch').removeClass('is-invalid');
         } 

        if (!department) { 
           $('#e_department').addClass('is-invalid');
            return false;
        }
        else {
           $('#e_department').removeClass('is-invalid');
        }
         if (!designation) { 
           $('#e_designation').addClass('is-invalid');
            return false;
        }
        else {
           $('#e_designation').removeClass('is-invalid');
        }

        if (employee && employee.length > 0) {

            }else{
            Swal.fire({

        text: "Please select the employee",
        type: "error"
        });
                return false;
            }
       
        
         if (!status) { 
           $('#e_status').addClass('is-invalid');
            return false;
        }
        else {
           $('#e_status').removeClass('is-invalid');
        }
         
        $('#form_status_assign_edit').attr("action",base_url+"common/db_add_update");
        $('#form_status_assign_edit').submit();
    

    }); 

});



 $(document).on('click', '.kt_status_assign_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this status assign Entry!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'status_assign_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your status assign has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your status assign is safe :)", "error");

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
                        $('select[name="fb_department"]').empty();
                        $('select[name="fb_employee"]').empty();
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
             
            var fb_branch     = $("#fb_branch").val();
             
            var fb_department = $("#fb_department").val();
            
            if(fb_branch && fb_department) {
                $.ajax({
                    url:base_url+'pipeline_assign/getdynamicemployee',
                    type: "POST",
                    data : {branch_id:fb_branch,
                            department_id : fb_department,
                       },
                    dataType: "json",
                    success:function(data) {
                        $('select[name="fb_employee"]').empty();
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


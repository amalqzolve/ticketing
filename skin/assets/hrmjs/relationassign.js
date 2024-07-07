/*$(function () {
    $('.ktdatepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
}).on('changeDate', function(e){
    $(this).datepicker('hide');
});*/
  $('.ktdatepicker').datepicker({
    format: 'dd-mm-yyyy'
}).on('changeDate', function(e){
    $(this).datepicker('hide');
});


 

$(document).ready(function() {
    $("#relationeassign_submit").click(function(e){
    	 e.preventDefault();
        var branch            = $("#branch").val();
        var department        = $('#department').val();
        var designation       = $("#designation").val();
        var relation_type     = $("#relation_type").val();
        var employee          = $("#employee").val();
        var reason_type       = $('#reason_type').val();
        var date              = $('#date').val();
        var voluntary         = $('#voluntary_termination').val();

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
       
        if (!relation_type) { 
            $('#relation_type').next().find('.select2-selection').addClass('select-dropdown-error');
             return false;
        }
         else {
         
            $('#relation_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        }
       

       
        if (!reason_type) { 
            $('#reason_type').next().find('.select2-selection').addClass('select-dropdown-error');
             return false;
        }
         else {
         
            $('#reason_type').next().find('.select2-selection').removeClass('select-dropdown-error');

        }
       
         
         if (!date) { 
           $('#date').addClass('is-invalid');
            return false;
        }
        else {
           $('#date').removeClass('is-invalid');
        }
        

        $('#form_relation_assign_save').attr("action",base_url+"common/db_add_update");
        $('#form_relation_assign_save').submit();
    

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



/*
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
                        //$('#employee').empty();
                        $("#employee").val(null).trigger("change");
                         $('#employee').empty().trigger("change");
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
    });*/


 var table
 $(document).ready(function() {

     table = $('#relation_assign_list') .on('preXhr.dt', function ( e, settings, data ) {
        data.relation_id = relation_id;
    } ).DataTable({ 
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
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
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                }
            }
        ],
    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "scrollX": true,
        "scrollY": '120vh',
        "order": [],
        "lengthMenu": [[10, 50, 100, 200, 250, -1], [10, 50, 100, 200, 250, 'All']],

        "ajax": {
            "url" : base_url+'relation_assign/relation_assign_list',
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
              "targets": [ 11 ],
              "orderable": false,
          }
        ],

    });
});



    $(document).on('click', '.kt_relation_assign_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this assign!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'relationeassign_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Assignment has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Assignment is safe :)", "error");

          }
        })
     });




$(document).ready(function() {
    $("#relationeassign_update").click(function(e){
       e.preventDefault();
        var branch            = $("#branch").val();
        var department        = $('#department').val();
        var designation       = $("#designation").val();
        var relation_type     = $("#relation_type").val();
        var employee          = $("#employee").val();
        var reason_type       = $('#reason_type').val();
        var date              = $('#date').val();
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
       
        
         if (!relation_type) { 
           $('#relation_type').addClass('is-invalid');
            return false;
        }
        else {
           $('#relation_type').removeClass('is-invalid');
        }

        if (!reason_type) { 
           $('#reason_type').addClass('is-invalid');
            return false;
        }
        else {
           $('#reason_type').removeClass('is-invalid');
        }
         
         if (!date) { 
           $('#date').addClass('is-invalid');
            return false;
        }
        else {
           $('#date').removeClass('is-invalid');
        }
        $('#form_relation_assign_update').attr("action",base_url+"common/db_add_update");
        $('#form_relation_assign_update').submit();
    

    }); 

});

    /***********Employee Relations List *******/
    $("#employrelationlist_print").on("click", function() {
        table.button( '.buttons-print' ).trigger();
    });

    $("#employrelationlist_copy").on("click", function() {
        table.button( '.buttons-copy' ).trigger();
    });

    $("#employrelationlist_excel").on("click", function() {
        table.button( '.buttons-excel' ).trigger();
    });
    
    $("#employrelationlist_csv").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });

    $("#employrelationlist_pdf").on("click", function() {
        table.button( '.buttons-pdf' ).trigger();
    });


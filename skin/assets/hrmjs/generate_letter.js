$(document).ready(function() {
    var pid = $('#processsss_id').val();


    table = $('#datatable-generate_letter') .on('preXhr.dt', function ( e, settings, data ) {
        data.process_id = pid;
    } ).DataTable({ 

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
            "url" : base_url+'issue_letter/issued_letter',
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
            "targets": [ 7 ],
            "orderable": false,
        },
        { 
            "targets": [ 8 ],
            "orderable": false,
        }
        ],

    });
});



$(document).ready(function() {
    $("#letter_save").click(function(e){
      
        e.preventDefault();
        var branch           = $("#branch").val();
        var department          = $('#department').val();
        var designation           = $("#designation").val();
        var employee          = $('#employee').val();
        var templete_id           = $("#templete_id").val();
        var url           = $("#url").val();
       
       
     /*   if (branch=="") {
          $('#branch').addClass('is-invalid');
          return false;
        } else{
          $('#branch').removeClass('is-invalid');
        }*/

    if (branch=="") {

            $('#branch').next().find('.select2-selection').addClass('select-dropdown-error');

          return false;
         } 
          else {
            $('#branch').next().find('.select2-selection').removeClass('select-dropdown-error');
         
        }

       /* if (department=="") {
          $('#department').addClass('is-invalid');
          return false;
        } else{
          $('#department').removeClass('is-invalid');
        }*/

            if (department=="") {

            $('#department').next().find('.select2-selection').addClass('select-dropdown-error');

          return false;
         } 
          else {
            $('#department').next().find('.select2-selection').removeClass('select-dropdown-error');
         
        }
        

    /*    if (designation=="") {
          $('#designation').addClass('is-invalid');
          return false;
        } else{
          $('#designation').removeClass('is-invalid');
        }*/
 if (designation=="") {

            $('#designation').next().find('.select2-selection').addClass('select-dropdown-error');

          return false;
         } 
          else {
            $('#designation').next().find('.select2-selection').removeClass('select-dropdown-error');
         
        }

/*
        if (employee=="") {
          $('#employee').addClass('is-invalid');
          return false;
        } else{
          $('#employee').removeClass('is-invalid');
        }

        if (templete_id=="") {
          $('#templete_id').addClass('is-invalid');
          return false;
        } else{
          $('#templete_id').removeClass('is-invalid');
        }*/

 if (employee=="") {

            $('#employee').next().find('.select2-selection').addClass('select-dropdown-error');

          return false;
         } 
          else {
            $('#employee').next().find('.select2-selection').removeClass('select-dropdown-error');
         
        }

         if (templete_id=="") {

            $('#templete_id').next().find('.select2-selection').addClass('select-dropdown-error');

          return false;
         } 
          else {
            $('#templete_id').next().find('.select2-selection').removeClass('select-dropdown-error');
         
        }
        
        $('#form_employee_letter_save').attr("action",base_url+"common/db_add_update");
        $('#form_employee_letter_save').submit();



    }); 
});

$(document).on('click', '.kt_template_form_fields_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/ajax_edit_data',
        data: {table:'qrecruitment_doc_fields',id:id},
        success: function(data){
          //console.log(data);
            var object = JSON.parse(data);

            $.each(object, function(key, value)
              {
                 $('#e_template_form_field_id').val(value.id);
                 $('#e_field_name').val(value.field_name);
                 $('#e_field_value').val(value.field_value);
              
              });
            $('#edittemplateformfields').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#template_form_field_update").click(function(e){
        e.preventDefault();
        var template_form_id = $("#e_template_form_field_id").val();
        var field_name       = $("#e_field_name").val();
        var field_value      = $('#e_field_value').val();

        
       
         if (field_name=="") {
         $('#e_field_name').addClass('is-invalid');
         return false;
         } else{
            $('#e_field_name').removeClass('is-invalid');
         } 
         if (field_value=="") {
         $('#e_field_value').addClass('is-invalid');
         return false;
         } else{
            $('#e_field_value').removeClass('is-invalid');
         } 
        
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'template_form_field_update',id:template_form_id,field_name:field_name,field_value:field_value},
        success: function(data){
        $('#edittemplateformfields').modal('hide');
           table.ajax.reload();
        $('#form_template_form_fields_update')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_template_form_fields_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Template Form Field !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'template_form_field_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your template form field has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your template form field is safe :)", "error");

          }
        })
     });
   

    $(document).on('click', '.generated_letter_delete', function () {
     var id = $(this).attr('id');
  
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Template Form Field !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'issue_letter_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your template form field has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your template form field is safe :)", "error");

          }
        })
     });
    $(document).ready(function()
    {
        $('#employee').select2();
          $('#employee').select2({
   placeholder: "Select"
});
    });

    //    $(document).ready(function()
    // {
    //     $('#e_letter_pipeline_process').select2();
    // });



       $(document).ready(function() {

     $('select[name="employee"]').on('change', function() {

            var employee = $(this).val();
            var process_id = $('#processsss_id').val();

               if (employee=="") {

               return false;
               } else{

               } 

           
                $.ajax({
                    url:base_url+'issue_letter/check_employee',
                    type: "POST",
                    data :{employee:employee,process_id:process_id},
                    success:function(data) {
                      data =data.replace(/\s/g, '');
                      console.log(data);


                    if(data=='0'){

                        $.ajax({
                    url:base_url+'issue_letter/check_order',
                    type: "POST",
                    data :{employee:employee,process_id:process_id},
                    success:function(data) {
                      data =data.replace(/\s/g, '');
                       if(data=='0'){
                        $('#letter_save').show();
                        $('#already_generated').hide();
                        $('#order').hide();
                         }else{
                          $('#letter_save').hide();
                          $('#already_generated').hide();
                          $('#order').show();
                             }
                          }
                      });

                        

                    }else{

                        $('#letter_save').hide();
                        $('#already_generated').show();
                        $('#order').hide();
                        }
                    }
                });
            
          });
      });



    /*   $(document).ready(function() {

        $('select[name="employee"]').on('change', function() {
         
            var employee = $('#employee').val();

              
           
                $.ajax({
                    url:base_url+'issue_letter/check_order',
                    type: "POST",
                    data :{id:template,employee:employee},
                    success:function(data) {
                      data =data.replace(/\s/g, '');
                      console.log(data);
                    if(data=='"PleaseGenerateInorder..."'){
                       $('.template_fields').text("Please Generate Letters in Order...");
                       $('#letter_save').hide();
                    }
                      var object = JSON.parse(data);
                     
                      $.each(object, function(key, value)
                        {
                        

                           tmplt += '<div class="col-lg-3">'
                           tmplt += '<label>'+value.field_name+'</label><input type = "text" class="form-control" name="'+value.field_name+'" id="'+value.field_name+'">'
                           tmplt += '</div>'
                           
                           $('.template_fields').html(tmplt);
                           $('#letter_save').show();
                        
                        });
                        
                        }
                });
            
          });
      });
*/



       $(document).ready(function() {

     $('select[name="fb_employee"]').on('change', function() {

            var employee = $(this).val();
            var process_id = $('#processsss_id').val();

               if (employee=="") {

               return false;
               } else{

               } 

           
          
           
                $.ajax({
                    url:base_url+'issue_letter/check_employee',
                    type: "POST",
                    data :{employee:employee,process_id:process_id},
                    success:function(data) {
                      data =data.replace(/\s/g, '');
                      console.log(data);


                    if(data=='0'){
                        $('#templete_save').show();
                        $('#fl_upload').show();
                        $('#already_uploaded').hide();

                    }else{

                   $('#templete_save').hide();
                        $('#fl_upload').hide();
                        $('#already_uploaded').show();
                      
                        
                        }
                    }
                });
            
          });
      });





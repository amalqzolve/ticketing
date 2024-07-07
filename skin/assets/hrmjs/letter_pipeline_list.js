var table;
$(document).ready(function() {

    table = $('#datatable-Letter_pipeline').DataTable({ 
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2,3]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2,3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2,3]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3]
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
            "url" : base_url+'basic_settings/letter_pipeline_list',
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
              "targets": [ 4 ],
              "orderable": false,
          },
        ],

    });
});



$(document).ready(function() {
    $("#letter_pipeline_save").click(function(e){
        e.preventDefault();
        var pipeline_name            = $("#pipeline").val();
        //var pipeline_method          = $('#pipeline_method').val();
        var letter_pipeline_stages   = $('#letter_pipeline_stages').val();
        var description              = $('#letter_pipeline_description').val();
       
         if (pipeline_name=="") {
         $('#pipeline').addClass('is-invalid');
         return false;
         } else{
            $('#pipeline').removeClass('is-invalid');
         } 
         
          if (letter_pipeline_stages == "") { 
            $('#letter_pipeline_stages').next().find('.select2-selection').addClass('select-dropdown-error');
             return false;
        }
         else {
         
            $('#letter_pipeline_stages').next().find('.select2-selection').removeClass('select-dropdown-error');

        }

          
 
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'letter_pipeline_save',pipeline_name:pipeline_name,letter_pipeline_stages:letter_pipeline_stages,description:description},
        success: function(data){
           if(data == 1)
          {
            
                 Swal.fire({

        text: "Already Exist",
        type: "error"
        });
          }
          else
          {
        $('#addletterpipeline').modal('hide');
           table.ajax.reload();
        $('#form_letter_pipeline_save')[0].reset();
        }},
       
      });

    }); 

});

$(document).on('click', '.kt_letter_pipeline_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/letter_pipeline_edit',
        data: {table:'qzolvehrm_letter_pipeline',id:id},
        success: function(data){


           var object = JSON.parse(data);
             var process_arr = [];

            $.each(object, function(key, value)
              {
                
              $('#e_letter_pipeline_id').val(value.id);  
             // $('#e_stage_name').val(value.stage_name);
              $.each(value.processes, function(keys, values)
              {
                process_arr.push(values.id);
                
              });
              //  $.each(value.pipeline, function(keys, valuess)
              // {
              //   $('#e_pipeline_method').append($("<option value="+valuess.id+" selected>"+valuess.method_name+"</option>"));
                
              // });
              $('#e_pipeline').val(value.pipeline_name);
             $('#e_letter_pipeline_description').val(value.description);
              });
            $('#e_letter_pipeline_stages').select2(); $('#e_letter_pipeline_stages').val(process_arr).trigger('change');
            $('#editletterpipeline').modal('show');

            // var object = JSON.parse(data);

            // $.each(object, function(key, value)
            //   {
            //      $('#e_process_id').val(value.id);
            //      $('#e_process_name').val(value.process_name);
            //      $('#e_process_description').val(value.description);
            //     // $('#e_payhead_category').val(value.payhead_category);
              
            //   });
            // $('#editcommonpipelineprocess').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#letter_pipeline_edit").click(function(e){
        e.preventDefault();
        var pipeline_id              = $("#e_letter_pipeline_id").val();
        var pipeline_name            = $("#e_pipeline").val();
        //var pipeline_method          = $('#e_pipeline_method').val();
        var letter_pipeline_stages   = $('#e_letter_pipeline_stages').val();
        var description              = $('#e_letter_pipeline_description').val();
       
         if (pipeline_name=="") {
         $('#e_pipeline').addClass('is-invalid');
         return false;
         } else{
            $('#e_pipeline').removeClass('is-invalid');
         } 
         // if (pipeline_method=="") {
         // $('#e_pipeline_method').addClass('is-invalid');
         // return false;
         // } else{
         //    $('#e_pipeline_method').removeClass('is-invalid');
         // } 
          if (letter_pipeline_stages=="") {
         $('#e_letter_pipeline_stages').addClass('is-invalid');
         return false;
         } else{
            $('#e_letter_pipeline_stages').removeClass('is-invalid');
         } 
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'letter_pipeline_edit',id:pipeline_id,pipeline_name:pipeline_name,description:description,letter_pipeline_stages:letter_pipeline_stages},
        success: function(data){
        $('#editletterpipeline').modal('hide');
           table.ajax.reload();
        $('#form_letter_pipeline_edit')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_letter_pipeline_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Letter Pipeline!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'letter_pipeline_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your letter Pipeline has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your letter Pipeline is safe :)", "error");

          }
        })
     });
    $(document).ready(function()
    {
        $('#letter_pipeline_stages').select2();
    });
     $(document).ready(function() {

        $('select[name="pipeline"]').on('change', function() {
            var pipeline = $(this).val();
            if(pipeline == 1) {
                $.ajax({
                    url:base_url+'basic_settings/get_recruitment',
                    type: "POST",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="pipeline_method"]').empty();
                        $('select[name="pipeline_method"]').append('<option value="'+ '' +'">'+ 'select' +'</option>');
                        $.each(data, function(key, value) {
                        $('select[name="pipeline_method"]').append('<option value="'+ value.id +'">'+ value.method_name +'</option>');
                        });
                    }
                });
            }
            else if(pipeline == 2) {
                $.ajax({
                    url:base_url+'basic_settings/get_onboard',
                    type: "POST",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="pipeline_method"]').empty();
                        $('select[name="pipeline_method"]').append('<option value="'+ '' +'">'+ 'select' +'</option>');
                        $.each(data, function(key, value) {
                        $('select[name="pipeline_method"]').append('<option value="'+ value.id +'">'+ value.method_name +'</option>');
                        });
                    }
                });
            }
              else if(pipeline == 3) {
                $.ajax({
                    url:base_url+'basic_settings/get_documentation',
                    type: "POST",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="pipeline_method"]').empty();
                        $('select[name="pipeline_method"]').append('<option value="'+ '' +'">'+ 'select' +'</option>');
                        $.each(data, function(key, value) {
                        $('select[name="pipeline_method"]').append('<option value="'+ value.id +'">'+ value.method_name +'</option>');
                        });
                    }
                });
            }
            else{
                $('select[name="pipeline_method"]').empty();
            }
        });
         
    });
$(document).ready(function() {

        $('select[name="e_pipeline"]').on('change', function() {
            var pipeline = $(this).val();
            if(pipeline == 1) {
                $.ajax({
                    url:base_url+'basic_settings/get_recruitment',
                    type: "POST",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="e_pipeline_method"]').empty();
                        $('select[name="e_pipeline_method"]').append('<option value="'+ '' +'">'+ 'select' +'</option>');
                        $.each(data, function(key, value) {
                        $('select[name="e_pipeline_method"]').append('<option value="'+ value.id +'">'+ value.method_name +'</option>');
                        });
                    }
                });
            }
            else if(pipeline == 2) {
                $.ajax({
                    url:base_url+'basic_settings/get_onboard',
                    type: "POST",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="e_pipeline_method"]').empty();
                        $('select[name="e_pipeline_method"]').append('<option value="'+ '' +'">'+ 'select' +'</option>');
                        $.each(data, function(key, value) {
                        $('select[name="e_pipeline_method"]').append('<option value="'+ value.id +'">'+ value.method_name +'</option>');
                        });
                    }
                });
            }
              else if(pipeline == 3) {
                $.ajax({
                    url:base_url+'basic_settings/get_documentation',
                    type: "POST",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="e_pipeline_method"]').empty();
                        $('select[name="e_pipeline_method"]').append('<option value="'+ '' +'">'+ 'select' +'</option>');
                        $.each(data, function(key, value) {
                        $('select[name="e_pipeline_method"]').append('<option value="'+ value.id +'">'+ value.method_name +'</option>');
                        });
                    }
                });
            }
            else{
                $('select[name="e_pipeline_method"]').empty();
            }
        });
         
    });

    
    $("#letterpipelineAdd_btn").click(function() {
      $("#pipeline").val('');
      $("#letter_pipeline_stages").val('').trigger('change');
      $("#letter_pipeline_description").val('');
      $("#addletterpipeline").modal({backdrop: 'static'});
      $("#addletterpipeline").modal('show');
    });
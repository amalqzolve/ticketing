var table;
$(document).ready(function() {

    table = $('#datatable-letter_pipeline_stage').DataTable({ 
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
            "url" : base_url+'basic_settings/letter_pipeline_stage_list',
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
        }
        ],

    });
});



$(document).ready(function() {
    $("#letter_pipeline_stage_save").click(function(e){
        e.preventDefault();
        var stage_name               = $("#stage_name").val();
        var letter_pipeline_process  = $('#letter_pipeline_process').val();
        var description              = $('#description').val();
        var name_error               = $("input[name ='name_error_msg']").val();
       
         if (stage_name=="") {
         $('#stage_name').addClass('is-invalid');
         return false;
         } else{
            $('#stage_name').removeClass('is-invalid');
         } 
        if (letter_pipeline_process == "") { 
            $('#letter_pipeline_process').next().find('.select2-selection').addClass('select-dropdown-error');
             return false;
        }
         else {
         
            $('#letter_pipeline_process').next().find('.select2-selection').removeClass('select-dropdown-error');

        }
        
       
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'letter_pipeline_stage_save',stage_name:stage_name,letter_pipeline_process:letter_pipeline_process,description:description},
        success: function(data){
          console.log(data)
            if(data == 1)
          {
            
                 Swal.fire({

        text: "Already Exist",
        type: "error"
        });
          }
          else
          {
        $('#addletterpipelinestage').modal('hide');
         $('#letter_pipeline_process').val('').trigger("change");
           table.ajax.reload();
        $('#form_letter_pipeline_stage_save')[0].reset();
        }},
       
      });
      
});
    }); 


$(document).on('click', '.kt_letter_pipeline_stage_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/letter_pipeline_stage_processedit_data',
        data: {table:'qzolvehrm_letter_pipeline_stage',id:id},
        success: function(data){

            // console.log(data);

            var object = JSON.parse(data);
             var process_arr = [];

            $.each(object, function(key, value)
              {
                console.log(value);
              $('#e_stage_id').val(value.id);  
              $('#e_stage_name').val(value.stage_name);
              $.each(value.processes, function(keys, values)
              {
                process_arr.push(values.id);
                
              });
             $('#e_description').val(value.description);
              });
            $('#e_letter_pipeline_process').select2(); $('#e_letter_pipeline_process').val(process_arr).trigger('change');
            $('#editletterpipelinestage').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#letter_pipeline_stage_update").click(function(e){
        e.preventDefault();
        var stage_id                    = $("#e_stage_id").val();
        var stage_name                  = $("#e_stage_name").val();
        var letter_pipeline_process     = $('#e_letter_pipeline_process').val();
        var description                 = $('#e_description').val();
       
         if (stage_name=="") {
         $('#e_stage_name').addClass('is-invalid');
         return false;
         } else{
            $('#e_stage_name').removeClass('is-invalid');
         } 
         if (letter_pipeline_process=="") {
         $('#e_letter_pipeline_process').addClass('is-invalid');
         return false;
         } else{
            $('#e_letter_pipeline_process').removeClass('is-invalid');
         }
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'letter_pipeline_stage_update',id:stage_id,stage_name:stage_name,letter_pipeline_process:letter_pipeline_process,description:description},
        success: function(data){
        $('#editletterpipelinestage').modal('hide');
           table.ajax.reload();
        $('#form_letter_pipeline_stage_update')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_letter_pipeline_stage_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Letter Pipeline Stages!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'letter_pipeline_stage_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Letter Pipeline Stages has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Letter Pipeline Stages is safe :)", "error");

          }
        })
     });

    $(document).ready(function()
    {
        $('#letter_pipeline_process').select2();
    });

       $(document).ready(function()
    {
        $('#e_letter_pipeline_process').select2();
    });

    $("#letterpipelinestageAdd_btn").click(function() {
        $("#stage_name").val('');
        $("#letter_pipeline_process").val('').trigger('change');
        $("#description").val('');
        $("#addletterpipelinestage").modal({backdrop: 'static'});
        $("#addletterpipelinestage").modal('show');
    });

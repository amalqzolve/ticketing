var table;
$(document).ready(function() {

    table = $('#datatable-common_pipeline_stage').DataTable({ 

    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],

        "ajax": {
            "url" : base_url+'basic_settings/common_pipeline_stage_list',
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
    $("#common_pipeline_stage_save").click(function(e){
        e.preventDefault();
        var stage_name         = $("#stage_name").val();
        var pipeline_process  =$('#pipeline_process').val();
        var description          = $('#description').val();
       
         if (stage_name=="") {
         $('#stage_name').addClass('is-invalid');
         return false;
         } else{
            $('#stage_name').removeClass('is-invalid');
         } 
         if (pipeline_process=="") {
         $('#pipeline_process').addClass('is-invalid');
         return false;
         } else{
            $('#pipeline_process').removeClass('is-invalid');
         } 


        
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'common_pipeline_stage_save',stage_name:stage_name,pipeline_process:pipeline_process,description:description},
        success: function(data){
        $('#addcommonpipelinestage').modal('hide');
           table.ajax.reload();
        $('#form_employee_type_save')[0].reset();
        },
       
      });

    }); 

});

$(document).on('click', '.kt_common_pipeline_stage_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/common_pipeline_stage_processedit_data',
        data: {table:'qrecruitment_common_pipeline_stages',id:id},
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
            $('#e_pipeline_process').select2(); $('#e_pipeline_process').val(process_arr).trigger('change');
            $('#editcommonpipelinestage').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#common_pipeline_stage_update").click(function(e){
        e.preventDefault();
        var stage_id          = $("#e_stage_id").val();
        var stage_name         = $("#e_stage_name").val();
        var pipeline_process  =$('#e_pipeline_process').val();
        var description          = $('#e_description').val();
       
         if (stage_name=="") {
         $('#e_stage_name').addClass('is-invalid');
         return false;
         } else{
            $('#e_stage_name').removeClass('is-invalid');
         } 
         if (pipeline_process=="") {
         $('#e_pipeline_process').addClass('is-invalid');
         return false;
         } else{
            $('#e_pipeline_process').removeClass('is-invalid');
         }
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'common_pipeline_stage_update',id:stage_id,stage_name:stage_name,pipeline_process:pipeline_process,description:description},
        success: function(data){
        $('#editcommonpipelinestage').modal('hide');
           table.ajax.reload();
        $('#form_common_pipeline_stage_update')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_common_pipeline_stage_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Common Pipeline Stages!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'common_pipeline_stage_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Common Pipeline Stages has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Common Pipeline Stages is safe :)", "error");

          }
        })
     });

    $(document).ready(function()
    {
        $('#pipeline_process').select2();
    });

       $(document).ready(function()
    {
        $('#e_pipeline_process').select2();
    });

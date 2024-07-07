var table;
$(document).ready(function() {

    table = $('#datatable-common_pipeline').DataTable({ 

    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],

        "ajax": {
            "url" : base_url+'basic_settings/common_pipeline_list',
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
    $("#common_pipeline_save").click(function(e){
        e.preventDefault();
        var pipeline_name            = $("#pipeline").val();
        var pipeline_method          = $('#pipeline_method').val();
        var pipeline_stages          = $('#pipeline_stages').val();
        var description              = $('#common_pipeline_description').val();
       
         if (pipeline_name=="") {
         $('#pipeline').addClass('is-invalid');
         return false;
         } else{
            $('#pipeline').removeClass('is-invalid');
         } 
         if (pipeline_method=="") {
         $('#pipeline_method').addClass('is-invalid');
         return false;
         } else{
            $('#pipeline_method').removeClass('is-invalid');
         } 
          if (pipeline_stages=="") {
         $('#pipeline_stages').addClass('is-invalid');
         return false;
         } else{
            $('#pipeline_stages').removeClass('is-invalid');
         } 



        
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'common_pipeline_save',pipeline_name:pipeline_name,pipeline_method:pipeline_method,pipeline_stages:pipeline_stages,description:description},
        success: function(data){
        $('#addcommonpipeline').modal('hide');
           table.ajax.reload();
        $('#form_common_pipeline_save')[0].reset();
        },
       
      });

    }); 

});

$(document).on('click', '.kt_common_pipeline_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/common_pipeline_edit',
        data: {table:'qrecruitment_common_pipeline',id:id},
        success: function(data){

          //console.log(data);
           var object = JSON.parse(data);
             var process_arr = [];
             var pipeline_method = [];

            $.each(object, function(key, value)
              {
               console.log(value.processes);
              console.log(value.pipeline);

                if(value.pipeline_for == 1)
                {

                 $('#e_pipeline').append($("<option value="+1+" selected>recruitment</option>"));

                }
                 if(value.pipeline_for == 2)
                {
                 $('#e_pipeline').append($("<option value="+2+" selected>onboard</option>"));

                }
                 if(value.pipeline_for == 3)
                {
                 $('#e_pipeline').append($("<option value="+3+" selected>Documentation</option>"));

                }
                if(value.pipeline_for == 4)
                {
                 $('#e_pipeline').append($("<option value="+4+" selected>Letter</option>"));

                }
              $('#e_common_pipeline_id').val(value.id);  
             // $('#e_stage_name').val(value.stage_name);
              $.each(value.processes, function(keys, values)
              {
                process_arr.push(values.id);
                
              });
               $.each(value.pipeline, function(keys, valuess)
              {
               
                
                $('#e_pipeline_method').append($("<option value="+valuess.id+" selected>"+valuess.method_name+"</option>"));
                
              });
              //console.log(process_arr);
             $('#e_common_pipeline_description').val(value.description);
              });
            $('#e_pipeline_stages').select2(); $('#e_pipeline_stages').val(process_arr).trigger('change');
            $('#editcommonpipeline').modal('show');

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
    $("#common_pipeline_edit").click(function(e){
        e.preventDefault();
        var pipeline_id              = $("#e_common_pipeline_id").val();
        var pipeline_name            = $("#e_pipeline").val();
        var pipeline_method          = $('#e_pipeline_method').val();
        var pipeline_stages          = $('#e_pipeline_stages').val();
        var description              = $('#e_common_pipeline_description').val();
       
         if (pipeline_name=="") {
         $('#e_pipeline').addClass('is-invalid');
         return false;
         } else{
            $('#e_pipeline').removeClass('is-invalid');
         } 
         if (pipeline_method=="") {
         $('#e_pipeline_method').addClass('is-invalid');
         return false;
         } else{
            $('#e_pipeline_method').removeClass('is-invalid');
         } 
          if (pipeline_stages=="") {
         $('#e_pipeline_stages').addClass('is-invalid');
         return false;
         } else{
            $('#e_pipeline_stages').removeClass('is-invalid');
         } 
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'common_pipeline_edit',id:pipeline_id,pipeline_name:pipeline_name,pipeline_method:pipeline_method,description:description,pipeline_stages:pipeline_stages},
        success: function(data){
        $('#editcommonpipeline').modal('hide');
           table.ajax.reload();
        $('#form_common_pipeline_edit')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_common_pipeline_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Common Pipeline!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'common_pipeline_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Common Pipeline has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Common Pipeline is safe :)", "error");

          }
        })
     });
    $(document).ready(function()
    {
        $('#pipeline_stages').select2();
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
            else if(pipeline == 4) {
                $.ajax({
                    url:base_url+'basic_settings/get_letter',
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
            else if(pipeline == 4) {
                $.ajax({
                    url:base_url+'basic_settings/get_letter',
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

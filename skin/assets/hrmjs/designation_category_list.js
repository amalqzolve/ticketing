var table;
$(document).ready(function() {

    table = $('#datatable-designation_category').DataTable({ 

    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],

        "ajax": {
            "url" : base_url+'basic_settings/designation_category_list',
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
    $("#designation_category_save").click(function(e){
        e.preventDefault();
        var designation           = $("#designation").val();
        var designation_id_format = $('#designation_id_format').val();
        var starting_number       = $('#starting_number').val();
       
        if (designation=="") {
          $('#designation').addClass('is-invalid');
          return false;
        } else{
          $('#designation').removeClass('is-invalid');
        }

        if (designation_id_format=="") {
          $('#designation_id_format').addClass('is-invalid');
          return false;
        } else{
          $('#designation_id_format').removeClass('is-invalid');
        }

        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'designation_category_save',designation:designation,designation_id_format:designation_id_format,starting_number:starting_number},
        success: function(data){
        $('#adddesignationcategory').modal('hide');
        table.ajax.reload();
        $('#form_designation_category_save')[0].reset();
        },
      });
    }); 
});

$(document).on('click', '.kt_designation_category_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/designation_category_edit',
        data: {table:'qrecruitment_designation_category',id:id},
        success: function(data){
          console.log(data);
            var object = JSON.parse(data);

            $.each(object, function(key, value)
              {
                 $('#e_designation_id').val(value.id);
                 $('#e_designation').append($("<option value="+value.desig_id+" selected>"+value.designation_name+"</option>"));
                 $('#e_designation_id_format').val(value.id_format);
                 $('#e_starting_number').val(value.starting_number);
              
              });
            $('#editdesignationcategory').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#designation_category_update").click(function(e){
        e.preventDefault();
        var designation_id           = $("#e_designation_id").val();
        var designation              = $("#e_designation").val();
        var designation_id_format    = $('#e_designation_id_format').val();
        var starting_number          = $('#e_starting_number').val();
        
       
         if (designation=="") {
         $('#e_designation').addClass('is-invalid');
         return false;
         } else{
            $('#e_designation').removeClass('is-invalid');
         } 
         if (designation_id_format=="") {
         $('#e_designation_id_format').addClass('is-invalid');
         return false;
         } else{
            $('#e_designation_id_format').removeClass('is-invalid');
         } 
        
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'designation_category_edit',id:designation_id,designation:designation,designation_id_format:designation_id_format,starting_number:starting_number},
        success: function(data){
        $('#editdesignationcategory').modal('hide');
           table.ajax.reload();
        $('#form_designation_category_edit')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_designation_category_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Designation Category !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'designation_category_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Designation Category has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Designation Category is safe :)", "error");

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
            else{
                $('select[name="pipeline_method"]').empty();
            }
        });
         
    });

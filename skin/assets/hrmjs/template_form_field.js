var table;
$(document).ready(function() {

    table = $('#datatable-template_form_fields').DataTable({ 

    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],

        "ajax": {
            "url" : base_url+'template_form/template_form_field_list',
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
    $("#template_form_field_save").click(function(e){
        e.preventDefault();
        var field_name           = $("#field_name").val();
        var field_value          = $('#field_value').val();
       
        if (field_name=="") {
          $('#field_name').addClass('is-invalid');
          return false;
        } else{
          $('#field_name').removeClass('is-invalid');
        }

        if (field_value=="") {
          $('#field_value').addClass('is-invalid');
          return false;
        } else{
          $('#field_value').removeClass('is-invalid');
        }

        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'template_form_field_save',field_name:field_name,field_value:field_value},
        success: function(data){
        $('#addtemplateformfields').modal('hide');
        table.ajax.reload();
        $('#form_template_form_fields_save')[0].reset();
        },
      });
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
   
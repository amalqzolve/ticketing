var table;
$(document).ready(function() {

    table = $('#datatable-employee_type').DataTable({ 

    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],

        "ajax": {
            "url" : base_url+'basic_settings/employee_type_list',
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
    $("#employee_type_save").click(function(e){
        e.preventDefault();
        var employee_type         = $("#employee_type").val();
        var employee_type_description     = $('#employee_type_description').val();
       
         if (employee_type=="") {
         $('#employee_type').addClass('is-invalid');
         return false;
         } else{
            $('#employee_type').removeClass('is-invalid');
         } 

        
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'employee_type_save',employee_type:employee_type,employee_type_description:employee_type_description},
        success: function(data){
        $('#addemployeetype').modal('hide');
           table.ajax.reload();
        $('#form_employee_type_save')[0].reset();
        },
       
      });

    }); 

});

$(document).on('click', '.kt_employee_type_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/ajax_edit_data',
        data: {table:'qrecruitment_employee_type',id:id},
        success: function(data){

            var object = JSON.parse(data);

            $.each(object, function(key, value)
              {
                 $('#e_employee_type_id').val(value.id);
                 $('#e_employee_type').val(value.employee_type);
                 $('#e_employee_type_description').val(value.description);
                // $('#e_payhead_category').val(value.payhead_category);
              
              });
            $('#editemployeetype').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#employee_type_edit").click(function(e){
        e.preventDefault();
         var employee_type_id               = $("#e_employee_type_id").val();
         var employee_type                 = $("#e_employee_type").val();
         var employee_type_description     = $('#e_employee_type_description').val();
       
         if (employee_type=="") {
         $('#e_employee_type').addClass('is-invalid');
         return false;
         } else{
            $('#e_employee_type').removeClass('is-invalid');
         } 
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'employee_type_edit',id:employee_type_id,employee_type:employee_type,employee_type_description:employee_type_description},
        success: function(data){
        $('#editemployeetype').modal('hide');
           table.ajax.reload();
        $('#form_employee_type_edit')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_employee_type_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Employee Type!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'employee_type_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Employee Type has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Employee Type is safe :)", "error");

          }
        })
     });

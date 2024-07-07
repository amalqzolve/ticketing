var table;
$(document).ready(function() {

    table = $('#datatable-onboard_method').DataTable({ 

    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],

        "ajax": {
            "url" : base_url+'basic_settings/onboard_method_list',
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
    $("#onboard_method_save").click(function(e){
        e.preventDefault();
        var onboard_method                 = $("#onboard_method_name").val();
        var description     = $('#onboard_method_description').val();
       
         if (onboard_method=="") {
         $('#onboard_method_name').addClass('is-invalid');
         return false;
         } else{
            $('#onboard_method_name').removeClass('is-invalid');
         } 

        
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'onboard_method_save',onboard_method:onboard_method,description:description},
        success: function(data){
        $('#addonboardmethod').modal('hide');
           table.ajax.reload();
        $('#form_onboard_method_save')[0].reset();
        },
       
      });

    }); 

});

$(document).on('click', '.kt_onboard_method_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/ajax_edit_data',
        data: {table:'qrecruitment_onboard_method',id:id},
        success: function(data){

            var object = JSON.parse(data);

            $.each(object, function(key, value)
              {
                 $('#e_onboard_method_id').val(value.id);
                 $('#e_onboard_method_name').val(value.method_name);
                 $('#e_onboard_method_description').val(value.description);
                // $('#e_payhead_category').val(value.payhead_category);
              
              });
            $('#editonboardmethod').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#onboard_method_update").click(function(e){
        e.preventDefault();
         var onboard_method_id               = $("#e_onboard_method_id").val();
         var onboard_method                 = $("#e_onboard_method_name").val();
         var description     = $('#e_onboard_method_description').val();
       
         if (onboard_method=="") {
         $('#e_onboard_method_name').addClass('is-invalid');
         return false;
         } else{
            $('#e_onboard_method_name').removeClass('is-invalid');
         } 
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'onboard_method_edit',id:onboard_method_id,onboard_method:onboard_method,description:description},
        success: function(data){
        $('#editonboardmethod').modal('hide');
           table.ajax.reload();
        $('#form_onboard_method_update')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_onboard_method_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Onboard Method!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'onboard_method_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Onboard Method has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Onboard Method is safe :)", "error");

          }
        })
     });

var table;
$(document).ready(function() {

    table = $('#datatable-letter_method').DataTable({ 

    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],

        "ajax": {
            "url" : base_url+'basic_settings/letter_method_list',
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
    $("#letter_method_save").click(function(e){
        e.preventDefault();
        var letter_method   = $("#letter_method_name").val();
        var description     = $('#letter_method_description').val();
       
         if (letter_method=="") {
         $('#letter_method_name').addClass('is-invalid');
         return false;
         } else{
            $('#letter_method_name').removeClass('is-invalid');
         } 

        
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'letter_method_save',letter_method:letter_method,description:description},
        success: function(data){
        $('#addlettermethod').modal('hide');
           table.ajax.reload();
        $('#form_letter_method_save')[0].reset();
        },
       
      });

    }); 

});

$(document).on('click', '.kt_letter_method_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/ajax_edit_data',
        data: {table:'qrecruitment_letter_method',id:id},
        success: function(data){

            var object = JSON.parse(data);

            $.each(object, function(key, value)
              {
                 $('#e_letter_method_id').val(value.id);
                 $('#e_letter_method_name').val(value.method_name);
                 $('#e_letter_method_description').val(value.description);
                // $('#e_payhead_category').val(value.payhead_category);
              
              });
            $('#editlettermethod').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#letter_method_edit").click(function(e){
        e.preventDefault(); 
        var letter_method_id = $('#e_letter_method_id').val();
        var letter_method    = $("#e_letter_method_name").val();
        var description      = $('#e_letter_method_description').val();
       
         if (letter_method=="") {
         $('#e_letter_method_name').addClass('is-invalid');
         return false;
         } else{
            $('#e_letter_method_name').removeClass('is-invalid');
         } 
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'letter_method_edit',id:letter_method_id,letter_method:letter_method,description:description},
        success: function(data){
        $('#editlettermethod').modal('hide');
           table.ajax.reload();
        $('#form_letter_method_edit')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_letter_method_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Letter Method!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'letter_method_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Letter Method has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Letter Method is safe :)", "error");

          }
        })
     });

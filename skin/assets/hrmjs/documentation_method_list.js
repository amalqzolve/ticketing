var table;
$(document).ready(function() {

    table = $('#datatable-documentation_method').DataTable({ 

    	"pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],

        "ajax": {
            "url" : base_url+'basic_settings/documentation_method_list',
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
    $("#documentation_method_save").click(function(e){
        e.preventDefault();
        var document_method = $("#documentation_method_name").val();
        var description     = $('#documentation_method_description').val();
       
         if (document_method=="") {
         $('#documentation_method_name').addClass('is-invalid');
         return false;
         } else{
            $('#documentation_method_name').removeClass('is-invalid');
         } 

        
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'documentation_method_save',document_method:document_method,description:description},
        success: function(data){
        $('#adddocumentationmethod').modal('hide');
           table.ajax.reload();
        $('#form_documentation_method_save')[0].reset();
        },
       
      });

    }); 

});

$(document).on('click', '.kt_document_method_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/ajax_edit_data',
        data: {table:'qrecruitment_document_method',id:id},
        success: function(data){

            var object = JSON.parse(data);

            $.each(object, function(key, value)
              {
                 $('#e_documentation_method_id').val(value.id);
                 $('#e_documentation_method_name').val(value.method_name);
                 $('#e_documentation_method_description').val(value.description);
                // $('#e_payhead_category').val(value.payhead_category);
              
              });
            $('#editdocumentationmethod').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#documentation_method_edit").click(function(e){
        e.preventDefault(); 
        var document_method_id = $('#e_documentation_method_id').val();
        var document_method = $("#e_documentation_method_name").val();
        var description     = $('#e_documentation_method_description').val();
       
         if (document_method=="") {
         $('#documentation_method_name').addClass('is-invalid');
         return false;
         } else{
            $('#documentation_method_name').removeClass('is-invalid');
         } 
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'documentation_method_edit',id:document_method_id,document_method:document_method,description:description},
        success: function(data){
        $('#editdocumentationmethod').modal('hide');
           table.ajax.reload();
        $('#form_documentation_method_edit')[0].reset();
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_document_method_delete', function () {
     var id = $(this).attr('id');
   
       Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Document Method!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : base_url+'common/db_add_update',
              data: {What:'document_method_delete',id:id},
              success: function(data) {
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Document Method has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Document Method is safe :)", "error");

          }
        })
     });

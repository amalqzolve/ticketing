var table;
$(document).ready(function() {

    table = $('#Templete_field_table_1').DataTable({ 
      "dom": 'Blfrtip',
       /* "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2]
                },
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2]
                }
            }
        ],
    	"pagingType": 'full_numbers',*/
       "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0,1,2]
                },
                orientation: 'landscape',
                pageSize: 'A4',
                customize : function(doc) {
                    doc.pageMargins = [50,50,50,50];
                  
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2]
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
            "url" : base_url+'documents_process/templete_list',
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
            "targets": [ 3 ],
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
    $("#templete_field_submit").click(function(e){
        e.preventDefault();
        var templete_name         = $("#templete_name").val();
        var fields                = $('#fields').val();

       
         if (templete_name=="") {
         $('#templete_name').addClass('is-invalid');
         return false;
         } else{
            $('#templete_name').removeClass('is-invalid');
         } 

        
          if (fields=="") {
         $('#fields').addClass('is-invalid');
         return false;
         } else{
            $('#fields').removeClass('is-invalid');
         } 


        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
        data: {What:'templete_field_save',templete_name:templete_name,fields:fields},
        success: function(data){
          console.log(data);
          if(data == 1)
          {
            
                 Swal.fire({

        text: "Already Exist",
        type: "error"
        });

          $('#templete_name').val('').trigger("change");
        $('#fields').val('').trigger("change");

          }
          else
          {
          $('#templete_name').val('').trigger("change");
          $('#fields').val('').trigger("change");

        $('#addTemplete_field').modal('hide');
           table.ajax.reload();
        $('#form_templetefield_save')[0].reset();

      }
        },
       
      });

    }); 

});

$(document).on('click', '.kt_templete_fields_edit', function () {
    
    var id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url : base_url+'common/templete_edit_data',
        data: {id:id},
        success: function(data){
            console.log(data);
                 
            var object = JSON.parse(data);
             var process_arr = [];

            $.each(object, function(key, value)
              {
                $('#e_templete_name').val(value.tid);
                $('#e_templete_name').trigger('change');
             // $('#e_templete_name').append('<option value="'+value.tid+'" selected>'+value.process_name+'</option>');
              $('#e_templete_id').val(value.id);
              $.each(value.fields, function(keys, values)
              {
                process_arr.push(values.id);
                
              });
              });
            $('#e_fields').select2(); $('#e_fields').val(process_arr).trigger('change');
         

            $('#kt_templete_fields_edit_modal').modal('show');
       },
       
  });
     
});


$(document).ready(function() {
    $("#templete_field_update").click(function(e){
        e.preventDefault();
         var templete_id               = $("#e_templete_id").val();
         var templete_name                 = $("#e_templete_name").val();
         var fields     = $('#e_fields').val();

         if (templete_name=="") {
         $('#e_templete_name').addClass('is-invalid');
         return false;
         } else{
            $('#e_templete_name').removeClass('is-invalid');
         } 
          
        $.ajax({
        type: "POST",
        url : base_url+'common/db_add_update',
       data: {What:'templete_field_update',templete_id:templete_id,templete_name:templete_name,fields:fields},
        
        success: function(data){
          $('#e_templete_name').val('').trigger("change");
          $('#e_fields').val('').trigger("change");
        $('#kt_templete_fields_edit_modal').modal('hide');
           table.ajax.reload();
        $('#form_payTemplete_update')[0].reset();
         $('#templete_name').val('').trigger("change");
        $('#fields').val('').trigger("change");
        },
       
   });

    }); 

});



    $(document).on('click', '.kt_templete_fields_delete', function () {
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
              data: {What:'templete_field_delete',id:id},
              success: function(data) {
                $('#templete_name').val('').trigger("change");
          $('#fields').val('').trigger("change");
                  table.ajax.reload();
                  swal.fire("Deleted!", "Your Employee Type has been deleted.", "success");
             }
          });
          } else {
            swal.fire("Cancelled", "Your Employee Type is safe :)", "error");

          }
        })
     });

$(document).ready(function() {
    $('.kt-select2').select2();
});
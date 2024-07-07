var table = $('#suppliertypedetails_list').DataTable({
        "dom"        : 'B<"top"f>rt<"bottom"lp>',
        "lengthMenu" : [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        "buttons": [
            {
             extend: 'pageLength',
             className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
             extend: 'copy',
             className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
              extend: 'csv',
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
              extend: 'excel',
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
              extend: 'pdf',
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
              exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
              }
            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        "select": {
            style   :  'os',
            selector: 'td:first-child'
        },
        select: true,
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'suppliertypeList',
            "type": "GET",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });
var table = $('#trashtype').DataTable({
        "dom"        : 'B<"top"f>rt<"bottom"lp>',
        "lengthMenu" : [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        "buttons": [
            {
             extend: 'pageLength',
             className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
             extend: 'copy',
             className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
              extend: 'csv',
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
              extend: 'excel',
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
              extend: 'pdf',
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
              exportOptions: {
                columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
              }
            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        "select": {
            style   :  'os',
            selector: 'td:first-child'
        },
        select: true,
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'suppliertypetrash',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });

$(document).on('click', '.typerestore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Customer Category Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'typeTrashRestores',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Customer Category Entry has been deleted.", "success");
                window.location.href="supplier_type";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Customer Entry is safe :)", "error");

          }
        })
     });




$(document).on('click', '#suppliertypedetail_submit', function(){
  

         $('#supplier-form').validate(  {
          rules: {
            title : "required",
            
            },
          messages: {
            name  : "Please s pecify your supplier Type",
           
          }

         });


        if (!$('#supplier-form').valid()) // check if form is valid
        {
           return false;

        }

       


        //console.log();

        //alert($("input[name='addmore']").val());

        $.ajax({
            type : "POST",
            url  : "suppliertypeSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        cust_id          : $('#id').val(),
                        title            : $('#title').val(),
                        discription      : $('#discription').val(),
                        color           : $('#color').val()
                        
                        

                    },
            success: function(data){

                  closeModel();


                  swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();

            },
            error   : function ( jqXhr, json, errorThrown )
            {
                var errors = jqXhr.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    if(jQuery.isPlainObject( value )){

                      $.each(value, function( index, ndata ) {
                        errorsHtml += '<li>' + ndata + '</li>';
                      });

                    }else{

                    errorsHtml += '<li>' + value + '</li>';

                    }
                });
                 toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });
  
function closeModel(){

      $("#kt_modal_4_7").modal("hide");

      $('#name').val("");
      
      $('#id').val("");
      

   }

  $(document).on('click', '.close,.closeBtn', function(){
     closeModel();
  });


$(document).on('click', '.suppliertypedetail_update', function(){
           var cust_id = $(this).attr("data-id");
           $.ajax({
                url       : "getsuppliertype",
                method    : "POST",
                data      : {
              _token      : $('#token').val(),
              cust_id     : cust_id
                    },
                dataType  : "json",
                success:function(data)
                {
                    $('#title').val(data['users'].title);
                    $('#discription').val(data['users'].discription);
                    $('#color').val(data['users'].color);
                     
                     $('#id').val(cust_id);
                     $("#usersInformation").modal("hide");
                     
                }
           })
      });





$(document).on('click', '.kt_del_supplierinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Payroll  Master Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'deletesuppliertypeInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
               // table.ajax.reload();
               swal.fire("Deleted!", "Your Payroll  Master Entry has been deleted.", "success");
               location.reload();
             }
          });
          } else {
            swal.fire("Cancelled", "Your Payroll  Master Entry is safe :)", "error");
          }
        })
       });







var table = $('#supplierdetails_list').DataTable({
        "dom"        : 'B<"top"f>rt<"bottom"lp>',
        "lengthMenu" : [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        "buttons": [
            {
                extend: 'pageLength',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'copy',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'csv',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'excel',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'pdf',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
                }
            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        "select": {
            style   :  'os',
            selector: 'td:first-child'
        },
        select: true,
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'SupplierList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }
    });

$(document).on('click', '.kt_del_customerinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Supplier Details Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deletesupplierInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Supplier Details Entry has been deleted.", "success");
                  location.reload();
             }
          });
          } else {

            swal.fire("Cancelled", "Your Supplier Details Entry is safe :)", "error");
          }
        })
       });


var table = $('#supplierdetailstrash_list').DataTable({
        "dom"        : 'B<"top"f>rt<"bottom"lp>',
        "lengthMenu" : [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        "buttons": [
            {
                extend: 'pageLength',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'copy',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'csv',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'excel',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
            },
            {
                extend: 'pdf',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9,10,11,12,13,14]
                }
            },
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                className:'btn btn-outline-brand btn-elevate btn-pill hideButton',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        "select": {
            style   :  'os',
            selector: 'td:first-child'
        },
        select: true,
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'suptrashlist',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });



$(document).on('click', '#Supplier_submit', function(e){
       e.preventDefault();
        var contact_personvalue=[];

        var contact_person_incharges=[];
        var mobiles=[];
        var offices=[]; 
        var emails=[];
        var departments=[]; 
        var locations=[];
        $(".addmore").each(function() {
         contact_personvalue.push($(this).find(".contact_personvalue").val());
        contact_person_incharges.push($(this).find(".contact_person_incharge").val());

         mobiles.push($(this).find(".mobiles").val());
         offices.push($(this).find(".offices").val()); 
         emails.push($(this).find(".emails").val());
         departments.push($(this).find(".departments").val());
         locations.push($(this).find(".locations").val());
        });

        $.ajax({
            type : "POST",
            url  : "SupplierSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        info_id          : $('#id').val(),
                        sup_code         : $('#sup_code').val(),
                        sup_type         : $('#sup_type').val(),
                        sup_category     : $('#sup_category').val(),
                        salesman         : $('#salesman').val(),
                        key_account      : $('#key_account').val(),
                        sup_note         : $('#sup_note').val(),
                        sup_name         : $('#sup_name').val(),
                        sup_add1         : $('#sup_add1').val(),
                        sup_add2         : $('#sup_add2').val(),
                        sup_country      : $('#sup_country').val(),
                        sup_region       : $('#sup_region').val(),
                        sup_city         : $('#sup_city').val(),
                        sup_zip          : $('#sup_zip').val(),
                        email1           : $('#email1').val(),
                        email2           : $('#email2').val(),
                        office_phone1    : $('#office_phone1').val(),
                        office_phone2    : $('#office_phone2').val(),
                        mobile1          : $('#mobile1').val(),
                        mobile2          : $('#mobile2').val(),
                        fax              : $('#fax').val(),
                        website          : $('#website').val(),
                        contact_person   : $('#contact_person').val(),
                        contact_person_incharge : $('#contact_person_incharge').val(),
                        mobile           : $('#mobile').val(),
                        office           : $('#office').val(),
                        contact_department: $('#contact_department').val(),
                        email            : $('#email').val(),
                        location         : $('#location').val(),
                        
                        portal           : $('#portal').val(),
                        username         : $('#username').val(),
                        registerd_email  : $('#registerd_email').val(),
                        password         : $('#password').val(),
                        contact_personvalue     :contact_personvalue,
                        contact_person_incharges:contact_person_incharges,
                        mobiles         :mobiles,
                        offices         :offices,
                        emails          :emails,
                        departments     :departments,
                        locations       :locations,

                    },
            success: function(data){
                  swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
                  window.location.href="supplierdetails";
            },
            error   : function ( jqXhr, json, errorThrown )
            {
                var errors = jqXhr.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    if(jQuery.isPlainObject( value )){

                      $.each(value, function( index, ndata ) {
                        errorsHtml += '<li>' + ndata + '</li>';
                      });

                    }else{

                    errorsHtml += '<li>' + value + '</li>';

                    }
                });
               toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });


$(document).on('click', '.kt_restore_supplierinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Supplier  Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'supplierTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Supplier Entry has been deleted.", "success");
                window.location.href="supplierdetails";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Supplier Entry is safe :)", "error");

          }
        })
     });

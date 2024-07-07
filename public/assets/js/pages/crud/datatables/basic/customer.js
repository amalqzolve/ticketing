var table = $('#customerdetails_list').DataTable({
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
            "url" : 'CustomerList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }
    });

var table = $('#customertypedetails_list').DataTable({
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
            "url" : 'CustomertypeList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });

var table = $('#trashdetailslisttype').DataTable({
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
            "url" : 'typetrashlist',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });


var table = $('#customerdetailstrash_list').DataTable({
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
            "url" : 'Customertrashlist',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });

var table = $('#trashdetailslistcategory').DataTable({
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
            "url" : 'Categorytrashlist',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });

$(document).on('click', '.kt_restore_customerinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this  Customer  Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'customerTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Customer Entry has been deleted.", "success");
                window.location.href="customerdetails";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Customer Entry is safe :)", "error");

          }
        })
     });


$(document).on('click', '.Customersdetail_update', function(){
    // alert("ed");

           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "getSinglecustomerInfo",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      info_id     : info_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#cust_code').val(data['users'].cust_code);
                     $('#cust_type').val(data['users'].cust_type);
                     $('#cust_category').val(data['users'].cust_category);
                     $('#salesman').val(data['users'].salesman);
                     $('#key_account').val(data['users'].key_account);
                     $('#cust_note').val(data['users'].cust_note);
                     $('#cust_name').val(data['users'].cust_name);
                     $('#cust_add1').val(data['users'].cust_add1);
                     $('#cust_add2').val(data['users'].cust_add2);
                     $('#cust_country').val(data['users'].cust_country);
                     $('#cust_region').val(data['users'].cust_region);
                     $('#cust_city').val(data['users'].cust_city);
                     $('#cust_zip').val(data['users'].cust_zip);
                     $('#id').val(info_id);
                     $('#email1').val(data['users'].email1);
                     $('#email2').val(data['users'].email2);
                     $('#office_phone1').val(data['users'].office_phone1);
                     $('#office_phone2').val(data['users'].office_phone2);
                     $('#mobile1').val(data['users'].mobile1);
                     $('#mobile2').val(data['users'].mobile2);
                     $('#fax').val(data['users'].fax);
                     $('#website').val(data['users'].website);
                     $('#contact_person').val(data['users'].contact_person);
                     $('#contact_person_incharge').val(data['users'].contact_person_incharge);
                     $('#mobile').val(data['users'].mobile);
                     $('#office').val(data['users'].office);
                     $('#contact_department').val(data['users'].contact_department);
                     $('#email').val(data['users'].email);
                     $('#location').val(data['users'].location);
                     $('#portal').val(data['users'].portal);
                     $('#password').val(data['users'].password);
                     $('#username').val(data['users'].username);
                     $('#registerd_email').val(data['users'].registerd_email);

                     $("#usersInformation").modal("hide");



                    $.each(data['addMore'], function( index, value ) {

                      if(index==0){

                        $('.addmore').find(".skill").val(value['skill']);
                        $('.addmore').find(".skillValue").val(value['value']);

                      }else{


                       $('#table-more').append('<tr id="row'+index+'" class="dynamic-added addmore subadmore">\
                        <td>\
                        <input type="text" value="'+value['skill']+'" name="skill['+index+']" placeholder="Skill" class="skill form-control name_list" />\
                        </td>\
                        <td>\
                        <input type="text" value="'+value['value']+'" name="skillValue['+index+']" placeholder="Value" class="skillValue form-control name_list" />\
                        </td>\
                        <td>\
                        <button type="button" name="remove" id="'+index+'" class="btn btn-danger btn_remove">X</button>\
                        </td>\
                        </tr>');
                      }

                    });


                }
           })
      });

$(document).on('click', '.kt_restore_categoryinformation', function () {
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
              url : 'categoryTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Customer Category Entry has been deleted.", "success");
                window.location.href="customercategorydetails";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Customer Entry is safe :)", "error");

          }
        })
     });
$(document).on('click', '.kt_restore_typeinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Customer Type Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'typeTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Type Category Entry has been deleted.", "success");
                window.location.href="customertypedetails";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Type Entry is safe :)", "error");

          }
        })
     });


var table = $('#customercategorydetails_list').DataTable({
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
            "url" : 'CustomercategoryList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }

    });
$(document).on('click', '#Category_submit', function(e){
      e.preventDefault();
      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
         $('#category-form').validate(  {
          rules: {
            customer_category : "required",
            },
          messages: {
            customer_category  : "Please specify your Customer Category",
          }

         });


        if (!$('#category-form').valid()) // check if form is valid
        {
            $(this).removeClass('kt-spinner');

            $(this).prop( "disabled", false );
            return false;

        }

       
        $.ajax({
            type : "POST",
            url  : "Categoryinfo",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        info_id          : $('#id').val(),
                        customer_category: $('#customer_category').val(),
                        description      : $('#description').val(),
                        color            : $('#color').val(),
                        cust_code        : $('#cust_code').val(),
                        start_from       : $('#start_from').val()

                       
                    },
            success: function(data){

                  closeModel();

                  swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
                  window.location.href="customercategorydetails";

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

                //for spinner button reactive
                $('#Customerdetail_submit').removeClass('kt-spinner');

                $('#Customerdetail_submit').prop( "disabled", false );
                //end for spinner button reactive

                $('#customercategorydetails_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });
$(document).on('click', '.close,.closeBtn', function(){

     closeModel();

  });
     function closeModel(){

      $("#kt_modal_4_4").modal("hide");
      $('#customer_category').val("");
      $('#description').val("");
        }
     function closeModels(){

      $("#kt_modal_4_4").modal("hide");
      $('#title').val("");
      $('#discription').val("");
      $('#color').val("");

        }
        
$(document).on('click', '#Type_submit', function(e){
      e.preventDefault();
      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
         $('#type-form').validate(  {
          rules: {
            title : "required",
            },
          messages: {
            title  : "Please specify your Customer Category",
          }

         });


        if (!$('#type-form').valid()) // check if form is valid
        {
            //for spinner button reactive
            $(this).removeClass('kt-spinner');

            $(this).prop( "disabled", false );
            //end for spinner button reactive
            return false;

        }

       
        $.ajax({
            type : "POST",
            url  : "Typesubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        info_id          : $('#id').val(),
                        title            : $('#title').val(),
                        discription      : $('#discription').val(),
                        color            : $('#color').val()

                        
                    },
            success: function(data){

                  closeModels();

                  swal.fire("Done", "Submission Sucessfully", "success");
                  // location.reload();
                  // table.ajax.reload(null, false); 
    // window.location.reload();
            window.location.reload(true);

                  window.location.href="customertypedetails";

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

                //for spinner button reactive
                $('#Customerdetail_submit').removeClass('kt-spinner');

                $('#Customerdetail_submit').prop( "disabled", false );
                //end for spinner button reactive

                $('#customertypedetails_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });
$(document).on('click', '#Customer_submit', function(e){
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
            url  : "CustomerSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        info_id          : $('#id').val(),
                        cust_code        : $('#cust_code').val(),
                        cust_type        : $('#cust_type').val(),
                        cust_category    : $('#cust_category').val(),
                        salesman         : $('#salesman').val(),
                        key_account      : $('#key_account').val(),
                        cust_note        : $('#cust_note').val(),
                        cust_name        : $('#cust_name').val(),
                        cust_add1        : $('#cust_add1').val(),
                        cust_add2        : $('#cust_add2').val(),
                        cust_country     : $('#cust_country').val(),
                        cust_region      : $('#cust_region').val(),
                        cust_city        : $('#cust_city').val(),
                        cust_zip         : $('#cust_zip').val(),
                        email1           : $('#email1').val(),
                        email2           : $('#email2').val(),
                        office_phone1    : $('#office_phone1').val(),
                        office_phone2    : $('#office_phone2').val(),
                        mobile1          : $('#mobile1').val(),
                        mobile2          : $('#mobile2').val(),
                        fax              : $('#fax').val(),
                        website          : $('#website').val(),
                        contact_person   : $('#contact_persons').val(),
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
                  window.location.href="customerdetails";
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

$(document).on('click', '.kt_del_typeinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Customer Type Details Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deletetypeInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Customer Type has been deleted.", "success");
                  location.reload();
             }
          });
          } else {

            swal.fire("Cancelled", "Your Customer Type Entry is safe :)", "error");
          }
        })
       });


   $(document).on('click', '.kt_del_customerinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Customer Details Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deleteCustomerInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Customer Details Entry has been deleted.", "success");
                  location.reload();
             }
          });
          } else {

            swal.fire("Cancelled", "Your Customer Details Entry is safe :)", "error");
          }
        })
       });
     
 $.reloadTable = function()
    {
        table.ajax.reload();
    };
    
     $(document).on('click', '.Type_update', function(){

           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "gettypeupdate",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      info_id     : info_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#title').val(data['users'].title);
                     $('#discription').val(data['users'].discription);
                     
                     $('#color').val(data['users'].color);
                     $('#id').val(info_id);
                     
                     $("#usersInformation").modal("hide");
                   
                }
           })
      });

    $(document).on('click', '.Category_update', function(){

           var info_id = $(this).attr("data-id");
           $.ajax({
                url       : "getcategorylist",
                method    : "POST",
                data      : {
                      _token      : $('#token').val(),
                      info_id     : info_id
                    },
                dataType  : "json",
                success:function(data)
                {
                     $('#customer_category').val(data['users'].customer_category);
                     $('#description').val(data['users'].description);
                     $('#color').val(data['users'].color);
                     $('#cust_code').val(data['users'].cust_code);
                     $('#start_from').val(data['users'].start_from);

                     $('#id').val(info_id);
                     
                     $("#usersInformation").modal("hide");
                   
                }
           })
      });


$(document).on('click', '.kt_del_categoryinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Category  Master Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'deletecategory',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Deleted!", "Your Category Entry has been deleted.", "success");
             location.reload();

             }
          });
          } else {
            swal.fire("Cancelled", "Your    Category   Entry is safe :)", "error");

          }
        })
       });

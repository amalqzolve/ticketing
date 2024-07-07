var table = $('#customerCredit_list').DataTable({
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
            "url" : 'customercreditList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });
var table = $('#salesdepartmenttrash').DataTable({
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
            "url" : 'salesdpttrash',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });

$(document).on('click', '.salesdeptrestore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this salesdepartment Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'salesdptTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Sales departmentEntry has been deleted.", "success");
                window.location.href="salesdepartment";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Sales Department Entry is safe :)", "error");

          }
        })
     });



$(document).on('click', '#Customercreditlimitsub', function(e){
  // alert("sd");
      e.preventDefault();
      $(this).addClass('kt-spinner');
      $(this).prop( "disabled", true );
         $('#creditlimit-form').validate(  {
          rules: {
            numberinvoice : "required",
            },
          messages: {
            numberinvoice  : "Please specify your Customer Number Of Invoice",
          }

         });


        if (!$('#creditlimit-form').valid()) // check if form is valid
        {
            //for spinner button reactive
            $(this).removeClass('kt-spinner');

            $(this).prop( "disabled", false );
            //end for spinner button reactive
            return false;

        }

       
        $.ajax({
            type : "POST",
            url  : "CustomerCreditSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        info_id          : $('#id').val(),
                        cust_name        : $('#cust_name').val(),
                        numberinvoice    : $('#numberinvoice').val(),
                        totalamount      : $('#totalamount').val(),
                        eachinvoice      : $('#eachinvoice').val(),
                        panelcharges     : $('#panelcharges').val()

                        
                    },
            success: function(data){

                  closeModels();

                  swal.fire("Done", "Submission Sucessfully", "success");
                  location.reload();
                  window.location.href="customercreditlimitdetails";

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

                $('#customerCredit_list').DataTable().ajax.reload();
                toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
            }
        });

        return false;

    });
function closeModels(){

      $("#kt_modal_4_13").modal("hide");

      $('#cust_name').val("");
      
      $('#id').val("");
      $('#numberinvoice').val("");
      
      $('#totalamount').val("");
      $('#eachinvoice').val("");
      
      $('#panelcharges').val("");
      

   }

$(document).on('click', '#Cusrcreditlimitsub', function(){
  
     
$('#creditlimit-form').validate(  {
          rules: {
            routename : "required",
            
            },
          messages: {
            name  : "Please specify your salesman route settings",
           
          }

         });


        if (!$('#creditlimit-form').valid()) // check if form is valid
        {
           return false;

        }

       


        //console.log();


        //alert($("input[name='addmore']").val());

        $.ajax({
            type : "POST",
            url  : "creditlimitSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        cust_id          : $('#id').val(),
                        cust_name        : $('#cust_name').val()
                        
                       

                        

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

      $("#kt_modal_4_13").modal("hide");

      $('#name').val("");
      
      $('#id').val("");
      

   }

  $(document).on('click', '.close,.closeBtn', function(){
     closeModel();
  });

// $(document).on('click', '.customerscreditlimit', function(){

//            var info_id = $(this).attr("data-id");
//            $.ajax({
//                 url       : "getcreditlimits?info_id="+info_id,
//                 method    : "POST",
//                 data      : {
//                       _token      : $('#token').val(),
//                       info_id     : info_id
//                     },
//                 dataType  : "json",
//                 success:function(data)
//                 {
                     
//                      $('#totalkm').val(data['users'].totalkm);
//                      $('#id').val(cust_id);
//                      $("#kt_modal_4_13").modal("hide");

                   
//                 }
//            })
//       });


// $(document).on('click', '.customerscreditlimit', function(){
        // var info_id = $(this).attr("data-id");

        //    $.ajax({
        //         url       : "getcreditlimits?info_id="+info_id,
        //         method    : "POST",
        //         data      : {
        //               _token      : $('#token').val(),
        //               info_id     : info_id
        //             },
        //         dataType  : "json",
        //         success:function(data)
        //         {
        //         $('#cust_name').val("option:selected", this);

                    // alert(data);
        // $('#cust_name').find('option:selected'); 
        // $('#cust_name').val(data['users'].cust_name).find('option:selected');
                      // $('#cust_name').val(cust_name);
                     // $("#kt_modal_4_13").modal("hide");

                   
      //           }
      //      })
      // });


var i=1;

$('#add-more').click(function(){
   i++;
   $('#table-more').append('<tr id="row'+i+'" class="dynamic-added addmore subadmore">\
    <td>\
    <input type="text"  name="skill['+i+']" placeholder="Skill" class="skill form-control name_list" />\
    </td>\
    <td>\
    <input type="text"  name="skillValue['+i+']" placeholder="Value" class="skillValue form-control name_list" />\
    </td>\
    <td>\
    <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>\
    </td>\
    </tr>');
});

$(document).on('click', '.btn_remove', function(){
     var button_id = $(this).attr("id");
     $('#row'+button_id+'').remove();
});



$(document).on('click', '.kt_del_creditlimitinformation', function () {
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
              url : 'deletecreditlimitInfo',
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

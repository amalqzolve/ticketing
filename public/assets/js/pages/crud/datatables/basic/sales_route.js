var table = $('#salesmanroute_list').DataTable({
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
            "url" : 'salesmanroutesettingList',
            "type": "GET",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });
var table = $('#salesmanroutesettingstrash').DataTable({
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
            "url" : 'salesmanroutetrash',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });

$(document).on('click', '.salesmanroutrestore', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this salesman Route Settings Entry also loss these Employee Salary Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'salesmanrouteTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Salesman Route SettingsEntry has been deleted.", "success");
                window.location.href="salesmanroutesettings";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Customer Entry is safe :)", "error");

          }
        })
     });




$(document).on('click', '#salesmanroute_submit', function(){
  
     
$('#salesmanroutesettings-form').validate(  {
          rules: {
            routename : "required",
            
            },
          messages: {
            name  : "Please specify your salesman route settings",
           
          }

         });


        if (!$('#salesmanroutesettings-form').valid()) // check if form is valid
        {
           return false;

        }

       


        //console.log();

        //alert($("input[name='addmore']").val());

        $.ajax({
            type : "POST",
            url  : "salesmanrouteSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        cust_id          : $('#id').val(),
                        routename        : $('#routename').val(),
                        startpalce       : $('#startpalce').val(),
                        endplace         : $('#endplace').val(),
                        totalkm          : $('#totalkm').val()

                        

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

      $("#kt_modal_4_11").modal("hide");

      $('#name').val("");
      
      $('#id').val("");
      

   }

  $(document).on('click', '.close,.closeBtn', function(){
     closeModel();
  });


$(document).on('click', '.salesmanroutedetail_update', function(){
           var cust_id = $(this).attr("data-id");
           $.ajax({
                url       : "getsalesmanroutesettings",
                method    : "POST",
                data      : {
              _token      : $('#token').val(),
              cust_id     : cust_id
                    },
                dataType  : "json",
                success:function(data)
                {
                    $('#routename').val(data['users'].routename);
                    $('#startpalce').val(data['users'].startpalce);
                    $('#endplace').val(data['users'].endplace);
                     $('#totalkm').val(data['users'].totalkm);
                     $('#id').val(cust_id);
                     $("##kt_modal_4_11").modal("hide");


                    }
                   
       
              
           })
      });


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



$(document).on('click', '.kt_del_salesmanrouteinformation', function () {
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
              url : 'deletesalesmanrouteInfo',
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

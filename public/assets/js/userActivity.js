    /*******************************************************************************
     * Detail : User Information data listing
     * Date   : 24-04-2020                                                         *
     *******************************************************************************/



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
  jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});


   
         
   function closeModel(){
      
         $("#kt_modal_4_2").modal("hide"); 
      
      $('#cust_type').val("");
      $('#cust_name').val("");
      $('#cust_add1').val("");
      $('#cust_add2').val("");
      $('#cust_country').val("");
      $('#cust_city').val("");
      $('#cust_region').val("");
      $('#cust_zip').val("");
      $('#cust_email').val("");
      $('#cust_officephone').val("");
      $('#cust_mobile').val("");
      $('#cust_fax').val("");
      $('#cust_website').val("");
      $('#id').val("");
      

   }      

  $(document).on('click', '.close,.closeBtn', function(){
     
     closeModel();

  });



    var table = $('#userActivity_list').DataTable({
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
            "url" : 'userActivityList',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });

$('#userActivity_list tfoot th').each(function (i) 
{

            var title = $('#userActivity_list tfoot th').eq($(this).index()).text();
            // or just var title = $('#sample_3 thead th').text();
            var serach = '<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />';
            $(this).html('');
            $(serach).appendTo(this).keyup(function(){table.fnFilter($(this).val(),i)})
});



     $.reloadTable = function() 
    {
        table.ajax.reload();
    };

    $("#export-button-pdf").on("click", function () {
     $('body .buttons-pdf').trigger('click');
    });

    $("#export-button-print").on("click", function () {
     $('body .buttons-print').trigger('click');
    });

    $("#export-button-csv").on("click", function () {
     $('body .buttons-csv').trigger('click');
    });

    $("#export-button-copy").on("click", function () {
     $('body .buttons-copy').trigger('click');
    });

    


    var tableTrash = $('#userActivity_list_trash').DataTable({
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
              className:'btn btn-outline-brand btn-elevate btn-pill hideButton'
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
        "pagingType": 'full_numbers',
        "iDisplayLength": 10,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "stripeClasses": [ 'odd-row', 'even-row' ],
        "order": [],

        "ajax": {
            "url" : 'userListTrash',
            "type": "POST",
            "data": function ( data ) {
                data._token = $('#token').val()
            }
        }


    });

    });
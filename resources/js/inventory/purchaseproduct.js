/**
 *Datatable for product details Information
 */
//$.fn.dataTable.ext.errMode = 'none';

var product_list_table = $('#productdetails_list').DataTable({
    processing: true,
    serverSide: false,
    bPaginate: false,
    dom: 'Blfrtip',
    columnDefs: [
  {
    "defaultContent": "-",
    "targets": "_all"
  }
  ,{
                "targets": [ 11 ],
                "visible": false
            }],
 //   aoColumnDefs: [{ "bVisible": false, "aTargets": [13] }],

    ajax: {
        "url": 'ProductpurchaseListing',
        "type": "POST",
        "data": function(data) {
            data._token = $('#token').val()
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
       /* { data: 'product_name', name: 'product_name' },*/
          { data: 'product_name', name: 'product_name', "render": function ( data, type, row, meta ) {
      return type === 'display' && data.length > 40 ?
        '<span title="'+data+'">'+data.substr( 0, 38 )+'...</span>' :
        data;
    } },

    
        { data: 'description', name: 'description', "render": function ( data, type, row, meta ) {

if (data != null && data.length > 1) {
     return type === 'display' && data.length > 40 ?
        '<span title="'+data+'">'+data.substr( 0, 38 )+'...</span>' :
        data;
    } else{
        return data;
    }

     
    } },
        { data: 'part_no', name: 'part_no' },

      /*  { data: 'description', name: 'description' },*/
        { data: 'product_code', name: 'product_code' },
        { data: 'bar_code',name: 'bar_code' },
        { data: 'unit', name: 'unit' },
        { data: 'product_price', name: 'product_price' },
        { data: 'selling_price', name: 'selling_price' },
        { data: 'available_stock', name: 'available_stock' },
        { data: 'warehouse', name: 'warehouse' },
        { data: 'store', name: 'store' },
        /*{ data: 'rack', name: 'rack' },*/
        { data: 'category_name', name: 'category_name' },
        
          /*  {
            data: 'product_type',
            name: 'product_type',
            render: function(data, type, row) {
                if (row.product_type == 1) {
                    return 'Product';
                } if (row.product_type == 2) {
                    return 'Service';
                }

            }
        },
         
         {
            data: 'product_status',
            name: 'product_status',
            render: function(data, type, row) {
                if (row.product_status == 1) {
                    return 'Enabled';
                } if (row.product_status == 2) {
                    return 'Disabled';
                }

            }
        },*/
      /* { data: 'pid', name: 'pid' },*/

          

        

    ]
});





    $(document).ready(function() {


     $('#productdetails_list tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');

         $('#selected_items').val(product_list_table.rows('.selected').data().length);

var versement_each = 0;
selectArr= new Array();
 var ids = $.map(product_list_table.rows('.selected').data(), function (item) {
         versement_each += parseFloat(item.unit_price) || 0;
         // alert(versement_each);
//
         var idx = $.inArray(item.product_id, selectArr);
if (idx == -1) {
  selectArr.push(item.product_id);
} else {
  selectArr.splice(idx, item.product_id);
}
//



    });


  $('#selected_amount').val(versement_each.toFixed(2));
    } );
 


} );



$("#datatableadd").on("click", function() {
$('#kt_modal_4_4').modal('hide');
product_list_table .rows( '.selected' ).nodes().to$() .removeClass( 'selected' );
$('#selected_amount').val('');
$('#selected_items').val('');
    createproductvialoop(selectArr);

    });


/**
 *products details DataTable Export
 */

$("#productdetails_list_print").on("click", function() {
   
    product_list_table.button('.buttons-print').trigger();
});


$("#productdetails_list_copy").on("click", function() {
    product_list_table.button('.buttons-copy').trigger();
});

$("#productdetails_list_csv").on("click", function() {
    product_list_table.button('.buttons-csv').trigger();
});

$("#productdetails_list_pdf").on("click", function() {
    product_list_table.button('.buttons-pdf').trigger();
});


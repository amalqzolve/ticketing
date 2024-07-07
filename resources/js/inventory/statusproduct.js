/**
 *Datatable for product details Information
 */
$.fn.dataTable.ext.errMode = 'none';

var product_list_table = $('#product_tables').DataTable({
    processing: true,
         serverSide: false,
         pagingType: "full_numbers",
          scrollX: true,

         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
         buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function(doc) {
                  doc.pageMargins = [50, 50, 50, 50];
              }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      });

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
   



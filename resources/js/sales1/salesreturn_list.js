var salesreturndetails_list_table = $('#salesreturndetails_list').DataTable({
      processing: true,
      serverSide: true,
      scrollX: true,
      pagingType: "full_numbers",
      dom: 'Blfrtip',
      lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
      ],
      buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
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
                  columns: [0, 1, 2, 3]
              }
          }
      ],

      ajax: {
          "url": 'salesreturn',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'salesreturnno', name: 'salesreturnno' },
          { data: 'purchase_date', name: 'purchase_date' },
          { 
            data: 'deliverto', name: 'deliverto', 
            render: function(data, type, row) {
                if (row.deliverto == 1) {
                    return 'Warehouse';
                } else {
                    return 'Purchase';
                }

            }
          },
          { data: 'net_amount', name: 'net_amount' },
          { data: 'paid_amount', name: 'paid_amount' },
          { data: 'due_amount', name: 'due_amount' },
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="edit_salesreturn?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-contract"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_salesreturn_delete" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>';
              }
          },
      ]
  });

$(document).on('click', '#salesreturn_submit', function(e) {
    e.preventDefault();
    var checkedValue  = $('#vendor_supplier').val();
    var name          = $('#supplier_vendor_names').val();
    var purchase_date = $('#purchase_order_date').val();
    var deliverto     = $('#deliver').val();
    var deliver_name  = $('#deliveredto').val();
    var recievedto    = $('#recievedto').val();
    var purchaseno    = $('#purchase_no').val();
    var paymentterms  = $('#paymentterms').val();
    var notes         = $('#notes').val();
    var terms         = $('#terms').val();
    var currency      = $('#item_currency').val();
    var currencyvalue = $('#item_currency_value').val();
    var purchase_sub_total = $('#purchase_sub_total').val();
    var grandtotal_discount = $('#grandtotal_discount').val();
    var grandtotal_tax = $('#grandtotal_tax').val();
    var net_amount = $('#net_amount').val();
    var paid_amount = $('#paid_amount').val();
    var due_amount = $('#due_amount').val();
    var totalcost_amount = $('#totalcost_amount').val();
    var fileData = $('#fileData').val();
    


    var productname = [];

    $("input[name^='item_details[]']")
        .each(function(input) {
            productname.push($(this).val());
        });
    var productname_id = [];

    $("input[name^='item_details_id[]']")
        .each(function(input) {
            productname_id.push($(this).val());
        });
       

    var batch = [];

    $("select[name^='batch[]']")
        .each(function(input) {
            batch.push($(this).val());
        });
       

        var newbatchname = [];

    $("input[name^='newbatchname[]']")
        .each(function(input) {
            newbatchname.push($(this).val());
        });
       

        var extbatchname = [];

    $("select[name^='extbatchname[]']")
        .each(function(input) {
            extbatchname.push($(this).val());
        });
        console.log(extbatchname);

    var costpercentage = [];

    $("input[name^='costpercentage[]']")
        .each(function(input) {
            costpercentage.push($(this).val());
        });
        

    var quantity = [];

    $("input[name^='quantity[]']")
        .each(function(input) {
            quantity.push($(this).val());
        });

    var unit = [];

    $("select[name^='unit[]']")
        .each(function(input) {
            unit.push($(this).val());
        });

    var rate = [];

    $("input[name^='rate[]']")
        .each(function(input) {
            rate.push($(this).val());
        });

    var amount = [];

    $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });

    var tax_group = [];

    $("select[name^='tax_group[]']")
        .each(function(input) {
            tax_group.push($(this).val());
        });

    var tax_amount = [];

    $("input[name^='tax_amount[]']")
        .each(function(input) {
            tax_amount.push($(this).val());
        });

    var discount = [];

    $("input[name^='discount[]']")
        .each(function(input) {
            discount.push($(this).val());
        });

    var row_total = [];

    $("input[name^='row_total[]']")
        .each(function(input) {
            row_total.push($(this).val());
        });

    var itemcost_details = [];

    $("select[name^='itemcost_details[]']")
        .each(function(input) {
            itemcost_details.push($(this).val());
        });

    var costrate = [];

    $("input[name^='costrate[]']")
        .each(function(input) {
            costrate.push($(this).val());
        });

    var costtax_group = [];

    $("select[name^='costtax_group[]']")
        .each(function(input) {
            costtax_group.push($(this).val());
        });

    var costtax_amount = [];

    $("input[name^='costtax_amount[]']")
        .each(function(input) {
            costtax_amount.push($(this).val());
        });

    var quantity_value = [];

    $("input[name^='quantity_value[]']")
        .each(function(input) {
            quantity_value.push($(this).val());
        });

    var pur_cost_id = [];

    $("input[name^='pur_cost_id[]']")
        .each(function(input) {
            pur_cost_id.push($(this).val());
        });

    var pur_pro_id = [];

    $("input[name^='pur_pro_id[]']")
        .each(function(input) {
            pur_pro_id.push($(this).val());
        });

        if(itemcost_details == "")
        {
          toastr.warning('Cost Head table is empty');
          return false;
        }
        if(productname == "")
        {
          toastr.warning('Product Table is empty');
          return false;
        }
        
        if (name == "") {
            $('#supplier_vendor_names').next().find('.select2-selection').addClass('select-dropdown-error');
            return false;
        } else {
            $('#supplier_vendor_names').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (deliver_name == "") {
            $('#deliveredto').next().find('.select2-selection').addClass('select-dropdown-error');
            return false;
        } else {
            $('#deliveredto').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (recievedto == "") {
            $('#recievedto').next().find('.select2-selection').addClass('select-dropdown-error');
            return false;
        } else {
            $('#recievedto').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (purchase_date == "") {
            $('#purchase_order_date').addClass('is-invalid');
            return false;
        } else {
            $('#purchase_order_date').removeClass('is-invalid');
        }
        if (purchaseno == "") {
            $('#purchase_no').addClass('is-invalid');
            return false;
        } else {
            $('#purchase_no').removeClass('is-invalid');
        }

    $(this).addClass('kt-spinner');
    $(this).prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      


    $.ajax({
        type: "POST",
        url: "salesreturn_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            checkedValue  : $('#vendor_supplier').val(),
            name          : $('#supplier_vendor_names').val(),
            purchase_date : $('#purchase_order_date').val(),
            deliverto     : $('#deliver').val(),
            deliver_name  : $('#deliveredto').val(),
            salesreturnno : $('#salesreturnno').val(),
            paymentterms  : $('#paymentterms').val(),
            notes         : $('#notes').val(),
            terms         : $('#terms').val(),
            currency      : $('#item_currency').val(),
            currencyvalue : $('#item_currency_value').val(),
            purchase_sub_total : $('#purchase_sub_total').val(),
            grandtotal_discount : $('#grandtotal_discount').val(),
            grandtotal_tax : $('#grandtotal_tax').val(),
            net_amount : $('#net_amount').val(),
            paid_amount : $('#paid_amount').val(),
            due_amount : $('#due_amount').val(),
            totalcost_amount : $('#totalcost_amount').val(),
            reciever     : $('#reciever').val(),
            recievedto  : $('#recievedto').val(),
            purchasemethod  : $('#purchasemethod').val(),
            productname   : productname,
            productname_id:productname_id,
            batch : batch,
            newbatchname : newbatchname,
            extbatchname : extbatchname,
            costpercentage : costpercentage,
            quantity: quantity,
            unit: unit,
            rate: rate,
            amount : amount,
            tax_group : tax_group,
            tax_amount : tax_amount,
            discount : discount,
            row_total : row_total,
            itemcost_details : itemcost_details,
            costrate : costrate,
            costtax_group : costtax_group,
            costtax_amount : costtax_amount,
            quantity_value : quantity_value,
            pur_pro_id  : pur_pro_id,
            pur_cost_id : pur_cost_id,
            fileData: $('#fileData').val(),
            branch : $('#branch').val()
        },
        success: function(data) {
            // uppy.reset();
            if(data == false)
          {
            $('#salesreturn_submit').removeClass('kt-spinner');
            $('#salesreturn_submit').prop("disabled", false);
             toastr.warning('The Sales Return Number Already Exists');

          }
          else
          {
            $('#salesreturn_submit').removeClass('kt-spinner');
            $('#salesreturn_submit').prop("disabled", false);
            toastr.success('Sales Return Details Updated Successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
            location.reload();
            window.location.href = "salesreturn";
            }
        },
        error: function(jqXhr, json, errorThrown) {
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors, function(key, value) {
                if (jQuery.isPlainObject(value)) {

                    $.each(value, function(index, ndata) {
                        errorsHtml += '<li>' + ndata + '</li>';
                    });

                } else {

                    errorsHtml += '<li>' + value + '</li>';

                }
            });
            toastr.error(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
        }
    });

    return false;

});

 $(document).on('click', '.kt_salesreturn_delete', function() {
    var id = $(this).attr('id');
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Entry ",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!"
    }).then(result => {
        if (result.value) {

            $.ajax({
                type: "POST",
                url: 'salesreturn_delete',
                data: {
                    _token: $('#token').val(),
                    id: id
                },
                success: function(data) {

                    swal.fire("Deleted!", "Your entry has been deleted.", "success");
                    salesreturndetails_list_table.ajax.reload();
                }
            });
        } else {

            swal.fire("Cancelled", "Your Entry is safe ", "error");
        }
    })
});

 $('.ktdatepicker').datepicker({
   todayHighlight: true,
   format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});
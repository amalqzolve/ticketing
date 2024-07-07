    var sales_return_details_lists_table = $('#sales_return_details_lists').DataTable({
      processing: false,
      serverSide: false,
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
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '20%',  '20%', '20%', '20%', 
                                                           '20%'];
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

      ajax: {
          "url": 'sales_return_list',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'invoiceno', name: 'invoiceno' },
          { data: 'cust_name', name: 'cust_name' },
          { data: 'quotedate', name: 'quotedate' },
          { data: 'grandtotalamount', name: 'grandtotalamount' },
        {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
               return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="salesreturn_pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
                   
              }
          },
          
      ]
  });

    $("body").on("click",".remove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
       var siblings = row.siblings();
       row.remove();
       siblings.each(function(index) {
            $(this).children().first().text(index+1);
       });

            var vatamounts = 0;
        $('.vatamount').each(function()
        {
            var id = $(this).attr('data-id');
            var vatamount = $('#vatamount'+id+'').val();
        
            vatamounts += parseFloat(vatamount);

        });
        $('#totalvatamount').val(vatamounts.toFixed(2));

        
        totalamount_calculate();
        discount_calculate();
final_calculate1();

   
});
    $(document.body).on("change", "#terms", function() 
    {
        var cid = $(this).val();
        
        $.ajax({
        url: "gettermsquote",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:cid
        },
        dataType: "json",
        success: function(data) {
          //  console.log(data);
            var termcondition ='';
          $.each(data, function(key, value) {
            
           termcondition =value.description;
                        });

          $('#kt-tinymce-4').val(termcondition);
          tinymce.activeEditor.setContent(termcondition);
          console.log(termcondition);

        }
    })
    });
    $(document.body).on("change", "#customer", function() 
    {
        var cid = $(this).val();
        
        $.ajax({
        url: "getcustomeraddressquote",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:cid
        },
        dataType: "json",
        success: function(data) {
            console.log(data);
            var inv_address ='';
            var ship_address ='';
            var cust_phone ='';
          $.each(data, function(key, value) {
            
           inv_address =value.invoice_add1+' '+value.invoice_add2+' '+value.invoice_city+' '+value.invoice_country;

           ship_address =value.shipping1+' '+value.shipping2+' '+value.shipping_city+' '+value.invoice_country;

           cust_phone =value.mobile1;



                        });

          $('#billing_address').val(inv_address);
          $('#shipping_address').val(ship_address);
          $('#contact_phone').val(cust_phone);
          

        }
    })
    });


$('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

    



$(document).on('click', '#sales_return_update', function(e) {
    e.preventDefault();
  
        customer_id      = $('#customer_id').val();
        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        currency      = $('#currency').val();
        currencyvalue = $('#currency_value').val();

        totalamount         = $('#totalamount').val();
        discount            = $('#discount').val();
        amountafterdiscount = $('#amountafterdiscount').val();
        totalvatamount      = $('#totalvatamount').val();
        grandtotalamount    = $('#grandtotalamount').val();

        terms      = $('#terms').val();
        notes      = $('#notes').val();
        preparedby = $('#preparedby').val();
        approvedby = $('#approvedby').val();


        var productname = [];

        $("input[name^='item_details_id[]']")
        .each(function(input) {
            productname.push($(this).val());
        });

        var product_id = [];

        $("input[name^='product_id[]']")
        .each(function(input) {
            product_id.push($(this).val());
        });

        var product_description = [];

          $("textarea[name^='product_description[]']")
        .each(function(input) {
            product_description.push($(this).val());
        });

        var unit = [];

        $("select[name^='unit[]']")
        .each(function(input) {
            unit.push($(this).val());
        });

        var quantity = [];

        $("input[name^='quantity[]']")
        .each(function(input) {
            quantity.push($(this).val());
        });
         var originalquantity = [];

        $("input[name^='originalquantity[]']")
        .each(function(input) {
            originalquantity.push($(this).val());
        });

        var oquantity = [];

        $("input[name^='orquantity[]']")
        .each(function(input) {
            oquantity.push($(this).val());
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

        var vatamount = [];

        $("input[name^='vatamount[]']")
        .each(function(input) {
            vatamount.push($(this).val());
        });
   var vat_percentage = [];

        $("input[name^='vat_percentage[]']")
        .each(function(input) {
            vat_percentage.push($(this).val());
        });


           var rdiscount = [];

        $("input[name^='discountamount[]']")
        .each(function(input) {
            rdiscount.push($(this).val());
        });

        var row_total = [];

        $("input[name^='row_total[]']")
        .each(function(input) {
            row_total.push($(this).val());
        });


        //  if (customer == "") {
        //     $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
        //     return false;
        // } else {
        //     $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        // }

        // if (reference == "") {
        //     $('#reference').addClass('is-invalid');
        //     return false;
        // } else {
        //      $('#reference').removeClass('is-invalid');
        //  }
          if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
           toastr.warning("Please Add Any Salesman!");
                      return false;
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }



                    var ttotal = 0;
            $.each(row_total,function() {
                ttotal += parseInt(this, 10);
            });


            if (ttotal > 0) {
                // the array is defined and has at least one element
            }else{
                   toastr.warning("Please Add Any Product!");
                      return false;
            }


     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else{
        var sucess_msg ='Created';
     }
    

    $.ajax({
        type: "POST",
        url: "salesreturnupdate",
        dataType: "text",
        data: { 
            _token: $('#token').val(),
        id            : $('#id').val(),
        customer      : $('#customer').val(),
        customer_id      : $('#customer_id').val(),
        unique_id      : $('#unique_id').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        quotedate     : $('#quotedate').val(),
        currency      : $('#currency').val(),
        currencyvalue : $('#currency_value').val(),

        totalamount         : $('#totalamount').val(),
        discount            : $('#discount').val(),
        amountafterdiscount : $('#amountafterdiscount').val(),
        totalvatamount      : $('#totalvatamount').val(),
        grandtotalamount    : $('#grandtotalamount').val(),

        terms      : $('#terms').val(),
        notes      : $('#notes').val(),
        preparedby : $('#preparedby').val(),
        approvedby : $('#approvedby').val(),
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        rate : rate,
        amount : amount,
        vatamount : vatamount,  
        rdiscount : rdiscount, 
        vat_percentage : vat_percentage,       
        row_total : row_total,
        shipping_address      : $('#shipping_address').val(),
        billing_address : $('#billing_address').val(),
        contact_phone : $('#contact_phone').val(),
        tpreview : $('#kt-tinymce-4').val(),
        oquantity : oquantity,
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        invcustomer_id : $('#invcustomer_id').val(),
        product_id : product_id,
        originalquantity :originalquantity,
        },
        success: function(data) {
       console.log(data);

             $('#sales_return_update').removeClass('kt-spinner');
             $('#sales_return_update').prop("disabled", false);
             location.reload();
              window.location.href = "sales_return_list";
             toastr.success('Sales Return Updated Successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

    
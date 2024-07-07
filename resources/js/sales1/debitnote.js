
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

    

var debitnotedetails_list_table = $('#debitnotedetails_list').DataTable({
      processing: true,
      serverSide: true,
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
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '10%',  '11%', '11%', '11%', 
                                                           '11%', '11%','11%','5%','5%','5%','5%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8]
              }
          }
      ],

      ajax: {
          "url": 'debitnote',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#S' + row.id + '&nbsp;&nbsp;';
              }
          },
           
          { data: 'quotedate', name: 'quotedate' },
         
          { data: 'grandtotalamount', name: 'grandtotalamount' },
          { data: 'reference', name: 'reference' },
          { data: 'attention', name: 'attention' },
          { data: 'name', name: 'name' },
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                     j='<a href="debitnote_pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a href="debitnote_pdfletter?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF Letterhead</span>\
                        </span></li></a>';
                   
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                        </ul></div></div></span>';
              }
          },
      ]
  });

$(document).on('click', '#debitnote_customer_submit', function(e) {
    e.preventDefault();

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

        // if (customer == "") {
        //     $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
        //     return false;
        // } else {
        //     $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        // }

       /* if (reference == "") {
            $('#reference').addClass('is-invalid');
            return false;
        } else {
             $('#reference').removeClass('is-invalid');
         }*/
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
        url: "debitnotecustomer_submit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        customer      : $('#customer').val(),
        invoice_no     : $('#invoice_no').val(),
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

        tpreview : $('#kt-tinymce-4').val(),
        oquantity : oquantity,
        cust_category      : $('#cust_category').val(),
        cust_code      : $('#cust_code').val(),
        cust_type      : $('#cust_type').val(),
        cust_group      : $('#cust_group').val(),
        cust_name      : $('#cust_name').val(),
        cust_country      : $('#cust_country').val(),
        building_no      : $('#building_no').val(),
        cust_region      : $('#cust_region').val(),
        cust_district      : $('#cust_district').val(),
        cust_city      : $('#cust_city').val(),
        cust_zip      : $('#cust_zip').val(),
        mobile      : $('#mobile').val(),
        vatno      : $('#vatno').val(),
        buyerid_crno      : $('#buyerid_crno').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        paidamount      : $('#paidamount').val(),
        balanceamount    : $('#balanceamount').val(),
   
        },
        success: function(data) {
       
        
             $('#debitnote_customer_submit').removeClass('kt-spinner');
             $('#debitnote_customer_submit').prop("disabled", false);
             location.reload();
              window.location.href = "debitnote";
             toastr.success('Debit Note Customer'+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

$(document).on('click', '#debitnote_supplier_submit', function(e) {
    e.preventDefault();

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

        // if (customer == "") {
        //     $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
        //     return false;
        // } else {
        //     $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        // }

       /* if (reference == "") {
            $('#reference').addClass('is-invalid');
            return false;
        } else {
             $('#reference').removeClass('is-invalid');
         }*/
          if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Salesman!");
                      return false;
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
     
       

            //        var ttotal = 0;
            // $.each(row_total,function() {
            //     ttotal += parseInt(this, 10);
            // });


            // if (ttotal > 0) {
            //     // the array is defined and has at least one element
            // }else{
            //        toastr.warning("Please Add Any Product!");
            //           return false;
            // }



     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else{
        var sucess_msg ='Created';
     }
    

    $.ajax({
        type: "POST",
        url: "debitnotesupplier_submit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        supplier      : $('#supplier').val(),
        purchase_no     : $('#purchase_no').val(),
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

        tpreview : $('#kt-tinymce-4').val(),
        oquantity : oquantity,
        cust_category      : $('#cust_category').val(),
        cust_code      : $('#cust_code').val(),
        cust_type      : $('#cust_type').val(),
        cust_group      : $('#cust_group').val(),
        cust_name      : $('#cust_name').val(),
        cust_country      : $('#cust_country').val(),
        building_no      : $('#building_no').val(),
        cust_region      : $('#cust_region').val(),
        cust_district      : $('#cust_district').val(),
        cust_city      : $('#cust_city').val(),
        cust_zip      : $('#cust_zip').val(),
        mobile      : $('#mobile').val(),
        vatno      : $('#vatno').val(),
        buyerid_crno      : $('#buyerid_crno').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        paidamount      : $('#paidamount').val(),
        balanceamount    : $('#balanceamount').val(),
   
        },
        success: function(data) {
       
        
             $('#debitnote_supplier_submit').removeClass('kt-spinner');
             $('#debitnote_supplier_submit').prop("disabled", false);
             location.reload();
              window.location.href = "debitnote";
             toastr.success('Debit Note Customer'+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

$(document).on('click', '#productname_submit', function(e) {
    e.preventDefault();

        name         = $('#itemname').val();
        description  = $('#description').val();
        unit         = $('#productunit').val();
        price        = $('#price').val();

        if (name == ""){
            $('#itemname').addClass('is-invalid');
            return false;
        }else{
            $('#itemname').removeClass('is-invalid');
        }

        if (unit == "") {
            $('#productunit').addClass('is-invalid');
            return false;
        } else {
             $('#productunit').removeClass('is-invalid');
         }
         if (price == "") {
            $('#price').addClass('is-invalid');
            return false;
        } else {
             $('#price').removeClass('is-invalid');
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
        url: "newproductsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            name         : $('#itemname').val(),
            description  : $('#description').val(),
            unit         : $('#productunit').val(),
            price        : $('#price').val(),
            branch : $('#branch').val(),
            type : 1
        },
        success: function(data) {
           
            if(data == 1)
            {
             toastr.warning('Product Already Exists');

            }
            else
            {
       
             $('#myModal').modal('hide');
             $('#productname_submit').removeClass('kt-spinner');
             $('#productname_submit').prop("disabled", false);
             toastr.success('New Product'+sucess_msg+' successfuly');
        
            var dataa = {
                    id: data,
                    text: name
                };

                var newOption = new Option(dataa.text, dataa.id, false, false);
                $('.productname').append(newOption);

                   $('#itemname').val('');
                   $('#description').val('');
                   $('#productunit').val('');
                   $('#price').val('');
}
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    });
});

$(document).on('click', '#servicename_submit', function(e) {
    e.preventDefault();

        name         = $('#servicename').val();
        description  = $('#servicedescription').val();
        unit         = $('#serviceunit').val();
        price        = $('#serviceprice').val();

        if (name == ""){
            $('#servicename').addClass('is-invalid');
            return false;
        }else{
            $('#servicename').removeClass('is-invalid');
        }

        if (unit == "") {
            $('#serviceunit').addClass('is-invalid');
            return false;
        } else {
             $('#serviceunit').removeClass('is-invalid');
         }
         if (price == "") {
            $('#serviceprice').addClass('is-invalid');
            return false;
        } else {
             $('#serviceprice').removeClass('is-invalid');
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
        url: "newproductsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
            name         : $('#servicename').val(),
            description  : $('#servicedescription').val(),
            unit         : $('#serviceunit').val(),
            price        : $('#serviceprice').val(),
            branch : $('#branch').val(),
            type : 2,
        },
        success: function(data) {
       if(data == 2)
            {
             toastr.warning('Service Already Exists');

            }
            else
            {
             $('#serviceModal').modal('hide');
             $('#servicename_submit').removeClass('kt-spinner');
             $('#servicename_submit').prop("disabled", false);
             toastr.success('New Service'+sucess_msg+' successfuly');
        
            var dataa = {
                    id: data,
                    text: name
                };

                var newOption = new Option(dataa.text, dataa.id, false, false);
                $('.productname').append(newOption).trigger('change');
}
        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log(errorThrown);
           
        }
    });
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
   


    $('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});

    


$(document).on('click', '#cinvoice_update', function(e) {
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
        url: "newcinvoiceupdate",
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
        cust_category      : $('#cust_category').val(),
        cust_code      : $('#cust_code').val(),
        cust_type      : $('#cust_type').val(),
        cust_group      : $('#cust_group').val(),
        cust_name      : $('#cust_name').val(),
        cust_country      : $('#cust_country').val(),
        building_no      : $('#building_no').val(),
        cust_region      : $('#cust_region').val(),
        cust_district      : $('#cust_district').val(),
        cust_city      : $('#cust_city').val(),
        cust_zip      : $('#cust_zip').val(),
        mobile      : $('#mobile').val(),
        vatno      : $('#vatno').val(),
        buyerid_crno      : $('#buyerid_crno').val(),
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        invcustomer_id : $('#invcustomer_id').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        newcustomer : $('#newcustomer').val(),
        paidamount      : $('#paidamount').val(),
        balanceamount    : $('#balanceamount').val(),
   
        },
        success: function(data) {
       console.log(data);

             $('#cinvoice_update').removeClass('kt-spinner');
             $('#cinvoice_update').prop("disabled", false);
             location.reload();
              window.location.href = "customeinvoicelist";
             toastr.success('Invoice Updated Successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});






$(document).on('click', '#cinvoice_update_revise', function(e) {
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

        $("select[name^='productname[]']")
        .each(function(input) {
            productname.push($(this).val());
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


         if (customer == "") {
            $('#customer').next().find('.select2-selection').addClass('select-dropdown-error');
            return false;
        } else {
            $('#customer').next().find('.select2-selection').removeClass('select-dropdown-error');
        }

        if (reference == "") {
            $('#reference').addClass('is-invalid');
            return false;
        } else {
             $('#reference').removeClass('is-invalid');
         }
          if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
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
        url: "newcinvoicerevise",
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
        tpreview : $('#kt-tinymce-4').val()
   
        },
        success: function(data) {
       
        
             $('#cinvoice_update_revise').removeClass('kt-spinner');
             $('#cinvoice_update_revise').prop("disabled", false);
             location.reload();
              window.location.href = "customeinvoicelist";
             toastr.success('Invoice Updated Successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

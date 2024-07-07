

$(document).on('click', '#invoice_submit', function(e) {
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
         /* if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Salesman!");
                      return false;
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }*/
     
       

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
        url: "posinvoicesubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        vanid : $('#vanid').val(),
        customer      : $('#customer').val(),
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
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        newcustomer : $('#newcustomer').val(), 
        
   
        },
        success: function(data) {
       
        
             $('#invoice_submit').removeClass('kt-spinner');
             $('#invoice_submit').prop("disabled", false);
             // location.reload();
              window.location.href = "possalesinvoicelisting";
             toastr.success('Invoice'+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
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
           $('#cust_name').val(value.cust_name);
           $('#building_no').val(value.cust_add1);
           $('#cust_region').val(value.cust_add2);
           $('#cust_district').val(value.cust_region);
           $('#cust_city').val(value.cust_city);
           $('#cust_zip').val(value.cust_zip);
           $('#mobile').val(value.mobile1);
           $('#vatno').val(value.vatno);
           $('#buyerid_crno').val(value.buyerid_crno);
           $('#cust_category').val(value.cust_category).trigger('change');
           $('#cust_type').val(value.cust_type).trigger('change');
           $('#cust_group').val(value.cust_group).trigger('change');
           $('#cust_country').val(value.cust_country).trigger('change');




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

    var invoicedetails_list_table = $('#invoicedetails_list').DataTable({
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
                                    doc.content[1].table.widths = [ '10%', '20%', '10%', '20%', '40%'];
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
                    "url": 'possalesinvoicelisting',
                    "type": "POST",
                    "data": function(data) {
                            data._token = $('#token').val()
                    }
            },
            columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'vanname', name: 'vanname' },
                    { data: 'cust_name', name: 'cust_name' },
                    { data: 'quotedate1', name: 'quotedate1' },
                    { data: 'totalamount', totalamount: 'name' },
                    { data: 'discount', name: 'discount' },
                    { data: 'vatamount', name: 'vatamount' },
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
                                                <a href="posinvoice_pdf?id=' + row.id + '" data-type="edit" target="_blank"><li class="kt-nav__item">\
                                                <span class="kt-nav__link">\
                                                <i class="kt-nav__link-icon flaticon2-contract"></i>\
                                                <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                                                </span></li></a>\
                                             </ul></div></div></span>';
                            }
                    },
            ]
        });

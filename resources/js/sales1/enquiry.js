var enquirydetails_list_table = $('#enquirydetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'newEnquiry',
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
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },

            {
              data: 'total',
              name: 'total',
              render: function(data, type, row) {
                if(row.total=='' || row.total==null){
                  return '0';
                }else{
                   return row.total; 
                }
              }
          },


        /*   { data: 'total', name: 'total' },*/
         /*  {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;'; 
                }
              }
          },*/
          { data: 'quotedate', name: 'quotedate' },

        /*  { data: 'validity', name: 'validity' },*/
         
          { data: 'cust_name', name: 'cust_name', },
         /* { data: 'reference', name: 'reference' },*/
          
          { data: 'name', name: 'name' },
         
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           if (row.status == 0) 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 1) 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 2) 
                {
                  return '<span style="color: red">Rejected</span>';

                }
                  
              }
          },
          
          {
              data: 'enqstatus',
              name: 'enqstatus',
              render: function(data, type, row) {
                if(row.enqstatus=='Expired'){
                   return  'Expired '+ row.redays +  ' days'; 
                }else{
                  return +row.redays+ ' days to expire' ;

                }
              }
          },
          { data: 'updated_at', name: 'updated_at' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                if (row.status == 0) {
                     j='<a href="enquiry_pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a href="enquiry_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item enquiry_approve" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Approve</span>\
                        </span></li></a>\
                        <a  data-type="rejected" data-target="#kt_form"><li class="kt-nav__item enquiry_rejected" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-cross"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Reject</span>\
                        </span></li></a>\
                        <a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delete</span>\
                        </span></li></a>';
                 }
                 if (row.status == 1) {
                  j='<a href="enquiry_pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a  data-type="rfq" data-target="#kt_form"><li class="kt-nav__item enquiry_rfq" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Generate RFQ</span>\
                        </span></li></a><a  data-type="enquiryquote" data-target="#kt_form"><li class="kt-nav__item enquiryquote" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Generate Quotation</span>\
                        </span></li></a>\
                        <a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delete</span>\
                        </span></li></a>\
                        ';
                 }
                 if (row.status == 2)
                 {
                  j='<a href="enquiry_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>';

                 }


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


$(document).on('click', '#enquiry_submit', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#dateofsupply').val();
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
        // cust_name=$('#cust_name').val();

        cust_code = $('#cust_code').val();
    cust_group = $('#cust_group').val();
    cust_type = $('#cust_type').val();
    cust_category = $('#cust_category').val();
    cust_name= $('#cust_name').val();
    cust_country = $('#cust_country').val();
if (quotedate == "") {
            $('#quotedate').addClass('is-invalid');
            toastr.warning("Please Add Date!");
            return false;
        } else {
             $('#quotedate').removeClass('is-invalid');
         }
         if (validity == "") {
            $('#dateofsupply').addClass('is-invalid');
            toastr.warning("Please Add Till Date!");
            return false;
        } else {
             $('#dateofsupply').removeClass('is-invalid');
         }
 if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Salesman!");
                      return false;
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }
        if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Customer!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }

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
if (cust_category == "") {
    $('#cust_category').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Customer Category is Required.');
    
    return false;
    } else {
     $('#cust_category').next().find('.select2-selection').removeClass('is-invalid');
    }
    if (cust_code == "") {
    $('#cust_code').addClass('is-invalid');
    toastr.warning('customer Code is Required.');
    
    return false;
    } else {
    $('#cust_code').removeClass('is-invalid');
    }
    if (cust_type == "") {
    $('#cust_type').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Customer Type is Required.');
    
    return false;
    } else {
     $('#cust_type').next().find('.select2-selection').removeClass('is-invalid');
    }
    if (cust_group == "") {
    $('#cust_group').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Customer Group is Required.');
   
    return false;
    } else {
     $('#cust_group').next().find('.select2-selection').removeClass('is-invalid');
    }

    if (cust_name == "") {
    $('#cust_name').addClass('is-invalid');
    toastr.warning('Cusomer Name is Required.');
    
    return false;
    } else {
    $('#cust_name').removeClass('is-invalid');
    }
    if (cust_country == "") {
    $('#cust_country').next().find('.select2-selection').addClass('is-invalid');
    toastr.warning('Country is Required.');
    
    return false;
    } else {
     $('#cust_country').next().find('.select2-selection').removeClass('is-invalid');
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
        url: "newenquirysubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        quotedate     : $('#quotedate').val(),
        validity      : $('#validity').val(),
        currency      : $('#currency').val(),
        currencyvalue : $('#currency_value').val(),

        totalamount         : $('#totalamount').val(),
        discount            : $('#discount').val(),
        amountafterdiscount : $('#amountafterdiscount').val(),
        totalvatamount      : $('#totalvatamount').val(),
        grandtotalamount    : $('#grandtotalamount').val(),

        terms      : $('#terms').val(),
        notes      : $('#notes').val(),
        internalreference      : $('#internalreference').val(),
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
        tpreview : tinymce.get("kt-tinymce-4").getContent(),
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
        email      : $('#email').val(),
        vatno      : $('#vatno').val(),
        buyerid_crno      : $('#buyerid_crno').val(),
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        newcustomer : $('#newcustomer').val(),
        
   
        },
        success: function(data) {
       
        
             $('#enquiry_submit').removeClass('kt-spinner');
             $('#enquiry_submit').prop("disabled", false);
             location.reload();
              window.location.href = "newEnquiry";
             toastr.success('New Enquiry '+sucess_msg+' successfuly');
            

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



                        });

          $('#billing_address').val(inv_address);
          $('#shipping_address').val(ship_address);
          $('#contact_phone').val(cust_phone);
          

        }
    })
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
           $('#email').val(value.email1);
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

    




/* $(".kt_datetimepickerr").datetimepicker({
    format: 'dd-mm-yyyy'

}).on('changeDate', function(e){
    $(this).datetimepicker('hide');
});
*/


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



$(document).on('click', '#enquiry_update', function(e) {
    e.preventDefault();
        customer_id      = $('#customer_id').val();
        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#validity').val();
        currency      = $('#currency').val();
        currencyvalue = $('#currency_value').val();
         dateofsupply     = $('#dateofsupply').val();

        totalamount         = $('#totalamount').val();
        discount            = $('#discount').val();
        amountafterdiscount = $('#amountafterdiscount').val();
        totalvatamount      = $('#totalvatamount').val();
        grandtotalamount    = $('#grandtotalamount').val();

        terms      = $('#terms').val();
        notes      = $('#notes').val();
        preparedby = $('#preparedby').val();
        approvedby = $('#approvedby').val();
        cust_name=$('#cust_name').val();



        if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Customer!");
            
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }


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


     
          if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Salesman!");
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
                /*   toastr.warning("Please Add Any Product!");
                      return false;*/
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
        url: "newenquiryupdate",
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
        validity      : $('#validity').val(),
        currency      : $('#currency').val(),
        currencyvalue : $('#currency_value').val(),
         dateofsupply     : $('#dateofsupply').val(),

        totalamount         : $('#totalamount').val(),
        discount            : $('#discount').val(),
        amountafterdiscount : $('#amountafterdiscount').val(),
        totalvatamount      : $('#totalvatamount').val(),
        grandtotalamount    : $('#grandtotalamount').val(),

        terms      : $('#terms').val(),
        notes      : $('#notes').val(),
        internalreference      : $('#internalreference').val(),
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
        tpreview : tinymce.get("kt-tinymce-4").getContent(),
        dateofsupply : $('#dateofsupply').val(),
        method : $('#method').val(),
        invcustomer_id : $('#invcustomer_id').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        
        },
        success: function(data) {
       
        
             $('#enquiry_update').removeClass('kt-spinner');
             $('#enquiry_update').prop("disabled", false);
             location.reload();
              window.location.href = "newEnquiry";
             toastr.success('Enquiry Updated Successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});


$(document).on('click', '.enquiry_approve', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Approved this Enquiry",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Approve",
            cancelButtonText: "Reject"
        }).then(result => {
            if (result.value) {
            window.location = "enquiry_approve?id="+id;
               
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });
$(document).on('click', '.enquiry_rejected', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Reject this Enquiry",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
window.location = "enquiry_rejected?id="+id;
               
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });

$(document).on('click', '.enquiry_rfq', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want RFQ this Enquiry",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
window.location = "enquiry_rfq?id="+id;
               
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });


$(document).on('click', '.enquiryquote', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Generate Quotation for this Enquiry",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
window.location = "enquiryquote?id="+id;
               
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });




var enquirydetails_list_draft_table = $('#enquirydetails_list_draft').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'newEnquiry_draft',
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
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           { data: 'total', name: 'total' },
         /*  {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;'; 
                }
              }
          },*/
          { data: 'quotedate', name: 'quotedate' },

        /*  { data: 'validity', name: 'validity' },*/
         
          { data: 'cust_name', name: 'cust_name', },
         /* { data: 'reference', name: 'reference' },*/
          
          { data: 'name', name: 'name' },
           
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           if (row.status == 0) 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 1) 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 2) 
                {
                  return '<span style="color: red">Rejected</span>';

                }
                  
              }
          },
          {
              data: 'enqstatus',
              name: 'enqstatus',
              render: function(data, type, row) {
                if(row.enqstatus=='Expired'){
                   return  'Expired '+ row.redays +  ' days'; 
                }else{
                  return +row.redays+ ' days to expire' ;

                }
              }
          },
          { data: 'updated_at', name: 'updated_at' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                if (row.status == 0) {
                     j='<a href="enquiry_pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>\
                        <a href="enquiry_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item enquiry_approve" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Approve</span>\
                        </span></li></a>\
                        <a  data-type="rejected" data-target="#kt_form"><li class="kt-nav__item enquiry_rejected" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-cross"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Reject</span>\
                        </span></li></a>\
                        <a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delete</span>\
                        </span></li></a>\
                        ';
                 }
                
                


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
var enquirydetails_list_approved_table = $('#enquirydetails_list_approved').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'newEnquiry_approved',
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
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
            { data: 'total', name: 'total' },
         /*  {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;'; 
                }
              }
          },*/
          { data: 'quotedate', name: 'quotedate' },

        /*  { data: 'validity', name: 'validity' },*/
         
          { data: 'cust_name', name: 'cust_name', },
         /* { data: 'reference', name: 'reference' },*/
          
          { data: 'name', name: 'name' },
           
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           if (row.status == 0) 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 1) 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 2) 
                {
                  return '<span style="color: red">Rejected</span>';

                }
                  
              }
          },
          {
              data: 'enqstatus',
              name: 'enqstatus',
              render: function(data, type, row) {
                if(row.enqstatus=='Expired'){
                   return  'Expired '+ row.redays +  ' days'; 
                }else{
                  return +row.redays+ ' days to expire' ;

                }
              }
          },
          { data: 'updated_at', name: 'updated_at' },

          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                 if (row.status == 1) {
                  j='<a href="enquiry_pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a  data-type="rfq" data-target="#kt_form"><li class="kt-nav__item enquiry_rfq" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Generate RFQ</span>\
                        </span></li></a><a  data-type="enquiryquote" data-target="#kt_form"><li class="kt-nav__item enquiryquote" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Generate Quotation</span>\
                        </span></li></a>\
                        <a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delete</span>\
                        </span></li></a>\
                        ';
                 }                
                


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
var enquirydetails_list_rejected_table = $('#enquirydetails_list_rejected').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'newEnquiry_rejected',
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
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
          {
              data: 'total',
              name: 'total',
              render: function(data, type, row) {
                if(row.total=='' || row.total==null){
                  return '0';
                }else{
                   return row.total; 
                }
              }
          },
              /*  { data: 'total', name: 'total' },*/
         /*  {
              data: 'sid',
              name: 'sid',
              render: function(data, type, row) {
                if(row.sid=='' || row.sid==null){
                  return '';
                }else{
                   return '#' + row.sid + '&nbsp;&nbsp;'; 
                }
              }
          },*/
          { data: 'quotedate', name: 'quotedate' },

        /*  { data: 'validity', name: 'validity' },*/
         
          { data: 'cust_name', name: 'cust_name', },
         /* { data: 'reference', name: 'reference' },*/
          
          { data: 'name', name: 'name' },
           
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           if (row.status == 0) 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 1) 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 2) 
                {
                  return '<span style="color: red">Rejected</span>';

                }
                  
              }
          },
          {
              data: 'enqstatus',
              name: 'enqstatus',
              render: function(data, type, row) {
                if(row.enqstatus=='Expired'){
                   return  'Expired '+ row.redays +  ' days'; 
                }else{
                  return +row.redays+ ' days to expire' ;

                }
              }
          },
          { data: 'updated_at', name: 'updated_at' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
               
                  j='<a href="enquiry_pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delete</span>\
                        </span></li></a>\
                        ';
                              
                


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

var purchasedeliverydetails_list_table = $('#purchasedeliverydetails_list').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'purchase_delivery',
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
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'rfq_id',
              name: 'rfq_id',
              render: function(data, type, row) {
                if(row.rfq_id=='' || row.rfq_id==null){
                  return '';
                }else{
                   return '#' + row.rfq_id + '&nbsp;&nbsp;'; 
                }
              }
          },
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                if(row.enquiry_id=='' || row.enquiry_id==null){
                  return '';
                }else{
                   return '#' + row.enquiry_id + '&nbsp;&nbsp;'; 
                }
              }
          },
          {
              data: 'vid',
              name: 'vid',
              render: function(data, type, row) {
                  return '#' + row.vid + '&nbsp;&nbsp;';
              }
          },

          { data: 'quotedate', name: 'quotedate' },

     /*  {
              data: 'provider',
              name: 'provider',
              render: function(data, type, row) {
                if(row.provider==1){
                  return 'Supplier';
                }else{
                   return 'Vendor';
                }
              }
          },*/
         
           { data: 'svname', name: 'svname' },
          
        /*  { data: 'name', name: 'name' },*/
           { data: 'grandtotalamount', name: 'grandtotalamount' },
        /*  {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
                  return '<span style="color: black">'+row.status+'</span>';
                  
              }
          },*/
           { data: 'updated_at', name: 'updated_at' },

          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                
                
                 j+='<a href="rfqpo_pdf1?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Commercial PO PDF</span>\
                        </span></li></a><a href="rfqpo_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Technical PO PDF</span>\
                        </span></li></a><a href="po_vo?id=' + row.id + '" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >VO</span>\
                        </span></li></a>';

                        if (row.status == 'Draft') {
                             j+='<a href="delivery_order_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><a href="delivery_order_issue?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PO Issue</span>\
                        </span></li></a>';
                        }

                          if (row.status == 'Po Issued') {

                             if (row.grn != 1) {
                               j+='<a href="delivery_order_convert_grn?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate GRN</span>\
                        </span></li></a>';
                        }
                        if (row.pi != 1) {
                               j+='<a href="delivery_order_convert_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate Purchase Invoice</span>\
                        </span></li></a>';
                        }
                          }
                       

                        
                       /*  j+='<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delete</span>\
                        </span></li></a>\
                        ';*/


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





var purchasedeliverydetails_list_issued_table = $('#purchasedeliverydetails_list_issued').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'purchase_delivery1',
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
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
           {
              data: 'rfq_id',
              name: 'rfq_id',
              render: function(data, type, row) {
                if(row.rfq_id=='' || row.rfq_id==null){
                  return '';
                }else{
                   return '#' + row.rfq_id + '&nbsp;&nbsp;'; 
                }
              }
          },
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                if(row.enquiry_id=='' || row.enquiry_id==null){
                  return '';
                }else{
                   return '#' + row.enquiry_id + '&nbsp;&nbsp;'; 
                }
              }
          },
          { data: 'quotedate', name: 'quotedate' },

     /*  {
              data: 'provider',
              name: 'provider',
              render: function(data, type, row) {
                if(row.provider==1){
                  return 'Supplier';
                }else{
                   return 'Vendor';
                }
              }
          },*/
         
           { data: 'svname', name: 'svname' },
          
          { data: 'name', name: 'name' },
           { data: 'grandtotalamount', name: 'grandtotalamount' },
        /*  {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
                  return '<span style="color: black">'+row.status+'</span>';
                  
              }
          },*/
          { data: 'updated_at', name: 'updated_at' },

          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                
                
                 j+='<a href="rfqpo_pdf1?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Commercial PO PDF</span>\
                        </span></li></a><a href="rfqpo_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Technical PO PDF</span>\
                        </span></li></a><a href="po_vo?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >VO</span>\
                        </span></li></a>';

                        if (row.status == 'Draft') {
                             j+='<a href="delivery_order_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a><a href="delivery_order_issue?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PO Issue</span>\
                        </span></li></a>';
                        }

                          if (row.status == 'Po Issued') {

                             if (row.grn != 1) {
                               j+='<a href="delivery_order_convert_grn?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate GRN</span>\
                        </span></li></a>';
                        }
                        if (row.pi != 1) {
                               j+='<a href="delivery_order_convert_invoice?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate Purchase Invoice</span>\
                        </span></li></a>';
                        }
                          }
                       

                        
                       /*  j+='<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delete</span>\
                        </span></li></a>\
                        ';*/


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






var purchasedeliverydetails_list_vo_table = $('#purchasedeliverydetails_list_vo').DataTable({
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
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
                  columns: [0, 1, 2, 3,4,5,6,7,8,9,10]
              }
          }
      ],

      ajax: {
          "url": 'purchase_delivery2',
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
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },
          { data: 'quotedate', name: 'quotedate' },

     /*  {
              data: 'provider',
              name: 'provider',
              render: function(data, type, row) {
                if(row.provider==1){
                  return 'Supplier';
                }else{
                   return 'Vendor';
                }
              }
          },*/
         
           { data: 'svname', name: 'svname' },
          
          { data: 'name', name: 'name' },
           { data: 'grandtotalamount', name: 'grandtotalamount' },
        /*  {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
                  return '<span style="color: black">'+row.status+'</span>';
                  
              }
          },*/
          { data: 'updated_at', name: 'updated_at' },

          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                
                
                 j+='<a href="rfqpo_pdf1?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Commercial PO PDF</span>\
                        </span></li></a><a href="rfqpo_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Technical PO PDF</span>\
                        </span></li></a>';

                     


                        
                       /*  j+='<a data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Delete</span>\
                        </span></li></a>\
                        ';*/


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


$(document).on('click', '#dpo_submit', function(e) {
    e.preventDefault();

        customer      = $('#customer1').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#dateofsupply').val();
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
        cust_name=$('#cust_name').val();


        if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Supplier!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }

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

        $("select[name^='vat_percentage[]']")
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

          if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Salesman!");
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
        url: "newposubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        customer      : $('#customer1').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        quotedate     : $('#quotedate').val(),
        validity      : $('#validity').val(),
        currency      : $('#currency').val(),
        currencyvalue : $('#currency_value').val(),

        totalamount         : $('#totalamount').val(),
        discount            : $('#discount').val(),
        amountafterdiscount : $('#amountafterdiscount').val(),
        totalvatamount      : $('#totalvatamount').val(),
        grandtotalamount    : $('#grandtotalamount').val(),

        terms      : $('#terms').val(),
        notes      : $('#notes').val(),
        internalreference      : $('#internalreference').val(),
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
        tpreview : tinymce.get("kt-tinymce-4").getContent(),
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
       
        
             $('#dpo_submit').removeClass('kt-spinner');
             $('#dpo_submit').prop("disabled", false);
             location.reload();
              window.location.href = "purchase_delivery";
             toastr.success('New PO '+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});
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
           $("#cust_name").prop("readonly",true);
           $('#building_no').val(value.cust_add1);
           $("#building_no").prop("readonly",true);
           $('#cust_region').val(value.cust_add2);
           $("#cust_region").prop("readonly",true);
           $('#cust_district').val(value.cust_region);
           $("#cust_district").prop("readonly",true);
           $('#cust_city').val(value.cust_city);
           $("#cust_city").prop("readonly",true);
           $('#cust_zip').val(value.cust_zip);
           $("#cust_zip").prop("readonly",true);
           $('#mobile').val(value.mobile1);
           $("#mobile").prop("readonly",true);
           $('#cust_code').val(value.cust_code);
           $("#cust_code").prop("readonly",true);
           $('#vatno').val(value.vatno);
           $("#vatno").prop("readonly",true);
           $('#buyerid_crno').val(value.buyerid_crno);
           $("#buyerid_crno").prop("readonly",true);
           $('#cust_category').val(value.cust_category).trigger('change');
           $('#cust_category').prop("disabled", true);
           $('#cust_type').val(value.cust_type).trigger('change');
           $('#cust_type').prop("disabled", true);
           $('#cust_group').val(value.cust_group).trigger('change');
           $('#cust_group').prop("disabled", true);
           $('#cust_country').val(value.cust_country).trigger('change');
           $('#cust_country').prop("disabled", true);
                        });

          $('#billing_address').val(inv_address);
          $('#shipping_address').val(ship_address);
          $('#contact_phone').val(cust_phone);

          

        }
    })
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

$(document).on('click', '#enquiry_estimation_submit', function(e) {
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
        var cost = [];

        $("input[name^='cost[]']")
        .each(function(input) {
            cost.push($(this).val());
        });
        var salepercentage = [];

        $("input[name^='salepercentage[]']")
        .each(function(input) {
            salepercentage.push($(this).val());
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
        url: "newestimationsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        customer      : $('#customer').val(),
        rfqlist      : $('#rfqlist').val(),
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
        cost : cost,
        salepercentage : salepercentage,
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
       
        
             $('#enquiry_estimation_submit').removeClass('kt-spinner');
             $('#enquiry_estimation_submit').prop("disabled", false);
             location.reload();
              window.location.href = "estimationlisting";
             toastr.success('New Estimation '+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

var estmationdetails_list_table = $('#estmationdetails_list').DataTable({
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
          "url": 'estimationlisting',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          {
              data: 'rfqlist',
              name: 'rfqlist',
              render: function(data, type, row) {
                  return '#' + row.rfqlist + '&nbsp;&nbsp;';
              }
          },
          { data: 'quotedate', name: 'quotedate' },
          { data: 'cust_name', name: 'cust_name', },
         
          
          { data: 'name', name: 'name' },
         

          // {
          //     data: 'status',
          //     name: 'status',
          //     render: function(data, type, row) {
          //  if (row.status == 0) 
          //       {
          //         return '<span style="color: black">Draft</span>';

          //       }
          //       if (row.status == 1) 
          //       {
          //         return '<span style="color: green">Approved</span>';

          //       }
          //       if (row.status == 2) 
          //       {
          //         return '<span style="color: red">Rejected</span>';

          //       }
                  
          //     }
          // },

          { data: 'updated_at', name: 'updated_at' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
               
                     j='<a href="estimation_pdf?id=' + row.id + '" target="_blank" data-type="edit" data-target="#kt_form" ><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a href="estimation_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a data-type="convertquote" data-target="#kt_form"><li class="kt-nav__item convertquote" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Convert to Quotation</span>\
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
$(document).on('click', '#estimation_update', function(e) {
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
        var cost = [];

        $("input[name^='cost[]']")
        .each(function(input) {
            cost.push($(this).val());
        });
        var salepercentage = [];

        $("input[name^='salepercentage[]']")
        .each(function(input) {
            salepercentage.push($(this).val());
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
        url: "newestimationupdate",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#customer_id').val(),
        customer      : $('#customer').val(),
        rfqlist      : $('#rfqlist').val(),
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
        cost : cost,
        salepercentage : salepercentage,
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
       
        
             $('#estimation_update').removeClass('kt-spinner');
             $('#estimation_update').prop("disabled", false);
             location.reload();
              window.location.href = "estimationlisting";
             toastr.success('New Estimation '+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

$(document).on('click', '.convertquote', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Generate Quotation for this Estimation",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
window.location = "estimationquote?id="+id;
               
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });


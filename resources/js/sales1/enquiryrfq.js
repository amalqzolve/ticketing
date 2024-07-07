$(document).on('click', '#enquiry_rfq_update', function(e) {
    e.preventDefault();
        supplier_vendor_names= $('#supplier_vendor_names').val();
        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#validity').val();
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


        if (supplier_vendor_names == "") {
            $('#supplier_vendor_names').addClass('is-invalid');
            toastr.warning("Please Add Supplier/Vendor!");
            return false;
        } else {
             $('#supplier_vendor_names').removeClass('is-invalid');
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

   var supplier_vendor = [];

        $("input[name^='supplier_vendor_names[]']")
        .each(function(input) {
            supplier_vendor.push($(this).val());
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
        url: "enquiryrfqsubmit",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        enquiryid      : $('#enquiryid').val(),
        // provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#supplier_vendor_names').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
        supplier_vendor:supplier_vendor,
        internalreference      : $('#internalreference').val(),

        
   
        },
        success: function(data) {
       
        
             $('#enquiry_rfq_update').removeClass('kt-spinner');
             $('#enquiry_rfq_update').prop("disabled", false);
     
              window.location.href = "rfqlisting";
             toastr.success('New Enquiry RFQ '+sucess_msg+' successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

var rfqenquirydetails_list_table = $('#rfqenquirydetails_list').DataTable({
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
          "url": 'rfqlisting',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
     /*     {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },*/
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
          { data: 'edate', name: 'edate' },
           
           { data: 'totalCount', name: 'totalCount' },{ data: 'quotedate', name: 'quotedate' },

        /*  { data: 'validity', name: 'validity' },*/
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
           { data: 'cust_name', name: 'cust_name' },
         
           { data: 'sup_name', name: 'sup_name' },
         
          
          { data: 'name', name: 'name' },
           /*{ data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }

               
             
                  
              }
          },*/
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='<a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>';
                
           /*     if (row.status === 'Draft') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a href="rfq_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item rfq_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }

                  if (row.status === 'Send') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a  data-type="negotiation" data-target="#kt_form"><li class="kt-nav__item rfq_negotiation" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Negotiate</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item rfq_approve" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Approve</span>\
                        </span></li></a>\
                        <a  data-type="rejected" data-target="#kt_form"><li class="kt-nav__item rfq_rejected" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-cross"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Reject</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }

                 if (row.status === 'Negotiated') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a  data-type="revised" data-target="#kt_form"><li class="kt-nav__item rfq_revised" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Revise</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }

                 if (row.status === 'Revised') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item rfq_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }

                    if (row.status === 'Approved') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }
                    
                     if (row.status === 'Rejected') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }*/

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







$(document).on('click', '.rfq_send', function() {
        var id = $(this).attr('id');
      
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Send this RFQ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
          /* cancelButtonText: "No"
        }).then(result => {*/
            cancelButtonText: "No, cancel it!" }).then(result => {
                if (result.value){
                 window.location = "rfq_send?id="+id;
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });




$(document).on('click', '.rfq_negotiation', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Negotiate this RFQ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {

               window.location = "rfq_negotiation?id="+id;
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });

$(document).on('click', '.rfq_revised', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Revised this RFQ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {

               window.location = "rfq_revised?id="+id;
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });

$(document).on('click', '.rfq_approve', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Approved this RFQ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
            window.location = "rfq_approve?id="+id;
               
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });
$(document).on('click', '.rfq_rejected', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Reject this RFQ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
window.location = "rfq_rejected?id="+id;
               
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });


$(document).on('click', '#enquiry_rfq_update_edit1', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        rfqdate     = $('#rfqdate').val();
        validity      = $('#validity').val();
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


     /*   if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Supplier/Vendor!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }*/

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
        url: "enquiryrfqupdate1",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        // provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
       
        
             $('#enquiry_rfq_update_edit1').removeClass('kt-spinner');
             $('#enquiry_rfq_update_edit1').prop("disabled", false);
       
              window.location.href = "rfqlisting";
             toastr.success('New Enquiry RFQ '+sucess_msg+' successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});




$(document).on('click', '#enquiry_rfq_update_edit', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        rfqdate     = $('#rfqdate').val();
        validity      = $('#validity').val();
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


     /*   if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Supplier/Vendor!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }*/

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


            if (productname.length > 0) {
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
        url: "enquiryrfqupdate",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        // provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
        internalreference      : $('#internalreference').val(),
        
   
        },
        success: function(data) {
       
        
             $('#enquiry_rfq_update_edit').removeClass('kt-spinner');
             $('#enquiry_rfq_update_edit').prop("disabled", false);
      
              window.location.href = "rfqlisting";
             toastr.success('New Enquiry RFQ '+sucess_msg+' successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});




$(document).on('click', '#enquiry_rfq_update_approve', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        rfqdate     = $('#rfqdate').val();
        validity      = $('#validity').val();
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
            toastr.warning("Please Add Supplier/Vendor!");
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
                   toastr.warning("Please Add Any Product!");
                      return false;
            }


     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Approved';
     } else{
        var sucess_msg ='Approved';
     }
    

    $.ajax({
        type: "POST",
        url: "enquiryrfqapprove",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        // provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
         internalreference      : $('#internalreference').val(),
        
   
        },
        success: function(data) {
       
        
             $('#enquiry_rfq_update_approve').removeClass('kt-spinner');
             $('#enquiry_rfq_update_approve').prop("disabled", false);
      
              window.location.href = "purchase_delivery";
             toastr.success('New Enquiry RFQ '+sucess_msg+' successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});

var rfqenquirydetails_list_draft_table = $('#rfqenquirydetails_list_draft').DataTable({
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
          "url": 'rfqlisting_draft',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
         /* {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },*/
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        { data: 'edate', name: 'edate' },
           { data: 'totalCount', name: 'totalCount' },
         /*  { data: 'quotedate', name: 'quotedate' },*/
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
         { data: 'cust_name', name: 'cust_name' },
              { data: 'cust_name', name: 'cust_name' },

          // { data: 'enqstatus', name: 'enqstatus' },
         
         
          
          { data: 'name', name: 'name' },
          /* { data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }

               
             
                  
              }
          },*/
          { data: 'updated_at', name: 'updated_at' },

          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='<a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>';
                
               /* if (row.status === 'Draft') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a href="rfq_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item rfq_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }*/

                 

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
  var rfqenquirydetails_list_send_table = $('#rfqenquirydetails_list_send').DataTable({
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
          "url": 'rfqlisting_send',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
             
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
         /* {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },*/
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        { data: 'edate', name: 'edate' },
           { data: 'totalCount', name: 'totalCount' },
          /* { data: 'quotedate', name: 'quotedate' },*/
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
         { data: 'cust_name', name: 'cust_name' },
           { data: 'sup_name', name: 'sup_name' },

          { data: 'name', name: 'name' },
          // { data: 'enqstatus', name: 'enqstatus' },

           /*{ data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }

               
             
                  
              }
          },*/
           { data: 'updated_at', name: 'updated_at' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='<a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>';
                
                
/*
                  if (row.status === 'Send') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a  data-type="negotiation" data-target="#kt_form"><li class="kt-nav__item rfq_negotiation" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Negotiate</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item rfq_approve" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Approve</span>\
                        </span></li></a>\
                        <a  data-type="rejected" data-target="#kt_form"><li class="kt-nav__item rfq_rejected" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-cross"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Reject</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }
*/
                 

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
var rfqenquirydetails_list_negotiated_table = $('#rfqenquirydetails_list_negotiated').DataTable({
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
          "url": 'rfqlisting_negotiated',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
         /* {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },*/
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        { data: 'edate', name: 'edate' },
           { data: 'totalCount', name: 'totalCount' },
          /* { data: 'quotedate', name: 'quotedate' },*/
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
         { data: 'cust_name', name: 'cust_name' },
           { data: 'sup_name', name: 'sup_name' },
        /*  { data: 'validity', name: 'validity' },*/
         
         
          
          { data: 'name', name: 'name' },
          /* { data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }

               
             
                  
              }
          },*/
          { data: 'updated_at', name: 'updated_at' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='<a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>';
                
                

                 

                /* if (row.status === 'Negotiated') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a  data-type="revised" data-target="#kt_form"><li class="kt-nav__item rfq_revised" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Revise</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }*/


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
var rfqenquirydetails_list_approved_table = $('#rfqenquirydetails_list_approved').DataTable({
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
          "url": 'rfqlisting_approved',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
         /* {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },*/
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        { data: 'edate', name: 'edate' },
           { data: 'totalCount', name: 'totalCount' },
        /*   { data: 'quotedate', name: 'quotedate' },*/
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
         { data: 'cust_name', name: 'cust_name' },
           { data: 'sup_name', name: 'sup_name' },
        /*  { data: 'validity', name: 'validity' },*/
         
         
          
          { data: 'name', name: 'name' },
           /*{ data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }

               
             
                  
              }
          },*/
          { data: 'updated_at', name: 'updated_at' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='<a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>';
                

               /*     if (row.status === 'Approved') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }*/
                    
                   

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
var rfqenquirydetails_list_rejected_table = $('#rfqenquirydetails_list_rejected').DataTable({
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
          "url": 'rfqlisting_rejected',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        /*  {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },*/
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        { data: 'edate', name: 'edate' },
           { data: 'totalCount', name: 'totalCount' },
           /*{ data: 'quotedate', name: 'quotedate' },*/
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
         { data: 'cust_name', name: 'cust_name' },
           { data: 'sup_name', name: 'sup_name' },

        /*  { data: 'validity', name: 'validity' },*/
         
         
          
          { data: 'name', name: 'name' },
          /* { data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }

               
             
                  
              }
          },*/
           { data: 'updated_at', name: 'updated_at' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='<a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>';
                
                
           /*         
                     if (row.status === 'Rejected') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }
*/
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
var rfqenquirydetails_list_revised_table = $('#rfqenquirydetails_list_revised').DataTable({
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
          "url": 'rfqlisting_revised',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          /*{
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },*/
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        { data: 'edate', name: 'edate' },
           { data: 'totalCount', name: 'totalCount' },
          /* { data: 'quotedate', name: 'quotedate' },*/
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
         { data: 'cust_name', name: 'cust_name' },
           { data: 'sup_name', name: 'sup_name' },
        /*  { data: 'validity', name: 'validity' },*/
         
         
          
          { data: 'name', name: 'name' },
          /* { data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }

               
             
                  
              }
          },*/
          { data: 'updated_at', name: 'updated_at' },

          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='<a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>';
                


             /*    if (row.status === 'Revised') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&status='+row.status+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>\
                        <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item rfq_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }*/

                  

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
var rfqenquirydetails_list_revisedversion_table = $('#rfqenquirydetails_list_revisedversion').DataTable({
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
          "url": 'rfqlistingrevisedversions',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()

          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        /*  {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },*/
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        { data: 'edate', name: 'edate' },
           { data: 'totalCount', name: 'totalCount' },
          /* { data: 'quotedate', name: 'quotedate' },*/

        /*  { data: 'validity', name: 'validity' },*/
         
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
         { data: 'cust_name', name: 'cust_name' },
           { data: 'sup_name', name: 'sup_name' },
          
          { data: 'name', name: 'name' },
          /* { data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }

               
             
                  
              }
          },*/
          { data: 'updated_at', name: 'updated_at' },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
               
                      j='<a href="rfqrevised_view_more?id=' + row.id + '&&eid='+row.enquiry_id+'&&version='+row.version+'" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ List</span>\
                        </span></li></a>';
                    
               
                    return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">'+j+'\
                       </ul></div></div></span>';
              }
          }
          
      ]
  });

var rfqenquirydetails_list_more_table = $('#rfqenquirydetails_list_more').DataTable({
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
          "url": 'rfq_view_more',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.eid = $('#enquiry_id').val(),
              data.status = $('#status').val()
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
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        
          /* { data: 'totalCount', name: 'totalCount' },*/
          { data: 'edate', name: 'edate' },
           { data: 'quotedate', name: 'quotedate' },

        /*  { data: 'validity', name: 'validity' },*/
         
         
          { data: 'cust_name', name: 'cust_name' },
          { data: 'sup_name', name: 'sup_name' },
          
          { data: 'name', name: 'name' },
           /*{ data: 'grandtotalamount', name: 'grandtotalamount' },*/
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }
                 if (row.status == 'RFQ Submitted') 
                {
                  return '<span style="color: green">RFQ Submitted</span>';

                }

               
             
                  
              }
          },
          { data: 'updated_at', name: 'updated_at' },

          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='';
                
                if (row.status === 'Draft') {
                     j='<a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a href="rfq_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item rfq_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                        </span></li></a>';
                    }

                  if (row.status === 'Send') {
                     j='<a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a  data-type="negotiation" data-target="#kt_form"><li class="kt-nav__item rfq_negotiation" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Negotiate</span>\
                        </span></li></a>\
                        <a data-type="approved" data-target="#kt_form"><li class="kt-nav__item rfq_approve" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-check-mark"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Approve</span>\
                        </span></li></a><a  data-type="rejected" data-target="#kt_form"><li class="kt-nav__item rfq_rejected" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-cross"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Reject</span>\
                        </span></li></a><a href="rfq_value?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >RFQ Value Submition</span>\
                        </span></li></a> ';
                    }

                 if (row.status === 'Negotiated') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a  data-type="revised" data-target="#kt_form"><li class="kt-nav__item rfq_revised" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Revise</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }

                 if (row.status === 'Revised') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a  data-type="send" data-target="#kt_form"><li class="kt-nav__item rfq_send" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-multimedia"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" id=' + row.id + '>Send</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a>';
                    }

                    if (row.status === 'Approved') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
                        </span></li></a><a  data-type="rfqquote" data-target="#kt_form"><li class="kt-nav__item rfqquote" id=' + row.id +'>\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '"  id=' + row.id + '>Generate Quotation</span>\
                        </span></li></a>';
                    }
                    
                     if (row.status === 'Rejected') {
                     j='<a href="rfq_view?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
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

var rfqreviseddetails_list_more_table = $('#rfqreviseddetails_list_more').DataTable({
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
          "url": 'rfqrevised_view_more',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val(),
              data.version = $('#version').val()

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
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        
           { data: 'totalCount', name: 'totalCount' },
           { data: 'quotedate', name: 'quotedate' },

        /*  { data: 'validity', name: 'validity' },*/
         
         
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
         
           { data: 'vsname', name: 'vsname' },
          { data: 'name', name: 'name' },
           { data: 'grandtotalamount', name: 'grandtotalamount' },
          {
              data: 'status',
              name: 'status',
              render: function(data, type, row) {
           
               
                if (row.status == 'Draft') 
                {
                  return '<span style="color: black">Draft</span>';

                }
                if (row.status == 'Send') 
                {
                  return '<span style="color: pink">Send</span>';
                }
                 if (row.status == 'Negotiated') 
                {
                  return '<span style="color: blue">Negotiated</span>';

                }
                 if (row.status == 'Revised') 
                {
                  return '<span style="color: yellow">Revised</span>';

                }
                if (row.status == 'Approved') 
                {
                  return '<span style="color: green">Approved</span>';

                }
                if (row.status == 'Rejected') 
                {
                  return '<span style="color: red">Rejected</span>';

                }

               
             
                  
              }
          },
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
               j='<a href="rfq_view_revised?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >View</span>\
                        </span></li></a>\
                        <a href="rfq_pdf_revised?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >PDF</span>\
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
//


$(document).on('click', '#enquiry_rfq_update_revise', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#validity').val();
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


        // if (cust_name == "") {
        //     $('#cust_name').addClass('is-invalid');
        //     toastr.warning("Please Add Supplier/Vendor!");
        //     return false;
        // } else {
        //      $('#cust_name').removeClass('is-invalid');
        //  }

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
                   toastr.warning("Please Add Any Product!");
                      return false;
            }


     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Revised';
     } else{
        var sucess_msg ='Revised';
     }
    

    $.ajax({
        type: "POST",
        url: "enquiryrfqrevision",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
       
        
             $('#enquiry_rfq_update_revise').removeClass('kt-spinner');
             $('#enquiry_rfq_update_revise').prop("disabled", false);
      
              window.location.href = "rfqlisting";
             toastr.success('New Enquiry RFQ '+sucess_msg+' successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});





$(document).on('click', '#grn_update_edit', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#validity').val();
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
            toastr.warning("Please Add Supplier/Vendor!");
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

         var grn_quantity = [];

        $("input[name^='grn_quantity[]']")
        .each(function(input) {
            grn_quantity.push($(this).val());
        });

         var oquantity = [];

        $("input[name^='oquantity[]']")
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
        
        var costtax_notes = [];

    $("input[name^='costtax_notes[]']")
        .each(function(input) {
            costtax_notes.push($(this).val());
        });

        var costsupplier = [];

    $("input[name^='costsupplier[]']")
        .each(function(input) {
            costsupplier.push($(this).val());
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
        url: "grnupdate",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        deliveryorder_id            : $('#deliveryorder_id').val(),
        rfq_id            : $('#rfq_id').val(),
        enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
         name          : $('#suppliernames').val(),
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
        preparedby : $('#preparedby').val(),
        approvedby : $('#approvedby').val(),
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        grn_quantity:grn_quantity,
        oquantity:oquantity,
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
         internalreference      : $('#internalreference').val(),
          purchaser: $('#purchaser').val(),
           po_ref_number : $('#po_ref_number').val(),
           purchasebillid : $('#purchasebillid').val(),
           purchasemethod  : $('#purchasemethod').val(),
           itemcost_details : itemcost_details,
            costrate : costrate,
            costtax_group : costtax_group,
            costtax_amount : costtax_amount,
            costtax_notes : costtax_notes,
            costsupplier : costsupplier,

      /*  provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#supplier_vendor_names').val(),
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
        preparedby : $('#preparedby').val(),
        approvedby : $('#approvedby').val(),
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        grn_quantity:grn_quantity,
        oquantity:oquantity,
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
        newcustomer : $('#newcustomer').val(),*/
        
   
        },
        success: function(data) {
       
        
             $('#grn_update_edit').removeClass('kt-spinner');
             $('#grn_update_edit').prop("disabled", false);
    
              window.location.href = "grn";
             toastr.success('New GRN '+sucess_msg+' successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});




$(document).on('click', '#pi_update_edit', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        quotedate     = $('#quotedate').val();
        validity      = $('#validity').val();
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
            toastr.warning("Please Add Supplier/Vendor!");
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

         var pi_quantity = [];

        $("input[name^='pi_quantity[]']")
        .each(function(input) {
            pi_quantity.push($(this).val());
        });

         var oquantity = [];

        $("input[name^='oquantity[]']")
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

          if (salesman == "") {
            $('#salesman').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Salesman!");
                      return false;
        } else {
            $('#salesman').next().find('.select2-selection').removeClass('select-dropdown-error');
        }


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
        
        var costtax_notes = [];

    $("input[name^='costtax_notes[]']")
        .each(function(input) {
            costtax_notes.push($(this).val());
        });

        var costsupplier = [];

    $("input[name^='costsupplier[]']")
        .each(function(input) {
            costsupplier.push($(this).val());
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


     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Updated';
     } else{
        var sucess_msg ='Created';
     }
    

    $.ajax({
        type: "POST",
        url: "piupdate1",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        po_id            : $('#deliveryorder_id').val(),
        so_id            : $('#rfq_id').val(),
        enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        purchase_date     : $('#quotedate').val(),
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
        preparedby : $('#preparedby').val(),
        approvedby : $('#approvedby').val(),
        productname : productname,
        product_description : product_description,
        unit : unit,
        quantity : quantity,
        pi_quantity:pi_quantity,
        oquantity:oquantity,
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
        purchasemethod : $('#method').val(),
        qtnref : $('#qtnref').val(),
        po_wo_ref : $('#po_wo_ref').val(),
        newcustomer : $('#newcustomer').val(),
        internalreference      : $('#internalreference').val(),
        itemcost_details : itemcost_details,
        costrate : costrate,
        costtax_group : costtax_group,
        costtax_amount : costtax_amount,
        costtax_notes : costtax_notes,
        costsupplier : costsupplier,
        bill_entry_date: $('#bill_entry_date').val(),
        purchaser: $('#purchaser').val(),
        purchasebillid : $('#purchasebillid').val(),
        totalcost_amount : $('#totalcost_amount').val(),
        
   
        },
        success: function(data) {
       
        
             $('#pi_update_edit').removeClass('kt-spinner');
             $('#pi_update_edit').prop("disabled", false);
          
              window.location.href = "PurchaseList";
             toastr.success('Purchase Invoice  '+sucess_msg+' successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});




$(document).on('click', '#enquiry_rfq_update_value', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        rfqdate     = $('#rfqdate').val();
        validity      = $('#validity').val();
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


     /*   if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Supplier/Vendor!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }*/

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
        url: "enquiryrfqvalueupdate",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        // provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
       
        
             $('#enquiry_rfq_update_value').removeClass('kt-spinner');
             $('#enquiry_rfq_update_value').prop("disabled", false);
             //location.reload();
             window.history.back();
             history.back();
             // window.location.href = "rfqlisting";
             toastr.success('New Enquiry RFQ Value '+sucess_msg+' successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});


var rfqsubmitted_details_table = $('#rfqsubmitted_details').DataTable({
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
          "url": 'rfqsubmittedlisting',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
     /*     {
              data: 'id',
              name: 'id',
              render: function(data, type, row) {
                  return '#' + row.id + '&nbsp;&nbsp;';
              }
          },*/
          {
              data: 'enquiry_id',
              name: 'enquiry_id',
              render: function(data, type, row) {
                  return '#' + row.enquiry_id + '&nbsp;&nbsp;';
              }
          },
        { data: 'edate', name: 'edate' },
           { data: 'totalCount', name: 'totalCount' },
          /* { data: 'quotedate', name: 'quotedate' },*/

        /*  { data: 'validity', name: 'validity' },*/
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
           { data: 'cust_name', name: 'cust_name' },
         
           { data: 'sup_name', name: 'sup_name' },
         
          
          { data: 'name', name: 'name' },
           { data: 'grandtotalamount', name: 'grandtotalamount' },


 {
              data: 'po_status',
              name: 'po_status',
              render: function(data, type, row) {
                if(row.po_status==2){
                  return '<span style="color: blue">Generated</span>';
                }else{
                    return '<span style="color: red">Not Generated</span>';
                }
              }
          },

           { data: 'updated_at', name: 'updated_at' },
          
         
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                var j='<a href="rfq_pdf1?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Commercial PO PDF</span>\
                        </span></li></a><a href="rfq_pdf?id=' + row.id + '" data-type="edit" data-target="#kt_form" target="_blank"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-file-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" > Technical PO PDF</span>\
                        </span></li></a>';
                
               
          
                  if (row.po_status != 2) {
                     j+='<a href="rfq_convert_po?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Generate PO</span>\
                        </span></li></a>';
                    }else{
                        j+='<a href="rfq_edit?id=' + row.id + '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-reload-1"></i>\
                        <span class="kt-nav__link-text" data-id="' + row.id + '" >Edit</span>\
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






$(document).on('click', '#enquiry_rfq_convert_po', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        rfqdate     = $('#rfqdate').val();
        validity      = $('#validity').val();
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
            toastr.warning("Please Add Supplier/Vendor!");
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
                   toastr.warning("Please Add Any Product!");
                      return false;
            }


     $(this).addClass('kt-spinner');
     $(this).prop("disabled", true);
     if($('#id').val()){
        var sucess_msg ='Approved';
     } else{
        var sucess_msg ='Approved';
     }
    
 
    $.ajax({
        type: "POST",
        url: "enquiryrfq_convert_po",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        // provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
       
        
             $('#enquiry_rfq_convert_po').removeClass('kt-spinner');
             $('#enquiry_rfq_convert_po').prop("disabled", false);
         
              window.location.href = "purchase_delivery";
             toastr.success('New Enquiry RFQ '+sucess_msg+' successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});


///



$(document).on('click', '#enquiry_po_update_edit', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        rfqdate     = $('#rfqdate').val();
        validity      = $('#validity').val();
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


     /*   if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Supplier/Vendor!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }*/

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
     
       

                   var ttotal = 0;
            $.each(row_total,function() {
                ttotal += parseInt(this, 10);
            });


            if (productname.length > 0) {
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
        url: "enquirypoupdate",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        rfq_id      : $('#rfq_id').val(),
         enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        // provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
        internalreference      : $('#internalreference').val(),
        
   
        },
        success: function(data) {
       
        
             $('#enquiry_po_update_edit').removeClass('kt-spinner');
             $('#enquiry_po_update_edit').prop("disabled", false);
        
              window.location.href = "purchase_delivery";
             toastr.success('PO Updated successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});


///////////////



$(document).on('click', '#enquiry_po_update_issue', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        rfqdate     = $('#rfqdate').val();
        validity      = $('#validity').val();
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


     /*   if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Supplier/Vendor!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }*/

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


            if (productname.length > 0) {
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
        url: "enquirypoupdateissue",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        rfq_id      : $('#rfq_id').val(),
         enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        // provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
        internalreference      : $('#internalreference').val(),
        
   
        },
        success: function(data) {
       
        
             $('#enquiry_po_update_issue').removeClass('kt-spinner');
             $('#enquiry_po_update_issue').prop("disabled", false);
       
              window.location.href = "purchase_delivery";
             toastr.success('PO Updated successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});




$(document).on('click', '.rfqquote', function() {
        var id = $(this).attr('id');
        swal.fire({
            title: "Are you sure?",
            text: "Do you want Generate Quotation for this RFQ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then(result => {
            if (result.value) {
window.location = "rfqquote?id="+id;
               
             } else {

                swal.fire("Cancelled", "", "error");
            }
        })
    });


$(document).on('click', '#enquiry_po_vo_update', function(e) {
    e.preventDefault();

        customer      = $('#customer').val();
        reference     = $('#reference').val();
        attention     = $('#attention').val();
        salesman      = $('#salesman').val();
        rfqdate     = $('#rfqdate').val();
        validity      = $('#validity').val();
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


     /*   if (cust_name == "") {
            $('#cust_name').addClass('is-invalid');
            toastr.warning("Please Add Supplier/Vendor!");
            return false;
        } else {
             $('#cust_name').removeClass('is-invalid');
         }*/

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


            if (productname.length > 0) {
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
        url: "enquirypovoupdate",
        dataType: "text",
        data: {
            _token: $('#token').val(),
        id            : $('#id').val(),
        rfq_id      : $('#rfq_id').val(),
         enquiryrfqid      : $('#enquiryrfqid').val(),
        enquiryid : $('#enquiryid').val(),
        // provider      : $('input[name="vendor_supplier"]:checked').val(),
        name          : $('#suppliernames').val(),
        customer      : $('#customer').val(),
        reference     : $('#reference').val(),
        attention     : $('#attention').val(),
        salesman      : $('#salesman').val(),
        rfqdate     : $('#rfqdate').val(),
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
        internalreference      : $('#internalreference').val(),
        
   
        },
        success: function(data) {
       
        
             $('#enquiry_po_vo_update').removeClass('kt-spinner');
             $('#enquiry_po_vo_update').prop("disabled", false);

              window.location.href = "purchase_delivery";
             toastr.success('PO Updated successfuly');

            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });
});
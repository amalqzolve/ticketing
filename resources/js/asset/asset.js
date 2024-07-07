/**
  *Asset details submission
  */
$(document).on('click', '#product_submit', function(e) {
    e.preventDefault();

    asset_name = $('#asset_name').val();

     asset_type = $('#asset_type').val();
     consumable = $('#consumable').val();
     inv_type = $('#inv_type').val();
     asset_code = $('#asset_code').val();
     barcode = $('#barcode').val();
     quantity = $('#quantity').val();
     varianttag = $('#varianttag').val();


       if (asset_name=="") 
       {
       $('#asset_name').addClass('is-invalid');
        toastr.warning('Asset Name is required.');
       return false;
       } 
       else
       {
          $('#asset_name').removeClass('is-invalid');
       } 
       


 if (quantity=="") 
       {
       $('#quantity').addClass('is-invalid');
        toastr.warning('Quantity is required.');
       return false;
       } 
       else
       {
          $('#quantity').removeClass('is-invalid');
       } 
       
       



    var part_name = [];

    $("select[name^='part_name[]']")
        .each(function(input) {
            part_name.push($(this).val());
        });


    var part_date = [];

    $("input[name^='part_date[]']")
        .each(function(input) {
            part_date.push($(this).val());
        });

        var reminderdaysparts = [];

    $("input[name^='reminderdaysparts[]']")
        .each(function(input) {
            reminderdaysparts.push($(this).val());
        });



 
    var component_name = [];

    $("select[name^='component[]']")
        .each(function(input) {
            component_name.push($(this).val());
        });

    var component_date = [];

    $("input[name^='component_date[]']")
        .each(function(input) {
            component_date.push($(this).val());
        });
var reminderdayscomponenet = [];

    $("input[name^='reminderdayscomponenet[]']")
        .each(function(input) {
            reminderdayscomponenet.push($(this).val());
        });


 
    var service_name = [];

    $("input[name^='service_name[]']")
        .each(function(input) {
            service_name.push($(this).val());
        });

    var service_date = [];

    $("input[name^='service_date[]']")
        .each(function(input) {
            service_date.push($(this).val());
        });
var reminderdaysservice = [];

    $("input[name^='reminderdaysservice[]']")
        .each(function(input) {
            reminderdaysservice.push($(this).val());
        });

        var option = [];

    $("input[name^='option[]']")
        .each(function(input) {
            option.push($(this).val());
        });
        var variantproductcode = [];

    $("input[name^='variantproductcode[]']")
        .each(function(input) {
            variantproductcode.push($(this).val());
        });
        var variantbarcode = [];

    $("input[name^='variantbarcode[]']")
        .each(function(input) {
            variantbarcode.push($(this).val());
        });
   


 var varianttag = [];

    $("input[name^='varianttag[]']")
        .each(function(input) {
            varianttag.push($(this).val());
        });
        

        $('#product_submit').addClass('kt-spinner');
        $(this).prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      


    $.ajax({
        type: "POST",
        url: "asset_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            asset_name: $('#asset_name').val(),
            asset_type: $('#asset_type').val(),
            consumable: $('#consumable').val(),
            inv_type: $('#inv_type').val(),
            // asset_code: $('#asset_code').val(),
            // barcode: $('#barcode').val(),
            fileData:$('#fileData').val(),
            group: $('#group').val(),
            category: $('#category').val(),
            warehouse: $('#warehouse').val(),
            type: $('#type').val(),
            store: $('#store').val(),
            rack: $('#rack').val(),
            unit:$('#unit').val(),
            manufaturer: $('#manufaturer').val(),
            supplier: $('#supplier').val(),
            brand:$('#brand').val(),
            quantity:$('#quantity').val(),
            barcodeformat:$('#barcodeformat').val(),
            slno: $('#slno').val(),
            modelno: $('#modelno').val(),
            partno:$('#partno').val(),
            hsncode: $('#hsncode').val(),
            upc: $('#upc').val(),
            ean:$('#ean').val(),
            jan:$('#jan').val(),
            isbn:$('#isbn').val(),
            mpn:$('#mpn').val(),
            part_name : part_name,
            part_date: part_date,
            reminderdaysparts :reminderdaysparts,
            component_name : component_name,
            component_date : component_date,
            reminderdayscomponenet : reminderdayscomponenet,
            service_name : service_name,
            service_date : service_date,
            reminderdaysservice : reminderdaysservice,
            option : option,
            variantproductcode : variantproductcode,
            variantbarcode : variantbarcode,
            varianttag:varianttag,
            asset_cost:$('#asset_cost').val(),
            purchase_date:$('#purchase_date').val(),
            inbound_date:$('#inbound_date').val(),
            


        },
        success: function(data) {
          if(data == 'false')
          {
            $('#product_submit').removeClass('kt-spinner');
            $('#product_submit').prop("disabled", false);
            toastr.warning('Asset namme already exist');
          }
            // uppy.reset();
            else
            {
            $('#product_submit').removeClass('kt-spinner');
            $('#product_submit').prop("disabled", false);
            toastr.success('Asset details ' + sucess_msg + ' successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
               const channel = new BroadcastChannel("inventory");
               channel.postMessage("success");

            location.reload();
            window.location.href = "asset_list";
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


$('.ktdatepicker').datepicker({
     todayHighlight: true,

    format: 'dd-mm-yyyy'
}).on('changeDate', function(e) {
    $(this).datepicker('hide');
});







$(document).on('click', '#allocation_submit', function(e) {
    e.preventDefault();

    allocation_date = $('#allocation_date').val();
    asset_id = $('#asset_id').val();
     return_date = $('#return_date').val();
     borrower = $('#borrower').val();
     reason = $('#reason').val();
     project = $('#project').val();
     geo_location = $('#geo_location').val();
     available_quantity = $('#available_quantity').val();
     allocation_quantity = $('#allocation_quantity').val();
     area = $('#area').val();
     notes = $('#notes').val();
     borrowertype = $('#borrowertype').val();
      allocatedby = $('#allocatedby').val();

 if (asset_id=="") 
       {
       $('#asset_id').addClass('is-invalid');
        toastr.warning('Asset is required.');
       return false;
       } 
       else
       {
          $('#asset_id').removeClass('is-invalid');
       } 


       if (allocation_date=="") 
       {
       $('#allocation_date').addClass('is-invalid');
        toastr.warning('Allocation Date is required.');
       return false;
       } 
       else
       {
          $('#allocation_date').removeClass('is-invalid');
       } 
       

          if (borrowertype=="") 
       {
       $('#borrowertype').addClass('is-invalid');
        toastr.warning('Borrower type is required.');
       return false;
       } 
       else
       {
          $('#borrowertype').removeClass('is-invalid');
       } 

       

            if (allocatedby=="") 
       {
       $('#allocatedby').addClass('is-invalid');
        toastr.warning('Allocated by is required.');
       return false;
       } 
       else
       {
          $('#allocatedby').removeClass('is-invalid');
       } 

       //     if (allocation_quantity=="") 
       // {
       // $('#allocation_quantity').addClass('is-invalid');
       //  toastr.warning('Allocation Date is required.');
       // return false;
       // } 
       // else
       // {
       //    $('#allocation_quantity').removeClass('is-invalid');
       // } 
       
       
       
      if ($('#borrower').val()==""&&$('#borrowername').val()=="") 
       {
       $('#borrowername').addClass('is-invalid');
       $('#borrower').addClass('is-invalid');
        toastr.warning('Borrower  is required.');
       return false;
       } 
       else
       {
           $('#borrowername').removeClass('is-invalid');
       $('#borrower').removeClass('is-invalid');
       } 

        

        $('#allocation_submit').addClass('kt-spinner');
        $(this).prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      


    $.ajax({
        type: "POST",
        url: "asset_allocation_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            asset_id: $('#asset_id').val(),
            allocation_date: $('#allocation_date').val(),
            return_date: $('#return_date').val(),
            borrowertype :$('#borrowertype').val(),
            borrowername : $('#borrowername').val(),
            borrower: $('#borrower').val(),
            reason: $('#reason').val(),
            project: $('#project').val(),
            geo_location: $('#geo_location').val(),
            // available_quantity:$('#available_quantity').val(),
            // allocation_quantity : $('#allocation_quantity').val(),
            area: $('#area').val(),
            notes : $('#notes').val(),
            allocatedby : $('#allocatedby').val(),

        },
        success: function(data) {
          if(data == 'false')
          {
            $('#allocation_submit').removeClass('kt-spinner');
            $('#allocation_submit').prop("disabled", false);
            toastr.warning('Asset name already exist');
          }
            // uppy.reset();
            else
            {
            $('#allocation_submit').removeClass('kt-spinner');
            $('#allocation_submit').prop("disabled", false);
            toastr.success('Asset Allocation ' + sucess_msg + ' successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
               const channel = new BroadcastChannel("inventory");
               channel.postMessage("success");

            location.reload();
            window.location.href = "allocation_list";
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






$(document).on('click', '#revoke_submit', function(e) {
    e.preventDefault();

    allocation_date = $('#allocation_date').val();
    asset_id = $('#asset_id').val();
     return_date = $('#return_date').val();
     borrower = $('#borrower').val();
     reason = $('#reason').val();
     project = $('#project').val();
     geo_location = $('#geo_location').val();
     available_quantity = $('#available_quantity').val();
     revoke_quantity = $('#revoke_quantity').val();
     area = $('#area').val();
     notes = $('#notes').val();

 if (asset_id=="") 
       {
       $('#asset_id').addClass('is-invalid');
        toastr.warning('Asset  is required.');
       return false;
       } 
       else
       {
          $('#asset_id').removeClass('is-invalid');
       } 


       if (allocation_date=="") 
       {
       $('#allocation_date').addClass('is-invalid');
        toastr.warning('Allocation Date is required.');
       return false;
       } 
       else
       {
          $('#allocation_date').removeClass('is-invalid');
       } 
       
           if (revoke_quantity=="") 
       {
       $('#revoke_quantity').addClass('is-invalid');
        toastr.warning('Allocation Date is required.');
       return false;
       } 
       else
       {
          $('#revoke_quantity').removeClass('is-invalid');
       } 
       
       


        

        $('#revoke_submit').addClass('kt-spinner');
        $(this).prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      


    $.ajax({
        type: "POST",
        url: "asset_revoke_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            asset_id: $('#asset_id').val(),
            allocation_date: $('#allocation_date').val(),
            return_date: $('#return_date').val(),
            borrower: $('#borrower').val(),
            reason: $('#reason').val(),
            project: $('#project').val(),
            geo_location: $('#geo_location').val(),
            available_quantity:$('#available_quantity').val(),
            revoke_quantity : $('#revoke_quantity').val(),
            area: $('#area').val(),
            notes : $('#notes').val(),
            allocationid : $('#allocationid').val(),
            

        },
        success: function(data) {
          if(data == 'false')
          {
            $('#revoke_submit').removeClass('kt-spinner');
            $('#revoke_submit').prop("disabled", false);
            toastr.warning('Asset namme already exist');
          }
            // uppy.reset();
            else
            {
            $('#revoke_submit').removeClass('kt-spinner');
            $('#revoke_submit').prop("disabled", false);
            toastr.success('Asset Revoke ' + sucess_msg + ' successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
               const channel = new BroadcastChannel("inventory");
               channel.postMessage("success");

            location.reload();
            window.location.href = "revoke_list";
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







$(document).on('click', '#asset_status_submit', function(e) {
    e.preventDefault();

    asset_id = $('#asset_id').val();
     asset_status = $('#asset_status').val();
     availability_status = $('#availability_status').val();


 /*if (asset_id=="") 
       {
       $('#asset_id').addClass('is-invalid');
        toastr.warning('Asset is required.');
       return false;
       } 
       else
       {
          $('#asset_id').removeClass('is-invalid');
       } */

    if (asset_id == "") {
            $('#asset_id').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Asset!");
                      return false;
        } else {
            $('#asset_id').next().find('.select2-selection').removeClass('select-dropdown-error');
        }





        if (asset_status == "") {
            $('#asset_status').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any Asset status!");
                      return false;
        } else {
            $('#asset_status').next().find('.select2-selection').removeClass('select-dropdown-error');
        }



       

               if (availability_status == "") {
            $('#availability_status').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Add Any availability status!");
                      return false;
        } else {
            $('#availability_status').next().find('.select2-selection').removeClass('select-dropdown-error');
        }



        

        $('#revoke_submit').addClass('kt-spinner');
        $(this).prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      


    $.ajax({
        type: "POST",
        url: "asset_status_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#id').val(),
            asset_id: $('#asset_id').val(),
            asset_status: $('#asset_status').val(),
            availability_status: $('#availability_status').val(),
            notes : $('#notes').val(),

        },
        success: function(data) {
          if(data == 'false')
          {
            $('#asset_status_submit').removeClass('kt-spinner');
            $('#asset_status_submit').prop("disabled", false);
            toastr.warning('Asset namme already exist');
          }
            // uppy.reset();
            else
            {
            $('#asset_status_submit').removeClass('kt-spinner');
            $('#asset_status_submit').prop("disabled", false);
            toastr.success('Asset Status Updated successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
               const channel = new BroadcastChannel("inventory");
               channel.postMessage("success");

            location.reload();
            window.location.href = "OM";
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


$(document).on('click', '#asset_update', function(e) {
    e.preventDefault();

    asset_name = $('#asset_name').val();

     asset_type = $('#asset_type').val();
     consumable = $('#consumable').val();
     inv_type = $('#inv_type').val();
     asset_code = $('#asset_code').val();
     barcode = $('#barcode').val();


       if (asset_name=="") 
       {
       $('#asset_name').addClass('is-invalid');
        toastr.warning('Asset Name is required.');
       return false;
       } 
       else
       {
          $('#asset_name').removeClass('is-invalid');
       } 
       

       


var part_id = [];

    $("input[name^='part_id[]']")
        .each(function(input) {
            part_id.push($(this).val());
        });
    var part_name = [];

    $("select[name^='part_name[]']")
        .each(function(input) {
            part_name.push($(this).val());
        });


    var part_date = [];

    $("input[name^='part_date[]']")
        .each(function(input) {
            part_date.push($(this).val());
        });

        var reminderdaysparts = [];

    $("input[name^='reminderdaysparts[]']")
        .each(function(input) {
            reminderdaysparts.push($(this).val());
        });



 var components_id = [];

    $("input[name^='components_id[]']")
        .each(function(input) {
            components_id.push($(this).val());
        });
    var component_name = [];

    $("select[name^='component[]']")
        .each(function(input) {
            component_name.push($(this).val());
        });

    var component_date = [];

    $("input[name^='component_date[]']")
        .each(function(input) {
            component_date.push($(this).val());
        });
var reminderdayscomponenet = [];

    $("input[name^='reminderdayscomponenet[]']")
        .each(function(input) {
            reminderdayscomponenet.push($(this).val());
        });


 var service_id = [];

    $("input[name^='service_id[]']")
        .each(function(input) {
            service_id.push($(this).val());
        });
    var service_name = [];

    $("input[name^='service_name[]']")
        .each(function(input) {
            service_name.push($(this).val());
        });

    var service_date = [];

    $("input[name^='service_date[]']")
        .each(function(input) {
            service_date.push($(this).val());
        });
var reminderdaysservice = [];

    $("input[name^='reminderdaysservice[]']")
        .each(function(input) {
            reminderdaysservice.push($(this).val());
        });

        var option = [];

    $("input[name^='option[]']")
        .each(function(input) {
            option.push($(this).val());
        });
        var variantproductcode = [];

    $("input[name^='variantproductcode[]']")
        .each(function(input) {
            variantproductcode.push($(this).val());
        });
        var variantbarcode = [];

    $("input[name^='variantbarcode[]']")
        .each(function(input) {
            variantbarcode.push($(this).val());
        });
   

        

        $('#asset_update').addClass('kt-spinner');
        $(this).prop("disabled", true);
         if ($('#id').val()) {
        var sucess_msg = 'Updated';
         } else {
        var sucess_msg = 'Created';
         }
      


    $.ajax({
        type: "POST",
        url: "asset_update",
        dataType: "json",
        data: {
            _token: $('#token').val(),
            id: $('#asset_id').val(),
            asset_name: $('#asset_name').val(),
            asset_type: $('#asset_type').val(),
            consumable: $('#consumable').val(),
            inv_type: $('#inv_type').val(),
            // asset_code: $('#asset_code').val(),
            // barcode: $('#barcode').val(),
            fileData:$('#fileData').val(),
            group: $('#group').val(),
            category: $('#category').val(),
            warehouse: $('#warehouse').val(),
            type: $('#type').val(),
            store: $('#store').val(),
            rack: $('#rack').val(),
            unit:$('#unit').val(),
            manufaturer: $('#manufaturer').val(),
            supplier: $('#supplier').val(),
            brand:$('#brand').val(),
            quantity:$('#quantity').val(),
            barcodeformat:$('#barcodeformat').val(),
            slno: $('#slno').val(),
            modelno: $('#modelno').val(),
            partno:$('#partno').val(),
            hsncode: $('#hsncode').val(),
            upc: $('#upc').val(),
            ean:$('#ean').val(),
            jan:$('#jan').val(),
            isbn:$('#isbn').val(),
            mpn:$('#mpn').val(),
            part_name : part_name,
            part_date: part_date,
            reminderdaysparts :reminderdaysparts,
            component_name : component_name,
            component_date : component_date,
            reminderdayscomponenet : reminderdayscomponenet,
            service_name : service_name,
            service_date : service_date,
            reminderdaysservice : reminderdaysservice,
            option : option,
            variantproductcode : variantproductcode,
            variantbarcode : variantbarcode,
            part_id : part_id,  
            components_id : components_id, 
            service_id : service_id,
        },
        success: function(data) {
          if(data == 'false')
          {
            $('#asset_update').removeClass('kt-spinner');
            $('#asset_update').prop("disabled", false);
            toastr.warning('Asset namme already exist');
          }
            // uppy.reset();
            else
            {
            $('#asset_update').removeClass('kt-spinner');
            $('#asset_update').prop("disabled", false);
            toastr.success('Asset details ' + sucess_msg + ' successfuly');

            // swal.fire("Done", "Submission Sucessfully", "success");
               const channel = new BroadcastChannel("inventory");
               channel.postMessage("success");

            location.reload();
            window.location.href = "asset_list";
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

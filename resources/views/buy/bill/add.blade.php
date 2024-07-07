@extends('qpurchase.common.layout') @section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	li.nav-item {
		width: 140px;
}
</style>


<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
		</div>
	   
	</div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Bill Settlement
				</h3>
			</div>

		</div> 

		<div class="kt-portlet__body">

			
							
								 <div class="row" style="padding-bottom: 6px;">
									
								   
								   


									<div class="col-lg-12">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Supplier<span style="color: red">*</span> </label>
									</div>  
									<div class="col-md-8 input-group input-group-sm">
								  <select class="form-control single-select kt-selectpicker customer" id="Supplier_select"  name="Supplier_select">
                                    <option value="">select</option>
         @foreach($suppliers as $data)
            <option value="{{$data->id}}">{{$data->sup_name}}</option>
            @endforeach
                                 </select>   
									
									</div>
									</div>
									</div>


					


									

								 </div>
						
<div id="results" style="display: none;">
						<table class="table table-striped table-hover table-checkable dataTable no-footer" >
    <thead>
        <tr>
        
            <th>#</th>
            <th>Bill ID</th>
            <th>Bill Date </th>
            <th>Bill Entry Date </th>
           <th>Purchaser</th>
            <th>Total amount</th>
             <th>Paid amount</th>
              <th>Due amount</th>
        </tr>
    </thead>
    <tbody id="maindetails_list">
    </tbody>
</table>

						

<hr style="width:100%;text-align:left;margin-left:0">
						<div class="row" style="padding-bottom: 6px; margin-top: 44px;">


									  <div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Due Amount </label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="dueamount" id="dueamount" value="" readonly="">                 
										</div>
										</div>
									  </div>


									  <div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Paid Amount </label>
										</div> 
										<div class="col-md-8  input-group-sm">
									<input type="text" class="form-control" name="paidamount" id="paidamount" value="" >                 
										</div>
										</div>
									  </div>


									
									  

									   
									  <div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Transaction Date')</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control kt_datetimepickerr" name="transactiondate" id="transactiondate" value="{{date('d-m-Y')}}">               
										</div>
										</div>
										</div>

										<div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>Deposit Account </label>
										</div> 
										<div class="col-md-8  input-group-sm">
								<!-- 	<input type="text" class="form-control" name="depositaccount" id="depositaccount" value="" > -->    
								 <select class="form-control single-select kt-selectpicker depositaccount" id="depositaccount"  name="depositaccount">
                                    <option value="">select</option>
         @foreach($accounts as $data)
            <option value="{{$data->id}}">{{$data->name}}</option>
            @endforeach
                                 </select> 

										</div>
										</div>
									  </div>

										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Notes</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control" name="notes" id="notes" value="" >               
										</div>
										</div>
										</div>

										<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Reference</label>
										</div>  
										<div class="col-md-8 input-group-sm">
									   
								<input type="text" class="form-control" name="reference" id="reference" value="" >               
										</div>
										</div>
										</div>


										
										
									</div>

										<div class="row" style="padding-bottom: 6px; margin-top: 44px;">
									<div class="col-lg-12">
									<div class="form-group row pl-md-3">
										<table class="table table-striped table-hover" >
											<thead  style=" background-color: #306584; color: white;">
											<tr>
											<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important; width: 30px;">#</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Mode of Payment')</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Reference')</th>
												<th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;">@lang('app.Amount')</th>
												
												 <th class="text-center" style="background-color:  #3f4aa0;     color: white; white-space: nowrap;     padding: 2px 7px !important;
												 width: 30px;">
													<!-- <div class="kt-demo-icon__preview addmorepayments pluseb">
															<i class="fa fa-plus" style="color: white;"></i>
														</div> --></th>
											</tr>
											</thead>
											<tbody id="modeofpaymenttable"></tbody>
										</table>
					<table style="width:100%;">
						<tr>
							<td>
								<button type="button" class="addmorepayments pluseb btn btn-brand btn-elevate btn-icon-sm  float-right" ><i class="la la-plus"></i>Add More</button>
							</td>
						</tr>
					</table>


					<hr style="width:100%;text-align:left;margin-left:0;padding-bottom: 6px; margin-top: 44px;">
						

					<div class="row col-lg-12">

					<div class="col-lg-6"></div>
					<div class="col-lg-6">
										<div class="form-group  row pr-md-3">
										<div class="col-md-4">
										<label>Total </label>
										</div>  
										<div class="col-md-8 input-group-sm">
								<input type="text" class="form-control" name="addtotal" id="addtotal" value="" readonly="">               
										</div>
										</div>
										</div>
								
							<!--submit -->
									</div>


											 

			
								</div>
								<div class="kt-portlet__foot pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" name="bill_settlement_submit" id="bill_settlement_submit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Save </button>
															<button type="button" class="btn btn-secondary float-right mr-2"  onclick="goPrev()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel</button>
														</div>
													</div>
												</div>
									
						</div>
							</div>
						</div>
</div>

					</div>
				</div>





		</div>
	</div>
</div>
<style type="text/css">
	.hideButton {
		display: none
	}
	
	.error {
		color: red
	}
</style>
<!--end::Modal-->
@endsection @section('script')
<script type="text/javascript">
   function goPrev()
	{
  window.history.back();
  }




</script>

</script>
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>


<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>

<script type="text/javascript">
	

	//
	//$("#bill_settlement_submit").live('change', function(){

	$(document.body).on('change',"#Supplier_select",function (e) {
	//$('body').on('change', '#bill_settlement_submit', function() {
//	$(document).on('click', '#bill_settlement_submit', function(e) {
				e.preventDefault();
			

			
				var Supplier_select=$('#Supplier_select').val();
				

    if (Supplier_select == "") {
            $('#Supplier_select').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Supplier is required.");
                      return false;
        } else {
            $('#Supplier_select').next().find('.select2-selection').removeClass('select-dropdown-error');
        }



				/*$(this).addClass('kt-spinner');
				$(this).prop("disabled", true);*/
				if($('#id').val()){
				var sucess_msg ='Updated';
				} else{
				var sucess_msg ='Created';
				}

				$.ajax({
						type: "POST",
						url: "submit_buy_supplier",
						dataType: "json",
						data: {
								_token: $('#token').val(),
								id: $('#id').val(),
								Supplier_select: $('#Supplier_select').val(),
							},
						success: function(data) {


							$("#maindetails_list").empty();
							$("#modeofpaymenttable").empty();
							$("#dueamount").val('');
							$("#paidamount").val('');
							$("#depositaccount").val('');
							$("#notes").val('');
							$("#reference").val('');
							$("#addtotal").val('');
							
				$("#results").show("slow");
						
						$.each(data, function (key, value) 
  					{
     $('#maindetails_list').append('<tr> <td><input type="checkbox" class="vcheck" id="' + value.vid + '" value="' + value.balanceamount + '" /></td> <td>' + value.bill_id + '</td>  <td>' + value.quotedate + '</td> <td>' + value.entrydate + '</td> <td>' + value.purchaser + '</td> <td>' + value.grandtotalamount + '</td> <td>' + value.paidamount + '</td> <td>' + value.balanceamount + '</td></tr>');
  });


							console.log(data);	
					
						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});

	

	$(document).ready(function(){
	  var rowcount = ($("#modeofpaymenttable > tbody > tr").length);
	    var sl = ($("#modeofpaymenttable > tbody > tr").length)+1;
	$(".addmorepayments").click(function() 
		{
		
	  

		   
			var payment = '';
			payment += '<tr>\
					  <td class="row_count" id="rowcount" style="padding: 0;">'+ sl +'</td>\
					  <td style="padding: 0;">\
					  <select class="form-control single-select modeofpayment kt-selectpicker" name="modeofpayment[]" id="modeofpayment'+rowcount+'" data-id='+rowcount+'>\
					 <option value="">Select</option>\
					  <option value="1" selected>Cash</option>\
					   <option value="2">Card</option>\
					    <option value="3">Bank</option>\
					     <option value="4">Cheque</option>\
					  </select>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control preference" name="preference[]" id="preference'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\
					  <td style="padding: 0;">\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control amount" name="amount[]" id="amount'+rowcount+'"  data-id='+rowcount+'>\
					  </div>\
					  </td>\
						<td style="padding: 0;">\
					  <div class="kt-demo-icon__preview costremove">\
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>\
					  </div>\
					  </td>\
					  </tr>';
		
					   $('#modeofpaymenttable').append(payment);

					  


					     sl++;
					   rowcount++;
});

   
 });


	 $('.kt_datetimepickerr').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy'
    }).on('changeDate', function(e) {
    $(this).datepicker('hide');
});


$("body").on("click",".costremove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');
   
  
	   var siblings = row.siblings();
	   row.remove();
	   siblings.each(function(index) {
		 $(this).children().first().text(index);
	   });
  
  amount_calculate();
});


$(document).on('click', '.vcheck', function () {

var voucher_id={};
voucher_id.checkselected=[];
voucher_id.checkselectedvalues=[];


$("input:checkbox").each(function(){
    var $this = $(this);

    if($this.is(":checked")){
    	
        voucher_id.checkselected.push($this.attr("id"));
        voucher_id.checkselectedvalues.push($this.val());
    }else{
        //
    }
})

//
var totaldue = 0;
for (var i = 0; i < voucher_id.checkselectedvalues.length; i++) {
    totaldue += voucher_id.checkselectedvalues[i] << 0;
}
//

$('#dueamount').val(totaldue);

});

//
/*var hour_val = $('#hourField').val();
if(hour_val > 12)
{
    alert('Number should be less than 12');
    return false;  
}*/
//
$(document).on("input", "#paidamount", function () {
/*$('body').on('change', '#paidamount', function() {*/

	 var ppaidamount = $('#paidamount').val();
	 var pdueamount =$('#dueamount').val();
	
	 if(parseInt(ppaidamount) > parseInt(pdueamount))
{
    toastr.warning('Paid Amount must less than due amount!!!');
    $('#paidamount').val('')  
}
	});


$('body').on('change', '.amount', function() {
	 var id = $(this).attr('data-id');
	 amount_calculate(id);
	});


function amount_calculate(){
 var totalamount = 0;
 var balance = 0;
 var total = 0;
 var totaldueamount = 0;
	$('.amount').each(function(){
		var id = $(this).attr('data-id');
		var amount = $('#amount'+id+'').val();
	totalamount += parseFloat(amount);
   });
	$('#addtotal').val(totalamount);


	var total = $('#paidamount').val();
	if(total < totalamount)
	{
		toastr.warning('Amount is less than or Equal to Paid Amount');
	
	}
	else
	{
		/*totaldueamount = $('#totaldueamount').val();
		balance = parseFloat(totaldueamount) - parseFloat(totalamount);
		$('#payingamount').val(totalamount.toFixed(2));
		$('#creditinvoice_pay').attr('disabled',false);
		$('#balanceamount').val(balance.toFixed(2));*/
	}
}




$(document).on('click', '#bill_settlement_submit', function(e) {




        Supplier_select      = $('#Supplier_select').val();
        dueamount      = $('#dueamount').val();
		depositaccount      = $('#depositaccount').val();

 
      
          if (Supplier_select == "") {
            $('#Supplier_select').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Supplier!");
                      return false;
        } else {
            $('#Supplier_select').next().find('.select2-selection').removeClass('select-dropdown-error');
        }


         if (dueamount == "") {
            $('#dueamount').addClass('is-invalid');
            toastr.warning("Please Add Due amount!");
            return false;
        } else {
             $('#dueamount').removeClass('is-invalid');
         }

           if (depositaccount == "") {
            $('#depositaccount').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Please Select Deposit account!");
                      return false;
        } else {
            $('#depositaccount').next().find('.select2-selection').removeClass('select-dropdown-error');
        }




         var modeofpayment = [];

        $("select[name^='modeofpayment[]']")
        .each(function(input) {
            modeofpayment.push($(this).val());
        });


        var preference = [];

        $("input[name^='preference[]']")
        .each(function(input) {
            preference.push($(this).val());
        });

        var amount = [];

        $("input[name^='amount[]']")
        .each(function(input) {
            amount.push($(this).val());
        });


        var voucher_id={};
voucher_id.checkselected=[];


$("input:checkbox").each(function(){
    var $this = $(this);

    if($this.is(":checked")){
    	
        voucher_id.checkselected.push($this.attr("id"));
        
    }else{
        //
    }
})
if (voucher_id.checkselected.length === 0) {
    toastr.warning("Please Select Voucher!");
                      return false;
}





  $.ajax({
        type: "POST",
        url: "buy_bill_settle_submit",
        dataType: "json",
        data: {
            _token: $('#token').val(),

        Supplier_select      : $('#Supplier_select').val(),
        dueamount      : $('#dueamount').val(),
        paidamount      : $('#paidamount').val(),
        depositaccount      : $('#depositaccount').val(),
        notes      : $('#notes').val(),
        reference      : $('#reference').val(),
        addtotal      : $('#addtotal').val(),
        vouchers:voucher_id.checkselected,
        modeofpayment : modeofpayment,
        preference : preference,
        amount : amount,
        transactiondate      : $('#transactiondate').val(),
        
        },
        success: function(data) {
       
        
             $('#bill_settlement_submit').removeClass('kt-spinner');
             $('#bill_settlement_submit').prop("disabled", false);
             location.reload();
              window.location.href = "buy_bill_settlement";
             toastr.success('New bill settlement '+sucess_msg+' successfuly');
            

        },
        error: function(jqXhr, json, errorThrown) {
         
          console.log('Error !!');
        }
    });






	});


</script>
@endsection
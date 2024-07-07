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
					Account Head
				</h3>
			</div>

		</div>

		<div class="kt-portlet__body">



								 <div class="row" style="padding-bottom: 6px;">





									<div class="col-lg-6">
									<div class="form-group row pr-md-3">
									<div class="col-md-4">
									<label>Account Head <span style="color: red">*</span> </label>
									</div>
									<div class="col-md-8 input-group input-group-sm">
								   <input type="text" class="form-control" name="head_name" id="head_name">

									</div>
									</div>
									</div>




									<div class="col-lg-6">
									<div class="form-group row pl-md-3">
									<div class="col-md-4">
									<label>Description </label>
									</div>
									<div class="col-md-8">
									<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="head_description" id="head_description" >
									</div>
									</div>
									</div>
									</div>



									     <div class="col-lg-6">
                              <div class="form-group  row pr-md-3">
                              <div class="col-md-4">
                              <label>Ledger Source<span style="color: red">*</span></label>
                              </div>

                              <div class="col-md-8 input-group-sm">

                                 <select class="form-control kt-selectpicker newledger" id="newledger">

            <option value="1">New </option>
          <option value="2">Existing</option>
                              </select>


                              <!-- </div> -->
                              </div>
                              </div>
                              </div>






							<div class="col-lg-6 new">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>@lang('customer.Parent Group')<span style="color: red">*</span></label>
									</div>
									<input type="hidden" class="form-control" id="branch" name="branch" autocomplete="off" value="{{$branch}}">
									<div class="col-md-8 input-group input-group-sm">
										<select class="form-control single-select" id="accounts_group" name="accounts_group">
											<option value="">{{ __('vendor.Select') }}</option>@foreach ($groups as $key)
											<option value="{{$key->id}}">{{$key->name}}</option>@endforeach</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6 new">
								<div class="form-group row pr-md-3">
									<div class="col-md-4">
										<label>@lang('customer.Ledger Code')<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<div class="input-group-prepend"></div>
											<input type="text" class="form-control" id="accounts_code" name="accounts_code" autocomplete="off" placeholder="Ledger Code">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 new">
								<div class="form-group row pl-md-3">
									<div class="col-md-4">
										<label>@lang('customer.Ledger Name')<span style="color: red">*</span></label>
									</div>
									<div class="col-md-8">
										<div class="input-group  input-group-sm">
											<div class="input-group-prepend"></div>
											<input type="text" class="form-control" id="accounts_ledger" name="accounts_ledger" autocomplete="off" placeholder="">
										</div>
									</div>
								</div>
							</div>






										<div class="col-lg-6" id="old_ledger" style="display: none">
										<div class="form-group row pl-md-3">
											<div class="col-md-4">
												<label>Ledger </label>
											</div>
											<div class="col-md-8">
												<div class="input-group input-group-sm">
													<select name="account_head_ledger" id="account_head_ledger" class="form-control single-select  kt-selectpicker account_head_ledger">
													  <option value="">{{ __('mainproducts.Select') }}</option>
													  @foreach($accounts as $data)
              <option value="{{$data->id}}">{{$data->name}}</option>
              @endforeach

													</select>
												</div>
											</div>
										</div>
									</div>




								 </div>
								 <div class="kt-portlet__foot pr-0">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
														</div>
														<div class="col-lg-6 kt-align-right">
															<button type="submit" name="account_head_submit" id="account_head_submit" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Save</button>
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

	$(document).on('click', '#account_head_submit', function(e) {
				e.preventDefault();


				var head_name = $('#head_name').val();
				var head_description = $('#head_description').val();
				var account_head_ledger = $('#account_head_ledger').val();
				var newledger=$('#newledger').val();
						if (head_name=="") {
         $('#head_name').addClass('is-invalid');
            toastr.warning('Head name is required.');
         return false;
         }
         else{
            $('#head_name').removeClass('is-invalid');
         }

         /*			if (account_head_ledger=="") {
         $('#account_head_ledger').addClass('is-invalid');
            toastr.warning('Account Ledger is required.');
         return false;
         }
         else{
            $('#account_head_ledger').removeClass('is-invalid');
         }*/


    if (newledger == "") {
            $('#newledger').next().find('.select2-selection').addClass('select-dropdown-error');
            toastr.warning("Account Type is required.");
                      return false;
        } else {
            $('#newledger').next().find('.select2-selection').removeClass('select-dropdown-error');
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
						url: "submit_account_head",
						dataType: "json",
						data: {
								_token: $('#token').val(),
								id: $('#id').val(),
								head_name: $('#head_name').val(),
								head_description: $('#head_description').val(),
								account_head_ledger: $('#account_head_ledger').val(),
				                newledger: $('#newledger').val(),
					            accounts_group: $('#accounts_group').val(),
						        accounts_code: $('#accounts_code').val(),
							    accounts_ledger: $('#accounts_ledger').val(),


						},
						success: function(data) {
							if(data == true)
							{
								$('#area_submit').removeClass('kt-spinner');
								$('#area_submit').prop("disabled", false);
							/*	location.reload();*/
								toastr.success('Buy Head '+sucess_msg+' Successfuly');
								  window.location.href = "buy_account_head";
							     // window.location.href = "http://localhost/trading/buy_account_head";
							}
							else
							{
								toastr.success('Account Head already exist');

							}


						},
						error: function(jqXhr, json, errorThrown) {
												console.log('Error !!');
						}
				});
		});

	$(document).ready(function(){
        $(document).on('change','.newledger',function()
        {

            var ledger = $(this).val();

            if(ledger == 1)
            {
               $('#account_head_ledger').val('').trigger('change');
               $('#old_ledger').hide();
               $('.new').show();

            }
            if(ledger == 2)
            {
               $('#ledger_name').attr('disabled',false);
                $('#old_ledger').show();
               $('.new').hide();



            }



        });
      });


	$(document.body).on("change", "#accounts_group", function() {
	var grp_id = this.value;

	$.ajax({
		url: "getgroup_details",
		method: "POST",
		data: {
			_token: $('#token').val(),
			grp_id: grp_id
		},
		dataType: "json",
		success: function(data) {
		//	if(typeof($('#accounts_code').val()) == "undefined" || $('#accounts_code').val() == null ||  $('#accounts_code').val() == '') {
				  $('#accounts_code').val(data);

				  $('#accounts_ledger').val($('#head_name').val());

			//	}




		}
	})


});


</script>
@endsection

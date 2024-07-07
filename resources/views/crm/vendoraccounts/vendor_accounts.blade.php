
@extends('crm.common.layout')
 @section('content')
 <link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet"
	type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
				<h3 class="kt-portlet__head-title">{{ __('vendor.Accounting Configuration') }}
										   
										</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="la la-download"></i>{{ __('vendor.Export') }}</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first"> <span class="kt-nav__section-text">{{ __('vendor.ChooseAnOption') }}</span>
									</li>
									<li class="kt-nav__item" id="vendordetails_list_print"> <span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">{{ __('vendor.Print') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="vendordetails_list_copy"> <span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">{{ __('vendor.Copy') }}</span>
										</span>
									</li>
									<li class="kt-nav__item" id="vendordetails_list_csv">
										<a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">@lang('app.CSV')</span>
										</a>
									</li>
									<li class="kt-nav__item" id="vendordetails_list_pdf"> <span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">@lang('app.PDF')</span>
										</span>
									</li>
								</ul>
							</div>
						</div>&nbsp;</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<table class="table table-striped  table-hover table-checkable"
			 id="vendordetails_list">
				<thead>
					<tr>
					  
						<th>{{ __('customer.Sl. No') }}</th>
						<th>{{ __('customer.Name') }}</th>
						<th>{{ __('customer.Code') }}</th>
						<th>{{ __('customer.Account Group') }}</th>
						<th>{{ __('customer.Ledger Name') }}</th>
						<th>{{ __('customer.Ledger Code') }}</th>
						<th>{{ __('customer.Status') }}</th>
						<th>{{ __('customer.action') }}</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>.
<div class="modal fade" id="kt_modal_4_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<input type="hidden" name="id" id="id" value="">
		<input type="hidden" name="main_ledger" id="main_ledger" value="">
		<input type="hidden" name="sub_ledger" id="sub_ledger" value="">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('vendor.Accounts Information Detail Form') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="kt-form kt-form--label-right" id="group-form" name="group-form">
					<div class="kt-portlet__body">



								<div class="form-group row" >
						 <div class="col-lg-12">
                           <div class="form-group row pr-md-3">
                            
                                 <div class="col-md-3">
                           <label>Accounting Ledger<span style="color: red">*</span></label>
                           </div> 
                           <div class="col-md-2">
                            <label class="kt-radio kt-radio--solid kt-radio--brand">
                           <input type="radio" name="types" class="types"  value="1" checked>New
                            <span></span>
                           </label>&nbsp;
                        </div>
                        <div class="col-md-2">
                           <label class="kt-radio kt-radio--solid kt-radio--brand">
                           <input type="radio" name="types" class="types" value="2"> Existing
                           <span></span>
                           </label>
                           </div>
                           
                        </div>
                     </div>
            </div>




						<div class="form-group row" id="new" >
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-3">
										<label>{{ __('customer.Parent Group') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-9 input-group input-group-sm">
										<select class="form-control single-select" id="accounts_group" name="accounts_group">
											<option value="">{{ __('vendor.Select') }}</option>@foreach ($groups as $key)
											<option value="{{$key->id}}">{{$key->name}}</option>@endforeach</select>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-3">
										<label>{{ __('customer.Ledger Code') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-9">
										<div class="input-group  input-group-sm">
											<div class="input-group-prepend"></div>
											<input type="text" class="form-control" id="accounts_code" name="accounts_code" autocomplete="off" placeholder="">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group row pr-md-3">
									<div class="col-md-3">
										<label>{{ __('customer.Ledger Name') }}<span style="color: red">*</span></label>
									</div>
									<div class="col-md-9">
										<div class="input-group  input-group-sm">
											<div class="input-group-prepend"></div>
											<input type="text" class="form-control" id="accounts_ledger" name="accounts_ledger" autocomplete="off" placeholder="">
											<input type="hidden" class="form-control" id="branch" name="branch" value="{{$branch}}">
										</div>
									</div>
								</div>
							</div>
						</div>



<div class="form-group row" id="existing" style="display: none;">
									
									
								   
									<div class="col-lg-12">
									<div class="form-group row pr-md-3">
									<div class="col-md-3">
									<label>Select Ledger<span style="color: red">*</span></label>
									</div>  
									<div class="col-md-9 input-group input-group-sm">
									<select class="form-control kt-selectpicker single-select" name="customer_ledger" id="customer_ledger">
										@foreach($accounts as $accountss)
										<option value="{{$accountss->id}}"  >{{$accountss->name}}</option>
										@endforeach
									</select>
									</div>
									</div>
									</div>
							

								</div>





					</div>
			</div>
			<div class="modal-footer">
				
				<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> {{ __('customer.Cancel') }}</button>
				<button id="Group_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> {{ __('customer.Save') }}</button>
			</div>
		</div>
	</div>
	</form>
</div>
<style type="text/css">
	.hideButton{
		   display: none
		}
		.error{
			color: red
		}
</style>
@endsection
 @section('script')
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>

<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/resources/js/crm/vendor_accounts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.js"></script>
<script type="text/javascript">
  $(document.body).on("change", "input[type=radio][name=types]", function() 
   {
      var checkedValue = $('input[name="types"]:checked').val();
      if(checkedValue == 1)
            {
            	$("#existing").hide(); 
					$("#new").show();
            }
      if(checkedValue == 2)
            {
            	$("#new").hide();  
               $("#existing").show();

            }
      
      
    /*  $.ajax({
      url: "getsupplier_vendor",
      method: "POST",
      data: {
         _token: $('#token').val(),
         id:checkedValue
      },
      dataType: "json",
      success: function(data) {
         console.log(data);
         $('select[name="supplier_vendor_names[]"]').empty();
         
$('select[name="supplier_vendor_names[]"]').append('<option value="">select</option>');
         $.each(data, function(key, value) {
                  $('select[name="supplier_vendor_names[]"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                  });

      }
         

      
   })*/
   }); 
</script>
@endsection
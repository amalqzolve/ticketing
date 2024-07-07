<?php
$default_customer_ledger = isset($accounts->default_customer_ledger) ? $accounts->default_customer_ledger : '';
$default_supplier_ledger = isset($accounts->default_supplier_ledger) ? $accounts->default_supplier_ledger : '';

$sales_invoice_ledger = isset($accounts->sales_invoice_ledger) ? $accounts->sales_invoice_ledger : '';
$sales_invoice_vat_ledger = isset($accounts->sales_invoice_vat_ledger) ? $accounts->sales_invoice_vat_ledger : '';
$sales_return_ledger = isset($accounts->sales_return_ledger) ? $accounts->sales_return_ledger : '';
$sales_return_vat_ledger = isset($accounts->sales_return_vat_ledger) ? $accounts->sales_return_vat_ledger : '';

$sales_invoice_entry_type = isset($accounts->sales_invoice_entry_type) ? $accounts->sales_invoice_entry_type : '';
$sales_return_entry_type = isset($accounts->sales_return_entry_type) ? $accounts->sales_return_entry_type : '';
$sales_billsettilement_entry_type = isset($accounts->sales_billsettilement_entry_type) ? $accounts->sales_billsettilement_entry_type : '';
$sales_adwance_entry_type = isset($accounts->sales_adwance_entry_type) ? $accounts->sales_adwance_entry_type : '';

?>

@extends('settings.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home-2"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Account settings
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<form class="kt-form" id="kt_form">
				<br><br>
				<div class="row">
					<div class="col-lg-12">
						<center>
							<h1>Ledger settings</h1>
						</center>
					</div>

				</div>
				<br><br>




				<div class="row" style="padding-bottom: 6px;">


					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Default Customer<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="default_customer_ledger" id="default_customer_ledger">
									<option value="" selected>Select</option>
									@foreach($allLedger as $ledger)
									<?php
									$selctOrNot = '';
									if (($ledger['parent_id'] == '~') && ($ledger['id'] == $default_customer_ledger))
										$selctOrNot = 'selected';
									?>
									<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
										@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
											@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Default Supplier<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="default_supplier_ledger" id="default_supplier_ledger">
									<option value="" selected>Select</option>
									@foreach($allLedger as $ledger)
									<?php
									$selctOrNot = '';
									if (($ledger['parent_id'] == '~') && ($ledger['id'] == $default_supplier_ledger))
										$selctOrNot = 'selected';
									?>
									<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
										@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
											@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Invoice<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="sales_invoice_ledger" id="sales_invoice_ledger">
									<option value="" selected>Select</option>
									@foreach($allLedger as $ledger)
									<?php
									$selctOrNot = '';
									if (($ledger['parent_id'] == '~') && ($ledger['id'] == $sales_invoice_ledger))
										$selctOrNot = 'selected';
									?>
									<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
										@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
											@endforeach
								</select>
							</div>
						</div>
					</div>




					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Invoice Vat<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="sales_invoice_vat_ledger" id="sales_invoice_vat_ledger">
									<option value="" selected>Select</option>
									@foreach($allLedger as $ledger)
									<?php
									$selctOrNot = '';
									if (($ledger['parent_id'] == '~') && ($ledger['id'] == $sales_invoice_vat_ledger))
										$selctOrNot = 'selected';
									?>
									<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
										@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
											@endforeach
								</select>
							</div>
						</div>
					</div>


					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Credit Note<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="sales_return_ledger" id="sales_return_ledger">
									<option value="" selected>Select</option>
									@foreach($allLedger as $ledger)
									<?php
									$selctOrNot = '';
									if (($ledger['parent_id'] == '~') && ($ledger['id'] == $sales_return_ledger))
										$selctOrNot = 'selected';
									?>
									<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
										@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
											@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Credit Note Vat<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="sales_return_vat_ledger" id="sales_return_vat_ledger">
									<option value="" selected>Select</option>
									@foreach($allLedger as $ledger)
									<?php
									$selctOrNot = '';
									if (($ledger['parent_id'] == '~') && ($ledger['id'] == $sales_return_vat_ledger))
										$selctOrNot = 'selected';
									?>
									<option value="{{$ledger['id']}}" {{($ledger['parent_id']!='~')?'disabled':''}} {{$selctOrNot}}>
										@for($i=0;$i<=$ledger['count'];$i++) &nbsp; &nbsp; @endfor [{{$ledger['code']}}] {{$ledger['name']}} </option>
											@endforeach
								</select>
							</div>
						</div>
					</div>





				</div>

				<br><br>
				<div class="row">
					<div class="col-lg-12">
						<center>
							<h1>Entry Type Settings</h1>
						</center>
					</div>

				</div>
				<br><br>

				<div class="row" style="padding-bottom: 6px;">
					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Invoice<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="sales_invoice_entry_type" id="sales_invoice_entry_type">
									<option value="" selected>Select</option>
									@foreach($entryTypes as $entryType)
									<option value="{{$entryType->id}}" {{($sales_invoice_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
									@endforeach
								</select>
							</div>
						</div>
					</div>



					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Credit Note<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="sales_return_entry_type" id="sales_return_entry_type">
									<option value="" selected>Select</option>
									@foreach($entryTypes as $entryType)
									<option value="{{$entryType->id}}" {{($sales_return_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
									@endforeach
								</select>
							</div>
						</div>
					</div>




					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Bill Settilement<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="sales_billsettilement_entry_type" id="sales_billsettilement_entry_type">
									<option value="" selected>Select</option>
									@foreach($entryTypes as $entryType)
									<option value="{{$entryType->id}}" {{($sales_billsettilement_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
									@endforeach
								</select>
							</div>
						</div>
					</div>



					<div class="col-lg-6">
						<div class="form-group row pr-md-3">
							<div class="col-md-4">
								<label>Adwance<span style="color: red">*</span></label>
							</div>
							<div class="col-md-8 input-group input-group-sm">
								<select class="form-control  single-select" name="sales_adwance_entry_type" id="sales_adwance_entry_type">
									<option value="" selected>Select</option>
									@foreach($entryTypes as $entryType)
									<option value="{{$entryType->id}}" {{($sales_adwance_entry_type==$entryType->id)?'selected':''}}>{{$entryType->name}} </option>
									@endforeach
								</select>
							</div>
						</div>
					</div>


				</div>


				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-lg-6">
							</div>
							<div class="col-lg-6 kt-align-right">
								<button type="reset" class="btn btn-secondary cancel" onclick="Currency_cancel()">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
										<line x1="18" y1="6" x2="6" y2="18"></line>
										<line x1="6" y1="6" x2="18" y2="18"></line>
									</svg>
									@lang('app.Cancel')
								</button>
								<button type="button" name="btnSave" id="btnSave" class="btn btn-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
										<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
										<polyline points="22 4 12 14.01 9 11.01"></polyline>
									</svg>
									@lang('app.Save')
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- The Modal -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog" style="max-width:75%;">
		<div class="modal-content">
			<!-- Modal Header -->
			<!-- Modal body -->
			<div class="modal-body">
				<button type="button " class="btn btn-dark float-right" data-dismiss="modal" style="    width: auto; padding: 4px; line-height: .75; ">&times;</button>
				<img alt="Logo" id="modalimg" src="" style="width:100%;" />
			</div>

			<!-- Modal footer -->

		</div>
	</div>
</div>

@endsection
@section('script')
<script type="text/javascript">
	$('.accountsettings').addClass('kt-menu__item--active');
</script>
<script src="{{url('/')}}/resources/js/settings/accounting.js" type="text/javascript"></script>
@endsection
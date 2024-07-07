@extends('settings.common.layout')

@section('content')
<style>
    .uppy-Dashboard-inner
    {
        width: 100% !important;
    }
</style>

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">


<!-- 									<h3 class="kt-subheader__title">
										Wizard 1 </h3>
									<span class="kt-subheader__separator kt-hidden"></span> -->

									<div class="kt-subheader__breadcrumbs">

										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

										<span class="kt-subheader__breadcrumbs-separator"></span>

									    {{ Breadcrumbs::render('userInfo.index') }}

										<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
									</div>
								</div>
								<div class="kt-subheader__toolbar">
									<div class="kt-subheader__wrapper">
										<a href="#" class="btn kt-subheader__btn-primary">
											Actions &nbsp;

											<!--<i class="flaticon2-calendar-1"></i>-->
										</a>
										<div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="" data-placement="left" data-original-title="Quick actions">
											<a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24"></polygon>
														<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
														<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"></path>
													</g>
												</svg>

												<!--<i class="flaticon2-plus"></i>-->
											</a>
											<div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">

												<!--begin::Nav-->
												<ul class="kt-nav">
													<li class="kt-nav__head">
														Add anything or jump to:
														<i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
													</li>
													<li class="kt-nav__separator"></li>
													<li class="kt-nav__item">
														<a href="#" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-drop"></i>
															<span class="kt-nav__link-text">Order</span>
														</a>
													</li>
													<li class="kt-nav__item">
														<a href="#" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-calendar-8"></i>
															<span class="kt-nav__link-text">Ticket</span>
														</a>
													</li>
													<li class="kt-nav__item">
														<a href="#" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
															<span class="kt-nav__link-text">Goal</span>
														</a>
													</li>
													<li class="kt-nav__item">
														<a href="#" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-new-email"></i>
															<span class="kt-nav__link-text">Support Case</span>
															<span class="kt-nav__link-badge">
																<span class="kt-badge kt-badge--success">5</span>
															</span>
														</a>
													</li>
													<li class="kt-nav__separator"></li>
													<li class="kt-nav__foot">
														<a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
														<a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more...">Learn more</a>
													</li>
												</ul>

												<!--end::Nav-->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>






	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											{{ trans('app.userslist')}}
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												<div class="dropdown dropdown-inline">
													<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="la la-download"></i> Export
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<ul class="kt-nav">
															<li class="kt-nav__section kt-nav__section--first">
																<span class="kt-nav__section-text">Choose an option</span>
															</li>
															<li class="kt-nav__item" id="export-button-print">
																<span href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">Print</span>
																</span>
															</li>
															<li class="kt-nav__item" id="export-button-copy">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">Copy</span>
																</span>
															</li>
															<li class="kt-nav__item" id="export-button-csv">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-text-o"></i>
																	<span class="kt-nav__link-text">CSV</span>
																</a>
															</li>
															<li class="kt-nav__item" id="export-button-pdf">
																<span class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">PDF</span>
																</span>
															</li>
														</ul>
													</div>
												</div>
												&nbsp;









												<button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-type="add" data-toggle="modal" data-target="#kt_modal_4_2"><i class="la la-plus"></i>New Record</button>

												<a href="userInfoTrash" type="button" class="btn btn-danger btn-elevate btn-icon-sm">
													<i class="la la-trash"></i>
												</a>

											</div>
										</div>
									</div>
								</div>






								<div class="kt-portlet__body">

<!--begin: Datatable -->
<table class="table table-striped- table-bordered table-hover table-checkable" id="userdetails_list">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Action</th>
            <th>User Type</th>
            <th>User Name</th>
            <th>Address1</th>
            <th>Address2</th>
            <th>Country</th>
            <th>City</th>
            <th>Region</th>
            <th>Zip</th>
            <th>Email</th>
            <th>Office Phone</th>
            <th>Mobile</th>
            <th>Fax Number</th>
            <th>Website</th>
        </tr>
    </thead>

    <tbody>

    </tbody>

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

<!--end: Datatable -->

								</div>
							</div>
						</div>.


<!--begin::Modal-->
							<div class="modal fade" id="kt_modal_4_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <input type="hidden" name="id" id="id" value="">
								<div class="modal-dialog modal-xl" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">User Information details form</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>

<!--$$$$$$$$$$$$$$$$$$--->

<div class="modal-body">
  <form class="kt-form kt-form--label-right" id="user-form" name="user-form">

      <div class="kt-portlet__body">
      	<ul class="nav nav-tabs  nav-tabs-line" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#user_details" role="tab">User Details</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#user_files" role="tab">User Files</a>
								</li>

							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="user_details" role="tabpanel">
         <div class="row">
         	<div class="col-lg-6">
																		<div class="form-group row pr-md-3">
																		<div class="col-md-4">
																		<label> Type</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_type" id="cust_type"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label> Name</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_name" id="cust_name"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pr-md-3">
																		<div class="col-md-4">
																		<label> Country</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_country" id="cust_country"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label> City</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_city" id="cust_city"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pr-md-3">
																		<div class="col-md-4">
																		<label> Region</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_region" id="cust_region"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label> Zip</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_zip" id="cust_zip"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pr-md-3">
																		<div class="col-md-4">
																		<label> Email</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_email" id="cust_email"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label> Office Phone</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_officephone" id="cust_officephone"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pr-md-3">
																		<div class="col-md-4">
																		<label> Mobile Number</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_mobile" id="cust_mobile"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label> Fax</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_fax" id="cust_fax"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pr-md-3">
																		<div class="col-md-4">
																		<label> Website</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<input type="text" class="form-control" name="cust_website" id="cust_website"  autocomplete="off">
																		</div>
																		</div>
																		</div>
											</div>
											<div class="col-lg-6">
																		<div class="form-group row pl-md-3">
																		<div class="col-md-4">
																		<label>Address</label>
																		</div>
																		<div class="col-md-8">
																		<div class="input-group input-group-sm">
																		<textarea class="form-control" name="cust_add1" id="cust_add1"  autocomplete="off"></textarea>
																		</div>
																		</div>
																		</div>
											</div>

										</div>

<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>


	<div class="row">
									<div class="col-lg-12">
									<div class="form-group row pl-md-3">
										<table class="table table-striped table-bordered table-hover" id="skill_table" style="width: 100%;">
											<thead  style=" background-color: #306584; color: white;">
											<tr>
												<th class="text-center p-1">S.No</th>
												<th class="text-center p-1">Skills</th>
												<th class="text-center p-1">Value</th>

												 <th class="text-center p-0" style="width: 38px; padding: 0;">
													<div class="kt-demo-icon__preview addmore">
															<i class="fa fa-plus" style="color: white;"></i>
														</div></th>
											</tr>
											</thead>
											<tr>

											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>

	<!-- <table id="table-more">
		<tr class="addmore">
			<td>
				 <input type="text" class="form-control skill" placeholder="Skill" name="skill[0]"/>
			</td>

			<td>
				<input type="text" class="form-control skillValue" placeholder="Value" name="skillValue[0]"/>
			</td>

			<td>
					<a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
					   <i class="la la-trash-o"></i> Delete
					</a>

					<a href="javascript:;" id="add-more" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand">
					  <i class="la la-plus"></i> Add
					</a>
			</td>

		</tr>
	</table> -->




<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
			<div class="tab-pane" id="user_files" role="tabpanel">
    <div class="form-group row">
            <div class="col-lg-12">
				<div id="choose-files" style="width:100%;">
				  <form action="/upload">
				    <input type="file" id="files" name="files[]"/>

				  </form>
				</div>
           </div>
       </div>
      </div>

      </div>


</div>

<!--$$$$$$$$$$$$$$$$$$--->



										<div class="modal-footer">



											<button type="reset" class="btn btn-secondary float-right mr-2 closeBtn" data-dismiss="modal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                Cancel
                                            </button>
                                            <button id="Customerdetail_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                                Submit
                                            </button>

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
<!--end::Modal-->
@endsection
@section('script')

    <script src="{{ URL::asset('assets') }}/js/pages/crud/datatables/basic/basic.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	  var rowcount = ($("#skill_table > tbody > tr").length);
	$(".addmore").click(function()
		{

	  var sl = ($("#skill_table > tbody > tr").length);


			var costs = '';
			costs += '<tr>\
					  <td class="row_count" id="rowcount">'+ sl +'</td>\
					  <td>\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control skill" name="skill[]" id="skill'+rowcount+'" data-id='+rowcount+'>\
					  </div>\
					  </td>\
					  <td>\
					  <div class="input-group input-group-sm">\
					  <input type="text" class="form-control skillValue" name="skillValue[]" id="skillValue'+rowcount+'" data-id='+rowcount+'>\
					  </div>\
					  </td>\
						<td>\
					  <div class="kt-demo-icon__preview skillremove">\
					  <i class="fa fa-trash" id="remove_row" style="color: red;padding-left: 30%;"></i>\
					  </div>\
					  </td>\
					  </tr>';

					   $('#skill_table').append(costs);
					   rowcount++;
});

 });

$("body").on("click",".skillremove",function(event){
   event.preventDefault();
   var row = $(this).closest('tr');


	   var siblings = row.siblings();
	   row.remove();
	   siblings.each(function(index) {
		 $(this).children().first().text(index);
	   });
});

</script>
@endsection

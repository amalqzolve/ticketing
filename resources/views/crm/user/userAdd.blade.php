@extends('crm.common.layout')
 @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<br/>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">	<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
				<h3 class="kt-portlet__head-title">
											{{ trans('app.addUserInfo')}}
										</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline"></div>&nbsp;</div>
				</div>
			</div>
		</div>
		<div class="">
			<div class="kt-portlet">
				<form class="kt-form kt-form--label-right" id="user-form">
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-4">
								<label>{{ trans('app.customerType')}}</label>
								<input type="text" class="form-control" value="{{isset($userInfo->cust_type)?$userInfo->cust_type:''}}" placeholder="Enter Customer Type " id="cust_type" name="cust_type">@if(isset($userInfo->id))
								<input name="cust_id" type="hidden" id="cust_id" value="{{$userInfo->id}}">@endif
								<input type="hidden" name="fileData" id="fileData" /> <span class="text-muted">Please enter customer type</span>
							</div>
							<div class="col-lg-4">
								<label>Customer Name:</label>
								<input type="text" class="form-control" value="{{isset($userInfo->cust_name)?$userInfo->cust_name:''}}" placeholder="Enter Customer Name" id="cust_name" name="cust_name">@if (isset($userInfo->uniqueid))
								<input type="hidden" id="UniqueID" value="{{$userInfo->uniqueid}}">@else
								<input type="hidden" id="UniqueID" value="{{uniqid()}}">@endif <span class="text-muted">Please enter your name</span>
							</div>
							<div class="col-lg-4">
								<label>Customer Country :</label>
								<input type="text" class="form-control" placeholder="Enter Customer Country" id="cust_country" name="cust_country" value="{{isset($userInfo->cust_country)?$userInfo->cust_country:''}}">	<span class="text-muted">Please enter country</span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label>Customer City:</label>
								<input type="text" class="form-control" placeholder="Enter  City" value="{{isset($userInfo->cust_city)?$userInfo->cust_city:''}}" id="cust_city" name="cust_city">	<span class="text-muted">Please enter your city</span>
							</div>
							<div class="col-lg-4">
								<label>Customer Region:</label>
								<input type="text" class="form-control" placeholder="Enter Customer Region " value="{{isset($userInfo->cust_region)?$userInfo->cust_region:''}}" id="cust_region" name="cust_region">	<span class="text-muted">Please enter customer region</span>
							</div>
							<div class="col-lg-4">
								<label class="">Customer Zip:</label>
								<input type="text" class="form-control" placeholder="Enter Customer Zip" id="cust_zip" value="{{isset($userInfo->cust_zip)?$userInfo->cust_zip:''}}" name="cust_zip">	<span class="text-muted">Please enter customer zip</span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label>Customer Email:</label>
								<input type="text" class="form-control" placeholder="Enter Customer  Email" id="cust_email" value="{{isset($userInfo->cust_email)?$userInfo->cust_email:''}}" name="cust_email" />	<span class="text-muted">Please enter customer email</span>
							</div>
							<div class="col-lg-4">
								<label>Customer Office Phone:</label>
								<input type="text" class="form-control" placeholder="Enter Customer Office Phone" value="{{isset($userInfo->cust_officephone)?$userInfo->cust_officephone:''}}" id="cust_officephone" name="cust_officephone" />	<span class="text-muted">Please enter office phone</span>
							</div>
							<div class="col-lg-4">
								<label class="">Customer Mobile Number:</label>
								<input type="text" class="form-control" placeholder="Enter Customer Mobile Number" value="{{isset($userInfo->cust_mobile)?$userInfo->cust_mobile:''}}" id="cust_mobile" name="cust_mobile" />	<span class="text-muted">Please enter mobile number</span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label>Customer Fax:</label>
								<input type="text" class="form-control" placeholder="Enter Customer Fax" id="cust_fax" name="cust_fax" value="{{isset($userInfo->cust_fax)?$userInfo->cust_fax:''}}"> <span class="text-muted">Please enter fax</span>
							</div>
							<div class="col-lg-4">
								<label>Customer Website:</label>
								<input type="text" class="form-control" placeholder="Enter Customer Website" id="cust_website" name="cust_website" value="{{isset($userInfo->cust_website)?$userInfo->cust_website:''}}">	<span class="text-muted">Please enter website</span>
							</div>
							<div class="col-lg-4">
								<label>Customer Address:</label>
								<textarea class="form-control edited" rows="1" id="cust_add1" name="cust_add1" placeholder="Enter Your Address">{{isset($userInfo->cust_add1)?$userInfo->cust_add1:''}}</textarea>	<span class="text-muted">Please enter addess</span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label class="">Customer Address2:</label>
								<textarea class="form-control edited" rows="1" id="cust_add2" name="cust_add2" placeholder="Enter Your Address">{{isset($userInfo->cust_add2)?$userInfo->cust_add2:''}}</textarea>	<span class="text-muted">Please enter Adress</span>
							</div>
							<div class="col-lg-4">
								<label class="">Customer List</label>
								<select multiple="multiple" name="select" class="js-data-example-ajax form-control"></select>
							</div>
						</div>
						<div class="form-group row">
							<div class="kt-portlet">
								<div class="kt-portlet__head">
									<div class="kt-portlet__head-label">
										<h3 class="kt-portlet__head-title">
                            Other Details
                        </h3>
									</div>
								</div>
								<div class="kt-portlet__body">
									<ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-success" role="tablist">
										<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#kt_tabs_7_1" role="tab"><i class="la la-cloud-upload"></i> Documents</a>
										</li>
										<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="la la-cog"></i> Skills</a>
											<div class="dropdown-menu"> <a class="dropdown-item" data-toggle="tab" href="#kt_tabs_7_2">Action</a>
												<a class="dropdown-item" data-toggle="tab" href="#kt_tabs_7_2">Another action</a>
												<a class="dropdown-item" data-toggle="tab" href="#kt_tabs_7_2">Something else here</a>
												<div class="dropdown-divider"></div> <a class="dropdown-item" data-toggle="tab" href="#kt_tabs_7_2">Separated link</a>
											</div>
										</li>
										<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#kt_tabs_7_3" role="tab"><i class="la la-puzzle-piece"></i> Logs</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="kt_tabs_7_1" role="tabpanel">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to.
											<br/>
											<br/>
											<div class="UppyForm">
												<form action="https://upload-endpoint.uppy.io/upload">
													<h5>Uppy was not loaded — slow connection, unsupported browser, weird JS error on a page — but the upload still works, because HTML is cool like that</h5>
													<input type="file" name="files[]" multiple="">
													<button type="submit">Fallback Form Upload</button>
												</form>
											</div>
											<div class="UppyProgressBar"></div>
											<div class="uploaded-files">
												<h5>Uploaded files:</h5>
												<ol></ol>
											</div>
										</div>
										<div class="tab-pane" id="kt_tabs_7_2" role="tabpanel">
											<div class="form-group row">
												<table id="table-more">
													<tr class="addmore">
														<td>
															<input type="text" class="form-control skill" placeholder="Skill" name="skill[0]" />
														</td>
														<td>
															<input type="text" class="form-control skillValue" placeholder="Value" name="skillValue[0]" />
														</td>
														<td>
															<a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold"> <i class="la la-trash-o"></i> Delete</a>
															<a href="javascript:;" id="add-more" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand"> <i class="la la-plus"></i> Add</a>
														</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="tab-pane" id="kt_tabs_7_3" role="tabpanel">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
											<br/>
											<br/>
											<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
											<!-- Modal1-->
											<div class="modal fade" id="myModal" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">1</h4>
														</div>
														<div class="modal-body">
															<p>Some text in the modal.</p>
															<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Open Modal</button>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
											<div class="modal fade" id="myModal2" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">2</h4>
														</div>
														<div class="modal-body">
															<p>Some text in the modal.</p>
															<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal3">Open Modal</button>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
											<div class="modal fade" id="myModal3" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">3</h4>
														</div>
														<div class="modal-body">
															<p>Some text in the modal.</p>
															<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal4">Open Modal</button>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
											<div class="modal fade" id="myModal4" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">4</h4>
														</div>
														<div class="modal-body">
															<p>Some text in the modal.</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="kt-separator kt-separator--dashed"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-lg-4"></div>
								<div class="col-lg-8">
									<button id="single_Customerdetail_submit" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">Submit</button>
									<button type="reset" class="btn btn-secondary">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>.
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
<script src="{{url('/')}}/js/userSingle.js"></script>
@endsection
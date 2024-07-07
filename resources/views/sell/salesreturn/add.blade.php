@extends('sell.common.layout')

@section('content')
<!-- <link href="{{url('/')}}/public/assets/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
                                   <div class="kt-subheader__breadcrumbs">

										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

										<span class="kt-subheader__breadcrumbs-separator"></span>

									   
									</div>
								</div>
								<div class="kt-subheader__toolbar">
                            <div class="kt-subheader__wrapper">
                                <a href="#" class="btn kt-subheader__btn-primary">
                                    @lang('app.Back') 
                                </a>
                                <a href="trash_purchase" class="btn btn-secondary btn-hover-warning">
                                    @lang('app.Trash ')

                                </a>
                               
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
											<i class="kt-font-brand flaticon-home-2"></i>
										</span>
										<h3 class="kt-portlet__head-title">
										Sales Return
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
											
					 
					</div>
				</div></div>
								</div>

								<div class="kt-portlet__body">

<!--begin: Datatable -->
<form method="POST" action="{{ route('invoicenumber_submit_sell') }}">
	@csrf
<div class="row">

	<div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Customer') </label>
										</div> 
										<div class="col-md-8  input-group-sm">
											<select class="form-control single-select kt-selectpicker" id="customer" name="customer">
												<option value="">select</option>
			@foreach($customers as $data)
            <option value="{{$data->id}}">{{$data->cust_name}}</option>
            @endforeach
											</select>                
										</div>
										</div>
									  </div>
									  <div class="col-lg-6">
										<div class="form-group row pr-md-3">
										<div class="col-md-4">
										<label>@lang('app.Invoice Number') </label>
										</div> 
										<div class="col-md-8  input-group-sm">
											<select class="form-control single-select kt-selectpicker" id="invoicenumber" name="invoicenumber">
												<option value="">select</option>
			
											</select>                
										</div>
										</div>
									  </div>
<div class="col-lg-6">
	  <button type="submit" class="btn btn-primary" id="" name="">Submit</button>
</div>
</div>
</form>
<!--end: Datatable -->

								</div>
							</div>
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
<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" src="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>

<script type="text/javascript">
	 $(document.body).on("change", "#customer", function()
    {
        var cid = $(this).val();
        $.ajax({
        url: "getinvoicenumber_sell",
        method: "POST",
        data: {
            _token: $('#token').val(),
            id:cid
        },
        dataType: "json",
        success: function(data) {
          //  console.log(data);
           
          $.each(data, function(key, value) {
          $('select[name="invoicenumber"]').append('<option value="'+ value.id +'">'+ value.id +'</option>');
           
                        });

        

        }
    })
    });
</script>
@endsection

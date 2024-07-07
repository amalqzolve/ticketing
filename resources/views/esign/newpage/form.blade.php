@extends('esign.common.layout')
@section('content')
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

<link href="https://releases.transloadit.com/uppy/v3.3.1/uppy.min.css" rel="stylesheet">
<style>
    .uppy-Dashboard-inner
    {
        width: 100% !important;
        height: 150px !important;
    }
    .remove
    {
        width: 34px;
    text-align: center;
    }
</style>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-5">
    <br />
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon-home-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Electronic Signature - Documents
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">


                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="container-fluid">
                <div class="row" style="padding-bottom: 6px;">
                    <div class="col-lg-6">
                        <div class="form-group row pr-md-3">
                            <div class="col-md-4">
                                <label>Document Name<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8  input-group input-group-sm">
                                <input type="text" class="form-control branch"
                                 name="cust_code" id="cust_code" placeholder="Document Name" autocomplete="off" >
                             </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <input type="hidden" class="form-control branch" name="branch" id="branch" value="12">
                        <div class="form-group row pl-md-3">
                            <div class="col-md-4">
                                <label>Document Type<span style="color: red">*</span></label>
                            </div>
                <div class="col-md-8">
                <div class="input-group input-group-sm">

                                    <input type="text" class="form-control branch"
                                    name="cust_code" id="cust_code" placeholder="Document Type"
                                    autocomplete="off" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row  pr-md-3">
                            <div class="col-md-4">
                                <label>Document Category<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <input type="text" class="form-control branch"
                                name="cust_code" id="cust_code" placeholder="Document Category"
                                autocomplete="off" >


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row pl-md-3">
                            <div class="col-md-4">
                                <label>Form Name<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8  input-group input-group-sm">
                                <input type="text" class="form-control branch"
                                name="cust_code" id="cust_code" placeholder="SignForm Name"
                                autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row  pr-md-3">
                            <div class="col-md-4">
                                <label>Days to complete<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8 input-group input-group-sm">
                                <input type="number" class="form-control branch"
                                name="cust_code" id="cust_code" placeholder="Days to complete"
                                autocomplete="off" >


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row pl-md-3">
                            <div class="col-md-4">
                                <label>Document valid until<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-8  input-group input-group-sm">
                                <input type="text" class="form-control branch kt_datetimepickerr" name="cust_code" id="cust_code" placeholder="dd/mm/yyyy" autocomplete="off" readonly="">
                            </div>
                        </div>
                    </div>

                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>Description</label>
                                </div>
                                <div class="col-md-8 input-group-sm pr-0">
                                    <textarea class="form-control" name="internalreference" id="internalreference"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group  row pr-md-3">
                                <div class="col-md-4">
                                    <label>Note to all Recipients</label>
                                </div>
                                <div class="col-md-8 input-group-sm pr-0">
                                    <textarea class="form-control" name="notes" id="notes"></textarea>
                                </div>
                            </div>
                        </div>


                </div>
                <div class="col-12 pb-3 pl-0 pr-0">
                    <table class="table table-striped table-bordered table-hover" id="flow_table" style="table-layout:fixed; width:100%">
						<thead class="thead-light">
							<tr>
								<th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="60px">Sl No</th>

								<th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;" width="250px">Recipients</th>
								<th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important;">Action</th>

								<th style="background-color:  #3f4aa0;
                                       color: white; white-space: nowrap;     padding: 2px 7px !important; " width="60px">

                                </th>
							</tr>
						</thead>
						<tbody>


						</tbody>
					</table>
                    <table style="width:100%">
						<tr>
							<td>
								<button type="button" class="btn btn-brand btn-elevate btn-icon-sm  float-right" id="newrow"
                                ><i class="la la-plus"></i> Recipients</button>
							</td>

						</tr>
					</table>
                </div>
                <div class="col-md-12 pr-0 pl-0">
                    <div id="drag-drop-area"></div>
                </div>


            </div>

        </div>
        <div class="kt-portlet__foot pr-5 ">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-6">

                    </div>
                    <div class="col-lg-6 kt-align-right">
                        <button id="branddetailsubmit" class="btn btn-primary  float-right "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>  Save</button>
                        <button type="button" class="btn btn-secondary mr-2" onclick="history.back()"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>  Cancel</button>


                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
@section('script')

<script src="{{ URL::asset('assets') }}/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets') }}/datatables/buttons.dataTables.min.css">
<script src="{{ URL::asset('assets') }}/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/jszip.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/esign/newpage/list.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/asset/tablednd.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
		$("#flow_table").tableDnD();
        $ind=0;
        $("#newrow").click(function(){
            $ind=$ind+1;
            rowcount =$ind;

		var product = '';
		product += '<tr>\
		<td style="text-align: center;" class="number">\
            <div class="row">\
            <div class="col-6">' + rowcount + '</div>\
            <div class="col-6"><i class="fa fa-arrows-alt" aria-hidden="true"></i></div>\
        </div>\
            </td>\
        <td style="text-align: center; padding: 0px;" >\
            <select class="form-control" id="sel1">\
                <option>User 1</option>\
                <option>User 2</option>\
                <option>User 3</option>\
            </select>  </td>\
        <td style="text-align: center; padding: 0px;">\
              <select class="form-control" id="sel1">\
    <option>Needs to sign</option>\
    <option>Approver</option>\
    <option>Receives a copy</option>\
  </select>  </td>\
        <td style="text-align: center;  padding: 6px;">\
            <button class="border border-0 rem">\
            <i class="fa fa-trash" aria-hidden="true"></i>\
            </button></td>\
        <tr>';

            $("#flow_table tbody ").append(product);
            $("#flow_table tbody ").tableDnD();
        });

	});

$(document).on("click",".remove",function() {
    $($(this).parents("tr")).remove();
});

</script>
<script type="module">
    import {Uppy, Dashboard, Tus} from "https://releases.transloadit.com/uppy/v3.3.1/uppy.min.mjs"
    var uppy = new Uppy()
      .use(Dashboard, {
        inline: true,
        target: '#drag-drop-area'
      })
      .use(Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

    uppy.on('complete', (result) => {
      console.log('Upload complete! We’ve uploaded these files:', result.successful)
    });

    $(document).on("click",".rem",function() {
       // alert("click");
       $($(this).parents("tr")).remove();
    });
  </script>
@endsection

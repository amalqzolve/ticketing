@extends('Reports.common.layout')
@section('content')
<style>
 .dataTables_wrapper .dataTable th{
    white-space: nowrap !important;
    padding-left: 5px !important;
    padding-right: 5px !important;
  }
</style>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-5">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
        <div class="container-fluid">
            <div class="row  border border-top-0 border-left-0 border-toright-0 pt-3 pb-3" >
                <div class="col-md-12">
                    <h3>Heading</h3>
                </div>
            </div>
            <div class="row pt-4 pb-4">
              <div class="col-12 pb-3">
                <a href=""  class="btn btn-primary float-right btn-sm"><i class="la la-plus"></i> New Record</a>
              </div>
                <div class="col-md-12">


                  <table class="table table-striped table-hover table-checkable dataTable no-footer" id="myTable">
                    <thead>
                      <tr>
                        <th>
                          <div class="form-group m-0" style="position: absolute; bottom:1px;">
                            <input type="checkbox" class="form-control" name="" id="">
                          </div>
                        </th>
                        <th>
                          Document name
                        </th>
                        <th>
                          Owner
                        </th>
                        <th>
                          Folder name
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Document type
                        </th>
                        <th>
                          Recipients
                        </th>
                        <th>
                          SignForm name
                        </th>
                        <th>
                          Created on
                        </th>
                        <th>
                          Last modified on
                        </th>
                      </tr>
                    </thead>

                  </table>



                </div>
            </div>
        </div>

	    </div>


	</div>
</div>


<!-- <script src="{{url('/')}}/resources/js/resourcemanagement/department.js" type="text/javascript"></script> -->
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
      $('#myTable').DataTable();
      $("#myTable").wrap("<div class='table-responsive'></div>");
  } );
</script>
@endsection

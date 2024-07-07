@extends('asset.common.layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<br/>
                     <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                           <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand flaticon-home-2"></i>
                              </span>
                              <h3 class="kt-portlet__head-title">
                                Parts Notifications
                              </h3>
                           </div>
                           <div class="kt-portlet__head-toolbar">
                              <div class="kt-portlet__head-wrapper">
                                 <div class="kt-portlet__head-actions">
                                    
                                    
              

                                    <div class="dropdown dropdown-inline">
                                       <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="la la-download"></i> Options
                                       </button>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <ul class="kt-nav">
                                             



                                             <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">{{ __('product.Choose an option') }}</span>
                                             </li>
                                             <li class="kt-nav__item" id="productdetails_list_print">
                                                <span href="#" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-print"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.Print') }}</span>
                                                </span>
                                             </li>
                                             <li class="kt-nav__item" id="productdetails_list_copy">
                                                <span class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-copy"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.Copy') }}</span>
                                                </span>
                                             </li>
                                             <li class="kt-nav__item" id="productdetails_list_csv">
                                                <a href="#" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.CSV') }}</span>
                                                </a>
                                             </li>
                                             <li class="kt-nav__item" id="productdetails_list_pdf">
                                                <span class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                   <span class="kt-nav__link-text">{{ __('product.PDF') }}</span>
                                                </span>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                    
                                         
                                           

                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="kt-portlet__body">
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="maindetails_list">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Asset Name</th>
            <th>Asset ID</th>
            <th>Asset Tag</th>
            <th>Expiry Date</th>
            <th>Expiry Status</th>
            

            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>


  @foreach($parts as $part)
<tr >
   <td >{{$i}}</td>
   <td   style="cursor: pointer;"  class="viewchilden">{{ $part->asset_name  }}</td>
      <td   style="cursor: pointer;"  class="viewchilden">{{ $part->id  }}</td>
      <td   style="cursor: pointer;"  class="viewchilden">{{ $part->tag  }}</td>
      <td   style="cursor: pointer;"  class="viewchilden">{{ $part->part_date  }}</td>


 <td   style="cursor: pointer;"  class="viewchilden">
      @if($part->part_date >=  Carbon\Carbon::today())
      <span class="badge badge-light-primary text-success ">Active</span>
@else
<span class="badge badge-light-primary text-danger ">Expired</span>
     </td>
@endif



         <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="{{url('/')}}/partsupdate?id={{$part->pid}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >Update</span>
                        </span></li></a>
                       
                       </ul></div></div></span></td>
</tr>
 <?php $i++; ?>
    @endforeach

 <?php $i++; ?>
   

    
          
              


    </tbody>
</table>
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
<script src="{{url('/')}}/resources/js/boq/boq.js" type="text/javascript"></script>
<script type="text/javascript">

   $(document).ready(function() {

      var maindetails_list_table = $('#maindetails_list').DataTable({
        processing: true,
         serverSide: false,
         pagingType: "full_numbers",
          scrollX: true,
         dom: 'Blfrtip',
         lengthMenu: [
               [10, 25, 50, -1],
               [10, 25, 50, "All"]
         ],
       
      })


$("#productdetails_list_print").on("click", function() {
   
    maindetails_list_table.button('.buttons-print').trigger();
});


$("#productdetails_list_copy").on("click", function() {
    maindetails_list_table.button('.buttons-copy').trigger();
});

$("#productdetails_list_csv").on("click", function() {
    maindetails_list_table.button('.buttons-csv').trigger();
});

$("#productdetails_list_pdf").on("click", function() {
    maindetails_list_table.button('.buttons-pdf').trigger();
});


      
      });



</script>
@endsection

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
                                Asset Master - Group
                              </h3>
                           </div>
                           <div class="kt-portlet__head-toolbar">
                              <div class="kt-portlet__head-wrapper">
                                 <div class="kt-portlet__head-actions">
                                    
                                    
                 <!--   <a href="{{url('/')}}/asset_download" class="btn btn-brand btn-elevate btn-icon-sm" style="width: 176px;">
                                      
                                       Templete Download
                                    </a>&nbsp;
                                     <a href="{{url('/')}}/exportassetdata" class="btn btn-brand btn-elevate btn-icon-sm" style="width: 176px;">
                                      Import Data
                                    </a>&nbsp; -->

                                   
                                    
                                         
                                           

                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="kt-portlet__body">
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="assetgroupdetails_list">
    <thead>
       <tr>
            <th>S.No</th>
            <th>Asset Name</th>
            <th>Asset ID</th>
            <th>Tag ID</th>
            <th>Group</th>
            <th>Category</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Warehouse</th>
            <th>Store</th>
            <th>Unit</th>
            <th>Qty</th>
            <th>Availability Status</th>
            <th>O&M Status</th>
          
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>


       @foreach($group as $asset)
<tr >
   <td >{{$i}}</td>
   <td   style="cursor: pointer;"  class="viewchilden">{{ $asset->asset_name  }}</td>
      <td   style="cursor: pointer;"  class="viewchilden">{{ $asset->asset_code  }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->tag }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->groupname }}</td>
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->categoryname }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->typename }}</td>
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->brand_name }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->warehouse_name }}</td>
         <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->store_name }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->unit_name }}</td>
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->quantity }}</td>
       <td  style="cursor: pointer;"  class="viewchilden">
         <?php
        if($asset->availability_status==1)
            { 
            ?>
            <span style="color:green">Active</span>
            <?php
            }
            else
            {
            ?>
            <span style="color: red">Inactive</span> 
            <?php
            }
            ?>
       </td>
        <td  style="cursor: pointer;"  class="viewchilden">{{ $asset->om_status }}</td>
      
          
</tr>
 <?php $i++; ?>
    @endforeach

    
          
              


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

      var assetgroupdetails_list_table = $('#assetgroupdetails_list').DataTable({
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




      
      });



</script>
@endsection

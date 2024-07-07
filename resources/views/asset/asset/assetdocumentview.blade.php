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
                                Assets Documents
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
<table class="table table-striped table-hover table-checkable dataTable no-footer" id="assetdocuments">
    <thead>
        <tr>
            <th>S.No</th>
           
            <th>Document Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php $i=1; ?>

 
     @foreach ($img as $key => $value) 
      <tr>
<td>{{$key+1}}</td>
         <td  style="cursor: pointer;"  class="viewchilden">{{$value}}</td>
          <td><span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="{{url('/')}}/assetdocdownload?id={{$value}}" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-background"></i>
                        <span class="kt-nav__link-text" data-id="" >Download</span>
                        </span></li></a>
                         
                        
                       </ul></div></div></span></td>
</tr >
  @endforeach

  <!--  <td >{{$key}}</td>
   
     
         <td  style="cursor: pointer;"  class="viewchilden">
                     
         </td>

        
</tr> -->


    
          
              


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

      var assetdocuments_table = $('#assetdocuments').DataTable({
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


<html>
  <head>
    <?php
         foreach ($branchsettings as $key => $value) {
         $header=$value->pdfheader;
         $footer=$value->pdffooter;
         }
         ?>
   <style>
     @page { margin: 180px 50px; }
     #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px;  text-align: center; }
     #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; text-align: center; }
      }
   </style>
  <body>
   <div id="header">
     <!-- <h1>PDF</h1> -->
       <img src="{{ asset($header) }}"  height="150" width="1250"  class="img-thumboli" />

   </div>
   <div id="footer">
       <img src="{{ asset($footer) }}"  height="150" width="1250"  class="img-thumboli" />
   </div>
   <div id="content">
<?php 
foreach ($route as $key => $value) {
  
$route_id=$value->id;
$routename=$value->routename;
$startpalce=$value->startpalce;
$endplace=$value->endplace;
$totalkm=$value->totalkm;
}?>
<table>
  <tr>
    <td>{{ __('salesman.Route Name') }}:{{$routename}}</td>
    <td>{{ __('salesman.Start Place') }}:{{$startpalce}}</td>

  </tr>
  <br><br>
  <br><br>
  <br><br>
   <tr>
    <td>{{ __('salesman.End Place') }}:{{$endplace}}</td>
    <td>{{ __('salesman.Total KM') }}:{{$totalkm}}</td>
    
  </tr>
</table>
   </div>
 </body>
 </html>

<?php
namespace App\Http\Controllers\crm;
use Illuminate\Http\Request;
class DownloadsController extends Controller
{

    public function download($path,$file) {
        $file_name = $path.'/'.$file;
        $file_path = public_path($file_name);
    return response()->download($file_path);
  }


public function download1($path,$uid,$file) {
        $file_name = $path.'/'.$uid.'/'.$file;
        $file_path = public_path($file_name);
    return response()->download($file_path);
  }
public function ccdownload (Request $request)
    {
        if(ob_get_length() > 0) {
        ob_end_clean(); 
    }
        $customer_id =$request->id;
        $file =$request->file;
        $file_path = public_path('custdocumentInfoData/'.$customer_id.'/'.$file);
        //dd($file_path);
         return response()->download($file_path);
      redirect()->back(); 
 }
public function ssdownload (Request $request)
    {
        if(ob_get_length() > 0) {
        ob_end_clean(); 
    }
        $supplier_id =$request->id;
        $file =$request->file;
        $file_path = public_path('supdocumentInfoData/'.$supplier_id.'/'.$file);
         return response()->download($file_path);
      redirect()->back(); 
 }

 public function vvdownload (Request $request)
    {
        if(ob_get_length() > 0) {
        ob_end_clean(); 
    }
        $vendor_id =$request->id;
        $file =$request->file;
        $file_path = public_path('vendordocumentInfoData/'.$vendor_id.'/'.$file);
         return response()->download($file_path);
      redirect()->back(); 
 }


}

<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use View;
use Yajra\DataTables\DataTables;
use App\settings\BranchSettingsModel;
use App\settings\SealModel;
use Session;
class SealController extends Controller
{
    public function seal()
    {
           $branch=Session::get('branch');
          $seals = DB::table('qsettings_seal')->select('*')->where('branch', $branch)->get();
         return view('settings.seal.index',compact('branch', 'seals'));

    }
     public function sealsubmit(Request $request)
    {
        // dd($request);
        $branch = $request->branch;
        $data_variant = [
            'seal' => $request->fileData,
            'branch' => $branch
            
        ];
        $seal = SealModel::updateOrCreate(['branch' => $branch],$data_variant);
    
       
        return response()->json($seal);
       
    }
    public function sealupload(Request $request)
    {

    $path = public_path('seal');
   
     if($request->hasfile('filenames'))

         {

            foreach($request->file('filenames') as $file)

            {
                $name=$file->getClientOriginalName();
  
                //Storage::putFile('userInfoData', $name);
                $file->move($path, $name);  
                //move_uploaded_file($name, public_path('userInfoData').'/'.$request->UniqueID);   
                   
                $data[] = $name;  

            }

         }
        return back()->with('success', 'Data Your files has been successfully added');

    }
}
?>
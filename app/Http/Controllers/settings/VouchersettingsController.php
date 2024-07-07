<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use View;
use Yajra\DataTables\DataTables;
use App\settings\BranchSettingsModel;
use App\settings\VouchersettingsModel;

use Session;
class VouchersettingsController extends Controller
{
	public function voucehersettings(Request $request)
    {
           $branch=Session::get('branch');

    	if ($request->ajax()) {

           $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
           $subentrytypestable= $subtable.'entrytypes';

            $query  = DB::table('qsettings_voucher')->leftjoin($subentrytypestable,$subentrytypestable.'.id','=','qsettings_voucher.entry_types')->select('qsettings_voucher.*',$subentrytypestable.'.name')
                ->orderby('qsettings_voucher.id', 'desc');
            $query->where('qsettings_voucher.del_flag', 1)->where('qsettings_voucher.branch',$branch);
            $data = $query->get(); 
            $count_filter = $query->count();
            $count_total = VouchersettingsModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    	 return view('settings.voucher.listing');
    }
	public function vouchersettings_add()
	{
           $branch=Session::get('branch');

           $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
           $subentrytypestable= $subtable.'entrytypes'; //Take id,name for ledger dropdown
           $entrytypes = DB::table($subentrytypestable)->select('id','name')->get();
            
    	 return view('settings.voucher.add',compact('branch','entrytypes'));

	}
   public function vouchersettingssubmit(Request $request)
   {
           $branch=Session::get('branch');

     $postID = $request->info_id;
     $data = [
                'voucher_name' => $request->vouchername,
                'prefix' =>  $request->prefix,      
                'entry_types' =>$request->entrytypes,
                'financeposting' => $request->financeposting,
                'branch'    => $branch,
                'startingno' => $request->startingno        
                 ];
               
        $voucher = VouchersettingsModel::updateOrCreate(['id' => $postID], $data);
        $voucher_id = $voucher->id;
        return $voucher_id;
   }
   
   public function settingsedit_voucher(Request $request)
    {
        $id = $request->id;
           $branch=Session::get('branch');

           $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
           $subentrytypestable= $subtable.'entrytypes'; //Take id,name for ledger dropdown
           $entrytypes = DB::table($subentrytypestable)->select('id','name')->get();
            
            $voucher = DB::table('qsettings_voucher')->where('id',$id)->get();

         return view('settings.voucher.edit',compact('branch','entrytypes','voucher'));

    }
    public function delete(Request $request)
    {
        $id = $request->id;

        $data1 = [          
                'del_flag' => 0,          
                        ]; 
        DB::table('qsettings_voucher')->where('id',$id)->update($data1);
    }
   

}
?>
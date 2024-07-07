<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use View;
use Yajra\DataTables\DataTables;
use App\settings\BranchSettingsModel;
use App\settings\WalletModel;
use App\settings\WalletTransactionModel;

use Session;
class WalletController extends Controller
{
	public function walletaccount(Request $request)
    {
           $branch=Session::get('branch');
           
           // echo $subentrytypestable.'id';

    	if ($request->ajax()) {
            
            $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
           $subentrytypestable= $subtable.'ledgers';

            $query  = DB::table('qsettings_wallet')->leftjoin($subentrytypestable,$subentrytypestable.'.id','=','qsettings_wallet.ledger')->select('qsettings_wallet.*',$subentrytypestable.'.name as ledgername')
                ->orderby('qsettings_wallet.id', 'desc');
            $query->where('qsettings_wallet.del_flag', 1)->where('qsettings_wallet.branch',$branch);
            $data = $query->get(); 
            $count_filter = $query->count();
            $count_total = WalletModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    	 return view('settings.wallet.listing');
    }
    
    public function walletaccount_add()
    {
           $branch=Session::get('branch');

           $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
           $subentrytypestable= $subtable.'ledgers'; //Take id,name for ledger dropdown
           
           $ledger = DB::table($subentrytypestable)->select('id','name')->get();
            
         return view('settings.wallet.add',compact('branch','ledger'));

    }
    public function walletaccountsubmit(Request $request)
   {
           $branch=Session::get('branch');

     $postID = $request->info_id;
     $data = [
                'name' => $request->accountname,
                'ledger' =>  $request->ledger,      
                'branch'    => $branch,       
                 ];
               
        $wallet = WalletModel::updateOrCreate(['id' => $postID], $data);
        $wallet_id = $wallet->id;
        return $wallet_id;
   }
   
   public function edit_wallet(Request $request)
    {
        $id = $request->id;
           $branch=Session::get('branch');

           $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
           $subentrytypestable= $subtable.'ledgers'; //Take id,name for ledger dropdown
           $ledger = DB::table($subentrytypestable)->select('id','name')->get();
            
            $wallet = DB::table('qsettings_wallet')->where('id',$id)->get();

         return view('settings.wallet.edit',compact('branch','ledger','wallet'));

    }
    public function delete(Request $request)
    {
        $id = $request->id;

        $data1 = [          
                'del_flag' => 0,          
                        ]; 
        DB::table('qsettings_wallet')->where('id',$id)->update($data1);
    }
    
    public function listing(Request $request)
    {
           $branch=Session::get('branch');

        if ($request->ajax()) {

            $query  = DB::table('qsettings_wallettransactions')->leftjoin('qsettings_wallet','qsettings_wallet.id','=','qsettings_wallettransactions.account')->select('qsettings_wallettransactions.*','qsettings_wallet.name')
                ->orderby('qsettings_wallettransactions.id', 'desc');
            $query->where('qsettings_wallettransactions.del_flag', 1)->where('qsettings_wallettransactions.branch',$branch);
            $data = $query->get(); 
            $count_filter = $query->count();
            $count_total = WalletTransactionModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
         return view('settings.wallet.walletlisting');
    }
     public function add()
    {
           $branch=Session::get('branch');
        $wallet = DB::table('qsettings_wallet')->select('id','name')->where('del_flag',1)->get();
            
         return view('settings.wallet.walletadd',compact('branch','wallet'));

    }
    
    public function submit(Request $request)
   {
           $branch=Session::get('branch');

     $postID = $request->info_id;
     $data = [
                'date' => $request->date,
                'account' => $request->accountname, 
                'drcr' =>$request->drcr,
                'amounts' =>$request->amounts,
                'notes' =>$request->notes,    
                'branch'    => $branch,       
                 ];
               
        $wallet = WalletTransactionModel::updateOrCreate(['id' => $postID], $data);
        $wallet_id = $wallet->id;
        return $wallet_id;
   }
    public function edit(Request $request)
    {
        $id = $request->id;

           $branch=Session::get('branch');
        $wallet = DB::table('qsettings_wallet')->select('id','name')->where('del_flag',1)->get();
        $wallettr = DB::table('qsettings_wallettransactions')->select('*')->where('id',$id)->get();

            
         return view('settings.wallet.walletedit',compact('branch','wallet','wallettr'));

    }
    
     public function deletewallet(Request $request)
    {
        $id = $request->id;

        $data1 = [          
                'del_flag' => 0,          
                        ]; 
        DB::table('qsettings_wallettransactions')->where('id',$id)->update($data1);
    }
}
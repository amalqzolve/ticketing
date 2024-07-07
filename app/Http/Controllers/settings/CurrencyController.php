<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\settings\CurrencyModel;
use Session;
class CurrencyController extends Controller
{
    //
    public function list(Request $request)
    {
           $branch=Session::get('branch');

    	if ($request->ajax()) {
            $query = CurrencyModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = CurrencyModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    	return view('settings.currency.listing');
	}
	public function add(Request $request)
    {
           $branch=Session::get('branch');

    	return view('settings.currency.add',compact('branch'));
	}
    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $query = CurrencyModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = CurrencyModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('settings.currency.trashlisting');
    }
    public function submit(Request $request)
    {
        // dd($request);
        $branch = $request->branch;
        $postID = $request->info_id;
        $defaultcount = 0;
               
     
            $check = $this->check_exists($request->currency_name,'currency_name','qpurchase_currency');

            if($check<1)
            {

if($request->checkedValue == "true")
{
    $value = 1;
    DB::table('qpurchase_currency')->where('branch',$branch)->update(array('currency_default'=>0));

}
else
{
    $value = 0;
}


                $data = [
                        'currency_name' => $request->currency_name,        
                        'value' =>$request->value,        
                        'symbol' =>$request->symbol, 
                        'note' =>$request->notes, 
                        'currency_default' =>$value,
                        'branch' => $branch    

                         ];
                       
                $purchase = CurrencyModel::updateOrCreate(['id' => $postID], $data);
                return 2;
            }
            else
            {
                return 3;
            }
           
        }
    
    public function edit(Request $request)
    {
           $branch=Session::get('branch');

        $id = $request->id;
        $data = CurrencyModel::where('id',$id)->get();
        return view ('settings.currency.edit',compact('data','branch'));

    }
    public function currencyview(Request $request)
    {
        $id = $request->id;
        $data = CurrencyModel::where('id',$id)->get();
        return view ('settings.currency.view',compact('data'));
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $query = DB::table('qpurchase_purchase')->select('currency')->where('currency',$id)->where('del_flag',1)->get();
        $query1 = DB::table('qpurchase_quotation')->select('currency')->where('currency',$id)->where('del_flag',1)->get();
        $query2 = DB::table('qsales_purchasereturn')->select('currency')->where('currency',$id)->where('del_flag',1)->get();
        $query3 = DB::table('qsales_salesreturn')->select('currency')->where('currency',$id)->where('del_flag',1)->get();

        $no  = $query->count();
        $no1 = $query1->count();
        $no2 = $query2->count();
        $no3 = $query3->count();

        if($no > 0 || $no1 > 0 || $no2 > 0 || $no3 > 0)
        {
            return '1';
        }
        else
        {

            CurrencyModel::where('id', $id)->update(['del_flag' => 0]);
            return 'true';
        }

    }
    public function restore(Request $request)
    {
        $id = $request->id;
        CurrencyModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        CurrencyModel::where('id', $id)->delete();
        return 'true';
    }
    public function check_exists($value,$field,$table)
     {
           $branch=Session::get('branch');

        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->where('branch',$branch)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
    
}

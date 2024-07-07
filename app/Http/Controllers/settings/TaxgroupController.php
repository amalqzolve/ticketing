<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\settings\TaxgroupModel;
use App\settings\TaxgrouptaxModel;
use Session;
class TaxgroupController extends Controller
{
    public function list(Request $request)
    {
           $branch=Session::get('branch');

    	if ($request->ajax()) {
            $query = TaxgroupModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = TaxgroupModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
    	return view('settings.taxgroup.listing');
	}
	public function add(Request $request)
    {
           $branch=Session::get('branch');

    	$taxlist = DB::table('qpurchase_tax')->select('id','taxname','tax_percentage')->where('del_flag',1)->where('branch',$branch)->get();
    	return view('settings.taxgroup.add',compact('taxlist','branch'));
	}
    public function trash(Request $request)
    {
           $branch=Session::get('branch');
        
        if ($request->ajax()) {
            $query = TaxgroupModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = TaxgroupModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('settings.taxgroup.trashlisting');
    }
    public function submit(Request $request)
    {
       
        $branch = $request->branch;
        $postID = $request->info_id;
        // $check = $this->check_exists($request->taxgroup_name,'taxgroup_name','qpurchase_taxgroup');
        // if($check<1)
        // {
       $total2 = 0;
        $total1 = array();
        $new_total = 0;
        
         for ($i = 0; $i < count($request->taxes); $i++) 
         {
            $sum = DB::table('qpurchase_tax')->select('tax_percentage')->where('id',$request->taxes[$i])->get();

            $new_total += (int)$sum[0]->tax_percentage;
            // array_push($total1, $sum);
            
         }
    
if($request->checkedValue == "true")
{
    $value = 1;
    DB::table('qpurchase_taxgroup')->where('branch',$branch)->update(array('default_tax'=>0));

}
else
{
    $value = 0;
}
        $data = [
                'taxgroup_name' => $request->taxgroup_name,
                'total' =>  $new_total,      
                'description' =>$request->description,
                'default_tax' => $value,
                'branch'    => $branch        
                 ];
               
        $taxgroup = TaxgroupModel::updateOrCreate(['id' => $postID], $data);
        $taxgroup_id = $taxgroup->id;
        DB::table('qpurchase_taxgroup_taxes')->where('taxgroupid',$taxgroup_id)->delete();
         for ($i = 0; $i < count($request->taxes); $i++) 
         {
            $data1 = [
                'taxgroupid' =>$taxgroup_id,
                'taxes' =>  $request->taxes[$i],
                'branch' => $branch          
                 ];
            $taxgroup = TaxgrouptaxModel::Create($data1);
         }
               
        

                return 'true';
        // }
        // else
        // {
        //     return 'false';
        // }
    }
    public function edit(Request $request)
    {
           $branch=Session::get('branch');

        $id = $request->id;
        $data = TaxgroupModel::where('id',$id)->get();
       
        // $taxlist = DB::table('qpurchase_tax')->select('qpurchase_tax.id as id','qpurchase_tax.id as ids','taxname','tax_percentage','taxes') ->Join('qpurchase_taxgroup_taxes', 'qpurchase_tax.id', '=', 'qpurchase_taxgroup_taxes.taxes')->where('qpurchase_tax.del_flag',1)->where('qpurchase_tax.branch',$branch)->get();
        $taxlist = DB::table('qpurchase_tax')->select('id','taxname','tax_percentage')->where('del_flag',1)->where('branch',$branch)->get();
        $cutaxlist = DB::table('qpurchase_taxgroup_taxes')->select('qpurchase_tax.taxname','qpurchase_tax.id')->join('qpurchase_tax','qpurchase_taxgroup_taxes.taxes', '=','qpurchase_tax.id')->where('qpurchase_taxgroup_taxes.taxgroupid',$id)->get();

         
      
        return view ('settings.taxgroup.edit',compact('data','taxlist','branch','cutaxlist'));

    }

    public function taxgroupview(Request $request)
    {
        $id = $request->id;
        $data = TaxgroupModel::where('id',$id)->get();
        // dd($data);
        $taxlist = DB::table('qpurchase_tax')->select('id','taxname','tax_percentage')->where('del_flag',1)->get();
        return view ('settings.taxgroup.view',compact('data','taxlist'));

    }

    public function delete(Request $request)
    {
        $id = $request->id;
/*
        $query = DB::table('qsales_purchasereturn_products')->select('tax_group')->where('tax_group',$id)->where('del_flag',1)->get();
        $query1 = DB::table('qsales_salesreturn_products')->select('tax_group')->where('tax_group',$id)->where('del_flag',1)->get();
        $query2 = DB::table('qsales_invoice_products')->select('taxgroup')->where('taxgroup',$id)->where('del_flag',1)->get();
        $query3 = DB::table('qsales_convert_delivery_products')->select('taxgroup')->where('taxgroup',$id)->where('del_flag',1)->get();
        $query4 = DB::table('qsales_convert_invoice_products')->select('taxgroup')->where('taxgroup',$id)->where('del_flag',1)->get();
        $query5 = DB::table('qpurchase_products')->select('tax_group')->where('tax_group',$id)->where('del_flag',1)->get();
        $query6 = DB::table('qpurchase_quotation_products')->select('tax_group')->where('tax_group',$id)->where('del_flag',1)->get();

        $no  = $query->count();
        $no1 = $query1->count();
        $no2 = $query2->count();
        $no3 = $query3->count();
        $no4 = $query4->count();
        $no5 = $query5->count();
        $no6 = $query6->count();

        if($no > 0 || $no1 > 0 || $no2 > 0 || $no3 > 0 || $no4 > 0 || $no5 > 0 || $no6 > 0)
        {
            return '1';
        }
        else
        {

       
        }*/

        TaxgroupModel::where('id', $id)->update(['del_flag' => 0]);
        return 'true';

    }
    public function restore(Request $request)
    {
        $id = $request->id;
        TaxgroupModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        TaxgroupModel::where('id', $id)->delete();
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

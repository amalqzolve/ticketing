<?php

namespace App\Http\Controllers\costing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Costs;
use App\crm\CustomerModel;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('costing.dashboard.index');
    }



    public function costmain()
    {
        $costs = Costs::whereNull('parent_id')->leftjoin('qprojects_projects', 'costs.projectname', '=', 'qprojects_projects.id')->leftjoin('qcrm_customer_details', 'costs.client', '=', 'qcrm_customer_details.id')->select('*', 'qprojects_projects.projectname as projectname', 'costs.description as description', 'costs.id as id', 'qcrm_customer_details.cust_name', 'qprojects_projects.ponumber')->get();



        $projects = DB::table('qprojects_projects')->select('id', 'projectname')->where('del_flag', 1)->get();

        return view('costing.dashboard.main', compact('costs', 'projects'));
    }
    public function viewchildencost(Request $request)
    {
        // $parent = $request->id;
        // if ($request->ajax()) {
        //     $data = Boq::where('parent_id', $parent)->orderBy('id', 'ASC')->get();
        //     $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
        //         return $row->id;
        //     });
        //     return $dtTble->make(true);
        // } else {
        //     if ($parent != '') {
        //         $assent_id = Boq::where('id', $parent)->value('parent_id');
        //         $parent_name = Boq::where('id', $parent)->value('category_name');
        //         return view('costing.costing.listChild', compact('assent_id', 'parent_name', 'parent'));
        //     } else
        //         return redirect()->route('cost-estimation', null);
        // }
    }


    public function cost_main_edit(Request $request)
    {
        $main = $request->id;

        $costs = DB::table('costs')->select('*')->where('id', $main)->get();


        $projects = DB::table('costs')->leftjoin('qprojects_projects', 'costs.projectname', '=', 'qprojects_projects.id')->select('qprojects_projects.id', 'qprojects_projects.projectname')->where('costs.id', $main)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        return view('costing.dashboard.edit', compact('costs', 'projects', 'customers'));
    }
    public function mainestimationupdate(Request $request)
    {

        Costs::where('id', $request->id)
            ->update(['category_name' => $request->category_name,  'projectname' => $request->projectname, 'description' => $request->description, 'client' => $request->client]);
        return 'true';
    }
    public function costaddparent(Request $request)
    {

        $parent = $request->ids;
        // $parent_name=Costs::where('id',$parent)->value('category_name');
        $parent_name = Costs::where('boq_id', $parent)->value('category_name');



        $branch = Session::get('branch');
        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        return view('costing.dashboard.addparent', compact('productlist', 'unitlist', 'parent', 'parent_name'));
    }
    public function costadd(Request $request)
    {

        $branch = Session::get('branch');
        $parent = $request->ids;
        $parent_name = Costs::where('boq_id', $parent)->value('category_name');
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('costing.dashboard.add', compact('vatlist', 'unitlist', 'parent', 'parent_name'));
    }
    public function innercostsubmit(Request $request)
    {

        $branch = Session::get('branch');
        $parent_child = $request->parent;
        for ($i = 0; $i < count($request->head_name); $i++) {
            $query = DB::table('cost_products')->select('product_name', 'boq_product_id')->where('product_name', $request->head_name[$i])->where('del_flag', 1)->get();

            if ($query->count() > 0) {
                foreach ($query as $key => $value) {
                    $boq_product_id = $value->boq_product_id;
                }
            } else {
                $data = [
                    'product_name' => $request->head_name[$i],
                    'description' => $request->product_description[$i],
                    'product_type' => 2,
                    'branch' => $branch
                ];
                $head_product = DB::table('cost_products')->insert($data);
                $boq_product_id = DB::getPdo()->lastInsertId();
            }
            Log::info('insert.', ['id' => $boq_product_id]);
            $node = Costs::create([
                'category_name' => $request->head_name[$i],
                'unit' => $request->unit[$i],
                'quantity' => $request->quantity[$i],
                'rate' => $request->rate[$i],
                'discountamount' => $request->rdiscount[$i],
                'amount1' => $request->amount[$i],
                'vat_percentage' => $request->vat_percentage[$i],
                'vatamount' => $request->vatamount[$i],
                'totalamount' => $request->row_total[$i],
                'amount' => $request->row_total[$i],
                'description' => $request->product_description[$i],
                // 'parent_id'=> $parent_child,

            ]);
            Costs::where('id', $node->id)->update(['parent_id' => $parent_child]);
        }
        /*$child_id=$node->id;
$parent = Costs::findOrFail($parent_child);  
$node->appendToNode($parent)->save();
$result = Costs::ancestorsOf($child_id);
$pid='';
foreach ($result as  $value) {
$nodes = Costs::findOrFail($value->id);
if($nodes->isRoot()){
   // dd($value->id);
    $pid.= $value->id.'-'; 
    
}else{
     $result1 = $nodes->getSiblings()->count();
    $num_padded = sprintf("%02d", $result1);
    $pid.= $num_padded.'-';
}
}
$result2 = $node->getSiblings()->count()+1;
$num_padded1 = sprintf("%02d", $result2);
$pid.= $num_padded1;
 DB::table('costs')->where('id',$node->id)->update([ 'category_code' => $pid]);
                 }
$nodes = Costs::reversed()->get();*/
        /*$traverse = function ($categories, $prefix = '-&nbsp;<br>') use (&$traverse) {
foreach ($categories as $category) 
{
$parent_total = Costs::where('parent_id', '=', $category->parent_id)->sum('totalamount');
$parent_quantity = Costs::where('parent_id', '=', $category->parent_id)->sum('quantity');
$parent_amount = Costs::where('parent_id', '=', $category->parent_id)->sum('amount');
$parent_vatamount = Costs::where('parent_id', '=', $category->parent_id)->sum('vatamount');
$parent_totalamount = Costs::where('parent_id', '=', $category->parent_id)->sum('totalamount'); 
Costs::where('id', $category->parent_id)->update(['totalamount' => $parent_total]);
Costs::where('id', $category->parent_id)->update(['quantity' => $parent_quantity]);
Costs::where('id', $category->parent_id)->update(['amount' => $parent_amount]);
Costs::where('id', $category->parent_id)->update(['vatamount' => $parent_vatamount]);
Costs::where('id', $category->parent_id)->update(['totalamount' => $parent_totalamount]);
 
$traverse($category->children, $prefix.'~');
    }
};*/
        //$traverse($nodes);
        return 'true';
    }
    public function innercostsubmitgroup(Request $request)
    {
        $parent_child = $request->parent;
        $node = Costs::create([
            //  'category_name' =>$product_name,
            'category_name' => $request->productname,
            /* 'quantity' => $request->total_quantity,
                            'amount1' =>$request->total_amount,*/
            'description' => $request->description,
            /*   'vatamount' => $request->total_vat,
                            'totalamount' => $request->grandtotal,
                            'amount' => $request->grandtotal,*/
            'is_parent' => 1,
            // 'parent_id'=> $request->parent,

        ]);

        Costs::where('id', $node->id)->update(['boq_id' => $request->parent]);

        DB::table('costs')->where('id', $node->id)->update(['parent_id' => $request->parent]);
        /*
$child_id=$node->boq_id;
//$parent = Costs::findOrFail($parent_child); 


$parent =Costs::where('boq_id', $parent_child)->firstOrFail();


$node->appendToNode($parent)->save();
$result = Costs::ancestorsOf($child_id);
$pid='';
foreach ($result as  $value) {
//$nodes = Costs::findOrFail($value->id);
$nodes =Costs::where('boq_id', $value->boq_id)->firstOrFail();
if($nodes->isRoot()){
   // dd($value->id);
    $pid.= $value->id.'-'; 
    
}else{
     $result1 = $nodes->getSiblings()->count();
    $num_padded = sprintf("%02d", $result1);
    $pid.= $num_padded.'-';

}
}
$result2 = $node->getSiblings()->count()+1;
    $num_padded1 = sprintf("%02d", $result2);
    $pid.= $num_padded1;
DB::table('costs')->where('id',$node->id)->update([ 'category_code' => $pid]);
$nodes = Costs::reversed()->get();
$traverse = function ($categories, $prefix = '-&nbsp;<br>') use (&$traverse) {
foreach ($categories as $category) {
$parent_total = Costs::where('parent_id', '=', $category->parent_id)->sum('totalamount');
$parent_quantity = Costs::where('parent_id', '=', $category->parent_id)->sum('quantity');
$parent_amount = Costs::where('parent_id', '=', $category->parent_id)->sum('amount');
$parent_vatamount = Costs::where('parent_id', '=', $category->parent_id)->sum('vatamount');
$parent_totalamount = Costs::where('parent_id', '=', $category->parent_id)->sum('totalamount');     
Costs::where('id', $category->parent_id)->update(['totalamount' => $parent_total]);
Costs::where('id', $category->parent_id)->update(['quantity' => $parent_quantity]);
Costs::where('id', $category->parent_id)->update(['amount' => $parent_amount]);
Costs::where('id', $category->parent_id)->update(['vatamount' => $parent_vatamount]);
Costs::where('id', $category->parent_id)->update(['totalamount' => $parent_totalamount]);
        $traverse($category->children, $prefix.'~');
    }
};
$traverse($nodes);*/
        return 'true';
    }
}

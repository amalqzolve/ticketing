<?php

namespace App\Http\Controllers\costing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Costs;
use App\costing\CostmatrixModel;
use DataTables;
use App\costing\CostmatrixProductModel;

class CostmatrixController extends Controller
{
    public function costmatrix(Request $request)
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $query  = DB::table('costmatrix')->select('costmatrix.*')
                ->orderby('id', 'desc');
            $query->where('costmatrix.del_flag', 1);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return view('costing.costmatrix.list');
    }
    public function Add_costmatrix(Request $request)
    {
        $branch = Session::get('branch');
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('costing.costmatrix.add', compact('vatlist', 'unitlist'));
    }
    public function costmatrixsubmit(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        if (isset($id) && !empty($id))
            $check = $this->check_exists_edit($id, $request->costmatrixname, 'costmatrixname', 'costmatrix');
        else
            $check = $this->check_exists($request->costmatrixname, 'costmatrixname', 'costmatrix');

        if ($check < 1) {
            $data               = [
                'costmatrixname' => $request->costmatrixname,
                'description' => $request->description,
                'grandtotalamount' => $request->grandtotalamount,
                'branch'     => $branch
            ];

            $costmatrix          = CostmatrixModel::updateOrCreate(['id' => $id], $data);
            $costmatrixid = $costmatrix->id;

            for ($i = 0; $i < count($request->head_name); $i++) {

                $data = [
                    'costmatrixid' => $costmatrixid,
                    'product_name' => $request->head_name[$i],
                    'description' => $request->product_description[$i],
                    'unit' => $request->unit[$i],
                    'quantity' => $request->quantity[$i],
                    'rate' => $request->rate[$i],
                    'amount' => $request->amount[$i],
                    'branch' => $branch
                ];
                $head_product = DB::table('costmatrix_products')->insert($data);
            }
            return 'true';
        } else {
            return 'false';
        }
    }

    public function addcostestimation(Request $request)
    {
        $branch = Session::get('branch');
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('costing.estimation.add', compact('vatlist', 'unitlist'));
    }
    public function searcheads(Request $request)
    {
        return CostmatrixProductModel::where('product_name', 'LIKE', '%' . $request->q . '%')->get();
    }
    public function check_exists($value, $field, $table)
    {
        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->get();

        return $query->count();
    }
    public function check_exists_edit($id, $value, $field, $table)
    {
        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->whereNotIn('id', [$id])->get();

        return $query->count();
    }
    public function delete_costmatrix(Request $request)
    {
        $id = $request->id;
        CostmatrixModel::where('id', $id)->update(['del_flag' => 0]);
        CostmatrixProductModel::where('costmatrixid', $id)->update(['del_flag' => 0]);
        return 'true';
    }

    public function costmatrixedit(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        $Costmatrix = CostmatrixModel::select('*')->where('id', $id)->get();
        $CostmatrixProduct = CostmatrixProductModel::select('*')->where('costmatrixid', $id)->get();
        return view('costing.costmatrix.edit', compact('vatlist', 'unitlist', 'Costmatrix', 'CostmatrixProduct'));
    }
    public function costmatrixupdate(Request $request)
    {
        $branch = Session::get('branch');
        $id = $request->id;
        if (isset($id) && !empty($id))
            $check = $this->check_exists_edit($id, $request->costmatrixname, 'costmatrixname', 'costmatrix');
        else
            $check = $this->check_exists($request->costmatrixname, 'costmatrixname', 'costmatrix');

        if ($check < 1) {
            $data               = [
                'costmatrixname' => $request->costmatrixname,
                'description' => $request->description,
                'grandtotalamount' => $request->grandtotalamount,
                'branch'     => $branch
            ];

            $costmatrix          = CostmatrixModel::updateOrCreate(['id' => $id], $data);
            $costmatrixid = $costmatrix->id;
            CostmatrixProductModel::where('costmatrixid', $id)->delete();
            for ($i = 0; $i < count($request->head_name); $i++) {
                $data = [
                    'costmatrixid' => $costmatrixid,
                    'product_name' => $request->head_name[$i],
                    'description' => $request->product_description[$i],
                    'unit' => $request->unit[$i],
                    'quantity' => $request->quantity[$i],
                    'rate' => $request->rate[$i],
                    'amount' => $request->amount[$i],
                    'branch' => $branch
                ];
                $head_product = DB::table('costmatrix_products')->insert($data);
            }
            return 'true';
        } else {
            return 'false';
        }
    }

    public function costmatrix_estimation(Request $request)
    {
        if ($request->ajax()) {
            $query  = DB::table('costmatrix')->select('costmatrix.*')
                ->orderby('id', 'desc');
            $query->where('costmatrix.del_flag', 1);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return NULL;
    }
    public function getproductCostmatrix(Request $request)
    {
        $id = $request->id;
        $data = DB::table('costmatrix_products')->select('*')->where('costmatrixid', $id)->get();

        $out = array(
            'status' => 1,
            'data' => $data
        );
        echo json_encode($out);
    }
}

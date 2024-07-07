<?php

namespace App\Http\Controllers\costing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Boq;
use App\costing\CostmatrixModel;
use App\costing\CostCategoryModel;

use App\costing\EstimationModel;
use App\costing\EstimationCategoryModel;
use DataTables;
use Auth;

class CostDescribeController extends Controller
{

    public function directCostEstimation(Request $request, $id)
    {
        if (!$request->ajax()) {
            $items =   $ifFind = Boq::select('boqs.id', 'boqs.category_name', 'boqs.ref', 'boqs.description', 'boqs.quantity', 'boqs.rate', 'boqs.amount', 'boqs.estimation_amount', 'boqs.total_amount')
                ->where('boqs.parent_id', $id)
                ->whereNull('boqs.is_parent')
                ->get();
            $parent_id = $id;
            return view('costing.describe.directEntry', compact('items', 'parent_id'));
        } else
            return NULL;
    }
    public function directCostEstimationSave(Request $request)
    {

        foreach ($request->head_id as $key => $value) {
            $ifFount = Boq::find($value);
            // echo $request->boq_id;
            if ($ifFount) {
                $inAr = array('rate' => $request->rate[$key], 'amount' => $request->amount[$key], 'total_amount' => $request->total_amount[$key]);
                $ifFount->update($inAr);
            }
        }
        $nodes = Boq::reversed()->get();
        // echo json_encode($nodes);
        $traverse = function ($categories, $prefix = '-&nbsp;<br>') use (&$traverse) {
            foreach ($categories as $category) {
                $amountTotal = Boq::where('parent_id', '=', $category->parent_id)->sum('amount');
                $totalAmountTotal = Boq::where('parent_id', '=', $category->parent_id)->sum('total_amount');

                Boq::where('id', $category->parent_id)->update(['amount' => $amountTotal, 'total_amount' => $totalAmountTotal]);
                $traverse($category->children, $prefix . '~');
            }
        };
        $traverse($nodes);
        echo json_encode(
            array(
                'status' => 1,
                'msg' => 'Success',
            )
        );
    }


    public function index(Request $request) //edit
    {
        if (!$request->ajax()) {
            $id = $request->id;
            $ifFind = Boq::select('boqs.id', 'qinventory_product_unit.unit_name', 'boqs.category_name', 'boqs.description', 'boqs.quantity', 'boqs.amount', 'boqs.rate', 'boqs.estimation_amount as totalamount', 'boqs.total_amount as grandtotal')->leftJoin('qinventory_product_unit', 'boqs.unit', '=', 'qinventory_product_unit.id')->where('boqs.id', $id)->first($id);
            if ($ifFind) {
                $branch = Session::get('branch');
                $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
                $data = $ifFind;
                $costMatrix = CostmatrixModel::where('del_flag', 1)->get();
                $costCat = CostCategoryModel::select('id', 'name', 'percentage')->orderby('id', 'desc')->where('del_flag', 1)->get();
                $esctimationData =  EstimationModel::select('estimation.*', 'costmatrix.costmatrixname')
                    ->leftJoin('costmatrix', 'estimation.costmatrx_id', '=', 'costmatrix.id')
                    ->orderBy('costmatrx_id', 'asc')
                    ->where('boq_id', $id)->with('category')->get();
                return view('costing.describe.edit', compact('costMatrix', 'costCat', 'data', 'unitlist', 'esctimationData'));
            }
        } else
            return NULL;
    }

    public function save(Request $request)
    {
        $branch = Session::get('branch');
        $currentUser = Auth::user()->id;
        $boqAdded = $request->boqAdded;
        EstimationModel::where('boq_id', $request->boq_id)->delete();
        EstimationCategoryModel::where('boq_id', $request->boq_id)->delete();
        if (is_array($boqAdded))
            foreach ($boqAdded as $key => $tableId) {
                // costmatrix items
                $costmatrx_product_id = 'costmatrx_product_id' . $tableId;
                $head_name = 'head_name' . $tableId;
                $product_description = 'product_description' . $tableId;
                $unit = 'unit' . $tableId;
                $quantity = 'quantity' . $tableId;
                $rate = 'rate' . $tableId;
                $amount = 'amount' . $tableId;
                $row_total = 'row_total' . $tableId;

                $costmatrx_product_id = $request->$costmatrx_product_id;
                $head_name = $request->$head_name;
                $product_description = $request->$product_description;
                $unit = $request->$unit;
                $quantity = $request->$quantity;
                $rate = $request->$rate;
                $amount = $request->$amount;
                $row_total = $request->$row_total;
                // costmatrix items
                // col items
                $currentColums = 'currentCat' . $tableId;
                $currentColums = $request->$currentColums; //get the col ref;
                // col items

                foreach ($costmatrx_product_id as $rowKey => $rows) {
                    $inData = array(
                        'boq_id' => $request->boq_id,
                        'costmatrx_id' => $tableId,
                        'costmatrx_product_id' => $costmatrx_product_id[$rowKey],
                        'head_name' => $head_name[$rowKey],
                        'product_description' => $product_description[$rowKey],
                        'unit' => $unit[$rowKey],
                        'quantity' => $quantity[$rowKey],
                        'rate' => $rate[$rowKey],
                        'amount' => $amount[$rowKey],
                        'row_total' => $row_total[$rowKey],
                        'branch' => $branch,
                        'created_by' => $currentUser
                    );
                    //save portion of rows
                    $postID = '';
                    $estimation = EstimationModel::updateOrCreate(['id' => $postID], $inData);

                    if (is_array($currentColums))
                        foreach ($currentColums as $columKey => $column) { //loop custom column
                            $columnNamePercenatage = 'percenatge' . $tableId . $column;
                            $columnNamePercenatageAmount = 'percenatge_amount' . $tableId . $column;

                            $columnValuePercenatage = $request->$columnNamePercenatage;
                            $columnValuePercenatageAmount = $request->$columnNamePercenatageAmount;
                            $inCat = array(
                                'estimation_id' => $estimation->id,
                                'boq_id' => $request->boq_id,
                                'cost_category_id' => $column,
                                'percenatge' => $columnValuePercenatage[$rowKey],
                                'amount' => $columnValuePercenatageAmount[$rowKey],
                            );
                            $postIDCat = '';
                            EstimationCategoryModel::updateOrCreate(['id' => $postIDCat], $inCat);
                            //save colum as row

                        }
                } //row loop
            } //table loop



        // echo json_encode($currentColums);

        $ifFount = Boq::find($request->boq_id);
        // echo $request->boq_id;
        if ($ifFount) {

            $inAr = array('estimation_amount' => $request->grandtotalamount, 'total_amount' => $request->grandFinaltotalamount);
            $ifFount->update($inAr);
            $nodes = Boq::reversed()->get();
            // echo json_encode($nodes);
            $traverse = function ($categories, $prefix = '-&nbsp;<br>') use (&$traverse) {
                foreach ($categories as $category) {
                    $parent_totalamount = Boq::where('parent_id', '=', $category->parent_id)->sum('estimation_amount');
                    $totalAmountTotal = Boq::where('parent_id', '=', $category->parent_id)->sum('total_amount');
                    Boq::where('id', $category->parent_id)->update(['estimation_amount' => $parent_totalamount, 'total_amount' => $totalAmountTotal]);
                    $traverse($category->children, $prefix . '~');
                }
            };
            $traverse($nodes);
        } else
            echo json_encode(122);

        $out = array(
            'status' => 1,
            'message' => 'success'
        );
        echo json_encode($out);
    }

    public function view(Request $request)
    {
        if (!$request->ajax()) {
            $id = $request->id;
            // $ifFind = Boq::select('boqs.id', 'qinventory_product_unit.unit_name', 'boqs.category_name', 'boqs.description', 'boqs.quantity', 'boqs.estimation_amount as totalamount')->leftJoin('qinventory_product_unit', 'boqs.unit', '=', 'qinventory_product_unit.id')->where('boqs.id', $id)->first($id);
            $ifFind = Boq::select('boqs.id', 'qinventory_product_unit.unit_name', 'boqs.category_name', 'boqs.description', 'boqs.quantity', 'boqs.amount', 'boqs.rate', 'boqs.estimation_amount as totalamount', 'boqs.total_amount as grandtotal')->leftJoin('qinventory_product_unit', 'boqs.unit', '=', 'qinventory_product_unit.id')->where('boqs.id', $id)->first($id);
            if ($ifFind) {
                $branch = Session::get('branch');
                $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
                $data = $ifFind;
                $costMatrix = CostmatrixModel::where('del_flag', 1)->get();
                $costCat = CostCategoryModel::select('id', 'name', 'percentage')->orderby('id', 'desc')->where('del_flag', 1)->get();
                $esctimationData =  EstimationModel::select('estimation.*', 'costmatrix.costmatrixname')
                    ->leftJoin('costmatrix', 'estimation.costmatrx_id', '=', 'costmatrix.id')
                    ->orderBy('costmatrx_id', 'asc')
                    ->where('boq_id', $id)->with('category')->get();
                $total = EstimationModel::select('costmatrx_id',  DB::raw("sum(row_total) as sum"))->orderBy('costmatrx_id', 'asc')->groupBy('costmatrx_id')->where('boq_id', $id)->get();

                return view('costing.describe.view', compact('costCat', 'data', 'unitlist', 'esctimationData', 'total'));
            }
        } else
            return NULL;
    }
}

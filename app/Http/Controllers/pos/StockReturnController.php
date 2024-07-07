<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\pos\StockReturnModel;
use DataTables;
use Auth;
use PDF;
use App\settings\BranchSettingsModel;

class StockReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function listing(Request $request)
    {
        $branch = Session::get('branch');
        $user_id = Auth::user()->name;
        if ($user_id == 'Qzolve') {
            if ($request->ajax()) {
                $query  = DB::table('qpos_stockreturn')->leftjoin('qpos_van', 'qpos_stockreturn.van', '=', 'qpos_van.id')->leftjoin('qcrm_salesman_details', 'qpos_stockreturn.receiver', '=', 'qcrm_salesman_details.id')
                    ->select('qpos_stockreturn.*', 'qpos_van.vanname', 'qcrm_salesman_details.name')
                    ->orderby('id', 'desc');
                $query->where('qpos_stockreturn.del_flag', 1)->where('qpos_stockreturn.branch', $branch);

                $data = $query->get();
                $count_filter = $query->count();
                $count_total = StockReturnModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                    return $row->id;
                })->rawColumns(['action'])->make(true);
            }
        } else {
            $van = DB::table('qpos_van')->select('id', 'vanname')->where('del_flag', 1)->where('username', $user_id)->get();
            foreach ($van as $van) {
                $vanid = $van->id;
            }
            if ($request->ajax()) {
                $query  = DB::table('qpos_stockreturn')->leftjoin('qpos_van', 'qpos_stockreturn.van', '=', 'qpos_van.id')->leftjoin('qcrm_salesman_details', 'qpos_stockreturn.receiver', '=', 'qcrm_salesman_details.id')
                    ->select('qpos_stockreturn.*', 'qpos_van.vanname', 'qcrm_salesman_details.name')
                    ->orderby('id', 'desc');
                $query->where('qpos_stockreturn.del_flag', 1)->where('qpos_stockreturn.branch', $branch)->where('qpos_stockreturn.van', $vanid);

                $data = $query->get();
                $count_filter = $query->count();
                $count_total = StockReturnModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                    return $row->id;
                })->rawColumns(['action'])->make(true);
            }
        }


        return view('pos.stockreturn.listing');
    }
    public function stockreturn()
    {
        $user_id = Auth::user()->name;
        if ($user_id == 'Qzolve') {
            $van = DB::table('qpos_van')->select('id', 'vanname')->where('del_flag', 1)->get();
            $salesmanlist = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->get();
            return view('pos.stockreturn.add', compact('van', 'salesmanlist', 'user_id'));
        } else {
            $van = DB::table('qpos_van')->select('id', 'vanname')->where('del_flag', 1)->where('username', $user_id)->get();
            foreach ($van as $vans) {
                $vanid = $vans->id;
            }
            $vanstock = DB::table('qpos_van_stock')->leftJoin('qinventory_products', 'qpos_van_stock.productid', '=', 'qinventory_products.product_id')->select('qpos_van_stock.*', 'qinventory_products.product_name')->where('qpos_van_stock.del_flag', 1)->where('qpos_van_stock.vanid', $vanid)->get();
            $salesmanlist = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->get();
            return view('pos.stockreturn.add', compact('van', 'salesmanlist', 'vanstock', 'user_id'));
        }
    }
    public function getvanname_details_pos(Request $request)
    {
        $id = $request->id;

        $data = DB::table('qpos_stocktransfer_products')->leftjoin('qinventory_products', 'qpos_stocktransfer_products.product', '=', 'qinventory_products.product_id')->select('qpos_stocktransfer_products.*', 'qinventory_products.product_name')->where('qpos_stocktransfer_products.van', $id)->get();


        return response()->json($data);
    }

    public function submit_stockreturn(Request $request)
    {

        $branch = Session::get('branch');
        $postID = $request->id;
        $data = [
            'van' => $request->van,
            'date' => $request->date,
            'notes' => $request->notes,
            'receiver' => $request->receiver,
            'returneditems' => $request->totalitems,
            'returnedquantity' => $request->totalquantity,
            'branch' => $branch
        ];

        $stockreturn = StockReturnModel::updateOrCreate(['id' => $postID], $data);
        $stockreturnid = $stockreturn->id;

        DB::table('qpos_stockreturn_products')->where('stockreturnid', $stockreturnid)->delete();

        for ($i = 0; $i < count($request->item_details_id); $i++) {
            $data = [
                'stockreturnid' => $stockreturnid,
                'van' =>  $request->van,
                'product' => $request->item_details_id[$i],
                'trquantity' => $request->trquantity[$i],

                'retquantity' => $request->retquantity[$i],
                'branch' => $branch
            ];

            // $quotation_product = CustomInvoiceproductModel::Create($data);
            $stockreturnproducts = DB::table('qpos_stockreturn_products')->insert($data);
        }
        $restock = 0;
        $restock1 = 0;
        $ostock = 0;
        $avstock = 0;
        $orstock = 0;
        $avquantity = 0;
        $r = 0;
        $i = 0;
        for ($i = 0; $i < count($request->item_details_id); $i++) {
            $ostock = DB::table('qinventory_products')->select('available_stock')->where('product_id', $request->item_details_id[$i])->get();

            foreach ($ostock as $ostock) {
                $orstock = $ostock->available_stock;
            }
            $restock = intval($orstock) + intval($request->retquantity[$i]);


            $data1 = [
                'available_stock' => $restock,
            ];
            DB::table('qinventory_products')->where('product_id', $request->item_details_id[$i])->update($data1);

            $avstock = DB::table('qpos_van_stock')->select('*')->where('productid', $request->item_details_id[$i])->where('vanid', $request->van)->get();
            foreach ($avstock as $avstock) {
                $avquantity = $avstock->available_quantity;
                $r = $avstock->return_quantity;
                $in = $avstock->invoiced_quantity;
            }
            $av = intval($avquantity) - intval($request->retquantity[$i]);

            $data2 = [
                'available_quantity' => $av,
                'return_quantity' =>  $r + $request->retquantity[$i]
            ];
            DB::table('qpos_van_stock')->where('productid', $request->item_details_id[$i])->where('vanid', $request->van)->update($data2);
        }



        return $data1;
    }

    public function getvanproductsreturn(Request $request)
    {
        $id = $request->vanname;

        $data = DB::table('qpos_van_stock')->leftJoin('qinventory_products', 'qpos_van_stock.productid', '=', 'qinventory_products.product_id')->select('qpos_van_stock.productid', 'qinventory_products.product_name', 'qpos_van_stock.*')->where('qpos_van_stock.del_flag', 1)->where('qpos_van_stock.vanid', $id)->get();


        return response()->json($data);
    }

    public function stockreturn_pdf(Request $request)
    {
        ini_set("pcre.backtrack_limit", "100000000000");
        $id = $request->id;
        $branch = Session::get('branch');


        $companysettings = BranchSettingsModel::where('branch', $branch)->get();


        $stockreturn   = DB::table('qpos_stockreturn')->leftjoin('qpos_van', 'qpos_stockreturn.van', '=', 'qpos_van.id')->select('qpos_stockreturn.*', 'qpos_van.vanname')->where('qpos_stockreturn.id', $id)->where('qpos_stockreturn.del_flag', 1)->where('qpos_stockreturn.branch', $branch)->get();
        $stockreturn_products   = DB::table('qpos_stockreturn_products')->leftjoin('qpos_van', 'qpos_stockreturn_products.van', '=', 'qpos_van.id')->leftjoin('qinventory_products', 'qpos_stockreturn_products.product', '=', 'qinventory_products.product_id')->select('qpos_stockreturn_products.*', 'qpos_van.vanname', 'qinventory_products.product_name')->where('qpos_stockreturn_products.stockreturnid', $id)->where('qpos_stockreturn_products.del_flag', 1)->where('qpos_stockreturn_products.branch', $branch)->get();

        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();


        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('pos.stockreturn.preview1', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stockreturn', 'stockreturn_products', 'salesmen'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('pos.stockreturn.preview2', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stockreturn', 'stockreturn_products', 'salesmen'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('pos.stockreturn.preview3', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stockreturn', 'stockreturn_products', 'salesmen'));
        } elseif (Session::get('preview') == 'preview4') {
            $pdf = PDF::loadView('pos.stockreturn.preview4', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stockreturn', 'stockreturn_products', 'salesmen'));
        } else {
            $pdf = PDF::loadView('pos.stockreturn.van_pdf', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stockreturn', 'stockreturn_products', 'salesmen'));
        }


        return $pdf->stream('stockreturn-#' . $id . '.pdf');
    }
}

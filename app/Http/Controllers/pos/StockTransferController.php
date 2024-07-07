<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\pos\StockTransferModel;
use App\pos\VanStockModel;
use DataTables;
use Auth;
use PDF;
use App\settings\BranchSettingsModel;

class StockTransferController extends Controller
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
                $query  = DB::table('qpos_stocktransfer')->leftjoin('qpos_van', 'qpos_stocktransfer.van', '=', 'qpos_van.id')
                    ->select('qpos_stocktransfer.*', 'qpos_van.vanname')
                    ->orderby('id', 'desc');
                $query->where('qpos_stocktransfer.del_flag', 1)->where('qpos_stocktransfer.branch', $branch);

                $data = $query->get();
                $count_filter = $query->count();
                $count_total = StockTransferModel::count();
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
                $query  = DB::table('qpos_stocktransfer')->leftjoin('qpos_van', 'qpos_stocktransfer.van', '=', 'qpos_van.id')
                    ->select('qpos_stocktransfer.*', 'qpos_van.vanname')
                    ->orderby('id', 'desc');
                $query->where('qpos_stocktransfer.del_flag', 1)->where('qpos_stocktransfer.branch', $branch)->where('qpos_stocktransfer.van', $vanid);

                $data = $query->get();
                $count_filter = $query->count();
                $count_total = StockTransferModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                    return $row->id;
                })->rawColumns(['action'])->make(true);
            }
        }


        return view('pos.stocktransfer.listing');
    }
    public function stocktransfer()
    {
        $user_id = Auth::user()->name;
        if ($user_id == 'Qzolve') {
            $van = DB::table('qpos_van')->select('id', 'vanname')->where('del_flag', 1)->get();
        } else {
            $van = DB::table('qpos_van')->select('id', 'vanname')->where('del_flag', 1)->where('username', $user_id)->get();
        }

        return view('pos.stocktransfer.add', compact('van', 'user_id'));
    }

    public function submit_stocktransfer(Request $request)
    {

        $branch = Session::get('branch');
        $postID = $request->id;
        $data = [
            'van' => $request->van,
            'date' => $request->date,
            'notes' => $request->notes,
            'totalitems' => $request->totalitems,
            'totalquantity' => $request->totalquantity,
            'totalamount' => $request->totalamount,
            'branch' => $branch
        ];

        $stocktransfer = StockTransferModel::updateOrCreate(['id' => $postID], $data);
        $stocktransferid = $stocktransfer->id;

        DB::table('qpos_stocktransfer_products')->where('stocktransferid', $stocktransferid)->delete();

        for ($i = 0; $i < count($request->item_details_id); $i++) {
            $data = [
                'stocktransferid' => $stocktransferid,
                'van' =>  $request->van,
                'product' => $request->item_details_id[$i],
                'rate' => $request->rate[$i],
                'quantity' => $request->quantity[$i],
                'invoiced_quantity' => 0,
                'amount' => $request->amount[$i],
                'branch' => $branch
            ];

            // $quotation_product = CustomInvoiceproductModel::Create($data);
            $stocktransferproducts = DB::table('qpos_stocktransfer_products')->insert($data);
            $available_quantity = 0;
            $q = 0;
            $r = 0;
            $in = 0;
            $available_quantity = DB::table('qpos_van_stock')->select('*')->where('vanid', $request->van)->where('productid', $request->item_details_id[$i])->get();
            foreach ($available_quantity as $key => $available_quantity) {
                $q = $available_quantity->available_quantity;
                $r = $available_quantity->return_quantity;
                $in = $available_quantity->invoiced_quantity;
            }
            $data1 = [

                'vanid' =>  $request->van,
                'productid' => $request->item_details_id[$i],
                'rate' => $request->rate[$i],
                'available_quantity' => $q + $request->quantity[$i],
                'invoiced_quantity' => $r,
                'return_quantity' => $in,

                'branch' => $branch
            ];

            // $quotation_product = CustomInvoiceproductModel::Create($data);
            $vanstock = VanStockModel::updateOrCreate(['vanid' => $request->van, 'productid' => $request->item_details_id[$i]], $data1);
        }

        $restock = 0;
        for ($i = 0; $i < count($request->item_details_id); $i++) {
            $ostock = DB::table('qinventory_products')->select('available_stock')->where('product_id', $request->item_details_id[$i])->get();

            foreach ($ostock as $ostock) {
                $orstock = $ostock->available_stock;
            }
            $restock = intval($orstock) - intval($request->quantity[$i]);


            $data1 = [
                'available_stock' => $restock,
            ];
            DB::table('qinventory_products')->where('product_id', $request->item_details_id[$i])->update($data1);
        }
        return $data1;
    }

    public function stocktransfer_pdf(Request $request)
    {
        ini_set("pcre.backtrack_limit", "100000000000");
        $id = $request->id;
        $branch = Session::get('branch');


        $companysettings = BranchSettingsModel::where('branch', $branch)->get();


        $stocktransfer   = DB::table('qpos_stocktransfer')->leftjoin('qpos_van', 'qpos_stocktransfer.van', '=', 'qpos_van.id')->select('qpos_stocktransfer.*', 'qpos_van.vanname')->where('qpos_stocktransfer.id', $id)->where('qpos_stocktransfer.del_flag', 1)->where('qpos_stocktransfer.branch', $branch)->get();
        $stocktransfer_products   = DB::table('qpos_stocktransfer_products')->leftjoin('qpos_van', 'qpos_stocktransfer_products.van', '=', 'qpos_van.id')->leftjoin('qinventory_products', 'qpos_stocktransfer_products.product', '=', 'qinventory_products.product_id')->select('qpos_stocktransfer_products.*', 'qpos_van.vanname', 'qinventory_products.product_name')->where('qpos_stocktransfer_products.stocktransferid', $id)->where('qpos_stocktransfer_products.del_flag', 1)->where('qpos_stocktransfer_products.branch', $branch)->get();

        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();


        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('pos.stocktransfer.preview1', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stocktransfer', 'stocktransfer_products'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('pos.stocktransfer.preview2', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stocktransfer', 'stocktransfer_products'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('pos.stocktransfer.preview3', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stocktransfer', 'stocktransfer_products'));
        } elseif (Session::get('preview') == 'preview4') {
            $pdf = PDF::loadView('pos.stocktransfer.preview4', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stocktransfer', 'stocktransfer_products'));
        } else {
            $pdf = PDF::loadView('pos.stocktransfer.van_pdf', compact('branch', 'branchsettings', 'bname', 'companysettings', 'stocktransfer', 'stocktransfer_products'));
        }


        return $pdf->stream('stocktransfer-#' . $id . '.pdf');
    }
}

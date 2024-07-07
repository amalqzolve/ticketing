<?php

namespace App\Http\Controllers\qpurchase;

use DB;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getproduct(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qinventory_products')
            ->select('*', DB::raw("(SELECT SUM(qsell_saleorder_products.invoice_remaining) FROM qsell_saleorder_products
                                WHERE qinventory_products.product_id = qsell_saleorder_products.item_id
                                GROUP BY qsell_saleorder_products.item_id) as so"))
            ->where('product_id', $id)
            ->get();
        return response()->json($data);
    }
    public function getcurrency_qpurchase(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qpurchase_currency')
            ->select('qpurchase_currency.*')
            ->where('qpurchase_currency.id', $id)
            ->get();
        return response()->json($data);
    }
    public function getsupplierdetails_qpurchase(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qcrm_supplier')
            ->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')
            ->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')
            ->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')
            ->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')
            ->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')
            ->where('qcrm_supplier.id', $id)
            ->get();
        return response()->json($data);
    }
    public function gettermsqpurchase(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qcrm_termsandconditions')->select('qcrm_termsandconditions.*')->where('qcrm_termsandconditions.id', $id)->get();
        return response()->json($data);
    }
    public function getPurchaseNumberForReturn(Request $request)
    {
        $supplier = $request->id;
        $data = DB::table('qbuy_purchase_pi')
            ->leftjoin('qbuy_purchase_pi_products', 'qbuy_purchase_pi.id', '=', 'qbuy_purchase_pi_products.pi_id')
            ->select('qbuy_purchase_pi.id','po_id',  DB::raw('SUM(qbuy_purchase_pi_products.returned_qty) as returned_qty'), DB::raw('SUM(qbuy_purchase_pi_products.quantity) as totalquantity'),) // 
            ->where('qbuy_purchase_pi.supplier_id', $supplier)
            ->where('qbuy_purchase_pi.status', 'Approved')
            ->groupBy('qbuy_purchase_pi.id')
            ->havingRaw('SUM(qbuy_purchase_pi_products.returned_qty) < SUM(qbuy_purchase_pi_products.quantity)')
            ->orderBy('qbuy_purchase_pi.id', 'desc')
            ->get();
        $out = array(
            'data' => $data,
            'status' => 1,
        );
        return response()->json($out);
    }
    public function getsupplierpurchaseid(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qbuy_purchase')->select('id')
            ->where('del_flag', 1)
            ->where('vendor_supplier_name', $id)
            ->get();
        return response()->json($data);
    }

    public function getdebitbalance(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $data = DB::table('qbuy_supplier_payments')
            ->select(DB::raw('SUM(qbuy_supplier_payments.dr_amount) as dr_amount'), DB::raw('SUM(qbuy_supplier_payments.cr_amount) as cr_amount'))
            ->where('qbuy_supplier_payments.supplier_id', $supplier_id)
            ->groupBy('qbuy_supplier_payments.supplier_id')
            ->get();
        return response()->json($data);
    }
}

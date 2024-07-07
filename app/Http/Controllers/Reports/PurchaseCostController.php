<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use View;
use DB;
use Auth;
use Session;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\purchase\ProductcostheadModel;
use App\settings\BranchSettingsModel;

class PurchaseCostController extends Controller
{
	public function purchasecostreports()
	{
		$purchaseno = DB::table('qbuy_purchase_pi')->select('id')->where('del_flag', 1)->get();
		return view('Reports.purchasecost.index', compact('purchaseno'));
	}
	public function purchasecostsubmit(Request $request)
	{
		$branch = Session::get('branch');
		$pid = $request->purchaseno;
		$productscount = DB::table('qbuy_pi_products')->where('pi_id', $pid)->count();
		$data = DB::table('qbuy_purchase_pi')->select('id', 'grandtotalamount')->where('id', $pid)->get();
		$pi_product   = DB::table('qbuy_pi_products')->leftjoin('qinventory_products', 'qinventory_products.product_id', '=', 'qbuy_pi_products.itemname')->leftJoin('qinventory_product_unit', 'qinventory_product_unit.id', '=', 'qbuy_pi_products.unit')->select('qbuy_pi_products.*', 'qinventory_products.product_name', 'qinventory_products.part_no', 'qinventory_product_unit.unit_name')->where('qbuy_pi_products.pi_id', $pid)->where('qbuy_pi_products.del_flag', 1)->where('qbuy_pi_products.branch', $branch)->get();

		$purchase_costlist = DB::table('qbuy_products_costhead')->select('*')->where('pi_id', $pid)->get();
		$subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
		$subentrytypestable = $subtable . 'entrytypes';
		$query  = DB::table('qsettings_voucher')->leftjoin($subentrytypestable, $subentrytypestable . '.id', '=', 'qsettings_voucher.entry_types')->select('qsettings_voucher.*', $subentrytypestable . '.name')->orderby('qsettings_voucher.id', 'desc');
		$query->where('qsettings_voucher.del_flag', 1)->where('qsettings_voucher.branch', $branch)->get();
		$costheadlist = $query->get();
		return view('Reports.purchasecost.report', compact('data', 'purchase_costlist', 'costheadlist', 'productscount', 'pi_product'));
	}
	public function purchasecostpdf(Request $request)
	{
		$branch = Session::get('branch');
		$pid = $request->pid;
		$productscount = DB::table('qbuy_pi_products')->where('pi_id', $pid)->count();
		$data = DB::table('qbuy_purchase_pi')->select('id', 'grandtotalamount')->where('id', $pid)->get();
		$pi_product   = DB::table('qbuy_pi_products')->leftjoin('qinventory_products', 'qinventory_products.product_id', '=', 'qbuy_pi_products.itemname')->leftJoin('qinventory_product_unit', 'qinventory_product_unit.id', '=', 'qbuy_pi_products.unit')->select('qbuy_pi_products.*', 'qinventory_products.product_name', 'qinventory_products.part_no', 'qinventory_product_unit.unit_name')->where('qbuy_pi_products.pi_id', $pid)->where('qbuy_pi_products.del_flag', 1)->where('qbuy_pi_products.branch', $branch)->get();

		$purchase_costlist = DB::table('qbuy_products_costhead')->select('*')->where('pi_id', $pid)->get();
		$subtable = DB::table('a_accounts')->where('id', '=', $branch)->orderBy('id', 'asc')->value('db_prefix');
		$subentrytypestable = $subtable . 'entrytypes';
		$query  = DB::table('qsettings_voucher')->leftjoin($subentrytypestable, $subentrytypestable . '.id', '=', 'qsettings_voucher.entry_types')->select('qsettings_voucher.*', $subentrytypestable . '.name')->orderby('qsettings_voucher.id', 'desc');
		$query->where('qsettings_voucher.del_flag', 1)->where('qsettings_voucher.branch', $branch)->get();
		$costheadlist = $query->get();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

		$pdf = PDF::loadview('Reports.purchasecost.pdf', compact('data', 'purchase_costlist', 'costheadlist', 'productscount', 'branchsettings', 'pi_product'));
		return $pdf->stream('purchasecost.pdf');
	}
}

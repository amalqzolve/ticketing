<?php

namespace App\Http\Controllers\CarRental;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;
use App\inventory\ProductdetailslistModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use MuktarSayedSaleh\ZakatTlv\Encoder;
use Illuminate\Support\Facades\Crypt;
use App\CarRental\CarInAndOut;
use App\CarRental\ReceiptModel;
use App\CarRental\PaymentModel;
use App\CarRental\InvoiceModel;


class ReceiptController extends Controller
{

	public function edit(Request $request, $id)
	{
		$branch = Session::get('branch');
		$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
		$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();

		$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('branch', $branch)->where('del_flag', 1)->get();

		$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
		$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->get();

		$adwance = ReceiptModel::where('id', Crypt::decryptString($id))->first();
		if ($adwance->car_in_out_id) {
			$car_in_out_id = $adwance->car_in_out_id;
			$carInoutId_encrypted = Crypt::encryptString($adwance->car_in_out_id);
			$carInAndOut =	CarInAndOut::select('id', 'car_id')->where('id', $car_in_out_id)->first();
		} else
			return 'not get any details';
		return view('carRental.receipt.edit', compact('branch', 'currencylist', 'vatlist',  'unitlist', 'termslist', 'salesmen', 'carInoutId_encrypted', 'car_in_out_id', 'carInAndOut', 'adwance'));
	}

	public function save(Request $request)
	{

		if ($request->ajax()) {
			try {
				DB::transaction(function () use ($request) {

					$user_id = Auth::user()->id;
					$branch = Session::get('branch');
					$postID = $request->id;
					$data =  array(
						'car_in_out_id' => $request->car_in_out_id,
						'adwance_id' => $request->adwance_id,
						'invoice_id' => $request->invoice_id,
						'type' => $request->type,
						'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d'),
						'valid_till' => Carbon::parse($request->valid_till)->format('Y-m-d'),
						'method' => $request->method,
						'salesman' => $request->salesman,
						'currency' => $request->currency,
						'currencyvalue' => $request->currencyvalue,
						'qtn_ref' => $request->qtn_ref,
						'po_ref' => $request->po_ref,
						'payment_terms' => $request->payment_terms,
						'discount_type' => $request->discount_type,
						'preparedby' => $request->preparedby,
						'approvedby' => $request->approvedby,
						'notes' => $request->notes,
						'internalreference' => $request->internalreference,
						'terms_conditions' => $request->terms_conditions,
						'name' => $request->name,
						'description' => $request->description,
						'amount' => $request->amount,
						'branch' => $branch,
						'user_id' => $user_id,
					);
					$receiptModel = ReceiptModel::updateOrCreate(['id' => $postID], $data);

					if ($request->adwance_id != '')
						$ifFind =  PaymentModel::find($request->adwance_id)->update(array('status' => 1));
					if ($request->invoice_id)
						$ifFind =  InvoiceModel::find($request->invoice_id)->update(array('status' => 2));
				});
				$out = array(
					'status' => 1,
					'msg' => 'Saved Success',
					'key' => $request->carInoutId_encrypted,
				);
				echo json_encode($out);
			} catch (\Throwable $e) {
				$out = array(
					'error' => $e,
					'status' => 0,
					'msg' => 'Error While Save'
				);
				echo json_encode($out);
			}
		} else
			return Null;
	}
}

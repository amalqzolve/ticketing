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
use App\CarRental\PaymentModel;
use App\CarRental\CarModel;
use App\CarRental\StatementOfAccountsModel;


class PaymentsController extends Controller
{

	public function add($id)
	{
		$branch = Session::get('branch');
		$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
		$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();

		$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();

		$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
		$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->get();
		$carInoutId_encrypted = $id;
		$car_in_out_id = Crypt::decryptString($id);
		$carInAndOut =	CarInAndOut::select('car_in_out.id', 'car_in_out.car_id', 'car_in_out.rental_type', 'car_in_out.rate', 'car_in_out.limit', 'car_in_out.aditional_amount', 'qcrm_customer_details.cust_name as renter_name', DB::raw("DATE_FORMAT(car_in_out.isue_date, '%d-%m-%Y') as isue_date"), DB::raw("DATE_FORMAT(car_in_out.exp_date, '%d-%m-%Y') as exp_date"), DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"), DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"), 'car_in_out.total_amount_invoiced')->where('car_in_out.id', $car_in_out_id)
			->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
			->first();
		$cars =  CarModel::select('id', 'registration_number', 'car_name')->where('branch', $branch)->get();
		return view('carRental.payments.add', compact('branch', 'currencylist', 'vatlist',  'unitlist', 'termslist', 'salesmen', 'carInoutId_encrypted', 'car_in_out_id', 'carInAndOut', 'cars'));
	}

	public function edit(Request $request, $id)
	{
		$branch = Session::get('branch');
		$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
		$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();

		$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('branch', $branch)->where('del_flag', 1)->get();

		$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
		$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->get();

		$adwance = PaymentModel::where('id', Crypt::decryptString($id))->first();
		if ($adwance->car_in_out_id) {
			$car_in_out_id = $adwance->car_in_out_id;
			$carInoutId_encrypted = Crypt::encryptString($adwance->car_in_out_id);
			$carInAndOut =	CarInAndOut::select('car_in_out.id', 'car_in_out.car_id', 'car_in_out.rental_type', 'car_in_out.rate', 'car_in_out.limit', 'car_in_out.aditional_amount', 'qcrm_customer_details.cust_name as renter_name', DB::raw("DATE_FORMAT(car_in_out.isue_date, '%d-%m-%Y') as isue_date"), DB::raw("DATE_FORMAT(car_in_out.exp_date, '%d-%m-%Y') as exp_date"), DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"), DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"), 'car_in_out.total_amount_invoiced')->where('car_in_out.id', $car_in_out_id)
				->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
				->first();
		} else
			return 'not get any details';

		$cars =  CarModel::select('id', 'registration_number', 'car_name')->where('branch', $branch)->get();
		return view('carRental.payments.edit', compact('branch', 'currencylist', 'vatlist',  'unitlist', 'termslist', 'salesmen', 'carInoutId_encrypted', 'car_in_out_id', 'carInAndOut', 'adwance', 'cars'));
	}

	public function save(Request $request)
	{

		if ($request->ajax()) {
			try {
				DB::transaction(function () use ($request) {

					$user_id = Auth::user()->id;
					$branch = Session::get('branch');
					$postID = $request->id;
					if (($postID != '') || ($postID != null)) {
						$adwance = PaymentModel::find($request->id);
						if ($adwance) {
							$oldAmount = $adwance->amount;
						}
					}
					$data =  array(
						'car_in_out_id' => $request->car_in_out_id,
						'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d'),
						// 'valid_till' => Carbon::parse($request->valid_till)->format('Y-m-d'),
						'method' => $request->method,
						'salesman' => $request->salesman,
						'currency' => $request->currency,
						'currencyvalue' => $request->currencyvalue,
						// 'qtn_ref' => $request->qtn_ref,
						// 'po_ref' => $request->po_ref,
						// 'payment_terms' => $request->payment_terms,
						// 'discount_type' => $request->discount_type,
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
					$payments = PaymentModel::updateOrCreate(['id' => $postID], $data);
					if (($postID == '') || ($postID == null)) {
						$ifFind =  CarInAndOut::find($request->car_in_out_id);
						if ($ifFind) {
							$ifFind->increment('adwance_amount', $request->amount);
						}
						$accArray = array(
							'car_in_out_id' => $request->car_in_out_id,
							'car_rent_payment_id' => $payments->id,
							'car_rent_invoice_id' => null,
							'type' => 'CREDIT',
							'transcation_date' => Carbon::now()->format('Y-m-d'),
							'trans_type' => 'PAYMENTS',
							'notes' => $request->description,
							'debit_amount' => 0,
							'credit_amount' => $request->amount,
							'branch' => $branch,
						);
						StatementOfAccountsModel::create($accArray);
					} else {
						$ifFind =  CarInAndOut::find($request->car_in_out_id);
						if ($ifFind) {
							$ifFind->decrement('adwance_amount', $oldAmount);
							$ifFind->increment('adwance_amount', $request->amount);
						}
						$accArray = array('credit_amount' => $request->amount);
						StatementOfAccountsModel::where('car_rent_payment_id', $postID)->update($accArray);
					}
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

	public function generateReceipt(Request $request)
	{
		if ($request->adwance_id != '')
			$ifFind =  PaymentModel::find($request->adwance_id)->update(array('status' => 1));

		if ($request->ajax()) {
			try {
				DB::transaction(function () use ($request) {
					$adw = PaymentModel::find($request->id);
					if ($adw) {
						$adw->update(array('status' => 1));
					}
				});
				$out = array(
					'status' => 1,
					'msg' => 'Payments Generated Successfully'
				);
				echo json_encode($out);
			} catch (\Throwable $e) {
				$out = array(
					'error' => $e,
					'status' => 0,
					'msg' => 'Error While Generate Payments'
				);
				echo json_encode($out);
			}
		} else
			return Null;
	}




	public function delete(Request $request)
	{
		if ($request->ajax()) {
			try {
				DB::transaction(function () use ($request) {
					$adw = PaymentModel::find($request->id);
					$ifFind =  CarInAndOut::find($adw->car_in_out_id);
					if ($ifFind) {
						$ifFind->decrement('adwance_amount', $adw->amount);
					}
					$adw->delete();
				});
				$out = array(
					'status' => 1,
					'msg' => 'Deleted Successfully'
				);
				echo json_encode($out);
			} catch (\Throwable $e) {
				$out = array(
					'error' => $e,
					'status' => 0,
					'msg' => 'Error While Delete'
				);
				echo json_encode($out);
			}
		} else
			return Null;
	}


	public function Pdf(Request $request, $id)
	{
		$brandlist = array();
		$manufacturerlist = array();
		$brname = array();
		$mrname = array();
		ini_set("pcre.backtrack_limit", "100000000000");
		$id = Crypt::decryptString($id);
		$branch = Session::get('branch');
		$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
		$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
		$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
		$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->get();
		$stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag', 1)->get();
		$salesinvoice   = PaymentModel::select('*')->where('id', $id)->first();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();
		$gm_amount = 0;

		// foreach ($salesinvoice as $key => $value) {
		$gm_amount = $salesinvoice->grandtotalamount;
		$balance_amount = $salesinvoice->balance_amount;
		// }
		$words = $this->numberToWord($gm_amount);
		$carInAndOut =	CarInAndOut::select('id', 'car_id', 'customer_id')->where('id', $salesinvoice->car_in_out_id)->first();

		if (isset($carInAndOut->id))
			$customers = DB::table('qcrm_customer_details')->select('qcrm_customer_details.*', 'qcrm_customer_categorydetails.customer_category', 'qcrm_customer_typedetails.title as type', 'qcrm_customer_groupdetails.title as group', 'countries.cntry_name')
				->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_details.cust_category', '=', 'qcrm_customer_categorydetails.id')
				->leftjoin('qcrm_customer_typedetails', 'qcrm_customer_details.cust_type', '=', 'qcrm_customer_typedetails.id')
				->leftjoin('qcrm_customer_groupdetails', 'qcrm_customer_details.cust_group', '=', 'qcrm_customer_groupdetails.id')
				->leftjoin('countries', 'qcrm_customer_details.cust_country', '=', 'countries.id')
				->where('qcrm_customer_details.id', $carInAndOut->customer_id)
				->get();
		else
			$customers = array();
		$pdf = PDF::loadView('carRental.payments.preview', compact('branch', 'branchsettings', 'currencylist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'vatlist', 'bname', 'companysettings',  'brname', 'mrname', 'words', 'carInAndOut'));
		return $pdf->stream('trip-receipt-#' . $id . '.pdf');
	}
	public function numberToWord($num = '')
	{
		$num    = (string) ((int) $num);
		if ((int) ($num) && ctype_digit($num)) {
			$words  = array();
			$num    = str_replace(array(',', ' '), '', trim($num));
			$list1  = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');
			$list2  = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
			$list3  = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion', 'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion');
			$num_length = strlen($num);
			$levels = (int) (($num_length + 2) / 3);
			$max_length = $levels * 3;
			$num    = substr('00' . $num, -$max_length);
			$num_levels = str_split($num, 3);
			foreach ($num_levels as $num_part) {
				$levels--;
				$hundreds   = (int) ($num_part / 100);
				$hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
				$tens       = (int) ($num_part % 100);
				$singles    = '';
				if ($tens < 20) {
					$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
				} else {
					$tens = (int) ($tens / 10);
					$tens = ' ' . $list2[$tens] . ' ';
					$singles = (int) ($num_part % 10);
					$singles = ' ' . $list1[$singles] . ' ';
				}
				$words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
			}
			$commas = count($words);
			if ($commas > 1) {
				$commas = $commas - 1;
			}
			$words  = implode(', ', $words);
			$words  = trim(str_replace(' ,', ',', ucwords($words)), ', ');
			if ($commas) {
				$words  = str_replace(',', ' ', $words);
			}
			return $words;
		} else if (!((int) $num)) {
			return 'Zero';
		}
		return '';
	}
}

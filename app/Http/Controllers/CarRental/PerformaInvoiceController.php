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
use App\CarRental\PerformaInvoiceModel;
use App\CarRental\InvoiceModel;
use App\CarRental\InvoiceAditionalAmountModel;
use App\CarRental\CarModel;
use App\CarRental\PerformaInvoiceAditionalAmountModel;


class PerformaInvoiceController extends Controller
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
		$carInAndOut =	CarInAndOut::select(
			'car_in_out.id',
			'car_in_out.car_id',
			'car_in_out.rental_type',
			'car_in_out.rate',
			'car_in_out.limit',
			'car_in_out.aditional_amount',
			'qcrm_customer_details.cust_name as renter_name',
			DB::raw("DATE_FORMAT(car_in_out.isue_date, '%d-%m-%Y') as isue_date"),
			DB::raw("DATE_FORMAT(car_in_out.exp_date, '%d-%m-%Y') as exp_date"),
			DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"),
			DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"),
			'car_in_out.total_amount_invoiced',
			'car_in_out.total_amount_performa_invoiced',
			'car_in_out.total_additional_amount_performa_invoiced',
			'car_in_out.status',
			'car_in_out.trip_start_odometer',
			'car_in_out.trip_end_odometer',
			'car_in_out.limit',
			'car_in_out.aditional_amount'
		)->where('car_in_out.id', $car_in_out_id)
			->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
			->first();
		$cars =  CarModel::select('id', 'registration_number', 'car_name')->where('branch', $branch)->get();

		if ($carInAndOut->rental_type == 'Monthly') {
			$this_month = Carbon::parse($carInAndOut->trip_start_date)->floorMonth(); // returns 2019-07-01
			$start_month = Carbon::parse($carInAndOut->trip_end_date)->floorMonth(); // returns 2019-06-01
			$diff = $start_month->diffInMonths($this_month);  // returns 1
			if ($diff < 1)
				$diff = 1;
			$totalAmount = $carInAndOut->rate * $diff;
			if ($carInAndOut->status != 3) {
				$totalAdditionalAmount = 0;
			} else {
				$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
				if (($carInAndOut->limit * $diff) < ($totalDuration * $diff)) {
					$totalAdditionalKm = ($totalDuration * $diff) - ($carInAndOut->limit * $diff);
					$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalAdditionalKm;
				} else
					$totalAdditionalAmount = 0;
			}
		} else if ($carInAndOut->rental_type == 'Daily') {
			$this_month = Carbon::parse($carInAndOut->trip_start_date)->floorMonth(); // returns 2019-07-01
			$start_month = Carbon::parse($carInAndOut->trip_end_date)->floorMonth(); // returns 2019-06-01
			$diff = $start_month->diffForHumans($this_month);  // returns 1
			if ($diff < 1)
				$diff = 1;
			$totalAmount = $carInAndOut->rate * $diff;
			if ($carInAndOut->status != 3) {
				$totalAdditionalAmount = 0;
			} else {
				$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
				if (($carInAndOut->limit * $diff) < ($totalDuration * $diff)) {
					$totalAdditionalKm = ($totalDuration * $diff) - ($carInAndOut->limit * $diff);
					$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalAdditionalKm;
				} else
					$totalAdditionalAmount = 0;
			}
		} else if ($carInAndOut->rental_type == 'Hourly') {
			$startTime = Carbon::parse($carInAndOut->trip_start_date)->floorMonth(); // returns 2019-07-01
			$finishTime = Carbon::parse($carInAndOut->trip_end_date)->floorMonth(); // returns 2019-06-01
			$totalDuration = ($finishTime->diffInSeconds($startTime)) / 3600;
			$diff = round($totalDuration, 0);
			if ($diff < 1)
				$diff = 1;
			$totalAmount = $carInAndOut->rate * $diff;
			if ($carInAndOut->status != 3) {
				$totalAdditionalAmount = 0;
			} else {
				$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
				if (($carInAndOut->limit * $diff) < ($totalDuration * $diff)) {
					$totalAdditionalKm = ($totalDuration * $diff) - ($carInAndOut->limit * $diff);
					$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalAdditionalKm;
				} else
					$totalAdditionalAmount = 0;
			}
		} else if ($carInAndOut->rental_type == 'Contract') {
			$totalAmount = $carInAndOut->rate;
			$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
			if ($totalDuration > 0)
				$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalDuration;
			else
				$totalAdditionalAmount = 0;
		} else {
			$totalAmount = 0;
			$totalAdditionalAmount = 0;
		}


		return view('carRental.performainvoice.add', compact('branch', 'currencylist', 'vatlist',  'unitlist', 'termslist', 'salesmen', 'carInoutId_encrypted', 'car_in_out_id', 'carInAndOut', 'cars', 'totalAmount', 'totalAdditionalAmount'));
	}

	public function edit(Request $request, $id)
	{
		$branch = Session::get('branch');
		$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
		$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();

		$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('branch', $branch)->where('del_flag', 1)->get();

		$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
		$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->get();
		$performaInvoice = PerformaInvoiceModel::where('id', Crypt::decryptString($id))->first();
		if (isset($performaInvoice->car_in_out_id)) {
			$carInoutId_encrypted = Crypt::encryptString($performaInvoice->car_in_out_id);
			$car_in_out_id = $performaInvoice->car_in_out_id;
			$carInAndOut =	CarInAndOut::select(
				'car_in_out.id',
				'car_in_out.car_id',
				'car_in_out.rental_type',
				'car_in_out.rate',
				'car_in_out.limit',
				'car_in_out.aditional_amount',
				'qcrm_customer_details.cust_name as renter_name',
				DB::raw("DATE_FORMAT(car_in_out.isue_date, '%d-%m-%Y') as isue_date"),
				DB::raw("DATE_FORMAT(car_in_out.exp_date, '%d-%m-%Y') as exp_date"),
				DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"),
				DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"),
				'car_in_out.total_amount_invoiced',
				'car_in_out.total_amount_performa_invoiced',
				'car_in_out.total_additional_amount_performa_invoiced',
				'car_in_out.status',
				'car_in_out.trip_start_odometer',
				'car_in_out.trip_end_odometer',
				'car_in_out.limit',
				'car_in_out.aditional_amount'
			)->where('car_in_out.id', $car_in_out_id)
				->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
				->first();
			$performaInvoiceAditionalAmount = PerformaInvoiceAditionalAmountModel::select('*')->where('car_rent_performa_invoice_id', Crypt::decryptString($id))->get();
			$cars =  CarModel::select('id', 'registration_number', 'car_name')->where('branch', $branch)->get();
		} else
			return false;

		if ($carInAndOut->rental_type == 'Monthly') {
			$this_month = Carbon::parse($carInAndOut->trip_start_date)->floorMonth(); // returns 2019-07-01
			$start_month = Carbon::parse($carInAndOut->trip_end_date)->floorMonth(); // returns 2019-06-01
			$diff = $start_month->diffInMonths($this_month);  // returns 1
			if ($diff < 1)
				$diff = 1;
			$totalAmount = $carInAndOut->rate * $diff;
			if ($carInAndOut->status != 3) {
				$totalAdditionalAmount = 0;
			} else {
				$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
				if (($carInAndOut->limit * $diff) < ($totalDuration * $diff)) {
					$totalAdditionalKm = ($totalDuration * $diff) - ($carInAndOut->limit * $diff);
					$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalAdditionalKm;
				} else
					$totalAdditionalAmount = 0;
			}
		} else if ($carInAndOut->rental_type == 'Daily') {
			$this_month = Carbon::parse($carInAndOut->trip_start_date)->floorMonth(); // returns 2019-07-01
			$start_month = Carbon::parse($carInAndOut->trip_end_date)->floorMonth(); // returns 2019-06-01
			$diff = $start_month->diffForHumans($this_month);  // returns 1
			if ($diff < 1)
				$diff = 1;
			$totalAmount = $carInAndOut->rate * $diff;
			if ($carInAndOut->status != 3) {
				$totalAdditionalAmount = 0;
			} else {
				$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
				if (($carInAndOut->limit * $diff) < ($totalDuration * $diff)) {
					$totalAdditionalKm = ($totalDuration * $diff) - ($carInAndOut->limit * $diff);
					$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalAdditionalKm;
				} else
					$totalAdditionalAmount = 0;
			}
		} else if ($carInAndOut->rental_type == 'Hourly') {
			$startTime = Carbon::parse($carInAndOut->trip_start_date)->floorMonth(); // returns 2019-07-01
			$finishTime = Carbon::parse($carInAndOut->trip_end_date)->floorMonth(); // returns 2019-06-01
			$totalDuration = ($finishTime->diffInSeconds($startTime)) / 3600;
			$diff = round($totalDuration, 0);
			if ($diff < 1)
				$diff = 1;
			$totalAmount = $carInAndOut->rate * $diff;
			if ($carInAndOut->status != 3) {
				$totalAdditionalAmount = 0;
			} else {
				$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
				if (($carInAndOut->limit * $diff) < ($totalDuration * $diff)) {
					$totalAdditionalKm = ($totalDuration * $diff) - ($carInAndOut->limit * $diff);
					$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalAdditionalKm;
				} else
					$totalAdditionalAmount = 0;
			}
		} else if ($carInAndOut->rental_type == 'Contract') {
			$totalAmount = $carInAndOut->rate;
			$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
			if ($totalDuration > 0)
				$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalDuration;
			else
				$totalAdditionalAmount = 0;
		} else {
			$totalAmount = 0;
			$totalAdditionalAmount = 0;
		}


		return view('carRental.performainvoice.edit', compact('branch', 'currencylist', 'vatlist',  'unitlist', 'termslist', 'salesmen', 'carInoutId_encrypted', 'car_in_out_id', 'carInAndOut', 'performaInvoice', 'performaInvoiceAditionalAmount', 'cars', 'totalAmount', 'totalAdditionalAmount'));
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
						$Invoice = PerformaInvoiceModel::find($request->id);
						if ($Invoice) {
							$oldAmount = $Invoice->amount;
							$oldAmountAdditional = $Invoice->additional_amount;
						}
					} else
						$adwance = 0;

					$data =  array(
						'car_in_out_id' => $request->car_in_out_id,
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
						'discount_percentage' => $request->discount_percentage,
						'vat_percentage' => $request->vat_percentage,
						'vat_amount' => $request->vat_amount,
						'total_amount' => $request->total_amount,
						'additional_name' => $request->additional_name,
						'additional_description' => $request->additional_description,
						'additional_amount' => $request->additional_amount,
						'additional_discount_percentage' => $request->additional_discount_percentage,
						'additional_vat_percentage' => $request->additional_vat_percentage,
						'additional_vat_amount' => $request->additional_vat_amount,
						'additional_total_amount' => $request->additional_total_amount,
						'totalamount' => $request->totalamount,
						'discount' => $request->discount,
						'amountafterdiscount' => $request->amountafterdiscount,
						'totalvatamount' => $request->totalvatamount,
						'grandtotalamount' => $request->grandtotalamount,
						'branch' => $branch,
						'user_id' => $user_id,
					);
					$performaInvoiceModel = PerformaInvoiceModel::updateOrCreate(['id' => $postID], $data);

					PerformaInvoiceAditionalAmountModel::where('car_rent_performa_invoice_id', $performaInvoiceModel->id)->delete();
					if (isset($request->additional_remarks)) {
						foreach ($request->additional_remarks as $key => $value) {
							$inArry = array(
								'car_in_out_id' => $request->car_in_out_id,
								'car_rent_performa_invoice_id' => $performaInvoiceModel->id,
								'additional_cost_id' => $request->additional_cost_id[$key],
								'additional_remarks' => $request->additional_remarks[$key],
								'additional_desc' => $request->additional_desc[$key],
								'additional_cost_amount' => $request->additional_cost_amount[$key],
								'additional_cost_discount' => $request->additional_cost_discount[$key],
								'additional_cost_vat' => $request->additional_cost_vat[$key],
								'additional_cost_vat_amount' => $request->additional_cost_vat_amount[$key],
								'additional_cost_total_amount' => $request->additional_cost_total_amount[$key]
							);
							PerformaInvoiceAditionalAmountModel::create($inArry);
						}
					}

					if (($postID == '') || ($postID == null)) {
						$ifFind =  CarInAndOut::find($request->car_in_out_id);
						if ($ifFind) {
							$ifFind->increment('total_amount_performa_invoiced', $request->amount);
							if ($request->additional_amount != '')
								$ifFind->increment('total_additional_amount_performa_invoiced', $request->additional_amount);
						}
					} else {
						$ifFind =  CarInAndOut::find($request->car_in_out_id);
						if ($ifFind) {
							$ifFind->decrement('total_amount_performa_invoiced', $oldAmount);
							$ifFind->increment('total_amount_performa_invoiced', $request->amount);
							if ($oldAmountAdditional != '')
								$ifFind->decrement('total_additional_amount_performa_invoiced', $oldAmountAdditional);
							if ($request->additional_amount != '')
								$ifFind->increment('total_additional_amount_performa_invoiced', $request->additional_amount);
						}
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


	public function convertToInvoice(Request $request, $id)
	{
		$branch = Session::get('branch');
		$currencylist = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value')->where('branch', $branch)->where('del_flag', 1)->get();
		$unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();

		$termslist = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('branch', $branch)->where('del_flag', 1)->get();

		$salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
		$vatlist = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('branch', $branch)->where('del_flag', 1)->get();
		$performaInvoice = PerformaInvoiceModel::where('id', Crypt::decryptString($id))->first();
		if (isset($performaInvoice->car_in_out_id)) {
			$carInoutId_encrypted = Crypt::encryptString($performaInvoice->car_in_out_id);
			$car_in_out_id = $performaInvoice->car_in_out_id;
			$carInAndOut =	CarInAndOut::select(
				'car_in_out.id',
				'car_in_out.car_id',
				'car_in_out.rental_type',
				'car_in_out.rate',
				'car_in_out.limit',
				'car_in_out.aditional_amount',
				'qcrm_customer_details.cust_name as renter_name',
				DB::raw("DATE_FORMAT(car_in_out.isue_date, '%d-%m-%Y') as isue_date"),
				DB::raw("DATE_FORMAT(car_in_out.exp_date, '%d-%m-%Y') as exp_date"),
				DB::raw("DATE_FORMAT(car_in_out.trip_start_date, '%d-%m-%Y') as trip_start_date"),
				DB::raw("DATE_FORMAT(car_in_out.trip_end_date, '%d-%m-%Y') as trip_end_date"),
				'car_in_out.total_amount_invoiced',
				'car_in_out.total_amount_performa_invoiced',
				'car_in_out.total_additional_amount_performa_invoiced',
				'car_in_out.status',
				'car_in_out.trip_start_odometer',
				'car_in_out.trip_end_odometer',
				'car_in_out.limit',
				'car_in_out.aditional_amount'
			)->where('car_in_out.id', $car_in_out_id)
				->leftjoin('qcrm_customer_details', 'qcrm_customer_details.id', 'car_in_out.customer_id')
				->first();
			$performaInvoiceAditionalAmount = PerformaInvoiceAditionalAmountModel::select('*')->where('car_rent_performa_invoice_id', Crypt::decryptString($id))->get();
			$cars =  CarModel::select('id', 'registration_number', 'car_name')->where('branch', $branch)->get();
		} else
			return false;
		if ($carInAndOut->status != 3) {
			echo "invoice can create after complete trip";
			die();
		}
		if ($carInAndOut->rental_type == 'Monthly') {
			$this_month = Carbon::parse($carInAndOut->trip_start_date)->floorMonth(); // returns 2019-07-01
			$start_month = Carbon::parse($carInAndOut->trip_end_date)->floorMonth(); // returns 2019-06-01
			$diff = $start_month->diffInMonths($this_month);  // returns 1
			if ($diff < 1)
				$diff = 1;
			$totalAmount = $carInAndOut->rate * $diff;
			if ($carInAndOut->status != 3) {
				$totalAdditionalAmount = 0;
			} else {
				$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
				if (($carInAndOut->limit * $diff) < ($totalDuration * $diff)) {
					$totalAdditionalKm = ($totalDuration * $diff) - ($carInAndOut->limit * $diff);
					$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalAdditionalKm;
				} else
					$totalAdditionalAmount = 0;
			}
		} else if ($carInAndOut->rental_type == 'Daily') {
			$this_month = Carbon::parse($carInAndOut->trip_start_date)->floorMonth(); // returns 2019-07-01
			$start_month = Carbon::parse($carInAndOut->trip_end_date)->floorMonth(); // returns 2019-06-01
			$diff = $start_month->diffForHumans($this_month);  // returns 1
			if ($diff < 1)
				$diff = 1;
			$totalAmount = $carInAndOut->rate * $diff;
			if ($carInAndOut->status != 3) {
				$totalAdditionalAmount = 0;
			} else {
				$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
				if (($carInAndOut->limit * $diff) < ($totalDuration * $diff)) {
					$totalAdditionalKm = ($totalDuration * $diff) - ($carInAndOut->limit * $diff);
					$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalAdditionalKm;
				} else
					$totalAdditionalAmount = 0;
			}
		} else if ($carInAndOut->rental_type == 'Hourly') {
			$startTime = Carbon::parse($carInAndOut->trip_start_date)->floorMonth(); // returns 2019-07-01
			$finishTime = Carbon::parse($carInAndOut->trip_end_date)->floorMonth(); // returns 2019-06-01
			$totalDuration = ($finishTime->diffInSeconds($startTime)) / 3600;
			$diff = round($totalDuration, 0);
			if ($diff < 1)
				$diff = 1;
			$totalAmount = $carInAndOut->rate * $diff;
			if ($carInAndOut->status != 3) {
				$totalAdditionalAmount = 0;
			} else {
				$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
				if (($carInAndOut->limit * $diff) < ($totalDuration * $diff)) {
					$totalAdditionalKm = ($totalDuration * $diff) - ($carInAndOut->limit * $diff);
					$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalAdditionalKm;
				} else
					$totalAdditionalAmount = 0;
			}
		} else if ($carInAndOut->rental_type == 'Contract') {
			$totalAmount = $carInAndOut->rate;
			$totalDuration = $carInAndOut->trip_end_odometer - $carInAndOut->trip_start_odometer;
			if ($totalDuration > 0)
				$totalAdditionalAmount = $carInAndOut->aditional_amount * $totalDuration;
			else
				$totalAdditionalAmount = 0;
		} else {
			$totalAmount = 0;
			$totalAdditionalAmount = 0;
		}

		return view('carRental.performainvoice.convertToInvoice', compact('branch', 'currencylist', 'vatlist',  'unitlist', 'termslist', 'salesmen', 'carInoutId_encrypted', 'car_in_out_id', 'carInAndOut', 'performaInvoice', 'cars', 'performaInvoiceAditionalAmount'));
	}
	public function generateInvoice(Request $request)
	{
		if ($request->ajax()) {
			try {
				DB::transaction(function () use ($request) {
					$user_id = Auth::user()->id;
					$branch = Session::get('branch');
					$postID = null;
					$data =  array(
						'car_in_out_id' => $request->car_in_out_id,
						'car_rent_performa_invoice_id' => $request->id,
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
						'discount_percentage' => $request->discount_percentage,
						'vat_percentage' => $request->vat_percentage,
						'additional_name' => $request->additional_name,
						'additional_description' => $request->additional_description,
						'additional_amount' => $request->additional_amount,
						'additional_discount_percentage' => $request->additional_discount_percentage,
						'additional_vat_percentage' => $request->additional_vat_percentage,
						'additional_vat_amount' => $request->additional_vat_amount,
						'additional_total_amount' => $request->additional_total_amount,
						'totalamount' => $request->totalamount,
						'discount' => $request->discount,
						'amountafterdiscount' => $request->amountafterdiscount,
						'totalvatamount' => $request->totalvatamount,
						'grandtotalamount' => $request->grandtotalamount,
						'branch' => $branch,
						'user_id' => $user_id,
					);
					$invoiceModel = InvoiceModel::updateOrCreate(['id' => $postID], $data);
					PerformaInvoiceModel::where('id', $request->id)->update(array('status' => 1));

					if (isset($request->additional_remarks)) {
						foreach ($request->additional_remarks as $key => $value) {
							$inArry = array(
								'car_in_out_id' => $request->car_in_out_id,
								'car_rent_invoice_id' => $invoiceModel->id,
								'additional_cost_id' => $request->additional_cost_id[$key],
								'additional_remarks' => $request->additional_remarks[$key],
								'additional_desc' => $request->additional_desc[$key],
								'additional_cost_amount' => $request->additional_cost_amount[$key],
								'additional_cost_discount' => $request->additional_cost_discount[$key],
								'additional_cost_vat' => $request->additional_cost_vat[$key],
								'additional_cost_vat_amount' => $request->additional_cost_vat_amount[$key],
								'additional_cost_total_amount' => $request->additional_cost_total_amount[$key]
							);
							InvoiceAditionalAmountModel::create($inArry);
						}
					}

					$ifFind =  CarInAndOut::find($request->car_in_out_id);
					if ($ifFind) {
						$ifFind->increment('total_amount_invoiced', $request->amount);
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



	public function delete(Request $request)
	{
		if ($request->ajax()) {
			try {
				DB::transaction(function () use ($request) {
					$adw = PerformaInvoiceModel::find($request->id);
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
		$salesinvoice   = PerformaInvoiceModel::select('*')->where('id', $id)->first();
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->get();
		$bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
		$companysettings = BranchSettingsModel::where('branch', $branch)->get();
		$gm_amount = 0;
		// foreach ($salesinvoice as $key => $value) {
		$gm_amount = $salesinvoice->grandtotalamount;
		$balance_amount = $salesinvoice->balance_amount;
		// }
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
		$invoiceAditionalAmount = PerformaInvoiceAditionalAmountModel::select('*')->where('car_rent_performa_invoice_id', $id)->get();

		$words = $this->numberToWord($gm_amount);
		$quote_status = DB::table('qsell_saleinvoice')->select('status')->where('id', $id)->value('status');
		if (Session::get('preview') == 'preview1') {
			$pdf = PDF::loadView('carRental.performainvoice.preview1', compact('branch', 'branchsettings', 'currencylist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'vatlist', 'bname', 'companysettings',  'brname', 'mrname', 'words', 'carInAndOut', 'invoiceAditionalAmount'));
		} elseif (Session::get('preview') == 'preview2') {

			$pdf = PDF::loadView('carRental.performainvoice.preview2', compact('branch', 'branchsettings', 'currencylist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'vatlist', 'bname', 'companysettings',  'brname', 'mrname', 'words', 'carInAndOut', 'invoiceAditionalAmount'));
		} elseif (Session::get('preview') == 'preview3') {
			$pdf = PDF::loadView('carRental.performainvoice.preview3', compact('branch', 'branchsettings', 'currencylist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'vatlist', 'bname', 'companysettings',  'brname', 'mrname', 'words', 'carInAndOut', 'invoiceAditionalAmount'));
		} elseif (Session::get('preview') == 'preview4') {
			if ($quote_status == "Approved") {
				$pdf = PDF::loadView('carRental.performainvoice.preview4', compact('branch', 'branchsettings', 'currencylist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'vatlist', 'bname', 'companysettings',  'words', 'carInAndOut', 'invoiceAditionalAmount'));
			} else {
				$pdf = PDF::loadView('carRental.performainvoice.preview4', compact('branch', 'branchsettings', 'currencylist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'vatlist', 'bname', 'companysettings',  'words', 'carInAndOut', 'invoiceAditionalAmount'), [], [
					'default_font'               => 'sans-serif',
					'watermark'                  => $quote_status,
					'show_watermark'             => true,
					'pdfa'                       => false,
					'pdfaauto'                   => false,
				]);
			}
		} else {
			$pdf = PDF::loadView('carRental.performainvoice.preview4', compact('branch', 'branchsettings', 'currencylist', 'termslist', 'customers', 'salesmen', 'salesinvoice', 'vatlist', 'bname', 'companysettings', 'plabels', 'itemdetails', 'brname', 'mrname', 'words'));
		}
		return $pdf->stream('Performainvoiceorder-#' . $id . '.pdf');
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

<?php

namespace App\Http\Controllers\sell;

use DB;
use Auth;
use Session;
use App\crm\CustomerCategoryModel;
use App\crm\CustomerTypeModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;
use App\Ticket;
use App\TicketMembers;
use DataTables;


class TicketController extends Controller
{
	public function list(Request $request, $id)
	{
		if (!$request->ajax()) {
			$branch = Session::get('branch');
			// $ticket = Ticket::select('id', 'sales_order_id', 'name');
			$sales_order_id = $id;
			return view('sell.ticket.list', compact('sales_order_id'));
		} else {
			$data = Ticket::select('tickets.id', 'tickets.sales_order_id', 'tickets.name', 'phone', 'tickets.total_amount', 'tickets.passport_no', 'countries.cntry_name as country')
				->leftjoin('countries', 'tickets.country', '=', 'countries.id')
				->where('tickets.sales_order_id', '=', $id)
				->get();

			$dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action']);
			return  $dtTble->make(true);
		}
	}

	public function listAll(Request $request)
	{
		$branch = Session::get('branch');
		if (!$request->ajax()) {
			return view('sell.ticket.list_all');
		} else {
			$data = Ticket::select('tickets.id', 'tickets.sales_order_id', 'tickets.name', 'phone', 'tickets.total_amount', 'tickets.passport_no', 'countries.cntry_name as country')
				->leftjoin('countries', 'tickets.country', '=', 'countries.id')
				// ->where('tickets.branch', '=', $branch)
				->get();

			$dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
				return $row->id;
			})->rawColumns(['action']);
			return  $dtTble->make(true);
		}
	}
	public function add($id)
	{
		$sales_order_id = $id;
		$branch = Session::get('branch');
		$country = DB::table('countries')->select('cntry_name', 'id')->get();
		$airline = DB::table('airlines')->select('Airline as name', 'id')->get();
		$airports = DB::table('airports')->select('code', 'name', 'cityCode', 'cityName')->get();
		return view('sell.ticket.add', compact('branch', 'country', 'sales_order_id', 'airline', 'airports'));
	}
	public function submit(Request $request)
	{
		try {
			DB::transaction(function () use ($request) {
				$ticketData = [
					'sales_order_id' => $request->sales_order_id,
					'name' => $request->name,
					'address' => $request->address,
					'phone' => $request->phone,
					'email' => $request->email,
					'country' => $request->country,
					'passport_no' => $request->passport_no,
					'issue_date' => ($request->issue_date != '') ? date('Y-m-d', strtotime($request->issue_date)) : '',
					'expiry_date' => ($request->expiry_date != '') ? date('Y-m-d', strtotime($request->expiry_date)) : '',
					'trip_details' => $request->trip_details,
					'booking_id' => $request->booking_id,
					'booking_status' => $request->booking_status,
					'class' => $request->class,
					'type' => $request->type,
					'seat' => $request->seat,
					'boarding_time' => ($request->boarding_time != '') ? date('Y-m-d H:i', strtotime($request->boarding_time)) : '',
					'notes' => $request->notes,
					'baggage_allowances' => $request->baggage_allowances,
					'extra_services' => $request->extra_services,
					'ticket_no' => $request->ticket_no,
					'airlines' => $request->airlines,
					'airline_booking_reference' => $request->airline_booking_reference,
					'agency' => $request->agency,
					'departure' => $request->departure, //date('Y-m-d H:i', strtotime($request->departure_date))
					'departure_date' => ($request->departure_date) ?  Carbon::createFromFormat('d-m-Y H:i', $request->departure_date)->format('Y-m-d H:i') : '',
					'arrival' => $request->arrival,
					'arrival_date' => ($request->arrival_date) ?  Carbon::createFromFormat('d-m-Y H:i', $request->arrival_date)->format('Y-m-d H:i') : '',
					'show_fair' => $request->show_fair,
					'total_amount' => $request->total_amount,
				];
				$ticket = Ticket::updateOrCreate(['id' => $request->id], $ticketData);
				$ticket_id = $ticket->id;

				TicketMembers::where('ticket_id', $ticket_id)->delete();
				if (is_array($request->add_passenger_name)) {
					$inArrayFianal = array();
					foreach ($request->add_passenger_name as $key => $value) {
						$inArray = array(
							'ticket_id' => $ticket_id,
							'add_passenger_name' => $request->add_passenger_name[$key],
							'add_passenger_passport' => $request->add_passenger_passport[$key],
							'add_passenger_passport_issue_date' => ($request->add_passenger_passport_exp_date[$key] != '') ? Carbon::parse($request->add_passenger_passport_issue_date[$key])->format('Y-m-d') : '',
							'add_passenger_passport_exp_date' => ($request->add_passenger_passport_exp_date[$key] != '') ? Carbon::parse($request->add_passenger_passport_exp_date[$key])->format('Y-m-d') : '',
							'add_passenger_ticket_number' => $request->add_passenger_ticket_number[$key],
							'add_passenger_booking_id' => $request->add_passenger_booking_id[$key],
							'add_fare' => $request->add_fare[$key]
						);
						array_push($inArrayFianal, $inArray);
					}
					TicketMembers::insert($inArrayFianal);
				}
			});
			$out = array(
				'status' => 1,
				'msg' => 'Saved Success'
			);
			echo json_encode($out);
		} catch (\Throwable $e) {
			$out = array(
				'error' => $e,
				'status' => 0,
				'msg' => ' Error While Save'
			);
			echo json_encode($out);
		}
	}




	public function edit(Request $request, $id)
	{
		$ticket = Ticket::select('*')->where('id', $id)->first();
		if (isset($ticket->id)) {
			$ticketMembers = TicketMembers::select('*')->where('ticket_id', $id)->get();
			$branch = Session::get('branch');
			$country = DB::table('countries')->select('cntry_name', 'id')->get();
			$airline = DB::table('airlines')->select('Airline as name', 'id')->get();
			$airports = DB::table('airports')->select('code', 'name', 'cityCode', 'cityName')->get();
			return view('sell.ticket.edit', compact('branch', 'country',  'airline', 'airports', 'ticket', 'ticketMembers'));
		} else
			echo "ticket Not Found";
	}


	public function Pdf(Request $request, $id)
	{

		$branch = Session::get('branch');
		$ticket = Ticket::select('tickets.*', 'airlines.Airline as airline_name')
			->leftjoin('airlines', 'tickets.airlines', 'airlines.id')
			->where('tickets.id', $id)->first();
		$airports = DB::table('airports')->select('code', 'name', 'cityCode', 'cityName')->get();

		$ticketMembers = TicketMembers::select('*')->where('ticket_id', $id)->get();

		$gm_amount = ($ticket->totalamount != '') ? $ticket->totalamount : 0;
		$words = $this->numberToWord($gm_amount);
		$branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->first();

		$configuration = [];
		$exp_id = 'Ticket-#' . $id;
		$pdf = PDF::loadView('sell.ticket.preview2', compact('branchsettings', 'ticket', 'ticketMembers', 'words', 'airports'), $configuration,  [
			'title'      => $exp_id,
			'margin_top' => 0
		]);
		return $pdf->stream($exp_id . '.pdf');
	}

	public function numberToWord($num = '')
	{
		$num    = (string) ((int) $num);
		if ((int) ($num) && ctype_digit($num)) {
			$words  = array();
			$num    = str_replace(array(',', ' '), '', trim($num));
			$list1  = array(
				'', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
				'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
				'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
			);

			$list2  = array(
				'', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',
				'seventy', 'eighty', 'ninety', 'hundred'
			);

			$list3  = array(
				'', 'thousand', 'million', 'billion', 'trillion',
				'quadrillion', 'quintillion', 'sextillion', 'septillion',
				'octillion', 'nonillion', 'decillion', 'undecillion',
				'duodecillion', 'tredecillion', 'quattuordecillion',
				'quindecillion', 'sexdecillion', 'septendecillion',
				'octodecillion', 'novemdecillion', 'vigintillion'
			);

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

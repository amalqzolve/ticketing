<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\sales\EnquiryModel;
use Yajra\DataTables\DataTables;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report1()
    {

         return view('Reports.reports.reports');
    }
    public function report2()
    {

         return view('Reports.reports.reports2');
    }
    public function report3()
    {

         return view('Reports.reports.reports3');
    }
    public function report4()
    {

         return view('Reports.reports.reports4');
    }
    public function report5()
    {

         return view('Reports.reports.reports5');
    }

    public function report6()
    {

         return view('Reports.reports.reports6');
    }

    public function report7()
    {

         return view('Reports.reports.reports7');
    }
   public function report8()
    {

         return view('Reports.reports.reports8');
    }

    public function report9()
    {

         return view('Reports.reports.reports9');
    }

    public function report10()
    {

         return view('Reports.reports.reports10');
    }
    public function report11()
    {

         return view('Reports.reports.reports11');
    }
    public function report12()
    {

         return view('Reports.reports.reports12');
    }
    public function report13()
    {

         return view('Reports.reports.reports13');
    }
    public function enquiryreport(Request $request)
    {
           $branch=Session::get('branch');

      if ($request->ajax()) {
        $fromdate = Carbon::parse($request->from)->format('Y-m-d');
        $todate = Carbon::parse($request->to)->format('Y-m-d');
          if($request->sid == 0)
          {
                $query  = DB::table('qsales_enquiry')->leftjoin('qcrm_customer_details','qsales_enquiry.customer','=','qcrm_customer_details.id')->leftjoin('qcrm_salesman_details','qsales_enquiry.salesman','=','qcrm_salesman_details.id')->select('qsales_enquiry.id','qsales_enquiry.status','qcrm_customer_details.cust_name','qsales_enquiry.reference','qsales_enquiry.attention','qcrm_salesman_details.name','qsales_enquiry.grandtotalamount','qsales_enquiry.updated_at',DB::raw("DATE_FORMAT(qsales_enquiry.validity, '%d-%m-%Y') as validity"),'qsales_enquiry.grandtotalamount',DB::raw("DATE_FORMAT(qsales_enquiry.quotedate, '%d-%m-%Y') as quotedate"))->whereDate('quotedate','>=',$fromdate)->whereDate('quotedate','<=',$todate)->orderby('qsales_enquiry.id', 'desc');




            $query->where('qsales_enquiry.del_flag', 1)->orderby('qsales_enquiry.id', 'desc')->where('qsales_enquiry.branch',$branch);
            $data = $query->get();

               foreach ($data as $key => $value) {


                $totalCount = \DB::table('qsales_enquiry_rfq')->where('enquiry_id', '=', $value->id)->count();
                $value->total = $totalCount;
                $cdate = date('d-m-Y');
           $exdate = $value->validity;

            if ($exdate <= $cdate) {
                $value->enqstatus = "Expired";
            }
            else {
               $value->enqstatus = "Active";
            }


            $date1     = date_create($cdate);
            $date2     = date_create($exdate);

            $diff      = date_diff($date1,$date2);
            $value->redays = $diff->days;

        }


            $count_filter = $query->count();
            $count_total = EnquiryModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
          }
          else
          {
              $query  = DB::table('qsales_enquiry')->leftjoin('qcrm_customer_details','qsales_enquiry.customer','=','qcrm_customer_details.id')->leftjoin('qcrm_salesman_details','qsales_enquiry.salesman','=','qcrm_salesman_details.id')->select('qsales_enquiry.id','qsales_enquiry.status','qcrm_customer_details.cust_name','qsales_enquiry.reference','qsales_enquiry.attention','qcrm_salesman_details.name','qsales_enquiry.grandtotalamount','qsales_enquiry.updated_at',DB::raw("DATE_FORMAT(qsales_enquiry.validity, '%d-%m-%Y') as validity"),'qsales_enquiry.grandtotalamount',DB::raw("DATE_FORMAT(qsales_enquiry.quotedate, '%d-%m-%Y') as quotedate"))->whereDate('quotedate','>=',$fromdate)->whereDate('quotedate','<=',$todate)->orderby('qsales_enquiry.id', 'desc');
            $query->where('qsales_enquiry.del_flag', 1)->orderby('qsales_enquiry.id', 'desc')->where('qsales_enquiry.branch',$branch)->where('qsales_enquiry.salesman',$request->sid);
            $data = $query->get();

               foreach ($data as $key => $value) {


                $totalCount = \DB::table('qsales_enquiry_rfq')->where('enquiry_id', '=', $value->id)->count();
                $value->total = $totalCount;
                $cdate = date('d-m-Y');
           $exdate = $value->validity;

            if ($exdate <= $cdate) {
                $value->enqstatus = "Expired";
            }
            else {
               $value->enqstatus = "Active";
            }


            $date1     = date_create($cdate);
            $date2     = date_create($exdate);

            $diff      = date_diff($date1,$date2);
            $value->redays = $diff->days;

        }


            $count_filter = $query->count();
            $count_total = EnquiryModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
          }

        }

         $salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->where('branch',$branch)->get();

         return view('Reports.reports.enquiryreport',compact('salesmen'));
    }








}

<?php

namespace App\Http\Controllers\support_ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

use App\support_ticket\TicketModel;

use DB;
use Auth;

class Open_closeticketController extends Controller
{
    /**
     * Detail : Open Tickets
     * Date   : 30-11-2022
     */
    public function index(Request $request)
    {   
        $login_user = Auth::user()->id;

        if ($request->ajax()) {
            $data = TicketModel::select('qsupport_ticket_tickets.*', DB::raw("DATE_FORMAT(qsupport_ticket_tickets.completion_date, '%d-%b-%Y') as due_date"), DB::raw("DATE_FORMAT(qsupport_ticket_tickets.created_at, '%d-%b-%Y') as ticket_date"), 'qcrm_customer_details.cust_name')
                                    ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
                                    ->where('qsupport_ticket_tickets.del_flag', 1)
                                    ->where('qsupport_ticket_tickets.ticket_status', 1) // Open
                                    ->where('qsupport_ticket_tickets.assigned_status', 1)
                                    ->where('qsupport_ticket_tickets.add_admin_id', $login_user)
                                    ->orderBy('qsupport_ticket_tickets.id', 'DESC')
                                    ->get();
                          
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('expirydays', function($row){
                        $days_diff = 0;
                        $ex_prefix = '';
                        $ex_suffix = '';
                        $today     = date('Y-m-d');

                        $expiry_date = $row->completion_date;
                        if ($expiry_date != NULL && $expiry_date != '') {
                            if ($expiry_date <= $today) {
                                $ex_prefix = '<span style="color:red;" >Expired</span> ';
                                $ex_suffix = ' Days';
                            }
                            else {
                                $ex_prefix = '';
                                $ex_suffix = ' Days to Expire';
                            }

                            $date1     = date_create($today);
                            $date2     = date_create($expiry_date);

                            $diff      = date_diff($date1,$date2);
                            $days_diff = $diff->days;
                        }
                        else {
                            $days_diff = '';
                        }
                        
                        return $ex_prefix.$days_diff.$ex_suffix;
                    })
                    ->addColumn('action', function($row){
                        return $row->id;
                    })
                    ->editColumn('assignd_user', function($row) {
                        $tid = $row->id;
                        $assigndusers = '';
                        $userarr   = array();
                        $users_arr = DB::table('qsupport_ticket_assignments')
                                            ->leftJoin('users', 'qsupport_ticket_assignments.assigned_to', '=', 'users.id')
                                            ->select('users.name')
                                            ->where('qsupport_ticket_assignments.ticket_id', '=', $tid)
                                            ->orderBy('qsupport_ticket_assignments.id', 'ASC')
                                            ->get();

                        foreach ($users_arr as $key => $users) {
                            array_push($userarr, $users->name);
                        }
                        
                        $assigndusers = implode(',' , $userarr);
                        return $assigndusers;
                    })
                    ->editColumn('ticket_status', function($row) {
                        if ($row->ticket_status == 1) {
                            return "<span class='kt-badge kt-badge--inline kt-badge--success'>Open</span>";
                        }
                        elseif ($row->ticket_status == 0) {
                            return "<span class='kt-badge kt-badge--inline kt-badge--danger'>Closed</span>";
                        }
                        else {
                            return "-";
                        }
                    })
                    ->rawColumns(['action', 'expirydays', 'ticket_status'])
                    ->make(true);        
        }

        return view('support_ticket.open_close_ticket.index');
    }

    /**
     * Details : Closed Tickets
     * Date    : 05-11-2022
     */
    public function closed_ticketslist(Request $request)
    {   
        $login_user = Auth::user()->id;

        if ($request->ajax()) {
            $data = TicketModel::select('qsupport_ticket_tickets.*', DB::raw("DATE_FORMAT(qsupport_ticket_tickets.completion_date, '%d-%b-%Y') as due_date"), DB::raw("DATE_FORMAT(qsupport_ticket_tickets.created_at, '%d-%b-%Y') as ticket_date"), 'qcrm_customer_details.cust_name')
                                    ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
                                    ->where('qsupport_ticket_tickets.del_flag', 1)
                                    ->where('qsupport_ticket_tickets.ticket_status', 0) // Closed
                                    ->where('qsupport_ticket_tickets.assigned_status', 1)
                                    ->where('qsupport_ticket_tickets.add_admin_id', $login_user)
                                    ->orderBy('qsupport_ticket_tickets.id', 'DESC')
                                    ->get();
                          
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('expirydays', function($row){
                        $days_diff = 0;
                        $ex_prefix = '';
                        $ex_suffix = '';
                        $today     = date('Y-m-d');

                        $expiry_date = $row->completion_date;
                        if ($expiry_date != NULL && $expiry_date != '') {
                            if ($expiry_date <= $today) {
                                $ex_prefix = '<span style="color:red;" >Expired</span> ';
                                $ex_suffix = ' Days';
                            }
                            else {
                                $ex_prefix = '';
                                $ex_suffix = ' Days to Expire';
                            }

                            $date1     = date_create($today);
                            $date2     = date_create($expiry_date);

                            $diff      = date_diff($date1,$date2);
                            $days_diff = $diff->days;
                        }
                        else {
                            $days_diff = '';
                        }
                        
                        return $ex_prefix.$days_diff.$ex_suffix;
                    })
                    ->addColumn('action', function($row){
                        return $row->id;
                    })
                    ->editColumn('assignd_user', function($row) {
                        $tid = $row->id;
                        $assigndusers = '';
                        $userarr   = array();
                        $users_arr = DB::table('qsupport_ticket_assignments')
                                            ->leftJoin('users', 'qsupport_ticket_assignments.assigned_to', '=', 'users.id')
                                            ->select('users.name')
                                            ->where('qsupport_ticket_assignments.ticket_id', '=', $tid)
                                            ->orderBy('qsupport_ticket_assignments.id', 'ASC')
                                            ->get();

                        foreach ($users_arr as $key => $users) {
                            array_push($userarr, $users->name);
                        }
                        
                        $assigndusers = implode(',' , $userarr);
                        return $assigndusers;
                    })
                    ->editColumn('ticket_status', function($row) {
                        if ($row->ticket_status == 1) {
                            return "<span class='kt-badge kt-badge--inline kt-badge--success'>Open</span>";
                        }
                        elseif ($row->ticket_status == 0) {
                            return "<span class='kt-badge kt-badge--inline kt-badge--danger'>Closed</span>";
                        }
                        else {
                            return "-";
                        }
                    })
                    ->rawColumns(['action', 'expirydays', 'ticket_status'])
                    ->make(true);        
        }

        return null;
    }

    /**
     * Details : View Ticket Details
     * Date    : 05-12-2022
     */
    public function view_ticket_details(Request $request)
    {
        return view('support_ticket.open_close_ticket.view_ticketdetails');
    }
}
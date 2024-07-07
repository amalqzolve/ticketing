<?php

namespace App\Http\Controllers\support_ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

use App\support_ticket\TicketModel;
use App\support_ticket\TicketStatusModel;
use App\support_ticket\TicketactivitylogModel;
use App\support_ticket\DelegationsModel;
use App\support_ticket\Ticketcommon_commentModel;

use App\User;

use DB;
use Auth;

class AssignTicketController extends Controller
{
    /**
     * Detail : Assign Ticket
     * Date   : 16-11-2022
     */
    // public function index(Request $request)
    // {   
    //     $log_userid = Auth::user()->id;
    //     if ($request->ajax()) {
    //         $data = TicketModel::select('qsupport_ticket_tickets.*', DB::raw("DATE_FORMAT(qsupport_ticket_tickets.completion_date, '%d-%b-%Y') as due_date"), /*'users.name as assignd_user',*/ 'qcrm_customer_details.cust_name')
    //                                     ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
    //                                     // ->leftJoin('users', 'qsupport_ticket_tickets.assigned_to', '=', 'users.id')
    //                                     ->where('qsupport_ticket_tickets.del_flag', 1)
    //                                     ->where('qsupport_ticket_tickets.assigned_to', $log_userid)
    //                                     ->where('qsupport_ticket_tickets.assigned_status', 1)
    //                                     ->orderBy('qsupport_ticket_tickets.id', 'DESC')
    //                                     ->get();

    //         return Datatables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('action', function($row){
    //                     return $row->id;
    //                 })
    //                 ->editColumn('ticket_status', function($row) {
    //                     if ($row->ticket_status == 1) {
    //                         return "Open";
    //                     }
    //                     elseif ($row->ticket_status == 0) {
    //                         return "Closed";
    //                     }
    //                     else {
    //                         return "-";
    //                     }
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //     }

    //     $tickstatus = TicketStatusModel::select('id','status')->where('del_flag',1)->get();
    //     return view('support_ticket.assign_ticket.index', compact('tickstatus'));
    // }
    public function index(Request $request)
    {   
        $log_userid = Auth::user()->id;

        if ($request->ajax()) {
            $data = DB::table('qsupport_ticket_assignments')
                            ->select('qsupport_ticket_tickets.*', DB::raw("DATE_FORMAT(qsupport_ticket_tickets.completion_date, '%d-%b-%Y') as due_date"), DB::raw("DATE_FORMAT(qsupport_ticket_tickets.created_at, '%d-%b-%Y') as ticket_date"), 'qcrm_customer_details.cust_name', 'qsupport_ticket_assignments.id as assignid', 'qsupport_ticket_assignments.ticket_status as ticketstatus', 'qsupport_ticket_assignments.delegation_flag', 'qsupport_ticket_ticket_status.status as present_status')
                            ->leftJoin('qsupport_ticket_tickets', 'qsupport_ticket_assignments.ticket_id', '=', 'qsupport_ticket_tickets.id')
                            ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
                            ->leftJoin('qsupport_ticketstatus_updations', function ($join) {
                                $join->on('qsupport_ticket_tickets.id', '=', 'qsupport_ticketstatus_updations.ticket_id')
                                     ->where('qsupport_ticketstatus_updations.del_flag', '=', 1)
                                     ->where('qsupport_ticketstatus_updations.user_id', '=', Auth::user()->id); // Status updated by the login user
                            })
                            ->leftJoin('qsupport_ticket_ticket_status', 'qsupport_ticketstatus_updations.status_id', '=', 'qsupport_ticket_ticket_status.id')
                            ->where('qsupport_ticket_assignments.assigned_to', '=', $log_userid) // Assigned to login user
                            ->where('qsupport_ticket_assignments.ticket_status', '=', 1) // Open
                            ->orderBy('qsupport_ticket_assignments.id', 'DESC')
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
                                $ex_prefix = 'Expired ';
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
                    ->editColumn('ticketstatus', function($row) {
                        if ($row->ticketstatus == 1) {
                            return "Open";
                        }
                        elseif ($row->ticketstatus == 0) {
                            return "Closed";
                        }
                        else {
                            return "-";
                        }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $tickstatus = TicketStatusModel::select('id','status')->where('del_flag',1)->get();
        $users      = User::select('id','name')->get();
        return view('support_ticket.assign_ticket.index', compact('tickstatus', 'users'));
    }

    /**
     * Detail : Delegated Tickets
     * Date   : 15-12-2022
     */
    public function delegated_ticketlist(Request $request)
    {   
        $log_userid = Auth::user()->id;

        if ($request->ajax()) {
            $data = DelegationsModel::select('qsupport_ticket_tickets.*', DB::raw("DATE_FORMAT(qsupport_ticket_tickets.completion_date, '%d-%b-%Y') as due_date"), DB::raw("DATE_FORMAT(qsupport_ticket_tickets.created_at, '%d-%b-%Y') as ticket_date"), 'qcrm_customer_details.cust_name', 'qsupport_ticket_delegations.id as delgn_id', 'qsupport_ticket_delegations.ticket_status as delgn_ticketstatus', 'qsupport_ticket_ticket_status.status as present_status', 'qsupport_ticket_delegations.assignment_id as delgn_assignid')
                                        ->leftJoin('qsupport_ticket_tickets', function ($join) {
                                            $join->on('qsupport_ticket_delegations.ticket_id', '=', 'qsupport_ticket_tickets.id')
                                                ->where('qsupport_ticket_tickets.del_flag', '=', 1)
                                                ->where('qsupport_ticket_tickets.ticket_status', '=', 1); // Open
                                        })
                                        ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
                                        ->leftJoin('qsupport_ticketstatus_updations', function ($join) {
                                            $join->on('qsupport_ticket_tickets.id', '=', 'qsupport_ticketstatus_updations.ticket_id')
                                                 ->where('qsupport_ticketstatus_updations.del_flag', '=', 1)
                                                 ->where('qsupport_ticketstatus_updations.user_id', '=', Auth::user()->id); // Status updated by the login user
                                        })
                                        ->leftJoin('qsupport_ticket_ticket_status', 'qsupport_ticketstatus_updations.status_id', '=', 'qsupport_ticket_ticket_status.id')
                                        ->where('qsupport_ticket_delegations.assigned_to', '=', $log_userid)
                                        ->where('qsupport_ticket_delegations.ticket_status', '=', 1) // Open
                                        ->orderBy('qsupport_ticket_delegations.id', 'DESC')
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
                                $ex_prefix = 'Expired ';
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
                    ->editColumn('delgn_ticketstatus', function($row) {
                        if ($row->delgn_ticketstatus == 1) {
                            return "Open";
                        }
                        elseif ($row->delgn_ticketstatus == 0) {
                            return "Closed";
                        }
                        else {
                            return "-";
                        }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return null;
    }

    /**
     * Detail : Update Ticket Status
     * Date   : 1-12-2022
     */
    public function ticketstatupdate(Request $request) 
    {
        // For new status
        if ($request->status_id != '' && (int)$request->status_id == 0) {
            $ins_statid = TicketStatusModel::create([
                'status'       => $request->status_id,
                'add_ip_addrs' => request()->ip(),
                'add_admin_id' => Auth::user()->id
            ])->id;
        }
        else {
            $ins_statid = $request->status_id;
        }

        // Update the older entry
        DB::table('qsupport_ticketstatus_updations')
                ->where('ticket_id',  $request->iid)
                ->where('del_flag',  1)
                ->update(['del_flag' => 2]);
        
        $updt_id= DB::table('qsupport_ticketstatus_updations')->insertGetId([
            // 'assignment_id'  => $request->assignid,
            'ticket_id'      => $request->iid,
            'user_id'        => Auth::user()->id,
            'status_date'    => ($request->st_date != '' && $request->st_date != null) ? date('Y-m-d', strtotime($request->st_date)) : null,
            'status_id'      => $ins_statid,
            'present_status' => $request->present_stat,
            'comments'       => $request->comments,
            'add_ip_addrs'   => request()->ip(),
            'add_admin_id'   => Auth::user()->id
        ]);

        if($updt_id)
        {
            // Save the Activity
            TicketactivitylogModel::create([
                'subject_id'    => $updt_id,
                'subject'       => 'id',
                'ticket_id'     => $request->iid,
                'activity_type' => 'Ticket Status Updated',
                'activity'      => 'ticketstatus_updations',
                'user_id'       => Auth::user()->id,
                'add_ip_addrs'  => request()->ip()
            ]);

            $stat = 'success';
            $msg  = 'Updation Successful :)';
        }
        else
        {
            $stat = 'danger';
            $msg  = 'Updation Failed :(';
        }

        $data = array(
            'toast_stat' => $stat,
            'toast_msg'  => $msg
        );

        echo json_encode($data);
    }

    /**
     * Detail : Close Ticket
     * Date   : 01-12-2022
     */
    public function close_ticket(Request $request)
    {
        $log_user  = Auth::user()->id;
        $ticketid  = $request->iid;
        $assign_id = $request->assignid;

        $ifupdt = DB::table('qsupport_ticket_assignments')
                        ->where('id',  $assign_id)
                        ->where('ticket_id',  $ticketid)
                        ->where('assigned_to',  $log_user)
                        ->update([
                            'ticket_status'     => 0,
                            'close_comments'    => $request->comment,
                            'ticketclosed_date' => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s'),
                            'edit_ip_addrs'     => request()->ip()
                    ]);
        
        // Check if ticket closed by all assigned users
        $num = DB::table('qsupport_ticket_assignments')->where('ticket_id', '=', $ticketid)
                                                       ->where('ticket_status', '=', 1)
                                                       ->count();
        
        if ($num == 0) {
            TicketModel::whereId($ticketid)->update([
                'ticket_status'     => 0,
                'ticketclosed_date' => date('Y-m-d H:i:s')
            ]);
        }
        // Save the Activity
        TicketactivitylogModel::create([
            'subject_id'    => $assign_id,
            'subject'       => 'id',
            'ticket_id'     => $ticketid,
            'activity_type' => 'Ticket Closed',
            'activity'      => 'ticket_assignments',
            'user_id'       => Auth::user()->id,
            'add_ip_addrs'  => request()->ip()
        ]);
        
        // echo $ifupdt;
        echo $num;
    }

    /**
     * Detail : Delegate Ticket Submit
     * Date   : 03-12-2022
     */
    public function delegateticketsubmit(Request $request)
    {
        $flag = 0;
        
        // Save Delegations
        foreach ($request->user_id as $key => $delegate) {
            $ifCre = DelegationsModel::create([
                    'assignment_id'       => $request->assignid,
                    'ticket_id'           => $request->iid,
                    'assigned_to'         => $delegate,
                    'assigned_by'         => Auth::user()->id,
                    'assigned_date'       => date('Y-m-d'),
                    'delegation_comments' => $request->comments,
                    'add_ip_addrs'        => request()->ip()
            ])->id;

            if ($ifCre) {
                $flag = 1;
                // Save in Assignments History
                DB::table('qsupport_ticket_assignment_history')->insert([
                    'ticket_id'     => $request->iid,
                    'assigned_to'   => $delegate,
                    'assigned_by'   => Auth::user()->id,
                    'assigned_date' => date('Y-m-d'),
                    'add_ip_addrs'  => request()->ip()
                ]);
            }
            else {
                $flag = 0;
            }

        } // End Foreach

        // Update Assignments
        DB::table('qsupport_ticket_assignments')
                ->where('id',  $request->assignid)
                ->update([
                    'delegation_comments' => $request->comments,
                    'delegated_date'      => date('Y-m-d H:i:s'),
                    'delegation_flag'     => 1, // Delegated
                    'updated_at'          => date('Y-m-d H:i:s'),
                    'edit_ip_addrs'       => request()->ip()
            ]);
        
        // Save the Activity
        TicketactivitylogModel::create([
            'subject_id'    => $request->assignid,
            'subject'       => 'assignment_id',
            'ticket_id'     => $request->iid,
            'activity_type' => 'Ticket Delegated',
            'activity'      => 'ticket_delegations',
            'user_id'       => Auth::user()->id,
            'add_ip_addrs'  => request()->ip()
        ]);

        if ($flag == 1) {
            $stat = 'success';
            $msg  = 'Ticket Delegation Successful :)';
        }
        else {
            $stat = 'danger';
            $msg  = 'Ticket Delegation Failed :(';
        }

        $data = array(
            'toast_stat' => $stat,
            'toast_msg'  => $msg
        );

        echo json_encode($data);
    }

    /**
     * Details : Assigned Tickets - View Ticket Details
     * Date    : 14-12-2022
     */
    public function viewassigned_ticket(Request $request)
    {
        $id             = $request->id;
        $ticket_history = array();
        $ticketdet_rslt = TicketModel::select('qsupport_ticket_tickets.*', 'users.name as created_by', 'qcrm_customer_details.cust_name', 'qsupport_ticket_ticket_category.category', 'qsupport_ticket_assignments.id as assignid', 'qsupport_ticket_assignments.delegation_flag', 'qsupport_ticket_assignments.ticket_status as assign_ticketstatus')
                                            ->leftJoin('users', 'qsupport_ticket_tickets.add_admin_id', '=', 'users.id')
                                            ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
                                            ->leftJoin('qsupport_ticket_ticket_category', 'qsupport_ticket_tickets.ticket_category_id', '=', 'qsupport_ticket_ticket_category.id')
                                            ->leftJoin('qsupport_ticket_assignments', function ($join) {
                                                $join->on('qsupport_ticket_tickets.id', '=', 'qsupport_ticket_assignments.ticket_id')
                                                     ->where('qsupport_ticket_assignments.assigned_to', '=', Auth::user()->id);
                                            })
                                            ->where('qsupport_ticket_tickets.id', '=', $id)
                                            ->get();
        
        foreach ($ticketdet_rslt as $key => $val) {
            $ticketdet             = $val;
            $ticketdet['assignid'] = $request->asid;
        }
        
        $ticket_attachmnts = DB::table('qsupport_ticket_ticketuploads')
                                    ->select('id', 'ticket_id', 'file_name')
                                    ->where('ticket_id', '=', $id)
                                    ->where('del_flag', '=', '1')
                                    ->get();
        
        /*$common_comments   = Ticketcommon_commentModel::latest()
                                            ->select('qsupport_ticket_commoncomments.*', 'users.name as commented_by', 'qsupport_ticket_tickets.ticketID')
                                            ->leftJoin('qsupport_ticket_tickets', 'qsupport_ticket_commoncomments.ticket_id', '=', 'qsupport_ticket_tickets.id')
                                            ->leftJoin('users', 'qsupport_ticket_commoncomments.comment_by', '=', 'users.id')
                                            ->where('qsupport_ticket_commoncomments.del_flag', '=', 1)
                                            ->where('qsupport_ticket_commoncomments.ticket_id', '=', $id)
                                            ->get();
        
        $ticketupdations   = DB::table('qsupport_ticketstatus_updations')
                                    ->select('qsupport_ticketstatus_updations.id', 'qsupport_ticketstatus_updations.ticket_id', 'qsupport_ticketstatus_updations.user_id', 'qsupport_ticketstatus_updations.created_at', 'qsupport_ticketstatus_updations.comments', 'users.name', 'users.image', 'qsupport_ticket_ticket_status.status')
                                    ->leftJoin('users', 'qsupport_ticketstatus_updations.user_id', '=', 'users.id')
                                    ->leftJoin('qsupport_ticket_ticket_status', 'qsupport_ticketstatus_updations.status_id', '=', 'qsupport_ticket_ticket_status.id')
                                    ->where('qsupport_ticketstatus_updations.ticket_id', '=', $id)
                                    ->where('qsupport_ticketstatus_updations.del_flag', '>', 0)
                                    ->orderBy('qsupport_ticketstatus_updations.created_at', 'DESC')
                                    ->get();

        $ticketclosed_stat = DB::table('qsupport_ticket_assignments')
                                    ->select('qsupport_ticket_assignments.*', 'u1.name as assignedto', 'u1.image as assignedto_img', 'u2.name as assignedby', 'u2.image as assignedby_img')
                                    ->leftJoin('users as u1', 'qsupport_ticket_assignments.assigned_to', '=', 'u1.id')
                                    ->leftJoin('users as u2', 'qsupport_ticket_assignments.assigned_by', '=', 'u2.id')
                                    ->where('qsupport_ticket_assignments.ticket_id', '=', $id)
                                    ->get();

        $ticket_delegate   =  DelegationsModel::latest()
                                        ->select('qsupport_ticket_delegations.*', 'u1.name as assignedto', 'u1.image as assignedto_img', 'u2.name as assignedby', 'u2.image as assignedby_img')
                                        ->leftJoin('users as u1', 'qsupport_ticket_delegations.assigned_to', '=', 'u1.id')
                                        ->leftJoin('users as u2', 'qsupport_ticket_delegations.assigned_by', '=', 'u2.id')
                                        ->where('qsupport_ticket_delegations.ticket_id', '=', $id)
                                        ->get();*/
        
        // begin :: Ticket History
        $ticket_actvlog = TicketactivitylogModel::latest()->where('ticket_id', '=', $id)->get();
        
        foreach ($ticket_actvlog as $key => $actv_log) {
            $tbl     = 'qsupport_'.$actv_log->activity;
            $sub     = $actv_log->subject;
            $sub_id  = $actv_log->subject_id;
            $ticktid = $actv_log->ticket_id;

            if($actv_log->activity_type == 'Ticket Added')
            {
                // Ticket Assigned
                $temparr2 = DB::table('qsupport_ticket_assignments')
                                ->leftJoin('users as u_to', 'qsupport_ticket_assignments.assigned_to', '=', 'u_to.id')
                                ->leftJoin('users as u_by', 'qsupport_ticket_assignments.assigned_by', '=', 'u_by.id')
                                ->select('qsupport_ticket_assignments.created_at', 'u_to.name as asgned_to', 'u_by.name as asgned_by')
                                ->where('qsupport_ticket_assignments.ticket_id', '=', $ticktid)
                                ->get();
                                  
                foreach ($temparr2 as $key => $v2) {
                    $v2->title = "Ticket Assigned To";
                    array_push($ticket_history, $v2);
                }

                // Ticket generated
                $temparr1 = DB::table($tbl)
                                ->leftJoin('users', 'qsupport_ticket_tickets.add_admin_id', '=', 'users.id')
                                ->select('qsupport_ticket_tickets.id', 'qsupport_ticket_tickets.ticketID', 'qsupport_ticket_tickets.created_at', 'users.name as user_name')
                                ->where($tbl.'.'.$sub, '=', $sub_id)
                                ->get();

                foreach ($temparr1 as $key => $v1) {
                    $v1->title = "Ticket Created By";
                    array_push($ticket_history, $v1);
                }
           
            }

            // Ticket Delegated
            if($actv_log->activity_type == 'Ticket Delegated')
            {
                $temparr3 = DB::table($tbl)
                                ->leftJoin('users as u_to', 'qsupport_ticket_delegations.assigned_to', '=', 'u_to.id')
                                ->leftJoin('users as u_by', 'qsupport_ticket_delegations.assigned_by', '=', 'u_by.id')
                                ->select('qsupport_ticket_delegations.created_at', 'u_to.name as asgned_to', 'u_by.name as asgned_by')
                                ->where($tbl.'.'.$sub, '=', $sub_id)
                                ->get();
                
                foreach ($temparr3 as $key => $v3) {
                    $v3->title = "Ticket Delegated To";
                    array_push($ticket_history, $v3);
                }
            }

            // ----- Ticket Updates -----
            // Updated Status
            if($actv_log->activity_type == 'Ticket Status Updated')
            {
                $temparr4 = DB::table($tbl)
                                ->leftJoin('users', 'qsupport_ticketstatus_updations.add_admin_id', '=', 'users.id')
                                ->leftJoin('qsupport_ticket_ticket_status', 'qsupport_ticketstatus_updations.status_id', '=', 'qsupport_ticket_ticket_status.id')
                                ->select('qsupport_ticketstatus_updations.created_at', 'users.name', 'qsupport_ticket_ticket_status.status')
                                ->where($tbl.'.'.$sub, '=', $sub_id)
                                ->get();
                
                foreach ($temparr4 as $key => $v4) {
                    $v4->title       = "Ticket Updates";
                    $v4->labelsuffix = "Updated Status : ";
                    $v4->labelcontent = $v4->status;
                    array_push($ticket_history, $v4);
                }
            }

            // Commented
            if($actv_log->activity_type == 'Comment Added')
            {
                $temparr5 = DB::table($tbl)
                                ->leftJoin('users', 'qsupport_ticket_commoncomments.comment_by', '=', 'users.id')
                                ->select('qsupport_ticket_commoncomments.comment', 'qsupport_ticket_commoncomments.created_at', 'users.name')
                                ->where($tbl.'.'.$sub, '=', $sub_id)
                                ->get();
                
                foreach ($temparr5 as $key => $v5) {
                    $v5->title        = "Ticket Updates";
                    $v5->labelsuffix  = "commented : ";
                    $v5->labelcontent = $v5->comment;
                    array_push($ticket_history, $v5);
                }
            }

            // Closed Ticket
            if($actv_log->activity_type == 'Ticket Closed')
            {
                $temparr6 = DB::table($tbl)
                                ->leftJoin('users', $tbl.'.assigned_to', '=', 'users.id')
                                ->select($tbl.'.close_comments', $tbl.'.ticketclosed_date as created_at', 'users.name')
                                ->where($tbl.'.'.$sub, '=', $sub_id)
                                ->get();
                
                foreach ($temparr6 as $key => $v6) {
                    $v6->title       = "Ticket Updates";
                    $v6->labelsuffix = "closed the assigned Ticket.";
                    array_push($ticket_history, $v6);
                }
            }

        } // End Foreach
        // end :: Ticket History
        
        return view('support_ticket.assign_ticket.view_ticket', compact('ticketdet', 'ticket_attachmnts', 'ticket_history'));
    }

    /**
     * Details : View Delegated Tickets
     * Date    : 15-12-2022
     */
    public function viewdelegated_ticket(Request $request)
    {
        $tid            = $request->id;
        
        $ticketdet_rslt = TicketModel::select('qsupport_ticket_tickets.*', 'users.name as created_by', 'qcrm_customer_details.cust_name', 'qsupport_ticket_ticket_category.category', 'qsupport_ticket_delegations.ticket_status as delgt_ticketstatus')
                                            ->leftJoin('users', 'qsupport_ticket_tickets.add_admin_id', '=', 'users.id')
                                            ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
                                            ->leftJoin('qsupport_ticket_ticket_category', 'qsupport_ticket_tickets.ticket_category_id', '=', 'qsupport_ticket_ticket_category.id')
                                            ->leftJoin('qsupport_ticket_delegations', function ($join) {
                                                $join->on('qsupport_ticket_tickets.id', '=', 'qsupport_ticket_delegations.ticket_id')
                                                     ->where('qsupport_ticket_delegations.assigned_to', '=', Auth::user()->id); // Delegated to Login user
                                            })
                                            ->where('qsupport_ticket_tickets.id', '=', $tid)
                                            ->get();
        
        foreach ($ticketdet_rslt as $key => $val) {
            $ticketdet              = $val;
            $ticketdet['delgn_id']  = $request->did;
            $ticketdet['assign_id'] = $request->asid;
        }
        
        $ticket_attachmnts = DB::table('qsupport_ticket_ticketuploads')
                                    ->select('id', 'ticket_id', 'file_name')
                                    ->where('ticket_id', '=', $tid)
                                    ->where('del_flag', '=', '1')
                                    ->get();

        $common_comments   = Ticketcommon_commentModel::latest()
                                    ->select('qsupport_ticket_commoncomments.*', 'users.name as commented_by', 'qsupport_ticket_tickets.ticketID')
                                    ->leftJoin('qsupport_ticket_tickets', 'qsupport_ticket_commoncomments.ticket_id', '=', 'qsupport_ticket_tickets.id')
                                    ->leftJoin('users', 'qsupport_ticket_commoncomments.comment_by', '=', 'users.id')
                                    ->where('qsupport_ticket_commoncomments.del_flag', '=', 1)
                                    ->where('qsupport_ticket_commoncomments.ticket_id', '=', $tid)
                                    ->get();

        $ticketupdations   = DB::table('qsupport_ticketstatus_updations')
                                    ->select('qsupport_ticketstatus_updations.id', 'qsupport_ticketstatus_updations.ticket_id', 'qsupport_ticketstatus_updations.user_id', 'qsupport_ticketstatus_updations.created_at', 'qsupport_ticketstatus_updations.comments', 'users.name', 'users.image', 'qsupport_ticket_ticket_status.status')
                                    ->leftJoin('users', 'qsupport_ticketstatus_updations.user_id', '=', 'users.id')
                                    ->leftJoin('qsupport_ticket_ticket_status', 'qsupport_ticketstatus_updations.status_id', '=', 'qsupport_ticket_ticket_status.id')
                                    ->where('qsupport_ticketstatus_updations.ticket_id', '=', $tid)
                                    ->where('qsupport_ticketstatus_updations.del_flag', '>', 0)
                                    ->orderBy('qsupport_ticketstatus_updations.created_at', 'DESC')
                                    ->get();

        $ticketclosed_stat = DB::table('qsupport_ticket_assignments')
                                    ->select('qsupport_ticket_assignments.*', 'u1.name as assignedto', 'u1.image as assignedto_img', 'u2.name as assignedby', 'u2.image as assignedby_img')
                                    ->leftJoin('users as u1', 'qsupport_ticket_assignments.assigned_to', '=', 'u1.id')
                                    ->leftJoin('users as u2', 'qsupport_ticket_assignments.assigned_by', '=', 'u2.id')
                                    ->where('qsupport_ticket_assignments.ticket_id', '=', $tid)
                                    ->get();

        $ticket_delegate   =  DelegationsModel::latest()
                                        ->select('qsupport_ticket_delegations.*', 'u1.name as assignedto', 'u1.image as assignedto_img', 'u2.name as assignedby', 'u2.image as assignedby_img')
                                        ->leftJoin('users as u1', 'qsupport_ticket_delegations.assigned_to', '=', 'u1.id')
                                        ->leftJoin('users as u2', 'qsupport_ticket_delegations.assigned_by', '=', 'u2.id')
                                        ->where('qsupport_ticket_delegations.ticket_id', '=', $tid)
                                        ->get();
        
        return view('support_ticket.assign_ticket.view_delegateticket', compact('ticketdet', 'ticket_attachmnts', 'common_comments', 'ticketupdations', 'ticketclosed_stat', 'ticket_delegate'));
    }

    /**
     * Detail : Close Ticket for Delegate
     * Date   : 15-12-2022
     */
    public function delegtclose_ticket(Request $request)
    {
        $log_user  = Auth::user()->id;
        $ticketid  = $request->iid;
        $delgnid   = $request->delgnid;
        $assignid  = $request->assgn_id;

        $ifupdt = DelegationsModel::where('id',  $delgnid)
                                        ->where('ticket_id',  $ticketid)
                                        ->where('assigned_to',  $log_user)
                                        ->update([
                                            'ticket_status'     => 0,
                                            'close_comments'    => $request->comment,
                                            'ticketclosed_date' => date('Y-m-d H:i:s'),
                                            'updated_at'        => date('Y-m-d H:i:s'),
                                            'edit_ip_addrs'     => request()->ip()
                                        ]);
        
        // Check if ticket closed by all delegated users
        $num = DelegationsModel::where('assignment_id', '=', $assignid)
                                    ->where('ticket_id', '=', $ticketid)
                                    ->where('ticket_status', '=', 1)
                                    ->count();
        
        if ($num == 0) {
            DB::table('qsupport_ticket_assignments')->where('id', '=', $assignid)
                                                    ->update([
                                                        'delegation_flag' => 2 // All delegates closed the ticket
                                                    ]);
        }

        // Save the Activity
        TicketactivitylogModel::create([
            'subject_id'    => $delgnid,
            'subject'       => 'id',
            'ticket_id'     => $ticketid,
            'activity_type' => 'Ticket Closed',
            'activity'      => 'ticket_delegations',
            'user_id'       => Auth::user()->id,
            'add_ip_addrs'  => request()->ip()
        ]);
        
        // echo $ifupdt;
        echo $num;
    }


}
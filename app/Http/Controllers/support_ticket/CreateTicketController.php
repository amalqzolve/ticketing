<?php

namespace App\Http\Controllers\support_ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

use App\support_ticket\TicketModel;
use App\crm\CustomerModel;
use App\support_ticket\TicketcategoryModel;
use App\support_ticket\TicketactivitylogModel;
use App\support_ticket\Ticketcommon_commentModel;
use App\User;

use DB;
use Auth;

class CreateTicketController extends Controller
{
    /**
     * Detail : Unassigned Tickets List
     * Date   : 16-11-2022
     */
    public function index(Request $request)
    {
        $login_user = Auth::user()->id;

        if ($request->ajax()) {
            $data = TicketModel::select('qsupport_ticket_tickets.*', DB::raw("DATE_FORMAT(qsupport_ticket_tickets.completion_date, '%d-%b-%Y') as due_date"), DB::raw("DATE_FORMAT(qsupport_ticket_tickets.created_at, '%d-%b-%Y') as ticket_date"), 'qcrm_customer_details.cust_name')
                ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
                ->where('qsupport_ticket_tickets.del_flag', 1)
                ->where('qsupport_ticket_tickets.assigned_status', 0)
                ->where('qsupport_ticket_tickets.add_admin_id', $login_user)
                ->orderBy('qsupport_ticket_tickets.id', 'DESC')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('expirydays', function ($row) {
                    $days_diff = 0;
                    $ex_prefix = '';
                    $ex_suffix = '';
                    $today     = date('Y-m-d');

                    $expiry_date = $row->completion_date;
                    if ($expiry_date != NULL && $expiry_date != '') {
                        if ($expiry_date <= $today) {
                            $ex_prefix = '<span style="color:red;" >Expired</span> ';
                            $ex_suffix = ' Days';
                        } else {
                            $ex_prefix = '';
                            $ex_suffix = ' Days to Expire';
                        }

                        $date1     = date_create($today);
                        $date2     = date_create($expiry_date);

                        $diff      = date_diff($date1, $date2);
                        $days_diff = $diff->days;
                    } else {
                        $days_diff = '';
                    }

                    return $ex_prefix . $days_diff . $ex_suffix;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->editColumn('ticket_status', function ($row) {
                    if ($row->ticket_status == 1) {
                        return "<span class='kt-badge kt-badge--inline kt-badge--success'>Open</span>";
                    } elseif ($row->ticket_status == 0) {
                        return "<span class='kt-badge kt-badge--inline kt-badge--danger'>Closed</span>";
                    } else {
                        return "-";
                    }
                })
                ->rawColumns(['action', 'expirydays', 'ticket_status'])
                ->make(true);
        }

        return view('support_ticket.create_ticket.index');
    }

    /**
     * Detail : Assigned Tickets List
     * Date   : 16-11-2022
     */
    /*
    public function assignedlist(Request $request)
    {   
        if ($request->ajax()) {
            $data = TicketModel::select('qsupport_ticket_tickets.*', DB::raw("DATE_FORMAT(qsupport_ticket_tickets.completion_date, '%d-%b-%Y') as due_date"), 'users.name as assignd_user', 'qcrm_customer_details.cust_name')
                                    ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
                                    ->leftJoin('users', 'qsupport_ticket_tickets.assigned_to', '=', 'users.id')
                                    ->where('qsupport_ticket_tickets.del_flag', 1)
                                    ->where('qsupport_ticket_tickets.assigned_status', 1)
                                    ->orderBy('qsupport_ticket_tickets.id', 'DESC')
                                    ->get();
                                      
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return $row->id;
                    })
                    ->editColumn('ticket_status', function($row) {
                        if ($row->ticket_status == 1) {
                            return "Open";
                        }
                        elseif ($row->ticket_status == 0) {
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
    */
    public function assignedlist(Request $request)
    {
        $login_user = Auth::user()->id;

        if ($request->ajax()) {
            $data = TicketModel::select('qsupport_ticket_tickets.*', DB::raw("DATE_FORMAT(qsupport_ticket_tickets.completion_date, '%d-%b-%Y') as due_date"), DB::raw("DATE_FORMAT(qsupport_ticket_tickets.created_at, '%d-%b-%Y') as ticket_date"), 'qcrm_customer_details.cust_name')
                ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
                ->where('qsupport_ticket_tickets.del_flag', 1)
                ->where('qsupport_ticket_tickets.assigned_status', 1)
                ->where('qsupport_ticket_tickets.add_admin_id', $login_user)
                ->orderBy('qsupport_ticket_tickets.id', 'DESC')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('expirydays', function ($row) {
                    $days_diff = 0;
                    $ex_prefix = '';
                    $ex_suffix = '';
                    $today     = date('Y-m-d');

                    $expiry_date = $row->completion_date;
                    if ($expiry_date != NULL && $expiry_date != '') {
                        if ($expiry_date <= $today) {
                            $ex_prefix = '<span style="color:red;" >Expired</span> ';
                            $ex_suffix = ' Days';
                        } else {
                            $ex_prefix = '';
                            $ex_suffix = ' Days to Expire';
                        }

                        $date1     = date_create($today);
                        $date2     = date_create($expiry_date);

                        $diff      = date_diff($date1, $date2);
                        $days_diff = $diff->days;
                    } else {
                        $days_diff = '';
                    }

                    return $ex_prefix . $days_diff . $ex_suffix;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->editColumn('assignd_user', function ($row) {
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

                    $assigndusers = implode(',', $userarr);
                    return $assigndusers;
                })
                ->editColumn('ticket_status', function ($row) {
                    if ($row->ticket_status == 1) {
                        return "<span class='kt-badge kt-badge--inline kt-badge--success'>Open</span>";
                    } elseif ($row->ticket_status == 0) {
                        return "<span class='kt-badge kt-badge--inline kt-badge--danger'>Closed</span>";
                    } else {
                        return "-";
                    }
                })
                ->rawColumns(['action', 'expirydays', 'ticket_status'])
                ->make(true);
        }

        return null;
    }

    /**
     * Detail : Add New Ticket
     * Date   : 16-11-2022
     */
    public function createticket()
    {
        $customers  = CustomerModel::select('id', 'cust_name')->where('del_flag', 1)->get();
        $categories = TicketcategoryModel::select('id', 'category')->where('del_flag', 1)->get();
        $users      = User::select('id', 'name')->get();

        return view('support_ticket.create_ticket.add_ticket', compact('customers', 'categories', 'users'));
    }

    /**
     * Detail : Get data for project dropdown based on clients
     * Date   : 23-11-2022
     */
    public function client_projectsajax(Request $request)
    {
        $clientId = $request->id;
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where('client', '=', $clientId)->get();
        $out = array(
            'status' => 1,
            'data' => $projects
        );
        echo json_encode($out);
    }

    /**
     * Detail : Create Ticket Submit
     * Date   : 23-11-2022
     */
    public function ticket_submit(Request $request)
    {
        $msg  = '';
        $stat = '';

        $ins_id = TicketModel::create([
            'client_id'          => $request->client,
            'ticket_against'     => $request->ticketagnst,
            'ticket_againstname' => $request->tick_against_na,
            'project_id'         => $request->project,
            'ticket_title'       => $request->title,
            'ticket_category_id' => $request->category,
            'ticket_date'        => date('Y-m-d'),
            'completion_date'    => ($request->compltn_dt != '' && $request->compltn_dt != null) ? date('Y-m-d', strtotime($request->compltn_dt)) : null,
            'scope_of_work'      => $request->scopeofwork,
            'priority_id'        => $request->priority,
            'priority_name'      => $request->priority_na,
            'assigned_status'    => ($request->assignd_to != '') ? 1 : 0,
            'reference'          => $request->reference,
            'ticket_details'     => $request->tickt_det,
            'add_ip_addrs'       => request()->ip(),
            'add_admin_id'       => Auth::user()->id, // Ticket created by
            'ticket_status'      => 1 // Open
        ])->id;

        if ($ins_id) {
            // Create & save ticket ID
            $incr_det = DB::table('qsupport_ticket_ticketautoincr_code')->where('id', 1)->get();
            foreach ($incr_det as $key => $incrdet) {
                $start_no = $incrdet->start;
                $code     = $incrdet->code;
                $ticketid = $code . ($start_no + $ins_id);
            }

            TicketModel::whereId($ins_id)->update([
                'ticketID'     => $ticketid
            ]);

            // Save attachments
            $upld_arr = explode(',', $request->upldfiles);
            foreach ($upld_arr as $key => $uplds) {
                if ($uplds != '') {
                    DB::table('qsupport_ticket_ticketuploads')->insert([
                        'ticket_id'    => $ins_id,
                        'file_name'    => $uplds,
                        'add_ip_addrs' => request()->ip(),
                        'add_admin_id' => Auth::user()->id
                    ]);
                }
            } //End foreach

            if (isset($request->assignd_to) && $request->assignd_to != '') {
                foreach ($request->assignd_to as $key => $assignto) {
                    // Save the assigned users
                    DB::table('qsupport_ticket_assignments')->insert([
                        'ticket_id'     => $ins_id,
                        'assigned_to'   => $assignto,
                        'assigned_by'   => Auth::user()->id,
                        'assigned_date' => date('Y-m-d'),
                        'add_ip_addrs'  => request()->ip()
                    ]);

                    // Save in Assignments History
                    DB::table('qsupport_ticket_assignment_history')->insert([
                        'ticket_id'     => $ins_id,
                        'assigned_to'   => $assignto,
                        'assigned_by'   => Auth::user()->id,
                        'assigned_date' => date('Y-m-d'),
                        'add_ip_addrs'  => request()->ip()
                    ]);
                } //End Foreach
            } // End If

            // Save in Activity
            TicketactivitylogModel::create([
                'subject_id'    => $ins_id,
                'subject'       => 'id',
                'ticket_id'     => $ins_id,
                'activity_type' => 'Ticket Added',
                'activity'      => 'ticket_tickets',
                'user_id'       => Auth::user()->id,
                'add_ip_addrs'  => request()->ip()
            ]);

            $stat = 'success';
            $msg  = 'Submission Successful :)';
        } else {
            $stat = 'danger';
            $msg  = 'Submission Failed :(';
        }

        $data = array(
            'toast_stat' => $stat,
            'toast_msg'  => $msg
        );

        echo json_encode($data);
    }

    /**
     * Detail : Upload Ticket Attachments
     * Date   : 22-11-2022
     */
    public function upld_ticketattchment(Request $request)
    {
        $path = public_path('support_tickets/tickets');

        //    if(File::exists($path)) {
        // echo $request->UniqueID;
        //     }else{
        // echo $request->UniqueID;        
        //         File::makeDirectory($path, $mode = 0777, true, true);
        //     }

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $data[] = $name;
            }
        }
        return back()->with('success', 'Data Your files has been successfully added');
    }

    /**
     * Detail : Edit Ticket
     * Date   : 28-11-2022
     */
    public function editticket(Request $request, $id)
    {
        $customers         = CustomerModel::select('id', 'cust_name')->where('del_flag', 1)->get();
        $categories        = TicketcategoryModel::select('id', 'category')->where('del_flag', 1)->get();
        $users             = User::select('id', 'name')->get();
        $ticketdet         = TicketModel::find($id);
        $ticket_attachmnts = DB::table('qsupport_ticket_ticketuploads')
            ->select('id', 'ticket_id', 'file_name')
            ->where('ticket_id', '=', $id)
            ->where('del_flag', '=', '1')
            ->get();

        return view('support_ticket.create_ticket.edit_ticket', compact('customers', 'categories', 'users', 'ticketdet', 'ticket_attachmnts'));
    }

    /**
     * Detail : Update Ticket Submit
     * Date   : 29-11-2022
     */
    public function ticket_update(Request $request)
    {
        $msg    = '';
        $stat   = '';
        $tickid = $request->iid;

        $ifUpd = TicketModel::whereId($request->iid)->update([
            // 'client_id'          => $request->client,
            'ticket_against'     => $request->ticketagnst,
            'ticket_againstname' => $request->tick_against_na,
            'project_id'         => $request->project,
            'ticket_title'       => $request->title,
            'ticket_category_id' => $request->category,
            // 'ticket_date'        => ($request->ticket_dt != '' && $request->ticket_dt != null) ? date('Y-m-d', strtotime($request->ticket_dt)) : null,
            'completion_date'    => ($request->compltn_dt != '' && $request->compltn_dt != null) ? date('Y-m-d', strtotime($request->compltn_dt)) : null,
            'scope_of_work'      => $request->scopeofwork,
            'priority_id'        => $request->priority,
            'priority_name'      => $request->priority_na,
            'assigned_status'    => ($request->assignd_to != '') ? 1 : 0,
            'reference'          => $request->reference,
            'ticket_details'     => $request->tickt_det,
            'edit_ip_addrs'      => request()->ip(),
            'edit_admin_id'      => Auth::user()->id,
            // 'ticket_status'      => 1 // Open
        ]);

        if ($ifUpd) {
            // Ticket Attachments
            $new_uploads = array();
            $old_uploads = array();

            // Get already uploaded files
            $q1 = DB::table('qsupport_ticket_ticketuploads')
                ->select('id')
                ->where('ticket_id', '=', $tickid)
                ->where('del_flag', '=', 1)
                ->get();

            foreach ($q1 as $key => $v1) {
                array_push($old_uploads, $v1->id);
            }

            if ($request->upldfiles != '') {
                $tickt_docs = explode(',', $request->upldfiles);

                foreach ($tickt_docs as $key => $t_doc) {
                    // Check if doc exist
                    $q2 = DB::table('qsupport_ticket_ticketuploads')
                        ->select('id')
                        ->where('ticket_id', '=', $tickid)
                        ->where('file_name', '=', $t_doc)
                        ->where('del_flag', '=', 1)
                        ->get();

                    $check_status = count($q2);

                    foreach ($q2 as $key => $v2) {
                        array_push($new_uploads, $v2->id);
                    } //End foreach

                    if ($check_status < 1) { // If New File
                        DB::table('qsupport_ticket_ticketuploads')->insert([
                            'ticket_id'    => $tickid,
                            'file_name'    => $t_doc,
                            'add_ip_addrs' => request()->ip(),
                            'add_admin_id' => Auth::user()->id
                        ]);
                    } //End if
                } // End Foreach
            } // End if

            //Getting File ids removed in the form
            $del_uplds = array_diff($old_uploads, $new_uploads);

            foreach ($del_uplds as $key => $dlt_uplds) {
                DB::table('qsupport_ticket_ticketuploads')
                    ->where('id', $dlt_uplds)
                    ->update([
                        'del_flag'      => 0,
                        'updated_at'    => date('Y-m-d H:i:s'),
                        'edit_ip_addrs' => request()->ip(),
                        'edit_admin_id' => Auth::user()->id
                    ]);
            }

            if (isset($request->assignd_to) && $request->assignd_to != '') {
                foreach ($request->assignd_to as $key => $assignto) {
                    // Save the assigned users
                    DB::table('qsupport_ticket_assignments')->insert([
                        'ticket_id'     => $tickid,
                        'assigned_to'   => $assignto,
                        'assigned_by'   => Auth::user()->id,
                        'assigned_date' => date('Y-m-d'),
                        'add_ip_addrs'  => request()->ip()
                    ]);

                    // Save in Assignments History
                    DB::table('qsupport_ticket_assignment_history')->insert([
                        'ticket_id'     => $tickid,
                        'assigned_to'   => $assignto,
                        'assigned_by'   => Auth::user()->id,
                        'assigned_date' => date('Y-m-d'),
                        'add_ip_addrs'  => request()->ip()
                    ]);
                } // End Foreach
            } // End If

            // Save in Activity
            TicketactivitylogModel::create([
                'subject_id'    => $tickid,
                'subject'       => 'id',
                'ticket_id'     => $tickid,
                'activity_type' => 'Ticket Updated',
                'activity'      => 'ticket_tickets',
                'user_id'       => Auth::user()->id,
                'add_ip_addrs'  => request()->ip()
            ]);

            $stat = 'success';
            $msg  = 'Updation Successful :)';
        } else {
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
     * Detail : Ticket Delete
     * Date   : 30-11-2022
     */
    public function ticket_deletefn(Request $request)
    {
        $dlt_id  = $request->id;

        $ifdlt = TicketModel::whereId($dlt_id)->update([
            'del_flag'     => 0
        ]);

        // Save the Activity
        TicketactivitylogModel::create([
            'subject_id'    => $dlt_id,
            'subject'       => 'id',
            'ticket_id'     => $dlt_id,
            'activity_type' => 'Ticket Deleted',
            'activity'      => 'ticket_tickets',
            'user_id'       => Auth::user()->id,
            'add_ip_addrs'  => request()->ip()
        ]);

        echo $ifdlt;
    }

    /**
     * Detail : Ticket Details View
     * Date   : 30-11-2022
     */
    public function viewticket(Request $request)
    {
       
        $id = $request->id;
        $ticket_history = array();

        $ticketdet_rslt    = TicketModel::select('qsupport_ticket_tickets.*', 'users.name as created_by', 'qcrm_customer_details.cust_name', 'qsupport_ticket_ticket_category.category')
            ->leftJoin('users', 'qsupport_ticket_tickets.add_admin_id', '=', 'users.id')
            ->leftJoin('qcrm_customer_details', 'qsupport_ticket_tickets.client_id', '=', 'qcrm_customer_details.id')
            ->leftJoin('qsupport_ticket_ticket_category', 'qsupport_ticket_tickets.ticket_category_id', '=', 'qsupport_ticket_ticket_category.id')
            ->where('qsupport_ticket_tickets.id', '=', $id)
            ->get();

        foreach ($ticketdet_rslt as $key => $val) {
            $ticketdet = $val;
        }

        $ticket_attachmnts = DB::table('qsupport_ticket_ticketuploads')
            ->select('id', 'ticket_id', 'file_name')
            ->where('ticket_id', '=', $id)
            ->where('del_flag', '=', '1')
            ->get();

        // begin :: Ticket History
        $ticket_actvlog = TicketactivitylogModel::latest()->where('ticket_id', '=', $id)->get();

        foreach ($ticket_actvlog as $key => $actv_log) {
            $tbl     = 'qsupport_' . $actv_log->activity;
            $sub     = $actv_log->subject;
            $sub_id  = $actv_log->subject_id;
            $ticktid = $actv_log->ticket_id;

            if ($actv_log->activity_type == 'Ticket Added') {
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
                    ->where($tbl . '.' . $sub, '=', $sub_id)
                    ->get();

                foreach ($temparr1 as $key => $v1) {
                    $v1->title = "Ticket Created By";
                    array_push($ticket_history, $v1);
                }
            }

            // Ticket Delegated
            if ($actv_log->activity_type == 'Ticket Delegated') {
                $temparr3 = DB::table($tbl)
                    ->leftJoin('users as u_to', 'qsupport_ticket_delegations.assigned_to', '=', 'u_to.id')
                    ->leftJoin('users as u_by', 'qsupport_ticket_delegations.assigned_by', '=', 'u_by.id')
                    ->select('qsupport_ticket_delegations.created_at', 'u_to.name as asgned_to', 'u_by.name as asgned_by')
                    ->where($tbl . '.' . $sub, '=', $sub_id)
                    ->get();

                foreach ($temparr3 as $key => $v3) {
                    $v3->title = "Ticket Delegated To";
                    array_push($ticket_history, $v3);
                }
            }

            // ----- Ticket Updates -----
            // Updated Status
            if ($actv_log->activity_type == 'Ticket Status Updated') {
                $temparr4 = DB::table($tbl)
                    ->leftJoin('users', 'qsupport_ticketstatus_updations.add_admin_id', '=', 'users.id')
                    ->leftJoin('qsupport_ticket_ticket_status', 'qsupport_ticketstatus_updations.status_id', '=', 'qsupport_ticket_ticket_status.id')
                    ->select('qsupport_ticketstatus_updations.created_at', 'users.name', 'qsupport_ticket_ticket_status.status')
                    ->where($tbl . '.' . $sub, '=', $sub_id)
                    ->get();

                foreach ($temparr4 as $key => $v4) {
                    $v4->title       = "Ticket Updates";
                    $v4->labelsuffix = "Updated Status : ";
                    $v4->labelcontent = $v4->status;
                    array_push($ticket_history, $v4);
                }
            }

            // Commented
            if ($actv_log->activity_type == 'Comment Added') {
                $temparr5 = DB::table($tbl)
                    ->leftJoin('users', 'qsupport_ticket_commoncomments.comment_by', '=', 'users.id')
                    ->select('qsupport_ticket_commoncomments.comment', 'qsupport_ticket_commoncomments.created_at', 'users.name')
                    ->where($tbl . '.' . $sub, '=', $sub_id)
                    ->get();

                foreach ($temparr5 as $key => $v5) {
                    $v5->title        = "Ticket Updates";
                    $v5->labelsuffix  = "commented : ";
                    $v5->labelcontent = $v5->comment;
                    array_push($ticket_history, $v5);
                }
            }

            // Closed Ticket
            if ($actv_log->activity_type == 'Ticket Closed') {
                $temparr6 = DB::table($tbl)
                    ->leftJoin('users', $tbl . '.assigned_to', '=', 'users.id')
                    ->select($tbl . '.close_comments', $tbl . '.ticketclosed_date as created_at', 'users.name')
                    ->where($tbl . '.' . $sub, '=', $sub_id)
                    ->get();

                foreach ($temparr6 as $key => $v6) {
                    $v6->title       = "Ticket Updates";
                    $v6->labelsuffix = "closed the assigned Ticket.";
                    array_push($ticket_history, $v6);
                }
            }
        } // End Foreach
        // end :: Ticket History

        // Ticket closed
        // By Assigned Users
        $closed_by_assignd = DB::table('qsupport_ticket_assignments')
            ->leftJoin('users', 'qsupport_ticket_assignments.assigned_to', '=', 'users.id')
            ->select('users.name')
            ->where('qsupport_ticket_assignments.ticket_id', '=', $id)
            ->where('qsupport_ticket_assignments.ticket_status', '=', '0') // Ticket closed
            ->get();

        // $closed_users = '';                     
        // if (!empty($closed_by_assignd) && $closed_by_assignd != NULL) {
        //     $closed_users = implode(",", $closed_by_assignd);
        // }
        // dd($closed_users);

        $closed_by_delegatd = DB::table('qsupport_ticket_delegations')
            ->leftJoin('users', 'qsupport_ticket_delegations.assigned_to', '=', 'users.id')
            ->where('qsupport_ticket_delegations.ticket_id', '=', $id)
            ->where('qsupport_ticket_delegations.ticket_status', '=', '0') // Ticket closed
            ->pluck('users.name');

        foreach ($closed_by_delegatd as $key => $va1) {
            print_r($va1);
        }
        // print_r($closed_by_delegatd);
        // exit();

        return view('support_ticket.create_ticket.view_ticket', compact('ticketdet', 'ticket_attachmnts', 'ticket_history'));
    }

    /**
     * Details : View Ticket Details - Download Attachment
     * Date    : 13-12-2022
     */
    public function dwnload_attachment(Request $request)
    {
        $pathToFile = public_path($request->na);
        return response()->download($pathToFile);
    }

    /**
     * Details : View Ticket Details - Save as note
     * Date    : 12-12-2022
     */
    public function ticket_commentssubmit(Request $request)
    {
        $stat = '';
        $msg  = '';

        // Save Comment
        $comment_id = Ticketcommon_commentModel::create([
            'ticket_id'    => $request->ticketid,
            'comment_by'   => Auth::user()->id,
            'comment'      => $request->ticket_cmn_comment,
            'add_ip_addrs' => request()->ip()
        ])->id;

        if ($comment_id) {
            // Upload attachment
            // $path = public_path('support_tickets/ticket_cmncomments/'.$comment_id.'');
            $path = public_path('support_tickets/ticket_cmncomments');
            $file = $request->file('ticket_commentupld');

            //    if(File::exists($path)) {
            // echo $request->UniqueID;
            //     }else{
            // echo $request->UniqueID;        
            //         File::makeDirectory($path, $mode = 0777, true, true);
            //     }

            if ($request->hasfile('ticket_commentupld')) {
                // foreach ($request->file('filenames') as $file) {
                $name = time() . $file->getClientOriginalName();
                $file->move($path, $name);
                // }

                // Save Attachment
                DB::table('qsupport_ticket_cmncomment_attachment')->insert([
                    'ticket_id'    => $request->ticketid,
                    'comment_id'   => $comment_id,
                    'attachment'   => $path . $name,
                    'add_ip_addrs' => request()->ip(),
                    'add_admin_id' => Auth::user()->id
                ]);
            }

            // Save the Activity
            TicketactivitylogModel::create([
                'subject_id'    => $comment_id,
                'subject'       => 'id',
                'ticket_id'     => $request->ticketid,
                'activity_type' => 'Comment Added',
                'activity'      => 'ticket_commoncomments',
                'user_id'       => Auth::user()->id,
                'add_ip_addrs'  => request()->ip()
            ]);

            $stat = 'success';
            $msg  = 'Submission Successful :)';
        } else {
            $stat = 'danger';
            $msg  = 'Submission Failed :(';
        }

        $data = array(
            'toast_stat' => $stat,
            'toast_msg'  => $msg
        );

        echo json_encode($data);
    }
}

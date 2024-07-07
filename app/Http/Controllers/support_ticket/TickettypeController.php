<?php

namespace App\Http\Controllers\support_ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

use App\support_ticket\TickettypeModel;
use DB;

use Auth;

class TickettypeController extends Controller
{
    /**
     * Detail : Ticket Type
     * Date   : 08-11-2022
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = TickettypeModel::latest()->where('del_flag', 1)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return $row->id;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('support_ticket.ticket_type.index');
    }

    /**
     * Detail : Ticket Type Submit
     * Date   : 08-11-2022
     */
    public function ticket_type_submit(Request $request)
    {
        $msg  = '';
        $stat = '';
        $flg  = 0;

        // Check if exists
        $type_exist = DB::table('qsupport_ticket_ticket_type')
                            ->where('type_name',  $request->typename)
                            ->where('del_flag',  1)
                            ->count();
        
        if($type_exist) {
            $stat = 'warning';
            $msg  = 'Type Already Exists';
            $flg  = 1;
        }
        else {
            $ifCre= TickettypeModel::create([
                'type_name'    => $request->typename,
                'description'  => $request->typedesc,
                'add_ip_addrs' => request()->ip(),
                'add_admin_id' => Auth::user()->id
            ]);

            if($ifCre)
            {
                $stat = 'success';
                $msg  = 'Submission Successful :)';
            }
            else
            {
                $stat = 'danger';
                $msg  = 'Submission Failed :(';
            }
        }

        $data = array(
            'toast_stat' => $stat,
            'toast_msg'  => $msg,
            'flag'       => $flg
        );

        echo json_encode($data);
    }

    /**
     * Detail : Get the Ticket Type Details
     * Date   : 09-11-2022
     */
    public function get_tickettype_det(Request $request)
    {
        $id = $request->id;
        
        $tickettypedet = TickettypeModel::find($id);
        echo json_encode($tickettypedet);
    }

    /**
     * Detail : Ticket Type Update
     * Date   : 09-11-2022
     */
    public function ticket_type_update(Request $request)
    {
        $msg  = '';
        $stat = '';
        $flg  = 0;

        // Check if exists
        $type_exist = DB::table('qsupport_ticket_ticket_type')
                            ->where('id', '!=',  $request->iid)
                            ->where('type_name', '=',  $request->typename)
                            ->where('del_flag', '=', 1)
                            ->exists();
        
        if($type_exist) {
            $stat = 'warning';
            $msg  = 'Type Already Exists';
            $flg  = 1;
        }
        else {
            $ifUpd= TickettypeModel::whereId($request->iid)->update([
                    'type_name'     => $request->typename,
                    'description'   => $request->typedesc,
                    'edit_ip_addrs' => request()->ip(),
                    'edit_admin_id' => Auth::user()->id
                ]);

            if($ifUpd)
            {
                $stat = 'success';
                $msg  = 'Updation Successful :)';
            }
            else
            {
                $stat = 'danger';
                $msg  = 'Updation Failed :(';
            }
        }

        $data = array(
            'toast_stat' => $stat,
            'toast_msg'  => $msg,
            'flag'       => $flg
        );

        echo json_encode($data);
    }

    /**
     * Detail : Ticket Type Delete
     * Date   : 19-11-2022
     */
    public function type_deletefn(Request $request)
    {
        $dlt_id  = $request->id;

        $ifdlt = TickettypeModel::whereId($dlt_id)->update([
            'del_flag'     => 0
        ]);

        echo $ifdlt;
    }
}
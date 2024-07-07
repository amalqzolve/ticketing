<?php

namespace App\Http\Controllers\support_ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

use App\support_ticket\EmailSettingsModel;
use DB;

use Auth;

class EmailsettingsController extends Controller
{
    /**
     * Detail : Email Settings
     * Date   : 01-01-2023
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = EmailSettingsModel::latest()->where('del_flag', 1)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return $row->id;
                    })
                    ->editColumn('smtpsecure_status', function($row) {
                        if ($row->smtpsecure_status == 1) {
                            return "Yes";
                        }
                        elseif ($row->smtpsecure_status == 2) {
                            return "No";
                        }
                        else {
                            return "-";
                        }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('support_ticket.emailsettings.index');
    }

    /**
     * Detail : Get the Email Settings Details
     * Date   : 01-01-2023
     */
    public function get_emailsetting_det(Request $request)
    {
        $id = $request->id;
        
        $emailsettngdet = EmailSettingsModel::find($id);
        echo json_encode($emailsettngdet);
    }

    /**
     * Detail : Email Settings Update
     * Date   : 01-01-2023
     */
    public function emailsettngs_update(Request $request)
    {
        $msg  = '';
        $stat = '';

        $ifUpd= EmailSettingsModel::whereId($request->iid)->update([
                'host'              => $request->host,
                'username'          => $request->smtpusername,
                'passwrd'           => $request->smtp_pwd,
                'smtpsecure_status' => $request->smtp_secure,
                'port_no'           => $request->port,
                'sender_email'      => $request->sender_email,
                'edit_ip_addrs'     => request()->ip(),
                'edit_admin_id'     => Auth::user()->id
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

        $data = array(
            'toast_stat' => $stat,
            'toast_msg'  => $msg
        );

        echo json_encode($data);
    }

}
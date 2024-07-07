<?php

namespace App\Http\Controllers\support_ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

use App\support_ticket\TickettagsModel;
use DB;

use Auth;

class TickettagsController extends Controller
{
    /**
     * Detail : Tags
     * Date   : 18-11-2022
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = TickettagsModel::latest()->where('del_flag', 1)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return $row->id;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('support_ticket.ticket_tags.index');
    }

    /**
     * Detail : Tag Submit
     * Date   : 18-11-2022
     */
    public function ticket_tag_submit(Request $request)
    {
        $msg  = '';
        $stat = '';
        $flg  = 0;

        // Check if exists
        $tag_exist = DB::table('qsupport_ticket_ticket_tags')
                            ->where('tag_name',  $request->tagname)
                            ->where('del_flag',  1)
                            ->exists();
        
        if($tag_exist) {
            $stat = 'warning';
            $msg  = 'Tag Already Exists';
            $flg  = 1;
        }
        else {
            $ifCre= TickettagsModel::create([
                'tag_name'    => $request->tagname,
                'description'  => $request->tagdesc,
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
     * Detail : Get the Tag Details
     * Date   : 09-11-2022
     */
    public function get_tickettags_det(Request $request)
    {
        $id = $request->id;
        
        $tickettagdet = TickettagsModel::find($id);
        echo json_encode($tickettagdet);
    }

    /**
     * Detail : Tag Update
     * Date   : 18-11-2022
     */
    public function ticket_tag_update(Request $request)
    {
        $msg  = '';
        $stat = '';
        $flg  = 0;

        // Check if exists
        $tag_exist = DB::table('qsupport_ticket_ticket_tags')
                            ->where('id', '!=',  $request->iid)
                            ->where('tag_name', '=',  $request->tagname)
                            ->where('del_flag', '=', 1)
                            ->exists();
        
        if($tag_exist) {
            $stat = 'warning';
            $msg  = 'Tag Already Exists';
            $flg  = 1;
        }
        else {
            $ifUpd= TickettagsModel::whereId($request->iid)->update([
                    'tag_name'      => $request->tagname,
                    'description'   => $request->tagdesc,
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
     * Detail : Tag Delete
     * Date   : 19-11-2022
     */
    public function tag_deletefn(Request $request)
    {
        $dlt_id  = $request->id;

        $ifdlt = TickettagsModel::whereId($dlt_id)->update([
            'del_flag'     => 0
        ]);

        echo $ifdlt;
    }
}
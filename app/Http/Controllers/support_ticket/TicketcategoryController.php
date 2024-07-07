<?php

namespace App\Http\Controllers\support_ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

use App\support_ticket\TicketcategoryModel;
use DB;

use Auth;

class TicketcategoryController extends Controller
{
    /**
     * Detail : Ticket Category
     * Date   : 18-11-2022
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = TicketcategoryModel::latest()->where('del_flag', 1)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return $row->id;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('support_ticket.ticket_category.index');
    }

    /**
     * Detail : Ticket Category Submit
     * Date   : 18-11-2022
     */
    public function ticket_ctg_submit(Request $request)
    {
        $msg  = '';
        $stat = '';
        $flg  = 0;

        // Check if exists
        $ctg_exist = DB::table('qsupport_ticket_ticket_category')
                            ->where('category',  $request->catgname)
                            ->where('del_flag',  1)
                            ->exists();
        
        if($ctg_exist) {
            $stat = 'warning';
            $msg  = 'Category Already Exists';
            $flg  = 1;
        }
        else {
            $ifCre= TicketcategoryModel::create([
                'category'     => $request->catgname,
                'description'  => $request->ctgdesc,
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
     * Detail : Get the Ticket Category Details
     * Date   : 18-11-2022
     */
    public function get_ticketctg_det(Request $request)
    {
        $id = $request->id;
        
        $ticketctgdet = TicketcategoryModel::find($id);
        echo json_encode($ticketctgdet);
    }

    /**
     * Detail : Ticket Category Update
     * Date   : 18-11-2022
     */
    public function ticket_ctg_update(Request $request)
    {
        $msg  = '';
        $stat = '';
        $flg  = 0;

        // Check if exists
        $type_exist = DB::table('qsupport_ticket_ticket_category')
                            ->where('id', '!=',  $request->iid)
                            ->where('category', '=',  $request->catgname)
                            ->where('del_flag', '=', 1)
                            ->exists();
        
        if($type_exist) {
            $stat = 'warning';
            $msg  = 'Category Already Exists';
            $flg  = 1;
        }
        else {
            $ifUpd= TicketcategoryModel::whereId($request->iid)->update([
                    'category'     => $request->catgname,
                    'description'   => $request->ctgdesc,
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
     * Detail : Ticket Category Delete
     * Date   : 19-11-2022
     */
    public function catg_deletefn(Request $request)
    {
        $dlt_id  = $request->id;

        $ifdlt = TicketcategoryModel::whereId($dlt_id)->update([
            'del_flag'     => 0
        ]);

        echo $ifdlt;
    }
}
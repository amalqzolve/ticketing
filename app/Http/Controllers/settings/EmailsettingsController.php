<?php
namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;
use App\settings\EmailsettingsModel;
use Illuminate\Http\Request;
use Auth;
use DB;
use Spatie\Activitylog\Models\Activity;
use PDF;
use DataTables;
use Session;
class EmailsettingsController extends Controller
{
    /*
    * Author : Siffy 
    * Detail : Email Settings List
    * Date   : 21-07-2022
    */
    public function list(Request $request)
    {
        $branch=Session::get('branch');

        if ($request->ajax()) 
        {
            $query = EmailsettingsModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = EmailsettingsModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                return $row->id; 
            })->rawColumns(['action'])->make(true);    
        }
         
        return view('settings.email_settings.index',compact('branch'));
    }

    /*
    * Author : Siffy 
    * Detail : Get Email Setting details for Edit
    * Date   : 21-07-2022
    */
    public function getEmailsetngDetails(Request $request)
    {
        $data['emaildet'] = EmailsettingsModel::where('id', $request->email_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }

    /*
    * Author : Siffy 
    * Detail : Email Settings Submit (save)
    * Date   : 21-07-2022
    */
    public function emailsetngSubmit(Request $request)
    {
        $branch=Session::get('branch');
        
        $postID = $request->email_id;

        $data = [
            'branch'            => $branch,
            'host'              => $request->host, 
            'username'          => $request->usrname,
            'passwrd'           => $request->passwrd,
            'smtpsecure_status' => $request->smtpsecure,
            'port_no'           => $request->port,
            'sender_email'      => $request->sender,
            'updated_at'        => date('Y-m-d H:i:s'),
            'edit_admin_id'     => Auth::user()->id,
            'ip_address'        => request()->ip()
        ];
        $emailInfo = EmailsettingsModel::updateOrCreate(['id' => $postID], $data);
        
        return 'true';
    }

}


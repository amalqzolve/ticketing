<?php
namespace App\Http\Controllers\crm;
use App\crm\TermsconditionsModel;
use Illuminate\Http\Request;
use DB;
use Spatie\Activitylog\Models\Activity;
use PDF;
use DataTables;
use Session;
class TermsandconditionsController extends Controller
{
    public function list(Request $request)
    {
                   $branch=Session::get('branch');

        if ($request->ajax()) 
            {
                $query = TermsconditionsModel::orderby('id', 'desc');
                $query->where('del_flag', 1)->where('branch',$branch);
                $data = $query->get();
                $count_filter = $query->count();
                $count_total = TermsconditionsModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);    
            }
         
        return view('crm.termsconditions.index',compact('branch'));
    }
    public function trash()
    {
        return view('crm.termsconditions.trash');
    }
   
    public function termstrashdetails(Request $request)
    {
                   $branch=Session::get('branch');
      
        if ($request->ajax()) 
            {
                $query = TermsconditionsModel::orderby('id', 'desc');
                $query->where('del_flag', 0)->where('branch',$branch);
                $data = $query->get();
                $count_filter = $query->count();
                $count_total = TermsconditionsModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);    
            }
         
        return view('crm.termsconditions.trash');
    
    }
    public function termsSubmit(Request $request)
    {

       $branch = $request->branch;
        // $user = auth()->user();
        $postID = $request->payment_id;
        $check = $this->check_exists($request->term,'term','qcrm_termsandconditions');
        if($check<1)
        {
        $data = [
        'term' => $request->term, 'description' => $request->description,'branch'=>$branch
        ];
        $userInfo = TermsconditionsModel::updateOrCreate(['id' => $postID], $data);
        
        return 'true';
        }
        else
        {
            return 'false';
        }
    }

    public function getTermsconditions(Request $request)
    {
        $data['users'] = TermsconditionsModel::where('id', $request->term_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function deletetermsInfo(Request $request)
    {
        $postID = $request->id;
        TermsconditionsModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function termsTrashRestore(Request $request)
    {
        $postID = $request->id;
        TermsconditionsModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function check_exists($value,$field,$table)
     {
           $branch=Session::get('branch');

        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->where('branch',$branch)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
}


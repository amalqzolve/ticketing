<?php
namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;
use App\settings\TermsconditionsModel;
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
         
        return view('settings.termsconditions.index',compact('branch'));
    }
    public function trash()
    {
        return view('settings.termsconditions.trash');
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
         
        return view('settings.termsconditions.trash');
    
    }

     public function view(Request $request)
    {
        $id = $request->id;
        $data = TermsconditionsModel::where('id',$id)->get();
        return view ('settings.termsconditions.view',compact('data'));
    }

    
    public function termsSubmit(Request $request)
    {

     $branch=Session::get('branch');
        // $user = auth()->user();
        $postID = $request->payment_id;

          $data = [
        'term' => $request->term, 'description' => $request->description,'branch'=>$branch
        ];
        $userInfo = TermsconditionsModel::updateOrCreate(['id' => $postID], $data);
        
        return 'true';

        
       /* $check = $this->check_exists($request->term,'term','qcrm_termsandconditions');
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
        }*/
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
        $query = DB::table('qsales_convert_delivery')->select('terms_conditions')->where('terms_conditions',$postID)->where('del_flag',1)->get();
        $no = $query->count();
        $query1 = DB::table('qsales_salesorder')->select('terms')->where('terms',$postID)->where('del_flag',1)->get();
        $no1 = $query1->count();
        $query2 = DB::table('qsales_salesreturn')->select('terms')->where('terms',$postID)->where('del_flag',1)->get();
        $no2 = $query2->count();
        $query3 = DB::table('qsales_quotation')->select('terms')->where('terms',$postID)->where('del_flag',1)->get();
        $no3 = $query3->count();
        $query4 = DB::table('qsales_quotation_edited')->select('terms')->where('terms',$postID)->where('del_flag',1)->get();
        $no4 = $query4->count();
        $query5 = DB::table('qsales_quotation_revised')->select('terms')->where('terms',$postID)->where('del_flag',1)->get();
        $no5 = $query5->count();
        $query6 = DB::table('qsales_purchasereturn')->select('terms')->where('terms',$postID)->where('del_flag',1)->get();
        $no6 = $query6->count();
        $query7 = DB::table('qsales_invoiceorder')->select('terms')->where('terms',$postID)->where('del_flag',1)->get();
        $no7 = $query7->count();
        $query8 = DB::table('qsales_deliveryorder')->select('terms')->where('terms',$postID)->where('del_flag',1)->get();
        $no8 = $query8->count();
        $query9 = DB::table('qsales_convert_invoice')->select('terms_conditions')->where('terms_conditions',$postID)->where('del_flag',1)->get();
        $no9 = $query9->count();
        if($no > 0 || $no1 > 0 || $no2 > 0 || $no3 > 0 || $no4 > 0 || $no5 > 0 || $no6 > 0 || $no7 > 0 || $no8 > 0 || $no9 > 0)
        {
            return '1';
        }
        else
        {
        TermsconditionsModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
        }
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


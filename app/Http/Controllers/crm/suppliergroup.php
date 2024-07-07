<?php
namespace App\Http\Controllers\crm;
use App\crm\SuppliergroupModel;
use DB;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use Spstie\Activitylog\Models\Activity;
use \PDF;
use DataTables;
use Session;
class suppliergroup extends Controller
{
/**
   *Supplier Group datas listing
**/     
    public function supplier_grup(Request $request)
    {
           $branch=Session::get('branch');

        if($request->ajax())
        {
            $query=SuppliergroupModel::orderby('id','desc');
            $query->where('del_flag',1)->where('branch',$branch);
            $data=$query->get();
            $count_filter = $query->count();
            $count_total = SuppliergroupModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);

        } 
        return view('crm.supplier_group.suppliergroup',compact('branch'));
    }
/**
   *Supplier group trash 
 */      
    public function suppliergroupindex(Request $request)
    {
           $branch=Session::get('branch');

        if ($request->ajax()) 
            {
                $query = SuppliergroupModel::orderby('id', 'desc');
                $query->where('del_flag', 0)->where('branch',$branch);
                $data = $query->get();
                $count_filter = $query->count();
                $count_total = SuppliergroupModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);    
            }
         
        return view('crm.supplier_group.suppliergrouptrash');

    }
/**
  * Supplier group restore
*/      
    public function suppliergrupTrashRestore(Request $request)
    {
        $postID = $request->id;
        SuppliergroupModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function show($id)
    {
        
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('title', 'title')->all();
        $userRole = $user
                     ->roles
                     ->pluck('title', 'title')
                     ->all();
        return view('crm.users.edit', compact('user', 'roles', 'userRole'));
    }
/**
   *Supplier Group datas submission
**/      
    public function submitgroup(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->info_id;
        $check = $this->check_exists($request->title,'title','qcrm_suppliergroup');
        if($check<1)
        {
        $data   = ['title' => $request->title, 'description' => $request->description,
                    'color' => $request->color,'branch'=>$branch];
        $userInfo = SuppliergroupModel::updateOrCreate(['id' => $postID], $data);
        return 'true';
        }
        else
        {
            return 'false';
        }
    }
/**
   *Supplier Group update 
**/      
    public function getsuppliergrup(Request $request)
    {
        $data['users']   = SuppliergroupModel::where('id', $request->cust_id)
                           ->limit(1)
                           ->first();
        
        echo json_encode($data);
    }
/**
   *Supplier Group delete 
**/       
    public function deletesuppliergrupInfo(Request $request)
    {
       $postID = $request->id;
        SuppliergroupModel::where('id', $postID)->update(['del_flag' => 0]);
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


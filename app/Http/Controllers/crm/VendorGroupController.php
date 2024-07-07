<?php
namespace App\Http\Controllers\crm;
use App\crm\VendorGroupModel;
use App\crm\TaxInformation;
use DB;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;
use Session;
use DataTables;

class VendorGroupController extends Controller
{
  /**
    *Vendor Group Listing Function
  */
    public function index(Request $request)
      {
           $branch=Session::get('branch');

        if ($request->ajax()) {
            $query = VendorGroupModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = VendorGroupModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
      return view('crm.VendorGroup.index',compact('branch'));
    }
  /**
    *Vendor Group Updates Function
  */
    public function groupedit(Request $request)
    {
        $data['users'] = VendorGroupModel::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
/**
  *Vendor Group Add Function
*/
    public function submit_vendorgroup(Request $request)
    {   
      $branch = $request->branch;
        $postID = $request->id;
        $check = $this->check_exists($request->title,'title','qcrm_vendor_groups');
        if($check<1)
        {
        $data   = [
                'title'            => $request->title,
                'description'      => $request->description,
                'color'            => $request->color,
                'branch'           => $request->branch
                   ];
        $vendors= VendorGroupModel::updateOrCreate(['id' => $postID],$data);
        // if($request->id){  
        //    $msg = 'updated';    
        // }else{  
        //    $msg = 'created';    
        // }   
        //  Session::flash('success', 'Vendor Group '.$msg.' successfully.'); 
       
        return 'true';
      }
      else
      {
        return 'false';
      }
    }
  /**
    *Vendor Group Trash Listing Function
  */
    public function GroupTrash(Request $request)
    {
           $branch=Session::get('branch');

        if ($request->ajax()) {
            $query = VendorGroupModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = VendorGroupModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.VendorGroup.trash');
    }
  /**
    *Vendor Group Delete Function
  */
    public function delete_vendorgroup(Request $request)
    {
        $postID = $request->id;
            $query = DB::table('qcrm_vendors')->select('vendor_category')->where('vendor_category',$postID)->where('del_flag',1)->get();
        $no = $query->count();
        if($no > 0)
        {
            return '1';
        }
        else
        {
     
        VendorGroupModel::where('id', $postID)
            ->update(['del_flag' => 0]);
        return 'true';
      }
    }
  /**
    *Vendor Group Restore Function
  */
    public function VendorGroupRestore(Request $request)
    {
        $postID = $request->id;
        VendorGroupModel::where('id', $postID)->update(['del_flag' => 1]);
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


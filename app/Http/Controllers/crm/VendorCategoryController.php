<?php
namespace App\Http\Controllers\crm;
use App\crm\vendor;
use App\crm\VendorCategoryModel;
use App\crm\VendorTypeModel;
use App\crm\vendorskill;
use App\crm\TaxInformation;
use DB;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;
use Session;
use DataTables;
class VendorCategoryController extends Controller
{
    /**
    *Vendor Category Listing Function
    */
    public function vendorcategoryindex(Request $request)
    {
                   $branch=Session::get('branch');
        if ($request->ajax()) {
            $query = VendorCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = VendorCategoryModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
       return view('crm.VendorCategory.index',compact('branch'));
    }
    /**
    *Vendor Category Trash Listing Function
   */
   public function vendorCategoryTrash(Request $request)
   {
                   $branch=Session::get('branch');

        if ($request->ajax()) {
            $query = VendorCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = VendorCategoryModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.VendorCategory.trash');
    }
  /**
    *Vendor Category Update Function
  */
    public function categoryedit(Request $request)
    {
        $data['users'] = VendorCategoryModel::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
  /**
    *Vendor Category Add Function
  */
    public function submit_vendorcategory(Request $request)
    {   
        // dd($request);
        $branch = $request->branch;
        $postID = $request->vendor_id;
        $check = $this->check_exists($request->vendor_category,'vendor_category','qcrm_vendor_category_details');
        if($check<1)
        {
        $data   = [
                // 'vendor_start' => $request->cust_code . '/' . number_format($request->start_from + 1),
                'vendor_category'   => $request->vendor_category,
                'description'       => $request->description,
                'color'             => $request->color,
                'customcode'        => $request->customcode,
                'startfrom'         => $request->startfrom,
                'increment'         => $request->startfrom,
                'branch'            => $branch

            ];
        $vendors= VendorCategoryModel::updateOrCreate(['id' => $postID],$data);
        // if($request->vendor_id){  
        //    $msg = 'updated';    
        // }else{  
        //    $msg = 'created';    
        // }   
        // Session::flash('success', 'Vendor Category '.$msg.' successfully.'); 
        return 'true';
    }
    else
    {
        return 'false';
    }
    }
    public function addvendorcategorydetails()
    {
        return view('crm.VendorCategory.addvendorcategorydetails');
    }
    public function edit_vendorcategory(Request $request)
    {
         $id    = $request->id;
         $users =  VendorCategoryModel::where('id',$id)
                            ->limit(1)
                            ->first();
         return view('crm.VendorCategory.edit',['data'=>$users]);
    }
/**
    *Vendor Category Delete Function
*/
    public function delete_vendorcategory(Request $request)
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
        VendorCategoryModel::where('id', $postID)
            ->update(['del_flag' => 0]);
        return 'true';
    }
    }
/**
  *Vendor Category Restore Function
*/
    public function vendorcategoryRestore(Request $request)
    {
        $postID = $request->id;
        VendorCategoryModel::where('id', $postID)->update(['del_flag' => 1]);
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


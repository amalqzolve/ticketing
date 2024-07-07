<?php
namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;
use App\settings\VendorGroupModel;
use App\settings\VendorCategoryModel;
use App\settings\VendorTypeModel;
use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;
use Session;
use DataTables;

class VendorController extends Controller
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
      return view('settings.VendorGroup.index',compact('branch'));
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
        
    $branch=Session::get('branch');
        $postID = $request->id;

          $data   = [
                'title'            => $request->title,
                'description'      => $request->description,
                'color'            => $request->color,
                'branch'           => $request->branch
                   ];
        $vendors= VendorGroupModel::updateOrCreate(['id' => $postID],$data);

        return 'true';


       /* $check = $this->check_exists($request->title,'title','qcrm_vendor_groups');
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
      }*/
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
        return view('settings.VendorGroup.trash');
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
       return view('settings.VendorCategory.index',compact('branch'));
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
        return view('settings.VendorCategory.trash');
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
         $branch=Session::get('branch');
        $postID = $request->vendor_id;

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
      
        return 'true';


      /*  $check = $this->check_exists($request->vendor_category,'vendor_category','qcrm_vendor_category_details');
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
    }*/
    }
    public function addvendorcategorydetails()
    {
        return view('VendorCategory.addvendorcategorydetails');
    }
    public function edit_vendorcategory(Request $request)
    {
         $id    = $request->id;
         $users =  VendorCategoryModel::where('id',$id)
                            ->limit(1)
                            ->first();
         return view('settings.VendorCategory.edit',['data'=>$users]);
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

public function vendortypeindex(Request $request)
    {
                   $branch=Session::get('branch');

        if ($request->ajax()) {
            $query = VendorTypeModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = VendorTypeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('settings.VendorType.index',compact('branch'));
    }
   /**
    *Vendor Type Trash Listing Function
   */
    public function vendorTypeTrash(Request $request)
    {
                   $branch=Session::get('branch');

        if ($request->ajax()) {
            $query = VendorTypeModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = VendorTypeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('settings.VendorType.trash');
    }
    public function typeedit(Request $request)
    {
        $data['users'] = VendorTypeModel::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    /**
    *Vendor Type Add Function
    */
    public function submit_vendortype(Request $request)
    {
          $branch=Session::get('branch');
        $postID = $request->vendor_id;

             $data = ['vendor_type' => $request->vendor_type, 'description' => $request->description, 'color' => $request->color,'branch'=>$branch];
        $vendors = VendorTypeModel::updateOrCreate(['id' => $postID], $data);
     
        return 'true';


        /*$check = $this->check_exists($request->vendor_type,'vendor_type','qcrm_vendor_type_details');
        if($check<1)
        {
        $data = ['vendor_type' => $request->vendor_type, 'description' => $request->description, 'color' => $request->color,'branch'=>$branch];
        $vendors = VendorTypeModel::updateOrCreate(['id' => $postID], $data);
        // if($request->vendor_id){  
        //    $msg = 'updated';    
        // }else{  
        //    $msg = 'created';    
        // }   
        //  Session::flash('success', 'Vendor Type Details '.$msg.' successfully.'); 
       
        return 'true';
        }
        else
        {
            return 'false';
        }*/
    }

      public function delete_vendortype(Request $request)
    {
        $postID = $request->id;
         $query = DB::table('qcrm_vendors')->select('vendor_type')->where('vendor_type',$postID)->where('del_flag',1)->get();
        $no = $query->count();
        if($no > 0)
        {
            return '1';
        }
        else
        {
        VendorTypeModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
}
    public function VendorTypeRestoreTrash(Request $request)
    {
        $postID = $request->id;
        VendorTypeModel::where('id', $postID)->update(['del_flag' => 1]);
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


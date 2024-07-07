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
class VendorTypeController extends Controller
{
    /**
    *Vendor Type Listing Function
    */
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
        return view('crm.VendorType.index',compact('branch'));
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
        return view('crm.VendorType.trash');
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
        $branch = $request->branch;
        $postID = $request->vendor_id;
        $check = $this->check_exists($request->vendor_type,'vendor_type','qcrm_vendor_type_details');
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
        }
    }
    public function vendortypeshow(Request $request)
    {
        $totalFiltered = 0;
        $totalData = VendorTypeModel::count();
        $query = VendorTypeModel::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('vendor_type', 'LIKE', "%{$search}%");
            $query->orWhere('description', 'LIKE', "%{$search}%");
            $query->orWhere('color', 'LIKE', "%{$search}%");
        }
        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('vendor_type', 'LIKE', "%{$search_3}%");
            $query->Where('description', 'LIKE', "%{$search_3}%");
            $query->Where('color', 'LIKE', "%{$search_3}%");
            echo "test";
        }
        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $vendor = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();
        foreach ($vendor as $vendor_detail)
        {
            $no++;
            $row[0] = $no;
            $row[1] = $vendor_detail->vendor_type;
            $row[2] = $vendor_detail->description;
            $row[3] = '<div style="width:25px;border-radius: 17px;height:10px;background:#' . $vendor_detail->color . '">&nbsp;&nbsp;</div>';
            $row[4] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                       <a href="#?id=' . $vendor_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_4"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Vendortypedetail_update" data-id="' . $vendor_detail->id . '" >Edit</span>
                        </span></li></a>
                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_vendortypeinformation" id=' . $vendor_detail->id . ' data-id=' . $vendor_detail->id . '>Delete</span></span></li>
                       </ul></div></div></span>';
            $data[$i] = $row;
            $i++;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function vendortypelistTrash(Request $request)
    {
        $totalFiltered = 0;
        $totalData = VendorTypeModel::count();
        $query = VendorTypeModel::orderby('id', 'desc');
        $query->where('del_flag', 0);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('vendor_type', 'LIKE', "%{$search}%");
            $query->orWhere('description', 'LIKE', "%{$search}%");
            $query->orWhere('color', 'LIKE', "%{$search}%");
        }
        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('vendor_type', 'LIKE', "%{$search_3}%");
            $query->Where('description', 'LIKE', "%{$search_3}%");
            $query->Where('color', 'LIKE', "%{$search_3}%");
            echo "test";
        }
        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $vendor = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();
        foreach ($vendor as $vendor_detail)
        {
            $no++;
            $row[0] = $no;
            $row[1] = $vendor_detail->vendor_type;
            $row[2] = $vendor_detail->description;
            $row[3] = '<div style="width:25px;border-radius: 17px;height:10px;background:#' . $vendor_detail->color . '">&nbsp;&nbsp;</div>';
            $row[4] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text VendorTypeDetail_restore" id=' . $vendor_detail->id . ' data-id=' . $vendor_detail->id . '>Restore</span></span></li>
                       </ul></div></div></span>';
            $data[$i] = $row;
            $i++;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        );
        echo json_encode($output);
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


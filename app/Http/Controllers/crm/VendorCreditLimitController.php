<?php
namespace App\Http\Controllers\crm;
use App\crm\VendorCreditLLimitModel;
use App\crm\vendor;
use DB;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;
use Session;
class VendorCreditLimitController extends Controller
{
   public function index()
    {   
     $list = VendorCreditLLimitModel::where('del_flag', 1)->get();
     
     return view('crm.VendorCredit.index',compact('list'));
    }
    public function VendorCreditList(Request $request){
        $totalFiltered=0;
        $totalData    = vendor::count();
        $query        =  vendor::orderby('id', 'desc');
        $query->where('del_flag',1);
        if(!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id','LIKE',"%{$search}%");
            $query->orWhere('vendor_name', 'LIKE',"%{$search}%");
        }
       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('vendor_name', 'LIKE',"%{$search_3}%");
            echo "test";
        }
       $totalFiltered  = $query->count();
       $query->skip($_POST['start'])->take($_POST['length']);
       $users=  $query->get();
       $data = array();
       $no   = $_POST['start'];
       $i    = 0;
       $row  = array();
       foreach ($users as $vendor_detail) {
         $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="#?id='.$vendor_detail->id.'" data-type="add" data-toggle="modal" data-target="#vendorCredit"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text CreditDetail_add" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>
                       </ul></div></div></span>';
            $row[2]    = $vendor_detail->vendor_name;
            $data[$i] = $row;
            $i++;
        }
        $output = array(
                    "draw"                => $_POST['draw'],
                    "recordsTotal"        => $totalData,
                    "recordsFiltered"     => $totalFiltered,
                    "data"                => $data,
                );
        echo json_encode($output);
    }
    public function getCreditAdd(Request $request){
        $data=array();
        $data['users'] =  Vendor::where('id',$request->user_id)
                            ->where('del_flag',1)
                             ->limit(1)
                             ->first();
       $data['vendor'] =  VendorCreditLLimitModel::where('vendor_id',$request->user_id)
                             ->limit(1)
                             ->first();
        echo json_encode($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'select_vendor' => 'required'
        ], [
            'select_vendor.required' => 'Name is required'
        ]);

        $user = auth()->user();
        $postID = $request->doc_id;
        $data   = [
                'number_invoices'       => $request->number_invoices,
                'vendor_id'             => $request->v_id,
                'total_amount'          => $request->total_amount,
                'period'                => $request->period,
                'penal_charges'         => $request->penal_charges,
                ];
        $vendors= VendorCreditLLimitModel::updateOrCreate(['id' => $postID],$data);
        if($request->doc_id){  
           $msg = 'updated';    
        }else{  
           $msg = 'created';    
        }   
         Session::flash('success', 'Vendor Credit Limit '.$msg.' successfully.'); 
             return 'true';
    }
    public function deleteCreditInfo(Request $request)
    {
         $postID = $request->id;
         VendorCreditLLimitModel::where('V_id', $postID)
             ->update(['del_flag' => 0]);
         return 'true';
    }
}


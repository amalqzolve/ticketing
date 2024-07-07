<?php
namespace App\Http\Controllers\crm;
use App\crm\PaymentModel;
use Illuminate\Http\Request;
use DB;
use Spatie\Activitylog\Models\Activity;
use PDF;
use DataTables;
use Session;
class PaymentController extends Controller
{
    public function index(Request $request)
    {
                   $branch=Session::get('branch');

        if ($request->ajax()) 
            {
                $query = PaymentModel::orderby('id', 'desc');
                $query->where('del_flag', 1)->where('branch',$branch);
                $data = $query->get();
                $count_filter = $query->count();
                $count_total = PaymentModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);    
            }
         
        return view('crm.PaymentDetail.index',compact('branch'));
    }
    public function trash()
    {
        return view('crm.PaymentDetail.trash');
    }
    // public function paymentTermsList(Request $request)
    // {
    //     $totalFiltered = 0;
    //     $totalData = PaymentModel::count();
    //     $query = PaymentModel::orderby('id', 'desc');
    //     $query->where('del_flag', 1);
    //     if (!empty($request->input('search.value')))
    //     {
    //         $search = $request->input('search.value');
    //         $query->Where('id', 'LIKE', "%{$search}%");
    //         $query->orWhere('title', 'LIKE', "%{$search}%");
    //         $query->orWhere('description', 'LIKE', "%{$search}%");
    //     }
    //     if (isset($_GET['columns'][3]['search']['value']) && $_GET['columns'][3]['search']['value'] != '')
    //     {
    //         $search_3 = $_GET['columns'][3]['search']['value'];
    //         $query->Where('description', 'LIKE', "%{$search_3}%");
    //         $query->Where('title', 'LIKE', "%{$search_3}%");
    //         echo "test";
    //     }
    //     $totalFiltered = $query->count();
    //     $query->skip($_GET['start'])->take($_GET['length']);
    //     $users = $query->get();
    //     $data = array();
    //     $no = $_GET['start'];
    //     $i = 0;
    //     $row = array();
    //     foreach ($users as $user_detail)
    //     {
    //         $no++;
    //         $row[0] = $no;
    //         $row[1] = $user_detail->term;
    //         $row[2] = substr($user_detail->description, 0, 40);
    //         $row[3] = '<span style="overflow: visible; position: relative; width: 80px;">
    //                     <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    //                     <i class="flaticon-more-1"></i></a>
    //                     <div class="dropdown-menu dropdown-menu-right">
    //                     <ul class="kt-nav">
    //                     <a href="#?id=' . $user_detail->id . '" data-type="edit" data-toggle="modal"  data-target="#payment_terms"><li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-contract"></i>
    //                     <span class="kt-nav__link-text paymentdetail_update" data-id="' . $user_detail->id . '" >' . trans('app.Edit') . '</span>
    //                     </span></li></a>
    //                     <li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                     <span class="kt-nav__link-text kt_del_paymentinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>' . trans('app.Delete') . '</span></span></li>
    //                     </ul></div></div></span>';
    //         $data[$i] = $row;
    //         $i++;
    //     }
    //     $output = array(
    //         "draw" => $_GET['draw'],
    //         "recordsTotal" => $totalData,
    //         "recordsFiltered" => $totalFiltered,
    //         "data" => $data,
    //     );
    //     echo json_encode($output);
    // }
    public function paymentttrashlists(Request $request)
    {
                   $branch=Session::get('branch');
        
        $totalFiltered = 0;
        $totalData     = PaymentModel::count();
        $query         = PaymentModel::orderby('id', 'desc');
        $query->where('del_flag', 0)->where('branch',$branch);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('title', 'LIKE', "%{$search}%");
            $query->orWhere('description', 'LIKE', "%{$search}%");
        }
        if (isset($_GET['columns'][3]['search']['value']) && $_GET['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_GET['columns'][3]['search']['value'];
            $query->Where('description', 'LIKE', "%{$search_3}%");
            $query->Where('title', 'LIKE', "%{$search_3}%");
            echo "test";
        }
        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $users = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();
        foreach ($users as $user_detail)
        {
            $no++;
            $row[0] = $no;
            $row[1] = $user_detail->term;
            $row[2] = $user_detail->description;
            $row[3] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <li>
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text paymentdetail_restore" data-id="' . $user_detail->id . '" >Restore</span>
                        </span></li>
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
    public function PaymentSubmit(Request $request)
    {
        $branch =  $request->branch;
        $request->validate(['term' => 'required', ], ['term.required' => 'term is required', ]);
        $user = auth()->user();
        $postID = $request->payment_id;
        $check = $this->check_exists($request->term,'term','qcrm_payment_terms');
        if($check<1)
        {
        $data = [
        'term' => $request->term, 'description' => $request->description,'branch'=>$branch
        ];
        $userInfo = PaymentModel::updateOrCreate(['id' => $postID], $data);
        
        return 'true';
        }
        else
        {
            return 'false';
        }
    }

    public function getPaymentTerms(Request $request)
    {
        $data['users'] = PaymentModel::where('id', $request->payment_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function deletePaymentInfo(Request $request)
    {
        $postID = $request->id;
        PaymentModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function paymentTrashRestore(Request $request)
    {
        $postID = $request->id;
        PaymentModel::where('id', $postID)->update(['del_flag' => 1]);
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


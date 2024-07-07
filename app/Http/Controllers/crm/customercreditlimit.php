<?php
namespace App\Http\Controllers\crm;
use App\crm\customerCreditlimitModel;
use App\crm\CustomerModel;
use DB;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use \PDF;
class customercreditlimit extends Controller
{
    public function customercredit_settings()
    {
        $data = CustomerModel::select('cust_name')->get();
        return view('crm.customer_CreditLimit.customerCreditlimit', compact('data'));
    }
    public function getcreditlimitcustomer(Request $request)
    {
        $data['users'] = customerCreditlimitModel::where('id', $request->id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function CustomerCreditSubmit(Request $request)
    {
        $request->validate(['numberinvoice' => 'required'], [
        'numberinvoice.required' => 'Name is required']);
        $postID = $request->info_id;
        $data = ['cust_name' => $request->cust_name, 'numberinvoice' => $request->numberinvoice, 'totalamount' => $request->totalamount, 'eachinvoice' => $request->eachinvoice, 'panelcharges' => $request->panelcharges
        ];
        $userInfo = customerCreditlimitModel::updateOrCreate(['id' => $postID], $data);
        return 'true';
    }
    public function salesmanroute_index()
    {
        return view('crm.salesman_routsettings.salemanroutetrash');
    }
    public function create()
    {
        // 
    }
    public function customercreditList(Request $request)
    {
        $data = CustomerModel::select('cust_name');
        $totalFiltered = 0;
        $totalData = customerCreditlimitModel::count();
        $query = customerCreditlimitModel::orderby('id', 'desc');
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->where('id', 'LIKE', "%{$search}%");
            $query->orWhere('cust_name', 'LIKE', "%{$search}%");
        }
        $query->where('del_flag', 0);
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
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text salesmanroutrestore" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>' . trans('app.Restore') . '</span></span><
                        </ul></div></div></span>';
            $row[2] = $user_detail->cust_name;
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
    public function salesmanrouteTrashRestore(Request $request)
    {
        $postID = $request->id;
        salesmanroute_settingModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function customercreditstore(Request $request)
    {
        $totalFiltered = 0;
        $totalData = customerCreditlimitModel::count();
        $query = customerCreditlimitModel::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->orWhere('cust_name', 'LIKE', "%{$search}%");
        }
        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('cust_name', 'LIKE', "%{$search_3}%");
            echo "test";
        }
        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $customer = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();
        foreach ($customer as $customer_detail)
        {
            $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                       <a href="#?id=' . $customer_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_13"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text customerscreditlimit" data-id="' . $customer_detail->id . '" >Edit</span>
                        </span></li></a>
                       </ul></div></div></span>';
            $row[2] = $customer_detail->cust_name;
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
    public function show($id)
    {   
    }
    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::pluck('cust_name', 'cust_name')->all();
        $userRole = $user
            ->roles
            ->pluck('cust_name', 'cust_name')
            ->all();
        return view('crm.users.edit', compact('user', 'roles', 'userRole'));
    }
    public function creditsubmitgroup(Request $request)
    {
        $request->validate(['cust_name' => 'required', ], ['cust_name.required' => 'cust_name is required', ]);
        $user = auth()->user();
        $postID = $request->cust_id;
        $data = [
        'cust_name' => $request->cust_name,
        ];

        $userInfo = customerCreditlimitModel::updateOrCreate(['id' => $postID], $data);
        return 'true';
    }
    public function getcreditlimit(Request $request)
    {
        $data['users'] = customerCreditlimitModel::where('id', $request->cust_id)
            ->limit(1)
            ->first();
        $data['addMore'] = Skillmore::where('info_id', $request->cust_id)
            ->get();
        echo json_encode($data);
    }
    public function deletecreditlimitInfo(Request $request)
    {
        $postID = $request->id;
        customerCreditlimitModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
}


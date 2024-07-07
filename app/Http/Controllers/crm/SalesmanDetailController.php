<?php

namespace App\Http\Controllers\crm;

use App\crm\SalesmanDetailModel;
use Illuminate\Http\Request;
use DB;
use PDF;
use App\User;
use Hash;
use DataTables;
use App\crm\CustomerModel;
use App\crm\Sales_customers_model;
use App\crm\salesmanroute_settingModel;
use App\crm\countryModel;
use App\settings\DepartmentModel;
use Session;
use App\settings\BranchSettingsModel;

class SalesmanDetailController extends Controller
{
    public function salesmanindex(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query  = DB::table('qcrm_salesman_details')->leftJoin('qcrm_salemanroute', 'qcrm_salesman_details.salesman_route', '=', 'qcrm_salemanroute.id')

                ->select('qcrm_salesman_details.id as id', 'qcrm_salesman_details.name as name', 'qcrm_salesman_details.target as target', 'qcrm_salesman_details.commission as commission', 'qcrm_salesman_details.place as place', 'qcrm_salemanroute.routename as salesman_route')
                ->orderby('id', 'desc');
            $query->where('qcrm_salesman_details.del_flag', 1)->where('qcrm_salesman_details.branch', $branch)->where('qcrm_salesman_details.keysalesman', 0);
            $data = $query->get();

            $count_filter = $query->count();
            $count_total = SalesmanDetailModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.salesman_details.salesman_index', compact('branch'));
    }
    public function trashsalesman()
    {
        return view('crm.salesman_details.salesman_Details_trash');
    }
    public function edit_salesman(Request $request)
    {
        $branch = Session::get('branch');

        $id = $_REQUEST['id'];
        $salesman = SalesmanDetailModel::where('id', $id)->limit(1)
            ->first();

        $salesman_route = salesmanroute_settingModel::select('id', 'routename')->where('del_flag', 1)->where('branch', $branch)->get();
        // dd($salesman_route);

        $customers = CustomerModel::select('id', 'cust_name')->get();
        $country = countryModel::select('id', 'cntry_name')->get();
        $salesman_customers = Sales_customers_model::select('customers')->where('salesmanid', $id)->get();
        $dept = DepartmentModel::select('*')->get();

        return view('crm.salesman_details.salesman_editdetails', ['data' => $salesman], compact('customers', 'salesman_customers', 'salesman_route', 'branch', 'country', 'dept'));
    }
    public function Salesmandetailsrestore(Request $request)
    {
        $id = $request->id;
        SalesmanDetailModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function Salesmandetailstrash(Request $request)
    {
        $branch = Session::get('branch');

        $totalFiltered = 0;
        $totalData     = SalesmanDetailModel::count();
        $query         = SalesmanDetailModel::orderby('id', 'desc');
        $query->where('del_flag', 0)->where('branch', $branch);
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('name', 'LIKE', "%{$search}%");
            $query->orWhere('address1', 'LIKE', "%{$search}%");
            $query->orWhere('address3', 'LIKE', "%{$search}%");
            $query->orWhere('address2', 'LIKE', "%{$search}%");
            $query->orWhere('zip', 'LIKE', "%{$search}%");
            $query->orWhere('country', 'LIKE', "%{$search}%");
            $query->orWhere('region', 'LIKE', "%{$search}%");
            $query->orWhere('place', 'LIKE', "%{$search}%");
            $query->orWhere('department_head', 'LIKE', "%{$search}%");
            $query->orWhere('department', 'LIKE', "%{$search}%");
            $query->orWhere('salesman_route', 'LIKE', "%{$search}%");
        }

        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '') {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('name', 'LIKE', "%{$search_3}%");
            $query->Where('address1', 'LIKE', "%{$search_3}%");
            $query->Where('address2', 'LIKE', "%{$search_3}%");
            $query->Where('address3', 'LIKE', "%{$search_3}%");
            $query->Where('zip', 'LIKE', "%{$search_3}%");
            $query->Where('country', 'LIKE', "%{$search_3}%");
            $query->Where('place', 'LIKE', "%{$search_3}%");
            $query->Where('region', 'LIKE', "%{$search_3}%");
            $query->Where('department_head', 'LIKE', "%{$search_3}%");
            $query->Where('department', 'LIKE', "%{$search_3}%");
            $query->Where('salesman_route', 'LIKE', "%{$search_3}%");
            echo "test";
        }
        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $salesman = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();
        foreach ($salesman as $salesman_detail) {
            $no++;
            $row[0] = $no;
            $row[1] = $salesman_detail->name;
            $row[2] = $salesman_detail->place;
            $row[3] = $salesman_detail->salesman_route;
            $row[4] = '<span style="overflow: visible; position: relative; width: 80px;">
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text salesmanrestores" id=' . $salesman_detail->id . ' data-id=' . $salesman_detail->id . '>Restore</span></span></li>
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
    //salesman details pdf

    public function salesman_detailspdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');


        $salesman = DB::table('qcrm_salesman_details')->select('id', 'name', 'commission', 'email', 'target', 'password', 'address1', 'address2', 'address3', 'zip', 'country', 'region', 'place', 'salesman_route', 'department', 'department_head', 'account_group', 'account_ledger', 'account_code')->where('del_flag', 1)->get();
        $route = DB::table('qcrm_salemanroute')->select('id', 'routename')->where('del_flag', 1)->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

        $pdf = PDF::loadView('crm.salesman_details.pdf', compact('salesman', 'route', 'branchsettings'));

        return $pdf->stream('document.pdf');
    }

    public function deletesalesman(Request $request)
    {
        $id = $request->id;
        $query = DB::table('qcrm_customer_details')->select('salesman')->where('salesman', $id)->where('del_flag', 1)->get();
        $no = $query->count();
        if ($no > 0) {
            return '1';
        } else {
            SalesmanDetailModel::where('id', $id)->update(['del_flag' => 0]);
            return '0';
        }
    }
    public function addsalesmandetails()
    {
        $branch = Session::get('branch');

        $customers = CustomerModel::select('id', 'cust_name')->get();
        $salesman_route = salesmanroute_settingModel::select('id', 'routename')->where('del_flag', 1)->where('branch', $branch)->get();
        $country = countryModel::select('id', 'cntry_name')->get();
        $dept = DepartmentModel::select('*')->get();
        return view('crm.salesman_details.salesman_adddetails', compact('customers', 'salesman_route', 'branch', 'country', 'dept'));
    }
    public function SalesmanSubmit(Request $request)
    {

        // $request->validate(['name' => 'required'], ['name.required' => 'name is required']);
        $branch = $request->branch;
        $postID = $request->info_id;
        $check = $this->check_exists($request->name, 'name', 'qcrm_salesman_details');
        if (isset($postID) && !empty($postID)) {
            $check = $this->check_exists_edit($postID, $request->email, 'email', 'qcrm_salesman_details');
        } else {
            $check = $this->check_exists($request->email, 'email', 'qcrm_salesman_details');
        }
        if ($check < 1) {
            $data = [
                'user_id' => 1, 'name' => $request->name, 'email' => $request->email, 'password' => encrypt($request->password),
                'address1' => $request->address1, 'address2' => $request->address2, 'address3' => $request->address3, 'zip' => $request->zip, 'country' => $request->country, 'region' => $request->region, 'place' => $request->place, 'department' => $request->department, 'department_head' => $request->department_head, 'salesman_route' => $request->salesman_route, 'account_group' => $request->parent_group, 'account_ledger' => $request->ledgername, 'account_code' => $request->ledgercode, 'target' => $request->target, 'commission' => $request->commission, 'branch' => $branch, 'keysalesman' => 0
            ];
            $userInfo = SalesmanDetailModel::updateOrCreate(['id' => $postID], $data);
            $id = DB::getPdo('qcrm_salesman_details')->lastInsertId();

            // for ($i = 0; $i < count($request->customers); $i++) 
            // {
            //    $data1 = [
            //        'salesmanid'=> $id,
            //        'customers' => $request->customers[$i]           
            //         ];
            //    $sales_customers = Sales_customers_model::Create($data1);
            // }
            return 'true';
        } else {
            return 'false';
        }
    }
    // public function SalesmandetailsList(Request $request)
    // {
    //     $totalFiltered = 0;
    //     $totalData = SalesmanDetailModel::count();
    //     $query = SalesmanDetailModel::orderby('id', 'desc');
    //     $query->where('del_flag', 1);
    //     if (!empty($request->input('search.value')))
    //     {
    //         $search = $request->input('search.value');
    //         $query->Where('id', 'LIKE', "%{$search}%");
    //         $query->orWhere('name', 'LIKE', "%{$search}%");
    //         $query->orWhere('address1', 'LIKE', "%{$search}%");
    //         $query->orWhere('address3', 'LIKE', "%{$search}%");
    //         $query->orWhere('address2', 'LIKE', "%{$search}%");
    //         $query->orWhere('zip', 'LIKE', "%{$search}%");
    //         $query->orWhere('country', 'LIKE', "%{$search}%");
    //         $query->orWhere('region', 'LIKE', "%{$search}%");
    //         $query->orWhere('place', 'LIKE', "%{$search}%");
    //         $query->orWhere('department_head', 'LIKE', "%{$search}%");
    //         $query->orWhere('department', 'LIKE', "%{$search}%");
    //         $query->orWhere('salesman_route', 'LIKE', "%{$search}%");
    //     }
    //     if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
    //     {
    //         $search_3 = $_POST['columns'][3]['search']['value'];
    //         $query->Where('name', 'LIKE', "%{$search_3}%");
    //         $query->Where('address1', 'LIKE', "%{$search_3}%");
    //         $query->Where('address2', 'LIKE', "%{$search_3}%");
    //         $query->Where('address3', 'LIKE', "%{$search_3}%");
    //         $query->Where('zip', 'LIKE', "%{$search_3}%");
    //         $query->Where('country', 'LIKE', "%{$search_3}%");
    //         $query->Where('place', 'LIKE', "%{$search_3}%");
    //         $query->Where('region', 'LIKE', "%{$search_3}%");
    //         $query->Where('department_head', 'LIKE', "%{$search_3}%");
    //         $query->Where('department', 'LIKE', "%{$search_3}%");
    //         $query->Where('salesman_route', 'LIKE', "%{$search_3}%");
    //         echo "test";
    //     }
    //     $totalFiltered = $query->count();
    //     $query->skip($_POST['start'])->take($_POST['length']);
    //     $salesman = $query->get();
    //     $data = array();
    //     $no = $_POST['start'];
    //     $i = 0;
    //     $row = array();
    //     foreach ($salesman as $salesman_detail)
    //     {
    //         $no++;
    //         $row[0] = $no;
    //         $row[1] = $salesman_detail->name;
    //         $row[2] = $salesman_detail->place;
    //         $row[3] = $salesman_detail->salesman_route;
    //         $row[4] = '<span style="overflow: visible; position: relative; width: 80px;">
    //                      <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    //                      <i class="fa fa-cog"></i></i></a>
    //                      <div class="dropdown-menu dropdown-menu-right">
    //                      <ul class="kt-nav">
    //                      <a href="view_salesman?id=' . $salesman_detail->id . '" ><li class="kt-nav__item">
    //                      <span class="kt-nav__link">
    //                      <i class="kt-nav__link-icon flaticon2-contract"></i>
    //                      <span class="kt-nav__link-text" data-id="' . $salesman_detail->id . '" >View</span>
    //                      </span></li></a>
    //                     <a href="edit_salesman?id=' . $salesman_detail->id . '" ><li class="kt-nav__item">
    //                      <span class="kt-nav__link">
    //                      <i class="kt-nav__link-icon flaticon2-contract"></i>
    //                      <span class="kt-nav__link-text Customersdetail_update" data-id="' . $salesman_detail->id . '" >Edit</span>
    //                      </span></li></a>
    //                        <li class="kt-nav__item">
    //                      <span class="kt-nav__link">
    //                      <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                      <span class="kt-nav__link-text kt_del_salesmaninformation" id=' . $salesman_detail->id . ' data-id=' . $salesman_detail->id . '>Delete</span></span></li>
    //                     </ul></div></div></span>';
    //         $data[$i] = $row;
    //         $i++;
    //     }
    //     $output = array(
    //         "draw"           => $_POST['draw'],
    //         "recordsTotal"   => $totalData,
    //         "recordsFiltered"=> $totalFiltered,
    //         "data"           => $data,
    //     );
    //     echo json_encode($output);
    // }
    public function view_salesman(Request $request)
    {
        $id = $_REQUEST['id'];
        $salesman = SalesmanDetailModel::where('id', $id)->limit(1)
            ->first();
        return view('crm.salesman_details.salesman_view', ['data' => $salesman]);
    }
    public function salesmanaccounts()
    {
        $groups = DB::table('a_branch1_a_groups')->get()
            ->toArray();
        return view('crm.salesman_details.salesmanaccounts', compact('groups'));
    }
    public function salesman_accounts_detailslist(Request $request)
    {
        $totalFiltered = 0;
        $totalData     = SalesmanDetailModel::count();
        $query         = SalesmanDetailModel::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('name', 'LIKE', "%{$search}%");
            $query->orWhere('address1', 'LIKE', "%{$search}%");
            $query->orWhere('address3', 'LIKE', "%{$search}%");
            $query->orWhere('address2', 'LIKE', "%{$search}%");
            $query->orWhere('zip', 'LIKE', "%{$search}%");
            $query->orWhere('country', 'LIKE', "%{$search}%");
            $query->orWhere('region', 'LIKE', "%{$search}%");
            $query->orWhere('place', 'LIKE', "%{$search}%");
            $query->orWhere('department_head', 'LIKE', "%{$search}%");
            $query->orWhere('department', 'LIKE', "%{$search}%");
            $query->orWhere('salesman_route', 'LIKE', "%{$search}%");
        }
        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '') {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('name', 'LIKE', "%{$search_3}%");
            $query->Where('address1', 'LIKE', "%{$search_3}%");
            $query->Where('address2', 'LIKE', "%{$search_3}%");
            $query->Where('address3', 'LIKE', "%{$search_3}%");
            $query->Where('zip', 'LIKE', "%{$search_3}%");
            $query->Where('country', 'LIKE', "%{$search_3}%");
            $query->Where('place', 'LIKE', "%{$search_3}%");
            $query->Where('region', 'LIKE', "%{$search_3}%");
            $query->Where('department_head', 'LIKE', "%{$search_3}%");
            $query->Where('department', 'LIKE', "%{$search_3}%");
            $query->Where('salesman_route', 'LIKE', "%{$search_3}%");
            echo "test";
        }
        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $salesman = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();
        foreach ($salesman as $salesman_detail) {

            $no++;
            $row[0] = $no;
            $row[1] = $salesman_detail->name;
            $row[2] = $salesman_detail->place;
            $row[3] = $salesman_detail->salesman_route;
            $row[4] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                       </a>
                        <a href="#?id=' . $salesman_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5">
                         <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text kt_edit_salesman_accounts" id=' . $salesman_detail->id . ' data-id=' . $salesman_detail->id . '>Update</span></span></li> </a>
                       </ul></div></div></span>';
            $data[$i] = $row;
            $i++;
        }
        $output = array(
            "draw"             => $_POST['draw'],
            "recordsTotal"     => $totalData,
            "recordsFiltered"  => $totalFiltered,
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function getsalesmanaccounts(Request $request)
    {
        $data['accounts'] = SalesmanDetailModel::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function salesmanAccountSubmit(Request $request)
    {
        $salesman_id = $request->salesman_id;
        $data = [
            'account_group' => $request->accounts_group, 'account_ledger' => $request->accounts_ledger, 'account_code' => $request->accounts_code
        ];
        $userInfo = SalesmanDetailModel::updateOrCreate(['id' => $salesman_id], $data);
        return 'true';
    }
    public function keysalesmanindex(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query  = DB::table('qcrm_salesman_details')->leftJoin('qcrm_salemanroute', 'qcrm_salesman_details.salesman_route', '=', 'qcrm_salemanroute.id')

                ->select('qcrm_salesman_details.id as id', 'qcrm_salesman_details.name as name', 'qcrm_salesman_details.target as target', 'qcrm_salesman_details.commission as commission', 'qcrm_salesman_details.place as place', 'qcrm_salemanroute.routename as salesman_route', 'qcrm_salesman_details.email')
                ->orderby('id', 'desc');
            $query->where('qcrm_salesman_details.del_flag', 1)->where('qcrm_salesman_details.branch', $branch)->where('qcrm_salesman_details.keysalesman', 1);
            $data = $query->get();

            $count_filter = $query->count();
            $count_total = SalesmanDetailModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.salesman_details.salesman_indexkey', compact('branch'));
    }
    public function keyaddsalesmandetails()
    {
        $branch = Session::get('branch');

        $customers = CustomerModel::select('id', 'cust_name')->get();
        $salesman_route = salesmanroute_settingModel::select('id', 'routename')->where('del_flag', 1)->where('branch', $branch)->get();
        $country = countryModel::select('id', 'cntry_name')->get();
        $dept = DepartmentModel::select('*')->get();
        return view('crm.salesman_details.keysalesman_adddetails', compact('customers', 'salesman_route', 'branch', 'country', 'dept'));
    }
    public function keySalesmanSubmit(Request $request)
    {


        // $request->validate(['name' => 'required'], ['name.required' => 'name is required']);
        $branch = $request->branch;
        $postID = $request->info_id;
        $check = $this->check_exists($request->name, 'name', 'qcrm_salesman_details');
        if (isset($postID) && !empty($postID)) {
            $check = $this->check_exists_edit($postID, $request->email, 'email', 'qcrm_salesman_details');
        } else {
            $check = $this->check_exists($request->email, 'email', 'qcrm_salesman_details');
        }
        if ($check < 1) {
            $data = [
                'user_id' => 1, 'name' => $request->name, 'email' => $request->email, 'password' => encrypt($request->password),
                'address1' => $request->address1, 'address2' => $request->address2, 'address3' => $request->address3, 'zip' => $request->zip, 'country' => $request->country, 'region' => $request->region, 'place' => $request->place, 'department' => $request->department, 'department_head' => $request->department_head, 'salesman_route' => $request->salesman_route, 'account_group' => $request->parent_group, 'account_ledger' => $request->ledgername, 'account_code' => $request->ledgercode, 'target' => $request->target, 'commission' => $request->commission, 'branch' => $branch, 'keysalesman' => 1, 'signature' => $request->signature,
            ];
            $userInfo = SalesmanDetailModel::updateOrCreate(['id' => $postID], $data);
            $id = DB::getPdo('qcrm_salesman_details')->lastInsertId();

            // for ($i = 0; $i < count($request->customers); $i++) 
            // {
            //    $data1 = [
            //        'salesmanid'=> $id,
            //        'customers' => $request->customers[$i]           
            //         ];
            //    $sales_customers = Sales_customers_model::Create($data1);
            // }
            return 'true';
        } else {
            return 'false';
        }
    }
    public function keyedit_salesman(Request $request)
    {
        $branch = Session::get('branch');

        $id = $_REQUEST['id'];
        $salesman = SalesmanDetailModel::where('id', $id)->limit(1)
            ->first();

        $salesman_route = salesmanroute_settingModel::select('id', 'routename')->where('del_flag', 1)->where('branch', $branch)->get();
        // dd($salesman_route);

        $customers = CustomerModel::select('id', 'cust_name')->get();
        $country = countryModel::select('id', 'cntry_name')->get();
        $salesman_customers = Sales_customers_model::select('customers')->where('salesmanid', $id)->get();
        $dept = DepartmentModel::select('*')->get();

        return view('crm.salesman_details.keysalesman_editdetails', ['data' => $salesman], compact('customers', 'salesman_customers', 'salesman_route', 'branch', 'country', 'dept'));
    }
    public function keydeletesalesman(Request $request)
    {
        $id = $request->id;
        $query = DB::table('qcrm_customer_details')->select('salesman')->where('salesman', $id)->where('del_flag', 1)->get();
        $no = $query->count();
        if ($no > 0) {
            return '1';
        } else {
            SalesmanDetailModel::where('id', $id)->update(['del_flag' => 0]);
            return '0';
        }
    }
    public function check_exists($value, $field, $table)
    {
        $branch = Session::get('branch');

        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->where('branch', $branch)->get();
        // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
        return $query->count();
    }
    public function getsalesmanemail(Request $request)
    {
        $branch = Session::get('branch');
        $email = $request->id;
        $query = DB::table('qcrm_salesman_details')->select('*')->where('email', $email)->where('del_flag', 1)->where('branch', $branch)->get();
        $check = $query->count();
        return $check;
    }
    public function check_exists_edit($id, $value, $field, $table)
    {
        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->whereNotIn('id', [$id])->get();

        return $query->count();
    }
}

<?php

namespace App\Http\Controllers;

use App\CustomerModel;
use App\customer;
use App\SupplierModel;
use App\Supplier;
use App\Category;
use App\suppliertype;
use App\SupplierCategory;
use App\CustomerTypeModel;
use App\CustomerCategoryModel;
use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;

class SupplierController extends Controller
{
    public function supplierdetailss()
    {
        return view('suppliers.suppliers');
    }
    public function supplierdetailstrash()
    {
        return view('suppliers.trash');
    }
    public function edits($id)
    {
        $userInfo = SupplierModel::findOrFail($id);

        // dd($userInfo);
        $areaLists = suppliertype::select('id', 'title')->get();
        $areaList = SupplierCategory::select('id', 'title')->get();

        // return view('customer.customer_details_add', compact('areaList', 'areaLists'));
        return view('suppliers.supplier_add', compact('areaList', 'areaLists'))
            ->with('userInfo', $userInfo);


        // $skill = [];

        // $id = $_REQUEST['id'];
        // $users = SupplierModel::where('id', $id)->limit(1)
        //     ->first();
        // $areaLists = suppliertype::select('id', 'title')->Where('del_flag', 1)
        //     ->get();
        // $areaList = SupplierCategory::select('id', 'title')->Where('del_flag', 1)
        //     ->get();

        // $skill = Supplier::where('info_id', $id)->limit(1)
        //     ->first();
        // return view('suppliers.supplier_add', ['data' => $users, 'datas' => $skill], compact('areaLists', 'areaList'))
        //             ->with('userInfo',$userInfo);











    }
    public function category_list()
    {
        return view('supplier_category.suppliercategory');
    }
    public function Categoryshows(Request $request)

    {
        $totalFiltered = 0;
        $totalData = SupplierCategory::count();
        $query = SupplierCategory::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('title', 'LIKE', "%{$search}%");
            $query->orWhere('discription', 'LIKE', "%{$search}%");
            $query->orWhere('customcode', 'LIKE', "%{$search}%");
            $query->orWhere('startfrom', 'LIKE', "%{$search}%");
        }
        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '') {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('title', 'LIKE', "%{$search_3}%");
            $query->Where('discription', 'LIKE', "%{$search_3}%");
            $query->Where('customcode', 'LIKE', "%{$search_3}%");
            $query->Where('startfrom', 'LIKE', "%{$search_3}%");

            $query->Where('startfrom', 'LIKE', "%{$search_3}%");

            echo "test";
        }
        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $users = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();
        foreach ($users as $user_detail) {
            $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                        <a href="#?id=' . $user_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_8"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text suppliercategorydetail_update" data-id="' . $user_detail->id . '" >Edit</span>
                        </span></li></a>

                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_suppliercatgryinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Delete</span></span></li>
                        </ul></div></div></span>';
            $row[2] = $user_detail->title;
            $row[3] = $user_detail->discription;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $user_detail->color . '">&nbsp;&nbsp;</div>';
            $row[5] = $user_detail->customcode;
            $row[6] = $user_detail->startfrom;

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
    public function findsupplierstartfrom(Request $request)
    {
        $id = $request->id;
        $data =  SupplierCategory::select('cust_start')->where('title', $id)->get();
        foreach ($data as $value) {
            $cust_start = $value->cust_start;
        }
        return response()->json($cust_start);
    }
    public function Submit(Request $request)
    {

        $request->validate(['title' => 'required',], ['title.required' => 'title is required',]);
        $user = auth()->user();
        $postID = $request->cust_id;
        $data = [
            'cust_start' => $request->customcode . '/' . number_format($request->startfrom + 1),
            'title' => $request->title, 'discription' => $request->discription, 'color' => $request->color, 'customcode' => $request->customcode, 'startfrom' => $request->startfrom,
        ];

        $userInfo = SupplierCategory::updateOrCreate(['id' => $postID], $data);

        return 'true';
    }
    public function getsuppliercatgry(Request $request)
    {

        $data['users'] = SupplierCategory::where('id', $request->cust_id)
            ->limit(1)
            ->first();
        // print_r( $data['users']);
        // exit();
        echo json_encode($data);
    }
    public function suplircatgry_trash()
    {
        return view('supplier_category.suppliercatgrytrash');
    }
    public function sup_cat_TrashRestore(Request $request)
    {
        $postID = $request->id;

        //echo $postID;
        SupplierCategory::where('id', $postID)->update(['del_flag' => 1]);

        return 'true';
    }

    public function getsuplirctgry_trash(Request $request)
    {
        $totalFiltered = 0;

        $totalData = SupplierCategory::count();

        $query = SupplierCategory::orderby('id', 'desc');

        if (!empty($request->input('search.value'))) {

            $search = $request->input('search.value');

            $query->where('id', 'LIKE', "%{$search}%");

            $query->orWhere('title', 'LIKE', "%{$search}%");
        }

        $query->where('del_flag', 0);

        $totalFiltered = $query->count();

        $query->skip($_POST['start'])->take($_POST['length']);

        $users = $query->get();

        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();

        foreach ($users as $user_detail) {

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
                        <span class="kt-nav__link-text sup_cat_typerestore" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Restore</span></span></li>

                        
                        </ul></div></div></span>';
            $row[2] = $user_detail->title;
            $row[3] = $user_detail->discription;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $user_detail->color . '">&nbsp;&nbsp;</div>';
            $row[5] = $user_detail->customcode;
            $row[6] = $user_detail->startfrom;

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
    public function deletesuppliercatgryInfo(Request $request)
    {
        $postID = $request->id;
        SupplierCategory::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }

    public function suplir_type()
    {
        return view('supplier_type.suppliertype');
    }
    public function suppliertypestore(Request $request)

    {
        $totalFiltered = 0;
        $totalData = suppliertype::count();
        $query = suppliertype::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('title', 'LIKE', "%{$search}%");
            $query->orWhere('discription', 'LIKE', "%{$search}%");
        }
        if (isset($_GET['columns'][3]['search']['value']) && $_GET['columns'][3]['search']['value'] != '') {
            $search_3 = $_GET['columns'][3]['search']['value'];
            $query->Where('title', 'LIKE', "%{$search_3}%");
            $query->Where('discription', 'LIKE', "%{$search_3}%");

            echo "test";
        }
        $totalFiltered = $query->count();
        $query->skip($_GET['start'])->take($_GET['length']);
        $users = $query->get();
        $data = array();
        $no = $_GET['start'];
        $i = 0;
        $row = array();
        foreach ($users as $user_detail) {
            $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                        <a href="#?id=' . $user_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_7"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text suppliertypedetail_update" data-id="' . $user_detail->id . '" >Edit</span>
                        </span></li></a>

                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_supplierinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Delete</span></span></li>
                        </ul></div></div></span>';
            $row[2] = $user_detail->title;
            $row[3] = $user_detail->discription;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $user_detail->color . '">&nbsp;&nbsp;</div>';

            $data[$i] = $row;
            $i++;
        }

        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        );

        echo json_encode($output);
    }
    public function suplir_trash()
    {
        return view('supplier_type.suppliertypetrash');
    }
    public function getsuplir_trash(Request $request)
    {
        $totalFiltered = 0;

        $totalData = suppliertype::count();

        $query = suppliertype::orderby('id', 'desc');

        if (!empty($request->input('search.value'))) {

            $search = $request->input('search.value');

            $query->where('id', 'LIKE', "%{$search}%");

            $query->orWhere('title', 'LIKE', "%{$search}%");
        }

        $query->where('del_flag', 0);

        $totalFiltered = $query->count();

        $query->skip($_POST['start'])->take($_POST['length']);

        $users = $query->get();

        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();

        foreach ($users as $user_detail) {

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
                        <span class="kt-nav__link-text typerestore" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Restore</span></span></li>

                        
                        </ul></div></div></span>';
            $row[2] = $user_detail->title;
            $row[3] = $user_detail->discription;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $user_detail->color . '">&nbsp;&nbsp;</div>';

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
    public function typetrashrestores(Request $request)
    {
        $postID = $request->id;

        //echo $postID;
        suppliertype::where('id', $postID)->update(['del_flag' => 1]);

        return 'true';
    }
    public function deletesupplierInfo(Request $request)
    {
        $postID = $request->id;
        suppliertype::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function getsuppliertype(Request $request)
    {

        $data['users'] = suppliertype::where('id', $request->cust_id)
            ->limit(1)
            ->first();
        $data['addMore'] = Skillmore::where('info_id', $request->cust_id)
            ->get();

        echo json_encode($data);
    }
    public function suptrashlist(Request $request)
    {
        $totalFiltered = 0;

        $totalData = SupplierModel::count();

        $query = SupplierModel::orderby('id', 'desc');

        if (!empty($request->input('search.value'))) {

            $search = $request->input('search.value');

            $query->where('id', 'LIKE', "%{$search}%");

            $query->orWhere('cust_category', 'LIKE', "%{$search}%");
        }

        $query->where('del_flag', 0);

        $totalFiltered = $query->count();

        $query->skip($_POST['start'])->take($_POST['length']);

        $users = $query->get();

        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();

        foreach ($users as $customer_detail) {

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
                        <span class="kt-nav__link-text kt_restore_supplierinformation" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Restore</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $customer_detail->sup_code;
            $row[3] = $customer_detail->sup_type;
            $row[4] = $customer_detail->sup_category;
            $row[5] = $customer_detail->salesman;
            $row[6] = $customer_detail->key_account;
            $row[7] = $customer_detail->sup_name;
            $row[8] = $customer_detail->sup_add1;
            $row[9] = $customer_detail->sup_add2;
            $row[10] = $customer_detail->sup_country;
            $row[11] = $customer_detail->sup_region;
            $row[12] = $customer_detail->sup_city;
            $row[13] = $customer_detail->sup_zip;
            $row[14] = $customer_detail->email1;
            $row[15] = $customer_detail->email2;
            $row[16] = $customer_detail->office_phone1;
            $row[17] = $customer_detail->office_phone2;
            $row[18] = $customer_detail->mobile1;
            $row[19] = $customer_detail->mobile2;
            $row[20] = $customer_detail->fax;
            $row[21] = $customer_detail->website;
            $row[22] = $customer_detail->contact_person;
            $row[23] = $customer_detail->contact_person_incharge;
            $row[24] = $customer_detail->mobile;
            $row[25] = $customer_detail->office;
            $row[26] = $customer_detail->contact_department;
            $row[27] = $customer_detail->email;
            $row[28] = $customer_detail->location;
            $row[29] = $customer_detail->portal;
            $row[30] = $customer_detail->username;
            $row[31] = $customer_detail->registerd_email;
            $row[32] = $customer_detail->password;
            $row[33] = $customer_detail->sup_note;

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

    public function view_supplier(Request $request)
    {
        $id = $_REQUEST['id'];

        $users = SupplierModel::where('id', $id)->limit(1)
            ->first();

        return view('suppliers.supplier_view', ['data' => $users]);
    }
    public function edit_supplier(Request $request)
    {
        $skill = [];

        $id = $_REQUEST['id'];
        $users = SupplierModel::where('id', $id)->limit(1)
            ->first();
        $areaLists = suppliertype::select('id', 'title')->Where('del_flag', 1)
            ->get();
        $areaList = SupplierCategory::select('id', 'title')->Where('del_flag', 1)
            ->get();

        $skill = Supplier::where('info_id', $id)->limit(1)
            ->first();
        return view('suppliers.supplier_edit', ['data' => $users, 'datas' => $skill], compact('areaLists', 'areaList'));
    }
    public function index()
    {
        $areaList = SupplierCategory::select('id', 'title')->get();
        $areaLists = suppliertype::select('id', 'title')->get();

        return view('suppliers.supplier_add', compact('areaLists', 'areaList'));
    }

    public function suppliershow(Request $request)
    {
        $data = DB::table('customer_details')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_categorydetails.customer_category', "=", "customer_details.cust_category")
            ->get()
            ->toArray();
        // echo"<pre>";
        // print_r($data);
        // exit();


        $totalFiltered = 0;
        $totalData = SupplierModel::count();
        $query = SupplierModel::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('sup_code', 'LIKE', "%{$search}%");
            $query->orWhere('sup_type', 'LIKE', "%{$search}%");
            $query->orWhere('sup_category', 'LIKE', "%{$search}%");
            $query->orWhere('salesman', 'LIKE', "%{$search}%");
            $query->orWhere('key_account', 'LIKE', "%{$search}%");
            $query->orWhere('sup_name', 'LIKE', "%{$search}%");
            $query->orWhere('sup_add1', 'LIKE', "%{$search}%");
            $query->orWhere('sup_add2', 'LIKE', "%{$search}%");
            $query->orWhere('sup_country', 'LIKE', "%{$search}%");
            $query->orWhere('sup_city', 'LIKE', "%{$search}%");
            $query->orWhere('sup_region', 'LIKE', "%{$search}%");
            $query->orWhere('sup_zip', 'LIKE', "%{$search}%");
            $query->orWhere('email1', 'LIKE', "%{$search}%");
            $query->orWhere('email2', 'LIKE', "%{$search}%");
            $query->orWhere('office_phone1', 'LIKE', "%{$search}%");
            $query->orWhere('office_phone2', 'LIKE', "%{$search}%");
            $query->orWhere('mobile1', 'LIKE', "%{$search}%");
            $query->orWhere('mobile2', 'LIKE', "%{$search}%");
            $query->orWhere('fax', 'LIKE', "%{$search}%");
            $query->orWhere('website', 'LIKE', "%{$search}%");
            $query->orWhere('contact_person', 'LIKE', "%{$search}%");
            $query->orWhere('contact_person_incharge', 'LIKE', "%{$search}%");
            $query->orWhere('mobile', 'LIKE', "%{$search}%");
            $query->orWhere('office', 'LIKE', "%{$search}%");
            $query->orWhere('contact_department', 'LIKE', "%{$search}%");
            $query->orWhere('email', 'LIKE', "%{$search}%");
            $query->orWhere('location', 'LIKE', "%{$search}%");
            $query->orWhere('portal', 'LIKE', "%{$search}%");
            $query->orWhere('username', 'LIKE', "%{$search}%");
            $query->orWhere('registerd_email', 'LIKE', "%{$search}%");
            $query->orWhere('password', 'LIKE', "%{$search}%");
        }

        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '') {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('password', 'LIKE', "%{$search_3}%");
            $query->Where('registerd_email', 'LIKE', "%{$search_3}%");
            $query->Where('username', 'LIKE', "%{$search_3}%");
            $query->Where('portal', 'LIKE', "%{$search_3}%");
            $query->Where('location', 'LIKE', "%{$search_3}%");
            $query->Where('email', 'LIKE', "%{$search_3}%");
            $query->Where('contact_department', 'LIKE', "%{$search_3}%");
            $query->Where('office', 'LIKE', "%{$search_3}%");
            $query->Where('mobile', 'LIKE', "%{$search_3}%");
            $query->Where('contact_person_incharge', 'LIKE', "%{$search_3}%");
            $query->Where('contact_person', 'LIKE', "%{$search_3}%");
            $query->Where('website', 'LIKE', "%{$search_3}%");
            $query->Where('fax', 'LIKE', "%{$search_3}%");
            $query->Where('mobile2', 'LIKE', "%{$search_3}%");
            $query->Where('mobile1', 'LIKE', "%{$search_3}%");
            $query->Where('office_phone2', 'LIKE', "%{$search_3}%");
            $query->Where('office_phone1', 'LIKE', "%{$search_3}%");
            $query->Where('email2', 'LIKE', "%{$search_3}%");
            $query->Where('email1', 'LIKE', "%{$search_3}%");
            $query->Where('sup_zip', 'LIKE', "%{$search_3}%");
            $query->Where('sup_city', 'LIKE', "%{$search_3}%");
            $query->Where('sup_region', 'LIKE', "%{$search_3}%");
            $query->Where('sup_country', 'LIKE', "%{$search_3}%");
            $query->Where('sup_add2', 'LIKE', "%{$search_3}%");
            $query->Where('sup_add1', 'LIKE', "%{$search_3}%");
            $query->Where('sup_name', 'LIKE', "%{$search_3}%");
            $query->Where('key_account', 'LIKE', "%{$search_3}%");
            $query->Where('salesman', 'LIKE', "%{$search_3}%");
            $query->Where('sup_category', 'LIKE', "%{$search_3}%");
            $query->Where('sup_type', 'LIKE', "%{$search_3}%");
            $query->Where('sup_code', 'LIKE', "%{$search_3}%");
            echo "test";
        }

        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $supplier = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();

        foreach ($supplier as $supplier_detail) {

            $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                        <a href="view_supplier?id=' . $supplier_detail->id . '" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text" data-id="' . $supplier_detail->id . '" >View</span>
                        </span></li></a>

                      

                        <a href="edit_suppliers/' . $supplier_detail->id . '"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Customerdetail_update" data-id="' . $supplier_detail->id . '" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_customerinformation" id=' . $supplier_detail->id . ' data-id=' . $supplier_detail->id . '>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $supplier_detail->sup_code;
            $row[3] = $supplier_detail->sup_type;
            $row[4] = $supplier_detail->sup_category;
            $row[5] = $supplier_detail->salesman;
            $row[6] = $supplier_detail->key_account;
            $row[7] = $supplier_detail->sup_name;
            $row[8] = $supplier_detail->sup_add1;
            $row[9] = $supplier_detail->sup_add2;
            $row[10] = $supplier_detail->sup_country;
            $row[11] = $supplier_detail->sup_region;
            $row[12] = $supplier_detail->sup_city;
            $row[13] = $supplier_detail->sup_zip;
            $row[14] = $supplier_detail->email1;
            $row[15] = $supplier_detail->email2;
            $row[16] = $supplier_detail->office_phone1;
            $row[17] = $supplier_detail->office_phone2;
            $row[18] = $supplier_detail->mobile1;
            $row[19] = $supplier_detail->mobile2;
            $row[20] = $supplier_detail->fax;
            $row[21] = $supplier_detail->website;
            $row[22] = $supplier_detail->contact_person;
            $row[23] = $supplier_detail->contact_person_incharge;
            $row[24] = $supplier_detail->mobile;
            $row[25] = $supplier_detail->office;
            $row[26] = $supplier_detail->contact_department;
            $row[27] = $supplier_detail->email;
            $row[28] = $supplier_detail->location;
            $row[29] = $supplier_detail->portal;
            $row[30] = $supplier_detail->username;
            $row[31] = $supplier_detail->registerd_email;
            $row[32] = $supplier_detail->password;
            $row[33] = $supplier_detail->sup_note;
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

    public function deletefiles(Request $request)
    {
        $postID = $request->id;
        SupplierModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }

    public function suppliersubmit(Request $request)
    {
        $request->validate(['username' => 'required'], [

            'username.required' => 'username is required'
        ]);
        $user = auth()->user();
        $postID = $request->info_id;
        $data = [
            'sup_code' => $request->sup_code, 'sup_type' => $request->sup_type, 'sup_category' => $request->sup_category, 'salesman' => $request->salesman, 'key_account' => $request->key_account, 'sup_note' => $request->sup_note,

            'sup_name' => $request->sup_name, 'sup_add1' => $request->sup_add1, 'sup_add2' => $request->sup_add2, 'sup_country' => $request->sup_country, 'sup_region' => $request->sup_region, 'sup_city' => $request->sup_city, 'sup_zip' => $request->sup_zip, 'email1' => $request->email1, 'email2' => $request->email2, 'office_phone1' => $request->office_phone1, 'office_phone2' => $request->office_phone2, 'mobile1' => $request->mobile1, 'mobile2' => $request->mobile2, 'fax' => $request->fax, 'website' => $request->website, 'contact_person' => $request->contact_person, 'contact_person_incharge' => $request->contact_person_incharge, 'mobile' => $request->mobile, 'office' => $request->office, 'contact_department' => $request->contact_department, 'email' => $request->email, 'location' => $request->location,

            'portal' => $request->portal, 'username' => $request->username, 'registerd_email' => $request->registerd_email, 'password' => encrypt($request->password),

        ];

        $userInfo = SupplierModel::updateOrCreate(['id' => $postID], $data);
        Supplier::where('info_id', $userInfo->id)
            ->delete();

        if (!empty($request->mobiles)) {
            foreach ($request->mobiles as $key => $value) {
                // dd($request);
                // exit();
                Supplier::create([

                    'info_id' => $userInfo->id, 'contact_personvalue' => $request->contact_personvalue[$key], 'contact_person_incharges' => $request->contact_person_incharges[$key], 'mobiles' => $request->mobiles[$key], 'offices' => $request->offices[$key], 'emails' => $request->emails[$key], 'departments' => $request->departments[$key], 'locations' => $request->locations[$key],

                ]);
            }
        }

        return 'true';
    }
    public function deletesuppliertypeInfo(Request $request)
    {
        $postID = $request->id;
        suppliertype::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function typeSubmit(Request $request)
    {

        $request->validate(['title' => 'required',], ['title.required' => 'title is required',]);
        $user = auth()->user();
        $postID = $request->cust_id;
        $data = [

            'title' => $request->title, 'discription' => $request->discription, 'color' => $request->color
        ];

        $userInfo = suppliertype::updateOrCreate(['id' => $postID], $data);

        return 'true';
    }
    public function supplierTrashRestore(Request $request)
    {
        $postID = $request->id;

        //echo $postID;
        SupplierModel::where('id', $postID)->update(['del_flag' => 1]);

        return 'true';
    }
}

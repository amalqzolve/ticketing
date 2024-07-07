<?php
namespace App\Http\Controllers;
use App\CustomerModel;
use App\customer;
use APP\Category;
use App\CustomerTypeModel;
use App\CustomerCategoryModel;
use App\CustomerGroup;
use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;

class CustomerController extends Controller
{
    public function index()
    {

        return view('customer.customer_details');
    }
    public function getcustomersdetailss()
    {

    }
    public function findstartform(Request $request)
    {
         $id=$request->id;
         $data=  CustomerCategoryModel::select('cust_start')->where('customer_category',$id)->get();
         foreach ($data as $value) {
             $cust_start= $value->cust_start;
              }
        return response()->json($cust_start);
    }
    public function grouptrashrestore(Request $request)
    {
    
    $postID = $request->id;

        CustomerGroup::where('id', $postID)->update(['del_flag' => 1]);

        return 'true';
    }    
    public function grouptrash()
    {
        return view('customer_grop.group_trash');
    }
    public function groupdelete(Request $request)
    {
        $delete = $request->id;
        CustomerGroup::where('id',$delete)->update(['del_flag' => 0]);
        return 'true';

    }
    public function groupupdate(Request $request)
    {
        $data['users']=CustomerGroup::where('id',$request->info_id)
                      ->limit(1)
                      ->first();
        echo json_encode($data);
    }
    public function groupindex()
    {
        return view('customer_grop.groupindex');
    }
    public function groupsubmit(Request $request)
    {
        $request->validate(['title' => 'required'], [

        'title.required' => 'title is required']);
        $user = auth()->user();
        $postID = $request->info_id;
        $data = ['title' => $request->title, 'description' => $request->description, 'color' => $request->color

        ];

        $userInfo = CustomerGroup::updateOrCreate(['id' => $postID], $data);

        return 'true';
    }
    public function view_group_lists(Request $request)
    {
        $id = $_REQUEST['id'];

        $users = CustomerGroup::where('id', $id)->limit(1)
            ->first();

        return view('customer_grop.group_view_list', ['data' => $users]);

    }
    
    public function Grouptrashlist(Request $request)
    {
         $totalFiltered = 0;
        $totalData = CustomerGroup::count();
        $query = CustomerGroup::orderby('id', 'desc');
        $query->where('del_flag', 0);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('title', 'LIKE', "%{$search}%");
            $query->orWhere('description', 'LIKE', "%{$search}%");
            $query->orWhere('color', 'LIKE', "%{$search}%");

        }

        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('title', 'LIKE', "%{$search_3}%");
            $query->Where('description', 'LIKE', "%{$search_3}%");
            $query->Where('color', 'LIKE', "%{$search_3}%");
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
                        

                       

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text grouprestoredetails" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Restore</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $customer_detail->title;
            $row[3] = $customer_detail->description;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $customer_detail->color . '">&nbsp;&nbsp;</div>';

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

    public function grouplist(Request $request)
    {
         $totalFiltered = 0;
        $totalData = CustomerGroup::count();
        $query = CustomerGroup::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('title', 'LIKE', "%{$search}%");
            $query->orWhere('description', 'LIKE', "%{$search}%");
            $query->orWhere('color', 'LIKE', "%{$search}%");

        }

        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('title', 'LIKE', "%{$search_3}%");
            $query->Where('description', 'LIKE', "%{$search_3}%");
            $query->Where('color', 'LIKE', "%{$search_3}%");
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
                        <a href="view_group_lists?id=' . $customer_detail->id . '" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text" data-id="' . $customer_detail->id . '" >View</span>
                        </span></li></a>

                        <a href="#?id=' . $customer_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Groupupdate" data-id="' . $customer_detail->id . '" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_groupinformation" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $customer_detail->title;
            $row[3] = $customer_detail->description;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $customer_detail->color . '">&nbsp;&nbsp;</div>';

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

    public function custcategoryindex()

    {
        return view('category.customer_category_details');

    }
    public function custtypeindex()
    {
        return view('type.customer_type_details');

    }
    public function trashcategory()
    {
        return view('category.trashcategory');

    }
    public function typetrashs()
    {
        return view('type.typetrash');

    }

    public function trashtypeshow(Request $request)
    {

        $totalFiltered = 0;

        $totalData = CustomerTypeModel::count();

        $query = CustomerTypeModel::orderby('id', 'desc');

        if (!empty($request->input('search.value')))
        {

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
                        <span class="kt-nav__link-text kt_restore_typeinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Restore</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $user_detail->title;
            $row[3] = $user_detail->discription;
            $row[4] = $user_detail->color;

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

    public function trashcategoryshow(Request $request)
    {

        $totalFiltered = 0;

        $totalData = CustomerCategoryModel::count();

        $query = CustomerCategoryModel::orderby('id', 'desc');

        if (!empty($request->input('search.value')))
        {

            $search = $request->input('search.value');

            $query->where('id', 'LIKE', "%{$search}%");

            $query->orWhere('customer_category', 'LIKE', "%{$search}%");

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
                        <span class="kt-nav__link-text kt_restore_categoryinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Restore</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $user_detail->customer_category;
            $row[3] = $user_detail->description;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $user_detail->color . '">&nbsp;&nbsp;</div>';
            $row[5] = $user_detail->cust_code;
            $row[6] = $user_detail->start_form;

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

    public function customertrashrestore(Request $request)
    {
        $postID = $request->id;

        CustomerModel::where('id', $postID)->update(['del_flag' => 1]);

        return 'true';
    }
    public function trashrestore(Request $request)
    {
        $postID = $request->id;

        CustomerCategoryModel::where('id', $postID)->update(['del_flag' => 1]);

        return 'true';
    }

    public function add_custmer()
    {

        $areaList = CustomerCategoryModel::select('id', 'customer_category')->get();
        $category = CustomerCategoryModel::select('id', 'customer_category', 'cust_code', 'start_from')->get();
        // print_r($category);
        // exit();
        $areaLists = CustomerTypeModel::select('id', 'title')->get();

        return view('customer.customer_details_add', compact('areaList', 'areaLists'));

    }
    public function customertrashshow()
    {
        return view('customer.trash_details');

    }

    public function add_category()
    {
        return view('customer.customer_category_add');

    }

    public function type_updates(Request $request)
    {
        $data['users'] = CustomerTypeModel::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }

    public function typetrashrestore(Request $request)
    {
        $postID = $request->id;

        //echo $postID;
        CustomerTypeModel::where('id', $postID)->update(['del_flag' => 1]);

        return 'true';
    }
    public function categoryedit(Request $request)
    {
        $data['users'] = CustomerCategoryModel::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function edits($id)
    {
         // $selectedItems =[];

        $userInfo = CustomerModel::findOrFail($id);

// dd($userInfo);
        $areaLists = CustomerTypeModel::select('id', 'title')->get();
        $areaList = CustomerCategoryModel::select('id', 'customer_category')->get();

        // return view('customer.customer_details_add', compact('areaList', 'areaLists'));
        return view('customer.customer_details_add' ,compact('areaList', 'areaLists'))
            ->with('userInfo',$userInfo);
            // ->with('selectedItems',$selectedItems);
    }

    public function edit_customer(Request $request)
    {
        $id = $_REQUEST['id'];
        $areaList = CustomerCategoryModel::select('id', 'customer_category')->Where('del_flag', 1)
            ->get();
        $areaLists = CustomerTypeModel::select('id', 'title')->Where('del_flag', 1)
            ->get();
        // print_r($areaLists);
        // exit();
        $users = CustomerModel::where('id', $id)->limit(1)
            ->first();

        $details = customer::where('info_id', $id)->limit(1)
            ->first();
        return view('customer.customer_edit', ['data' => $users, 'datas' => $details], compact('areaList', 'areaLists'));
    }
    public function view_customer(Request $request)
    {
        $id = $_REQUEST['id'];

        $users = CustomerModel::where('id', $id)->limit(1)
            ->first();

        return view('customer.customer_view', ['data' => $users]);
    }
    public function view_category_list(Request $request)
    {
        $id = $_REQUEST['id'];

        $users = CustomerCategoryModel::where('id', $id)->limit(1)
            ->first();

        return view('category.category_view', ['datas' => $users]);
    }
    public function view_type_list(Request $request)
    {
        $id = $_REQUEST['id'];

        $users = CustomerTypeModel::where('id', $id)->limit(1)
            ->first();

        return view('type.typeview', ['datas' => $users]);
    }

    public function submit_user(Request $request)
    {
        $request->validate(['username'      => 'required',
                            'cust_code'     => 'required',
                            'cust_category' => 'required',

    ], [

        'username.required'      => 'username is required',
        'cust_code.required'     => 'Customer Code is required',
        'cust_category.required' => 'Customer Category is required'

    ]);
        $user = auth()->user();
        $postID = $request->info_id;
        $data = [
            'cust_code' => $request->cust_code, 'cust_type' => $request->cust_type, 'cust_category' => $request->cust_category, 'salesman' => $request->salesman, 'key_account' => $request->key_account, 'cust_note' => $request->cust_note,

        'cust_name' => $request->cust_name, 'cust_add1' => $request->cust_add1, 'cust_add2' => $request->cust_add2, 'cust_country' => $request->cust_country, 'cust_region' => $request->cust_region, 'cust_city' => $request->cust_city, 'cust_zip' => $request->cust_zip, 'email1' => $request->email1, 'email2' => $request->email2, 'office_phone1' => $request->office_phone1, 'office_phone2' => $request->office_phone2, 'mobile1' => $request->mobile1, 'mobile2' => $request->mobile2, 'fax' => $request->fax, 'website' => $request->website, 'contact_person' => $request->contact_person, 'contact_person_incharge' => $request->contact_person_incharge, 'mobile' => $request->mobile, 'office' => $request->office, 'contact_department' => $request->contact_department, 'email' => $request->email, 'location' => $request->location,

        'portal' => $request->portal, 'username' => $request->username, 'registerd_email' => $request->registerd_email, 'password' => encrypt($request->password) ,

        ];

        $userInfo = CustomerModel::updateOrCreate(['id' => $postID], $data);
        customer::where('info_id', $userInfo->id)
            ->delete();
        if (!empty($request->contact_person_incharges))
        {
            foreach ($request->contact_person_incharges as $key => $value)
            {

                customer::create([

                'info_id' => $userInfo->id, 'contact_person_incharges' => $request->contact_person_incharges[$key], 'contact_personvalue' => $request->contact_personvalue[$key], 'mobiles' => $request->mobiles[$key], 'offices' => $request->offices[$key], 'emails' => $request->emails[$key], 'departments' => $request->departments[$key], 'locations' => $request->locations[$key],

                ]);

            }
        }

        return 'true';
    }
    public function Categorys_submit(Request $request)
    {
        $request->validate([
            'customer_category' => 'required'], [

        'customer_category.required' => 'Code is required']);
        $user = auth()->user();
        $postID = $request->info_id;
        $data = [
             'cust_start'=>$request->cust_code.'/'.number_format($request->start_from+1),
            'customer_category' => $request->customer_category, 'description' => $request->description, 'color' => $request->color, 'cust_code' => $request->cust_code, 'start_from' => $request->start_from

        ];

        $userInfo = CustomerCategoryModel::updateOrCreate(['id' => $postID], $data);

        return 'true';
    }

    public function deletecategory(Request $request)
    {
        $postID = $request->id;
        CustomerCategoryModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }

    public function deletetypeds(Request $request)
    {
        $postID = $request->id;
        CustomerTypeModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }

    public function delete_customer(Request $request)
    {
        $postID = $request->id;
        CustomerModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }

    public function customersstrashshow(Request $request)
    {
        $totalFiltered = 0;

        $totalData = CustomerModel::count();

        $query = CustomerModel::orderby('id', 'desc');

        if (!empty($request->input('search.value')))
        {

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

        foreach ($users as $customer_detail)
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
                        <span class="kt-nav__link-text kt_restore_customerinformation" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Restore</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $customer_detail->cust_code;
            $row[3] = $customer_detail->cust_type;
            $row[4] = $customer_detail->cust_category;
            $row[5] = $customer_detail->salesman;
            $row[6] = $customer_detail->key_account;
            $row[7] = $customer_detail->cust_name;
            $row[8] = $customer_detail->cust_add1;
            $row[9] = $customer_detail->cust_add2;
            $row[10] = $customer_detail->cust_country;
            $row[11] = $customer_detail->cust_region;
            $row[12] = $customer_detail->cust_city;
            $row[13] = $customer_detail->cust_zip;
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
            $row[33] = $customer_detail->cust_note;

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

    public function customershow(Request $request)
    {
        $data = DB::table('customer_details')->leftjoin('qcrm_customer_categorydetails', 'qcrm_customer_categorydetails.customer_category', "=", "customer_details.cust_category")
            ->get()
            ->toArray();
        // echo"<pre>";
        // print_r($data);
        // exit();
        

        $totalFiltered = 0;
        $totalData = CustomerModel::count();
        $query = CustomerModel::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('cust_code', 'LIKE', "%{$search}%");
            $query->orWhere('cust_type', 'LIKE', "%{$search}%");
            $query->orWhere('cust_category', 'LIKE', "%{$search}%");
            $query->orWhere('salesman', 'LIKE', "%{$search}%");
            $query->orWhere('key_account', 'LIKE', "%{$search}%");
            $query->orWhere('cust_name', 'LIKE', "%{$search}%");
            $query->orWhere('cust_add1', 'LIKE', "%{$search}%");
            $query->orWhere('cust_add2', 'LIKE', "%{$search}%");
            $query->orWhere('cust_country', 'LIKE', "%{$search}%");
            $query->orWhere('cust_city', 'LIKE', "%{$search}%");
            $query->orWhere('cust_region', 'LIKE', "%{$search}%");
            $query->orWhere('cust_zip', 'LIKE', "%{$search}%");
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

        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
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
            $query->Where('cust_zip', 'LIKE', "%{$search_3}%");
            $query->Where('cust_city', 'LIKE', "%{$search_3}%");
            $query->Where('cust_region', 'LIKE', "%{$search_3}%");
            $query->Where('cust_country', 'LIKE', "%{$search_3}%");
            $query->Where('cust_add2', 'LIKE', "%{$search_3}%");
            $query->Where('cust_add1', 'LIKE', "%{$search_3}%");
            $query->Where('cust_name', 'LIKE', "%{$search_3}%");
            $query->Where('key_account', 'LIKE', "%{$search_3}%");
            $query->Where('salesman', 'LIKE', "%{$search_3}%");
            $query->Where('cust_category', 'LIKE', "%{$search_3}%");
            $query->Where('cust_type', 'LIKE', "%{$search_3}%");
            $query->Where('cust_code', 'LIKE', "%{$search_3}%");
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

                        <a href="view_customer?id=' . $customer_detail->id . '" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text" data-id="' . $customer_detail->id . '" >View</span>
                        </span></li></a>

                       
                        <a href="edit_customers/'.$customer_detail->id.'"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Customerdetail_update" data-id="'.$customer_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_customerinformation" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $customer_detail->cust_code;
            $row[3] = $customer_detail->cust_type;
            $row[4] = $customer_detail->cust_category;
            $row[5] = $customer_detail->salesman;
            $row[6] = $customer_detail->key_account;
            $row[7] = $customer_detail->cust_name;
            $row[8] = $customer_detail->cust_add1;
            $row[9] = $customer_detail->cust_add2;
            $row[10] = $customer_detail->cust_country;
            $row[11] = $customer_detail->cust_region;
            $row[12] = $customer_detail->cust_city;
            $row[13] = $customer_detail->cust_zip;
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
            $row[33] = $customer_detail->cust_note;
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

    public function customercategoryshow(Request $request)
    {
        $totalFiltered = 0;
        $totalData = CustomerCategoryModel::count();
        $query = CustomerCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('customer_category', 'LIKE', "%{$search}%");
            $query->orWhere('description', 'LIKE', "%{$search}%");

        }

        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('customer_category', 'LIKE', "%{$search_3}%");
            $query->Where('description', 'LIKE', "%{$search_3}%");

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
                        <a href="view_category?id=' . $customer_detail->id . '" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text" data-id="' . $customer_detail->id . '" >View</span>
                        </span></li></a>

                       <a href="#?id=' . $customer_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_4"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Category_update" data-id="' . $customer_detail->id . '" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_categoryinformation" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $customer_detail->customer_category;
            $row[3] = $customer_detail->description;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $customer_detail->color . '">&nbsp;&nbsp;</div>';
            $row[5] = $customer_detail->cust_code;
            $row[6] = $customer_detail->start_from;

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
    public function typeSubmit(Request $request)
    {
        $request->validate(['title' => 'required'], [

        'title.required' => 'title is required']);
        $user = auth()->user();
        $postID = $request->info_id;
        $data = ['title' => $request->title, 'discription' => $request->discription, 'color' => $request->color

        ];

        $userInfo = CustomerTypeModel::updateOrCreate(['id' => $postID], $data);

        return 'true';

    }
    public function customertypeshow(Request $request)
    {
        $totalFiltered = 0;
        $totalData = CustomerTypeModel::count();
        $query = CustomerTypeModel::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('title', 'LIKE', "%{$search}%");
            $query->orWhere('discription', 'LIKE', "%{$search}%");
            $query->orWhere('color', 'LIKE', "%{$search}%");

        }

        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('title', 'LIKE', "%{$search_3}%");
            $query->Where('discription', 'LIKE', "%{$search_3}%");
            $query->Where('color', 'LIKE', "%{$search_3}%");
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
                        <a href="view_type_lists?id=' . $customer_detail->id . '" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text" data-id="' . $customer_detail->id . '" >View</span>
                        </span></li></a>

                        <a href="#?id=' . $customer_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_4"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Type_update" data-id="' . $customer_detail->id . '" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_typeinformation" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $customer_detail->title;
            $row[3] = $customer_detail->discription;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $customer_detail->color . '">&nbsp;&nbsp;</div>';

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
    public function getSinglecustomerInfo(Request $request)
    {

        $data['users'] = CustomerModel::where('id', $request->info_id)
            ->limit(1)
            ->first();

        $data['addMore'] = customer::where('info_id', $request->info_id)
            ->get();

        echo json_encode($data);

    }

}


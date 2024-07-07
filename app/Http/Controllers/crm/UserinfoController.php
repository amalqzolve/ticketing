<?php
namespace App\Http\Controllers\crm;
use App\crm\Userinfo;
use App\crm\Skillmore;
use Illuminate\Http\Request;
use DB;
use Spatie\Activitylog\Models\Activity;
use PDF;
class UserinfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('crm.user.index');
    }
    public function userInfoSingle()
    {
        return view('crm.user.userInfoSingle');
    }
    public function userAdd()
    {
        return view('crm.user.userAdd');
    }
    public function userInfoTrash()
    {
        return view('crm.user.trash');
    }
    public function create()
    {
    }
    public function store(Request $request)
    {

        $request->validate([
        'cust_name' => 'required',
        'cust_email' => 'required'
        ], [
        'cust_name.required' => 'Name is required',
        'cust_email.required' => 'Password is required'
        ]);
        $user   = auth()->user();
        $postID = $request->cust_id;
        $data = ['cust_type' => $request->cust_type, 'cust_name' => $request->cust_name, 'cust_add1' => $request->cust_add1, 'cust_add2' => $request->cust_add2, 'cust_country' => $request->cust_country, 'cust_city' => $request->cust_city, 'cust_region' => $request->cust_region, 'cust_zip' => $request->cust_zip, 'cust_email' => $request->cust_email, 'cust_officephone' => $request->cust_officephone, 'cust_mobile' => $request->cust_mobile, 'cust_fax' => $request->cust_fax, 'cust_website' => $request->cust_website, 'uniqueid' => $request->UniqueID, 'file_data' => $request->file_data, 'cust_users' => isset($request->cust_users) ? $request->cust_users : '', ];
        $userInfo = Userinfo::updateOrCreate(['id' => $postID], $data);
        Skillmore::where('info_id', $userInfo->id)
            ->delete();
        return 'true';
    }
    public function userShow($id)
    {
        $selectedItems = [];
        $userInfo = Userinfo::findOrFail($id);
        return view('crm.user.userShow')->with('userInfo', $userInfo)->with('selectedItems', $selectedItems);
    }
    public function edit($id)
    {
        $selectedItems = [];
        $userInfo = Userinfo::findOrFail($id);
        return view('crm.user.userAdd')->with('userInfo', $userInfo)->with('selectedItems', $selectedItems);
    }
    public function selectOptions($table, $id)
    {
        $users = DB::table($table)->where('id', $id)->value('cust_users');
        $userList = explode(',', $users);
        foreach ($userList as $row)
        {
            $user = DB::table($table)->where('id', $row)->select('id', 'cust_name')
                        ->first();
            $data[$row]['id'] = $user->id;
            $data[$row]['cust_name'] = $user->cust_name;
        }
        return $data;
    }
    public function update(Request $request, User $user)
    {
    }
    public function deleteUserInfo(Request $request)
    {
        $postID = $request->id;
        Userinfo::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function userTrashRestore(Request $request)
    {
        $postID = $request->id;
        Userinfo::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function userList(Request $request)
    {
        $totalFiltered = 0;
        $totalData = Userinfo::count();
        $query = Userinfo::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
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
                        <a href="userShow/' . $user_detail->id . '"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text " data-id="' . $user_detail->id . '">View</span>
                        </span></li></a>
                        <a href="#?id=' . $user_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_2"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Customerdetail_update" data-id="' . $user_detail->id . '" >Edit</span>
                        </span></li></a>
                        <a href="editSingleUser/' . $user_detail->id . '"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Customerdetail_update" data-id="' . $user_detail->id . '" >Edit single</span>
                        </span></li></a>
                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_usersinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Delete</span></span></li>
                       </ul></div></div></span>';
            $row[2] = $user_detail->cust_type;
            $row[3] = $user_detail->cust_name;
            $row[4] = $user_detail->cust_add1;
            $row[5] = $user_detail->cust_add2;
            $row[6] = $user_detail->cust_country;
            $row[7] = $user_detail->cust_city;
            $row[8] = $user_detail->cust_region;
            $row[9] = $user_detail->cust_zip;
            $row[10] = $user_detail->cust_email;
            $row[11] = $user_detail->cust_officephone;
            $row[12] = $user_detail->cust_mobile;
            $row[13] = $user_detail->cust_fax;
            $row[14] = $user_detail->cust_website;
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
    public function userListDropDown(Request $request)
    {
        $totalFiltered = 0;
        $totalData = Userinfo::count();
        $query = Userinfo::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('q')))
        {
            $search = $request->input('q');
            $query->Where('cust_name', 'LIKE', "%{$search}%");
        }
        $totalFiltered = $query->count();
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        if ($page == 1)
        {
            $query->take(30);
        }
        else
        {
            $query->skip($page * 30)->take(30);
        }
        $users = $query->get();
        $data = array();
        $no = $page;
        $i = 0;
        $row = array();
        foreach ($users as $user_detail)
        {
            $no++;
            $image = explode(",", $user_detail->file_data);
            $row['id'] = $user_detail->id;
            $row['full_name'] = $user_detail->cust_name;
            $row['description'] = $user_detail->cust_type;
            $row['forks_count'] = $user_detail->cust_name;
            $row['stargazers_count'] = $user_detail->cust_add1;
            $row['watchers_count'] = $user_detail->cust_add2;
            $row['url'] = $image[0];
            $data[$i] = $row;
            $i++;
        }
        $output = array(
            "total_count" => $totalData,
            "incomplete_results" => 'false',
            "items" => $data,
        );
        echo json_encode($output);
    }
    public function getSingleUserInfo(Request $request)
    {
        $data['users'] = Userinfo::where('id', $request->user_id)
                            ->limit(1)
                            ->first();
        $data['addMore'] = Skillmore::where('info_id', $request->user_id)
                            ->get();
        echo json_encode($data);
    }
    public function profilePdfDownload($id)
    {
        $data = [];
        $pdfName = 'UserInfo-' . date('Y-M-d-H-i') . '.pdf';
        $pdf = PDF::loadView('pdf/invoice/invoice', $data);
        return $pdf->download($pdfName);
    }
    public function userListTrash(Request $request)
    {
        $totalFiltered = 0;
        $totalData = Userinfo::count();
        $query = Userinfo::orderby('id', 'desc');
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
                        <span class="kt-nav__link-text kt_restore_usersinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Restore</span></span></li>
                       </ul></div></div></span>';
            $row[2]  = $user_detail->cust_type;
            $row[3]  = $user_detail->cust_name;
            $row[4]  = $user_detail->cust_add1;
            $row[5]  = $user_detail->cust_add2;
            $row[6]  = $user_detail->cust_country;
            $row[7]  = $user_detail->cust_city;
            $row[8]  = $user_detail->cust_region;
            $row[9]  = $user_detail->cust_zip;
            $row[10] = $user_detail->cust_email;
            $row[11] = $user_detail->cust_officephone;
            $row[12] = $user_detail->cust_mobile;
            $row[13] = $user_detail->cust_fax;
            $row[14] = $user_detail->cust_website;
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
}


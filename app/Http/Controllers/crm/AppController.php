<?php
namespace App\Http\Controllers\crm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\crm\Skillmore;
use App\crm\AppList;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
class AppController extends Controller
{
    public function index(Request $request)
    {
        $data = AppList::orderBy('id', 'DESC')->paginate(5);
        return view('crm.appList.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function store(Request $request)
    {
        $request->validate([
        'app_name' => 'required',
        'url' => 'required'
        ], [
        'app_name.required' => 'Name is required',
        'url.required' => 'Url is required'
        ]);
        $user = auth()->user();
        $postID = $request->id;
        $data = ['id' => $request->id, 'app_name' => $request->app_name, 'app_desc' => $request->app_desc, 'url' => $request->url, 'email' => $request->email, 'status' => $request->status, 'uniqueid' => $request->UniqueID, 'file_data' => $request->file_data,
        ];
        $app = AppList::updateOrCreate(['id' => $postID], $data);
        Skillmore::where('id', $app->id)
            ->delete();
        if (!empty($request->skill))
        {
            foreach ($request->skill as $key => $value)
            {
                Skillmore::create([
                'id' => $app->id, 'skill' => $request->skill[$key], 'value' => $request->skillValue[$key], ]);
            }
        }
        return 'true';
    }
    public function appList(Request $request)
    {
        $totalFiltered = 0;
        $totalData = AppList::count();
        $query = AppList::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('app_name', 'LIKE', "%{$search}%");
        }
        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('app_name', 'LIKE', "%{$search_3}%");
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

                        <a href="show/' . $user_detail->id . '"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text " data-id="' . $user_detail->id . '">View</span>
                        </span></li></a>

                        <a href="#?id=' . $user_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_2"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text singleApp_update" data-id="' . $user_detail->id . '" >Edit</span>
                        </span></li></a>

                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_appinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $user_detail->app_name;
            $row[3] = $user_detail->app_desc;
            $row[4] = $user_detail->url;
            $row[5] = $user_detail->status;
            $row[7] = $user_detail->uniqueid;

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
        $app = AppList::find($id);
        return view('crm.appList.show', compact('app'));
    }

    public function getSingleAppInfo(Request $request)
    {
        $data['apps'] = AppList::where('id', $request->user_id)
            ->limit(1)
            ->first();
        $data['addMore'] = Skillmore::where('info_id', $request->user_id)
            ->get();
        echo json_encode($data);
    }
    public function deleteAppInfo(Request $request)
    {
        $postID = $request->id;
        AppList::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function appInfoTrash()
    {
        return view('crm.applist.trash');
    }
    public function appListTrash(Request $request)
    {
        $totalFiltered = 0;
        $totalData = AppList::count();
        $query = AppList::orderby('id', 'desc');
        $query->where('del_flag', 0);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('app_name', 'LIKE', "%{$search}%");
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

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_restore_appinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Restore</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $user_detail->app_name;
            $row[3] = $user_detail->app_desc;
            $row[4] = $user_detail->url;
            $row[5] = $user_detail->status;
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
    public function appTrashRestore(Request $request)
    {
        $postID = $request->id;
        AppList::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
}


<?php

namespace App\Http\Controllers\crm;

use App\crm\salesmanroute_settingModel;
use DB;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use Spstie\Activitylog\Models\Activity;
use \PDF;
use DataTables;
use Session;
use App\settings\BranchSettingsModel;

class Salesmanroutesettings extends Controller
{
    public function salesmanrout_settings(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query = salesmanroute_settingModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch', $branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = salesmanroute_settingModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.salesman_routsettings.salesmanroute', compact('branch'));
    }
    public function salesmanroute_index(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query = salesmanroute_settingModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch', $branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = salesmanroute_settingModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.salesman_routsettings.salemanroutetrash');
    }
    public function create()
    {
    }
    //salesman route pdf

    public function salesman_routepdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');

        $route = DB::table('qcrm_salemanroute')->select('id', 'routename', 'startpalce', 'endplace', 'totalkm', 'branch')->where('del_flag', 1)->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

        $pdf = PDF::loadView('crm.salesman_routsettings.pdf', compact('route', 'branchsettings'));

        return $pdf->stream('document.pdf');
    }

    public function salesmanroutesettingList(Request $request)
    {
        $totalFiltered   = 0;
        $totalData       = salesmanroute_settingModel::count();
        $query           = salesmanroute_settingModel::orderby('id', 'desc');
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
            $row[1] = $user_detail->routename;
            $row[2] = $user_detail->startpalce;
            $row[3] = $user_detail->endplace;
            $row[4] = $user_detail->totalkm;
            $row[5] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text salesmanroutrestore" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>' . trans('app.Restore') . '</span></span><
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
    public function salesmanrouteTrashRestore(Request $request)
    {
        $postID = $request->id;
        salesmanroute_settingModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function salesmanroutestore(Request $request)
    {
        $totalFiltered = 0;
        $totalData = salesmanroute_settingModel::count();
        $query = salesmanroute_settingModel::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('routename', 'LIKE', "%{$search}%");
            $query->orWhere('startpalce', 'LIKE', "%{$search}%");
            $query->orWhere('endplace', 'LIKE', "%{$search}%");
            $query->orWhere('totalkm', 'LIKE', "%{$search}%");
        }
        if (isset($_GET['columns'][3]['search']['value']) && $_GET['columns'][3]['search']['value'] != '') {
            $search_3 = $_GET['columns'][3]['search']['value'];
            $query->Where('totalkm', 'LIKE', "%{$search_3}%");
            $query->Where('endplace', 'LIKE', "%{$search_3}%");
            $query->Where('startpalce', 'LIKE', "%{$search_3}%");
            $query->Where('routename', 'LIKE', "%{$search_3}%");
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
            $row[1] = $user_detail->routename;
            $row[2] = $user_detail->startpalce;
            $row[3] = $user_detail->endplace;
            $row[4] = $user_detail->totalkm;
            $row[5] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        <a href="#?id=' . $user_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_11"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text salesmanroutedetail_update" data-id="' . $user_detail->id . '" >' . trans('app.Edit') . '</span>
                        </span></li></a>
                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_salesmanrouteinformation" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>' . trans('app.Delete') . '</span></span></li>
                        </ul></div></div></span>';
            $data[$i] = $row;
            $i++;
        }
        $output = array(
            "draw"            => $_GET['draw'],
            "recordsTotal"    => $totalData,
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
        $user     = User::find($id);
        $roles    =  Role::pluck('routename', 'routename')->all();
        $userRole = $user
            ->roles
            ->pluck('routename', 'routename')
            ->all();
        return view('crm.users.edit', compact('user', 'roles', 'userRole'));
    }
    public function salesmansubmitgroup(Request $request)
    {
        $branch = $request->branch;
        $request->validate(['routename' => 'required',], ['routename.required' => 'routename is required',]);
        $user = auth()->user();
        $postID = $request->cust_id;
        if (isset($postID) && !empty($postID)) {
            $check = $this->check_exists_edit($postID, $request->routename, 'routename', 'qcrm_salemanroute');
        } else {
            $check = $this->check_exists($request->routename, 'routename', 'qcrm_salemanroute');
        }
        if ($check < 1) {
            $data = [
                'routename' => $request->routename, 'startpalce' => $request->startpalce, 'endplace' => $request->endplace, 'totalkm' => $request->totalkm, 'branch' => $branch
            ];
            $userInfo = salesmanroute_settingModel::updateOrCreate(['id' => $postID], $data);
            return 'true';
        } else {
            return 'false';
        }
    }
    public function getsalesmanroutesettings(Request $request)
    {
        $data['users'] = salesmanroute_settingModel::where('id', $request->cust_id)
            ->limit(1)
            ->first();
        $data['addMore'] = Skillmore::where('info_id', $request->cust_id)
            ->get();
        echo json_encode($data);
    }
    public function deletesalesmanrouteInfo(Request $request)
    {
        $postID = $request->id;
        salesmanroute_settingModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    public function check_exists($value, $field, $table)
    {
        $branch = Session::get('branch');

        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->where('branch', $branch)->get();
        // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
        return $query->count();
    }
    public function check_exists_edit($id, $value, $field, $table)
    {
        $query = DB::table($table)->select($field)->where($field, $value)->where('del_flag', 1)->whereNotIn('id', [$id])->get();

        return $query->count();
    }
}

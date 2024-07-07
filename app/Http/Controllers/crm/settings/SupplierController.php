<?php

namespace App\Http\Controllers\crm\settings;

use App\Http\Controllers\Controller;
use App\settings\SuppliergroupModel;
use App\settings\SupplierCategory;
use App\settings\Suppliertype;
use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spstie\Activitylog\Models\Activity;
use \PDF;
use DataTables;
use Session;

class SupplierController extends Controller
{
    public function supplier_grup(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query = SuppliergroupModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch', $branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = SuppliergroupModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.settings.supplier_group.suppliergroup', compact('branch'));
    }
    public function suppliergroupindex(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query = SuppliergroupModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch', $branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = SuppliergroupModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }

        return view('crm.settings.supplier_group.suppliergrouptrash');
    }
    public function submitgroup(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->info_id;
        // $check = $this->check_exists($request->title,'title','qcrm_suppliergroup');
        if (isset($postID) && !empty($postID)) {
            $check = $this->check_exists_edit($postID, $request->title, 'title', 'qcrm_suppliergroup');
        } else {
            $check = $this->check_exists($request->title, 'title', 'qcrm_suppliergroup');
        }
        if ($check < 1) {
            $data   = [
                'title' => $request->title, 'description' => $request->description,
                'color' => $request->color, 'branch' => $branch
            ];
            $userInfo = SuppliergroupModel::updateOrCreate(['id' => $postID], $data);
            return 'true';
        } else {
            return 'false';
        }
    }
    public function getsuppliergrup(Request $request)
    {
        $data['users']   = SuppliergroupModel::where('id', $request->cust_id)
            ->limit(1)
            ->first();

        echo json_encode($data);
    }

    public function deletesuppliergrupInfo(Request $request)
    {
        $postID = $request->id;
        $query = DB::table('qcrm_supplier')->select('sup_note')->where('sup_note', $postID)->where('del_flag', 1)->get();
        $no = $query->count();
        if ($no > 0) {
            return '1';
        } else {
            SuppliergroupModel::where('id', $postID)->update(['del_flag' => 0]);
            return '0';
        }
    }

    public function suppliergrupTrashRestore(Request $request)
    {
        $postID = $request->id;
        SuppliergroupModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }

    public function category_list(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query = SupplierCategory::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch', $branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = SupplierCategory::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.settings.supplier_category.suppliercategory', compact('branch'));
    }
    public function suplircatgry_trash(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query = SupplierCategory::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch', $branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = SupplierCategory::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.settings.supplier_category.suppliercatgrytrash');
    }

    public function Submit(Request $request)
    {
        $branch = Session::get('branch');
        $postID = $request->info_id;
        if (isset($postID) && !empty($postID)) {
            $check = $this->check_exists_edit($postID, $request->title, 'title', 'qcrm_suppliercatogry');
        } else {
            $check = $this->check_exists($request->title, 'title', 'qcrm_suppliercatogry');
        }
        if ($check < 1) {
            $data   = ['cust_start' => $request->customcode . '/' . number_format($request->startfrom + 1), 'title' => $request->title, 'discription' => $request->discription, 'color' => $request->color, 'customcode' => $request->customcode, 'startfrom' => $request->startfrom, 'increment' => $request->startfrom, 'branch' => $branch];
            $userInfo = SupplierCategory::updateOrCreate(['id' => $postID], $data);
            return 'true';
        } else {
            return 'false';
        }
        /* $check = $this->check_exists($request->title,'title','qcrm_suppliercatogry');
        if($check<1)
        {
        $data   = ['cust_start' => $request->customcode . '/' . number_format($request->startfrom + 1) , 'title' => $request->title, 'discription' => $request->discription, 'color' => $request->color, 'customcode' => $request->customcode, 'startfrom' => $request->startfrom,'increment' => $request->startfrom,'branch' => $branch];
        $userInfo = SupplierCategory::updateOrCreate(['id' => $postID], $data);
        return 'true';
        }
        else
        {
        return 'false';
        }*/
    }
    public function getsuppliercatgry(Request $request)
    {

        $data['users'] = SupplierCategory::where('id', $request->cust_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }

    public function deletesuppliercatgryInfo(Request $request)
    {
        $postID = $request->id;
        $query = DB::table('qcrm_supplier')->select('sup_category')->where('sup_category', $postID)->where('del_flag', 1)->get();
        $no = $query->count();
        if ($no > 0) {
            return '1';
        } else {
            SupplierCategory::where('id', $postID)->update(['del_flag' => 0]);
            return '0';
        }
    }
    public function sup_cat_TrashRestore(Request $request)
    {
        $postID = $request->id;
        SupplierCategory::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }

    public function suplir_type(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query = Suppliertype::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch', $branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = Suppliertype::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }

        return view('crm.settings.supplier_type.suppliertype', compact('branch'));
    }
    public function suplir_trash(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query = suppliertype::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch', $branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = suppliertype::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.settings.supplier_type.suppliertypetrash');
    }
    public function typeSubmit(Request $request)
    {
        $branch = Session::get('branch');
        $postID = $request->info_id;
        if (isset($postID) && !empty($postID)) {
            $check = $this->check_exists_edit($postID, $request->title, 'title', 'qcrm_supplier_type');
        } else {
            $check = $this->check_exists($request->title, 'title', 'qcrm_supplier_type');
        }
        if ($check < 1) {
            $data   = [
                'title' => $request->title, 'discription' => $request->discription, 'color' => $request->color, 'branch' => $branch
            ];
            $userInfo = suppliertype::updateOrCreate(['id' => $postID], $data);

            return 'true';
        } else {
            return 'false';
        }
        /*  $check = $this->check_exists($request->title,'title','qcrm_supplier_type');
        if($check<1)
        {
        $data   = [
        'title' => $request->title, 'discription' => $request->discription, 'color' => $request->color,'branch' =>$branch];
        $userInfo = suppliertype::updateOrCreate(['id' => $postID], $data);
        return 'true';
        }
        else
        {
            return 'false';
        }*/
    }

    public function getsuppliertype(Request $request)
    {

        $data['users']   = suppliertype::where('id', $request->cust_id)
            ->limit(1)
            ->first();

        echo json_encode($data);
    }

    public function deletesuppliertypeInfo(Request $request)
    {
        $postID = $request->id;
        $query = DB::table('qcrm_supplier')->select('sup_type')->where('sup_type', $postID)->where('del_flag', 1)->get();
        $no = $query->count();
        if ($no > 0) {
            return '1';
        } else {
            suppliertype::where('id', $postID)->update(['del_flag' => 0]);
            return '0';
        }
    }
    public function typetrashrestores(Request $request)
    {
        $postID = $request->id;
        suppliertype::where('id', $postID)->update(['del_flag' => 1]);
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

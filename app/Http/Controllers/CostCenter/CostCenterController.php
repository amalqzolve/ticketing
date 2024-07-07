<?php

namespace App\Http\Controllers\CostCenter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tender\TenderModel;
use App\crm\DepartmentModel;
use App\CostCenter\CostrCenter;
use Carbon\Carbon;
use DataTables;
use Auth;
use Session;
use Validator;
use DB;
use Illuminate\Validation\Rule;

class CostCenterController extends Controller
{
    public function list(Request $request)
    {
        $user = Auth::user();
        if (!$request->ajax()) {
            $branch = Session::get('branch');
            $department = DepartmentModel::select('id', 'name')->where('branch', $branch)->get();
            return view('cost-center.costCenter.list', compact('department'));
        } else {
            $data = CostrCenter::select('cost_centers.id', 'cost_centers.name', 'cost_centers.code', 'cost_centers.category_code', 'qcrm_department.name as department', 'cost_centers.description', 'cost_centers.business_area', 'cost_centers.functional_area', 'cost_centers.amount', 'cost_centers.responsible_person')
                ->leftjoin('qcrm_department', 'cost_centers.department', 'qcrm_department.id')
                ->whereNull('cost_centers.parent_id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {

                $hasPermission = $user->can('Cost Center edit');
                if ($hasPermission) {
                    $j = '<li class="kt-nav__item edit_btn" data-id="' . $row->id . '">
                        <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-edit"></i>
                            <span class="kt-nav__link-text " data-id="' . $row->id . '">Edit</span>
                        </span>
                    </li>';
                    return '<span style="overflow: visible; position: relative; width: 80px;">
                           <div class="dropdown">
                                <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                <i class="fa fa-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">' . $j . '</ul>
                                </div>
                          </div>
                       </span>';
                } else
                    return '--';
            });
            return $dtTble->make(true);
        }
    }


    public function listChilden(Request $request, $id = 0)
    {
        $user = Auth::user();
        $parent = $id;
        if ($request->ajax()) {
            $data = CostrCenter::select('cost_centers.id', 'cost_centers.name', 'cost_centers.code', 'cost_centers.category_code', 'qcrm_department.name as department', 'cost_centers.description', 'cost_centers.business_area', 'cost_centers.functional_area', 'cost_centers.responsible_person', 'cost_centers.is_parent', 'cost_centers.amount')
                ->leftjoin('qcrm_department', 'cost_centers.department',  'qcrm_department.id')
                ->where('parent_id', $parent)
                ->orderBy('id', 'ASC')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $hasPermission = $user->can('Cost Center edit');
                if ($hasPermission) {
                    $j = '<li class="kt-nav__item edit_btn" data-id="' . $row->id . '">
                        <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-edit"></i>
                            <span class="kt-nav__link-text " data-id="' . $row->id . '">Edit</span>
                        </span>
                    </li>';
                    return '<span style="overflow: visible; position: relative; width: 80px;">
                           <div class="dropdown">
                                <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                <i class="fa fa-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">' . $j . '</ul>
                                </div>
                          </div>
                       </span>';
                } else
                    return '--';
            });
            return $dtTble->make(true);
        } else {
            if ($parent != 0) {
                $branch = Session::get('branch');
                $boq = CostrCenter::where('id', $parent)->first(); //->value('parent_id');
                $assent_id = $boq->parent_id;
                $parent_name = $boq->name;
                $department = DepartmentModel::select('id', 'name')->where('branch', $branch)->get();
                return view('cost-center.costCenter.listChild', compact('assent_id', 'parent_name', 'parent', 'boq', 'department'));
            } else {
                return redirect()->route('Cost Center List', null);
            }
        }
    }



    public function save(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'code' => ['required', 'string', 'max:50',  Rule::unique('cost_centers')->ignore($request->id)],
                'department' => ['required'],
                'description' => ['nullable', 'max:500'],
                'business_area' => ['nullable', 'max:255'],
                'functional_area' => ['nullable', 'max:255'],
                'responsible_person' => ['nullable', 'max:255'],
            ]);

            if ($validator->fails()) {
                $out = array(
                    "status" => 2,
                    "msg" => 'Validation Error.',
                    "error" => $validator->errors()
                );
                echo json_encode($out);
                die();
            } else {
                try {
                    DB::transaction(function () use ($request) {
                        $postID = $request->id;
                        $data = array(
                            'name' => $request->name,
                            'code' => $request->code,
                            'department' => $request->department,
                            'description' => $request->description,
                            'business_area' => $request->business_area,
                            'functional_area' => $request->functional_area,
                            'responsible_person' => $request->responsible_person
                        );
                        $node = CostrCenter::updateOrCreate(['id' => $postID], $data);
                        CostrCenter::where('id', $node->id)->update(['category_code' => $node->id]);
                        $out = array(
                            'status' => 1,
                            'msg' => 'Success'
                        );
                        echo json_encode($out);
                    });
                } catch (\Throwable $e) {
                    $out = array(
                        'error' => $e,
                        'status' => 0,
                        'msg' => 'Error While Save'
                    );
                    echo json_encode($out);
                }
            }
        }
    }


    public function saveGroup(Request $request)
    {
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'code' => ['required', 'string', 'max:50', Rule::unique('cost_centers')->ignore($request->id)],
                'description' => ['nullable', 'max:500'],
            ]);

            if ($validator->fails()) {
                $out = array(
                    "status" => 2,
                    "msg" => 'Validation Error.',
                    "error" => $validator->errors()
                );
                echo json_encode($out);
                die();
            } else {
                try {
                    DB::transaction(function () use ($request) {
                        $postID = $request->id;
                        $data = array(
                            'name' => $request->name,
                            'code' => $request->code,
                            'description' => $request->description,
                            'is_parent' => 1
                        );
                        $parent_child = $request->parent_id;
                        $node = CostrCenter::updateOrCreate(['id' => $postID], $data);
                        $parent = CostrCenter::findOrFail($parent_child);
                        $node->appendToNode($parent)->save();
                        $out = array(
                            'status' => 1,
                            'msg' => 'Success'
                        );
                        echo json_encode($out);
                    });
                } catch (\Throwable $e) {
                    $out = array(
                        'error' => $e,
                        'status' => 0,
                        'msg' => 'Error While Save'
                    );
                    echo json_encode($out);
                }
            }
        }
    }

    public function saveElement(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'nameElement' => ['required', 'string', 'max:255'],
                'code' => ['required', 'string', 'max:50', Rule::unique('cost_centers')->ignore($request->idElement)],
                'descriptionElement' => ['nullable', 'max:500'],
            ]);

            if ($validator->fails()) {
                $out = array(
                    "status" => 2,
                    "msg" => 'Validation Error.',
                    "error" => $validator->errors()
                );
                echo json_encode($out);
                die();
            } else {
                try {
                    DB::transaction(function () use ($request) {
                        $postID = $request->idElement;
                        $data = array(
                            'name' => $request->nameElement,
                            'code' => $request->codeElement,
                            'description' => $request->descriptionElement,
                            'is_parent' => 0
                        );
                        $parent_child = $request->parent_idElement;
                        $node = CostrCenter::updateOrCreate(['id' => $postID], $data);
                        $parent = CostrCenter::findOrFail($parent_child);
                        $node->appendToNode($parent)->save();
                        $out = array(
                            'status' => 1,
                            'msg' => 'Success'
                        );
                        echo json_encode($out);
                    });
                } catch (\Throwable $e) {
                    $out = array(
                        'error' => $e,
                        'status' => 0,
                        'msg' => 'Error While Save'
                    );
                    echo json_encode($out);
                }
            }
        }
    }



    public function getCostrCenterFromId(Request $request, $id)
    {
        if ($request->ajax()) {
            $costrCenter = CostrCenter::where('id', $id)->first();
            $out = array(
                'status' => 1,
                'msg' => 'success',
                'data' => $costrCenter
            );
            echo json_encode($out);
        }
    }
}

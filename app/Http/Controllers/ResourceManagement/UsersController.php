<?php

namespace App\Http\Controllers\ResourceManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Session;
use App\settings\DepartmentModel;
use Carbon\Carbon;
use Auth;
use App\ResourceManagement\EmployeesModel;

class UsersController extends Controller
{
    /**
     *Department Listing Function
     */
    public function rmusers(Request $request)
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $query = EmployeesModel::select('employees.category', 'employees.employee_name_field', 'qcrm_department.name',  'employees.employeeid', 'employees.id','jobtitle')
                ->leftjoin('qcrm_department', 'employees.department',  'qcrm_department.id');
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return view('resourcemanagement.users.index', compact('branch'));
    }
    public function rmnewusers(Request $request)
    {
        $branch = Session::get('branch');
        $department = DepartmentModel::select('id', 'name')->where('del_flag', 1)->get();
        return view('resourcemanagement.users.newusers', compact('branch', 'department'));
    }
    public function rmexistingusers(Request $request)
    {
        $branch = Session::get('branch');
        $department = DepartmentModel::select('id', 'name')->where('del_flag', 1)->get();
        $employee = DB::table('qzolvehrm_employee')->select('id', 'f_name', 'l_name')->where('del_flag', 1)->get();
        return view('resourcemanagement.users.existingusers', compact('branch', 'department', 'employee'));
    }

    public function saveUsers(Request $request)
    {
    }

    public function getHrUserFromId(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $data = DB::table('qzolvehrm_employee')->select('id', 'f_name', 'l_name', 'department_id', 'employee_code', 'phno_1', 'phno_2', 'national_id', 'iqma_num', 'iqma_remdate', 'iqma_expiry', 'passport_num', 'passport_expdate', 'passport_validity', 'country')->where('id', $id)->first();
            $out = array(
                'status' => 1,
                'data' => $data
            );
            echo json_encode($out);
        } else
            return Null;
    }

    public function saveEmployees(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $createdBy = Auth::user()->id;
                    $inArray = array();
                    foreach ($request->employee_name_field as $key => $value) {
                        $inSubArray =   array(
                            'category' => $request->category[$key],
                            'employeename' => $request->employeename[$key],
                            'employee_name_field' => $request->employee_name_field[$key],
                            'department' => $request->department[$key],
                            'jobtitle' => $request->jobtitle[$key],
                            'employeeid' => $request->employeeid[$key],
                            'contractno' => $request->contractno[$key],
                            'nationality' => $request->nationality[$key],
                            'nationalid' => $request->nationalid[$key],
                            'nationalidexp' => isset($request->nationalidexp[$key]) ? Carbon::parse($request->nationalidexp[$key])->format('Y-m-d') : NULL,
                            'passportno' => $request->passportno[$key],
                            'passportnoexp' => isset($request->passportnoexp[$key]) ? Carbon::parse($request->passportnoexp[$key])->format('Y-m-d') : NULL,
                            'overhead' => $request->overhead[$key],
                            'created_by' => $createdBy,
                            'created_at' => Carbon::now(),
                        );
                        array_push($inArray, $inSubArray);
                    }
                    EmployeesModel::insert($inArray);
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'success'
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => 'Error While Save'
                );
                echo json_encode($out);
            }
        } else
            return Null;
    }
}

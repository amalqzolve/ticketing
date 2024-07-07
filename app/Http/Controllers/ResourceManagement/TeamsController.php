<?php

namespace App\Http\Controllers\ResourceManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DataTables;
use App\ResourceManagement\ProjectTeamEmployeesModel;
use App\ResourceManagement\ProjectTeamModel;
use Carbon\Carbon;
use DB;
use Auth;


class TeamsController extends Controller
{
    public function teamsList(Request $request)
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $query = ProjectTeamModel::select('project_team.*');
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return view('resourcemanagement.teams.list');
    }

    public function add(Request $request)
    {
        if ($request->ajax()) {
            return Null;
        } else
            return view('resourcemanagement.teams.add');
    }

    public function save(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $branch = Session::get('branch');
                    $createdBy = Auth::user()->id;
                    $editId = $request->id;
                    $datArray = array(
                        'name' => $request->name,
                        'decription' => $request->decription,
                        'branch' => $branch,
                        'created_by' => $createdBy
                    );
                    $team = ProjectTeamModel::updateOrCreate(['id' => $editId], $datArray);
                    ProjectTeamEmployeesModel::where('project_team_id', $editId)->delete();
                    $inArray = array();
                    foreach ($request->employee_id as $key => $value) {
                        $inSubArray =   array(
                            'project_team_id' => $team->id,
                            'member_id' => $value,
                            'created_at' => Carbon::now(),
                        );
                        array_push($inArray, $inSubArray);
                    }
                    ProjectTeamEmployeesModel::insert($inArray);
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
            return null;
    }
    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            $team = ProjectTeamModel::where('id', $id)->first();
            $members = ProjectTeamEmployeesModel::select('employees.id', 'employees.category', 'employees.employee_name_field', 'qcrm_department.name',  'employees.employeeid', 'employees.id', 'jobtitle')
                ->leftjoin('employees', 'project_team_members.member_id',  'employees.id')
                ->leftjoin('qcrm_department', 'employees.department',  'qcrm_department.id')
                ->where('project_team_members.project_team_id', $id)
                ->get();
            return view('resourcemanagement.teams.edit', compact('team', 'members'));
        } else
            return Null;
    }
}

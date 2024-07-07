<?php

namespace App\Http\Controllers\ResourceManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Session;
use App\ResourceManagement\ProjectTeamEmployeesModel;
use App\projects\ProjectModel;
use App\ResourceManagement\ProjectMembersModel;
use App\User;
use Carbon\Carbon;
use Auth;

class ManagementController extends Controller
{
    /**
     *Department Listing Function
     */
    public function resmanagement(Request $request)
    {
        $branch = Session::get('branch');
        if ($request->ajax()) {
            $query = ProjectModel::select('qprojects_projects.*', 'qcrm_customer_details.cust_name', DB::raw("DATE_FORMAT(qprojects_projects.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(qprojects_projects.enddate, '%d-%m-%Y') as enddate"), DB::raw("DATE_FORMAT(qprojects_projects.podate, '%d-%m-%Y') as podate"), 'users.name as lead_name')
                ->leftjoin('qcrm_customer_details', 'qprojects_projects.client', 'qcrm_customer_details.id')
                ->leftjoin('users', 'qprojects_projects.project_leader', 'users.id')
                ->orderby('qprojects_projects.id', 'desc')
                ->where('qprojects_projects.del_flag', 1)
                ->where('qprojects_projects.branch', $branch)
                ->where('qprojects_projects.status',  6)
                ->where('qprojects_projects.resources_alc_flg', 1);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        } else
            return view('resourcemanagement.management.index', compact('branch'));
    }
    public function rmnewmanagement(Request $request)
    {
        $branch = Session::get('branch');
        $projects = ProjectModel::select('id', 'projectname')->where('del_flag', 1)->where('resources_alc_flg', 0)->get();
        $users = User::all();
        return view('resourcemanagement.management.add', compact('branch', 'projects', 'users'));
    }
    public function edit(Request $request, $id)
    {
        $branch = Session::get('branch');
        $projects = ProjectModel::select('id', 'projectname', 'project_leader')->where('id', $id)->get();
        $users = User::all();
        $members = ProjectMembersModel::select('employees.id', 'employees.category', 'employees.employee_name_field', 'qcrm_department.name',  'employees.employeeid', 'employees.id', 'jobtitle')
            ->leftjoin('employees', 'project_members.member_id',  'employees.id')
            ->leftjoin('qcrm_department', 'employees.department',  'qcrm_department.id')
            ->where('project_members.project_id', $id)
            ->get();
        return view('resourcemanagement.management.edit', compact('branch', 'projects', 'users', 'members'));
    }



    public function getTteamMembers(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->team_id;
            $members = ProjectTeamEmployeesModel::select('employees.id', 'employees.category', 'employees.employee_name_field', 'qcrm_department.name',  'employees.employeeid', 'employees.id', 'jobtitle')
                ->leftjoin('employees', 'project_team_members.member_id',  'employees.id')
                ->leftjoin('qcrm_department', 'employees.department',  'qcrm_department.id')
                ->where('project_team_members.project_team_id', $id)
                ->get();
            $out = array(
                'status' => 1,
                'data' => $members
            );
            echo json_encode($out);
        } else
            return null;
    }


    public function projectMembersSave(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $ifFound = ProjectModel::find($request->project_id);
                    if ($ifFound) {
                        $ifFound->update(array(
                            'resources_alc_flg' => 1,
                            'project_leader' => $request->project_leader
                        ));
                        ProjectMembersModel::where('project_id', $request->project_id)->delete();
                        $inArray = array();
                        foreach ($request->employee_id as $key => $value) {
                            $inSubArray =   array(
                                'project_id' => $request->project_id,
                                'member_id' => $value,
                                'created_at' => Carbon::now(),
                            );
                            array_push($inArray, $inSubArray);
                        }
                        ProjectMembersModel::insert($inArray);
                    } else
                        abort(404);
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
}

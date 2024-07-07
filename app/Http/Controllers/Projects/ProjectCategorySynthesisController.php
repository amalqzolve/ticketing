<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\projects\ProjectCategoryModel;
use App\projects\ProjectCategorySynthesisModel;
use App\Tender\TenderModel;
use App\User;
use Auth;
use Session;
use DataTables;

class ProjectCategorySynthesisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ProjectCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('flow_created', 1);
            $data = $query->get();
            $user = Auth::user();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $j = '';
                $k = 0;

                if ($user->can('project edit-project-category-synthesis')) {
                    $j .= ' <a href="project-category-synthesis-edit-view?id=' . $row->id . '" data-type="edit" data-target="#product_category"><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-edit"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->id . '" >Edit</span>
                    </span></li></a>';
                    $k++;
                }
                if ($user->can('project clone-project-category-synthesis')) {
                    $j .= '<a href="project-category-synthesis-clone?id=' . $row->id . '" data-type="edit" data-target="#kt_form"><li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon-background"></i>
                    <span class="kt-nav__link-text" data-id="' . $row->id . '" >clone</span>
                    </span></li></a>';
                    $k++;
                }
                if ($user->can('project delete-project-category-synthesis')) {
                    $j .= '<li class="kt-nav__item">
                    <span class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-trash"></i>
                    <span class="kt-nav__link-text mrWorkFlowdelete" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span></span></li>';
                    $k++;
                }
                if ($k)
                    return '<span style="overflow: visible; position: relative; width: 80px;">
          <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                      <i class="fa fa-cog"></i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                      <ul class="kt-nav">' . $j . '</ul></div></div></span>';
                else
                    return '';
            })->rawColumns(['action']);
            $dataTble->editColumn('decription', function ($row) {
                $priority = ProjectCategorySynthesisModel::select('user_id', 'users.name')->leftjoin('users', 'project_category_synthesis.user_id', '=', 'users.id')->where('cat_id', '=', $row->id)->orderBy('priority', 'ASC')->get();
                $prList = '';
                foreach ($priority as $key => $value) {
                    if ($key != 0)
                        $prList .=  ' -> ' . $value->name;
                    else
                        $prList .=  $value->name;
                }
                return $prList;
            });

            return $dataTble->make(true);
        }
        return view('projects.projectCategorySynthesis.listing');
    }
    public function add(Request $request)
    {
        $query = ProjectCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('flow_created', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        return view('projects.projectCategorySynthesis.add', compact('MaterialCategory', 'users'));
    }
    public function save(Request $request)
    {
        $useasr_id = Auth::user()->id;
        $branch = Session::get('branch');
        $postID = $request->id;
        for ($i = 0; $i < count($request->users); $i++) {
            $data = [
                'cat_id' => $request->mrCat,
                'priority' => $i + 1,
                'user_id' => $request->users[$i],
                'if_accepted_note' => $request->ifAccepted[$i],
                'if_rejected_note' => $request->ifRejected[$i],
                'branch'   => $branch,
                'created_by' => $useasr_id
            ];
            $mr = ProjectCategorySynthesisModel::updateOrCreate(['id' => $postID], $data);
        }
        $MaterialCategory = ProjectCategoryModel::find($request->mrCat);
        if ($MaterialCategory)
            $MaterialCategory->update(['flow_created' => 1]);
        return 'true';
    }
    public function editView(Request $request)
    {
        $query = ProjectCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = ProjectCategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('projects.projectCategorySynthesis.edit', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }
    public function view(Request $request)
    {
        $query = ProjectCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = ProjectCategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('projects.projectCategorySynthesis.view', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }

    public function clone(Request $request)
    {
        $query = ProjectCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('flow_created', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = ProjectCategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('projects.projectCategorySynthesis.clone', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }

    public function cloneSave(Request $request)
    {
        $useasr_id = Auth::user()->id;
        $branch = Session::get('branch');
        $postID = $request->id;
        for ($i = 0; $i < count($request->users); $i++) {
            $data = [
                'cat_id' => $request->mrCat,
                'priority' => $i + 1,
                'user_id' => $request->users[$i],
                'if_accepted_note' => $request->ifAccepted[$i],
                'if_rejected_note' => $request->ifRejected[$i],
                'branch'   => $branch,
                'created_by' => $useasr_id
            ];
            $mr = ProjectCategorySynthesisModel::updateOrCreate(['id' => $postID], $data);
        }
        $MaterialCategory = ProjectCategoryModel::find($request->mrCat);
        if ($MaterialCategory)
            $MaterialCategory->update(['flow_created' => 1]);
        return 'true';
    }

    public function update(Request $request)
    {
        $useasr_id = Auth::user()->id;
        $branch = Session::get('branch');
        ProjectCategorySynthesisModel::where('cat_id', '=', $request->mrCat)->delete();
        for ($i = 0; $i < count($request->users); $i++) {
            if (!isset($request->old_id[$i])) {
                $data = [
                    'cat_id' => $request->mrCat,
                    'priority' => $i + 1,
                    'user_id' => $request->users[$i],
                    'if_accepted_note' => $request->ifAccepted[$i],
                    'if_rejected_note'         => $request->ifRejected[$i],
                    'branch'   => $branch,
                    'created_by' => $useasr_id
                ];
            } else {
                $data = [
                    'id' => $request->old_id[$i],
                    'cat_id' => $request->mrCat,
                    'priority' => $i + 1,
                    'user_id' => $request->users[$i],
                    'if_accepted_note' => $request->ifAccepted[$i],
                    'if_rejected_note'         => $request->ifRejected[$i],
                    'branch'   => $branch,
                    'created_by' => $useasr_id
                ];
            }
            $mr = ProjectCategorySynthesisModel::Create($data);
        }
    }



    public function  delete(Request $request)
    {
        $isUsed = TenderModel::where('category_id', '=', $request->id)->count();

        if ($isUsed == 0) {
            ProjectCategorySynthesisModel::where('cat_id', '=', $request->id)->delete();
            $MaterialCategory = ProjectCategoryModel::find($request->id);
            if ($MaterialCategory)
                $MaterialCategory->update(['flow_created' => 0]);
            $data = array(
                'status' => 1,
                'msg' => "Your Entry has been deleted",
            );
        } else {
            $data = array(
                'status' => 0,
                'msg' => "Already Used Can't Delete!! ",
            );
        }

        echo json_encode($data);
    }
}

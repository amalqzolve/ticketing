<?php

namespace App\Http\Controllers\RequestAndApproval;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RequestAndApproval\RequestCategoryModel;
use App\RequestAndApproval\RequestCategorySynthesisModel;

use App\procurement\MaterialRequestModel;
use App\User;
use Auth;
use Session;
use DataTables;

class RequestCategorySynthesisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = RequestCategoryModel::orderby('id', 'desc');
            $query->where('flow_created', 1);
            $data = $query->get();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            $dataTble->editColumn('decription', function ($row) {
                $priority = RequestCategorySynthesisModel::select('user_id', 'users.name')->leftjoin('users', 'request_category_synthesis.user_id', '=', 'users.id')->where('cat_id', '=', $row->id)->orderBy('priority', 'ASC')->get();
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
        return view('request_and_approval.request_category_synthesis.listing');
    }
    public function add(Request $request)
    {
        $query = RequestCategoryModel::orderby('id', 'desc');
        $query->where('flow_created', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        return view('request_and_approval.request_category_synthesis.add', compact('MaterialCategory', 'users'));
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
            $mr = RequestCategorySynthesisModel::updateOrCreate(['id' => $postID], $data);
        }
        $MaterialCategory = RequestCategoryModel::find($request->mrCat);
        if ($MaterialCategory)
            $MaterialCategory->update(['flow_created' => 1]);
        return 'true';
    }
    public function editView(Request $request)
    {
        $query = RequestCategoryModel::orderby('id', 'desc');
        $query->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = RequestCategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('request_and_approval.request_category_synthesis.edit', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }
    public function view(Request $request)
    {
        $query = RequestCategoryModel::orderby('id', 'desc');
        $query->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = RequestCategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('request_and_approval.request_category_synthesis.view', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }

    public function clone(Request $request)
    {
        $query = RequestCategoryModel::orderby('id', 'desc');
        $query->where('flow_created', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = RequestCategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('request_and_approval.request_category_synthesis.clone', compact('MaterialCategory', 'users', 'mrWorkflow'));
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
            $mr = RequestCategorySynthesisModel::updateOrCreate(['id' => $postID], $data);
        }
        $MaterialCategory = RequestCategoryModel::find($request->mrCat);
        if ($MaterialCategory)
            $MaterialCategory->update(['flow_created' => 1]);
        return 'true';
    }

    public function update(Request $request)
    {
        $useasr_id = Auth::user()->id;
        $branch = Session::get('branch');
        RequestCategorySynthesisModel::where('cat_id', '=', $request->mrCat)->delete();
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
            $mr = RequestCategorySynthesisModel::Create($data);
        }
    }



    public function  delete(Request $request)
    {
        $isUsed = MaterialRequestModel::where('mr_category', '=', $request->id)->count();
        if ($isUsed == 0) {
            RequestCategorySynthesisModel::where('cat_id', '=', $request->id)->delete();
            $MaterialCategory = RequestCategoryModel::find($request->id);
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

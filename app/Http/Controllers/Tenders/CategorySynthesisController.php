<?php

namespace App\Http\Controllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tender\CategoryModel;
use App\Tender\CategorySynthesisModel;
use App\Tender\TenderModel;
use App\User;
use Auth;
use Session;
use DataTables;
use DB;

class CategorySynthesisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = CategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('flow_created', 1);
            $data = $query->get();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            $dataTble->editColumn('decription', function ($row) {
                $priority = CategorySynthesisModel::select('user_id', 'users.name')->leftjoin('users', 'category_synthesis.user_id', '=', 'users.id')->where('cat_id', '=', $row->id)->orderBy('priority', 'ASC')->get();
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
        return view('tenders.synthesis.listing');
    }
    public function add(Request $request)
    {
        $query = CategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('flow_created', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        return view('tenders.synthesis.add', compact('MaterialCategory', 'users'));
    }
    public function save(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {

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
                    $mr = CategorySynthesisModel::updateOrCreate(['id' => $postID], $data);
                }
                $MaterialCategory = CategoryModel::find($request->mrCat);
                if ($MaterialCategory)
                    $MaterialCategory->update(['flow_created' => 1]);
            });
            return 'true';
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }
    public function editView(Request $request)
    {
        $query = CategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = CategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('tenders.synthesis.edit', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }
    public function view(Request $request)
    {
        $query = CategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = CategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('tenders.synthesis.view', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }

    public function clone(Request $request)
    {
        $query = CategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('flow_created', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = CategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('tenders.synthesis.clone', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }

    public function cloneSave(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {
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
                    $mr = CategorySynthesisModel::updateOrCreate(['id' => $postID], $data);
                }
                $MaterialCategory = CategoryModel::find($request->mrCat);
                if ($MaterialCategory)
                    $MaterialCategory->update(['flow_created' => 1]);
            });
            return 'true';
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function update(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {

                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                CategorySynthesisModel::where('cat_id', '=', $request->mrCat)->delete();
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
                    $mr = CategorySynthesisModel::Create($data);
                }
            });
            return 'true';
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }



    public function  delete(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $isUsed = TenderModel::where('category_id', '=', $request->id)->count();
                if ($isUsed == 0) {
                    CategorySynthesisModel::where('cat_id', '=', $request->id)->delete();
                    $MaterialCategory = CategoryModel::find($request->id);
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
            });
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While delete'
            );
            echo json_encode($out);
        }
    }
}

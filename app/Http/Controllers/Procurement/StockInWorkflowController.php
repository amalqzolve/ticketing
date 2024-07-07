<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MaterialCategoryModel;
use App\procurement\StockInWorkflowModel;
use App\procurement\MaterialRequestModel;
use App\User;
use Auth;
use Session;
use DataTables;
use DB;

class StockInWorkflowController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MaterialCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('flow_created_stock_in', 1);
            $data = $query->get();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            $dataTble->editColumn('decription', function ($row) {
                $priority = StockInWorkflowModel::select('user_id', 'users.name')->leftjoin('users', 'stock_in_workflow.user_id', '=', 'users.id')->where('cat_id', '=', $row->id)->orderBy('priority', 'ASC')->get();
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
        return view('procurement.stockInWorkflow.listing');
    }
    public function add(Request $request)
    {
        $query = MaterialCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('flow_created_stock_in', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        return view('procurement.stockInWorkflow.add', compact('MaterialCategory', 'users'));
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
                    $mr = StockInWorkflowModel::updateOrCreate(['id' => $postID], $data);
                }
                $MaterialCategory = MaterialCategoryModel::find($request->mrCat);
                if ($MaterialCategory)
                    $MaterialCategory->update(['flow_created_stock_in' => 1]);
            });
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }
    public function editView(Request $request)
    {
        $query = MaterialCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = StockInWorkflowModel::where('cat_id', '=', $request->id)->get();
        return view('procurement.stockInWorkflow.edit', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }
    public function view(Request $request)
    {
        $query = MaterialCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = StockInWorkflowModel::where('cat_id', '=', $request->id)->get();
        return view('procurement.stockInWorkflow.view', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }

    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                StockInWorkflowModel::where('cat_id', '=', $request->mrCat)->delete();
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
                    $mr = StockInWorkflowModel::Create($data);
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }


    public function clone(Request $request)
    {
        $query = MaterialCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('flow_created_stock_in', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = StockInWorkflowModel::where('cat_id', '=', $request->id)->get();
        return view('procurement.stockInWorkflow.clone', compact('MaterialCategory', 'users', 'mrWorkflow'));
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
                    $mr = StockInWorkflowModel::updateOrCreate(['id' => $postID], $data);
                }
                $MaterialCategory = MaterialCategoryModel::find($request->mrCat);
                if ($MaterialCategory)
                    $MaterialCategory->update(['flow_created_stock_in' => 1]);
            });
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }


    public function  delete(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $isUsed = MaterialRequestModel::where('mr_category', '=', $request->id)->count();
                if ($isUsed == 0) {
                    StockInWorkflowModel::where('cat_id', '=', $request->id)->delete();
                    $MaterialCategory = MaterialCategoryModel::find($request->id);
                    if ($MaterialCategory)
                        $MaterialCategory->update(['flow_created_stock_in' => 0]);
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
            // $out = array(
            //     'status' => 1,
            //     'msg' => 'Success'
            // );
            // echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error'
            );
            echo json_encode($out);
        }
    }
}

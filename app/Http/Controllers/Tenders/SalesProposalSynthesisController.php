<?php

namespace App\Http\Controllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tender\SalesProposalCategoryModel;
use App\Tender\SalesProposalCategorySynthesisModel;
use App\Tender\TenderModel;
use App\User;
use Auth;
use Session;
use DataTables;

class SalesProposalSynthesisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = SalesProposalCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('flow_created', 1);
            $data = $query->get();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            $dataTble->editColumn('decription', function ($row) {
                $priority = SalesProposalCategorySynthesisModel::select('user_id', 'users.name')->leftjoin('users', 'sales_proposal_category_synthesis.user_id', '=', 'users.id')->where('cat_id', '=', $row->id)->orderBy('priority', 'ASC')->get();
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
        return view('tenders.salesProposalSynthesis.listing');
    }
    public function add(Request $request)
    {
        $query = SalesProposalCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('flow_created', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        return view('tenders.salesProposalSynthesis.add', compact('MaterialCategory', 'users'));
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
            $mr = SalesProposalCategorySynthesisModel::updateOrCreate(['id' => $postID], $data);
        }
        $MaterialCategory = SalesProposalCategoryModel::find($request->mrCat);
        if ($MaterialCategory)
            $MaterialCategory->update(['flow_created' => 1]);
        return 'true';
    }
    public function editView(Request $request)
    {
        $query = SalesProposalCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = SalesProposalCategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('tenders.salesProposalSynthesis.edit', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }
    public function view(Request $request)
    {
        $query = SalesProposalCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = SalesProposalCategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('tenders.salesProposalSynthesis.view', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }

    public function clone(Request $request)
    {
        $query = SalesProposalCategoryModel::orderby('id', 'desc');
        $query->where('del_flag', 1)->where('flow_created', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = SalesProposalCategorySynthesisModel::where('cat_id', '=', $request->id)->get();
        return view('tenders.salesProposalSynthesis.clone', compact('MaterialCategory', 'users', 'mrWorkflow'));
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
            $mr = SalesProposalCategorySynthesisModel::updateOrCreate(['id' => $postID], $data);
        }
        $MaterialCategory = SalesProposalCategoryModel::find($request->mrCat);
        if ($MaterialCategory)
            $MaterialCategory->update(['flow_created' => 1]);
        return 'true';
    }

    public function update(Request $request)
    {
        $useasr_id = Auth::user()->id;
        $branch = Session::get('branch');
        SalesProposalCategorySynthesisModel::where('cat_id', '=', $request->mrCat)->delete();
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
            $mr = SalesProposalCategorySynthesisModel::Create($data);
        }
    }



    public function  delete(Request $request)
    {
        $isUsed = TenderModel::where('category_id', '=', $request->id)->count();

        if ($isUsed == 0) {
            SalesProposalCategorySynthesisModel::where('cat_id', '=', $request->id)->delete();
            $MaterialCategory = SalesProposalCategoryModel::find($request->id);
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

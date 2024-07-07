<?php

namespace App\Http\Controllers\vouchers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\MaterialCategoryModel;
use App\settings\VouchersettingsModel;
use App\vouchers\VoucherSynthesisModel;
// use App\procurement\MaterialRequestModel;
use App\User;
use Auth;
use Session;
use DataTables;

class SynthesisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = VouchersettingsModel::orderby('id', 'desc');
            $query->where('del_flag', '=', 1)->where('flow_created', 1);
            $data = $query->get();
            $dataTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            $dataTble->editColumn('decription', function ($row) {
                $priority = VoucherSynthesisModel::select('user_id', 'users.name')->leftjoin('users', 'voucher_synthesis.user_id', '=', 'users.id')->where('qsettings_voucher_id', '=', $row->id)->orderBy('priority', 'ASC')->get();
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
        return view('vouchers.synthesis.listing');
    }
    public function add(Request $request)
    {
        $query = VouchersettingsModel::orderby('id', 'desc');
        $query->where('del_flag', '=', 1)->where('flow_created', 0);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        return view('vouchers.synthesis.add', compact('MaterialCategory', 'users'));
    }
    public function save(Request $request)
    {
        $useasr_id = Auth::user()->id;
        $branch = Session::get('branch');
        $postID = $request->id;
        for ($i = 0; $i < count($request->users); $i++) {
            $data = [
                'qsettings_voucher_id' => $request->mrCat,
                'priority' => $i + 1,
                'user_id' => $request->users[$i],
                'if_accepted_note' => $request->ifAccepted[$i],
                'if_rejected_note' => $request->ifRejected[$i],
                'branch'   => $branch,
                'created_by' => $useasr_id
            ];
            $mr = VoucherSynthesisModel::updateOrCreate(['id' => $postID], $data);
        }
        $MaterialCategory = VouchersettingsModel::find($request->mrCat);
        if ($MaterialCategory)
            $MaterialCategory->update(['flow_created' => 1]);
        return 'true';
    }
    public function editView(Request $request)
    {
        $query = VouchersettingsModel::orderby('id', 'desc');
        $query->where('id', $request->id);
        $MaterialCategory = $query->get();
        // echo json_encode($MaterialCategory);
        // die();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = VoucherSynthesisModel::where('qsettings_voucher_id', '=', $request->id)->get();
        return view('vouchers.synthesis.edit', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }
    public function view(Request $request)
    {
        $query = VouchersettingsModel::orderby('id', 'desc');
        $query->where('id', $request->id);
        $MaterialCategory = $query->get();
        $users = User::where('synthesis_user_flg', 1)->get();
        $mrWorkflow = VoucherSynthesisModel::where('qsettings_voucher_id', '=', $request->id)->get();
        return view('vouchers.synthesis.view', compact('MaterialCategory', 'users', 'mrWorkflow'));
    }

    public function update(Request $request)
    {
        $useasr_id = Auth::user()->id;
        $branch = Session::get('branch');
        VoucherSynthesisModel::where('qsettings_voucher_id', '=', $request->mrCat)->delete();
        for ($i = 0; $i < count($request->users); $i++) {
            if (!isset($request->old_id[$i])) {
                $data = [
                    'qsettings_voucher_id' => $request->mrCat,
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
                    'qsettings_voucher_id' => $request->mrCat,
                    'priority' => $i + 1,
                    'user_id' => $request->users[$i],
                    'if_accepted_note' => $request->ifAccepted[$i],
                    'if_rejected_note'         => $request->ifRejected[$i],
                    'branch'   => $branch,
                    'created_by' => $useasr_id
                ];
            }
            $mr = VoucherSynthesisModel::Create($data);
        }
    }
    public function  delete(Request $request)
    {
        $isUsed = MaterialRequestModel::where('mr_category', '=', $request->id)->count();

        if ($isUsed == 0) {
            VoucherSynthesisModel::where('qsettings_voucher_id', '=', $request->id)->delete();
            $MaterialCategory = VouchersettingsModel::find($request->id);
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

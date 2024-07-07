<?php

namespace App\Http\Controllers\Tenders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Tender\SalesProposalCategoryModel;
use Session;

class SalesProposalCategoryController extends Controller
{
    public function list(Request $request)
    {
        // $branch = Session::get('branch');
        if ($request->ajax()) {
            $query = SalesProposalCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('tenders.salesProposalCategory.listing');
    }
    public function add(Request $request)
    {
        return view('tenders.salesProposalCategory.add');
    }
    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $query = SalesProposalCategoryModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('tenders.salesProposalCategory.trashlisting');
    }
    public function submit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $postID = $request->info_id;
                $branch = Session::get('branch');
                $data = [
                    'name' => $request->name,
                    'decription' => $request->decription,
                    'branch' => $branch
                ];

                $purchase = SalesProposalCategoryModel::updateOrCreate(['id' => $postID], $data);
            });
            return 'true';
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Approve'
            );
            echo json_encode($out);
        }
    }
    public function edit(Request $request)
    {
        $branch = Session::get('branch');

        $id = $request->id;
        $data = SalesProposalCategoryModel::where('id', $id)->get();
        return view('tenders.salesProposalCategory.edit', compact('data', 'branch'));
    }


    public function delete(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $MaterialCategory = SalesProposalCategoryModel::find($request->id);
                if ($MaterialCategory->flow_created == 0) {
                    SalesProposalCategoryModel::where('id', $id)->update(['del_flag' => 0]);
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
    public function restore(Request $request)
    {
        $id = $request->id;
        SalesProposalCategoryModel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function trashdelete(Request $request)
    {
        $id = $request->id;
        SalesProposalCategoryModel::where('id', $id)->delete();
        return 'true';
    }
}

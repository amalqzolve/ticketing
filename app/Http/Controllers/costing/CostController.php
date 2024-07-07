<?php

namespace App\Http\Controllers\costing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Boq;
use App\costing\CostmatrixModel;
use DataTables;
use App\crm\CustomerModel;
use App\Tender\TenderModel;

class CostController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Boq::select('boqs.*', 'boqs.status', 'boqs.description as description', 'boqs.id as id', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as projectname')
                ->whereNull('parent_id')
                ->leftjoin('qprojects_projects', 'boqs.projectname', '=', 'qprojects_projects.id')
                ->leftjoin('qcrm_customer_details', 'boqs.client', '=', 'qcrm_customer_details.id')
                ->where('boqs.status', 1)
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            });
            return $dtTble->make(true);
        } else
            return view('costing.costing.list');
    }

    public function Child(Request $request)
    {
        $parent = $request->id;
        if ($request->ajax()) {
            $data = Boq::where('parent_id', $parent)->orderBy('id', 'ASC')->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            });
            return $dtTble->make(true);
        } else {
            if ($parent != '') {
                $boq = Boq::where('id', $parent)->first(); //->value('parent_id');
                $assent_id = $boq->parent_id;
                $parent_name = $boq->category_name;
                return view('costing.costing.listChild', compact('assent_id', 'parent_name', 'parent'));
            } else
                return redirect()->route('cost-estimation', null);
        }
    }

    public function markEstimationCompleted(Request $request)
    {
        $id = $request->id;
        if (($id) && ($request->ajax())) {
            $ifFind = Boq::whereIn('id', BOQ::select('id')->descendantsAndSelf($id))->update(['estimation_status' => 1]);
            $out = array(
                'status' => 1,
                'message' => 'Success',
            );
        } else
            $out = array(
                'status' => 0,
                'message' => 'Error',
            );
        echo json_encode($out);
    }


    public function markEstimationPending(Request $request)
    {
        $id = $request->id;
        if (($id) && ($request->ajax())) {
            $ifFind = Boq::whereIn('id', BOQ::select('id')->descendantsAndSelf($id))->update(['estimation_status' => NULL]);
            $out = array(
                'status' => 1,
                'message' => 'Success',
            );
        } else
            $out = array(
                'status' => 0,
                'message' => 'Error',
            );
        echo json_encode($out);
    }
}

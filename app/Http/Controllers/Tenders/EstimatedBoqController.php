<?php

namespace App\Http\Controllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Boq;
use Session;
use DB;
use DataTables;

class EstimatedBoqController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Boq::select('boqs.*', 'boqs.status', 'boqs.description as description', 'boqs.id as id', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as projectname')
                ->whereNull('boqs.parent_id')
                ->where('boqs.status', 3)
                ->leftjoin('qprojects_projects', 'boqs.projectname', '=', 'qprojects_projects.id')
                ->leftjoin('qcrm_customer_details', 'boqs.client', '=', 'qcrm_customer_details.id')
                ->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            });
            return $dtTble->make(true);
        } else
            return view('tenders.boq.list');
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
                return view('tenders.boq.listChild', compact('assent_id', 'parent_name', 'parent'));
            } else
                return redirect()->route('estimated-boq-list', null);
        }
    }
}

<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\MaterialRequestModel;
use App\procurement\MaterialRequestProductsModel;
use App\procurement\EprRfqModel;
use DB;

class ProcurementController extends Controller
{
    public function index()
    {
        return view('procurement.home');
    }

    public function listing(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'material_request.procurement_status', 'material_request.rfq_status', 'material_request.po_status', 'users.name')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->where('material_request.request_against', '=', 1)
                // ->where('material_request.request_type', '=', 1) //internal use
                ->where('material_request.status', '=', 6)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('rfqstatus', function ($row) {
                $eprCount = EprRfqModel::select('status')->where('epr_id', '=', $row->id)->get();
                $rfqCount = 0;
                $valueSubmited = 0;
                foreach ($eprCount as $key => $value) {
                    if ($value->status == 2) {
                        $rfqCount++;
                        $valueSubmited++;
                    } else
                        $rfqCount++;
                }
                return  "Total Quotes: " . $rfqCount . "<br/>Quote Submited : " . $valueSubmited;
            })->addColumn('postatus', function ($row) {
                return $this->getPoStatus($row->id);
            })->rawColumns(['action', 'rfqstatus', 'postatus']);
            return  $dtTble->make(true);
        } else
            return view('procurement.procurement.listing');
    }
    public function getPoStatus($id)
    {
        $products =  MaterialRequestProductsModel::select('quantity', 'po_assigned_qty')->where('mr_id', $id)->get();
        $status = 0;
        $changed = 0;
        $j = 0;
        foreach ($products as $key => $value) {
            $j++;
            if ($value->quantity == $value->po_assigned_qty)
                $status++;
            if ($value->po_assigned_qty != 0)
                $changed++;
        }
        if ($j == $status)
            $out = 2;
        else if ($changed != 0)
            $out = 1;
        else
            $out = 0;
        return $out;
    }

    public function listDeptUse(Request $request)
    {
        if ($request->ajax()) {
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'material_request.procurement_status', 'material_request.rfq_status', 'material_request.po_status', 'users.name')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->where('material_request.request_against', '=', 2)
                // ->where('material_request.request_type', '=', 2) //Department use
                ->where('material_request.status', '=', 6)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('rfqstatus', function ($row) {
                $eprCount = EprRfqModel::select('status')->where('epr_id', '=', $row->id)->get();
                $rfqCount = 0;
                $valueSubmited = 0;
                foreach ($eprCount as $key => $value) {
                    if ($value->status == 2) {
                        $rfqCount++;
                        $valueSubmited++;
                    } else
                        $rfqCount++;
                }
                return  "Total Quotes: " . $rfqCount . "<br/>Quote Submited : " . $valueSubmited;
            })->addColumn('postatus', function ($row) {
                return $this->getPoStatus($row->id);
            })->rawColumns(['action', 'rfqstatus', 'postatus']);
            return  $dtTble->make(true);
        } else
            return null;
    }
    public function listPersonalUse(Request $request)
    {
        if ($request->ajax()) {
            $data = MaterialRequestModel::select('material_request.id', 'material_request.request_type', 'ma_category.name as mr_category', 'material_request.request_against', DB::raw("DATE_FORMAT(material_request.quotedate, '%d-%m-%Y') as quotedate"), 'material_request.status', 'material_request.procurement_status', 'material_request.rfq_status', 'material_request.po_status', 'users.name')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->where('material_request.request_against', '=', 3)
                // ->where('material_request.request_type', '=', 3) // PersonalUse
                ->where('material_request.status', '=', 6)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('rfqstatus', function ($row) {
                $eprCount = EprRfqModel::select('status')->where('epr_id', '=', $row->id)->get();
                $rfqCount = 0;
                $valueSubmited = 0;
                foreach ($eprCount as $key => $value) {
                    if ($value->status == 2) {
                        $rfqCount++;
                        $valueSubmited++;
                    } else
                        $rfqCount++;
                }
                return  "Total Quotes: " . $rfqCount . "<br/>Quote Submited : " . $valueSubmited;
            })->addColumn('postatus', function ($row) {
                return $this->getPoStatus($row->id);
            })->rawColumns(['action', 'rfqstatus', 'postatus']);
            return  $dtTble->make(true);
        } else
            return null;
    }
}

<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\MaterialRequestModel;
use App\procurement\EprRfqModel;
use App\procurement\EprRfqProductsModel;
use App\MaterialCategoryModel;
use App\procurement\MaterialRequestProductsModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoProductsModel;
use App\crm\CustomerModel;
use DB;
use Session;
use Auth;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;

class RfqController extends Controller
{
    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = EprRfqModel::select('epr_rfq.epr_id as id', 'epr_rfq.request_type', 'ma_category.name as mr_category', 'epr_rfq.request_against', DB::raw("DATE_FORMAT(epr_rfq.quotedate, '%d-%m-%Y') as quotedate"), 'epr_rfq.status', 'users.name')
                ->leftjoin('ma_category', 'epr_rfq.mr_category', '=', 'ma_category.id')
                ->leftjoin('users', 'epr_rfq.user_id', '=', 'users.id')
                ->where('epr_rfq.request_type', '=', 1)
                ->groupBy('epr_id')
                ->get();

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
                return $str = "Quote Submited : " . $valueSubmited . "<br/>Total Quotes: " . $rfqCount;
            })->rawColumns(['action', 'rfqstatus']);
            return  $dtTble->make(true);
        } else
            return view('procurement.rfq.list');
    }

    public function  listDepartment(Request $request)
    {
        if ($request->ajax()) {
            $data = EprRfqModel::select('epr_rfq.epr_id as id', 'epr_rfq.request_type', 'ma_category.name as mr_category', 'epr_rfq.request_against', DB::raw("DATE_FORMAT(epr_rfq.quotedate, '%d-%m-%Y') as quotedate"), 'epr_rfq.status', 'users.name')
                ->leftjoin('ma_category', 'epr_rfq.mr_category', '=', 'ma_category.id')
                ->leftjoin('users', 'epr_rfq.user_id', '=', 'users.id')
                ->where('epr_rfq.request_type', '=', 2)
                ->groupBy('epr_id')
                ->get();

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
                return $str = "Quote Submited : " . $valueSubmited . "<br/>Total Quotes: " . $rfqCount;
            })->rawColumns(['action', 'rfqstatus']);
            return  $dtTble->make(true);
        } else
            return Null;
    }
    public function listPersonal(Request $request)
    {
        if ($request->ajax()) {
            $data = EprRfqModel::select('epr_rfq.epr_id as id', 'epr_rfq.request_type', 'ma_category.name as mr_category', 'epr_rfq.request_against', DB::raw("DATE_FORMAT(epr_rfq.quotedate, '%d-%m-%Y') as quotedate"), 'epr_rfq.status')
                ->leftjoin('ma_category', 'epr_rfq.mr_category', '=', 'ma_category.id')
                ->where('epr_rfq.request_type', '=', 3)
                ->groupBy('epr_id')
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if ($row->status != 0) {
                    $str = '--';
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return Null;
    }
    public function listProject(Request $request)
    {
        if ($request->ajax()) {
            $data = EprRfqModel::select('epr_rfq.epr_id as id', 'epr_rfq.request_type', 'ma_category.name as mr_category', 'epr_rfq.request_against', DB::raw("DATE_FORMAT(epr_rfq.quotedate, '%d-%m-%Y') as quotedate"), 'epr_rfq.status', 'qcrm_customer_details.cust_name as cust_name', 'qprojects_projects.projectname')
                ->leftjoin('ma_category', 'epr_rfq.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'epr_rfq.client', '=', 'qcrm_customer_details.id')
                ->leftjoin('qprojects_projects', 'epr_rfq.project', '=', 'qprojects_projects.id')
                ->where('epr_rfq.request_type', '=', 4)
                ->groupBy('epr_id')
                ->get();

            // ->where('epr_rfq.status', '!=', 0)->get();

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
                return $str = "Quote Submited : " . $valueSubmited . "<br/>Total Quotes: " . $rfqCount;
            })->rawColumns(['action', 'rfqstatus']);
            return  $dtTble->make(true);
        } else
            return Null;
    }


    public function detailList(Request $request)
    {
        $id = $request->id;
        if ($request->ajax()) {
            $data = EprRfqModel::select('epr_rfq.id', 'epr_rfq.epr_id', 'epr_rfq.request_type', 'ma_category.name as mr_category', 'epr_rfq.request_against', DB::raw("DATE_FORMAT(epr_rfq.rfq_date, '%d-%m-%Y') as rfq_date"), DB::raw("DATE_FORMAT(epr_rfq.rfq_valid_till, '%d-%m-%Y') as rfq_valid_till"), 'epr_rfq.status', 'users.name', 'qcrm_supplier.sup_name')
                ->leftjoin('ma_category', 'epr_rfq.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_rfq.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_rfq.user_id', '=', 'users.id')
                ->where('epr_rfq.epr_id', '=', $id)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if ($row->status != 0) {
                    $str = '--';
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return view('procurement.rfq.listDetail', compact('id'));
    }

    public function quoteDetailList(Request $request)
    {
        $id = $request->id;
        if ($request->ajax()) {
            $data = EprRfqModel::select('epr_rfq.id', 'epr_rfq.epr_id', 'epr_rfq.request_type', 'ma_category.name as mr_category', 'epr_rfq.request_against', DB::raw("DATE_FORMAT(epr_rfq.rfq_date, '%d-%m-%Y') as rfq_date"), DB::raw("DATE_FORMAT(epr_rfq.rfq_valid_till, '%d-%m-%Y') as rfq_valid_till"), 'epr_rfq.status', 'epr_rfq.supp_quot_id', DB::raw("DATE_FORMAT(epr_rfq.quot_date, '%d-%m-%Y') as quot_date"), DB::raw("DATE_FORMAT(epr_rfq.quote_valid_date, '%d-%m-%Y') as quote_valid_date"), 'users.name', 'qcrm_supplier.sup_name')
                ->leftjoin('ma_category', 'epr_rfq.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_rfq.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_rfq.user_id', '=', 'users.id')
                ->where('epr_rfq.epr_id', '=', $id)
                ->where('epr_rfq.status', '=', 2)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if ($row->status != 0) {
                    $str = '--';
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return view('procurement.rfq.quoteListDetail', compact('id'));
    }


    public function generate(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = MaterialRequestModel::find($id);
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where('client', '=', $MaterialRequest->client)->get();
        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = MaterialRequestProductsModel::where('mr_id', '=', $id)->get();
        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.rfq.generate', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'productlist', 'supplier', 'projects'));
    }

    public function save(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $supplierArray = $request->supplier;
                foreach ($supplierArray as $key => $value) {
                    $supplier = $value;
                    $data = array(
                        'epr_id' => $request->id,
                        'rfq_date' => Carbon::parse($request->rfq_date)->format('Y-m-d  h:i'),
                        'rfq_valid_till' => Carbon::parse($request->rfq_valid_till)->format('Y-m-d  h:i'),
                        'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                        'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                        'request_type' => $request->request_type,
                        'mr_category' => $request->mr_category,
                        'request_priority' => $request->request_priority,
                        'request_against' => $request->request_against,
                        'client' => $request->client,
                        'project' => $request->project,
                        'supplier_id' => $supplier,
                        'internalreference' => $request->internalreference,
                        'notes' => $request->notes,
                        'terms' => $request->terms,
                        'user_id' => $useasr_id
                    );
                    $postID = '';

                    $epr_id = EprRfqModel::updateOrCreate(['id' => $postID], $data);
                    $mrId = $epr_id->id;
                    for ($i = 0; $i < count($request->productname); $i++) {
                        $data = [
                            'epr_rfq_id' => $mrId,
                            'epr_product_id' => $request->eprProductId[$i],
                            'itemname' => $request->productname[$i],
                            'description' => $request->product_description[$i],
                            'unit'         => $request->unit[$i],
                            'quantity'   => $request->quantity[$i],
                            'branch' => $branch
                        ];

                        $eprRfqProducts = EprRfqProductsModel::Create($data);
                    }
                }
                $out = array('status' => 1, 'data' => $mrId);
                echo json_encode($out);
            });
            // $out = array(
            //     'status' => 1,
            //     'msg' => 'Saved Success'
            // );
            // echo json_encode($out);
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
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprRfqModel::find($id);
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where('client', '=', $MaterialRequest->client)->get();
        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprRfqProductsModel::where('epr_rfq_id', '=', $id)->get();
        return view('procurement.rfq.edit', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'supplier', 'projects'));
    }
    public function Update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $supplier = $request->supplier;
                $postID = $request->id;
                $data = array(
                    'epr_id' => $request->epr_id,
                    'rfq_date' => Carbon::parse($request->rfq_date)->format('Y-m-d  h:i'),
                    'rfq_valid_till' => Carbon::parse($request->rfq_valid_till)->format('Y-m-d  h:i'),
                    'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                    'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                    'request_type' => $request->request_type,
                    'mr_category' => $request->mr_category,
                    'request_priority' => $request->request_priority,
                    'request_against' => $request->request_against,
                    'client' => $request->client,
                    'project' => $request->project,
                    'supplier_id' => $supplier,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'user_id' => $useasr_id
                );

                $eprRfq = EprRfqModel::updateOrCreate(['id' => $postID], $data);
                EprRfqProductsModel::where('epr_rfq_id', '=', $postID)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_rfq_id' => $postID,
                        'epr_product_id' => $request->eprProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'branch' => $branch
                    ];

                    $eprRfqProducts = EprRfqProductsModel::Create($data);
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Saved Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }
    public function editforSubmit(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprRfqModel::find($id);
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where('client', '=', $MaterialRequest->client)->get();

        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprRfqProductsModel::where('epr_rfq_id', '=', $id)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.rfq.submit', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'supplier', 'vatlist', 'projects'));
    }
    public function submitUpdate(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $supplier = $request->supplier;
                $postID = $request->id;
                $data = array(
                    'epr_id' => $request->epr_id,
                    'supp_quot_id' => $request->supp_quot_id,
                    'quot_date' => Carbon::parse($request->quot_date)->format('Y-m-d  h:i'),
                    'quote_valid_date' => Carbon::parse($request->quote_valid_date)->format('Y-m-d  h:i'),
                    'rfq_date' => Carbon::parse($request->rfq_date)->format('Y-m-d  h:i'),
                    'rfq_valid_till' => Carbon::parse($request->rfq_valid_till)->format('Y-m-d  h:i'),
                    'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                    'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                    'request_type' => $request->request_type,
                    'mr_category' => $request->mr_category,
                    'request_priority' => $request->request_priority,
                    'request_against' => $request->request_against,
                    'client' => $request->client,
                    'project' => $request->project,
                    'supplier_id' => $supplier,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'user_id' => $useasr_id,
                    'totalamount' => $request->totalamount,
                    'discount' => $request->discount,
                    'amountafterdiscount' => $request->amountafterdiscount,
                    'totalvatamount' => $request->totalvatamount,
                    'grandtotalamount' => $request->grandtotalamount,
                    'status' => 2 //change to submited status

                );

                $eprRfq = EprRfqModel::updateOrCreate(['id' => $postID], $data);
                EprRfqProductsModel::where('epr_rfq_id', '=', $postID)->delete();
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_rfq_id' => $postID,
                        'epr_product_id' => $request->eprProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'rate' => $request->rate[$i],
                        'amount' => $request->amount[$i],
                        'discont' => $request->discountamount[$i],
                        'vat' => $request->vat_percentage[$i],
                        'vat_amount' => $request->vatamount[$i],
                        'total' => $request->row_total[$i],
                        'branch' => $branch
                    ];

                    $eprRfqProducts = EprRfqProductsModel::Create($data);
                }
            });
            $out = array(
                'status' => 1,
                'message' => 'EPR RFQ Submited Succesfully'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }
    public function sendRfq(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $id = $request->id;
                $ifFind = EprRfqModel::find($id);
                if ($ifFind) {
                    $data = array(
                        'status' => 3,
                    );
                    $ifFind->Update($data);
                }
            });
            $out = array(
                'status' => 1,
                'msg' => 'Saved Success'
            );
            echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function editforPo(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprRfqModel::find($id);

        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where('client', '=', $MaterialRequest->client)->get();


        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprRfqProductsModel::where('epr_rfq_id', '=', $id)->get();
        $reqProduct = $MaterialRequestProducts->map(function ($value, $key) {
            $product = MaterialRequestProductsModel::find($value->epr_product_id);
            $outArray = array(
                'epr_quantity' => $product->quantity,
                'po_assigned_qty' => $product->po_assigned_qty,
                'quantity' => $value->quantity,
                'balance' => $product->quantity - $product->po_assigned_qty,
            );
            return $outArray;
        });

        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.rfq.submitPo', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'supplier', 'vatlist', 'reqProduct', 'projects'));
    }

    public function submitPo(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');

                $data = array(
                    'epr_id' => $request->epr_id,
                    'rfq_id' => $request->rfq_id,
                    'po_date' => Carbon::parse($request->po_date)->format('Y-m-d  h:i'),
                    'po_valid_till' => Carbon::parse($request->po_valid_till)->format('Y-m-d  h:i'),
                    'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                    'dateofsupply' => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),
                    'request_type' => $request->request_type,
                    'mr_category' => $request->mr_category,
                    'request_priority' => $request->request_priority,
                    'request_against' => $request->request_against,
                    'client' => $request->client,
                    'project' => $request->project,
                    'supplier_id' => $request->supplier,
                    'internalreference' => $request->internalreference,
                    'notes' => $request->notes,
                    'terms' => $request->terms,
                    'totalamount' => $request->totalamount,
                    'discount' => $request->discount,
                    'amountafterdiscount' => $request->amountafterdiscount,
                    'totalvatamount' => $request->totalvatamount,
                    'grandtotalamount' => $request->grandtotalamount,
                    'user_id' => $useasr_id
                );
                $postID = '';

                $epr_id = EprPoModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $epr_id->id;
                for ($i = 0; $i < count($request->productname); $i++) {
                    $data = [
                        'epr_po_id' => $mrId,
                        'epr_product_id' => $request->eprProductId[$i],
                        'itemname' => $request->productname[$i],
                        'description' => $request->product_description[$i],
                        'unit'         => $request->unit[$i],
                        'quantity'   => $request->quantity[$i],
                        'rate' => $request->rate[$i],
                        'amount' => $request->amount[$i],
                        'discont' => $request->discountamount[$i],
                        'vat' => $request->vat_percentage[$i],
                        'vat_amount' => $request->vatamount[$i],
                        'total' => $request->row_total[$i],
                        'branch' => $branch
                    ];

                    $eprRfqProducts = EprPoProductsModel::Create($data);
                    $qty = $request->quantity[$i] + $request->po_assigned_qty[$i];
                    $this->updateEprQty($request->eprProductId[$i], $qty);
                }
                $out = array('status' => 1, 'data' => $mrId);
                echo json_encode($out);
            });
            // $out = array(
            //     'status' => 1,
            //     'msg' => 'Saved Success'
            // );
            // echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Save'
            );
            echo json_encode($out);
        }
    }

    public function updateEprQty($id, $qty)
    {
        MaterialRequestProductsModel::find($id)->update(['po_assigned_qty' => $qty]);
    }


    public function view(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprRfqModel::find($id);
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where(
            'client',
            '=',
            $MaterialRequest->client
        )->get();

        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprRfqProductsModel::where('epr_rfq_id', '=', $id)->get();
        return view('procurement.rfq.view', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'supplier', 'projects'));
    }

    public function viewPdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');

        $mainData = EprRfqModel::select(
            'epr_rfq.id',
            'epr_rfq.rfq_date',
            'epr_rfq.rfq_valid_till',
            'epr_rfq.supp_quot_id',
            'epr_rfq.quot_date',
            'epr_rfq.quote_valid_date',
            'qcrm_termsandconditions.description',
            'epr_rfq.notes',
            'epr_rfq.totalamount',
            'epr_rfq.totalvatamount',
            'epr_rfq.grandtotalamount',
            'users.name as created_name',
            'qcrm_supplier.sup_name',
            'qcrm_supplier.sup_add1',
            'qcrm_supplier.sup_add2',
            'qcrm_supplier.sup_region',
            'qcrm_supplier.sup_city',
            'qcrm_supplier.sup_zip',
            'qcrm_supplier.vatno',
            'qcrm_supplier.buyerid_crno',
            'qcrm_supplier.sup_name_ar',
            'qcrm_supplier.sup_add1_ar',
            'qcrm_supplier.sup_add2_ar',
            'qcrm_supplier.sup_region_ar',
            'qcrm_supplier.sup_city_ar',
            'qcrm_supplier.sup_country_ar',
            'qcrm_supplier.sup_zip_ar',
            'qcrm_supplier.vatno_ar',
            'qcrm_supplier.buyerid_crno_ar',
            'epr_rfq.status'
        )
            ->leftjoin('users', 'epr_rfq.user_id', '=', 'users.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_rfq.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('qcrm_supplier', 'epr_rfq.supplier_id', '=', 'qcrm_supplier.id')
            ->find($id);
        $products = EprRfqProductsModel::select('epr_rfq_products.*', 'qinventory_product_unit.unit_name')
            ->leftjoin('qinventory_product_unit', 'epr_rfq_products.unit', '=', 'qinventory_product_unit.id')
            ->where('epr_rfq_id', '=', $id)->get();


        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

        $pdfData = 'RFQ ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->rfq_date));
        // if ($mainData->status == 2) {
        //     $pdf = PDF::loadView('procurement.rfq.previewQuote', compact('mainData', 'products', 'branchsettings'), array(),  [
        //         'title'      => $pdfData,
        //         'margin_top' => 0
        //     ]);
        // } else {
        $pdf = PDF::loadView('procurement.rfq.preview', compact('mainData', 'products', 'branchsettings'), array(),  [
            'title'      => $pdfData,
            'margin_top' => 0
        ]);
        // }

        return $pdf->stream($pdfData . '.pdf');
    }



    public function viewPdfQuote(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');

        $mainData = EprRfqModel::select(
            'epr_rfq.id',
            'epr_rfq.rfq_date',
            'epr_rfq.rfq_valid_till',
            'epr_rfq.supp_quot_id',
            'epr_rfq.quot_date',
            'epr_rfq.quote_valid_date',
            'qcrm_termsandconditions.description',
            'epr_rfq.notes',
            'epr_rfq.totalamount',
            'epr_rfq.totalvatamount',
            'epr_rfq.grandtotalamount',
            'users.name as created_name',
            'qcrm_supplier.sup_name',
            'qcrm_supplier.sup_add1',
            'qcrm_supplier.sup_add2',
            'qcrm_supplier.sup_region',
            'qcrm_supplier.sup_city',
            'qcrm_supplier.sup_zip',
            'qcrm_supplier.vatno',
            'qcrm_supplier.buyerid_crno',
            'qcrm_supplier.sup_name_ar',
            'qcrm_supplier.sup_add1_ar',
            'qcrm_supplier.sup_add2_ar',
            'qcrm_supplier.sup_region_ar',
            'qcrm_supplier.sup_city_ar',
            'qcrm_supplier.sup_country_ar',
            'qcrm_supplier.sup_zip_ar',
            'qcrm_supplier.vatno_ar',
            'qcrm_supplier.buyerid_crno_ar',
            'epr_rfq.status'
        )
            ->leftjoin('users', 'epr_rfq.user_id', '=', 'users.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_rfq.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('qcrm_supplier', 'epr_rfq.supplier_id', '=', 'qcrm_supplier.id')
            ->find($id);
        $products = EprRfqProductsModel::select('epr_rfq_products.*', 'qinventory_product_unit.unit_name')
            ->leftjoin('qinventory_product_unit', 'epr_rfq_products.unit', '=', 'qinventory_product_unit.id')
            ->where('epr_rfq_id', '=', $id)->get();


        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();

        $pdfData = 'RFQ ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->rfq_date));
        $pdf = PDF::loadView('procurement.rfq.previewQuote', compact('mainData', 'products', 'branchsettings'), array(),  [
            'title'      => $pdfData,
            'margin_top' => 0
        ]);


        return $pdf->stream($pdfData . '.pdf');
    }






    public function supplierQuotation(Request $request)
    {
        if ($request->ajax()) {
            $data = EprRfqModel::select('epr_rfq.id', 'epr_rfq.epr_id', 'epr_rfq.request_type', 'ma_category.name as mr_category', 'epr_rfq.request_against', DB::raw("DATE_FORMAT(epr_rfq.rfq_date, '%d-%m-%Y') as rfq_date"), DB::raw("DATE_FORMAT(epr_rfq.rfq_valid_till, '%d-%m-%Y') as rfq_valid_till"), 'epr_rfq.status', 'epr_rfq.supp_quot_id', DB::raw("DATE_FORMAT(epr_rfq.quot_date, '%d-%m-%Y') as quot_date"), DB::raw("DATE_FORMAT(epr_rfq.quote_valid_date, '%d-%m-%Y') as quote_valid_date"), 'users.name', 'qcrm_supplier.sup_name')
                ->leftjoin('ma_category', 'epr_rfq.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_rfq.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_rfq.user_id', '=', 'users.id')
                ->where('epr_rfq.status', '=', 2)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('procurement.rfq.supplierQuotation');
    }
    public function supplierQuotationCompare(Request $request)
    {
        if ($request->ajax()) {
            $data = EprRfqModel::select('epr_rfq.id', 'epr_rfq.epr_id', 'epr_rfq.request_type', 'ma_category.name as mr_category', 'epr_rfq.request_against', DB::raw("DATE_FORMAT(epr_rfq.rfq_date, '%d-%m-%Y') as rfq_date"), DB::raw("DATE_FORMAT(epr_rfq.rfq_valid_till, '%d-%m-%Y') as rfq_valid_till"), 'epr_rfq.status', 'users.name', 'qcrm_supplier.sup_name', 'epr_rfq.totalamount', 'epr_rfq.discount', 'epr_rfq.amountafterdiscount', 'epr_rfq.totalvatamount', 'epr_rfq.grandtotalamount')
                ->leftjoin('ma_category', 'epr_rfq.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_supplier', 'epr_rfq.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('users', 'epr_rfq.user_id', '=', 'users.id')
                ->orderBy('epr_rfq.epr_id', 'asc')
                ->where('epr_rfq.status', '=', 2)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }
    public function supplierQuotationGroup(Request $request)
    {
        if ($request->ajax()) {
            $data = EprRfqModel::select('epr_rfq.epr_id as id', 'epr_rfq.request_type', 'ma_category.name as mr_category', 'epr_rfq.request_against', DB::raw("DATE_FORMAT(epr_rfq.quotedate, '%d-%m-%Y') as quotedate"), 'epr_rfq.status', 'qcrm_customer_details.cust_name as cust_name', 'qprojects_projects.projectname as project')
                ->leftjoin('ma_category', 'epr_rfq.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'epr_rfq.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'epr_rfq.project', 'qprojects_projects.id')
                ->where('epr_rfq.request_type', '=', 4)
                ->groupBy('epr_id')
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }
}

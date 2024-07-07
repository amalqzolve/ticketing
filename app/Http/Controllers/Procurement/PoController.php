<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\MaterialRequestModel;
use App\procurement\PoWorkflowModel;
use App\procurement\PoApprovalTransactionModel;
use App\MaterialCategoryModel;
use App\procurement\MaterialRequestProductsModel;
use App\procurement\EprPoModel;
use App\procurement\EprPoRevisedModel;
use App\procurement\EprPoProductsModel;
use App\crm\CustomerModel;
use App\User;
use DB;
use Session;
use Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ActionRequired;
use App\settings\BranchSettingsModel;

class PoController extends Controller
{

    public function list(Request $request) //list Boq
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->whereIn('epr_po.status',  [1, 3])->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = PoApprovalTransactionModel::select('epr_po_approval_transaction.status', 'users.name')
                        ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                        ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                        ->where('epr_po_approval_transaction.po_id', '=', $row->id)
                        ->where('epr_po_approval_transaction.status', '!=', 0)
                        ->orderBy('epr_po_approval_transaction.id', 'asc')
                        ->limit(1)
                        ->get();
                    $str = '';
                    foreach ($data as $key => $value) {
                        $statu = '';
                        if ($value->status == 0)
                            $statu = 'waiting';
                        else if ($value->status == 1)
                            $statu = 'Approval Pending';
                        else if ($value->status == 2)
                            $statu = 'Approved';
                        else if ($value->status == 3)
                            $statu = 'Resubmited';
                        else if ($value->status == 4)
                            $statu = 'rejected';

                        $str .= $value->name . '(' . $statu . ')</br>';
                    }
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return view('procurement.po.list');
    }
    public function listDepartment(Request $request)
    {
        if ($request->ajax()) {

            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->whereIn('epr_po.status',  [2, 5])->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = PoApprovalTransactionModel::select('epr_po_approval_transaction.status', 'users.name')
                        ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                        ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                        ->where('epr_po_approval_transaction.po_id', '=', $row->id)
                        ->where('epr_po_approval_transaction.status', '!=', 0)
                        ->orderBy('epr_po_approval_transaction.id', 'asc')
                        ->limit(1)
                        ->get();
                    $str = '';
                    foreach ($data as $key => $value) {
                        $statu = '';
                        if ($value->status == 0)
                            $statu = 'waiting';
                        else if ($value->status == 1)
                            $statu = 'Approval Pending';
                        else if ($value->status == 2)
                            $statu = 'Approved';
                        else if ($value->status == 3)
                            $statu = 'Resubmited';
                        else if ($value->status == 4)
                            $statu = 'rejected';

                        $str .= $value->name . '(' . $statu . ')</br>';
                    }
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }
    public function listPersonal(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('epr_po.status',  6)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = PoApprovalTransactionModel::select('epr_po_approval_transaction.status', 'users.name')
                        ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                        ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                        ->where('epr_po_approval_transaction.po_id', '=', $row->id)
                        ->where('epr_po_approval_transaction.status', '!=', 0)
                        ->orderBy('epr_po_approval_transaction.id', 'asc')
                        ->limit(1)
                        ->get();
                    $str = '';
                    foreach ($data as $key => $value) {
                        $statu = '';
                        if ($value->status == 0)
                            $statu = 'waiting';
                        else if ($value->status == 1)
                            $statu = 'Approval Pending';
                        else if ($value->status == 2)
                            $statu = 'Approved';
                        else if ($value->status == 3)
                            $statu = 'Resubmited';
                        else if ($value->status == 4)
                            $statu = 'rejected';

                        $str .= $value->name . '(' . $statu . ')</br>';
                    }
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }
    public function listProject(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('epr_po.status',  4)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('heyrarchy', function ($row) {
                if (($row->status != 0) && ($row->status != 1)) {
                    $data = PoApprovalTransactionModel::select('epr_po_approval_transaction.status', 'users.name')
                        ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                        ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                        ->where('epr_po_approval_transaction.po_id', '=', $row->id)
                        ->where('epr_po_approval_transaction.status', '!=', 0)
                        ->orderBy('epr_po_approval_transaction.id', 'asc')
                        ->limit(1)
                        ->get();
                    $str = '';
                    foreach ($data as $key => $value) {
                        $statu = '';
                        if ($value->status == 0)
                            $statu = 'waiting';
                        else if ($value->status == 1)
                            $statu = 'Approval Pending';
                        else if ($value->status == 2)
                            $statu = 'Approved';
                        else if ($value->status == 3)
                            $statu = 'Resubmited';
                        else if ($value->status == 4)
                            $statu = 'rejected';

                        $str .= $value->name . '(' . $statu . ')</br>';
                    }
                } else
                    $str = '--';
                return $str;
            })->rawColumns(['action', 'heyrarchy']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }


    public function closedPo(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('epr_po.po_closed',  1)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('procurement.po.listClosed');
    }

    public function purchaseIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'epr_po.supplier_id', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status', DB::raw('count(*) as po_count'))
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->groupBy('epr_po.supplier_id')
                ->get();
            // ->where('epr_po.po_closed',  1)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('items', function ($row) {
                $qry = EprPoProductsModel::leftjoin('epr_po', 'epr_po_products.epr_po_id', '=', 'epr_po.id')
                    ->where('epr_po.supplier_id', $row->supplier_id); //->get();
                $totalItems = $qry->count();
                $totalProducts = $qry->sum('quantity');
                $itemsPurchased = DB::table('purchase_index_products')
                    ->leftjoin('epr_po', 'purchase_index_products.po_id', '=', 'epr_po.id')
                    ->where('epr_po.supplier_id', $row->supplier_id)->sum('purchased');
                $out = array(
                    'totalItems' => $totalItems,
                    'totalProducts' => $totalProducts,
                    'itemsPurchased' => $itemsPurchased,
                    'itemsBalance' => $totalProducts - $itemsPurchased
                );
                return $out;
            })->rawColumns(['action', 'items']);
            return  $dtTble->make(true);
        } else
            return view('procurement.po.purchaseIndex');
    }


    public function purchaseIndexSpecific(Request $request)
    {
        $supplerId = $request->id;
        if ($request->ajax()) {
            $data = EprPoModel::select('epr_po.id', 'epr_po.epr_id', DB::raw("DATE_FORMAT(epr_po.po_date, '%d-%m-%Y') as po_date"), 'users.name', 'qcrm_supplier.sup_name', 'material_request.request_type', 'material_request.request_against', 'ma_category.name as mr_category', 'qcrm_customer_details.cust_name as client', 'qprojects_projects.projectname as project', 'epr_po.status')
                ->leftjoin('material_request', 'epr_po.epr_id', '=', 'material_request.id')
                ->leftjoin('users', 'material_request.user_id', '=', 'users.id')
                ->leftjoin('ma_category', 'material_request.mr_category', '=', 'ma_category.id')
                ->leftjoin('qcrm_customer_details', 'material_request.client', '=', 'qcrm_customer_details.id')
                ->leftJoin('qprojects_projects', 'material_request.project', 'qprojects_projects.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->where('epr_po.supplier_id', $supplerId)
                ->get();
            // ->where('epr_po.po_closed',  1)->get();
            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->addColumn('items', function ($row) {
                $qry = EprPoProductsModel::where('epr_po_id', $row->id); //->get();
                $totalItems = $qry->count();
                $totalProducts = $qry->sum('quantity');
                $itemsPurchased = DB::table('purchase_index_products')->where('po_id', $row->id)->sum('purchased');
                $out = array(
                    'totalItems' => $totalItems,
                    'totalProducts' => $totalProducts,
                    'itemsPurchased' => $itemsPurchased,
                    'itemsBalance' => $totalProducts - $itemsPurchased
                );
                return $out;
            })->rawColumns(['action', 'items']);
            return  $dtTble->make(true);
        } else {
            $supplier = DB::table('qcrm_supplier')->select('sup_name')->where('id', $supplerId)->first();
            return view('procurement.po.purchaseIndexSpecific', compact('supplerId', 'supplier'));
        }
    }

    public function purchaseIndexPdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprPoModel::select(
            'epr_po.id',
            'epr_po.epr_id',
            'epr_po.po_date',
            'epr_po.po_valid_till',
            'epr_po.delivery_terms',
            'epr_po.notes',
            'epr_po.totalamount',
            'epr_po.totalvatamount',
            'epr_po.grandtotalamount',
            'qcrm_termsandconditions.description',
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
            'users.name as created_name',
            'users.email as created_email',
            'users.phone as created_phone',
            'epr_po.status'
        )
            ->leftjoin('users', 'epr_po.user_id', '=', 'users.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);

        // $products = EprPoProductsModel::select('epr_po_products.*', 'qinventory_product_unit.unit_name')
        //     ->leftjoin('qinventory_product_unit', 'epr_po_products.unit', '=', 'qinventory_product_unit.id')
        //     ->where('epr_po_id', '=', $id)->get();

        $products = EprPoProductsModel::select('epr_po_products.id', 'epr_po_products.itemname', 'epr_po_products.description', 'qinventory_product_unit.unit_name', 'epr_po_products.quantity', 'purchase_index_products.purchased')->where('epr_po_id', '=', $id)
            ->leftJoin('qinventory_product_unit', 'epr_po_products.unit', 'qinventory_product_unit.id')
            ->leftJoin('purchase_index_products', 'epr_po_products.id', 'purchase_index_products.epr_po_product_id')
            ->get();
        $products = $products->map(function ($value, $key) {
            $outArray = array(
                'po_product_id' => $value->id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit_name,
                'quantity' => $value->quantity,
                'purchased' => $value->purchased,
                'balance' => $value->quantity - $value->purchased,

            );
            return $outArray;
        });

        $approvalLevel = array();

        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'PO ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->po_date));
        $pdf = PDF::loadView('procurement.po.previewPurchaseIndex', compact('mainData', 'products', 'approvalLevel', 'branchsettings'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');
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
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where(
            'client',
            '=',
            $MaterialRequest->client
        )->get();

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = MaterialRequestProductsModel::where('mr_id', '=', $id)->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $outArray = array(
                'id' => $value->id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'epr_quantity' => $value->quantity,
                'po_assigned_qty' => $value->po_assigned_qty,
                'balance' => $value->quantity - $value->po_assigned_qty,
                'quantity' => 0,
                'rate' => 0,
                'amount' => 0,
                'rdiscount' => 0,
                'vatamount' => 0,
                'totalamount' => 0,
            );
            return $outArray;
        });

        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.po.generate', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'productlist', 'supplier', 'vatlist',  'projects'));
    }

    public function save(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $data = array(
                    'epr_id' => $request->epr_id,
                    'po_date' => Carbon::parse($request->po_date)->format('Y-m-d  h:i'),
                    'po_valid_till' => Carbon::parse($request->po_valid_till)->format('Y-m-d  h:i'),
                    'delivery_terms' => $request->delivery_terms,
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
                );
                $postID = '';
                if ($postID == '')
                    $data['user_id'] = $useasr_id;

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


    public function editView(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprPoModel::select('epr_po.*', 'epr_rfq.id as rfq_id', 'epr_rfq.quot_date as rfq_quot_date')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->find($id);
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where(
            'client',
            '=',
            $MaterialRequest->client
        )->get();
        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprPoProductsModel::where('epr_po_id', '=', $id)->get();
        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $product = MaterialRequestProductsModel::find($value->epr_product_id);
            $outArray = array(
                'id' => $value->id,
                'epr_product_id' => $value->epr_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'epr_quantity' => $product->quantity,
                'po_assigned_qty' => $product->po_assigned_qty - $value->quantity, //$value->po_assigned_qty,
                'balance' => $product->quantity - $product->po_assigned_qty,
                'quantity' => $value->quantity,
                'rate' => $value->rate,
                'amount' => $value->amount,
                'discont' => $value->discont,
                'vat' => $value->vat,
                'vat_amount' => $value->vat_amount,
                'total' => $value->total,
            );
            return $outArray;
        });
        // $reqProduct = $MaterialRequestProducts->map(function ($value, $key) {
        //     $product = MaterialRequestProductsModel::find($value->epr_product_id);
        //     $actualQty = $product->quantity;
        //     $poCreatedProduct = EprPoProductsModel::where('epr_product_id', '=', $value->epr_product_id)
        //         ->where('id', '!=', $value->id)
        //         ->sum('quantity');
        //     $outArray = array(
        //         'actualQty' => $actualQty,
        //         'balance' => $actualQty - $poCreatedProduct
        //     );
        //     return $outArray;
        // });
        // 'reqProduct',

        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.po.edit', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'productlist', 'supplier', 'vatlist',  'projects'));
    }

    public function Update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                $postID = $request->id;

                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);

                $data = array(
                    'epr_id' => $request->id,
                    'po_date' => Carbon::parse($request->po_date)->format('Y-m-d  h:i'),
                    'po_valid_till' => Carbon::parse($request->po_valid_till)->format('Y-m-d  h:i'),
                    'delivery_terms' => $request->delivery_terms,
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

                $epr_id = EprPoModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $epr_id->id;
                EprPoProductsModel::where('epr_po_id', '=', $mrId)->delete();
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
                // $out = array('status' => 1, 'data' => $mrId);
                // echo json_encode($out);
            });
            $out = array(
                'status' => 1,
                'msg' => 'Saved Success',
                // 'data' => $mrId
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


    public function view(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprPoModel::find($id);
        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where(
            'client',
            '=',
            $MaterialRequest->client
        )->get();
        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprPoProductsModel::where('epr_po_id', '=', $id)->get();

        $reqProduct = $MaterialRequestProducts->map(function ($value, $key) {
            $product = MaterialRequestProductsModel::find($value->epr_product_id);
            $actualQty = $product->quantity;
            $poCreatedProduct = EprPoProductsModel::where('epr_product_id', '=', $value->epr_product_id)
                ->where('id', '!=', $value->id)
                ->sum('quantity');
            $outArray = array(
                'actualQty' => $actualQty,
                'balance' => $actualQty - $poCreatedProduct
            );
            return $outArray;
        });

        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.po.view', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'productlist', 'supplier', 'vatlist', 'reqProduct', 'projects'));
    }
    public function pdf(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprPoModel::select(
            'epr_po.id',
            'epr_po.epr_id',
            'epr_po.po_date',
            'epr_po.request_type',
            'epr_po.po_valid_till',
            'epr_po.delivery_terms',
            'epr_po.notes',
            'epr_po.totalamount',
            'epr_po.totalvatamount',
            'epr_po.grandtotalamount',
            'qcrm_termsandconditions.description',
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
            'users.name as created_name',
            'users.email as created_email',
            'users.phone as created_phone',
            'epr_rfq.supp_quot_id',
            'qprojects_projects.projectname',
            'epr_po.status'
        )
            ->leftjoin('users', 'epr_po.user_id', '=', 'users.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->leftjoin('qprojects_projects', 'epr_po.project', '=', 'qprojects_projects.id')
            ->find($id);

        $products = EprPoProductsModel::select('epr_po_products.*', 'qinventory_product_unit.unit_name')
            ->leftjoin('qinventory_product_unit', 'epr_po_products.unit', '=', 'qinventory_product_unit.id')
            ->where('epr_po_id', '=', $id)->get();

        if (($mainData->status != 1) || $mainData->status != 0) {
            $approvalLevel = PoApprovalTransactionModel::select('epr_po_approval_transaction.updated_at', 'epr_po_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'epr_po_approval_transaction.status')
                ->leftjoin('poworkflow', 'epr_po_approval_transaction.poworkflow_id', '=', 'poworkflow.id')
                ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('epr_po_approval_transaction.po_id', '=', $mainData->id)
                ->where('epr_po_approval_transaction.status', '!=', 0)
                ->where('epr_po_approval_transaction.status', '!=', 1)
                ->get();

            $approvalLevel = $approvalLevel->map(function ($value, $key) {
                if ($value->status_changed_by != null) {
                    $user = $this->getDescUser($value->status_changed_by);
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $user->name,
                        'sign' => $user->sign,
                        'designation' => $user->designation,
                        'department' => $user->department,
                        'status' => $value->status,
                    );
                } else {
                    $outArray = array(
                        'updated_at' => $value->updated_at,
                        'name' => $value->name,
                        'sign' => $value->sign,
                        'designation' => $value->designation,
                        'department' => $value->department,
                        'status' => $value->status,
                    );
                }
                return $outArray;
            });
        } else
            $approvalLevel = array();

        $totalDigits =  $this->numberToWord($mainData->grandtotalamount);

        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'PO ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->po_date));
        $pdf = PDF::loadView('procurement.po.preview', compact('mainData', 'products', 'approvalLevel', 'branchsettings', 'totalDigits'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        $pdf->getMpdf()->AddPage(/*...*/);
        return $pdf->stream($pdfId . '.pdf');
    }

    public function pdfNoSign(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprPoModel::select(
            'epr_po.id',
            'epr_po.epr_id',
            'epr_po.po_date',
            'epr_po.request_type',
            'epr_po.po_valid_till',
            'epr_po.delivery_terms',
            'epr_po.notes',
            'epr_po.totalamount',
            'epr_po.totalvatamount',
            'epr_po.grandtotalamount',
            'qcrm_termsandconditions.description',
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
            'users.name as created_name',
            'users.email as created_email',
            'users.phone as created_phone',
            'epr_rfq.supp_quot_id',
            'qprojects_projects.projectname',
            'epr_po.status'
        )
            ->leftjoin('users', 'epr_po.user_id', '=', 'users.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->leftjoin('qprojects_projects', 'epr_po.project', '=', 'qprojects_projects.id')
            ->find($id);

        $products = EprPoProductsModel::select('epr_po_products.*', 'qinventory_product_unit.unit_name')
            ->leftjoin('qinventory_product_unit', 'epr_po_products.unit', '=', 'qinventory_product_unit.id')
            ->where('epr_po_id', '=', $id)->get();
        $totalDigits =  $this->numberToWord($mainData->grandtotalamount);
        $approvalLevel = array();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'PO ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->po_date));
        $pdf = PDF::loadView('procurement.po.previewNosign', compact('mainData', 'products', 'approvalLevel', 'branchsettings', 'totalDigits'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');
    }

    public function pdfPoTechnical(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = EprPoModel::select(
            'epr_po.id',
            'epr_po.epr_id',
            'epr_po.po_date',
            'epr_po.request_type',
            'epr_po.po_valid_till',
            'epr_po.delivery_terms',
            'epr_po.notes',
            'epr_po.totalamount',
            'epr_po.totalvatamount',
            'epr_po.grandtotalamount',
            'qcrm_termsandconditions.description',
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
            'users.name as created_name',
            'users.email as created_email',
            'users.phone as created_phone',
            'epr_rfq.supp_quot_id',
            'qprojects_projects.projectname',
            'epr_po.status'
        )
            ->leftjoin('users', 'epr_po.user_id', '=', 'users.id')
            ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
            ->leftjoin('qcrm_termsandconditions', 'epr_po.terms', '=', 'qcrm_termsandconditions.id')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')
            ->leftjoin('qprojects_projects', 'epr_po.project', '=', 'qprojects_projects.id')
            ->find($id);

        $products = EprPoProductsModel::select('epr_po_products.*', 'qinventory_product_unit.unit_name')
            ->leftjoin('qinventory_product_unit', 'epr_po_products.unit', '=', 'qinventory_product_unit.id')
            ->where('epr_po_id', '=', $id)->get();
        $totalDigits =  $this->numberToWord($mainData->grandtotalamount);
        $approvalLevel = array();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'PO ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->po_date));
        $pdf = PDF::loadView('procurement.po.previewTechnical', compact('mainData', 'products', 'approvalLevel', 'branchsettings', 'totalDigits'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');
    }

    public function getDescUser($id)
    {
        return User::select('users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')->where('users.id', $id)->first();
    }

    public function resubmit(Request $request)
    {
        $id = $request->id;
        $branch = Session::get('branch');
        $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
        $materialCategory = MaterialCategoryModel::orderby('id', 'desc')->where('del_flag', 1)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
        $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
        $MaterialRequest = EprPoModel::select('epr_po.*', 'epr_rfq.id as rfq_id', 'epr_rfq.quot_date as rfq_quot_date')
            ->leftjoin('epr_rfq', 'epr_po.rfq_id', '=', 'epr_rfq.id')->find($id);

        $projects = DB::table('qprojects_projects')->select('projectname', 'id')->where(
            'client',
            '=',
            $MaterialRequest->client
        )->get();

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $MaterialRequestProducts = EprPoProductsModel::where('epr_po_id', '=', $id)->get();

        $MaterialRequestProducts = $MaterialRequestProducts->map(function ($value, $key) {
            $product = MaterialRequestProductsModel::find($value->epr_product_id);
            $outArray = array(
                'id' => $value->id,
                'epr_product_id' => $value->epr_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit' => $value->unit,
                'epr_quantity' => $product->quantity,
                'po_assigned_qty' => $product->po_assigned_qty - $value->quantity, //$value->po_assigned_qty,
                'balance' => $product->quantity - $product->po_assigned_qty,
                'quantity' => $value->quantity,
                'rate' => $value->rate,
                'amount' => $value->amount,
                'discont' => $value->discont,
                'vat' => $value->vat,
                'vat_amount' => $value->vat_amount,
                'total' => $value->total,
            );
            return $outArray;
        });


        $supplier   = DB::table('qcrm_supplier')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
        return view('procurement.po.resubmit', compact('materialCategory', 'unitlist', 'termslist', 'customers', 'MaterialRequest', 'MaterialRequestProducts', 'productlist', 'supplier', 'vatlist',  'projects'));
    }

    public function resubmitUpdate(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $useasr_id = Auth::user()->id;
                $branch = Session::get('branch');
                if ($request->id != '') {
                    $postID = $request->id;
                    $this->backupOldRequest($postID);
                } else
                    return 'false';

                if ($request->deleted_elements != '')
                    $this->trashedItemUpdate($postID, $request->deleted_elements);

                $data = array(
                    'epr_id' => $request->epr_id,
                    'version' => $request->version + 1,
                    'po_date' => Carbon::parse($request->po_date)->format('Y-m-d  h:i'),
                    'po_valid_till' => Carbon::parse($request->po_valid_till)->format('Y-m-d  h:i'),
                    'delivery_terms' => $request->delivery_terms,
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
                    'user_id' => $useasr_id,
                    'status' => 5,
                );

                $epr_id = EprPoModel::updateOrCreate(['id' => $postID], $data);
                $mrId = $epr_id->id;
                EprPoProductsModel::where('epr_po_id', '=', $mrId)->delete();
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
                $this->sendReq($postID);
                // $out = array('status' => 1, 'data' => $mrId);
                // echo json_encode($out);
            });
            $out = array(
                'status' => 1,
                'msg' => 'Saved Success',
                // 'data' => $mrId
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

    public function backupOldRequest($eprId)
    {
        $materialReq = EprPoModel::find($eprId);
        $data = array(
            'version' => $materialReq->version,
            'quotedate' => $materialReq->quotedate,
            'dateofsupply' => $materialReq->dateofsupply,
            'request_type' => $materialReq->request_type,
            'mr_category' => $materialReq->mr_category,
            'request_priority' => $materialReq->request_priority,
            'request_against' => $materialReq->request_against,
            'client' => $materialReq->client,
            'project' => $materialReq->project,
            'internalreference' => $materialReq->internalreference,
            'notes' => $materialReq->notes,
            'terms' => $materialReq->terms,
            'user_id' => $materialReq->user_id
        );
        $postID = '';
        $inserted = EprPoRevisedModel::updateOrCreate(['id' => $postID], $data);
        $newMrId = $inserted->id;
        $products = EprPoProductsModel::where('epr_po_id', $eprId)->get();
        foreach ($products as $key => $value) {
            $prData = array(
                'epr_po_id' => $newMrId,
                'epr_product_id' => $value->epr_product_id,
                'itemname' => $value->itemname,
                'description' => $value->description,
                'unit'         => $value->unit,
                'quantity'   => $value->quantity,
                'rate' => $value->rate,
                'amount' => $value->amount,
                'discont' => $value->discont,
                'vat' => $value->vat,
                'vat_amount' => $value->vat_amount,
                'total' => $value->total,
                'branch' => $value->branch
            );
            DB::table('epr_po_products_revised')->insert($prData);
        }
        $this->sendReq($postID);
        return 'true';
    }


    public function send(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $createdBy = Auth::user()->id;
                $id = $request->id;
                $materialReq = EprPoModel::find($id);
                if ($materialReq) {
                    $materialReq->mr_category;
                    $workflow =  PoWorkflowModel::select('poworkflow.id', 'users.email', 'users.name')
                        ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                        ->where('poworkflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
                    $i = 0;
                    foreach ($workflow as $key => $value) {
                        $status = ($key == 0) ? 1 : 0;
                        $data = array(
                            'poworkflow_id' => $value->id,
                            'po_id' => $id,
                            'created_by' => $createdBy,
                            'status' => $status
                        );
                        $tData = PoApprovalTransactionModel::create($data);
                        if ($status == 1) {
                            $toMailId = $value->email;
                            $this->sendMail('po', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                        }
                        $i++;
                    }
                    if ($i != 0) {
                        $data = array('status' => 2);
                        $materialReq->update($data);
                        $out = array(
                            'status' => 1,
                            'msg' => 'success',
                        );
                    } else {
                        $out = array(
                            'status' => 0,
                            'msg' => 'PO Sysnthesis Not Found Contact Admin !!',
                        );
                    }
                    echo json_encode($out);
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'error Please Try After Some time',
                    );
                    echo json_encode($out);
                }
            });
            // $out = array(
            //     'status' => 1,
            //     'msg' => 'Saved Success',
            //     // 'data' => $mrId
            // );
            // echo json_encode($out);
        } catch (\Throwable $e) {
            $out = array(
                'error' => $e,
                'status' => 0,
                'msg' => ' Error While Resend'
            );
            echo json_encode($out);
        }
    }

    public function sendReq($id)
    {
        $createdBy = Auth::user()->id;
        $materialReq = EprPoModel::find($id);
        if ($materialReq) {
            $materialReq->mr_category;
            $workflow =  PoWorkflowModel::select('poworkflow.id', 'users.email', 'users.name')
                ->leftjoin('users', 'poworkflow.user_id', '=', 'users.id')
                ->where('poworkflow.cat_id', '=', $materialReq->mr_category)->orderBy('priority', 'asc')->get();
            foreach ($workflow as $key => $value) {
                $status = ($key == 0) ? 1 : 0;
                $data = array(
                    'poworkflow_id' => $value->id,
                    'po_id' => $id,
                    'created_by' => $createdBy,
                    'status' => $status
                );
                $tData = PoApprovalTransactionModel::create($data);
                if ($status == 1) {
                    $toMailId = $value->email;
                    $this->sendMail('po', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                }
            }
            return 1;
        }
    }

    public function getPo(Request $request)
    {
        $supplier_id = $request->id;
        $poid = EprPoModel::where('supplier_id', '=', $supplier_id)->where('po_status', '=', 3)->select('id')->get();
        $out = array(
            'status' => 1,
            'data' => $poid
        );
        echo json_encode($out);
    }

    public function updateEprQty($id, $qty)
    {
        MaterialRequestProductsModel::find($id)->update(['po_assigned_qty' => $qty]);
    }

    public function trashedItemUpdate($postID, $deleted_elements)
    {
        $elements = explode("~", $deleted_elements);
        foreach ($elements as $key => $value) {
            $product = EprPoProductsModel::where('epr_po_id', $postID)->where('epr_product_id', $value)->first();
            if ($product) {
                $product->quantity;
                $ifFind = MaterialRequestProductsModel::find($value);
                if ($ifFind)
                    $ifFind->decrement('po_assigned_qty', $product->quantity);
            }
        }
    }

    public function sendMail($docType = 'po', $docId, $toMailId, $transactionId, $userName, $date)
    {
        $token = Str::random(64);
        $data = [
            'email' => $toMailId,
            'doc_type' => $docType,
            'doc_id' => $docId,
            'transaction_id' => $transactionId,
            'token' => $token,
            'created_at' => Carbon::now(),
        ];
        DB::table('email_verify_keys')->insert($data);
        $data['userName'] = $userName;
        $data['document_name'] = 'PO';
        $data['document'] = 'PO';
        $data['date'] = $date;
        Mail::to($toMailId)->queue(new ActionRequired($data));
    }

    public function numberToWord($num = '')
    {
        $num    = (string) ((int) $num);

        if ((int) ($num) && ctype_digit($num)) {
            $words  = array();

            $num    = str_replace(array(',', ' '), '', trim($num));

            $list1  = array(
                '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
                'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
                'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
            );

            $list2  = array(
                '', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',
                'seventy', 'eighty', 'ninety', 'hundred'
            );

            $list3  = array(
                '', 'thousand', 'million', 'billion', 'trillion',
                'quadrillion', 'quintillion', 'sextillion', 'septillion',
                'octillion', 'nonillion', 'decillion', 'undecillion',
                'duodecillion', 'tredecillion', 'quattuordecillion',
                'quindecillion', 'sexdecillion', 'septendecillion',
                'octodecillion', 'novemdecillion', 'vigintillion'
            );

            $num_length = strlen($num);
            $levels = (int) (($num_length + 2) / 3);
            $max_length = $levels * 3;
            $num    = substr('00' . $num, -$max_length);
            $num_levels = str_split($num, 3);

            foreach ($num_levels as $num_part) {
                $levels--;
                $hundreds   = (int) ($num_part / 100);
                $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
                $tens       = (int) ($num_part % 100);
                $singles    = '';

                if ($tens < 20) {
                    $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                } else {
                    $tens = (int) ($tens / 10);
                    $tens = ' ' . $list2[$tens] . ' ';
                    $singles = (int) ($num_part % 10);
                    $singles = ' ' . $list1[$singles] . ' ';
                }
                $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
            }
            $commas = count($words);
            if ($commas > 1) {
                $commas = $commas - 1;
            }

            $words  = implode(', ', $words);

            $words  = trim(str_replace(' ,', ',', ucwords($words)), ', ');
            if ($commas) {
                $words  = str_replace(',', ' and', $words);
            }

            return $words;
        } else if (!((int) $num)) {
            return 'Zero';
        }
        return '';
    }
}

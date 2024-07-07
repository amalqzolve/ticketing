<?php

namespace App\Http\Controllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Boq;
use Session;
use DB;
use DataTables;
use App\SalesmanDetailModel;
use App\Tender\SalesProposalModel;
use App\Tender\SalesOrderModel;
use App\Tender\SalesOrderLebalsModel;
use App\Tender\SalesProposalItemsModel;
use App\Tender\SalesProposalCategoryModel;
use App\projects\LabelModel;
use App\crm\CustomerModel;
use App\projects\ProjectCategoryModel;
use App\projects\ProjectModel;
use Auth;
use Carbon\Carbon;
use App\settings\BranchSettingsModel;



class SalesOrderController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesOrderModel::select('sales_orders.id', 'sales_orders.projectname', DB::raw("DATE_FORMAT(sales_orders.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(sales_orders.enddate, '%d-%m-%Y') as enddate"), 'sales_orders.clients_po_number', 'sales_orders.sovalue', DB::raw("DATE_FORMAT(sales_orders.sodate, '%d-%m-%Y') as sodate"), 'users.name as created_by', 'qcrm_customer_details.cust_name as cust_name')
                ->leftjoin('users', 'sales_orders.user_id', '=', 'users.id')
                ->leftJoin('qcrm_customer_details', 'sales_orders.client_id', 'qcrm_customer_details.id')
                ->where('sales_orders.project_conversion_flg', 0)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('tenders.salesOrder.index');
    }

    public function indexConverted(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesOrderModel::select('sales_orders.id', 'sales_orders.projectname', DB::raw("DATE_FORMAT(sales_orders.startdate, '%d-%m-%Y') as startdate"), DB::raw("DATE_FORMAT(sales_orders.enddate, '%d-%m-%Y') as enddate"), 'sales_orders.clients_po_number', 'sales_orders.sovalue', DB::raw("DATE_FORMAT(sales_orders.sodate, '%d-%m-%Y') as sodate"), 'users.name as converted_by', 'qcrm_customer_details.cust_name as cust_name')
                ->leftjoin('users', 'sales_orders.project_converted_by', '=', 'users.id')
                ->leftJoin('qcrm_customer_details', 'sales_orders.client_id', 'qcrm_customer_details.id')
                ->where('sales_orders.project_conversion_flg', 1)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return null;
    }



    public function add(Request $request)
    {
        if (!$request->ajax()) {
            $id = $request->id;
            $branch = Session::get('branch');
            $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
            $prevData =  SalesProposalModel::where('id', $id)->get();
            $labels = LabelModel::select('*')->where('del_flag', 1)->get();
            $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
            $category = ProjectCategoryModel::select('id', 'name')->get();
            $salesOrderLebals = array();
            return view('tenders.salesOrder.add', compact(
                'termslist',
                'prevData',
                'customers',
                'labels',
                'category',
                'id'
            ));
        } else
            return NULL;
    }
    public function addBlank(Request $request)
    {
        if (!$request->ajax()) {
            $id = $request->id;
            $branch = Session::get('branch');
            $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
            $prevData =  SalesProposalModel::where('id', $id)->get();
            $labels = LabelModel::select('*')->where('del_flag', 1)->get();
            $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
            $category = ProjectCategoryModel::select('id', 'name')->get();
            return view('tenders.salesOrder.addBlank', compact('termslist', 'prevData', 'customers', 'labels', 'category'));
        } else
            return NULL;
    }



    public function save(Request $request)
    {
        if ($request->ajax()) {

            try {
                DB::transaction(function () use ($request) {

                    $branch = Session::get('branch');
                    $currentUser = Auth::user()->id; //current user Id
                    $inArray = array(
                        'sales_proposal_id' => $request->sales_proposal_id,
                        'client_id' => $request->client_id,
                        'poject_category_id' => $request->poject_category_id,
                        'projectname' => $request->projectname,
                        'description' => $request->description,
                        'startdate' => Carbon::parse($request->startdate)->format('Y-m-d  h:i'),
                        'enddate' => Carbon::parse($request->enddate)->format('Y-m-d  h:i'),
                        'clients_po_number' => $request->clients_po_number,
                        'salesorder' => $request->salesorder,
                        'sovalue' => $request->sovalue,
                        'sodate' => Carbon::parse($request->sodate)->format('Y-m-d  h:i'),
                        'internal_ref' => $request->internal_ref,
                        'notes' => $request->notes,
                        'branch' => $branch,
                        'user_id' => $currentUser,


                    );
                    $postID = null;
                    $salesOrder = SalesOrderModel::updateOrCreate(['id' => $postID], $inArray);

                    $labels = $request->labels;
                    foreach ($labels as $key => $value) {
                        $da = SalesOrderLebalsModel::create(array(
                            'sales_orders_id' => $salesOrder->id,
                            'label_id' => $value
                        ));
                    }

                    if ($request->sales_proposal_id != '')
                        SalesProposalModel::where('id', $request->sales_proposal_id)
                            ->update(['sales_order_generated_flg' => 1]);
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
                    'msg' => ' Error While Save'
                );
                echo json_encode($out);
            }
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $salesOrder = SalesOrderModel::select('id', 'sales_proposal_id')
                    ->where('id', $request->id)
                    ->first();
                $salesProposalId = $salesOrder->sales_proposal_id;
                SalesProposalModel::where('id', $salesProposalId)->update(array('sales_order_generated_flg' => 0));
                SalesOrderLebalsModel::where('sales_orders_id', $request->id)->delete();
                SalesOrderModel::where('id', $request->id)->delete();
            });
            $out = array(
                'status' => 1,
                'msg' => 'Deleted Success'
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

    public function convert(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $currentUser = Auth::user()->id; //current user Id
                    $id = $request->id;
                    $salesOrder = SalesOrderModel::find($id);
                    $salesOrderLebals = SalesOrderLebalsModel::select('label_id')->where('sales_orders_id', $id)->get();

                    $data = [
                        'client' => $salesOrder->client_id,
                        'projectname' => $salesOrder->projectname,
                        'description' => $salesOrder->description,
                        'startdate' => $salesOrder->startdate,
                        'enddate' => $salesOrder->enddate,
                        'poject_category_id' => $salesOrder->poject_category_id,
                        'ponumber' => $request->clients_po_number,
                        'povalue' => $salesOrder->sovalue,
                        'podate' => $salesOrder->sodate,
                        'internal_ref' => $salesOrder->internal_ref,
                        'notes' => $salesOrder->notes,
                        'branch' => $salesOrder->branch
                    ];
                    $postID = null;
                    $project = ProjectModel::updateOrCreate(['id' => $postID], $data);
                    $projectLbl = array();
                    foreach ($salesOrderLebals as $key => $value) {
                        $tempArray = array(
                            'projectid' => $project->id,
                            'labels' => $value->label_id,
                        );
                        array_push($projectLbl, $tempArray);
                    }
                    DB::table('qprojects_projects_labels')->insert($projectLbl);
                    $salesOrder->update(array('project_conversion_flg' => 1, 'project_converted_by' => $currentUser));
                });
                $out = array(
                    'status' => 1,
                    'msg' => 'Convertion Success'
                );
                echo json_encode($out);
            } catch (\Throwable $e) {
                $out = array(
                    'error' => $e,
                    'status' => 0,
                    'msg' => ' Error While Convert'
                );
                echo json_encode($out);
            }
        } else
            return NULL;
    }


    public function edit(Request $request)
    {
        if (!$request->ajax()) {
            $id = $request->id;
            $data = SalesProposalModel::find($id);
            if ($data) {
                $dataProducts = SalesProposalItemsModel::where('sales_proposal_id', $id)->get();
                $branch = Session::get('branch');
                $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
                $salesman = SalesmanDetailModel::all();
                $salesProposalCategory = SalesProposalCategoryModel::all();
                $boq = Boq::where('id', $data->boq_id)->first();
                $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
                return view('tenders.sales_proposal.edit', compact('termslist', 'salesman', 'salesProposalCategory', 'boq', 'vatlist', 'data', 'dataProducts'));
            }
        } else
            return NULL;
    }


    public function update(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    $currentUser = Auth::user()->id; //current user Id
                    $inArray = array(
                        'boq_id' => $request->boq_id,
                        'quotedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),
                        'valid_till' => Carbon::parse($request->valid_till)->format('Y-m-d  h:i'),
                        'sales_proposal_category_id' => $request->sales_proposal_category,
                        'salesman' => $request->salesman,
                        'attention' => $request->attention,
                        'file_data' => $request->fileData,
                        'reference' => $request->reference,
                        'internalreference' => $request->internalreference,
                        'notes' => $request->notes,
                        'terms' => $request->terms,
                        'linetotalamount' => $request->linetotalamount,
                        'estimated_amount' => $request->estimated_amount,
                        'net_amount' => $request->net_amount,
                        'profit_percenatge' => $request->profit_percenatge,
                        'profit_amount' => $request->profit_amount,
                        'total_amount_including_profit' => $request->total_amount_including_profit,
                        'discount_percenatge' => $request->discount_percenatge,
                        'discount_amount' => $request->discount_amount,
                        'amount_after_discount' => $request->amount_after_discount,
                        'vat_percenatge' => $request->vat_percenatge,
                        'vat_amount' => $request->vat_amount,
                        'grandtotalamount' => $request->grandtotalamount,
                        'user_id' => $currentUser,
                    );
                    $postID = $request->id;
                    $salesProposal = SalesProposalModel::updateOrCreate(['id' => $postID], $inArray);
                    SalesProposalItemsModel::where('sales_proposal_id', $postID)->delete();
                    if (isset($request->desc)) {
                        $a = $request->desc;
                        foreach ($a as $key => $value) {
                            $in_array = array(
                                'sales_proposal_id' => $salesProposal->id,
                                'item_name' => $request->item[$key],
                                'description' => $value,
                                'amount' => $request->amount[$key],
                                'user_id' => $currentUser
                            );
                            SalesProposalItemsModel::create($in_array);
                        }
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
                    'msg' => ' Error While Save'
                );
                echo json_encode($out);
            }
        }
    }




    public function pdf(Request $request)
    {

        $id = $request->id;
        $branch = Session::get('branch');
        $mainData = SalesProposalModel::select(
            'sales_proposal.id',
            'sales_proposal.quotedate',
            'sales_proposal.valid_till',
            'sales_proposal.attention',
            'sales_proposal.reference',
            'sales_proposal.internalreference',
            'sales_proposal.notes',
            'sales_proposal.linetotalamount',
            'sales_proposal.estimated_amount',
            'sales_proposal.net_amount',
            'sales_proposal.profit_percenatge',
            'sales_proposal.profit_amount',
            'sales_proposal.total_amount_including_profit',
            'sales_proposal.discount_percenatge',
            'sales_proposal.discount_amount',
            'sales_proposal.amount_after_discount',
            'sales_proposal.vat_percenatge',
            'sales_proposal.vat_amount',
            'sales_proposal.grandtotalamount',
            'sales_proposal.status',
            'qcrm_termsandconditions.description',
            'users.name as created_name',
            'qcrm_salesman_details.name as salesman',
            'sales_proposal_category.name as category',
        )
            ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
            ->leftjoin('qcrm_salesman_details', 'sales_proposal.salesman', '=', 'qcrm_salesman_details.id')
            ->leftjoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', '=', 'sales_proposal_category.id')
            ->leftjoin('qcrm_termsandconditions', 'sales_proposal.terms', '=', 'qcrm_termsandconditions.id')
            ->find($id);

        $products = SalesProposalItemsModel::select('sales_proposal_items.*')
            ->where('sales_proposal_id', '=', $id)->get();

        if (($mainData->status != 1) || $mainData->status != 0) {
            $approvalLevel = SalesProposalApprovalTransactionModel::select('sales_proposal_approval_transaction.updated_at', 'sales_proposal_approval_transaction.status_changed_by', 'users.name', 'users.sign', 'users.designation', 'qcrm_department.name as department', 'sales_proposal_approval_transaction.status')
                ->leftjoin('sales_proposal_category_synthesis', 'sales_proposal_approval_transaction.sales_proposal_category_synthesis_id', '=', 'sales_proposal_category_synthesis.id')
                ->leftjoin('users', 'sales_proposal_category_synthesis.user_id', '=', 'users.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('sales_proposal_approval_transaction.sales_proposal_id', '=', $mainData->id)
                ->where('sales_proposal_approval_transaction.status', '!=', 0)
                ->where('sales_proposal_approval_transaction.status', '!=', 1)
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


        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdfId = 'PROP ' . $mainData->id . '_' . date('d-m-Y', strtotime($mainData->quotedate));
        $pdf = PDF::loadView('tenders.sales_proposal.preview', compact('mainData', 'products', 'approvalLevel', 'branchsettings'), array(),  [
            'title'      => $pdfId,
            'margin_top' => 0
        ]);
        return $pdf->stream($pdfId . '.pdf');
    }
}

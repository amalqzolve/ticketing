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
use App\Tender\SalesProposalItemsModel;
use App\Tender\SalesProposalCategoryModel;
use App\Tender\SalesProposalCategorySynthesisModel;
use App\Tender\SalesProposalApprovalTransactionModel;
use Auth;
use Carbon\Carbon;
use Mail;
use App\Mail\ActionRequired;
use App\User;
use PDF;
use Illuminate\Support\Str;
use App\settings\BranchSettingsModel;


class SalesProposalController extends Controller
{


    public function listTender(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesProposalModel::select('sales_proposal.id',  DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"), 'sales_proposal.status', 'sales_proposal.boq_id', 'sales_proposal.sales_order_generated_flg', 'users.name as created_by', 'qcrm_customer_details.cust_name as client_name', 'sales_proposal_category.name as category_name', 'boqs.tender_id', 'tenders.project_name')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')
                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')
                ->where('boqs.type', 1)
                ->where('sales_proposal.status', 1)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('tenders.sales_proposal.listingTender');
    }


    public function listTenderSend(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesProposalModel::select('sales_proposal.id',  DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"), 'sales_proposal.status', 'sales_proposal.boq_id', 'sales_proposal.sales_order_generated_flg', 'users.name as created_by', 'qcrm_customer_details.cust_name as client_name', 'sales_proposal_category.name as category_name', 'boqs.tender_id', 'tenders.project_name')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')

                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')
                ->where('boqs.type', 1)
                ->where('sales_proposal.status', 2)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }
    public function listTenderApproved(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesProposalModel::select('sales_proposal.id',  DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"), 'sales_proposal.status', 'sales_proposal.boq_id', 'sales_proposal.sales_order_generated_flg', 'users.name as created_by', 'qcrm_customer_details.cust_name as client_name', 'sales_proposal_category.name as category_name', 'boqs.tender_id', 'tenders.project_name')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')

                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')
                ->where('boqs.type', 1)
                ->where('sales_proposal.status', 6)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }

    public function listTenderRejected(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesProposalModel::select('sales_proposal.id',  DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"), 'sales_proposal.status', 'sales_proposal.boq_id', 'sales_proposal.sales_order_generated_flg', 'users.name as created_by', 'qcrm_customer_details.cust_name as client_name', 'sales_proposal_category.name as category_name', 'boqs.tender_id', 'tenders.project_name')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')

                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')
                ->where('boqs.type', 1)
                ->where('sales_proposal.status', 4)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }



    public function listProject(Request $request)
    {

        if ($request->ajax()) {
            $data = SalesProposalModel::select('sales_proposal.id',  DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"), 'sales_proposal.status', 'sales_proposal.boq_id', 'sales_proposal.sales_order_generated_flg', 'users.name as created_by', 'qcrm_customer_details.cust_name as client_name', 'sales_proposal_category.name as category_name', 'boqs.tender_id', 'tenders.project_name')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')

                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')
                ->where('boqs.type', 2)
                ->where('sales_proposal.status', 1)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return view('tenders.sales_proposal.listingProject');
    }

    public function listProjectSend(Request $request)
    {

        if ($request->ajax()) {
            $data = SalesProposalModel::select('sales_proposal.id',  DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"), 'sales_proposal.status', 'sales_proposal.boq_id', 'sales_proposal.sales_order_generated_flg', 'users.name as created_by', 'qcrm_customer_details.cust_name as client_name', 'sales_proposal_category.name as category_name', 'boqs.tender_id', 'tenders.project_name')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')

                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')
                ->where('boqs.type', 2)
                ->where('sales_proposal.status', 2)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }

    public function listProjectApproved(Request $request)
    {

        if ($request->ajax()) {
            $data = SalesProposalModel::select('sales_proposal.id',  DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"), 'sales_proposal.status', 'sales_proposal.boq_id', 'users.name as created_by', 'qcrm_customer_details.cust_name as client_name', 'sales_proposal_category.name as category_name', 'sales_proposal.sales_order_generated_flg', 'boqs.tender_id', 'tenders.project_name')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')

                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')
                ->where('boqs.type', 2)
                ->where('sales_proposal.status', 6)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }

    public function listProjectRejected(Request $request)
    {

        if ($request->ajax()) {
            $data = SalesProposalModel::select('sales_proposal.id',  DB::raw("DATE_FORMAT(sales_proposal.quotedate, '%d-%m-%Y') as quotedate"), DB::raw("DATE_FORMAT(sales_proposal.valid_till, '%d-%m-%Y') as valid_till"), 'sales_proposal.status', 'sales_proposal.boq_id', 'sales_proposal.sales_order_generated_flg', 'users.name as created_by', 'qcrm_customer_details.cust_name as client_name', 'sales_proposal_category.name as category_name', 'boqs.tender_id', 'tenders.project_name')
                ->leftjoin('users', 'sales_proposal.user_id', '=', 'users.id')
                ->leftJoin('sales_proposal_category', 'sales_proposal.sales_proposal_category_id', 'sales_proposal_category.id')
                ->leftjoin('boqs', 'sales_proposal.boq_id', '=', 'boqs.id')

                ->leftJoin('qcrm_customer_details', 'boqs.client', 'qcrm_customer_details.id')
                ->leftjoin('tenders', 'boqs.tender_id', '=', 'tenders.id')
                ->where('boqs.type', 2)
                ->where('sales_proposal.status', 4)->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action']);
            return  $dtTble->make(true);
        } else
            return NULL;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) {
            $id = $request->id;
            $branch = Session::get('branch');
            $termslist   = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('del_flag', 1)->where('branch', $branch)->get();
            $salesman = SalesmanDetailModel::all();
            $salesProposalCategory = SalesProposalCategoryModel::all();
            $boq = Boq::where('id', $id)->first();
            $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();

            if ($boq)
                return view('tenders.sales_proposal.add', compact('termslist', 'salesman', 'salesProposalCategory', 'boq', 'vatlist'));
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
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        }
    }


    public function save(Request $request)
    {
        if ($request->ajax()) {
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
            $postID = null;
            $salesProposal = SalesProposalModel::updateOrCreate(['id' => $postID], $inArray);
            if (isset($request->desc)) {
                // $a =  explode(",", $request->desc);
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
            $out = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($out);
        }
    }

    public function salesProposalUpload(Request $request)
    {
        $path = public_path('sales_proposal');
        //echo $path;
        //    if(File::exists($path)) {
        // echo $request->UniqueID;
        //     }else{
        // echo $request->UniqueID;        
        //         File::makeDirectory($path, $mode = 0777, true, true);
        //     }
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $data[] = $name;
            }
        }
        return back()->with('success', 'Data Your files has been successfully added');
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


    public function send(Request $request)
    {
        if ($request->ajax()) {
            $createdBy = Auth::user()->id;
            $id = $request->id;
            $reqData = SalesProposalModel::find($id);
            if ($reqData) {
                $workflow =  SalesProposalCategorySynthesisModel::select('sales_proposal_category_synthesis.id', 'users.email', 'users.name')
                    ->leftjoin('users', 'sales_proposal_category_synthesis.user_id', '=', 'users.id')
                    ->where('cat_id', '=', $reqData->sales_proposal_category_id)->orderBy('priority', 'asc')->get();
                $i = 0;
                foreach ($workflow as $key => $value) {
                    $status = ($key == 0) ? 1 : 0;
                    $data = array(
                        'sales_proposal_category_synthesis_id' => $value->id,
                        'sales_proposal_id' => $id,
                        'created_by' => $createdBy,
                        'status' => $status
                    );
                    $tData = SalesProposalApprovalTransactionModel::create($data);

                    if ($status == 1) {
                        $toMailId = $value->email;
                        $this->sendMail('PROPS', $id, $toMailId, $tData->id, $value->name, Carbon::now());
                    }

                    $i++;
                }
                if ($i != 0) {
                    $data = array('status' => 2);
                    $reqData->update($data);
                    $out = array(
                        'status' => 1,
                        'msg' => 'success',
                    );
                } else {
                    $out = array(
                        'status' => 0,
                        'msg' => 'Sysnthesis Not Found Contact Admin !!',
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
        } else
            return NULL;
    }

    public function sendMail($docType = 'PROPS', $docId, $toMailId, $transactionId, $userName, $date)
    {
        $token = Str::random(64);
        $data = [
            'email' => $toMailId,
            'doc_type' => $docType,
            'doc_id' => $docId,
            'transaction_id' => $transactionId,
            'token' => $token,
            'created_at' => Carbon::now()
        ];
        DB::table('email_verify_keys')->insert($data);

        $data['userName'] = $userName;
        $data['document_name'] = 'Sales Proposal';
        $data['document'] = 'PROPS';
        $data['date'] = $date;

        Mail::to($toMailId)->queue(new ActionRequired($data));
    }
    public function getDescUser($id)
    {
        return User::find($id);
    }
}

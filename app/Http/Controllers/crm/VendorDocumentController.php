<?php

namespace App\Http\Controllers\crm;

use App\crm\VendorDocument;
use App\crm\vendorskill;
use App\crm\vendor;
use DB;
use Illuminate\Http\Request;
use App\crm\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;
use App\crm\VendorGroupModel;
use App\crm\Vendor_documents_Model;
use App\crm\PaymentModel;
use Session;
use DataTables;
use Carbon\Carbon;
use App\settings\BranchSettingsModel;

class VendorDocumentController extends Controller
{
    public function index(Request $request)
    {
        $branch = Session::get('branch');
        $ta = 1;
        $te = 1;
        if ($request->ajax()) {
            $query  = DB::table('qcrm_vendors')->leftJoin('qcrm_vendors_documents', 'qcrm_vendors.id', '=', 'qcrm_vendors_documents.vendor_id')->leftJoin('qcrm_vendor_docs', 'qcrm_vendors.id', '=', 'qcrm_vendor_docs.vendorid')

                ->select('qcrm_vendors.vendor_name', 'qcrm_vendors.id', 'qcrm_vendors_documents.documents', 'qcrm_vendors_documents.vendor_id', DB::raw("DATE_FORMAT(qcrm_vendor_docs.expdate, '%d-%m-%Y') as expdate"))
                ->groupBy('qcrm_vendors.id')
                ->orderby('qcrm_vendors.id', 'desc');
            $query->where('qcrm_vendors.del_flag', 1);
            $data = $query->get();
            foreach ($data as $key => $value) {

                $value->exp = "";
                $value->ac = "";
                $value->total = "";
                $value->total = DB::table('qcrm_vendor_docs')->select('docname')->where('vendorid', $value->id)->where('del_flag', 1)->count();
                $cdate = date('Y-m-d');
                $value->exp = DB::table('qcrm_vendor_docs')->select('expdate')->where('vendorid', $value->id)->where('del_flag', 1)->where('expdate', '<', $cdate)->count();

                $value->ac = DB::table('qcrm_vendor_docs')->select('expdate')->where('vendorid', $value->id)->where('del_flag', 1)->where('expdate', '>=', $cdate)->count();
            }
            $count_filter = $query->count();
            $count_total = Vendor_documents_Model::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('crm.VendorDoc.index');
    }

    public function edit_vendor_documents()
    {
        $branch = Session::get('branch');

        $id = $_REQUEST['id'];
        $vendordocuments = Vendor_documents_Model::where('vendor_id', $id)->get();
        $payment_terms = PaymentModel::where('branch', $branch)->get();
        $unq_id = uniqid();
        $docs = DB::table('qcrm_vendor_docs')->select('*', DB::raw("DATE_FORMAT(qcrm_vendor_docs.expdate, '%d-%m-%Y') as expdate1"))->where('vendorid', $id)->get();
        // dd($vendordocuments);
        return view('crm.VendorDoc.vendor_document_edit', ['data' => $vendordocuments], compact('id', 'payment_terms', 'unq_id', 'branch', 'docs'));
    }
    //vendor document details pdf

    public function vendor_docpdf(Request $request)
    {
        $branch = Session::get('branch');

        $id = $request->id;
        $vendor = vendor::where('id', $id)->limit(1)
            ->first();
        // dd($vendor->vendor_name);
        $vendordocuments = Vendor_documents_Model::where('vendor_id', $id)->get();
        $payment_terms = PaymentModel::where('branch', $branch)->get();
        $unq_id = uniqid();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $pdf = PDF::loadView('crm.VendorDoc.pdf', compact('id', 'payment_terms', 'unq_id', 'branch', 'vendor', 'vendordocuments', 'branchsettings'));

        return $pdf->stream('document.pdf');
    }
    public function vendordocumentSubmit(Request $request)
    {
        $branch = $request->branch;
        $postID = $request->vendor_id;
        $data = [
            'vendor_id' => $postID, 'no_of_invoices' => $request->no_of_invoices, 'credit_period_of_each_invoices' => $request->credit_period_each_invoice, 'total_amount' => $request->total_amount, 'credit_period_of_total_invoices' => $request->credit_period_total_invoice, 'payment_terms' => $request->payment_terms, 'description' => $request->description, 'branch' => $branch
        ];
        $userInfo = Vendor_documents_Model::updateOrCreate(['vendor_id' => $postID], $data);
        DB::table('qcrm_vendor_docs')->where('vendorid', $postID)->delete();

        for ($i = 0; $i < count($request->documentname); $i++) {
            $data1 = ['vendorid' => $postID, 'docname' => $request->documentname[$i], 'expdate' => Carbon::parse($request->expirydate[$i])->format('Y-m-d'), 'days' => $request->days[$i]];

            DB::table('qcrm_vendor_docs')->insert($data1);
        }
        if ($request->vendor_id) {
            $msg = 'updated';
        } else {
            $msg = 'created';
        }
        Session::flash('success', 'Vendor Documents ' . $msg . ' successfully.');

        return 'true';
    }
    public function Docinfotrash(Request $request)
    {
        $totalFiltered = 0;
        $totalData = VendorDocument::count();
        $query =  VendorDocument::orderby('id', 'desc');
        $query->where('del_flag', 0);
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('name', 'LIKE', "%{$search}%");
        }
        if (
            isset($_POST['columns'][3]['search']['value']) &&
            $_POST['columns'][3]['search']['value'] != ''
        ) {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('name', 'LIKE', "%{$search_3}%");
            echo "test";
        }
        $totalFiltered  = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $users =  $query->get();
        $data = array();
        $no   = $_POST['start'];
        $i    = 0;
        $row  = array();
        foreach ($users as $vendor_detail) {
            $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                       <a href="#?id=' . $vendor_detail->id . '" data-type="edit" data-toggle="modal" data-target="#vendorDoc"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text DocDetail_restore" data-id="' . $vendor_detail->id . '" >Restore</span>
                        </span></li></a>
                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->name;
            $row[3]  = $vendor_detail->title;
            $row[4]  = $vendor_detail->description;
            $row[5]  = $vendor_detail->file_data;
            $data[$i] = $row;
            $i++;
        }
        $output = array(
            "draw"                => $_POST['draw'],
            "recordsTotal"        => $totalData,
            "recordsFiltered"     => $totalFiltered,
            "data"                => $data,
        );
        echo json_encode($output);
    }
    public function doctrashrestore(Request $request)
    {
        $postID = $request->id;
        VendorDocument::where('V_id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ], [
            'title.required' => 'Title is required'
        ]);
        $user = auth()->user();
        $postID = $request->doc_id;
        $data   = [
            'name'                => $request->name,
            'title'                 => $request->title,
            'V_id'                => $request->v_id,
            'description'          => $request->description,
            'uniqueid'             => $request->UniqueID,
            'file_data'            => $request->fileData,
        ];
        $vendors = VendorDocument::updateOrCreate(['id' => $postID], $data);
        VendorDocument::where('V_id', $vendors->id)->delete();
        if (!empty($request->titles)) {
            foreach ($request->titles as $key => $value) {
                VendorDocument::create([
                    'title'                 => $request->titles[$key],
                    'V_id'                  => $request->v_id[$key],
                    'description'           => $request->descriptions[$key],
                    'uniqueid'              => $request->UniqueID[$key],
                    'file_data'             => $request->fileData[$key],
                ]);
            }
        }
        return 'true';
        $userInfo = VendorDocument::updateOrCreate(['id' => $postID], $data);
        return 'true';
    }
    public function getDocInfo(Request $request)
    {
        $data['users'] =  VendorDocument::where('name', $request->user_name)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function getDocAdd(Request $request)
    {
        $data['users'] =  Vendor::where('id', $request->user_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function view_vendordoc(Request $request)
    {
        $id = $_REQUEST['id'];
        $users = VendorDocument::where('id', $id)->limit(1)
            ->first();
        return view('crm.VendorDoc.view', ['data' => $users]);
    }
    public function getDocEdit(Request $request)
    {
        $id = $_REQUEST['user_id'];
        $data['users'] =  VendorDocument::where('V_id', $id)
            ->limit(2)
            ->first();
        echo json_encode($data);
    }
    public function deleteDocInfo(Request $request)
    {
        $postID = $request->id;
        VendorDocument::where('V_id', $postID)
            ->update(['del_flag' => 0]);
        return 'true';
    }
    public function DocRestore(Request $request)
    {
        $postID = $request->id;
        VendorDocument::where('id', $postID)
            ->update(['del_flag' => 1]);
        return 'true';
    }
    public function DocDetailsTrash(Request $request)
    {
        return view('crm.VendorDoc.trash');
    }
    public function vendor_download(Request $request)
    {
        $id = $request->id;
        $customerdocuments = Vendor_documents_Model::where('vendor_id', $id)->select('fileData as documents')->get();
        return view('crm.Download.common_download1', ['data' => $customerdocuments], compact('id'));
    }

    public function vendor_doc_view(Request $request)
    {
        $branch = Session::get('branch');
        $vendor_id = $request->id;
        if ($request->ajax()) {
            $query  = DB::table('qcrm_vendors_documents_files')->select('qcrm_vendors_documents_files.*')
                ->orderby('qcrm_vendors_documents_files.id', 'desc');
            $query->where('qcrm_vendors_documents_files.vendor_id', $request->vendor_id);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = $query->count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }

        return view('crm.VendorDoc.vendor_doc_view', compact('vendor_id'));
    }
    public function edit_vendor_docs(Request $request)
    {
        $branch = Session::get('branch');

        $id = $request->id;
        $docs = DB::table('qcrm_vendor_docs')->select('*', DB::raw("DATE_FORMAT(qcrm_vendor_docs.expdate, '%d-%m-%Y') as expdate1"))->where('vendorid', $id)->get();

        return view('crm.VendorDoc.vendor_docs', compact('docs'));
    }
}

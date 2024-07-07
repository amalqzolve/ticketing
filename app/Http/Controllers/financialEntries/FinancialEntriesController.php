<?php

namespace App\Http\Controllers\financialEntries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\procurement\EprSupplierPaymentModel;
use App\procurement\EprPoInvoiceProductsModel;

use DB;
use Session;
use Auth;
use Carbon\Carbon;
use PDF;

class FinancialEntriesController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = EprSupplierPaymentModel::select('epr_supplier_payment.id', 'epr_supplier_payment.created_at', 'qcrm_supplier.sup_name', 'epr_supplier_payment.invoice_id', DB::raw("DATE_FORMAT(epr_po_invoice.supplier_invoice_date, '%d-%m-%Y') as supplier_invoice_date"), DB::raw("DATE_FORMAT(epr_supplier_payment.payement_book_date, '%d-%m-%Y') as payement_book_date"), 'epr_supplier_payment.status')
                ->leftjoin('epr_po', 'epr_supplier_payment.po_id', '=', 'epr_po.id')
                ->leftjoin('qcrm_supplier', 'epr_po.supplier_id', '=', 'qcrm_supplier.id')
                ->leftjoin('epr_po_invoice', 'epr_supplier_payment.invoice_id', '=', 'epr_po_invoice.id')
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->editColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->addColumn('invoice_amount', function ($row) {
                $created = EprPoInvoiceProductsModel::where('epr_po_invoice_id', '=', $row->invoice_id)->sum('amount');
                return $created;
            })->rawColumns(['action', 'heyrarchy']);
            return $dtTble->make(true);
        } else {
            return view('financialEntries.financialEntries.list');
        }
    }
}

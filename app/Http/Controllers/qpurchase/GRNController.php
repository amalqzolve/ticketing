<?php

namespace App\Http\Controllers\qpurchase;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;
use App\Traits\ProductCountOperationTrait;
use DataTables;
use Hashids\Hashids;

class GRNController extends Controller
{
     use  ProductCountOperationTrait;
     public function list(Request $request)
     {
          $branch = Session::get('branch');
          $user = Auth::user();
          if (!$request->ajax()) {
               return view('qpurchase.grn.list');
          } else {
               $deliveryorder = DB::table('qbuy_purchase_grn')
                    ->leftjoin('qbuy_purchase_orders', 'qbuy_purchase_grn.po_id', '=', 'qbuy_purchase_orders.id')
                    ->leftjoin('qbuy_purchase_pi', 'qbuy_purchase_grn.inv_id', '=', 'qbuy_purchase_pi.id')
                    ->leftjoin('qcrm_supplier', 'qbuy_purchase_grn.supplier_id', '=', 'qcrm_supplier.id')
                    ->leftjoin('qcrm_salesman_details', 'qbuy_purchase_grn.preparedby', '=', 'qcrm_salesman_details.id')
                    ->leftjoin('qbuy_purchase_grn_products', 'qbuy_purchase_grn.id', '=', 'qbuy_purchase_grn_products.grn_id')
                    ->select('qbuy_purchase_grn.*',  'qbuy_purchase_pi.id as pur_inv_br_id', 'qcrm_supplier.sup_name', 'qcrm_salesman_details.name as salesman_name', DB::raw('SUM(qbuy_purchase_grn_products.quantity) as grn_quantity'), DB::raw("DATE_FORMAT(qbuy_purchase_grn.grn_date, '%d-%m-%Y') as grn_date"))
                    ->where('qbuy_purchase_grn.branch', $branch)
                    ->groupBy('qbuy_purchase_grn.id')
                    ->get();


               $dtTble = Datatables::of($deliveryorder)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                    $hashids = new Hashids();
                    $j = '';
                    $j .= '<a href="qpurchase-grn-view/' . $hashids->encode($row->id) . '" data-type="edit" data-target="#kt_form">
                    <li class="kt-nav__item">
                        <span class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-eye"></i>
                            <span class="kt-nav__link-text" data-id="' . $row->id . '">View</span>
                        </span>
                    </li>
                </a>';

                    $j .= '<a href="qpurchasegrn-pdf?id=' . $row->id . '" data-type="edit" data-target="#kt_form" target="_blank">
				<li class="kt-nav__item">
					<span class="kt-nav__link">
						<i class="kt-nav__link-icon flaticon2-printer"></i>
						<span class="kt-nav__link-text" data-id="' . $row->id . '">PDF</span>
					</span>
				</li>
			</a>';
                    if ($row->status == 'Draft') {
                         $url = ($row->source == 'By PO') ? 'qpurchasegrn-edit-by-po' : 'qpurchasegrn-edit-by-inv';
                         $url = 'qpurchasegrn-edit-by-po';
                         $j .= '<a href="' . $url . '?id=' . $row->id . '" data-type="edit" data-target="#kt_form">
                                   <li class="kt-nav__item">
                                        <span class="kt-nav__link">
                                             <i class="kt-nav__link-icon flaticon2-reload-1"></i>
                                             <span class="kt-nav__link-text" data-id="' . $row->id . '">Edit</span>
                                        </span>
                                   </li>
                              </a>';
                         $j .= '<a data-type="send" data-target="#kt_form">
                                   <li class="kt-nav__item grnApprove" id="' . $row->id . '">
                                        <span class="kt-nav__link">
                                             <i class="kt-nav__link-icon flaticon-multimedia"></i>
                                             <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Approve</span>
                                        </span>
                                   </li>
                              </a>';
                         $j .= '<a data-type="send" data-target="#kt_form">
                              <li class="kt-nav__item grnDelete" id="' . $row->id . '">
                                   <span class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon-delete"></i>
                                        <span class="kt-nav__link-text" data-id="' . $row->id . '" id=' . $row->id . '>Delete</span>
                                   </span>
                              </li>
                         </a>';
                    }

                    return '<span style="overflow: visible; position: relative; width: 80px;">
						   <div class="dropdown">
								<a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
								<i class="fa fa-cog"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">' . $j . '</ul>
								</div>
						  </div>
					   </span>';
               })->addColumn('status', function ($row) use ($user) {
                    if ($row->status == 'Approved')
                         return '<span style="color:green;">Approved</span>';
                    if ($row->status == 'Draft')
                         return '<span style="color:gray;">Draft</span>';
               })->addColumn('po_code', function ($row) {
                         if ($row->po_id != null)
                              return $row->po_id ;
                         else
                              return '-';
                    })->addColumn('pur_inv_code', function ($row) {
                         if ($row->inv_id != null)
                              return $row->inv_id;
                         else
                              return '-';
                    })
                    ->rawColumns(['action', 'status']);
               return  $dtTble->make(true);
          }
     }


     public function view(Request $request, $id)
     {
          $hashids = new Hashids();
          $id = isset($hashids->decode($id)[0]) ? $hashids->decode($id)[0] : 0;
          $branch = Session::get('branch');
          $branch_settings = Session::get('branch_settings');
          $grn = DB::table('qbuy_purchase_grn')->select('*')->where('id', $id)->where('branch', $branch)->first();
          if (isset($grn->id)) {
               $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
               $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
               $customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
               $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();

               if ($grn->source == 'By PO') {
                    $otherInformation   = DB::table('qbuy_purchase_orders')->select('*')->where('id', $grn->po_id)->first();
                    $products = DB::table('qbuy_purchase_grn_products')
                         ->leftjoin('qbuy_purchase_order_products', 'qbuy_purchase_grn_products.purchase_order_products_id', '=', 'qbuy_purchase_order_products.id')
                         ->select('qbuy_purchase_grn_products.*', 'qbuy_purchase_order_products.quantity as total_qty', 'qbuy_purchase_order_products.grn_remaining_quantity', 'qbuy_purchase_order_products.totalamount')
                         ->where('qbuy_purchase_grn_products.grn_id', $grn->id)
                         ->get();
               } else if ($grn->source == 'By Invoice') {
                    $otherInformation   = DB::table('qbuy_purchase_pi')->select('*')->where('id', $grn->inv_id)->first();
                    $products = DB::table('qbuy_purchase_grn_products')
                         ->leftjoin('qbuy_purchase_pi_products', 'qbuy_purchase_grn_products.purchase_invoice_products_id', '=', 'qbuy_purchase_pi_products.id')
                         ->select('qbuy_purchase_grn_products.*', 'qbuy_purchase_pi_products.quantity as total_qty', 'qbuy_purchase_pi_products.grn_remaining_quantity', 'qbuy_purchase_pi_products.totalamount')
                         ->where('qbuy_purchase_grn_products.grn_id', $grn->id)
                         ->get();
               }

               $supplierDetails = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $grn->supplier_id)->get();

               return view('qpurchase.grn.view', compact('branch_settings', 'unitlist', 'termslist', 'customers', 'salesmen', 'grn', 'products', 'otherInformation', 'supplierDetails'));
          } else
               return abourt(404);
     }


     public function editByPO(Request $request)
     {
          $id = $request->id;
          $branch = Session::get('branch');
          $branch_settings = Session::get('branch_settings');
          $grn = DB::table('qbuy_purchase_grn')->select('*')->where('id', $id)->where('branch', $branch)->first();
          if (isset($grn->id)) {
               $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
               $termslist = DB::table('qcrm_termsandconditions')->select('id', 'term')->where('branch', $branch)->where('del_flag', 1)->get();
               $customers = DB::table('qcrm_supplier')->select('id', 'sup_name', 'sup_code')->where('branch', $branch)->where('del_flag', 1)->get();
               $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();

               if ($grn->source == 'By PO') {
                    $otherInformation   = DB::table('qbuy_purchase_orders')->select('*')->where('id', $grn->po_id)->first();
                    $products = DB::table('qbuy_purchase_grn_products')
                         ->leftjoin('qbuy_purchase_order_products', 'qbuy_purchase_grn_products.purchase_order_products_id', '=', 'qbuy_purchase_order_products.id')
                         ->select('qbuy_purchase_grn_products.*', 'qbuy_purchase_order_products.quantity as total_qty', 'qbuy_purchase_order_products.grn_remaining_quantity', 'qbuy_purchase_order_products.totalamount')
                         ->where('qbuy_purchase_grn_products.grn_id', $grn->id)
                         ->get();
               } else if ($grn->source == 'By Invoice') {
                    $otherInformation   = DB::table('qbuy_purchase_pi')->select('*')->where('id', $grn->inv_id)->first();
                    $products = DB::table('qbuy_purchase_grn_products')
                         ->leftjoin('qbuy_purchase_pi_products', 'qbuy_purchase_grn_products.purchase_invoice_products_id', '=', 'qbuy_purchase_pi_products.id')
                         ->select('qbuy_purchase_grn_products.*', 'qbuy_purchase_pi_products.quantity as total_qty', 'qbuy_purchase_pi_products.grn_remaining_quantity', 'qbuy_purchase_pi_products.totalamount')
                         ->where('qbuy_purchase_grn_products.grn_id', $grn->id)
                         ->get();
               }

               $supplierDetails = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $grn->supplier_id)->get();

               return view('qpurchase.grn.edit', compact('branch_settings', 'unitlist', 'termslist', 'customers', 'salesmen', 'grn', 'products', 'otherInformation', 'supplierDetails'));
          } else
               echo "GRN Not Fount";
     }

     public function update(Request $request)
     {
          DB::transaction(function () use ($request) {
               $branch = Session::get('branch');
               $branch_settings = Session::get('branch_settings');
               $postID = $request->id;
               $data = [
                    'po_id' => $request->po_id,
                    'inv_id' => $request->inv_id,
                    'supplier_id' => $request->supplier_id,
                    'source' => $request->source,
                    'grn_date'   => Carbon::parse($request->grn_date)->format('Y-m-d'),
                    'attention'     => $request->attention,
                    'vehicle'     => $request->vehicle,
                    'driver'     => $request->driver,
                    'preparedby' => $request->preparedby,
                    'deliverynote' => $request->deliverynote,
                    'terms' => $request->terms,
                    'tpreview' => $request->tpreview,
                    'branch' => $branch,
                    'status' => $request->status,
               ];
               DB::table('qbuy_purchase_grn')->where('id', $postID)->update($data);
               $oldProducts =  DB::table('qbuy_purchase_grn_products')->select('purchase_order_products_id', 'purchase_invoice_products_id', 'quantity')->where('grn_id', $postID)->get();
               foreach ($oldProducts as $key => $value) {
                    if ($request->source == 'By PO')
                         DB::table('qbuy_purchase_order_products')->where('id', $value->purchase_order_products_id)->increment('grn_remaining_quantity', $value->quantity);
               }
               DB::table('qbuy_purchase_grn_products')->where('grn_id', $postID)->delete();
               for ($i = 0; $i < count($request->productname); $i++) {
                    if ($request->source == 'By PO')
                         DB::table('qbuy_purchase_order_products')->where('id', $request->purchase_order_products_id[$i])->decrement('grn_remaining_quantity', $request->quantity[$i]);
                    $data = [
                         'grn_id' => $postID,
                         'purchase_order_products_id' => $request->purchase_order_products_id[$i],
                         'purchase_invoice_products_id' => $request->purchase_invoice_products_id[$i],
                         'item_details_id' => $request->item_details_id[$i],
                         'productname' => $request->productname[$i],
                         'product_description' => $request->product_description[$i],
                         'unit' => $request->unit[$i],
                         'quantity' => $request->quantity[$i],
                    ];

                    if ($branch_settings->inventory_stock_affect_at == 'at-delivey-or-grn') {
                         $stockUpdationStatus = $this->purchaseUpdation('GRN', 'update', $request->grn_date, array(
                              'item_details_id' => $request->item_details_id[$i],
                              'product_name' => $request->productname[$i],
                              'unit' => $request->unit[$i],
                              'quantity'   => $request->quantity[$i],
                              'quantity_old'   => $request->quantity_old[$i],
                              'description' => $request->product_description[$i],
                              'save_as' => $request->save_as[$i],
                              'save_as_old' => $request->save_as_old[$i],
                              'totalamount' => $request->product_price[$i] * $request->quantity[$i],
                              'product_transaction_id' => $request->product_transaction_id[$i],
                              'new_product_id' => $request->new_product_id[$i],
                              'branch' => $branch,
                         ));
                         $data['save_as'] = $request->save_as[$i];
                         $data['new_product_id'] = $stockUpdationStatus['new_product_id'];
                         $data['product_transaction_id'] = $stockUpdationStatus['transaction_id'];
                    }

                    $enquiry_product =  DB::table('qbuy_purchase_grn_products')->insert($data);
               }
          });
          $out = array(
               'status' => 1,
               'msg' => 'Saved Success'
          );
          echo json_encode($out);
     }


     public function approve(Request $request)
     {
          DB::transaction(function () use ($request) {
               $id = $request->id;
               $dat = DB::table('qbuy_purchase_grn')->where('id', $id)->update(['status' => 'Approved']);
          });
          $out = array(
               'status' => 1,
               'msg' => 'Approved'
          );
          echo json_encode($out);
     }

     public function delete(Request $request)
     {
          DB::transaction(function () use ($request) {
               $postID = $request->id;
               $sourceRes = DB::table('qbuy_purchase_grn')->where('id', $postID)->select('source')->first();
               $source = $sourceRes->source;
               DB::table('qbuy_purchase_grn')->where('id', $postID)->delete();
               $products = DB::table('qbuy_purchase_grn_products')->where('grn_id', $postID)->select('quantity', 'purchase_order_products_id', 'new_product_id', 'product_transaction_id')->get();
               foreach ($products as $key => $value) {
                    if ($source == 'By PO')
                         DB::table('qbuy_purchase_order_products')->where('id', $value->purchase_order_products_id)->increment('grn_remaining_quantity', $value->quantity);
                    // else if ($source == 'By Invoice')
                    //      DB::table('qbuy_purchase_pi_products')->where('id', $value->purchase_order_products_id)->increment('grn_remaining_quantity', $value->quantity);
                    if ($value->new_product_id != '')
                         $this->decrementStock($value->new_product_id, $value->quantity);
                    if ($value->product_transaction_id != '')
                         $this->deleteProductTransaction($value->product_transaction_id);
               }
               DB::table('qbuy_purchase_grn_products')->where('grn_id', $postID)->delete();
          });
          $out = array(
               'status' => 1,
          );
          echo json_encode($out);
     }


     public function pdf(Request $request)
     {
          $id = $request->id;
          $branch = Session::get('branch');
          $grn = DB::table('qbuy_purchase_grn')->select('*')->where('id', $id)->where('branch', $branch)->first();
          if (isset($grn->id)) {
               $products = DB::table('qbuy_purchase_grn_products')
                    ->leftjoin('qbuy_purchase_pi_products', 'qbuy_purchase_grn_products.purchase_invoice_products_id', '=', 'qbuy_purchase_pi_products.id')
                    ->select('qbuy_purchase_grn_products.*', 'qbuy_purchase_pi_products.quantity as total_qty', 'qbuy_purchase_pi_products.grn_remaining_quantity')
                    ->where('qbuy_purchase_grn_products.grn_id', $id)
                    ->get();
               $supplierDetails = DB::table('qcrm_supplier')->leftjoin('qcrm_suppliergroup', 'qcrm_supplier.sup_note', '=', 'qcrm_suppliergroup.id')->leftjoin('qcrm_supplier_type', 'qcrm_supplier.sup_type', '=', 'qcrm_supplier_type.id')->leftjoin('qcrm_suppliercatogry', 'qcrm_supplier.sup_category', '=', 'qcrm_suppliercatogry.id')->leftjoin('countries', 'qcrm_supplier.sup_country', '=', 'countries.id')->select('qcrm_supplier.*', 'qcrm_suppliergroup.title as group', 'qcrm_supplier_type.title as type', 'qcrm_suppliercatogry.title as category', 'countries.cntry_name')->where('qcrm_supplier.id', $grn->supplier_id)->get();
               $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('branch', $branch)->get();
               $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name', 'unit_code')->where('branch', $branch)->where('del_flag', 1)->get();
               $salesmen = DB::table('qcrm_salesman_details')->select('id', 'name')->where('branch', $branch)->where('del_flag', 1)->get();
               if (Session::get('preview') == 'preview1') {
                    $pdf = PDF::loadView('qpurchase.grn.preview1', compact('branchsettings', 'unitlist', 'salesmen', 'grn', 'products', 'supplierDetails'));
               } elseif (Session::get('preview') == 'preview2') {
                    $pdf = PDF::loadView('qpurchase.grn.preview2', compact('branchsettings', 'unitlist', 'salesmen', 'grn', 'products', 'supplierDetails'));
               } elseif (Session::get('preview') == 'preview3') {
                    $pdf = PDF::loadView('qpurchase.grn.preview3', compact('branchsettings', 'unitlist', 'salesmen', 'grn', 'products', 'supplierDetails'));
               } elseif (Session::get('preview') == 'preview4') {
                    $pdf = PDF::loadView('qpurchase.grn.preview4', compact('branchsettings', 'unitlist', 'salesmen', 'grn', 'products', 'supplierDetails'));
               } else {
                    $pdf = PDF::loadView('qpurchase.grn.preview4', compact('branchsettings', 'unitlist', 'salesmen', 'grn', 'products', 'supplierDetails'));
               }
               return $pdf->stream('Delivery-#' . $id . '.pdf');
          } else
               echo "Grn Not Fount";
     }
}

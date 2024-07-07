<?php

namespace App\Http\Controllers\sell;

use Illuminate\Http\Request;
use PDF;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Spatie\Activitylog\Models\Activity;
use DB;
class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();
     $branch=Session::get('branch');

        $customers       = DB::table('qcrm_customer_details')->where('branch',$branch)->count();
        $activecustomers = DB::table('qcrm_customer_details')->where('qcrm_customer_details.del_flag',1)->where('branch',$branch)->count();
        $suppliers       = DB::table('qcrm_supplier')->where('branch',$branch)->count();
        $activesuppliers = DB::table('qcrm_supplier')->where('branch',$branch)->where('qcrm_supplier.del_flag',1)->count();
        $vendors         = DB::table('qcrm_vendors')->where('branch',$branch)->where('branch',$branch)->count();
        $activevendors   = DB::table('qcrm_vendors')->where('qcrm_vendors.del_flag',1)->where('branch',$branch)->count();
        $salesmen        = DB::table('qcrm_salesman_details')->where('branch',$branch)->count();
        $activesalesmen  = DB::table('qcrm_salesman_details')->where('branch',$branch)->where('qcrm_salesman_details.del_flag',1)->count();
           //  $query           = DB::table('qcrm_customer_details')->count();
           //  $supplier_query  = DB::table('qcrm_supplier')->count();
           //  $vendor_query    = DB::table('qcrm_vendors')->count();
           //  $sales_query     = DB::table('qcrm_salesman_details')->count();

           // $cust_del = DB::table('qcrm_customer_details')->where('qcrm_customer_details.del_flag',1)->count();
           // $custble_del = DB::table('qcrm_customer_details')->where('qcrm_customer_details.del_flag',0)->count();
           // $sup_del = DB::table('qcrm_supplier')->where('qcrm_supplier.del_flag',1)->count();
           // $suptble_del = DB::table('qcrm_supplier')->where('qcrm_supplier.del_flag',0)->count();
           // $ven_del = DB::table('qcrm_vendors')->where('qcrm_vendors.del_flag',1)->count();
           // $ventble_del = DB::table('qcrm_vendors')->where('qcrm_vendors.del_flag',0)->count();
           // $sales_del = DB::table('qcrm_salesman_details')->where('qcrm_salesman_details.del_flag',1)->count();
           // $salestbl_del = DB::table('qcrm_salesman_details')->where('qcrm_salesman_details.del_flag',0)->count();



           // $cust_doc = DB::table('qcrm_customer_documents')->where('qcrm_customer_documents.vat_no','<>', '')->count();
           // $cust_doc_up = DB::table('qcrm_customer_documents')->where('qcrm_customer_documents.vat_no','')->count();
           // $sup_doc = DB::table('qcrm_supplier_documents')->where('qcrm_supplier_documents.vat_no','<>','')->count();
           // $sup_doc_up = DB::table('qcrm_supplier_documents')->where('qcrm_supplier_documents.vat_no','')->count();
           // $ven_doc = DB::table('qcrm_vendors_documents')->where('qcrm_vendors_documents.vat_no','<>','')->count();
           // $ven_doc_up = DB::table('qcrm_vendors_documents')->where('qcrm_vendors_documents.vat_no','')->count();
           
$permissions = $user->getAllPermissions();
          return view('sell.dashboard.index',compact('customers','activecustomers','suppliers','activesuppliers','vendors','activevendors','salesmen','activesalesmen'));
// get all inherited permissions for that user

      //return view('sell.dashboard.index');
    }

   
    
}

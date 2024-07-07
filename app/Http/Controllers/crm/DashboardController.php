<?php

namespace App\Http\Controllers\crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DashboardController extends Controller
{
    public function index()
    {
         $branch=Session::get('branch');

        $customers       = DB::table('qcrm_customer_details')->where('branch',$branch)->count();
        $activecustomers = DB::table('qcrm_customer_details')->where('qcrm_customer_details.del_flag',1)->where('branch',$branch)->count();
        $suppliers       = DB::table('qcrm_supplier')->where('branch',$branch)->count();
        $activesuppliers = DB::table('qcrm_supplier')->where('branch',$branch)->where('qcrm_supplier.del_flag',1)->count();
        $vendors         = DB::table('qcrm_vendors')->where('branch',$branch)->where('branch',$branch)->count();
        $activevendors   = DB::table('qcrm_vendors')->where('qcrm_vendors.del_flag',1)->where('branch',$branch)->count();
        $salesmen        = DB::table('qcrm_salesman_details')->where('branch',$branch)->count();
        $activesalesmen  = DB::table('qcrm_salesman_details')->where('branch',$branch)->where('qcrm_salesman_details.del_flag',1)->count();
        $cgroup  = DB::table('qcrm_customer_groupdetails')->where('branch',$branch)->where('qcrm_customer_groupdetails.del_flag',1)->count();
        $ctype  = DB::table('qcrm_customer_typedetails')->where('branch',$branch)->where('qcrm_customer_typedetails.del_flag',1)->count();
        $ccategory  = DB::table('qcrm_customer_categorydetails')->where('branch',$branch)->where('qcrm_customer_categorydetails.del_flag',1)->count();
        $sgroup  = DB::table('qcrm_suppliergroup')->where('branch',$branch)->where('qcrm_suppliergroup.del_flag',1)->count();
        $stype  = DB::table('qcrm_supplier_type')->where('branch',$branch)->where('qcrm_supplier_type.del_flag',1)->count();
        $scategory  = DB::table('qcrm_suppliercatogry')->where('branch',$branch)->where('qcrm_suppliercatogry.del_flag',1)->count();
        $total=DB::table('qcrm_customer_docs')->select('docname')->where('del_flag',1)->count();
        $cdate = date('Y-m-d');
        $exp=DB::table('qcrm_customer_docs')->select('expdate')->where('del_flag',1)->where('expdate','<',$cdate)->count();
              
        $ac=DB::table('qcrm_customer_docs')->select('expdate')->where('del_flag',1)->where('expdate','>=',$cdate)->count();
        $totals=DB::table('qcrm_supplier_docs')->select('docname')->where('del_flag',1)->count();
        $exps=DB::table('qcrm_supplier_docs')->select('expdate')->where('del_flag',1)->where('expdate','<',$cdate)->count();
              
        $acs=DB::table('qcrm_supplier_docs')->select('expdate')->where('del_flag',1)->where('expdate','>=',$cdate)->count();
           

          return view('crm.dashboard.dashboard',compact('customers','activecustomers','suppliers','activesuppliers','vendors','activevendors','salesmen','activesalesmen','cgroup','ctype','ccategory','sgroup','stype','scategory','total','exp','ac','totals','exps','acs'));

    }
}
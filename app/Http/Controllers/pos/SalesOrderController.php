<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
// use App\Boq;
use App\crm\CustomerTypeModel;
use App\crm\CustomerCategoryModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function possalesorder()
    {
        $branch=Session::get('branch');

        $productlist = DB::table('qinventory_products')->select('*')->where('del_flag',1)->where('branch',$branch)->get();
        $currencylist   = DB::table('qpurchase_currency')->select('id','currency_name','currency_default','value')->where('del_flag',1)->where('branch',$branch)->get();
        $unitlist = DB::table('qinventory_product_unit')->select('id','unit_name')->where('branch',$branch)->where('del_flag',1)->get();
        $termslist   = DB::table('qcrm_termsandconditions')->select('id','term')->where('del_flag',1)->where('branch',$branch)->get();
        if(Session::get('common_customer_database')==1)
        {
            $customers   = DB::table('qcrm_customer_details')->select('id','cust_name')->where('del_flag',1)->get();
        }
        else
        {
            $customers   = DB::table('qcrm_customer_details')->select('id','cust_name')->where('del_flag',1)->where('branch',$branch)->get();
        }
        $salesmen   = DB::table('qcrm_salesman_details')->select('id','name')->where('del_flag',1)->where('branch',$branch)->get();
        $vatlist   = DB::table('qpurchase_taxgroup')->select('id','total','default_tax')->where('del_flag',1)->where('branch',$branch)->get();
        $areaList = CustomerCategoryModel::select('id', 'customer_category')->where('branch',$branch)->where('del_flag',1)->get();
        $areaLists = CustomerTypeModel::select('id', 'title')->where('branch',$branch)->where('del_flag',1)->get();
        $group = CustomerGroup::select('id', 'title')->where('branch',$branch)->where('del_flag',1)->get();
        $country = countryModel::select('id', 'cntry_name')->get();
       // dd($vatlist);
         return view('pos.salesorder.add',compact('branch','currencylist','vatlist','productlist','unitlist','termslist','customers','salesmen','areaList','areaLists','group','country'));
    }
     

  
}

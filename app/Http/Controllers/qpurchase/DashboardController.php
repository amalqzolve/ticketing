<?php

namespace App\Http\Controllers\qpurchase;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($groupID,$branch) {
     //   return 'I am group id ' . $groupID;
        Auth::loginUsingId($groupID, true);
        Session::put('branch', $branch);
      //  var_dump(Auth::user()->roles()->get()); exit();
        return redirect()->intended('/home');
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changepic(Request $request)
    {
        $id = $request->id;

        return view('changepic',compact('id'));
    }
    public function view()

    { 
        $data = DB::table('qpurchase_purchase')->count();
        $purchase_del = DB::table('qpurchase_purchase')->where('qpurchase_purchase.del_flag',1)->count();
        $purchase_tbl_del = DB::table('qpurchase_purchase')->where('qpurchase_purchase.del_flag',0)->count();


        $currency = DB::table('qpurchase_currency')->count();
        $currency_del = DB::table('qpurchase_currency')->where('qpurchase_currency.del_flag',1)->count();
        $currency_tbl_del = DB::table('qpurchase_currency')->where('qpurchase_currency.del_flag',0)->count();


        $costhead = DB::table('qpurchase_costhead')->count();
        $costhead_del = DB::table('qpurchase_costhead')->where('qpurchase_costhead.del_flag',1)->count();
        $costhead_tbl_del = DB::table('qpurchase_costhead')->where('qpurchase_costhead.del_flag',0)->count();


        $tax = DB::table('qpurchase_tax')->count();
        $tax_del = DB::table('qpurchase_tax')->where('qpurchase_tax.del_flag',1)->count();
        $tax_tbl_del = DB::table('qpurchase_tax')->where('qpurchase_tax.del_flag',0)->count();
        

         return view('qpurchase.dashboard.view',['data' => $data,'purchase_tbl_del'=>$purchase_tbl_del,'purchase_del'=>$purchase_del,'currency'=>$currency,'currency_tbl_del'=>$currency_tbl_del,'currency_del'=>$currency_del,'costhead'=>$costhead,'costhead_del'=>$costhead_del,'costhead_tbl_del'=>$costhead_tbl_del,'tax'=>$tax,'tax_del'=>$tax_del,'tax_tbl_del'=>$tax_tbl_del]);
    }





    
    public function submit_changepic(Request $request)
    {
        $id                 = $request->id;
       
        $data               = [
                               
                               'image'       =>$request->fileData,
                               
                              ];

        $brand          = DB::table('users')->where('id',$id)->update($data);
        return 'true';
       
    }


}

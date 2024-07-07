<?php
namespace App\Http\Controllers\crm;
use Illuminate\Http\Request;
use App\crm\vendor;
use DB;
use PDF;
use DataTables;
use Session;
use App\settings\BranchSettingsModel;

class vendoraccountsController extends Controller
{
    public function accountsList(Request $request)
    {
                   $branch=Session::get('branch');

         if($request->ajax())
        {
         $query = DB::table('qcrm_vendors')
            ->select('qcrm_vendors.vendor_code','qcrm_vendors.vendor_name','qcrm_vendors.account_group','qcrm_vendors.account_ledger','qcrm_vendors.account_code','qcrm_vendors.id','qcrm_vendors.*')
            ->orderby('qcrm_vendors.id', 'desc');
        $query->where('qcrm_vendors.del_flag', 1)->where('qcrm_vendors.branch',$branch);
        $data = $query->get();
                $count_filter = $query->count();
                $count_total = vendor::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
                 })->addColumn('status', function ($row) {
                return $row->account_code;
                })->rawColumns(['action','status'])->make(true);
        }
            /* */
        $branch=Session::get('branch');
         $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
         $subgrouptable= $subtable.'a_groups'; 
        $groups = DB::table($subgrouptable)->get()
            ->toArray();

             $branch=Session::get('branch');
            $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
            $subledgertable= $subtable.'ledgers'; //Take id,name for ledger dropdown
            $accounts = DB::table($subledgertable)->select('id','name')->get();

      /* */
        return view('crm.vendoraccounts.vendor_accounts', compact('groups','branch','accounts'));
    }
    //vendor account details pdf

    public function vendoraccount_pdf(Request $request)
    {
                $branch=Session::get('branch');

        $id = $request->id;
        $account = vendor::where('id', $id)->limit(1)->first();
        $category = DB::table('qcrm_customer_categorydetails')->select('id','customer_category')->where('del_flag',1)->get();
        $branchsettings = BranchSettingsModel::select('id','pdfheader','pdffooter')->where('del_flag',1)->where('branch',$branch)->get();

        $pdf = PDF::loadView('crm.vendoraccounts.pdf', compact('category','branchsettings'),['data'=>$account]);
    
    return $pdf->stream('document.pdf');
}
    public function getgroup_details(Request $request)
    {

         $branch=Session::get('branch');

         $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
         $subgrouptable= $subtable.'a_groups'; 


        $data['groups'] = array();
        $data['groups'] = DB::table($subgrouptable)->select('code')
            ->where('id', $request->grp_id)
            ->orderby('id', 'desc')
            ->first();
        foreach ($data['groups'] as $key)
        {
            $group_code = $key;
        }
        $data['ledger'] = DB::table('qlogistic_accountsledgers')->select('code')
            ->where('group_id', $request->grp_id)
            ->orderby('id', 'desc')
            ->first();
        if (!empty($data['ledger']))
        {
            foreach ($data['ledger'] as $key)
            {
                $code = substr($key, strpos($key, "-") + 1);
                $new_code = $code . "1";
                $ledger_code = $group_code . '-' . $new_code;
            }
        }
        else
        {
            $ledger_code = $group_code . '-001';
        }
        echo json_encode($ledger_code);
    }
    public function accountsubmit(Request $request)
    {
        $branch = $request->branch;
        $custID = $request->cust_id;
        $main_ledger = $request->main_ledger;
        $sub_ledger = $request->sub_ledger;
        $checkedValue = $request->ledger_type;
        $customer_ledger = $request->customer_ledger;

 //
         if($checkedValue==1){
        if(isset($main_ledger) && !empty($main_ledger) && isset($sub_ledger) && !empty($sub_ledger)){




            //main accounts
            $maintable=DB::table('qlogistic_accounts_accounts') ->where('is_default', '=', 1)->orderBy('id','asc')->value('db_prefix');
            $mainledgertable= $maintable.'ledgers'; 



            $data = array(
              //  'code' => $request->accounts_code,
                'op_balance' => 0,
                'name' => $request->accounts_ledger,
                'group_id' => $request->accounts_group,
                'op_balance_dc' => 0,
                'notes' => $request->accounts_ledger.'-'.$request->accounts_code,
                'reconciliation' => 0,
                'type' => 0,
            );
            DB::table($mainledgertable)->where('id', $main_ledger)->update($data);
           //main accounts
  $main_ledger_id = DB::getPdo()->lastInsertId();

          //sub accounts

              $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
              $subledgertable= $subtable.'ledgers'; 
  $data = array(
                'main_ledger_id' => $main_ledger_id,
                'op_balance' => 0,
                'name' => $request->accounts_ledger,
                'group_id' => $request->accounts_group,
                'op_balance_dc' => 0,
                'notes' => $request->accounts_ledger.'-'.$request->accounts_code,
                'reconciliation' => 0,
                'type' => 0,
            );

              DB::table($subledgertable)->where('id', $sub_ledger)->update($data);


            //Sub accounts


        } else{

      


            //main accounts
            $maintable=DB::table('qlogistic_accounts_accounts') ->where('is_default', '=', 1)->orderBy('id','asc')->value('db_prefix');
            $mainledgertable= $maintable.'ledgers'; 



            $data = array(
                'code' => $request->accounts_code,
                'op_balance' => 0,
                'name' => $request->accounts_ledger,
                'group_id' => $request->accounts_group,
                'op_balance_dc' => 0,
                'notes' => $request->accounts_ledger.'-'.$request->accounts_code,
                'reconciliation' => 0,
                'type' => 0,
            );
          $main_ledger =  DB::table($mainledgertable)->insert($data);
           //main accounts
  $main_ledger_id = DB::getPdo()->lastInsertId();

          //sub accounts

              $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
              $subledgertable= $subtable.'ledgers'; 


            $data = array(
                'main_ledger_id' => $main_ledger_id,
                'code' => $request->accounts_code,
                'op_balance' => 0,
                'name' => $request->accounts_ledger,
                'group_id' => $request->accounts_group,
                'op_balance_dc' => 0,
                'notes' => $request->accounts_ledger.'-'.$request->accounts_code,
                'reconciliation' => 0,
                'type' => 0,
            );
            $sub_ledger =  DB::table($subledgertable)->insert($data);
 

            //Sub accounts

        }
     
            //


       $data = ['account_group' => $request->accounts_group, 'account_ledger' => $request->accounts_ledger, 'account_code' => $request->accounts_code,'branch' =>$branch,'main_ledger' =>$main_ledger,'sub_ledger' =>$sub_ledger
        ];

        
        $userInfo = vendor::updateOrCreate(['id' => $custID], $data);
        return 'true';
    }

     if($checkedValue==2){
        $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
              $subledgertable= $subtable.'ledgers'; 
$main_ledger=DB::table($subledgertable) ->where('id', '=', $request->customer_ledger)->orderBy('id','asc')->value('main_ledger_id');

         //'main_ledger' =>$main_ledger
        $data = ['branch' =>$branch,'sub_ledger' =>$request->customer_ledger,'main_ledger' =>$main_ledger,'ledger_type' =>$request->ledger_type
        ];
        $userInfo = vendor::updateOrCreate(['id' => $custID], $data);
        return 'true';

       }
       
    }
    public function getaccountdata(Request $request)
    {
        $data['accounts'] = vendor::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show($id)
    {
    }
    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}


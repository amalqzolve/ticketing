<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\AccountslistModel;
use yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;

use DB;

class AccountsController extends Controller
{
     /**
     * Display a listing of Various Accounts.
     */

    public function AccountsListing(Request $request)
    {
        
        if ($request->ajax()) 
            {
               $query = DB::table('qinventory_accounts')
                ->leftJoin('a_branch1_a_groups', 'qinventory_accounts.group_name', '=', 'a_branch1_a_groups.id')
                ->select('a_branch1_a_groups.name','qinventory_accounts.id','qinventory_accounts.account_name','qinventory_accounts.account_code')->orderby('qinventory_accounts.id', 'desc');
                $query->where('qinventory_accounts.del_flag',1);
                $data = $query->get();
                // dd($data);
                $count_filter = $query->count();
                $count_total = AccountslistModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);    
            }
         return view('inventory.inventory.accounts.listing');
    }


    /**
     * Add New Accounts Form.
     */

    public function NewAccount()
    {
        $groups = DB::table('a_branch1_a_groups')->get()
            ->toArray();
         return view('inventory.accounts.add',compact('groups'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // public function accounts_list()
    // {
    //     $totalFiltered = 0;
    //     $totalData = AccountslistModel::count();
    //     $query = AccountslistModel::orderby('id', 'desc');
    //     $query->where('del_flag', 1);
    //     $totalFiltered = $query->count();
    //     $query->skip($_POST['start'])->take($_POST['length']);
    //     $list = $query->get();
    //     $data = array();
    //     $no = $_POST['start'];
    //     $i = 0;
    //     $row = array();

    //     foreach ($list as $lists)
    //     {
    //         // echo "<pre>";
    //         // print_r($lists);
    //         // exit();
    //         $no++;

    //         $row[0] = $no;
    //         $row[1] = $lists->account_name;
    //         $row[2] = $lists->account_code;
    //         $row[3] = $lists->group_name;
    //         $row[4] = '<span style="overflow: visible; position: relative; width: 80px;">
    //                     <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    //                     <i class="flaticon-more-1"></i></a>
    //                     <div class="dropdown-menu dropdown-menu-right">
    //                     <ul class="kt-nav">
                        

    //                    <a href="edit_accounts?id=' . $lists->id . '"><li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-contract"></i>
    //                     <span class="kt-nav__link-text " data-id="' . $lists->id . '" >Edit</span>
    //                     </span></li></a>

    //                       <li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                     <span class="kt-nav__link-text kt_accounts_delete" id=' . $lists->id . ' data-id=' . $lists->id . '>Delete</span></span></li>

    //                    </ul></div></div></span>';


    //         $data[$i] = $row;
    //         $i++;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $totalData,
    //         "recordsFiltered" => $totalFiltered,
    //         "data" => $data,
    //     );
    //     echo json_encode($output);

    // }
    
    public function accounts_submit(Request $request)
    {
        $postID = $request->id;
       // dd($postID);
        $check = $this->check_exists($request->account_name,'account_name','qinventory_accounts');
        if($check<1)
        {
        $data = [
                    'account_name' => $request->account_name,
                    'account_code' => $request->account_code,
                    'group_name'   => $request->group_name,
            
                 ];
                // print_r($data);

        $userInfo = AccountslistModel::updateOrCreate(['id' => $postID], $data);
         return 'true';
     }
     else
     {
        return 'false';
     }
    }
    
    public function edit_accounts(Request $request)
    {
        $id = $_REQUEST['id'];
       $groups = DB::table('a_branch1_a_groups')->get()
            ->toArray();

        $accounts = AccountslistModel::where('id', $id)->limit(1)
            ->first();

        return view('inventory.accounts.edit',['data' => $accounts],compact('groups'));


    }
    
    public function deleteaccounts(Request $request)
    {
        $postID = $request->id;
        //dd($postID);
        AccountslistModel::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }
    
    public function trash(Request $request)
    {
        if ($request->ajax()) 
            {
                $query = AccountslistModel::orderby('id', 'desc');
                $query->where('del_flag', 0);
                $data = $query->get();
                // dd($data);
                $count_filter = $query->count();
                $count_total = AccountslistModel::count();
                return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                    return $row->id; 
                })->rawColumns(['action'])->make(true);    
            }
         return view('inventory.accounts.trash');
    }
    
    // public function trash_list()
    // {
    //     $totalFiltered = 0;
    //     $totalData = AccountslistModel::count();
    //     $query = AccountslistModel::orderby('id', 'desc');
    //     $query->where('del_flag', 0);
    //     $totalFiltered = $query->count();
    //     $query->skip($_POST['start'])->take($_POST['length']);
    //     $list = $query->get();
    //     $data = array();
    //     $no = $_POST['start'];
    //     $i = 0;
    //     $row = array();

    //     foreach ($list as $lists)
    //     {
    //         // echo "<pre>";
    //         // print_r($lists);
    //         // exit();
    //         $no++;

    //         $row[0] = $no;
    //         $row[1] = $lists->account_name;
    //         $row[2] = $lists->account_code;
    //         $row[3] = $lists->group_name;
    //         $row[4] = '<span style="overflow: visible; position: relative; width: 80px;">
    //                     <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
    //                     <i class="flaticon-more-1"></i></a>
    //                     <div class="dropdown-menu dropdown-menu-right">
    //                     <ul class="kt-nav">
                        


    //                       <li class="kt-nav__item">
    //                     <span class="kt-nav__link">
    //                     <i class="kt-nav__link-icon flaticon2-trash"></i>
    //                     <span class="kt-nav__link-text kt_accounts_recover" id=' . $lists->id . ' data-id=' . $lists->id . '>Recover</span></span></li>

    //                    </ul></div></div></span>';


    //         $data[$i] = $row;
    //         $i++;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $totalData,
    //         "recordsFiltered" => $totalFiltered,
    //         "data" => $data,
    //     );
    //     echo json_encode($output);

    // }
    
     public function restoreaccounts(Request $request)
    {
        $postID = $request->id;
        AccountslistModel::where('id', $postID)->update(['del_flag' => 1]);
        return 'true';
    }
     public function getgroup_details(Request $request)
    {
        $data['groups'] = array();
        $data['groups'] = DB::table('a_branch1_a_groups')->select('code')
            ->where('id', $request->grp_id)
            ->orderby('id', 'desc')
            ->first();
        foreach ($data['groups'] as $key)
        {
            $group_code = $key;
        }
        $data['ledger'] = DB::table('accountsledgers')->select('code')
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
    public function index()
    {
        //
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
    public function show($id)
    {
        //
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
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }
}

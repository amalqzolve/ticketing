<?php

namespace App\Http\Controllers\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\pos\VanModel;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use PDF;
use App\settings\BranchSettingsModel;

class VanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request)
    {
        $branch = Session::get('branch');

        if ($request->ajax()) {
            $query  = DB::table('qpos_van')->leftjoin('qcrm_salemanroute', 'qpos_van.route', '=', 'qcrm_salemanroute.id')->leftjoin('qcrm_salesman_details', 'qpos_van.salesman', '=', 'qcrm_salesman_details.id')->leftjoin('qpos_driver', 'qpos_van.driver', '=', 'qpos_driver.id')
                ->select('qpos_van.*', 'qcrm_salemanroute.routename', 'qcrm_salesman_details.name', 'qpos_driver.name as driver')
                ->orderby('id', 'desc');
            $query->where('qpos_van.del_flag', 1)->where('qpos_van.branch', $branch);

            $data = $query->get();
            $count_filter = $query->count();
            $count_total = VanModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        return view('pos.van.listing');
    }
    public function Add_van()
    {

        $user_id = Auth::user()->id;

        $customers   = DB::table('qcrm_customer_details')->whereNotIn('qcrm_customer_details.id', DB::table('qpos_van_customers')->pluck('qpos_van_customers.customers'))->select('qcrm_customer_details.*')->where('qcrm_customer_details.del_flag', 1)->get();
        $salesmanlist = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->get();
        $route = DB::table('qcrm_salemanroute')->select('id', 'routename')->where('del_flag', 1)->get();
        $drivers   = DB::table('qpos_driver')->select('id', 'name')->where('del_flag', 1)->get();
        return view('pos.van.add', compact('customers', 'salesmanlist', 'route', 'drivers'));
    }
    public function getcustomerdetailspos(Request $request)
    {
        $id = $request->id;

        $data = DB::table('qcrm_customer_details')->select('qcrm_customer_details.*')->where('qcrm_customer_details.id', $id)->get();


        return response()->json($data);
    }

    public function getvanemailspos(Request $request)
    {
        $email = $request->email;

        $data = DB::table('qpos_van')->select('username')->where('username', $email)->where('del_flag', 1)->get();
        return $data->count();
    }
    public function submit_van(Request $request)
    {
        // dd($request);
        // $user_id = Auth::user()->id;
        $branch = Session::get('branch');
        $postID = $request->id;
        $check = $this->check_exists($request->licenseno);
        if ($check < 1) {
            $data = [
                'vanname' => $request->vanname,
                'licenseno' => $request->licenseno,
                'route' => $request->route,
                'salesman' => $request->salesman,
                'driver' => $request->driver,
                'notes' => $request->notes,
                'username' => $request->username,
                'password' => $request->password,
                'branch' => $branch
            ];

            $van = VanModel::updateOrCreate(['id' => $postID], $data);
            $vanid = $van->id;
            User::create([
                'name' => $request->vanname,
                'email' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            DB::table('qpos_van_customers')->where('vanid', $vanid)->delete();

            for ($i = 0; $i < count($request->customername); $i++) {
                $data = [
                    'vanid' => $vanid,
                    'customers' => $request->customername[$i],
                    'streetname' => $request->streetname[$i],
                    'district' => $request->district[$i],
                    'vatno' => $request->vatno[$i],
                    'crno' => $request->crno[$i],
                    'phone' => $request->phone[$i],
                    'branch' => $branch
                ];
                // $quotation_product = CustomInvoiceproductModel::Create($data);
                $vancustomers = DB::table('qpos_van_customers')->insert($data);
            }

            return 'true';
        } else {
            return 'false';
        }
    }


    public function vanpdf(Request $request)
    {
        ini_set("pcre.backtrack_limit", "100000000000");
        $id = $request->id;
        $branch = Session::get('branch');


        $companysettings = BranchSettingsModel::where('branch', $branch)->get();
        $vandetails = VanModel::where('id', $id)->get();

        $customers   = DB::table('qpos_van_customers')->leftjoin('qcrm_customer_details', 'qpos_van_customers.customers', '=', 'qcrm_customer_details.id')->select('qpos_van_customers.*', 'qcrm_customer_details.cust_name')->where('qpos_van_customers.vanid', $id)->where('qpos_van_customers.del_flag', 1)->where('qpos_van_customers.branch', $branch)->get();

        $salesmen   = DB::table('qcrm_salesman_details')->select('id', 'name')->where('del_flag', 1)->where('branch', $branch)->get();
        $branchsettings = BranchSettingsModel::select('id', 'pdfheader', 'pdffooter')->where('del_flag', 1)->where('branch', $branch)->get();
        $bname   = DB::table('a_accounts')->select('id', 'label')->where('id', $branch)->get();
        $route   = DB::table('qcrm_salemanroute')->select('id', 'routename')->where('del_flag', 1)->where('branch', $branch)->get();
        $drivers   = DB::table('qpos_driver')->select('id', 'name')->where('del_flag', 1)->get();
        if (Session::get('preview') == 'preview1') {
            $pdf = PDF::loadView('pos.van.preview1', compact('branch', 'branchsettings', 'customers', 'salesmen', 'bname', 'companysettings', 'vandetails', 'route', 'drivers'));
        } elseif (Session::get('preview') == 'preview2') {
            $pdf = PDF::loadView('pos.van.preview2', compact('branch', 'branchsettings', 'customers', 'salesmen', 'bname', 'companysettings', 'vandetails', 'route', 'drivers'));
        } elseif (Session::get('preview') == 'preview3') {
            $pdf = PDF::loadView('pos.van.preview3', compact('branch', 'branchsettings', 'customers', 'salesmen', 'bname', 'companysettings', 'vandetails', 'route', 'drivers'));
        } elseif (Session::get('preview') == 'preview4') {
            $pdf = PDF::loadView('pos.van.preview4', compact('branch', 'branchsettings', 'customers', 'salesmen', 'bname', 'companysettings', 'vandetails', 'route', 'drivers'));
        } else {
            $pdf = PDF::loadView('pos.van.van_pdf', compact('branch', 'branchsettings', 'customers', 'salesmen', 'bname', 'companysettings', 'vandetails', 'route', 'drivers'));
        }


        return $pdf->stream('van-#' . $id . '.pdf');
    }


    public function check_exists($value1)
    {
        $branch = Session::get('branch');

        $query = DB::table('qpos_van')->select('licenseno')->where('licenseno', $value1)->where('del_flag', 1)->where('branch', $branch)->get();

        return $query->count();
    }
}

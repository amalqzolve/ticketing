<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\crm\CustomerCategoryModel;
use App\crm\CustomerTypeModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;
use App\inventory\ProductdetailslistModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use MuktarSayedSaleh\ZakatTlv\Encoder;
use Illuminate\Support\Facades\Crypt;



class CommonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /***
    Get unique id
     ***/
    public function detUniqueID()
    {
        return json_encode(uniqid());
    }
    public function nextNumber()
    {
        //  $this->DB1->where('entrytype_id', $id);
        $max = $this->DB1->select('MAX(number) AS max')->get('entries')->row_array();
        if (empty($max['max'])) {
            $maxNumber = 0;
        } else {
            $maxNumber = $max['max'];
        }
        return $maxNumber + 1;
    }

    public function tsearch()
    {
        $branch = Session::get('branch');
        $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();

        $warehouses = DB::table('qinventory_warehouse')->select('*')->where('branch', $branch)->get();

        $common_customer_database = DB::table('qsettings_company')->select('common_customer_database')->value('common_customer_database');
        $productlistquery = DB::table('qinventory_products')->select('*');
        if ($common_customer_database != 1) {
            $productlistquery->where('branch', $branch);
        }
        $productlist = $productlistquery->where('del_flag', 1)->get();
        $currencylistquery = DB::table('qpurchase_currency')->select('id', 'currency_name', 'currency_default', 'value');
        if ($common_customer_database != 1) {
            $currencylistquery->where('branch', $branch);
        }
        $currencylist = $currencylistquery->where('del_flag', 1)->get();
        $unitlistquery = DB::table('qinventory_product_unit')->select('id', 'unit_name');
        if ($common_customer_database != 1) {
            $unitlistquery->where('branch', $branch);
        }

        $unitlist = $unitlistquery->where('del_flag', 1)->get();

        $termslistquery = DB::table('qcrm_termsandconditions')->select('id', 'term');

        if ($common_customer_database != 1) {
            $termslistquery->where('branch', $branch);
        }

        $termslist = $termslistquery->where('del_flag', 1)->get();

        $customersquery = DB::table('qcrm_customer_details')->select('id', 'cust_name');

        if ($common_customer_database != 1) {
            $customersquery->where('branch', $branch);
        }

        $customers = $customersquery->where('del_flag', 1)->get();

        $salesmenquery = DB::table('qcrm_salesman_details')->select('id', 'name');

        if ($common_customer_database != 1) {
            $salesmenquery->where('branch', $branch);
        }

        $salesmen = $salesmenquery->where('del_flag', 1)->get();

        $vatlistquery = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax');

        if ($common_customer_database != 1) {
            $vatlistquery->where('branch', $branch);
        }

        $vatlist = $vatlistquery->where('del_flag', 1)->get();

        $areaListquery = DB::table('qcrm_customer_categorydetails')->select('*');

        if ($common_customer_database != 1) {
            $areaListquery->where('branch', $branch);
        }

        $areaList = $areaListquery->where('del_flag', 1)->get();

        $areaListsquery = DB::table('qcrm_customer_typedetails')->select('*');

        if ($common_customer_database != 1) {
            $areaListsquery->where('branch', $branch);
        }

        $areaLists = $areaListsquery->where('del_flag', 1)->get();


        $groupquery = DB::table('qcrm_customer_groupdetails')->select('*');

        if ($common_customer_database != 1) {
            $groupquery->where('branch', $branch);
        }

        $group = $groupquery->where('del_flag', 1)->get();

        $countryquery = DB::table('countries')->select('id', 'cntry_name');
        $country = $countryquery->get();

        $stores   = DB::table('qinventory_store_management')->select('*')->where('del_flag', 1)->get();
        $storeavailabe   = DB::table('qsettings_company')->select('storeavailable')->where('branch', $branch)->get();
        $default_grp   = DB::table('qcrm_customer_groupdetails')->select('id')->where('default_grp', 1)->get();
        $typedefault   = DB::table('qcrm_customer_typedetails')->select('id')->where('typedefault', 1)->get();
        $catdefault   = DB::table('qcrm_customer_categorydetails')->select('id')->where('catdefault', 1)->get();
        return view('sell.search.add', compact('branch', 'currencylist', 'vatlist', 'productlist', 'unitlist', 'termslist', 'customers', 'salesmen', 'areaList', 'areaLists', 'group', 'country', 'storeavailabe', 'stores', 'warehouses', 'default_grp', 'typedefault', 'catdefault'));
    }

    public function downloadFile(Request $request, $id)
    {
        ob_end_clean();
        $file_path = decrypt($id);
        if (file_exists($file_path)) {
            return response()->download($file_path);
            redirect()->back();
        } else
            echo 'File Note Found';
    }

    public function downloadFileFromStorage(Request $request, $id)
    {
        ob_end_clean();
        // $file_path = decrypt($id);
        // if (file_exists($file_path)) {
        //     return response()->download($file_path);
        //     redirect()->back();
        // } else
        // echo storage_path() . '/app/' . decrypt($id);

        $path = storage_path()  . '/app/' . decrypt($id);
        // $path = 'D:\xampp\htdocs\trading\storage\app\public\pdf\car_reant_agreements\25.pdf';
        if (file_exists($path)) {
            return response()->download($path);
            redirect()->back();
        } else
            echo "file note fount";
    }

    public function autoincrement()
    {
        DB::update("ALTER TABLE qsell_saleinvoice AUTO_INCREMENT = 76;");
    }
    public function update()
    {
        DB::table('qsell_saleinvoice')->where('id', 68)->update(['id' => 69]);
    }
    public function tozero()
    {
        DB::table('qinventory_products')->update(['available_stock' => 0, 'opening_stock' => 0]);
    }
    public function quantitychange_purchase()
    {
        $quantity   = DB::table('qbuy_pi_products')->leftjoin('qinventory_products', 'qbuy_pi_products.itemname', '=', 'qinventory_products.product_id')->select('qbuy_pi_products.quantity', 'qbuy_pi_products.itemname')->get();
        foreach ($quantity as $quantitys) {
            $stock = ProductdetailslistModel::where('product_id',  $quantitys->itemname)->increment('available_stock', $quantitys->quantity);
            $stock1 = ProductdetailslistModel::where('product_id',  $quantitys->itemname)->increment('opening_stock', $quantitys->quantity);
        }
    }
    public function quantitychange_sales()
    {
        $quantity   = DB::table('qsell_saleinvoice_products')->leftjoin('qinventory_products', 'qsell_saleinvoice_products.item_id', '=', 'qinventory_products.product_id')->select('qsell_saleinvoice_products.quantity', 'qsell_saleinvoice_products.item_id')->get();
        foreach ($quantity as $quantitys) {
            $stock = ProductdetailslistModel::where('product_id',  $quantitys->item_id)->decrement('available_stock', $quantitys->quantity);
            $stock1 = ProductdetailslistModel::where('product_id',  $quantitys->item_id)->decrement('opening_stock', $quantitys->quantity);
        }
    }

    public function gettermsquote(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qcrm_termsandconditions')
            ->select('qcrm_termsandconditions.*')
            ->where('qcrm_termsandconditions.id', $id)
            ->get();
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use App\settings\BranchSettingsModel;
use App\Traits\AccountingActionsTrait;

class BranchSettingsController  extends Controller
{
    use AccountingActionsTrait;
    public function index(Request $request)
    {
        $branch = Session::get('branch');
        $this->connectToAccounting();
        try {
            // Try to connect to the Accouting DB database
            DB::connection('mysql_accounting')->getPdo();
        } catch (\Exception $e) {
            $this->configureAccountingDBConnection();
        }

        $countries = DB::table('countries')->select('id', 'cntry_name')->get();
        $branchSettings = BranchSettingsModel::where('branch', $branch)->first();
        $entryTypes = DB::connection('mysql_accounting')->table('entrytypes')->get();
        $groups = DB::connection('mysql_accounting')->table('groups')->get();
        $ledgers = DB::connection('mysql_accounting')->table('ledgers')->get();
        $finalLedger = array();
        foreach ($groups as $key => $value) {

            $string = $value->code;
            $characterToCount = '-';
            $count = substr_count($string, $characterToCount);
            $elemnt = array(
                'id' => $value->id,
                'parent_id' => $value->parent_id,
                'name' => $value->name,
                'code' => $value->code,
                'count' => $count,
            );
            array_push($finalLedger, $elemnt);
        }

        foreach ($ledgers as $key => $value) {
            $string = $value->code;
            $characterToCount = '-';
            $count = substr_count($string, $characterToCount);
            $elemnt = array(
                'id' => $value->id,
                'parent_id' => '~', //$value->parent_id,
                'name' => $value->name,
                'code' => $value->code,
                'count' => $count,
            );
            array_push($finalLedger, $elemnt);
        }
        $allLedger = collect($finalLedger)->sortBy('code')->toArray();

        return view('settings.branchSettings.update', compact('branchSettings', 'countries', 'entryTypes', 'allLedger'));
    }

    public function configureAccountingDBConnection()
    {
        $branch = Session::get('branch');
        $accountigDbCredentials = DB::table('qsettings_branch_details')->where('id', $branch)->first();
        return view('settings.branchSettings.updateAccountingConnConfig', compact('accountigDbCredentials'));
    }

    public function testAccountingConnection(Request $request)
    {
        config([
            'database.connections.mysql_accounting_test.driver' => $request->db_datasource, //'mysql',
            'database.connections.mysql_accounting_test.host' => $request->db_host, //'127.0.0.1',
            'database.connections.mysql_accounting_test.port' => $request->db_port, //3306,
            'database.connections.mysql_accounting_test.database' => $request->db_schema, //'accountant_new1',
            'database.connections.mysql_accounting_test.username' => $request->db_login, //'root',
            'database.connections.mysql_accounting_test.password' => $request->db_password, //'123456',
        ]);
        try {
            // Try to connect to the Accouting DB database
            DB::connection('mysql_accounting_test')->getPdo();
            $out = array(
                'status' => 1,
                'msg' => 'Connection Success'
            );
            echo json_encode($out);
        } catch (\Exception $e) {
            $out = array(
                'status' => 0,
                'msg' => 'Connection Faill'
            );
            echo json_encode($out);
        }
    }
    public function saveAccountingConnection(Request $request)
    {
        $branch = Session::get('branch');
        DB::table('qsettings_branch_details')->where('id', $branch)->update(array(
            'db_datasource' => $request->db_datasource,
            'db_host' => $request->db_host,
            'db_port' => $request->db_port,
            'db_schema' => $request->db_schema,
            'db_login' => $request->db_login,
            'db_password' => $request->db_password,
        ));

        $account_credentials =  DB::table('qsettings_branch_details')->where('id', $branch)->first();
        Session::put('account_credentials', $account_credentials);

        $out = array(
            'status' => 1,
            'msg' => 'DB Connection Saved'
        );
        echo json_encode($out);
    }


    public function sealupload(Request $request)
    {
        $path = public_path('seal');
        $branch = Session::get('branch');
        if ($request->hasfile('filenames')) {

            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();

                //Storage::putFile('userInfoData', $name);
                $file->move($path, $name);
                //move_uploaded_file($name, public_path('userInfoData').'/'.$request->UniqueID);   

                $data[] = $name;
                $sealData = [
                    'seal' => 'seal/' . $name,
                    'branch' => $branch
                ];
                $seal = BranchSettingsModel::updateOrCreate(['branch' => $branch], $sealData);
            }
        }
    }

    public function companylogoupload(Request $request)
    {
        $path = public_path('companylogoupload');
        $branch = Session::get('branch');
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $data[] = $name;
                $logoData =  array('companylogo' => 'companylogoupload/' . $name);
                $seal = BranchSettingsModel::updateOrCreate(['branch' => $branch], $logoData);
            }
        }
    }


    public function headderUpload(Request $request)
    {
        $path = public_path('pdfheader');
        $branch = Session::get('branch');
        if ($request->hasfile('filenames')) {

            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();

                //Storage::putFile('userInfoData', $name);
                $file->move($path, $name);
                //move_uploaded_file($name, public_path('userInfoData').'/'.$request->UniqueID);   

                $data[] = $name;
                $headderData = [
                    'pdfheader' => 'pdfheader/' . $name,
                    'branch' => $branch
                ];
                $branchsettings = BranchSettingsModel::updateOrCreate(['branch' => $branch], $headderData);
            }
        }
    }

    public function footerUpload(Request $request)
    {
        $path = public_path('pdffooter');
        $branch = Session::get('branch');
        if ($request->hasfile('filenames')) {

            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();

                //Storage::putFile('userInfoData', $name);
                $file->move($path, $name);
                //move_uploaded_file($name, public_path('userInfoData').'/'.$request->UniqueID);   

                $data[] = $name;
                $footerData = [
                    'pdffooter' => 'pdffooter/' . $name,
                    'branch' => $branch
                ];
                $branchsettings = BranchSettingsModel::updateOrCreate(['branch' => $branch], $footerData);
            }
        }
    }

    public function saveBranchDetails(Request $request)
    {
        $branch = Session::get('branch');

        $data = array(
            'company_name' => $request->company_name,
            'building_no' => $request->building_no,
            'street_name' => $request->street_name,
            'district' => $request->district,
            'province_state' => $request->province_state,
            'city' => $request->city,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
            'company_cr' => $request->company_cr,
            'company_vat' => $request->company_vat,

            'seal' => $request->fileDataSeal,
            'pdfheader' => $request->fileDataHeadder,
            'pdffooter' => $request->fileDataFooter,

            'preview' => $request->preview,
            'pdfletterheader_top' => $request->pdfletterheader_top,
            'pdfletterfooter_bottom' => $request->pdfletterfooter_bottom,
            'pdfheader_top' => $request->pdfheader_top,
            'pdffooter_bottom' => $request->pdffooter_bottom,

            'default_customer_ledger' => $request->default_customer_ledger,
            'default_supplier_ledger' => $request->default_supplier_ledger,
            'sales_invoice_ledger' => $request->sales_invoice_ledger,
            'sales_invoice_vat_ledger' => $request->sales_invoice_vat_ledger,
            'sales_return_ledger' => $request->sales_return_ledger,
            'sales_return_vat_ledger' => $request->sales_return_vat_ledger,
            'purchase_invoice_ledger' => $request->purchase_invoice_ledger,
            'purchase_invoice_vat_ledger' => $request->purchase_invoice_vat_ledger,
            'purchase_return_ledger' => $request->purchase_return_ledger,
            'purchase_return_vat_ledger' => $request->purchase_return_vat_ledger,
            'sales_invoice_entry_type' => $request->sales_invoice_entry_type,
            'sales_return_entry_type' => $request->sales_return_entry_type,
            'sales_billsettilement_entry_type' => $request->sales_billsettilement_entry_type,
            'sales_adwance_entry_type' => $request->sales_adwance_entry_type,
            'sales_return_refund_entry_type' => $request->sales_return_refund_entry_type,
            'purchase_invoice_entry_type' => $request->purchase_invoice_entry_type,
            'purchase_return_entry_type' => $request->purchase_return_entry_type,
            'purchase_billsettilement_entry_type' => $request->purchase_billsettilement_entry_type,
            'purchase_adwance_entry_type' => $request->purchase_adwance_entry_type,
            'purchase_return_refund_entry_type' => $request->purchase_return_refund_entry_type,

            'settings_completed' => 1,
        );
        $qsettings_branch = BranchSettingsModel::updateOrCreate(['branch' => $branch], $data);


        Session::put('company_name', $qsettings_branch->company_name);
        Session::put('company_cr', $qsettings_branch->company_cr);
        Session::put('company_vat', $qsettings_branch->company_vat);
        Session::put('preview', $qsettings_branch->preview);
        Session::put('common_customer_database', $qsettings_branch->common_customer_database);
        Session::put('pdfletterheader_top', $qsettings_branch->pdfletterheader_top);
        Session::put('pdfletterfooter_bottom', $qsettings_branch->pdfletterfooter_bottom);
        Session::put('pdfheader_top', $qsettings_branch->pdfheader_top);
        Session::put('pdffooter_bottom', $qsettings_branch->pdffooter_bottom);

        Session::put('branch_settings', $qsettings_branch);
        $out = array(
            'msg' => 'Details Saved Success',
            'status' => 1,
        );
        echo json_encode($out);
    }
}

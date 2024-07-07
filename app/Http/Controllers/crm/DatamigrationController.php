<?php

namespace App\Http\Controllers\crm;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use App\Imports\CustomermainImport;
use App\Imports\SuppliermainImport;
use Carbon\Carbon;
use App\crm\CustomerModel;
use App\crm\SupplierModel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatamigrationController extends Controller
{
	public function customerdatamigration()
	{
		return view('crm.datamigration.exportcustomer');
	}
	public function customer_download()
    {
       $filepath = public_path('customer.xlsx');
       if(ob_get_length() > 0) {
        ob_end_clean(); 
    }

            
            ob_start(); 
         return response()->download($filepath, 'customer.xlsx', [
        'Content-Type' => 'application/vnd.ms-excel',
        'Content-Disposition' => 'inline; filename="customer.xlsx"'
    ]);
    }
    public function submit_file_customer(Request $request)
    {
	  Excel::import(new CustomermainImport, $request->file('file')->store('temp'));
      return redirect()->route('Customer Information')->with('message', 'State saved correctly!!!');

    }
    
    public function supplierdatamigration()
	{
		return view('crm.datamigration.exportsupplier');
	}
	public function supplier_download()
    {
       $filepath = public_path('supplier.xlsx');
       if(ob_get_length() > 0) {
        ob_end_clean(); 
    }
         return response()->download($filepath, 'supplier.xlsx', [
        'Content-Type' => 'application/vnd.ms-excel',
        'Content-Disposition' => 'inline; filename="customer.xlsx"'
    ]);
    }
    public function submit_file_supplier(Request $request)
    {
	  Excel::import(new SuppliermainImport, $request->file('file')->store('temp'));
      return redirect()->route('supplierdetails')->with('message', 'State saved correctly!!!');
    }
}
?>
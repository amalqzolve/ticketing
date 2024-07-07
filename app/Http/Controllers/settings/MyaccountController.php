<?php
namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use View;
use Yajra\DataTables\DataTables;
use App\settings\BranchSettingsModel;
use Session;
class MyaccountController extends Controller
{
    public function index()
    {
           $branch=Session::get('branch');
         return view('settings.myaccount.index');

    }
}
?>
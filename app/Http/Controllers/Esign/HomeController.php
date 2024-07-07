<?php

namespace App\Http\Controllers\Esign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Boq;
use File;
use Response;
use App\boq\BoqProductModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BoqmainImport;
use App\Imports\BoqchildImport;
use Illuminate\Support\Facades\Log;
use App\crm\CustomerModel;
use App\Tender\TenderModel;
use Carbon\Carbon;
use DataTables;




class HomeController extends Controller
{

  public function index()
  {
    return view('esign.home');
  }
  public function newPage()
  {
    return view('esign.newpage.list');
  }
  public function newForm()
  {
    return view('esign.newpage.form');
  }
  public function signform()
  {
    return view('esign.newpage.signform');
  }
  public function approvals()
  {
    return view('esign.newpage.approvals');
  }
}

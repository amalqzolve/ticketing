<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use App\settings\BranchSettingsModel;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = '/home';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function showLoginForm()
  {
    $branch = DB::table('a_accounts')->select('id', 'label')->get();
    return view('auth.login', ['branches' => $branch]);
  }

  protected function credentials(Request $request)
  {
    return [
      'email' => request()->email,
      'password' => request()->password,
      'branch' => request()->branch
    ];
  }

  protected function authenticated(Request $request, $user)
  {
    $branch =  $request->branch;
    Session::put('branch', $request->branch);
    $qsettings_branch = BranchSettingsModel::where('branch', $request->branch)->first();
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
    $account_credentials =  DB::table('a_accounts')->where('id', $branch)->first();
    Session::put('account_credentials', $account_credentials);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    Session::flush();
    return redirect('/login');
  }
}

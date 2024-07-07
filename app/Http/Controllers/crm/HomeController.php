<?php
namespace App\Http\Controllers\crm;
use Illuminate\Http\Request;
use Auth;
use PDF;
use DB;
use Session;
          // $branch=Session::get('branch');


class HomeController extends Controller
{
    public function __construct()
    {   
    }
    public function index()
    {
           $branch=Session::get('branch');

         return view('crm.home',compact('branch'));
    }
    public function test()
    {
        return view('crm.test');
    }

      

    public function show($groupID,$branch) {

     //   return 'I am group id ' . $groupID;
        Auth::loginUsingId($groupID, true);
          Session::put('branch', $branch);
      //  var_dump(Auth::user()->roles()->get()); exit();
        return redirect()->intended('/home');
    } 



function generate_pdf() {
    $data = [
        'foo' => 'bar'
    ];
    $pdf = PDF::loadView('pdftest', $data);
    return $pdf->stream('document.pdf');
}
public function changepic(Request $request)
    {
        $id = $request->id;

        return view('crm.changepic',compact('id'));
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


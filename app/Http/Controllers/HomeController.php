<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class HomeController extends Controller
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

        $userID = auth()->user()->id;
        $branch = Session::get('branch');

        $profile =  DB::table('users')->where('id', '=', $userID)->orderBy('id', 'asc')->pluck('image');
        $logo =  DB::table('qsettings_company')->where('branch', $branch)->value('companylogo');


        Session::put('profile', $profile);

        return view('home')->with('userID', $userID)->with('branch', $branch)->with('logo', $logo);
        //return view('home',compact('logo'));
    }

    public function test()
    {
        return view('test');
    }


    public function barcode()
    {

        echo DNS2D::getBarcodeHTML('4445645656', 'QRCODE');
        echo DNS2D::getBarcodePNGPath('4445645656', 'PDF417');
        echo DNS2D::getBarcodeSVG('4445645656', 'DATAMATRIX');



        echo DNS1D::getBarcodeHTML('4445645656', 'C39');
        echo DNS1D::getBarcodeHTML('4445645656', 'C39+');
        echo DNS1D::getBarcodeHTML('4445645656', 'C39E');
        echo DNS1D::getBarcodeHTML('4445645656', 'C39E+');
        echo DNS1D::getBarcodeHTML('4445645656', 'C93');
        echo DNS1D::getBarcodeHTML('4445645656', 'S25');
        echo DNS1D::getBarcodeHTML('4445645656', 'S25+');
        echo DNS1D::getBarcodeHTML('4445645656', 'I25');
        echo DNS1D::getBarcodeHTML('4445645656', 'I25+');
        echo DNS1D::getBarcodeHTML('4445645656', 'C128');
        echo DNS1D::getBarcodeHTML('4445645656', 'C128A');
        echo DNS1D::getBarcodeHTML('4445645656', 'C128B');
        echo DNS1D::getBarcodeHTML('4445645656', 'C128C');
        echo DNS1D::getBarcodeHTML('44455656', 'EAN2');
        echo DNS1D::getBarcodeHTML('4445656', 'EAN5');
        echo DNS1D::getBarcodeHTML('4445', 'EAN8');
        echo DNS1D::getBarcodeHTML('4445', 'EAN13');
        echo DNS1D::getBarcodeHTML('4445645656', 'UPCA');
        echo DNS1D::getBarcodeHTML('4445645656', 'UPCE');
        echo DNS1D::getBarcodeHTML('4445645656', 'MSI');
        echo DNS1D::getBarcodeHTML('4445645656', 'MSI+');
        echo DNS1D::getBarcodeHTML('4445645656', 'POSTNET');
        echo DNS1D::getBarcodeHTML('4445645656', 'PLANET');
        echo DNS1D::getBarcodeHTML('4445645656', 'RMS4CC');
        echo DNS1D::getBarcodeHTML('4445645656', 'KIX');
        echo DNS1D::getBarcodeHTML('4445645656', 'IMB');
        echo DNS1D::getBarcodeHTML('4445645656', 'CODABAR');
        echo DNS1D::getBarcodeHTML('4445645656', 'CODE11');
        echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA');
        echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function changepic(Request $request)
    {
        $id = $request->id;

        return view('changepic', compact('id'));
    }

    public function submit_changepic(Request $request)
    {
        $id                 = $request->id;

        $data               = [

            'image'       => $request->fileData,

        ];

        $brand          = DB::table('users')->where('id', $id)->update($data);
        Session::pull('profile');
        Session::put('profile', $request->fileData);
        return 'true';
    }




    public function ProductCode(Request $request)
    {

        /*  $id = IdGenerator::generate(['table' => 'qpurchase_autoincrement', 'length' => 6, 'prefix' => date('1')]);*/
        $id = IdGenerator::generate(['table' => 'qpurchase_autoincrement', 'field' => 'number', 'length' => 10, 'prefix' => 'P']);



        $data = [
            'number' => $id,


        ];
        $dser = DB::table('qpurchase_autoincrement')->insert($data);


        return response()->json($id);
    }
}

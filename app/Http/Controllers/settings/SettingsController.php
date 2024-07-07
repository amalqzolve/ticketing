<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use View;
use Yajra\DataTables\DataTables;
use App\settings\BranchSettingsModel;

use App\settings\WalletModel;
use App\settings\WalletTransactionModel;

use Session;
class SettingsController extends Controller
{
	public function customefields()
	{
    	 return view('settings.customefields.custom');

	}
	public function customfieldsubmit(Request $request)
	{
		DB::table('qsettings_custom_fields')->delete();
        for($i=0;$i<count($request->labels);$i++)
        {
            $data1 = [
                
            'labels' => $request->labels[$i],
            
        ];
            DB::table('qsettings_custom_fields')->insert($data1);
        }
        return 'true';
	}
	 
}

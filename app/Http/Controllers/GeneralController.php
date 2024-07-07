<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GeneralController extends Controller
{
    public function getTermsFromId(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qcrm_termsandconditions')->select('id', 'term', 'description')->where('id', $id)->first();
        $out = array(
            'status' => 1,
            'data' => $data
        );
        echo json_encode($out);
    }
}

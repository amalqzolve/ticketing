<?php

namespace App\Http\Controllers\crm;

use Illuminate\Http\Request;
use App\Traits\AccountingActionsTrait;
use DB;


class CommonController extends Controller
{
    use AccountingActionsTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('crm.home');
    }
    public function detUniqueID()
    {
        return json_encode(uniqid());
    }

    public function getAccountingNextCode(Request $request)
    {
        $this->connectToAccounting();
        $id = $request->id;

        // $this->DB1->where('id', $id);
        // $p_group_code = $this->DB1->get('groups')->row()->code;
        // $this->DB1->where('group_id', $id);
        // $q = $this->DB1->get('ledgers')->result();

        $p_group = DB::connection('mysql_accounting')->table('groups')->where('id', $id)->select('code')->first();

        $q = DB::connection('mysql_accounting')->table('ledgers')->where('group_id', $id)->orderBy('id', 'desc')->first();
        $p_group_code = $p_group->code;
        if ($q) {
            // $last = end($q);
            $last = $q->code;
            $l_array = explode('-', $last);
            $new_index = end($l_array);
            $new_index += 1;
            $new_index = sprintf("%04d", $new_index);
            $outCode = $p_group_code . "-" . $new_index;
        } else
            $outCode = $p_group_code . "-0001";
        $out = array(
            'status' => 1,
            'msg' => 'Success',
            'code' => $outCode
        );
        echo json_encode($out);
    }
}

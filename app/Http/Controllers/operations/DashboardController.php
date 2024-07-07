<?php

namespace App\Http\Controllers\operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Auth;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use Session;
// use Spatie\Activitylog\Models\Activity;
use DB;

use App\operations\EntryModel;
use DataTables;

class DashboardController extends Controller
{
   
 public function show() 
    {

       return view('operations.dashboard.index');

    } 
 public function operational_entries(Request $request)
    {
  $branch=Session::get('branch');
 $branch=Session::get('branch');
            $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
            $subledgertable= $subtable.'ledgers';
            $subentrytypestable= $subtable.'entrytypes';


         if ($request->ajax()) {

            $query  = DB::table('qsales_entries')->leftjoin($subledgertable,'qsales_entries.account_name','=',$subledgertable.'.id')->leftjoin($subentrytypestable,'qsales_entries.entrytype_id','=',$subentrytypestable.'.id')->select('qsales_entries.*',$subentrytypestable.'.name as entrytype_id1' ,$subledgertable.'.name as account_names')
                ->orderby('qsales_entries.id', 'desc');



          /*  $query  = DB::table('qsales_entries')->select('qsales_entries.*')
                ->orderby('id', 'desc');
*/
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = EntryModel::count();
             return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
       return view('operations.entries.listing');
    }
    public function post_entry(Request $request)
    {
      $id = $request->id;
  $branch=Session::get('branch');

      //
        $entry = DB::table('qsales_entries')->select('*')->where('id', '=', $id)->get();

foreach ($entry as $key => $value) {

$entrytype_id=$value->entrytype_id;
   
  $dr_total=$value->dr_total;
  $cr_total=$value->cr_total;
 $number = $this->nextNumber($entrytype_id);



$data_accounts = [
                  'entrytype_id'   => $entrytype_id,
                  'number'         => $number,
                  'date'           => date("Y-m-d"),
                  'dr_total'       => $dr_total,
                  'cr_total'       => $cr_total,
                    'notes'       => '-',
            ];


      
 $main_entry = DB::table('qlogistic_accountsentries')->insert($data_accounts);
// $main_entry_id = $main_entry->id;
$main_entry_id =DB::getPdo()->lastInsertId();


    $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
              $sub_entryitems= $subtable.'entryitems'; 
              $sub_entries= $subtable.'entries'; 

$sub_entry = DB::table($sub_entries)->insert($data_accounts);
$sub_entry_id =DB::getPdo()->lastInsertId();

 $entry_items = DB::table('qsales_entryitems')->select('*')->where('entry_id', '=', $id)->get();

 foreach ($entry_items as $keys => $values) {
 $main_ledger=$value->ledger_id;
  $amount=$value->amount;
  $dc=$value->dc;

     $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $main_ledger,
                                'amount'     => $amount,
                                'dc'         => $dc,
                                'narration'         => '-',
                                 ];
    DB::table('qlogistic_accountsentryitems')->insert($data_accounts_items);


 $data_accounts_items_sub =[
                                'entry_id'   => $sub_entry_id,
                                'ledger_id'  => $main_ledger,
                                'amount'     => $amount,
                                'dc'         => $dc,
                                'narration'         => '-',
                                 ];
    DB::table($sub_entryitems)->insert($data_accounts_items_sub);





  
 }








 




}
      //
      EntryModel::where('id', $id)->update(array('pstatus' => 1));
  
    return redirect()->route('operational_entries')->with('message', 'State saved correctly!!!');
     }



 public function nextNumber($id) {

    $max = DB::table('qlogistic_accountsentries')->where('entrytype_id',$id)->max('number');
 
/*   foreach ($max as $key => $value) {
    if (empty($value->max)) {
        $maxNumber = 0;
      } else {
        $maxNumber = $value->max;
      }
   }*/
    if (empty($max)) {
        $maxNumber = 0;
      } else {
        $maxNumber = $max;
      }

      return $maxNumber + 1;
    }

}
?>

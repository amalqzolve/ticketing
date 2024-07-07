<?php



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


    


//Accounting
  $company_accounts = DB::table('qsettings_company_accounts')->select('*')->where('branch', '=', $branch)->get();

  //sales_inv_entry_type
  //sales_inv_entry_type_post
  $sales_inv_entry_type=0;
  $entry_post=0;
   $sales_evenue_account=0;
foreach ($company_accounts as $key => $value) {
$sales_inv_entry_type=$value->sales_inv_entry_type;
$entry_post=$value->sales_inv_entry_type_post;
$sales_evenue_account=$value->sales_evenue_account;
$output_vat_ledger=$value->output_vat_ledger;
}
 $number = $this->nextNumber($sales_inv_entry_type);
if($entry_post==1){

 


$data['accounts'] = CustomerModel::where('id', $request->customer)->get();
      //dd($data['accounts']);      
foreach ($data['accounts'] as $key => $value) {
    $main_ledger=$value->main_ledger;
    $sub_ledger=$value->sub_ledger;
}

$data_accounts = [
                  'entrytype_id'   => $sales_inv_entry_type,
                  'number'         => $number,
                  'date'           => date("Y-m-d"),
                  'dr_total'       => abs($request->grandtotalamount),
                  'cr_total'       => abs($request->grandtotalamount),
            ];


      
 $main_entry = DB::table('qlogistic_accountsentries')->insert($data_accounts);
// $main_entry_id = $main_entry->id;
$main_entry_id =DB::getPdo()->lastInsertId();


    $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $main_ledger,
                                'amount'     => abs($request->grandtotalamount),
                                'dc'         => 'D',
                                'narration'         => '-',
                                 ];
    DB::table('qlogistic_accountsentryitems')->insert($data_accounts_items);
    $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $sales_evenue_account,
                                'amount'     => abs($request->totalamount),
                                'dc'         => 'C',
                                'narration'         => '-',
                                 ];

                               


    DB::table('qlogistic_accountsentryitems')->insert($data_accounts_items);
  

      $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $output_vat_ledger,
                                'amount'     => abs($request->totalvatamount),
                                'dc'         => 'C',
                                'narration'         => '-',
                                 ];

                               


    DB::table('qlogistic_accountsentryitems')->insert($data_accounts_items);
  

  //  output_vat_ledger




        $subtable=DB::table('a_accounts') ->where('id', '=', $branch)->orderBy('id','asc')->value('db_prefix');
              $sub_entryitems= $subtable.'entryitems'; 
              $sub_entries= $subtable.'entries'; 
              //branch
              $data_accounts = [
                  'entrytype_id'   => $sales_inv_entry_type,
                  'number'         => $number,
                  'date'           => date("Y-m-d"),
                  'dr_total'       => abs($request->grandtotalamount),
                  'cr_total'       => abs($request->grandtotalamount),
                  'notes'       => '-',
            ];


      
 $main_entry = DB::table($sub_entries)->insert($data_accounts);
 $main_entry_id =DB::getPdo()->lastInsertId();

/* $main_entry_id = $main_entry->id;*/



    $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $main_ledger,
                                'amount'     => abs($request->grandtotalamount),
                                'dc'         => 'D',
                                'narration'         => '-',
                                 ];
    DB::table($sub_entryitems)->insert($data_accounts_items);
    $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $sales_evenue_account,
                                'amount'     => abs($request->totalamount),
                                'dc'         => 'C',
                                'narration'         => '-',
                                 ];
    DB::table($sub_entryitems)->insert($data_accounts_items);

     $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $output_vat_ledger,
                                'amount'     => abs($request->totalvatamount),
                                'dc'         => 'C',
                                'narration'         => '-',
                                 ];
    DB::table($sub_entryitems)->insert($data_accounts_items);

  


//auto


$data_accounts = [
                  'entrytype_id'   => $sales_inv_entry_type,
                  'number'         => $number,
                  'date'           => date("Y-m-d"),
                  'dr_total'       => abs($request->grandtotalamount),
                  'cr_total'       => abs($request->grandtotalamount),
                  'notes'       => '-',
                  'branch'       => $branch=Session::get('branch'),
                  'pstatus'       => 1,
                  'entry_type'       => $sales_inv_entry_type,
                  'category'       => 'Direct Invoice',
                  'account_name'       => $sales_evenue_account,
            ];


      
 $main_entry = DB::table('qsales_entries')->insert($data_accounts);
  $main_entry_id =DB::getPdo()->lastInsertId();
 //$main_entry_id = $main_entry->id;



    $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $main_ledger,
                                'amount'     => abs($request->grandtotalamount),
                                'dc'         => 'D',
                                'narration'         => '-',
                                 ];
    DB::table('qsales_entryitems')->insert($data_accounts_items);
    $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $sales_evenue_account,
                                'amount'     => abs($request->totalamount),
                                'dc'         => 'C',
                                'narration'         => '-',
                                 ];
    DB::table('qsales_entryitems')->insert($data_accounts_items);


 $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $output_vat_ledger,
                                'amount'     => abs($request->totalvatamount),
                                'dc'         => 'C',
                                'narration'         => '-',
                                 ];
    DB::table('qsales_entryitems')->insert($data_accounts_items);







    //end-auto
              //branch
   
}
if($entry_post==2){

    


$data['accounts'] = CustomerModel::where('id', $request->customer)->get();
            
foreach ($data['accounts'] as $key => $value) {
    $main_ledger=$value->main_ledger;
    $sub_ledger=$value->sub_ledger;
}

$data_accounts = [
                  'entrytype_id'   => $sales_inv_entry_type,
                  'number'         => $number,
                  'date'           => date("Y-m-d"),
                  'dr_total'       => abs($request->grandtotalamount),
                  'cr_total'       => abs($request->grandtotalamount),
                  'notes'       => '-',
                  'branch'       => $branch=Session::get('branch'),
                  'pstatus'       => 0,
                  'entry_type'       => $sales_inv_entry_type,
                  'category'       => 'Direct Invoice',
                  'account_name'       => $sales_evenue_account,
            ];


      
      
      
 $main_entry = DB::table('qsales_entries')->insert($data_accounts);
  $main_entry_id =DB::getPdo()->lastInsertId();
 //$main_entry_id = $main_entry->id;



    $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $main_ledger,
                                'amount'     => abs($request->grandtotalamount),
                                'dc'         => 'D',
                                'narration'         => '-',
                                 ];
    DB::table('qsales_entryitems')->insert($data_accounts_items);
    $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $sales_evenue_account,
                                'amount'     => abs($request->totalamount),
                                'dc'         => 'C',
                                'narration'         => '-',
                                 ];
    DB::table('qsales_entryitems')->insert($data_accounts_items);

     $data_accounts_items =[
                                'entry_id'   => $main_entry_id,
                                'ledger_id'  => $output_vat_ledger,
                                'amount'     => abs($request->totalvatamount),
                                'dc'         => 'C',
                                'narration'         => '-',
                                 ];
    DB::table('qsales_entryitems')->insert($data_accounts_items);
    
  

    


}

  //Accounting


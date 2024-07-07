<?php
namespace App\Http\Controllers\sell;
use DB;
use Auth;
use Session;
use App\crm\CustomerCategoryModel;
use App\crm\CustomerTypeModel;
use App\crm\CustomerGroup;
use App\crm\countryModel;
use App\inventory\ProductdetailslistModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\settings\BranchSettingsModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use MuktarSayedSaleh\ZakatTlv\Encoder;
class DummyController extends Controller
{
	public function dummysubmit(Request $request)
	{

		$invoices = DB::table('qsales_salesorder')->get();
		
		foreach($invoices as $invoicess)
		{
			$id = $invoicess->id;
			$qtnref = $invoicess->qtnref; 
			$po_wo_ref = $invoicess->po_wo_ref; 
			$customer = $invoicess->customer; 
			$attention = $invoicess->attention; 
			$salesman = $invoicess->salesman; 
			$quotedate = $invoicess->quotedate; 
			$validity = $invoicess->validity; 
			$currency = $invoicess->currency; 
			$currencyvalue = $invoicess->currencyvalue; 
			$totalamount = $invoicess->totalamount; 
			$discount = $invoicess->discount; 
			$amountafterdiscount = $invoicess->amountafterdiscount; 
			$vatamount = $invoicess->vatamount; 
			$grandtotalamount = $invoicess->grandtotalamount; 
			$terms = $invoicess->terms; 
			$notes = $invoicess->notes; 
			$preparedby = $invoicess->preparedby; 
			$approvedby = $invoicess->approvedby; 
			$del_flag = $invoicess->del_flag;
			$branch = $invoicess->branch; 
			$created_at = $invoicess->created_at; 
			$updated_at = $invoicess->updated_at; 
			$status = $invoicess->status; 
			$p_status = $invoicess->p_status; 
			$tpreview = $invoicess->tpreview; 
			$po_id = $invoicess->po_id; 
			$po_date = $invoicess->po_date; 
			$po_note = $invoicess->po_note; 
			$invoice_type = $invoicess->invoice_type; 
			$user_id = $invoicess->user_id; 
			$paid_amount = $invoicess->paid_amount; 
			$due_amount = $invoicess->due_amount; 

			$sale_order_data = [
				'id'=>$id,
   		   	 	'sale_type'=> 'Direct',
   		   	 	'quote_id'=> '',
				'quotedate' => $quotedate, 
				'valid_till' => $validity,
				'qtn_ref'=> $qtnref,
				'po_ref'=>$po_wo_ref,
				'delivery_period'=>'',
				'attention'=>$attention,
				'salesman'=>$salesman,
				'currency'=>$currency,
				'currencyvalue'=>$currencyvalue,
				'preparedby'=>$preparedby,
				'approvedby'=>$approvedby,
				'discount_type' =>1,
				'customer'=>$customer,
				'terms_conditions'=>$terms,
				'notes'=>$notes,
				'internal_reference'=>'',
				'tpreview'=>$tpreview,
			    'documents'=>'',
				'totalamount'=>$totalamount,
				'discount'=>$discount,
				'amountafterdiscount'=>$amountafterdiscount,
				'vatamount'=>$vatamount,
				'grandtotalamount'=>$grandtotalamount,
				'branch'=>$branch,
				'user_id'=>$user_id,
				'payment_terms'=>'',
				'podate'=>$po_date,
				'status'=>$status,
				'del_flag'=>$del_flag,
				'created_at'=>$created_at,
				'updated_at'=>$updated_at,
					];		

             DB::table('qsell_saleorder')->insert($sale_order_data);
         $saleorder_id = DB::getPdo()->lastInsertId();  




$invoice_data = [
				'id'=> $id,
   		   	    'invoice_number' => $id,
   		   	    'sale_type'=>'Direct',
   		     	'saleorder_id'=>$saleorder_id,
				'quotedate' => $quotedate, 
				'valid_till' => $validity,
				'qtn_ref'=>$qtnref,
				'po_ref'=>$po_wo_ref,
				'delivery_period'=>'',
				'attention'=>$attention,
				'salesman'=>$salesman,
				'currency'=>$currency,
				'currencyvalue'=>$currencyvalue,
				'preparedby'=>$preparedby,
				'approvedby'=>$approvedby,
				'customer'=>$customer,
				'terms_conditions'=>$terms,
				'notes'=>$notes,
				'internal_reference'=>'',
				'tpreview'=>$tpreview,
				'totalamount'=>$totalamount,
				'discount'=>$discount,
				'discount_type'=>1,
				'amountafterdiscount'=>$amountafterdiscount,
				'vatamount'=>$vatamount,
				'grandtotalamount'=>$grandtotalamount,
				'branch'=>$branch,
				'user_id'=>$user_id,
				'payment_terms'=>'',
				'sale_method'=>'',
				'paid_amount'=>$paid_amount,
				'balance_amount'=>$due_amount,
				'useadvance' => '',
				'status'=>$status,
				'del_flag'=>$del_flag,
				'created_at'=>$created_at,
				'updated_at'=>$updated_at,

					];		


          DB::table('qsell_saleinvoice')->insert($invoice_data);

 $invoice_id = DB::getPdo()->lastInsertId();




         

          		$invoices_products = DB::table('qsales_salesorder_products')->where('qsales_salesorder_products.quotationid',$id)->get();		 
          //
foreach($invoices_products as $invoices_productss)
{
	$id= $invoices_productss->id;
	$quotationid= $invoices_productss->quotationid;
	$itemname= $invoices_productss->itemname;
	$description= $invoices_productss->description;
	$unit= $invoices_productss->unit;
	$quantity= $invoices_productss->quantity;
	$rate= $invoices_productss->rate;
	$amount= $invoices_productss->amount;
	$vatamount= $invoices_productss->vatamount;
	$vat_percentage= $invoices_productss->vat_percentage;
	$rdiscount= $invoices_productss->rdiscount;
	$totalamount= $invoices_productss->totalamount;
	$del_flag= $invoices_productss->del_flag;
	$branch= $invoices_productss->branch;
	$created_at= $invoices_productss->created_at;
	$updated_at= $invoices_productss->updated_at;

	$sale_order_product_data = [
				'id'=>$id,
				'saleorder_id' => $saleorder_id,        
				'item_id' => $itemname,      
				'description'=> $description,             
				'unit'         => $unit,  
				'quantity'   => $quantity,
				'delivery_remaining'   => $quantity,
				'invoice_remaining'   => 0, 	           
				'rate'     => $rate,            
				'amount' => $amount, 
				'vatamount' => $vatamount,  
				'vat_percentage' => $vat_percentage, 
				'discount' => $rdiscount,   
			    'totalamount'=> $totalamount,                   
				'branch' =>$branch,
				'created_at'=>$created_at,
				'updated_at'=>$updated_at,
				'del_flag'=>$del_flag,
								 ];		
				DB::table('qsell_saleorder_products')->insert($sale_order_product_data);


$invoice_product_data = [
					'id'=>$id,
				'invoice_id' => $invoice_id,        
				'item_id' => $itemname,      
				'description'=> $description,             
				'unit'         => $unit,  
				'quantity'   => $quantity,           
				'rate'     => $rate,            
				'amount' => $amount, 
				'vatamount' => $vatamount,  
				'vat_percentage' => $vat_percentage, 
				'discount' => $rdiscount,   
			    'totalamount'=> $totalamount,                   
				'branch' =>$branch,
				'created_at'=>$created_at,
				'updated_at'=>$updated_at,
				'del_flag'=>$del_flag,
								 ];		
				DB::table('qsell_saleinvoice_products')->insert($invoice_product_data);






}




































   	
		/*Generate Zakat QR code*/
				$company_name='';
				$company_vat='';
				$company_details = DB::table('qsettings_company')->select('*')->first();
				$company_name=$company_details->company_name;
				$company_vat=$company_details->company_vat;
				 // $quotedate=Carbon::parse($request->quotedate)->format('Y-m-d  h:i');
			  //    $grandtotalamount=$request->grandtotalamount;
			  //    $totalvatamount=$request->totalvatamount;


				 $qrtextof='Seller Name :-> '.$company_name.', Vat Number :-> '.$company_vat.', Datetime :-> '.$quotedate.', Vat Total :-> '.$vatamount.', Total  :->'.$grandtotalamount;


				$encoder = new Encoder();
				$qr_signature = $encoder->encode(
				    $company_name,
				    $company_vat,
				    null,
				    $grandtotalamount,
				    $vatamount
				);

				$qrcode = QrCode::size(200)->format('svg')->generate($qr_signature, storage_path('app/public/QRinvoice/'.str_slug($id).'.svg'));

				/*Generate Zakat QR code*/



}


         }     




       
				
						



}
?>

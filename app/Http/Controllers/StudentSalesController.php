<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PDF;
use View;
use DB;
use Auth;
use Yajra\DataTables\DataTables;
use Session;
use Carbon\Carbon;
use App\Student_Model;

class StudentSalesController extends Controller
{
	public function studentsales(Request $request)
    {

           // $branch=Session::get('branch');
           if ($request->ajax()) {
            $query  = DB::table('sales_order')->select('sales_order.*',DB::raw("DATE_FORMAT(sales_order.inv_issuedate, '%d-%m-%Y %h:%i') as inv_issuedate"),DB::raw("DATE_FORMAT(sales_order.inv_dateofsupply, '%d-%m-%Y') as inv_dateofsupply"))->orderby('sales_order.id', 'desc');
            $query->where('sales_order.del_flag', 1)->orderby('sales_order.id', 'desc');
            $data = $query->get(); 
            $count_filter = $query->count();
            $count_total = Student_Model::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
        
         return view('student.listing');
    }
    public function Add(Request $request)
    {
         return view('student.add');

    }
    
    public function studentinvoicesubmit(Request $request)
    {
        $user_id = Auth::user()->id;
        $branch=Session::get('branch');
        $postID = $request->id;
    
        $data = [
                'inv_no' => '1',        
                'inv_issuedate' => Carbon::parse($request->quotedate)->format('Y-m-d  h:i'),      
                'inv_dateofsupply'     => Carbon::parse($request->dateofsupply)->format('Y-m-d  h:i'),             
                'inv_qtn_ref'         => $request->qtnref,  
                'inv_po_wo_ref'   => $request->po_wo_ref,
                'st_name'   => $request->cust_name,           
                'st_buildingno' => $request->building_no, 
                'st_streetname' => $request->cust_region,  
                'district'   => $request->cust_district,           
                'city' => $request->cust_city, 
                'country' => $request->cust_country, 
                'postalcode'=>$request->cust_zip,
                'mobileno'=>$request->mobile, 
                'vatno'=>$request->vatno,
                'buyerid_crno'=>$request->buyerid_crno,   
                'totalamount'=> $request->totalamount,     
                'discount' => $request->discount,         
                'amountafterdiscount' => $request->amountafterdiscount,       
                'vatamount' => $request->totalvatamount, 
                'grandtotalamount' => $request->grandtotalamount,    
                'terms' => $request->terms,                   
                'notes' => $request->notes,           
                'preparedby' => $request->preparedby,         
                'approvedby' => $request->approvedby,                  
                'user_id'=>$user_id,
            
                  ];      

                // $quotation = CustomInvoiceModel::updateOrCreate(['id' => $postID], $data);
                    $quotation = Student_Model::updateOrCreate(['id' => $postID], $data);
                $quotationid = $quotation->id;

                DB::table('sales_order_products')->where('invoiceno',$quotationid)->delete();

                for ($i = 0; $i < count($request->productname); $i++)
                 {
                    $data = [
                'invoiceno' => $quotationid,  
                'inv_no' =>'1',      
                'itemname' => $request->productname[$i],      
                'description'     => $request->product_description[$i],             
                'unit'         => $request->unit[$i],  
                'quantity'   => $request->quantity[$i], 
                'discount' => $request->discountamount[$i],
                'vatpercentage'=>     $request->vat_percentage[$i],     
                'rate'     => $request->rate[$i],            
                'amount' => $request->amount[$i], 
                'vatamount' => $request->vatamount[$i],  
                'totalamount'=> $request->row_total[$i]
                                 ];      
               $quotation_product = DB::table('sales_order_products')->insert($data);
                
                 }
          
    }
    public function studentinvoice_edit(Request $request)
    {
    	$id = $request->id;
    	$sinvoice   = DB::table('sales_order')->select('*')->where('id',$id)->where('del_flag',1)->get();

        $sinvoice_product   = DB::table('sales_order_products')->select('*')->where('invoiceno',$id)->where('del_flag',1)->get();
     return view('student.edit',compact('sinvoice','sinvoice_product'));   
    }
    
    
}
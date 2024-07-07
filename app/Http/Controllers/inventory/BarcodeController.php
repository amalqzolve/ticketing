<?php
namespace App\Http\Controllers\inventory;
use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use DB;
use Spatie\Activitylog\Models\Activity;
use PDF;
use DataTables;
use Session;
use App\inventory\ProductdetailslistModel;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
  use Zend\Barcode\Barcode;
class BarcodeController extends Controller
{
	 public function Add_barcode()
    {
           $branch=Session::get('branch');
           $product = DB::table('qinventory_products')->select('qinventory_products.*')->where('qinventory_products.branch',$branch)->where('qinventory_products.del_flag',1)->get();
           $html = "";
           $button = "";
         return view('inventory.barcode.add',compact('product','branch','html','button'));
    }
    public function submit_barcode(Request $request)
    {

//dd($request);
/*     "productname" => "2"
      "barcode_format" => "code128"
      "style" => "24"
      "pcount" => "100"
      "site_name" => "1"
      "product_name" => "1"
      "price" => "1"
      "currencies" => "1"
      "unit" => "1"
      "category" => "1"*/

      $pcount = $request->pcount;
        $style = $request->style;
     /* $barcode_format = $request->barcode_format;*/
               $sitename='';
                $company_details = DB::table('qsettings_company')->select('*')->first();
                $sitename=$company_details->company_name;

     $id = $request->productname;
      $barcode_format = $request->barcode_format;
     /*  $product = DB::table('qinventory_products')->select('*','qinventory_product_unit.unit_name as unit1','qinvoice_category.category_name1')->where('product_id',$request->productname)->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')->get();*/
    $product = DB::table('qinventory_products')
                                ->leftJoin('qinvoice_category', 'qinventory_products.category', '=', 'qinvoice_category.id')
                                ->leftJoin('qinventory_product_unit', 'qinventory_products.unit', '=', 'qinventory_product_unit.id')->leftJoin('qcrm_supplier', 'qinventory_products.provider_id', '=', 'qcrm_supplier.id')->leftJoin('qinventory_manufacture', 'qinventory_products.manufacturer', '=', 'qinventory_manufacture.id')->leftJoin('qinventory_brand', 'qinventory_products.brand', '=', 'qinventory_brand.id')->leftJoin('qinventory_warehouse', 'qinventory_products.warehouse', '=', 'qinventory_warehouse.id')->select('qinventory_products.product_name','qinventory_products.product_code','qinventory_products.barcode','qinventory_product_unit.unit_name as unitname','qinventory_products.out_of_stock_status','qinventory_products.product_status','qinventory_products.description','qinventory_products.product_id', 'qinvoice_category.category_name','qinventory_products.selling_price','qinventory_products.product_price','qinventory_products.part_no','qinventory_products.model_no','qinventory_products.available_stock','qinventory_products.sku','qinventory_warehouse.warehouse_name','qinventory_brand.brand_name','qcrm_supplier.sup_name','qinventory_manufacture.manufacture_name','qinventory_products.supplier_name','qinventory_products.manufacturer_name','qinventory_products.serial_number','qinventory_products.hsn_code','qinventory_products.lotno','qinventory_products.countryoforigin','qinventory_products.catno','qinventory_products.cfds')->orderby('qinventory_products.product_id', 'desc');
                                $product->where('product_id',$request->productname);
                                // $query->where('qinventory_products.product_id',NULL);
                                $data = $product->get();

    $product_name='';
    $barcode='';
    $selling_price='';
    $unitname='';
    $category_name='';



foreach ($data as $key => $value) {
    
    $product_name=$value->product_name;
    $barcode=$value->product_code;
    $selling_price=$value->selling_price;
    $unitname=$value->unitname;
    $category_name=$value->category_name;
    $product_code=$value->product_code;
    $sku=$value->sku;
    $supplier_name=$value->supplier_name;
    $manufacturer_name=$value->manufacturer_name;
    $brand_name=$value->brand_name;
    $warehouse_name=$value->warehouse_name;
    $part_no=$value->part_no;
    $model_no=$value->model_no;
    $serial_number=$value->serial_number;
    $hsn_code=$value->hsn_code;
    $lotno=$value->lotno;
    $countryoforigin=$value->countryoforigin;
    $catno=$value->catno;
    $cfds = $value->cfds;
}

    $currencylistquery = DB::table('qpurchase_currency')->select('*')->where('currency_default',1)->first();

 $currency_symbol=$currencylistquery->symbol;
    
 //$barcode_format = 'ean8';

 $barcode_image=$this->product_barcode($barcode, $barcode_format, 60);


/*     "productname" => "2"
      "barcode_format" => "code128"
      "style" => "24"
      "pcount" => "100"
      "site_name" => "1"
      "product_name" => "1"
      "price" => "1"
      "currencies" => "1"
      "unit" => "1"
      "category" => "1"*/
//
      $print_site_name=0;
if(!empty($request->site_name)){
    $print_site_name=1;
}
     $print_price=0;
if(!empty($request->price)){
    $print_price=1;
}

   $print_currencies=0;
if(!empty($request->currencies)){
    $print_currencies=1;
}

 $print_unit=0;
if(!empty($request->unit)){
    $print_unit=1;
}


 $print_category=0;
if(!empty($request->category)){
    $print_category=1;
}
 $print_product_name=0;
if(!empty($request->product_name)){
    $print_product_name=1;
}

 $print_product_code=0;
if(!empty($request->product_code)){
    $print_product_code=1;
}

 $print_sku=0;
if(!empty($request->sku)){
    $print_sku=1;
}

 $print_supplier_name=0;
if(!empty($request->supplier_name)){
    $print_supplier_name=1;
}

 $print_manufacturer_name=0;
if(!empty($request->manufacturer_name)){
    $print_manufacturer_name=1;
}

 $print_brand_name=0;
if(!empty($request->brand_name)){
    $print_brand_name=1;
}

 $print_warehouse_name=0;
if(!empty($request->warehouse_name)){
    $print_warehouse_name=1;
}

 $print_part_no=0;
if(!empty($request->part_no)){
    $print_part_no=1;
}

 $print_model_no=0;
if(!empty($request->model_no)){
    $print_model_no=1;
}

 $print_serial_number=0;
if(!empty($request->serial_number)){
    $print_serial_number=1;
}

 $print_hsn_code=0;
if(!empty($request->hsn_code)){
    $print_hsn_code=1;
}

 $print_lotno=0;
if(!empty($request->lotno)){
    $print_lotno=1;
}

 $print_countryoforigin=0;
if(!empty($request->countryoforigin)){
    $print_countryoforigin=1;
}

 $print_cfds=0;
if(!empty($request->cfds)){
    $print_cfds=1;
}

 $print_catno=0;
if(!empty($request->catno)){
    $print_catno=1;
}

$print=1;


$branch=Session::get('branch');
$product = DB::table('qinventory_products')->select('qinventory_products.*')->where('qinventory_products.branch',$branch)->where('qinventory_products.del_flag',1)->get();
 return view('inventory.barcode.show',compact('product','branch','product_name','barcode_format','style','pcount','sitename','currency_symbol','unitname','selling_price','category_name','print_site_name','print_product_name','print_price','print_currencies','print_unit','print_category','print','barcode_image','print_product_code','print_sku','print_supplier_name','print_manufacturer_name','print_brand_name','print_warehouse_name','print_part_no','print_model_no','print_serial_number','print_hsn_code','print_lotno','print_countryoforigin','print_cfds','print_catno','product_code','sku','supplier_name','manufacturer_name','brand_name','warehouse_name','part_no','model_no','serial_number','hsn_code','lotno','countryoforigin','cfds','catno'));
    }
 public function product_barcode($product_code = NULL, $bcs = 'code128', $height = 60) {
    $barcode = new \Com\Tecnick\Barcode\Barcode();

      
        return $this->generate($product_code, $bcs, $height);
    }
  public function generate($text, $bcs = 'code128', $height = 50, $drawText = true, $get_be = false) {
        // Barcode::setBarcodeFont('my_font.ttf');
    $barcode = new \Com\Tecnick\Barcode\Barcode();

        $check = $this->prepareForChecksum($text, $bcs);

        $barcodeOptions = ['text' => $check['text'], 'barHeight' => $height, 'drawText' => $drawText, 'withChecksum' => $check['checksum'], 'withChecksumInText' => $check['checksum']]; //'fontSize' => 12, 'factor' => 1.5,

        $rendererOptions = ['imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle'];
        $imageResource = Barcode::draw($bcs, 'image', $barcodeOptions, $rendererOptions);




        ob_start();
        imagepng($imageResource);
        $imagedata = ob_get_contents();

        ob_end_clean();
        if ($get_be) {
            return 'data:image/png;base64,'.base64_encode($imagedata);
        }

        return "<img src='data:image/png;base64,".base64_encode($imagedata)."' alt='{$text}' class='bcimg' />";
    }
      protected function prepareForChecksum($text, $bcs) {
        if ($bcs == 'code25' || $bcs == 'code39') {
            return ['text' => $text, 'checksum' => false];
        } elseif ($bcs == 'code128') {
            return ['text' => $text, 'checksum' => true];
        }
        return ['text' => substr($text, 0, -1), 'checksum' => true];
    }

    public function printbarcode(Request $request)
    {
        $html = $request->barcodepage;
        //dd($html);
        return view('inventory.barcode.print',compact('html'));
       
    }
}
?>
<?php
namespace App\Http\Controllers;
use App\vendor;
use App\VendorCategoryModel;
use App\VendorTypeModel;
use App\vendorskill;
use App\TaxInformation;
use APP\crm\countryModel;
use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;

class vendorsController extends Controller
{
    public function index()
    { 
        return view('vendors.index');
    }
    public function addvendordetails()
    {
        $categry = VendorCategoryModel::select('id','vendor_category')->get();
        $type = VendorTypeModel::select('id','vendor_type')->get();
        return view('vendors.addvendordetails',compact('categry','type'));
    }
     public function vendorInfoTrash()
    {

     return view('vendors.trash');

    }
  
    public function vendorshow(Request $request)
    {
        $totalFiltered=0;
        $totalData = vendor::count();
        $query =  vendor::orderby('id', 'desc');
        $query->where('del_flag',1);
        if(!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id','LIKE',"%{$search}%");
            $query->orWhere('vendor_code', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_type', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_category', 'LIKE',"%{$search}%");
            $query->orWhere('salesman', 'LIKE',"%{$search}%");
            $query->orWhere('key_account', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_name', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_add1', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_add2', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_country', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_city', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_region', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_zip', 'LIKE',"%{$search}%");
            $query->orWhere('email1', 'LIKE',"%{$search}%");
            $query->orWhere('email2', 'LIKE',"%{$search}%");
            $query->orWhere('office_phone1', 'LIKE',"%{$search}%");
            $query->orWhere('office_phone2', 'LIKE',"%{$search}%");
            $query->orWhere('mobile1', 'LIKE',"%{$search}%");
            $query->orWhere('mobile2', 'LIKE',"%{$search}%");
            $query->orWhere('fax', 'LIKE',"%{$search}%");
            $query->orWhere('website', 'LIKE',"%{$search}%");
            $query->orWhere('contact_person', 'LIKE',"%{$search}%");
            $query->orWhere('mobile', 'LIKE',"%{$search}%");
            $query->orWhere('office', 'LIKE',"%{$search}%");
            $query->orWhere('contact_department', 'LIKE',"%{$search}%");
            $query->orWhere('email', 'LIKE',"%{$search}%");
            $query->orWhere('location', 'LIKE',"%{$search}%");
            $query->orWhere('invoice_add1', 'LIKE',"%{$search}%");
            $query->orWhere('invoice_add2', 'LIKE',"%{$search}%");
            $query->orWhere('shipping1', 'LIKE',"%{$search}%");
            $query->orWhere('shipping2', 'LIKE',"%{$search}%");
            $query->orWhere('portal', 'LIKE',"%{$search}%");
            $query->orWhere('username', 'LIKE',"%{$search}%");
            $query->orWhere('registerd_email', 'LIKE',"%{$search}%");
            $query->orWhere('password', 'LIKE',"%{$search}%");
        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('password', 'LIKE',"%{$search_3}%");
            $query->Where('registerd_email', 'LIKE',"%{$search_3}%");
            $query->Where('username', 'LIKE',"%{$search_3}%");
            $query->Where('portal', 'LIKE',"%{$search_3}%");
            $query->Where('shipping2', 'LIKE',"%{$search_3}%");
            $query->Where('shipping1', 'LIKE',"%{$search_3}%");
            $query->Where('invoice_add2', 'LIKE',"%{$search_3}%");
            $query->Where('invoice_add1', 'LIKE',"%{$search_3}%");
            $query->Where('location', 'LIKE',"%{$search_3}%");
            $query->Where('email', 'LIKE',"%{$search_3}%");
            $query->Where('contact_department', 'LIKE',"%{$search_3}%");
            $query->Where('office', 'LIKE',"%{$search_3}%");
            $query->Where('mobile', 'LIKE',"%{$search_3}%");
            $query->Where('contact_person', 'LIKE',"%{$search_3}%");
            $query->Where('website', 'LIKE',"%{$search_3}%");
            $query->Where('fax', 'LIKE',"%{$search_3}%");
            $query->Where('mobile2', 'LIKE',"%{$search_3}%");
            $query->Where('mobile1', 'LIKE',"%{$search_3}%");
            $query->Where('office_phone2', 'LIKE',"%{$search_3}%");
            $query->Where('office_phone1', 'LIKE',"%{$search_3}%");
            $query->Where('email2', 'LIKE',"%{$search_3}%");
            $query->Where('email1', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_zip', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_city', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_region', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_country', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_add2', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_add1', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_name', 'LIKE',"%{$search_3}%");
            $query->Where('key_account', 'LIKE',"%{$search_3}%");
            $query->Where('salesman', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_category', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_type', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_code', 'LIKE',"%{$search_3}%");
            echo "test";
       }

       $totalFiltered  = $query->count();
       $query->skip($_POST['start'])->take($_POST['length']);
       $vendor =  $query->get();
       $data = array();
       $no   = $_POST['start'];
       $i    = 0;
       $row  = array();

       foreach ($vendor as $vendor_detail) {

         $no++;

            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                       <a href="edit_vendor?id='.$vendor_detail->id.'" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Vendrdetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_vendorinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->vendor_code;
            $row[3]  = $vendor_detail->vendor_type;
            $row[4]  = $vendor_detail->vendor_category;
            $row[5]  = $vendor_detail->salesman;
            $row[6]  = $vendor_detail->key_account;
            $row[7]  = $vendor_detail->vendor_name;
            $row[8]  = $vendor_detail->vendor_add1;
            $row[9]  = $vendor_detail->vendor_add2;
            $row[10] = $vendor_detail->vendor_country;
            $row[11] = $vendor_detail->vendor_region;
            $row[12] = $vendor_detail->vendor_city;
            $row[13] = $vendor_detail->vendor_zip;
            $row[14] = $vendor_detail->email1;
            $row[15] = $vendor_detail->email2;
            $row[16] = $vendor_detail->office_phone1;
            $row[17] = $vendor_detail->office_phone2;
            $row[18] = $vendor_detail->mobile1;
            $row[19] = $vendor_detail->mobile2;
            $row[20] = $vendor_detail->fax;
            $row[21] = $vendor_detail->website;
            $row[22] = $vendor_detail->contact_person;
            $row[23] = $vendor_detail->mobile;
            $row[24] = $vendor_detail->office;
            $row[25] = $vendor_detail->contact_department;
            $row[26] = $vendor_detail->email;
            $row[27] = $vendor_detail->location;
            $row[28] = $vendor_detail->invoice_add1;
            $row[29] = $vendor_detail->invoice_add2;
            $row[30] = $vendor_detail->shipping1;
            $row[31] = $vendor_detail->shipping2;
            $row[32] = $vendor_detail->portal;
            $row[33] = $vendor_detail->username;
            $row[34] = $vendor_detail->registerd_email;
            $row[35] = $vendor_detail->password;
            $data[$i] = $row;
            $i++;
        }

        $output = array(
                    "draw"                => $_POST['draw'],
                    "recordsTotal"        => $totalData,
                    "recordsFiltered"     => $totalFiltered,
                    "data"                => $data,
                );
        echo json_encode($output);

    }
    public function vendortrashshow(Request $request)
    {
        $totalFiltered=0;
        $totalData = vendor::count();
        $query =  vendor::orderby('id', 'desc');
        $query->where('del_flag',0);
        if(!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id','LIKE',"%{$search}%");
            $query->orWhere('vendor_code', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_type', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_category', 'LIKE',"%{$search}%");
            $query->orWhere('salesman', 'LIKE',"%{$search}%");
            $query->orWhere('key_account', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_name', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_add1', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_add2', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_country', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_city', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_region', 'LIKE',"%{$search}%");
            $query->orWhere('vendor_zip', 'LIKE',"%{$search}%");
            $query->orWhere('email1', 'LIKE',"%{$search}%");
            $query->orWhere('email2', 'LIKE',"%{$search}%");
            $query->orWhere('office_phone1', 'LIKE',"%{$search}%");
            $query->orWhere('office_phone2', 'LIKE',"%{$search}%");
            $query->orWhere('mobile1', 'LIKE',"%{$search}%");
            $query->orWhere('mobile2', 'LIKE',"%{$search}%");
            $query->orWhere('fax', 'LIKE',"%{$search}%");
            $query->orWhere('website', 'LIKE',"%{$search}%");
            $query->orWhere('contact_person', 'LIKE',"%{$search}%");
            $query->orWhere('mobile', 'LIKE',"%{$search}%");
            $query->orWhere('office', 'LIKE',"%{$search}%");
            $query->orWhere('contact_department', 'LIKE',"%{$search}%");
            $query->orWhere('email', 'LIKE',"%{$search}%");
            $query->orWhere('location', 'LIKE',"%{$search}%");
            $query->orWhere('invoice_add1', 'LIKE',"%{$search}%");
            $query->orWhere('invoice_add2', 'LIKE',"%{$search}%");
            $query->orWhere('shipping1', 'LIKE',"%{$search}%");
            $query->orWhere('shipping2', 'LIKE',"%{$search}%");
            $query->orWhere('portal', 'LIKE',"%{$search}%");
            $query->orWhere('username', 'LIKE',"%{$search}%");
            $query->orWhere('registerd_email', 'LIKE',"%{$search}%");
            $query->orWhere('password', 'LIKE',"%{$search}%");
        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('password', 'LIKE',"%{$search_3}%");
            $query->Where('registerd_email', 'LIKE',"%{$search_3}%");
            $query->Where('username', 'LIKE',"%{$search_3}%");
            $query->Where('portal', 'LIKE',"%{$search_3}%");
            $query->Where('shipping2', 'LIKE',"%{$search_3}%");
            $query->Where('shipping1', 'LIKE',"%{$search_3}%");
            $query->Where('invoice_add2', 'LIKE',"%{$search_3}%");
            $query->Where('invoice_add1', 'LIKE',"%{$search_3}%");
            $query->Where('location', 'LIKE',"%{$search_3}%");
            $query->Where('email', 'LIKE',"%{$search_3}%");
            $query->Where('contact_department', 'LIKE',"%{$search_3}%");
            $query->Where('office', 'LIKE',"%{$search_3}%");
            $query->Where('mobile', 'LIKE',"%{$search_3}%");
            $query->Where('contact_person', 'LIKE',"%{$search_3}%");
            $query->Where('website', 'LIKE',"%{$search_3}%");
            $query->Where('fax', 'LIKE',"%{$search_3}%");
            $query->Where('mobile2', 'LIKE',"%{$search_3}%");
            $query->Where('mobile1', 'LIKE',"%{$search_3}%");
            $query->Where('office_phone2', 'LIKE',"%{$search_3}%");
            $query->Where('office_phone1', 'LIKE',"%{$search_3}%");
            $query->Where('email2', 'LIKE',"%{$search_3}%");
            $query->Where('email1', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_zip', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_city', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_region', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_country', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_add2', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_add1', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_name', 'LIKE',"%{$search_3}%");
            $query->Where('key_account', 'LIKE',"%{$search_3}%");
            $query->Where('salesman', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_category', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_type', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_code', 'LIKE',"%{$search_3}%");
            echo "test";
       }

       $totalFiltered  = $query->count();
       $query->skip($_POST['start'])->take($_POST['length']);
       $vendor =  $query->get();
       $data = array();
       $no   = $_POST['start'];
       $i    = 0;
       $row  = array();

       foreach ($vendor as $vendor_detail) {

         $no++;

            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                       <a href="edit_vendor?id='.$vendor_detail->id.'" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Vendrdetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_vendorinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->vendor_code;
            $row[3]  = $vendor_detail->vendor_type;
            $row[4]  = $vendor_detail->vendor_category;
            $row[5]  = $vendor_detail->salesman;
            $row[6]  = $vendor_detail->key_account;
            $row[7]  = $vendor_detail->vendor_name;
            $row[8]  = $vendor_detail->vendor_add1;
            $row[9]  = $vendor_detail->vendor_add2;
            $row[10] = $vendor_detail->vendor_country;
            $row[11] = $vendor_detail->vendor_region;
            $row[12] = $vendor_detail->vendor_city;
            $row[13] = $vendor_detail->vendor_zip;
            $row[14] = $vendor_detail->email1;
            $row[15] = $vendor_detail->email2;
            $row[16] = $vendor_detail->office_phone1;
            $row[17] = $vendor_detail->office_phone2;
            $row[18] = $vendor_detail->mobile1;
            $row[19] = $vendor_detail->mobile2;
            $row[20] = $vendor_detail->fax;
            $row[21] = $vendor_detail->website;
            $row[22] = $vendor_detail->contact_person;
            $row[23] = $vendor_detail->mobile;
            $row[24] = $vendor_detail->office;
            $row[25] = $vendor_detail->contact_department;
            $row[26] = $vendor_detail->email;
            $row[27] = $vendor_detail->location;
            $row[28] = $vendor_detail->invoice_add1;
            $row[29] = $vendor_detail->invoice_add2;
            $row[30] = $vendor_detail->shipping1;
            $row[31] = $vendor_detail->shipping2;
            $row[32] = $vendor_detail->portal;
            $row[33] = $vendor_detail->username;
            $row[34] = $vendor_detail->registerd_email;
            $row[35] = $vendor_detail->password;
            $data[$i] = $row;
            $i++;
        }

        $output = array(
                    "draw"                => $_POST['draw'],
                    "recordsTotal"        => $totalData,
                    "recordsFiltered"     => $totalFiltered,
                    "data"                => $data,
                );
        echo json_encode($output);

    }
    
    public function submit_vendor(Request $request)
    {
        
        $request->validate([
            'vendor_code' => 'required'
        ], [

            'vendor_code.required' => 'Code is required'
        ]);
        $user = auth()->user();
        $postID = $request->vendor_id;

        $data   = [
                'vendor_code'         =>$request->vendor_code,
                'vendor_type'         => $request->vendor_type,
                'vendor_category'     => $request->vendor_category,
                'salesman'          => $request->salesman,
                'key_account'       => $request->key_account,
                'vendor_note'       => $request->vendor_note,

                'vendor_name'         => $request->vendor_name,
                'contact_person'       => $request->contact_person,
                'vendor_add1'         => $request->vendor_add1,
                'vendor_add2'         => $request->vendor_add2,
                'vendor_country'      => $request->vendor_country,
                'vendor_region'       => $request->vendor_region,
                'vendor_city'         => $request->vendor_city,
                'vendor_zip'          => $request->vendor_zip,
                'email1'            => $request->email1,
                'email2'            => $request->email2,
                'office_phone1'     => $request->office_phone1,
                'office_phone2'     => $request->office_phone2,
                'mobile1'           => $request->mobile1,
                'mobile2'           => $request->mobile2,
                'fax'               => $request->fax,
                'website'           => $request->website,
                'contact_persons'    => $request->contact_persons,
                'mobile'            => $request->mobile,
                'office'            => $request->office,
                'contact_department'=> $request->contact_department,
                'email'             => $request->email,
                'location'          => $request->location,
                
                
                'portal'            => $request->portal,
                'username'          => $request->username,
                'registerd_email'   => $request->registerd_email,
                'password'          => encrypt($request->password),
                

            ];

        $vendors= vendor::updateOrCreate(['id' => $postID],$data);

        vendorskill::where('info_id',$vendors->id)->delete();

        if(!empty($request->contact_person_incharges))
            {
                foreach($request->contact_person_incharges as $key => $value){

                  vendorskill::create([

                                  'info_id' => $vendors->id,
                                  'contact_person_incharges'   => $request->contact_person_incharges[$key],
                                  'mobiles'=>$request->mobiles[$key],
                                  'offices'   => $request->offices[$key],
                                  'emails'   => $request->emails[$key],
                                  'departments'   => $request->departments[$key],
                                  'locations'   => $request->locations[$key],
                                   ]);

                }
            }

        return 'true';
    }

    

    public function edit_vendor(Request $request)
    {
        $skill=[];
        $id= $request->id;
        $categry = VendorCategoryModel::select('id','vendor_category')->get();
        $type = VendorTypeModel::select('id','vendor_type')->get();
        $users =  vendor::where('id',$id)
                            ->limit(1)
                            ->first();
        $skill = vendorskill::where('info_id', $id) ->get();

                            
         return view('vendors.vendor_edit',['data'=>$users, 'datas' => $skill],compact('categry','type'));

    }

    public function delete_vendor(Request $request)
    {
        $postID = $request->id;
        vendor::where('id', $postID)
            ->update(['del_flag' => 0]);
        return 'true';
    }

}


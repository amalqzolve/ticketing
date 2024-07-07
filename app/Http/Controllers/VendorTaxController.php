<?php
namespace App\Http\Controllers;
use App\vendor;
use App\TaxInformation;

use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;

class VendorTaxController extends Controller
{
    
    public function vendortaxindex()
    {

     return view('VendorTax.index');

    }

    public function taxList(Request $request){
        // dd($request);

        $totalFiltered=0;

        $totalData = TaxInformation::count();

        $query =  TaxInformation::orderby('id', 'desc');
        $query->where('del_flag',1);

        if(!empty($request->input('search.value'))) {

            $search = $request->input('search.value');

            $query->Where('id','LIKE',"%{$search}%");

            $query->orWhere('vat_name', 'LIKE',"%{$search}%");

        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){

            $search_3 = $_POST['columns'][3]['search']['value'];

            $query->Where('vat_name', 'LIKE',"%{$search_3}%");
            echo "test";

       }



       $totalFiltered  = $query->count();

       $query->skip($_POST['start'])->take($_POST['length']);

       $users =  $query->get();

       $data = array();
       $no   = $_POST['start'];
       $i    = 0;
       $row  = array();

       foreach ($users as $vendor_detail) {

         $no++;

            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                       <a href="#?id='.$vendor_detail->id.'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_2"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text TaxDetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_Taxinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->vat_no;
            $row[3]  = $vendor_detail->vat_name;
            $row[4]  = $vendor_detail->file_data;
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

    public function taxinfotrash(Request $request){
        // dd($request);

        $totalFiltered=0;

        $totalData = TaxInformation::count();

        $query =  TaxInformation::orderby('id', 'desc');
        $query->where('del_flag',0);

        if(!empty($request->input('search.value'))) {

            $search = $request->input('search.value');

            $query->Where('id','LIKE',"%{$search}%");

            $query->orWhere('vat_name', 'LIKE',"%{$search}%");

        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){

            $search_3 = $_POST['columns'][3]['search']['value'];

            $query->Where('vat_name', 'LIKE',"%{$search_3}%");
            echo "test";

       }

       $totalFiltered  = $query->count();

       $query->skip($_POST['start'])->take($_POST['length']);

       $users =  $query->get();

       $data = array();
       $no   = $_POST['start'];
       $i    = 0;
       $row  = array();

       foreach ($users as $vendor_detail) {

         $no++;

            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                       <a href="#?id='.$vendor_detail->id.'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_2"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text TaxDetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_Taxinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->vat_no;
            $row[3]  = $vendor_detail->vat_name;
            $row[4]  = $vendor_detail->file_data;
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

    public function store(Request $request)
    {

        $request->validate([

            'vat_no' => 'required'

        ], [

            'vat_no.required' => 'Number is required'

        ]);

        $user = auth()->user();


        $postID = $request->tax_id;

        $data   = [
                'vat_no'            => $request->vat_no,
                'vat_name'          => $request->vat_name,
                'uniqueid'          => $request->UniqueID,
                'file_data'         => $request->fileData,
               
            ];

        $userInfo= TaxInformation::updateOrCreate(['id' => $postID],$data);


        // Skillmore::where('info_id',$userInfo->id)->delete();

        // if(!empty($request->skill))
        //     {
        //         foreach($request->skill as $key => $value) {

        //           Skillmore::create([

        //                           'info_id' => $userInfo->id,
        //                           'skill'   => $request->skill[$key],
        //                           'value'   => $request->skillValue[$key],

        //                           ]);

        //         }
        //     }

        return 'true';
    }
    
    public function getTaxInfo(Request $request){

       $data['users'] =  TaxInformation::where('id',$request->user_id)
                            ->limit(1)
                            ->first();

       
       echo json_encode($data);

    }
    public function deleteTaxInfo(Request $request)
    {
        $postID = $request->id;

        //echo $postID;
        TaxInformation::where('id', $postID)
            ->update(['del_flag' => 0]);

        return 'true';
    }

    public function TaxRestore(Request $request)
    {
        $postID = $request->id;

        //echo $postID;
        TaxInformation::where('id', $postID)
            ->update(['del_flag' => 1]);

        return 'true';
    }

    public function TaxDetailsTrash(Request $request)
    {

     return view('VendorTax.trash');

    }


}


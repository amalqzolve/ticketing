<?php
namespace App\Http\Controllers;
use App\vendor;
use App\VendorCategoryModel;
use App\VendorTypeModel;
use App\vendorskill;
use App\TaxInformation;

use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;

class VendorCategoryController extends Controller
{
 
 
    public function vendorCategoryTrash()
    {

     return view('VendorCategory.trash');

    }
 
    public function categoryedit(Request $request)
    {
        $data['users'] = VendorCategoryModel::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }
    public function vendorcategorytrashshow(Request $request)
    {
        $totalFiltered=0;
        $totalData = VendorCategoryModel::count();
        $query =  VendorCategoryModel::orderby('id', 'desc');
        $query->where('del_flag',0);
        if(!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id','LIKE',"%{$search}%");
            $query->orWhere('vendor_category', 'LIKE',"%{$search}%");
            $query->orWhere('description', 'LIKE',"%{$search}%");
            $query->orWhere('color', 'LIKE',"%{$search}%");
            $query->orWhere('customcode', 'LIKE',"%{$search}%");
            $query->orWhere('startfrom', 'LIKE',"%{$search}%");
        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){
            $search_3 = $_POST['columns'][3]['search']['value'];
          $query->orWhere('startfrom', 'LIKE',"%{$search}%");
          $query->orWhere('customcode', 'LIKE',"%{$search}%");
            $query->Where('color', 'LIKE',"%{$search_3}%");
            $query->Where('description', 'LIKE',"%{$search_3}%");
            $query->Where('vendor_category', 'LIKE',"%{$search_3}%");
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

                       <a href="edit_vendorcategory?id='.$vendor_detail->id.'" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Vendrdetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_vendorcategoryinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->vendor_category;
            $row[3]  = $vendor_detail->description;
            $row[4]  = '<div style="width:25px;border-radius: 17px;height:10px;background:#'.$vendor_detail->color.'">&nbsp;&nbsp;</div>';
            $row[5]  = $vendor_detail->customcode;
            $row[6]  = $vendor_detail->startfrom;

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
  
    public function submit_vendorcategory(Request $request)
    {
        
        $request->validate([
            'vendor_category' => 'required'
        ], [

            'vendor_category.required' => 'Code is required'
        ]);
        $user = auth()->user();
        $postID = $request->vendor_id;

        $data   = [
                'vendor_category'   => $request->vendor_category,
                'description'       => $request->description,
                'color'             => $request->color,
                'customcode'          => $request->customcode,
                'startfrom'            => $request->startfrom
            ];

        $vendors= VendorCategoryModel::updateOrCreate(['id' => $postID],$data);
        return 'true';
    }


     public function vendorcategoryindex()

    {
      return view('VendorCategory.index');

    }

    public function vendorcategoryshow(Request $request)
    {
        $totalFiltered=0;
        $totalData = VendorCategoryModel::count();
        $query =  VendorCategoryModel::orderby('id', 'desc');
        $query->where('del_flag',1);
        if(!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id','LIKE',"%{$search}%");
            $query->orWhere('vendor_category', 'LIKE',"%{$search}%");
            $query->orWhere('description', 'LIKE',"%{$search}%");
            $query->Where('color', 'LIKE',"%{$search_3}%");
            $query->orWhere('customcode', 'LIKE',"%{$search}%");
            $query->orWhere('startfrom', 'LIKE',"%{$search}%");


        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('vendor_category', 'LIKE',"%{$search_3}%");
            $query->Where('description', 'LIKE',"%{$search_3}%");
            $query->Where('color', 'LIKE',"%{$search_3}%");
            $query->Where('startfrom', 'LIKE',"%{$search_3}%");
            $query->Where('customcode', 'LIKE',"%{$search_3}%");
            
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

                       <a href="#?id='.$vendor_detail->id.'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_4"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Vendorcategorydetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_vendorcategoryinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->vendor_category;
            $row[3]  = $vendor_detail->description;
            $row[4]  = '<div style="width:25px;border-radius: 17px;height:10px;background:#'.$vendor_detail->color.'">&nbsp;&nbsp;</div>';
            $row[5]  = $vendor_detail->customcode;
            $row[6]  = $vendor_detail->startfrom;
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

   public function addvendorcategorydetails()
    {
        return view('VendorCategory.addvendorcategorydetails');
    }
    public function edit_vendorcategory(Request $request)
    {
         $id= $request->id;
         $users =  VendorCategoryModel::where('id',$id)
                            ->limit(1)
                            ->first();
         return view('VendorCategory.edit',['data'=>$users]);

    }
    public function delete_vendorcategory(Request $request)
    {
        $postID = $request->id;
        VendorCategoryModel::where('id', $postID)
            ->update(['del_flag' => 0]);
        return 'true';
    }
  

}


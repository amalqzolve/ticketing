<?php
namespace App\Http\Controllers;

use App\VendorGroupModel;
use App\TaxInformation;

use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;

class VendorGroupController extends Controller
{
    
    public function index()
    {
     
      return view('VendorGroup.index');

    }
    
     public function groupedit(Request $request)
    {
        $data['users'] = VendorGroupModel::where('id', $request->info_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }

    public function submit_vendorgroup(Request $request)
    {
        
        $request->validate([
            'title' => 'required'
        ], [

            'title.required' => 'Title is required'
        ]);
        $user = auth()->user();
        $postID = $request->id;

        $data   = [
                'title'            => $request->title,
                'description'      => $request->description,
                'color'            => $request->color

                   ];

        $vendors= VendorGroupModel::updateOrCreate(['id' => $postID],$data);
        return 'true';
    }

    
    public function VendorGroupShow(Request $request)
    {
        $totalFiltered=0;
        $totalData = VendorGroupModel::count();
        $query =  VendorGroupModel::orderby('id', 'desc');
        $query->where('del_flag',1);
        if(!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id','LIKE',"%{$search}%");
            $query->orWhere('title', 'LIKE',"%{$search}%");
            $query->orWhere('description', 'LIKE',"%{$search}%");
            $query->orWhere('color', 'LIKE',"%{$search}%");

        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('title', 'LIKE',"%{$search_3}%");
            $query->Where('description', 'LIKE',"%{$search_3}%");
            $query->Where('color', 'LIKE',"%{$search_3}%");
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
                        <span class="kt-nav__link-text VendorGroupDetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_vendorgroupinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->title;
            $row[3]  = $vendor_detail->description;
            $row[4]  = '<div style="width:25px;border-radius: 17px;height:10px;background:#'.$vendor_detail->color.'">&nbsp;&nbsp;</div>';

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
    public function GroupTrash(Request $request)
    {

     return view('VendorGroup.trash');

    }
     public function vendorgrouplistTrash(Request $request)
    {
        $totalFiltered=0;
        $totalData = VendorGroupModel::count();
        $query =  VendorGroupModel::orderby('id', 'desc');
        $query->where('del_flag',0);
        if(!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id','LIKE',"%{$search}%");
            $query->orWhere('title', 'LIKE',"%{$search}%");
            $query->orWhere('description', 'LIKE',"%{$search}%");
            $query->orWhere('color', 'LIKE',"%{$search}%");

        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('title', 'LIKE',"%{$search_3}%");
            $query->Where('description', 'LIKE',"%{$search_3}%");
            $query->Where('color', 'LIKE',"%{$search_3}%");
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
                        <span class="kt-nav__link-text VendorGroupDetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_vendorgroupinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->title;
            $row[3]  = $vendor_detail->description;
            $row[4]  = '<div style="width:25px;border-radius: 17px;height:10px;background:#'.$vendor_detail->color.'">&nbsp;&nbsp;</div>';

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
    public function delete_vendorgroup(Request $request)
    {
        $postID = $request->id;
        VendorGroupModel::where('id', $postID)
            ->update(['del_flag' => 0]);
        return 'true';
    }

}


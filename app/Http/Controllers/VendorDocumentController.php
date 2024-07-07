<?php
namespace App\Http\Controllers;
use App\VendorDocument;
use App\vendorskill;
use App\vendor;

use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spatie\Activitylog\Models\Activity;
use PDF;

class VendorDocumentController extends Controller
{
    
    public function index()

    {
        $list = vendor::select('id', 'vendor_name')->get();
        $lists = VendorDocument::select('id', 'name')->get();

        // print_r($category);
        // exit();
       
     return view('VendorDoc.index',compact('list','lists'));

    }

    public function docList(Request $request){
        // dd($request);

        $totalFiltered=0;

        $totalData = vendor::count();

        $query =  vendor::orderby('id', 'desc');
        $query->where('del_flag',1);

        if(!empty($request->input('search.value'))) {

            $search = $request->input('search.value');

            $query->Where('id','LIKE',"%{$search}%");

            $query->orWhere('vendor_name', 'LIKE',"%{$search}%");

        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){

            $search_3 = $_POST['columns'][3]['search']['value'];

            $query->Where('vendor_name', 'LIKE',"%{$search_3}%");
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
                        <a href="#?id='.$vendor_detail->id.'" data-type="add" data-toggle="modal" data-target="#kt_modal_4_2"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text DocDetail_add" data-id="'.$vendor_detail->id.'" >Add</span>
                        </span></li></a>

                       <a href="#?id='.$vendor_detail->id.'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_2"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text DocDetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                       

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_Docinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->vendor_name;
            // $row[3]  = $vendor_detail->description;
            // $row[4]  = $vendor_detail->file_data;
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

    public function Docinfotrash(Request $request){
        // dd($request);

        $totalFiltered=0;

        $totalData = VendorDocument::count();

        $query =  VendorDocument::orderby('id', 'desc');
        $query->where('del_flag',0);

        if(!empty($request->input('search.value'))) {

            $search = $request->input('search.value');

            $query->Where('id','LIKE',"%{$search}%");

            $query->orWhere('name', 'LIKE',"%{$search}%");

        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){

            $search_3 = $_POST['columns'][3]['search']['value'];

            $query->Where('name', 'LIKE',"%{$search_3}%");
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
                        <span class="kt-nav__link-text DocDetail_update" data-id="'.$vendor_detail->id.'" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_Docinformation" id='.$vendor_detail->id.' data-id='.$vendor_detail->id.'>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2]  = $vendor_detail->name;
            $row[3]  = $vendor_detail->description;
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

            'title' => 'required'

        ], [

            'title.required' => 'Title is required'

        ]);

        $user = auth()->user();
         $postID = $request->doc_id;

      
        $data   = [
                'name'                =>$request->name,
                'title'                 => $request->title,
                
                'description'          => $request->description,
                'uniqueid'             => $request->UniqueID,
                'file_data'            => $request->fileData,
               
            ];

        $userInfo= VendorDocument::updateOrCreate(['id' => $postID],$data);


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
    
    public function getDocInfo(Request $request){

       $data['users'] =  VendorDocument::where('name',$request->user_name)
                            ->limit(1)
                            ->first();

       
       echo json_encode($data);

    }
     public function getDocAdd(Request $request){
      $data['users'] =  Vendor::where('id',$request->user_id)
                             ->limit(1)
                             ->first();

        // print_r($data['users']);
        echo json_encode($data);
        
}
    
    public function view_vendordoc(Request $request)
    {
        $id = $_REQUEST['id'];

        $users = VendorDocument::where('id', $id)->limit(1)
            ->first();

        return view('VendorDoc.view', ['data' => $users]);
    }

     public function getDocEdit(Request $request){
     $data['users'] =  VendorDocument::where('id',$request->user_id)
                            ->limit(1)
                            ->first();

       
       echo json_encode($data);
        

    }
    public function deleteDocInfo(Request $request)
    {
        $postID = $request->id;

        //echo $postID;
        VendorDocument::where('id', $postID)
            ->update(['del_flag' => 0]);

        return 'true';
    }

    public function DocRestore(Request $request)
    {
        $postID = $request->id;

        //echo $postID;
        VendorDocument::where('id', $postID)
            ->update(['del_flag' => 1]);

        return 'true';
    }

    public function DocDetailsTrash(Request $request)
    {

     return view('VendorDoc.trash');

    }


}


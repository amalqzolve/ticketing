<?php

namespace App\Http\Controllers;
use App\SuppliergroupModel;
use DB;
use Illuminate\Http\Request;
use App\Skillmore;
use Spstie\Activitylog\Models\Activity;
use\PDF;


class suppliergroup extends Controller
{
   /**
    * Display a listing of the resource.
    * @return \ illuminate \Http\Response
    */
    Public function supplier_grup ()
    {
    	return view('supplier_group.suppliergroup');
    }



     public function suppliergroupindex()
    {
        return view('supplier_group.suppliergrouptrash');

    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     //
    }
    public function suppliergrouplist (Request $request)
    {
            $totalFiltered = 0;

        $totalData = SuppliergroupModel::count();

        $query = SuppliergroupModel::orderby('id', 'desc');

        if (!empty($request->input('search.value')))
        {

            $search = $request->input('search.value');

            $query->where('id', 'LIKE', "%{$search}%");

            $query->orWhere('title', 'LIKE', "%{$search}%");

        }

        $query->where('del_flag', 0);

        $totalFiltered = $query->count();

        $query->skip($_POST['start'])->take($_POST['length']);

        $users = $query->get();

        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();

        foreach ($users as $user_detail)
        {

             $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text suppliergruprestore" id=' . $user_detail->id . ' data-id=' . $user_detail->id . '>Restore</span></span></li>

                        
                        </ul></div></div></span>';
            $row[2]  = $user_detail->title;
            $row[3]  = $user_detail->description;
            $row[4]  = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#'.$user_detail->color.'">&nbsp;&nbsp;</div>';
            
            $data[$i] = $row;
            $i++;

        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        );

        echo json_encode($output);


    }
    public function suppliergrupTrashRestore(Request $request)
    {
        $postID = $request->id;

        //echo $postID;
       SuppliergroupModel::where('id', $postID)
            ->update(['del_flag' => 1]);

        return 'true';
    }

    /**

     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function suppliergrupstore(Request $request)

         {$totalFiltered=0;
         $totalData = SuppliergroupModel::count();
         $query =  SuppliergroupModel::orderby('id', 'desc');
         $query->where('del_flag',1);
         if(!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->Where('id','LIKE',"%{$search}%");
            $query->orWhere('title', 'LIKE',"%{$search}%");
             $query->orWhere('description', 'LIKE',"%{$search}%");
            $query->orWhere('color', 'LIKE',"%{$search}%");

           }
         if(isset($_GET['columns'][3]['search']['value'])&&
            $_GET['columns'][3]['search']['value']!=''){
            $search_3 = $_GET['columns'][3]['search']['value'];
            
            $query->Where('color', 'LIKE',"%{$search_3}%");
            $query->Where('description', 'LIKE',"%{$search_3}%");
            $query->Where('title', 'LIKE',"%{$search_3}%");
            echo "test";
        }
         $totalFiltered  = $query->count();
         $query->skip($_GET['start'])->take($_GET['length']);
         $users =  $query->get();
         $data = array();
         $no   = $_GET['start'];
         $i    = 0;
         $row  = array();
         foreach ($users as $user_detail) {
            $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                        <a href="#?id='.$user_detail->id.'" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_10"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text suppliergrupdetail_update" data-id="'.$user_detail->id.'" >'. trans('app.Edit').'</span>
                        </span></li></a>

                        <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_suppliergrupinformation" id='.$user_detail->id.' data-id='. $user_detail->id.'>'. trans('app.Delete').'</span></span></li>
                        </ul></div></div></span>';
            $row[2]  = $user_detail->title;
            $row[3]  = $user_detail->description;
            $row[4]  = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#'.$user_detail->color.'">&nbsp;&nbsp;</div>';
            
            $data[$i] = $row;
            $i++;

        }

        $output = array(
                    "draw"                => $_GET['draw'],
                    "recordsTotal"        => $totalData,
                    "recordsFiltered"     => $totalFiltered,
                    "data"                => $data,
                );

        echo json_encode($output);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $user = User::find($id);
      $roles = Role::pluck('title','title')->all();
      $userRole = $user->roles->pluck('title','title')->all();
      return view('users.edit',compact('user','roles','userRole'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public  function submitgroup(Request $request)
    {
        // dd($request);
        // exit();
    	
        $request->validate([
            'title' => 'required',
         ], [
            'title.required' => 'title is required',
        ]);
        $user = auth()->user();
        $postID = $request->cust_id;
        $data   = [

                'title'         => $request->title,
                'description'   => $request->description,
                'color'        => $request->color
            ]; 

        $userInfo= SuppliergroupModel::updateOrCreate(['id' => $postID],$data);
        

        return 'true';
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function getsuppliergrup(Request $request){

       $data['users'] =  SuppliergroupModel::where('id',$request->cust_id)
                            ->limit(1)
                            ->first();
       $data['addMore'] =  Skillmore::where('info_id',$request->cust_id)
                            ->get();

       echo json_encode($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function deletesuppliergrupInfo(Request $request)
    {
        $postID = $request->id;
        SuppliergroupModel::where('id', $postID)
            ->update(['del_flag' => 0]);
        return 'true';
    }
}

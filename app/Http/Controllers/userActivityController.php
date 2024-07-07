<?php

namespace App\Http\Controllers;

use App\Userinfo;
use App\userActivity;
use Illuminate\Http\Request;
use DB;
use Spatie\Activitylog\Models\Activity;

class userActivityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('userActivity.index');
    }

    
    /**
     * Get all userActivity list.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function userActivityList(Request $request){

        $totalFiltered=0;
           
        $totalData = userActivity::count();
            
        $query =  userActivity::orderby('id', 'desc');                                                 

        if(!empty($request->input('search.value'))) {

            $search = $request->input('search.value'); 

            $query->Where('id','LIKE',"%{$search}%");
                            
            $query->orWhere('log_name', 'LIKE',"%{$search}%");

        }

       if(isset($_POST['columns'][3]['search']['value'])&&
        $_POST['columns'][3]['search']['value']!=''){

            $search_3 = $_POST['columns'][3]['search']['value'];                  
        
            $query->Where('log_name', 'LIKE',"%{$search_3}%");
            echo "test";
       
       } 



       $totalFiltered  = $query->count();

       $query->skip($_POST['start'])->take($_POST['length']);
       
       $usersActivity =  $query->get(); 

	   $data = array(); 
       $no   = $_POST['start'];
       $i    = 0;
       $row  = array();

	   foreach ($usersActivity as $activity) {
            
         $no++;

            $row[0]  = $no;
            $row[1]  = $activity->log_name;
            $row[2]  = $activity->description;
            $row[3]  = $activity->subject_id;
            $row[4]  = $activity->subject_type;
            $row[5]  = $activity->causer_id;
            $row[6]  = $activity->causer_type;
            $row[7]  = $activity->properties;
            
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

    public function getSingleUserInfo(Request $request){

       $users =  userActivity::where('id',$request->user_id)
                            ->limit(1)
                            ->first();

       echo json_encode($users);                             
 
    }


}
                        
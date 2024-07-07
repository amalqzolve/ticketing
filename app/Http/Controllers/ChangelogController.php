<?php

namespace App\Http\Controllers;

use App\Userinfo;
use App\userActivity;
use Illuminate\Http\Request;
use DB;
use Spatie\Activitylog\Models\Activity;

class ChangelogController extends Controller
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

        return view('changelog.index');
    }

    
    /**
     * Get all userActivity list.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function getSingleUserInfo(Request $request){

       $users =  userActivity::where('id',$request->user_id)
                            ->limit(1)
                            ->first();

       echo json_encode($users);                             
 
    }


}
                        
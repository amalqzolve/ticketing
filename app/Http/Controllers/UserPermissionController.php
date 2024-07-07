<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\RolehaspermisionModel;
use DB;
use Hash;


class UserPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function appPermission()
    {
        $permissions = Permission::all(); //Get all permissions
        $roles = Role::get(); 
        $role_has_permissions=RolehaspermisionModel::select('permission_id','role_id')->get();
            // dd($role_has_permissions);
            
        // dd( $role_has_permissions);
             // exit();
        return view('permissions.appPermission',compact('permissions','roles','role_has_permissions'));
    }
    public function store(Request $request)
    {
         DB::table("role_has_permissions")->delete();
       for ($i = 0; $i < count($request->permission); $i++) {
       
        $data = [
            'permission_id' => $request->permission[$i],
            'role_id' => $request->role[$i]
        ];
//dd($data);
         // DB::table("role_has_permissions")->where('permission_id',$id)->delete();
         DB::table('role_has_permissions')->insert($data);
           // $output = ProductvariantModel::updateOrCreate(['id' => $vid], $data_variant);
        }
        return 'true';
    }
    

     public function permissionsforUser(Request $request)
    {
        DB::table("role_has_permissions")->delete();
       for ($i = 0; $i < count($request->role); $i++) {
       
        $data = [
            'permission_id' => $request->permission[$i],
            'role_id' => $request->role[$i]
        ];

         // DB::table("role_has_permissions")->where('permission_id',$id)->delete();
         DB::table('role_has_permissions')->insert($data);
           // $output = ProductvariantModel::updateOrCreate(['id' => $vid], $data_variant);
        }
         return 'true';
    }

    public function userperission()
    {
              $permissions = Permission::all(); //Get all permissions
        $roles = Role::get(); 
        $role_has_permissions=RolehaspermisionModel::select('permission_id','role_id')->get();
            // dd($role_has_permissions);


    /*    
        $roles = Role::orderBy('id','DESC')->paginate(5);
        $permission = Permission::get();
          $role_has_permissions=RolehaspermisionModel::select('permission_id','role_id')->get();*/
        return view('userpermission.index',compact('roles','permissions','role_has_permissions'));
    }


}

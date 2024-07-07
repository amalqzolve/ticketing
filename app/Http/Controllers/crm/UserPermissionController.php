<?php
namespace App\Http\Controllers\crm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
class UserPermissionController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('crm.users.index',compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function appPermission()
    {
        return view('crm.permissions.appPermission');
    }
}

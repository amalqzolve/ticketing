<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;

class UsermanegementController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select('users.id', 'users.name', 'users.email',  'users.designation', 'a_accounts.label as branch', 'qcrm_department.name as department')
                ->leftjoin('a_accounts', 'users.branch', '=', 'a_accounts.id')
                ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
                ->where('synthesis_user_flg', 1)
                ->get();

            $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            });
            return $dtTble->make(true);
        } else {
            $users = User::select('id', 'name', 'email')->where('synthesis_user_flg', 0)->get();
            return view('procurement.userManagement.index', compact('users'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $branches   = DB::table('a_accounts')->select('id', 'label')->get();
        return view('procurement.userManagement.create', compact('roles', 'branches'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select('users.*', 'qcrm_department.name as dept')
            ->leftjoin('qcrm_department', 'users.department', '=', 'qcrm_department.id')
            ->find($id);
        return view('procurement.userManagement.show', compact('user'));
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
        $branches   = DB::table('a_accounts')->select('id', 'label')->get();
        $department   = DB::table('qcrm_department')->select('id', 'name')->get();

        return view('procurement.userManagement.edit', compact('user', 'branches', 'department'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'department' => 'required',
            'designation' => 'required',
        ]);
        $inData = array(
            'synthesis_user_flg' => 1,
            'department' => $request->department,
            'designation' => $request->designation,
            'sign' => $request->fileData,
        );

        $user = User::find($id);
        $user->update($inData);

        return redirect()->route('procurement-user-management.index')
            ->with('success', 'User Details updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function userSignUpload(Request $request)
    {
        $path = public_path('usersigns');
        //echo $path;
        //    if(File::exists($path)) {
        // echo $request->UniqueID;
        //     }else{
        // echo $request->UniqueID;        
        //         File::makeDirectory($path, $mode = 0777, true, true);
        //     }
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $data[] = $name;
            }
        }
        return back()->with('success', 'Data Your files has been successfully added');
    }
}

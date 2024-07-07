<?php


namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use Validator;
use Session;


class ProfileController extends Controller
{
    public function profilepictureFileUpload(Request $request)
    {
        $path = public_path('Profilepicture');
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = $file->getClientOriginalName();
                //Storage::putFile('userInfoData', $name);
                $file->move($path, $name);
                //move_uploaded_file($name, public_path('userInfoData').'/'.$request->UniqueID);   
                $data[] = $name;
            }
        }
        return back()->with('success', 'Data Your files has been successfully added');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => ['required', 'string', 'max:255'],
            'user_phone' => ['string', 'max:20', 'nullable'],
            'password' => ['string', 'min:8', 'nullable'],
            'password_confirmation' => ['same:password'],
        ]);
        if ($validator->fails()) {
            $out = array(
                "status" => 2,
                "msg" => 'Validation Error.',
                "error" => $validator->errors()
            );
            echo json_encode($out);
            die();
        }


        $id = $request->id;
        $userData =  array(
            'name' => $request->user_name,
            'phone' => $request->user_phone,
        );
        if ($request->password != '') {
            $password =  Hash::make($request->password);
            $auth = Auth::user();
            if (!Hash::check($request->get('current_password'), $auth->password)) {
                $out = array(
                    "status" => 2,
                    "msg" => 'Validation Error.',
                    "error" => array('current_password' => ['Current Password is Invalid'])
                );
                echo json_encode($out);
                die();
            }

            $userData['password'] = $password;
        }

        if ($request->fileDataProfile != '') {
            $userData['image'] = $request->fileDataProfile;
            Session::pull('profile');
            Session::put('profile', $request->fileDataProfile);
        }

        $user = User::updateOrCreate(['id' => $id], $userData);

        $out = array(
            "status" => 1,
            "msg" => 'Profile Updated Successfully.'
        );
        echo json_encode($out);
        die();
    }
}

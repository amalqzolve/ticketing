<?php


namespace App\Http\Controllers\inventory;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ProfilePictureController extends Controller

{
    
    public function profilepictureFileUpload(Request $request)

    {




    $path = public_path('Profilepicture');
   


        if($request->hasfile('filenames'))

         {

            foreach($request->file('filenames') as $file)

            {


                $name=$file->getClientOriginalName();
  
                //Storage::putFile('userInfoData', $name);
                $file->move($path, $name);  
                //move_uploaded_file($name, public_path('userInfoData').'/'.$request->UniqueID);   
                   
                $data[] = $name;  

            }

         }


       


        return back()->with('success', 'Data Your files has been successfully added');

    }
}
?>

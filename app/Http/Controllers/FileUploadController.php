<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class FileUploadController extends Controller

{

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('create');

    }


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {


        // $this->validate($request, [

        //         'filenames' => 'required',

        //         'filenames.*' => 'mimes:doc,pdf,docx,zip'

        // ]);
                             
  

//     //$path = public_path('/public/storage/'.$request->UniqueID.'/');
// //dd($request);
//      if(!Storage::exists('userInfoData/'.$request->UniqueID)){
//       // dd(Storage::exists('userInfoData/'.$request->UniqueID));
//        Storage::disk('local')->makeDirectory('userInfoData/'.$request->UniqueID);
    
//      }


    $path = public_path('userInfoData').'/'.$request->UniqueID;
//echo $path;


   if(File::exists($path)) {

echo $request->UniqueID;
//dd("test");
    }else{
echo $request->UniqueID;        
//dd("test2");        
        File::makeDirectory($path, $mode = 0777, true, true);
    }

//$path = url('/storage/app/userInfoData/5ebedb709943e');

//dd($path);
//dd($request);
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


         // $file= new File();

         // $file->filenames=json_encode($data);

         // $file->save();


        return back()->with('success', 'Data Your files has been successfully added');

    }

}
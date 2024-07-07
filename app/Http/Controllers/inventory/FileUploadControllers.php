<?php


namespace App\Http\Controllers\inventory;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class FileUploadControllers extends Controller

{
    
    public function custdocumentFileUpload(Request $request)

    {




    $path = public_path('Brandinfodata');
    // .'/'.$request->UniqueID
//echo $path;


//    if(File::exists($path)) {

// echo $request->UniqueID;
// //dd("test");
//     }else{
// echo $request->UniqueID;        
// //dd("test2");        
//         File::makeDirectory($path, $mode = 0777, true, true);
//     }


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


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */


public function assetstore(Request $request)

    {


        
    $path = public_path('AssetFileUpload');

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


    public function productstore(Request $request)

    {


        
    $path = public_path('ProductFileUpload');

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


    public function productstore1(Request $request)

    {
      /* dd($request);*/
        $path = public_path('ProductFileUpload');
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();  
        $image->move($path,$imageName);
        return response()->json($imageName); 

    }
    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function manufacturestore(Request $request)

    {


        
    $path = public_path('Manufactureinfodata');

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



     public function brandstore(Request $request)

    {


        
    $path = public_path('Brandinfodata');
//echo $path;


//    if(File::exists($path)) {

// echo $request->UniqueID;
//     }else{
// echo $request->UniqueID;        
//         File::makeDirectory($path, $mode = 0777, true, true);
//     }

        if($request->hasfile('filenames'))

         {

            foreach($request->file('filenames') as $file)

            {


                $name=$file->getClientOriginalName();
  
                $file->move($path, $name);    
                   
                $data[] = $name;  

            }

         }




        return back()->with('success', 'Data Your files has been successfully added');

    }

  public function setwarehouse(Request $request)
    {
        $wid=$request->wid;
        $wname=$request->wname;

       session(['warehouse' => $wid]);
        session(['default_warehouse_name' => $wname]); 
        return 'true';
        }

}
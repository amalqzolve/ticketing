<?php


namespace App\Http\Controllers\sell;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Session;
use DB;
use DataTables;
class FileUploadControllers extends Controller

{
    
    public function pdfheaderFileUpload(Request $request)

    {




    $path = public_path('pdfheader');
   
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


     public function quotationfileupload(Request $request)
    {
        $customer_id = "";
        $branch=Session::get('branch');
        $customer_id=$request->qtnid;

        $path = public_path('Quotationfiles/'.$customer_id);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
     
     /*   if (File::exists($path))
        {
            echo $request->UniqueID;
        }
        else
        {
            echo $request->UniqueID;
            File::makeDirectory($path, $mode = 0777, true, true);
        }*/
        // dd($request->hasfile('filenames'));
        if ($request->hasfile('filenames'))
        {
            foreach ($request->file('filenames') as $file)
            {
                  $file_exist = DB::table('qsales_quotation_documents_files')->where('file',$file->getClientOriginalName())->where('qtn_id' ,$customer_id)->first();

                 if(!$file_exist){


                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                DB::table('qsales_quotation_documents_files')->insert(
               array('qtn_id' => $customer_id,'file' => $name, 'branch' => $branch,'caption' => $request->caption));
                    //

                $oldfiles = DB::table('qsell_quotation')->select('documents','id')->where('del_flag',1)->where('id',$customer_id)->limit(1)->get();

                    foreach ($oldfiles as $key => $value) {
                       $f= $value->documents;
                       $c= $value->id;
                    }

                       if(empty($c)) { 
                         DB::table('qsell_quotation')->insert(
               array('id' => $customer_id, 'branch' => $branch));
                     }


                    if(!empty($f)) { 

                      $nf=$f.','.'Quotationfiles/'.$customer_id.'/'.$name;
                       DB::table('qsell_quotation')
                                ->where('id', $customer_id)
                                ->update(['documents' =>$nf]);
                    }else{
                        DB::table('qsell_quotation')
                                ->where('id', $customer_id)
                                ->update(['documents' =>'Quotationfiles/'.$customer_id.'/'.$name]); 
                    }

                    ///
                $data[] = $name;
            }
        }
        }




    /*
          DB::table('qsales_quotation')
            ->where('customer_id', $customer_id)
            ->update(['documents' =>$request->doc]);*/

        return back()->with('success', 'Data Your files has been successfully added');
    }
    public function quotationfiledelete(Request $request)
    {
        $branch=Session::get('branch');
        $customer_id=$request->id;
        $file1name=$request->file1name;
        $ofile=$request->ofile;
        $docs=$request->docs;
        
         $path = public_path('Quotationfiles/'.$customer_id);

        File::delete($path.'/'.$ofile);

        DB::table('qsales_quotation_documents_files')->where('qtn_id',$customer_id)->where('file',$ofile)->delete();

        DB::table('qsell_quotation')
            ->where('id', $customer_id)
            ->update(['documents' =>$docs]);


        return response()->json('success');

    }

    

}

?>
<?php
namespace App\Http\Controllers\crm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Session;
use DB;
class FileUploadController extends Controller
{
    public function create()
    {
        return view('crm.create');
    }
    public function supdocumentFileUpload(Request $request)
    {
         $branch=Session::get('branch');
        $supplier_id=$request->supplier_id;
        $path = public_path('supdocumentInfoData/'.$supplier_id);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        if ($request->hasfile('filenames'))
        {
            foreach ($request->file('filenames') as $file)
            {



                $file_exist = DB::table('qcrm_supplier_documents_files')->where('file',$file->getClientOriginalName())->where('supplier_id',$supplier_id)->first();

                 if(!$file_exist){
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                DB::table('qcrm_supplier_documents_files')->insert(
               array('supplier_id' => $supplier_id,'file' => $name, 'branch' => $branch,'caption' => $request->caption));
                    //

                $oldfiles = DB::table('qcrm_supplier_documents')->select('documents','supplier_id')->where('del_flag',1)->where('supplier_id',$supplier_id)->limit(1)->get();
                    foreach ($oldfiles as $key => $value) {
                       $f= $value->documents;
                       $s= $value->supplier_id;
                    }

                     if(empty($s)) { 
                         DB::table('qcrm_supplier_documents')->insert(
               array('supplier_id' => $supplier_id, 'branch' => $branch));
                     }
                    if(!empty($f)) { 

                      $nf=$f.','.'supdocumentInfoData/'.$supplier_id.'/'.$name;
                       DB::table('qcrm_supplier_documents')
                                ->where('supplier_id', $supplier_id)
                                ->update(['documents' =>$nf]);
                    }else{
                        DB::table('qcrm_supplier_documents')
                                ->where('supplier_id', $supplier_id)
                                ->update(['documents' =>'supdocumentInfoData/'.$supplier_id.'/'.$name]); 
                    }

                    ///
                $data[] = $name;

            }
            }
        }





        return back()->with('success', 'Data Your files has been successfully added');
    }

     public function supplierdocumentDelete(Request $request)
    {
        $branch=Session::get('branch');
        $supplier_id=$request->supplier_id;
        $file1name=$request->file1name;
        $ofile=$request->ofile;
        $docs=$request->docs;
        
        $path = public_path('supdocumentInfoData/'.$supplier_id);

        File::delete($path.'/'.$ofile);

        DB::table('qcrm_supplier_documents_files')->where('supplier_id',$supplier_id)->where('file',$ofile)->delete();

        DB::table('qcrm_supplier_documents')
            ->where('supplier_id', $supplier_id)
            ->update(['documents' =>$docs]);


        return response()->json('success');

    }
    public function vendordocumentFileUpload(Request $request)
    {
         $branch=Session::get('branch');
        $vendor_id=$request->vendor_id;
        $path = public_path('vendordocumentInfoData/'.$vendor_id);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        if ($request->hasfile('filenames'))
        {
            foreach ($request->file('filenames') as $file)
            {

                  $file_exist = DB::table('qcrm_vendors_documents_files')->where('file',$file->getClientOriginalName())->where('vendor_id' ,$vendor_id)->first();

                 if(!$file_exist){


                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                DB::table('qcrm_vendors_documents_files')->insert(
               array('vendor_id' => $vendor_id,'file' => $name, 'branch' => $branch,'caption' => $request->caption));
                    //

                $oldfiles = DB::table('qcrm_vendors_documents')->select('documents','vendor_id')->where('del_flag',1)->where('vendor_id',$vendor_id)->limit(1)->get();
                    foreach ($oldfiles as $key => $value) {
                       $f= $value->documents;
                       $c= $value->vendor_id;
                    }

                       if(empty($c)) { 
                         DB::table('qcrm_vendors_documents')->insert(
               array('vendor_id' => $vendor_id, 'branch' => $branch));
                     }


                    if(!empty($f)) { 

                      $nf=$f.','.'vendordocumentInfoData/'.$vendor_id.'/'.$name;
                       DB::table('qcrm_vendors_documents')
                                ->where('vendor_id', $vendor_id)
                                ->update(['documents' =>$nf]);
                    }else{
                        DB::table('qcrm_vendors_documents')
                                ->where('vendor_id', $vendor_id)
                                ->update(['documents' =>'vendordocumentInfoData/'.$vendor_id.'/'.$name]); 
                    }

                    ///
                $data[] = $name;
            }
        }
        }




    /*
          DB::table('qcrm_customer_documents')
            ->where('customer_id', $customer_id)
            ->update(['documents' =>$request->doc]);*/

        return back()->with('success', 'Data Your files has been successfully added');
    }


     public function vendordocumentDelete(Request $request)
    {
        $branch=Session::get('branch');
        $vendor_id=$request->vendor_id;
        $file1name=$request->file1name;
        $ofile=$request->ofile;
        $docs=$request->docs;
        
        $path = public_path('vendordocumentInfoData/'.$vendor_id);

        File::delete($path.'/'.$ofile);

        DB::table('qcrm_vendors_documents_files')->where('vendor_id',$vendor_id)->where('file',$ofile)->delete();

        DB::table('qcrm_vendors_documents')
            ->where('vendor_id', $vendor_id)
            ->update(['documents' =>$docs]);


        return response()->json('success');

    }


    public function custdocumentInfoData(Request $request)
    {
        
        $branch=Session::get('branch');
        $customer_id=$request->customer_id;

        $path = public_path('custdocumentInfoData/'.$customer_id);
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
                  $file_exist = DB::table('qcrm_customer_documents_files')->where('file',$file->getClientOriginalName())->where('customer_id' ,$customer_id)->first();

                 if(!$file_exist){


                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                DB::table('qcrm_customer_documents_files')->insert(
               array('customer_id' => $customer_id,'file' => $name, 'branch' => $branch,'caption' => $request->caption));
                    //

                $oldfiles = DB::table('qcrm_customer_documents')->select('documents','customer_id')->where('del_flag',1)->where('customer_id',$customer_id)->limit(1)->get();

                    foreach ($oldfiles as $key => $value) {
                       $f= $value->documents;
                       $c= $value->customer_id;
                    }

                       if(empty($c)) { 
                         DB::table('qcrm_customer_documents')->insert(
               array('customer_id' => $customer_id, 'branch' => $branch));
                     }


                    if(!empty($f)) { 

                      $nf=$f.','.'custdocumentInfoData/'.$customer_id.'/'.$name;
                       DB::table('qcrm_customer_documents')
                                ->where('customer_id', $customer_id)
                                ->update(['documents' =>$nf]);
                    }else{
                        DB::table('qcrm_customer_documents')
                                ->where('customer_id', $customer_id)
                                ->update(['documents' =>'custdocumentInfoData/'.$customer_id.'/'.$name]); 
                    }

                    ///
                $data[] = $name;
            }
        }
        }




    /*
          DB::table('qcrm_customer_documents')
            ->where('customer_id', $customer_id)
            ->update(['documents' =>$request->doc]);*/

        return back()->with('success', 'Data Your files has been successfully added');
    }

    
   public function customerdocumentDelete(Request $request)
    {
        $branch=Session::get('branch');
        $customer_id=$request->customer_id;
        $file1name=$request->file1name;
        $ofile=$request->ofile;
        $docs=$request->docs;
        
         $path = public_path('custdocumentInfoData/'.$customer_id);

        File::delete($path.'/'.$ofile);

        DB::table('qcrm_customer_documents_files')->where('customer_id',$customer_id)->where('file',$ofile)->delete();

        DB::table('qcrm_customer_documents')
            ->where('customer_id', $customer_id)
            ->update(['documents' =>$docs]);


        return response()->json('success');

    }

    public function store(Request $request)
    {
        $path = public_path('userInfoData') . '/' . $request->UniqueID;
        if (File::exists($path))
        {
            echo $request->UniqueID;
        }
        else
        {
            echo $request->UniqueID;
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        if ($request->hasfile('filenames'))
        {
            foreach ($request->file('filenames') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);
                $data[] = $name;
            }
        }
        return back()->with('success', 'Data Your files has been successfully added');
    }

public function signatureupload(Request $request)
    {

    $path = public_path('signature');
   
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


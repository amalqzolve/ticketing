<?php
namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use DB;
use App\inventory\AttributeModel;
use App\inventory\Attributeoptionsmodel;
use Session;
use DataTables;
use Spatie\Activitylog\Models\Activity;

class AttributeController extends Controller
{
     /**
     * Display a listing of Various attributes.
     */

    public function AttributeListing(Request $request)
    {
           $branch=Session::get('branch');
$ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }

        if ($request->ajax()) {
            if($common_customer_database == 1)
            {
                $query  = AttributeModel::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = AttributeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query  = AttributeModel::orderby('id', 'desc');
            $query->where('del_flag', 1)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = AttributeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
         return view('inventory.attribute.listing');
    }


    /**
     * Add New Attribute Form.
     */

    public function NewAttribute()
    {
           $branch=Session::get('branch');

         return view('inventory.attribute.add',compact('branch'));
    }
    
    /**
     *  Attribute Delete Listing.
     */
    public function attributetrash(Request $request)
    {
        $ccd = DB::table('qsettings_company')->select('common_customer_database')->get();
    foreach($ccd as $cus)
    {
        $common_customer_database = $cus->common_customer_database;
    }
           $branch=Session::get('branch');
        
        if ($request->ajax()) {
            if($common_customer_database == 1)
            {
                $query  = AttributeModel::orderby('id', 'desc');
            $query->where('del_flag', 0);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = AttributeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            else
            {
                $query  = AttributeModel::orderby('id', 'desc');
            $query->where('del_flag', 0)->where('branch',$branch);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = AttributeModel::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
            }
            
        }
       return view('inventory.attribute.trash');

    }
    /**
     * Display a Edit listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editattribute(Request $request)
    {
           $branch=Session::get('branch');

         $id   = $request->id;

          $query =  DB::table('qinventory_attribute')
                    ->leftJoin('qinventory_attributeoptions', 'qinventory_attribute.id', '=', 'qinventory_attributeoptions.attribute_id')->where('qinventory_attribute.del_flag',1)
                    ->select('qinventory_attribute.*', 'qinventory_attributeoptions.option_name')
                    ->orderby('qinventory_attribute.id', 'desc')
                    ->where('qinventory_attribute.id',$id);
            $data = $query->get();

         return view('inventory.attribute.edit',['data'=>$data],compact('branch'));
    }

    /**
     * Store data for attribute table.
     *
     * @return \Illuminate\Http\Response
     */
    public function submitattribute(Request $request)
    {
        $branch = $request->branch;
         $id                 = $request->id;
         

            if(isset($id)&&!empty($id)){
                 $check = $this->check_exists_edit($id,$request->attribute_name,'attribute_name','qinventory_attribute');
            }else{
                $check = $this->check_exists($request->attribute_name,'attribute_name','qinventory_attribute'); 
            }
        


        if($check<1)
        {
         $data               = [
                               'attribute_name'=>$request->attribute_name,
                               'attribute_code'=>$request->attribute_code,
                               'description'=>$request->description,
                               'branch' => $branch
                              ];

        $attribute_id          = AttributeModel::updateOrCreate(['id'=>$id],$data);
        $options =implode(', ', array_column(json_decode($request->options), 'value'));
        $option_array =array_column(json_decode($request->options), 'value');
        $attribute_option_array =[];
         foreach ($option_array as $key => $value) {
             $attributeoption_id = DB::table('qinventory_attributeoptions')-> insertGetId(array(
            'attribute_id'=>$attribute_id->id,
            'option_name' =>$value
          ));
             array_push($attribute_option_array, $attributeoption_id);
         }

        DB::table('qinventory_attribute')->where('id', $attribute_id->id)->update(['options'=>$options]); 

        return 'true';
        }
        else
        {
            return 'false';
        }

    }

     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        AttributeModel::where('id',$id)->update(['del_flag'=>0]);
        return 'true';
    }
/**
  *attribute restore function
  */
    public function attributerestore(Request $request)
    {
        $id = $request->id;
        AttributeModel::where('id',$id)->update(['del_flag'=>1]);
        return 'true';
    }
/**
  *Attribute trash recover
  */    
    public function trashdelete_attribute(Request $request)
    {
        $id = $request->id;
        AttributeModel::where('id',$id)->delete();
        return 'true';
    }
    public function check_exists($value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }

        public function check_exists_edit($id,$value,$field,$table)
     {
        $query = DB::table($table)->select($field)->where($field,$value)->where('del_flag',1)->whereNotIn('id',[$id])->get();
         // $query = $this->db->select($field)->from($table)->where($field,$value)->where('qcrm_customer_groupdetails.del_flag',1)->get();
         return $query->count();
     }

}

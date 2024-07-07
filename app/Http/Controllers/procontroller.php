<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\prodcutdetailscontroller;
use Spatie\Activitylog\Models\Activity;

class procontroller extends Controller
{
    public function prodcutdetails()
    {
    	return view('product.index');
    }
    public function addproductdetails()
    {
        	return view('product.add');
	
    }
    public function productadddetails(Request $request)
    {
    	 // dd($request);
    	$id =$request->info_id;
    	$data=[
    		    'cust_code' => $request->cust_code,
    		    'cust_type' => $request->cust_type

    	];
    	prodcutdetailscontroller::updateOrCreate(['id'=>$id],$data);
    	return true;

    }
    public function productdetailslist(Request $request)
    {
    	 $totalFiltered = 0;
        $totalData = prodcutdetailscontroller::count();
        $query = prodcutdetailscontroller::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('custom_code', 'LIKE', "%{$search}%");
            $query->orWhere('custom_type', 'LIKE', "%{$search}%");

        }

        if (isset($_GET['columns'][3]['search']['value']) && $_GET['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_GET['columns'][3]['search']['value'];
            $query->Where('custom_code', 'LIKE', "%{$search_3}%");
            $query->Where('custom_type', 'LIKE', "%{$search_3}%");
            echo "test";
        }

        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $customer = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();

        foreach ($customer as $customer_detail)
        {

            $no++;

            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                        

                        <a href="#?id=' . $customer_detail->id . '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Groupupdate" data-id="' . $customer_detail->id . '" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_groupinformation" id=' . $customer_detail->id . ' data-id=' . $customer_detail->id . '>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $customer_detail->cust_code;
            $row[3] = $customer_detail->cust_type;
            $row[4] = '<div style="width:25px;border-radius: 17px;heigt:10px;background:#' . $customer_detail->color . '">&nbsp;&nbsp;</div>';

            $data[$i] = $row;
            $i++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        );
        echo json_encode($output);


    }
}

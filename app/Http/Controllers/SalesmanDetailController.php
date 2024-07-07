<?php
namespace App\Http\Controllers;
use App\SalesmanDetailModel;
use Illuminate\Http\Request;
use DB;
use Spatie\Activitylog\Models\Activity;
use PDF;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class SalesmanDetailController extends Controller
{
    public function salesmanindex()
    {
        return view('salesman_details.salesman_index');
    }
    public function trashsalesman()
    {
        return view('salesman_details.salesman_Details_trash');

    }
    public function edit_salesman(Request $request)
    {
        $id = $_REQUEST['id'];

        $salesman = SalesmanDetailModel::where('id', $id)->limit(1)
            ->first();
        return view('salesman_details.salesman_editdetails', ['data' => $salesman]);
    }
    
    public function Salesmandetailsrestore(Request $request)
    {
        $id = $request->id;
        SalesmanDetailModdel::where('id', $id)->update(['del_flag' => 1]);
        return 'true';
    }
    public function Salesmandetailstrash(Request $request)
    {
        $totalFiltered = 0;
        $totalData = SalesmanDetailModdel::count();
        $query = SalesmanDetailModdel::orderby('id', 'desc');
        $query->where('del_flag', 0);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('name', 'LIKE', "%{$search}%");
            $query->orWhere('address1', 'LIKE', "%{$search}%");
            $query->orWhere('address3', 'LIKE', "%{$search}%");
            $query->orWhere('address2', 'LIKE', "%{$search}%");
            $query->orWhere('zip', 'LIKE', "%{$search}%");
            $query->orWhere('country', 'LIKE', "%{$search}%");
            $query->orWhere('region', 'LIKE', "%{$search}%");
            $query->orWhere('place', 'LIKE', "%{$search}%");
            $query->orWhere('department_head', 'LIKE', "%{$search}%");
            $query->orWhere('department', 'LIKE', "%{$search}%");
            $query->orWhere('salesman_route', 'LIKE', "%{$search}%");

        }

        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('name', 'LIKE', "%{$search_3}%");
            $query->Where('address1', 'LIKE', "%{$search_3}%");
            $query->Where('address2', 'LIKE', "%{$search_3}%");
            $query->Where('address3', 'LIKE', "%{$search_3}%");
            $query->Where('zip', 'LIKE', "%{$search_3}%");
            $query->Where('country', 'LIKE', "%{$search_3}%");
            $query->Where('place', 'LIKE', "%{$search_3}%");
            $query->Where('region', 'LIKE', "%{$search_3}%");
            $query->Where('department_head', 'LIKE', "%{$search_3}%");
            $query->Where('department', 'LIKE', "%{$search_3}%");
            $query->Where('salesman_route', 'LIKE', "%{$search_3}%");

            echo "test";
        }

        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $salesman = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();

        foreach ($salesman as $salesman_detail)
        {

            $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">


                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text salesmanrestores" id=' . $salesman_detail->id . ' data-id=' . $salesman_detail->id . '>Restore</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $salesman_detail->name;
            $row[3] = $salesman_detail->address1;
            $row[4] = $salesman_detail->address2;
            $row[5] = $salesman_detail->address3;
            $row[6] = $salesman_detail->zip;
            $row[7] = $salesman_detail->country;
            $row[8] = $salesman_detail->region;

            $row[9] = $salesman_detail->place;
            $row[10] = $salesman_detail->department;
            $row[11] = $salesman_detail->department_head;
            $row[12] = $salesman_detail->salesman_route;

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
    public function deletesalesman(Request $request)
    {
        $id = $request->id;
        SalesmanDetailModdel::where('id', $id)->update(['del_flag' => 0]);
        return 'true';

    }
    public function addsalesmandetails()
    {
        return view('salesman_details.salesman_adddetails');

    }

    /**
    * Store a newly salesman.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    
    public function SalesmanSubmit(Request $request)
    {

        $request->validate(['name' => 'required'], ['name.required' => 'name is required']);
        
        $user           = auth()->user();

        $postID         = $request->info_id;
 
        $input=[
         'name'            => $request->name,
         'email'           => $request->email,
         'password'        => Hash::make($request->password),
         ];
        $user = User::create($input);

        $sales=$user->assignRole('salesman');
          
        $data           = ['user_id'         => $user->id,
                           'name'            => $request->name,
                           'email'           => $request->email,
                           'password'        => encrypt($request->password),

                           'address1'        => $request->address1, 
                           'address2'        => $request->address2,
                           'address3'        => $request->address3, 
                           'zip'             => $request->zip, 
                           'country'         => $request->country,
                           'region'          => $request->region,
                           'place'           => $request->place, 
                           'department'      => $request->department, 
                           'department_head' => $request->department_head,
                           'salesman_route'  => $request->salesman_route
                          ];

        $userInfo       = SalesmanDetailModel::updateOrCreate(['id' => $postID], $data);
        $id             = DB::getPdo('salesman_details')->lastInsertId();

        return 'true';
    }

    public function SalesmandetailsList(Request $request)
    {
        $totalFiltered = 0;
        $totalData = SalesmanDetailModel::count();
        $query = SalesmanDetailModel::orderby('id', 'desc');
        $query->where('del_flag', 1);
        if (!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $query->Where('id', 'LIKE', "%{$search}%");
            $query->orWhere('name', 'LIKE', "%{$search}%");
            $query->orWhere('address1', 'LIKE', "%{$search}%");
            $query->orWhere('address3', 'LIKE', "%{$search}%");
            $query->orWhere('address2', 'LIKE', "%{$search}%");
            $query->orWhere('zip', 'LIKE', "%{$search}%");
            $query->orWhere('country', 'LIKE', "%{$search}%");
            $query->orWhere('region', 'LIKE', "%{$search}%");
            $query->orWhere('place', 'LIKE', "%{$search}%");
            $query->orWhere('department_head', 'LIKE', "%{$search}%");
            $query->orWhere('department', 'LIKE', "%{$search}%");
            $query->orWhere('salesman_route', 'LIKE', "%{$search}%");

        }

        if (isset($_POST['columns'][3]['search']['value']) && $_POST['columns'][3]['search']['value'] != '')
        {
            $search_3 = $_POST['columns'][3]['search']['value'];
            $query->Where('name', 'LIKE', "%{$search_3}%");
            $query->Where('address1', 'LIKE', "%{$search_3}%");
            $query->Where('address2', 'LIKE', "%{$search_3}%");
            $query->Where('address3', 'LIKE', "%{$search_3}%");
            $query->Where('zip', 'LIKE', "%{$search_3}%");
            $query->Where('country', 'LIKE', "%{$search_3}%");
            $query->Where('place', 'LIKE', "%{$search_3}%");
            $query->Where('region', 'LIKE', "%{$search_3}%");
            $query->Where('department_head', 'LIKE', "%{$search_3}%");
            $query->Where('department', 'LIKE', "%{$search_3}%");
            $query->Where('salesman_route', 'LIKE', "%{$search_3}%");

            echo "test";
        }

        $totalFiltered = $query->count();
        $query->skip($_POST['start'])->take($_POST['length']);
        $salesman = $query->get();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        $row = array();

        foreach ($salesman as $salesman_detail)
        {

            $no++;
            $row[0] = $no;
            $row[1] = '<span style="overflow: visible; position: relative; width: 80px;">
                        <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">

                        <a href="view_salesman?id=' . $salesman_detail->id . '" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text" data-id="' . $salesman_detail->id . '" >View</span>
                        </span></li></a>

                       <a href="edit_salesman?id=' . $salesman_detail->id . '" ><li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-contract"></i>
                        <span class="kt-nav__link-text Customersdetail_update" data-id="' . $salesman_detail->id . '" >Edit</span>
                        </span></li></a>

                          <li class="kt-nav__item">
                        <span class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                        <span class="kt-nav__link-text kt_del_salesmaninformation" id=' . $salesman_detail->id . ' data-id=' . $salesman_detail->id . '>Delete</span></span></li>

                       </ul></div></div></span>';
            $row[2] = $salesman_detail->name;
            $row[3] = $salesman_detail->email;
            $row[4] = $salesman_detail->password;
            $row[5] = $salesman_detail->address1;
            $row[6] = $salesman_detail->address2;
            $row[7] = $salesman_detail->address3;
            $row[8] = $salesman_detail->zip;
            $row[9] = $salesman_detail->country;
            $row[10] = $salesman_detail->region;

            $row[11] = $salesman_detail->place;
            $row[12] = $salesman_detail->department;
            $row[13] = $salesman_detail->department_head;
            $row[14] = $salesman_detail->salesman_route;

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
    public function view_salesman(Request $request)
    {
        $id = $_REQUEST['id'];
        $salesman = SalesmanDetailModel::where('id', $id)->limit(1)
            ->first();
        return view('salesman_details.salesman_view', ['data' => $salesman]);
    }
}


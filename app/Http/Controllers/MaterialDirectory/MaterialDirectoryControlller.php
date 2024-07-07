<?php

namespace App\Http\Controllers\MaterialDirectory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\boq\MaterialDirectoryModel;
use DataTables;
use Auth;
use App\Imports\MaterialDirectoryImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class MaterialDirectoryControlller extends Controller
{

  public function dashboard(Request $request)
  {
    return view('materialDirectory.dashboard.index');
  }
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = MaterialDirectoryModel::select('material_directory.id', 'material_directory.material_name', 'material_directory.description', 'material_directory.code', 'material_directory.unit', 'material_directory.category', 'material_directory.group', 'material_directory.amount',  DB::raw("DATE_FORMAT(material_directory.valid_till, '%d-%m-%Y') as valid_till"), 'users.name', 'material_directory.updated_at')
        ->leftJoin('users', 'material_directory.created_by', 'users.id')
        ->get();
      $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
        return $row->id;
      })->addColumn('updated_at', function ($row) {
        return ($row->updated_at != '') ? Carbon::parse($row->updated_at)->format('d M Y  h:i') : NULL;
      })->rawColumns(['action']);
      return  $dtTble->make(true);
    } else
      return view('materialDirectory.material_directory.listing');
  }
  public function add(Request $request)
  {
    return view('materialDirectory.material_directory.add');
  }

  public function save(Request $request)
  {
    $useasr_id = Auth::user()->id;
    $branch = Session::get('branch');
    for ($i = 0; $i < count($request->material_name); $i++) {

      $validDate = str_replace('/', '-', $request->valid_till[$i]);
      $data = [
        'material_name' => $request->material_name[$i],
        'description' => $request->description[$i],
        'code' => $request->code[$i],
        'unit' => $request->unit[$i],
        'category' => $request->category[$i],
        'group' => $request->group[$i],
        'amount' => $request->amount[$i],
        'branch' => $branch,
        'valid_till' => isset($validDate) ? Carbon::parse($validDate)->format('Y-m-d  h:i') : NULL,
        'created_by' => $useasr_id,
      ];
      if ($request->request_against == 1) {
        $upQty = $request->reqQty[$i] + $request->quantity[$i];
        $this->updateBoq($request->product_id[$i], $upQty);
      }
      $MaterialDirectory = MaterialDirectoryModel::Create($data);
    }
    return 'true';
  }

  public function editView(Request $request)
  {
    $id = $request->id;
    $mainData = MaterialDirectoryModel::find($id);
    return view('materialDirectory.material_directory.edit', compact('mainData'));
  }
  public function update(Request $request)
  {
    $postID = $request->id;
    $useasr_id = Auth::user()->id;
    $data = array(
      'material_name' => $request->material_name,
      'description' => $request->description,
      'code' => $request->code,
      'unit' => $request->unit,
      'category' => $request->category,
      'group' => $request->group,
      'amount' => $request->amount,
      'created_by' => $useasr_id,
      'valid_till' => isset($request->valid_till) ? Carbon::parse($request->valid_till)->format('Y-m-d  h:i') : NULL,
    );
    $mr = MaterialDirectoryModel::updateOrCreate(['id' => $postID], $data);
  }

  public function fileUp(Request $request)
  {
    return view('materialDirectory.material_directory.upload');
  }

  public function file_import(Request $request)
  {
    $useasr_id = Auth::user()->id;
    $branch = Session::get('branch');
    Excel::import(new MaterialDirectoryImport($useasr_id, $branch), $request->file('file')->store('temp'));
    return redirect()->route('material-directory');
  }

  public function getTmplate()
  {
    $filepath = public_path('resource_directory_template.xlsx');
    // ob_end_clean();
    // ob_start();
    return response()->download($filepath, 'resource_directory_template.xlsx', [
      'Content-Type' => 'application/vnd.ms-excel',
      'Content-Disposition' => 'inline; filename="resource_directory_template.xlsx"'
    ]);
  }
}

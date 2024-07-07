<?php

namespace App\Http\Controllers\boq;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Boq;
use File;
use Response;
use App\boq\BoqProductModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BoqmainImport;
use App\Imports\BoqchildImport;
use Illuminate\Support\Facades\Log;
use App\crm\CustomerModel;
use App\Tender\TenderModel;
use Carbon\Carbon;
use DataTables;




class BOQController extends Controller
{

  public function list(Request $request)
  {
    if ($request->ajax()) {
      $data = Boq::select('boqs.*', 'boqs.status', 'boqs.description as description', 'boqs.id as id', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as projectname')
        ->whereNull('parent_id')
        ->leftjoin('qprojects_projects', 'boqs.projectname', '=', 'qprojects_projects.id')
        ->leftjoin('qcrm_customer_details', 'boqs.client', '=', 'qcrm_customer_details.id')
        ->get();

      $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
        return $row->id;
      });
      return $dtTble->make(true);
    } else {
      $projects = DB::table('qprojects_projects')->select('id', 'projectname')->where('del_flag', 1)->get();
      $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
      $tender = TenderModel::select('id')->where('participation_status', 1)->get();
      return view('boq.boq.list', compact('projects', 'customers', 'tender'));
    }
  }


  public function listChilden(Request $request)
  {
    $parent = $request->id;
    if ($request->ajax()) {
      $data = Boq::where('parent_id', $parent)->orderBy('id', 'ASC')->get(); //->where('alocation_flg', 1)
      $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
        return $row->id;
      });
      return $dtTble->make(true);
    } else {
      if ($parent != '') {
        $boq = Boq::where('id', $parent)->first(); //->value('parent_id');
        $assent_id = $boq->parent_id;
        $parent_name = $boq->category_name; //Boq::where('id', $parent)->value('category_name');
        return view('boq.boq.listChild', compact('assent_id', 'parent_name', 'parent', 'boq'));
      } else
        return redirect()->route('list-boq', null);
    }
  }

  public function listEstimationPending(Request $request)
  {
    if ($request->ajax()) {
      $data = Boq::select('boqs.*', 'boqs.status', 'boqs.description as description', 'boqs.id as id', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as projectname')
        ->whereNull('parent_id')
        ->where('boqs.status', 1)
        ->where('boqs.estimation_status', '!=', 1)
        ->leftjoin('qprojects_projects', 'boqs.projectname', '=', 'qprojects_projects.id')
        ->leftjoin('qcrm_customer_details', 'boqs.client', '=', 'qcrm_customer_details.id')
        ->get();

      $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
        return $row->id;
      });
      return $dtTble->make(true);
    } else {
      $projects = DB::table('qprojects_projects')->select('id', 'projectname')->where('del_flag', 1)->get();
      $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
      $tender = TenderModel::select('id')->where('participation_status', 1)->get();
      return view('boq.boq.listEstimationPending', compact('projects', 'customers', 'tender'));
    }
  }


  public function listChildenEstimationPending(Request $request)
  {
    $parent = $request->id;
    if ($request->ajax()) {
      $data = Boq::where('parent_id', $parent)->orderBy('id', 'ASC')->get(); //->where('alocation_flg', 1)
      $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
        return $row->id;
      });
      return $dtTble->make(true);
    } else {
      if ($parent != '') {
        $boq = Boq::where('id', $parent)->first(); //->value('parent_id');
        $assent_id = $boq->parent_id;
        $parent_name = $boq->category_name; //Boq::where('id', $parent)->value('category_name');
        return view('boq.boq.listChildEstimationPending', compact('assent_id', 'parent_name', 'parent', 'boq'));
      } else
        return redirect()->route('list-boq-estimation-pending', null);
    }
  }





  public function listEstimationCompleted(Request $request)
  {
    if ($request->ajax()) {
      $data = Boq::select('boqs.*', 'boqs.status', 'boqs.description as description', 'boqs.id as id', 'qcrm_customer_details.cust_name', 'qprojects_projects.projectname as projectname')
        ->whereNull('boqs.parent_id')
        ->where(function ($query) {
          $query->whereIn('boqs.status', [2, 3])
            ->orWhere('boqs.estimation_status', 1);
        })
        ->leftjoin('qprojects_projects', 'boqs.projectname', '=', 'qprojects_projects.id')
        ->leftjoin('qcrm_customer_details', 'boqs.client', '=', 'qcrm_customer_details.id')
        ->get();

      $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
        return $row->id;
      });
      return $dtTble->make(true);
    } else {
      $projects = DB::table('qprojects_projects')->select('id', 'projectname')->where('del_flag', 1)->get();
      $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
      $tender = TenderModel::select('id')->where('participation_status', 1)->get();
      return view('boq.boq.listEstimationCompleted', compact('projects', 'customers', 'tender'));
    }
  }


  public function listChildenEstimationCompleted(Request $request)
  {
    $parent = $request->id;
    if ($request->ajax()) {
      $data = Boq::where('parent_id', $parent)->orderBy('id', 'ASC')->get(); //->where('alocation_flg', 1)
      $dtTble = Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
        return $row->id;
      });
      return $dtTble->make(true);
    } else {
      if ($parent != '') {
        $boq = Boq::where('id', $parent)->first(); //->value('parent_id');
        $assent_id = $boq->parent_id;
        $parent_name = $boq->category_name; //Boq::where('id', $parent)->value('category_name');
        return view('boq.boq.listChildEstimationCompleted', compact('assent_id', 'parent_name', 'parent', 'boq'));
      } else
        return redirect()->route('list-boq-estimation-completed', null);
    }
  }





  public function boq_main_edit(Request $request)
  {
    $main = $request->id;
    $boqs = DB::table('boqs')->select('*')->where('id', $main)->get();
    $projects = DB::table('boqs')->leftjoin('qprojects_projects', 'boqs.projectname', '=', 'qprojects_projects.id')->select('qprojects_projects.id', 'qprojects_projects.projectname')->where('boqs.id', $main)->get();
    $customers = CustomerModel::select('cust_name', 'id')->where('del_flag', 1)->get();
    $tender = TenderModel::select('id')->where('participation_status', 1)->get();
    return view('boq.boq.main_edit', compact('boqs', 'projects', 'customers', 'tender'));
  }

  public function mainboqupdate(Request $request)
  {
    Boq::where('id', $request->id)
      ->update(['category_name' => $request->category_name,  'projectname' => $request->projectname, 'description' => $request->description, 'client' => $request->client]);
    return 'true';
  }


  public function boqsubmit(Request $request)
  {
    $node = Boq::create([
      'category_name' => $request->name,
      'description' => $request->description,
      'projectname' => $request->projectname,
      'client' => $request->client,
      'type' => $request->type,
      'tender_id' => $request->tender_id,
      'date' => Carbon::parse($request->date)->format('Y-m-d  h:i')
    ]);
    DB::table('boqs')->where('id', $node->id)->update(['category_code' => $node->id]);
    return 'true';
  }

  public function sendToEstimation(Request $request)
  {
    $id = $request->id;
    if ($id) {
      $ifFind = Boq::whereIn('id', BOQ::select('id')->descendantsAndSelf($id))->update(['status' => 1]);
      $out = array(
        'status' => 1,
        'message' => 'Success',
      );
    } else
      $out = array(
        'status' => 0,
        'message' => 'Error',
      );
    echo json_encode($out);
  }

  public function enableEdit(Request $request)
  {
    $id = $request->id;
    if ($id) {
      $ifFind = Boq::whereIn('id', BOQ::select('id')->descendantsAndSelf($id))->update(['status' => NULL, 'estimation_status' => NULL]);
      $out = array(
        'status' => 1,
        'message' => 'Success',
      );
    } else
      $out = array(
        'status' => 0,
        'message' => 'Error',
      );
    echo json_encode($out);
  }




  public function sendToTender(Request $request)
  {
    $id = $request->id;
    if ($id) {
      $ifFind = Boq::whereIn('id', BOQ::select('id')->descendantsAndSelf($id))->update(['status' => 3]);
      $out = array(
        'status' => 1,
        'message' => 'Success',
      );
    } else
      $out = array(
        'status' => 0,
        'message' => 'Error',
      );
    echo json_encode($out);
  }


  public function boqupdate(Request $request)
  {
    $data['users'] = Boq::where('id', $request->info_id)
      ->limit(1)
      ->first();
    echo json_encode($data);
  }
  public function boq_update(Request $request)
  {
    Boq::where('id', $request->info_id)
      ->update([
        'category_name' => $request->name,
        'projectname' => $request->projectname,
        'description' => $request->description,
        'type' => $request->type,
        'tender_id' => $request->tender_id,
        'date' => Carbon::parse($request->date)->format('Y-m-d  h:i'),
      ]);
    return 'true';
  }
  public function main_boq_download()
  {
    $filepath = public_path('Book1.xlsx');
    ob_end_clean();
    ob_start();
    return response()->download($filepath, 'Book1.xlsx', [
      'Content-Type' => 'application/vnd.ms-excel',
      'Content-Disposition' => 'inline; filename="Book1.xlsx"'
    ]);
  }
  public function exportdata()
  {
    return view('boq.boq.export');
  }
  public function submit_file(Request $request)
  {
    Excel::import(new BoqmainImport, $request->file('file')->store('temp'));
    return redirect()->route('main')->with('message', 'State saved correctly!!!');
  }

  public function boqaddparent(Request $request)
  {

    $parent = $request->ids;
    $parent_name = Boq::where('id', $parent)->value('category_name');
    $branch = Session::get('branch');
    $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
    $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
    return view('boq.boq.addparent', compact('productlist', 'unitlist', 'parent', 'parent_name'));
  }


  public function boqadd(Request $request)
  {
    $branch = Session::get('branch');
    $parent = $request->ids;
    $parent_name = Boq::where('id', $parent)->value('category_name');
    $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
    $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
    return view('boq.boq.add', compact('vatlist', 'unitlist', 'parent', 'parent_name'));
  }


  public function searcheads(Request $request)
  {
    return BoqProductModel::where('product_name', 'LIKE', '%' . $request->q . '%')->where('product_type', 2)->get();
  }

  public function innerboqsubmit(Request $request)
  {
    $branch = Session::get('branch');
    $parent_child = $request->parent;
    for ($i = 0; $i < count($request->head_name); $i++) {
      $query = DB::table('boq_products')->select('product_name', 'boq_product_id')->where('product_name', $request->head_name[$i])->where('del_flag', 1)->get();
      if ($query->count() > 0) {
        foreach ($query as $key => $value) {
          $boq_product_id = $value->boq_product_id;
        }
      } else {
        $data = [
          'product_name' => $request->head_name[$i],
          'description' => $request->product_description[$i],
          'product_type' => 2,
          'branch' => $branch
        ];
        $head_product = DB::table('boq_products')->insert($data);
        $boq_product_id = DB::getPdo()->lastInsertId();
      }
      //
      // Log::info('insert.', ['id' => $boq_product_id]);
      $node = Boq::create([
        'ref' => $request->ref[$i],
        'category_name' => $request->head_name[$i],
        'unit' => $request->unit[$i],
        'quantity' => $request->quantity[$i],
        // 'rate' => $request->rate[$i],
        // 'discountamount' => $request->rdiscount[$i],
        // 'amount1' => $request->amount[$i],
        // 'vat_percentage' => $request->vat_percentage[$i],
        // 'vatamount' => $request->vatamount[$i],
        // 'totalamount' => $request->row_total[$i],
        // 'amount' => $request->row_total[$i],
        'description' => $request->product_description[$i],
      ]);

      $child_id = $node->id;
      $parent = Boq::findOrFail($parent_child);
      $node->appendToNode($parent)->save();
      //
      $result = Boq::ancestorsOf($child_id);
      $pid = '';
      foreach ($result as  $value) {
        $nodes = Boq::findOrFail($value->id);
        if ($nodes->isRoot()) {
          $pid .= $value->id . '-';
        } else {
          $result1 = $nodes->getSiblings()->count();
          $num_padded = sprintf("%02d", $result1);
          $pid .= $num_padded . '-';
        }
      }
      $result2 = $node->getSiblings()->count() + 1;
      $num_padded1 = sprintf("%02d", $result2);
      $pid .= $num_padded1;
      DB::table('boqs')->where('id', $node->id)->update(['category_code' => $pid]);
      //calculate
    }
    // $nodes = Boq::reversed()->get();
    // $traverse = function ($categories, $prefix = '-&nbsp;<br>') use (&$traverse) {
    //   foreach ($categories as $category) {
    //     $parent_total = Boq::where('parent_id', '=', $category->parent_id)->sum('totalamount');
    //     $parent_quantity = Boq::where('parent_id', '=', $category->parent_id)->sum('quantity');
    //     $parent_amount = Boq::where('parent_id', '=', $category->parent_id)->sum('amount');
    //     $parent_vatamount = Boq::where('parent_id', '=', $category->parent_id)->sum('vatamount');
    //     $parent_totalamount = Boq::where('parent_id', '=', $category->parent_id)->sum('totalamount');
    //     Boq::where('id', $category->parent_id)->update(['totalamount' => $parent_total]);
    //     Boq::where('id', $category->parent_id)->update(['quantity' => $parent_quantity]);
    //     Boq::where('id', $category->parent_id)->update(['amount' => $parent_amount]);
    //     Boq::where('id', $category->parent_id)->update(['vatamount' => $parent_vatamount]);
    //     Boq::where('id', $category->parent_id)->update(['totalamount' => $parent_totalamount]);
    //     $traverse($category->children, $prefix . '~');
    //   }
    // };

    // $traverse($nodes);


    return 'true';
  }
  public function children_boq_download()
  {
    $filepath = public_path('Book2.xlsx');
    ob_end_clean();
    ob_start();
    return response()->download($filepath, 'Book2.xlsx', [
      'Content-Type' => 'application/vnd.ms-excel',
      'Content-Disposition' => 'inline; filename="Book2.xlsx"'
    ]);
  }
  public function exportdata_child(Request $request)
  {
    $parent = $request->ids;
    $parent_name = Boq::where('id', $parent)->value('category_name');

    return view('boq.boq.export_child', compact('parent', 'parent_name'));
  }
  public function file_import_child(Request $request)
  {
    $parent_child = $request->parent;
    Excel::import(new BoqchildImport($parent_child), $request->file('file')->store('temp'));
    return redirect()->to($request->bpage);
  }

  public function innerboqedit(Request $request)
  {
    $id = $request->id;
    $branch = Session::get('branch');
    $productlist = DB::table('qinventory_products')->select('*')->where('del_flag', 1)->where('branch', $branch)->get();
    $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
    $boq = DB::table('boqs')->select('*')->where('id', $id)->get();
    return view('boq.boq.edit', compact('productlist', 'unitlist', 'boq'));
  }
  public function innerboqupdate(Request $request)
  {
    Boq::where('id', $request->id)->update([
      'productname' => $request->productname,
      'unit' => $request->unit,
      'quantity' => $request->quantity,
      'rate' => $request->rate,
      'discountamount' => $request->discountamount,
      'amount1' => $request->amount,
      'vat_percentage' => $request->vat_percentage,
      'vatamount' => $request->vatamount,
      'totalamount' => $request->totalamount,
      'description' => $request->description,

    ]);
    // $nodes = Boq::reversed()->get();
    // $traverse = function ($categories, $prefix = '-&nbsp;<br>') use (&$traverse) {
    //   foreach ($categories as $category) {
    //     $parent_total = Boq::where('parent_id', '=', $category->parent_id)->sum('totalamount');
    //     $parent_quantity = Boq::where('parent_id', '=', $category->parent_id)->sum('quantity');
    //     $parent_amount = Boq::where('parent_id', '=', $category->parent_id)->sum('amount');
    //     $parent_vatamount = Boq::where('parent_id', '=', $category->parent_id)->sum('vatamount');
    //     $parent_totalamount = Boq::where('parent_id', '=', $category->parent_id)->sum('totalamount');
    //     Boq::where('id', $category->parent_id)->update(['totalamount' => $parent_total]);
    //     Boq::where('id', $category->parent_id)->update(['quantity' => $parent_quantity]);
    //     Boq::where('id', $category->parent_id)->update(['amount' => $parent_amount]);
    //     Boq::where('id', $category->parent_id)->update(['vatamount' => $parent_vatamount]);
    //     Boq::where('id', $category->parent_id)->update(['totalamount' => $parent_totalamount]);
    //     // echo PHP_EOL.$prefix.'-'.$category->category_name.' '.$category->totalamount.'-'.$category->parent_id;
    //     /*Log::info('===================', ['children total' =>$total]);*/
    //     //Log::info('===================', ['id' =>$category->children]);
    //     $traverse($category->children, $prefix . '~');
    //   }
    // };
    // $traverse($nodes);
    return 'true';
  }


  public function innerboqsubmitgroup(Request $request)
  {

    $parent_child = $request->parent;
    $node = Boq::create([
      //  'category_name' =>$product_name,
      'category_name' => $request->productname,
      'quantity' => $request->total_quantity,
      'amount1' => $request->total_amount,
      'description' => $request->description,
      'vatamount' => $request->total_vat,
      'totalamount' => $request->grandtotal,
      'amount' => $request->grandtotal,
      'is_parent' => 1,
    ]);

    $child_id = $node->id;
    $parent = Boq::findOrFail($parent_child);
    $node->appendToNode($parent)->save();
    $result = Boq::ancestorsOf($child_id);
    $pid = '';
    foreach ($result as  $value) {
      $nodes = Boq::findOrFail($value->id);
      if ($nodes->isRoot()) {
        // dd($value->id);
        $pid .= $value->id . '-';
      } else {
        $result1 = $nodes->getSiblings()->count();
        $num_padded = sprintf("%02d", $result1);
        $pid .= $num_padded . '-';
      }
    }

    $result2 = $node->getSiblings()->count() + 1;
    $num_padded1 = sprintf("%02d", $result2);
    $pid .= $num_padded1;
    DB::table('boqs')->where('id', $node->id)->update(['category_code' => $pid]);
    //calculate
    // $nodes = Boq::reversed()->get();
    // $traverse = function ($categories, $prefix = '-&nbsp;<br>') use (&$traverse) {
    //   foreach ($categories as $category) {
    //     $parent_total = Boq::where('parent_id', '=', $category->parent_id)->sum('totalamount');
    //     $parent_quantity = Boq::where('parent_id', '=', $category->parent_id)->sum('quantity');
    //     $parent_amount = Boq::where('parent_id', '=', $category->parent_id)->sum('amount');
    //     $parent_vatamount = Boq::where('parent_id', '=', $category->parent_id)->sum('vatamount');
    //     $parent_totalamount = Boq::where('parent_id', '=', $category->parent_id)->sum('totalamount');
    //     Boq::where('id', $category->parent_id)->update(['totalamount' => $parent_total]);
    //     Boq::where('id', $category->parent_id)->update(['quantity' => $parent_quantity]);
    //     Boq::where('id', $category->parent_id)->update(['amount' => $parent_amount]);
    //     Boq::where('id', $category->parent_id)->update(['vatamount' => $parent_vatamount]);
    //     Boq::where('id', $category->parent_id)->update(['totalamount' => $parent_totalamount]);
    //     $traverse($category->children, $prefix . '~');
    //   }
    // };
    // $traverse($nodes);
    return 'true';
  }

  public function boq_bulk_edit(Request $request)
  {
    $parent_child = $request->parent;
    $edit_ids = $request->ids;
    $id_arr = explode(",", $request->ids);
    $items = Boq::whereIn('id', $id_arr)->get();
    //  dd($items);
    $branch = Session::get('branch');
    $unitlist = DB::table('qinventory_product_unit')->select('id', 'unit_name')->where('branch', $branch)->where('del_flag', 1)->get();
    $vatlist   = DB::table('qpurchase_taxgroup')->select('id', 'total', 'default_tax')->where('del_flag', 1)->where('branch', $branch)->get();
    return view('boq.boq.bulk_edit', compact('vatlist', 'unitlist', 'items', 'edit_ids', 'parent_child'));
  }
  public function innerboqupdatebulk(Request $request)
  {

    $branch = Session::get('branch');
    $parent_child = $request->parent_child;
    $edit_ids = $request->edit_ids;
    $id_arr = explode(",", $request->edit_ids);
    for ($i = 0; $i < count($request->head_id); $i++) {
      Boq::where('id', $request->head_id[$i])->update([
        'category_name' => $request->head_name[$i],
        'unit' => $request->unit[$i],
        'ref' => $request->ref[$i],
        'quantity' => $request->quantity[$i],
      ]);
    }
    // $nodes = Boq::reversed()->get();
    // $traverse = function ($categories, $prefix = '-&nbsp;<br>') use (&$traverse) {
    //   foreach ($categories as $category) {
    //     $parent_total = Boq::where('parent_id', '=', $category->parent_id)->sum('totalamount');
    //     $parent_quantity = Boq::where('parent_id', '=', $category->parent_id)->sum('quantity');
    //     $parent_amount = Boq::where('parent_id', '=', $category->parent_id)->sum('amount');
    //     $parent_vatamount = Boq::where('parent_id', '=', $category->parent_id)->sum('vatamount');
    //     $parent_totalamount = Boq::where('parent_id', '=', $category->parent_id)->sum('totalamount');
    //     Boq::where('id', $category->parent_id)->update(['totalamount' => $parent_total]);
    //     Boq::where('id', $category->parent_id)->update(['quantity' => $parent_quantity]);
    //     Boq::where('id', $category->parent_id)->update(['amount' => $parent_amount]);
    //     Boq::where('id', $category->parent_id)->update(['vatamount' => $parent_vatamount]);
    //     Boq::where('id', $category->parent_id)->update(['totalamount' => $parent_totalamount]);
    //     $traverse($category->children, $prefix . '~');
    //   }
    // };
    // $traverse($nodes);
    return 'true';
  }
}

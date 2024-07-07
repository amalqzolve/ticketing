<?php

namespace App\Http\Controllers\documentation;

use App\Http\Controllers\Controller;
use App\documentation\HelpCategory;
use App\documentation\HelpArticle;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Session;
use Auth;

class HelpCategoryController extends Controller
{
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $user = Auth::user();
            $query = HelpCategory::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = HelpCategory::count();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) use ($user) {
                    $options = '';
                    $optionCount = 0;
                    if ($user->can('documentation edit-category')) {
                        $options .= '<a href="#?id=' . $row->id . '" data-type="edit" >
                                    <li class="kt-nav__item">
                                    <span class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-edit"></i> <span class="kt-nav__link-text helpcategoryedit" data-id="' . $row->id . '" >Edit</span>
                                    </li>
                                    </a>';
                        $optionCount++;
                    }
                    if ($user->can('documentation delete-category')) {
                        $options .= '<li class="kt-nav__item">
                                    <span class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-trash"></i> <span class="kt-nav__link-text helpcategorydelete" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span>
                                   </li>';
                        $optionCount++;
                    }
                    if ($optionCount) {
                        return '<span style="overflow: visible; position: relative; width: 80px;">
						      <div class="dropdown">
                               <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="fa fa-cog"></i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        ' . $options . '
                                   </ul>
                                 </div>
                               </div>
                            </span>';
                    } else
                        return '-';
                })->addColumn('status', function ($row) {
                    if ($row->status == 'Inactive')
                        return '<span style="color: red">Inactive</span>';
                    else if ($row->status == 'Active')
                        return '<span style="color: green">Active</span>';
                    else
                        return '';
                })->rawColumns(['action', 'status'])->make(true);
        }

        return view('documentation.help_category.index');
    }
    public function create()
    {
        return view('documentation.help_category.index');
    }

    public function save(Request $request)
    {
        $tittleCount = HelpCategory::where('title', $request->title)->where('id', '!=', $request->id)->where('del_flag', 1)->count();
        if ($tittleCount >= 1) {
            $out = array(
                'status' => 2,
                'msg' => 'Category Tittle Already Exist'
            );
            echo json_encode($out);
            die();
        }
        $tittleSort = HelpCategory::where('sort', $request->sort)->where('id', '!=', $request->id)->where('del_flag', 1)->count();
        if ($tittleSort >= 1) {
            $out = array(
                'status' => 3,
                'msg' => 'Category Sort Order Already Exist'
            );
            echo json_encode($out);
            die();
        }
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'sort' => $request->sort,
            'status' => $request->status

        ];
        $helpcategory_id = $request->id;
        $userInfo = HelpCategory::updateOrCreate(['id' => $helpcategory_id], $data);
        $out = array(
            'status' => 1,
            'msg' => 'success'
        );
        echo json_encode($out);
    }

    public function getCategory(Request $request)
    {
        $data['helpCategory'] = HelpCategory::where('id', $request->help_category_id)
            ->limit(1)
            ->first();
        $data['status'] = 1;
        echo json_encode($data);
    }
    public function edit()
    {
        //
        return view('documentation.help_category.index');
    }

    public function deleteHelpCategory(Request $request)
    {
        $postID = $request->id;
        $ifArticleFount =  HelpArticle::where('category', $postID)->where('del_flag', 1)->count();
        if ($ifArticleFount >= 1) {
            $out = array(
                'status' => 0,
                'msg' => 'Delete Failed !! Active Article Present in This Category'
            );
            echo json_encode($out);
        } else {
            HelpCategory::where('id', $postID)->update(['del_flag' => 0]);
            $out = array(
                'status' => 1,
                'msg' => 'Deleted'
            );
            echo json_encode($out);
        }
    }
    public function update(Request $request, HelpCategory $helpCategory)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'sort' => 'required',
        ]);

        $helpCategory->update($request->all());

        return redirect()->route('documentation.help_category.index');
    }


    /* public function store(Request $request)
  {
      $request->validate([
        'title'       => 'required|max:255',
        'description' => 'required',
        'sort' => 'required',
      ]);

      $helpCategory = HelpCategory::updateOrCreate(['id' => $request->id], [
                'title' => $request->title,
                'description' => $request->description,
                'sort' => $request->sort
              ]);

      return response()->json(['code'=>200, 'message'=>'Help Category added successfully','data' => $helpCategory], 200);

  }*/
}

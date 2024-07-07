<?php

namespace App\Http\Controllers\documentation;

use App\Http\Controllers\Controller;
use App\documentation\HelpArticle;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Session;
use Auth;

class HelpArticlesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $query = DB::table('qdoc_help_article')->leftjoin('qdoc_help_category', 'qdoc_help_article.category', '=', 'qdoc_help_category.id')->select('qdoc_help_article.*', 'qdoc_help_category.title as category_title')->orderby('qdoc_help_article.id', 'desc');
            $query->where('qdoc_help_article.del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = HelpArticle::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) use ($user) {
                $options = '';
                if ($user->can('documentation edit-article')) {
                    $options .=  '<a href="helparticleedit?id=' . $row->id . '" data-type="edit" data-target="">
                                <li class="kt-nav__item">
                                 <span class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-contract"></i><span class="kt-nav__link-text" data-id="' . $row->id . '" >Edit</span>
                                </li>
                            </a>';
                }
                if ($user->can('documentation delete-article')) {
                    $options .=  '<li class="kt-nav__item">
                                <span class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-trash"></i><span class="kt-nav__link-text helparticledelete" id=' . $row->id . ' data-id=' . $row->id . '>Delete</span>
                              </li>';
                }
                return '<span style="overflow: visible; position: relative; width: 80px;">
                            <div class="dropdown">
                                <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="fa fa-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                  <ul class="kt-nav">
                                        <a href="helparticleview?id=' . $row->id . '&&cid=' . $row->category . '" data-type="edit" data-target=""><li class="kt-nav__item">
                                            <li class="kt-nav__item">
                                            <span class="kt-nav__link"><i class="kt-nav__link-icon flaticon2-document"></i><span class="kt-nav__link-text" data-id="' . $row->id . '" data-cid="' . $row->category . '">View</span>
                                            </li>
                                        </a>
                                        ' . $options . '
                                    </ul>
                                </div>
                            </div>
                        </span>';
            })->addColumn('status', function ($row) {
                if ($row->status == 'Inactive')
                    return '<span style="color: red">Inactive</span>';
                else if ($row->status == 'Active')
                    return '<span style="color: green">Active</span>';
                else
                    return '';
            })->rawColumns(['action', 'status'])->make(true);
        }

        return view('documentation.help_articles.index');
    }


    public function addArticleHelp()
    {
        $category = DB::table('qdoc_help_category')
            ->select('*')
            ->where('del_flag', 1)
            ->get();
        return view('documentation.help_articles.add', compact('category'));
    }

    public function create()
    {
        return view('documentation.help_articles.index');
    }

    public function save(Request $request)
    {
        $tittleCount = HelpArticle::where('title', $request->title)->where('id', '!=', $request->id)->where('del_flag', 1)->count();
        if ($tittleCount >= 1) {
            $out = array(
                'status' => 2,
                'msg' => 'Category Tittle Already Exist'
            );
            echo json_encode($out);
            die();
        }
        $tittleSort = HelpArticle::where('sort', $request->sort)->where('id', '!=', $request->id)->where('del_flag', 1)->count();
        if ($tittleSort >= 1) {
            $out = array(
                'status' => 3,
                'msg' => 'Category Sort Order Already Exist'
            );
            echo json_encode($out);
            die();
        }

        $data = array(
            'title' => $request->title,
            'category' => $request->category,
            'notes' => $request->notes,
            'sort' => $request->sort,
            'status' => $request->status
        );

        $helparticle_id = $request->id;
        $userInfo = HelpArticle::updateOrCreate(['id' => $helparticle_id], $data);
        $out = array(
            'status' => 1,
            'msg' => 'success'
        );
        echo json_encode($out);
    }

    public function getHelpArticle(Request $request)
    {

        $data['helpArticle'] = HelpArticle::where('id', $request->help_article_id)
            ->limit(1)
            ->first();
        $data['status'] = 1;
        echo json_encode($data);
    }

    public function deleteHelpArticle(Request $request)
    {
        $postID = $request->id;
        HelpArticle::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }

    public function helparticleedit(Request $request)
    {
        $id = $request->id;
        $categories = DB::table('qdoc_help_category')->select('*')->where('del_flag', 1)->get();
        $article = DB::table('qdoc_help_article')->select('*')->where('del_flag', 1)->where('id', $id)->get();
        // dd($article);
        return view('documentation.help_articles.edit', compact('categories', 'article'));
    }

    public function helparticleview(Request $request)
    {
        $id = isset($request->id) ? $request->id : '';
        $cid = $request->cid;
        $categories = DB::table('qdoc_help_category')->select('*')->where('del_flag', 1)->get();
        $articleQry = DB::table('qdoc_help_article')
            ->where('del_flag', 1)
            ->where('category', $cid);
        if ($id != '') {
            $articleQry = $articleQry->where('id', $id);
            $articleQry =  $articleQry->select('qdoc_help_article.id', 'qdoc_help_article.category', 'qdoc_help_article.title', 'qdoc_help_article.notes');
        } else {
            $articleQry =  $articleQry->select('qdoc_help_article.id', 'qdoc_help_article.category', 'qdoc_help_article.title')->where('status', 'Active');
        }


        $article = $articleQry->get();

        if ($id != '')
            return view('documentation.help_articles.viewSpecific', compact('categories', 'article', 'cid'));
        else
            return view('documentation.help_articles.viewAllCat', compact('categories', 'article', 'cid'));
    }
    public function autocomplete(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('qdoc_help_article')
                ->select('qdoc_help_article.title', 'qdoc_help_article.id', 'qdoc_help_article.category')
                ->where('qdoc_help_article.title', 'LIKE', "%{$query}%")->where('qdoc_help_article.del_flag', 1)
                ->where('qdoc_help_article.status', 'Active')
                ->where('qdoc_help_category.status', 'Active')
                ->leftjoin('qdoc_help_category', 'qdoc_help_article.category', 'qdoc_help_category.id')
                ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li><a href="helparticleview?id=' . $row->id . '&cid=' . $row->category . '">' . $row->title . '</a></li>';
            }

            if ($data->count() == 0)
                $output .= '&nbsp; &nbsp; No Data found';

            $output .= '</ul>';



            echo $output;
        }
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

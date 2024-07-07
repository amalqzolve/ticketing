<?php

namespace App\Http\Controllers\documentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Session;
use App\documentation\KnowledgeBasearticle;
class KnowledgeBaseArticlesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('qdoc_base_article')->leftjoin('qdoc_knowledge_base_category','qdoc_base_article.category','=','qdoc_knowledge_base_category.id')->select('qdoc_base_article.*','qdoc_knowledge_base_category.title as category_title')->orderby('qdoc_base_article.id', 'desc');
            $query->where('qdoc_base_article.del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = KnowledgeBasearticle::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }      
    	return view('documentation.knowledge_base_articles.index');
	}
    public function add(Request $request)
    {
          $category = DB::table('qdoc_knowledge_base_category')->select('*')->where('del_flag',1)->get();
        return view('documentation.knowledge_base_articles.add',compact('category'));
    }
    
    public function submit(Request $request)
    {

        $data = ['title' => $request->title, 
                'category' => $request->category, 
                'notes' => $request->notes, 
                'sort' => $request->sort,
                'status' => $request->status
        ];

        $id = $request->id;
        $userInfo = KnowledgeBasearticle::updateOrCreate(['id' => $id], $data);
        return 'true';

    }
    public function edit(Request $request)
    {
        $id = $request->id;
          $category = DB::table('qdoc_knowledge_base_category')->select('*')->where('del_flag',1)->get();
          $article = DB::table('qdoc_base_article')->select('*')->where('del_flag',1)->where('id',$id)->get();
        return view('documentation.knowledge_base_articles.edit',compact('category','article'));
    }
    public function delete(Request $request)
    {
    
       $postID = $request->id;
        KnowledgeBasearticle::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';

    }
    
    public function basearticleview(Request $request)
    {
        $id = $request->id;
       
        $cid = $request->cid;
        $basecategories = DB::table('qdoc_knowledge_base_category')->select('*')->where('del_flag',1)->get();
        $basearticle = DB::table('qdoc_base_article')->select('*')->where('del_flag',1)->where('category',$cid)->get();
        $basearticletitles = DB::table('qdoc_base_article')->select('*')->where('del_flag',1)->get();
        // dd($article);
        return view('documentation.knowledge_base_articles.view',compact('basecategories','basearticle','basearticletitles'));
    }
    public function autocomplete(Request $request)
    {
    if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('qdoc_base_article')
        ->where('title', 'LIKE', "%{$query}%")
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="basearticleview?cid='.$row->category.'">'.$row->title.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
    

}

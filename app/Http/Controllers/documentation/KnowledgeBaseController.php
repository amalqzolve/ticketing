<?php

namespace App\Http\Controllers\documentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Session;
class KnowledgeBaseController extends Controller
{
    public function index(Request $request)
    {
        $basecategories = DB::table('qdoc_knowledge_base_category')->select('*')->where('del_flag',1)->get();
    	return view('documentation.knowledge_base.index',compact('basecategories'));
    	
	}
	public function show()
	{
		return view('documentation.knowledge_base.category1');
		return view('documentation.knowledge_base.category2');
		return view('documentation.knowledge_base.category3');
	}
}

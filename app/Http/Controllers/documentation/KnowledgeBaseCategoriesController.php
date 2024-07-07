<?php

namespace App\Http\Controllers\documentation;

use App\Http\Controllers\Controller;
use App\documentation\KnowledgeBaseCategory;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Session;
class KnowledgeBaseCategoriesController extends Controller
{
   public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = KnowledgeBaseCategory::orderby('id', 'desc');
            $query->where('del_flag', 1);
            $data = $query->get();
            $count_filter = $query->count();
            $count_total = KnowledgeBaseCategory::count();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $row->id;
            })->rawColumns(['action'])->make(true);
        }
           
        return view('documentation.knowledge_base_categories.index');
    }

    public function create()
    {

        return view('documentation.knowledge_base_categories.index');
    }

    public function save(Request $request)
    {

        $data = ['title' => $request->title,
        'description' => $request->description, 
        'sort' => $request->sort,
        'status' => $request->status

        ];
        $knowledgebase_category_id = $request->id;
        
        $userInfo = KnowledgeBaseCategory::updateOrCreate(['id' => $knowledgebase_category_id], $data);
        return 'true';
    }

    public function getKnowledgeBaseCategory (Request $request)
    {
         
        $data['knowledgeBaseCategory'] = KnowledgeBaseCategory::where('id', $request->knowledge_base_category_id)
            ->limit(1)
            ->first();
        echo json_encode($data);
    }

    public function deleteKnowledgeBaseCategory(Request $request)
    {
        //
       $postID = $request->id;
        KnowledgeBaseCategory::where('id', $postID)->update(['del_flag' => 0]);
        return 'true';
    }

    public function edit()
    {
        //
         return view('documentation.knowledge_base_categories.index');
    }

    public function update(Request $request, KnowledgeBaseCategory $knowledgeBaseCategory)
    {
        //
        $request->validate([
           'title' => 'required',
            'description' => 'required',
            'sort' => 'required',
        ]);
    
        $knowledgeBaseCategory->update($request->all());
    
        return redirect()->route('documentation.knowledge_base_categories.index');
    }

    

}
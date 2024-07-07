<?php

namespace App\Http\Controllers\documentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Session;

class HelpSupportController extends Controller
{
	public function index(Request $request)
	{
		$categories = DB::table('qdoc_help_category')
			->select('*')
			->where('del_flag', 1)
			->where('status', 'Active')
			->orderBy('sort', 'asc')
			->get();
		return view('documentation.help.index', compact('categories'));
	}

	public function show()
	{
		/*$routeName = Request::route()->getName();*/
		/*	$routeName = Route::currentRouteName(); */
		/*$routeName = Route::current();

		if($routeName == help_category1)
		{
		return view('documentation.help.category1');
		}
*/
		/*return view('documentation.help.category1');
		return view('documentation.help.category2');*/
		return view('documentation.help.category3');
	}
	public function view()
	{
		/*return view('documentation.help.view.helpCategoryView1');
		return view('documentation.help.view.helpCategoryView2');
		return view('documentation.help.view.helpCategoryView3');
		return view('documentation.help.view.helpCategoryView4');
		return view('documentation.help.view.helpCategoryView5');*/
		return view('documentation.help.view.helpCategoryView6');
	}
}

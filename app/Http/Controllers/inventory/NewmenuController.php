<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\inventory\Controller;
use Illuminate\Http\Request;
use App\inventory\AttributeModel;
use App\inventory\BrandModel;
use App\inventory\ManufactureModel;
use App\inventory\productcategory;
use App\inventory\Attributeoptionsmodel;
use App\inventory\ProductdetailslistModel;
use App\inventory\ProductvariantModel;
use App\inventory\ProductUnitModel;
use App\inventory\BatchlistModel;
use DataTables;
use Spatie\Activitylog\Models\Activity;
use Session;
use DB;

class NewmenuController extends Controller
{
		public function newmenu(Request $request)
		{
		   $branch=Session::get('branch');

				
				 return view('inventory.newmenu.listing');
		}
}
?>
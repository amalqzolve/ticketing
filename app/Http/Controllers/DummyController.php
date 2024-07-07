<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DummyController extends Controller
{
  
   public function view1()
    {

        return view('dummy.view1');
    }

     public function view2()
    {

        return view('dummy.view2');
    }
     public function view3()
    {

        return view('dummy.view3');
    }
     public function view4()
    {

        return view('dummy.view4');
    }
     public function view5()
    {

        return view('dummy.view5');
    }

}

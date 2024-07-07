<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocaleController extends Controller
{
    public function setLocale($locale)
    {
        // Implement your logic to set the locale
        // For example, you can use the session to store the selected locale
        session(['locale' => $locale]);

        // Redirect back or to a specific route
        return redirect()->back();
    }
}

<?php
namespace App\Http\Controllers\crm;
use App;
use Illuminate\Http\Request;
class LocalizationController extends Controller
{
    public function index($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}

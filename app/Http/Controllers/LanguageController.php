<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    // Sets locale and saves it in the ssession
    public function change($locale)
{
    App::setLocale($locale);
    
    session(['locale' => $locale]);
    return view('tasks.create');
}

}

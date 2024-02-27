<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        return view("pages/home")->with("categories", $categories);
    }
    public function companies()
    {
        return view('pages/companies');
    }
  
}

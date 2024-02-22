<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home () {
        return view("pages/home");
    }                   
    public function companies () {
    return view('pages/companies');
    }
}

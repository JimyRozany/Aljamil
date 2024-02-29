<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Models\Company;

class GeneralController extends Controller
{

    public function products()
    {
        $products = ProductResource::collection(Product::all());
        return response()->json(["data" => $products], 200);
    }
    public function categories()
    {
        $categories = CategoryResource::collection(Category::all());
        return response()->json(["data" => $categories], 200);
    }
    public function companies()
    {
        $companies = CompanyResource::collection(Company::all());
        return response()->json(["data" => $companies], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(10);

        return view("pages/product/products")->with("products", $products);
    }


    public function create()
    {
        $companies = Company::all();
        $categories = Category::all();
        return view("pages/product/create")->with("companies", $companies)->with("categories", $categories);
    }


    public function store(StoreProductRequest $request)
    {

        $imageExtension = $request->file("image")->getClientOriginalExtension();
        $imageNewName = time() . "." . $imageExtension;
        $request->file("image")->move(public_path("products/"), $imageNewName);
        $imagePath = "products/" . $imageNewName;

        $product = Product::create([
            "company_id" => $request->input("select_company") === null ? null : $request->input("select_company"),
            "category_id" => $request->input("select_category") === null ? null : $request->input("select_category"),
            "name" => $request->input("name"),
            "price" => $request->input("price"),
            "description" => $request->input("description"),
            "image" => $imagePath,

        ]);

        toastr("Product added", "success");
        return redirect('/product');
    }

    public function edit(Product $product)
    {
        $companies = Company::all();
        $categories = Category::all();
        return view("pages/product/edit")->with("product", $product)->with("companies", $companies)->with("categories", $categories);
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->company_id = $request->input('company_id');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');

        // delete old image and upload new image
        if ($request->hasFile('image')) {


            if (File::exists($product->image)) {
                File::delete($product->image);
            }

            $imageExtension = $request->file("image")->getClientOriginalExtension();
            $imageNewName = time() . "." . $imageExtension;
            $request->file("image")->move(public_path("products/"), $imageNewName);
            $imagePath = "products/" . $imageNewName;

            $product->image = $imagePath;
        }

        $product->save();

        toastr("product updated", "success");
        return redirect('/product');
    }


    public function destroy(Product $product)
    {
        //  delete image and delete product from database
        if (File::exists($product->image)) {
            File::delete($product->image);
        }
        $product->delete();
        toastr("product deleted", 'success');

        return redirect('/product');
    }
}

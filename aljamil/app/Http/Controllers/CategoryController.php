<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{



    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            "name" => $request->input("category_name")
        ]);
        toastr()->success("category add");
        return redirect()->to('/');
    }

    public function edit(Category $category)
    {
        return view("pages/edit-category")->with("category", $category);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            "name" => $request->input("category_name")
        ]);

        toastr()->success("category updated");
        return redirect()->to("/");
    }


    public function destroy(Category $category)
    {
        $category->delete();
        toastr()->success("category deleted");
        return redirect()->to('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;

class FavoriteController extends Controller
{
    // get all favorites for user authenticated
    public function index()
    {
        $favorites = auth("api-user")->user()->favorites;
        if (count($favorites) > 0) {
            return response()->json([
                "data" => $favorites,
                "status" => "success"
            ], 200);
        } else {
            return response()->json([
                "data" => [], "status" => "success",
                "message" => "Favorites is empty"
            ]);
        }
    }
    // add to favorites
    public function store(StoreFavoriteRequest $request)
    {
        $user_favorites = auth("api-user")->user()->favorites;
        $product = Product::find($request->product_id);

        // check if product is exists in user favorites or not ?
        if (count($user_favorites->where("product_id", "=", $request->product_id)) > 0) {
            return response()->json([
                "status" => "error",
                "message" => "the product is already exists"
            ], 409);
        }


        // check if product is exists in product table or not ?
        if ($product) {
            Favorite::create([
                "user_id" => auth("api-user")->user()->id,
                "product_id" => $request->product_id,
            ]);
            return response()->json([
                "status" => "success",
                "message" => "product added successfully",
            ], 201);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "product not found",
            ], 404);
        }
    }
    // delete from favorites
    public function destroy($product_id)
    {
        $user_favorites = auth("api-user")->user()->favorites;
        $product =  $user_favorites->where("product_id", "=", $product_id)->first();
        if ($product) {
            $product->delete();
            return response()->json([
                "status" => "success",
                "message" => "product removed successfully",
            ], 200);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "product not fount",
            ], 404);
        }
    }
}

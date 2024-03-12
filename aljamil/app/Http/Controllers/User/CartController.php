<?php

namespace App\Http\Controllers\User;


use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{

    public function index()
    {

        $carts = auth("api-user")->user()->carts;
        if (count($carts) > 0) {
            return response()->json([
                "data" => $carts,
                "status" => "success"
            ]);
        } else {
            return response()->json([
                "data" => [], "status" => "success",
                "message" => "cart is empty"
            ]);
        }
    }
    // add to cart
    public function store(StoreCartRequest $request)
    {
        $user_carts = auth('api-user')->user()->carts;

        if ($user_carts->where("product_id", "=", $request->product_id)->first()) {
            return response()->json([
                "status" => "error",
                "message" => "the product is already exists in your cart"
            ], 403);
        }

        $cart = Cart::create([
            "user_id" => auth("api-user")->user()->id,
            "product_id" => $request->product_id,
            "quantity" => $request->quantity
        ]);
        return response()->json(
            ["status" => "success", "message" => "added successfully"],
            201
        );
    }

    public function update(UpdateCartRequest $request, $cart_id)
    {

        $cart = Cart::find($cart_id);
        if ($cart === null) {
            return response()->json([
                "status" => "fail",
                "message" => "cart not found",
            ], 404);
        } else {
            $cart->update([
                "quantity" => $request->quantity,
            ]);
            return response()->json([
                "data" => $cart,
                "status" => "success",
                "message" => "cart updated successfully"
            ], 201);
        }
    }


    public function destroy($cart_id)
    {

        $cart = Cart::find($cart_id);
        if ($cart === null) {
            return response()->json([
                "status" => "fail",
                "message" => "cart not found",
            ], 404);
        } else {
            $cart->delete();
            return response()->json([
                "status" => "success",
                "message" => "cart deleted successfully"
            ], 200);
        }
    }
}

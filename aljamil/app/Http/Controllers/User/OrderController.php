<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderResource;
use App\Models\OrderItem;

class OrderController extends Controller
{
  //get user order
  public function myOrders()
  {
    $orders = auth("api-user")->user()->orders;
    if (count($orders) > 0) {
      return response()->json([
        "data" => OrderResource::collection($orders),
        "status" => "success",
      ], 200);
    } else {
      return response()->json([
        "data" => [],
        "status" => "success",
        "message" => "order is not exists"
      ]);
    }
  }
  // create order 
  public function create(StoreOrderRequest $request)
  {

    $user = auth("api-user")->user();
    if (count($user->carts) > 0) {
      $order = Order::create([
        'user_id' => $user->id,
        'name' => $request->name,
        'phone_1' => $request->phone_1,
        'phone_2' => $request->phone_2,
        'address' => $request->address,
        'city' => $request->city,
        'status' => "pending",
      ]);
      if ($order) {
        $carts = $user->carts;
        foreach ($carts as $cart) {
          OrderItem::create([
            "order_id" => $order->id,
            "product_id" => $cart->product_id,
            "quantity" => $cart->quantity,
          ]);
          $cart->delete();
        }
      }

      return response()->json([
        "status" => "success",
        "message" => "order is created",
      ], 201);
    } else {
      return response()->json([
        "status" => "error",
        "message" => "your cart is empty",
      ], 400);
    }
  }

  // get order items by order id
  public function orderItems(Request $request)
  {
    $order = Order::find($request->order_id);
    $orderItems = $order->orderItems;

    return response()->json([
      "data" => OrderItemResource::collection($orderItems),
      "status" => "success",
    ], 200);
  }
}

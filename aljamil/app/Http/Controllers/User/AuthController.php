<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\MeResource;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $request->validate([
            "name" => "required",
            "phone" => "required|unique:users|digits:11",
            "password" => "required|min:8",
            "governorate" => "required",
            "city" => "required"
        ]);

        $user = User::create([
            "name" => $request->name,
            "phone" => $request->phone,
            "password" => bcrypt($request->password),
            "governorate" =>  $request->governorate,
            "city" => $request->city
        ]);
        return response()->json(["user" => $user], 201);
    }


    public function login(Request $request)
    {
        $request->validate([
            "phone" => "required|exists:users,phone",
            "password" => "required",
        ]);

        $credentials = $request->only("phone", "password");

        if (!$token = auth("api-user")->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        $user = auth("api-user")->user();
        return MeResource::make($user);
        // return response()->json(auth("api-user")->user());
    }


    public function logout()
    {
        auth("api-user")->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }




    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
        ]);
    }
}

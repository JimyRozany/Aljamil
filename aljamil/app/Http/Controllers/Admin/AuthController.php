<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view("admin/login");
    }
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|exists:admins,email",
            "password" => "required"
        ]);

        $credentials = $request->only("email", "password");
        $success = auth("admin")->attempt($credentials);

        return redirect("/");
    }

    public function logout()
    {
        // $result =  auth("admin")->logout();
          auth("admin")->logout();

        // dd($result);
        return redirect()->to('/');
    }
}

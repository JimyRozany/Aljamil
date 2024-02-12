<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

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

        return redirect("/pro");
    }

    function logout()
    {
        auth("admin")->logout();
        return redirect("/login");
    }
}

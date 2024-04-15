<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',   
            'password' => 'required|min:8'
        ]);

        return redirect('/parkiran');
    }
}

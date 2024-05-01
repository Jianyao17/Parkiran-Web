<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:255',   
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($validatedData))
        {
            $request->session()->regenerate();
            
            switch (auth()->user()->role) 
            {
                case 'Admin' :  return redirect('/parkiran'); break;
                case 'Petugas-Masuk' : return redirect('/parkiran/masuk'); break;
                case 'Petugas-Keluar' : return redirect('/parkiran/keluar'); break;
                case 'Petugas-Ruang' : return redirect('/parkiran/set-ruang'); break;
                default:
                    return back()->with('roleError', 'User Role Tidak Diketahui');
                    break;
            }
        }

        return back()->with('loginError', 'Gagal Melakukan Login');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}

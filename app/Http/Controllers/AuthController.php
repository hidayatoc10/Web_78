<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginView()
    {
        return view("auth.login");
    }

    public function loginPost(Request $request)
    {
        $validator = $request->validate([
            "username" => ["required", "min:4", "max:10"],
            "password" => ["required", "min:7", "max:100"],
        ]);

        if (Auth::attempt($validator)) {
            $request->session()->regenerate();
            if (auth()->user()->keterangan === 'Admin') {
                return redirect()->route('dashboard_admin');
            } else if (auth()->user()->keterangan === 'Guru') {
                return redirect()->route('dashboard_guru');
            } else if (auth()->user()->keterangan === 'Murid') {
                return redirect()->route('dashboard_murid');
            }
        }

        return redirect()->route('loginView')->with("gagal_login", "gagal login");
    }

    public function logoutAdmin()
    {
        Auth::logout();
        return redirect()->route("loginView")->with("berhasil_logout", "berhasil");
    }
    public function logoutGuru()
    {
        Auth::logout();
        return redirect()->route("loginView")->with("berhasil_logout", "berhasil");
    }
    public function logoutMurid()
    {
        Auth::logout();
        return redirect()->route("loginView")->with("berhasil_logout", "berhasil");
    }
}

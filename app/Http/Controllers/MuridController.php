<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MuridController extends Controller
{
    public function dashboard_murid()
    {
        return view("murid.dashboard_murid");
    }
}

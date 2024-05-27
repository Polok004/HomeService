<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Home1Controller extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
    
    public function index()
    {
        return view('home1');
    }

    public function adminHome()
    {
        $scatagories = DB::table('service_catagories')->paginate(10);
        return view('dashboard', ['scatagories' => $scatagories]);
        
    }

  

    public function addServe()
    {
        return view('addService');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function registerSave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password); // Ensure password is hashed using Bcrypt
        $user->type = 0;
        $user->save();

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        if (auth()->user()->type == 'admin') {
            return redirect()->route('ownerProfile'); // Change admin.home1 to admin.home1
        } else {
           // Auth::logout();
            return redirect()->route('user.profile');
        }
        
        
         
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
 
        return redirect('/login');
    }
    public function index(){
        $scatagories = DB::table('service_catagories')->inRandomOrder()->take(20)->get();
        $fservices = DB::table('services')
         ->where('featured', true)
        ->inRandomOrder()
        ->take(8)
        ->get();
        $fscatagories = DB::table('service_catagories')
         ->where('featured', true)
        ->inRandomOrder()
        ->take(8)
        ->get();
        $sid= DB::table('service_catagories')
        ->whereIn('slug',['ac','water'])->get()->pluck('id');
        $aservices= DB::table('services')->whereIn('service_category_id',$sid)->inRandomOrder()->take(8)->get();
        $slides=DB::table('sliders')->where('status',true)->get();
        
        return view('index', ['scatagories' => $scatagories, 'fservices' => $fservices, 'fscatagories' => $fscatagories, 'aservices' => $aservices, 'slides' => $slides]);

    }
}

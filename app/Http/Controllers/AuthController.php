<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerSave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password); 
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

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $this->createUserSession($user);
            return $user->type == 'admin' ? redirect()->route('ownerProfile') : redirect()->route('user.profile');
        }

        return back()->withErrors(['email' => trans('auth.failed')]);
    }

    public function logout(Request $request)
    {
        Session::forget('user_id'); 
        Session::forget('user_type'); 
        Session::forget('name'); 
        Session::forget('phone'); 
        Session::forget('email'); 
        return redirect('/login');
    }
    
    public function createUserSession(User $user)
    {
        Session::put('user_id', $user->id);
        Session::put('user_type', $user->type);
        Session::put('name', $user->name);
        Session::put('phone', $user->phone);
        Session::put('email', $user->email);
    }

    

    public function index(){
        
        $scatagories = DB::table('service_catagories')->inRandomOrder()->take(20)->get();

        $fservices = DB::table('services') ->where('featured', true) ->inRandomOrder()->take(8)->get();

        $fscatagories = DB::table('service_catagories')->where('featured', true)->inRandomOrder()->take(8)->get();

        $sid= DB::table('service_catagories')->pluck('id');

        $aservices= DB::table('services')->whereIn('service_category_id',$sid)->inRandomOrder()->take(8)->get();

        $slides=DB::table('sliders')->where('status',true)->get();
        
        return view('index', ['scatagories' => $scatagories, 'fservices' => $fservices, 'fscatagories' => $fscatagories, 'aservices' => $aservices, 'slides' => $slides]);

    }
}

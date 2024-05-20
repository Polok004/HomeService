<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $data = DB::table('services')
                        ->select('name')
                        ->where("name", "LIKE", "%{$request->input('query')}%")
                        ->get();
    
            if($data->isEmpty()) {
                return response()->json(['message' => 'No services found'], 404);
            }
    
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while searching for services'], 500);
        }
    }
    
    public function searchService(Request $request)
{
    $serviceSlug = Str::slug($request->q, '-');
    if ($serviceSlug) {
        // Redirect to the service details page with the generated slug
        return redirect()->route('serviceDetails', ['service_slug' => $serviceSlug]);
    } else {
        return back()->with('fail', 'No service found');
    }
}

    public function index(){
        return view('about');
    }
}


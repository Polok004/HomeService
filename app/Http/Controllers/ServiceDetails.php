<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceDetails extends Controller
{
    public function index($service_slug)
    {

        $service = DB::table('services')->join('service_catagories', 'services.service_category_id', '=', 'service_catagories.id')->select('services.*', 'service_catagories.name as category_name')->where('services.slug', $service_slug)->first();

        if (!$service) {
            abort(404); 
        }

        $r_service = DB::table('services') ->where('service_category_id', $service->service_category_id)->where('slug', '!=', $service_slug)->inRandomOrder()->first();

        $total = $service->price;
        session(['service' => $service]);
    
        return view('serviceDetails', compact('service', 'r_service', 'total'));
    }
}

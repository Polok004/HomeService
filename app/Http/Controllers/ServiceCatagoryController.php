<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\ServiceCategory;

class ServiceCatagoryController extends Controller
{
    public function Service()
    {
       
        $scatagories = DB::table('service_catagories')->get();
        return view('ServiceCatagories', ['scatagories' => $scatagories]);
    }

    public $category_slug;
    public function mount($category_slug){
        $this->category_slug = $category_slug;
    }

    public function CatagoryBy(Request $request)
    {
    $category_slug = $request->route('category_slug');
    
    $scategory = DB::table('service_catagories')->where('slug', $category_slug)->first();
    
    if ($scategory) {
        $services = DB::table('services')->where('service_category_id', $scategory->id)->get();

        return view('ServiceByCatagories', compact('scategory', 'services'));
    } else {
       
        abort(404);
    }    
}

    public function allServices()
     {

    $services = DB::table('services')->join('service_catagories', 'services.service_category_id', '=', 'service_catagories.id')
                    ->select('services.*', 'service_catagories.name as category_name') ->paginate(10); 

    return view('allServices', compact('services'));
}

}

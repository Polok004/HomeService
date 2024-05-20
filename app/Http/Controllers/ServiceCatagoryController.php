<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\ServiceCategory;

class ServiceCatagoryController extends Controller
{
    public function Service()
    {
        // Retrieve data from the service_catagories table
        $scatagories = DB::table('service_catagories')->get();

        // Pass the $scatagories variable to the view
        return view('ServiceCatagories', ['scatagories' => $scatagories]);
    }

    public $category_slug;
    public function mount($category_slug){
        $this->category_slug = $category_slug;
    }

    public function CatagoryBy(Request $request)
{
    $category_slug = $request->route('category_slug');
    
    // Retrieve the service category from the database using DB query builder
    $scategory = DB::table('service_catagories')->where('slug', $category_slug)->first();
    
    // Check if the category exists
    if ($scategory) {
        // Fetch services related to the category using another query
        $services = DB::table('services')->where('service_category_id', $scategory->id)->get();
        
        // Return the view with the fetched data
        return view('ServiceByCatagories', compact('scategory', 'services'));
    } else {
        // Handle the case when category is not found
        abort(404);
    }

    
}

    //

    public function allServices()
     {
    // Retrieve all services along with their associated categories using a join query
    $services = DB::table('services')
                    ->join('service_catagories', 'services.service_category_id', '=', 'service_catagories.id')
                    ->select('services.*', 'service_catagories.name as category_name')
                    ->paginate(10); // Adjust pagination limit as needed

    // Pass the $services variable to the view
    return view('allServices', compact('services'));
}



    
}

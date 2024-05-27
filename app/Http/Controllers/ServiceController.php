<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Add this line to import the Str class
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{

    public function addNewServe()
    {
        
        $categories = DB::table('service_catagories')->get(); 
        return view('add AllService', ['categories' => $categories]);
    }

    public function storeNewService(Request $request)
    {
         

        $validatedData = $request->validate([
        
            'category' => 'required|exists:service_catagories,id',
            'name' => 'required|string|max:255',
            'tagline' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'discount_type' => 'in:fixed,percent',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,avif', 
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,avif', 
            'description' => 'required|string',
            'inclusion' => 'required|string',
            'exclusion' => 'required|string',
            'status' => 'nullable|boolean', 
        ]);
 
        $slug = Str::slug($validatedData['name']);

        $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
        $request->image->move(public_path('images/services'), $imageName);
    
        $thumbnailPath = Carbon::now()->timestamp . '.' . $request->thumbnail->extension();
        $request->thumbnail->move(public_path('images/services/thumbnails'), $imageName);

        $data = [
            'name' => $validatedData['name'],
            'slug' => $slug,
            'tagline' => $validatedData['tagline'],
            'service_category_id' => $validatedData['category'],
            'price' => $validatedData['price'],
            'discount' => $request->input('discount'), 
            'discount_type' => $request->input('discount_type'), 
            'image' => $imageName,
            'thumbnail' => $thumbnailPath,
            'description' => $validatedData['description'],
            'inclusion' => $validatedData['inclusion'],
            'exclusion' => $validatedData['exclusion'],
            'status' => $request->has('status') ? true : false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    
       
        DB::table('services')->insert($data);
    
        return redirect()->back()->with('message', 'Service added successfully');
    }
    


    //edit

    public function editAllService($service_id)
{
    $service = DB::table('services')->where('id', $service_id)->first();
    $category = DB::table('service_catagories')->where('id', $service->service_category_id)->first();
    $categories = DB::table('service_catagories')->get(); 
    return view('editAllServices', ['service' => $service, 'category' => $category, 'categories' => $categories]);
}


public function updateService(Request $request)
{
    
    $request->validate([
        'name' => 'required|string',
        'tagline' => 'required|string',
        'category' => 'required|exists:service_catagories,id',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'discount_type' => 'nullable|string',
        'description' => 'required|string',
        'inclusion' => 'required|string',
        'exclusion' => 'required|string',
       // 'status' => 'nullable|in:active,inactive', 
    ]);

    $status = $request->has('status') ? true : false;

    $data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'tagline' => $request->tagline,
        'service_category_id' => $request->category,
        'price' => $request->price,
        'featured' => $request->featured ?? 0,
        'discount' => $request->discount,
        'discount_type' => $request->discount_type,
        'description' => $request->description,
        'inclusion' => $request->inclusion,
        'exclusion' => $request->exclusion,
        'status' => $status,

        'updated_at' => now(),
    ];

    
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/services'), $imageName);
        $data['image'] = $imageName;
    }

   
    if ($request->hasFile('thumbnail')) {
        $thumbnailName = time() . '_thumbnail.' . $request->thumbnail->extension();
        $request->thumbnail->move(public_path('images/services/thumbnails'), $thumbnailName);
        $data['thumbnail'] = $thumbnailName;
    }

 
    DB::table('services')->where('id', $request->service_id)->update($data);

 
    return redirect()->back()->with('message', 'Service updated successfully');
}


//delete

public function deleteService($service_id)
{
   
    $service = DB::table('services')->where('id', $service_id)->first();


    if ($service) {
      
        if (file_exists(public_path('images/services/thumbnails/' . $service->thumbnail))) {
            unlink(public_path('images/services/thumbnails/' . $service->thumbnail));
        }


        DB::table('services')->where('id', $service_id)->delete();

        Session::flash('message', 'Service has been deleted successfully!');
    } else {
  
        Session::flash('error', 'Service not found!');
    }


    return redirect()->back();
}

}

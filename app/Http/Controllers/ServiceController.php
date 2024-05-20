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
        // Fetch categories from the database
        $categories = DB::table('service_catagories')->get(); // Assuming 'service_categories' is your table name

        // Pass categories to the view
        return view('add AllService', ['categories' => $categories]);
    }

    public function storeNewService(Request $request)
    {
         
       

        // Validate request data
        $validatedData = $request->validate([
            // Define validation rules for each field including the category
            'category' => 'required|exists:service_catagories,id',
            'name' => 'required|string|max:255',
            // Remove the 'slug' validation rule as it will be automatically generated
            'tagline' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric', // Modified to allow null values
            'discount_type' => 'in:fixed,percent',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,avif', // Adjust the file types and size limit as needed
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,avif', // Adjust the file types and size limit as needed
            'description' => 'required|string',
            'inclusion' => 'required|string',
            'exclusion' => 'required|string',
            'status' => 'nullable|boolean', // Validate if status is boolean
        ]);
    
        // Generate slug from the service name
        $slug = Str::slug($validatedData['name']);

        $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
        $request->image->move(public_path('images/services'), $imageName);
    
        $thumbnailPath = Carbon::now()->timestamp . '.' . $request->thumbnail->extension();
        $request->thumbnail->move(public_path('images/services/thumbnails'), $imageName);

        // Retrieve data from the request
        $data = [
            'name' => $validatedData['name'],
            'slug' => $slug,
            'tagline' => $validatedData['tagline'],
            'service_category_id' => $validatedData['category'],
            'price' => $validatedData['price'],
            'discount' => $request->input('discount'), // No need to check if it exists since it's optional
            'discount_type' => $request->input('discount_type'), // No need to check if it exists since it's optional
            'image' => $imageName,
            'thumbnail' => $thumbnailPath,
            'description' => $validatedData['description'],
            'inclusion' => $validatedData['inclusion'],
            'exclusion' => $validatedData['exclusion'],
            'status' => $request->has('status') ? true : false, // Convert checkbox value to boolean
            'created_at' => now(),
            'updated_at' => now(),
        ];
    
        // Insert the new service into the database
        DB::table('services')->insert($data);
    
        // Redirect back with success message
        return redirect()->back()->with('message', 'Service added successfully');
    }
    


    //edit

    public function editAllService($service_id)
{
    $service = DB::table('services')->where('id', $service_id)->first();
    $category = DB::table('service_catagories')->where('id', $service->service_category_id)->first();
    $categories = DB::table('service_catagories')->get(); // Fetch all categories for the dropdown
    return view('editAllServices', ['service' => $service, 'category' => $category, 'categories' => $categories]);
}


public function updateService(Request $request)
{
    // Validate the incoming request data
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
       // 'status' => 'nullable|in:active,inactive', // Make status field nullable
    ]);

    $status = $request->has('status') ? true : false;


    // Prepare data for updating
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

    // Check if a new image is provided and update it
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/services'), $imageName);
        $data['image'] = $imageName;
    }

    // Check if a new thumbnail is provided and update it
    if ($request->hasFile('thumbnail')) {
        $thumbnailName = time() . '_thumbnail.' . $request->thumbnail->extension();
        $request->thumbnail->move(public_path('images/services/thumbnails'), $thumbnailName);
        $data['thumbnail'] = $thumbnailName;
    }

    // Update the service record in the database
    DB::table('services')
        ->where('id', $request->service_id)
        ->update($data);

    // Redirect back with success message
    return redirect()->back()->with('message', 'Service updated successfully');
}


//delete

public function deleteService($service_id)
{
    // Find the service by ID
    $service = DB::table('services')->where('id', $service_id)->first();

    // Check if the service exists
    if ($service) {
        // Delete the service's image from storage if it exists
        if (file_exists(public_path('images/services/thumbnails/' . $service->thumbnail))) {
            unlink(public_path('images/services/thumbnails/' . $service->thumbnail));
        }

        // Delete the service record from the database
        DB::table('services')->where('id', $service_id)->delete();

        // Flash a success message
        Session::flash('message', 'Service has been deleted successfully!');
    } else {
        // Flash an error message if service not found
        Session::flash('error', 'Service not found!');
    }

    // Redirect back to the page
    return redirect()->back();
}

}

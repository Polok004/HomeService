<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Add this line to import the Str class
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class SproviderController extends Controller
{
    public function index()
    {
        $sproviders = DB::table('service_providers')->paginate(10);

        return view('SproviderDetails', ['sproviders' => $sproviders]);
    }

    public function addNewSprovider()
{
    // Fetch all service providers from the database
    $sproviders = DB::table('service_providers')->get();
    $categories = DB::table('service_catagories')->get();

    return view('addSproviders', ['sproviders' => $sproviders, 'categories' => $categories]);
}

public function storeNewSprovider(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'category' => 'required|string|max:255', // Corrected field name
        'salary' => 'required|string|max:255',   // Corrected field name
    ]);

    // Move the uploaded image to the public/images/Sproviders directory
    $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
    $request->image->move(public_path('images/Sproviders'), $imageName);

    // Prepare data for insertion
    $data = [
        'name' => $validatedData['name'],
        'image' => $imageName,
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'],
        'location' => $validatedData['location'],
        'Service_Catagory' => $validatedData['category'], // Corrected field name
        'Salary' => $validatedData['salary'],             // Corrected field name
    ];

    // Insert data into the service_providers table
    DB::table('service_providers')->insert($data);

    // Redirect back with success message
    return redirect()->back()->with('message', 'Service provider added successfully');
}

    


public function editSprovider($id)
{
    // Fetch the service provider to be edited
    $sprovider = DB::table('service_providers')->find($id);

    // Fetch all categories for dropdown
    $categories = DB::table('service_catagories')->get();

    return view('editSproviders', compact('sprovider', 'categories'));
}

public function updateSprovider(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'salary' => 'required|string|max:255',
    ]);

    // Fetch the service provider to be updated
    $sprovider = DB::table('service_providers')->find($request->input('service_provider_id'));

    // Check if the service provider exists
    if (!$sprovider) {
        return redirect()->back()->with('error', 'Service provider not found');
    }

    // Prepare data for update
    $data = [
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'],
        'location' => $validatedData['location'],
        'Service_Catagory' => $validatedData['category'],
        'Salary' => $validatedData['salary'],
    ];

    // Check if a new image is uploaded
    if ($request->hasFile('image')) {
        // Move the uploaded image to the public/images/Sproviders directory
        $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
        $request->image->move(public_path('images/Sproviders'), $imageName);
        
        // Update the image path
        $data['image'] = $imageName;

        // Remove old image file if exists
        if ($sprovider->image) {
            unlink(public_path('images/Sproviders/' . $sprovider->image));
        }
    }

    // Update the service provider data
    DB::table('service_providers')->where('id', $sprovider->id)->update($data);

    // Redirect back with success message
    return redirect()->back()->with('message', 'Service provider updated successfully');
}


public function deleteSprovider($id)
{
    // Fetch the service provider to be deleted
    $sprovider = DB::table('service_providers')->find($id);

    // Check if the service provider exists
    if (!$sprovider) {
        return redirect()->back()->with('error', 'Service provider not found');
    }

    // Delete the service provider's image if it exists
    if ($sprovider->image) {
        unlink(public_path('images/Sproviders/' . $sprovider->image));
    }

    // Delete the service provider from the database
    DB::table('service_providers')->where('id', $id)->delete();

    // Redirect back with success message
    return redirect()->back()->with('message', 'Service provider deleted successfully');
}


public function showSprovider($id)
{
    // Fetch the service provider details from the database
    $sprovider = DB::table('service_providers')->find($id);

    // Check if the service provider exists
    if (!$sprovider) {
        // Redirect back with an error message if the service provider is not found
        return redirect()->back()->with('error', 'Service provider not found');
    }

    // Return the view with the service provider data
    return view('Sproviderprofile', compact('sprovider'));
}

}

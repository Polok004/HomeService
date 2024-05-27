<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
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
   
    $sproviders = DB::table('service_providers')->get();
    $categories = DB::table('service_catagories')->get();

    return view('addSproviders', ['sproviders' => $sproviders, 'categories' => $categories]);
}

public function storeNewSprovider(Request $request)
{
    
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'category' => 'required|string|max:255', 
        'salary' => 'required|string|max:255',   
    ]);

  
    $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
    $request->image->move(public_path('images/Sproviders'), $imageName);

    $data = [
        'name' => $validatedData['name'],
        'image' => $imageName,
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'],
        'location' => $validatedData['location'],
        'Service_Catagory' => $validatedData['category'], 
        'Salary' => $validatedData['salary'],             
    ];

    
    DB::table('service_providers')->insert($data);

    return redirect()->back()->with('message', 'Service provider added successfully');
}

    


public function editSprovider($id)
{
    $sprovider = DB::table('service_providers')->find($id);

    $categories = DB::table('service_catagories')->get();

    return view('editSproviders', compact('sprovider', 'categories'));
}

public function updateSprovider(Request $request)
{
   
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'salary' => 'required|string|max:255',
    ]);

  
    $sprovider = DB::table('service_providers')->find($request->input('service_provider_id'));

   
    if (!$sprovider) {
        return redirect()->back()->with('error', 'Service provider not found');
    }

 
    $data = [
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'],
        'location' => $validatedData['location'],
        'Service_Catagory' => $validatedData['category'],
        'Salary' => $validatedData['salary'],
    ];


    if ($request->hasFile('image')) {
        
        $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
        $request->image->move(public_path('images/Sproviders'), $imageName);

        $data['image'] = $imageName;

        if ($sprovider->image) {
            unlink(public_path('images/Sproviders/' . $sprovider->image));
        }
    }

    DB::table('service_providers')->where('id', $sprovider->id)->update($data);

    return redirect()->back()->with('message', 'Service provider updated successfully');
}


public function deleteSprovider($id)
{
    $sprovider = DB::table('service_providers')->find($id);

    if (!$sprovider) {
        return redirect()->back()->with('error', 'Service provider not found');
    }

    if ($sprovider->image) {
        unlink(public_path('images/Sproviders/' . $sprovider->image));
    }

  
    DB::table('service_providers')->where('id', $id)->delete();

    return redirect()->back()->with('message', 'Service provider deleted successfully');
}


public function showSprovider($id)
{
 
    $sprovider = DB::table('service_providers')->find($id);

    if (!$sprovider) {
       
        return redirect()->back()->with('error', 'Service provider not found');
    }

   
    return view('Sproviderprofile', compact('sprovider'));
}

}

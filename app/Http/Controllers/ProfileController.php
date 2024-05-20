<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;
class ProfileController extends Controller
{
    //
    public function index()
    {
        $bookings = DB::table('operation')
            ->where('user_id', Auth::id()) // Fetch bookings for the authenticated user only
            ->orderBy('id', 'desc') // Order by ID in descending order to get the latest bookings first
            ->paginate(10); // Paginate the results
    
        return view('profile', ['bookings' => $bookings]);
    }
    
    public function booked()
    {
        $bookings = DB::table('operation')->paginate(10);

        // Pass the $scatagories variable to the view
        return view('bookedService', ['bookings' => $bookings]);
        
    }

    public function showDetails($id)
{
    // Fetch the service provider details from the database
    $sprovider = DB::table('service_providers')->get();
    $bookings = DB::table('operation')->find($id);


    // Check if the service provider exists
    if (!$bookings) {
        // Redirect back with an error message if the service provider is not found
        return redirect()->back()->with('error', 'booking not found');
    }

    // Return the view with the service provider data
    return view('operationDetails', compact('sprovider','bookings'));
}

public function updateService(Request $request, $id)
{
    // Validate incoming request
    $request->validate([
        'category' => 'required',
    ]);

    // Fetch the service provider ID based on the selected category
    $serviceProvider = DB::table('service_providers')
                        ->where('name', $request->input('category'))
                        ->first();

    // Update the booking with the selected service provider and set featured property to true
    DB::table('operation')
        ->where('id', $id)
        ->update([
            'service_provider_id' => $serviceProvider->id,
            'featured' => 1 // Set featured property to true
        ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Service updated successfully');
}

//user profile-
public function userProfile()
{
    $bookings = DB::table('operation')
        ->where('user_id', Auth::id()) // Fetch bookings for the authenticated user only
        ->orderBy('id', 'desc') // Order by ID in descending order to get the latest bookings first
        ->get(); // Retrieve all bookings for the user
    
    // Calculate total services taken
    $totalServicesTaken = $bookings->count();
    
    // Calculate total spent
    $totalSpent = $bookings->sum('service_price');
    
    // Determine customer type based on total spent
    if ($totalSpent >= 5000) {
        $customerType = 'Diamond';
    } elseif ($totalSpent >= 4000) {
        $customerType = 'Ruby';
    } elseif ($totalSpent >= 3000) {
        $customerType = 'Platinum';
    } elseif ($totalSpent >= 2000) {
        $customerType = 'Golden';
    } else {
        $customerType = 'Silver';
    }

    return view('userprofile', [
        'bookings' => $bookings,
        'totalServicesTaken' => $totalServicesTaken,
        'customerType' => $customerType
    ]);
}

//adminprofile



public function ownerProfile()
{
 // Calculate total spent per user
 $totalSpentPerUser = DB::table('operation')
 ->select('user_id', DB::raw('SUM(service_price) as total_spent'))
 ->groupBy('user_id')
 ->pluck('total_spent', 'user_id');

// Determine customer types based on total spent
$diamondCustomers = $totalSpentPerUser->filter(function ($totalSpent) {
 return $totalSpent >= 5000;
})->count();

$rubyCustomers = $totalSpentPerUser->filter(function ($totalSpent) {
 return $totalSpent >= 4000 && $totalSpent < 5000;
})->count();

$platinumCustomers = $totalSpentPerUser->filter(function ($totalSpent) {
 return $totalSpent >= 3000 && $totalSpent < 4000;
})->count();

$goldenCustomers = $totalSpentPerUser->filter(function ($totalSpent) {
 return $totalSpent >= 2000 && $totalSpent < 3000;
})->count();

$silverCustomers = $totalSpentPerUser->filter(function ($totalSpent) {
 return $totalSpent < 2000;
})->count();

$serviceCategories = DB::table('operation')
->join('service_catagories', 'operation.service_category', '=', 'service_catagories.name')
->select('service_catagories.name', DB::raw('SUM(operation.service_price) as total_price'))
->groupBy('service_catagories.name')
->get();

    // Fetch other dashboard data
    $totalCustomers = DB::table('users')->where('type', 'user')->count();
    $totalServiceProviders = DB::table('service_providers')->count();
    $totalServiceCategories = DB::table('service_catagories')->count();
    $totalServices = DB::table('services')->count();
    $totalSalary = DB::table('service_providers')->sum('salary');
    $totalIncome = DB::table('operation')->sum('service_price');

    return view('owner', compact('serviceCategories','totalCustomers', 'diamondCustomers', 'rubyCustomers', 'platinumCustomers', 'goldenCustomers', 'silverCustomers', 'totalServiceProviders', 'totalServiceCategories', 'totalServices', 'totalSalary', 'totalIncome'));
}




}

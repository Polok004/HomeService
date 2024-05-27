<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        
        $userId = session('user_id');
        $bookings = DB::table('operation')->where('user_id', $userId) ->orderBy('id', 'desc')->paginate(10);
        return view('profile', ['bookings' => $bookings]);
    }

    public function booked()
{
    // Fetch bookings sorted by 'created_at' in descending order using Query Builder
    $bookings = DB::table('operation')
                  ->orderBy('created_at', 'desc')
                  ->paginate(10); // Adjust the pagination as needed

    return view('bookedService', ['bookings' => $bookings]);
}


    public function showDetails($id)
    {
        $sprovider = DB::table('service_providers')->get();
        $bookings = DB::table('operation')->find($id);

        if (!$bookings) {
            return redirect()->back()->with('error', 'Booking not found');
        }

        return view('operationDetails', compact('sprovider', 'bookings'));
    }

    public function updateService(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $serviceProvider = DB::table('service_providers')
            ->where('name', $request->input('category'))
            ->first();

        DB::table('operation')
            ->where('id', $id)
            ->update([
                'service_provider_id' => $serviceProvider->id,
                'featured' => 1
            ]);

        return redirect()->back()->with('success', 'Service updated successfully');
    }

    public function userProfile()
    {
        $userId = session('user_id');

        $bookings = DB::table('operation')->where('user_id', $userId)->orderBy('id', 'desc')->get();

        $totalServicesTaken = $bookings->count();

        $totalSpent = $bookings->sum('service_price');

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

    public function ownerProfile()
    {
        $totalSpentPerUser = DB::table('operation')->select('user_id', DB::raw('SUM(service_price) as total_spent'))
            ->groupBy('user_id')->pluck('total_spent', 'user_id');

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

        $serviceCategories = DB::table('operation')->join('service_catagories', 'operation.service_category', '=', 'service_catagories.name')
            ->select('service_catagories.name', DB::raw('SUM(operation.service_price) as total_price'))->groupBy('service_catagories.name')->get();

        $totalCustomers = DB::table('users')->where('type', 'user')->count();
        $totalServiceProviders = DB::table('service_providers')->count();
        $totalServiceCategories = DB::table('service_catagories')->count();
        $totalServices = DB::table('services')->count();
        $totalSalary = DB::table('service_providers')->sum('salary');
        $totalIncome = DB::table('operation')->sum('service_price');

        return view('owner', compact('serviceCategories', 'totalCustomers', 'diamondCustomers', 'rubyCustomers', 'platinumCustomers', 'goldenCustomers', 'silverCustomers', 'totalServiceProviders', 'totalServiceCategories', 'totalServices', 'totalSalary', 'totalIncome'));
    }
}

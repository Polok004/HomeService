<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Service;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class BookingController extends Controller
{
    public function showServiceDetails($service_slug)
    {
        $service = DB::table('services')
        ->join('service_catagories', 'services.service_category_id', '=', 'service_catagories.id')
        ->select('services.*', 'service_catagories.name as category_name')
        ->where('services.slug', $service_slug)
        ->first();

    // Check if service exists
    if (!$service) {
        abort(404); // or return a custom error view
    }

    // Fetch a related service (assuming you have a similar structure)
    $r_service = DB::table('services')
        ->where('service_category_id', $service->service_category_id)
        ->where('slug', '!=', $service_slug)
        ->inRandomOrder()
        ->first();

    // Initialize total with the service price
    $total = $service->price;
    session(['service' => $service]);

    return view('serviceDetails', compact('service', 'r_service', 'total'));
    }

    public function createPaymentIntent(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    
        $service = Service::find($request->service_id);
    
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        $total = $service->price;
    if ($service->discount) {
        if ($service->discount_type == 'fixed') {
            $total -= $service->discount;
        } elseif ($service->discount_type == 'percent') {
            $total -= ($total * $service->discount / 100);
        }
    }
    
        try {
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $total * 100, // Amount in cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
            ]);
    
            return response()->json(['client_secret' => $intent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function saveBooking(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
        ]);
    
        $user_id = session()->get('user_id');
        $customer_name = session()->get('name');
        $customer_phone = session()->get('phone');

        $location = $request->input('location');
        $date = $request->input('date');
        $time = $request->input('time');
        $service = $request->session()->get('service');
    
        if (!$service || !$service->status) {
            return redirect()->route('inactive')->with('failed', 'Service is unavailable');
        }

        // Calculate the total after discount
    $total = $service->price;
    if ($service->discount) {
        if ($service->discount_type == 'fixed') {
            $total -= $service->discount;
        } elseif ($service->discount_type == 'percent') {
            $total -= ($total * $service->discount / 100);
        }
    }
    
        DB::table('operation')->insert([
            'user_id' => $user_id,
            'customer_name' => $customer_name,
            'customer_phone' => $customer_phone,
            'customer_location' => $location,
            'customer_date' => $date,
            'customer_time' => $time,
            'service_id' => $service->id,
            'service_name' => $service->name,
            'service_price' => $total,
            'service_category' => $service->category_name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('confirmation')->with('success', 'Booking saved successfully!');
    }



    public function cancelBooking($id)
    {
        // Find the booking by id
        $booking = DB::table('operation')->where('id', $id)->first();
        
        if ($booking) {
            // Check if the booking is pending (not provided by a service provider)
            if (!$booking->service_provider_id) {
                // Perform cancellation logic here
                DB::table('operation')->where('id', $id)->delete();
                
                // Redirect or return a response as needed
                return redirect()->back()->with('success', 'Booking canceled successfully.');
            } else {
                // If the booking is already provided by a service provider, it cannot be canceled
                return redirect()->back()->with('error', 'This booking cannot be canceled as it has already been provided by a service provider.');
            }
        } else {
            // If the booking with the given id does not exist, redirect with an error message
            return redirect()->back()->with('error', 'Booking not found.');
        }
    }
    
   
}

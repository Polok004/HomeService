<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    public function index()
    {
        $slides = DB::table('sliders')->paginate(10);

        return view('admin_slider', ['slides' => $slides]);
    }

    public function addNewSlider()
    {
        $sliders = DB::table('sliders')->get();
        return view('addSlider', ['sliders' => $sliders]);
    }

    public function storeNewSlider(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean', // Nullable since it's not required
        ]);

        $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
        $request->image->move(public_path('images/Sliders'), $imageName);

        $status = $request->input('status', false); // Default status to false if not provided

        $data = [
            'title' => $validatedData['title'],
            'image' => $imageName,
            'status' => $status,
        ];

        DB::table('sliders')->insert($data);

        return redirect()->back()->with('message', 'Slider added successfully');
    }




    public function editSlider($id)
    {
        $slider = DB::table('sliders')->find($id);
        return view('editSlide', compact('slider'));
    }

    public function updateSlider(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validatedData['title'],
            'status' => $request->input('status', false),
        ];

        if ($request->hasFile('image')) {
            $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
            $request->image->move(public_path('images/Sliders'), $imageName);
            $data['image'] = $imageName;
        }

        DB::table('sliders')->where('id', $request->input('slider_id'))->update($data);

        return redirect()->back()->with('message', 'Slider updated successfully');
    }



    public function deleteSlider($id)
    {
        // Find the slider by ID
        $slider = DB::table('sliders')->where('id', $id)->first();
    
        // Check if the slider exists
        if ($slider) {
            // Delete the slider's image from storage
            if (file_exists(public_path('images/Sliders/' . $slider->image))) {
                unlink(public_path('images/Sliders/' . $slider->image));
            }
    
            // Delete the slider record from the database
            DB::table('sliders')->where('id', $id)->delete();
    
            // Flash a success message
            Session::flash('message', 'Slider has been deleted successfully!');
        } else {
            // Flash an error message if slider not found
            Session::flash('error', 'Slider not found!');
        }
    
        // Redirect back to the page
        return redirect()->back();
    }
    
}

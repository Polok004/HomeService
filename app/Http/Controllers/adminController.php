<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function generateSlug($name)
    {
        return Str::slug($name, '-');
    }

    public function newCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:jpeg,png'
        ]);

        $slug = $this->generateSlug($request->name);

        $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
        $request->image->move(public_path('images/categories'), $imageName);

        DB::table('service_catagories')->insert([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imageName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Session::flash('message', 'Category has been created successfully!');
        
        return redirect()->back(); // Stay on the same page
    }

    public function editCategory($category_id)
    {
        $category = DB::table('service_catagories')->where('id', $category_id)->first();
        return view('editService', ['category' => $category]);
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'image' => 'nullable|mimes:jpeg,png' // Update validation rule for image
        ]);

        // Generate slug from the name
        $slug = $this->generateSlug($request->name);

        // Update the category record in the database
        DB::table('service_catagories')
            ->where('id', $request->category_id)
            ->update([
                'name' => $request->name,
                'slug' => $slug, // Update the slug
                'featured' => $request->featured ?? 0,
                'updated_at' => Carbon::now(),
            ]);

        // Check if a new image is provided and update it
        if ($request->hasFile('image')) {
            $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);

            DB::table('service_catagories')
                ->where('id', $request->category_id)
                ->update([
                    'image' => $imageName,
                ]);
        }

        Session::flash('message', 'Category has been updated successfully!');
        return redirect()->back();
    }

//delete
public function deleteCategory($category_id)
{
    // Find the category by ID
    $category = DB::table('service_catagories')->where('id', $category_id)->first();

    // Check if the category exists
    if ($category) {
        // Delete the category's image from storage
        if (file_exists(public_path('images/categories/' . $category->image))) {
            unlink(public_path('images/categories/' . $category->image));
        }

        // Delete the category record from the database
        DB::table('service_catagories')->where('id', $category_id)->delete();

        // Flash a success message
        Session::flash('message', 'Category has been deleted successfully!');
    } else {
        // Flash an error message if category not found
        Session::flash('error', 'Category not found!');
    }

    // Redirect back to the page
    return redirect()->back();
}

}

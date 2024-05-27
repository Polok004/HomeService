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
        
        return redirect()->back(); 
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
            'image' => 'nullable|mimes:jpeg,png' 
        ]);

       
        $slug = $this->generateSlug($request->name);

       
        DB::table('service_catagories')
            ->where('id', $request->category_id)
            ->update([
                'name' => $request->name,
                'slug' => $slug, 
                'featured' => $request->featured ?? 0,
                'updated_at' => Carbon::now(),
            ]);

       
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
   
    $category = DB::table('service_catagories')->where('id', $category_id)->first();

   
    if ($category) {
        
        if (file_exists(public_path('images/categories/' . $category->image))) {
            unlink(public_path('images/categories/' . $category->image));
        }

       
        DB::table('service_catagories')->where('id', $category_id)->delete();

 
        Session::flash('message', 'Category has been deleted successfully!');
    } else {
        
        Session::flash('error', 'Category not found!');
    }

    return redirect()->back();
}

}

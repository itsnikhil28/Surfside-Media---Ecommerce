<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class admincategorycontroller extends Controller
{
    public function addcategory()
    {
        return view('admin.add-category');
    }

    public function categorystore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('categories', $imagename, ['disk' => 's3', 'visibility' => 'public']);
        } else {
            return back()->with('error', 'Image upload failed. Please try again.');
        }

        $slug = Str::slug($request->name);

        category::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imagename,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    public function editcategory($id)
    {
        $category = category::findorfail($id);
        return view('admin.edit-category', compact('category'));
    }

    public function updatecategory(Request $request)
    {
        $category = category::findOrFail($request->id);

        $request->validate([
            'name' => 'required|unique:brands,name,' . $category->id,
            'slug' => 'required|unique:brands,slug,' . $category->id,
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('s3')->delete('categories/' . $category->image);
            }

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('categories', $imagename, ['disk' => 's3', 'visibility' => 'public']);

            $category->image = $imagename;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category Updated successfully.');
    }

    public function categorydelete($id)
    {
        $category = category::findorfail($id);

        if ($category->image && Storage::disk('s3')->exists('categories/' . $category->image)) {
            Storage::disk('s3')->delete('categories/' . $category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category Deleted successfully.');
    }
}

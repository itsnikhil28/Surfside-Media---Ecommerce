<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class adminbrandcontroller extends Controller
{

    public function addbrand()
    {
        return view('admin.add-brand');
    }

    public function brandstore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('brands', $imagename, ['disk' => 's3', 'visibility' => 'public']);
        } else {
            return back()->with('error', 'Image upload failed. Please try again.');
        }

        $slug = Str::slug($request->name);

        brand::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imagename,
        ]);

        return redirect()->route('admin.brands')->with('success', 'Brand created successfully.');
    }

    public function editbrand($id)
    {
        $brand = brand::findorfail($id);
        return view('admin.edit-brand', compact('brand'));
    }

    public function updatebrand(Request $request)
    {
        $brand = brand::findOrFail($request->id);

        $request->validate([
            'name' => 'required|unique:brands,name,' . $brand->id,
            'slug' => 'required|unique:brands,slug,' . $brand->id,
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($brand->image) {
                Storage::disk('s3')->delete('brands/' . $brand->image);
            }

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('brands', $imagename, ['disk' => 's3', 'visibility' => 'public']);

            $brand->image = $imagename;
        }
        $brand->save();
        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully.');
    }

    public function branddelete($id)
    {
        $brand = brand::findorfail($id);

        if ($brand->image && Storage::disk('s3')->exists('brands/' . $brand->image)) {
            Storage::disk('s3')->delete('brands/' . $brand->image);
        }

        $brand->delete();

        return redirect()->route('admin.brands')->with('success', 'Brand Deleted successfully.');
    }
}

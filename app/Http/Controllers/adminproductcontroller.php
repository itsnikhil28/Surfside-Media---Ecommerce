<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\category;
use App\Models\product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class adminproductcontroller extends Controller
{
    public function addproduct()
    {
        $categories = category::all();
        $brands = brand::all();
        return view('admin.add-product', compact('categories', 'brands'));
    }

    public function productstore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'images.*' => 'mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imagename, ['disk' => 's3', 'visibility' => 'public']);
        }

        $imageNames = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $id => $image) {
                $imageName = $id . '.' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $imageName, ['disk' => 's3', 'visibility' => 'public']);
                $imageNames[] = $imageName;
            }
        }

        product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => (int)$request->regular_price,
            'sale_price' => (int) $request->sale_price,
            'SKU' => $request->SKU,
            'stock_status' => $request->stock_status,
            'featured' => $request->featured,
            'quantity' => (int) $request->quantity,
            'image' => $imagename,
            'images' => implode(',', array_filter($imageNames)),
        ]);

        return redirect()->route('admin.products')->with('success', 'Product Added Successfully');
    }

    public function editproduct($id)
    {
        $product = product::findorfail($id);
        $categories = category::all();
        $brands = brand::all();
        $images = !empty($product->images) ? explode(',', ltrim($product->images, ',')) : [];
        return view('admin.edit-product', compact('product', 'categories', 'brands', 'images'));
    }

    public function updateproduct(Request $request)
    {
        $product = product::findorfail($request->id);

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id,
            'category_id' => 'required',
            'brand_id' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
            'images.*' => 'mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = (int) $request->regular_price;
        $product->sale_price = (int) $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = (int) $request->quantity;
        // $product->image = $request->image;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('s3')->delete('products/' . $product->image);
            }

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imagename, ['disk' => 's3', 'visibility' => 'public']);

            $product->image = $imagename;
        }

        $existingImages = explode(',', $product->images);
        $newImageNames = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $id => $image) {
                $imageName = $id . '.' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $imageName, ['disk' => 's3', 'visibility' => 'public']);
                $newImageNames[] = $imageName;
            }
        }

        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $removeImage) {
                if (in_array($removeImage, $existingImages)) {
                    Storage::disk('s3')->delete('products/' . $removeImage);
                    $existingImages = array_diff($existingImages, [$removeImage]);
                }
            }
        }

        $allImages = array_merge($existingImages, $newImageNames);
        $product->images = implode(',', array_filter($allImages));
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product Updated Successfully');
    }

    public function productdelete($id)
    {
        $product = product::findorfail($id);

        if ($product->images) {
            $images = explode(',', $product->images);
            foreach ($images as $image) {
                Storage::disk('s3')->delete('products/' . $image);
            }
        }

        if ($product->image && Storage::disk('s3')->exists('products/' . $product->image)) {
            Storage::disk('s3')->delete('products/' . $product->image);
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product Deleted successfully.');
    }
}

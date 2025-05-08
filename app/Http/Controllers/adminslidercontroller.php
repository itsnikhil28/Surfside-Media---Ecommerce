<?php

namespace App\Http\Controllers;

use App\Models\slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class adminslidercontroller extends Controller
{
    public function addslider()
    {
        return view('admin.add-slide');
    }

    public function sliderstore(Request $request)
    {
        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required|url',
            'status' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('slider', $imagename, ['disk' => 's3', 'visibility' => 'public']);
        }

        slider::create([
            'tagline' => $request->tagline,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'link' => $request->link,
            'status' => $request->status,
            'image' => $imagename,
        ]);

        return redirect()->route('admin.sliders')->with('success', 'Slider Added Successfully');
    }

    public function editslider($id)
    {
        $slider = slider::findorfail($id);
        return view('admin.edit-slide', compact('slider'));
    }

    public function updateslider(Request $request)
    {
        $slider = slider::findorfail($request->id);

        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required|url',
            'status' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $slider->tagline = $request->tagline;
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->link = $request->link;
        $slider->status = $request->status;

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('s3')->delete('slider/' . $slider->image);
            }

            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('slider', $imagename, ['disk' => 's3', 'visibility' => 'public']);

            $slider->image = $imagename;
        }

        $slider->save();

        return redirect()->route('admin.sliders')->with('success', 'Slider Updated Successfully');
    }

    public function sliderdelete($id)
    {
        $slider = slider::findorfail($id);

        if ($slider->image && Storage::disk('s3')->exists('slider/' . $slider->image)) {
            Storage::disk('s3')->delete('slider/' . $slider->image);
        }
        $slider->delete();

        return redirect()->route('admin.sliders')->with('success', 'Slider Deleted successfully.');
    }
}

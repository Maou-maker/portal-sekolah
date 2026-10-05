<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'caption' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = 'https://picsum.photos/1200/500?random=' . rand(10, 99);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $file->storeAs('slider_images', $filename, 'public');
            $imagePath = 'slider_images/' . $filename;
        }

        Slider::create([
            'title' => $request->input('title'),
            'caption' => $request->input('caption'),
            'image' => $imagePath,
            'is_active' => true,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'sliders'])->with('success', 'Banner slider berhasil ditambahkan!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|max:255',
            'caption' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->input('title'),
            'caption' => $request->input('caption'),
        ];

        if ($request->hasFile('image')) {
            if ($slider->image && !str_starts_with($slider->image, 'http')) {
                Storage::disk('public')->delete($slider->image);
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $file->storeAs('slider_images', $filename, 'public');
            $data['image'] = 'slider_images/' . $filename;
        }

        $slider->update($data);

        return redirect()->route('admin.dashboard', ['tab' => 'sliders'])->with('success', 'Banner slider berhasil diperbarui!');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image && !str_starts_with($slider->image, 'http')) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'sliders'])->with('success', 'Banner slider berhasil dihapus!');
    }
}
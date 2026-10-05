<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = 'https://picsum.photos/400/300?random=' . rand(10, 99);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $file->storeAs('gallery_images', $filename, 'public');
            $imagePath = 'gallery_images/' . $filename;
        }

        Gallery::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'galleries'])
            ->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
        ];

        if ($request->hasFile('image')) {
            if ($gallery->image && !str_starts_with($gallery->image, 'http')) {
                Storage::disk('public')->delete($gallery->image);
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $file->storeAs('gallery_images', $filename, 'public');
            $data['image'] = 'gallery_images/' . $filename;
        }

        $gallery->update($data);

        return redirect()->route('admin.dashboard', ['tab' => 'galleries'])
            ->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && !str_starts_with($gallery->image, 'http')) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'galleries'])
            ->with('success', 'Foto galeri berhasil dihapus!');
    }
}
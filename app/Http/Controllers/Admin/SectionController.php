<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'position' => 'required|in:left,right',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = 'https://picsum.photos/600/400?random=' . rand(10, 99);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $file->storeAs('section_images', $filename, 'public');
            $imagePath = 'section_images/' . $filename;
        }

        Section::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'position' => $request->input('position'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'sections'])
            ->with('success', 'Section landing berhasil ditambahkan!');
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'position' => 'required|in:left,right',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'position' => $request->input('position'),
        ];

        if ($request->hasFile('image')) {
            if ($section->image && !str_starts_with($section->image, 'http')) {
                Storage::disk('public')->delete($section->image);
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $file->storeAs('section_images', $filename, 'public');
            $data['image'] = 'section_images/' . $filename;
        }

        $section->update($data);

        return redirect()->route('admin.dashboard', ['tab' => 'sections'])
            ->with('success', 'Section landing berhasil diperbarui!');
    }

    public function destroy(Section $section)
    {
        if ($section->image && !str_starts_with($section->image, 'http')) {
            Storage::disk('public')->delete($section->image);
        }
        $section->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'sections'])
            ->with('success', 'Section landing berhasil dihapus!');
    }
}
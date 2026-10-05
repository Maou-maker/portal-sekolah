<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socials = SocialMedia::latest()->paginate(10);
        return view('admin.socials.index', compact('socials'));
    }

    public function create()
    {
        return view('admin.socials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'platform' => 'required|in:YouTube,TikTok,Instagram',
            'url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $file->storeAs('social_thumbnails', $filename, 'public');
            $imagePath = 'social_thumbnails/' . $filename;
        }

        SocialMedia::create([
            'title' => $request->input('title'),
            'platform' => $request->input('platform'),
            'url' => $request->input('url'),
            'image' => $imagePath,
            'is_highlight' => $request->has('is_highlight') ? true : false,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'socials'])->with('success', 'Tautan media sosial berhasil ditambahkan!');
    }

    public function edit(SocialMedia $social)
    {
        return view('admin.socials.edit', compact('social'));
    }

    public function update(Request $request, SocialMedia $social)
    {
        $request->validate([
            'title' => 'required|max:255',
            'platform' => 'required|in:YouTube,TikTok,Instagram',
            'url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->input('title'),
            'platform' => $request->input('platform'),
            'url' => $request->input('url'),
            'is_highlight' => $request->has('is_highlight') ? true : false,
        ];

        if ($request->hasFile('image')) {
            if ($social->image && !str_starts_with($social->image, 'http')) {
                Storage::disk('public')->delete($social->image);
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $file->storeAs('social_thumbnails', $filename, 'public');
            $data['image'] = 'social_thumbnails/' . $filename;
        }

        $social->update($data);

        return redirect()->route('admin.dashboard', ['tab' => 'socials'])->with('success', 'Tautan media sosial berhasil diperbarui!');
    }

    public function destroy(SocialMedia $social)
    {
        if ($social->image && !str_starts_with($social->image, 'http')) {
            Storage::disk('public')->delete($social->image);
        }
        $social->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'socials'])->with('success', 'Tautan media sosial berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $title = $request->input('title');
        $content = $request->input('content');

        // Default pakai gambar dummy jika tidak upload
        $imagePath = 'https://picsum.photos/600/400?random=' . rand(10, 99);

        // Jika admin benar-benar mengupload file gambar
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            // Simpan ke storage/app/public/news_images
            $file->storeAs('news_images', $filename, 'public');
            // Cukup simpan path relatifnya saja ke database!
            $imagePath = 'news_images/' . $filename;
        }

        News::create([
            'title' => $title,
            'slug' => Str::slug($title) . '-' . uniqid(),
            'content' => $content,
            'image' => $imagePath,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'news'])->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $title = $request->input('title');
        $content = $request->input('content');

        $data = [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . uniqid(),
            'content' => $content,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan bukan link dummy eksternal
            if ($news->image && !str_starts_with($news->image, 'http')) {
                Storage::disk('public')->delete($news->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($file->getClientOriginalName());
            $file->storeAs('news_images', $filename, 'public');
            $data['image'] = 'news_images/' . $filename;
        }

        $news->update($data);

        return redirect()->route('admin.dashboard', ['tab' => 'news'])->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        if ($news->image && !str_starts_with($news->image, 'http')) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'news'])->with('success', 'Berita berhasil dihapus!');
    }
}
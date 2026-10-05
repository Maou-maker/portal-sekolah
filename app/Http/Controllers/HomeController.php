<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Section;
use App\Models\SocialMedia;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $news = News::latest()->get();
        $galleries = Gallery::latest()->get();
        $sections = Section::all();
        $socials = SocialMedia::all();
        $highlights = SocialMedia::all();

        return view('welcome', compact('sliders', 'news', 'galleries', 'sections', 'socials', 'highlights'));
    }

    public function berita()
    {
        $news = News::latest()->get();
        return view('berita', compact('news'));
    }

    public function galeri()
    {
        $galleries = Gallery::latest()->get();
        $highlightSection = Section::first();
        return view('galeri', compact('galleries', 'highlightSection'));
    }

    public function mediaSosial()
    {
        $socials = SocialMedia::all();
        $highlights = SocialMedia::all();
        return view('social-media', compact('socials', 'highlights'));
    }
}
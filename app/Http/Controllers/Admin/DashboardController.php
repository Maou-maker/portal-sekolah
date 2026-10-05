<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\Section;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalNews = News::count();
        $totalGalleries = Gallery::count();
        $totalSliders = Slider::count();
        $totalSocials = SocialMedia::count();
        $totalSections = Section::count();

        $latestNews = News::latest()->take(3)->get();
        $latestGalleries = Gallery::latest()->take(4)->get();
        $latestSliders = Slider::latest()->take(3)->get();
        $latestSocials = SocialMedia::latest()->take(4)->get();

        $activeTab = $request->get('tab', 'preview');

        $newsList = News::latest()->paginate(5);
        $galleryList = Gallery::latest()->paginate(8);
        $sliderList = Slider::latest()->paginate(5);
        $socialList = SocialMedia::latest()->paginate(5);
        $sectionList = Section::all(); // <-- INI YANG BIKIN KELOLA SECTION KOSONG

        return view('admin.dashboard', compact(
            'totalNews',
            'totalGalleries',
            'totalSliders',
            'totalSocials',
            'totalSections',
            'latestNews',
            'latestGalleries',
            'latestSliders',
            'latestSocials',
            'activeTab',
            'newsList',
            'galleryList',
            'sliderList',
            'socialList',
            'sectionList'
        ));
    }
}
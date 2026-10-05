<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileTeacher;
use App\Models\ProfileVision;
use App\Models\ProfileProgram;
use App\Models\ProfileEvent;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // === GURU ===
    public function storeTeacher(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'nip' => 'nullable|unique:profile_teachers,nip', // <-- Tambahkan unique di sini
            'position' => 'required',
            'gender' => 'required|in:L,P',
            'address' => 'nullable',
            'photo' => 'nullable|image|max:2048',
            'role' => 'required|in:teacher,headmaster,foundation_head'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        ProfileTeacher::create($data);
        return back()->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function updateTeacher(Request $request, $id)
    {
        $teacher = ProfileTeacher::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'nip' => 'nullable|unique:profile_teachers,nip,' . $id, // <-- Unique dengan mengabaikan ID guru yang sedang diedit
            'position' => 'required',
            'gender' => 'required|in:L,P',
            'address' => 'nullable',
            'photo' => 'nullable|image|max:2048',
            'role' => 'required|in:teacher,headmaster,foundation_head'
        ]);

        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $teacher->update($data);
        return back()->with('success', 'Data guru berhasil diupdate.');
    }

    public function destroyTeacher($id)
    {
        $teacher = ProfileTeacher::findOrFail($id);
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }
        $teacher->delete();
        return back()->with('success', 'Data guru berhasil dihapus.');
    }

    // === VISI MISI ===
    public function storeVision(Request $request)
    {
        $data = $request->validate(['type' => 'required|in:vision,mission', 'content' => 'required']);
        ProfileVision::create($data);
        return back()->with('success', 'Visi/Misi berhasil ditambahkan.');
    }

    public function updateVision(Request $request, $id)
    {
        $vision = ProfileVision::findOrFail($id);
        $data = $request->validate(['type' => 'required|in:vision,mission', 'content' => 'required']);
        $vision->update($data);
        return back()->with('success', 'Visi/Misi berhasil diupdate.');
    }

    public function destroyVision($id)
    {
        ProfileVision::findOrFail($id)->delete();
        return back()->with('success', 'Visi/Misi berhasil dihapus.');
    }

    // === PROGRAM ===
    public function storeProgram(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('programs', 'public');
        }

        ProfileProgram::create($data);
        return back()->with('success', 'Program berhasil ditambahkan.');
    }

    public function updateProgram(Request $request, $id)
    {
        $prog = ProfileProgram::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048' // <-- Diubah dari icon ke image
        ]);

        if ($request->hasFile('image')) {
            if ($prog->image) {
                Storage::disk('public')->delete($prog->image);
            }
            $data['image'] = $request->file('image')->store('programs', 'public');
        }

        $prog->update($data);
        return back()->with('success', 'Program berhasil diupdate.');
    }

    public function destroyProgram($id)
    {
        ProfileProgram::findOrFail($id)->delete();
        return back()->with('success', 'Program berhasil dihapus.');
    }

    // === EVENT TAHUNAN ===
    public function storeEvent(Request $request)
    {
        $data = $request->validate(['title' => 'required', 'description' => 'required', 'image' => 'nullable|image|max:2048']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        ProfileEvent::create($data);
        return back()->with('success', 'Event berhasil ditambahkan.');
    }

    public function updateEvent(Request $request, $id)
    {
        $event = ProfileEvent::findOrFail($id);
        $data = $request->validate(['title' => 'required', 'description' => 'required', 'image' => 'nullable|image|max:2048']);
        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        $event->update($data);
        return back()->with('success', 'Event berhasil diupdate.');
    }

    public function destroyEvent($id)
    {
        $event = ProfileEvent::findOrFail($id);
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();
        return back()->with('success', 'Event berhasil dihapus.');
    }

    // === HALAMAN PUBLIK PROFIL ===
    public function publicIndex()
    {
        $visions = ProfileVision::where('type', 'vision')->get();
        $missions = ProfileVision::where('type', 'mission')->get();
        $programs = ProfileProgram::all();
        $events = ProfileEvent::latest()->get();
        $pimpinans = ProfileTeacher::whereIn('role', ['headmaster', 'foundation_head'])->get();

        // Ambil section pertama untuk bagian kotak biru profil (supaya sinkron dinamis)
        $firstSection = \App\Models\Section::first();

        return view('profil', compact('visions', 'missions', 'programs', 'events', 'pimpinans', 'firstSection'));
    }

    // === HALAMAN PUBLIK DIREKTORI GURU ===
    public function publicTeachers(Request $request)
    {
        $query = ProfileTeacher::query();

        // Fitur Pencarian (Nama atau NIP)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        // Filter Jenis Kelamin (L / P)
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // Filter Role / Jabatan (teacher, headmaster, foundation_head)
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        $teachers = $query->latest()->get();

        return view('profil-guru', compact('teachers'));
    }
}
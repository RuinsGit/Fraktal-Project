<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryTitle;
use Illuminate\Http\Request;

class GalleryTitleController extends Controller
{
    public function index()
    {
        $galleryTitles = GalleryTitle::all();
        return view('back.gallery-title.index', compact('galleryTitles'));
    }

    public function create()
    {
        return view('back.gallery-title.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
        ]);

        GalleryTitle::create([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'status' => $request->status ?? 1
        ]);

        return redirect()
            ->route('admin.gallery-title.index')
            ->with('success', 'Məlumat uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $galleryTitle = GalleryTitle::findOrFail($id);
        return view('back.gallery-title.edit', compact('galleryTitle'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
        ]);

        $galleryTitle = GalleryTitle::findOrFail($id);
        
        $galleryTitle->update([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'status' => $request->status ?? $galleryTitle->status
        ]);

        return redirect()
            ->route('admin.gallery-title.index')
            ->with('success', 'Məlumat uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $galleryTitle = GalleryTitle::findOrFail($id);
        $galleryTitle->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Məlumat uğurla silindi'
        ]);
    }

    public function status($id)
    {
        $galleryTitle = GalleryTitle::findOrFail($id);
        $galleryTitle->status = !$galleryTitle->status;
        $galleryTitle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
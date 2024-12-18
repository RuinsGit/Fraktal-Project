<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryVideoController extends Controller
{
    public function index()
    {
        $galleryVideos = GalleryVideo::all();
        return view('back.gallery-video.index', compact('galleryVideos'));
    }

    public function create()
    {
        return view('back.gallery-video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'video' => 'required|file|mimetypes:video/mp4,video/quicktime|max:20480',
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $video = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery-videos'), $video);
        }

        GalleryVideo::create([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'video' => $video ?? null,
            'status' => $request->status ?? 1
        ]);

        return redirect()
            ->route('admin.gallery-video.index')
            ->with('success', 'Video uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $galleryVideo = GalleryVideo::findOrFail($id);
        return view('back.gallery-video.edit', compact('galleryVideo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'video' => 'nullable|file|mimetypes:video/mp4,video/quicktime|max:20480',
        ]);

        $galleryVideo = GalleryVideo::findOrFail($id);

        if ($request->hasFile('video')) {
            // Köhnə videonu sil
            if ($galleryVideo->video && File::exists(public_path('uploads/gallery-videos/' . $galleryVideo->video))) {
                File::delete(public_path('uploads/gallery-videos/' . $galleryVideo->video));
            }

            $file = $request->file('video');
            $video = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery-videos'), $video);
        }

        $galleryVideo->update([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'video' => $video ?? $galleryVideo->video,
            'status' => $request->status ?? $galleryVideo->status
        ]);

        return redirect()
            ->route('admin.gallery-video.index')
            ->with('success', 'Video uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $galleryVideo = GalleryVideo::findOrFail($id);
        
        // Videonu sil
        if ($galleryVideo->video && File::exists(public_path('uploads/gallery-videos/' . $galleryVideo->video))) {
            File::delete(public_path('uploads/gallery-videos/' . $galleryVideo->video));
        }

        $galleryVideo->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Video uğurla silindi'
        ]);
    }

    public function status($id)
    {
        $galleryVideo = GalleryVideo::findOrFail($id);
        $galleryVideo->status = !$galleryVideo->status;
        $galleryVideo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
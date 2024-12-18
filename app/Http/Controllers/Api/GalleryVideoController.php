<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryVideoResource;
use App\Models\GalleryVideo;
use Illuminate\Http\Request;

class GalleryVideoController extends Controller
{
    public function index()
    {
        try {
            $galleryVideos = GalleryVideo::where('status', true)
                                       ->latest()
                                       ->get();

            if ($galleryVideos->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Qalereya videoları tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => GalleryVideoResource::collection($galleryVideos),
                'message' => 'Qalereya videoları uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $galleryVideo = GalleryVideo::where('status', true)
                                      ->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new GalleryVideoResource($galleryVideo),
                'message' => 'Qalereya videosu uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 
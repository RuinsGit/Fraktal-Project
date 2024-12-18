<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryTitleResource;
use App\Models\GalleryTitle;
use Illuminate\Http\Request;

class GalleryTitleController extends Controller
{
    public function index()
    {
        try {
            $galleryTitles = GalleryTitle::where('status', true)->get();

            if ($galleryTitles->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Qalereya başlıqları tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => GalleryTitleResource::collection($galleryTitles),
                'message' => 'Qalereya başlıqları uğurla gətirildi'
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
            $galleryTitle = GalleryTitle::where('status', true)->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new GalleryTitleResource($galleryTitle),
                'message' => 'Qalereya başlığı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 
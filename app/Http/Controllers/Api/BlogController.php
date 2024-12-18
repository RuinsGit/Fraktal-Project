<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        try {
            $blogs = Blog::where('status', Blog::STATUS_ACTIVE)
                        ->whereNotNull('published_at')
                        ->latest('published_at')
                        ->get();

            if ($blogs->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bloqlar tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => BlogResource::collection($blogs),
                'message' => 'Bloqlar uğurla gətirildi'
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
            $blog = Blog::where('status', Blog::STATUS_ACTIVE)
                       ->whereNotNull('published_at')
                       ->findOrFail($id);

            // Görüntülenme sayısını artır
            $blog->increment('view_count');

            return response()->json([
                'status' => 'success',
                'data' => new BlogResource($blog),
                'message' => 'Bloq uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }

    public function popular()
    {
        try {
            $blogs = Blog::where('status', Blog::STATUS_ACTIVE)
                        ->whereNotNull('published_at')
                        ->orderBy('view_count', 'desc')
                        ->take(5)
                        ->get();

            if ($blogs->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Populyar bloqlar tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => BlogResource::collection($blogs),
                'message' => 'Populyar bloqlar uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
}

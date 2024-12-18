<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogTitleResource;
use App\Models\BlogTitle;
use Illuminate\Http\Request;

class BlogTitleController extends Controller
{
    public function index()
    {
        try {
            $blogTitles = BlogTitle::where('status', true)->get();

            if ($blogTitles->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bloq başlıqları tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => BlogTitleResource::collection($blogTitles),
                'message' => 'Bloq başlıqları uğurla gətirildi'
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
            $blogTitle = BlogTitle::where('status', true)->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new BlogTitleResource($blogTitle),
                'message' => 'Bloq başlığı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 
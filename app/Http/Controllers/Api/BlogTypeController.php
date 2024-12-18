<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogTypeResource;
use App\Models\BlogType;
use Illuminate\Http\Request;

class BlogTypeController extends Controller
{
    public function index()
    {
        try {
            $blogTypes = BlogType::where('status', true)->get();
            
            return response()->json([
                'status' => 'success',
                'data' => BlogTypeResource::collection($blogTypes),
                'message' => 'Blog növləri uğurla gətirildi'
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
            $blogType = BlogType::findOrFail($id);
            
            return response()->json([
                'status' => 'success',
                'data' => new BlogTypeResource($blogType),
                'message' => 'Blog növü uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Blog növü tapılmadı'
            ], 404);
        }
    }
} 
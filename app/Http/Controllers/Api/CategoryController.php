<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::where('status', 1)->get();

            if ($categories->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Heç bir kateqoriya tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => CategoryResource::collection($categories),
                'message' => 'Kateqoriyalar uğurla gətirildi'
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
            $category = Category::where('status', 1)
                              ->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new CategoryResource($category),
                'message' => 'Kateqoriya uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        try {
            $subCategories = SubCategory::with('category')
                ->orderBy('created_at', 'desc')
                ->get();

            if ($subCategories->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Heç bir alt kateqoriya tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => SubCategoryResource::collection($subCategories),
                'message' => 'Alt kateqoriyalar uğurla gətirildi'
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
            $subCategory = SubCategory::with('category')->find($id);

            if (!$subCategory) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Alt kateqoriya tapılmadı',
                    'requested_id' => $id
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new SubCategoryResource($subCategory),
                'message' => 'Alt kateqoriya uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getByCategory($categoryId)
    {
        try {
            $category = Category::find($categoryId);
            
            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kateqoriya tapılmadı'
                ], 404);
            }

            $subCategories = SubCategory::with('category')
                ->where('category_id', $categoryId)
                ->orderBy('created_at', 'desc')
                ->get();

            if ($subCategories->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bu kateqoriyaya aid alt kateqoriya tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => SubCategoryResource::collection($subCategories),
                'message' => 'Alt kateqoriyalar uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 
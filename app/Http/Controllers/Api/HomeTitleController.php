<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeTitle;
use App\Http\Resources\HomeTitleResource;

class HomeTitleController extends Controller
{
    public function index()
    {
        try {
            $titles = HomeTitle::latest()->get();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Başlıqlar uğurla gətirildi',
                'data' => HomeTitleResource::collection($titles)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function active()
    {
        try {
            $titles = HomeTitle::where('status', 1)->latest()->get();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Aktiv başlıqlar uğurla gətirildi',
                'data' => HomeTitleResource::collection($titles)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 
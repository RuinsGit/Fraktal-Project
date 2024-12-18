<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HumanDesignResource;
use App\Models\HumanDesign;
use Illuminate\Http\Request;

class HumanDesignController extends Controller
{
    public function index()
    {
        try {
            $humanDesign = HumanDesign::where('status', true)->first();

            if (!$humanDesign) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'İnsan dizaynı məlumatı tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new HumanDesignResource($humanDesign),
                'message' => 'İnsan dizaynı məlumatı uğurla gətirildi'
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
            $humanDesign = HumanDesign::where('status', true)->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new HumanDesignResource($humanDesign),
                'message' => 'İnsan dizaynı məlumatı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        try {
            $partners = Partner::where('status', 1)->get();

            if ($partners->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Heç bir partner tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => PartnerResource::collection($partners),
                'message' => 'Partnerlər uğurla gətirildi'
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
            $partner = Partner::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new PartnerResource($partner),
                'message' => 'Partner uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 
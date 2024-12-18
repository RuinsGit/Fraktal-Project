<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutCompanyResource;
use App\Models\AboutCompany;
use Illuminate\Http\Request;

class AboutCompanyController extends Controller
{
    public function index()
    {
        try {
            $aboutCompany = AboutCompany::where('status', true)->first();

            if (!$aboutCompany) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Şirkət haqqında məlumat tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new AboutCompanyResource($aboutCompany),
                'message' => 'Şirkət haqqında məlumat uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 
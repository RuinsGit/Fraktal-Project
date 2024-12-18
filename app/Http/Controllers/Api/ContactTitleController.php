<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactTitleResource;
use App\Models\ContactTitle;
use Illuminate\Http\Request;

class ContactTitleController extends Controller
{
    public function index()
    {
        try {
            $contactTitles = ContactTitle::where('status', true)->get();

            if ($contactTitles->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Əlaqə başlıqları tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => ContactTitleResource::collection($contactTitles),
                'message' => 'Əlaqə başlıqları uğurla gətirildi'
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
            $contactTitle = ContactTitle::where('status', true)->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => new ContactTitleResource($contactTitle),
                'message' => 'Əlaqə başlığı uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }
} 
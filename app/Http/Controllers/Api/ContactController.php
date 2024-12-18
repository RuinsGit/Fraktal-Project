<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        try {
            $contact = Contact::first();

            if (!$contact) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Əlaqə məlumatları tapılmadı'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => new ContactResource($contact),
                'message' => 'Əlaqə məlumatları uğurla gətirildi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 
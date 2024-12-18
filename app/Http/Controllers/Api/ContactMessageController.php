<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'message' => 'required|string'
            ], [
                'name.required' => 'Ad və soyad daxil edilməlidir',
                'email.required' => 'E-poçt ünvanı daxil edilməlidir',
                'email.email' => 'Düzgün e-poçt ünvanı daxil edilməlidir',
                'phone.required' => 'Telefon nömrəsi daxil edilməlidir',
                'message.required' => 'Mesaj daxil edilməlidir'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasiya xətası',
                    'errors' => $validator->errors()
                ], 422);
            }

            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'status' => false // Yeni mesaj olduğu için oxunmamış
            ]);

            return response()->json([
                'status' => 'success',
                'data' => new ContactMessageResource($contactMessage),
                'message' => 'Mesajınız uğurla göndərildi'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
} 
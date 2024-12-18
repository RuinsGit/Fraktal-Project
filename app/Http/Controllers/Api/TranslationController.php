<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TranslationResource;
use App\Models\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index()
    {
        $translations = Translation::all();
        return TranslationResource::collection($translations);
    }

    public function show($id)
    {
        $translation = Translation::find($id);
        return new TranslationResource($translation);
    }
    
} 
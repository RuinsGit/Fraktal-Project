<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return GalleryResource::collection($galleries);
    }

    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return new GalleryResource($gallery);
    }
} 
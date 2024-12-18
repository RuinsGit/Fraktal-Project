<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudyContent;
use App\Http\Resources\StudyContentResource;
use App\Http\Resources\StudyContentCollection;

class StudyContentController extends Controller
{
    public function index()
    {
        $studyContents = StudyContent::where('status', 1)->get();
        return new StudyContentCollection($studyContents);
    }

    public function show($slug)
    {
        $studyContent = StudyContent::where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();
        return new StudyContentResource($studyContent);
    }
} 
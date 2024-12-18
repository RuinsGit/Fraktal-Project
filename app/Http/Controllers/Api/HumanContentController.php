<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HumanContent;
use App\Http\Resources\HumanContentCollection;

class HumanContentController extends Controller
{
    public function index()
    {
        $humanContents = HumanContent::where('status', 1)->get();
        return new HumanContentCollection($humanContents);
    }
} 
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FooterResource;
use App\Models\Service;

class FooterController extends Controller
{
    public function index()
    {
        // Son 5 hizmeti al
        $services = Service::where('status', true)
                           ->latest()
                           ->take(5)
                           ->get();

        return new FooterResource($services);
    }
}
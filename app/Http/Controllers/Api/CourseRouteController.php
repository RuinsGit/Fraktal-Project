<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseRouteResource;
use App\Models\CourseRoute;
use Illuminate\Http\Request;

class CourseRouteController extends Controller
{
    public function index()
    {
        $routes = CourseRoute::orderBy('order')->get();
        return CourseRouteResource::collection($routes);
    }

    public function show($id)
    {
        $route = CourseRoute::findOrFail($id);
        return new CourseRouteResource($route);
    }

    public function store(Request $request)
    {
        $request->validate([
            'text_az' => 'required|string|max:255',
            'text_en' => 'required|string|max:255',
            'text_ru' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'status' => 'boolean',
            'order' => 'integer'
        ]);

        $route = CourseRoute::create($request->all());
        return new CourseRouteResource($route, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text_az' => 'required|string|max:255',
            'text_en' => 'required|string|max:255',
            'text_ru' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'status' => 'boolean',
            'order' => 'integer'
        ]);

        $route = CourseRoute::findOrFail($id);
        $route->update($request->all());
        return new CourseRouteResource($route);
    }

    public function destroy($id)
    {
        $route = CourseRoute::findOrFail($id);
        $route->delete();
        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CourseRouteController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $routes = CourseRoute::orderBy('order')->get();
        return view('back.pages.course-route.index', compact('routes'));
    }

    public function create()
    {
        return view('back.pages.course-route.create');
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

        CourseRoute::create($request->all());

        toastr()->success('Kurs yolu uğurla əlavə edildi');
        return redirect()->route('admin.course-route.index');
    }

    public function edit($id)
    {
        $route = CourseRoute::findOrFail($id);
        return view('back.pages.course-route.edit', compact('route'));
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

        toastr()->success('Kurs yolu uğurla yeniləndi');
        return redirect()->route('admin.course-route.index');
    }

    public function destroy($id)
    {
        $route = CourseRoute::findOrFail($id);
        $route->delete();

        toastr()->success('Kurs yolu uğurla silindi');
        return redirect()->route('admin.course-route.index');
    }
}
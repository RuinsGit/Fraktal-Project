<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseType;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CourseTypeController extends Controller
{
    public function index()
    {
        $courseTypes = CourseType::all();
        return view('admin.course-types.index', compact('courseTypes'));
    }

    public function create()
    {
        return view('admin.course-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        CourseType::create($data);

        Toastr::success('Kurs növü uğurla əlavə edildi');
        return redirect()->route('admin.course-types.index');
    }

    public function edit(CourseType $courseType)
    {
        return view('admin.course-types.edit', compact('courseType'));
    }

    public function update(Request $request, CourseType $courseType)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        $courseType->update($data);

        Toastr::success('Kurs növü uğurla yeniləndi');
        return redirect()->route('admin.course-types.index');
    }

    public function destroy(CourseType $courseType)
    {
        $courseType->delete();
        
        Toastr::success('Kurs növü uğurla silindi');
        return redirect()->route('admin.course-types.index');
    }
}
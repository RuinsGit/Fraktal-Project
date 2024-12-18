<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudyContentController extends Controller
{
    public function index()
    {
        $studyContents = StudyContent::all();
        return view('back.study-content.index', compact('studyContents'));
    }

    public function create()
    {
        return view('back.study-content.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'description_az' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/study-content'), $image);
        }

        StudyContent::create([
            'text_az' => $request->text_az,
            'text_en' => $request->text_en,
            'text_ru' => $request->text_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'image' => $image ?? null,
            'status' => $request->status
        ]);

        toastr()->success('Məlumat uğurla əlavə edildi');
        return redirect()->route('admin.study-content.index');
    }

    public function edit($id)
    {
        $studyContent = StudyContent::findOrFail($id);
        return view('back.study-content.edit', compact('studyContent'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'description_az' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $studyContent = StudyContent::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($studyContent->image && File::exists(public_path('uploads/study-content/' . $studyContent->image))) {
                File::delete(public_path('uploads/study-content/' . $studyContent->image));
            }

            $file = $request->file('image');
            $image = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/study-content'), $image);
        }

        $studyContent->update([
            'text_az' => $request->text_az,
            'text_en' => $request->text_en,
            'text_ru' => $request->text_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'image' => $image ?? $studyContent->image,
            'status' => $request->status ?? $studyContent->status
        ]);

        return redirect()
            ->route('admin.study-content.index')
            ->with('success', 'Məlumat uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $studyContent = StudyContent::findOrFail($id);
        
        if ($studyContent->image && File::exists(public_path('uploads/study-content/' . $studyContent->image))) {
            File::delete(public_path('uploads/study-content/' . $studyContent->image));
        }

        $studyContent->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Məlumat uğurla silindi'
        ]);
    }

    public function status($id)
    {
        $studyContent = StudyContent::findOrFail($id);
        $studyContent->status = !$studyContent->status;
        $studyContent->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
} 
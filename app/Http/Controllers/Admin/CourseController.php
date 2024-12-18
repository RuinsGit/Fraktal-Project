<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('back.course.index', compact('courses'));
    }

    public function create()
    {
        return view('back.course.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        try {
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('uploads/courses');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                }
            }

            Course::create([
                'image' => 'uploads/courses/' . $webpFileName,
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'text_az' => $request->text_az,
                'text_en' => $request->text_en,
                'text_ru' => $request->text_ru,
                'status' => $request->status
            ]);

            return redirect()
                ->route('admin.course.index')
                ->with('success', 'Kurs uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('back.course.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        try {
            $course = Course::findOrFail($id);

            if($request->hasFile('image')) {
                if ($course->image && File::exists(public_path($course->image))) {
                    File::delete(public_path($course->image));
                }
                
                $file = $request->file('image');
                $destinationPath = public_path('uploads/courses');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    
                    $course->image = 'uploads/courses/' . $webpFileName;
                }
            }

            $course->update([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'text_az' => $request->text_az,
                'text_en' => $request->text_en,
                'text_ru' => $request->text_ru,
                'status' => $request->status
            ]);

            return redirect()
                ->route('admin.course.index')
                ->with('success', 'Kurs uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        
        if(File::exists(public_path($course->image))) {
            File::delete(public_path($course->image));
        }
        
        $course->delete();

        return redirect()
            ->route('admin.course.index')
            ->with('success', 'Kurs uğurla silindi');
    }

    public function status($id)
    {
        $course = Course::findOrFail($id);
        $course->status = !$course->status;
        $course->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
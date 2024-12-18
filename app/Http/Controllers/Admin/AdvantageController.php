<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advantage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdvantageController extends Controller
{
    public function index()
    {
        $advantages = Advantage::latest()->get();
        return view('back.home.advantages.index', compact('advantages'));
    }

    public function create()
    {
        return view('back.home.advantages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('uploads/advantages');
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

                    $data['image'] = 'uploads/advantages/' . $webpFileName;
                }
            }

            Advantage::create($data);

            return redirect()
                ->route('admin.home.advantages.index')
                ->with('success', 'Üstünlük uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $advantage = Advantage::findOrFail($id);
        return view('back.home.advantages.edit', compact('advantage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        try {
            $advantage = Advantage::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('image')) {
                if ($advantage->image && File::exists(public_path($advantage->image))) {
                    File::delete(public_path($advantage->image));
                }

                $file = $request->file('image');
                $destinationPath = public_path('uploads/advantages');
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

                    $data['image'] = 'uploads/advantages/' . $webpFileName;
                }
            }

            $advantage->update($data);

            return redirect()
                ->route('admin.home.advantages.index')
                ->with('success', 'Üstünlük uğurla yeniləndi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $advantage = Advantage::findOrFail($id);

            if ($advantage->image && File::exists(public_path($advantage->image))) {
                File::delete(public_path($advantage->image));
            }

            $advantage->delete();

            return redirect()
                ->route('admin.home.advantages.index')
                ->with('success', 'Üstünlük uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        try {
            $advantage = Advantage::findOrFail($id);
            $advantage->status = !$advantage->status;
            $advantage->save();

            return response()->json([
                'success' => true,
                'message' => 'Status uğurla yeniləndi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
}
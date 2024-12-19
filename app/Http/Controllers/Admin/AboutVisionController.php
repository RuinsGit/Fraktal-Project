<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutVision;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AboutVisionController extends Controller
{
    public function index()
    {
        $vision = AboutVision::first();
        return view('back.about.vision.index', compact('vision'));
    }

    public function create()
    {
        if (AboutVision::count() > 0) {
            return redirect()->route('admin.about.vision.index')
                ->with('error', 'Yalnız bir vizyon məlumatı əlavə edilə bilər!');
        }
        return view('back.about.vision.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name_1_az' => 'required|string|max:255',
            'name_1_en' => 'nullable|string|max:255',
            'name_1_ru' => 'nullable|string|max:255',
            'text_1_az' => 'required|string',
            'text_1_en' => 'nullable|string',
            'text_1_ru' => 'nullable|string',
            'icon_2' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'name_2_az' => 'required|string|max:255',
            'name_2_en' => 'nullable|string|max:255',
            'name_2_ru' => 'nullable|string|max:255',
            'text_2_az' => 'required|string',
            'text_2_en' => 'nullable|string',
            'text_2_ru' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|boolean'
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('icon_1')) {
                $icon1 = $request->file('icon_1');
                $icon1Name = Str::uuid() . '.' . $icon1->getClientOriginalExtension();
                $icon1->move(public_path('uploads/about/vision'), $icon1Name);
                $data['icon_1'] = 'uploads/about/vision/' . $icon1Name;
            }

            if ($request->hasFile('icon_2')) {
                $icon2 = $request->file('icon_2');
                $icon2Name = Str::uuid() . '.' . $icon2->getClientOriginalExtension();
                $icon2->move(public_path('uploads/about/vision'), $icon2Name);
                $data['icon_2'] = 'uploads/about/vision/' . $icon2Name;
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about/vision'), $imageName);
                $data['image'] = 'uploads/about/vision/' . $imageName;
            }

            AboutVision::create($data);

            return redirect()
                ->route('admin.about.vision.index')
                ->with('success', 'Məlumat uğurla əlavə edildi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $vision = AboutVision::findOrFail($id);
        return view('back.about.vision.edit', compact('vision'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'icon_1' => 'nullable|file|mimes:gif|max:2048',
            'icon_2' => 'nullable|file|mimes:gif|max:2048',
            // ... diğer validasyonlar ...
        ]);

        try {
            $vision = AboutVision::findOrFail($id);
            $data = $request->all();

            // İkon 1 için
            if ($request->hasFile('icon_1')) {
                // Eski dosyayı sil
                if ($vision->icon_1 && File::exists(public_path($vision->icon_1))) {
                    File::delete(public_path($vision->icon_1));
                }

                $file = $request->file('icon_1');
                $destinationPath = public_path('uploads/about/vision');
                $gifFileName = time() . '_icon1_' . uniqid() . '.gif';

                // Dizin kontrolü
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                // GIF dosyasını olduğu gibi kaydet
                $file->move($destinationPath, $gifFileName);
                $data['icon_1'] = 'uploads/about/vision/' . $gifFileName;
            }

            // İkon 2 için
            if ($request->hasFile('icon_2')) {
                // Eski dosyayı sil
                if ($vision->icon_2 && File::exists(public_path($vision->icon_2))) {
                    File::delete(public_path($vision->icon_2));
                }

                $file = $request->file('icon_2');
                $destinationPath = public_path('uploads/about/vision');
                $gifFileName = time() . '_icon2_' . uniqid() . '.gif';

                // Dizin kontrolü
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }

                // GIF dosyasını olduğu gibi kaydet
                $file->move($destinationPath, $gifFileName);
                $data['icon_2'] = 'uploads/about/vision/' . $gifFileName;
            }

            // Normal resim güncelleme işlemi
            if ($request->hasFile('image')) {
                // Eski resmi sil
                if ($vision->image && File::exists(public_path($vision->image))) {
                    File::delete(public_path($vision->image));
                }

                $image = $request->file('image');
                $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about/vision'), $imageName);
                $data['image'] = 'uploads/about/vision/' . $imageName;
            }

            // Veritabanını güncelle
            $vision->update($data);

            return redirect()
                ->route('admin.about.vision.index')
                ->with('success', 'Məlumat uğurla yeniləndi');

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
            $vision = AboutVision::findOrFail($id);

            if ($vision->image && File::exists(public_path($vision->image))) {
                File::delete(public_path($vision->image));
            }

            $vision->delete();

            return redirect()
                ->route('admin.about.vision.index')
                ->with('success', 'Məlumat uğurla silindi');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        $vision = AboutVision::findOrFail($id);
        $vision->status = !$vision->status;
        $vision->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
            'newStatus' => $vision->status
        ]);
    }
}
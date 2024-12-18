<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('back.pages.service.index', compact('services'));
    }

    public function create()
    {
        return view('back.pages.service.create');
    }

    public function store(ServiceRequest $request)
    {
        try {
            // Şəkil yükləmə
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                
                if (!file_exists(public_path('uploads/services'))) {
                    mkdir(public_path('uploads/services'), 0777, true);
                }
                
                $image->move(public_path('uploads/services'), $imageName);
                $imagePath = 'uploads/services/' . $imageName;
            }

            Service::create([
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'description_az' => $request->description_az,
                'description_en' => $request->description_en,
                'description_ru' => $request->description_ru,
                'image' => $imagePath ?? null,
                'slug' => Str::slug($request->title_en),
                'status' => true
            ]);

            toastr()->success('Xidmət uğurla əlavə edildi!');
            return redirect()->route('admin.service.index');

        } catch (\Exception $e) {
            if (isset($imagePath) && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
            toastr()->error('Xəta: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $service = Service::findOrFail($id);
            return view('back.pages.service.edit', compact('service'));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.service.index')
                ->with('error', 'Xidmət tapılmadı');
        }
    }

    public function update(ServiceRequest $request, $id)
    {
        try {
            $service = Service::findOrFail($id);

            // Yeni resim yüklendiyse
            if ($request->hasFile('image')) {
                // Eski resmi sil
                if ($service->image && file_exists(public_path($service->image))) {
                    unlink(public_path($service->image));
                }

                // Yeni resmi yükle
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/services'), $imageName);
                $imagePath = 'uploads/services/' . $imageName;
            }

            // Verileri güncelle
            $service->update([
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'description_az' => $request->description_az,
                'description_en' => $request->description_en,
                'description_ru' => $request->description_ru,
                'image' => $request->hasFile('image') ? $imagePath : $service->image,
                'slug' => Str::slug($request->title_en)
            ]);

            toastr()->success('Xidmət uğurla yeniləndi!');
            return redirect()->route('admin.service.index');

        } catch (\Exception $e) {
            // Hata durumunda yeni yüklenen resmi sil
            if (isset($imagePath) && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            toastr()->error('Xəta: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            
            
            if ($service->icon && file_exists(public_path($service->icon))) {
                unlink(public_path($service->icon));
            }

            $service->delete();

            return redirect()
                ->route('admin.service.index')
                ->with('success', 'Xidmət uğurla silindi!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}

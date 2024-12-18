<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('back.pages.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('back.pages.gallery.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title_az' => 'required',
                'title_en' => 'required',
                'title_ru' => 'required',
                'main_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'sub_images.*' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
            ]);

            // Ana resim yükleme ve WEBP'e dönüştürme
            if ($request->hasFile('main_image')) {
                $mainImage = $request->file('main_image');
                $destinationPath = public_path('uploads/gallery');
                $originalFileName = pathinfo($mainImage->getClientOriginalName(), PATHINFO_FILENAME);
                $mainImageName = time() . '_main_' . $originalFileName . '.webp';

                $imageResource = imagecreatefromstring(file_get_contents($mainImage));
                $webpPath = $destinationPath . '/' . $mainImageName;

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $mainImagePath = 'uploads/gallery/' . $mainImageName;
                }
            }

            // Alt resimleri yükleme ve WEBP'e dönüştürme
            $subImagePaths = [];
            if ($request->hasFile('sub_images')) {
                foreach ($request->file('sub_images') as $subImage) {
                    if ($subImage->isValid()) {
                        $originalFileName = pathinfo($subImage->getClientOriginalName(), PATHINFO_FILENAME);
                        $subImageName = time() . '_' . uniqid() . '_' . $originalFileName . '.webp';
                        
                        $imageResource = imagecreatefromstring(file_get_contents($subImage));
                        $webpPath = public_path('uploads/gallery/' . $subImageName);

                        if ($imageResource) {
                            imagewebp($imageResource, $webpPath, 80);
                            imagedestroy($imageResource);
                            $subImagePaths[] = 'uploads/gallery/' . $subImageName;
                        }
                    }
                }
            }

            Gallery::create([
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'image' => $mainImagePath ?? '',
                'main_image' => $mainImagePath ?? null,
                'sub_images' => !empty($subImagePaths) ? json_encode($subImagePaths) : null
            ]);

            toastr()->success('Qalereya müvəffəqiyyətlə əlavə edildi');
            return redirect()->route('admin.gallery.index');

        } catch (\Exception $e) {
            toastr()->error('Xəta: ' . $e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('back.pages.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);

            $validated = $request->validate([
                'title_az' => 'required',
                'title_en' => 'required',
                'title_ru' => 'required',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
                'sub_images.*' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
            ]);

            // Ana resim güncelleme
            if ($request->hasFile('main_image')) {
                // Eski ana resmi sil
                if ($gallery->main_image && File::exists(public_path($gallery->main_image))) {
                    File::delete(public_path($gallery->main_image));
                }

                $mainImage = $request->file('main_image');
                $destinationPath = public_path('uploads/gallery');
                $originalFileName = pathinfo($mainImage->getClientOriginalName(), PATHINFO_FILENAME);
                $mainImageName = time() . '_main_' . $originalFileName . '.webp';

                $imageResource = imagecreatefromstring(file_get_contents($mainImage));
                $webpPath = $destinationPath . '/' . $mainImageName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $mainImagePath = 'uploads/gallery/' . $mainImageName;
                }
            }

            // Alt resimleri güncelleme
            $subImagePaths = [];
            if ($request->hasFile('sub_images')) {
                // Eski alt resimleri sil
                if ($gallery->sub_images) {
                    $oldSubImages = json_decode($gallery->sub_images, true);
                    foreach ($oldSubImages as $oldImage) {
                        if (File::exists(public_path($oldImage))) {
                            File::delete(public_path($oldImage));
                        }
                    }
                }

                foreach ($request->file('sub_images') as $subImage) {
                    if ($subImage->isValid()) {
                        $originalFileName = pathinfo($subImage->getClientOriginalName(), PATHINFO_FILENAME);
                        $subImageName = time() . '_' . uniqid() . '_' . $originalFileName . '.webp';
                        
                        $imageResource = imagecreatefromstring(file_get_contents($subImage));
                        $webpPath = public_path('uploads/gallery/' . $subImageName);

                        if ($imageResource) {
                            imagewebp($imageResource, $webpPath, 80);
                            imagedestroy($imageResource);
                            $subImagePaths[] = 'uploads/gallery/' . $subImageName;
                        }
                    }
                }
            }

            $gallery->update([
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'image' => isset($mainImagePath) ? $mainImagePath : $gallery->image,
                'main_image' => isset($mainImagePath) ? $mainImagePath : $gallery->main_image,
                'sub_images' => !empty($subImagePaths) ? json_encode($subImagePaths) : $gallery->sub_images
            ]);

            toastr()->success('Qalereya uğurla yeniləndi!');
            return redirect()->route('admin.gallery.index');

        } catch (\Exception $e) {
            toastr()->error('Xəta: ' . $e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);

            // Ana resmi sil
            if ($gallery->main_image && File::exists(public_path($gallery->main_image))) {
                File::delete(public_path($gallery->main_image));
            }

            // Alt resimleri sil
            if ($gallery->sub_images) {
                $subImages = json_decode($gallery->sub_images, true);
                foreach ($subImages as $image) {
                    if (File::exists(public_path($image))) {
                        File::delete(public_path($image));
                    }
                }
            }

            $gallery->delete();

            toastr()->success('Qalereya uğurla silindi!');
            return redirect()->route('admin.gallery.index');

        } catch (\Exception $e) {
            toastr()->error('Xəta: ' . $e->getMessage());
            return back();
        }
    }
}
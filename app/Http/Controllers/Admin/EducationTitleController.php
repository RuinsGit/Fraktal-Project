<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EducationTitleController extends Controller
{
    public function index()
    {
        $educationTitle = EducationTitle::first();
        return view('back.education-title.index', compact('educationTitle'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'name_az' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text_az' => 'nullable|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string'
        ]);

        // Sadece gönderilen verileri içeren bir dizi oluştur
        $data = array_filter($request->only([
            'name_az',
            'name_en',
            'name_ru',
            'text_az',
            'text_en',
            'text_ru'
        ]));

        $educationTitle = EducationTitle::firstOrNew(['id' => 1]);

        // Resim yükleme işlemi
        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($educationTitle->image && File::exists(public_path($educationTitle->image))) {
                File::delete(public_path($educationTitle->image));
            }
            
            // Yeni resmi yükle
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/education-title/');
            $image->move($destinationPath, $name);
            
            $data['image'] = '/uploads/education-title/' . $name;
        }

        // Status değerini kontrol et
        if ($request->has('status')) {
            $data['status'] = $request->status;
        }

        // Sadece gönderilen verileri güncelle
        $educationTitle->fill($data);
        $educationTitle->save();

        return redirect()
            ->route('admin.education-title.index')
            ->with('success', 'Məlumatlar uğurla yeniləndi');
    }

    public function status($id)
    {
        $educationTitle = EducationTitle::findOrFail($id);
        $educationTitle->status = !$educationTitle->status;
        $educationTitle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
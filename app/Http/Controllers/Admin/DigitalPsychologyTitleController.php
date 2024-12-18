<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DigitalPsychologyTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DigitalPsychologyTitleController extends Controller
{
    public function index()
    {
        $digitalPsychologyTitle = DigitalPsychologyTitle::first();
        return view('back.digital-psychology-title.index', compact('digitalPsychologyTitle'));
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

        $digitalPsychologyTitle = DigitalPsychologyTitle::firstOrCreate(
            ['id' => 1],
            [
                'image' => 'default.jpg',
                'name_az' => null,
                'name_en' => null,
                'name_ru' => null,
                'text_az' => null,
                'text_en' => null,
                'text_ru' => null,
                'status' => 1
            ]
        );

        if ($request->hasFile('image')) {
            if ($digitalPsychologyTitle->image != 'default.jpg' && File::exists(public_path($digitalPsychologyTitle->image))) {
                File::delete(public_path($digitalPsychologyTitle->image));
            }
            
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/digital-psychology-title/');
            $image->move($destinationPath, $name);
            
            $digitalPsychologyTitle->image = '/uploads/digital-psychology-title/' . $name;
        }

        if ($request->filled('name_az')) $digitalPsychologyTitle->name_az = $request->name_az;
        if ($request->filled('name_en')) $digitalPsychologyTitle->name_en = $request->name_en;
        if ($request->filled('name_ru')) $digitalPsychologyTitle->name_ru = $request->name_ru;
        if ($request->filled('text_az')) $digitalPsychologyTitle->text_az = $request->text_az;
        if ($request->filled('text_en')) $digitalPsychologyTitle->text_en = $request->text_en;
        if ($request->filled('text_ru')) $digitalPsychologyTitle->text_ru = $request->text_ru;
        if ($request->has('status')) $digitalPsychologyTitle->status = $request->status;

        $digitalPsychologyTitle->save();

        return redirect()
            ->route('admin.digital-psychology-title.index')
            ->with('success', 'Məlumatlar uğurla yeniləndi');
    }

    public function status($id)
    {
        $digitalPsychologyTitle = DigitalPsychologyTitle::findOrFail($id);
        $digitalPsychologyTitle->status = !$digitalPsychologyTitle->status;
        $digitalPsychologyTitle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
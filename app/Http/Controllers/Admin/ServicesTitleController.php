<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesTitle;
use Illuminate\Http\Request;

class ServicesTitleController extends Controller
{
    public function index()
    {
        $servicesTitle = ServicesTitle::first();
        return view('back.services-title.index', compact('servicesTitle'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string'
        ]);

        ServicesTitle::updateOrCreate(
            ['id' => 1],
            [
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'text_az' => $request->text_az,
                'text_en' => $request->text_en,
                'text_ru' => $request->text_ru
            ]
        );

        return redirect()
            ->route('admin.services-title.index')
            ->with('success', 'Məlumatlar uğurla yeniləndi');
    }
}
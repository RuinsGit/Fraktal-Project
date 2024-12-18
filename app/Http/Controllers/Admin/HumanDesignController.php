<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HumanDesign;
use Illuminate\Http\Request;

class HumanDesignController extends Controller
{
    public function index()
    {
        $humanDesigns = HumanDesign::all();
        $canCreate = $humanDesigns->isEmpty();
        return view('back.human-design.index', compact('humanDesigns', 'canCreate'));
    }

    public function create()
    {
        if (HumanDesign::count() > 0) {
            return redirect()
                ->route('admin.human-design.index')
                ->with('error', 'Sadəcə bir məlumat əlavə edilə bilər!');
        }
        return view('back.human-design.create');
    }

    public function store(Request $request)
    {
        if (HumanDesign::count() > 0) {
            return redirect()
                ->route('admin.human-design.index')
                ->with('error', 'Sadəcə bir məlumat əlavə edilə bilər!');
        }

        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'description_az' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
        ]);

        HumanDesign::create([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'text_az' => $request->text_az,
            'text_en' => $request->text_en,
            'text_ru' => $request->text_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'status' => $request->status ?? 1
        ]);

        return redirect()
            ->route('admin.human-design.index')
            ->with('success', 'Məlumat uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $humanDesign = HumanDesign::findOrFail($id);
        return view('back.human-design.edit', compact('humanDesign'));
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
            'description_az' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
        ]);

        $humanDesign = HumanDesign::findOrFail($id);
        
        $humanDesign->update([
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'text_az' => $request->text_az,
            'text_en' => $request->text_en,
            'text_ru' => $request->text_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
            'status' => $request->status ?? $humanDesign->status
        ]);

        return redirect()
            ->route('admin.human-design.index')
            ->with('success', 'Məlumat uğurla yeniləndi');
    }

    public function destroy($id)
    {
        HumanDesign::findOrFail($id)->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Məlumat uğurla silindi'
        ]);
    }

    public function status($id)
    {
        $humanDesign = HumanDesign::findOrFail($id);
        $humanDesign->status = !$humanDesign->status;
        $humanDesign->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
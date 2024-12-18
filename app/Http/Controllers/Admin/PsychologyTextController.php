<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychologyText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PsychologyTextController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $psychologyTexts = PsychologyText::all();
        return view('back.psychology-text.index', compact('psychologyTexts'));
    }

    public function create()
    {
        return view('back.psychology-text.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string',
            'name_en' => 'nullable|string',
            'name_ru' => 'nullable|string',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
        ]);

        try {
            PsychologyText::create([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'text_az' => $request->text_az,
                'text_en' => $request->text_en,
                'text_ru' => $request->text_ru,
                'status' => $request->status ?? 1
            ]);

            return redirect()
                ->route('admin.psychology-text.index')
                ->with('success', 'Məlumat uğurla əlavə edildi');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $psychologyText = PsychologyText::findOrFail($id);
        return view('back.psychology-text.edit', compact('psychologyText'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string',
            'name_en' => 'nullable|string',
            'name_ru' => 'nullable|string',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
        ]);

        try {
            $psychologyText = PsychologyText::findOrFail($id);
            
            $psychologyText->update([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'text_az' => $request->text_az,
                'text_en' => $request->text_en,
                'text_ru' => $request->text_ru,
                'status' => $request->status ?? $psychologyText->status
            ]);

            return redirect()
                ->route('admin.psychology-text.index')
                ->with('success', 'Məlumat uğurla yeniləndi');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $psychologyText = PsychologyText::findOrFail($id);
            $psychologyText->delete();
            
            if(request()->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Məlumat uğurla silindi'
                ]);
            }

            return redirect()
                ->route('admin.psychology-text.index')
                ->with('success', 'Məlumat uğurla silindi');
            
        } catch (\Exception $e) {
            \Log::error('PsychologyText silme hatası: ' . $e->getMessage());
            
            if(request()->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Xəta baş verdi: ' . $e->getMessage()
                ], 500);
            }

            return redirect()
                ->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        $psychologyText = PsychologyText::findOrFail($id);
        $psychologyText->status = !$psychologyText->status;
        $psychologyText->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
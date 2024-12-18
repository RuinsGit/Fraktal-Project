<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::all();
        return view('back.history.index', compact('histories'));
    }

    public function create()
    {
        return view('back.history.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        History::create($request->all());

        return redirect()
            ->route('admin.history.index')
            ->with('success', 'Məlumat uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $history = History::findOrFail($id);
        return view('back.history.edit', compact('history'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|integer',
            'text_az' => 'required|string',
            'text_en' => 'nullable|string',
            'text_ru' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        $history = History::findOrFail($id);
        $history->update($request->all());

        return redirect()
            ->route('admin.history.index')
            ->with('success', 'Məlumat uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $history = History::findOrFail($id);
        $history->delete();

        return redirect()
            ->route('admin.history.index')
            ->with('success', 'Məlumat uğurla silindi');
    }

    public function status($id)
    {
        $history = History::findOrFail($id);
        $history->status = !$history->status;
        $history->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi'
        ]);
    }
}
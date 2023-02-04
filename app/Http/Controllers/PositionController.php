<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\StaffCategory;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return view('positions.index', [
            'positions' => Position::query()->orderBy('name')->get(),
            'staffCategories' => StaffCategory::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Position::query()->create($request->all());
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function update(Request $request, Position $position)
    {
        $position->update($request->all());
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->back()->with('success', 'Удалено!');
    }
}

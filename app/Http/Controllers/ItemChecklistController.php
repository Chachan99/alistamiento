<?php

namespace App\Http\Controllers;

use App\Models\ItemChecklist;
use Illuminate\Http\Request;

class ItemChecklistController extends Controller
{
    public function index()
    {
        $items = ItemChecklist::all();
        return view('checklist.index', compact('items'));
    }

    public function create()
    {
        return view('checklist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:item_checklists',
        ]);

        ItemChecklist::create($request->all());

        return redirect()->route('checklist.index')->with('success', 'Ítem creado.');
    }

   public function edit(ItemChecklist $checklist)
{
    return view('checklist.edit', compact('checklist'));
}

public function update(Request $request, ItemChecklist $checklist)
{
    $request->validate([
        'nombre' => 'required|unique:item_checklists,nombre,' . $checklist->id,
    ]);

    $checklist->update($request->all());

    return redirect()->route('checklist.index')->with('success', 'Ítem actualizado.');
}

public function destroy(ItemChecklist $checklist)
{
    $checklist->delete();

    return redirect()->route('checklist.index')->with('success', 'Ítem eliminado.');
}
}
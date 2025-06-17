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

    public function edit(ItemChecklist $itemChecklist)
    {
        return view('checklist.edit', compact('itemChecklist'));
    }

    public function update(Request $request, ItemChecklist $itemChecklist)
    {
        $request->validate([
            'nombre' => 'required|unique:item_checklists,nombre,' . $itemChecklist->id,
        ]);

        $itemChecklist->update($request->all());

        return redirect()->route('checklist.index')->with('success', 'Ítem actualizado.');
    }

    public function destroy(ItemChecklist $itemChecklist)
    {
        $itemChecklist->delete();

        return redirect()->route('checklist.index')->with('success', 'Ítem eliminado.');
    }
}

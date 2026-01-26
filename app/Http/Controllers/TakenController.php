<?php

namespace App\Http\Controllers;

use App\Models\Taken;
use Illuminate\Http\Request;

class TakenController extends Controller
{
    public function index()
    {
        return view('taken.create');
    }

    public function create(Request $request)
    {

        $validated = $request->validate([
            'titel' => 'required|string|max:70',
            'omschrijving' => 'nullable|string',
            'categorie' => 'required|string|in:school,werk,side-project,prive',
            'deadline' => 'nullable|date',
            'type' => 'required|string|in:anders,backend,frontend,fullStack,API,AI,database,devops,testing,design,documentation',
            'prioriteit' => 'required|string|in:laag,medium,hoog',
        ]);
        Taken::create([
            'user_id' => $request->user()->id,
            'titel' => $validated['titel'],
            'omschrijving' => $validated['omschrijving'] ?? null,
            'deadline' => $validated['deadline'] ?? null,
            'categorie' => $request->input('categorie'),
            'type' => $validated['type'],
            'status' => 'niet klaar',
            'prioriteit' => $validated['prioriteit'],
        ]);

        return redirect()->route('dashboard')->with('succesBerichtTaak', 'Taak succesvol aangemaakt.');
    }

    public function updatePage($id)
    {
        $taak = Taken::where('id', $id)->first();

        return view('taken.update', ['taak' => $taak]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'titel' => 'required|string|max:70',
            'omschrijving' => 'nullable|string',
            'categorie' => 'required|string|in:school,werk,side-project,prive',
            'deadline' => 'nullable|date',
            'type' => 'required|string|in:anders,backend,frontend,fullStack,API,AI,database,devops,testing,design,documentation',
            'prioriteit' => 'required|string|in:laag,medium,hoog',
        ]);

        $taak = Taken::findOrFail($validated['id']);
        $taak->update([
            'titel' => $validated['titel'],
            'omschrijving' => $validated['omschrijving'] ?? null,
            'deadline' => $validated['deadline'] ?? null,
            'categorie' => $validated['categorie'],
            'type' => $validated['type'],
            'prioriteit' => $validated['prioriteit'],
        ]);

        return redirect()->route('dashboard')->with('succesBerichtTaak', 'Taak succesvol bijgewerkt.');
    }

    public function delete($id)
    {
        $taak = Taken::findOrFail($id);
        $taak->delete();
        return redirect()->route('dashboard')->with('succesBerichtTaak', 'Taak succesvol verwijderd.');
    }
}

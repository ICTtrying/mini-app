<?php

namespace App\Http\Controllers;

use App\Models\Taken;
use Illuminate\Http\Request;
use Pest\ArchPresets\Php;

class TakenController extends Controller
{
    public function index()
    {
        return view('takenMaken.index');
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
}

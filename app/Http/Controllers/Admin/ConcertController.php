<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Concert;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function index()
    {
        $concerts = Concert::orderBy('date', 'desc')->paginate(10);
        return view('admin.concerts.index', compact('concerts'));
    }

    public function create()
    {
        return view('admin.concerts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'ville' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Concert::create($validated);

        return redirect()->route('admin.concerts.index')->with('success', 'Concert ajouté avec succès.');
    }

    public function edit(Concert $concert)
    {
        return view('admin.concerts.edit', compact('concert'));
    }

    public function update(Request $request, Concert $concert)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'ville' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $concert->update($validated);

        return redirect()->route('admin.concerts.index')->with('success', 'Concert mis à jour avec succès.');
    }

    public function destroy(Concert $concert)
    {
        $concert->delete();
        return redirect()->route('admin.concerts.index')->with('success', 'Concert supprimé avec succès.');
    }
}
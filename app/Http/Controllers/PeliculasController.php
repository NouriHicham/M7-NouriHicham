<?php

namespace App\Http\Controllers;

use App\Models\Peliculas;
use Illuminate\Http\Request;

class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peliculas = Peliculas::all();
        return view('peliculas.index', compact('peliculas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peliculas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'year' => 'required|integer',
            'duration' => 'required|integer',
        ]);

        Peliculas::create($request->all());
        return redirect()->route('peliculas.index')->with('success', 'Película creada correctament!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peliculas $peliculas)
    {
        return view('peliculas.show', compact('peliculas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peliculas $peliculas)
    {
        return view('peliculas.edit', compact('peliculas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peliculas $peliculas)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'year' => 'required|integer',
            'duration' => 'required|integer',
        ]);

        $peliculas->update($request->all());
        return redirect()->route('peliculas.index')->with('success', 'Película actualizada correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peliculas $peliculas)
    {
        $peliculas->delete();
        return redirect()->route('peliculas.index')->with('success', 'Película eliminada correctament!');
    }
}

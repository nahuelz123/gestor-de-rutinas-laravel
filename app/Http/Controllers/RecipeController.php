<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Recipe::query();
        
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        
        $recipes = $query->get();
        
        return view('recipes.index', compact('recipes'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'nullable|url',
            'tips' => 'nullable|string',
        ]);

        Recipe::create($request->all());
        return redirect()->route('recipes.index')->with('success', 'receta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id )
    {
        $recipes = Recipe::findOrFail($id);
        return view('recipes.show', compact('recipes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $recipes = Recipe::findOrFail($id);
        return view('recipes.edit', compact('recipes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'nullable|url',
            'tips' => 'nullable|string',
        ]);

        $recipes = Recipe::findOrFail($id);
        $recipes->update($request->all());
        return redirect()->route('recipes.index')->with('success', 'Receta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recipes = Recipe::findOrFail($id);
        $recipes->delete();
        return redirect()->route('recipes.index')->with('success', 'Receta eliminada exitosamente.');
    }
}

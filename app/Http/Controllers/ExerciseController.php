<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController  extends Controller
{
    // Lista todos los ejercicios
    public function index(Request $request)
    {
        $query = Exercise::query();
    
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
    
        $exercises = $query->get();
    
        return view('exercises.index', compact('exercises'));
    }
    // Muestra un ejercicio específico con videos y tips
    public function show($id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('exercises.show', compact('exercise'));
    }

    // Muestra el formulario para crear un nuevo ejercicio (solo para coaches y admin)
    public function create()
    {
        return view('exercises.create');
    }
    

    // Guarda un nuevo ejercicio en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'nullable|url',
            'tips' => 'nullable|string',
        ]);

        Exercise::create($request->all());
        return redirect()->route('exercises.index')->with('success', 'Ejercicio creado exitosamente.');
    }

    // Muestra el formulario para editar un ejercicio existente
    public function edit($id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('exercises.edit', compact('exercise'));
    }

    // Actualiza un ejercicio existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'nullable|url',
            'tips' => 'nullable|string',
        ]);

        $exercise = Exercise::findOrFail($id);
        $exercise->update($request->all());
        return redirect()->route('exercises.index')->with('success', 'Ejercicio actualizado exitosamente.');
    }

    // Elimina un ejercicio existente
    public function destroy($id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->delete();
        return redirect()->route('exercises.index')->with('success', 'Ejercicio eliminado exitosamente.');
    }
}

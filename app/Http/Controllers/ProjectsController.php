<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
      // $projects = Projects::all();
       // return "hola";
        // Obtener el usuario autenticado
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Verificar si el usuario tiene proyectos asociados
        if ($user && $user->projects) {
            $projects = $user->projects;

            // Verificar si hay proyectos asociados
            if ($projects->isEmpty()) {
                return response()->json(['message' => 'No tienes proyectos asociados.'], 200);
            }

            // Retornar los proyectos en formato JSON
            return response()->json($projects);
        }

        // Si el usuario no está autenticado o no tiene proyectos asociados
        return response()->json(['message' => 'No tienes proyectos asociados.'], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $projects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projects $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectsRequest $request, Projects $projects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $projects)
    {
        //
    }
}

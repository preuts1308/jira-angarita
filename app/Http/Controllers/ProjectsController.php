<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User; 
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
    public function create(Request $request)
    {
        // Verificar el rol del usuario
        $userRole = Auth::user()->role;
        $managerId = Auth::id();
        if ($userRole !== 'gerente') {
            return response()->json(['error' => 'No tienes permisos para crear proyectos. Tu rol es: ' . $userRole,$userid], 403);
        }
    
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|date_format:Y-m-d',
            // Agregar más reglas de validación según sea necesario
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Crear el proyecto
        $project = Projects::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'manager_id'=>$managerId,
            // Agregar más campos según sea necesario
        ]);
    
        // Asociar el gerente al proyecto (asumiendo que el usuario autenticado es el gerente)
        //$project->manager()->associate(Auth::user());
        //$project->manager_id = Auth::user()->id;
        //$project->save();
    
        // Devolver una respuesta JSON con los detalles del proyecto creado
        return response()->json([
            'success' => true,
            'message' => 'Proyecto creado exitosamente',
            'data' => $project,
        ]);
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

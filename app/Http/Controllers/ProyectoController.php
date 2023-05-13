<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Repositories\ProyectoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;

class ProyectoController extends Controller
{
    private ProyectoRepository $proyectoRepository;

    public function __construct(ProyectoRepository $proyectoRepository)
    {
        $this->proyectoRepository = $proyectoRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('Admin.Proyecto.index');
    }


    public function projects(): JsonResponse
    {
        $proyectos = $this->proyectoRepository->get_data(['tareas'], 5);
        return response()->json(['proyectos' => $proyectos]);
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
    public function store(Request $request): JsonResponse
    {
        Proyecto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json(['mensaje' => 'Proyecto Creado Exitosamente'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($proyectoid): JsonResponse
    {
        $proyecto = Proyecto::with('tareas')->find($proyectoid);

        return response()->json(['proyecto' => $proyecto], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto): void
    {
        $proyecto->fill($request->all());
        $proyecto->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param Proyecto $proyecto id del proyecto A eliminar
     * @return JsonResponse
     */
    public function destroy(Proyecto $proyecto): JsonResponse
    {
       if($proyecto->tareas()->exists()){
            return response()->json(['mensaje' => 'El Proyecto, Tiene Tareas Asignadas'],409);
       }

       $proyecto->delete();

       return response()->json(['mensaje' => 'Proyecto Eliminado Exitosamente']);
       
    }

    // Método que retorna los Proyectos donde el status es activo (1)
    public function obtenerProyectos()
    {
        return Proyecto::latest()->where('status', '=', 1)->get(['id', 'nombre', 'status']);
    }
}

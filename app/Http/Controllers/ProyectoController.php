<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Repositories\ProyectoRepository;
use Illuminate\Http\JsonResponse;

class ProyectoController extends Controller
{
    private $proyectoRepository;

    public function __construct(ProyectoRepository $proyectoRepository)
    {
        $this->proyectoRepository = $proyectoRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Proyecto.index');
    }


    public function allprojects(): JsonResponse
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
    public function store(Request $request)
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
    public function show(Proyecto $proyecto)
    {
        //
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
    public function update(Request $request, Proyecto $proyecto)
    {
        $proyecto->fill($request->all());
        $proyecto->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        //
    }

    public function obtenerProyectos()
    {
        $proyectos = Proyecto::latest()->where('status', '=', 1)->get(['id', 'nombre', 'status']);
        return $proyectos;
    }
}

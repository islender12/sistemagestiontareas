<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tarea;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;
use App\Http\Controllers\ProyectoController;
use App\Http\Requests\FormCrearTareaRequest;

class TareaController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(ProyectoController $proyectoController)
    {
        $proyectos = $proyectoController->obtenerProyectos();
        $tareas = Tarea::latest()->get();

        return view('Admin.Tarea.CrearTarea', [
            'proyectos' => $proyectos,
            'tareas' => $tareas
        ]);
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
    public function store(FormCrearTareaRequest $request)
    {
        try {
            Tarea::create([
                'nombre' => $request->tarea,
                'descripcion' => $request->descripcion,
                'fecha_asignacion' => $request->fecha_asignacion,
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'user_id' => auth()->user()->id,
                'proyecto_id' => $request->proyecto
            ]);

            return back()->with('status', 'Tarea Creada Exitosamente');
        } catch (\Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        //
    }
}

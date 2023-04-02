<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Tarea;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;
use App\Http\Controllers\ProyectoController;
use App\Http\Requests\FormCrearTareaRequest;
use App\Repositories\TareaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TareaController extends Controller
{

    private $tareaRepository;

    public function __construct(TareaRepository $tareaRepository)
    {
        $this->tareaRepository = $tareaRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        return view('Admin.Tarea.TareaIndex');
    }

    public function listar_tareas()
    {
        $tareas = $this->tareaRepository->get_data(['proyecto:id,nombre', 'user:id,name'], 5);
        return response()->json(['tareas' => $tareas], 200);
    }


    public function tareasanduser()
    {
        $tareas = Tarea::with('proyecto:id,nombre')->where('estatus', '=', 'pendiente')->get();
        $users = User::all(['id', 'name', 'email']);

        return response()->json(['tareas' => $tareas, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ProyectoController $proyectoController)
    {
        $proyectos = $proyectoController->obtenerProyectos();
        return view('Admin.Tarea.CrearTarea', compact('proyectos'));
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
    public function destroy(Tarea $tarea): JsonResponse
    {
        // Validamos primero que no tengamos tareas asignadas a algun usuario
        if ($tarea->users_asigned()->exists()) {
            return response()->json(['mensaje' => 'No se puede eliminar la tarea.'], 409);
        }
        $tarea->delete();
        return response()->json(['mensaje' => 'Tarea eliminada correctamente']);
    }
}

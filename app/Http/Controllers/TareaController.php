<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Tarea;
use Illuminate\View\View;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;
use App\Events\NewTareaAsignada;
use Illuminate\Http\JsonResponse;
use App\Repositories\TareaRepository;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\ProyectoController;
use App\Http\Requests\FormCrearTareaRequest;
use App\Http\Requests\AsignaUsuarioTareaRequest;

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

    public function listar_tareas(): JsonResponse
    {
        $tareas = $this->tareaRepository->get_data(['proyecto:id,nombre', 'user:id,name'], 5);
        return response()->json(['tareas' => $tareas], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ProyectoController $proyectoController): View
    {
        $proyectos = $proyectoController->obtenerProyectos();
        return view('Admin.Tarea.CrearTarea', compact('proyectos'));
    }

    public function AsignarTareaUsuario(AsignaUsuarioTareaRequest $request): JsonResponse
    {
        $tareaAsignada = Tarea::find($request->tarea);
        $tareaAsignada->users_asigned()->attach($request->usuario);

        event(new NewTareaAsignada($tareaAsignada));

        return response()->json(['mensaje' => 'Se ha Creado Exitosamente'], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormCrearTareaRequest $request): RedirectResponse
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

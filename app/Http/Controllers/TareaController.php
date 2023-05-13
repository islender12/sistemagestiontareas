<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tarea;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Events\NewTareaAsignada;
use Illuminate\Http\JsonResponse;
use App\Repositories\TareaRepository;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormCrearTareaRequest;
use App\Http\Requests\AsignaUsuarioTareaRequest;

class TareaController extends Controller
{

    private TareaRepository $tareaRepository;

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
        return response()->json(['tareas' => $tareas]);
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
        $usuario = $request->usuario;
        $tarea = $request->tarea;
        $tareaAsignada = Tarea::with(['proyecto:id,nombre'])->find($tarea);
        $tareaAsignada->users_asigned()->attach($usuario);
        // Usaremos El Evento para modificar el status de la Tarea y Enviar el Correo
        event(new NewTareaAsignada($tareaAsignada, $usuario));
        return response()->json(['mensaje' => 'Se ha Creado Exitosamente', 'id_usuario' => $usuario], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormCrearTareaRequest $request): RedirectResponse
    {
        try {

            $tarea = new Tarea($request->all() + ['user_id' => auth()->id()]);

            $tarea = $this->tareaRepository->save($tarea);

            return back()->with('status', 'Tarea Creada Exitosamente');
        } catch (\Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($tarea): JsonResponse
    {
        $tarea = Tarea::with(['proyecto:id,nombre', 'users_asigned:id,name,email'])->find($tarea);
        return response()->json(['tarea' => $tarea]);
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
            return response()->json(['mensaje' => 'No se puede eliminar la tarea. Pues se Encuentra Asignada'], 409);
        }
        $tarea->delete();
        return response()->json(['mensaje' => 'Tarea eliminada correctamente']);
    }
}

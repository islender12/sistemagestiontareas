<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{

    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * En este ejemplo, estamos usando la función remember() para almacenar en caché
     *  los resultados de la consulta a la tabla de "users" 
     * durante un período de tiempo determinado. 
     * Si la caché ya contiene los resultados de la consulta, se devolverán
     *  los resultados almacenados en caché en lugar de realizar una
     *  nueva consulta a la base de datos. Esto reduce significativamente
     *  la cantidad de consultas a la base de datos y mejora el rendimiento de la aplicación.
     */
    public function users(): JsonResponse
    {
        $users = Cache::remember('users', 5, function () {
            return $this->userRepository->selectColumns(['id', 'name']);
        });

        return response()->json(['users' => $users], 200);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

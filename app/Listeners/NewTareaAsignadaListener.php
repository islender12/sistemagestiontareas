<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\NewTareaAsignada;
use App\Mail\AsignaTareaMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewTareaAsignadaListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewTareaAsignada $event): void
    {
        //
        $usuario = User::find($event->usuarioAsignado);
        $tarea = $event->tarea;
        $tarea->estatus = "asignado";
        $tarea->save();
        $correo = new AsignaTareaMailable(['tarea' => $tarea]);
        Mail::to($usuario->email)->send($correo);
    }
}

<?php

namespace App\Listeners;

use App\Events\NewTareaAsignada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        $tarea = $event->tarea;
        $tarea->estatus = "asignado";
        $tarea->save();
    }
}

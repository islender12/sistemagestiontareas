<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NewTareaAsignada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public object $tarea;
    public int $usuarioAsignado;
    /**
     * Create a new event instance.
     * @param object $tarea Instancia de la Clase Tarea
     * @param int $usuario  id del Usuario asignado
     */
    public function __construct(object $tarea, int $usuario)
    {
        $this->tarea = $tarea;
        $this->usuarioAsignado = $usuario;
    }

}

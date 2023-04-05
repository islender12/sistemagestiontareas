<?php

namespace App\Events;

use App\Models\User;
use App\Models\Tarea;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewTareaAsignada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tarea;
    public $usuarioAsignado;
    /**
     * Create a new event instance.
     * @param $tarea Instancia de la Clase Tarea
     * @param int $usuario  id del Usuario asignado
     */
    public function __construct($tarea, int $usuario)
    {
        $this->tarea = $tarea;
        $this->usuarioAsignado = $usuario;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}

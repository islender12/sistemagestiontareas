<?php

namespace App\Jobs;

use App\Mail\AsignaTareaMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTareaAsignadaEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $usuario;
    public $tarea;
    /**
     * Create a new job instance.
     */
    public function __construct($usuario, $tarea)
    {
        $this->usuario = $usuario;
        $this->tarea = $tarea;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $correo = new AsignaTareaMailable(['tarea' => $this->tarea]);
        Mail::to($this->usuario->email)->send($correo);
    }
}

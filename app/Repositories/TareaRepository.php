<?php

namespace App\Repositories;

use App\Models\Tarea;

class TareaRepository extends BaseRepository
{
    public function __construct(Tarea $tarea)
    {
        parent::__construct($tarea);
    }
}

<?php

namespace App\Repositories;

use App\Models\Proyecto;

class ProyectoRepository extends BaseRepository
{
    public function __construct(Proyecto $proyecto)
    {
        parent::__construct($proyecto);
    }
}

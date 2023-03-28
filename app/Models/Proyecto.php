<?php

namespace App\Models;

use App\Models\Tarea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'status'];

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}

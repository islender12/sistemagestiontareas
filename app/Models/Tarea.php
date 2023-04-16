<?php

namespace App\Models;

use App\Models\User;
use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_asignacion',
        'fecha_vencimiento',
        'user_id',
        'proyecto_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function users_asigned()
    {
        return $this->belongsToMany(User::class, 'tareas_asignadas', 'tarea_id', 'usuario_asignado_id')->withPivot('status');
    }
}

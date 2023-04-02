<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    /**
     * @param Model $model Modelo al Quiero Instanciar para obtener Datos de acuerdo al Modelo
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $paginate El numero de Elementos a mostrar por pagina
     * @param array|string $relations relaciones a la carga ansiosa.
     */
    public function get_data($relations = "", int $paginate = 0, $columns = ['*'])
    {
        $query = $this->model;

        if ($relations && !$paginate) {
            $query = $query->with($relations);
        }

        if (!$relations && $paginate) {

            return $query->paginate($paginate);
        }

        if ($relations && $paginate) {
            return $query->with($relations)->paginate($paginate);
        }

        return $query->get($columns);
    }

    public function selectColumns($columns = ['*'])
    {
        $query = $this->model;
        return $query->get($columns);
    }
}

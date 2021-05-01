<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function model()
    {
        return $this->model;
    }
}

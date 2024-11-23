<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepositories
{
    public function __construct(protected Model $model)
    {}

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }
}

<?php


namespace App\repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements EloquentRepositoryInterface
{

    protected Model $model;
    public function __construct(Model $model)
    {
        $this->model=$model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }


    public function all(): Collection
    {
        return  $this->model->all();
    }
}

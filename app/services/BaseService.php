<?php


namespace App\services;


use App\repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseService implements EloquentServiceInterface
{

    protected BaseRepository $baseRepository;
    public function __construct( BaseRepository $baseRepository)
    {
        $this->baseRepository=$baseRepository;
    }

    public function create(array $attributes): Model
    {
        return $this->baseRepository->create($attributes);
    }

    public function delete($id)
    {
        return $this->baseRepository->delete($id);
    }

    public function all(): Collection
    {
        return $this->baseRepository->all();
    }
}

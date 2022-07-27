<?php


namespace App\repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EloquentRepositoryInterface
{
    public  function create(array $attributes):Model;
    public  function delete($id);
    public function all():Collection;
    public  function getNames();
    public  function getByName($name);
}

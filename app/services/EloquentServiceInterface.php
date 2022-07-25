<?php


namespace App\services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EloquentServiceInterface
{
    public  function create(array $attributes):Model;
    public  function delete($id);
    public  function all():Collection;

}

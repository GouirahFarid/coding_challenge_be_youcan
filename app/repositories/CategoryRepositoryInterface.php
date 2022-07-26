<?php


namespace App\repositories;


use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getByName($name);
    public  function getCategoriesNames();
    public  function getIdsByNames($names);
}

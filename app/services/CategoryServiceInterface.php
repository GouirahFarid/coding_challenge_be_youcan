<?php


namespace App\services;


use App\Models\Category;

interface CategoryServiceInterface
{
    public  function getByName($name);
    public  function getCategoriesNames();
    public  function getIdsByNames($names);
}

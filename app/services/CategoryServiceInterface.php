<?php


namespace App\services;


use App\Models\Category;

interface CategoryServiceInterface
{
    public  function getIdsByNames($names);
}

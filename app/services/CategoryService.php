<?php


namespace App\services;


use App\repositories\BaseRepository;
use App\repositories\CategoryRepository;

class CategoryService extends BaseService implements CategoryServiceInterface
{

    public function __construct(CategoryRepository $baseRepository)
    {
        parent::__construct($baseRepository);
    }

}

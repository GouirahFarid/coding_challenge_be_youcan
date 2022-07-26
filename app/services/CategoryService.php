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

    public function getByName($name)
    {
        return $this->baseRepository->getByName($name);
    }

    public function getCategoriesNames()
    {
        return $this->baseRepository->getCategoriesNames();
    }

    public function getIdsByNames($names)
    {
        return $this->baseRepository->getIdsByNames($names);
    }
}

<?php


namespace App\repositories;


use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): Model
    {
        return  $this->model->create([
            'name'=>$attributes['name']
        ]);
    }
}
